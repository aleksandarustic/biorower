<?php namespace App\Http\Controllers\Braining;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\User;
use App\Profile;
use App\Firmware;
use Exception;
use Auth;
use Validator;

use App\Session;

class FirmwareController extends Controller {

	public function index()
	{

		try{
			
	        $statusCode = 200;
	        $response = [
	          'authenticationToken'  => ''
	        ];



	        /*
			$user = User::where('email', $email)->get();

			if (!$user->isEmpty()){
			    throw new Exception;
			}

			$profile = new Profile();
			$profile->save();

	 		$user = new User();
	 		$user->profile_id = $profile->id;
	 		$user->email = $email;
	 		$user->password = bcrypt($password);

	 		$token = bin2hex(openssl_random_pseudo_bytes(16));
			$user->auth_token = $token;
	 		$user->save();

	        $response = [
	          'authenticationToken'  => $user->auth_token
	        ];
	        */


	        /*
	        $email = 'bojanproba81@gmail.com';
	        $password = 'test1231';	        

	        $statusCode = 201;
	        $response = [
	          'authenticationToken'  => '',
	          'account'  => '',
	        ];

			$user = User::where('auth_token', '8c4adf2b8b991af9e30aa28d2b4c38f3')->get();

			if ($user->isEmpty()){
			    throw new Exception;
			}

	        $response = [
	          'authenticationToken'  => $user->first()->auth_token,
	          'account'  => $user->first()->email,
	        ];
	        */	 


	        /*
			if (Auth::attempt(array('email' => $email, 'password' => $password)))
			{
				$token = bin2hex(openssl_random_pseudo_bytes(16));
				$user = User::where('email', $email)->first();

				$token = bin2hex(openssl_random_pseudo_bytes(16));
				$user->auth_token = $token;
		 		$user->save();				
			}			
			else{
				throw new Exception;
			}
			*/
	 
	 		/*
	        $photos = Photo::all()->take(9);
	 
	        foreach($photos as $photo){

	            $response['photos'][] = [
	                'id' => $photo->id,
	                'user_id' => $photo->user_id,
	                'url' => $photo->url,
	                'title' => $photo->title,
	                'description' => $photo->description,
	                'category' => $photo->category,
	            ];
        	}
        	*/


		        $statusCode = 200;
		        $response = [
		          'sessionId'  => '',
		          'packetsReceived'  => '',
		        ];

		        $account = "retro981@yahoo.com";
		        $data = "aaaaaa";

				$user = User::where('email', $account)->get();

				if ($user->isEmpty()){
				    throw new Exception;
				}

				$session = new Session();
				$session->user_id = $user->first()->id;
				$session->data = $data;

				$session->save();

				/*
					$session->data_version = Input::get("dataVersion");
					$session->serial_number = Input::get("serialNumber");
					$session->firmware_version = Input::get("firmwareVersion");
					$session->start_date = Input::get("startDate");
				*/
				//jos neki podaci ...

		        $response = [
		          'sessionId'  => $user->first()->authToken,
		          'packetsReceived'  => '', //koliko vec
		        ];

	 	
	 	}
	 	catch (Exception $e)
	    {
	        $statusCode = 400;
	    }

		return Response::json($response, $statusCode);

	}


	public function upload(Request $request) {
		$succCode = 200;
		$failCode = 400;
		$data = $request->json()->all();
		$validator = Validator::make($data, [
            'deviceTypeID' => 'required|integer',
            'version' => 'required|integer',
            'versionText' => 'string',
            'data' => 'required|string|max:1000000', //Base64 encode will increase the data size by around 33%
        ]);
        if ($validator->fails()) {
        	return Response::json(['code'=>$failCode, 'error'=>$validator->errors()->all()[0]]); // print the error in develop period
        }

        $firmware = Firmware::firstOrNew(['device_type_id' => $data['deviceTypeID']]);
        $firmware->version = $data['version'];
        $firmware->version_text = $data['versionText'];
        $firmware->data = $data['data'];
        $rs = $firmware->save();
        if (!$rs) {
        	return Response::json(['code'=>$failCode, 'error'=>'system error']);
        } else {
        	return Response::json(['code'=>$succCode]);
        }
	}

	public function getVersion(Request $request) {
		$succCode = 200;
		$failCode = 400;
		$data = $request->json()->all();
		$validator = Validator::make($data, [
            'deviceTypeID' => 'required|integer',
        ]);
        if ($validator->fails()) {
        	return Response::json(['code'=>$failCode, 'error'=>$validator->errors()->all()[0]]);
        }

        $firmware = Firmware::where(['device_type_id' => $data['deviceTypeID']])->first(['device_type_id', 'version', 'version_text']);
        if (!$firmware) {
        	return Response::json(['code'=>$failCode, 'error'=>'record is not exists']);
        }
        return Response::json(['code'=>$succCode, 'version'=>$firmware->version, 'versionText'=>$firmware->version_text]);
	}

	public function download(Request $request) {
		$succCode = 200;
		$failCode = 400;
		$data = $request->json()->all();
		$validator = Validator::make($data, [
            'deviceTypeID' => 'required|integer',
        ]);
        if ($validator->fails()) {
        	return Response::json(['code'=>$failCode, 'error'=>$validator->errors()->all()[0]]);
        }

        $firmware = Firmware::where(['device_type_id' => $data['deviceTypeID']])->first();
        if (!$firmware) {
        	return Response::json(['code'=>$failCode, 'error'=>'record is not exists']);
        }
        return Response::json([
        	'code'=>$succCode, 
        	'deviceTypeId'=>$firmware->device_type_id, 
        	'version'=>$firmware->version, 
        	'versionText'=>$firmware->version_text,
        	'data'=>$firmware->data, 
        ]);	
	}

	public function downloadAll()
	{
		$failCode = 400;
		$results = Firmware::select('device_type_id', 'version', 'version_text', 'updated_at')->get();

        if (!$results) {
        	return Response::json(['code'=>$failCode, 'error'=>'An error has occurred']);
        }else{
         	
         	$firmwares = array();
        	foreach($results as $res){
        		$result = array();
        		$result['deviceTypeID'] 	=  $res->device_type_id;
        		$result['version'] 		=  $res->version;
        		$result['versionText']	=  $res->version_text;
        		$result['date'] 			=  $res->api_date;

        		array_push($firmwares, $result);
        	}

        	$response = [
             'firmwares'  => $firmwares,
           ];

        	return Response::json($response);	
		}
	}


}
