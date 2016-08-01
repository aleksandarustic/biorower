<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Session;
use Exception;
use App\User;
use Input;

class EditSessionController extends Controller {

	public function store()
	{

	    $statusCode = 200;

		try{
	        $response = [
	          'response'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

	        if ($email[0] == "twitter"){
	        	$user = User::where('twitter_id', $email[1])->get();
	        }
	        else if ($email[0] == "facebook"){
	        	$user = User::where('facebook_id', $email[1])->get();
			}	        
	        else{
				$user = User::where('email', $email[1])->get();
			}

			if ($user->isEmpty()){
			    throw new Exception;
			}

	        $id = Input::get("id");
	        $name=Input::get("name");
	        $comment=Input::get("comment");
			$userFirst = $user->first();

			if ($user->isEmpty()){
				$statusCode = 403;
			}
			else
			{



				       Session::where('user_id', $userFirst->id)
								   ->where('id', $id)
						    	   ->update(array('name' => $name));
			$comment2 = Comment::where('user_id', $userFirst->id)
								->where('session_id', $id)->first();

			if ($comment2 != null) {
			   $user = Comment::where('user_id', $userFirst->id)
								->where('session_id', $id)->update(array('text' => $comment));
			}						
			if ($comment2 === null) {
			   $user = Comment::create(array('user_id' => $userFirst->id,'session_id'=>$id,'text'=>$comment));
			}






		        $response = [
		          'response' => 'ok',
		        ];
	    	}
	    
	 	}
	 	catch (Exception $e)
	    {
    		$statusCode = 400;
        }

		return Response::json($response, $statusCode);
	}

}

