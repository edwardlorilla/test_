@extends('layouts.default')
{{-- Content --}}
@section('content')
<h2>Hi, welcome to Admin.</h2>
<a href="/admin/email-members" class="btn btn-lg btn-primary btn-block">Email Members</a>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
	});
</script>
@stop
