@extends('layouts.default')
{{-- Content --}}
@section('content')
@if (!$autosaves->isEmpty())
@foreach($autosaves as $autosave)
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
		{{$autosave->updated_at}}
		</div>
		<div class="panel-body">
		{{ nl2br($autosave->content_in_progress) }}
		</div>
	</div>
</div>
@endforeach
{{ $autosaves->links() }}
@else
<div class="row">
	</br>
	<div class="panel panel-default">
		<div class="panel-body">
			You have not yet saved anything.  Want to <a href="/dashboard">write something</a>?
		</div>
	</div>
</div>
@endif
@endsection
