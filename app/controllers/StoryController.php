<?php

use Illuminate\Support\MessageBag;
use Carbon\Carbon;

class StoryController extends \BaseController {
	public function isUserStoryOwnerOrSubscribedTeamMember($story_id)
	{
		$userIsOwnerOrSubscribedTeamMember = false;
		$user_id = Auth::id();

		try
		{
			// is the logged in user the owner of the story?
			if (Story::where('id', '=', $story_id)->first()->user->id == $user_id)
			{
				$userIsOwnerOrSubscribedTeamMember = true;
			}
			// or on the team AND subscribed?
			elseif (Auth::user()->subscribed() == true)
			{
				$team = StoryTeamMember::where('story_id', '=', $story_id)->where('user_id', '=', $user_id)->first();

				if (isset($team))
				{
					$userIsOwnerOrSubscribedTeamMember = true;
				}
			}
			else
			{
				return Redirect::to('dashboard');
			}
		}
		catch(\Exception $e)
		{
			$userIsOwnerOrSubscribedTeamMember = false;
		}

		return $userIsOwnerOrSubscribedTeamMember;
	}

	public function isUserStoryOwner($story_id)
	{
		$userIsOwner = false;
		$user_id = Auth::id();

		// is the logged in user the owner of the story?
		if (Story::where('id', '=', $story_id)->first()->user->id == $user_id)
		{
			$userIsOwner = true;
		}
		else
		{
			return Redirect::to('dashboard');
		}

		return $userIsOwner;
	}

	public function getStory($story_id)
	{
		$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);
		$user_id = Auth::id();

		// check if the user is able to access the story
		// they are either the owner of the story or
		// they are part of the team for this story
		$team = StoryTeamMember::where('story_id', '=', $story_id)->where('user_id', '=', $user_id)->first();

		if (!isset($team))
		{
			$story = Story::where('user_id', '=', $user_id)
						->where('id', '=', $story_id)
						->first();

			$story_role = "Owner";
		}
		else
		{
			// this user is on the team for this story, we don't
			// need to confirm their user id in the story
			$story = Story::where('id', '=', $story_id)
						->first();

			$story_role = "TeamMember";
		}

		if (!isset($story)) {
			return Redirect::to('/');
		}
		else {
			$story->touch();
		}

		// delete empty story contents
		StoryContent::where('story_id', '=', $story_id)->
						where('word_count', '=', '0')->delete();

		$story_contents = StoryContent::where('story_id', '=', $story->id)->orderBy('created_at', 'asc')->get();

		// Get team members if any
		$team_members = DB::select( DB::raw("select u.username, u.email, u.id as user_id
		from users u, story_team_members stm
		where u.id = stm.user_id and stm.story_id = :story_id"),
		array('story_id' => $story_id));

		$story_owner_username = Story::where('id', '=', $story_id)->first()->user->username;

		$this->user = Auth::user();

		$total_words_written = Auth::user()->total_words_written;
		$free_trial_word_count_limit = Auth::user()->free_trial_word_count_limit;
		$free_trial_words_remaining = $free_trial_word_count_limit - $total_words_written;
		$user_in_trial_period = ($free_trial_words_remaining > 0) ? true : false;

		$user_subscribed = Auth::user()->subscribed();
		$stories = Story::where('user_id', $user_id)->get();

		return View::make('write.show-story', array('stories' => $stories, 'story' => $story, 'story_contents' => $story_contents, 'user' => $this->user, 'story_id' => $story_id, 'team_members' => $team_members, 'story_role' => $story_role, 'user_subscribed' => $user_subscribed, 'story_owner_username' => $story_owner_username, 'user_in_trial_period' => $user_in_trial_period));
	}

	public function getStoryContent() {
		$user_id = Auth::id();

		$story_id = Input::get('story-id');
		$story_content_id = Input::get('story-content-id');

		$story = Story::where('user_id', '=', $user_id)
					->where('id', '=', $story_id)
					->first();

		if (!isset($story)) {
			return Response::json('Invalid story id', 404);
		}

		$story_content = StoryContent::where('id', '=', $story_content_id)->where('story_id', '=', $story->id)->first();

		if (!isset($story_content)) {
			return Response::json('Invalid story content id', 404);
		}
		else {
			return Response::json(array('id' => $story_content->id,
				'title' => $story_content->name,
				'content' => e($story_content->content),
				'word_count' => $story_content->word_count));
		}
	}

