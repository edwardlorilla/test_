@extends('layouts.default-no-container')
@section('topScriptsStyles')
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap-editable.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/show-story.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/jquery.scrollbar.css')}}">
@stop
{{-- Content --}}
@section('content')


@if( isset($story) )
<!-- Story screen -->
<div class="container story-container">
    <div class="story-header">
      <!-- Story name and id -->
        <h1 class="story-data story-data-placeholder" data-id="{{ e($story->id) }}">{{ e($story->name) }}</h1>
        <input data-toggle="popover" data-content="Rename story" type="text" maxlength="50" class="story-data story-data-input h1" style="width: 0" data-id="{{ e($story->id) }}" value="{{ e($story->name) }}"/>
        <!-- Story word count -->
        <span class="story-word-count" data-toggle="popover" data-content="Story word count">({{ number_format($story->total_word_count) }} words)</span>
        <!-- Story actions -->
        <div class="story-actions">
            <a data-toggle="popover" data-content="Dashboard" href="/"><i class="fa fa-home"></i></a>
            <a id="create-new-session" class="create-new-session" data-toggle="popover" data-content="Create new session"><i class="fa fa-plus-circle"></i></a>
            <a id="download_story" href="/download-story?story_id={{ $story-> id }}" alt="Download Story" data-toggle="popover" data-content="Download story"><i class="fa fa-cloud-download"></i></a>
            <a id="delete_story" data-toggle="popover-left" data-content="Delete story"><i class="fa fa-times-circle"></i></a>
        </div>
    </div>
    <div class="story-content">
        <div class='hidden no-story-contents'>
          <span class="no-sessions-header">This story is empty. <i class="fa fa-frown-o" aria-hidden="true"></i></span><br/>
          <span class="no-sessions-subheader"><a href="#" class="create-new-session">Flow some life into it...</a></span>
        </div>
        <!-- Story sessions, don't forget to set `data-id` attributes -->
        <div class="story-sessions-border">
          <div class="scrollbar-inner" id="story-sessions-scrollbar-inner">
            <div class="story-sessions">
              <!-- Assign the class `.session-card-active` to the first session card -->

              <?php
                $sort_by = 'id';

                if (count($story_contents->filter(function ($story_content) { return $story_content->sort_id > 0; })) > 0)
                {
                  $sort_by = 'sort_id';
                }
              ?>

              @foreach ($story_contents->sortBy($sort_by) as $story_content)
              <div  class="session-card" data-id="{{$story_content->id}}">
                <a class='session-card-link'>{{ !empty($story_content->name) ? e($story_content->name) : 'Untitled' }}</a>
                <div class='reorder-icon'><i class="fa fa-bars" aria-hidden="true"></i></div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <!-- Selected session -->
        <div class="story-session">
            <div class="session-header">
                <!-- Session title -->
                <h2 class="session-title session-title-placeholder"></h2>
                <input data-toggle="popover" data-content="Rename session" type="text" maxlength="50" class="session-title session-title-input h2" style="width: 0" value=""/>

                <!-- Session actions -->
                <div class="session-actions">
                    <a data-toggle="popover" data-content="Continue"><i class="fa fa-edit" data-continue-session></i></a>
                    <a data-toggle="popover" data-content="Edit"><i class="fa fa-file-text" data-edit-session></i></a>
                    @if ($stories->count() > 1)
                    <a data-toggle="popover" data-content="Move"><i class="fa fa-share" data-move-session aria-hidden="true"></i></a>
                    @endif
                    <a data-toggle="popover" data-content="Delete"><i class="fa fa-times-circle" data-story-content-id></i></a>
                </div>
            </div>
            <div class="scrollbar-inner">
                <!-- Session content -->
                <div class="session-content story-reader text-justify"></div>
            </div>
            <!-- Loading spinner -->
            <div class="session-loading hidden"><i class="fa fa-spinner fa-pulse"></i></div>
        </div>
    </div>
</div>

