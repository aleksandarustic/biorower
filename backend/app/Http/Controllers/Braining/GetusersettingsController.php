<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Library\GlobalFunctions;
use Auth;
use Exception;
use App\User;
use Input;

class GetusersettingsController extends Controller {

	public function store()
	{

		try{
	        $statusCode = 200;
	        $response = [
	          	'settings'  => '',
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

			$user_settings = $user->first()->usersettings;

	        $response = [
	          'account' => Input::get("account"),
	          'settings'  => $user_settings->setting1,
	        ];
	 	}
	 	catch (Exception $e)
	    {
	    	$statusCode = 400;
        }

		return Response::json($response, $statusCode);

	}

}

