<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\User;
use Exception;
use Input;
use Auth;

class UsersController extends Controller {

	//$value = Request::header('Content-Type');
	//$key = Request::header('X-API-KEY');

	public function store()
	{
		try{
			
	        $statusCode = 200;
	        $response = [
	          'authenticationToken'  => ''
	        ];

	        $email = Input::get("emailAddress");
	        $password = Input::get("password");

			if (Auth::attempt(array('email' => $email, 'password' => $password)))
			{
				$user = User::where('email', $email)->with('usersettings')->first();

				$token = bin2hex(openssl_random_pseudo_bytes(16));
				$user->auth_token = $token;
		 		$user->save();				

		        $response = [
		          'authenticationToken'  => $user->auth_token,
		          'settings'  => $user->usersettings
		        ];
			}			
			else{
				$statusCode = 403;
			}
	 	}
	 	catch (Exception $e)
	    {
	        $statusCode = 400;
        }

		return Response::json($response, $statusCode);		
	}	

	/*
	public function store()
	{
        $statusCode = 200;

        $response = [
          'authenticationToken'  => 'nesto sa POST uspelo'
        ];

		return Response::json($response, $statusCode);        
	}
	*/

}
