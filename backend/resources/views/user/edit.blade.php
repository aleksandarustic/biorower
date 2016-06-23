@extends('layouts.main')

@section('content')
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

<section class="content">
	<div class="row" style="margin-bottom: 350px"><!-- /.col -->
		<h1 class="h1-settings">Change</h1>
		<div class="col-md-3 pull-left">
			<div class=" box box-primary">
				<ul class="edit-tab white-bg" id="accordion">
					<div class="panel">
						<li class="title-section"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Edit Profile</a></li>
						<ul id="collapseOne" class="panel-collapse collapse in sub-ul">
							<li class="active"><a href="#profile-image" class="btn-block" data-toggle="tab">Profile image</a></li>
							<li><a href="#user-details" class="btn-block" data-toggle="tab">Users Details</a></li>
							<li><a href="#user-type" class="btn-block" data-toggle="tab">User type</a></li>
							<li><a href="#e-mail" class="btn-block" data-toggle="tab">E-mail</a></li>
							<li><a href="#notifi" class="btn-block" data-toggle="tab">Notifications</a></li>
							<li><a href="#account-priv" class="btn-block" data-toggle="tab">Account Privicy</a></li>
							<li><a href="#change-pass" class="btn-block" data-toggle="tab">Change Password</a></li>
						</ul>
					</div>
					<div class="panel">
						<li class="title-section"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">My Profile</a></li>
						<ul id="collapseTwo" class="panel-collapse collapse sub-ul">
							<li><a href="#total-parm" class="btn-block" data-toggle="tab">Total Parmetars</a></li>
							<li><a href="#edit-history" class="btn-block" data-toggle="tab">Edit History</a></li>
							<li><a href="#progress" class="btn-block" data-toggle="tab">Progress</a></li>
						</ul>
					</div>
				</ul>
			</div>
		</div>
		<div class="nav-tabs-custom col-md-7 no-padding padding-bottom pull-left edit-tabs">
			<div class="box box-primary padding-all">
				<form method="POST" action="http://beegrower.bugs3.com/public/user/edit" accept-charset="UTF-8" id="mainFormEdit">
					<input name="_token" type="hidden" value="LSoFI4hQLii3O5perBoyDdGQZReepW9mUEm4eI7r">
					<div class="tab-content tab-cont">
						<div class="active tab-pane edit-box margin-top" id="profile-image">
							<h2 class="h2-tabs">Change your profile image</h2>
							<p class="h2-subhead">Update your avatar</p>
							<div class="upload-photo-cont" >
								<span class="user-header"><img src="{{ URL::asset('dist/img') .'/'.$user->profile->image->name }}" alt="User Image"></span>
								<div class="upload-photo">
									<a href="#" class="mailedit-box-attachment-name" data-toggle="modal" data-target="#myModal">
										<i class="fa fa-camera"></i> <span class="upload-txt">Upload a photo</span></a>
								</div>
								<div class="example-modal">
									<div class="modal" id="myModal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Upload a image</h4>
												</div>
												<div class="modal-body">
													<div class=" modal-choose">
														<input type="file" class="col-md-12">
														<span class="choose-image"><i class="fa fa-plus"></i> Upload Image</span>
													</div>
												</div>
												<div class="modal-footer model-mdown">
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
								</div><!-- /.example-modal -->
							</div>
						</div>
						<!-- /.tab-pane -->
						<div class="tab-pane edit-box margin-top" id="user-details"> <h2 class="h2-tabs">User Details</h2>
							<p class="h2-subhead">Update your personal info</p>
							<div class="form-group">
								<label for="display_name" class="">Display name</label>
								<br />
								<input class="form-control input-sm" id="id_displayname" name="display_name" type="text" value="{{ $user->display_name }}">
							</div>
							<div class="form-group">
								<label for="first_name" class="">First name</label>
								<br />
								<input class="form-control input-sm" id="id_firstname" name="first_name" type="text" value="{{ $user->first_name }}">
							</div>
							<div class="form-group">
								<label for="last_name" class="">Last name</label>
								<br />
								<input class="form-control input-sm" id="id_lastname" name="last_name" type="text" value="{{ $user->last_name }}">
							</div>
							<div class="form-group">
								<label for="about_me" class="">About me</label>
								<br />
								<textarea class="form-control input-sm" id="id_aboutme" name="profile[about_me]" cols="50" rows="10">{{ $user->about_me }}</textarea>
							</div>
							<div class="form-group">
								<label for="dic_languages_id" class="">Language</label>
								<br />
								<select class="form-control select2" style="width: 100%;" id="id_profile" name="profile[dic_languages_id]">
									<option value="1" selected="selected">English</option>
									<option value="2">Serbian</option>
								</select>
							</div>
							<div class="form-group">
								<label for="date_of_birth" class="">Date of birth</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control" id="date_of_birth" name="profile[date_of_birth]" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $user->date_of_birth }}">
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="">Gender</label>
								<br />
								<select class="form-control select2" style="width: 100%;" id="id_gender" name="profile[gender]">
									<option value="3">Not Telling</option>
									<option value="0">Male</option>
									<option value="1" selected="selected">Female</option>
								</select>
							</div>
							<div class="form-group">
								<label for="phone" class="">Phone</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<input type="text" id="id_phone" name="profile[phone]" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $user->profile->phone }}">
								</div>
							</div>
							<div class="form-group">
								<label for="mobile" class="">Mobile</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<input type="text" id="id_mobile" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $user->profile->mobile }}">
								</div>
							</div>
							<div class="form-group">
								<label for="line1" class="">Line1</label>
								<br />
								<input class="form-control input-sm" id="id_line1" name="profile[line1]" type="text" value="">
							</div>
							<div class="form-group">
								<label for="line2" class="">Line2</label>
								<br />
								<input class="form-control input-sm" id="id_line2" name="profile[line2]" type="text" value="">
							</div>
							<div class="form-group">
								<label for="city" class="">City</label>
								<br />
								<input class="form-control input-sm" id="id_city" name="profile[city]" type="text" value="{{ $user->profile->city }}">
							</div>
							<div class="form-group">
								<label for="zip" class="">Zip</label>
								<br />
								<input class="form-control input-sm" id="id_zip" name="profile[zip]" type="text" value="{{ $user->profile->zip }}">
							</div>
							<div class="form-group">
								<label for="website" class="">Website</label>
								<br />
								<input class="form-control input-sm" id="id_website" name="profile[website]" type="text" value="">
							</div>
							<div class="form-group">
								<label for="dic_country_id" class="">Country</label>
								<br />
								<select class="form-control select2" style="width: 100%;" name="profile[dic_country_id]">
									@foreach($countries as $country)
									<option value="{{ $country->id }}">{{ $country->name }}</option>
									@endforeach
								</select>
							</div>
						</div><!-- /.tab-pane -->

						<div class="tab-pane edit-box margin-top" id="user-type"> <h2 class="h2-tabs">User Type</h2>
							<p class="h2-subhead">Type of person</p>
							<div class="form-group">
								<input class="minimal" checked="checked" name="profile[dic_user_type_id]" type="radio" value="1">
								Home User <br />
								<input class="minimal" name="profile[dic_user_type_id]" type="radio" value="2">
								Gym/Club User <br />
								<input class="minimal" name="profile[dic_user_type_id]" type="radio" value="3">
								Work User <br />
								<input class="minimal" name="profile[dic_user_type_id]" type="radio" value="4">
								Armed Forces/Uniformed Services User <br />
							</div>
						</div> <!-- /.tab-pane -->

						<div class="tab-pane edit-box margin-top" id="e-mail"> <h2 class="h2-tabs">E-mail</h2>
							<p class="h2-subhead">Update email data</p>
							<div class="form-group">
								<label for="email" class="">E-mail</label>
								<input class="form-control input-sm email required" id="id_email" name="email" type="text" value="{{ $user->email }}">
							</div>
						</div> <!-- /.tab-pane -->
						<div class="tab-pane edit-box margin-top" id="notifi"> <h2 class="h2-tabs">Notifications</h2>
							<p class="h2-subhead">Update your notifications</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="profile[notify_me_on_comment]">
									<option value="3">-------</option>
									<option value="1" selected="selected">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
							<hr />
							<label>Notify Me on New Session</label>
							<p class="instructions">Email me when someone I'm watching adds a session</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="profile[notify_me_on_new_session]">
									<option value="3">-------</option>
									<option value="1" selected="selected">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
							<hr />
							<label>Notify Me on New Watcher</label>
							<p class="instructions">Email me if someone new starts watching me</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="profile[notify_me_on_new_watcher]">
									<option value="3">-------</option>
									<option value="1" selected="selected">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
							<hr />
							<label>Send Session Summary </label>
							<p class="instructions">Email me a summary when I upload a session</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="profile[send_session_summary]">
									<option value="3" selected="selected">-------</option>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
							<hr />
							<label>Session Summary Alternative </label>
							<p class="instructions">Alternate email address for session summary emails only. i.e. Coach</p>
							<div class="form-group">
								<input class="form-control input-sm email" id="id_email_alternative" name="profile[email_summary_alternative]" type="text" value="">
							</div>
							<hr />
							<label>Send Session Summary Alternate </label>
							<p class="instructions">Email a summary of my sessions to the alternate email address i.e. Coach</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="profile[send_session_summary_alternate]">
									<option value="3" selected="selected">-------</option>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane edit-box margin-top" id="account-priv"> <h2 class="h2-tabs">Account Privicy</h2>
							<p class="h2-subhead">Update your account privicy</p>
							<p class="instructions">If selected your account will not be publicly viewable.</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="profile[privacy]">
									<option value="3" selected="selected">-------</option>
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane edit-box margin-top" id="change-pass"> <h2 class="h2-tabs">Change Password</h2>
							<p class="h2-subhead">Leave blank to keep your current password</p>
							<div class="form-group">
								<div class="form-group">
									<label for="password" class="password">Password</label>
									<br />
									<input class="form-control input-sm" name="password" type="password" value="" id="password">
								</div>
								<div class="form-group">
									<label for="Confirm password" class="password">Confirm Password</label>
									<br />
									<input class="form-control input-sm" name="password_confirm" type="password" value="">
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->

						<!-- tab-pane -->
						<div class="tab-pane edit-box margin-top" id="total-parm">
							<h2 class="h2-tabs">Total Parmetars</h2>
							<p class="h2-subhead">Chose parametars you want to see</p>

						</div>
						<!-- /.tab-content -->
						<!--tab-pane -->
						<div class="tab-pane edit-box margin-top" id="edit-history">
							<h2 class="h2-tabs">Edit History</h2>
						</div>
						<!-- /.tab-content -->
						<!-- tab-pane -->
						<div class="tab-pane edit-box margin-top" id="progress">
							<h2 class="h2-tabs">Progress</h2>
						</div>
						<!-- /.tab-content -->


						<div class="pull-left">
							<input class="btn btn-primary btn-primary" id="idSubmitEditProfile" type="submit" value="Save profile">
							<input class="btn btn-primary btn-primary" id="idSubmitEditProfile" type="reset" value="Reset">
						</div>
				</form>
			</div>
		</div>
		<!-- /.tab-content -->
		<div class="clear"></div>
	</div>
	</div>
	<!-- /.row -->

<!-- MODAL -->
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
</section>
@endsection
