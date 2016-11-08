<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Http\Request;

class VerifyCsrfToken extends BaseVerifier {


	protected $except = [
        'api/*',
        'set-cookie'
    ];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		foreach( $this->except as $route )
        {
            if( $request->is( $route ) ) return $next($request);
        }

        return parent::handle($request, $next);
	}

}
