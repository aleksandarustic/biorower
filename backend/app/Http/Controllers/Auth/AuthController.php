<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\RegisterUserPostRequest;

use Illuminate\Http\Request;

use App\User;
use App\Profile;
use Input;
use DB;
use Socialize;
use Auth;
use App\Library\GlobalFunctions;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/'.Auth::user()->linkname;
	}	


//	public function postLogin(Request $request)
//	{
//		$data = [
//			'email' => $request->input('email'),
//			'password' => $request->input('password')
//		];
//
//		return $data; exit;
//
//		$this->validate($request, [
//			'email' => 'required|email', 'password' => 'required',
//		]);
//
//		$credentials = $request->only('email', 'password');
//
//		if ($this->auth->attempt($credentials, $request->has('remember')))
//		{
//			return redirect()->intended($this->redirectPath());
//		}
//
//		$loginPath = '/'.Auth::user()->linkname;
//
//		return redirect($loginPath)
//					->withInput($request->only('email', 'remember'))
//					->withErrors([
//						'email' => $this->getFailedLoginMessage(),
//					]);
//	}


	public function postRegister(RegisterUserPostRequest $request)
	{
		/*
		$this->auth->login($this->registrar->create($request->all()));

		return redirect($this->redirectPath());
		*/

		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			return $validator->messages();

			$this->throwValidationException(
				$request, $validator
			);
		}

		DB::beginTransaction();

		try
		{			

			$profile = new Profile(); 
			$profile->save();

			$user = new User();
			$user->profile_id = $profile->id;
			$user->email = Input::get("email");
			$user->password = bcrypt(Input::get("password"));

			$arrayEmail = explode("@", Input::get("email"));
			$allUsers = User::where('linkname', 'LIKE',  $arrayEmail[0] . '%')->get();
			$user->linkname = GlobalFunctions::getNewFreeLinkName($allUsers, $arrayEmail[0]);

			$user->display_name = $arrayEmail[0];
			$user->save();

			DB::commit();

		}
		catch (Exception $e){

			DB::rollBack();

			$error = "There is a problem with database connection. Please, try again or report the error to the administrators.";
			return redirect('auth/register')->with('flash_message', $error);
		}

		//$user = $this->registrar->create($request->all());

		$this->auth->login($user);

		return redirect($this->redirectPath());
	}

	public function getLoginFacebook()
	{
		return Socialize::with('facebook')->redirect();
	}

	public function getHandleProviderCallbackFacebook()
	{
          
        $user = Socialize::with('facebook')->user();
	    
	    $facebook_id = $user->getId();
	    $name = $user->getName();
  
		$userExist = User::where('email', $email)->get();

		if ($userExist->isEmpty()){

			DB::beginTransaction();

			try
			{			
				$profile = new Profile(); 
				$profile->save();

				$user = new User();
				$user->profile_id = $profile->id;
				$user->created_at = time();
				$user->updated_at = time();

				$spitName = explode(" ", $name);
				if (count($spitName) >= 2){
					$user->first_name = $spitName[0];
					$user->last_name = $spitName[1];
				}
				else{
					$user->first_name = $spitName[0];
					$user->last_name = $spitName[0];
				}

				$user->facebook_id = $facebook_id;

				$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 7);
				$user->email = "e.".$randomString.time()."@btemp.com";

				$arrayEmail = explode("@", $user->email);
				$allUsers = User::where('linkname', 'LIKE',  $arrayEmail[0] . '%')->get();				
				$user->linkname = GlobalFunctions::getNewFreeLinkName($allUsers, $arrayEmail[0]);

				$user->display_name = $arrayEmail[0];

				$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 9);
				$user->password = bcrypt($randomString);

				$user->save();

				DB::commit();

				Auth::loginUsingId($user->id);
				return redirect('/');

			}
			catch (Exception $e){
				DB::rollBack();

				//doraditi
				$error = "There is a problem with database connection. Please, try again or report the error to the administrators.";
				return redirect('auth/login')->with('flash_message', $error);
			}			

		}
		else{
			Auth::loginUsingId($userExist->first()->id);
			return redirect('/template/overview');
		}
	}

	public function getLoginTwitter()
	{
		return Socialize::with('twitter')->redirect();
	}

	public function getHandleProviderCallbackTwitter()
	{

	    $user = Socialize::with('twitter')->user();

	    $twitter_id = $user->getId();
	    $name = $user->getName();
	    
		$userExist = User::where('twitter_id', $twitter_id)->get();

		if ($userExist->isEmpty()){

			DB::beginTransaction();

			try
			{			
				$profile = new Profile(); 
				$profile->save();

				$user = new User();
				$user->profile_id = $profile->id;

				$spitName = explode(" ", $name);
				if (count($spitName) >= 2){
					$user->first_name = $spitName[0];
					$user->last_name = $spitName[1];
				}
				else{
					$user->first_name = $spitName[0];
					$user->last_name = $spitName[0];
				}

				$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 7);
				$user->email = "e.".$randomString.time()."@btemp.com";

				$user->created_at = time();
				$user->updated_at = time();

				$user->twitter_id = $twitter_id;

				$arrayEmail = explode("@", $user->email);
				$allUsers = User::where('linkname', 'LIKE',  $arrayEmail[0] . '%')->get();				
				$user->linkname = GlobalFunctions::getNewFreeLinkName($allUsers, $arrayEmail[0]);				

				$user->display_name = $arrayEmail[0];

				$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 9);
				$user->password = bcrypt($randomString);				

				$user->save();
				//$user->password = bcrypt(Input::get("password"));

				DB::commit();

				Auth::loginUsingId($user->id);
				return redirect('/template/overview');

			}
			catch (Exception $e){
				DB::rollBack();

				//doraditi
				$error = "There is a problem with database connection. Please, try again or report the error to the administrators.";
				return redirect('auth/login')->with('flash_message', $error);
			}			

		}
		else{
			Auth::loginUsingId($userExist->first()->id);
			return redirect('/template/overview');
		}
		
	}

}

