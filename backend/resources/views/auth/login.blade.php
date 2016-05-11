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
	<div class="tab-content">
		<div class="login-box active tab-pane" id="login">
			<div class="login-box-body">
				<div class="login-logo">
					<a href="profile.html"><img src="{{ URL::asset('images/login/Logo.png') }}" alt="Biorower"/></a>
				</div><!-- /.login-logo -->
				<form action="{{ url('/login') }}" method="post" id="login-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group has-feedback">
						<input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" name="password" placeholder="Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="checkbox icheck">
								<label>
									<input type="checkbox"> Remember Me
								</label>
								<a href="#forgot-pass" data-toggle="tab" class="inline float-right forgot-password">I forgot my password</a>
							</div>
						</div><!-- /.col -->
						<div class="btn btn-block">
							<button type="submit" class="btn btn-primary btn-block btn-flat  margin-top">Sign In</button>
						</div><!-- /.col -->
					</div>
				</form>
				<div class="social-auth-links text-center margin-top">
					<p>- or sign in via social network -</p>
					<a href="{{ url('/auth/login-facebook') }}" class="btn btn-social btn-facebook btn-flat ghost-btn inline col-xs-5"><i class="fa fa-facebook"></i> Facebook login</a>
					<a href="#" class="btn btn-social btn-google btn-flat ghost-btn inline col-xs-5 margin-left"><i class="fa fa-google-plus"></i> Google+ login</a>
				</div>
				<!-- /.social-auth-links -->

				<div class="clear"></div>
				<p class="text-center margin-top">Don't have an account yet? <a href="#register" class="link-underline" data-toggle="tab">Sign up now</a></p>


			</div><!-- /.login-box-body -->
		</div><!-- /.login-box -->

		<div class="register-box tab-pane" id="register">
			<div class="register-box-body">
				<div class="register-logo">
					<a href="/profile"><img src="{{ URL::asset('images/login/Logo.png') }}" alt="Biorower"/></a>
				</div>
				<div>
					@if (count($errors) > 0) 
					<div class="alert alert-danger"> 
						<strong>Whoops!</strong> There were some problems with your input.<br><br> 
						<ul> 
							@foreach ($errors->all() as $error) 
							<li>{{ $error }}</li> 
							@endforeach 
						</ul> 
					</div> 
					@endif
				</div>
				<div>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (Session::has('flash_message'))
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								{{ Session::get('flash_message') }}
							</ul>
						</div>
					@endif
				</div>
				<form action="{{ url('/register') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group has-feedback">
						<input type="text" name="full_name" placeholder="Full name">
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
									<input type="checkbox"> I agree to the <a href="#">terms</a>
								</label>
							</div>
						</div><!-- /.col -->
						<div class="col-xs-6">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
						</div><!-- /.col -->
					</div>
				</form>

				<div class="social-auth-links text-center">
					<p>- or sign in via social network -</p>

					<a href="#" class="btn btn-social btn-facebook btn-flat ghost-btn inline col-xs-5"><i class="fa fa-facebook"></i> Facebook login</a>
					<a href="#" class="btn btn-social btn-google btn-flat ghost-btn inline col-xs-5 margin-left"><i class="fa fa-google-plus"></i> Google+ login</a>

				</div><!-- /.social-auth-links -->

				<div class="clear"></div>

				<p class="text-center margin-top">I already have a membership. <a href="#login" class="link-underline" data-toggle="tab">Login</a></p>
			</div><!-- /.form-box -->
		</div>

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
<script>
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
