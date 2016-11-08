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
	        			$auth_name	= Auth::user()->first_name." ".Auth::user()->last_name;
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

							$element          		= "<li class='label-warning'> <a href='".asset('/'.Auth::user()->display_name)."'> <i class='fa fa-user-plus text-aqua'></i> ".$auth_name." accepted your friend request. Just now</a> </li>";
							// Display a new notification to users via a pusher
							Pusher::trigger('notifications', 'notifuser-'.$id2, $element);

			}elseif($type == 2){ // User save a new session
						$usersget 				= FollowController::GetAllUsersForNotification($id2);
						$user 					= User::find($id2);
						$link					= '/profile/'.$user->display_name.'/session/'.$object;

						// create notification for navbar
						$element   				= "<li class='label-warning'> <a href='".asset($link)."'> <i class='fa fa-info-circle text-aqua'></i>".$user->first_name." ".$user->last_name." did a new training. Just now</a></li>";

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

							// Display a new notification to users via a pusher
							Pusher::trigger('notifications', 'notifuser-'.$user->user1_id, $element);
						}

			}elseif($type == 3){
					$auth_name			= Auth::user()->first_name." ".Auth::user()->last_name;
					$link				= '/profile/'.Auth::user()->display_name.'/session/'.$object;

					$element   			= "<li class='label-warning'> <a href='".asset($link)."'> <i class='fa fa-commenting text-aqua'></i>".$auth_name." commented on your training. Just now</a></li>";

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

					Pusher::trigger('notifications', 'notifuser-'.$id2, $element);	
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

}
