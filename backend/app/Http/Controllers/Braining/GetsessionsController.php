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

			$sessions = Session::whereIn('id', $arrayIds)->with("sessionSummary")
								 ->get();

			$arraySessions = array();
			foreach ($sessions as $session) {
				$tmp = array();
				//za biorower

				$tmp["dataVersion"] = $session["dataVersion"];
				$tmp["deviceType"] = $session["deviceType"];
				$tmp["serialNumber"] = $session["serialNumber"];
				$tmp["firmwareVersion"] = $session["firmwareVersion"];
				$tmp["userAgent"] = $session["mobileUserAgent"];
				$tmp["account"] = Input::get("account");
				$tmp["UTC"] = $session["utc"];
				$tmp["date"] = $session["date"];
				/* 
				//ovo je za beeger
				$tmp["sampleRate"] = $session["sampleRate"];
				$tmp["fftRange"] = $session["fftRange"];
				$tmp["duration"] = $session["duration"];
				*/
				$tmp["splits"] = json_decode($session["data"]);
				$tmp["summary"] = $session->sessionSummary;

				/*
				"dataVersion":1,
				"deviceType":"Biorower V1",
				"serialNumber":"6856",
				"firmwareVersion":0,
				"userAgent":
					{
						"type":"onboard",
						"name":"asus; WW_K013; K013",
						"serialNumber":"6856",
						"application":"Biorower Client",
						"appVersion":1
					},
				"account":"biorower:gaboroki@gmail.com",
				"UTC":1442233708361,
				"date":"2015-09-14T14:28:28.361+0200",
				"summary":{
					"scnt":300.0,
					"time":300.0,
					"spd_avg":300.0,
					"spd_max":300.0,
					"distance":300.0,
					"sdist_max":300,
					"pace_avg":300.0,
					"pace_max":300.0,
					"pwr_avg":300.0,
					"pwr_avg_l":300.0,
					"pwr_avg_r":300.0,
					"pwr_max":300.0,
					"pwr_max_l":300.0,
					"pwr_max_r":300.0,
					"pwr_bal":49.0,
					"srate_avg":300.0,
					"srate_max":300.0,
					"ang_avg":300.0,
					"ang_avg_l":300.0,
					"ang_avg_r":300.0,
					"ang_max":300.0,
					"ang_max_l":300.0,
					"ang_max_r":300.0,
					"hr_avg":300.0,
					"hr_max":300.0,
					"mml2":300.0,
					"mml4":300.0,
					"temperature":0,
					"altitude":0,
					"boatPosition":1,
					"weight":90,
					"maxHeartRate":100,
					"maxMinutePower":0
				},
				*/
			
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

