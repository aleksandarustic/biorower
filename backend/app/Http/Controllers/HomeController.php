<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

use Hashids\Hashids;
use Mail;
use App\Library\GlobalFunctions;
use App\User;
use DB;
use Carbon;

use App\Session;

class HomeController extends Controller {

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
		$this->middleware('auth', ['except' => ['getApiDocs', 'getTest']]); //['except' => ['apiDocs', 'dataVersion', 'changeLog']]

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('home');
	}

	public function getTest()
	{

		/*
		$user = GlobalFunctions::addUserViaSocialConn("dasdads", "twitter", "123314234");
		dd($user);
		*/

		/*
		$key = '#&$sdfdfs789fs7d';
		$myVarIWantToEncodeAndDecode = "bojan";

		$prvi = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $myVarIWantToEncodeAndDecode, MCRYPT_MODE_CBC, md5(md5($key)))));

		$drugiizm = urldecode($prvi);

		$drugi = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($drugiizm), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

		return $prvi." ".$drugi;
		*/

		//http://localhost:8080/!powerhub%20template/blog/public/password/reset-password?id_and=2VWy&email=i3OuAnPRJ%2BH19ILzIXwwQmWAJh8X7QHqDEWkv9nRPos%3D&exp=RpH8%2FYx%2BheEbOfROKnagUJ4iaCiibO97SYFIWH93mZo%3D
		
		/*
		$email = "i3OuAnPRJ+H19ILzIXwwQmWAJh8X7QHqDEWkv9nRPos=";

		$keyEncKeyForResetPasswordEmail = GlobalFunctions::getEncKeyForResetPasswordEmail();
		$decodedEmail = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($keyEncKeyForResetPasswordEmail), base64_decode($email), MCRYPT_MODE_CBC, md5(md5($keyEncKeyForResetPasswordEmail))), "\0");

		return $decodedEmail;
		*/

		
		/*
		$userGet = User::where('email', "bojanproba81@gmail.com")->get();
		$user = $userGet->first();

		$hashids = new Hashids(GlobalFunctions::getEncKeyForResetPasswordID());
		$tmp = $user->id;
		$encodedID = $hashids->encode($tmp+3000);

		$keyEncKeyForResetPasswordEmail = GlobalFunctions::getEncKeyForResetPasswordEmail();
		$encodedEmail = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($keyEncKeyForResetPasswordEmail), $user->email, MCRYPT_MODE_CBC, md5(md5($keyEncKeyForResetPasswordEmail)))));

		$expTime = time() + (1 * 24 * 60 * 60);

		$keyEncKeyForResetPasswordTime = GlobalFunctions::getEncKeyForResetPasswordTime();
		$encodedTime = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($keyEncKeyForResetPasswordTime), $expTime, MCRYPT_MODE_CBC, md5(md5($keyEncKeyForResetPasswordTime)))));

		$recipient = array();
		array_push($recipient, $user->email);

		$linkAdd = Request::root()."/password/reset-password?id_and=".$encodedID."&email=".$encodedEmail."&exp=".$encodedTime;

		if (strpos($user->email, "@btemp.com") === false){
			Mail::send('emails.password_andr', ['url' => $linkAdd], function($message) use ($recipient)
			{
			    $message->to($recipient[0])->subject('Your Password Reset Link');
			});
		}
		*/


		/*
		$varParameter = $req["parameter"];
		$queryCalculate = GlobalFunctions::GetRequestedParameterQuery($varParameter);
		*/

		/*
		$date = Carbon\Carbon::now();
		$date->addMonth();
		$date->day = 0;
		return $date->toDateString();
		*/


		/*		
				$results = DB::select(DB::raw(
					"SELECT 
							COUNT(*) as training_sessions,
							SUM(stroke_count) as stroke_count,
							SUM(time) as time,
							SUM(distance) as distance,
							(SUM(time*stroke_distance_average)/SUM(time)) as stroke_distance_average,
							MAX(stroke_distance_max) as stroke_distance_max,
							(SUM(time*speed_average)/SUM(time)) as speed_average,
							MAX(speed_max) as speed_max,
							(SUM(time*pace_average)/SUM(time)) as pace_average,
							MAX(pace_max) as pace_max,
							(SUM(time*heart_rate_average)/SUM(time)) as heart_rate_average,
							MAX(heart_rate_max) as heart_rate_max,
							(SUM(time*stroke_rate_average)/SUM(time)) as stroke_rate_average,
							MAX(stroke_rate_max) as stroke_rate_max,
							(SUM(time*power_average)/SUM(time)) as power_average,
							MAX(power_max) as power_max,
							(SUM(time*power_left_average)/SUM(time)) as power_left_average,
							MAX(power_left_max) as power_left_max,
							(SUM(time*power_right_average)/SUM(time)) as power_right_average,
							MAX(power_right_max) as power_right_max,
							(SUM(stroke_count*power_balance)/SUM(stroke_count)) as power_balance,
							(SUM(stroke_count*angle_average)/SUM(stroke_count)) as angle_average,
							MAX(angle_max) as angle_max,
							(SUM(stroke_count*angle_left_average)/SUM(stroke_count)) as angle_left_average,
							MAX(angle_left_max) as angle_left_max,
							(SUM(stroke_count*angle_right_average)/SUM(stroke_count)) as angle_right_average,
							MAX(angle_right_max) as angle_right_max,
							(SUM(time*mml_2_level)/SUM(time)) as mml_2_level,
							(SUM(time*mml_4_level)/SUM(time)) as mml_4_level
					 FROM data_biorower_sessions
					 	  INNER JOIN sessions
					 	  ON data_biorower_sessions.id = sessions.data_biorower_sessions_id
					 WHERE sessions.user_id = 2")); 
		*/


	
		/*

		$groupType = "month";
		$rangeType = "year";

		$dateStart = Carbon\Carbon::createFromDate(2015, 7, 25);

		$results = GlobalFunctions::GetHistoryStatistics($groupType, $rangeType, $dateStart, 2);

		return $results;
	
		$dateStart = Carbon\Carbon::createFromDate(2015, 7, 25);
		$dateEnd = clone $dateStart;

		$firstDay = $dateStart;
		$lastDay = $dateEnd->addDays(7);

		//return $firstDay." ".$lastDay;

		$results = DB::select(DB::raw(
			"SELECT
					WEEKDAY(date) as position,
					date,
					COUNT(*) as training_sessions,
					stroke_count,
					time,
					distance,
					stroke_distance_average,
					stroke_distance_max,
					speed_average,
					speed_max,
					pace_average,
					pace_max,
					heart_rate_average,
					heart_rate_max,
					stroke_rate_average,
					stroke_rate_max,
					power_average,
					power_max,
					power_left_average,
					power_left_max,
					power_right_average,
					power_right_max,
					power_balance,
					angle_average,
					angle_max,
					angle_left_average,
					angle_left_max,
					angle_right_average,
					angle_right_max,
					mml_2_level,
					mml_4_level
			 FROM data_biorower_sessions
			 	  INNER JOIN sessions
			 	  ON data_biorower_sessions.id = sessions.data_biorower_sessions_id
			 WHERE sessions.user_id = 2
			 AND date>='".$firstDay."' AND date<='".$lastDay."'"
			 ));

        $response = [
          'account' => "nesto",
          'totaldata'  => $results,
        ];

        $statusCode = 200;
		
		return Response::json($response, $statusCode);



		//Za zadat mesec po danima 
		//Za zadatu nedelju po danima 
		//Za zadatu godinu po danima
		$results = DB::select(DB::raw(
			"SELECT ".$varParameter." as result FROM session_data_biorower
			 WHERE  MONTH(date) = 8
			 GROUP BY date
		    ")); //WEEK(date) = 32, YEAR(date) = 2015

		return $results;

		//Za zadatu godinu prikaz statistike po mesecima
		//Za zadatu godinu po nedeljama 
		$results = DB::select(DB::raw(
			"SELECT (SUM(time*power_average)/SUM(time)) as result FROM session_data_biorower
			 WHERE  YEAR(date) = 2015
			 GROUP BY MONTH(date)
		    ")); //GROUP BY WEEK(date)

		return $results;

		//Za zadat interval za mesece
		//Za zadat interval za nedelje
		$results = DB::select(DB::raw(
			"SELECT (SUM(time*power_average)/SUM(time)) as result FROM session_data_biorower
			 WHERE  date >= @interval1
			 AND  date <= @interval2
			 GROUP BY MONTH(date)
		    ")); //GROUP BY WEEK(date)

		return $results;

		*/

		/*
		$user = User::where('email', "bojanproba81@gmail.com")->with('usersettings')->get();

		return $user->first()->usersettings;
		*/



		/*

			$arrayIds = array();
			array_push($arrayIds, 90);


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
				$tmp["account"] = $session["account"];
				$tmp["UTC"] = $session["utc"];
				$tmp["date"] = $session["date"];
				$tmp["splits"] = json_decode($session["data"]);
				$tmp["summary"] = $session->sessionSummary;
		
				array_push($arraySessions, $tmp);
			}

		return $arraySessions;
		*/

		/*
		$user = User::where('email', "gaboroki2@gmail.com")
					->with('usersettings')
					->leftJoin('user_settings', 'user_settings_id', '=', 'user_settings.id')
					->get();

		return $user;

		$userFirstSettings = $user->first()->usersettings;
		*/

		/*
		if ($userFirstSettings == null){
			$userFirstSettings = new UserSettings();
		}
		*/

		
		$firstDay = new Carbon\Carbon("2015-09-24T15:46:49.329+0200");

		return $firstDay;


		//http://localhost:8080/!powerhub%20template/blog/public/password/reset/http://localhost:8080/!powerhub%20template/blog/public/password/reset-password?id_and=2VWy&email=i3OuAnPRJ%2BH19ILzIXwwQmWAJh8X7QHqDEWkv9nRPos%3D&exp=XrC9mwFEvSoWZvhky4fEoVUIwCUTVqn%2Fmu5r36kfpfw%3D
	}


	public function getApiDocs()
	{
	    /*
	    if (in_array($_SERVER['HTTP_USER_AGENT'], array(
	      'facebookexternalhit/1.1 (+https://www.facebook.com/externalhit_uatext.php)',
	      'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)'
	    ))) 
	    {
			return view('/home/apiTestFB');
		}
		else{
			return view('/home/api');
		}
		*/
		return view('/home/api');
	}	

	public function getDataVersion()
	{
		return view('/home/data-version');
	}		

	public function getChangeLog()
	{
		return view('/home/change-log');
	}		

}
