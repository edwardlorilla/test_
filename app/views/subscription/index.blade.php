@extends('layouts.default')

@section('content')
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-default">

	@if($user->subscribed())
		@if($user->cancelled())
			<div class="panel-heading">
				<i class="fa fa-times color-red"></i> Your membership is active, but is set to expire.
			</div>
			<div class="panel-body">
				Although you have turned off auto-renew for your membership payments, your account is still active for the remainder of your original subscription period. You can continue to write until {{ $user->subscription_ends_at->format('D M d, Y') }}.
				<br/><br/>
				You can <a href="{{ URL::action('subscription-resume') }}?_token={{ csrf_token() }}">turn on auto-renew payments</a> at any time.
			</div>
		@elseif($user->subscribed())
			<div class="panel-heading">
				<i class="fa fa-check color-green"></i> Your account is active and in good standing!
			</div>
			<div class="panel-body">
				<h2 class="text-center">Thank you for loving ilys!  :)</h2><br/>
				<h4 class="text-center">Your account is paid and fully active.</h4>
				<br/>
				<div class="text-center">If we can assist you with anything, please <a href="/contact-us">contact us</a>.</div>
				<br/><!--
				You can <a href="{{ URL::action('subscription-cancel') }}?_token={{ csrf_token() }}">turn off auto-renew</a> at any time.
				<br/><br/>

				Or you could instead choose to <a href="{{{ URL::to('/') }}}">write something</a> now.
								-->
			</div>
		@endif
	@else
		<div class="panel-heading">
			<i class="fa fa-check color-green"></i> Want to become a full member?
		</div>

		<div class="panel-body text-center defaultFontSize">
			{{ html_entity_decode($marketing_program->copy) }}
			<form action="{{ URL::action('subscription-join') }}" method="post" id="subscription-form">
			  <script
			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			    data-key="{{ $stripe_public_key }}"
			    data-image="/assets/img/ilysLogo128.jpg"
			    data-name="ilys"
			    data-email="{{$user->email}}"
			    data-description="{{$marketing_program->stripe_data_description}}"
			    data-amount="{{$marketing_program->stripe_data_amount}}"
			    data-label="Subscribe now">
			  </script>
				<input type="hidden" name="plan" value="{{$marketing_program->stripe_plan}}">
				<input type="hidden" name="stripeToken" id="stripeToken" value="">
			  {{ Form::token() }}
			</form><br/><br/>
			<a href="https://stripe.com/" target="_new">Stripe</a> processes your payments securely.<br/><br/>
			<h4><i class="fa fa-heart" style="color: red; margin-right: 15px;"></i>Thank you for loving ilys<i style="color: red; margin-left: 15px;" class="fa fa-heart"></i></h4><br/>
		@endif
		</div>
    </div>
</div>
<script>
	var handler = StripeCheckout.configure({
	  key: '{{ $stripe_public_key }}',
	  locale: 'auto',
	  token: function(token) {
	    $('input#stripeToken').val(token.id);
	    $('form').submit();
	  }
	});

	var swapPlan = function(event, name, description, amount, plan) {
		event.preventDefault();

		$('#subscription-form').find('input[name="plan"]').val(plan);

		handler.open({
      amount: parseFloat(amount),
			name: name,
			description: description,
			email: '{{$user->email}}'
    });
	}
</script>
@stop
