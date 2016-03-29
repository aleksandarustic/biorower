@extends('layouts.full')

@section('content')
<div class="container-fluid brain-background" id="fullColumn">
	<div class="row" style="height:100%">
		<div class="col-md-12 col-lg-12" style="height:100%">
			<div class="row" id="ctnLogin" style="height:100%">
				<div class="col-lg-6 col-lg-offset-3" style="height:100%">

					<div id="fullContainer">
						<div id="fullContent">

								<div class="transbox">
									<h1 class="fullText">
									Welcome to {{ config('app.title') }} SportConn, the cloud based home for your {{ config('app.title') }} SportConn data. Whether you train at home, at the gym, or at work, {{ config('app.title') }} SportConn means you can store, analyse and share your sessions with ease.
									</h1>
								</div>

								<div class="row">
									<div class="col-lg-8 col-lg-offset-2">

										<div class="panel panel-default">
											<div class="panel-heading">Login</div>
											<div class="panel-body">
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

												<form class="form-horizontal classFormFull" role="form" method="POST" action="{{ url('/auth/login') }}">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">

													<div class="form-group">
														<label class="col-md-4 control-label">E-Mail Address</label>
														<div class="col-md-6">
															<input type="email" class="form-control" name="email" value="{{ old('email') }}">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-4 control-label">Password</label>
														<div class="col-md-6">
															<input type="password" class="form-control" name="password">
														</div>
													</div>

													<div class="form-group">
														<div class="col-md-6 col-md-offset-4">
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="remember"> Remember Me
																</label>
															</div>
														</div>
													</div>

													<div class="form-group">
														<div class="col-md-6 col-md-offset-4">
															<button type="submit" class="btn btn-primary">Login</button>

															<a class="" style="display:inline-block" href="{{ url('/password/email') }}">Forgot Your Password?</a>
														</div>
													</div>
												</form>		

											</div>
										</div>

										<div class="form-group loginSocializeContainer">
												<div class="loginSocialize">
													<a class="btn btn-lg btn-custom-facebook fbLogin" href="{{ url('/auth/login-facebook') }}"><i class="fa fa-facebook"></i>Log In With Facebook</a>
													<a class="btn btn-lg btn-custom-twitter twLogin" href="{{ url('/auth/login-twitter') }}"><i class="tw tw-twitter"></i>Log In With Twitter</a>
													<br />
													<a class="btn btn-lg btn-danger" id="idRegisterBtn" href="{{ url('/auth/register') }}">Register</a>
												</div>
										</div>
									</div>
								</div>

						</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
