<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MassEmailUsers extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ilys:mass-email-users';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send a collection of users an email.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
			$emailMessageId = $this->argument('email-message-id');

			$emailMessage = EmailMessage::find($emailMessageId);

			if ($emailMessage) {
				$data["email_message_id"] = $emailMessageId;
				$data['subject'] = $emailMessage->subject;
				$data['message_text'] = $emailMessage->message_text;
				$data['sql'] = $emailMessage->sql;

				$this->send($data);
			}
	}


	public function send($data)
	{
			$time_start = microtime(true);

			$email_message_id = $data["email_message_id"];
			$subject = $data["subject"];
			$message_text = $data["message_text"];
			$sql = $data["sql"];

			$users_to_email = DB::select(DB::raw($sql));
			$suppressed_email = 0;
			$already_sent_email = 0;
			$sent_email = 0;

			$this->info('Starting mass mailer.');

			foreach($users_to_email as $user) {
				$email = $user->email;

				$suppressed = EmailSuppression::where('email', $email)->first();

				if (isset($suppressed)) {
						$suppressed_email++;
						$this->error('Suppressed ' . $email);
				}
				else {
						$emst = EmailMessageSentTo::where('email_message_id', $email_message_id)->where('email', $email)->first();

						if (isset($emst)) {
								$already_sent_email++;
								$this->error('Already sent to ' . $email);
						}
						else {
								Mail::queueOn('admin-send-to-users', array('text' => 'emails.admin.send_to_users'), array(
									'message_text' => $message_text,
									'email' => $email), function($message) use ($email, $subject)
								{
										$message->to($email, $email)->replyTo('hello@ilys.com')->subject($subject);
								});

								$emst = new EmailMessageSentTo();
								$emst->email = $email;
								$emst->email_message_id = $email_message_id;
								$emst->save();

								$sent_email++;
								$this->info('Sent to ' . $email);
							}
					}
			}

			$this->info('Suppressed emails: ' . $suppressed_email);
			$this->info('Already sent emails: ' . $already_sent_email);
			$this->info('Total sent emails: ' . $sent_email);

			$time_end = microtime(true);
			$time = $time_end - $time_start;

			$this->info('Total processing time: ' . $time);
			$this->info('BASTA!');
	}



	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array("email-message-id", InputArgument::REQUIRED, "Email message id"),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
