<?php namespace App\Http\Controllers\User;

use App\Country;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use File;
use App\Http\Controllers\Controller;
use App\User;
use App\Profile;
use View;
use Input;
use DB;
use Auth;
use Exception;
use URL;
use App\Image as Img;
use App\Message;
use App\Library\GlobalFunctions;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\URL;

use Image as Images;


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

	public function postSearchUsersAjax(req $request) 
	{
		$statusCode = 204;
		if (Request::ajax() ){

			$search_name = $request->getContent();
			$search_name = explode('=', $search_name);
			$keyword = $search_name[1];
			//$res     = explode('+', $keyword);
			
			$users 	= 	User::where("activated", "=", "1")
						->where(function ($query) use ($keyword) {
                			$query->where("first_name", "LIKE","%$keyword%")
                    			->orWhere("last_name", "LIKE", "%$keyword%")
                   				->orWhere("display_name", "LIKE", "%$keyword%")
                   				->orWhereRaw("concat(first_name, '+', last_name) like '%$keyword%' ");

            				})
			  			->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
						->join('images', 'image_id', '=', 'images.id')
						->select('users.first_name', 'users.last_name', 'users.display_name', 'users.id', 'images.name')
						->get();

			$statusCode = 200;
		}
		//$partialView = View::make('/user/_users-search-results')->with('users', $result)->render();
        return Response::json($users);      
	}

	public function getEdit()
	{
        $user3	=	Auth::User();         
		$user 	= 	User::where('id', $user3['id'])->with('profile.image')->first();

		$countries = Country::all();

		return view('/user/edit', compact('user', 'countries'));
	}


	// Update avatar
	public function UpdateUserAvatar(req $request){

		$validator = Validator::make($request->all(), [
			'avatar'   	=> 'required|image|mimes:jpeg,jpg,png|max:3000',
		]);

		if($validator->fails()){
				return back()
				->withErrors($validator->errors());		
		}else{
		// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$user 		= Auth::user();
    		$profile 	= Auth::user()->profile;

    		$avatar 	= $request->file('avatar');
    		$filename 	= time() . '.' . $avatar->getClientOriginalExtension();

    		// Provera da li korisnik ima svoj folder, ukoliko nema napravi ga
    		File::exists(public_path('/profile_images/'.$user->id)) or File::makeDirectory(public_path('/profile_images/'.$user->id));
    		// Sacuvaj sliku u korisnikov folder i resize je na 300x300 
    		Images::make($avatar)->resize(300, 300)->save( public_path('/profile_images/'.$user->id.'/avatar_'. $filename ) );

    		$image 		 = new Img();
    		$image->name = '/profile_images/'.$user->id.'/avatar_'. $filename;
    		$image->save();

    		// provera da li korisnik ima vec sliku, ukoliko ima obrisi iz tabele images
    		if($profile->image_id > 1 ){  
				Img::destroy($profile->image_id );
    		}

    		$profile->image_id = $image->id;
    		$profile->save();
    		return redirect('/profile/edit')->with('status-success', 'You have successfully changed your avatar .');
    	}
    	return redirect('/profile/edit')->with('status', 'An error has occurred. Please try again .');
    	}	
	}

}

