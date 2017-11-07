<?php

/*
|--------------------------------------------------------------------------
| Setup Papertrail Routing w/ monolog
|--------------------------------------------------------------------------
*/
$monolog = Log::getMonolog();
$syslog = new \Monolog\Handler\SyslogHandler('papertrail');
$formatter = new \Monolog\Formatter\LineFormatter('%channel%.%level_name%: %message% %extra%');
$syslog->setFormatter($formatter);

$monolog->pushHandler($syslog);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Marketing Programs & Static Pages
Route::get('nanowrimo', 'MarketingController@validate');
Route::get('NaNoWriMo', 'MarketingController@validate');

Route::get('/about', function(){
	return View::make('static_pages.about');
});

Route::get('/contact-us', function(){
	return View::make('static_pages.contact-us');
});

Route::get('/testimonials', function(){
	return View::make('static_pages.testimonials');
});

Route::get('/terms-of-service', function(){
	return View::make('static_pages.terms-of-service');
});

Route::get('/welcome', array('before' => 'guest', function(){
	Session::put('marketing_program_short_code', "Retail");
	return View::make('homepage.index');
}));

Route::get('/groups', array('before' => 'auth', 'uses' =>	'StoryController@getGroups'));

Route::get('/', array('before' => 'auth', 'uses' =>	'StoryController@getDashboard'));

//:: User Account Routes ::
Route::get('login', function() {
	return Redirect::to('users/login');
});

Route::get('logout', function() {
	return Redirect::to('users/logout');
});

Route::get('timeout', array('before' => 'auth', 'uses' =>	'StoryController@getDashboard'));

Route::get('keepAlive', 'UsersController@keepAlive');

// Confide routes
Route::get('users/create', 						'UsersController@create');
Route::post('users', 							'UsersController@store');
Route::get('users/login', 						'UsersController@login');
Route::post('users/login', 						'UsersController@doLogin');
Route::get('users/confirm/{code}', 				'UsersController@confirm');
Route::get('users/forgot_password', 			'UsersController@forgotPassword');
Route::post('users/forgot_password', 			'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 		'UsersController@resetPassword');
Route::post('users/reset_password', 			'UsersController@doResetPassword');
Route::get('users/logout', 						'UsersController@logout');

//////////////////////////////////////////////////////////////////
// these routes show up as errors because somehow the system is calling them incorrectly:
// create-writing-session should only be a POST call, handle the GET
//////////////////////////////////////////////////////////////////
Route::get('/create-writing-session', function(){
	return Redirect::to('dashboard');
});

Route::get('/attempt-save-wip-to-story', function(){
	return Redirect::to('dashboard');
});

Route::get('/continue-writing-session', function(){
	return Redirect::to('dashboard');
});

Route::get('/update-writing-session', function(){
	return Redirect::to('dashboard');
});


//////////////////////////////////////////////////////////////////
// ilys specific routes
//////////////////////////////////////////////////////////////////
//Route::get('help', array('uses' => 'HomeController@showHelp'));

Route::get('maint', array('uses' => 'HomeController@runMaint'));

Route::get('dashboard', array('before' => 'auth', 'uses' =>	'StoryController@getDashboard'));

Route::get('write', array('before' => 'auth', function() {
	return View::make('site.write.main');
}));

Route::post('create-writing-session',
	array('before' => 'csrf', 'before' => 'auth', 'uses' =>	'StoryController@postCreateWritingSession'));

Route::post('continue-writing-session',
	array('before' => 'csrf', 'before' => 'auth', 'uses' =>	'StoryController@postContinueWritingSession'));

Route::post('update-writing-session',
	array('before' => 'csrf', 'before' => 'auth', 'uses' =>	'StoryController@postUpdateWritingSession'));

Route::get('save-writing-session', array('before' => 'csrf', 'before' => 'auth', function()
{ return Redirect::to('dashboard'); }));

Route::get('save-wip-to-story', array('before' => 'csrf', 'before' => 'auth', function()
{ return Redirect::to('dashboard'); }));

Route::post('save-writing-session', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postSaveWritingSession'));

Route::post('attempt-save-wip-to-story', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postAttemptSaveWipToStory'));

Route::post('save-wip-to-story', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postSaveWipToStory'));

Route::post('update-wordcount', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postUpdateWordCount'));

Route::post('reorder-story-contents', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postReorderStoryContents'));

Route::get('download-story', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@getDownloadStory'));

Route::get('continue-story-content', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@getContinueStoryContent'));

Route::get('get-story-content', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@getStoryContent'));

Route::get('show-story/{story_id}', array('before' => 'auth', 'uses' => 'StoryController@getStory'));

Route::get('get-nanowrimo-wordcount', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'NaNoWriMoController@getNaNoWriMoWordsWritten'));

Route::get('get-writing-session-token', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@getWritingSessionToken'));

Route::post('delete-story', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postDeleteStory'));

Route::post('delete-session', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postDeleteSession'));

Route::post('move-session', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postMoveSession'));

Route::post('rename-story', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postRenameStory'));

Route::post('rename-session', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postRenameSession'));

Route::post('add-team-member', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postAddTeamMember'));

Route::post('delete-team-member', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postDeleteTeamMember'));

Route::post('leave-team', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postLeaveTeam'));

Route::post('stripe/webhook', 'Laravel\Cashier\WebhookController@handleWebhook');

Route::post('contact-us', array('before' => 'csrf', 'uses' => 'HelperController@postFeedbackMessage'));

Route::post('send-feedback', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'HelperController@postFeedbackMessage'));

Route::post('error-report', array('before' => 'csrf', 'uses' =>	'HelperController@postFeedbackMessage'));

Route::get('recent-autosaves', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@getAttemptedSaves'));

Route::post('setup-nanowrimo', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'NaNoWriMoController@setUpNaNoWriMoGoal'));

Route::post('update-story-name', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postChangeStoryName'));

Route::post('update-session-name', array('before' => 'csrf', 'before' => 'auth', 'uses' => 'StoryController@postChangeSessionName'));

Route::group(['prefix' => 'subscription', 'before' => 'auth'], function()
{
	Route::get('/', [
		'as' => 'subscription',
		'uses' => 'SubscriptionController@getIndex'
	]);

	Route::group(['before' => 'not.subscribed'], function()
	{
		Route::get('join', [
			'as' => 'subscription-join',
			'uses' => 'SubscriptionController@getIndex'
		]);

		Route::post('join', [
			'before' => 'csrf',
			'uses' => 'SubscriptionController@postJoin'
		]);
	});

	Route::group(['before' => 'subscribed'], function()
	{
		Route::get('cancel', [
			'before' => 'not.cancelled|csrf',
			'as' => 'subscription-cancel',
			'uses' => 'SubscriptionController@getCancel'
		]);

		Route::get('resume', [
			'before' => 'cancelled|csrf',
			'as' => 'subscription-resume',
			'uses' => 'SubscriptionController@getResume'
		]);

		Route::get('card', [
			'before' => 'csrf',
			'as' => 'subscription-card',
			'uses' => 'SubscriptionController@getCard'
		]);

		Route::post('card', [
			'before' => 'csrf',
			'uses' => 'SubscriptionController@postCard'
		]);
	});
});


Route::group(['before' => 'auth|subscribed'], function()
{
	Route::get('/protected', function()
	{
		echo "Subscribed only!";
	});
});
