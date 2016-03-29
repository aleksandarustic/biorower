@extends('layouts.myframe')

@section('content')
<div class="container-fluid" id="rightColumn">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
			@include('home.apiMenu')
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">

		</div>		
	</div>
</div>
@endsection
