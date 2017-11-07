<!--
Howdy.  This code written by Michael Gurevich at ilys.com.
Big shouts to the many, many minds and souls who have contributed
everything to making this possible.  All love!
-->

<!doctype html>
<html>
<head>
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:429286,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <title>ilys</title>
    <meta http-equiv="pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="_token" content="<?= csrf_token() ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/ilys.css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">

    <style>
        .ui-dialog { z-index: 1001 !important ;}
        .ui-front { z-index: 1001 !important; }
        .ui-widget-overlay { z-index: 1000 !important; }
    </style>
</head>
<body>
<!-- form elements for placeholders of variables -->

@if (isset($continue_writing_session))
    <input type="hidden" id="continue_writing_session" value="1">
    <input type="hidden" id="is_ninja_mode_from_db" value="{{$is_ninja_mode}}">
    <input type="hidden" id="words_to_write" value="{{e($writing_session->words_to_write)}}">
    @if (isset($view))
    <input type="hidden" id="requested_view" value="{{$view}}">
    @endif
    @if (isset($story_content_id))
    <input type="hidden" id="story_content_id_in_progress" value="{{$story_content_id}}">
    @else
    <input type="hidden" id="story_content_id_in_progress" value="0">
    @endif
    <input type="hidden" id="content_in_progress" value="{{e($writing_session->content_in_progress)}}">
@else
    <input type="hidden" id="continue_writing_session" value="0">
