<!DOCTYPE html>
<html lang="en">
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
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="Expires" content="Tue, 01 Jan 1995 12:12:12 GMT">
		<title>
			@section('title')
			ilys
			@show
		</title>
		<meta name="_token" content="{{ csrf_token() }}"/>
		@section('meta_keywords')
		<meta name="keywords" content="nanowrimo, writers block, flow, creativity, creative, author, writing" />
		@show
		@section('meta_author')
		<meta name="author" content="The Pump Creative" />
		@show
		@section('meta_description')
		<meta name="description" content="ilys unlocks your creative potential." />
                @show
		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/ilys-bootstrap-overrides.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
				<link rel="stylesheet" href="{{asset('assets/css/fireworksStyles.css')}}">

		@section('topScriptsStyles')
		@show

        <!--- Offline.js
        <link rel="stylesheet" href="{{asset('assets/css/offline-theme-default.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/offline-language-english.css')}}">
        -->

		<style>
        .layout-spacer {
            padding: 30px 0;
        }

		.ui-dialog { z-index: 1001 !important ;}
		.ui-front { z-index: 1001 !important; }
		.ui-widget-overlay { z-index: 1000 !important; }


		.mobile-browser {
		    padding-top: 40px;
		}

		.mobile-browser .mobile-warning {
		    display: block;
		}

		.mobile-warning {
		    display: none;
		    left: 0;
		    top: 0;
		    width: 100%;
		    padding: 50px;
		    color: white;
		    background-color: #999;
		    text-align: center;
		    margin-bottom: 15px;
		}

		.panel-default > .panel-heading {
		  background-color: #efefef;
		}

		#welcome-panel, #nanocountdown, #nano-instruments {
		    background-color: #7fcbef;
		    color: white;
		}

		#nanostats {
		  display: flex;
		  flex-direction: column;
		  width: 100%;
		  padding: 20px;
		}

		.nanostatsunit {
		  display: flex;
		  flex-direction: row;
		  justify-content: space-between;
		  font-size: 1.5em;
		}

		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
	</head>
	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div class="mobile-warning">
		    <p>Please use ilys with a laptop or desktop browser.<br/><br/>We are currently making the ilys apps, but for the moment only support full modern browsers.<br/><br/>Thank you :)</p>
		</div>
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar navbar-default navbar-inverse navbar-fixed-top">
			 <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
							<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('/') }}}">Dashboard</a></li>
                        @endif
                    </ul>

                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check())
                        @if (Auth::user()->hasRole('admin'))
                        <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
                        @endif
                        <li><a href="/subscription">Hi {{{ Auth::user()->username }}}!</a></li>
						<li><a href="{{{ URL::to('help') }}}">Help</a></li>
                        <li><a href="{{{ URL::to('users/logout') }}}">Sign out</a></li>
                        @else
                        <li {{ (Request::is('users/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('users/login') }}}">Sign in</a></li>
                        <li {{ (Request::is('users/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('users/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                        @endif
                    </ul>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<div class="layout-spacer"></div>
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->
			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->

		@include('layouts.footer')

 		<!-- Javascripts
		================================================== -->
        <script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

		    <script src="{{asset('assets/js/perlin.js')}}"></script>
				<script src="{{asset('assets/js/fireworks.js')}}"></script>

        @yield('scripts')

	    <script>
				window.mobileAndTabletCheck = function() {
		        var check = false;
		        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
		        return check;
		    };

				$(function() {
					window.isMobileOrTablet = mobileAndTabletCheck();
			    if (isMobileOrTablet) {
			        document.body.classList.add('mobile-browser');
			    }
				});

	      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	      ga('create', 'UA-45457401-1', 'ilys.com');
	      ga('send', 'pageview');
	    </script>
	</body>
</html>
