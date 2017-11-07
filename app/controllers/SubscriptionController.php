<?php

class SubscriptionController extends \BaseController {

	protected $user;

	public function __construct()
	{
		$this->user = Auth::user();
	}

	public function getIndex()
	{
		$marketing_program_short_code = $this->user->marketing_program_short_code;

		if (isset($marketing_program_short_code))
		{
			$marketing_program = MarketingProgram::where('short_code', '=', $marketing_program_short_code)->where('active', '=', '1')->first();

			if (!isset($marketing_program))
			{
				$marketing_program = MarketingProgram::where('short_code', '=', 'Retail')->where('active', '=', '1')->first();
			}
		}
		else
		{
			$marketing_program = MarketingProgram::where('short_code', '=', 'Retail')->first();
		}

		return View::make('subscription.index', array('user' => $this->user, 'marketing_program' => $marketing_program, 'stripe_public_key' => Config::get('app.stripe_public_key')));
	}

	public function getJoin()
	{
		return View::make('subscription.join');
	}

	public function postJoin()
	{
		$messageTitle = "";
		$message = "";

		try {
			$this->user->subscription(Input::get('plan'))->create(Input::get('stripeToken'), [
				'email' => $this->user->email
			]);

			$subject = 'Thank you for joining ilys!';

			$user = Auth::user();

			$name = $user->username;
			$email_address = $user->email;

			Mail::send(array('text' => 'emails.subscription.subscribed'), array(
				'name' => $name,
				'email_address' => $email_address), function($message) use ($email_address, $subject)
			{
				$message->to($email_address)->replyTo('hello@ilys.com', 'hello@ilys .com')->subject($subject);
			});

			return Redirect::action('StoryController@getDashboard')->with('info', 'You have successfully subscribed to ilys!');
		}
        catch(Stripe_CardError $e) {
            $messageTitle = 'Card Declined';
            $message = "Unfortunately this card was declined by the bank.  Please try again with another card.";
        }
        catch (Stripe_InvalidRequestError $e)
        {
            // Invalid parameters were supplied to Stripe's API
            $messageTitle = 'Oops...';
            $message = 'It looks like our payment processor encountered an error with the payment information. Please contact us before re-trying.';
        }
        catch (Stripe_AuthenticationError $e)
        {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $messageTitle = 'Oops...';
            $message = 'It looks like our payment processor API encountered an error. Please contact us before re-trying.';
        }
        catch (Stripe_ApiConnectionError $e)
        {
            // Network communication with Stripe failed
            $messageTitle = 'Oops...';
            $message = 'It looks like our payment processor encountered a network error. Please contact us before re-trying.';
        }
        catch (Stripe_Error $e)
        {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $messageTitle = 'Oops...';
            $message = 'It looks like our payment processor encountered a network error. Please contact us before re-trying.';
        }
        catch (Exception $e)
        {
            // Something else happened, completely unrelated to Stripe
            $messageTitle = 'Oops...';
            $message = 'It appears that something went wrong with your payment. Please contact us before re-trying.';
        }

		return Redirect::action('subscription')->with('error', $message);
	}

	public function getCancel()
	{
		$this->user->subscription()->cancel();

		return Redirect::action('subscription')->with('info', 'You have turned off auto-renew payments.');
	}

	public function getResume()
	{
		$this->user->subscription($this->user->stripe_plan)->resume();

		return Redirect::action('subscription')->with('info', 'You have resumed your subscription.');
	}

	public function getCard()
	{
		return View::make('subscription.card');
	}

	public function postCard()
	{
		$this->user->updateCard(Input::get('token'));

		return Redirect::action('subscription')->with('info', 'Your card details have been updated.');
	}
}
