
<?php
	use App\User;
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

<?php 
	if (!Auth::guest()){
		$hashids = new Hashids(GlobalFunctions::getEncKeyUserId());
		$encodedID = $hashids->encode(Auth::user()->id);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

	<?php $title = config('app.title') ?>
	<head>
		<meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	    <title>Biorower - Settings</title>
	    <meta name="keywords" content="" />
	    <meta name="description" content="" />

	    <link rel="icon" href="{{ Request::root() }}/favicon.ico" type="image/x-icon">

		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="{{ URL::asset('js/plugins/iCheck/square/blue.css') }}">
		<!-- Select2 -->
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/plugins/select2/select2.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/plugins/daterangepicker/daterangepicker-bs3.css') }}">
		

		<!-- Theme style -->
		<link rel="stylesheet" href="{{ URL::asset('css/AdminLTE.min.css') }}">
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
		<link rel="stylesheet" href="{{ URL::asset('css/skins/skin-blue.min.css') }}">
		<!-- Date Range Picker -->


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

		@yield('head-script')

		@if (!Auth::guest() && Route::currentRouteAction() != "App\Http\Controllers\RaceController@getLive")
		    <script src="{{ Request::root() }}/../node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	    	<script type="text/javascript">

	    		var socket = io.connect('http://localhost:8890');

		        socket.on('connect', function(){
		            socket.emit('send_identification', "{{ $encodedID }}" );
		        });	    		
		        
		        $(function(){

		            socket.on('receivedMessage', function(){
	                	if ($("#newMessages").text() != ""){
		                	var br = parseInt(parseInt($("#newMessages").text()) + 1);
		                	if (br >= 1){
		                		$(".clsNewMessages").text(br);
		                	}
		                	else{
		                		$(".clsNewMessages").text("");	
		                	}
	                	}
	                	else{
	                		$(".clsNewMessages").text(1);
	                	}

	                	$(".newMessagesWrapper").effect( "bounce", {times:5}, 1000 );
		            });

		        });

	        </script>
		@endif

		@yield('page-script')

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>
<body class="skin-blue fixed sidebar-mini">
<div class="wrapper">

<header class="main-header">
	<?php
	$newMessages = User::where('id', Auth::user()->id)->with('messagesCount')->first()->messagesCount;
	if (!empty($newMessages))
	{
		$newMessages = $newMessages->count;
	}
	?>

	<!-- Logo -->
	<a href="{{ url('/') }}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>BIO</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><img src="{{ URL::asset('images/login/Logo.png') }}" alt="Biorower" style="margin-top: 10px" /></span>
	</a>

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">

				<!-- Messages: style can be found in dropdown.less-->
			
				<!-- Notifications: style can be found in dropdown.less -->
			<!--	<li class="dropdown notifications-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-warning">10</span> </a>
					<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
											<ul class="menu">
								<li> <a href="#"> <i class="fa fa-users text-aqua"></i> 5 new members joined today </a> </li>
								<li> <a href="#"> <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems </a> </li>
								<li> <a href="#"> <i class="fa fa-users text-red"></i> 5 new members joined </a> </li>
								<li> <a href="#"> <i class="fa fa-shopping-cart text-green"></i> 25 sales made </a> </li>
								<li> <a href="#"> <i class="fa fa-user text-red"></i> You changed your username </a> </li>
							</ul>
						</li>
						<li class="footer"><a href="#">View all</a></li>
					</ul>
				</li> 
			-->
				<!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ URL::asset(Auth::user()->profile->image->name) }}" class="user-image" alt="User Image">

                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span> 
                    </a>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                        <br>
                            <a href="{{ url('/profile/edit') }}">
                                    <img src="{{ URL::asset(Auth::user()->profile->image->name) }}" class="user-image" alt="User Image">                
                            </a>

                            <p class="h2-subhead"> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <small>Member since {{ date('M Y', strtotime(Auth::user()->created_at)) }}</small> </p>


                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left"> <a href="{{ url('/profile/edit') }}" class="btn btn-default btn-flat">Profile</a> </div>
                            <div class="pull-right"> <a href="{{ url('/profile/logout') }}" class="btn btn-default btn-flat">Sign out</a> </div>
                        </li>
                    </ul>
                </li>
			</ul>
		</div>


		<!-- search form -->
		<!-- Privremeno gasenje pretrage
		<div class="nav-search pull-right">
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
				</div>
			</form>
		</div>
		-->
		<!-- /.search form -->

	</nav>
