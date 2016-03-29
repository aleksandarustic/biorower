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

class SessionsController extends Controller {

	//http://laravel.com/docs/5.0/controllers
	// sa only resource setujemo
	// users, auths, sessions, status, reset, firmware

	public function store()
	{

       
		//try{

	        $statusCode = 200;
	        $response = [
	          'sessionId'  => '',
	          'packetsReceived'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

			$user = User::where('email', $email[1])->get();

			if ($user->isEmpty()){
			    throw new Exception;
			}

			$userFirst = $user->first();

			$session = new Session();
			$session->user_id = $userFirst->id;
			$session->data = Input::get("serialNumber");
			$session->date = new Carbon\Carbon();

			$session->save();

			/*
			$allWatched = Watching::where('user2_id', Auth::user()->id)
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
				    	if ($br == 0){
				    		$email = $userWatched->user1->email;
				        	$br = 1;
				        }
				        else{
				        	array_push($bccArray, $userWatched->user1->email);
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
	          'sessionId'  => $userFirst->auth_token,
	          'packetsReceived'  => '', //koliko vec
	        ];
	 	
	    /*
	 	}
	 	catch (Exception $e)
	    {
	    	$statusCode = 400;
        }
        */

		return Response::json($response, $statusCode);

	}

}

