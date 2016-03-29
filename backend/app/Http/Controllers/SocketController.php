<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use LRedis;
 
class SocketController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	public function socket()
	{
		return view('/socket/index');
	}
	public function writemessage()
	{
		return view('/socket/writemessage');
	}
	public function sendMessage(){
		$redis = LRedis::connection();
		$redis->publish('message1', Request::input('message'));
		return redirect('writemessage');
	}

}
