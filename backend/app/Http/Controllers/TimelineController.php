<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\Timeline;
use App\Session;
use App\User;
use App\Comment;
use DB;


class TimelineController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public static function index($id2)
	{
		$posts = Timeline::where('timeline.user_id', $id2)
						->where('timeline.status', 1)
						->where('sessions.deleted', false)
						->leftJoin('sessions', 'timeline.object_id', '=', 'sessions.id')
						->join('data_biorower_sessions', 'sessions.data_biorower_sessions_id', '=', 'data_biorower_sessions.id')
						->join('images', 'timeline.image', '=', 'images.id')
						->select('timeline.time', 'timeline.object_id', 'timeline.type', 'sessions.description', 'sessions.name', 'data_biorower_sessions.distance', 'data_biorower_sessions.time as totaltime', 'data_biorower_sessions.stroke_count', 'images.name as image', 'timeline.coms', 'timeline.utc')
						->orderBy('utc', 'desc')
					    ->paginate(15);

		if($posts){
	    	return $posts;
	    }else{
	    	return false;
	   	}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
