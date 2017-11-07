@extends('layouts.default')

{{-- Styles/Scripts --}}
@section('topScriptsStyles')
@stop

{{-- Content --}}
@section('content')
@if ( Session::get('error') )
<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
@if ( Session::get('notice') )
<div class="alert">{{ Session::get('notice') }}</div>
@endif

<div class="row">
	@if ($total_words_written == 0)
	<div class="col-lg-10 col-lg-offset-1">
		<div class="well" id="welcome-panel">
			<canvas class="welcome-canvas"></canvas>
			<div style="width: 100%; text-align: center; padding: 25px;">
				<h3 style="color: white; margin: 0px;">Awesome, you made it!&nbsp;&nbsp;&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></h3>
			</div>
		</div>
	</div>
	@endif

	@if ($free_trial_word_count_limit >= 1000000000)
	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-default">
		  <div class="panel-heading">
		  	Welcome to the Billionaires Club!
		  </div>
		  <div class="panel-body" style="color: gold;">
			<div class="row">
				<br/>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-2 pull-left text-center">
                    <span class="hidden-xs">
						<i class="fa fa-star"></i>&nbsp;&nbsp;
						<i class="fa fa-star"></i>&nbsp;&nbsp;
						<i class="fa fa-star"></i>&nbsp;&nbsp;
						<i class="fa fa-star"></i>&nbsp;&nbsp;
					</span>
					<i class="fa fa-star"></i>&nbsp;&nbsp;
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 text-center" style="color:red;">
					<strong>Thank you for loving ilys!</strong>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-2 pull-left text-center">
          <span class="hidden-xs">
						&nbsp;&nbsp;<i class="fa fa-star"></i>
						&nbsp;&nbsp;<i class="fa fa-star"></i>
						&nbsp;&nbsp;<i class="fa fa-star"></i>
						&nbsp;&nbsp;<i class="fa fa-star"></i>
					</span>
					&nbsp;&nbsp;<i class="fa fa-star"></i>
				</div>
				<br/><br/>
			</div>
		  </div>
		</div>
	</div>
	@elseif (($user_in_trial_period == true) && ($user_subscribed == false))
	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-default">
		  <div class="panel-heading">
		  	Your Free Trial
		  </div>
		  <div class="panel-body text-center">
			<h4>You have <strong>{{number_format($free_trial_word_count_limit - $total_words_written)}}</strong> free trial words to play with.</h4>
			{{ link_to('subscription', 'Click here to subscribe.', $attributes = array(), $secure = null) }}
		  </div>
		</div>
	</div>
	@endif

	<div class="col-lg-10 col-lg-offset-1">
		@if ($marketing_program_short_code == "nanowrimo")
			<div class="well hidden" id="nanocountdown" style="margin-bottom: 40px;">
				<div class="text-center">
					<div style="width: 100%; font-size: 2.5em; text-align: center; color: white; padding: 10px 15px 0px 15px; font-weight: bold;"><span id="nano-countdown-content">????</span>
					Seconds Until NaNoWriMo!</div>
					<div id="set-timezone" class="set-timezone" style="padding: 15px; font-size: 1.4em; color: white;">Please ensure your time zone is correct: <a href="#"><span id="timezone-text">{{ $timezone }}</span></a></div>
				</div>
			</div>
			<div class="well hidden" id="nano-instruments" style="display: flex;">
				<div id="nanoguage" class="text-center">
					<div id="nanowrimoWordsWritten" style="font-size: 2.5em;"></div>
					<div>
						<canvas width=240 height=70 id="canvas-preview"></canvas>
					</div>
					<div style="font-size: 1.3em;">Words Typed</div>
				</div>
				<div id="nanostats" style="margin-right: 25px;">
					<div class="nanostatsunit" style="padding: 7px;">
						<div id="nanoremainingWordsLabel">Words to go:</div><div id="nanoremainingWordsValue"></div>
					</div>
					<div class="nanostatsunit" style="padding: 0px 7px 7px 7px; border-bottom: 2px solid white;">
						<div id="nanoremainingDaysLabel">Days remaining: <span style="font-size: .5em; margin-left: 10px;" class="set-timezone"><a href="#">(Change time zone)</a></span></div><div id="nanoremainingDaysValue"></div>
					</div>
					<div class="nanostatsunit" style="padding: 12px 7px 7px 5px;">
						<div id="nanotargetWordsPerDaysLabel" style="font-size: 1.3em; color: lightyellow;">Daily Words Goal:</div><div id="nanotargetWordsPerDaysValue" style="font-size: 1.3em; color: lightyellow;"></div>
					</div>
				</div>
			</div>
			<div id="nanoprize-banner" class="text-center">
				Win NaNoWriMo with ilys and <a href="https://www.ilys.com/nanoprize" target="_new">possibly $1,008.01 too</a>?
			</div>
		@endif
		<div class="panel panel-default">
		  <div class="panel-heading">
		    Write Something...
		  </div>
		  <div class="panel-body">
			@if ((isset($writing_session) && (strlen(trim($writing_session->content_in_progress)) > 0)))
				<div id="continue-session-details">
					<div style="display: flex; justify-content: space-between; margin-bottom: 15px; align-items: center;">
						<span id="continue-session-header" style="font-weight: bold;"></span>
						<div style="display: flex; justify-content: flex-end;">
							@if ($user_in_trial_period == true || $user_subscribed == true)
							<button type="button" id="continue_session" class="btn btn-md btn-primary" style="margin-right: 10px;">Continue</button>
							@endif
							<button type="button" id="save_session" class="btn btn-md btn-primary">Save</button>
						</div>
					</div>
					<div class="well text-justify" id="continue-session-text"></div>
					<form method="POST" id="continue_writing_session" action="continue-writing-session" accept-charset="UTF-8">
						{{Form::token()}}
						<input type="hidden" id="writing_session_token" name="writing_session_token" value="">
						<input type="hidden" id="user_id" name="user_id" value="">
						<input type="hidden" id="story_id" name="story_id" value="">
						<input type="hidden" id="story_name" name="story_name" value="">
						<input type="hidden" id="session_id" name="session_id" value="">
						<input type="hidden" id="session_name" name="session_name" value="">
	  				<input type="hidden" id="story_content_id_in_progress" name="story_content_id_in_progress" value="">
						<input type="hidden" id="content_in_progress" name="content_in_progress" value="">
						<input type="hidden" id="words_to_write" name="words_to_write" value="">
						<input type="hidden" id="word_count" name="word_count" value="">
						<input type="hidden" id="is_ninja_mode" name="is_ninja_mode" value="{{$writing_session->is_ninja_mode}}">
						<input type="hidden" id="local_storage_updated_at" name="local_storage_updated_at" value="">
					</form>
					<hr width="100%">
				</div>
			@endif
			@if ($user_in_trial_period == true || $user_subscribed == true)
				{{ Form::open(array('url' => 'create-writing-session', 'id' => "new_session_form")) }}
					<input type="hidden" id="new_session_user_id" name="new_session_user_id" value="">
					<input type="hidden" id="new_session_story_id" name="new_session_story_id" value="">
					<input type="hidden" id="new_session_story_name" name="new_session_story_name" value="">
					<input type="hidden" id="new_session_session_id" name="new_session_session_id" value="">
					<input type="hidden" id="new_session_session_name" name="new_session_session_name" value="">
					<button type="submit" class="btn btn-lg btn-primary btn-block" id="new_session_button">Create new session</button>
				{{ Form::close() }}
			@elseif ($user_in_trial_period == false && $user_subscribed == false)
				<h3 class="text-center">Thank you for trying ilys :)</h3>
				<br/>
				<div class="text-center">You have used all of your free trial words and we hope you loved it!
					<br/>
					<br/>
					If you find ilys to be truly helpful in freeing your creative genius,
					<br/>
					then we invite you to continue the journey with us:
					<br/><br/>
				</div>
				<h4 class="text-center">{{ link_to('subscription', 'Click here to subscribe to ilys.', $attributes = array(), $secure = null) }}</h4>
			@endif
		  </div>
		</div>
	</div>

	<div id="confirm-session-in-progress-delete-modal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Clear your previous session?</h4>
	            </div>
	            <div class="modal-body">
	                <p>Would you like to save your previous session before creating another?</p>
	                <p class="text-warning"><small>If you choose to clear it, it will be gone forever. But if you save it, you can continue with it later.</small></p>
	            </div>
	            <div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-primary" id="save_session_modal">Save session</button>
	                <button type="button" class="btn btn-primary" id="confirm-clear-session">Clear and create new session</button>
	            </div>
	        </div>
	    </div>
	</div>

	<div id="set-timezone-modal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Time Zone Setup</h4>
	            </div>
	            <div class="modal-body">
	                <p>Please enter your correct time zone for NaNoWriMo clock accuracy.</p>
									<?php
										$selected = 'US/Central';
										$placeholder = 'Select a timezone';
										$formAttributes = array('class' => 'timezone-select', 'id' => 'timezone', 'name' => 'timezone');
										$optionAttributes = array('customValue' => 'true');
									?>
									{{Timezone::selectForm($selected, $placeholder, $formAttributes, $optionAttributes)}}
	            </div>
	            <div class="modal-footer">
									<button type="button" class="btn btn-primary" id="save-timezone-button">Save</button>
	            </div>
	        </div>
	    </div>
	</div>

	@if (count($stories) > 0)
	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-default">
		    <div class="panel-heading">
					Your Stories
					<div class="pull-right">Total Words: {{number_format($stories->sum('total_word_count'))}}</div>
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<tr>
					    	<td align="left">Name</td>
					    	<td align="right">Words</td>
						</tr>
					</thead>
					<tbody>
						@foreach($stories as $story)
						<tr class="story-tr" data-story-id="{{$story->id}}">
							<td><a href="show-story/{{$story->id}}"><span class="story-name">{{e($story->name)}}</span></a></td>
							<td align="right">{{number_format($story->total_word_count)}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif
	<div class="col-lg-10 col-lg-offset-1" id="statsChart">
		<div class="panel panel-default">
		    <div class="panel-heading">
					Your Writing Habit
		    </div>
		    <div class="panel-body">
		    	<div id="highChart" style="width:100%; height:300px;"></div>
		    </div>
		</div>
	</div>
	@if (count($team_stories) > 0)
	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-default">
		    <div class="panel-heading">
				Your Teams
		    </div>
		    <div class="panel-body">
				<table class="table">
					<thead>
						<tr>
					    	<td align="left"><strong>Name</strong></td>
					    	<td align="right"><strong>Words</strong></td>
						</tr>
					</thead>
					<tbody>
						@foreach($team_stories as $team_story)
						<tr>
							<td><a href="show-story/{{$team_story->id}}">{{e($team_story->name)}}</a></td>
							<td align="right">{{number_format($team_story->total_word_count)}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@endif

	<div class="col-lg-10 col-lg-offset-1">
		<div class="panel panel-default">
		  <div class="panel-heading" id="feedbackFormDisplay">
			<table width="100%" border="0" margin="0">
				<tr>
				<td>Want help?</td>
				<td align="right"><i class="fa fa-chevron-down" id="feedbackCollapseIcon"></i></td>
				</tr>
			</table>
		  </div>
		  <div class="panel-body hidden" id="feedbackForm">
			<form role="form" method="POST" action="{{ URL::to('/send-feedback') }}" accept-charset="UTF-8">
				<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
				<input type="hidden" name="subject" value="Feedback from user">
				<label class="sr-only" for="message">Enter your message here.</label>
				<textarea class="form-control" style="resize:none;" rows="4" name="feedback_message" id="feedback_message" autofocus placeholder="Write your message here..."></textarea>
				<br/>
				<button class="btn btn-lg btn-primary btn-block" type="submit" tabindex="0">Send us your message</button>
			</form>
		  </div>
		</div>
	</div>
</div>

@stop

@section('scripts')
<script src="{{asset('assets/js/highcharts.js')}}"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/store.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.min.js"></script>

@if ($marketing_program_short_code == "nanowrimo")
<script src="{{asset('assets/js/guage.min.js')}}"></script>
@endif

<script type="text/javascript">
	var secondsTillGoalStarts = 0;
	var countdownTimer = null;

	$(function () {
		$.get( "/get-writing-session-token?_=" + new Date().getTime(), function(data) {})
			.done(function(data) {
				if (data) {
					setTimeout(function() {
						$('#writing_session_token').val(data);
					}, 100);
				}
			});

		@if ((isset($writing_session) && (strlen(trim($writing_session->content_in_progress)) > 0)))
			var ilys_server_storage_updated_at = {{$writing_session->local_storage_updated_at ? $writing_session->local_storage_updated_at : "0"}};
			var ilys_local_storage_updated_at = localStorage.getItem('ilysLocalStorageUpdatedAt');
			var ilys_local_storage_session_id = localStorage.getItem('ilysSessionId');
			var ilys_local_storage_session_name =  decodeURI(localStorage.getItem('ilysSessionName'));
			var ilys_local_storage_story_name = decodeURI(localStorage.getItem('ilysStoryName'));
			var ilys_local_storage_story_id = localStorage.getItem('ilysStoryId');

			if (ilys_server_storage_updated_at < ilys_local_storage_updated_at)
			{
				var continuedTextLimit = 1190;
				var continueTextString = $('#continue-session-text').text(localStorage.getItem('ilysWritingInProgress').substring(0, continuedTextLimit)).text();
				if (continueTextString.length >= continuedTextLimit)
				{
					continueTextString = continueTextString + '... (continued)';
				}

				$('#continue-session-text').text(continueTextString);
			}
			else
			{
				{{ $escaped_content_in_progress_js }}
				$('#continue-session-text').html(continueTextString).text();
			}

			if (ilys_local_storage_session_id > "0")
			{
				if (ilys_local_storage_session_name === 'undefined')
				{
					ilys_local_storage_session_name = "Untitled";
				}


        if (ilys_local_storage_story_name.length > 25) {
          ilys_local_storage_story_name = ilys_local_storage_story_name.substring(0, 25) + '..';
        }

        if (ilys_local_storage_session_name.length > 25) {
          ilys_local_storage_session_name = ilys_local_storage_session_name.substring(0, 25) + '..';
        }


				$('#continue-session-header').text('"' + ilys_local_storage_session_name + '" from your story "' + ilys_local_storage_story_name + '" is unsaved.');

				//$('#continue_session').text('Continue "' + ilys_local_storage_session_name + '"')
			}
			else
			{
				$('#continue-session-header').text('You have an unsaved session already in progress.');
			}

			if (!$('#continue-session-text').text().trim().length) {
				$('#continue-session-details').hide();
			}
			else {
				$('#continue-session-details').show();
			}
		@endif

	    $('#highChart').highcharts({
			credits: {
				enabled: false
			},
	        chart: {
	            type: 'column'
	        },
            title: {
	            text: 'Words Written',
	        },
			xAxis: {
				crosshair: true,
				type: 'datetime',
			},
	        yAxis: {
	            title: {
	                text: 'Word Count'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        legend: {
	            enabled: false
	        },
	        series: [{
	            name: 'Word Count',
	    		data: getDailyWordCountsForHighChart()
	        }]
	    });

		$('#feedbackFormDisplay').on('click', function(){
			if ($('#feedbackForm').hasClass('hidden'))
			{
				$('#feedback_message').focus();
				$('#feedbackForm').removeClass('hidden');
				$('#feedbackCollapseIcon').removeClass('fa-chevron-down');
				$('#feedbackCollapseIcon').addClass('fa-chevron-up');
			}
			else
			{
				$('#feedbackForm').addClass('hidden');
				$('#feedbackCollapseIcon').addClass('fa-chevron-down');
				$('#feedbackCollapseIcon').removeClass('fa-chevron-up');
			}
		});

		$(window).scrollTop(0);
	});

    function getDailyWordCountsForHighChart()
    {
     	var wordCountValues = [];

     	// the dataset from the backend only contains dates that have values
     	// create filler data for dates without values.

		for (var i = 0; i < 30; i++)
		{
			wordCountValues.push([getSeriesDateToUTC(moment().subtract(i, 'days').format("YYYY-MM-DD")), 0]);
		}

		@foreach($daily_writing_logs as $daily_writing_log)
        wordCountValues.push([getSeriesDateToUTC('{{ $daily_writing_log->date }}'), {{ $daily_writing_log->daily_word_count }}]);
		@endforeach

        return wordCountValues.sort();
    };

    function getSeriesDateToUTC(dateToConvert) {
		var dateParts = dateToConvert.split('-');

		var year = dateParts[0];
		var month = dateParts[1] - 1;
		var day = dateParts[2];

		var UTCDate = Date.UTC(year, month, day);
		return UTCDate;
	};

	$('.story-tr').on('click', function() {
		window.location = 'show-story/' + $(this).data("story-id");
	});

	$('#save-timezone-button').click(function(event) {
		event.preventDefault();
		updateTimezone();
	});

	$(".set-timezone").click(function(event) {
		event.preventDefault();
		$("#set-timezone-modal").modal('show');
	});

	$("#new_session_button").click(function(event) {
		if (($('#continue_session').length > 0) && ($('#continue-session-text').text().trim().length > 0))
		{
			event.preventDefault();
			$("#confirm-session-in-progress-delete-modal").modal('show');
		}
		else
		{
			createNewSession();
		}
	});

	$("#confirm-clear-session").click(function()
    {
	   	$("#confirm-session-in-progress-delete-modal").modal('hide');
			createNewSession();
	});

	showNaNoWriMoInstruments = function() {
		$.get( "/get-nanowrimo-wordcount?_=" + new Date().getTime(), function(data) {
		}).done(function(data) {
			var nanowrimoWordsWritten = data.nanowrimoWordsWritten;
			var secondsTillEnd = data.secondsTillEnd;
			var wordsToGo = (nanowrimoWordsWritten >= 50000) ? 0 : Math.floor(50000 - nanowrimoWordsWritten);
			var daysToGo = (secondsTillEnd > 0) ? Math.ceil(secondsTillEnd/86400) : 0;
			var targetWPD = (wordsToGo > 0) ? Math.ceil(wordsToGo / daysToGo) : '<span style="font-weight: strong;">YOU WON!</span>';

			$('#nanoremainingWordsValue').html(wordsToGo);
			$('#nanoremainingDaysValue').html(daysToGo);
			$('#nanotargetWordsPerDaysValue').html(targetWPD);

			$("#nano-instruments").removeClass('hidden');

			var opts = {
			  angle: 0, // The span of the gauge arc
			  lineWidth: 0.32, // The line thickness
			  radiusScale: 1, // Relative radius
			  pointer: {
			    length: 0.64, // // Relative to gauge radius
			    strokeWidth: 0.082, // The thickness
			    color: '#FF0000' // Fill color
			  },
			  limitMax: false,     // If false, max value increases automatically if value > maxValue
			  limitMin: false,     // If true, the min value of the gauge will be fixed
			  colorStart: 'lime',   // Colors
			  colorStop: 'lime',    // just experiment with them
			  strokeColor: '#E0E0E0',  // to see which ones work best for you
			  generateGradient: true,
			  highDpiSupport: true     // High resolution support
			};
			var target = document.getElementById('canvas-preview'); // your canvas element
			var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
			gauge.maxValue = 50000; // set max gauge value
			gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
			gauge.animationSpeed = 32; // set animation speed (32 is default value)
			gauge.set(nanowrimoWordsWritten); // set actual value

			$('#nanowrimoWordsWritten').html(nanowrimoWordsWritten);
	  });
	};

	startGoalTimer = function(seconds) {
		clearInterval(countdownTimer);

		countdownTimer = setInterval(function() {
			$('#nano-countdown-content').html(seconds);

			if (seconds <= 0) {
					clearInterval(countdownTimer);

					$('#nanocountdown').addClass('hidden');
					showNaNoWriMoInstruments();
			} else {
					seconds--;
			}
		}, 1000);
	}

	updateTimezone = function() {
		$.post('setup-nanowrimo', {
			timezone:$('#timezone').val()
		}).done(function (data) {
			$('#timezone-text').html($('#timezone').val());
			secondsTillGoalStarts = data;

			if (secondsTillGoalStarts > 0) {
					startGoalTimer(secondsTillGoalStarts);
					$('#nanocountdown').removeClass('hidden');
					$('#nano-instruments').addClass('hidden');
			}
			else {
					$('#nanocountdown').addClass('hidden');
					showNaNoWriMoInstruments();
			}

			$("#set-timezone-modal").modal('hide');
		});
	};

	createNewSession = function()
	{
		$("#new_session_story_id").val('0');
		$("#new_session_story_name").val('');
		$("#new_session_session_id").val('0');
		$("#new_session_session_name").val('');

		localStorage["ilysStoryId"] = "0";
		localStorage["ilysStoryName"] = "";
		localStorage["ilysSessionId"] = "0";
		localStorage["ilysSessionName"] = "";

		$("#new_session_form").submit();
	};

@if (isset($writing_session))
		prepareDataForSessionSaveOrContinue = function(useLocalStorage) {
			var ilys_local_storage_updated_at = localStorage.getItem('ilysLocalStorageUpdatedAt');
			var ilys_server_storage_updated_at = {{$writing_session->local_storage_updated_at ? $writing_session->local_storage_updated_at : "0"}};

			$("#user_id").val(localStorage.getItem('ilysUserId'));
			$("#story_id").val(localStorage.getItem('ilysStoryId'));
			$("#story_name").val(localStorage.getItem('ilysStoryName'));
			$("#session_id").val(localStorage.getItem('ilysSessionId'));
			$("#session_name").val(localStorage.getItem('ilysSessionName'));
			$("#story_content_id_in_progress").val(localStorage.getItem('ilysSessionId'));

			if (useLocalStorage || (ilys_server_storage_updated_at < ilys_local_storage_updated_at))
			{
				$("#content_in_progress").val(localStorage.getItem('ilysWritingInProgress'));
				$("#words_to_write").val(localStorage.getItem('ilysWordsToWrite'));
			}

			$("#local_storage_updated_at").val(ilys_local_storage_updated_at);
		};

		$("#save_session, #save_session_modal").click(function(event) {
			event.preventDefault();

			prepareDataForSessionSaveOrContinue(true);
			$('#word_count').val("{{$writing_session->word_count}}");
			$("#continue_writing_session").attr("action", "save-writing-session");
			$("#continue_writing_session").append('<input type="hidden" id="story_content_id" name="story_content_id" value="' + $('#story_content_id_in_progress').val() + '">')

			$("#continue_writing_session").submit();
		});

    $("#continue_session").click(function()
    {
			prepareDataForSessionSaveOrContinue();
			$("#continue_writing_session").submit();
    });
@endif

@if ($marketing_program_short_code == "nanowrimo")
	const timezone = jstz.determine();
	@if (($timezone === NULL) || ($timezone === ''))
		$('#timezone').val(timezone.name());
		$("#set-timezone-modal").modal('show');
	@else
		$('#timezone').val('{{{$timezone}}}');
		updateTimezone();
	@endif
@endif
</script>
@stop
