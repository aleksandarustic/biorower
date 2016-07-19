<?php namespace App\Http\Controllers\User;

use App\Country;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use View;
use Input;
use DB;
use Auth;
use Exception;
use URL;
use App\Image;
use App\Message;
use App\Library\GlobalFunctions;

use App\Watching;
use Mail;

use Closure;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getSearch()
	{
		return view('/user/search');
	}

	public function postSearchUsersAjax() 
	{

		if (Input::get('search_name') != ""){
			/*
				$usersFirst = User::where('first_name', 'LIKE', '%' . Input::get('search_name') . '%')->get();
				$usersLast = User::where('last_name', 'LIKE', '%' . Input::get('search_name') . '%')->get();

				$result = $usersFirst->merge($usersLast);
			*/

			$usersFirst = User::with('profile')
					  ->where('first_name', 'LIKE', '%' . Input::get('search_name') . '%')
					  ->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
					  //->where('profiles.privacy', '=', 1)
					  ->with('sessionsCount')
					  ->with('profile.image')
					  ->get();

			$usersLast = User::with('profile')
					  ->where('last_name', 'LIKE', '%' . Input::get('search_name') . '%')
					  ->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
					  //->where('profiles.privacy', '=', 1)
					  ->with('sessionsCount')
					  ->with('profile.image')
					  ->get();

			$result = $usersFirst->merge($usersLast);
			
		}
		else{
			$result = User::all(); //skloniti
		}

		$partialView = View::make('/user/_users-search-results')->with('users', $result)->render();

        return Response::json($partialView);
        
	}

	public function getEdit()
	{

		
                $user3=Auth::User();
                
                
		$user = User::where('id', $user3['id'])->with('profile')->first();
		$countries = Country::all();

		return view('/user/edit', compact('user', 'countries'));
	}

	public function postUserChangeProfileImage()
	{

		$x1 = Input::get("cx1");
		$y1 = Input::get("cy1");
		$w = Input::get("cw");
		$h = Input::get("ch");

		//return "x1:".$x1." y1:".$y1." w:".$w." h:".$h;
		//x1:191 y1:14 w:299 h:299

		$filename = Input::get("tempImage");
		$tempPath = DIRECTORY_SEPARATOR."temp_profile_images".DIRECTORY_SEPARATOR;
		$profilesPath = DIRECTORY_SEPARATOR."profile_images".DIRECTORY_SEPARATOR;
		$fullfileName = $tempPath.$filename;

		$ekstenzija = explode('.', $filename);

		$image = new Image();
		$image->save();

		$arrayDirektorijumi = explode('/', GlobalFunctions::getFileDirectory($image->id));
		$direktorijumi = GlobalFunctions::NapraviDirektorijume($arrayDirektorijumi);		

		$fileOnDisc = md5(uniqid(rand(), true));
		$fileOnDisc = $fileOnDisc.".".strtolower(end($ekstenzija));

		GlobalFunctions::CropSaveAndResizeImage(end($ekstenzija), $fullfileName, $x1, $y1, $w, $h);

	    if (copy(storage_path().$fullfileName, $direktorijumi.$fileOnDisc))
	    {
		    $profile = Auth::user()->profile;

		    $oldImageId = null;
		    $imageOldName = "";
		    if (isset($profile->image_id))
		    {
		    	$oldImageId = $profile->image_id;
		    	$imageOldName = $profile->image->name;
		    }

		    $profile->image_id = $image->id;
		    $profile->save();

		    if (isset($oldImageId)){
		    	if ($imageOldName != ""){
		    		try{
		    			unlink(storage_path().$profilesPath.$imageOldName);
		    		}
					catch (Exception $e){
		    		}
		    	}
		    	Image::destroy($oldImageId);
		    }

		    $image->name = GlobalFunctions::getFileDirectory($image->id).$fileOnDisc;
		    $image->save();

		    unlink(storage_path().$fullfileName);
	    }
	}	

	public function postUserUploadTempImage()
	{
		if (Input::only("file") != "")
		{
			$eks = explode(".", $_FILES['file']['name']);
			$filename = time().Auth::id().".".end($eks);

			if (GlobalFunctions::ProveraEkstenzije(end($eks)))
			{
				$fullfileName = DIRECTORY_SEPARATOR."temp_profile_images".DIRECTORY_SEPARATOR.$filename;

			    if (move_uploaded_file($_FILES['file']['tmp_name'], storage_path().$fullfileName))
			    {
			    	list($width, $height, $type, $attr) = getimagesize(storage_path().$fullfileName);

			    	return response()->json(['width' => $width, 'height' => $height, 'filename' => $filename]);
			    }
		    }
		    else{
		    	return "false";
		    }
		}
	}

	public function postEdit()
	{

		$id = Auth::id();

		$inputUser = Input::except('profile');
		$inputUser['id'] = $id;

		$user = new User();
		$profile = new Profile();
		$errors = array();
		$profileInput = Input::get('profile');

		// attempt validation
		if ($user->validateModel($inputUser) && $profile->validateModel($profileInput))
		{

			DB::beginTransaction();

			try
			{	
				$user = User::find($id);
			    $user->fill(Input::only('email', 'first_name', 'last_name', 'display_name'));

			    foreach($user->toArray() as $key => $value)
			    {
					if (empty($inputUser[$key]) && $key != 'password' && $key != 'auth_token' && $key != 'profile_id') {
						$user->{$key} = null;
					}
			    }

				if (Input::get('password') != ""){
					$user->password = bcrypt(Input::get('password'));
				}

				$user->save();

			    foreach($profile->toArray() as $key => $value)
			    {
					if (empty($profileInput[$key]) && $key != 'id') {
						$profile->{$key} = null;
					}
			    }

			    $profile = $user->profile->fill(Input::get('profile'));
				$profile->save();

				DB::commit();

			}
			catch (Exception $e){

				DB::rollBack();

				$error = "There is a problem with database connection. Please, try again or report the error to the administrators.";
				return redirect('user/edit')->with('flash_message', $error);

			}

			return redirect('/'.Auth::user()->linkname);
		
		}
		else
		{

			$errors =  $user->errors()->merge($profile->errors());

			$user = User::where('id', $id)->with('profile')->first();
		    $user->fill(Input::only('email', 'first_name', 'last_name', 'display_name'));

			//$errors = $user->getErrors()->all() + $profile->getErrors()->all();
		    //$errors = array_merge($user->errors()->toArray(), $profile->errors()->toArray());
		}

		return  view('/user/edit', compact('user', 'errors', 'profile'));

	}

	public function getFollowUser(req $request)
	{

		$ln = $request["user_ln"];
		$user = User::where('linkname', $ln)->first();

		if ($user->profile->privacy == 1)
		{
			try
			{
				$watching = new Watching();
				$watching->user1_id = Auth::user()->id;
				$watching->user2_id = $user->id;

				$watching->save();

				$recipient = array();
				array_push($recipient, $user->email);
				array_push($recipient, $user->first_name);
				array_push($recipient, $user->last_name);

				$linkAdd = Request::root()."/".$user->linkname;

				if (strpos($user->email, '@btemp.com') == false){
					Mail::send('emails.new_follower', ['user_follower' => $user->display_name, 'linkAdd' => $linkAdd], function($message) use ($recipient)
					{
						$name = $recipient[1]." ".$recipient[2];
					    $message->to($recipient[0], $name)->subject('New follower');
					});
				}

			}
			catch (Exception $e){
				$error = "error";
				return $error;
			}
		}

	}

	public function getUnfollowUser(req $request)
	{
		$ln = $request["user_ln"];
		$user = User::where('linkname', $ln)->first();

		try
		{
			$watching = Watching::where('user1_id', Auth::user()->id)
								->where('user2_id', $user->id)
								->where('website_id', config('app.website'))
								->first();
			$watching->delete();
		}
		catch (Exception $e){
			$error = "error";
			return $error;
		}
	}

	public function getIamFollowing()
	{
		$allWatching = Watching::where('user1_id', Auth::user()->id)
								->where('website_id', config('app.website'))
								->where('approved', 1)
								->with('user2','user2.profile','user2.profile.image', 'user2.sessions')
								->with('user2.sessionsCount')
								->get();

		return view('/user/iam-following', compact('allWatching'));
	}

	/**
	 * Friends
	 *
	 * @return View
	 */
	public function friends()
	{
		return view('user.friends');
	}

	public function getFollowingMe()
	{

		$allWatched = Watching::where('user2_id', Auth::user()->id)
								->where('approved', 1)
								->with('user1','user1.profile','user1.profile.image')
								->with('user1.sessionsCount')
								->get();

		return view('/user/following-me', compact('allWatched'));
	}

	public function getRequesttofollowUser(req $request)
	{

		$ln = $request["user_ln"];
		$user = User::where('linkname', $ln)->first();

		$newWatching = new Watching();
		$newWatching->user1_id = Auth::user()->id;
		$newWatching->user2_id = $user->id;
		$newWatching->approved = 0;

		DB::beginTransaction();

		try{
			$newWatching->save();

			$message = new Message();
			$message->read = 0;
			$message->sender_user_id = Auth::user()->id;
			$message->receiver_user_id = $user->id;

			$linkAccept = Request::root()."/user/accept-following?user_ln=".Auth::user()->linkname;

			$name = "";
			if (Auth::user()->first_name !="" || Auth::user()->last_name !=""){
				$name = "(".Auth::user()->first_name." ".Auth::user()->last_name.")";
			}
			$message->text = "User ".Auth::user()->display_name." ".$name." send you request for follow. You can accept request on the following link: <a class='btn btn-default' href='".$linkAccept."' >Accept</a>";

			$message->subject = "New follower request";
			$message->date = date("Y-m-d H:i:s");
			$message->save();

			DB::commit();
		}
		catch (Exception $e){

			DB::rollBack();

			$error = "error";
			return $error;
		}
	}


	public function getCancelUserFollowing(req $request)
	{
		$ln = $request["user_ln"];
		$user = User::where('linkname', $ln)->first();

		$watching = Watching::where('user1_id', $user->id)
							->where('user2_id', Auth::user()->id)
							->first();
		$watching->delete();

		return "";
	}

	public function getAcceptFollowing(req $request)
	{

		$ln = $request["user_ln"];
		$user = User::where('linkname', $ln)->first();

		$watching = Watching::where('user1_id', $user->id)
							->where('user2_id', Auth::user()->id)
							->first();

		$watching->approved = 1;
		$watching->website_id = config('app.website');
		$watching->save();

		return "";
	}

}

