
		$(function(){
			
			 $.validator.addMethod("noSpace", function(value, element) { 
			 	if (value == "") return true;
			    return value != "" && value.indexOf(" ") < 0; 
			 }, "Space are not allowed");			

			$("#id_firstname").rules( "add", {
				 required: true,
			     maxlength: 255
			});

			$("#id_lastname").rules( "add", {
				 required: true,
			     maxlength: 255
			});

			$("#id_email").rules( "add", {
			     maxlength: 255
			});

			$("#password").rules( "add", {
				 noSpace: true,
				 minlength: 6,
			     maxlength: 255
			});

			$("input[name='password_confirm']").rules( "add", {
                equalTo: "#password"
			});

			$("#id_phone").rules( "add", {
			     maxlength: 45
			});							

			$("#id_mobile").rules( "add", {
			     maxlength: 45
			});					

			$("#id_line1").rules( "add", {
			     maxlength: 45
			});		

			$("#id_line2").rules( "add", {
			     maxlength: 45
			});		

			$("#id_city").rules( "add", {
			     maxlength: 70
			});					

			$("#id_zip").rules( "add", {
			     maxlength: 45
			});			

			$("#id_website").rules( "add", {
			     maxlength: 100
			});

			$("#id_displayname").rules( "add", {
				 required: true,
			     maxlength: 255,
			});

			$("#id_email_alternative").rules( "add", {
			     maxlength: 255
			});			

		});

