@extends('layouts.default')
@section('topScriptsStyles')
@stop
{{-- Content --}}
@section('content')
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/01_dashboard.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/02_continue_session.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/03_progress_tracking.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/04_storiesInDashboard.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/05_begin_session.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/06_writing_interface.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/07_no_backspace.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/08_ninjaMode.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/09_peekmode.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/10_finishedGoal.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/11_editmode.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/12_savestory.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		<img src="{{asset('assets/img/screenshots/13_storyscreen.jpg')}}">
	</div>
</div>
<br/><br/><hr><br/><br/>
<div class="row">
	<div class="text-center">
		If you have questions, <a href="{{{ URL::to('contact-us') }}}">send us a note</a>.<br/><br/><br/>
	</div>
</div>
<script>
	window.intercomSettings = {
		app_id: "abson6zr"
	};
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/abson6zr';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
@stop
