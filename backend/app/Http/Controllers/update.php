<?php namespace App\Http\Controllers;

use DB;
use Mail;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Hash;

class update extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	public function update(Request $request)
	{
		if (Auth::check())
		{

         $id = Auth::id();
         $korisnik=Auth::User();
         $profile_id=$korisnik->profile_id;
         $profile= Profile::where('id',$profile_id)->first();


         $displayname=$request->input('display_name');
		 $firstname=$request->input('first_name');
		 $lastname=$request->input('last_name');
		 $aboutme=$request->input('about_me');
		 $languages=$request->input('dic_languages_id');
		 $dateofbirth=$request->input('date_of_birth');
		 $gender=$request->input('gender');
		 $phone=$request->input('phone');
		 $mobile=$request->input('mobile');
		 $line1=$request->input('line1');
		 $line2=$request->input('line2');
		 $city=$request->input('city');
		 $zip=$request->input('zip');
		 $website=$request->input('website');
		 $contry=$request->input('dic_country_id');
		 $dic_user_type_id=$request->input('dic_user_type_id');
		 $email=$request->input('email');
		 $notify_me_on_comment=$request->input('notify_me_on_comment');
		 $notify_me_on_new_session=$request->input('notify_me_on_new_session');
		 $notify_me_on_new_watcher=$request->input('notify_me_on_new_watcher');
		 $send_session_summary=$request->input('send_session_summary');
		 $email_summary_alternative=$request->input('email_summary_alternative');
		 $send_session_summary_alternate=$request->input('send_session_summary_alternate');
		 $privacy=$request->input('privacy');
	
                 $niz=array('first_name'=>$firstname,
                     'last_name'=>$lastname,
                     'display_name'=>$displayname,
                     'email'=>$email);

                 $niz2=array('about_me'=>$aboutme,
                     'dic_languages_id'=>$languages,
                     'date_of_birth'=>$dateofbirth,
                     'gender'=>$gender,
                     'phone'=>$phone,
                     'mobile'=>$mobile,
                     'line1'=>$line1,
                     'line2'=>$line2,
                     'city'=>$city,
                     'zip'=>$zip,
                     'website'=>$website,
                     'dic_country_id'=>$contry,
                     'dic_user_type_id'=>$dic_user_type_id,
                     'notify_me_on_comment'=>$notify_me_on_comment,
                     'notify_me_on_new_session'=>$notify_me_on_new_session,
                     'notify_me_on_new_watcher'=>$notify_me_on_new_watcher,
                     'send_session_summary'=>$send_session_summary,
                     'email_summary_alternative'=>$email_summary_alternative,
                     'send_session_summary_alternate'=>$send_session_summary_alternate,
                     'privacy'=>$privacy);

            $potvrda  	= User::where("id", $id)->update($niz);
		 	$potvrda2 	= Profile::where("id", $profile_id)->update($niz2);
		 
			
			 return redirect('/profile/edit')->with('status-success', 'You have successfully saved your changes.');
		}
		else{
			return redirect('/')->with('status', 'An error has occurred. Please try again .');
		}
			
	}

	// PROMENA SIFRE PREKO SETTINGS STRANE!
	public function ChangePassword(Request $request){
		
		if (Auth::check()){
			  	$id 			= 	Auth::id();
         	  	$user			=	Auth::User();

         	  	$validator 		= 	Validator::make($request->all(), [
									'password'   				=> 'required|min:6|confirmed',
									'password_confirmation'   	=> 'required|min:6',
									]);
        // PROVERA TRENUTNE SIFRE 	  	
        if(Hash::check($request->input('old_password'), $user->password))
        {

		if($validator->fails()){ // Provera novih sifri
				return Redirect::to(URL::previous() . "#change-pass")
				->withErrors($validator->errors());
		}
			$user->password = bcrypt($request->input('password'));

			if($user->save()){ // sacuvaj novu sifru ukoliko je sve u redu
				return redirect('/profile/edit')->with('status-success', 'You have successfully changed your password.');
			}

		}else{ // ukoliko nije ispravna trenutna sifra 
			return redirect('/profile/edit')->with('status', 'You have entered the wrong current password.');
		}

		}else{
			return redirect('/');
		}

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
