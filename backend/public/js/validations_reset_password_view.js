
		$(function(){

			$("#emailPasswordReset").rules( "add", {
				 required: true,
				 email: true
			});

			$("#passwordPasswordReset").rules( "add", {
				 required: true,
				 minlength: 6,
			     maxlength: 255				 
			});

			$("input[name='password_confirmation']").rules( "add", {
				required: true,
                equalTo: "#passwordPasswordReset"
			});
	

		});

