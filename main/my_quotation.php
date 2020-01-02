<?php include'../templates/header.php';?>
<?php
session_start();
if(!isset($_SESSION['username'])&& !isset($_SESSION['id'])){
header("location:../index.php");
}
?>
<style>
	.p-b-54{
		background-color: #ffffff;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/images/back1.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54" style="background-image: url('../assets/images/back1.jpg'); background-size: cover;">
				<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<a href="index.php"><button type="login_button" class="login100-form-btn" id="backbtn">
								<p style="color: black; font-weight: bolder; font-size: 17px;">BACK TO MAIN MENU</p>
							</button></a>
						</div>
					</div>
					<div>
					</div>
					<br>
						<table class="table" id="myTable">
					    <thead>
					      <tr>
					        <th><center>MY QUOTATION LIST</center></th>
					      </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		include '../dbcon.php';
					    		include 'quote_form/php_function/myquotation_function.php';
					    	?>
					    </tbody>
					  </table>
				
				<?php include'../templates/signature.php';?>
			</div>
		</div>
	</div>
	<script src="../script/main.js"></script>
	<script>
		$(document).ready( function () {
    	$('#myTable').DataTable();
	} );
	</script>