@extends('layouts.default')

{{-- Content --}}
@section('content')
<form class="" role="form" method="post" action="start-session">
<div class="row">
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-default">
		  <div class="panel-heading">
			Choose your story.
		  </div>
		  <div class="panel-body">
			  <div class="form-group">
				<label for="new_story_name">Is this a new story?  Its name is:</label><br/>
			    <input type="text" class="form-control" placeholder="New story name." id="new_story_name" name="story_name">
				@if (count($stories) > 0) 
				<br/>
				<label for="story_name_from_list">Or, select from your existing stories:</label><br/>
				<select class="form-control" id="story_name_from_list" name="story_name_from_list">
					@foreach($stories as $story)
					<option value="{{$story->name}}">{{$story->name}}</option>
					@endforeach
				</select>
				@endif
			  </div>
			</div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading">
			Setup your session.
		  </div>
		  <div class="panel-body">
			<label for="session_name">Session name:</label><br/>
		    <input type="text" class="form-control" placeholder="Session name." id="session_name" name="session_name" autofocus>
			<br/>
			<label for="word_count_goal">Word count goal:</label><br/>
		    <input type="text" class="form-control" placeholder="Word count goal." id="word_count_goal" name="word_count_goal">
			<br/>
			<div class="pull-left">
				<label for="ninja_mode">Ninja Mode:</label>&nbsp;&nbsp;
				<input type="checkbox" checked data-toggle="toggle" data-onstyle="success" id="ninja_mode" name="ninja_mode">
				<br/><br/>
			</div>
			<div class="pull-right">
				<label for="backspace_buzzer">Backspace buzzer:</label>&nbsp;&nbsp;
				<input type="checkbox" checked data-toggle="toggle" data-onstyle="success" id="backspace_buzzer" name="backspace_buzzer">
				<br/><br/>
			</div>
			<button type="submit" class="btn btn-lg btn-primary btn-block">Start your session</button>
		  </div>
		</div>
	</div>
</div>
</form>
@endsection