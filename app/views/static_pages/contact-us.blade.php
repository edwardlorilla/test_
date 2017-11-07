@extends('layouts.default')
@section('topScriptsStyles')
@stop
{{-- Content --}}
@section('content')
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-default">
		  <div class="panel-body" id="feedbackForm">
			<h3>Hi, we'd love to hear from you.</i></h3><br/>
			Please send us your message and we will reply as soon as possible.<br/><br/>
			<form role="form" method="POST" action="{{ URL::to('/contact-us') }}" accept-charset="UTF-8" id="contact-form">
				<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
				<input type="hidden" name="subject" value="Contact Us">
@if (Auth::guest())
				<input type="hidden" name="calling_url" value="/contact-us">
				<label for="Email">Your email address:</label>
				<input type="text" class="form-control" name="email" id="email" autofocus placeholder="Your email address"></input>
                <br/>
@else
				<input type="hidden" name="calling_url" value="/dashboard">
@endif
				<label for="message">Enter your message here.</label>
				<textarea class="form-control" style="resize:none;" rows="7" name="feedback_message" id="feedback_message" autofocus placeholder="Write your message here..."></textarea>
				<br/>
				<button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="0" id="submit-button">Send us your message</button>
			</form>
		  </div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    var contactForm = $( "#contact-form" );

@if (Auth::guest())
    contactForm.validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            feedback_message: {
                required: true
            }
        },
        messages: {
            email: "Please enter a valid email address",
            feedback_message: "Please write a message before sending"
        }
    });  
@else
    contactForm.validate({
        rules: {
            feedback_message: {
                required: true
            }
        },
        messages: {
            feedback_message: "Please write a message before sending"
        }
    });  
@endif

    
    $("#submit_button").click(function(){
        
        if (contactForm.valid())
        {
            var $this = $(this);
            $this.attr('disabled','disabled');
            $this.text("Creating your account");
            $('#contact-form').submit();
        }
    });
</script>
@stop