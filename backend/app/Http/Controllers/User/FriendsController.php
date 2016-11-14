<?php namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use App\Friend;
use App\Profile;
use App\Message;
use App\Notification;
use Input;
use Exception;
use URL;
use DB;
use Vinkla\Pusher\PusherManager;
use App\Http\Controllers\NotificationsController;
use Carbon\Carbon;
//use Vinkla\Pusher\Facades\Pusher;


class FriendsController extends Controller {

  	protected $pusher;

	public function __construct(PusherManager $pusher)
  	{
   	 	$this->pusher = $pusher;
 	}

	/**
	 *  AUTH::USER sends a request for friendship - status=1
	 *
	 * @return Response - $statusCode
	 */
	public function create(req $request)
	{
		$statusCode = 204;

		if (Request::ajax()){
			$id = Auth::id();	
			// check status between two users

			$check = $this->CheckFriendStatus($id, $request['id2']);

	        try{  				
	            if(!$check){ // no friend - create new request 			
						$newRequest = new Friend();
						$newRequest->user1 			= $id;
						$newRequest->user2 			= $request['id2'];
						$newRequest->status 		= 1;
						$newRequest->user_action 	= $id;
						$newRequest->view 			= 0;
						$newRequest->utc_action 	= strtotime(Carbon::now());
						$newRequest->save();
				}else{
					if($check['status'] != 2)
						$check->status 			= 1;
						$check->view 			= 0;
						$check->user_action 	= $id;
						$check->utc_action	 	= strtotime(Carbon::now());
						$check->save();	
				}

					$broj = 1;
       				$this->pusher->trigger('requests', 'private-'.$request['id2'], ['message' => $broj]);
					$statusCode = 200;	
 					
			}catch (Exception $e){
				DB::rollBack();
				$error = "error";
				return $error;
			}
					
		}
		return Response::json($statusCode);  
	}

	/**
	 * AUTH::user accept friend request - status=2
	 *
	 * @param  int  $id2
	 * @return Response($statusCode)
	 */
	public function ConfirmFriend(req $request)
	{
		$statusCode = 204;

		if (Request::ajax()){
				$id 	= Auth::id();	
			try{
				$res = $this->CheckFriendStatus($id, $request['id2']);

	            if($res && $res->user_action != $id && $res->status == 1){		  
	     			$res->status 		= 2;
	     			$res->user_action 	= $id;
	     			$res->utc_action 	= strtotime(Carbon::now());
					$res->save();	  			  
					$statusCode 		= 200;
					//$res->name 			= Auth::user()->first_name.' '.Auth::user()->last_name;
					//$res->username 		= Auth::user()->display_name;
				}

					$addNotif			= NotificationsController::addNotifications(1, '', $request['id2']); 
		
			}catch(Exception $e){
				$error = "error";
				return $error;
			}
		}
		return Response::json($statusCode);  
	}


	/**
	 * Checking whether a user 1 and user 2 friends.
	 * Obtaining the status of friendship between the two users.
	 *
	 * @param  int  $user1, int $user2 
	 * @return $result = status
	 */
	public static function CheckFriendStatus($user1, $user2)
	{
	    $result = Friend::where(function($query) use ($user1, $user2)
	    {
	        $query->where([
	            'user1'   => $user1,
	            'user2' => $user2
	        ])->orWhere([
	            'user1'   => $user2,
	            'user2' => $user1
	        ]);
	    })->first();

	    if($result){
	    	return $result;
	    }else{
	    	return false;
	    }
	}

	/**
	 * Page to display all received and sent friend requests to AUTH::user
	 *
	 * @return View / with: received, send results
	 */
	public function ViewRequests()
	{
		$received = $this->GetReceivedRequest();
		$send 	  = $this->GetSendRequest();

		return view('user.friends-request', compact('received', 'send'));							
	}