	public function postReorderStoryContents()
	{
		$user_id = Auth::id();

		$story_id = Input::get('story_id');
		$story_content_ids = Input::get('sessions_order');

		$story = Story::where('user_id', '=', $user_id)
					->where('id', '=', $story_id)
					->first();

		if (!isset($story)) {
			return Response::json('Invalid story id', 404);
		}

		$sort_id = 0;

		foreach ($story_content_ids as $story_content_id) {
				$story_content = StoryContent::where('id', '=', $story_content_id)->where('story_id', '=', $story->id)->first();

				if (isset($story_content)) {
					$story_content->sort_id = $sort_id++;

					if (empty(trim($story_content->name))) {
						$story_content->name = 'Untitled';
					}

					$story_content->save();
				}
		}

		return Response::json('Ok', 200);
	}

	public function getDashboard()
	{
		$user_id = Auth::id();
		$stories = Story::where('user_id', '=', $user_id)->orderBy('updated_at', 'desc')->get();

		$team_stories = DB::select( DB::raw("select s.id, s.name, s.total_word_count
									from stories s, story_team_members stm
									where s.id = stm.story_id
									and stm.user_id = :user_id"),
									array('user_id' => $user_id));

		// clear empty writing sessions
		WritingSession::where('user_id', '=', Auth::id())->where('content_in_progress', '=', '')->delete();

		// get active writing session
		$writing_session = WritingSession::where('user_id', '=', Auth::id())->first();

		$user = Auth::user();

		$total_words_written = $user->total_words_written;
		$free_trial_word_count_limit = $user->free_trial_word_count_limit;
		$free_trial_words_remaining = $free_trial_word_count_limit - $total_words_written;
		$user_in_trial_period = ($free_trial_words_remaining > 0) ? true : false;
		$user_subscribed = $user->subscribed();
		$marketing_program_short_code = $user->marketing_program_short_code;
		$timezone = $user->timezone;

		// Get daily writing log
		$daily_writing_logs = DailyWritingLog::where('user_id', '=', Auth::id())
								->where('date', '<', Carbon::now())
    							->where('date', '>', Carbon::now()->subDays(30))
								->orderBy('date', 'asc')->take(30)->get();

		$escaped_content_in_progress = "";

		if (isset($writing_session))
		{
			$escaped_content_in_progress = e(str_replace(PHP_EOL, '', str_limit(preg_replace('/\s\s+/', ' ', trim($writing_session->content_in_progress)), $limit = 1000, $end = '... (continued)')));
		}

		$escaped_content_in_progress_js = "var continueTextString = '" . $escaped_content_in_progress . "';";

		return View::make('write.dashboard', array('stories' => $stories,
					'team_stories' => $team_stories,
					'writing_session' => $writing_session,
					'total_words_written' => $total_words_written,
					'free_trial_words_remaining' => $free_trial_words_remaining,
					'user_in_trial_period' => $user_in_trial_period,
					'free_trial_word_count_limit' => $free_trial_word_count_limit,
					'user_subscribed' => $user_subscribed,
					'daily_writing_logs' => $daily_writing_logs,
					'escaped_content_in_progress_js' => $escaped_content_in_progress_js,
					'marketing_program_short_code' => $marketing_program_short_code,
					'timezone' => $timezone));
	}

	public function getGroups() {
		$group_daily_writing_logs = array();
		$user_id = Auth::id();

		$groups = DB::select('
			select distinct g.id, g.name
			from groups g, group_users gu
			where g.id = gu.group_id and
			((g.owner_user_id = ?) or
			(gu.user_id = ? and can_view_group_stats = true))', [$user_id, $user_id]);

		if (count($groups) > 0) {
			foreach ($groups as $group) {
				$group_users = DB::select('
					select distinct g.name, u.id, u.username, u.email
					from groups g, group_users gu, users u
					where g.id = gu.group_id and
					gu.user_id = u.id and
					gu.group_id = ?', [$group->id]);

				if (count($group_users) > 0) {
					foreach ($group_users as $group_user) {
						// Get daily writing log
						$daily_writing_logs = DailyWritingLog::where('user_id', '=', $group_user->id)
							->where('date', '<', Carbon::now())
							->where('date', '>', Carbon::now()->subDays(30))
							->orderBy('date', 'asc')->take(30)->get();

						array_push($group_daily_writing_logs, [$group_user->name, $group_user->id, $group_user->username, $group_user->email, $daily_writing_logs]);
					}
				}
			}
		}

		if (count($group_daily_writing_logs) > 0) {
			return View::make('write.groups', array('groups' => $groups,
			'group_daily_writing_logs' => $group_daily_writing_logs));
		}

		// There are no groups to show, go to Dashboard
		return Redirect::to('dashboard');
	}

	public function postCreateWritingSession()
	{
		$story_id = Input::get('story_id');
		$story_name = Input::get('story_name');
		$session_id = Input::get('session_id');
		$session_name = Input::get('session_name');

		WritingSession::where('user_id', '=', Auth::id())->delete();

		$writing_session = new WritingSession;
		$writing_session->user_id = Auth::id();
		$writing_session->writing_session_token = Auth::id();
		$writing_session->save();

		if ($story_id == null)
		{
			$story_id = 0;
		}

		$this->user = Auth::user();

		return View::make('write.main', array('writing_session' => $writing_session, 'story_id' => $story_id, 'user_id' => $this->user->id, 'story_name' => $story_name, 'session_id' => $session_id, 'session_name' => $session_name));
	}

	public function postContinueWritingSession()
	{
		$story_id = Input::get('story_id');
		$story_name = Input::get('story_name');
		$session_id = Input::get('session_id');
		$session_name = Input::get('session_name');

		$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

		$writing_session = $this->updateWritingSession();

		$continue_writing_session = true;

		$is_ninja_mode = $writing_session->is_ninja_mode;

		if ($is_ninja_mode == 1)
		{
			$is_ninja_mode = "1";
		}
		elseif ($is_ninja_mode == 0)
		{
			$is_ninja_mode = "0";
		}

		$this->user = Auth::user();

		return View::make('write.main',
			array('writing_session' => $writing_session,
					'continue_writing_session' => $continue_writing_session,
					'is_ninja_mode' => $is_ninja_mode,
					'user_id' => $this->user->id,
					'story_id' => $story_id,
					'story_name' => $story_name,
					'session_id' => $session_id,
					'session_name' => $session_name,
					'story_content_id' => $session_id));
	}

	public function getContinueStoryContent()
	{
		if (Input::has('sci') && (Input::has('si')))
		{
			try
			{
				$story_id = Input::get('si');
				$story_content_id = Input::get('sci');
				$input = Input::get('edit');
				$view = "";

				if (isset($input) && ($input == "1")) {
					$view = "edit";
				}
				else {
					$view = "write";
				}

				$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

				// get the story content
				$story = Story::where('user_id', '=', Auth::id())
					->where('id', '=', $story_id)
					->first();

				$story_content = StoryContent::where('id', '=', $story_content_id)->
												where('story_id', '=', $story_id)->first();

				// create a new writing session
				WritingSession::where('user_id', '=', Auth::id())->delete();

				$writing_session = new WritingSession;
				$writing_session->user_id 				= Auth::id();
				$writing_session->writing_session_token = Auth::id();
				$writing_session->content_in_progress 	= trim($story_content->content);
				$writing_session->word_count 			= $story_content->word_count;
				$writing_session->words_to_write 		= 0;
				$writing_session->is_ninja_mode 		= 0;
				$writing_session->save();

				// continue session in main
				$continue_writing_session = true;
				$is_ninja_mode = $writing_session->is_ninja_mode;

				if ($is_ninja_mode == 1)
				{
					$is_ninja_mode = "1";
				}
				elseif ($is_ninja_mode == 0)
				{
					$is_ninja_mode = "0";
				}

				$this->user = Auth::user();
				$story_name = $story->name;
				$session_id = $story_content_id;
				$session_name = $story_content->name;

				return View::make('write.main',
					array(	'writing_session' => $writing_session,
							'continue_writing_session' => $continue_writing_session,
							'is_ninja_mode' => $is_ninja_mode,
							'story_id' => $story_id,
							'story_name' => $story_name,
							'session_id' => $session_id,
							'session_name' => $session_name,
							'story_content_id' => $story_content->id,
							'user_id' => $this->user->id,
							'view' => $view));
			}
			catch (\Exception $e)
			{
		        return Redirect::to('dashboard');
			}
		}
	}

	public function postUpdateWritingSession()
	{
		$this->updateWritingSession();

		return "";
	}

	public function postAddTeamMember()
	{
		if ((Input::has('story_id') && (Input::has('email_or_username_to_add'))))
		{
			$story_id = Input::get('story_id');
			$email_or_username_to_add = Input::get('email_or_username_to_add');

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			try
			{
				$logged_in_user = Auth::user();
				$logged_in_username = $logged_in_user->username;
				$user = User::where('email', '=', $email_or_username_to_add)->orWhere('username', '=', $email_or_username_to_add)->firstOrFail();
				$story = Story::find($story_id);
				$story_name = $story->name;

				// check if the username being added is the user that is logged in
				if ($user->id == Auth::id())
				{
					return Response::make("Can't add yourself.", 401);
				}

				$member = new StoryTeamMember();
				$member->user_id = $user->id;
				$member->story_id = $story_id;
				$member->save();

				// send notification email
				$subject = "You've been added to the " . $story_name . " team.";

				$name = $user->username;
				$email_address = $user->email;

				Mail::send(array('text' => 'emails.team.added'), array(
					'name' => $name,
					'email_address' => $email_address,
					'story_name' => $story_name,
					'logged_in_username' => $logged_in_username), function($message) use ($email_address, $subject, $story_name, $logged_in_username)
				{
					$message->to($email_address)->replyTo('hello@ilys.com', 'hello@ilys .com')->subject($subject);
				});
			}
			catch(\Exception $e)
			{
				return Response::make("Can't add user.", 401);
			}

			$data['username'] = $user->username;
			$data['user_id'] = $user->id;

			return Response::json($data);
		}
		else
		{
			return Response::make('error', 400);
		}
	}

	public function postDeleteStory()
	{
		if (Input::has('story_id'))
		{
			$story_id 	= Input::get('story_id');
			$story_name = Input::get('story_name');

			$this->isUserStoryOwner($story_id);

			Story::where('user_id', '=', Auth::id())
						->where('id', '=', $story_id)
						->delete();

	        return Redirect::to('dashboard')->with('success', 'Your story <strong>' . $story_name . '</strong> was deleted.');
		}
		else
		{
	        return Redirect::to('dashboard');
		}
	}

	public function postDeleteTeamMember()
	{
		try
		{
			if ((Input::has('story_id') && (Input::has('user_id_to_remove'))))
			{
				$story_id = Input::get('story_id');
				$user_id_to_remove = Input::get('user_id_to_remove');

				$this->isUserStoryOwner($story_id);

				$member = StoryTeamMember::where('user_id', '=', $user_id_to_remove)->
											where('story_id', '=', $story_id)->delete();

				$logged_in_user = Auth::user();
				$logged_in_username = $logged_in_user->username;
				$user = User::where('id', '=', $user_id_to_remove)->firstOrFail();
				$story = Story::find($story_id);
				$story_name = $story->name;

				// send notification email
				$subject = "You've been removed from the " . $story_name . " team.";

				$name = $user->username;
				$email_address = $user->email;

				Mail::send(array('text' => 'emails.team.removed'), array(
					'name' => $name,
					'email_address' => $email_address,
					'story_name' => $story_name,
					'logged_in_username' => $logged_in_username), function($message) use ($email_address, $subject, $story_name, $logged_in_username)
				{
					$message->to($email_address)->replyTo('hello@ilys.com', 'hello@ilys .com')->subject($subject);
				});

				return "";
			}
			else
			{
				return Response::make('error', 400);
			}
		}
		catch (\Exception $e)
		{
			return Response::make('error', 400);
		}
	}

	public function postLeaveTeam()
	{
		if (Input::has('story_id'))
		{
			$story_id = Input::get('story_id');
			$user_id_to_remove = Auth::id();

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			$member = StoryTeamMember::where('user_id', '=', $user_id_to_remove)->
										where('story_id', '=', $story_id)->delete();

			return Redirect::to('dashboard');
		}
		else
		{
			return Response::make('error', 400);
		}
	}

	public function postMoveSession()
	{
		if ((Input::has('story_id') && Input::has('story_content_id') && (Input::has('new_story_id'))))
		{
			$story_id = Input::get('story_id');
			$story_content_id = Input::get('story_content_id');
			$new_story_id = Input::get('new_story_id');

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			$userId = Auth::id();

			// does the story exist?
			$story = Story::where('user_id', '=', $userId)
							->where('id', '=', $story_id)
							->first();

			if (isset($story)) {
				// does new story exist?
				$newStory = Story::where('user_id', '=', $userId)
								->where('id', '=', $new_story_id)
								->first();

				if (isset($newStory)) {
					$story_content = StoryContent::where('story_id', '=', $story_id)
									->where('id', '=', $story_content_id)->first();

					if (isset($story_content)) {
						$new_story_content = new StoryContent;
						$new_story_content->story_id = $new_story_id;
						$new_story_content->word_count = $story_content->word_count;
						$new_story_content->words_per_minute = $story_content->words_per_minute;
						$new_story_content->content = $story_content->content;
						$new_story_content->name = $story_content->name;
						$new_story_content->save();

						$newStory->total_word_count = StoryContent::where('story_id', '=', $new_story_id)->sum('word_count');
						$newStory->save();

						$story_content->delete();

						$story->total_word_count = StoryContent::where('story_id', '=', $story_id)->sum('word_count');
						$story->save();

						$data['new_word_count'] = $story->total_word_count;

						return Response::json($data);
					}
					else
					{
						return Response::make('Session does not exist', 400);
					}
				}
				else
				{
					return Response::make('Destination story does not exist', 400);
				}
			}
			else
			{
				return Response::make('Story does not exist', 400);
			}
		}
		else
		{
			return Response::make('error', 400);
		}
	}

	public function postDeleteSession()
	{
		if ((Input::has('story_id') && (Input::has('story_content_id'))))
		{
			$story_id = Input::get('story_id');
			$story_content_id = Input::get('story_content_id');

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			// does the story exist?
			$story = Story::where('user_id', '=', Auth::id())
							->where('id', '=', $story_id)
							->first();

			if (isset($story)) {
				$story_content = StoryContent::where('story_id', '=', $story_id)
								->where('id', '=', $story_content_id)
								->delete();

				$story->total_word_count = StoryContent::where('story_id', '=', $story_id)->sum('word_count');
				$story->save();

				$data['new_word_count'] = $story->total_word_count;

				return Response::json($data);
			}
			else
			{
				return Response::make('error', 400);
			}
		}
		else
		{
			return Response::make('error', 400);
		}
	}

	public function postRenameStory()
	{
		if (Input::has('value'))
		{
			$story_name = !empty(Input::get('value')) ? ucwords(substr(Input::get('value'), 0, 50)) : 'Untitled';
			$story_id 	= Input::get('pk');

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			$story = Story::where('user_id', '=', Auth::id())
							->where('id', '=', $story_id)
							->first();

			if (isset($story))
			{
				$story->name = $story_name;

				$story->save();

				return Response::make($story_name, 200);
			}
			else
			{
				return Response::make('error', 400);
			}
		}
		else
		{
			return Response::make('error', 400);
		}
	}

	public function postRenameSession()
	{
		if (Input::has('value'))
		{
			$ids = explode(",", Input::get('pk'));

			$story_content_name = !empty(Input::get('value')) ? ucwords(substr(Input::get('value'), 0, 50)) : 'Untitled';
			$story_id = $ids[0];
			$story_content_id = $ids[1];

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			// does the story exist?
			$story = Story::where('user_id', '=', Auth::id())
							->where('id', '=', $story_id)
							->first();

			if (isset($story)) {
				$story_content = StoryContent::where('story_id', '=', $story_id)
								->where('id', '=', $story_content_id)
								->first();

				$story_content->name = $story_content_name;
				$story_content->save();

				return Response::make($story_content_name, 200);
			}
			else
			{
				return Response::make('error', 400);
			}
		}
		else
		{
			return Response::make('error', 400);
		}
	}

	public function getDownloadStory()
	{
		if (Input::has('story_id'))
		{
			$story_id 	= Input::get('story_id');

			$this->isUserStoryOwnerOrSubscribedTeamMember($story_id);

			$story = Story::where('user_id', '=', Auth::id())
							->where('id', '=', $story_id)
							->first();

			if (!isset($story)) {
				return Redirect::to('/');
			}

			$divider = "\r\n\r\n";
			$indent = '> ';

			$story_contents = StoryContent::where('story_id', '=', $story->id)->orderBy('created_at', 'asc')->get();

			$file_name = preg_replace('/[^a-zA-Z0-9]/', '', trim($story->name)) . '.txt';
			$file_contents = $indent . html_entity_decode ($story->name) . $divider . $divider;

			$sort_by = 'id';

			if (count($story_contents->filter(function ($story_content) { return $story_content->sort_id > 0; })) > 0)
			{
				$sort_by = 'sort_id';
			}

			foreach ($story_contents->sortBy($sort_by) as $story_content)
			{
				if (strlen ($story_content->content) > 0)
				{
					if (empty($story_content->name))
					{
						$story_content->name = "Untitled Session";
					}

					$file_contents = $file_contents . $indent . html_entity_decode ($story_content->name) . $divider;
					$file_contents = $file_contents . $story_content->content . $divider . $divider;
				}
			}

			$file_contents = $file_contents . $indent . "Thank you with love from ilys :)\r\n";

			return Response::make($file_contents, '200', array(
			    'Content-Type' => 'application/octet-stream',
			    'Content-Disposition' => 'attachment; filename="'. $file_name .'"'
			));
		}
	}

	public function updateWritingSession()
	{
		$writing_session_token = Input::get('writing_session_token');
		$writing_session = WritingSession::where('writing_session_token', '=', $writing_session_token)->first();

		$content_in_progress = Input::get('content_in_progress');
		$is_ninja_mode = Input::get('is_ninja_mode');
		$words_to_write = Input::get('words_to_write');
		$word_count = Input::get('word_count');
		$local_storage_updated_at	= Input::get('local_storage_updated_at');

		// update the data of the writing session with data from the
		// localStorage of the browser because it's newer?
		if (isset($writing_session->local_storage_updated_at) && ($writing_session->local_storage_updated_at < $local_storage_updated_at))
		{
			$writing_session->content_in_progress = trim($content_in_progress);
			$writing_session->is_ninja_mode = $is_ninja_mode;
			$writing_session->word_count = $word_count;
			$writing_session->words_to_write = $words_to_write;
			$writing_session->local_storage_updated_at = $local_storage_updated_at;

			$writing_session->save();
		}

		return $writing_session;
	}

	public function postUpdateWordCount()
	{
		$writing_session_token = Input::get('writing_session_token');
		$user_id = Crypt::decrypt($writing_session_token);
		$update_word_count = Input::get('update_word_count');

		// update total_words_written
		$user = Auth::user();
		$user->total_words_written = $user->total_words_written + $update_word_count;
		$user->save();

		if (isset($user->marketing_program_short_code) &&  ($user->marketing_program_short_code == 'nanowrimo')) {
			$goal = WritingGoal::where('user_id', Auth::id())->where('name', 'nanowrimo')->first();

			if (isset($goal) && (!empty($user->timezone))) {
				$utc_start_at = Carbon::createFromFormat('Y-m-d H:i:s', $goal->start_at, $user->timezone);
				$utc_start_at->setTimezone('UTC');

				$utc_end_at = Carbon::createFromFormat('Y-m-d H:i:s', $goal->end_at, $user->timezone);
				$utc_start_at->setTimezone('UTC');

				if ((Carbon::now() > $utc_start_at) && (Carbon::now() < $utc_end_at)) {
					$goal->current_word_count = $goal->current_word_count + $update_word_count;
					$goal->save();
				}
			}
		}
	}

	public function getWritingSessionToken()
	{
		$wst = WritingSession::where('user_id', Auth::id())->orderBy('id', 'desc')->pluck('writing_session_token');

		if (isset($wst)) {
			return Response::json($wst, 200);
		}
		else {
			return Response::json('', 200);
		}
	}

	public function postSaveWritingSession()
	{
		$story_id = Input::get('story_id');
		$story_name = Input::get('story_name');
		$session_id = Input::get('session_id');
		$session_name = Input::get('session_name');

		$writing_session_token = Input::get('writing_session_token');

		$user_id = Crypt::decrypt($writing_session_token);

		$user = Auth::loginUsingId($user_id);

		$content_in_progress = Input::get('content_in_progress');
		$is_ninja_mode = Input::get('is_ninja_mode');
		$word_count = Input::get('word_count');
		$words_to_write = Input::get('words_to_write');
		$local_storage_updated_at = Input::get('local_storage_updated_at');

		$writing_session = WritingSession::where('writing_session_token', '=', $writing_session_token)->
										where('user_id', '=', $user_id)->
										first();


		if ($writing_session)
		{
			// is this an update to an already existing story_content?
			// if so, update and return to show-story
			if (Input::has("story_content_id") && (Input::get("story_content_id") != "0"))
			{
				$story_content_id = Input::get("story_content_id");

				// update the story content
				$story_content = StoryContent::firstOrNew(array('id' => $story_content_id));
				$story_content->content = $content_in_progress;
				$story_content->word_count = $word_count;
				$story_content->save();

				// show the story
				$story = Story::where('user_id', '=', Auth::id())
								->where('id', '=', $story_id)
								->first();

				// update story word count
				$story->total_word_count = StoryContent::where('story_id', '=', $story_id)->sum('word_count');
				$story->save();

				if (!isset($story)) {
					return Redirect::to('/');
				}

				$story_contents = StoryContent::where('story_id', '=', $story->id)->orderBy('created_at', 'asc')->get();

				// delete writing session
				$writing_session->delete();

				$this->user = Auth::user();

				// TODO :: CORRECT THIS LATER to show Owner or TeamOwner
				$story_role = "Owner";
				$story_owner_username = Story::where('id', '=', $story_id)->first()->user->username;

				$team_members = DB::select( DB::raw("select u.username, u.email, u.id as user_id
				from users u, story_team_members stm
				where u.id = stm.user_id and stm.story_id = :story_id"),
				array('story_id' => $story_id));

				$total_words_written = Auth::user()->total_words_written;
				$free_trial_word_count_limit = Auth::user()->free_trial_word_count_limit;
				$free_trial_words_remaining = $free_trial_word_count_limit - $total_words_written;
				$user_in_trial_period = ($free_trial_words_remaining > 0) ? true : false;

				$user_subscribed = Auth::user()->subscribed();
				$stories = Story::where('user_id', $user_id)->get();

				return View::make('write.show-story', array('stories' => $stories, 'story' => $story, 'story_content_id' => $story_content_id, 'story_contents' => $story_contents, 'user' => $this->user, 'story_id' => $story_id, 'story_role' => $story_role, 'story_owner_username' => $story_owner_username, 'team_members' => $team_members, 'user_in_trial_period' => $user_in_trial_period, 'user_subscribed' => $user_subscribed));
			}
			else
			{
				$writing_session->word_count = $word_count;
				$writing_session->words_to_write = $words_to_write;
				$writing_session->local_storage_updated_at = $local_storage_updated_at;
				$writing_session->content_in_progress = trim($content_in_progress);
				$writing_session->is_ninja_mode = $is_ninja_mode;

				$writing_session->save();

				$stories = Story::where('user_id', '=', $user_id)->orderBy('updated_at', 'desc')->get();

				return View::make('write.save-wip', array('writing_session_token' => $writing_session_token, 'stories' => $stories, 'story_id' => $story_id));
			}
		}
		else
		{
			if (isset($writing_session)) {
				return Redirect::to('dashboard')->withErrors($writing_session->errors());
			}
			else {
				return Redirect::to('dashboard');
			}
		}
	}

	public function getAttemptedSaves()
	{
		$user_id = Auth::id();

		$autosaves = WritingSessionAttemptedSave::where('user_id', '=', $user_id)
			->orderBy('updated_at', 'desc')->paginate(40);

		return View::make('write.autosaves', array('autosaves' => $autosaves));
	}

	public function postAttemptSaveWipToStory()
	{
		$ws = new WritingSessionAttemptedSave;
		$ws->user_id = Auth::id();
		$ws->content_in_progress = trim(Input::get('content_in_progress'));
		$ws->save();

		// trim the excess records
		// WritingSessionAttemptedSave::where('created_at', '<', Carbon::now()->subDays(60))->delete();
	}

	public function postChangeStoryName()
	{
			$storyId = Input::get('story_id');
			$newStoryName = trim(Input::get('new_story_name'));

			$story = Story::where('user_id', Auth::id())->where('id', $storyId)->first();

			if (isset($story))
			{
				$story->name = $newStoryName;
				$story->save();
			}

			return Response::json(200);
	}

	public function postChangeSessionName()
	{
			$storyId = Input::get('story_id');
			$sessionId = Input::get('session_id');
			$newSessionName = trim(Input::get('new_session_name'));

			$story = Story::where('user_id', Auth::id())->where('id', $storyId)->first();

			if (isset($story))
			{
				$storyContent = StoryContent::where('story_id', '=', $storyId)->where('id', $sessionId)->first();

				if (isset($storyContent)) {
					$storyContent->name = $newSessionName;
					$storyContent->save();
				}
			}

			return Response::json(200);
	}

	public function postSaveWipToStory()
	{
		$writing_session_token = Input::get('writing_session_token');
		$writing_session = WritingSession::where('writing_session_token', '=', $writing_session_token)->first();

		if (isset($writing_session))
		{
			$get_story_by_story_name = false;

			// if there is a value in story_name, this is a new story.
			$story_name = Input::get('story_name');

			// if the story_id is not 0, this is an update to a story.
			$story_id = Input::get('story_id_from_list');

			// if story_name is not empty, use story name
			if (($story_name != '') || (!isset($story_id)))
			{
				$get_story_by_story_name = true;

				if ($story_name == '')
				{
					$story_name = "Untitled";
				}
				else
				{
					$story_name = e(ucwords($story_name));
				}
			}

			$new_session_name = !empty(Input::get('new_session_name')) ? ucwords(Input::get('new_session_name')) : "Untitled";

			$user_id = Crypt::decrypt($writing_session_token);

			if ($get_story_by_story_name)
			{
				$story = Story::firstOrNew(array('user_id' => $user_id, 'name' => $story_name));
			}
			else
			{
				$story = Story::firstOrNew(array('user_id' => $user_id, 'id' => $story_id));
			}

			$content_in_progress_word_count = $writing_session->word_count;
			$total_word_count = $story->total_word_count + $content_in_progress_word_count;
			$story->total_word_count = $total_word_count;

			// only attempt to save if there is content to save
			if ($content_in_progress_word_count > 0)
			{
        if ($story->save())
        {
					$new_sort_id = DB::select( DB::raw("select max(sort_id) as sort_id
					from story_contents where story_id = :story_id"),
					array('story_id' => $story_id) );

					if ($new_sort_id[0]->sort_id > 0) {
						$new_sort_id = $new_sort_id[0]->sort_id + 1;
					}
					else {
						$new_sort_id = 0;
					}

					$story_content = new StoryContent;
					$story_content->story_id = $story->id;
					$story_content->word_count = $content_in_progress_word_count;
					$story_content->words_per_minute = $writing_session->words_per_minute;
					$story_content->content = trim($writing_session->content_in_progress);
					$story_content->name = $new_session_name;
					$story_content->sort_id = $new_sort_id;

					if ($story_content->save())
					{
						// story and story_content is saved, now
						// archive and delete the wip record
						$writing_sessions_archive = new WritingSessionsArchive;
						$writing_sessions_archive->user_id = $writing_session->user_id;
						$writing_sessions_archive->is_ninja_mode = $writing_session->is_ninja_mode;
						$writing_sessions_archive->words_to_write = $writing_session->words_to_write;
						$writing_sessions_archive->word_count = $writing_session->word_count;
						$writing_sessions_archive->words_per_minute = $writing_session->words_per_minute;
						$writing_sessions_archive->session_started_at = $writing_session->session_started_at;
						$writing_sessions_archive->session_ended_at = $writing_session->session_ended_at;
						$writing_sessions_archive->created_at = $writing_session->created_at;
						$writing_sessions_archive->updated_at = $writing_session->updated_at;

						$writing_sessions_archive->save();

						// add statistics to daily_writing_log table
						$today = Carbon::today();

						$daily_writing_log = DailyWritingLog::firstOrNew(array('user_id' => $user_id, 'date' => $today));

						if (isset($daily_writing_log->daily_word_count))
						{
							$daily_writing_log->daily_word_count = $daily_writing_log->daily_word_count + $content_in_progress_word_count;
						}
						else
						{
							$daily_writing_log->daily_word_count = $content_in_progress_word_count;
						}

						$daily_writing_log->save();

						$writing_session->delete();

						$story_contents = StoryContent::where('story_id', '=', $story->id)->orderBy('created_at', 'asc')->get();

						$this->user = Auth::user();

						// TODO :: CORRECT THIS LATER to show either Owner of TeamMember
						$story_role = "Owner";

						try
						{
							$story_owner_username = Story::where('id', '=', $story_id)->first()->user->username;
						}
						catch (\Exception $e)
						{
							$story_owner_username = $this->user->username;
						}

						$team_members = DB::select( DB::raw("select u.username, u.email, u.id as user_id
						from users u, story_team_members stm
						where u.id = stm.user_id and stm.story_id = :story_id"),
						array('story_id' => $story_id));

						$total_words_written = Auth::user()->total_words_written;
						$free_trial_word_count_limit = Auth::user()->free_trial_word_count_limit;
						$free_trial_words_remaining = $free_trial_word_count_limit - $total_words_written;
						$user_in_trial_period = ($free_trial_words_remaining > 0) ? true : false;

						$user_subscribed = Auth::user()->subscribed();
						$stories = Story::where('user_id', $user_id)->get();

						return View::make('write.show-story', array('stories' => $stories, 'story' => $story, 'story_content_id' => $story_content->id, 'story_contents' => $story_contents, 'user' => $this->user, 'story_id' => $story->id, 'story_role' => $story_role, 'story_owner_username' => $story_owner_username, 'team_members' => $team_members, 'user_in_trial_period' => $user_in_trial_period, 'user_subscribed' => $user_subscribed));
					}
					else
					{
						return Redirect::back()->withErrors($story_content->errors());
					}
		        }
		        else
		        {
					return Redirect::back()->withErrors($story->errors());
		        }
		    }
		}

		return Redirect::to('dashboard');
	}
}
