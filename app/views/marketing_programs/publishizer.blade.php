<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ilys</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/ilys-bootstrap-overrides.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/one-page-wonder.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox-buttons.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{asset('assets/css/jquery.fancybox-thumbs.css')}}" type="text/css" media="screen" />

    <style>
        .phHeaderText {
            font-size: 3em;
            color: #fff;
        }

        .philysText {
            font-size: 4em;
            color: black;
        }

        .headline2 {
            background-color: rgb(218,85,47);
        }

        .header-div2 {
            -webkit-box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.4);
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.4);
        }

    </style>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div id="header-image-container">
	    <!-- Full Width Image Header -->
      <header class="header-image">
	        <div class="headline">
              <div class="row">
    		        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div>
                      <h1>Free Your Mind</h1>
                      <p class="lead">ilys trains your creative-mind<br/>
                      to experience pure writing flow.</p>
                  </div>
                  <div>
                      <span class="visible-lg visible-md">
                        <a class="btn btn-lg btn-primary" href="/users/create" role="button">Try ilys free!</a>
                        <a class="btn btn-lg btn-primary" href="/users/login" role="button">Sign in</a>
                      </span>
                      <span class="visible-sm visible-xs">
                        <a class="btn btn-md btn-primary" href="/users/create" role="button">Try ilys free!</a>
                        <a class="btn btn-md btn-primary" href="/users/login" role="button">Sign in</a>
                      </span>
                  </div>
              </div>
          </div>
		    </div>
	    </header>
	</div>
    <div class="header-div2">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style="background-color: rgb(230,230,230)">
                <div class="visible-md visible-lg">
                    <img src="{{asset('assets/img/partner_assets/Publishizer_Logo.png')}}"><br/>
                    <div class="phHeaderText" style="color: #000">Special Offer for the Publishizer community.</div><br/>
                </div>
                <div class="visible-xs visible-sm">
                    <img src="{{asset('assets/img/partner_assets/Publishizer_Logo_300.png')}}"><br/>
                    <div class="phHeaderText" style="color: #000">Special Offer for<br/>the Publishizer community.</div><br/>
                </div>
                <br/>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container">
        <br/>
        <br/>
        <div class="featurette" id="loveWriting">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-heart-o fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Love writing again.<br/>
            <span class="text-muted">Have fun and feel great!</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">Writing can be so much fun when our creative juices are flowing.  This beautiful and delicious state of being is sometimes called a <strong>peak experience</strong> -- something rare and hard to find.  We've discovered that this state of flow can be had easily and effortlessly by training ourselves to let go of our inner-editor while our creative-genius is given the freedom to run wild with unbounded expression.  Cultivating this flow within you is why ilys exists.</p>
        </div>

        <hr class="featurette-divider">

        <div class="featurette" id="unlockYourGenius">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-key fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Unlock your genius.<br/>
            <span class="text-muted">Let your creativity soar.</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">When you've tapped and practiced the ability to let go of your inner-editor, you will release within you a gushing torrent of latent creative-potential.  Without the nagging inner-critic interrupting your every move, your creative output will explode through the box that once constrained it.</p>
        </div>
        <hr class="featurette-divider">
        <div class="featurette" id="forwardOnly">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-forward fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Forward only.<br/>
            <span class="text-muted">The golden path to magic.</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">To start a writing session, tell ilys how many words you want to write.  Then begin writing and see that there is nothing else you can do but to just keep writing.  You can't go back, delete or edit anything until you have completed your word count goal.  When you have reached your goal, only then can you edit your text in every way you want.
            <br/>
            <br/>
            Don't get us wrong, we <i class="fa fa-heart"></i> the inner-editor and are fully aware of the very vital role it plays in the writing process.  We also believe that its time to shine comes AFTER the creation phase, not during.  The results of keeping these phases separate are tremendous improvements in the quantity and quality of your written works.</p>
        </div>
        <hr class="featurette-divider">
        <div class="featurette" id="winNaNoWriMo">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-trophy fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Win <a href="http://www.nanowrimo.org" target="_new">NaNoWriMo</a>!<br/>
            <span class="text-muted">You now have the Master Key.</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify"><a href="/testimonials">Many people have found their creativity explode</a> during <a href="http://www.nanowrimo.org" target="_new">NaNoWriMo</a> with ilys because they share the same foundational principle:&nbsp;&nbsp;<strong>JUST KEEP WRITING!</strong>  The tremendous boost to your output comes from keeping your inner-editor far away from your creative process while you write, write, write.  The <a href="http://aliciavannoycall.blogspot.com/2014/11/ilys.html" target="_new">unleashed creative flow</a> is so powerful that winning <a href="http://www.nanowrimo.org" target="_new">NaNoWriMo</a> becomes a reality for many who attempt and follow through with it.
            <br/><br/>
            <div class="well lead">
            <strong>Thomas Harper says:</strong> I had two four thousand words sessions today. Since I worked last night, today is my first day and that makes this my most successful start to nanowrimo in my eleven years taking part in the event.<br/><br/>
            <strong>Callie Sandberg says:</strong> Just want to say thank you to ilys for allowing me to start writing 5,000 words without looking back at my mistakes. This NaNo year will be the year that I win thanks to this website.<br/><br/>
            <strong>Arya Turner says:</strong> ilys helps me to concentrate on writing. I have problems with staying focused on writing and not going back and fixing mistakes and typos and reading what nonsense I am creating :) When I can't see what I write I can simply write further without caring too much. It turned out to be really useful during NaNoCamp :)<br/><br/>
            <strong>Ellie McRitchie says:</strong> ilys is fantastic! It's helped me out so much with NaNoWriMo this year, as I'm terrible for reading and rereading everything I've written over and over, editing as I go along. ilys removes that option, which has really helped me bump up my word count and keep on top of everything. :)<br/><br/>
            <strong>Ella says:</strong> When I first heard about ilys, I thought to myself, "This can't be helpful for me. It sounds so frustrating!" However, I tried it, and I was astounded by how much I was able to get done. Now, I can write about a thousand words in half an hour, which is perfect for NaNoWriMo and Camp NaNoWriMo. I recommended it to my sister, and now we both use it daily. Good job, guys!<br/><br/>
            <strong>Solomon says:</strong> ilys is absolutely awesome. I am currently participating in the Nanowrimo camp month-long novel write and it is really helping me to achieve my word-count goals. Before I was trying to write in 300 word sessions multiple times throughout the day but was finding it very difficult to accomplish these quickly and effectively. When I started using ilys I have upped my word-count daily goal from 500 words per day to 1000. Having said this, thank you so much for this program.<br/><br/>
            <strong>Charlie says:</strong> I found this website today via NaNoWriMo and wow this is very, very useful. Not only is the "block your inner editor" very useful, but it's a great way of doing "I won't take a break until I've done 1000 words" kind of thing. It really does make things flow really well too, because I often go back and re-read sentences which can be a big distraction. I think the black background works really well to because it's minimally distracting. THANK YOU FOR THIS BEAUTIFUL GIFT OF A WEBSITE.<br/><br/>
            <strong>Babette says:</strong> I LOVE ilys it helped me SO much for NaNoWriMo last November and it's helping again this year! Thank you so much for this awesome website!
            </panel></p>
        </div>
        <hr class="featurette-divider">
        <div class="featurette" id="trackYourProgress">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa fa-bar-chart fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Track your progress.<br/>
                <span class="text-muted">Enjoy a rock-solid writing habit.</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">Do you want to improve your word-counts and write more consistently?  Like a good coach, ilys will track your progress over time and help you see where you're rocking and when you've dipped in your output.  Many professionals repeat the mantra of consistency in writing, whether good or bad, as the master-key to ultimate writing success.  We agree with this philosophy and want to support you with it.</p>
        </div>
        <hr class="featurette-divider">
        <div class="featurette" id="privacy">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-eye-slash fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Enjoy complete privacy.<br/><span class="text-muted">They can't see it.</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">Do you worry about people reading what you're writing as they stand behind your back?  Writing in public spaces with ilys is awesome because the only visible text on the screen is the very last letter you typed.  If even that one letter is too much, you can turn on Ninja Mode and flow in stealth.  Your words are invisible until you're ready to reveal them.  You can always click on the <i class="fa fa-eye"></i> icon and have a peek at your text when you want it.</p>
        </div>
        <hr class="featurette-divider">
        <div class="featurette" id="endToEndEncryption">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-lock fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">End to end encryption.<br/>
                <span class="text-muted">Because your data is worth it.</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">We take your data very seriously.  That's why all communications with ilys happen through the Secure Channel, also known as SSL.  This is the same technology that keeps you safe when you share your payment information with Amazon or any other highly-trusted online site.  While our communication-pipes are tightly secured, we don't stop there.  All of your story data is professionally encrypted and looks like absolute gobbledy-gook (that's a technical term) to human eyes in our database.  You can rest assured knowing we've got security handled.</p>
        </div>
        <hr class="featurette-divider">
        <div class="featurette" id="soMuchMore">
            <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                <i class="fa fa-usd fa-stack-1x"></i>
            </span>
            <h2 class="featurette-heading">Publishizer = Half Price!<br/>
                <span class="text-muted">Are you kidding?!</span>
            </h2>
            <br/>
            <br/>
            <p class="lead text-justify">Nope.  Not kidding.  You are a member of the leading-edge Publishizer community and obviously a being who is open to appreciating new and exciting ways of doing things, yes?  We want you to have ilys and to blossom with a freedom of expression unlike you've ever known before.  We want that freedom of expression to ripple through your writing into a fuller flow in every area of your life.  We want you to thrive in every way and to be joyous in the ecstasy of your creation!  You have access to this exclusive offer because we know you're awesome and we think we'll like you... a lot!<br/><br/>
            The price of ilys for the general public is $10.08 per month.  For you we have created something very special, $59.99 annually.
            <br/><br/>
            Because ilys isn't for everybody, you'll want to <a href="/users/create" role="button">try ilys</a> before you buy and make sure it's really for you. It takes a certain kind of person to allow themselves to experience the letting go that ilys facilitates so beautifully.  It's in that letting go that vast torrents of creativity can flow.  While ilys isn't for everybody, for those of us who get it, we LOVE it!  We know that to truly understand what this is all about, you need to actually use it and have the experience.  So go ahead, <a href="/users/create" role="button">create an account</a> and take ilys for a very long test-drive.</p>
            <br/>
            <p class="lead text-justify">Because ilys is unique, it might seem very weird at first.  This weirdness is your first opportunity to practice letting-go with ilys.  Get past any thoughts you have about it and just start typing, and just keep typing.  Any thoughts you have that cause you to slow down, pause or stop, let them go and continue typing.  Just keep going and see what happens.  Try to get your fingers moving faster than your thoughts and see what happens.  Notice yourself creating as you practice letting go.  You might just enter the magic space and completely surprise yourself with the genius you unleash when your inner-editor takes a nap while you write.
            <br/><br/>
            You will have <strong>3,000 free trial words</strong> to play with.</p>
        </div>
        <br/><br/>
        <a class="btn btn-lg btn-primary btn-block" href="/users/create" role="button">Try ilys for free!</a>
        <br/><br/><br/>
    </div>
    </div>
    <!-- Footer -->
    <div id="footer">
            <br/>
            <div id="footerBorder">&nbsp;</div>
            <div class="col-lg-12 text-center ilys-footer">
                <br/><br/><br/>
                <p class="muted credit">&copy; <?php echo date("Y") ?> ilys</p>
                <br/><br/><br/>
            </div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- Add fancyBox -->
    <script type="text/javascript" src="{{asset('assets/js/jquery.mousewheel-3.0.6.pack.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.fancybox.js?v=2.1.5')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.fancybox-buttons.js?v=1.0.5')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.fancybox-thumbs.js?v=1.0.5')}}"></script>

    <script>
    $(document).ready(function() {
        $('.fancybox_lg').fancybox({
            width : 1280,
            height : 720,
            fitToView : true,
            autoSize : true,
            openEffect : 'fade',
            closeEffect : 'fade',
            aspectRatio : true
        });

        var isMobile = false; //initiate as false
        // device detection
        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
            || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

        if (isMobileDevice())
        {
            $("#videoButtonLg").removeClass('fancybox_lg').attr("href", "https://www.youtube.com/watch?v=mLFNwQDFyDI");
            $("#videoButtonSm").removeClass('fancybox_lg').attr("href", "https://www.youtube.com/watch?v=mLFNwQDFyDI");
        }
    });

    function isMobileDevice() {
        return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
    };

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45457401-1', 'ilys.com');
      ga('send', 'pageview');

    </script>
</body>

</html>
