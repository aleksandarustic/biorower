
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
					<!-- My Profile deo privremeno ugasen jer nema funkciju
					<div class="panel">
						<li class="title-section"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">My Profile</a<>/li>
						<ul id="collapseTwo" class="panel-collapse collapse sub-ul">
							<li><a href="#total-parm" class="btn-block" data-toggle="tab">Total Parmetars</a></li>
							<li><a href="#edit-history" class="btn-block" data-toggle="tab">Edit History</a></li>
							<li><a href="#progress" class="btn-block" data-toggle="tab">Progress</a></li>
						</ul>
					</div>
					--> 
				</ul>
			</div>
		</div>
		<div class="nav-tabs-custom col-md-7 no-padding padding-bottom pull-left edit-tabs">
			<div class="box box-primary padding-all">
				<div class="tab-content tab-cont">

				<div class="active tab-pane edit-box margin-top" id="profile-image">
						<h2 class="h2-tabs">Change your profile image</h2>
						<p class="h2-subhead">Update your avatar</p>

					<div class="upload-photo-cont" >
								<span class="user-header"><img src="{{ URL::asset($user['profile']['image']['name']) }}" alt="User Image" height="160" width="160"></span>
								<div class="upload-photo">
									<a href="#" class="mailedit-box-attachment-name" data-toggle="modal" data-target="#myModal">
										<i class="fa fa-camera"></i> <span class="upload-txt">CHANGE AVATAR</span></a>
								</div>
					<!--  Modal za izmenu avatara -->			
							<div class="example-modal">
								<div class="modal" id="myModal">
									<div class="modal-dialog">
										<div class="modal-content">
										<form enctype="multipart/form-data" action="avatar" method="POST">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Upload a image</h4>
												</div>

												<div class="modal-body">
													<div class=" modal-choose">
                                                    <input type="file" class="col-md-12" name='avatar'>
													<span class="choose-image"><i class="fa fa-plus"></i> Select a image</span>
													</div>
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
												</div>

												<div class="modal-footer model-mdown">
													<button type="submit" class="btn btn-primary">Change avatar</button>
													 
												</div>
										</form>		
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							</div><!-- /.example-modal -->
						<!--  Modal za izmenu avatara -->	

					</div>
				</div>
	
		<!-- /.tab-pane -->

			<div class="tab-pane edit-box margin-top" id="user-details"> 
				<h2 class="h2-tabs">User Details</h2>

						<form method="POST" action="user/edit" accept-charset="UTF-8" id="mainFormEdit">
                            <input name="_token" type="hidden" value="LSoFI4hQLii3O5perBoyDdGQZReepW9mUEm4eI7r">

							<p class="h2-subhead">Update your personal info</p>
							<div class="form-group">
								<label for="display_name" class="">Display name</label>
								<br />
								<input class="form-control input-sm" id="id_displayname" name="display_name" type="text" value="{{$user['display_name']}}">
							</div>
							<div class="form-group">
								<label for="first_name" class="">First name</label>
								<br />
								<input class="form-control input-sm" id="id_firstname" name="first_name" type="text" value="{{$user['first_name']}}">
							</div>
							<div class="form-group">
								<label for="last_name" class="">Last name</label>
								<br />
								<input class="form-control input-sm" id="id_lastname" name="last_name" type="text" value="{{$user['last_name']}}">
							</div>
							<div class="form-group">
								<label for="about_me" class="">About me</label>
								<br />
								<textarea class="form-control input-sm" id="id_aboutme" name="about_me" cols="50" rows="10">{{$user['profile']['about_me']}}</textarea>
							</div>
                                                        
                                                        
                                                        
                                                                           
                                                        
							<div class="form-group">
								<label for="dic_languages_id" class="">Language</label>
								<br />
								<select class="form-control select2" style="width: 100%;" id="id_profile" name="dic_languages_id">
                                                                         @if ($user['profile']['dic_languages_id'] == 1)
                                                                                  <option value="1" selected="selected">English</option>
									          <option value="2">Serbian</option>
                                                                          @else
                                                                                  <option value="1" >English</option>
									          <option value="2" selected="selected">Serbian</option>
                                                                          @endif
																	</select>
							</div>
							<div class="form-group">
								<label for="date_of_birth" class="">Date of birth</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
                                                                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="{{$user['profile']['date_of_birth']}}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
							</div>
                                                        
							<div class="form-group">
                                                             
								<label for="gender" class="">Gender</label>
								<br />
                                                               
                                                                
								<select class="form-control select2" style="width: 100%;" id="id_gender" name="gender">
									
                                                                     @if ($user['profile']['gender'] == 0)
                                                                                   <option value="3">Not Telling</option>
									           <option value="0" selected="selected">Male</option>
                                                                                   <option value="1">Female</option>
                                                                          @elseif($user['profile']['gender']==1)
                                                                                  <option value="3">Not Telling</option>
                                                                                  <option value="0">Male</option>
                                                                                  <option value="1" selected="selected">Female</option>
                                                                           @else
                                                                             <option value="3" selected="selected">Not Telling</option>
                                                                               <option value="0">Male</option>
                                                                                     <option value="1">Female</option>
                                                                          @endif 
                                                                         
								</select>
                                                                							</div>
							<div class="form-group">
								<label for="phone" class="">Phone</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<input type="text" id="id_phone" name="phone" value="{{$user['profile']['phone']}}" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								</div>
							</div>
							<div class="form-group">
								<label for="mobile" class="">Mobile</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<input type="text" id="id_mobile" name="mobile"value="{{$user['profile']['mobile']}}" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								</div>
							</div>
							<div class="form-group">
								<label for="line1" class="">Line1</label>
								<br />
								<input class="form-control input-sm" id="id_line1" name="line1" type="text" value="{{$user['profile']['line1']}}">
							</div>
							<div class="form-group">
								<label for="line2" class="">Line2</label>
								<br />
								<input class="form-control input-sm" id="id_line2" name="line2" type="text" value="{{$user['profile']['line2']}}">
							</div>
							<div class="form-group">
								<label for="city" class="">City</label>
								<br />
								<input class="form-control input-sm" id="id_city" name="city" type="text" value="{{$user['profile']['city']}}">
							</div>
							<div class="form-group">
								<label for="zip" class="">Zip</label>
								<br />
								<input class="form-control input-sm" id="id_zip" name="zip" type="text" value="{{$user['profile']['zip']}}">
							</div>
							<div class="form-group">
								<label for="website" class="">Website</label>
								<br />
								<input class="form-control input-sm" id="id_website" name="website" type="text" value="{{$user['profile']['website']}}">
							</div>
							<div class="form-group">
								<label for="dic_country_id" class="">Country</label>
								<br />
								<select class="form-control select2" style="width: 100%;" name="dic_country_id">
                                                                    @foreach($countries as $contry )
                                                                    <option value='{{$contry['id']}}'<?php if($user['profile']['dic_country_id']==$contry['id']) echo 'selected="selected"' ?>>{{$contry['name']}}</option>
                                                                    @endforeach
                                                                    
									
								</select>
							</div>
						</div><!-- /.tab-pane -->

						<div class="tab-pane edit-box margin-top" id="user-type"> <h2 class="h2-tabs">User Type</h2>
							<p class="h2-subhead">Type of person</p>
							<div class="form-group">
                                                           
                                                            
                                                            
								<input name="dic_user_type_id" type="radio"<?php if($user['profile']['dic_user_type_id']==1) echo 'checked="checked"' ?> value="1">
								Home User <br />
								<input  name="dic_user_type_id" type="radio" value="2" <?php if($user['profile']['dic_user_type_id']==2) echo 'checked="checked"' ?> >
								Gym/Club User <br />
								<input  name="dic_user_type_id" type="radio" value="3" <?php if($user['profile']['dic_user_type_id']==3) echo 'checked="checked"' ?> >
								Work User <br />
								<input  name="dic_user_type_id" type="radio" value="4" <?php if($user['profile']['dic_user_type_id']==4) echo 'checked="checked"' ?> >
								Armed Forces/Uniformed Services User <br />
							</div>
						</div> <!-- /.tab-pane -->

						<div class="tab-pane edit-box margin-top" id="e-mail"> <h2 class="h2-tabs">E-mail</h2>
							<p class="h2-subhead">Update email data</p>
							<div class="form-group">
								<label for="email" class="">E-mail</label>
								<input class="form-control input-sm email required" id="id_email" name="email" type="text" value="{{$user['email']}}">
							</div>
						</div> <!-- /.tab-pane -->
						<div class="tab-pane edit-box margin-top" id="notifi"> <h2 class="h2-tabs">Notifications</h2>
							<p class="h2-subhead">Update your notifications</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="notify_me_on_comment">
									<option value="3" <?php if($user['profile']['notify_me_on_comment']==3) echo 'selected="selected"' ?> >-------</option>
									<option value="1" <?php if($user['profile']['notify_me_on_comment']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['notify_me_on_comment']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
							<hr />
							<label>Notify Me on New Session</label>
							<p class="instructions">Email me when someone I'm watching adds a session</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="notify_me_on_new_session">
									<option value="3" <?php if($user['profile']['notify_me_on_new_session']==3) echo 'selected="selected"' ?>>-------</option>
									<option value="1" <?php if($user['profile']['notify_me_on_new_session']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0"<?php if($user['profile']['notify_me_on_new_session']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
							<hr />
							<label>Notify Me on New Watcher</label>
							<p class="instructions">Email me if someone new starts watching me</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="notify_me_on_new_watcher">
									<option value="3" <?php if($user['profile']['notify_me_on_new_watcher']==3) echo 'selected="selected"' ?>>-------</option>
									<option value="1" <?php if($user['profile']['notify_me_on_new_watcher']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['notify_me_on_new_watcher']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
							<hr />
							<label>Send Session Summary </label>
							<p class="instructions">Email me a summary when I upload a session</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="send_session_summary">
									<option value="3" <?php if($user['profile']['send_session_summary']==3) echo 'selected="selected"' ?>>-------</option>
									<option value="1" <?php if($user['profile']['send_session_summary']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['send_session_summary']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
							<hr />
							<label>Session Summary Alternative </label>
							<p class="instructions">Alternate email address for session summary emails only. i.e. Coach</p>
							<div class="form-group">
								<input class="form-control input-sm email" id="id_email_alternative" name="email_summary_alternative" type="text" value="{{$user['profile']['email_summary_alternative']}}">
							</div>
							<hr />
							<label>Send Session Summary Alternate </label>
							<p class="instructions">Email a summary of my sessions to the alternate email address i.e. Coach</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="send_session_summary_alternate">
									<option value="3" <?php if($user['profile']['send_session_summary_alternate']==3) echo 'selected="selected"' ?>>-------</option>
									<option value="1" <?php if($user['profile']['send_session_summary_alternate']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['send_session_summary_alternate']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane edit-box margin-top" id="account-priv"> <h2 class="h2-tabs">Account Privicy</h2>
							<p class="h2-subhead">Update your account privicy</p>
							<p class="instructions">If selected your account will not be publicly viewable.</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="privacy">
									<option value="3" <?php if($user['profile']['privacy']==3) echo 'selected="selected"' ?>>-------</option>
									<option value="1" <?php if($user['profile']['privacy']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['privacy']==0) echo 'selected="selected"' ?>>No</option>
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

						<br> 
						<div class="pull-left">
							<input class="btn btn-primary btn-primary" id="idSubmitEditProfile" type="submit" value="Save profile">
							<input class="btn btn-primary btn-primary" id="idSubmitEditProfile" type="reset" value="Reset">
							<br>
						</div>
						<br> 
				</form>
			</div>
		</div>
		<!-- /.tab-content -->
		<div class="clear"></div>
	</div>
	</div>
	<!-- /.row -->

@endsection