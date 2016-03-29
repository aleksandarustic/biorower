
<?php 
	  use App\Language;
	  use App\Country;
	  use App\UserType;
?>

@section('page-script')
	
	<link rel="stylesheet" href="../js/jcrop/css/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" href="../js/jquery-validation-1.13.1/css/screen.css" type="text/css" />
	<script src="../js/jcrop/js/jquery.Jcrop.min.js"></script>
	<script src="../js/jquery-validation-1.13.1/jquery.validate.js"></script>

	<script type="text/javascript">
		$(function(){
			$("#date_of_birth").datepicker();
			$("#date_of_birth").datepicker( "option", "dateFormat", "yy-mm-dd" );

			/*
				$("#changeImage").click(function(){
					alert('aaaaaa');

					return false;
				});
			*/

		    function showCoords(c)
		    {
   		        // variables can be accessed here as
		        // c.x, c.y, c.x2, c.y2, c.w, c.h
		        $("#cx1").val(c.x);
		        $("#cy1").val(c.y);
				$("#cx2").val(c.x2);
				$("#cy2").val(c.y2);

				$cw = parseInt(c.x2) - parseInt(c.x);
				$ch = parseInt(c.y2) - parseInt(c.y);

				$("#cw").val($cw);
				$("#ch").val($ch);
   		    };

   		    //saveProfileImage

			var urlBase = "<?php echo Request::root() ?>";
			var form = $('#uploadForm');
			var jcrop_api = null;

			$("#uploadTempFile input.file").change(function () {
				$("#loadingGif").show();

				var fd = new FormData(document.getElementById("uploadForm"));

				$("#idImageWrapper").hide();

		        $.ajax({
		        	    url : urlBase + '/user/user-upload-temp-image',
		        	    type: "POST",
			            data: fd,
						processData: false,  // tell jQuery not to process the data
						contentType: false   // tell jQuery not to set contentType		            
			        }).done(function (data) {

			        	$("#loadingGif").hide();			        	

			        	if (data != "false"){

				        	if ($("#idImageWrapper").attr("src") != "")
				        	{
				        		JcropAPI = $('#idImageWrapper').data('Jcrop');
				        		JcropAPI.destroy();
								$("#idImageWrapper").remove();
				        		$("<img src='' id='idImageWrapper' width='550' />").appendTo("#idImageWrapperWrapper");
				        	}
				        	
				        	$("#idImageWrapper").attr("src", "../../storage/temp_profile_images/" + data.filename);

				        	$("#tempImage").val(data.filename);

				        	$('#idImageWrapper').Jcrop({
					            setSelect:   [ 10, 10, 50, 50 ],
					            aspectRatio: 1,
					            onChange: showCoords,
					            trueSize: [data.width,data.height]
							});
						}
						else{
							alert("Error! Wrong file extension.");
						}

			        }).fail(function () {
		        });
			});

			$("#saveProfileImage").click(function () {

				var formSend = $("#sendForm");

		        $.ajax({
		        	    url : urlBase + '/user/user-change-profile-image',
		        	    type: "POST",
			            data: formSend.serialize(),
						//processData: false,  // tell jQuery not to process the data
						//contentType: false   // tell jQuery not to set contentType
			        }).done(function (data) {
						
						//$("#profileImageLayout").attr("src", "../images/testSlika.png");
						$("#myModal").modal('hide');

			        }).fail(function () {
		        });				

			});
		
			/*
		    $('#uploadForm').on('submit', function(e) {
		        e.preventDefault();
		    });
			*/
			
			$("#mainFormEdit").validate();

			//itd...

			$(document).on("click", "#idSaveEditProfile", function(){
				$("#idSubmitEditProfile").click();
			})

		})
	</script>

	<script src="../js/validations_edit_view.js"></script>

@endsection

@extends('layouts.myframe')

