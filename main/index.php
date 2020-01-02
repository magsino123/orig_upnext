<?php include'../templates/header.php';?>
<?php
session_start();
if(!isset($_SESSION['username'])){
header("location:../index.php");
}
include_once("../dbcon.php");
$sql = "SELECT * FROM agent_list_tb WHERE username='".$_SESSION['username']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_array($resultset);
?>
<body>
	<style>
		.wrap-login100-form-btn{
			height: 100px;	
		}
		.p-b-54{
			background-image: url('assets/images/back1.jpg');
			background-size:cover;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="toast.css">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/images/back1.jpg'); background-size:cover;">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
					<div id="error"></div>	
					<span class="login100-form-title p-b-49">
						<h4><i>WELCOME: <br><?php echo $row['firstname'];?> <?php echo $row['middlename_suffix'];?>. <?php echo $row['lastname'];?></i></h4>
					</span>
					
					<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<a style="text-decoration: none;" href="my_quotation.php"><button type="submit" class="login100-form-btn"><br>	
								<p style="color: black; font-weight: bolder; font-size: 17px; margin-top: 22px;"><span class="fa fa-home fa-2x" style="color: black;"></span> HOME</p>
							</button></a>
						</div>
					</div>

						<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<a style="text-decoration: none;" href="quote_form/"><button type="submit" class="login100-form-btn">
								<p style="color: black; font-weight: bolder; font-size: 17px; margin-top: 22px;"><span class="fa fa-edit fa-2x" style="color: black;"></span> QUOTATION FORM</p>
							</button></a>
						</div>
					</div>
					
						<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" onclick="myFunction()">
								<p style="color: black; font-weight: bolder; font-size: 17px; margin-top: 22px;"><span class="fa fa-power-off fa-2x" style="color: black;"></span> LOGOUT</p>
							</button>
						</div>
					</div>
					<div id="snackbar">Logging OUT .... <img src="assets/images/ajax-loader.gif" width="50"></div>
					<br><br><br><br>
				<?php include'../templates/signature.php';?>
			</div>
		</div>
	</div>
	<script src="js.js/myjs.js"></script>
</body>
</html>