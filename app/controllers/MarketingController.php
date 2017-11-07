<?php

use Illuminate\Routing\Controller;

class MarketingController extends Controller {

	public function validate()
	{
		$uri = URL::current();

		$segments = explode("/", $uri);
		$last_segment = strtolower(end($segments));

		$marketing_program = MarketingProgram::where('short_code', '=', explode("?", $last_segment)[0])->where('active', '=', '1')->first();

		// Marketing program is invalid, return to the main landing page
		if (!isset($marketing_program->short_code))
		{
			Session::put('marketing_program_short_code', 'Retail');

			return View::make('homepage.index');
		}

		Session::put('marketing_program_short_code', $marketing_program->short_code);

		// reroute to the sales page for the marketing program
		switch (strtolower($marketing_program->short_code))
		{
	    case 'nanowrimo':
					return View::make('marketing_programs.nanowrimo');
	        break;
			case 'ph':
					return View::make('marketing_programs.ph');
	        break;
			case 'tnw':
					return View::make('marketing_programs.tnw');
	        break;
			case 'publishizer':
					return View::make('marketing_programs.publishizer');
	        break;
			case 'prowritingaid':
					return View::make('marketing_programs.prowritingaid');
	        break;

	    default:
					return View::make('homepage.index');
					break;
		}
	}
}
