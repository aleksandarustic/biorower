@extends('app')

@section('head-script')

	<link rel="stylesheet" href="{{ Request::root() }}/js/jquery-validation-1.13.1/css/screen.css" type="text/css" />
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

	<script type="text/javascript">
		$(function(){
			$("#formResetPassword").validate();
		})
	</script>

	<script src="{{ Request::root() }}/js/validations_reset_password_view.js"></script>

@endsection


@section('content')
<div class="container-fluid" id="rightColumn">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}" id="formResetPassword">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						@if (isset($ind_and))
							<input type="hidden" name="ind_and" value="{{ $ind_and }}">
							<input type="hidden" name="email_and" value="{{ $email }}">
							<input type="hidden" name="exp" value="{{ $exp }}">
						@endif

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" id="emailPasswordReset">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" id="passwordPasswordReset">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
