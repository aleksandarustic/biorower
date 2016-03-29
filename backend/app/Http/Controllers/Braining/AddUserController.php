<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\User;
use App\Profile;
use Exception;
use Input;
use DB;
use App\Library\GlobalFunctions;

class AddUserController extends Controller {

	//$value = Request::header('Content-Type');
	//$key = Request::header('X-API-KEY');

	/*
    public function __construct()
    {
		$this->beforeFilter('csrf', array('except' => 'store'));
    }
    */

	public function store()
	{

		try{
	        $statusCode = 201;
	        $response = [
	          'authenticationToken'  => ''
	        ];

			$user = User::where('email', Input::get("emailAddress"))->get();

			if (!$user->isEmpty()){
				$statusCode = 409;
			}
			else{
				DB::beginTransaction();

				try
				{				
					$profile = new Profile();
					$profile->save();

			 		$user = new User();
			 		$user->profile_id = $profile->id;
			 		$user->email = Input::get("emailAddress");
			 		$user->password = bcrypt(Input::get("password"));

			 		$token = bin2hex(openssl_random_pseudo_bytes(16));
					$user->auth_token = $token;

					$arrayEmail = explode("@", Input::get("emailAddress"));
					$allUsers = User::where('linkname', 'LIKE',  $arrayEmail[0] . '%')->get();
					$user->linkname = GlobalFunctions::getNewFreeLinkName($allUsers, $arrayEmail[0]);

					$user->display_name = $arrayEmail[0];

			 		$user->save();

			        $response = [
			          'authenticationToken'  => $user->auth_token
			        ];
				
					DB::commit();
				}
				catch (Exception $e){
					DB::rollBack();
				}
			}
	 	}
	 	catch (Exception $e)
	    {
	       	$statusCode = 400;
        }

		return Response::json($response, $statusCode);	
		

		/*
        $statusCode = 200;

        $response = [
          'authenticationToken'  => 'nesto sa POST uspelo'
        ];

		return Response::json($response, $statusCode);        
		*/
	}

}
