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

class GetsessionsController extends Controller {

	public function store()
	{

		try{
	        $statusCode = 200;
	        $response = [
	          'sessionIds'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

	        if ($email[0] == "twitter"){
	        	$user = User::where('twitter_id', $email[1])->get();
	        }
	        else if ($email[0] == "facebook"){
	        	$user = User::where('facebook_id', $email[1])->get();
			}	        
	        else{
				$user = User::where('email', $email[1])->get();
			}

			if ($user->isEmpty()){
			    throw new Exception;
			}

			$userFirst = $user->first();

			$arrayIds = array();
			foreach (Input::get("sessionIds") as $valInput) {
				array_push($arrayIds, $valInput);
			}

			$sessions = Session::whereIn('id', $arrayIds)->with("sessionSummary")->get();

			$arraySessions = array();
			foreach ($sessions as $session) {
				$tmp = array();
				//za biorower

				$tmp["ID"] 				= $arrayIds[0];
				$tmp["name"] 			= $session["name"];
				$tmp["description"]		= $session["description"];
				$tmp["dataVersion"] 	= $session["dataVersion"];
				$tmp["deviceType"] 		= $session["deviceType"];
				$tmp["serialNumber"] 	= $session["serialNumber"];
				$tmp["firmwareVersion"] = $session["firmwareVersion"];

				$UA = array();
				$UA['type'] 			= $session["UA_type"];
				$UA['name'] 			= $session["UA_name"];
				$UA['serialNumber'] 	= $session["UA_serialNumber"];
				$UA['application'] 		= $session["UA_application"];
				$UA['appVersion'] 		= $session["UA_appVersion"];

				$tmp["userAgent"] 		= $UA;

				$tmp["account"] 		= Input::get("account");
				$tmp["UTC"] 			= $session["utc"];
				$tmp["date"] 			= $session["date"];
		
				$tmp["splits"]			= json_decode($session["data"]);

				$summary_list = array();
				$summary_list["scnt"] 		= $session->sessionSummary->stroke_count;
				$summary_list["time"] 		= $session->sessionSummary->time;
				$summary_list["dist"] 		= $session->sessionSummary->distance;
				$summary_list['cal']		= $session->sessionSummary->calories;
				$summary_list["sdist_avg"] 	= $session->sessionSummary->stroke_distance_average;
				$summary_list["sdist_max"] 	= $session->sessionSummary->stroke_distance_max;
				$summary_list["spd_avg"] 	= $session->sessionSummary->speed_average;
				$summary_list["spd_max"] 	= $session->sessionSummary->speed_max;
				$summary_list["pace500_avg"]= $session->sessionSummary->pace_average;
				$summary_list["pace500_max"]= $session->sessionSummary->pace_max;
				$summary_list["pace2k_avg"]	= $session->sessionSummary->pace2km_average;
				$summary_list["pace2k_max"]	= $session->sessionSummary->pace2km_max;
				$summary_list["hr_avg"] 	= $session->sessionSummary->heart_rate_average;
				$summary_list["hr_max"] 	= $session->sessionSummary->heart_rate_max;
				$summary_list["srate_avg"] 	= $session->sessionSummary->stroke_rate_average;
				$summary_list["srate_max"] 	= $session->sessionSummary->stroke_rate_max;
				$summary_list["pwr_avg"] 	= $session->sessionSummary->power_average;
				$summary_list["pwr_max"] 	= $session->sessionSummary->power_max;
				$summary_list["pwr_l_avg"] 	= $session->sessionSummary->power_left_average;
				$summary_list["pwr_l_max"] 	= $session->sessionSummary->power_left_max;
				$summary_list["pwr_r_avg"] 	= $session->sessionSummary->power_right_average;
				$summary_list["pwr_r_max"] 	= $session->sessionSummary->power_right_max;
				$summary_list["pwr_bal_avg"]= $session->sessionSummary->power_balance;
				$summary_list["pwr_bal_max"]= $session->sessionSummary->power_balance_max;
				$summary_list["ang_l_avg"] 	= $session->sessionSummary->angle_left_average;
				$summary_list["ang_l_max"] 	= $session->sessionSummary->angle_left_max;
				$summary_list["ang_r_avg"] 	= $session->sessionSummary->angle_right_average;
				$summary_list["ang_r_max"] 	= $session->sessionSummary->angle_right_max;
				$summary_list["ang_avg"] 	= $session->sessionSummary->angle_average;
				$summary_list["ang_max"] 	= $session->sessionSummary->angle_max;
				$summary_list["mml2"] 		= $session->sessionSummary->mml_2_level;
				$summary_list["mml4"] 		= $session->sessionSummary->mml_4_level;
				$tmp["summary"] 			= $summary_list;
			
				array_push($arraySessions, $tmp);
			}

	        $response = [
	          'account' => Input::get("account"),
	          'sessions'  => $arraySessions,
	        ];
	 	}
	 	catch (Exception $e)
	    {
	    	$statusCode = 400;
        }

		return Response::json($response, $statusCode);

	}

}

