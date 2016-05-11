<?php namespace App\Http\Controllers;

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
			return redirect('/profile/' . Auth::user()->linkname);
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
				->withErrors($validator)
				->withInput();
		}
		else
		{
			if(Auth::attempt([
				'email'    => $request->input('email'),
				'password' => $request->input('password')
			]))
			{
				return redirect('/profile');
			}
			else
			{
				return redirect()->back()->with('status', 'Incorrect email or password.');
			}
		}
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
