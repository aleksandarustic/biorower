
<?php 
	use Hashids\Hashids;
	use App\Library\GlobalFunctions;
?>

@extends('layouts.myframe')

@section('head-script')
	<link rel="stylesheet" href="../js/jquery-validation-1.13.1/css/screen.css" type="text/css" />
	<script src="../js/jquery-validation-1.13.1/jquery.validate.js"></script>
@endsection


<?php 
	$hashidsUser = new Hashids(GlobalFunctions::getEncKeyUserId());
	$encodedIDUser = $hashidsUser->encode(Auth::user()->id);
?>

@section('page-script')
	<script type="text/javascript">
		$(function(){
			var urlBase = "<?php echo Request::root() ?>";
			$("#mainFormEdit").validate();

			$(document).on("click", ".clsAcceptRace", function(){
				var idRace = $(this).attr("id").split("-")[1];
				window.location = urlBase + '/race/acceptrequest?id1={{ $encodedIDUser }}&id2='+idRace+"&page=index";
			});

			$(document).on("click", ".clsCancelRace", function(){
				var idRace = $(this).attr("id").split("-")[1];
				window.location = urlBase + '/race/cancelrequest?id1={{ $encodedIDUser }}&id2='+idRace+"&page=index";
			});

			$('#tabsRaces a').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			});
			
		})
	</script>
@endsection

@section('title', 'Races')
@endsection

@section('content')
		<section>
			<div id="rightColumn" class="container-fluid">
			  <div class="row" id="rightColumnRow">

			  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

								  <ul class="nav nav-tabs" role="tablist" id="tabsRaces">
								    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Requests</a></li>
								    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Next races</a></li>
								  </ul>

								  <!-- Tab panes -->
								  <div class="tab-content">
								    <div role="tabpanel" class="tab-pane active" id="home">
										<h2 style="float:left">New requests for races: </h2>
							            <div style="float:right; position:relative">
								            <span id="racesArchiveWrapper" style="position:absolute; top:10px; right:0px;">
								            	<a href="{{ Request::root() }}/race/archive" class="btn btn-default"> Archive</a>
								            </span>     
							            </div>
							            <div style="clear:both"></div>
								  		<div id="">
								  			{!! $partialTableRequest !!}
								  		</div>							            
								    </div>
								    <div role="tabpanel" class="tab-pane" id="profile">
										<h2>Next races: </h2>
								  		<div id="">
								  			{!! $partialTableAccepted !!}
								  		</div>								    	
								    </div>
								  </div>

				  			</div>
				  		</div>

				  		<!--
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


				  			</div>
				  		</div>				  		
				  		-->

						{!! Form::open(array('url' => '/race/add', 'method' => 'POST', 'id'=>'mainFormEdit')) !!}
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="">
									<fieldset>
										<legend>Create race</legend>
										<div class="form-group" style="float:left">
											{!! Form::label('name', 'Name', array('class' => '')) !!}
											<br />
											{!! Form::text('name', '', array('id' => 'id_name', 'class' => 'required')) !!}
										</div>
										{!! Form::submit('Add', array('class'=>'btn btn-primary', 'style' => 'float:left; margin-top: 28px; margin-left: 7px;')) !!}
									</fieldset>
								</div>
							</div>
						</div>
						{!! Form::close() !!}

						<br />
			  	</div>
			  </div>
			</div>
		</section>
@endsection

