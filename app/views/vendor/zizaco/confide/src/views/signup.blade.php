@extends('layouts.default')
{{-- Content --}}
@section('content')
    <br/>
    <img src="/assets/img/NaNoilys.jpg" class="img-responsive" style="margin: 0 auto; width: 350px;">
    <br/>
    <br/>
    <form class="form-signin" id="signUpForm" role="form"  method="POST" action="{{{ URL::to('users') }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <input type="hidden" id="allow_marketing" name="allow_marketing" value="1">
    <h2 class="form-signin-heading">Welcome to ilys...</h2>
    <div class="well text-justify" style="margin: 10px 0px 10px 0px;">
        Please fill in the form to create an account.
        <!---  After sending it to us, check your email inbox for an important message from ilys.<br/><br/>
        The email message will contain a link.  Please click this link to confirm your registration and complete the creation of your new account.
        <br/><br/>After you confirm your account, you will be able to sign in and have much fun with ilys!
        <br/><br/>If you do not see the message in your inbox, please check your spam folder as email services sometimes are confused. If you ever want assistance, please <a href="/contact-us">contact us</a>.
      -->
    </div>

    <label for="username" class="sr-only">{{{ Lang::get('confide::confide.username') }}}</label>
    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}" required tabindex="1">
    <label for="email" class="sr-only">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="email" name="email" id="email" value="{{{ Input::old('email') }}}" required tabindex="2">
    <label for="password" class="sr-only">{{{ Lang::get('confide::confide.password') }}}</label>
    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password" required minlength="4" tabindex="3">
    <br/>
    <label for="agree_tos">
      <table border="0">
          <tr valign="top">
              <td><input type="checkbox" id="agree_tos"></td>
              <td>&nbsp;&nbsp;&nbsp;</td>
              <td>I agree to the <a href="/terms-of-service" target="_blank">Terms of Service</a>.</td>
          </tr>
      </table>
    </label>
    <br/>
    <br/>
    <button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="4" id="submit_button" disabled="disabled">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
</form>
<br/>
<br/>
@stop

@section('scripts')
<script src="{{asset('assets/js/highcharts.js')}}"></script>

<script type="text/javascript">
    var signUpForm = $( "#signUpForm" );

    signUpForm.validate({
        rules: {
            username: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 4
            },
            agree_tos: "required"
        },
        messages: {
            username: "Please enter your Username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 4 characters long"
            },
            email: "Please enter a valid email address",
            agree: "Please accept our policy"
        }
    });

    $("#agree_tos").click(function(){
        if ($("#agree_tos").is(':checked'))
        {
            $("#submit_button").removeAttr('disabled');
        }
        else
        {
            $("#submit_button").attr('disabled','disabled');
        }
    });

    $("#submit_button").click(function(){

        if (signUpForm.valid())
        {
            var $this = $(this);
            $this.attr('disabled','disabled');
            $this.text("Creating your account");
            $('#signUpForm').submit();
        }
    });
</script>
@stop
