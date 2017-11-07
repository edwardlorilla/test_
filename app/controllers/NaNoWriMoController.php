<?php

use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Routing\Controller;

class NaNoWriMoController extends Controller {
	public function setUpNaNoWriMoGoal()
	{
	  $user = User::find(Auth::id());
	  $user->timezone = Input::get('timezone');
	  $user->save();

		$goal = WritingGoal::firstOrNew(array('user_id' => $user->id, 'name' => 'nanowrimo'));
		$goal->user_id = $user->id;
		$goal->name = 'nanowrimo';
		$goal->start_at = Carbon::parse('2017-11-01 0:00:00');
		$goal->end_at = Carbon::parse('2017-11-30 23:59:59');
		$goal->word_count_goal = 50000;
		$goal->save();

		$utc_start_at = Carbon::createFromFormat('Y-m-d H:i:s', $goal->start_at, $user->timezone);
		$utc_start_at->setTimezone('UTC');

		$secondsTillStart = Carbon::now()->diffInSeconds($utc_start_at, false);

	  return Response::json($secondsTillStart, 200);
	}

	public function getNaNoWriMoWordsWritten()
	{
		$goal = WritingGoal::where('user_id', Auth::id())->where('name', 'nanowrimo')->first();

		if (isset($goal)) {
			$user = Auth::user();

			$utc_end_at = Carbon::createFromFormat('Y-m-d H:i:s', $goal->end_at, $user->timezone);
			$utc_end_at->setTimezone('UTC');

			$secondsTillEnd = Carbon::now()->diffInSeconds($utc_end_at, false);

			$data = [
				'nanowrimoWordsWritten' => $goal->current_word_count,
				'secondsTillEnd' => $secondsTillEnd
			];

			return Response::json($data, 200);
		}
		else {
			return Response::json(0, 200);
		}
	}
}
