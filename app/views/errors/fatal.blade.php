@extends('layouts.default')
@section('topScriptsStyles')
@stop
{{-- Content --}}
@section('content')
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-default">
		  <div class="panel-body" id="feedbackForm">
			<h3>Hello, please forgive me. I've experienced an error.&nbsp;&nbsp;&nbsp;<i class="fa fa-frown-o fa-1x"></i></h3><br/>
			We are very concerned about you having an exceptional experience with ilys and are focused on creating this for you.  While errors do sometimes happen, we want to assure you they are looked at carefully and addressed thoroughly.<br/><br/>
			So that we can more accurately get at the cause of the error, please help us understand what happened.
			<br/><br/>
			Please tell us what you remember about the experience leading up to this. Your detailed description will help our engineers find the cause and produce the right solution.<br/><br/>
			@if (Auth::check())
			You can always access your <a href="/recent-autosaves">recent autosaves</a> to find your text, if you need to.<br/><br/>
			@endif
			<form role="form" method="POST" action="{{ URL::to('/error-report') }}" accept-charset="UTF-8">
				<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
				<input type="hidden" name="calling_url" value="/dashboard">
				<input type="hidden" name="subject" value="Error Report">
				<label class="sr-only" for="message">Enter your message here.</label>
				<textarea class="form-control" style="resize:none;" rows="7" name="feedback_message" id="feedback_message" autofocus placeholder="Write your message here..."></textarea>
				<br/>
				<button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="0">Tell us what happened</button>
			</form>
		  </div>
		</div>
	</div>
</div>
@stop

@section('scripts')
@stop