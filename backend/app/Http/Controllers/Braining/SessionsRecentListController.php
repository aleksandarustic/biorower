<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Comment;
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
								   ->with('comments')
								   ->first()
						    	   ->get();

				$sessionsRecentList = array();
			
			





				foreach ($sessions as $key => $value) {

				$komentari=Comment::Where("user_id",$userFirst->id)->Where("session_id",$value["id"])->select('text')->get();

				
				
				   $tmp = array("ID" => $value["id"], 
						"date" => $value["date"],
						"UTC"=>$value["utc"],
						"name"=>$value["name"],
						"comment"=>$komentari,
						"time"=>$value->sessionSummary["time"],
						"dist"=>$value->sessionSummary["distance"],
						"pwr_avg"=>$value->sessionSummary["power_average"],
						"hr_avg"=>$value->sessionSummary["heart_rate_average"],
						"speed"=>$value->sessionSummary["speed_average"],
						"Angle"=>$value->sessionSummary["angle_average"],
						"Pace"=>$value->sessionSummary["pace_average"],
						"pwr_max"=>$value->sessionSummary["power_max"],
						"pwr_balance"=>$value->sessionSummary["power_balance"],
						"stroke_rate"=>$value->sessionSummary["stroke_rate_average"],
						"stroke_rate_max"=>$value->sessionSummary["stroke_rate_max"],
						"hr_rate_max"=>$value->sessionSummary["heart_rate_max"]);

			




					


					

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



