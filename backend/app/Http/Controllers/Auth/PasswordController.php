<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use Hashids\Hashids;
use Input;
use App\Library\GlobalFunctions;
use App\User;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}


	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getResetPassword(Request $request)
	{

		$token = "";
		$ind_and = $request["id_and"];
		$email = $request["email"];
		$exp = $request["exp"];

		return view('auth.reset', compact('token', 'ind_and', 'email', 'exp'));

	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function postReset(Request $request)
	{

		if (Input::get("ind_and") == ""){

			$this->validate($request, [
				'token' => 'required',
				'email' => 'required|email',
				'password' => 'required|confirmed',
			]);

			$credentials = $request->only(
				'email', 'password', 'password_confirmation', 'token'
			);

			$response = $this->passwords->reset($credentials, function($user, $password)
			{
				$user->password = bcrypt($password);

				$user->save();

				$this->auth->login($user);
			});

			switch ($response)
			{
				case PasswordBroker::PASSWORD_RESET:
					return redirect($this->redirectPath());

				default:
					return redirect()->back()
								->withInput($request->only('email'))
								->withErrors(['email' => trans($response)]);
			}
		}
		else{

			$ind_and = Input::get("ind_and");
			$email = Input::get("email_and");
			$exp = Input::get("exp");

			$hashids = new Hashids(GlobalFunctions::getEncKeyForResetPasswordID());
			$decodedID = $hashids->decode($ind_and);

			$id = $decodedID[0] - 3000;

			$keyEncKeyForResetPasswordEmail = GlobalFunctions::getEncKeyForResetPasswordEmail();
			$decodedEmail = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($keyEncKeyForResetPasswordEmail), base64_decode($email), MCRYPT_MODE_CBC, md5(md5($keyEncKeyForResetPasswordEmail))), "\0");

			$keyEncKeyForResetPasswordTime = GlobalFunctions::getEncKeyForResetPasswordTime();
			$decodedTime = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($keyEncKeyForResetPasswordTime), base64_decode($exp), MCRYPT_MODE_CBC, md5(md5($keyEncKeyForResetPasswordTime))), "\0");

			//return $id." ".$decodedEmail." ".$decodedTime;

			if ($decodedTime < time()){
				return redirect()->back()
								 ->withErrors(['email' => "Token expired"]);
			}
			else
			{
				$userGet = User::where('id', $id)
								->where('email', $decodedEmail)
								->get();

				if ($userGet->isEmpty()){
					return redirect()->back()
									 ->withErrors(['email' => "Error"]);
				}				
				else{
					$user = $userGet->first();
					$user->password = bcrypt(Input::get("password"));

					$user->save();
				}

				return redirect("/");

			}
		}

	}


}


