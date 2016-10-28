@extends('layouts.main')

@section('page-script')
	<script type="text/javascript">
		$(function(){	
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

		});

	</script>
@endsection



@section('content')
<section class="content">
	<div class="row"><!-- /.col -->
		<h1 class="h1-settings">Settings</h1>
	
	
		<div class="col-md-3 pull-left">
			<div class=" box box-primary">
				<ul class="edit-tab white-bg" id="accordion">
					<div class="panel">
						<li class="title-section"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Edit Profile</a></li>
						<ul id="collapseOne" class="panel-collapse collapse in sub-ul">
							<li class="active"><a href="#profile-image" class="btn-block" data-toggle="tab">Profile image</a></li>
							<li><a href="#user-details" class="btn-block" data-toggle="tab">Users Details</a></li>
							<!-- Privremeno iskljuceno 
							<li><a href="#user-type" class="btn-block" data-toggle="tab">User type</a></li> -->	
							<li><a href="#notifi" class="btn-block" data-toggle="tab">Notifications</a></li>
							<!-- Privremeno iskljuceno
							<li><a href="#account-priv" class="btn-block" data-toggle="tab">Account Privacy</a></li> -->

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
	<div>
		@if (session('status-success'))
			<div class="alert alert-success">
				<strong>Great!</strong><br><br>
				<ul>
					<li>{{ session('status-success') }}</li>
				</ul>
			</div>
		@endif
	</div>		

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
		@if (!$errors->isEmpty())
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					<?php echo $errors->first('email', '<li>:message</li>'); ?>
					<?php echo $errors->first('first_name', '<li>:message</li>'); ?>
					<?php echo $errors->first('last_name', '<li>:message</li>'); ?>
					<?php echo $errors->first('display_name', '<li>:message</li>'); ?>	
					<?php echo $errors->first('month', '<li>:message</li>'); ?>
					<?php echo $errors->first('day', '<li>:message</li>'); ?>
					<?php echo $errors->first('year', '<li>:message</li>'); ?>		
				</ul>
			</div>
		@endif
	</div>
			<div class="box box-primary padding-all">
				<div class="tab-content tab-cont">

				<div class="active tab-pane edit-box margin-top" id="profile-image">
						<h2 class="h2-tabs">Change your profile image</h2>
						<p class="h2-subhead">Update your avatar</p>

					<div class="upload-photo-cont" >
					<span class="user-header"><img src="{{ URL::asset($user['profile']['image']['name']) }}" alt="User Image" height="160" width="160"></span>
					</div>

			<form enctype="multipart/form-data" action="avatar" method="POST" id="cng-avatar">
				<a href="#">
					<label for="avatar"><h4> <i class="fa fa-plus"></i> Select a new avatar </h4></label> </a>
					<input type="file" name="avatar" id="avatar" class="hidden new-avatar" />
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<br>
					<span id="selected_name"> </span>
					<br>
					<div id="loadingmessage" style="display: none;" >
       					<img src="{{ URL::asset('images/ajax-loader.gif') }}"/>
					</div>
						<div class="pull-right" style="display: none;" id="buttonSaveAvatar">
						<input id="SaveAvatar" class="btn btn-primary btn-primary" type="submit" value="Save Avatar">
						</div>	
			</form>	

				</div>
	
		<!-- /.tab-pane -->

			<div class="tab-pane edit-box margin-top" id="user-details"> 
			<h2 class="h2-tabs">User Details</h2>

						<form method="POST" action="user/edit" accept-charset="UTF-8" id="mainFormEdit">
                           <input name="_token" type="hidden" value="{!! csrf_token() !!}" />


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
								<label for="email" class="">E-mail</label>
								<input class="form-control input-sm email required" id="id_email" name="email" type="text" value="{{$user['email']}}">
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
									<select name="month" class="form-control select2" style="width: 9%;">
										<option value="13"> Month </option> 
										@for($m=1; $m < 13; $m++)	
											<option value="{{$m}}" {{$m == $user['profile']['month_birthday'] ? "selected" :""}}>{{$m}}</option>
										@endfor								
									</select>								
									<select name="day" class="form-control select2" style="width: 9%;">
										<option value="32"> Day </option> 
										@for($d=1; $d< 32; $d++)
											<option value="{{$d}}" {{$d == $user['profile']['day_birthday'] ? "selected" :""}}>{{$d}}</option>
										@endfor						
									</select>
									<select name="year" class="form-control select2" style="width: 11%;"> 
										<option value="2020"> Year </option> 
										@for($y=1930; $y< 2011; $y++)
											<option value="{{$y}}" {{$y == $user['profile']['year_birthday'] ? "selected" :""}} >{{$y}}</option>
										@endfor		
									</select>
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
							<hr />	
						<div class="pull-right">
							<input class="btn btn-primary btn-primary" id="idSubmitEditProfile" type="submit" value="Saves profile">
						</div>

						</div><!-- /.tab-pane -->

				<div class="tab-pane edit-box margin-top" id="user-type"> 
				<h2 class="h2-tabs">User Type</h2>
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

				<div class="tab-pane edit-box margin-top" id="notifi"> 
				<h2 class="h2-tabs">Notifications</h2>
							<p class="h2-subhead">Update your notifications</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="notify_me_on_comment">
								
									<option value="1" <?php if($user['profile']['notify_me_on_comment']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['notify_me_on_comment']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
							<hr />					
							<label>Send Session Summary </label>
							<p class="instructions">Email me a summary when I upload a session</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="send_session_summary">
									<option value="1" <?php if($user['profile']['send_session_summary']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['send_session_summary']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
							<hr />	
						<div class="pull-right">
							<input class="btn btn-primary btn-primary" id="idSubmitEditProfile" type="submit" value="Saves profile">
						</div>
					</form>	
				</div><!-- /.tab-pane -->

				
				<div class="tab-pane edit-box margin-top" id="account-priv"> 
				<h2 class="h2-tabs">Account privacy</h2>
							<p class="h2-subhead">Update your account privacy</p>
							<p class="instructions">If selected your account will not be publicly viewable.</p>
							<div class="form-group">
								<select class="form-control select2" style="width: 100%;" name="privacy">
									<option value="1" <?php if($user['profile']['privacy']==1) echo 'selected="selected"' ?>>Yes</option>
									<option value="0" <?php if($user['profile']['privacy']==0) echo 'selected="selected"' ?>>No</option>
								</select>
							</div>
				</div><!-- /.tab-pane -->


				<div class="tab-pane edit-box margin-top" id="change-pass"> 
				<h2 class="h2-tabs">Change Password</h2>
							<p class="h2-subhead">Leave blank to keep your current password</p>
				<form method="POST" action="user/change-password" accept-charset="UTF-8">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<div class="form-group">
									<label for="password" class="password">Current Password</label>
									<br />
									<input class="form-control input-sm" name="old_password" type="password" value="" id="password">
								</div>

								<div class="form-group">
									<label for="password" class="password">New Password</label>
									<br />
									<input class="form-control input-sm" name="password" type="password" value="" id="password">
								</div>
								<div class="form-group">
									<label for="Confirm password" class="password">Confirm New Password</label>
									<br />
									<input class="form-control input-sm" name="password_confirmation" type="password" value="">
								</div>
							</div>

					<div class="pull-right">
						<input class="btn btn-primary btn-primary" type="submit" value="Change Password">
					</div>
				</form>				
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
						
						<br> 
				
			</div>
		</div>
		<!-- /.tab-content -->
		<div class="clear"></div>
	</div>
	</div>
</section>	
	<!-- /.row -->
<script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script>
	$(function() { 
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
	});

	if($('.alert').is(':visible')) {
		$('.alert').delay(5000).slideUp();
	}

	// ZA UPLOAD AVATARA
	var $f1 = $("#cng-avatar .new-avatar");
	function FChange() {
    	var prikazi = document.getElementById("selected_name");
		prikazi.innerHTML = "<b> You chose:</b> "+this.value+" <br> If you want to change your avatar , press Save Avatar ";
		$('#buttonSaveAvatar').show();
	}

	$f1.change(FChange);
	// Prikazati ajax loading gif
	$(document).on("click", "#SaveAvatar", function(){
				$('#loadingmessage').show();
	});
	// ZA UPLOAD AVATARA KRAJ
</script>
@endsection