	/**
	 * AUTH::user cancels friendship(unfriend)    or
	 * AUTH::user cancel request to a friend - status=0
	 * @param  int  $id2 
	 * @return Response($statusCode)
	 */
	public function destroy(req $request)
	{
		$statusCode = 204;

		if (Request::ajax()){
				$id 	= Auth::id();	
				$id2 	= $request['id2'];
			try{
				$res = $this->CheckFriendStatus($id, $id2);
	            	if($res){		  
		     			$res->status 		= 0;
		     			$res->user_action 	= $id;
		     			$res->utc_action 	= strtotime(Carbon::now());
						$res->save();	  			  
						$statusCode = 200;	

						$messages 	= Message::where('status', 1)
												->where('read', 0)
								              	->where(function($query) use ($id,$id2){
												        $query->where('messages.sender_user_id', '=', $id)
								                 			  ->where('messages.receiver_user_id', '=', $id2); 
												    })
												->orWhere(function($query) use ($id,$id2){
												        $query->where('messages.sender_user_id', '=', $id2)
								                 			  ->where('messages.receiver_user_id', '=', $id); 
												    })
								                ->update(['read' => '1']); 

					    $not        = Notification::where('status', 1)
					    							->where(function($query) use ($id,$id2){
												        $query->where('user_action', '=', 	$id)
								                 			  ->where('user_get', 	 '=', 	$id2); 
												    })
													->orWhere(function($query) use ($id,$id2){
												        $query->where('user_action', '=', 	$id2)
								                 			  ->where('user_get', 	 '=',	$id); 
												    })
					    							->update(['status' => '0']);

					}
			}catch(Exception $e){
				$error = "error";
				return $error;	
			}
		}
		return Response::json($statusCode);  
	}

	/**
	 * Get all received friend requests for AUTH::user
	 *
	 * @return result(array)
	 */
	public function GetReceivedRequest()
	{
		$id 	= Auth::id();

		$result = Friend::where(function($query) use ($id)
	    {
	        $query->where([
	            'user1'   => $id,
	        ])->orWhere([
	            'user2' => $id
	        ]);
	    })
	    ->where('status', 1)
	    ->where('user_action', '!=', $id)
		->leftJoin('users', 'friends.user_action', '=', 'users.id')
		->join('profiles', 'users.profile_id', '=', 'profiles.id')
		->join('images', 'profiles.image_id', '=', 'images.id')					
		->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name')
		->orderBy('utc_action', 'desc')
	    ->get();

	    return $result;
	}

	/**
	 * Get all send friend requests for AUTH::user
	 *
	 * @return result(array)
	 */
	public function GetSendRequest()
	{
		$id 	= Auth::id();

		$result = Friend::where('status', 1)
	    ->where('user_action', '=', $id)
		//->leftJoin('users', 'friends.user_action', '=', 'users.id')
		->join('users', function ($join) use ($id) {
            $join->on('friends.user1', '=', 'users.id')
                 ->where('friends.user1', '!=', $id)
            ->orOn('friends.user2', '=', 'users.id')
                 ->where('friends.user2', '!=', $id);             
        })
		->join('profiles', 'users.profile_id', '=', 'profiles.id')
		->join('images', 'profiles.image_id', '=', 'images.id')					
		->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name')
		->orderBy('utc_action', 'desc')
	    ->get();

	    return $result;	
	}

	/**
	 * The total number of received friends requests , view = 0
	 * route '/new-requests'
	 * @return result( int ) 
	 */
	public function NumNewRequests()
	{
		$id 	= Auth::id();

		$result = Friend::where(function($query) use ($id)
	    {
	        $query->where([ 'user1'   => $id, ])
	        	  ->orWhere([ 'user2' => $id  ]);
	    })
				    ->where('status', 1)
				    ->where('view', 0)
				    ->where('user_action', '!=', $id)
				    ->count();
	    return $result;
	}

	/**
	 * User is view new received friends requests, view = 1
	 * route '/view-newreq'
	 * @return response $statusCode
	 */
	public function ViewNewRequests()
	{
		$id 	= Auth::id();
		$statusCode = 204;

		if (Request::ajax()){
				$result = Friend::where(function($query) use ($id)
			    	{
			        	$query->where(['user1'   => $id,])
			        		  ->orWhere(['user2' => $id ]);
			    	})
			    ->where('status', 1)
			    ->where('view', 0)
			    ->where('user_action', '!=', $id)
			    ->update(['view' => '1']);
			     $statusCode = 200;	
		}
	   return Response::json($statusCode);  
	}

}
