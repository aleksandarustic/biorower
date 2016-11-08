<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\Timeline;
use App\Session;
use App\Comment;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\User\FriendsController;
use App\Notification;
use Vinkla\Pusher\PusherManager;


class CommentController extends Controller {

	protected $pusher;
	protected $coms_per_load = 10;

	public function __construct(PusherManager $pusher)
  	{
   	 	$this->pusher = $pusher;
 	}

	/**
	 * Show last two comments for a post/session 
	 *
	 * @return View(comments)
	 */
	public function index(req $request)
	{
		if(Request::ajax()){

			$page_number  	= $request['page'];
			$item_per_page 	= $request['num'];

			if($page_number == 2){
				$position 	= 2;
			}else{
				$position 	= (($page_number-1) * $item_per_page)-4;
			}

				$comments 	= Comment::where('session_id', $request['ids'])
						->where('status', 1)
						->leftJoin('users', 'comments.user_id', '=', 'users.id')
						->join('profiles', 'users.profile_id', '=', 'profiles.id')
						->join('images', 'profiles.image_id', '=', 'images.id')			
						->select('comments.text', 'comments.date', 'comments.session_id', 'comments.id',
							'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'comments.user_id', 'comments.utc')
						->orderBy('utc', 'desc')
						->skip($position)
						->take($item_per_page)
					    ->get();

			if(count($comments) > 0){ 
				return view('session.latest-comments', compact('comments'));
			}else{
				return 0;
			}
		}
	}

	/**
	 * Add a comment to a post
	 *
	 * @return Response($statusCode)
	 */
	public function create(req $request)
	{				
					$statusCode 		= 204;
		if(Request::ajax())
		{				
					$ids 				= $request['ids'];
					$id 				= Auth::id();
					$id2				= $request['id2'];
					$check 				= FriendsController::CheckFriendStatus($id, $id2);
			if($check['status'] == 2){
				try{
					$com 				= new Comment;
					$com->session_id 	= $ids;
					$com->user_id 		= $id;
					$com->text 			= $request['text'];
					$com->status 		= 1;
					$com->utc 			= strtotime(Carbon::now());
					$dt 				= Carbon::now(Auth::user()->timezone);
					$com->date     		= $dt->format('Y-m-d H:i:s');
					$com->save();

					$user 				= User::findOrFail($id);
					$com->avatar 		= $user->profile->image->name;
					$com->name 	 		= $user->first_name.' '.$user->last_name;
		
					$this->pusher->trigger('comments', 'comments-'.$ids, $com);
					$addNotif  = NotificationsController::addNotifications(3, $ids, $id2);
					$statusCode 		= 200;

					$result = Timeline::where('object_id', $ids)
									    ->where('status', 1)
								   		->increment('coms');

				}catch (Exception $e){
					DB::rollBack();
					$statusCode 		= 204;	
				}
			}
		}
		return Response::json($statusCode);
	}

	public static function NumComments($ids)
	{
			$num = Comment::where('session_id', $ids)
						->where('status', 1)	
						->select('id')
					    ->count();
			return $num;
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
	public function show(req $request)
	{
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
	 * Delete comment ( status = 0)
	 *
	 * @param  int  $id
	 * @return Response($statusCode)
	 */
	public function destroy(req $request)
	{
			$statusCode 	 = 204;	
		if(Request::ajax()){
			try{
					$id 	 = Auth::id();
					$idc 	 = $request['id']; // comment id

					$comment = Comment::where('id', $idc)
										->where('status', 1)
										->where('user_id', $id)
										->first();
				if($comment){
					$comment->status 	= 0;
					$comment->save();
					Timeline::where('object_id', $comment->session_id)
							->where('status', 1)
							->decrement('coms');
					$statusCode 		= 200;	
				}else{					
					$statusCode 		= 204;
				}	

			}catch (Exception $e){
					DB::rollBack();
					$statusCode 		= 204;	
			}
		}// end ajax request

		return $statusCode;	
	}

}
