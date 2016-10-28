<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Session;
use Exception;
use App\User;
use Input;
use Carbon;
use DB;
use App\Library\GlobalFunctions;

class HistorystatisticsController extends Controller {

	public function store()
	{

	    $statusCode = 200;

		try{
			
	        $response = [
	          'account' => '',
	          'historydata'  => '',
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

	        }else if ($email[0] == "facebook"){
	        	$user = User::where('facebook_id', $email[1])->get();

				if ($user->isEmpty()){
					$userFirst = GlobalFunctions::addUserViaSocialConn(Input::get("password"), "facebook", $email[1]);
				}
				else{
					$userFirst = $user->first();	
				}

	        } else{
				$user = User::where('email', $email[1])->get();
				$userFirst = $user->first();

				if ($user->isEmpty()){
					$statusCode = 403;
				}
			}

			if($statusCode != 403){
				$groupType = "";
				if (Input::get("groupType") != ""){
		        	$groupType = Input::get("groupType");
				}

		        $rangeType = Input::get("rangeType");
		        $dateStart = Input::get("dateStart");

		        $results = GlobalFunctions::GetHistoryStatistics($groupType, $rangeType, $dateStart, $userFirst->id);

		        $response = [
		          'account' => Input::get("account"),
		          'historydata'  => $results,
		        ];
		    }


	 	}
	 	catch (Exception $e)
	    {
    		$statusCode = 400;
        }

		return Response::json($response, $statusCode);

	}

}

