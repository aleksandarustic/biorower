<?php namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Auth;
use App\User;
use App\Watching;
use App\Profile;
use Input;
use Exception;
use URL;
use DB;

class FollowController extends Controller {

	/**
	 * AUTH::user get notifications from $id2 
	 *
	 * @param  int  $id2
	 * @return Response($statuscode)
	 */
	public function create(req $request)
	{
		$statusCode = 204;

		if (Request::ajax()){
			$id = Auth::id();	
			// check status between two users
			$check = Watching::where('user1_id', '=', $id)
							  ->where('user2_id', '=', $request['id2'])
	              			  ->first();
	        try{  				
	            if(!$check){ // no follow 			
						$newRequest = new Watching();
						$newRequest->user1_id = $id;
						$newRequest->user2_id = $request['id2'];
						$newRequest->status = 1;
						$newRequest->save();
				}else{
					if($check['status'] != 1)
						$check->status = 1;
						$check->save();	
				}
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function GetAllUsersForNotification($id)
	{
			$users = Watching::where('user2_id', '=', $id)
							  ->where('status', '=', 1)
							  ->select('watching.user1_id')
	              			  ->get();
		return $users;						
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function ShowFollowingMe($id)
	{
		$list = Watching::where('user1_id', Auth::user()->id)
								->where('approved', 2)
								//->with('user2','user2.profile','user2.profile.image')
								//->with('user2.sessionsCount')
								//->select('id')
								->leftJoin('users', 'watching.user2_id', '=', 'users.id')
								->join('profiles', 'users.profile_id', '=', 'profiles.id')
								->join('images', 'profiles.image_id', '=', 'images.id')
								//->leftJoin('dic_countries', 'dic_country_id', '=', 'dic_countries.id')
								->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name')
								->get();

		return $list;
	}


	/**
	 * UNFOLLOW  = Stop watching users
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(req $request)
	{
		$statusCode = 204;

		if (Request::ajax()){
				$id 	= Auth::id();	
			try{
				$res 	= Watching::where('user1_id', '=', $id)
							  ->where('user2_id', '=', $request['id2'])
							  ->where('status', 1)
	              			  ->first();
	            if($res){		  
	     			$res->status = 0;
					$res->save();	  			  
					$statusCode = 200;	
				}

			}catch(Exception $e){
				$error = "error";
				return $error;	
			}
		}
		return Response::json($statusCode);  
	}

	/**
	 * Check - check whether the user receives notification from $id2
	 * 
	 * @param  int  $id2
	 * @return Response
	 */
	public static function CheckGetNotifications($id2)
	{
		$id 		= 	Auth::id();	
		$result		= 	Watching::where('user1_id', '=', $id)
							->where('user2_id', '=', $id2)
							->where('status', 1)
	              			->first();
	    if($result){
	    	return 1;
	    }else{
	    	return 0;
	    }          			
	}


}
