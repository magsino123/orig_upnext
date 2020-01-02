/* login ajax */
$('document').ready(function() { 
	/* handling form validation */
	$("#login-form").validate({
		rules: {
			password: {
				required: true,
			},
			username: {
				required: true,
			},
		},
		messages: {
			password:{
			  required: "<p style='color:red; font-size:12px'>please enter your password</p>"
			 },
			username: "<p style='color:red; font-size:12px'>please enter your username</p>",
		},
		submitHandler: submitForm	
	});	   
	/* Handling login functionality */
	function submitForm() {		
		var data = $("#login-form").serialize();				
		$.ajax({				
			type : 'POST',
			url  : 'login.php',
			data : data,
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#login_button").html('<img src="assets/images/ajax-loader.gif" width="80" /> &nbsp; Please Wait...');
			},
			success : function(response){						
				if(response=="ok"){									
					$("#login_button").html('<img src="assets/images/ajax-loader.gif" width="60"/> &nbsp; Logging In ...');
					setTimeout(' window.location.href = "main/index.php"; ',1000);
					
				}else {									
					$("#error").fadeOut(4000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
						$("#login_button").html('<span class="fa fa-log-in" style="color: black; font-weight: bolder; font-size: 17px;">&nbsp; Login</span> ');
						swal(response,"", "warning");
						$("#username").val("");
						$("#password").val("");
					});
				}
			}
		});
		return false;
	}   
});
/* end login ajax */