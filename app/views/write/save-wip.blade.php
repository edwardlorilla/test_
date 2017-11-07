@extends('layouts.default')

{{-- Content --}}
@section('content')
<div class="row">
	<form class="" role="form" method="post" action="save-wip-to-story">
	<div class="col-lg-6 col-lg-offset-3">
@if (((count($stories) < 1)) || ($story_id == 0))
		<div class="panel panel-default">
		  <div class="panel-heading">
			What story will we save this session to?
		  </div>
		  <div class="panel-body">
			  <div class="form-group">
				<label for="new_story_name">Create a new story:</label><br/>
			    <input type="text" class="form-control" placeholder="New story name." id="new_story_name" name="story_name" maxlength="50" autofocus>
				@if (count($stories) > 0)
				<br/>
				<label for="story_name_from_list">Or, select from your existing stories:</label><br/>
				<select class="form-control" id="story_id_from_list" name="story_id_from_list">
					@foreach($stories as $story)
					<option value="{{$story->id}}">{{$story->name}}</option>
					@endforeach
				</select>
				@endif
			  </div>
		  </div>
		</div>
@else
	<input type="hidden" name="story_id_from_list" value="{{ $story_id }}">
@endif
	</div>
	<div class="col-lg-6 col-lg-offset-3">
		<div class="panel panel-default">
		  <div class="panel-heading">
			What will you name this session?
		  </div>
		  <div class="panel-body">
			  <div class="form-group">
				<label for="new_session_name">Session name:</label><br/>
			    <input type="text" class="form-control" placeholder="New session name." id="new_session_name" name="new_session_name" maxlength="50" autofocus>
				<br/><br/>
				<input type="hidden" name="writing_session_token" value="{{ $writing_session_token }}">
				<button type="submit" class="btn btn-lg btn-primary btn-block">Save your session</button>
			  </div>
		  </div>
		</div>
	</div>
	</form>
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/js/store.min.js')}}"></script>
@stop
