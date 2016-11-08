@extends('layouts.full')

@section('content')
		<!-- Full Page Image Background Carousel Header -->
<div id="myCarousel" class="carousel container slide carousel-fade">
	<div class="carousel-inner">
		<div class="active item one"></div>
		<div class="item two"></div>
		<div class="item three"></div>
		<div class="item four"></div>
		<div class="item five"></div>
		<div class="item six"></div>
		<div class="item seven"></div>
	</div>
	<div class="dark-bg"></div>
</div>
<div class="login">
	<div>
		@if (session('status'))
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					<li>{{ session('status') }}</li>	
				</ul>
			</div>
		@endif
	</div>
	<div>
		@if ($errors->first('password') or $errors->first('email') or $errors->first('terms'))
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					<?php echo $errors->first('email', '<li>:message</li>'); ?>
					<?php echo $errors->first('password', '<li>:message</li>'); ?>
					<?php echo $errors->first('terms', '<li>:message</li>'); ?>		
				</ul>
			</div>
		@endif
	</div>
	<div class="tab-content">
		<div class="login-box active tab-pane" id="login">
			<div class="login-box-body">
				<div class="login-logo">
					<a href="{{ url('/') }}"><img src="{{ URL::asset('images/login/Logo.png') }}" alt="Biorower"/></a>
				</div><!-- /.login-logo -->
				<form action="{{ url('/register') }}" method="post">
					<input type="hidden" name="timezone" id="timezone" value="">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group has-feedback">
						<input type="text" name="first_name" placeholder="First name" value="{{ old('first_name') }}">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="text" name="last_name" placeholder="Last name" value="{{ old('last_name') }}">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="password" placeholder="Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="password_confirmation" placeholder="Retype password">
						<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="checkbox icheck">
								<label>
									<input type="checkbox" name="terms"> I agree to the <a href="#" class="link-underline">terms</a>
								</label>
							</div>
						</div><!-- /.col -->
						<div class="col-xs-6">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
						</div><!-- /.col -->
					</div>
				</form>
				<div class="social-auth-links text-center margin-top">
					<p>- or sign in via social network -</p>
					<a href="{{ url('/auth/login-facebook') }}" class="btn btn-social btn-facebook btn-flat ghost-btn inline col-xs-5"><i class="fa fa-facebook"></i> Facebook login</a>
					<a href="#" class="btn btn-social btn-twitter btn-flat ghost-btn inline col-xs-5 margin-left"><i class="fa fa-twitter"></i> Twitter login</a>
				</div>
				<!-- /.social-auth-links -->

				<div class="clear"></div>
				<p class="text-center margin-top">Already have an account? <a href="{{ URL::to('login') }}" class="link-underline">Login</a></p>


			</div><!-- /.login-box-body -->
		</div><!-- /.login-box -->


		<div class="login-box tab-pane" id="forgot-pass">
			<div class="login-box-body">
				<div class="login-logo">
					<a href="profile.html"><img src="images/login/Logo.png" alt="Biorower"/></a>
				</div><!-- /.login-logo -->
				<p>Enter the email address associated with your account.</p>
				<form action="" method="post">
					<div class="form-group has-feedback">
						<input type="email" name="email" placeholder="Email">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="btn btn-block margin-left-neg">
						<button type="submit" class="btn btn-primary col-xs-10 inline">Reset password</button>
						<button type="reset" class="btn btn-default ghost-btn col-sm-pull-12 inline margin-left">Cancel</button>
					</div><!-- /.col -->
				</form>

				<div class="clear"></div>

				<p class="inline float-right margin-top">Back to <a href="#login" data-toggle="tab" class="inline link-underline">Login Page</a></p>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
</div><!-- /.tab-content -->
</div>
<!-- jQuery 2.1.4 -->
<script src="js/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="js/icheck/icheck.min.js"></script>
<script src="{{ URL::asset('dist/js/jstz.min.js') }}"></script>
<script>
	var tz = jstz.determine();
	$('#timezone').val(tz.name());
	
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
</script>
<script>
	$('.carousel').carousel({
		interval: 6000,
		pause: "false"
	});
</script>
@endsection
