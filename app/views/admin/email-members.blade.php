@extends('layouts.default')
@section('topScriptsStyles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.css"/>
@stop
{{-- Content --}}
@section('content')
<h2>Email Members</h2>
<h4>Enter sql where clause</h4>
<textarea id="get-users-sql" style="width: 100%; height: 50px;"></textarea><br/>
<span>
	<button type="button" id="get-users" class="btn btn-lg btn-primary btn-block">Get users</button>
	<button type="button" id="edit-sql" class="btn btn-lg btn-primary btn-block" style="display: none;">Edit SQL</button>
</span>
<br/><br/>
<h4>Users to send email to</h4>
<table id="users-table" class="display" width="100%">
	<thead>
			<tr>
					<th>Username</th>
					<th>Email</th>
			</tr>
	</thead>
</table>
<br/></br/>
<h4>Subject</h4>
<input type="text" style="width:100%;" id="email-subject">
<br/>
<h4>Message to send</h4>
<textarea id="email-message" style="width: 100%; height: 400px;"></textarea><br/>
<button disabled type="button" id="send-message" class="btn btn-lg btn-primary btn-block">Send message</button><br/>

@stop

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/af-2.1.2/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/cr-1.3.2/fc-3.2.2/fh-3.1.2/kt-2.1.3/r-2.1.0/rr-1.1.2/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
<script type="text/javascript">
	var users_to_send_to;

	$(document).ready(function() {
	});

	$('#email-message').keydown(function(){
		$('#send-message').prop('disabled', false);
	});

	$('#email-message').blur(function(){
		if ($('#email-message').val().length < 1) {
			$('#send-message').prop('disabled', true);
		}
	});

	$('#edit-sql').click(function(){
		$('#get-users-sql').prop('disabled', false);
		$('#edit-sql').hide();
		$('#get-users').show();
	});

	$('#get-users').on('click', function(){
		var getUserSql = $('#get-users-sql').val();

		ajaxData = {
				sql: getUserSql
		};

		$.ajaxSetup({
				headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});

		$.post( "/admin/get-users", ajaxData)
				.done(function( data ) {
					users_to_send_to = data;

					if (users_to_send_to.length) {
							$('#get-users-sql').prop('disabled', true);
							$('#get-users').hide();
							$('#edit-sql').show();
							// clear table in case it has data in it
							$('#users-table').DataTable().clear().draw();
							$('#users-table').DataTable( {
					        data: data,
									destroy: true,
									columns: [
										{"data": "username"},
										{"data": "email"}
									]
					    } );
						} else {
							alert('No users returned, fix SQL.');
							$('#get-users-sql').focus();
						}
					});
	});

	$('#send-message').on('click', function(){
		// Do some checks on readiness.
		var ready_to_send = true;

		var get_users_sql = $("#get-users-sql").val();
		var subject = $('#email-subject').val();
		var message = $('#email-message').val();

		var errors = [];

		if (get_users_sql.length < 1) {
			errors.push('SQL empty.');
		}

		if (users_to_send_to.length.length < 1) {
			errors.push('No users to send to.');
		}

		if (subject.length < 1) {
			errors.push('Subject empty.');
		}

		if (message.length < 1) {
			errors.push('Message empty.');
		}

		if (errors.length) {
			alert (errors);
			ready_to_send = false;
		}

		if (ready_to_send) {
			$('#send-message').prop('disabled', true);
			$('#email-message').prop('disabled', true);
			$('#email-subject').prop('disabled', true);

			var getUserSql = $('#get-users-sql').val();

			ajaxData = {
					sql: getUserSql,
					subject: subject,
					message_text: message
			};

			$.ajaxSetup({
					headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
			});

			$.post( "/admin/send-message-to-users", ajaxData)
					.done(function( data ) {
						alert('Wrote message ' + data + '. Now kick off Artisan to send.');
						// reset form
						$('#get-users-sql').val('');
						$('#email-message').val('');
						$('#email-subject').val('');
						$('#users-table').DataTable().clear().draw();
						window.scrollTo(0, 0);
						$('#edit-sql').hide();
						$('#get-users').show();
						$('#get-users-sql').prop('disabled', false);
						$('#send-message').prop('disabled', true);
						$('#email-message').prop('disabled', false);
						$('#email-subject').prop('disabled', false);
					});
		}
	});
</script>
@stop
