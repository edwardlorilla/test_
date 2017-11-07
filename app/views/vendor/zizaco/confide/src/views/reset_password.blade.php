@extends('layouts.default')
{{-- Content --}}
@section('content')
<br/>
<img src="/assets/img/NaNoilys.jpg" class="img-responsive" style="margin: 0 auto; width: 350px;">
<br/>
<br/>
<form class="form-signin" role="form" method="POST" action="{{ URL::to('/users/reset_password') }}" accept-charset="UTF-8">
    <input type="hidden" name="token" value="{{{ $token }}}">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <h2 class="form-signin-heading">Reset your password</h2>
    <label class="sr-only" for="password">{{{ Lang::get('confide::confide.e_mail') }}}</label>
    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password" tabindex="0" required>
    <br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="1">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
</form>
@stop
