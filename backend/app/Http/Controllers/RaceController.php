<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Hashids\Hashids;
use Illuminate\Http\Request as req;
use App\Library\GlobalFunctions;
use Illuminate\Support\Facades\Response;

use View;
use App\Race;
use Input;
use Auth;
use App\Watching;
use App\UsersRaces;
use App\User;
use LRedis;
use Exception;
use Mail;
use App\Message;

class RaceController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth'); //['except' => ['apiDocs', 'dataVersion', 'changeLog']]
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$races = Race::leftJoin('users_races', 'id', '=', 'users_races.race_id')
				  ->where('date', '>=', date("Y-m-d H:i:s"))
				  ->where('users_races.user_id', '=', Auth::user()->id)
				  ->get();

		$partialTableRequest = View::make('/race/_races_table')
							->with('races', $races)
							->with('type', 'request')
							->render();

		$partialTableAccepted = View::make('/race/_races_table')
							->with('races', $races)
							->with('type', 'accepted')
							->render();

		return view('/race/index', compact('partialTableRequest', 'partialTableAccepted'));
	}

	public function postAdd()
	{
		//transakcija

		$race = new Race();
		$race->date = date("Y-m-d H:i:s");
		$race->name = Input::get("name");
		$race->save();

		$usersraces = new UsersRaces();
		$usersraces->race_id = $race->id;
		$usersraces->user_id = Auth::user()->id;
		$usersraces->save();		

		return redirect('/race/index');
	}

	public function getAddUserToRace(req $request)
	{

		$hashidsRace = new Hashids(GlobalFunctions::getEncKeyRaceId());
		$decodedIDRace = $hashidsRace->decode($request["id_race"]);

		$hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
		$decodedIDUser = $hashidsUser->decode($request["id_user"]);

		$usersraces = new UsersRaces();
		$usersraces->race_id = $decodedIDRace[0];
		$usersraces->user_id = $decodedIDUser[0];
		$usersraces->save();

		return "";

	}

	public function getDeleteUserFromRace(req $request)
	{


		$hashidsRace = new Hashids(GlobalFunctions::getEncKeyRaceId());
		$decodedIDRace = $hashidsRace->decode($request["id_race"]);

		$hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
		$decodedIDUser = $hashidsUser->decode($request["id_user"]);

		$usersraces = UsersRaces::where('race_id', $decodedIDRace[0])
								 ->where('user_id', $decodedIDUser[0])
								 ->delete();

		return "";
	}


	public function getLive(req $request)
	{

		$hashids = new Hashids(GlobalFunctions::getEncKeyRaceId());
		$decodedID = $hashids->decode($request["id"]);
		$addedUsersInRace = UsersRaces::where('race_id', $decodedID[0])
							->with('user','user.profile','user.profile.image')
							->orderBy('race_id')
							->get();

		$idsAddedUsers = array();
		foreach ($addedUsersInRace as $key => $value){
			array_push($idsAddedUsers, $value["user_id"]);
		}

		$initiatorID = $addedUsersInRace[0]->user->id;
		$isInitiator = false;
		if ($initiatorID == Auth::user()->id)
		{
			$isInitiator = true;
		}

		$allWatchedList = Watching::where('user2_id', Auth::user()->id)
								->where('website_id', config('app.website'))		
								->leftJoin("users", "watching.user1_id", "=", "users.id")
								->select('users.display_name', 'users.id')
								->get();
		$listsWatchedList = array();
		foreach ($allWatchedList as $key => $value) {
			if (!in_array($value["id"],$idsAddedUsers)){
				
				$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
				$decodedID = $hashids->encode($value["id"]);			

				$listsWatchedList = $listsWatchedList + array($decodedID => $value["display_name"]);
			}
		}

		return view('/race/live', compact('listsWatchedList', 'addedUsersInRace', 'isInitiator'));
	}

	public function getAjaxData1(req $request)
	{
		
		// Set the JSON header
		header("Content-type: text/json");

		// The x value is the current JavaScript time, which is the Unix time multiplied 
		// by 1000.
		$x = time() * 1000;
		// The y value is a random number
		$y = rand(0, 100);

		// Create a PHP array and echo it as JSON
		$ret = array($x, $y);

		$redis = LRedis::connection();
		$arrayJson = array();

		$hashidsUserID = new Hashids(GlobalFunctions::getEncKeyUserId());
		$encodedUserID = $hashidsUserID->encode(Auth::user()->id);

		array_push($arrayJson, array('"user"' => $encodedUserID) + array('"data"' => $ret) + array('"room"' => $request["id_race"]));
		//array_push($arrayJson, $ret);
		$redis->publish('message1', json_encode($arrayJson));
		//echo json_encode($ret);
	}

	public function postSearchUsersRaceAjax() 
	{
		if (Input::get('search_name') != ""){

			$result = User::with('profile')
					  ->where('first_name', 'LIKE', '%' . Input::get('search_name') . '%')
					  ->orWhere('last_name', 'LIKE', '%' . Input::get('search_name') . '%')
					  ->leftJoin('profiles', 'profile_id', '=', 'profiles.id')
					  //->where('profiles.privacy', '=', 1)
					  ->with('profile.image')
					  ->paginate(5);

			//$result = $usersFirst->merge($usersLast);
			//$result = $result->paginate(5);
		}
		else{
			$result = User::paginate(5);
			//$result = $result->paginate(5);
		}

		$partialView = View::make('/race/_users-race-search-results')
							->with('users', $result)
							->render();

        return Response::json($partialView);
	}

	public function getSendRequestForRace(req $request)
	{
		try
		{
			$hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
			$decodedIDUser = $hashidsUser->decode($request["id_user"]);

			$hashidsRace = new Hashids(GlobalFunctions::getEncKeyRaceId());
			$decodedIDRace = $hashidsRace->decode($request["id_race"]);

			$newUserInRace = new UsersRaces();
			$newUserInRace->race_id = $decodedIDRace[0];
			$newUserInRace->user_id = $decodedIDUser[0];
			$newUserInRace->accepted = 0;
			$newUserInRace->save();

			$user = User::where('id', $decodedIDUser[0])->first();

			$recipient = array();
			array_push($recipient, $user->email);
			array_push($recipient, $user->first_name);
			array_push($recipient, $user->last_name);

			$senderDisplayName = Auth::user()->display_name;				
			$senderFirstName = Auth::user()->first_name;
			$senderLastName = Auth::user()->last_name;

			$linkAccept = Request::root()."/race/acceptrequest?id1=".$request["id_user"]."&id2=".$request["id_race"];


			$race = Race::where('id', $decodedIDRace[0])->first();


			if (strpos($user->email, '@btemp.com') == false){
				Mail::send('emails.new_request_for_race', ['linkAccept' => $linkAccept, 'senderDisplayName' => $senderDisplayName, 'senderFirstName' => $senderFirstName, 'senderLastName' => $senderLastName, 'raceTime' => $race->date], function($message) use ($recipient)
				{
					$name = $recipient[1]." ".$recipient[2];
				    $message->to($recipient[0], $name)->subject('New request for race');
				});
			}

			$message = new Message();
			$message->sender_user_id = Auth::user()->id;
			$message->receiver_user_id = $decodedIDUser[0];
			$message->subject = "New request for race";
			$message->date = date("Y-m-d H:i:s");
			$name = "";
			if ($senderFirstName !="" || $senderLastName !=""){
				$name = "(".$senderFirstName." ".$senderLastName.")";
			}
			$message->text = "User ".$senderDisplayName." ".$name." send you request for race with starting time at ".$race->date.". You can accept request on the following link: <a class='btn btn-default' href='".$linkAccept."' >Accept</a>";
			$message->save();
		}

		catch (Exception $e){
			$error = "error";
			return $e;
		}
	}

	public function getAcceptrequest(req $request)
	{
		
		try{
			$hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
			$decodedIDUser = $hashidsUser->decode($request["id1"]);

			$hashidsRace = new Hashids(GlobalFunctions::getEncKeyRaceId());
			$decodedIDRace = $hashidsRace->decode($request["id2"]);

			if (Auth::user()->id == $decodedIDUser[0]){
				$usersraces = UsersRaces::where('user_id', $decodedIDUser[0])
									->where('race_id', $decodedIDRace[0])
									->update(['accepted' => 1]);
			}
		}
		catch (Exception $e){
			$error = "error";
			return $e;
		}

		if (isset($request["page"]) && $request["page"] == 'index'){
			return redirect('race/index');
		}

		return view('/race/success_race_add');

	}

	public function getCancelrequest(req $request)
	{

		try{
			$hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
			$decodedIDUser = $hashidsUser->decode($request["id1"]);

			$hashidsRace = new Hashids(GlobalFunctions::getEncKeyRaceId());
			$decodedIDRace = $hashidsRace->decode($request["id2"]);

			if (Auth::user()->id == $decodedIDUser[0]){
				$usersrace = UsersRaces::where('user_id', $decodedIDUser[0])
									->where('race_id', $decodedIDRace[0])
									->delete();
			}
		}
		catch (Exception $e){
			$error = "error";
			return $e;
		}

		return redirect('race/index');
	}

	public function getArchive()
	{
		$races = Race::leftJoin('users_races', 'id', '=', 'users_races.race_id')
				  ->where('date', '<=', date("Y-m-d H:i:s"))
				  ->where('accepted', '=', 1)
				  ->where('users_races.user_id', '=', Auth::user()->id)
				  ->get();

		$partialTableArchive = View::make('/race/_races_table')
							   ->with('races', $races)
							   ->with('type', 'archive')
							   ->render();

		return view('/race/archive', compact('partialTableArchive'));
	}

}
