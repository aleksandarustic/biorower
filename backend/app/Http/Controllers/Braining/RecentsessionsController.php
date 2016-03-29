<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Session;
use Hashids\Hashids;
use Mail;
use Carbon;
use App\Message;
use App\Library\GlobalFunctions;
use App\Watching;
use Auth;
use Exception;
use App\User;
use Input;

class RecentsessionsController extends Controller {

	public function store()
	{

	    $statusCode = 200;

		try{

	        $response = [
	          'sessionIdsUTCs'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

	        if ($email[0] == "twitter"){

	        	$user = User::where('twitter_id', $email[1])->get();

				if ($user->isEmpty()){
					$userFirst = GlobalFunctions::addUserViaSocialConn(Input::get("password"), "twitter", $email[1]);
				}
				else{
					$userFirst = $user->first();	
				}

	        }
	        else if ($email[0] == "facebook"){
	        	
	        	$user = User::where('facebook_id', $email[1])->get();

				if ($user->isEmpty()){
					$userFirst = GlobalFunctions::addUserViaSocialConn(Input::get("password"), "facebook", $email[1]);
				}
				else{
					$userFirst = $user->first();	
				}

	        }
	        else{

				$user = User::where('email', $email[1])->get();
				$userFirst = $user->first();

				if ($user->isEmpty()){
					$statusCode = 403;
				}
			}

			if ($statusCode != 403){

				$sessions = Session::where('user_id', $userFirst->id)
								   ->where('deleted', false)
								   ->orderBy('id', 'DESC')
								   ->take(Input::get("maxCount"))
						    	   ->get();

				$arrayIds = array();
				foreach ($sessions as $key => $value) {
					$tmp = array("sessionID" => $value["id"], "UTC" => $value["utc"]);
					//array_push($tmp, array("sessionID" => $value["id"], "UTC" => $value["utc"]));
					///array_push($tmp, array("UTC" => $value["utc"]));
					//{"sessionIdsUTCs":{"sessionID":23,"UTC":2147483647}}

					array_push($arrayIds, $tmp);
				}

				/*
				$arrayall = array();
				array_push($arrayall, $arrayIds);
				*/

				//$response = json_encode(array('sessionIdsUTCs'  => $arrayIds));
		        $response = [
		          'sessionIdsUTCs'  => $arrayIds,
		        ];

	    	}

	 	}
	 	catch (Exception $e)
	    {
	    	if ($statusCode != 403){
	    		$statusCode = 400;
	    	}
        }

        /*
			{"sessionIdsUTCs":"[[{\"sessionID\":23},{\"UTC\":2147483647}],[{\"sessionID\":22},{\"UTC\":2147483647}],[{\"sessionID\":21},{\"UTC\":2147483647}],[{\"sessionID\":20},{\"UTC\":2147483647}],[{\"sessionID\":19},{\"UTC\":2147483647}]]"}

			{"sessionIdsUTCs":[{"sessionID":23},{"UTC":2147483647}],[{"sessionID":22},{"UTC":2147483647}],[{"sessionID":21},{"UTC":2147483647}],[{"sessionID":20},{"UTC":2147483647}],[{"sessionID":19},{"UTC":2147483647}]}

			{"sessionIdsUTCs":[{"sessionID":23},{"UTC":2147483647}]}
        */

		return Response::json($response, $statusCode);

	}



}

