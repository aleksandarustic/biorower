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
        Route::resource('v1/graph', 'Braining\GraphController',
					['only' => ['store']]);	

	Route::resource('v1/get_user_settings', 'Braining\GetusersettingsController',
					['only' => ['store']]);		

	Route::resource('v1/set_user_settings', 'Braining\SetusersettingsController',
					['only' => ['store']]);	
        Route::resource('v1/graph_setting', 'Braining\SettingController',
					['only' => ['store']]);		
});

/** Login/Register/Reset PW  */
Route::get('/', 						'WelcomeController@getLogin');
Route::get('/login', 					'WelcomeController@getLogin');
Route::post('/login', 					'WelcomeController@postLogin');
Route::get('/register', 				'WelcomeController@getRegister');
Route::post('/register', 				'WelcomeController@postRegister');
Route::post('/password-reset', 			'WelcomeController@passwordReset');
Route::get('/password/reset/{token}', 	'WelcomeController@resetPassword');
Route::post('/update-password', 		'WelcomeController@updatePassword');
/** Login/Register/Reset PW  */

Route::get('/checkEmail', function(){
	return view('emails.profile_activated');
});
Route::get('/approve/user/{userId}', 	'WelcomeController@approveRegister');

// Only for logged-in users
Route::group(['middleware' => 'auth'], function()
{
Route::get('/profile/logout', 			'WelcomeController@getLogout');

//Route::get('socket', 'SocketController@socket');
Route::post('sendmessage',				'SocketController@sendMessage');
Route::get('writemessage', 				'SocketController@writemessage');

Route::get('/profile', 										'Template\TemplateController@overview');
Route::get('/profile/sessions', 							'SessionController@sessions');
Route::get('/{username}', 									'User\ProfileController@index');
Route::get('/profile/{username}/session/{session}', 		'SessionController@index');
Route::get('/profile/{username}/sessions/{date1}/{date2}', 	'SessionController@sessionsRangeSearch');
Route::post('/profile/avatar', 								'User\UserController@UpdateUserAvatar');
Route::post('/search', 										'User\UserController@postSearchUsersAjax');
Route::get('/profile/edit', 								'User\UserController@getEdit');
Route::post('profile/user/edit',							'update@update');
Route::post('profile/user/change-password', 				'update@ChangePassword');
Route::get('{username}/graphs', 							'User\ProfileController@graphs');
Route::get('{username}/scalendar', 							'User\ProfileController@calendar');

/* User Friends */
Route::post('/friend-request', 			'User\FriendsController@create');
Route::post('/unfriend', 				'User\FriendsController@destroy');
Route::post('/friend-confirm', 			'User\FriendsController@ConfirmFriend');
Route::get('/profile/friends/requests', 'User\FriendsController@ViewRequests');
Route::post('/new-requests', 			'User\FriendsController@NumNewRequests');
Route::post('/view-newreq', 			'User\FriendsController@ViewNewRequests');
Route::get('/friends/received-req', 	'User\FriendsController@GetReceivedRequest');
Route::get('/{username}/friends', 		'User\ProfileController@FriendsList');
Route::post('/friend-search', 			'User\ProfileController@FriendSearch');
Route::get('/profile/myfriends', 		'User\ProfileController@MyFriendsList');
/* User Friends */
/* CHAT - message */
Route::post('/chat-box', 				'ChatController@show');
Route::post('/chat-messages', 			'ChatController@getMsg');
Route::post('/num-new-messages', 		'ChatController@NumNewMsg');
Route::post('/user-msg-notif', 			'ChatController@NewMsgNotif');
Route::post('/friend-chat-list', 		'ChatController@index');
Route::post('/chat-send-msg', 			'ChatController@create');
Route::post('/view-newmsg', 			'ChatController@ViewNewMessages');
Route::post('/load-old-msg', 			'ChatController@getOldMsg');
/* NOTIFICATIONS */
Route::post('/show-notifications',		'NotificationsController@index');
Route::post('/get-notifications', 		'User\FollowController@create');
Route::post('/unget-notifications',		'User\FollowController@destroy');
Route::post('/num-new-notifications', 	'NotificationsController@NumNewNotifications');
Route::post('/read-new-notifications',  'NotificationsController@ReadNewNotifications');
Route::post('/get-new-notifications',   'NotificationsController@GetNewNotifications');
/* SESSION COMMENTS*/
Route::post('/getLatestComment', 		'CommentController@index');
Route::post('/addComment', 				'CommentController@create');
Route::post('/deleteComment', 			'CommentController@destroy');

/* Route::get('/auth/twitter', 'WelcomeController@redirectToProvider');
Route::get('/auth/twitter/callback', 'WelcomeController@handleProviderCallback');
*/
Route::get('/sessions/calendar', 		'SessionController@calendar');
Route::post('/sessions/comment', 		'SessionController@comment');

Route::get('session/delete-comment', 	'SessionController@deleteComment');
Route::get('session/delete-session', 	'SessionController@deleteSession');
Route::get('session/client1', 			'SessionController@client1');
Route::get('session/client2', 			'SessionController@client2');
Route::get('session/ajaxData1', 		'SessionController@ajaxData1');
Route::get('session/ajaxData2', 		'SessionController@ajaxData2');

}); // Only for logged-in users

Route::controllers([
	'template' => 'Template\TemplateController',
]);

Route::post('/set-cookie', 				'TimezoneController@create');


