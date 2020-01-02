<?php include'templates/header.php';?>
<script type="text/javascript" src="script/validation.min.js"></script>
<script type="text/javascript" src="script/login.js"></script>
<script src="script/sweetalert.js"></script>
<link rel="stylesheet" type="text/css" href="main/toast.css">
<body>
	<div class="limiter">
		<br>
		<div class="container-login100" style="background-image: url('assets/images/back1.jpg'); background-size:cover;">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="post" id="login-form" >
					<div id="error"></div>	
					<span class="login100-form-title p-b-49">
						<img src="assets/images/upnext.png" style=" width:100%; height: 100px;">
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>
						<input class="input100" type="text"  name="username" id="username" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" id="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" name="login_button" id="login_button">
								<p style="color: black; font-weight: bolder; font-size: 17px;">Login</p>
							</button>
						</div>
						<div id="snackbar">Refres Done !</div>
					</div>
					<br>
					<center><a style="text-decoration: none;" href="#" id="mod">REFRESH</a></center>
					<br>
				</form>
				<?php include'templates/signature.php'; include'templates/modal_refresh.php';?>
			</div>
		</div>
	</div>
</body>
<script>
	$("#mod").on('click',function(){
			$('#myModal').modal({
	    backdrop: 'static',
	    keyboard: false
	});
	});
	$("#reset").on('click',function(){
		$("#ref").val("");
	})
//end toast logout
$('#ref').on('keyup',function(event){
	event.preventDefault();
	var id = 'id';
	var refresh = $("#ref").val();
	var form = $('#form').serialize();
	$.ajax({
		type : 'POST',
		url  : 'ajax_refresh.php',
		data : form,
		dataType: "json",
		success: function(data){
			if (data.auth == "pwede") {
				if (refresh == '') {
					$('#go').attr('disabled',true);	
				}
				if (refresh != '') {
						 $('#go').attr('disabled',false);	
				}
			}
			if (data.ok == "exists") {
				 $('#go').attr('disabled',true);		
			}	
		}

	})
})
</script>
</html>
