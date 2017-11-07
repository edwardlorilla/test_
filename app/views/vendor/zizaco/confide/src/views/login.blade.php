@extends('layouts.default')
{{-- Content --}}
@section('content')
    <br/>
    <img src="/assets/img/NaNoilys.jpg" class="img-responsive" style="margin: 0 auto; width: 350px;">
    <br/><br/>
      <form class="form-signin" role="form" method="POST" action="{{{ URL::to('/users/login') }}}" accept-charset="UTF-8">
        <h2 class="form-signin-heading">Sign in</h2>
        <label for="inputEmail" class="sr-only">{{{ Lang::get('confide::confide.username_e_mail') }}}</label>
        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" required autofocus tabindex="1">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" required tabindex="2">
        <!--
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me" tabindex="3"> Remember me
          </label>
        </div>
        -->
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="4">Sign in</button>
        <br/>
        <span class="text-center">
            <a href="{{{ URL::to('/users/forgot_password') }}}">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
        </span>
      </form>
    <br/>
    <br/>
@stop
