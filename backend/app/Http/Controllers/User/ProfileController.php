<?php namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Profile;
use App\Watching;
use App\Friend;
use Auth;
use App\Library\GlobalFunctions;
use App\Session;
use App\Http\Controllers\User\FriendsController;
use App\Http\Controllers\User\FollowController;
use App\Http\Controllers\TimelineController;
use Cache;

class ProfileController extends Controller {

	/**
	 * Public display the person's profile
	 * @param string $username
	 * @return View(user.friend-profile)
	 */
	public function index($username)
	{
		try{
			$user = User::where('display_name', '=', $username)
					->where('activated', 1)
					->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
					->join('images', 'image_id', '=', 'images.id')
					->leftJoin('dic_countries', 'dic_country_id', '=', 'dic_countries.id')
					->select('users.first_name', 'users.last_name', 'users.display_name', 'users.id', 'images.name', 'dic_countries.name as country', 'users.email')
					->first();

			if($user){
				$id = Auth::id();
				if($id == $user->id) return redirect('/'); 

				// check whether the AUTH-user friends with $username
              	$check = FriendsController::CheckFriendStatus($id, $user->id);

              	if(!$check or $check['status'] != 2){ // no friend
              			$status = $check;
              			return view('user.profile', compact('user', 'status'));
              	}else{ // Friends 
					$totalPar 	= GlobalFunctions::GetTotalStatistics($user->id);
					$friends  	= $this->UserProfileFriends($user->id);
					$getstatus 	= FollowController::CheckGetNotifications($user->id);

					$sessions = Session::where('user_id', $user->id)
								->where('deleted', 0)
								->leftJoin('data_biorower_sessions', 'data_biorower_sessions_id', '=', 'data_biorower_sessions.id')
								->orderBy('utc', 'DESC')
								->select('sessions.id', 'sessions.date', 'sessions.name', 'sessions.description', 'data_biorower_sessions.distance', 'data_biorower_sessions.power_average', 'data_biorower_sessions.heart_rate_average', 'data_biorower_sessions.time', 'sessions.utc')
						    	->get();

				if(Cache::has('user-is-online-'.$user->id)){ // whether the user is online
						$user['online'] = '1';
				}
	    		    	
              	return view('user.friend-profile', compact('user', 'totalPar', 'sessions', 'friends', 'getstatus', 'posts'));
              	}

			}else{
				return redirect('/');
			}

		}catch (Exception $e){
			return redirect('/');
		}

	}

	/**
	 * Display pages with graphs for $username
	 * @param string $username
	 * @return view(user.graphs)
	 */
	public function graphs($username)
	{
		try{
			$user = User::where('display_name', '=', $username)
					->where('activated', 1)
					->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
					->join('images', 'image_id', '=', 'images.id')
					->leftJoin('dic_countries', 'dic_country_id', '=', 'dic_countries.id')
					->select('users.first_name', 'users.last_name', 'users.display_name', 'users.id', 'images.name', 'dic_countries.name as country', 'users.email')
					->first();

			if($user){
				$id = Auth::id();
				if($id == $user->id) return redirect('/'); 

				// check whether the AUTH-user friends with $username
              	$check = FriendsController::CheckFriendStatus($id, $user->id);

              	if(!$check or $check['status'] != 2){ // no friend
              			$status = $check;
              			return view('user.profile', compact('user', 'status'));
              	}else{ // Friends 
					$getstatus 	= FollowController::CheckGetNotifications($user->id);

				if(Cache::has('user-is-online-'.$user->id)){ // whether the user is online
						$user['online'] = '1';
				}
	    		    	
              	return view('user.graphs', compact('user', 'getstatus'));
              	}

			}else{
				return redirect('/');
			}

		}catch (Exception $e){
			return redirect('/');
		}
	}

