<?php namespace App\Http\Controllers\Template;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Auth;
use App\Library\GlobalFunctions;
use App\Http\Controllers\User\ProfileController;
use App\User;
use View;

use App\Watching;
use App\Session;
use Hashids\Hashids;
use Carbon;


use Input;
use Closure;

class TemplateController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		return view('/template/index');
	}

	public function overview()
	{
		$isMyProfile = false;
		$user = null;

		$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());

		//return date('d - m - Y', strtotime("previous monday"));
		//strtotime( "previous monday" );

		$monday = date('d-m-Y', strtotime("this week"));
		$sunday = date('d-m-Y', strtotime($monday . " +6 days"));

		$firstDayOfYear	= date('d-m-Y',strtotime(date('Y-01-01')));
		$lastDayOfYear	= date('d-m-Y',strtotime(date('Y-12-31')));

		if (Auth::user()){

			$user = User::where('linkname', Auth::user()->linkname)->with('profile.image')->first();
			$imageid = isset($user->profile->image_id) ? $user->profile->image_id : null;
			$userid = $user->id;
			$userLinkname = $user->linkname;

			$encodedID = $hashids->encode($userid);

			$sessionsHistory = GlobalFunctions::GetHistoryStatistics("", "week", $monday, $userid);

	    	$firstDayOfYearTemp = Carbon\Carbon::createFromDate(date("Y"), 1, 1);
			$parametersProgress = GlobalFunctions::GetHistoryStatistics("week", "year", $firstDayOfYearTemp, $userid);

			$arrayHeatMap = array();
			/*
			foreach ($sessionsHistory as $key => $value) {
				$arrayHeatMap = $arrayHeatMap + array(strtotime($value['date']) => $value["user_id"]);
			}
			*/

			$arrayHeatMap = str_replace('"', "\"", json_encode($arrayHeatMap, JSON_HEX_APOS));

		}else{

			$imageid = Auth::user()->profile->image_id;
			$imageid = isset($imageid) ? $imageid : null;
			$userid = Auth::user()->id;
			$userLinkname = Auth::user()->linkname;

			$encodedID = $hashids->encode($userid);

			//$sessionsHistory = GlobalFunctions::GetHistoryStatistics("", "week", $monday, Auth::user()->id);

			$sessionsHistory = GlobalFunctions::GetHistoryStatistics("", "week", $monday, $userid);

	    	$firstDayOfYearTemp = Carbon\Carbon::createFromDate(date("Y"), 1, 1); //"2014" //date("Y")
			$parametersProgress = GlobalFunctions::GetHistoryStatistics("week", "year", $firstDayOfYearTemp, $userid);

			/*
			$sessions = Session::where('user_id', Auth::user()->id)
							   ->where('deleted', 0)
							   ->select('date','user_id')
							   ->get(); //$monday //$sunday
			*/
			$arrayHeatMap = array();
			/*
			foreach ($sessionsHistory as $key => $value) {
				$arrayHeatMap = $arrayHeatMap + array(strtotime($value['date']) => $value["user_id"]);
			}
			*/

			$arrayHeatMap = str_replace('"', "\"", json_encode($arrayHeatMap, JSON_HEX_APOS));

		}

		if ($userid == Auth::user()->id){
			$isMyProfile = true;
		}

		//$partialView = View::make('/template/_users-pagination')->with('allUsers', $allUsers)->with('userLinkname', $userLinkname)->render();
		//zbog optimizacije salju se prazni podaci da bi se napunili grafovi (series)

		$emptyChartsBoolHistory = false;
		if (empty($sessionsHistory)){
			$sessionsHistory = GlobalFunctions::getEmptyDataHistory();	
			$emptyChartsBoolHistory = true;
		}

		$emptyChartsBoolProgress = false;
		if (empty($parametersProgress)){
			$parametersProgress = [];
			$emptyChartsBoolProgress = true;
		}

		$emptyChartsDataHistory = GlobalFunctions::getEmptyDataHistory();

		//return 	json_encode($sessionsHistory;

		$allSessions = Session::where("user_id", $userid)
							   ->where('deleted', 0)
							   ->orderBy('id', 'desc')
							   ->take(5)
							   ->get();

		$jsonChart = Session::orderBy('id', 'desc') //where("user_id", $userid)
							->select('data')->take(1)->get()->first();
		$jsonChart = json_encode($jsonChart["data"]);

		$firstDay = Carbon\Carbon::createFromDate(1970, 1, 1);

		$friends  	= ProfileController::UserProfileFriends($userid);

		$totalStatisticsParameters = GlobalFunctions::GetTotalStatistics($userid);

    	return view('/template/overview', compact('imageid', 'isMyProfile', 'userid', 'user', 'userLinkname', 'allSessions', 'arrayHeatMap', 'encodedID', 'jsonChart', 'monday', 'sunday', 'firstDayOfYear', 'lastDayOfYear', 'sessionsHistory', 'parametersProgress', 'emptyChartsBoolHistory', 'emptyChartsDataHistory', 'emptyChartsBoolProgress', 'totalStatisticsParameters', 'friends'));
        //}
	}

	public function getGetStatistics(req $request)
	{
		$date1 = $request["start_date"];
		$date2 = $request["stop_date"];

		$dateStart = new Carbon\Carbon($date1);
		//$lastDay = new Carbon\Carbon($date2);
		/*
		if ($firstDay == $lastDay){
			$lastDay = $lastDay->addDay();
		}
		*/
		//return $firstDay."-".$lastDay;
		/*
		$sessions = Session::where('date', '<=', $lastDay)
							->where('date', '>=', $firstDay)
							->where('deleted', 0)
							->where('user_id', Auth::user()->id)->get();
		*/
        $rangeType = Input::get("rangeType");
        $groupType = Input::get("groupType"); //"week";

		$results = GlobalFunctions::GetHistoryStatistics($groupType, $rangeType, $dateStart, Auth::user()->id);

		return json_encode($results);

	}


	public function getGetProgress(req $request)
	{
		$date1 = $request["start_date"];
		$date2 = $request["stop_date"];

		$firstDay = new Carbon\Carbon($date1);
		$lastDay = new Carbon\Carbon($date2);

		if ($firstDay == $lastDay){
			$lastDay = $lastDay->addDay();
		}

		//return $firstDay."-".$lastDay;
		$sessions = Session::where('date', '<=', $lastDay)
							->where('date', '>=', $firstDay)
							->where('deleted', 0)
							->where('user_id', Auth::user()->id)->get();

		return '{"valuesModules": [
						{
				            "name": "Tokyo",
				            "id": "Tokyo",
				            "data": [21.9, 31.5, 39.4, 11.2, 14.0, 17.0, 15.6, 14.5, 2.4, 14.1, 9.6, 154.4]
				        },
						{
				            "name": "New York",
				            "id": "New York",
				            "data": [2, 11.5, 34.4, 14.2, 1.0, 1.0, 1.6, 1.5, 21.4, 119.1, 94.6, 51.4]
				        },
						{
				            "name": "London",
				            "id": "London",
				            "data": [34, 15.5, 35.4, 15.2, 15.0, 157.0, 123.6, 118.5, 32.4, 1.1, 19.6, 45.4]
				        },
						{
				            "name": "Berlin",
				            "id": "Berlin",
				            "data": [4, 5.5, 5.4, 1.2, 1.0, 117.0, 12.6, 318.5, 3.4, 134.1, 119.6, 15.4]
				        }				        
				        ]				        
			}';
	}
	
}
