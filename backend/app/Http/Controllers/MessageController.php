<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use App\Library\GlobalFunctions;
use Illuminate\Support\Facades\Response;

use Input;
use Auth;
use Exception;
use App\Message;
use App\Watching;

use Hashids\Hashids;

class MessageController extends Controller {

	public $primaryKey  = '_id';

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
		$messages = Message::with('sender')
				  	       ->where('receiver_user_id', '=', Auth::user()->id)
				  	       ->orderBy('date', 'DESC')
				  	       ->paginate(3);

		$allWatchedList = Watching::where('user2_id', Auth::user()->id)
								->where('website_id', config('app.website'))
								->leftJoin("users", "watching.user1_id", "=", "users.id")
								->select('users.display_name', 'users.first_name', 'users.last_name', 'users.id')
								->get();

		$listsWatchedList = array();
		foreach ($allWatchedList as $key => $value) {

			$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
			$encodedID = $hashids->encode($value["id"]);

			$name = $value["display_name"];

			if ($value["first_name"] !="" || $value["last_name"] !="")
			{
				$name = $name." (".$value["first_name"]." ".$value["last_name"].")";
			}

			$listsWatchedList = $listsWatchedList + array($encodedID => $name);
		}

		return view('/message/index', compact('messages', 'listsWatchedList'));
	}

	public function postSendMessage()
	{
		$message = new Message();
		$message->read = 0;
		$message->sender_user_id = Auth::user()->id;

		$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
		$decodedID = $hashids->decode(Input::get("receiver"));

		$message->receiver_user_id = $decodedID[0];
		$message->text = Input::get("message");
		$message->subject = Input::get("subject");
		$message->date = date("Y-m-d H:i:s");
		
		$message->save();

		return redirect('message/index');
	}

	public function getRead(req $request)
	{		
		$hashidsMessage = new Hashids(GlobalFunctions::getEncKeyForMessages());
		$decodedIDMessage = $hashidsMessage->decode($request["id_message"]);		

		$message = Message::where('id', $decodedIDMessage[0])->first();
		$message->read = 1;
		$message->save();

		return $message->text;
	}

	public function postDeleteMessages()
	{
		$arrayGet = Input::get('chkMessage');
		$arrayDecoded = array();

		foreach ($arrayGet as $key => $value) {
			$hashids = new Hashids(GlobalFunctions::getEncKeyForMessages());
			$decodedID = $hashids->decode($value);
			array_push($arrayDecoded, $decodedID);
		}

		$messages = Message::whereIn('id', $arrayDecoded)
							->where('receiver_user_id', Auth::user()->id)
							->delete(); 

		return redirect('message/index');
	}

	//postMarkAsRead

	public function postMarkAsRead()
	{
		$arrayGet = Input::get('chkMessage');
		$arrayDecoded = array();

		foreach ($arrayGet as $key => $value) {
			$hashids = new Hashids(GlobalFunctions::getEncKeyForMessages());
			$decodedID = $hashids->decode($value);
			array_push($arrayDecoded, $decodedID);
		}

		$messages = Message::whereIn('id', $arrayDecoded)
							->where('receiver_user_id', Auth::user()->id)		
							->update(array('read' => 1));

		return Response::json($arrayGet);
	}	

}

