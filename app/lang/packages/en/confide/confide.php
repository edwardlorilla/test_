<?php

return array(

    'username' => 'Username',
    'password' => 'Password',
    'password_confirmation' => 'Confirm Password',
    'e_mail' => 'Email',
    'username_e_mail' => 'Username or Email',

    'signup' => array(
        'title' => 'Signup',
        'desc' => 'Signup for new account',
        'confirmation_required' => 'Confirmation required',
        'submit' => 'Create new account',
    ),

    'login' => array(
        'title' => 'Login',
        'desc' => 'Enter your credentials',
        'forgot_password' => 'Forgot your password?',
        'remember' => 'Remember me',
        'submit' => 'Login',
    ),

    'forgot' => array(
        'title' => 'Forgot password',
        'submit' => 'Reset password',
    ),

    'alerts' => array(
        'account_created' => 'Please check your email for instructions on how to activate your new account.',
        'instructions_sent'       => 'Please check your email for the instructions on how to confirm your account.',
        'too_many_attempts' => 'Too many attempts. Try again in few minutes.',
        'wrong_credentials' => 'Incorrect username, email or password.',
        'not_confirmed' => 'Your account may not be confirmed. Check your email for the confirmation link',
        'confirmation' => 'Your account has been confirmed! You may now login.',
        'wrong_confirmation' => 'Wrong confirmation code.',
        'password_forgot' => 'Please check your email for instructions to reset your password.',
        'wrong_password_forgot' => 'User not found.',
        'password_reset' => 'Your password has been changed successfully.',
        'wrong_password_reset' => 'Invalid password. Try again',
        'wrong_token' => 'The password reset token is not valid.',
        'duplicated_credentials' => 'The credentials provided have already been used. Try with different credentials.',
    ),

    'email' => array(
        'account_confirmation' => array(
            'subject' => 'Please confirm your ilys account.',
            'greetings' => 'Hi :name',
            'body' => 'We have received your application for an ilys account.  To complete your registration, please click on the link below:',
            'farewell' => 'Thanks from ilys!',
        ),

        'password_reset' => array(
            'subject' => 'Password Reset',
            'greetings' => 'Hi :name',
            'body' => 'To change your password, please click on the link below:',
            'farewell' => 'Thanks from ilys!',
        ),
    ),

);
