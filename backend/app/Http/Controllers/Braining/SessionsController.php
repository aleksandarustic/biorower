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
use App\Http\Controllers\NotificationsController;
use Auth;
use Exception;
use App\User;
use Input;
use App\Parameter;
use DB;
use App\DataBiorowerSession;
use App\Timeline;

class SessionsController extends Controller {

	//http://laravel.com/docs/5.0/controllers
	// sa only resource setujemo
	// users, auths, sessions, status, reset, firmware

	public function store()
	{
		
        $statusCode = 200;

        DB::beginTransaction();

		try
		{
	         $response = [
	          'sessionId'  => '',
	          'packetsReceived'  => '',
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
					$statusCode = 408;
				}
			}

			if ($statusCode != 403)
			{

				$brOfSessions = 0;

				$arrayIds = array();
				//$allParameters = Parameter->get();

				foreach (Input::get("sessions") as $valInput) {
					$session = new Session();
					$session->user_id = $userFirst->id;
					$session->name = $valInput["name"];
					$session->description = $valInput["description"];
					$session->data = json_encode($valInput["splits"]);
					$session->dataVersion = $valInput["dataVersion"];
					$session->deviceType = $valInput["deviceType"];
					$session->serialNumber = $valInput["serialNumber"];
					$session->firmwareVersion = $valInput["firmwareVersion"];
					if (config('app.website') == 1)
					{
						$session->UA_type			= $valInput["userAgent"]["type"];
						$session->UA_name			= $valInput["userAgent"]["name"];
						$session->UA_serialNumber	= $valInput["userAgent"]["serialNumber"];
						$session->UA_application	= $valInput["userAgent"]["application"];
						$session->UA_appVersion		= $valInput["userAgent"]["appVersion"];		
					}
					else{
						//$session->mobileUserAgent = $valInput["mobileUserAgent"];
						$session->sampleRate = $valInput["sampleRate"];
						$session->fftRange = $valInput["fftRange"];
						$session->duration = $valInput["duration"];						
					}

					$session->utc = $valInput["UTC"];
					$session->date = $valInput["date"];
					$session->website_id = config('app.website');

					// in case that it is a biorower 
					if (config('app.website') == 1)
					{
							$sessionData = new DataBiorowerSession();
							$sessionData->stroke_count 				= $valInput["summary"]["scnt"];
							$sessionData->time 						= $valInput["summary"]["time"];
							$sessionData->distance 					= $valInput["summary"]["dist"];
							$sessionData->calories					= $valInput["summary"]["cal"];
							$sessionData->stroke_distance_average 	= $valInput["summary"]["sdist_avg"];
							$sessionData->stroke_distance_max 		= $valInput["summary"]["sdist_max"];
							$sessionData->speed_average 			= $valInput["summary"]["spd_avg"];
							$sessionData->speed_max 				= $valInput["summary"]["spd_max"];
							$sessionData->pace_average 				= $valInput["summary"]["pace500_avg"];
							$sessionData->pace_max 					= $valInput["summary"]["pace500_max"];
							$sessionData->pace2km_average 			= $valInput["summary"]["pace2k_avg"];
							$sessionData->pace2km_max 				= $valInput["summary"]["pace2k_max"];
							$sessionData->power_average 			= $valInput["summary"]["pwr_avg"];
							$sessionData->power_max 				= $valInput["summary"]["pwr_max"];
							$sessionData->power_left_average 		= $valInput["summary"]["pwr_l_avg"];
							$sessionData->power_left_max 			= $valInput["summary"]["pwr_l_max"];
							$sessionData->power_right_average 		= $valInput["summary"]["pwr_r_avg"];
							$sessionData->power_right_max 			= $valInput["summary"]["pwr_r_max"];
							$sessionData->power_balance 			= $valInput["summary"]["pwr_bal_avg"];
							$sessionData->power_balance_max			= $valInput["summary"]['pwr_bal_max'];
							$sessionData->stroke_rate_average 		= $valInput["summary"]["srate_avg"];
							$sessionData->stroke_rate_max 			= $valInput["summary"]["srate_max"];
							$sessionData->heart_rate_average 		= $valInput["summary"]["hr_avg"];
							$sessionData->heart_rate_max 			= $valInput["summary"]["hr_max"];
							$sessionData->angle_average 			= $valInput["summary"]["ang_avg"];
							$sessionData->angle_max 				= $valInput["summary"]["ang_max"];
							$sessionData->angle_left_average 		= $valInput["summary"]["ang_l_avg"];
							$sessionData->angle_left_max 			= $valInput["summary"]["ang_l_max"];
							$sessionData->angle_right_average 		= $valInput["summary"]["ang_r_avg"];
							$sessionData->angle_right_max 			= $valInput["summary"]["ang_r_max"];
							$sessionData->mml_2_level 				= $valInput["summary"]["mml2"];
							$sessionData->mml_4_level 				= $valInput["summary"]["mml4"];
							

						$sessionData->save();

						$session->data_biorower_sessions_id = $sessionData->id;					
					}

					$session->save();
					$tl 			= new Timeline();
					$tl->object_id 	= $session->id;
					$tl->user_id 	= $userFirst->id;
					$tl->type 		= 1;
					$tl->image 		= 2;
					$tl->status 	= 1;
					$tl->save();
					$addNotif  = NotificationsController::addNotifications(2, $session->id, $userFirst->id); 
					$brOfSessions++;

					DB::commit();

					array_push($arrayIds, $session->id);
					
				}

				/*
				$allWatched = Watching::where('user2_id', $userFirst->id)
									  ->where('user1.profile.notify_me_on_new_session', 1)
									  ->with('user1','user1.profile','user1.profile.image')->get();

				$hashids = new Hashids(GlobalFunctions::getEncKey());
				$encodedID = $hashids->encode($session->id);
				$linkAdd = Request::root()."/".$userFirst->linkname."/session/".$encodedID;

				if (count($allWatched) > 0){
					Mail::send('emails.new_session', ['user_session' => $userFirst->display_name, 'linkAdd' => $linkAdd], function($message)
					{
						$br = 0;
						$email = '';
						$bccArray = array();
					    foreach ($allWatched as $userWatched) {
					    	if (strpos($userWatched->user1->email, '@btemp.com') == false){
						    	if ($br == 0){
						    		$email = $userWatched->user1->email;
						        	$br = 1;
						        }
						        else{
						        	array_push($bccArray, $userWatched->user1->email);
						        }
					        }
					    }

						if (!empty($bccArray)){
					    	$message->to($email)->bcc($bccArray)->subject('New session of user who you are following');
					    }
					    else{
					    	$message->to($email)->subject('New session of user who you are following');
					    }
					});
				}
				*/
				
		        $response = [
		          'sessionIds'  => $arrayIds,
		          'packetsReceived'  => $brOfSessions, //koliko vec
		        ];

	        }
	        

	 	}
	 	catch (Exception $e)
	 	{
	    	DB::rollBack();
	    	if ($statusCode != 403){
	    		$statusCode = 402;
	    	}
        }
        

		return Response::json($response, $statusCode);

	}

}

