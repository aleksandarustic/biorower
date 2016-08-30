<?php namespace App\Http\Controllers\Braining;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Exception;
use Illuminate\Support\Facades\Response;

use App\User;
use Input;

use Hashids\Hashids;
use Mail;
use App\Library\GlobalFunctions;


class ResetController extends Controller {

	public function store()
	{

		//try{
	        $statusCode = 200;
	        $response = [
	          'Error Code'  => ''
	        ];

			$userGet = User::where('email', Input::get("emailAddress"))->get();

			if ($userGet->isEmpty()){
	        	$statusCode = 403;
			}
			else{
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
				array_push($recipient, $user->first_name);
				array_push($recipient, $user->last_name);				

				//$linkAdd = Request::root()."/password/reset-password?id_and=".$encodedID."&email=".$encodedEmail."&exp=".$encodedTime;

				if (strpos($user->email, "@btemp.com") === false){
					Mail::send('emails.password', ['user' => $user], function ($m) use ($user) {
					$m->from('admin@biorower', 'Biorower');
					$m->to($user->email, $user->first_name)->subject('Biorower Password Reset');
					});
				}
			}

	        $response = [
	          'message'  => 'OK'
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
