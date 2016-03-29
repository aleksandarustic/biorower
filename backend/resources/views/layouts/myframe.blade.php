
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
	    <meta http-equiv="Content-Type" content="text/plain; charset=utf-8" />
	    <title>{{ $title }} | @yield('title')</title>
	    <meta name="keywords" content="" />
	    <meta name="description" content="" />

	    <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

	    <link rel="icon" href="{{ Request::root() }}/favicon.ico" type="image/x-icon">

		{!! HTML::style('css/main.css') !!} 
		{!! HTML::style('css/bootstrap/bootstrap.css') !!}
		{!! HTML::style('js/jquery-ui-1.11.4/jquery-ui.css') !!}

		{!! HTML::script('js/jquery-ui-1.11.4/external/jquery/jquery.js') !!}
		{!! HTML::script('js/bootstrap/bootstrap.min.js') !!}
		{!! HTML::script('js/jquery-ui-1.11.4/jquery-ui.min.js') !!}

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
<body>

		<nav class="navbar navbar-fixed-top navbar-inverse">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">

		      <!-- <a class="navbar-brand" href="#">Brand</a> -->
		      
		       <div id="toggleButtonLayoutLeftWrapper">
		           <a id="toggleButtonLayoutLeft" class="menu-icon-layout" href="#">
					     <span></span>
				   </a>
				   <span class="divider-vertical-left"></span>
			   </div>
			   @if (!Auth::guest())
				   <?php  
				   	   $newMessages = User::where('id', Auth::user()->id)->with('messagesCount')->first()->messagesCount;
					   if (!empty($newMessages))
					   {
					   	 $newMessages = $newMessages->count;
					   }
				   ?>
				   <div id="toggleButtonLayoutRightWrapper">
				   	   <span class="divider-vertical-right"></span>
			           <a id="toggleButtonLayoutRight" class="menu-icon-layout" href="#">
						     <span></span>
					   </a>
				   </div>
				   <div class="newMessagesWrapper">
				   		<a href="{{ url('/message/index') }}">
				   			<span class="badge clsNewMessages" id="newMessages">{{ $newMessages }}</span>
				   		</a>
				   </div>
			   @endif
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav" style="margin-left:40px;">
		      	<!-- <li id="idLogo1"> {!! HTML::image('/images/logo2.png') !!}</li> -->
		      	<li id="idLogo1">{{ config('app.title') }}</li> 
		      	<li id="idLogo2"><span style="font-weight: normal;">SportConn</span><img pagespeed_url_hash="1185330858" src="<?php echo Request::root() ?>/images/beta.png" alt="BETA"></img>
		      	</li>
		      	<!--
		        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
		        <li><a href="#">Link</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		            <li class="divider"></li>
		            <li><a href="#">One more separated link</a></li>
		          </ul>
		        </li>
		        -->
		      </ul>

		      <!--
		      <form class="navbar-form navbar-left" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Submit</button>
		      </form>
		      -->
		      <ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<!--<li><a href="{{ url('/auth/register') }}">Register</a></li> -->
					@endif
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		<aside>
		    <div id="left_wrapper">
		      <div class="content_box">	
			        <ul class="off-canvas-list menuAside menuAsideLeft">
						@if (!Auth::guest())
							<li><a href="{{ url('/'.Auth()->user()->linkname) }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;My profile page</a></li>
							<li><a href="{{ url('/'.Auth()->user()->linkname.'/sessions') }}"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;My sessions</a></li>
							<li><a href="{{ url('/sessions/calendar') }}"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Calendar</a></li>
							<li><a href="{{ url('/race/index') }}"><span class="glyphicon glyphicon-road"></span>&nbsp;&nbsp;My races</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Request a feature</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-new-window"></span>&nbsp;&nbsp;Visit {{ strtolower(config('app.title')) }}sportconn.com</a></li>
						@else
					        <li><a href="{{ url('/auth/login') }}" data-reveal-id="loginModal"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Log in</a></li>
					    @endif
					        <li class="divider"></li>
					        <li><a href="#" class="linkGroupTitle">SUPPORT</a></li>
					        <li><a href="/help">FAQ</a></li>
					        <li><a href="/help/contact-support">Contact Support</a></li>
					        <li id="lastItemInLeftMenu"><a href="{{ url('/home/api-docs') }}">Api</a></li>
			        </ul>
	          </div>
		    </div>
	    </aside>

	    <div id="straftaLayout" class="clsStraftra">
            <div id="straftaTextLayout"><h2 class="h2Title"></h2></div>
            <div id="straftaButtonsLayout"></div>
        </div>	    

		@yield('content')

		@if (!Auth::guest())
			<aside>
			    <div id="right_wrapper">
			      <div class="content_box">	
				        <ul class="off-canvas-list menuAside menuAsideRight">
								@if (isset(Auth::user()->profile->image_id))
									<li><img src="{{ Request::root().'/../storage/profile_images'.Auth::user()->profile->image->name }}" id="profileImageLayout" /></li>
								@endif		
								<li><a href="{{ url('/user/edit') }}"><span class="glyphicon glyphicon-cog"></span>&nbsp;
										{{ Auth::user()->display_name }}
								</a></li>
								<li><a href="{{ url('/auth/logout') }}"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li>
								<li><a href="#" class="linkGroupTitle">&nbsp;&nbsp;SOCIAL</a></li>
								<li><a href="{{ url('/message/index') }}"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;Messages <span class="badge clsNewMessages" id="cloneNewMessages">{{ $newMessages }}</span></a></li>
								<li><a href="{{ url('/user/iam-following') }}"><span class="glyphicon glyphicon-share"></span>&nbsp;&nbsp;I'm Following</a></li>
								<li><a href="{{ url('/user/following-me') }}"><span class="glyphicon glyphicon-share"></span>&nbsp;&nbsp;Following Me</a></li>
								<li id="lastItemInRightMenu"><a href="{{ url('/user/search') }}"><span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;Find Users</a></li>
								<!-- <li ><a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;View Comments</a></li> -->
				        </ul>
		          </div>
			    </div>
		    </aside>
	    @endif

	  <section class="footer">
	  	<!-- <img alt="Biorower Sportconn Logo" src=""> -->
        <p><a href="http://{{ config('app.title') }}sportconn.com" id="idLogoBiorowerFooter">{{ config('app.title') }} SportConn</a></p>

        <p>
        	<strong><a href="http://{{ config('app.title') }}sportconn.com">www.{{ strtolower(config('app.title')) }}sportconn.com</a></strong>
        	<a href="mailto:hub@{{ config('app.title') }}sportconn.com">hub{{'@'.strtolower(config('app.title')) }}sportconn.com</a>
        	<a href="#">Privacy</a> <a href="#">Terms</a>
        </p>
        <p>© {{ config('app.title') }} SportConn Ltd</p>
	  </section>
	
</body>
</html>

