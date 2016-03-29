<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!$this->auth->guest())
		{
			return $next($request);
		}
		else{
			
			/*
			if (in_array($_SERVER['HTTP_USER_AGENT'], array( 'facebookexternalhit/1.0 (+https://www.facebook.com/externalhit_uatext.php)', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'Facebot (+http://www.facebook.com/externalhit_uatext.php)' )))
			{ 
				return $next($request); 
			}
			else 
			*/

			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}			
		}
	}

}