<div id="confirm-delete-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete {{ e($story->name) }}?</h4>
            </div>
            <div class="modal-body">
                <p>If you delete <strong>{{ e($story->name) }}</strong>, it will be gone forever.</p>
                <p class="text-warning"><small>Are you sure you want to delete this story?</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, don't delete</button>
                <button type="button" class="btn btn-primary" id="confirm-delete-story">Yes, delete this story</button>
            </div>
        </div>
    </div>
</div>
<div id="confirm-session-delete-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete session?</h4>
            </div>
            <div class="modal-body">
                <p>If you delete this session, it will be gone forever.</p>
                <p class="text-warning"><small>Are you sure you want to delete it?</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, don't delete</button>
                <button type="button" class="btn btn-primary" id="confirm-delete-session">Yes, delete this session</button>
            </div>
        </div>
    </div>
</div>
<div id="move-session-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Move this session into another story?</h4>
            </div>
            <div class="modal-body">
              Move this session to:&nbsp;&nbsp;&nbsp;
            <select id="move-session-to-story">
            @foreach ($stories->sortBy('updated_at') as $thisStory)
            @if ($thisStory->id != $story->id)
            <option value="{{ e($thisStory->id) }}">{{ e($thisStory->name) }}</option>
            @endif
            @endforeach
          </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-move-session">Move</button>
            </div>
        </div>
    </div>
</div>
<div id="for-subscribers-only-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please subscribe to continue.</h4>
            </div>
            <div class="modal-body">
                <p>Writing and editing is only available to ilys subscribers.  Please <a href="/subscription">click here</a> to subscribe.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-subscribe">Yes, let's subscribe</button>
            </div>
        </div>
    </div>
</div>
<form action="/delete-story" method="post" id="delete-story-form" accept-charset="UTF-8">
  {{Form::token()}}
  <input type="hidden" id="story_id" name="story_id" value="{{ $story->id }}">
  <input type="hidden" id="story_name" name="story_name" value="{{ e($story->name) }}">
</form>

<span class="hidden" id="story_content_id_in_focus"></span>
@endif
@stop

@section('scripts')
</script>
<script src="{{asset('assets/js/bootstrap-editable.min.js')}}"></script>
<script src="{{asset('assets/js/store.min.js')}}"></script>
<script src="{{asset('assets/js/Sortable.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.scrollbar.min.js')}}"></script>

