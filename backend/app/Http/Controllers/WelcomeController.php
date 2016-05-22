<?php namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		if(Auth::check())
		{
			return redirect('/profile');
		}

		return view('auth.login');
	}

	public function postLogin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email'      => 'required|email:unique',
			'password'   => 'required|min:6',
		]);

		if($validator->fails())
		{
			return back()
				->withErrors($validator->errors())
				->withInput();
		}
		else
		{
			if(Auth::attempt([
				'email'    => $request->input('email'),
				'password' => $request->input('password'),
			]))
			{
				if(Auth::user()->activated == 1)
				{
					return redirect('/profile');
				}
				else
				{
					Auth::logout();
					return redirect('/')->with('status', 'You profile is not activated yet. Come back soon.');
				}
			}
			else
			{
				return redirect()
					->back()
					->with('status', 'Incorrect email or password');
			}
		}
	}

	public function getRegister()
	{
		return view('auth.register');
	}

	public function postRegister(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|unique:users|email',
			'password'   => 'required|min:6|confirmed',
			'password_confirmation'   => 'required|min:6',
		]);

		if($validator->fails())
		{
			return back()
				->withErrors($validator->errors())
				->withInput();
		}else{

			$user = new User();
			$profile = new Profile();
			$profile->save();

			$user->first_name = $request->input('first_name');
			$user->last_name = $request->input('last_name');
			$user->email = $request->input('email');
			$user->password = bcrypt($request->input('password'));
			$user->activated = 0;
			$user->profile_id = $profile->id;
			$user->display_name = preg_replace('/([^@]*).*/', '$1', $request->input('email'));
			$user->linkname = preg_replace('/([^@]*).*/', '$1', $request->input('email'));

			if($user->save())
			{

				Mail::send('emails.new_registration', ['user' => $user], function ($m) use ($user) {
					$m->from('root@localhost', 'Biorower');

					$m->to("milosh.diklich@gmail.com", "Admin")->subject('New Registration Request!');
				});

				return view('message.successfull-registration');
			}
			else {
				return back()
					->with('status', 'Whoops! Something went wrong. Please try again.');
			}
		}

	}

	/**
	 * Approve register (Admin)
	 */
	public function approveRegister($userId)
	{
		$user = User::where('id', $userId)->firstOrFail();

		if($user->activated == 0)
		{
			$user->activated = 1;
			$user->save();

			Mail::send('emails.profile_activated', ['user' => $user], function ($m) use ($user) {
				$m->from('admin@biorower', 'Biorower');

				$m->to($user->email, $user->first_name)->subject('Biorower account info');
			});

			return 'User successfully activated.';

		}

		return 'User profile is already activated.';

	}

	/**
	 * Logout user
	 *
	 * @return mixed
	 */
	public function getLogout()
	{
		Auth::logout();

		return redirect('/');
	}

}
