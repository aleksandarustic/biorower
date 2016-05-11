<?php namespace App\Http\Controllers\Template;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\User;
use View;
use Auth;
use App\Watching;
use App\Session;
use Hashids\Hashids;
use Carbon;

use App\Library\GlobalFunctions;
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
//		$field = 'last_name';
//		$order = 'desc';
//
//		if ($request->has('sort')){
//			$field = $request['sort'];
//			$order = $request['order'];
//		}

//		$allUsers = User::orderBy($field, $order)->with('sessions')->paginate(2);

		//return $allUsers;

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

			$allWatching = array();
			$allWatched = array();
			$myWatching = array();

			$isApproved = false;
			$requestToFollowUserAlreadySent = false;
			$notSentRequest = false;

			$existInDatabase = Watching::where('user1_id', Auth::user()->id)
										  ->where('user2_id', $userid)
										  ->with('user2','user2.profile')
										  ->get();

			if (!$existInDatabase->isEmpty()){
				$founded = $existInDatabase->first();
				if ($founded->approved == 1){
			    	$isApproved = true;
				}
			    else if ($user->profile->privacy == 1){
			    	$requestToFollowUserAlreadySent = true;
			    }
			}
			else{
  			    if ($user->profile->privacy == 1){
					$notSentRequest = true;
				}
			}

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

			if ($user->profile->privacy != 1 || $isApproved){
				$allWatching = Watching::where('user1_id', $userid)
										->where('website_id', config('app.website'))
										->with('user2','user2.profile','user2.profile.image')->get();
				$allWatched = Watching::where('user2_id', $userid)
										->where('website_id', config('app.website'))				
										->with('user1','user1.profile','user1.profile.image')->get();

				$myWatching = Watching::where('user1_id', Auth::user()->id)->with('user2','user2.profile','user2.profile.image')->get();
			}
		}
		else{

			$imageid = Auth::user()->profile->image_id;
			$imageid = isset($imageid) ? $imageid : null;
			$userid = Auth::user()->id;
			$userLinkname = Auth::user()->linkname;

			$encodedID = $hashids->encode($userid);

			/* ne igra ulogu */
			$isApproved = true;
			$requestToFollowUserAlreadySent = true;
			$notSentRequest = true;
			/*****************/

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

			$allWatching = Watching::where('user1_id', Auth::user()->id)
									->where('website_id', config('app.website'))			
									->with('user2','user2.profile','user2.profile.image')->get();
			$allWatched = Watching::where('user2_id', Auth::user()->id)
									->where('website_id', config('app.website'))			
									->with('user1','user1.profile','user1.profile.image')->get();

			$myWatching = $allWatching;
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
		$totalStatisticsParameters = GlobalFunctions::GetHistoryStatistics("", "all", $firstDay, $userid, true);

    	return view('/template/overview', compact('imageid', 'isMyProfile', 'userid', 'allWatching', 'allWatched', 'myWatching', 'user', 'userLinkname', 'allSessions', 'isApproved', 'requestToFollowUserAlreadySent', 'notSentRequest', 'arrayHeatMap', 'encodedID', 'jsonChart', 'monday', 'sunday', 'firstDayOfYear', 'lastDayOfYear', 'sessionsHistory', 'parametersProgress', 'emptyChartsBoolHistory', 'emptyChartsDataHistory', 'emptyChartsBoolProgress', 'totalStatisticsParameters'));
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

		/*
		return '{
			"valuesModules": [
						{
				            "name": "Time",
				            "id": "Time",
				            "data": [4.9, 11.5, 33.4, 11.2, 144.0, 176.0, 135.6, 148.5, 22.4, 194.1, 95.6, 54.4]
				        },
						{
				            "name": "Distance",
				            "id": "Distance",
				            "data": [20, 3.5, 4.4, 5.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Power average",
				            "id": "Power average",
				            "data": [1, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Power Peak",
				            "id": "Power Peak",
				            "data": [3, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Number of strokes",
				            "id": "Number of strokes",
				            "data": [1, 1.5, 3.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Stroke rate average",
				            "id": "Stroke rate average",
				            "data": [9, 91.5, 13.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Stroke rate peak",
				            "id": "Stroke rate peak",
				            "data": [16, 81.5, 23.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Angle average",
				            "id": "Angle average",
				            "data": [89, 71.5, 23.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "Angle peak",
				            "id": "Angle peak",
				            "data": [49, 61.5, 33.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "HR average",
				            "id": "HR average",
				            "data": [19, 51.5, 43.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "HR peak",
				            "id": "HR peak",
				            "data": [69, 41.5, 43.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "2-mml level",
				            "id": "2-mml level",
				            "data": [59, 31.5, 53.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        },
						{
				            "name": "4-mml level",
				            "id": "4-mml level",
				            "data": [31, 21.5, 11.4, 1.2, 14.0, 17.0, 13.6, 18.5, 2.4, 19.1, 9.6, 5.4]
				        }
			    ],
			    "valuesBalancePower": [
							{
				            "name": "Left",
				            "data": [13, 2, 20, 347, 102, 364, 568,
				            	   12, 20, 20, 147, 102, 364, 568,
				            	   10, 20, 20, 147, 102, 364, 528]
				        }, {
				            "name": "Right",
				            "data": [4, 17, 111, 203, 321, 467, 1266,
				            	   23, 17, 111, 203, 321, 417, 1266,
				            	   11, 17, 111, 203, 321, 467, 1266]
				        }],
			    "valuesBalanceLeftAndRight": [
							{
				            "name": "Left",
				            "data": [70, 50, 190, 447, 1302, 2934, 6468,
				            	   70, 110, 190, 447, 1302, 2934, 6468,
				            	   70, 230, 190, 447, 1452, 2934, 6468]
				        }, {
				            "name": "Right",
				            "data": [18, 137, 111, 193, 281, 767, 1766,
				            	   18, 147, 111, 193, 281, 767, 1766,
				            	   18, 147, 111, 193, 281, 767, 1766]
				        }],
			    "valuesBalancePowerPeak": [
							{
				            "name": "Left",
				            "data": [50, 20, 250, 947, 1302, 3934, 5468,
				            	   50, 100, 210, 1047, 1302, 3934, 5468,
				            	   50, 200, 210, 1047, 1452, 3934, 5468]
				        }, {
				            "name": "Right",
				            "data": [36, 7, 131, 103, 221, 767, 1766,
				            	   36, 7, 131, 103, 221, 767, 1766,
				            	   36, 7, 131, 103, 221, 767, 1766]
				        }],
			    "valuesBalanceAnglePeak": [
							{
				            "name": "Left",
				            "data": [50, 20, 250, 947, 1302, 3934, 5468,
				            	   50, 100, 210, 1047, 1302, 3934, 5468,
				            	   50, 200, 210, 1047, 1452, 3934, 5468]
				        }, {
				            "name": "Right",
				            "data": [36, 7, 131, 103, 221, 767, 1766,
				            	   36, 7, 131, 103, 221, 767, 1766,
				            	   36, 7, 131, 103, 221, 767, 1766]
				        }]	
			}';
			*/
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
