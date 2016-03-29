<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Session;
use Exception;
use App\User;
use Input;
use Carbon;
use DB;
use App\Library\GlobalFunctions;

class HistorystatisticsController extends Controller {

	public function store()
	{

	    $statusCode = 200;

		try{
			
	        $response = [
	          'account' => '',
	          'historydata'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

			$user = User::where('email', $email[1])->get();
			$userFirst = $user->first();

			if ($user->isEmpty()){
				$statusCode = 403;
			}
			else
			{
				$groupType = "";
				if (Input::get("groupType") != ""){
		        	$groupType = Input::get("groupType");
				}

		        $rangeType = Input::get("rangeType");
		        $dateStart = Input::get("dateStart");

		        $results = GlobalFunctions::GetHistoryStatistics($groupType, $rangeType, $dateStart, $userFirst->id);

		        $response = [
		          'account' => Input::get("account"),
		          'historydata'  => $results,
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