	/**
	 * Display pages with calendar(with sessions) for $username
	 * @param string $username
	 * @return view(user.calendar)
	 */
	public function calendar($username)
	{
		try{
			$user = User::where('display_name', '=', $username)
					->where('activated', 1)
					->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
					->join('images', 'image_id', '=', 'images.id')
					->leftJoin('dic_countries', 'dic_country_id', '=', 'dic_countries.id')
					->select('users.first_name', 'users.last_name', 'users.display_name', 'users.id', 'images.name', 'dic_countries.name as country', 'users.email')
					->first();

			if($user){
				$id = Auth::id();
				if($id == $user->id) return redirect('/'); 

				// check whether the AUTH-user friends with $username
              	$check = FriendsController::CheckFriendStatus($id, $user->id);

              	if(!$check or $check['status'] != 2){ // no friend
              			$status = $check;
              			return view('user.profile', compact('user', 'status'));
              	}else{ // Friends 
					$getstatus 	= FollowController::CheckGetNotifications($user->id);

				if(Cache::has('user-is-online-'.$user->id)){ // whether the user is online
						$user['online'] = '1';
				}
	    		    	
              	return view('user.calendar', compact('user', 'getstatus'));
              	}

			}else{
				return redirect('/');
			}

		}catch (Exception $e){
			return redirect('/');
		}
	}

	/**
	 * Display the eight randomly selected friends for user($id)
	 *
	 * @param  int  $id
	 * @return Result(array)
	 */
	public static function UserProfileFriends($id)
	{
		$result = Friend::where('status', 2)
						->join('users', function ($join) use ($id) {
				            $join->on('friends.user2', '=', 'users.id')
				                 ->where('friends.user1', '=', $id)
				            ->orOn('friends.user1', '=', 'users.id')
				                 ->where('friends.user2', '=', $id);             
				        })
						->join('profiles', 'users.profile_id', '=', 'profiles.id')
						->join('images', 'profiles.image_id', '=', 'images.id')					
						->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name')
						->limit(8)
						->orderByRaw("RAND()")
					    ->get();

		return $result;			    
	}

	/**
	 * View all friends of one user
	 *	
	 *	@param string $username
	 *  @return view(friends-list)
	 */
	public function FriendsList($username)
	{
		$user   	= User::where('display_name', '=', $username)
					->where('activated', 1)
					->select('users.first_name', 'users.last_name', 'users.display_name', 'users.id')
					->first();			
		$id 		= $user->id;

		$check = FriendsController::CheckFriendStatus(Auth::id(), $id);

		if($check && $check['status'] == 2){ 

		$friends 	= Friend::where('status', 2)
					->where('user1', '!=', Auth::id())
					->where('user2', '!=', Auth::id())
					->join('users', function ($join) use ($id) {
				            $join->on('friends.user2', '=', 'users.id')
				                 ->where('friends.user1', '=', $id)
				            ->orOn('friends.user1', '=', 'users.id')
				                 ->where('friends.user2', '=', $id);             
				        })
					->join('profiles', 'users.profile_id', '=', 'profiles.id')
					->join('images', 'profiles.image_id', '=', 'images.id')					
					->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name')
					->orderBy('users.first_name', 'desc')
					->paginate(30);

            // add status
           for($i=0; $i < count($friends); $i++){ 
            	$check = FriendsController::CheckFriendStatus(Auth::id(), $friends[$i]->id);
					if($check && $check['status'] > 0){ 
						$friends[$i]['sfriend'] = $check['status'];
					}
			} 	
			return view('user.friends-list', compact('friends', 'user'));

		}else{
			return redirect('/');
		}
	}

	/**
	 * View All Friends AUTH user
	 *	
	 *	@param 
	 *  @return view(myfriends-list)
	 */
	public function MyFriendsList()
	{
		$id = Auth::id();

		$friends 	= Friend::where('status', 2)
					//->where('user1', '!=', Auth::id())
					//->where('user2', '!=', Auth::id())
					->join('users', function ($join) use ($id) {
				            $join->on('friends.user2', '=', 'users.id')
				                 ->where('friends.user1', '=', $id)
				            ->orOn('friends.user1', '=', 'users.id')
				                 ->where('friends.user2', '=', $id);             
				        })
					->join('profiles', 'users.profile_id', '=', 'profiles.id')
					->join('images', 'profiles.image_id', '=', 'images.id')					
					->select('users.id', 'users.display_name', 'users.first_name', 'users.last_name', 'images.name')
					->orderBy('users.first_name', 'desc')
					->paginate(30);

		return view('user.myfriends-list', compact('friends'));
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
