<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Hashids\Hashids;
use Illuminate\Http\Request as req;
use App\Library\GlobalFunctions;

use App\Comment;
use Input;
use Auth;
use App\Session;
use View;
use Carbon;
use Response;
use Mail;
use App\Race;

use LRedis;

class SessionController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index']]); //['except' => ['apiDocs', 'dataVersion', 'changeLog']]
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index($id, $session)
	{
			
		/*
		$sessions = Session::whereIn('id', array(14,13,12))
							 ->get();

		$arraySessions = array();
		foreach ($sessions as $session) {
			$tmp = array();
			$tmp["dataVersion"] = $session["dataVersion"];
			$tmp["deviceType"] = $session["deviceType"];
			$tmp["serialNumber"] = $session["serialNumber"];
			$tmp["firmwareVersion"] = $session["firmwareVersion"];
			$tmp["mobileUserAgent"] = $session["mobileUserAgent"];
			$tmp["account"] = Input::get("account");
			$tmp["UTC"] = $session["utc"];
			$tmp["date"] = $session["date"];
			$tmp["sampleRate"] = $session["sampleRate"];
			$tmp["fftRange"] = $session["fftRange"];
			$tmp["duration"] = $session["duration"];
			$tmp["splits"] = json_decode($session["data"]);
			
			array_push($arraySessions, $tmp);
		}								 

        $response = [
          'account' => Input::get("account"),
          'sessions'  => $arraySessions,
        ];
        */

        //return json_encode($arraySessions, JSON_NUMERIC_CHECK);
        //dd(json_encode($response));
	   
		/*
		$string = '22';
		$iv = '12345678';
		$passphrase = '8chrsLng';

		$enc = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_3DES, $passphrase, $string, MCRYPT_MODE_CBC, $iv)));
		*/

		//$enc = urlencode(base64_decode(mcrypt_decrypt(MCRYPT_BLOWFISH, $passphrase, $string, MCRYPT_MODE_CBC, $iv)));

		/*
		$key = 23423;

		$encoder = new OpaqueEncoder($key, OpaqueEncoder::ENCODING_BASE64);
		return $encoder->encode("33");
		*/

		$hashids = new Hashids(GlobalFunctions::getEncKey());
		$decodedID = $hashids->decode($session);

		$sessionUser = Session::where('id', $decodedID[0])
						   ->where('deleted', false)
						   ->with('user.profile.image')
						   ->with('sessionSummary')
						   ->with('comments', 'comments.user')->first();

		if (in_array($_SERVER['HTTP_USER_AGENT'], array( 'facebookexternalhit/1.0 (+https://www.facebook.com/externalhit_uatext.php)', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'Facebot (+http://www.facebook.com/externalhit_uatext.php)' )))
		{ 
			$og_title = config('app.title')." sportConn session title";
			$og_description = "session on: ".$sessionUser->date;

			return view('/session/index-fb-share', compact('og_title', 'og_description'));
		}

		//$summaryTotalData = json_decode($sessionUser->data);

		$summaryTotalData = $sessionUser->sessionSummary;
		//dd($summaryTotalData);

		$parameterByStrokesValues = json_decode($sessionUser->data);
		$parameterByStrokesValues = GlobalFunctions::PrepareArrayParametersStatistics($parameterByStrokesValues[0]);

		//dd($session);
		$isAdmin = false;
		if (!Auth::guest()){
			if (Auth::user()->linkname == $sessionUser->user->linkname){
				$isAdmin = true;
			}
		}
						   
		$allComments = View::make('/session/_allComments')
						->with('sessionUser', $sessionUser)
						->with('isAdmin', $isAdmin)
						->render();
		/*
		$parameterByStrokesValues = '{"valuesModules": [
						{
				            "name": "Time",
				            "id": "Time",
				            "data": [1.9, 11.5, 33.4, 11.2, 144.0, 176.0, 135.6, 148.5, 22.4, 194.1, 95.6, 54.4]
				        },
						{
				            "name": "Distance",
				            "id": "Distance",
				            "data": [200, 3.5, 4.4, 5.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Pace",
				            "id": "Pace",
				            "data": [15, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },				        
						{
				            "name": "Power",
				            "id": "Power",
				            "data": [15, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Power left",
				            "id": "Power left",
				            "data": [15, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Power right",
				            "id": "Power right",
				            "data": [15, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Power balance",
				            "id": "Power balance",
				            "data": [15, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Stroke rate",
				            "id": "Stroke rate",
				            "data": [15, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },				        
						{
				            "name": "Angle",
				            "id": "Angle",
				            "data": [39, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Angle left",
				            "id": "Angle left",
				            "data": [39, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Angle right",
				            "id": "Angle left",
				            "data": [39, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },				        
						{
				            "name": "Heart rate",
				            "id": "Heart rate",
				            "data": [39, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        }
				]
			}';
			*/

		return view('/session/index', compact('decodedID', 'id', 'allComments', 'sessionUser', 'og_title', 'og_description', 'parameterByStrokesValues', 'summaryTotalData','summaryTotalData'));
	}

	public function comment()
	{
		if (Input::get("comment") != "")
		{
			$newComment = new Comment();
			$newComment->date = date("Y-m-d H:i:s");
			$newComment->text = Input::get("comment");

			$hashidsSession = new Hashids(GlobalFunctions::getEncKey());
			$decodedIDsession = $hashidsSession->decode(Input::get("session_id"));

			$newComment->session_id = $decodedIDsession[0]; 
			$newComment->user_id = Auth::user()->id;

			$newComment->save();

			$comment = Comment::where('id', $newComment->id)->with('user', 'session.user.profile')->first();
			$comment->date = "Just now";

			//return $comment->session->user->email;

			if (strpos($comment->session->user->email, '@btemp.com') == false){
				if ($comment->session->user->profile->notify_me_on_comment == 1)
				{
					$recipient = array();
					array_push($recipient, $comment->session->user->email);
					array_push($recipient, $comment->session->user->first_name);
					array_push($recipient, $comment->session->user->last_name);

					$hashids = new Hashids(GlobalFunctions::getEncKey());
					$encodedID = $hashids->encode($comment->session->id);
					$linkAdd = Request::root()."/".$comment->session->user->linkname."/session/".$encodedID;
					
					Mail::send('emails.new_comment', ['user_comment' => $comment->user->display_name, 'linkAdd' => $linkAdd], function($message) use ($recipient)
					{
						$name = $recipient[1]." ".$recipient[2];
					    $message->to($recipient[0], $name)->subject('New comment on your session.');
					});
				}
			}

			$isAdmin = false;
			if (Auth::user()->id == $newComment->user_id){
				$isAdmin = true;
			}			

			return view("/session/_comment", compact('comment', 'isAdmin'));
		}
	}

	public function sessions()
	{
		$d = new Carbon\Carbon(); 
		$firstDay = date('Y-m-01');
		$lastDay = $d->format('Y-m-t');

		$sessions = Session::where('date', '<', $lastDay)
							->where('date', '>', $firstDay)
							->where('deleted', false)
							->where('user_id', Auth::user()->id)->get();

		$partialTable = View::make('/session/_session_table')->with('sessions', $sessions)->render();

        if (Request::ajax()) {
            return Response::json($partialTable);
        }	
        else{
        	return view('/session/sessions', compact('partialTable'));
        }
	}

	public function sessionsRangeSearch($id, $date1, $date2)
	{
		$firstDay = new Carbon\Carbon($date1);
		$lastDay = new Carbon\Carbon($date2);


		//$new_releases = Game::whereBetween('release', array($start, $end))->get();
		//$sessions = Session::whereBetween('date', array($firstDay, $lastDay))->where('user_id', Auth::user()->id)->get();
		//$sessions = Session::where('date', $lastDay)->get();

		if ($firstDay == $lastDay){
			$lastDay = $lastDay->addDay();
		}

		$sessions = Session::where('date', '<=', $lastDay)
							->where('date', '>=', $firstDay)
							->where('deleted', false)
							->where('user_id', Auth::user()->id)->get();

		$partialTable = View::make('/session/_session_table')->with('sessions', $sessions)->render();

        if (Request::ajax()) {
            return Response::json($partialTable);
        }
        else{
        	return view('/session/sessions', compact('partialTable'));
        }
	}

	public function client1()
	{
		return view('/session/client1'); //compact('')
	}

	public function client2()
	{
		return view('/session/client2'); //compact('')
	}	

	public function deleteComment(req $request)
	{
		
		$hashidsComment = new Hashids(GlobalFunctions::getEncKeyForComment());
		$encodedIDComment = $hashidsComment->decode($request["id_comment"]);

		$hashidsSession = new Hashids(GlobalFunctions::getEncKey());
		$decodedIDsession = $hashidsSession->decode($request["id_session"]);

		$session = Session::where('id', $decodedIDsession[0])
							->where('user_id', Auth::user()->id)
						    ->get();

		if (!$session->isEmpty()){
			$comment = Comment::where('id', $encodedIDComment[0])->first();
	 		$comment->delete();

	 		return "ok";
		}
		else{
			return "error";
		}

	}

	public function calendar()
	{
		return view('/session/calendar');
	}

	public function deleteSession(req $request)
	{
		$session = Session::where('id', $request["id_session"])
							->where('user_id', Auth::user()->id)
						    ->first();

		if ($session != null){
			$session->deleted = true;
			$session->save();
		}

		return redirect('/'.Auth::user()->linkname);
	}		
	
	/*
	public function ajaxData1()
	{
		
		// Set the JSON header
		header("Content-type: text/json");

		// The x value is the current JavaScript time, which is the Unix time multiplied 
		// by 1000.
		$x = time() * 1000;
		// The y value is a random number
		$y = rand(0, 100);

		// Create a PHP array and echo it as JSON
		$ret = array($x, $y);

		$redis = LRedis::connection();
		$arrayJson = array();

		$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
		$encodedUserID = $hashids->encode(Auth::id);

		array_push($arrayJson, array('"user"' => $encodedUserID) + array('"data"' => $ret));
		//array_push($arrayJson, $ret);
		$redis->publish('message1', json_encode($arrayJson));
		//echo json_encode($ret);
		
	}

	public function ajaxData2()
	{
		
		// Set the JSON header
		header("Content-type: text/json");

		// The x value is the current JavaScript time, which is the Unix time multiplied 
		// by 1000.
		$x = time() * 1000;
		// The y value is a random number
		$y = rand(0, 100);

		// Create a PHP array and echo it as JSON
		$ret = array($x, $y);

		$redis = LRedis::connection();
		$arrayJson = array();
		array_push($arrayJson, array('"user"' => 'user2') + array('"data"' => $ret));
		//array_push($arrayJson, $ret);
		$redis->publish('message1', json_encode($arrayJson));
		//echo json_encode($ret);
		
	}
	*/

	/*
	public function ajaxData2()
	{
		// Set the JSON header
		header("Content-type: text/json");

		// The x value is the current JavaScript time, which is the Unix time multiplied 
		// by 1000.
		$x = time() * 1000;
		// The y value is a random number
		$y = rand(0, 100);

		// Create a PHP array and echo it as JSON
		$ret = array($x, $y);

		$redis = LRedis::connection();
		$redis->publish('message2', json_encode($ret));
		echo json_encode($ret);
	}
	*/

}

