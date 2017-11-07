<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml" lang="en"><head>
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

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <title>ilys</title>
    <!-- Bootstrap Core CSS -->
    <style>
        body {
            margin: 0;
            background: #000;
        }
        video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -100;
            transform: translateX(-50%) translateY(-50%);
            background: url('https://www.ilys.com/assets/img/ilysFullscreenPoster.jpg') no-repeat;
            background-size: cover;
            transition: 1s opacity;
        }
        .stopfade {
            opacity: .5;
        }
        #signup {
            background: blue;
        }
        #mainContent {
            font-family: 'Open Sans', sans-serif;
            background: #000;
            opacity: 1;
            color: #ddd;
            padding: 2rem;
            width: 300px;
            line-height: 1.8rem;
            float: left;
            font-size: 1rem;
            border-right: 3px solid #d9230f;
            text-align: justify;
            text-justify: inter-word;
        }
        h1 {
            font-size: 3rem;
            text-transform: uppercase;
            margin-top: 0;
            letter-spacing: .3rem;
        }
        #mainContent button {
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
        #mainContent button:hover {
            background: #d9230f;
            opacity: .9;
        }
        a {
            display: inline-block;
            color: #fff;
            text-decoration: none;
            background: rgba(0, 0, 0, 1);
            transition: .6s background;
        }
        a:hover {
            background: rgba(0, 0, 0, 0.9);
        }
        input {
            width: 96%;
            padding: .4rem;
            border: none;
            margin: 1rem auto;
            font-size: 1.3rem;
            background: white;
            color: black;
        }
        #grant {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            vertical-align: text-top;
            margin-right: 20px;
            border: 3px solid white;
        }
        #ilysHorns {
            position: fixed;
            bottom: 5px;
            right: 15px;
        }
        #mobileView {
            display: none;
        }

        /* Styles for small screens */
        @media  screen and (max-width: 500px) {
            #bgvid, #ilysHorns {
                display: none;
            }

            #mainContent {
                box-sizing: border-box;
                width: 100%;
            }
            #mobileView {
                display: block;
                padding: 30px;
                text-align: center;
                color: #d9230f;
                background-color: #d9edf7;
            }
            #mainLoginButton, #share-box {
                display:none;
            }
        }

        @media  screen and (max-device-width: 800px) {
            html {
            }
            #bgvid {
                display: none;
            }
            #ilysHorns {
                display: none;
            }
            #mobileView {
                display: flex;
            }
            #mainLoginButton, #share-box {
                display:none;
            }
        }
    </style>
</head>

<body>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=414356978658429";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<video poster="https://www.ilys.com/assets/img/ilysFullscreenPoster.jpg" id="bgvid" playsinline="" autoplay="" muted="" loop="">
    <source src="https://www.ilys.com/assets/img/ilysFullscreen.mp4" type="video/mp4">
</video>
<div>
    <img src="https://www.ilys.com/assets/img/ilysHorns150.png" id="ilysHorns">
