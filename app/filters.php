<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	if (app()->env == 'production')
	{
	    if( ! Request::secure())
	    {
	        //return Redirect::secure(Request::path());
	    }
	}
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if ( Auth::guest() ) // If the user is not logged in
	{
        return Redirect::guest('/welcome');
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::guest('/dashboard');
});

/*
|--------------------------------------------------------------------------
| Role Permissions
|--------------------------------------------------------------------------
|
| Access filters based on roles.
|
*/

// Check for role on all admin routes
Entrust::routeNeedsRole( 'admin*', array('admin'), Redirect::to('/') );

// Check for permissions on admin actions
Entrust::routeNeedsPermission( 'admin/blogs*', 'manage_blogs', Redirect::to('/admin') );
Entrust::routeNeedsPermission( 'admin/comments*', 'manage_comments', Redirect::to('/admin') );
Entrust::routeNeedsPermission( 'admin/users*', 'manage_users', Redirect::to('/admin') );
Entrust::routeNeedsPermission( 'admin/roles*', 'manage_roles', Redirect::to('/admin') );

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
    $token = Request::ajax() ? Request::header('x-csrf-token') : Input::get('_token');

    if (Session::token() != $token)
    {
	    $writing_session_token= Input::get('writing_session_token');
	    if ($writing_session_token)
	    {
			$user_id 					= Crypt::decrypt($writing_session_token);
			$user 						= Auth::loginUsingId($user_id);
			$writing_session 			= WritingSession::where('writing_session_token', '=', $writing_session_token)->
											where('user_id', '=', $user_id)->
											first();

			if (!$writing_session)
			{
				Auth::logout();
				return Redirect::to("user/login");
			}
	    }
	    else
	    {
			throw new Illuminate\Session\TokenMismatchException;
        }
    }
});


/*
|--------------------------------------------------------------------------
| Language
|--------------------------------------------------------------------------
|
| Detect the browser language.
|
*/

Route::filter('detectLang',  function($route, $request, $lang = 'auto')
{

    if($lang != "auto" && in_array($lang , Config::get('app.available_language')))
    {
        Config::set('app.locale', $lang);
    }else{
        $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
        $browser_lang = substr($browser_lang, 0,2);
        $userLang = (in_array($browser_lang, Config::get('app.available_language'))) ? $browser_lang : Config::get('app.locale');
        Config::set('app.locale', $userLang);
        App::setLocale($userLang);
    }
});


/*
|--------------------------------------------------------------------------
| Subscription
|--------------------------------------------------------------------------
|
| Detect the status of users level of subscription.
|
*/

Route::filter('subscribed', function()
{
	if(Auth::check() && !Auth::user()->subscribed())
	{
		return Redirect::action('subscription')->with('flash', 'You need to be subscribed to do that.');
	}
});

Route::filter('not.subscribed', function()
{
	if(Auth::check() && Auth::user()->subscribed())
	{
		return Redirect::action('subscription');
	}
});

Route::filter('not.cancelled', function()
{
	if(Auth::check() && Auth::user()->cancelled())
	{
		return Redirect::action('subscription');
	}
});

Route::filter('cancelled', function()
{
	if(Auth::check() && !Auth::user()->cancelled())
	{
		return Redirect::action('subscription');
	}
});

// used to test if the user is on a certain plan
// in this case, the "large" plan.
Route::filter('plan.large', function()
{
	if(Auth::check() && !Auth::user()->onPlan('large'))
	{
		return Redirect::action('subscription')->with('flash', 'You need to be on the Large subscription to do that.');;
	}
});