</header>

<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ URL::asset(Auth::user()->profile->image->name) }}" class="user-image" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</p>
				<!-- Status -->
			</div>
		</div>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">NAVIGATION</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="{{ setActive('profile') }}"><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
			<li class="{{ setActive('sessions/calendar') }}"><a href="{{ url('/sessions/calendar') }}"><i class="fa fa-calendar"></i> <span>My Calendar</span></a></li>
			<li class="{{ setActive('profile/sessions') }}"><a href="{{ url('/profile/sessions') }}"><i class="fa fa-tasks"></i> <span>My Sessions</span></a></li>
			<!--
			<li class="{{ setActive('sessions/training') }}"><a href="{{ url('/sessions/training') }}"><i class="fa  fa-ship"></i> <span>My Training Session</span></a></li>
			-->
			<li class="{{ setActive('profile/edit') }}"><a href="{{ url('/profile/edit') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
<div class="content-wrapper" style="min-height: 857px">
	<!-- REQUIRED JS SCRIPTS -->

	<!-- jQuery 2.1.4 -->
	<script src="{{ URL::asset('js/jQuery-2.1.4.min.js') }}"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ URL::asset('js/app.min.js') }}"></script>
	<script src="{{ URL::asset('js/plugins/select2/select2.full.min.js') }}"></script>
	<!-- FLOT CHARTS -->
	<script src="{{ URL::asset('js/plugins/flot/jquery.flot.min.js') }}"></script>
	<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
	<script src="{{ URL::asset('js/plugins/flot/jquery.flot.resize.min.js') }}"></script>
	<script src="{{ URL::asset('js/plugins/flot/jquery.flot.canvas.js') }}"></script>
	<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
	<script src="{{ URL::asset('js/plugins/flot/jquery.flot.categories.min.js') }}"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<script src="{{ URL::asset('js/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="{{ URL::asset('js/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ URL::asset('js/plugins/fastclick/fastclick.min.js') }}"></script>

<!-- Bootstrap 3.3.5 --> 

<!-- AdminLTE App --> 
	<script src="{{ URL::asset('js/jquery-ui-multiselect-widget/jquery.multiselect.css') }}"></script>
<!-- FLOT CHeartS --> 
<script src="{{ URL::asset('plugins/flot/jquery.flot.min.js') }}"></script>

<!-- FLOT RESIZE PLUGIN - allows the cHeart to redraw when the window is resized --> 

<script src="{{ URL::asset('plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ URL::asset('plugins/flot/jquery.flot.canvas.js') }}"></script>

<script src="{{ URL::asset('plugins/flot/jquery.flot.animator.min.js') }}"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar cHearts --> 
<script src="{{ URL::asset('plugins/flot/jquery.flot.categories.min.js') }}"></script>

<script src="{{ URL::asset('plugins/flot/jquery.flot.navigate.js') }}"></script>
	




	<!-- AdminLTE App -->

	<!-- iCheck -->
	<script src="{{ URL::asset('js/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	

	<section class="content">
		@yield('content')



	</section>

	<!-- Main Footer -->
	<footer class="main-footer row">
		<!-- To the right -->
		<div class="footer-right">
			<ul class="inline-list">
				<li><a href="#"><i class="fa fa-1x fa-facebook-square"></i></a></li>
				<li><a href="#"><i class="fa fa-1x fa-twitter-square"></i></a></li>
				<li><a href="#"><i class="fa fa-1x fa-instagram"></i></a></li>
				<li><a href="#"><i class="fa fa-1x fa-pinterest-square"></i></a></li>
			</ul>


			<!-- Default to the right -->
			<p><strong>Copyright &copy; 2016 <a href="#">Biorower</a>.</strong> All rights reserved.</p>
			<ul class="inline-list">
				<li><a href="#">FAQ</a></li>
				<li><a href="#">Contact Support</a></li>
				<li class="margin-right-5"><a href="#">Terms</a></li>
				<li><a href="#">Privacy Policy</a></li>

			</ul>
		</div>
		<div class="clear"></div>
	</footer>
</div>

</div>
</body>
</html>

