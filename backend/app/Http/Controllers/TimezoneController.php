<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use Cookie;

class TimezoneController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public static function index()
	{
		$user = Auth::user();

    	if($user->timezone == ''){ // user has not set timezone in db
    		if(!Cookie::get('tz')){ // Check if there is cookie with timezone
    			$user->timezone = "Etc/GMT+0";
    			$user->save();
    			$timezone 		= "Etc/GMT+0";	
    		}else{ 
    			$timezone 		= Cookie::get('tz');
    			$user->timezone = $timezone;
    			$user->save();
    		}
    	}else{
    		$timezone 	= $user->timezone;
    	}

    	return $timezone;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(req $request)
	{
		$timezone 	= Cookie::get('tz');
		if(!$timezone or $timezone != $request['tz'] ){
        	return response('ok')->withCookie(cookie('tz', $request['tz']));
    	}else{
    		return response('vec postoji');
    	}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
