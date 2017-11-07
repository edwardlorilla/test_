<?php
use Carbon\Carbon;
class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{  
		return View::make('hello');
	}

	public function showHelp()
	{
		return View::make('static_pages.help');
	}

	public function runMaint()
	{
		// trim the autosaves table
		WritingSessionAttemptedSave::where('created_at', '<', Carbon::now()->subDays(60))->delete();

		return Response::make('OK', 200);
	}
}
