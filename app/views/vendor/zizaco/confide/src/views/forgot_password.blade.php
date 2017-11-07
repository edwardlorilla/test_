@extends('layouts.default')
{{-- Content --}}
@section('content')
<br/>
<img src="/assets/img/NaNoilys.jpg" class="img-responsive" style="margin: 0 auto; width: 350px;">
<br/>
<br/>
<form class="form-signin" role="form" method="POST" action="{{ URL::to('/users/forgot_password') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <h2 class="form-signin-heading">Forgot your password?</h2>
    <div class="well text-justify" style="margin: 10px 0px 10px 0px;">
        Please enter your email address and we'll send you an email with instructions for resetting your password.
    </div>
    <label class="sr-only" for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="email" name="email" id="email" value="{{{ Input::old('email') }}}" tabindex="1">
    <br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="1">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
</form>
@stop
