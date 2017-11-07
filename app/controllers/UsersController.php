<?php

/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class UsersController extends Controller
{

    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return View::make(Config::get('confide::signup_form'));
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {
        $marketing_program_short_code = Session::get('marketing_program_short_code');

        if (!isset($marketing_program_short_code)) {
          $marketing_program_short_code = 'Retail';
        }

        $marketing_program            = MarketingProgram::where('short_code', '=', $marketing_program_short_code)->where('active', '=', '1')->first();
        $free_trial_word_count_limit  = Config::get('app.free_trial_word_count_limit');

        if ((isset($marketing_program->free_trial_word_count_limit)) && ($marketing_program->free_trial_word_count_limit > 0))
        {
          $free_trial_word_count_limit = $marketing_program->free_trial_word_count_limit;
        }

        if (Input::get('allow_marketing') === '1')
        {
            $allow_marketing = 1;
        }
        else
        {
            $allow_marketing = 0;
        }

        $repo = App::make('UserRepository');
        $user = $repo->signup(Input::all());

        if ($user->id) {
            if (Config::get('confide::signup_email')) {
                Mail::send(
                    'emails.auth.quickQuestion',
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject('A quick question from ilys?');
                    }
                );
            }

            $user->allow_marketing = $allow_marketing;
            $user->marketing_program_short_code = $marketing_program_short_code;
            $user->free_trial_word_count_limit = $free_trial_word_count_limit;
            $user->confirmed = true;
            $user->save();

            Auth::login($user);

            if (isset($marketing_program->notification_email))
            {
              $notification_email = $marketing_program->notification_email;

              if ((isset($notification_email) && ($notification_email != ''))) {
                try{
                  Mail::send(
                      'emails.marketing_program.notify_signup',
                      compact('user'),
                      function ($message) use ($user, $notification_email, $marketing_program_short_code) {
                          $message
                              ->to($notification_email, $notification_email)
                              ->subject($user->email . ' ' . $marketing_program_short_code . ' signed up.');
                      }
                  );
                }
                catch(\Exception $e){
                }
              }
            }

            return Redirect::to('dashboard');
        } else {
            $error = $user->errors()->all(':message');

            return Redirect::action('UsersController@create')
                ->withInput(Input::except('password'))
                ->with('error', $error);
        }
    }

    /**
     * Displays the login form
     *
     * @return  Illuminate\Http\Response
     */
    public function login()
    {
        if (Confide::user()) {
            return Redirect::to('/');
        } else {
            return View::make(Config::get('confide::login_form'));
        }
    }

    /**
     * Attempt to do login
     *
     * @return  Illuminate\Http\Response
     */
    public function doLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            try{
              $user = Auth::user();

              Mail::send(
                  'emails.auth.loggedin',
                  compact('user'),
                  function ($message) use ($user) {
                      $message
                          ->to("mg@ilys.com", "mg@ilys.com")
                          ->subject($user->email . ' ' . $user->marketing_program_short_code . ' '
                          . ((isset($user->stripe_active) && ($user->stripe_active == 1)) ? 'mem' : 'nonmem') . ' '
                          . ((($user->free_trial_word_count_limit - $user->total_words_written) > 0) ? ($user->free_trial_word_count_limit - $user->total_words_written) : '') . ' '
                          . ' logged in.');
                  }
              );
            }
            catch(\Exception $e){
            }

            return Redirect::intended('/');
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::action('UsersController@login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     *
     * @return  Illuminate\Http\Response
     */
    public function confirm($code)
    {
        if (Confide::confirm($code)) {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
            return Redirect::action('UsersController@login')
                ->with('info', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
            return Redirect::action('UsersController@login')
                ->with('error', $error_msg);
        }
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     * @return  Illuminate\Http\Response
     */
    public function doForgotPassword()
    {
        if (Confide::forgotPassword(Input::get('email'))) {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
            return Redirect::action('UsersController@login')
                ->with('info', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
            return Redirect::action('UsersController@doForgotPassword')
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Shows the change password form with the given token
     *
     * @param  string $token
     *
     * @return  Illuminate\Http\Response
     */
    public function resetPassword($token)
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     * @return  Illuminate\Http\Response
     */
    public function doResetPassword()
    {
        $repo = App::make('UserRepository');

        // made password confirmation automatic
        $input = array(
            'token'                 =>Input::get('token'),
            'password'              =>Input::get('password'),
            'password_confirmation' =>Input::get('password'),
        );

        // By passing an array with the token, password and confirmation
        if ($repo->resetPassword($input)) {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');

            if ($repo->login($input)) {
                return Redirect::intended('/');
            }

            return Redirect::action('UsersController@login')
                ->with('info', $notice_msg);
        } else {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');

            return Redirect::action('UsersController@resetPassword', array('token'=>$input['token']))
                ->withInput()
                ->with('error', $error_msg);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return  Illuminate\Http\Response
         */
    public function logout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

    public function timeout()
    {
        Confide::logout();

        return View::make(Config::get('confide::login_form'));
    }

    public function keepAlive()
    {
        return 'ok';
    }
}
