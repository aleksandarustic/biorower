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

class SessionsRecentListController extends Controller {

	
	public function store()
	{
		 $statusCode = 200;

		try{

	        $response = [
	          'account'  => '',
	          'sessionsRecentList'  => '',


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
								  
								   ->orderBy('date', 'DESC')
								   ->skip(Input::get("offset"))
								   ->take(Input::get("pageSize"))
								   ->with("sessionSummary")
								   ->with("comments")
						    	   ->get();

				$sessionsRecentList = array();
				foreach ($sessions as $key => $value) {


					$tmp = array("ID" => $value["id"], 
						"date" => $value["date"],
						"UTC"=>$value["utc"],
						"name"=>"session:".$value["id"],
						"comment"=>"",
						"time"=>$value->sessionSummary["time"],
						"dist"=>$value->sessionSummary["distance"],
						"pwr_avg"=>$value->sessionSummary["power_average"],
						"hr_avg"=>$value->sessionSummary["heart_rate_average"]);


					

					array_push($sessionsRecentList, $tmp);
				}

			
		        $response = [
		          'account'  => Input::get("account"),
	        	  'sessionsRecentList'  => $sessionsRecentList,

		        ];

	    	}

	 	}
	 	catch (Exception $e)
	    {
	    	if ($statusCode != 403){
	    		$statusCode = 400;
	    	}
        }

       
		return Response::json($response, $statusCode);
		




	}


	

}




