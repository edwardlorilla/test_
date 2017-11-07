@extends('layouts.default')
@section('topScriptsStyles')
@stop
{{-- Content --}}
@section('content')
<div class="row text-center">
	<br/>
	<h4>
		Question: What does ilys stand for?<br/><br/>
		Answer: <span style="color: #d9230f;">i</span> <span style="color: #d9230f;">l</span>ove <span style="color: #d9230f;">y</span>our <span style="color: #d9230f;">s</span>tories.
		<br/>
		<br/>
		<br/>
		Question: That's cute, but what does it REALLY stand for?<br/><br/>
		Answer: Watch this interview to find out...
	</h4>
	<br/>
	(hint: it's about the fulfillment of human potential)
	<br/>
	<br/>
	<br/>
	<iframe width="560" height="315" src="https://www.youtube.com/embed/tbxnemjEIHI" frameborder="0" allowfullscreen></iframe>
	<br/><br/><br/>
	Please <a href="/contact-us">send a message</a> with your thoughts or questions :)<br/>
	<br/><br/>
</div>
<script>
	window.intercomSettings = {
		app_id: "abson6zr"
	};
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/abson6zr';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
@stop