@endif
    <div align="center" id="wrapper">
        <!-- set up screen -->
        <div id="setupWrapper" class="setupView">
            <div id="content">
                <div id="startHere">
                    <div id="startNewFlow">
                        <form>
                            How many words would you like to write?<br/>
                            <input id="wordsToWriteTextbox" class="bigTexbox" type="text" size="6" autofocus="autofocus" /><br/><br/>
                            Ready to flow?<br/>
                            <button type="button" id="bigButton" class="bigButton">GO!</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="endShadow">&nbsp;</div>
        </div>

        <!-- text entry screen -->
        <div id="progressBar" class="flowView ilys-progress ilys-header">
            <div class="meterWrapper ilys-header flowView">&nbsp;
                <span class="meter ilys-header" id="meter"></span>
            </div>
        </div>
        <div id="mainWritingDiv" class="flowView">
            <div id="wordCountLabel" class="flowView">Start typing...</div>
            <div id="wpmLabel" class="flowView darkGrey hidableMenuItem">0 WPM</div>
            <div id="homeMenuDiv" class="hidableMenuItem">
                <div id="fullscreenDiv">
                    <div id="fullscreenOffDiv" data-toggle="popover" data-content="Exit Full Screen"><i id="fullscreenOffIcon" class="flowView fa fa-compress"></i></div>
                    <div id="fullscreenOnDiv" data-toggle="popover" data-content="Full Screen"><i id="fullscreenOnIcon" class="flowView fa fa-arrows-alt"></i></div>
                </div>
                <div id="dashboardDiv" data-toggle="popover" data-content="Dashboard"><i id="homeIcon" class="flowView fa fa-home"></i></div>
                <div id="cogDiv" data-toggle="popover" data-content="Session Settings"><i id="cogIcon" class="flowView fa fa-cog"></i></div>
                <div id="ninjaModeDiv">
                    <div id="ninjaModeOffDiv" data-toggle="popover" data-content="Ninja Mode"><i id="ninjaModeOffIcon" class="flowView fa fa-toggle-off"></i></div>
                    <div id="ninjaModeOnDiv" data-toggle="popover" data-content="Ninja Mode"><i id="ninjaModeOnIcon" class="flowView fa fa-toggle-on"></i></div>
                </div>
                <div id="peekDiv" data-toggle="popover" data-content="Peek"><i id="peekIcon" class="flowView fa fa-eye"></i></div>
                <div id="saveDiv" data-toggle="popover" data-content="Save Session"><i id="saveIcon" class="flowView fa fa-floppy-o"></i></div>
            </div>
            <div id="wrongCharacterDiv"><i id="wrongCharacterIcon" class="flowView fa fa-times"></i></div>
            <div id="completeCheckDiv" data-toggle="popover-goal-reached" data-content=""><i id="completeCheckIcon" class="flowView fa fa-check-square-o"></i></div>
            <div id="saveContentDiv" class="hidableMenuItem">
                <div id="saveContentImageDiv" data-toggle="popover-left" data-content="Autosave">Saving</div>
            </div>
            <table align="center" border="0" width="100%" margin="0" padding="0" class="flowView" id="flowEntryTable">
                <tr align="center">
                    <td width="45%">&nbsp;</td>
                    <td align="center">
                        <div id="flowEntry" class="flowView">&nbsp;</div>
                        <input type="text" maxlength="1" id="flowEntryTextbox" autofocus class="flowEntryTextbox">
                    </td>
                    <td width="45%">&nbsp;</td>
                </tr>
            </table>
        </div>

        <div id="leftPaddle" class="leftPaddle"><i class="paddle-icon fa fa-chevron-left"></i></div>
        <div id="rightPaddle" class="rightPaddle hidableMenuItem" data-toggle="popover-left" data-content="Edit"><i class="paddle-icon fa fa-chevron-right"></i></div>

        <!-- editing screen -->
        {{ Form::open(array('id' => 'save-writing-session', 'url' => 'save-writing-session', 'method' => 'post')) }}
            <input type="hidden" name="writing_session_token" value="{{ $writing_session->writing_session_token }}">
            <input type="hidden" name="local_storage_updated_at" id="local_storage_updated_at" value="">
            <input type="hidden" name="words_to_write" id="words_to_write" value="">
            <input type="hidden" name="word_count" id="word_count" value="">
            <input type="hidden" name="is_ninja_mode" id="is_ninja_mode" value="">
            @if (isset($story_id))
            <input type="hidden" name="story_id" id="story_id" value="{{$story_id}}">
            <input type="hidden" name="story_name" id="story_name" value="{{ e($story_name) }}">
            @else
            <input type="hidden" name="story_id" id="story_id" value="0">
            <input type="hidden" name="story_name" id="story_name" value="">
            @endif
            @if (isset($session_id))
            <input type="hidden" name="session_id" id="session_id" value="{{$session_id}}">
            <input type="hidden" name="session_name" id="session_name" value="{{ e($session_name) }}">
            @else
            <input type="hidden" name="session_id" id="session_id" value="0">
            <input type="hidden" name="session_name" id="session_name" value="">
            @endif
            @if (isset($story_content_id))
            <input type="hidden" id="story_content_id" name="story_content_id" value="{{$story_content_id}}">
            @else
            <input type="hidden" id="story_content_id" name="story_content_id" value="0">
            @endif
            @if (isset($user_id))
            <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
            @else
            <input type="hidden" name="user_id" id="user_id" value="0">
            @endif
            <div id="flowCollectionNotification" class="summaryView">
                <div id="flowCollectionNotificationText"></div>
                <div id="flowCollectionSaveButton" class="summaryView">
                    <span id="saveWIPButton">&nbsp;Save&nbsp;</span>
                </div>
            </div>
            <div id="flowCollectionWrapper" class="summaryView">
                <textarea id="flowCollection" name="content_in_progress" class="summaryView"></textarea>
            </div>
        {{ Form::close() }}
    </div>
    <script type='text/javascript' src="assets/js/modernizr.custom.56195.js"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/store.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/keypress-2.1.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/ion.sound.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/screenfull.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
      WebFont.load({
        google: {
          families: ['Cutive Mono']
        }
      });
    </script>

    <script type="text/javascript">
        var goalReached = false;
        var sessionStart = new Date();
        var currentView = '';
        var ninjaMode = false;
        var wordsToWrite = 108;
        var wordCountUpdateThreshold = 10;
        var wordCountUpdateCounter = 0;
        var timeoutId = "";
        var hidableMenuInterval = 10000;
        var afterKeypressTrackMouseMoveThreshold = 750;
        var afterKeypressTrackMouseMove = false;
        var afterKeypressTrackMouseMoveTimeoutId = "";
        var readyToExit = false;
        var wpmTimesCollection = [];
        var wpmProcessingPaused = false;
        var lastKeyCodePressed = 0;
        var maxStoryNameDisplayLength = 25;
        var maxSessionNameDisplayLength = 25;
        var debug = false;

        var successMessage = '';
        var successMessages = [
          'Total Success!',
          'You Rock!',
          'You Did It!',
          'Goal Reached!',
          'You Are Legend, Goal Reached!',
          'You Are Awesome, Goal Reached!',
          'Your Genius Is Showing!'
        ];

        var listener = new window.keypress.Listener();

        var log = function(message) {
          if (debug) {
            console.log(message);
          }
        }

        $(function() {
          //  $('#story_name').val(localStorage['ilysStoryName']);
          //  $('#session_name').val(localStorage['ilysSessionName']);

            // initialize ion Sound
            ion.sound({
                sounds: [
                    {name: "error"}
                ],
                path: "assets/sounds/",
                preload: true
            });

            if(typeof ninjaMode === 'undefined'){
                setNinjaMode(false);
            };

            var captureKeyPress = false;

            displayPaddles(false, false);

            if ( $('#words_to_write').length )
            {
                wordsToWrite = $('#words_to_write').val();
            }

            $('#wordsToWriteTextbox').val(wordsToWrite).focus();

            displayStartHerePanel('startNewFlow');

            $("#descriptionContent").hide();

            // clear all textareas.
            $("flowEntry").val('');
            $("flowCollection").html('');

            registerKeyCombos();

            processGhettoTek();

            // display initial view
            viewController("setupDisplay");

            $("#flowEntry").keydown(function(e){
                log('flowEntry.keydown');
                processKeyPress(e);
            });

            $("#flowEntryTextbox").focusout(function() {
              log('flowEntryTextbox.focusout');
              $( "#flowEntryTextbox" ).focus();
            });

            $('[data-toggle="tooltip"]').tooltip({
              'placement': 'right'
            });

            $('[data-toggle="popover"]').popover({
                trigger: 'hover',
                    'placement': 'right'
            });

            $('[data-toggle="popover-left"]').popover({
                trigger: 'hover',
                    'placement': 'left'
            });

            $(document).mousemove(function(event)
            {
                if ((currentView == "flowView") && (afterKeypressTrackMouseMove))
                {
                    showMenu();
                }
            });

            $("#ninjaModeDiv").click(function()
            {
              log('ninjaModeDiv clicked');

                if (ninjaMode)
                {
                    setNinjaMode(false);
                }
                else
                {
                    setNinjaMode(true);
                }
            });

            $(".rightPaddle").click(function()
            {
              log('rightPaddle.click');

                updateLocalStorage();
                updateProgress();
                updateContentToServerAjax();
                attemptSaveToServer();
                viewController("summaryView");
            });

            $(".leftPaddle").click(function()
            {
              log('leftPaddle.click');

                if ($("#flowCollection").val().substring($("#flowCollection").val().length - 1) != " ")
                {
                    appendToFlowCollection(' ');
                }

                enableDisableSaveIcon();
                updateLocalStorage();
                updateContentToServerAjax();
                updateProgress();
                viewController("flowView");
            });

            $("#homeIcon").click(function()
            {
              log('homeIcon.click');

                updateLocalStorage();
                updateContentToServerAjax();
                updateProgress();
                displayPaddles(false, false);
                window.location.replace("/dashboard");
            });

            $("#cogIcon").click(function()
            {
              log('cogIcon.click');

                updateLocalStorage();
                updateContentToServerAjax();
                updateProgress();
                displayPaddles(false, false);
                $('#wordsToWriteTextbox').val(wordsToWrite);

                setTimeout(function() {
                  $('#wordsToWriteTextbox').focus();
                }, 0);

                displayStartHerePanel('startNewFlow');
                viewController("setupDisplay");
            });

            $("#saveIcon").click(function()
            {
              log('saveIcon.click');

              saveSessionToServer();
            });

            $("#peekIcon").click(function()
            {
              log('peekIcon.click');

                updateLocalStorage();
                updateContentToServerAjax();
                updateProgress();
                viewController("summaryView");
            });

            $('#wordsToWriteTextbox').keypress(function (e) {
              log('wordsToWriteTextbox.click');

                if (e.which == 13)
                {
                    initializeNewFlow();
                    return false;
                }
                return true;
            });

            $('#fullscreenDiv').click(function()
            {
                if (screenfull.enabled) {
                    if (!screenfull.isFullscreen) {
                        screenfull.request();
                    }
                    else {
                        screenfull.exit();
                    }
                }
            });

            $("#bigButton").click(function()
            {
              log('bigButton.click');

                initializeNewFlow();
            });

            $("#introText").click(function()
            {
              log('introText.click');

                if ($("#descriptionContent").is(":visible"))
                {
                    $("#introTextChevron").removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    $("#descriptionContent").hide();
                }
                else
                {
                    $("#introTextChevron").removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    $("#descriptionContent").slideDown( "slow", function() {
                        // Animation complete.
                    });
                }
            });

            $("#flowCollectionSaveButton").click(function(event)
            {
              log('flowCollectionSaveButton.click');

                // update all storage and wordcount in case
                // the user has made edits before submitting to the server
                event.preventDefault();
                saveSessionToServer();
            });

            $("#saveWIPButton").click(function(event)
            {
              log('saveWIPButton.click');

                // update all storage and wordcount in case
                // the user has made edits before submitting to the server
                event.preventDefault();
                saveSessionToServer();
            });

            $(document).keypress(function(e) {
                if (captureKeyPress) { processKeyPress(e); }

                enableDisableSaveIcon();
            });

            window.onbeforeunload = function () {
              log('onbeforeunload');

                updateTotalWordCountToServerAjax();

                if (!readyToExit)
                {
                  log('onbeforeunload.!readyToExit');

                    updateLocalStorage();
                    setHiddenWordCountField(wordCount());
                    attemptSaveToServer();
                }
            }

            function enableDisableSaveIcon() {
                if ($('#flowCollection').val().trim().length) {
                  $('#saveDiv').fadeIn(1000);
                }
                else {
                  $('#saveDiv').hide();
                }
            };

            function saveSessionToServer() {
                log('saveSessionToServer');

                if ($('#flowCollection').val().length > 0)
                {
                  log('flowCollection.val.length > 0');

                    // update all storage and wordcount in case
                    // the user has made edits before submitting to the server
                    updateLocalStorage();
                    setHiddenWordCountField(wordCount());
                    attemptSaveToServer();
                    readyToExit = true;
                    $( "#save-writing-session" ).submit();
                }
                else
                {
                  log('flowCollection.val.length = 0');
                    window.location.replace("/dashboard");
                }
            };

            function registerKeyCombos() {
                listener.register_combo({
                    "keys"              : 'backspace',
                    "on_keydown"        : function(e){ handleDisallowedCharacter(true); },
                    "on_keyup"          : function(e){ handleDisallowedCharacter(false); },
                    "on_release"        : null,
                    "this"              : undefined,
                    "prevent_default"   : true,
                    "prevent_repeat"    : false,
                    "is_unordered"      : false,
                    "is_counting"       : false,
                    "is_exclusive"      : false,
                    "is_solitary"       : false,
                    "is_sequence"       : false
                });

                listener.register_combo({
                    "keys"              : 'delete',
                    "on_keydown"        : function(e){ handleDisallowedCharacter(true); },
                    "on_keyup"          : function(e){ handleDisallowedCharacter(false); },
                    "on_release"        : null,
                    "this"              : undefined,
                    "prevent_default"   : true,
                    "prevent_repeat"    : false,
                    "is_unordered"      : false,
                    "is_counting"       : false,
                    "is_exclusive"      : false,
                    "is_solitary"       : false,
                    "is_sequence"       : false
                });
            };

            function handleDisallowedCharacter(displayIcon)
            {
              log('handleDisallowedCharacter');

                if (displayIcon) {
                    $("#flowEntry").css( "color", "red" );
                    $("#wrongCharacterDiv").css("display", "block");
                    if (!ninjaMode)
                    {
                        ion.sound.play("error");
                    }
                } else {
                    $("#flowEntry").css( "color", "#777" );
                    $("#wrongCharacterDiv").css("display", "none");
                }
            };

            function processGhettoTek()
            {
              log('processGhettoTek');

                // set font
                var resizeMultipler = parseInt(($("#wrapper").height()) / 1.5);

                var flowEntryFontSize = resizeMultipler;
                $("#flowEntry").css("font-size", flowEntryFontSize + "px");

                var wordCountLabelFontSize = parseInt(resizeMultipler / 15);
                $("#wordCountLabel").css("font-size", wordCountLabelFontSize + "px");

                var wpmLabelFontSize = parseInt(resizeMultipler / 22);
                $("#wpmLabel").css("font-size", wpmLabelFontSize + "px");

                var flowCollectionFontSize = parseInt(resizeMultipler / 23);
                $("#flowCollection").css("font-size", flowCollectionFontSize + "px");

                var flowCollectionNotificationFontSize = parseInt(resizeMultipler / 20);
                $("#flowCollectionNotification").css("font-size", flowCollectionNotificationFontSize + "px");

                var saveWIPButtonFontSize = parseInt(resizeMultipler / 20);
                $("#saveWIPButton").css("font-size", saveWIPButtonFontSize + "px");

                var wrongCharacterIconFontSize = parseInt(resizeMultipler / 14);
                $("#wrongCharacterIcon").css("font-size", wrongCharacterIconFontSize + "px");

                var peekIconFontSize = parseInt(resizeMultipler / 14);
                $("#peekIcon").css("font-size", peekIconFontSize + "px");

                var completeCheckFontSize = parseInt(resizeMultipler / 14);
                $("#completeCheckIcon").css("font-size", peekIconFontSize + "px");

                var homeIconFontSize = parseInt(resizeMultipler / 14);
                $("#homeIcon").css("font-size", homeIconFontSize + "px");

                var cogIconFontSize = parseInt(resizeMultipler / 14);
                $("#cogIcon").css("font-size", cogIconFontSize + "px");

                var saveIconFontSize = parseInt(resizeMultipler / 14);
                $("#saveIcon").css("font-size", saveIconFontSize + "px");

                var fullscreenOffIconFontSize = parseInt(resizeMultipler / 14);
                $("#fullscreenOffIcon").css("font-size", fullscreenOffIconFontSize + "px");

                var fullscreenOnIconFontSize = parseInt(resizeMultipler / 14);
                $("#fullscreenOnIcon").css("font-size", fullscreenOnIconFontSize + "px");

                var ninjaModeOffIconFontSize = parseInt(resizeMultipler / 14);
                $("#ninjaModeOffIcon").css("font-size", ninjaModeOffIconFontSize + "px");

                var ninjaModeOnIconFontSize = parseInt(resizeMultipler / 14);
                $("#ninjaModeOnIcon").css("font-size", ninjaModeOnIconFontSize + "px");

                var saveContentImageDivFontSize = parseInt(resizeMultipler / 20);
                $("#saveContentImageDiv").css("font-size", saveContentImageDivFontSize + "px");

                var startHereFontSize = parseInt(resizeMultipler / 24);
                $("#startHere").css("font-size", startHereFontSize + "px");

                var wordsToWriteTextboxFontSize = parseInt(resizeMultipler / 20);
                $("#wordsToWriteTextbox").css("font-size", wordsToWriteTextboxFontSize + "px");

                var ninjaModeCheckboxHeightSize = parseInt(resizeMultipler / 9);
                $("#ninjaModeCheckbox").css("height", ninjaModeCheckboxHeightSize + "px");

                var ninjaModeCheckboxWidthSize = parseInt(resizeMultipler / 9);
                $("#ninjaModeCheckbox").css("width", ninjaModeCheckboxWidthSize + "px");

                var bigButtonFontSize = parseInt(resizeMultipler / 20);
                $("#bigButton").css("font-size", bigButtonFontSize + "px");

                var bigContinueWritingButtonFontSize = parseInt(resizeMultipler / 20);
                $("#bigContinueWritingButton").css("font-size", bigContinueWritingButtonFontSize + "px");

                var bigStartNewWritingButtonFontSize = parseInt(resizeMultipler / 20);
                $("#bigStartNewWritingButton").css("font-size", bigStartNewWritingButtonFontSize + "px");

                $("#flowCollectionWrapper").css("height", ($(window).height() - 2) + "px");

                var flowCollectionMarginTop = $("#flowCollectionNotification").css("height").replace('px','');
                var flowCollectionHeight = ($(window).height() - flowCollectionMarginTop);
                $("#flowCollection").css("height", flowCollectionHeight  + "px");
                $("#flowCollection").css("margin-top", flowCollectionMarginTop + "px");
                $("#flowCollection").css("padding", bigButtonFontSize + "px");
                $("#flowCollection").css("paddingRight", (bigButtonFontSize * 3) + "px");
                $("#flowCollection").css("paddingLeft", (bigButtonFontSize * 3) + "px");


                // set Paddle size
                var PaddleSize = parseInt(resizeMultipler/10) + "px";
                $(".paddle-icon").css("font-size", PaddleSize);


                var PaddleTopOffset = parseInt(resizeMultipler/1.5) + "px";
                $(".rightPaddle").css("top", PaddleTopOffset);
                $(".leftPaddle").css("top", PaddleTopOffset);

                var RightPaddleMarginOffset = parseInt(resizeMultipler/10) + "px";
                $(".rightPaddle").css("margin-right", RightPaddleMarginOffset);

/*
                var LeftPaddleMarginOffset = parseInt(resizeMultipler/20) + "px";
                $(".leftPaddle").css("margin-left", LeftPaddleMarginOffset);
*/
                // set progress bar height
                var progressBarHeight = parseInt(resizeMultipler/50);
                if (progressBarHeight > 8) { progressBarHeight = 8; }

                progressBarHeight += "px";
                $(".meterWrapper").css("height", progressBarHeight);
                $(".meter").css("height", progressBarHeight);

                $("#ninjaMode").css("height", ($(window).height() - 100)  + "px");
                $("#ninjaMode").css("width", ($(window).height() - 100)  + "px");

                $("#flowEntryTextbox").focus();
            };

            function processKeyPress(e)
            {
              log('processKeyPress');

                hideMenu();

                var fromWhich = String.fromCharCode( e.which );
                var keyCode = e.keyCode || e.which;

                // process WPM
                processWPM(keyCode);

                // separate word counter for server update of counter without content
                if (((lastKeyCodePressed != 32) && (lastKeyCodePressed != 13)) &&
                    ((keyCode == 32) || (keyCode == 13))) {
                    wordCountUpdateCounter++;
                }

                lastKeyCodePressed = keyCode;

                // handle special characters
                // Ignore Backspace and Tab keys
                if (keyCode == 8 || keyCode == 9)
                {
                    e.preventDefault();
                    return;
                }
                else if (keyCode == 13)
                {
                    // add to the wordCount
                    appendToFlowCollection(fromWhich + " \r");
                    updateProgress();
                    updateLocalStorage();
                }
                else
                {
                    appendToFlowCollection(fromWhich);
                }
            };

            function initializeNewFlow()
            {
              log('initializeNewFlow');

                wordsToWrite = $("#wordsToWriteTextbox").val();

                if($('#ninjaModeCheckbox').prop('checked')) {
                    setNinjaMode(true);
                } else {
                    setNinjaMode(false);
                }

                if (wordsToWrite < 1) {
                  wordsToWrite = 0;
                }

                updateLocalStorage();
                updateProgress();
                updateContentToServerAjax();

                if (goalReached)
                {
                    displayPeekOrDone(false, true);
                }
                else
                {
                    displayPeekOrDone(true, false);
                }

                hideElementsOnNoSetGoal();

                viewController("flowView");
            };

            function flashElement(elementToFlash)
            {
              log('flashElement');

                $(elementToFlash).delay(4).fadeIn(200).delay(300)
                .fadeOut(200).delay(300).fadeIn(200).delay(300)
                .fadeOut(200).delay(300).fadeIn(200).delay(300)
                .fadeOut(200).delay(300).fadeIn(200);
            };

            function hideElementsOnNoSetGoal() {
              if (wordsToWrite > 0) {
                $('#meter').show();

                if (wordsToWrite <= wordCount()) {
                  $('#completeCheckDiv').show();
                }
              }
              else {
                $('#meter').hide();
                $('#completeCheckDiv').hide();
              }
            };

            function enablePopoverForGoalReached() {
                if ((wordCount() >= wordsToWrite) && (wordsToWrite > 0))
                {
                    $('[data-toggle="popover-goal-reached"]').popover({
                        trigger: 'hover',
                            'placement': 'right',
                            content: function() {
                              if (!successMessage) {
                                successMessage = successMessages[Math.floor(Math.random()*successMessages.length)];
                              }

                              return successMessage;
                            }
                    });
                }
            };

            function updateProgress()
            {
              log('updateProgress');

                var count = wordCount();

                $("#wordCountLabel").html(count);

                if (count >= wordsToWrite)
                {
                    goalReached = true;

                    // Animate something to let the user know they have reached their count
                    if ((count == wordsToWrite) && (wordsToWrite > 0))
                    {
                        enablePopoverForGoalReached();

                        flashElement("#completeCheckIcon");
                        flashElement("#meter");
                    }
                }
                else
                {
                    goalReached = false;
                }

                if (goalReached)
                {
                    var sessionName = $('#session_name').val();
                    var storyName = $('#story_name').val();

                    if ((storyName.length) && (sessionName === 'undefined'))
                    {
                        sessionName = "Untitled";
                    }

                    if (storyName.length > maxStoryNameDisplayLength) {
                      storyName = storyName.substring(0, maxStoryNameDisplayLength) + '..';
                    }

                    if (sessionName.length > maxSessionNameDisplayLength) {
                      sessionName = sessionName.substring(0, maxSessionNameDisplayLength) + '..';
                    }

                    var editingText = (sessionName.length > 0) ? 'Editing "' + sessionName + '" from "' + storyName + '"' : 'Editing';

                    $("#flowCollection").removeAttr('readonly');
                    $("#flowCollection").css("background-color", "#fff");
                    $("#flowCollection").css("color", "#000");
                    $("#flowCollectionWrapper").css("background-color", "#fff");
                    $("#flowCollectionNotificationText").text('').append(editingText);

                    if (!$('.rightPaddle').hasClass('hidableMenuItem'))
                    {
                        displayPaddles(false, true);
                    }

                    displayPeekOrDone(false, true);
                }
                else
                {
                    $("#flowCollection").attr('readonly','readonly');
                    $("#flowCollection").css("background-color", "#000");
                    $("#flowCollection").css("color", "#fff");
                    $("#flowCollectionWrapper").css("background-color", "#000");
                    $("#flowCollectionNotificationText").text('').append("Peeking");

                    displayPeekOrDone(true, false);
                    displayPaddles(false, false);
                }

                updateProgressBar(count);

                setHiddenWordCountField(count);
            };

            function hideMenu()
            {
              log('hideMenu');

                $('.rightPaddle').addClass('hidableMenuItem');

                $('.hidableMenuItem').fadeOut(400);

                // set timer for showing the menu if typing stops
                window.clearTimeout(timeoutId);
                timeoutId = setTimeout(function()
                            {
                                showMenu();
                            }, hidableMenuInterval);

                // set timer for listening to the mousemove if typing stops
                window.clearTimeout(afterKeypressTrackMouseMoveTimeoutId);
                afterKeypressTrackMouseMoveTimeoutId = setTimeout(function()
                            {
                                if (afterKeypressTrackMouseMove == false)
                                {
                                    afterKeypressTrackMouseMove = true;
                                }
                            }, afterKeypressTrackMouseMoveThreshold);

            };

            function showMenu()
            {
              if (currentView == "flowView") {
                log('showMenu');

                  pauseWpmProcessing();

                  if (!goalReached)
                  {
                      $('.rightPaddle').removeClass('hidableMenuItem');
                  }

                  $('.hidableMenuItem:not(#saveContentDiv)').fadeIn(500);

                  if (afterKeypressTrackMouseMove)
                  {
                      afterKeypressTrackMouseMove = false;
                  }
              }
            };

            function pauseWpmProcessing()
            {
              log('pauseWpmProcessing');

                if (!wpmProcessingPaused)
                {
                    wpmProcessingPaused = true;
                }
            };

            function processWPM(keyCode)
            {
              log('processWPM');

                if (((keyCode == 32) || (keyCode == 13)) && ((lastKeyCodePressed != 32) && (lastKeyCodePressed != 13)))
                {
                    var keyPressTime = new Date().getTime();
                    var tempWpmTimesCollection = [];

                    if (wpmProcessingPaused)
                    {
                        var timeOffset = keyPressTime - wpmTimesCollection[wpmTimesCollection.length - 1];

                        // refresh wpmTimesCollection with new records
                        wpmTimesCollection.map( function(wpmItem)
                        {
                            tempWpmTimesCollection.push(wpmItem + timeOffset);
                        });

                        wpmTimesCollection = tempWpmTimesCollection.sort();
                        tempWpmTimesCollection = [];

                        wpmProcessingPaused = false;
                    }

                    // add new word to the collection
                    wpmTimesCollection.push(keyPressTime);

                    // remove any word from the wpmWordCollection that is older than a minute
                    var oneMinuteAgo = new Date().getTime() - 60000;

                    wpmTimesCollection.map( function(wpmItem)
                    {
                        if (wpmItem >= oneMinuteAgo)
                        {
                            tempWpmTimesCollection.push(wpmItem);
                        }
                    });

                    wpmTimesCollection = tempWpmTimesCollection.sort();

                    // count the words and update the WPM label
                    var wpm = wpmTimesCollection.length + ' WPM';

                    $('#wpmLabel').html(wpm);
                }
            };

            function updateWordCountToServer()
            {
              log('updateWordCountToServer');

                if (wordCountUpdateCounter >= wordCountUpdateThreshold)
                {
                    updateTotalWordCountToServerAjax();
                    updateContentToServerAjax();
                    attemptSaveToServer();
                    wordCountUpdateCounter = 0;
                }
            };

            function setHiddenWordCountField(count) {
              log('setHiddenWordCountField');

                $("#word_count").val(count);
            };

            function updateProgressBar(count)
            {
              log('updateProgressBar');

                if (count == 0)
                {
                    $(".meter").css("background-color", "#f00");
                    $(".meter").css("width", "100%");
                }
                else
                {
                    var progressBarWidth = parseInt((count * 100)/wordsToWrite);
                    //var color = (progressBarWidth * 1.3);
                    //var colorString = "rgb(" + 0 + "," + color + "," + 0 + ")";
                    var colorString = "rgb(0 , 128, 0)";

                    $(".meter").css("width", progressBarWidth  + "%");
                    $(".meter").css("background-color", colorString);
                }
            };

            $(window).load(function()
            {
              log('window.load');

                processGhettoTek();
            });

            $(window).resize(function()
            {
              log('window.resize');

                processGhettoTek();
            });

            function viewController(viewToShow)
            {
              log('viewController');

                pauseWpmProcessing();

                switch(viewToShow)
                {
                    case "setupDisplay":
                        currentView = "setupDisplay";
                        setCaptureKeyPress(false);

                        $(".setupView").css("display", "block");
                        $(".flowView").css("display", "none");
                        $(".summaryView").css("display", "none");
                        $("#flowCollectionNotification").css("display", "none");

                        processGhettoTek();

                        break;
                    case "flowView":
                        currentView = "flowView";

                        $("#flowEntry").text('');

                        if (goalReached) { displayPaddles(false, true); }

                        $(".setupView").css("display", "none");
                        $(".flowView").css("display", "block");
                        $(".summaryView").css("display", "none");
                        $("#flowCollectionNotification").css("display", "none");
                        $("#wrongCharacterDiv").css("display", "none");

                        setCaptureKeyPress(true);

                        processGhettoTek();

                        break;
                    case "summaryView":
                        currentView = "summaryView";

                        setCaptureKeyPress(false);

                        // add any remaining character(s) to the flowCollection
                        appendToFlowCollection($("#flowEntry").val());

                        // trim the flowCollection
                        var trimmedFlowCollection = $.trim($("#flowCollection").val());
                        $("#flowCollection").val(trimmedFlowCollection);

                        displayPaddles(true, false);

                        $("#flowCollectionNotification").css("display", "flex");
                        $(".setupView").css("display", "none");
                        $(".flowView").css("display", "none");
                        $(".summaryView").css("display", "flex");
                        $("#flowCollection").focus();

                        processGhettoTek();

                        break;
                    default:
                        currentView = "none";
                        break;
                }
            };

            function setNinjaMode(setNinjaModeValue) {
              log('setNinjaMode');

                if (setNinjaModeValue)
                {
                    $("#ninjaModeOffDiv").css("display", "none");
                    $("#ninjaModeOnDiv").css("display", "block");

                    $('#ninjaModeCheckbox').prop('checked', true);
                    $("#is_ninja_mode").val("1");

                    $('#wordCountLabel').addClass('hidableMenuItem');

                    appendToFlowCollection(' ');
                    ninjaMode = true;

                    $('#wordCountLabel').html("Ninja Mode On");
                }
                else
                {
                    $("#ninjaModeOffDiv").css("display", "block");
                    $("#ninjaModeOnDiv").css("display", "none");

                    $('#ninjaModeCheckbox').prop('checked', false);
                    $("#is_ninja_mode").val("0");

                    $('#wordCountLabel').removeClass('hidableMenuItem');

                    appendToFlowCollection(' ');
                    ninjaMode = false;

                    $('#wordCountLabel').html("Ninja Mode Off");
                }
            };

            function setCaptureKeyPress(value)
            {
              log('setCaptureKeyPress');

                captureKeyPress = value;

                if (captureKeyPress) {
                    listener.listen();
                }
                else {
                    listener.stop_listening();
                }
            };

            function displayStartHerePanel(panelToDisplay)
            {
              log('displayStartHerePanel');

                if (panelToDisplay == 'continueSavedFlow')
                {
                    $("#continueSavedFlow").css("display", "block");
                    $("#startNewFlow").css("display", "none");
                }
                else if (panelToDisplay == 'startNewFlow')
                {
                    $("#continueSavedFlow").css("display", "none");
                    $("#startNewFlow").css("display", "block");
                }
            };

            function displayPaddles(leftPaddleVisible, rightPaddleVisible)
            {
                log('displayPaddles');

                if (wordCount() > 0) {
                    if (leftPaddleVisible == true)
                    {
                        $('#leftPaddle').css("display", "block");
                    }
                    else
                    {
                        $('#leftPaddle').css("display", "none");
                    }

                    if (rightPaddleVisible == true)
                    {
                        $('#rightPaddle').css("display", "block");
                    }
                    else
                    {
                        $('#rightPaddle').css("display", "none");
                    }
                }
                else {
                    $('#leftPaddle').css("display", "none");
                    $('#rightPaddle').css("display", "none");
                }
            };

            function displayPeekOrDone(showPeekIcon, showDoneIcon)
            {
                log('displayPeekOrDone');

                if (showPeekIcon == true)
                {
                    $("#peekDiv").css("display", "block");
                }
                else
                {
                    $("#peekDiv").css("display", "none");
                }

                if (showDoneIcon == true)
                {
                    $("#completeCheckDiv").css("display", "block");
                }
                else
                {
                    $("#completeCheckDiv").css("display", "none");
                }

                hideElementsOnNoSetGoal();
            };

            function appendToFlowCollection(valueToAppend) {
              log('appendToFlowCollection');

                $("#flowCollection").val($("#flowCollection").val() + valueToAppend);

                if (!ninjaMode)
                {
                    $("#flowEntry").text(valueToAppend);
                    $("#flowEntryTextbox").val(valueToAppend);
                }
                else
                {
                    $("#flowEntry").text('');
                    $("#flowEntryTextbox").val('');
                }

                if (valueToAppend.charCodeAt(0) == 32)
                {
                    updateProgress();
                    updateWordCountToServer();
                    updateLocalStorage();
                }
            };

            function updateLocalStorage()
            {
              log('updateLocalStorage');

                var local_storage_updated_at = new Date().getTime();

                localStorage["ilysWritingInProgress"] = $("#flowCollection").val();
                localStorage["ilysWordsToWrite"] = wordsToWrite;
                localStorage["ilysLocalStorageUpdatedAt"] = local_storage_updated_at;
                localStorage["ilysStoryId"] = $('#story_id').val();
                localStorage["ilysStoryName"] = $('#story_name').val();
                localStorage["ilysSessionId"] = $('#session_id').val();
                localStorage["ilysSessionName"] = $('#session_name').val();
                localStorage["ilysUserId"] = $('#user_id').val();

                if ( $('#story_content_id').length )
                {
                    localStorage["ilysStoryContentIdInProgress"] = $('#story_content_id').val();
                }
                else
                {
                    localStorage.removeItem("ilysStoryContentIdInProgress");
                }

                if (ninjaMode == true)
                {
                    $("#is_ninja_mode").val('1');
                }
                else
                {
                    $("#is_ninja_mode").val('0');
                }

                $("#local_storage_updated_at").val(local_storage_updated_at);
                $("#words_to_write").val(wordsToWrite);
            };

            function wordCount() {
                var box = $("#flowCollection").val();
                var boxTrimmed = box.trim();

                if (boxTrimmed.length == 0)
                {
                    return 0;
                }
                else
                {
                    var boxCount = boxTrimmed.replace(/\s{2,}/g, ' ').split(" ");
                    return boxCount.length;
                }
            };

            function attemptSaveToServer()
            {
              log('attemptSaveToServer');

                ajaxData = {
                        content_in_progress: localStorage.getItem('ilysWritingInProgress'),
                };

                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                $.post( "attempt-save-wip-to-story", ajaxData)
                    .done(function( data ) {
                      log('attempted save complete');
                    });
            };

            function updateContentToServerAjax()
            {
              log('updateContentToServerAjax');

                var ilys_local_storage_updated_at = localStorage.getItem('ilysLocalStorageUpdatedAt');
                var ilys_server_storage_updated_at = {{$writing_session->local_storage_updated_at ? $writing_session->local_storage_updated_at : "0"}};

                var ajaxData = {};

                if (ilys_server_storage_updated_at < ilys_local_storage_updated_at)
                {
                    ajaxData = {
                        writing_session_token: "{{$writing_session->writing_session_token}}",
                        content_in_progress: localStorage.getItem('ilysWritingInProgress'),
                        words_to_write: localStorage.getItem('ilysWordsToWrite'),
                        user_id: localStorage.getItem('ilysUserId'),
                        story_id: localStorage.getItem('ilysStoryId'),
                        word_count: $("#word_count").val(),
                        is_ninja_mode: $("#is_ninja_mode").val(),
                        local_storage_updated_at: ilys_local_storage_updated_at
                    };
                }
                else
                {
                    ajaxData = {
                        writing_session_token: "{{$writing_session->writing_session_token}}",
                        words_to_write: localStorage.getItem('ilysWordsToWrite'),
                        word_count: $("#word_count").val(),
                        is_ninja_mode: $("#is_ninja_mode").val(),
                        local_storage_updated_at: ilys_local_storage_updated_at
                    };
                }

                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                $.post( "update-writing-session", ajaxData)
                    .done(function( data ) {
                      log('update-writing-session complete');

                        if (!ninjaMode)
                        {
                            $('#saveContentDiv').fadeIn(200).delay(500).fadeOut(200);
                        }
                    });
            };

            function updateTotalWordCountToServerAjax()
            {
              log('updateTotalWordCountToServerAjax');

                ajaxData = {
                    writing_session_token: "{{$writing_session->writing_session_token}}",
                    update_word_count: wordCountUpdateCounter
                };

                $.ajaxSetup({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                });

                $.post( "update-wordcount", ajaxData)
                    .done(function( data ) {
                      log('update-wordcount complete');
                    });
            };

            $("#wordsToWriteTextbox").keydown(function(e)
            {
                if (e.shiftKey)
                   e.preventDefault();
                else
                {
                    var nKeyCode = e.keyCode;
                    //Ignore Backspace, Enter and Tab keys
                    if (nKeyCode == 8 || nKeyCode == 9 || nKeyCode == 13)
                        return;
                    if (nKeyCode < 95)
                    {
                        if (nKeyCode < 48 || nKeyCode > 57)
                        {
                            e.preventDefault();
                        }
                    }
                    else
                    {
                        if (nKeyCode < 96 || nKeyCode > 105)
                        {
                            e.preventDefault();
                        }
                    }
               }
            });

            if (screenfull.enabled) {
            	screenfull.on('change', function() {
                if (screenfull.isFullscreen) {
                  $('#fullscreenOffDiv').show();
                  $('#fullscreenOnDiv').hide();
                }
                else {
                  $('#fullscreenOffDiv').hide();
                  $('#fullscreenOnDiv').show();
                }
            	});
            }

            $( document ).ready(function() {
              log('document.ready');

                if ($("#continue_writing_session").val() == '1')
                {
                    $("#flowCollection").val($("#content_in_progress").val());
                    if ($("#is_ninja_mode_from_db").val() == '1')
                    {
                        setNinjaMode(true);
                    }
                    else
                    {
                        setNinjaMode(false);
                    }

                    wordsToWrite = $("#words_to_write").val();
                    $("#wordCountLabel").html(wordCount());

                    updateProgress();
                    enablePopoverForGoalReached();

                    var requestedView = $('#requested_view').val();

                    if (requestedView == 'edit') {
                      viewController("summaryView");
                    }
                    else {
                      viewController("flowView");
                    }
                }
                else
                {
                    viewController("setupDisplay");
                }

                updateLocalStorage();
            });
        })
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45457401-1', 'ilys.com');
      ga('send', 'pageview');

    </script>
</body>
</html>
