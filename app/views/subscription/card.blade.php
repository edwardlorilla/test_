@extends('layouts.default')

@section('content')
	<form action="{{ URL::action('subscription-card') }}" method="post" id="subscription-form">
		<div class="row">
			<div class="large-6 columns">
				@include('subscription.partials._card')
				<button class="button">Update Card</button>
			</div>
		</div>

		{{ Form::token() }}
	</form>
@stop

@section('scripts')
	<script src="https://js.stripe.com/v2" type="text/javascript"></script>
	<script src={{ asset('js/stripe.js') }} type="text/javascript"></script>
@stop