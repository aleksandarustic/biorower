
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
	    <title>Biorower - My Profile</title>
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
		<link href="{{ URL::asset('js/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="{{ URL::asset('js/plugins/fullcalendar/fullcalendar.print.css') }}" media="print">


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

		<script type="text/javascript">

			    $(function(){

			            $("#left_wrapper, #right_wrapper").on("mouseenter", function(){
			            	$("#rightColumnRow").css("opacity","0.8");
			            	$(".navbar").css("opacity","0.8");
			            });

			            $("#left_wrapper, #right_wrapper").on("mouseleave", function(){
			            	$("#rightColumnRow").css("opacity","1");
			            	$(".navbar").css("opacity","1");
			            });	   

			            $("#toggleButtonLayoutLeftWrapper").click(function(){
			            	if ($("#left_wrapper").is(":visible")){
			            		$("#left_wrapper").hide();
			            	}
			            	else{
			            		$("#left_wrapper").toggle();	
			            	}
			                
			                if ($("#rightColumn").hasClass("inner-wrap")){
			                    $("#rightColumn").removeClass("inner-wrap");
			                    $(window).resize();
			                }
			                else{
				                if ($("#rightColumn").hasClass("inner-wrap-right")){
				                	$("#right_wrapper").hide();
				                    $("#rightColumn").removeClass("inner-wrap-right");
				                }

			                    $("#rightColumn").addClass("inner-wrap");
			                    $(window).resize();
			                }
			            });

			            $("#toggleButtonLayoutRightWrapper").click(function(){
			            	if ($("#right_wrapper").is(":visible")){
			            		$("#right_wrapper").hide();
			            	}
			            	else{
			            		$("#right_wrapper").toggle();	
			            	}

			                if ($("#rightColumn").hasClass("inner-wrap-right")){
			                    $("#rightColumn").removeClass("inner-wrap-right");
			                    $(window).resize();
			                }
			                else{
			                	if ($("#rightColumn").hasClass("inner-wrap")){
			                		$("#left_wrapper").hide();
			                    	$("#rightColumn").removeClass("inner-wrap");
			                    }

			                    $("#rightColumn").addClass("inner-wrap-right");
			                    $(window).resize();
			                }
			            });	

			            $("#rightColumn").click(function(){
			            	$("#left_wrapper").hide();
			            	$("#right_wrapper").hide();
			            	$("#rightColumn").removeClass("inner-wrap");
			            	$("#rightColumn").removeClass("inner-wrap-right");
			            	$(window).resize();
			            });

			            window.fncUpdateMenu = function(){
			            	if ($(".chart").length <= 0){
					            var currentLeft = parseInt($(".footer").position().top) - $('#lastItemInLeftMenu').height();
			            		$('#lastItemInLeftMenu').css("height", currentLeft);

					            var currentRight = parseInt($(".footer").position().top) - $('#lastItemInRightMenu').height();
			            		$('#lastItemInRightMenu').css("height", currentRight);		            		
			            	}
			        	}

			        	window.fncUpdateMenu();

			        	$(".newMessagesWrapper").effect( "bounce", {times:5}, 1000 );
			        	
		                if ($("#straftaButtons a").text() != "") {

		                	$("#straftaLayout").show();
		                	$("#rightColumn").prepend("<br />");
		                	
		                	var textStrafta = $("#straftaText .h2Title").text();
		                	$("#straftaTextLayout .h2Title").text(textStrafta);

		                    $("#straftaButtons a").each(function () {
		                        $(this).detach().appendTo('#straftaButtonsLayout');
		                    });
		                }
		                else {
		                    $("#straftaLayout").hide();
		                }

		            });

		</script>

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
	<a href="index2.html" class="logo">
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
				<li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i> <span class="label label-success">4</span> </a>
					<ul class="dropdown-menu">
						<li class="header">You have 4 messages</li>
						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								<li><!-- start message -->
									<a href="#">
										<div class="pull-left"> <img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> </div>
										<h4> Support Team <small><i class="fa fa-clock-o"></i> 5 mins</small> </h4>
										<p class="h2-subhead">Why not buy a new awesome theme?</p>
									</a> </li>
								<!-- end message -->
								<li> <a href="#">
										<div class="pull-left"> <img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> </div>
										<h4> AdminLTE Design Team <small><i class="fa fa-clock-o"></i> 2 hours</small> </h4>
										<p class="h2-subhead">Why not buy a new awesome theme?</p>
									</a> </li>
								<li> <a href="#">
										<div class="pull-left"> <img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> </div>
										<h4> Developers <small><i class="fa fa-clock-o"></i> Today</small> </h4>
										<p class="h2-subhead">Why not buy a new awesome theme?</p>
									</a> </li>
								<li> <a href="#">
										<div class="pull-left"> <img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> </div>
										<h4> Sales Department <small><i class="fa fa-clock-o"></i> Yesterday</small> </h4>
										<p class="h2-subhead">Why not buy a new awesome theme?</p>
									</a> </li>
								<li> <a href="#">
										<div class="pull-left"> <img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> </div>
										<h4> Reviewers <small><i class="fa fa-clock-o"></i> 2 days</small> </h4>
										<p class="h2-subhead">Why not buy a new awesome theme?</p>
									</a> </li>
							</ul>
						</li>
						<li class="footer"><a href="messages.html">See All Messages</a></li>
					</ul>
				</li>
				<!-- Notifications: style can be found in dropdown.less -->
				<li class="dropdown notifications-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-warning">10</span> </a>
					<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
							<!-- inner menu: contains the actual data -->
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
				<!-- User Account Menu -->
				<li class="dropdown user user-menu">
					<!-- Menu Toggle Button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<!-- The user image in the navbar-->
						<img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
						<!-- hidden-xs hides the username on small devices so only the image appears. -->
						<span class="hidden-xs">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span> </a>
					<ul class="dropdown-menu">
						<!-- The user image in the menu -->
						<li class="user-header"> <img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
							<p class="h2-subhead"> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} <small>Member since Nov. 2012</small> </p>
						</li>
						<!-- Menu Body -->
						<li class="user-body">
							<div class="act-block text-left">
								<a href="/{{Auth::user()->linkname}}" class="act-list"><i class="fa fa-user"></i> Username</a>
							</div>
							<div class="act-block text-left">
								<a href="friends.html" class="act-list"><i class="fa fa-users"></i> Friends</a>
							</div>
							<div class="act-block text-left">
								<a href="messages.html" class="act-list"> <i class="fa fa-envelope"></i> Massages</a>
							</div>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left"> <a href="/{{Auth::user()->linkname}}" class="btn btn-default btn-flat">Profile</a> </div>
							<div class="pull-right"> <a href="{{ url('/profile/logout') }}" class="btn btn-default btn-flat">Sign out</a> </div>
						</li>
					</ul>
				</li>
			</ul>
		</div>


		<!-- search form -->
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
		<!-- /.search form -->

	</nav>
</header>

<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ URL::asset('images/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</p>
				<p>Memeber:
					{{ date('Y-m-d', strtotime(Auth::user()->created_at)) }}</p>
				<!-- Status -->
			</div>
		</div>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">NAVIGATION</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="{{ setActive('profile') }}"><a href="/profile"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
			<li class="{{ setActive('sessions/calendar') }}"><a href="/sessions/calendar"><i class="fa fa-calendar"></i> <span>My Calendar</span></a></li>
			<li class="{{ setActive('profile/sessions') }}"><a href="/profile/sessions"><i class="fa fa-tasks"></i> <span>My Sessions</span></a></li>
			<li class="{{ setActive('training') }}"><a href="/sessions/training"><i class="fa  fa-ship"></i> <span>My Training Session</span></a></li>
			<li class="{{ setActive('edit') }}"><a href="/profile/edit"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
<div class="content-wrapper" style="min-height: 857px">

	<section class="content">
		@yield('content')

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

	</section>
</div>

</div>
</body>
</html>

