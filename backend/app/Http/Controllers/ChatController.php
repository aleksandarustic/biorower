<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Auth;
use App\User;
use App\Friend;
use App\Profile;
use App\Message;
use Input;
use Exception;
use URL;
use Carbon\Carbon;
use DB;
use Cache;
use Vinkla\Pusher\PusherManager;
use App\Http\Controllers\User\FriendsController;


class ChatController extends Controller {

	var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$id = Auth::id();	
		if (Request::ajax()){
			$result = Friend::where('status', 2)
						->join('users', function ($join) use ($id) {
				            $join->on('friends.user2', '=', 'users.id')
				                 ->where('friends.user1', '=', $id)
				            ->orOn('friends.user1', '=', 'users.id')
				                 ->where('friends.user2', '=', $id);             
				        })
						->join('profiles', 'users.profile_id', '=', 'profiles.id')
						->join('images', 'profiles.image_id', '=', 'images.id')
						->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'friends.id as id_chat')
						->orderByRaw("RAND()")
					    ->get();
		    // Add user online status
		    for($i=0; $i < count($result); $i++){ 
					if(Cache::has('user-is-online-'.$result[$i]->id)){
						$result[$i]['online'] = '1';
					}
			}	    
			
			return $result;
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(req $request)
	{
		try{
		$id 				= Auth::user()->id;
		$id2 				= $request['id2'];

		$message 			= new Message();
		$message->status 	= 1;
		$message->read 		= 0;
		$message->sender_user_id = $id;
		$message->receiver_user_id = $id2;
		$message->text 		= $request['text'];
		$message->utc 		= strtotime(Carbon::now());
		$dt 				= Carbon::now(Auth::user()->timezone);
		$message->date     	= $dt->format('Y-m-d H:i:s');
		$message->save();

		$user 				= User::findOrFail($id);
		$user2 				= User::findOrFail($id2);
		$message->avatar 	= $user->profile->image->name;
		$message->name 	 	= $user->first_name.' '.$user->last_name;
		$date 				= Carbon::now($user2->timezone);
		$message->date1     = $date->format('Y-m-d H:i:s');
		$id_chat1 			= FriendsController::CheckFriendStatus($id, $id2);
		$message->id_chat 	= $id_chat1->id;

		$newmsg 			= Message::where('receiver_user_id', $id2)
						    ->where('status', 1)
						    ->where('read', 0)
						    ->select(DB::raw('count(sender_user_id) as nummsg, sender_user_id') ,'utc')
						    ->groupBy('sender_user_id')
						    ->get();

		}catch (Exception $e){
			$error = "error";
			return $error;
		}

		$this->pusher->trigger('ch-chat', 'chat-msg-'.$id_chat1->id, $message);
		$this->pusher->trigger('ch-chat', 'chat-notif-'.$id2, $newmsg);

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
	public function show()
	{
		$id = Auth::id();	
		if (Request::ajax()){
			$result = Friend::where('status', 2)
						->join('users', function ($join) use ($id) {
				            $join->on('friends.user2', '=', 'users.id')
				                 ->where('friends.user1', '=', $id)
				            ->orOn('friends.user1', '=', 'users.id')
				                 ->where('friends.user2', '=', $id);             
				        })
						->join('profiles', 'users.profile_id', '=', 'profiles.id')
						->join('images', 'profiles.image_id', '=', 'images.id')					
						->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'friends.id as id_chat')
						->orderByRaw("RAND()")
					    ->get();

			return view('/message/index', compact('result'));
		}		
	}


