<?php

class HelperController extends Controller {

	public function postFeedbackMessage()
	{
		$calling_url = Input::get('calling_url');
		$subject = Input::get('subject');
		$feedback_message = Input::get('feedback_message');

		$user = Auth::user();

		if ($user != null)
		{
			$name = $user->username;
			$email_address = $user->email;
		}
		else
		{
			$name = "not authenticated user";
			$email_address = Input::get('email');
		}

		Mail::send(array('text' => 'emails.admin.feedback'), array(
			'name' => $name, 
			'email_address' => $email_address, 
			'feedback_message' => $feedback_message), function($message) use ($email_address, $subject)
		{
		    $message->to('hello@ilys.com', 'hello@ilys .com')->replyTo($email_address)->subject($subject);
		});	

		return Redirect::to($calling_url)->with('success','Thanks, your message was sent.');
	}
}