<script type="text/javascript">
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.emptytext = 'Untitled';

	$(document).ready(function() {
        localStorage['ilysStoryId'] = '{{ $story_id }}';
        localStorage['ilysStoryName'] = '{{ e($story->name) }}';
        localStorage['ilysSessionId'] = $(this).attr("0");
        localStorage['ilysSessionName'] = $(this).attr("");

        // Initializing variables
        var storyId = $('.story-data').data('id');
        var storySessions = $('.story-sessions');
        var sessionCards = $('.session-card');
        var sessionTitle = $('.session-title');
        var sessionTitleInput = $('.session-title-input');
        var sessionContent = $('.session-content');
        var sessionActions = $('.session-actions');
        var sessionLoading = $('.session-loading');
        var saveOrder = false;
        var sessionsOrder, jsonOrder, currentSessionId, card, id, continueSessionId;

        // did this request come from an edit/writing screen, session in progress?
        @if (isset($story_content_id))
        continueSessionId = {{ e($story_content_id) }};
        @endif

        var storyInput = $('.story-data-input');
        var storyPlaceholder = $('.story-data-placeholder');
        var sessionInput = $('.session-title-input');
        var sessionPlaceholder = $('.session-title-placeholder');

        var sessions = {};

        var sortable = new Sortable(storySessions[0], {
            animation: 100,  // ms, animation speed moving items when sorting, `0` — without animation
            onEnd: function (evt) {
                if (evt.newIndex != evt.oldIndex) {
                    saveOrder = true;
                }
            },
            store: {
                get: function (sortable) {
                    sessionsOrder = sortable.toArray();
                    return sessionsOrder;
                },
                set: function (sortable) {
                    if (saveOrder) {
                        saveOrder = false;
                        sessionsOrder = sortable.toArray();
                        sendOrderToServer();
                    }
                }
            }
        });

        function getSessionFromServer(id) {
            // Uncomment and replace the URL with a real one
            $.get('/get-story-content?story-id=' + storyId + '&story-content-id=' + id, function (data) {
                sessions[id] = data;
                if (id == currentSessionId) {
                    setSession(id);
                }
            });
        };

        function scrollSelectedCardIntoView() {
          var cardsContainer = $('#story-sessions-scrollbar-inner');
          var offset = cardsContainer.offset();
          var width = cardsContainer.width();
          var height = cardsContainer.height();

          var centerX = offset.left + width / 2;
          var centerY = offset.top + height / 2;

          var selectedCardX = $('.session-card-active').offset().top;

          if ((selectedCardX > height) || (selectedCardX < offset.top)) {
            $('#story-sessions-scrollbar-inner').scrollTop(selectedCardX);
          }
        };

        function setSession(id) {
            var session = sessions[id];
            var _session = session || { title: ' ', content: '' };

            if (session && !_session.title.trim().length) {
              _session.title = 'Untitled';
            }

            setSessionTitle(_session.title);
            sessionContent.html(_session.content.trim());

            $('.session-actions').find('[data-story-content-id]').attr('data-story-content-id', id);
            $('#story_content_id_in_focus').html(id);

            if (session) {
                sessionActions.removeClass('hidden');
                sessionLoading.addClass('hidden');
                scrollSelectedCardIntoView();
            } else {
                sessionActions.addClass('hidden');
                sessionLoading.removeClass('hidden');
                getSessionFromServer(id);
            }
        };

        function setSessionTitle (title) {
          if (title.length) {
            var sessionTitle = $('.session-title');
            var sessionTitleInput = $('.session-title-input');

            sessionTitle.text(title);
            sessionTitleInput.val(title);

            setTimeout(adjustSessionInputWidth);
          }
        };

        function sendOrderToServer() {
            // Construct an object with `story_id` and `sessions_order`
            // For example: {"story_id":1,"sessions_order":["2","1","3"]}
            // `sessions_order` is an array containing the sessions `id` in the new ordered position
            jsonOrder = {story_id: storyId, sessions_order: sessionsOrder};
            $.post('/reorder-story-contents', jsonOrder);
        }

        function adjustStoryInputWidth() {
            storyPlaceholder.text(storyInput.val());
            storyInput.width(storyPlaceholder.width() + 5);
        }

        function adjustSessionInputWidth() {
            sessionPlaceholder.text(sessionInput.val());
            sessionInput.width(sessionPlaceholder.width() + 5);
        }

        function updateSelectedSessionTileName (newSessionName) {
          var newTitle = $('.session-title-input').val();

          if (!newTitle.trim().length) {
            newTitle = 'Untitled';
          }

          $('.session-card-active').find('.session-card-link').text(newTitle);
          if (sessions) {
            sessions[$('.session-card-active').data('id')].title = newTitle;
          }
        };

        function updateSessionTitleInputValue (newSessionName) {
          $('.session-title-input').val(newSessionName);
          setTimeout(adjustSessionInputWidth);

          ajaxData = {
              story_id: "{{ $story->id }}",
              session_id: $('.session-card-active').data('id'),
              new_session_name: newSessionName
          };

          $.ajaxSetup({
              headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });

          $.post( "/update-session-name", ajaxData)
              .done(function( data ) {
              });
        }

        function showNoSessionsScreen(showNoSessions) {
          if (showNoSessions) {
            $('.story-sessions-border').addClass('hidden');
            $('.story-session').addClass('hidden');
            $('.no-story-contents').removeClass('hidden');
          }
          else {
            $('.story-sessions-border').removeClass('hidden');
            $('.story-session').removeClass('hidden');
            $('.no-story-contents').addClass('hidden');
          }

        };

        function userIsSubscribedOrInTrialMode() {
            subscribedOrInTrial = false;

            if (('{{ $user_in_trial_period }}' == '1') || ('{{$user_subscribed}}' == '1'))
            {
                subscribedOrInTrial = true;
            }

            return subscribedOrInTrial;
        };

        function continueOrEditSession(edit) {
            if (!userIsSubscribedOrInTrialMode())
            {
                $("#for-subscribers-only-modal").modal('show');

                return;
            }

            var editSession = (edit == true) ? "&edit=1" : "";

            var sessionId = $('#story_content_id_in_focus').html();
            var url = "/continue-story-content?si={{ $story_id }}&sci=" + sessionId + editSession;

            @if($user->subscribed() || ($user->total_words_written < $user->free_trial_word_count_limit))
                var storyName = $('.story-data').text();
                var sessionName = $('.session-title').text();

                localStorage['ilysStoryId'] = '{{ $story_id }}';
                localStorage['ilysStoryName'] = storyName
                localStorage['ilysSessionId'] = sessionId;
                localStorage['ilysSessionName'] = (sessionName.length > 0) ? sessionName : "Untitled";

                $('body').append('<a href="' + url  + '" id="clickOnMeContinueSession" class="hidden"></a>');

                // handle case of user jumping to this function from a story or session rename -- a little
                // buffer of time for the rename request to get to the server, so it doesn't load the old name
                setTimeout(function() {
                  $('#clickOnMeContinueSession')[0].click();
                }, 700);
            @else
                $('{{ Form::open(array('url' => 'subscription', 'method' => 'get')) }}{{ Form::close() }}').appendTo('body').submit();
            @endif
        };

        storyInput.on('input', adjustStoryInputWidth);
        sessionInput.on('input', adjustSessionInputWidth);

        $(window).on('resize', adjustStoryInputWidth);
        $(window).on('resize', adjustSessionInputWidth);

        sessionCards.on("dragover", function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

        sessionCards.on("dragleave", function(event) {
            event.preventDefault();
            event.stopPropagation();
        });

        sessionCards.on("drop", function(event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).click();
        });

        // Listen to click events on sessions to
        sessionCards.click(function (e) {
            card = $(this);
            id = card.data('id');
            if (id != currentSessionId) {
                currentSessionId = id;
                $('.session-card-active').removeClass('session-card-active');
                card.addClass('session-card-active');
                setSession(id);
            }
        });

        $('.story-data-input').on('change', function() {
            var newStoryName = $('.story-data-input').val().trim();

            if (!newStoryName.trim().length) {
              newStoryName = 'Untitled';
            }

            $('.story-data-input').val(newStoryName);
            setTimeout(adjustStoryInputWidth);

            ajaxData = {
                story_id: "{{ $story->id }}",
                new_story_name: newStoryName
            };

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $.post( "/update-story-name", ajaxData)
                .done(function( data ) {
                });
        });

        $('.session-title-input').on('change', function() {
          var newTitle = $('.session-title-input').val().trim();

          if (!newTitle.trim().length) {
            newTitle = 'Untitled';
          }

          updateSessionTitleInputValue(newTitle);
          updateSelectedSessionTileName(newTitle);
        });

        $('.session-title-input').on('keydown', function() {
          setTimeout(function() {
            updateSelectedSessionTileName ($('.session-title-input').val());
          }, 10);
        });

        $('.story-data-input, .session-title-input').on('focus', function() {
          this.select();
        });

        $('.story-data-input').keypress(function (e) {
          var key = e.which;

          if(key == 13)  // the enter key code
            {
              $('.story-data-input').blur();
              return false;
            }
          });

        $('.session-title-input').keypress(function (e) {
          var key = e.which;

          if(key == 13)  // the enter key code
            {
              $('.session-title-input').blur();
              return false;
            }
          });

        $('[data-continue-session]').click(function(event) {
        	event.preventDefault();

          continueOrEditSession();
        });

        $('[data-edit-session]').click(function(event) {
        	event.preventDefault();

          continueOrEditSession(true);
        });

        $('[data-move-session]').click(function(event) {
        	event.preventDefault();

        	$("#move-session-modal").modal('show');
        });

        $("#delete_story").click(function(event) {
        	event.preventDefault();
        	$("#confirm-delete-modal").modal('show');
        });

        $("#confirm-delete-story").click(function(event) {
        	event.preventDefault();
        	$('#delete-story-form').submit();
        });

        $('#confirm-subscribe').click(function() {
            $('<form action="/subscription"></form>').appendTo('body').submit();
        });

        $("[data-story-content-id]").click(function(event) {
        	event.preventDefault();

            if (!userIsSubscribedOrInTrialMode())
            {
                $("#for-subscribers-only-modal").modal('show');

                return;
            }

        	$("#confirm-session-delete-modal").modal('show');
    	   });

         $('#confirm-move-session').click(function(event) {
           event.preventDefault();

           $("#move-session-modal").modal('hide');

           var $story_content_id = $("#story_content_id_in_focus").html();
           var $new_story_id = $('#move-session-to-story').val();

           ajaxData = {
             story_id: "{{ $story->id }}",
             story_content_id: $story_content_id,
             new_story_id: $new_story_id
           };

           $.ajaxSetup({
               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
           });

           $.post( "/move-session", ajaxData)
               .success(function( data ) {
                 $(".story-word-count").html('(' + data["new_word_count"] + ' words)');
                 $('.session-card[data-id="' + $story_content_id + '"]').remove();
                 if ($('.session-card').length) {
                   $('.session-card')[0].click();
                 }
                 else {
                   showNoSessionsScreen(true);
                 }
             });
         });


         $("#confirm-delete-session").click(function(event) {
          	event.preventDefault();

      	   	$("#confirm-session-delete-modal").modal('hide');

          	var $story_content_id = $("#story_content_id_in_focus").html();

            ajaxData = {
                story_id: "{{ $story->id }}",
                story_content_id: $story_content_id
            };

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $.post( "/delete-session", ajaxData)
                .done(function( data ) {
                	$(".story-word-count").html('(' + data["new_word_count"] + ' words)');
                  $('.session-card[data-id="' + $story_content_id + '"]').remove();
                  if ($('.session-card').length) {
                    $('.session-card')[0].click();
                  }
                  else {
                    showNoSessionsScreen(true);
                  }
              });
          });

      	  $("#create-new-session, .create-new-session").click(function(event) {
          	  event.preventDefault();

              if (!userIsSubscribedOrInTrialMode())
              {
                  $("#for-subscribers-only-modal").modal('show');

                  return;
              }

              @if($user->subscribed() || ($user->total_words_written < $user->free_trial_word_count_limit))
                  $('{{ Form::open(array('url' => 'create-writing-session')) }}{{ Form::hidden('story_id', $story_id) }}{{ Form::close() }}').appendTo('body').submit();
              @else
                  $('{{ Form::open(array('url' => 'subscription', 'method' => 'get')) }}{{ Form::close() }}').appendTo('body').submit();
              @endif
      	});

        $('[data-toggle="tooltip"]').tooltip({
            'placement': 'bottom'
        });

        $('[data-toggle="popover"]').popover({
            trigger: 'hover',
                'placement': 'bottom'
        });

        $('[data-toggle="popover-left"]').popover({
            trigger: 'hover',
                'placement': 'left'
        });

        // Initializing the current session
        setTimeout(adjustStoryInputWidth);

        if ($('.session-card').length) {
          sessionsOrder = [];

          // came from an edit or write screen?
          if (continueSessionId > 0) {
            $('.session-card[data-id="' + continueSessionId + '"]').click();
          }
          else {
            sessionCards[0].click();
            currentSessionId = $(sessionCards[0]).data('id');
          }

          sessions[currentSessionId] = {title: sessionTitle.text(), content: sessionContent.text()};
        }
        else {
          showNoSessionsScreen(true);
        }

        $('#footer').hide();
        $('.layout-spacer').css('padding', '0px');

        jsonOrder = {story_id: storyId, sessions_order: sessionsOrder};
        $('.scrollbar-inner').scrollbar();
  	});
</script>
@stop