	public function getMsg(req $request)
	{
		if (Request::ajax()){
			$id 			= Auth::id();	
			$id2 			= $request['id2'];

			$msgs 			= Message::where('status', 1)
								->join('users', function ($join) use ($id, $id2) {
					            	$join->on('messages.receiver_user_id', '=', 'users.id')
					                 	->where('messages.sender_user_id', '=', $id)
					                 	->where('messages.receiver_user_id', '=', $id2)
					            	->orOn('messages.sender_user_id', '=', 'users.id')
					                 	->where('messages.sender_user_id', '=', $id2)
					                 	->where('messages.receiver_user_id', '=', $id); 
					                 }) 									
								->select('date', 'utc')
						  	    ->orderBy('utc', 'ASC')
						  	    ->paginate(15);
			
			$position 		=	$msgs->total()-15;		
			$totalmsg		= 	$msgs->total();
			$totalpage		=	$msgs->lastPage();	  	    

			$messages 		= Message::where('status', 1)
								->join('users', function ($join) use ($id, $id2) {
					            	$join->on('messages.receiver_user_id', '=', 'users.id')
					                 	->where('messages.sender_user_id', '=', $id)
					                 	->where('messages.receiver_user_id', '=', $id2)
					            	->orOn('messages.sender_user_id', '=', 'users.id')
					                 	->where('messages.sender_user_id', '=', $id2)
					                 	->where('messages.receiver_user_id', '=', $id); 
					                 }) 
								->join('profiles', 'users.profile_id', '=', 'profiles.id')
								->join('images', 'profiles.image_id', '=', 'images.id')					
								->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'messages.sender_user_id', 'messages.receiver_user_id', 'messages.text', 'messages.date', 'messages.utc')
						  	    ->orderBy('utc', 'ASC')
						  	    ->skip($position)
								->take(15)
							    ->get();		  	    

			$iddd 			= FriendsController::CheckFriendStatus($id, $id2);
			$id_chat 		= $iddd->id;
			$received		= $id2;

			return view('/message/msg', compact('messages', 'id_chat', 'received', 'totalmsg', 'totalpage'));
		}
	}

	public function getOldMsg(req $request)
	{
		if (Request::ajax()){
			$id 			= Auth::id();	
			$id2 			= $request['id2'];
			$page_number  	= $request['page'];
			$total 			= $request['total'];
			$totalpage		= $request['totalpage'];

			if($totalpage >= $page_number){
			$position		= ($total - ($page_number*15));

			$messages 		= Message::where('status', 1)
								->join('users', function ($join) use ($id, $id2) {
					            	$join->on('messages.receiver_user_id', '=', 'users.id')
					                 	->where('messages.sender_user_id', '=', $id)
					                 	->where('messages.receiver_user_id', '=', $id2)
					            	->orOn('messages.sender_user_id', '=', 'users.id')
					                 	->where('messages.sender_user_id', '=', $id2)
					                 	->where('messages.receiver_user_id', '=', $id); 
					                 }) 
								->join('profiles', 'users.profile_id', '=', 'profiles.id')
								->join('images', 'profiles.image_id', '=', 'images.id')					
								->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'messages.sender_user_id', 'messages.receiver_user_id', 'messages.text', 'messages.date', 'messages.utc')
						  	    ->orderBy('utc', 'ASC')
						  	    ->skip($position)
								->take(15)
							    ->get();

				if(count($messages) > 0){
					return view('/message/oldmsg', compact('messages'));
				}
			}else{
				return 0;
			}
		}
	}


	public function NumNewMsg()
	{
		$id 	= Auth::id();

		$result = Message::where('receiver_user_id', $id)
		    ->where('status', 1)
		    ->where('read', 0)
		    ->select(DB::raw('count(sender_user_id) as nummsg, sender_user_id'), 'utc')
		    ->groupBy('sender_user_id')
		    ->get();

	    return $result;
	}


	public function NewMsgNotif(req $request)
	{
		if (Request::ajax()){
			$id2 	= $request['id2'];
			$id 	= Auth::id();

			$result = Message::where('receiver_user_id', $id)
				    ->where('status', 1)
				    ->where('read', 0)
				    ->groupBy('sender_user_id')
				    ->count('sender_user_id');

		return $result;
		}

	}

	public function ViewNewMessages(req $request)
	{
		$id 	= Auth::id();
		$id2 	= $request['id2'];

		$statusCode = 204;

		if (Request::ajax()){
				$result = Message::where('receiver_user_id', $id)
					->where('sender_user_id', $id2)
				    ->where('status', 1)
				    ->where('read', 0)
			   		->update(['read' => '1']);
			   		
			     	$statusCode = 200;	
		}
	   return Response::json($statusCode);  
	}


}