</div>
<div id="flex">
    <div id="mobileView">
      Please visit ilys.com with your computer for the better experience.
    </div>
    <div id="mainContent">
        <div style="display: flex; background-color: #777; line-height: 1.4em; padding: 20px; margin-bottom: 14px; border-radius: 8px;">
            <div>
                <img src="https://www.ilys.com/assets/img/grant_faulkner_SFSU.jpg" id="grant">
            </div>
            <div>
                <span style="color: white; font-size: 1.2em;">Grant Faulkner</span>
                <br> Executive Director
                <br> @NaNoWriMo  says:
            </div>
        </div>
        <div style="background-color: #444; padding: 20px; margin-top: -15px; border-radius: 8px;">
            "The best way to learn to write a novel? <span style="color:lime;"><b>Sit down and write.</b></span> You'll find your muse in the words on the page."
        </div>
        <h3 style="padding-top: 8px;">Want to win NaNoWriMo?</h3>
        Really ponder the meaning of what Grant said: The master-key is to start writing and keep writing, no matter what. Save the editing for after you have written your first draft, in December.
        <br>
        <h3>For now, just write.</h3>
        It's all very simple in theory, but can be quite difficult in practice. Many people get caught up in endless loops of self-criticism. Instead of letting words flow through them with pleasurable ease, they are mired by doubt and fear. This can easily cause writer's block, which results in creative paralysis and the death of fun.
        <br>
        <br>
        But not you...
        <h3 style="color: lime;">You found ilys.</h3>
        Many people have found their creativity explode during NaNoWriMo with ilys because we share the same foundational principle:
        <br>
        <h3>Just keep writing!</h3>
        The tremendous boost to your output comes from keeping your inner-editor far away from your creative process while you write, write, write. The unleashed creative flow is so powerful that winning NaNoWriMo transforms from an impossible dream into a very pleasurable reality.
        <br>
        <br>
        We use positive and negative reinforcement to train your neurology into a creative flow state, effectively hacking your psychology towards better writing.
        <br>
        <br>
        You can't edit, you can't delete, you can only go forward.
        <br>
        <br>
        It's awesome for NaNoWriMo! Want proof?
        <br>
        <br>
        <a href="https://www.linkedin.com/pulse/13-time-nanowrimo-winner-instantly-doubled-his-output-gurevich-1/" target="_new" style="color: cyan; text-decoration: underline;">Click here to read how Thomas Harper, 13 Time NaNoWriMo Winner Instantly Doubled His Output To Win Twice In Less Than One Month!</a>
        <br>
        <br>
        Want more proof?
        <br/>
        <br/>
        Try it!
        <br/>
        <br/>
        We know that to truly understand what ilys is all about, you need to actually use it and have the experience. So go ahead, create an account and take ilys for a 3,000 word test flight to discover the exhilaration of pure writing flow.
        <br>
        <br>
        When you discover that ilys is right for you, you can become an honored NaNoWriMo member for less than 14 cents per day, discounted 60% off the standard price.
        <br>
        <h3 style="color: lime;">LUCKY YOU!</h3>
        Because ilys is unique, it might seem very weird at first. This weirdness is your first opportunity to practice letting-go of your inner-critic. Get past any thoughts you have about it and just start writing, and just keep writing. Any thoughts you have that cause you to slow down, pause or stop, let them go and continue writing.
        <br>
        <br>
        Just keep going and see what happens. Try to get your fingers moving faster than your thoughts. Notice yourself creating as you practice letting go. You might just enter the magic space and completely surprise yourself with the genius you unleash when your inner-critic takes a nap while you write.
        <br>
        <br>
        When you're done, remember Grant:
        <br>
        <br>
        <span style="color: lime;">"You'll find your muse in the words on the page."</span>
        <br>
        <br>
        <div id="share-box">
          <div style="background-color: black; display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 0px; padding: 14px; position: fixed; top: 90px; right: 15px; width: 118px; border: 2px solid white;">
          <div style="margin-bottom: 10px;" class="fb-share-button" data-href="https://www.ilys.com/nanowrimo" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.ilys.com%2Fnanowrimo&amp;src=sdkpreparse">Share</a></div>
          <a href="https://twitter.com/share" class="twitter-share-button" data-size="large" data-text="@ilysdotcom is awesome for #NaNoWriMo, check it out!" data-url="https://www.ilys.com/nanowrimo" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>
        </div>
        <br>
        <button class="signupButton" style="padding: 14px;">Start Your Free Trial</button>
        <button class="loginButton" style="margin-top: 0px; padding: 14px;">Login</button>
        <button class="loginButton" id="mainLoginButton" style="margin-top: 0px; padding: 14px; position: fixed; top: 20px; right: 15px; width: 150px; border: 2px solid white;">Login</button>
    </div>
</div>
<script async="" src="//www.google-analytics.com/analytics.js"></script><script src="https://www.ilys.com/assets/js/jquery-1.11.1.min.js"></script>
<script>
    $(function() {
        var vid = document.getElementById("bgvid");

        function vidFade() {
            vid.classList.add("stopfade");
        }

        $('.signupButton').click(function() {
            vid.pause();
            vidFade();
            window.location.href = "/users/create";
        });

        $('.loginButton').click(function() {
          vid.pause();
          vidFade();
          window.location.href = "/users/login";
        });
    });


    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-45457401-1', 'ilys.com');
    ga('send', 'pageview');
</script>



</body></html>
