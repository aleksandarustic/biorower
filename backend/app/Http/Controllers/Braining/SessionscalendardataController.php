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

class SessionscalendardataController extends Controller {

	public function store()
	{

	    $statusCode = 200;

		try{
			
	        $response = [
	          'account' => '',
	          'sessionIdsUTCs'  => '',
	        ];

	        $email = explode(":", Input::get("account"));

			$user = User::where('email', $email[1])->get();
			$userFirst = $user->first();

			if ($user->isEmpty()){
				$statusCode = 403;
			}
			else
			{

		        $type = Input::get("type");
		        $dateStart = Input::get("dateStart");
		        $dateEnd = Input::get("dateEnd");				

				$firstDay = new Carbon\Carbon($dateStart);
				if ($dateEnd != ""){
					$lastDay = new Carbon\Carbon($dateEnd);
				}
				else{
					switch ($type){
					    case ("day"):
					        $lastDay = $firstDay;
					        break;
					    case ("week"):
					    	$lastDay = clone $firstDay;
					        $lastDay->addDays(6);
					        break;
					    case ("month"):
					    	$lastDay = clone $firstDay;
					        $lastDay->addMonth();
							$lastDay->day = 0;
					        break;
					    case ("year"):
					    	$lastDay = clone $firstDay;
					        $lastDay->addYear();
					        break;
					}
				}

				$sessions = Session::where('user_id', $userFirst->id)
									->where('date', '<=', $lastDay)
									->where('date', '>=', $firstDay)								    
  						    	    ->get();

				$arrayIds = array();
				foreach ($sessions as $key => $value) {
					$tmp = array(
						"sessionID"  => $value["id"], 
						"DateTime"   => $value["date"],
						"Name"		 =>	$value["name"],
						"Description"=>	$value["description"],
						"duration"	 =>	gmdate(config('parameters.time.format'), $value->sessionSummary->time),
						"distance"	 =>	round($value->sessionSummary->distance, config('parameters.dist.format')),
						"power"		 =>	round($value->sessionSummary->power_average, config('parameters.pwr_avg.format')),
						"srate"		 => round($value->sessionSummary->stroke_rate_average, config('parameters.srate_avg.format')),
						"hr"		 =>	round($value->sessionSummary->heart_rate_average, config('parameters.hr_avg.format'))
						);
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

