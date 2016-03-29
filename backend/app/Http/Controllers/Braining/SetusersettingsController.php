<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Library\GlobalFunctions;
use Auth;
use Exception;
use App\User;
use App\UserSettings;
use Input;
use DB;

class SetusersettingsController extends Controller {

	public function store()
	{

		try{

			DB::beginTransaction();

	        $statusCode = 200;
	        $response = [
	          'results'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

	        if ($email[0] == "twitter"){
	        	$user = User::where('twitter_id', $email[1])->with('usersettings')->get();
	        }
	        else if ($email[0] == "facebook"){
	        	$user = User::where('facebook_id', $email[1])->with('usersettings')->get();
			}	        
	        else{
				$user = User::where('email', $email[1])->with('usersettings')->get();
			}

			if ($user->isEmpty()){
			    throw new Exception;
			}

			$userFirst = $user->first();

			$userFirstSettings = $userFirst->usersettings;

			$settingsJson = Input::get("settings");

			if ($userFirstSettings == null){
				$userFirstSettings = new UserSettings();
			}

			$userFirstSettings->setting1 = $settingsJson;
			/*
			$userFirstSettings->setting2 = $settingsJson["setting2"];
			$userFirstSettings->setting3 = $settingsJson["setting3"];
			*/

			$userFirstSettings->save();

			$userFirst->user_settings_id = $userFirstSettings->id;
			$userFirst->save();

			DB::commit();

	        $response = [
				'results'  => 'ok',
	        ];
	 	}
	 	catch (Exception $e)
	    {
	    	DB::rollBack();
	    	$statusCode = 400;
        }

		return Response::json($response, $statusCode);

	}

}

