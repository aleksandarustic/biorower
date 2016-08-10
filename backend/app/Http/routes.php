<?php

Route::group(array('prefix' => 'api'), function()
{
	Route::resource('v1/users', 'Braining\UsersController',
					['only' => ['store']]); //, 'names' => ['store' => 'api.braining.users.registration', 'update' => 'api.braining.users.login']]

	Route::resource('v1/adduser', 'Braining\AddUserController',
					['only' => ['store']]);
	Route::resource('v1/sessions_recent_list', 'Braining\SessionsRecentListController',
					['only' => ['store']]);

        Route::Post('v1/firmware_update', 'Braining\FirmwareController@upload'); 

	Route::Post('v1/firmware_get_version', 'Braining\FirmwareController@getVersion');

	Route::Post('v1/firmware_get', 'Braining\FirmwareController@download'); 

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

	Route::resource('v1/sessions_edit', 'Braining\EditSessionController',
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

Route::get('/', 'WelcomeController@getLogin');
Route::get('/login', 'WelcomeController@getLogin');
Route::post('/login', 'WelcomeController@postLogin');
Route::get('/register', 'WelcomeController@getRegister');
Route::post('/register', 'WelcomeController@postRegister');
Route::post('/password-reset', 'WelcomeController@passwordReset');
Route::get('/password/reset/{token}', 'WelcomeController@resetPassword');

Route::post('/update-password', 'WelcomeController@updatePassword');

//Route::get('socket', 'SocketController@socket');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');

Route::get('/approve/user/{userId}', 'WelcomeController@approveRegister');

Route::get('/checkEmail', function(){
	return view('emails.profile_activated');
});

Route::get('/profile', 'Template\TemplateController@overview');
Route::get('/profile/sessions', 'SessionController@sessions');
Route::get('/profile/friends', 'User\UserController@friends');
Route::get('/profile/{username}/session/{session}', 'SessionController@index');
Route::get('/profile/{username}/sessions/{date1}/{date2}', 'SessionController@sessionsRangeSearch');

Route::post('/profile/edit', 'User\UserController@postEdit');
Route::post('/profile/avatar', 'User\UserController@UpdateUserAvatar');
Route::post('/profile/edit/user/user-upload-temp-image', 'User\UserController@postUserUploadTempImage');
Route::post('/profile/edit/user/user-change-profile-image', 'User\UserController@postUserChangeProfileImage');
Route::get('/profile/logout', 'WelcomeController@getLogout');

Route::get('/sessions/calendar', 'SessionController@calendar');
Route::post('/sessions/comment', 'SessionController@comment');

Route::get('session/delete-comment', 'SessionController@deleteComment');
Route::get('session/delete-session', 'SessionController@deleteSession');
Route::get('session/client1', 'SessionController@client1');
Route::get('session/client2', 'SessionController@client2');
Route::get('session/ajaxData1', 'SessionController@ajaxData1');
Route::get('session/ajaxData2', 'SessionController@ajaxData2');

Route::get('/profile/edit', 'User\UserController@getEdit');
Route::post('profile/user/edit','update@update');

Route::controllers([
	'template' => 'Template\TemplateController',
]);



