
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
								<span class="user-header"><img src="dist/img/user2-160x160.jpg" alt="User Image"></span>
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
								<input class="form-control input-sm" id="id_displayname" name="display_name" type="text" value="marijavlvc">
							</div>
							<div class="form-group">
								<label for="first_name" class="">First name</label>
								<br />
								<input class="form-control input-sm" id="id_firstname" name="first_name" type="text" value="Marija">
							</div>
							<div class="form-group">
								<label for="last_name" class="">Last name</label>
								<br />
								<input class="form-control input-sm" id="id_lastname" name="last_name" type="text" value="Vulović">
							</div>
							<div class="form-group">
								<label for="about_me" class="">About me</label>
								<br />
								<textarea class="form-control input-sm" id="id_aboutme" name="profile[about_me]" cols="50" rows="10">I&#039;m a web designer and a front-end programmer</textarea>
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
									<input type="text" class="form-control" id="date_of_birth" name="profile[date_of_birth]" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
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
									<input type="text" id="id_phone" name="profile[phone]" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
								</div>
							</div>
							<div class="form-group">
								<label for="mobile" class="">Mobile</label>
								<br />
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<input type="text" id="id_mobile" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
								<input class="form-control input-sm" id="id_city" name="profile[city]" type="text" value="Kovin">
							</div>
							<div class="form-group">
								<label for="zip" class="">Zip</label>
								<br />
								<input class="form-control input-sm" id="id_zip" name="profile[zip]" type="text" value="26220">
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
									<option value="0">- Please select -</option>
									<option value="3">Afghanistan</option>
									<option value="6">Albania</option>
									<option value="62">Algeria</option>
									<option value="11">American Samoa</option>
									<option value="1">Andorra</option>
									<option value="8">Angola</option>
									<option value="5">Anguilla</option>
									<option value="9">Antarctica</option>
									<option value="4">Antigua and Barbuda</option>
									<option value="10">Argentina</option>
									<option value="7">Armenia</option>
									<option value="14">Aruba</option>
									<option value="13">Australia</option>
									<option value="12">Austria</option>
									<option value="16">Azerbaijan</option>
									<option value="15">Ă&hellip;land</option>
									<option value="32">Bahamas</option>
									<option value="23">Bahrain</option>
									<option value="19">Bangladesh</option>
									<option value="18">Barbados</option>
									<option value="36">Belarus</option>
									<option value="20">Belgium</option>
									<option value="37">Belize</option>
									<option value="25">Benin</option>
									<option value="27">Bermuda</option>
									<option value="33">Bhutan</option>
									<option value="29">Bolivia</option>
									<option value="30">Bonaire</option>
									<option value="17">Bosnia and Herzegovina</option>
									<option value="35">Botswana</option>
									<option value="34">Bouvet Island</option>
									<option value="31">Brazil</option>
									<option value="106">British Indian Ocean Territory</option>
									<option value="239">British Virgin Islands</option>
									<option value="28">Brunei</option>
									<option value="22">Bulgaria</option>
									<option value="21">Burkina Faso</option>
									<option value="24">Burundi</option>
									<option value="117">Cambodia</option>
									<option value="47">Cameroon</option>
									<option value="38">Canada</option>
									<option value="52">Cape Verde</option>
									<option value="124">Cayman Islands</option>
									<option value="41">Central African Republic</option>
									<option value="215">Chad</option>
									<option value="46">Chile</option>
									<option value="48">China</option>
									<option value="54">Christmas Island</option>
									<option value="39">Cocos [Keeling] Islands</option>
									<option value="49">Colombia</option>
									<option value="119">Comoros</option>
									<option value="45">Cook Islands</option>
									<option value="50">Costa Rica</option>
									<option value="98">Croatia</option>
									<option value="51">Cuba</option>
									<option value="53">Curacao</option>
									<option value="55">Cyprus</option>
									<option value="56">Czech Republic</option>
									<option value="40">Democratic Republic of the Congo</option>
									<option value="59">Denmark</option>
									<option value="58">Djibouti</option>
									<option value="60">Dominica</option>
									<option value="61">Dominican Republic</option>
									<option value="221">East Timor</option>
									<option value="63">Ecuador</option>
									<option value="65">Egypt</option>
									<option value="210">El Salvador</option>
									<option value="88">Equatorial Guinea</option>
									<option value="67">Eritrea</option>
									<option value="64">Estonia</option>
									<option value="69">Ethiopia</option>
									<option value="72">Falkland Islands</option>
									<option value="74">Faroe Islands</option>
									<option value="71">Fiji</option>
									<option value="70">Finland</option>
									<option value="75">France</option>
									<option value="80">French Guiana</option>
									<option value="175">French Polynesia</option>
									<option value="216">French Southern Territories</option>
									<option value="76">Gabon</option>
									<option value="85">Gambia</option>
									<option value="79">Georgia</option>
									<option value="57">Germany</option>
									<option value="82">Ghana</option>
									<option value="83">Gibraltar</option>
									<option value="89">Greece</option>
									<option value="84">Greenland</option>
									<option value="78">Grenada</option>
									<option value="87">Guadeloupe</option>
									<option value="92">Guam</option>
									<option value="91">Guatemala</option>
									<option value="81">Guernsey</option>
									<option value="86">Guinea</option>
									<option value="93">Guinea-Bissau</option>
									<option value="94">Guyana</option>
									<option value="99">Haiti</option>
									<option value="96">Heard Island and McDonald Islands</option>
									<option value="97">Honduras</option>
									<option value="95">Hong Kong</option>
									<option value="100">Hungary</option>
									<option value="109">Iceland</option>
									<option value="105">India</option>
									<option value="101">Indonesia</option>
									<option value="108">Iran</option>
									<option value="107">Iraq</option>
									<option value="102">Ireland</option>
									<option value="104">Isle of Man</option>
									<option value="103">Israel</option>
									<option value="110">Italy</option>
									<option value="44">Ivory Coast</option>
									<option value="112">Jamaica</option>
									<option value="114">Japan</option>
									<option value="111">Jersey</option>
									<option value="113">Jordan</option>
									<option value="125">Kazakhstan</option>
									<option value="115">Kenya</option>
									<option value="118">Kiribati</option>
									<option value="245">Kosovo</option>
									<option value="123">Kuwait</option>
									<option value="116">Kyrgyzstan</option>
									<option value="126">Laos</option>
									<option value="135">Latvia</option>
									<option value="127">Lebanon</option>
									<option value="132">Lesotho</option>
									<option value="131">Liberia</option>
									<option value="136">Libya</option>
									<option value="129">Liechtenstein</option>
									<option value="133">Lithuania</option>
									<option value="134">Luxembourg</option>
									<option value="148">Macao</option>
									<option value="144">Macedonia</option>
									<option value="142">Madagascar</option>
									<option value="156">Malawi</option>
									<option value="158">Malaysia</option>
									<option value="155">Maldives</option>
									<option value="145">Mali</option>
									<option value="153">Malta</option>
									<option value="143">Marshall Islands</option>
									<option value="150">Martinique</option>
									<option value="151">Mauritania</option>
									<option value="154">Mauritius</option>
									<option value="247">Mayotte</option>
									<option value="157">Mexico</option>
									<option value="73">Micronesia</option>
									<option value="139">Moldova</option>
									<option value="138">Monaco</option>
									<option value="147">Mongolia</option>
									<option value="140">Montenegro</option>
									<option value="152">Montserrat</option>
									<option value="137">Morocco</option>
									<option value="159">Mozambique</option>
									<option value="146">Myanmar [Burma]</option>
									<option value="160">Namibia</option>
									<option value="169">Nauru</option>
									<option value="168">Nepal</option>
									<option value="166">Netherlands</option>
									<option value="161">New Caledonia</option>
									<option value="171">New Zealand</option>
									<option value="165">Nicaragua</option>
									<option value="162">Niger</option>
									<option value="164">Nigeria</option>
									<option value="170">Niue</option>
									<option value="163">Norfolk Island</option>
									<option value="121">North Korea</option>
									<option value="149">Northern Mariana Islands</option>
									<option value="167">Norway</option>
									<option value="172">Oman</option>
									<option value="178">Pakistan</option>
									<option value="185">Palau</option>
									<option value="183">Palestine</option>
									<option value="173">Panama</option>
									<option value="176">Papua New Guinea</option>
									<option value="186">Paraguay</option>
									<option value="174">Peru</option>
									<option value="177">Philippines</option>
									<option value="181">Pitcairn Islands</option>
									<option value="179">Poland</option>
									<option value="184">Portugal</option>
									<option value="182">Puerto Rico</option>
									<option value="187">Qatar</option>
									<option value="188">RĂ&copy;union</option>
									<option value="42">Republic of the Congo</option>
									<option value="189">Romania</option>
									<option value="191">Russia</option>
									<option value="192">Rwanda</option>
									<option value="26">Saint BarthĂ&copy;lemy</option>
									<option value="199">Saint Helena</option>
									<option value="120">Saint Kitts and Nevis</option>
									<option value="128">Saint Lucia</option>
									<option value="141">Saint Martin</option>
									<option value="180">Saint Pierre and Miquelon</option>
									<option value="237">Saint Vincent and the Grenadines</option>
									<option value="244">Samoa</option>
									<option value="204">San Marino</option>
									<option value="193">Saudi Arabia</option>
									<option value="209">SĂŁo TomĂ&copy; and PrĂ&shy;ncipe</option>
									<option value="205">Senegal</option>
									<option value="190" selected="selected">Serbia</option>
									<option value="195">Seychelles</option>
									<option value="203">Sierra Leone</option>
									<option value="198">Singapore</option>
									<option value="211">Sint Maarten</option>
									<option value="202">Slovakia</option>
									<option value="200">Slovenia</option>
									<option value="194">Solomon Islands</option>
									<option value="206">Somalia</option>
									<option value="248">South Africa</option>
									<option value="90">South Georgia and the South Sandwich Islands</option>
									<option value="122">South Korea</option>
									<option value="208">South Sudan</option>
									<option value="68">Spain</option>
									<option value="130">Sri Lanka</option>
									<option value="196">Sudan</option>
									<option value="207">Suriname</option>
									<option value="201">Svalbard and Jan Mayen</option>
									<option value="213">Swaziland</option>
									<option value="197">Sweden</option>
									<option value="43">Switzerland</option>
									<option value="212">Syria</option>
									<option value="228">Taiwan</option>
									<option value="219">Tajikistan</option>
									<option value="229">Tanzania</option>
									<option value="218">Thailand</option>
									<option value="217">Togo</option>
									<option value="220">Tokelau</option>
									<option value="224">Tonga</option>
									<option value="226">Trinidad and Tobago</option>
									<option value="223">Tunisia</option>
									<option value="225">Turkey</option>
									<option value="222">Turkmenistan</option>
									<option value="214">Turks and Caicos Islands</option>
									<option value="227">Tuvalu</option>
									<option value="232">U.S. Minor Outlying Islands</option>
									<option value="240">U.S. Virgin Islands</option>
									<option value="231">Uganda</option>
									<option value="230">Ukraine</option>
									<option value="2">United Arab Emirates</option>
									<option value="77">United Kingdom</option>
									<option value="233">United States</option>
									<option value="234">Uruguay</option>
									<option value="235">Uzbekistan</option>
									<option value="242">Vanuatu</option>
									<option value="236">Vatican City</option>
									<option value="238">Venezuela</option>
									<option value="241">Vietnam</option>
									<option value="243">Wallis and Futuna</option>
									<option value="66">Western Sahara</option>
									<option value="246">Yemen</option>
									<option value="249">Zambia</option>
									<option value="250">Zimbabwe</option>
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
								<input class="form-control input-sm email required" id="id_email" name="email" type="text" value="marijavlvc@gmail.com">
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

@endsection
