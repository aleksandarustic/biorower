<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Session;
use Exception;
use App\User;
use Input;

class RecentshortdatasessionsController extends Controller {

	public function store()
	{

	    $statusCode = 200;

		try{

	        $response = [
	          'account' => '',
	          'sessionIdsUTCs'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

	        $n = Input::get("N");
	        $id = Input::get("id");

			$user = User::where('email', $email[1])->get();
			$userFirst = $user->first();

			if ($user->isEmpty()){
				$statusCode = 403;
			}
			else 
			{
				if ($id == 0){
					$sessions = Session::where('user_id', $userFirst->id)
									   ->orderBy('id', 'DESC')
									   ->take($n)
							    	   ->get();
				}
				else{
					$sessions = Session::where('user_id', $userFirst->id)
									   ->where('id', '<', $id)
									   ->orderBy('id', 'DESC')
									   ->take($n)
							    	   ->get();
				}

				$arrayIds = array();
				foreach ($sessions as $key => $value) {
					$tmp = array("sessionID" => $value["id"], "DateTime" => $value["date"]);
					array_push($arrayIds, $tmp);
				}

		        $response = [
		          'account' => Input::get("account"),
		          'sessionIdsUTCs'  => $arrayIds,
		        ];
	    	}

	 	}
	 	catch (Exception $e)
	    {
    		$statusCode = 400;
        }

        /*
			{"sessionIdsUTCs":[{"sessionID":23},{"UTC":2147483647}]}
        */

		return Response::json($response, $statusCode);

	}

}

