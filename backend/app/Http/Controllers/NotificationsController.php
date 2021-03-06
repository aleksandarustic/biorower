<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use App\Profile;
use App\Notification;
use App\Http\Controllers\User\FollowController;
use URL;
use Carbon\Carbon;
use DB;
use Vinkla\Pusher\Facades\Pusher;

class NotificationsController extends Controller {

	/**
	 * Display all notifications for a AUTH::user
	 *
	 * @return $notifications
	 */
	public static function index()
	{
		$id = Auth::id();	

		$notifications = Notification::where('user_get', $id)
						->where('status', 1)
						->leftJoin('users', 'notifications.user_action', '=', 'users.id')
						->join('profiles', 'users.profile_id', '=', 'profiles.id')
						->join('images', 'profiles.image_id', '=', 'images.id')		
						->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'notifications.type', 'notifications.object', 'notifications.isRead', 'notifications.time', 'notifications.utc')
						->orderBy('utc', 'desc')
					    ->get();

		if($notifications){
	    	return $notifications;
	    }else{
	    	return false;
	    }
	}

	/**
	 * Adding a new notification or more notifications
	 * Type 1 = Accept friend request  | Type 2 = User save new session | type 3 = add comment
	 * @param  int $type , int
	 * @return Response($statusCode)
	 */
	public static function addNotifications($type, $object, $id2)
	{
		$statusCode = 204;
		$id 		= Auth::id();

	    try{  				
	        if($type == 1){ //  Accept friend request
	            		$check					= Notification::where('type', 1)
	            									->where('status', 1)
	            									->where(function($query) use ($id, $id2)
															{ $query->where(['user_action'   => $id,
																            'user_get' => $id2
																        ])->orWhere([ 'user_action'   => $id2,'user_get' => $id]); 
															})
													->first();
						if(!$check) // checking whether there is already this notice
						{										    
							$new1 					= new Notification();
							$new1->user_action 		= $id;
							$new1->user_get 		= $id2;
							$new1->type 			= 1;
							$new1->status 			= 1;
							$new1->utc 				= strtotime(Carbon::now());
							$dt 					= Carbon::now(Auth::user()->timezone);
							$new1->time     		= $dt->format('Y-m-d H:i:s');
							$new1->save(); // save new notification
						}else{ 
							$check->user_action		= $id;
							$check->user_get		= $id2;
							$check->isRead 			= 0;
							$check->utc 			= strtotime(Carbon::now());
							$dt 					= Carbon::now(Auth::user()->timezone);
							$check->time 			= $dt->format('Y-m-d H:i:s');
							$check->save(); // change older notifcation
						}
						Pusher::trigger('notifications', 'notifuser-'.$id2, 1);

			}elseif($type == 2){ // User save a new session
						$usersget 				= FollowController::GetAllUsersForNotification($id2);

						foreach($usersget as $user)
						{
							$new2 				= new Notification();
							$new2->user_action 	= $id2;
							$new2->user_get 	= $user->user1_id;
							$new2->object 		= $object;
							$new2->type 		= 2;
							$new2->status 		= 1;
							$new2->utc 			= strtotime(Carbon::now());
							$dt 				= Carbon::now();
							$new2->time 		= $dt->format('Y-m-d H:i:s');
							$new2->save(); // save new notification

							Pusher::trigger('notifications', 'notifuser-'.$user->user1_id, 1);
						}

			}elseif($type == 3){
					$new2 				= new Notification();
					$new2->user_action 	= $id;
					$new2->user_get 	= $id2;
					$new2->object 		= $object;
					$new2->type 		= $type;
					$new2->utc 			= strtotime(Carbon::now());
					$dt 				= Carbon::now(Auth::user()->timezone);
					$new2->time     	= $dt->format('Y-m-d H:i:s');
					$new2->status 		= 1;
					$new2->save(); // save new notification
					Pusher::trigger('notifications', 'notifuser-'.$id2, 1);	
			}

		$statusCode = 200;	// all is ok

		}catch (Exception $e){
			DB::rollBack();
			$error = "error";
			return $error;
		}	
		return Response::json($statusCode);  
	}

	/**
	 * Display number of new notifications
	 * @route /num-new-notifications
	 * @return int $result
	 */
	public function NumNewNotifications()
	{
		$id = Auth::id();	

		$result = Notification::where('user_get', $id)
				    ->where('status', 1)
				    ->where('isRead', 0)
				    ->count();

	    return $result;
	}

	/**
	 * Users view their new notifications | isRead = 1
	 * @route /read-new-notifications
	 * @return response($statuscode)
	 */
	public function ReadNewNotifications()
	{
		$id 		= Auth::id();
		$statusCode = 204;

		if (Request::ajax()){
			$result = Notification::where('user_get', $id)
					->where('status', 1)
				    ->where('isRead', 0)
			   		->update(['isRead' => '1']);
			   		
			     	$statusCode = 200;	// all is ok
		}
	   return Response::json($statusCode);  
	}

	/**
	 * Get new notifications - isRead = 0
	 * @route /get-new-notifications
	 * @return response($statuscode)
	 */	
	public function GetNewNotifications()
	{
		$id = Auth::id();	

		$notifications = Notification::where('user_get', $id)
						->where('status', 1)			
						->leftJoin('users', 'notifications.user_action', '=', 'users.id')
						->join('profiles', 'users.profile_id', '=', 'profiles.id')
						->join('images', 'profiles.image_id', '=', 'images.id')		
						->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name', 'notifications.type', 'notifications.object', 'notifications.isRead', 'notifications.time', 'notifications.utc')
						->orderBy('utc', 'desc')
					    ->get();

		$this->ReadNewNotifications();
		$element 		= array();

		foreach ($notifications as $key) {
					
					$name			= $key->first_name." ".$key->last_name;
					$link			= '/profile/'.$key->display_name.'/session/'.$key->object;
						if($key->isRead == 0){
						 	$isread = 'label-warning'; 
						}else{
							$isread = '';
						}

					if($key->type == 1){
					    	$element[]          		= "<li class='".$isread."'> <a href='".asset('/'.$key->display_name)."'> <i class='fa fa-user-plus text-aqua'></i> ".$name." accepted your friend request. ".$key->time_ago."</a> </li>";
					}elseif ($key->type == 2) {
							$element[]    			= "<li class='".$isread."'> <a href='".asset($link)."'> <i class='fa fa-info-circle text-aqua'></i>".$name." did a new training. ".$key->time_ago."</a></li>";
					}elseif ($key->type == 3) {
							$element[]   			= "<li class='".$isread."'> <a href='".asset($link)."'> <i class='fa fa-commenting text-aqua'></i>".$name." commented on your training. ".$key->time_ago."</a></li>";
					}
			}	// end foreach		    

		if($notifications){
	    	return $element;
	    }else{
	    	return false;
	    }		
	}

}
