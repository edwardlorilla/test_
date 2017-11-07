<?php

use Illuminate\Support\Facades\Artisan;

class AdminController extends BaseController {
	public function index()
	{
		return View::make('admin.index');
	}

	public function emailMembers()
	{
		return View::make('admin.email-members');
	}

	public function postGetUsers()
	{
		$sql_where = Input::get('sql');
		$sql = "select username, email from users where 1=1 and " . $sql_where;
		$users_to_email = DB::select( DB::raw($sql));

		return Response::json($users_to_email);
	}

	public function postSendMessageToUsers()
	{
		$sql_where = Input::get('sql');
		$sql = "select username, email from users where 1=1 and " . $sql_where;

		$emailMessage = new EmailMessage();
		$emailMessage->subject = Input::get('subject');
		$emailMessage->message_text = Input::get('message_text');
		$emailMessage->sql = $sql;
		$emailMessage->save();

		$id = $emailMessage->id;

		return $id;
	}
}
