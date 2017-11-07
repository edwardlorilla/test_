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
	<div class="col-lg-8 col-lg-offset-2">
	@foreach($groups as $group)
		<div class="panel group-header panel-info">
			<div class="text-center group-header" data-group-id="{{$group->id}}"><h3 style="margin-bottom: 17px; cursor: pointer;">{{$group->name}}</h3></div>
			@foreach($group_daily_writing_logs as $log)
				@if ($log[0] == $group->name)
				<div class="group-members panel-info hidden" data-group-id="{{$group->id}}">
					<div class="panel-heading">
					{{$log[2]}} (<a href="mailto:{{$log[3]}}" target="_blank" style="color: #0f0">{{$log[3]}}</a>)
					</div>
					<div class="panel-body">
						<div id="highChart{{$log[1]}}" data-user-id="{{$log[1]}}" style="width:710px; height:300px;"></div>
					</div>
				</div>
				@endif
			@endforeach
		</div>
	@endforeach
	</div>

	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-info">
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
				<input type="hidden" name="calling_url" value="groups">
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

<script type="text/javascript">
	$(function () {
		var daily_writing_logs = {{json_encode($group_daily_writing_logs)}};

		@foreach($group_daily_writing_logs as $log)

    $('#highChart{{$log[1]}}').highcharts({
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
	    		data: getDailyWordCountsForHighChart({{$log[4]}})
	        }]
	    });
			@endforeach

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
	});

	$('.group-header').on('click', function() {
			$('.group-members[data-group-id="' + $(this).attr('data-group-id') + '"]').toggleClass('hidden');
	});

  function getDailyWordCountsForHighChart(daily_writing_log)
    {
     	var wordCountValues = [];

     	// the dataset from the backend only contains dates that have values
     	// create filler data for dates without values.

			for (var i = 0; i < 30; i++)
			{
				wordCountValues.push([getSeriesDateToUTC(moment().subtract(i, 'days').format("YYYY-MM-DD")), 0]);
			}

			for (var i = 0; i < daily_writing_log.length; i++) {
				wordCountValues.push([getSeriesDateToUTC(daily_writing_log[i].date), daily_writing_log[i].daily_word_count]);
			}

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
</script>
@stop
