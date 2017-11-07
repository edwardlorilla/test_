<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en">
	<head>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-45457401-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-45457401-1');
    </script>
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
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta property="og:title" content="ilys">
		<meta property="og:url" content="https://www.ilys.com/nanowrimo">
		<meta property="og:image" content="https://www.ilys.com/assets/img/ilysHorns300.png">
		<meta property="og:site_name" content="ilys">
		<meta property="og:description" content="Many people get caught up in writer's block and get stuck in endless loops of self-criticism. Instead of letting words flow through them with pleasurable ease, they are mired by doubt and fear. But not you... You found ilys.">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="{{asset('assets/css/ilys-bootstrap-overrides.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/one-page-wonder.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


		<title>ilys</title>
		<!-- Bootstrap Core CSS -->
		<style>
			/* Global Styles */
			html,body {
			color:#000;
			font-family:"Open Sans", sans-serif;
			font-size:100%;
			height:100%;
			line-height:1.45;
			margin: 0px;
			}
			#contentBody {
			background-color: #fff;
			border-top: 3px solid red;
			}
      #contentBody button {
          width: 100%;
          padding: .4rem;
          border: none;
          margin: 1rem auto;
          font-size: 1.3rem;
          background: #d9230f;
          color: #fff;
          border-radius: 3px;
          cursor: pointer;
          transition: .3s background;
      }
			/* Video Overlay */
			#overlay {
			background-color:rgba(0,0,0,0);
			height:100%;
			left:0;
			position:relative;
			transition:background-color 300ms ease;
			width:100%;
			}
			.fade { background-color:rgba(0,0,0,.85) !important; }
			/* Hero Video + Fallback */
			#hero-vid {
			backface-visibility:hidden;
			background:url("https://www.ilys.com/assets/img/ilysFullscreenPoster.jpg") no-repeat scroll 0 0 #000;
			background-size:cover;
			bottom:0;
			height:auto;
			min-height:100%;
			min-width:100%;
			perspective:1000;
			position:fixed;
			right:0;
			width:auto;
			z-index:-1;
			}
			#hero-pic {
			display:block;
			height:auto;
			width:100%;
			}
			#state {
			bottom:0;
			cursor:pointer;
			font-size:2.25rem;
			left:0;
			line-height:1;
			padding:2rem 2.5rem 1.65rem;
			position:absolute;
			}
			/* Content Styles */
			#title {
			backface-visibility:hidden;
			left:0;
			perspective:1000;
			width:100%;
			}
			#title h1 {
			background-color:rgba(0,0,0,.5);
			font-family:"Poiret One", sans-serif;
			font-size:2.5rem;
			padding:1rem 1.75rem;
			margin: 0px;
			}
			#content {
			background-color:#fcfcfc;
			padding:2.5rem;
			position:relative;
			z-index:1;
			width: 700px;
			border-left: 3px solid red;
			border-right: 3px solid red;
			}
			#content p {
			font-size:1.25rem;
			letter-spacing:.02rem;
			margin-bottom:1.3rem;
			}
			.text-content {
			text-align: justify;
			}

			.mobile-experience {
				display: none !important;
			}

			.full-experience {
				display: block !important;
			}

			.strong {
				font-weight: bold;
			}
			/* Media Queries */
			@media only screen and (max-width:768px) {
				#overlay { height:auto; }
				#mainLoginButton, #share-box, #mainTrialButton {
						display:none;
				}

				.mobile-experience {
					display: block !important;
				}

				.full-experience {
					display: none !important;
				}

				#content {
					border-left: 0px;
					border-right: 0px;
				}
			}
			/* Visibility Helpers */
			@media only screen and (min-width:769px) {
			.visible-mobile,.visible-tablet,.hidden-desktop { display:none !important; }
			}
			@media only screen and (min-width:480px) and (max-width:768px) {
			.visible-mobile,.hidden-tablet,.visible-desktop { display:none !important; }
			}
			@media only screen and (max-width:479px) {
			.hidden-mobile,.visible-tablet,.visible-desktop { display:none !important; }
			}
		</style>
	</head>
	<body translate="no">
		<div class="mobile-experience" style="width: 100%; background-color: red; padding: 30px; color: white;">Please visit ilys.com with your full-featured computer browser for the better experience.</div>
		<div id="overlay">
			<video class="visible-desktop" id="hero-vid" poster="https://www.ilys.com/assets/img/ilysFullscreenPoster.jpg" autoplay="" loop="" muted="">
				<source type="video/mp4" src="https://www.ilys.com/assets/img/ilysFullscreen.mp4">
			</video>
			<img id="hero-pic" class="hidden-desktop" src="https://www.ilys.com/assets/img/ilysFullscreenPoster.jpg" alt="">
		</div>
		<div id="contentBody">

      <div class="row-fluid">
        <div class="text-center" style="background-color: #000000; margin: 0%;">
          <br/><br/><br/><br/>
          <span style="color: #afebff; font-size: 2.8em; font-family: monospace;">Pure Writing Flow</span><br/><br/><br/>
          <span style="color: #eee; font-size: 1.8em; font-weight: normal; font-family: monospace;">For Professionals<br/>Who Value Their Time<br/>And Require Creativity.</span>
          <br/><br/><br/><br/><br/>
        </div>
      </div>
      <div class="row text-center">
          <a class="btn btn-lg btn-primary col-6" href="/users/login" role="button">Sign in</a>
          <a class="btn btn-lg btn-primary col-6" href="/users/create" role="button">Free trial</a>
      </div>

      <div class="row-fluid">
        <!-- Page Content -->
        <div class="container">
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="featurette" id="loveWriting">
                <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                    <i class="fa fa-heart-o fa-stack-1x" style="color: #d9230f;"></i>
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
                    <i class="fa fa-key fa-stack-1x" style="color: #d9230f;"></i>
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
                    <i class="fa fa-forward fa-stack-1x" style="color: #d9230f;"></i>
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
            <div class="featurette" id="trackYourProgress">
                <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                    <i class="fa fa fa-bar-chart fa-stack-1x" style="color: #d9230f;"></i>
                </span>
                <h2 class="featurette-heading">Track your writing.<br/>
                    <span class="text-muted">Create a rock-solid habit.</span>
                </h2>
                <br/>
                <br/>
                <p class="lead text-justify">Do you want to improve your word-counts and write more consistently?  Like a good coach, ilys will track your progress over time and help you see where you're rocking and when you've dipped in your output.  Many professionals repeat the mantra of consistency in writing, whether good or bad, as the master-key to ultimate writing success.  We agree with this philosophy and want to support you with it.</p>
            </div>
            <hr class="featurette-divider">
            <div class="featurette" id="privacy">
                <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                    <i class="fa fa-eye-slash fa-stack-1x" style="color: #d9230f;"></i>
                </span>
                <h2 class="featurette-heading">Complete privacy.<br/><span class="text-muted">They can't see it.</span>
                </h2>
                <br/>
                <br/>
                <p class="lead text-justify">Do you worry about people reading what you're writing as they stand behind your back?  Writing in public spaces with ilys is awesome because the only visible text on the screen is the very last letter you typed.  If even that one letter is too much, you can turn on Ninja Mode and flow in stealth.  Your words are invisible until you're ready to reveal them.  You can always click on the <i class="fa fa-eye"></i> icon and have a peek at your text when you want it.</p>
            </div>
            <hr class="featurette-divider">
            <div class="featurette" id="endToEndEncryption">
                <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                    <i class="fa fa-lock fa-stack-1x" style="color: #d9230f;"></i>
                </span>
                <h2 class="featurette-heading">Totally secure.<br/>
                    <span class="text-muted">Your story matters.</span>
                </h2>
                <br/>
                <br/>
                <p class="lead text-justify">We take your story very seriously.  That's why all communications with ilys happen through the Secure Channel, also known as SSL.  This is the same technology that keeps you safe when you share your payment information with Amazon or any other highly-trusted online site.  While our communication-pipes are tightly secured, we don't stop there.  All of your story data is professionally encrypted and looks like absolute gobbledy-gook (that's a technical term) to human eyes in our database.  You can rest assured knowing we've got security handled.</p>
            </div>
            <hr class="featurette-divider">
            <div class="featurette" id="soMuchMore">
                <span class="featurette-image img-circle img-responsive pull-left fa-stack fa-lg fa-5x">
                    <i class="fa fa-star fa-stack-1x" style="color: #d9230f;"></i>
                </span>
                <h2 class="featurette-heading">Only $10.08 per month.<br/>
                    <span class="text-muted">So worth it.</span>
                </h2>
                <br/>
                <br/>
                <p class="lead text-justify">Yep, for less than the price of a combo snack at a movie theater, all of this will be yours.  There's good reason why <a href="/testimonials">people love ilys</a> -- it simply works -- very, very well.  We know that to truly understand what this is all about, you need to actually use it and have the experience.  So go ahead, create an account and take ilys for a very long test-drive.</p>
                <br/>
                <p class="lead text-justify">Because ilys is unique, it might seem very weird at first.  This weirdness is your first opportunity to practice letting-go with ilys.  Get past any thoughts you have about it and just start typing, and just keep typing.  Any thoughts you have that cause you to slow down, pause or stop, let them go and continue typing.  Just keep going and see what happens.  Try to get your fingers moving faster than your thoughts and see what happens.  Notice yourself creating as you practice letting go.  You might just enter the magic space and completely surprise yourself with the genius you unleash when your inner-editor takes a nap while you write.  You will have <strong>3,000 free trial words</strong> to play with.</p>
            </div>
            <hr class="featurette-divider">
            <br/>
            <a class="btn btn-lg btn-primary btn-block" href="/users/create" role="button">Try ilys now for free!</a>
            <br/><br/><br/>
        </div>
        </div>
      </div>
      <button class="loginButton" style="margin-top: 0px; padding: 14px; position: fixed; top: 20px; right: 15px; width: 150px; border: 2px solid white;     margin: 1rem auto;
    font-size: 1.3rem;
    background: #d9230f;
    color: #fff;
    border-radius: 3px;
    cursor: pointer;
    transition: .3s background;">Login</button>
		</div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
			$(function() {
        $('.loginButton').click(function() {
            window.location.href = "/users/login";
        });

			  $(window).on("load scroll", function() {
			      var scrolled = $(this).scrollTop();
			      $("#hero-vid").css(
			          "transform",
			          "translate3d(0, " + -(scrolled * 0.25) + "px, 0)"
			      ); // parallax (25% scroll rate)
			  });

				setTimeout(function() {
					if ($(window).scrollTop() < 25) {
						var xval = 0;

						var slide = setInterval (function() {
							$(window).scrollTop(xval++);

							if (xval > 200) {
								clearInterval(slide);
							}
						}, 2);
					}
				}, 8000);
			});
		</script>
	</body>
</html>