@section('content')
<div class="container-fluid" id="rightColumn">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div id="strafta">
				<div id="straftaText"><h2 class="h2Title">Edit your profile</h2></div>
			    <div id="straftaButtons"><a href="#" class="btn btn-default btn-small" style="float:right" id="idSaveEditProfile">Save</a></div>
			</div>

			<!-- <h1>Edit your profile</h1> -->

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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

			{!! Form::open(array('url' => '/user/edit', 'method' => 'POST', 'id'=>'mainFormEdit')) !!}
			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="">
						<fieldset>
							<legend>User details</legend>

								<div class="form-group">
										{!! Form::label('display_name', 'Display name', array('class' => '')) !!}
										<br />
										{!! Form::text('display_name', $user->display_name, array('id' => 'id_displayname')) !!}
								</div>

								<div class="form-group">
										{!! Form::label('first_name', 'First name', array('class' => '')) !!}
										<br />
										{!! Form::text('first_name', $user->first_name, array('id' => 'id_firstname')) !!}
								</div>
								<div class="form-group">
										{!! Form::label('last_name', 'Last name', array('class' => '')) !!}
										<br />
										{!! Form::text('last_name', $user->last_name, array('id' => 'id_lastname')) !!}
								</div>
								<div class="form-group">
										{!! Form::label('about_me', 'About me', array('class' => '')) !!}
										<br />
										{!! Form::textarea('profile[about_me]', $user->profile->about_me, array('id' => 'id_aboutme')) !!}
								</div>								
								<div class="form-group">
										{!! Form::label('dic_languages_id', 'Language', array('class' => '')) !!}
										<br />
										{!! Form::select('profile[dic_languages_id]',  Language::where('dic_id', '1')->lists('name','id'), $user->profile->dic_languages_id, array('id' => 'id_profile')) !!}
								</div>
								<div class="form-group">
										{!! Form::label('date_of_birth', 'Date of birth', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[date_of_birth]', $user->profile->date_of_birth, array('id' => 'date_of_birth')) !!}
								</div>
								<div class="form-group">
										{!! Form::label('gender', 'Gender', array('class' => '')) !!}
										<br />
										{!! Form::select('profile[gender]', array('3' => 'Not Telling', '0' => 'Male', '1' => 'Female'), $user->profile->gender, array('id' => 'id_gender')) !!}
								</div>								
								<div class="form-group">
										{!! Form::label('phone', 'Phone', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[phone]', $user->profile->phone, array('id' => 'id_phone')) !!}
								</div>								
								<div class="form-group">
										{!! Form::label('mobile', 'Mobile', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[mobile]', $user->profile->mobile, array('id' => 'id_mobile')) !!}
								</div>							
								<div class="form-group">
										{!! Form::label('line1', 'Line1', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[line1]', $user->profile->line1, array('id' => 'id_line1')) !!}
								</div>								
								<div class="form-group">
										{!! Form::label('line2', 'Line2', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[line2]', $user->profile->line2, array('id' => 'id_line2')) !!}
								</div>																
								<div class="form-group">
										{!! Form::label('city', 'City', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[city]', $user->profile->city, array('id' => 'id_city')) !!}
								</div>												
								<div class="form-group">
										{!! Form::label('zip', 'Zip', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[zip]', $user->profile->zip, array('id' => 'id_zip')) !!}
								</div>
								<div class="form-group">
										{!! Form::label('website', 'Website', array('class' => '')) !!}
										<br />
										{!! Form::text('profile[website]', $user->profile->website, array('id' => 'id_website')) !!}
								</div>
								<div class="form-group">
										{!! Form::label('dic_country_id', 'Country', array('class' => '')) !!}
										<br />
										{!! Form::select('profile[dic_country_id]', array('0' => '- Please select -') + Country::where('dic_id', '1')->orderBy('name')->lists('name','id'), $user->profile->dic_country_id) !!}
								</div>

						</fieldset>						

					<div class="">
						<fieldset>
							<legend>User type</legend>
							<div class="form-group">
								<?php $formUserType = UserType::all(); ?>

								@foreach($formUserType as $valUT)
									<?php $varSetRadio = false ?>

									@if ($user->profile->dic_user_type_id === $valUT->id)
										<?php $varSetRadio = true ?>
									@endif

									{!! Form::radio('profile[dic_user_type_id]', $valUT->id, $varSetRadio) !!} {{ $valUT->name }}
									<br />
								@endforeach
							</div>
						</fieldset>
					</div>


				  </div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

					<div class="">
						<fieldset>
							<legend>E-mail</legend>
								<div class="form-group">
									{!! Form::label('email', 'E-mail', array('class' => '')) !!}
									<br />
									{!! Form::text('email', $user->email, array('class' => 'email required', 'id' => 'id_email')) !!}
								</div>															
						</fieldset>
					</div>		

					<div class="">
						<fieldset>
							<legend>Profile image</legend>
								@if (isset(Auth::user()->profile->image_id))
									<div><img src="{{ '../../storage/profile_images'.Auth::user()->profile->image->name }}" /></div>
									<br />
								@endif

								<div class="form-group">
									<div class="form-group">
											<a href="#" id="changeImage" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Change image</a>
									</div>							
								</div>
						</fieldset>
					</div>		

					<div class="">
						<fieldset>					
							<legend>Notifications</legend>
								<label>Notify Me on Comment</label>
								<p class="instructions">Email me when someone comments on one of my sessions</p>
								<div class="form-group">
										{!! Form::select('profile[notify_me_on_comment]',  array('3' => '-------', '1' => 'Yes', '0' => 'No'), $user->profile->notify_me_on_comment, array()) !!}
								</div>

								<hr />

								<label>Notify Me on New Session</label>
								<p class="instructions">Email me when someone I'm watching adds a session</p>
								<div class="form-group">
										{!! Form::select('profile[notify_me_on_new_session]',  array('3' => '-------', '1' => 'Yes', '0' => 'No'), $user->profile->notify_me_on_new_session, array()) !!}
								</div>

								<hr />

								<label>Notify Me on New Watcher</label>
								<p class="instructions">Email me if someone new starts watching me</p>
								<div class="form-group">
										{!! Form::select('profile[notify_me_on_new_watcher]',  array('3' => '-------', '1' => 'Yes', '0' => 'No'), $user->profile->notify_me_on_new_watcher, array()) !!}
								</div>

								<hr />

								<label>Send Session Summary </label>
								<p class="instructions">Email me a summary when I upload a session</p>
								<div class="form-group">
										{!! Form::select('profile[send_session_summary]',  array('3' => '-------', '1' => 'Yes', '0' => 'No'), $user->profile->send_session_summary, array()) !!}
								</div>

								<hr />

								<label>Session Summary Alternative </label>
								<p class="instructions">Alternate email address for session summary emails only. i.e. Coach</p>
								<div class="form-group">
										{!! Form::text('profile[email_summary_alternative]', $user->profile->email_summary_alternative, array('class' => 'email', 'id' => 'id_email_alternative')) !!}
								</div>

								<hr />

								<label>Send Session Summary Alternate </label>
								<p class="instructions">Email a summary of my sessions to the alternate email address i.e. Coach</p>
								<div class="form-group">
										{!! Form::select('profile[send_session_summary_alternate]',  array('3' => '-------', '1' => 'Yes', '0' => 'No'), $user->profile->send_session_summary_alternate, array()) !!}
								</div>								
						</fieldset>
					</div>

					<div class="">
						<fieldset>					
							<legend>Account Privacy</legend>
								<label>Private Account</label>
								<p class="instructions">If selected your account will not be publicly viewable.</p>
								<div class="form-group">
										{!! Form::select('profile[privacy]',  array('3' => '-------', '1' => 'Yes', '0' => 'No'), $user->profile->privacy, array()) !!}
								</div>
							</fieldset>
					</div>

					<div class="">
						<fieldset>					
							<legend>Change password</legend>
								<p>Leave blank to keep your current password</p>
								<div class="form-group">
									<div class="form-group">
											{!! Form::label('password', '', array('class' => 'password')) !!}
											<br />
											{!! Form::password('password', '', array('id' => 'password')) !!}
									</div>							
									<div class="form-group">
											{!! Form::label('Confirm password', '', array('class' => 'password')) !!}
											<br />
											{!! Form::password('password_confirm', '') !!}
									</div>															
								</div>
						</fieldset>
					</div>
		
				</div>				
			</div>

			<br />			

			{!!  Form::submit('Save profile', array('class'=>'btn btn-primary btn-lg', 'id' => 'idSubmitEditProfile')) !!}

			<br />
			<br />


			{!! Form::close() !!}
		</div>
	</div>					
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">

		<form id="uploadForm" method="post" enctype="multipart/form-data" name="uploadForm">
	      	<div id="uploadTempFile">
	        	<input type="file" class="file" name="file" />
	        </div>
	    </form>

	    <div style="width:100%;">
	        <div id="loadingGif" style="margin:0 auto; display:none; width:120px;">
	            Loading...
	            {!! HTML::image('images/ajax-loader.gif', 'loading') !!}
	        </div>
        </div>

	    <div id="idImageWrapperWrapper">
	    	<img src="" id="idImageWrapper" width="550" />
	    </div>

	    <!--
        	<img src="../images/testSlika.png" id="targetCroping" />
        -->
		<form id="sendForm" method="post" name="sendForm">
	        <input type="hidden" id="cx1" name="cx1">
	        <input type="hidden" id="cy1" name="cy1">
	        <input type="hidden" id="cx2" name="cx2">
	        <input type="hidden" id="cy2" name="cy2">
	        <input type="hidden" id="cw" name="cw">
	        <input type="hidden" id="ch" name="ch">
	        <input type="hidden" id="tempImage" name="tempImage">
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveProfileImage">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

@endsection
