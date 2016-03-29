<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\User;
use Exception;
use Input;

class AuthsController extends Controller {

	public function store()
	{
		try{
	        $statusCode = 200;
	        $response = [
	          'authenticationToken'  => '',
	          'account'  => '',
	        ];

			$user = User::where('auth_token', Input::get("authenticationToken"))->get();

			if ($user->isEmpty()){
			    throw new Exception;
			}

	        $response = [
	          'authenticationToken'  => $user->first()->auth_token,
	          'account'  => $user->first()->email,
	        ];

	 	}
	 	catch (Exception $e)
	    {
        	$statusCode = 400;
        }

		return Response::json($response, $statusCode);
	}

}



