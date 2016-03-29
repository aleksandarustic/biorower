<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	//'template' => 'Template\TemplateController',
	'user' => 'User\UserController',
	'home' => 'HomeController',
	'race' => 'RaceController',
	'message' => 'MessageController',
	//'/api/braining' =>'BrainingController',
]);

Route::group(array('prefix' => 'api'), function()
{
	Route::resource('v1/users', 'Braining\UsersController',
					['only' => ['store']]); //, 'names' => ['store' => 'api.braining.users.registration', 'update' => 'api.braining.users.login']]

	Route::resource('v1/adduser', 'Braining\AddUserController',
					['only' => ['store']]);

	Route::resource('v1/auths', 'Braining\AuthsController',
					['only' => ['store']]); //, 'names' => ['store' => 'api.braining.auths.auths']]

	Route::resource('v1/sessions_upload', 'Braining\SessionsController',
					['only' => ['store']]); //, 'names' => ['update' => 'api.braining.sessions.sessions']]

	Route::resource('v1/status', 'Braining\StatusController',
					['only' => ['store']]); //'names' => ['store' => 'api.braining.status.status']

	Route::resource('v1/reset', 'Braining\ResetController',
					['only' => ['store']]); //, 'names' => ['store' => 'api.braining.reset.reset']]

	Route::resource('v1/firmware', 'Braining\FirmwareController',
					['only' => ['index']]); //'names' => ['index' => 'api.braining.firmware.firmware']]

	Route::resource('v1/sessions_recent', 'Braining\RecentsessionsController',
					['only' => ['store']]);

	Route::resource('v1/sessions_get', 'Braining\GetsessionsController',
					['only' => ['store']]);

	Route::resource('v1/sessions_short_data', 'Braining\RecentshortdatasessionsController',
					['only' => ['store']]);

	Route::resource('v1/delete_session', 'Braining\DeletesessionController',
					['only' => ['store']]);	

	Route::resource('v1/sessions_calendar_data', 'Braining\SessionscalendardataController',
					['only' => ['store']]);

	Route::resource('v1/sessions_total_statistics', 'Braining\TotalstatisticsController',
					['only' => ['store']]);	

	Route::resource('v1/sessions_history', 'Braining\HistorystatisticsController',
					['only' => ['store']]);	

	Route::resource('v1/get_user_settings', 'Braining\GetusersettingsController',
					['only' => ['store']]);		

	Route::resource('v1/set_user_settings', 'Braining\SetusersettingsController',
					['only' => ['store']]);		
});


Route::get('home', 'HomeController@getIndex');

//Route::get('socket', 'SocketController@socket');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');


Route::get('{id}', 'Template\TemplateController@overview');
Route::get('sessions/calendar', 'SessionController@calendar');
Route::get('{id}/sessions', 'SessionController@sessions');
Route::get('{id}/sessions/{date1}/{date2}', 'SessionController@sessionsRangeSearch');
Route::post('session/comment', 'SessionController@comment');

Route::get('session/delete-comment', 'SessionController@deleteComment');
Route::get('session/delete-session', 'SessionController@deleteSession');
Route::get('session/client1', 'SessionController@client1');
Route::get('session/client2', 'SessionController@client2');
Route::get('session/ajaxData1', 'SessionController@ajaxData1');
Route::get('session/ajaxData2', 'SessionController@ajaxData2');

Route::get('{id}/session/{session}', 'SessionController@index');

Route::controllers([
	'template' => 'Template\TemplateController',
]);



/*
Route::get('template/overview', function(){
    if (Request::ajax()) {
        return Response::json(View::make('allUsers', array('allUsers' => $allUsers))->render());
    }
});
*/

//Route::post('user/SearchUsersAjax', 'UserController@SearchUsersAjax');


Route::get('/', 'Auth\AuthController@getLogin');


