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
			background-color: #7fcbef;
			display: flex;
			justify-content: center;
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
			<div id="content">
				<br/>
				<div id="title-images" class="text-center full-experience">
					<img src='/assets/img/nanosponsor.png' width="200">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src='/assets/img/ilyslogolarge.png' width="240">
				</div>
				<div id="title-images" class="text-center mobile-experience">
					<img src='/assets/img/nanosponsor.png' width="200">
					<br/><br/><br/>
					<img src='/assets/img/ilyslogolarge.png' width="240">
				</div>
				<br/><br/><br/>
				<h2 class="text-center" style="line-height: 1.7em;">
					Release Your Muse<br/>
					Break Your Writer's Block<br/>
					Experience Pure Writing Flow</h2>
				<br/><br/><br/>
        <button class="signupButton" style="padding: 14px;">Start Your Free Trial</button>
        <br/><br/><br/>
				<div class="text-content">Hi, I’m Mike and we’ve been busy designing the most distraction free flow-enhancing writing experience we can imagine.</div>
				<br/>
				<div class="text-content">For us, this means creating a writing experience that will keep you focused, inspired and moving forward while keeping your inner-editor far away from your creative process.</div>
				<br/>
				<div class="text-content">Remember that writing is a multi-phase journey: First the pure freedom of joyous written creation (NaNoWriMo), and then the perfectionism of editing (after NaNoWriMo). They are two very distinct mindsets that require different specialized tools for maximum flow and enjoyable fun. Mixing these two mindsets can easily give you writer's block, which will probably result in the creative paralysis that becomes the tragic ending to this adventure that we definitely don’t ever want to see, ever.</div>
				<br/>
				<div class="text-content"><strong>Instead, why not win?</strong></div>
				<br/>
				<div class="text-content">If your goal is to write 50,000 words as soon as possible and to love the feeling of free-flowing creation moving through you as your neurology blazes with the sparks of genius creativity and otherworldly inspirations, you want to use the right tool for the job. In this case, and for this phase, I believe this tool to be ilys -- it will become your very effective ultra-awesome super-power, Superhero.</div>
				<br/>
				<div class="text-content">We use positive and negative reinforcement to train your neurology into a creative flow state, effectively guiding you towards better writing. With ilys, you can't edit or delete until you've reached your word-count goal and are simply encouraged to keep going.</div>
				<br/>
				<div class="text-content">Using the right super-power for the writing phase will make NaNoWriMo a tremendous success that will produce a powerful momentum and reference point in your life. You dared to dream and to try, and YOU WIN! You will stand upon this new plateau of cherished accomplishment as you go on to dare to dream your next dreams and move towards realizing them in an ever-expanding upward spiral of joy and success, a beautiful life well-lived. You did that!</div>
				<br/>
				<div class="text-content"><strong>SO LET’S WIN! OK?</strong></div>
				<br/>
				<div class="text-content">You can definitely do this. With all of the support from the community, your belief in yourself and your amazing ilys super-powers, consider it done.</div>
				<br/>
				<div class="text-content"><h3><strong><span style="text-decoration: underline;">The Offer:</span></strong></h3></div>
				<div class="text-content">We here at ilys want you to win and experience the joy of your cherished victory. As the brave Superhero WriMo who steps into the arena and onto this wild ride, you can have unlimited ilys for 60% off, at <strong>$48.69</strong> per year. Or, get the monthly pass for <strong>$10.08</strong>. Sign up and try it for free, take it for a 3,000 word test flight to discover the exhilaration of pure writing flow.</div>
				<br/>
				<div class="text-content"><h3><strong><span style="text-decoration: underline;">The Prize:</span></strong></h3></div>
				<div class="text-content">When you win NaNoWriMo with ilys, you will be entered for your chance to win the $1,008.01 NaNoPrize on December 15th. You will find more details about the grand prize inside ilys.</div>
				<br/>
				<div class="text-content">We wish you Godspeed, Good Luck, and above all, A LOT OF FUN!
				<br/>
				<br/>
				<h3><strong>Questions?</strong></h3>
				Please <a href="https://www.ilys.com/contact-us" target="_new">send us a message</a> and ask.
				<br/><br/>
				<div style="width: 100%; display: flex; justify-content: center; flex-direction: row; margin-top: 17px;">
					<div style=""><a href="https://www.linkedin.com/in/michaelgurevich/" target="_new"><img src="/assets/img/oceanmike.jpg" width="100" height="100"></a></div>
					<div style="align-self: center; margin-left: 15px;">Yours in Victory,<br/><a href="https://www.linkedin.com/in/michaelgurevich/" target="_new">Mike Gurevich</a><br/>Founder of ilys</div>
				</div>
				<br/>
        <br/>
				<button class="signupButton" style="padding: 14px;">Start Your Free Trial</button>
				<button class="signupButton" id="mainTrialButton" style="margin-top: 0px; padding: 14px; position: fixed; top: 20px; right: 15px; width: 150px; border: 2px solid white;">Sign Up</button>
			</div>
		</div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
			$(function() {
        $('.signupButton').click(function() {
            window.location.href = "/users/create";
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

							if (xval > 150) {
								clearInterval(slide);
							}
						}, 2);
					}
				}, 8000);
			});
		</script>
	</body>
</html>
