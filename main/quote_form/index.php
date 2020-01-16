<?php include'../../templates/header.php';?>
<?php
session_start();
if(!isset($_SESSION['username'])){
header("location:../index.php");
}
?>
<style>
	.p-b-54{
		background-color: #ffffff;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/images/back1.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54" style="background-image: url('../assets/images/back1.jpg'); background-size: cover;">
				<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn" >
							<div class="login100-form-bgbtn" ></div>
							<a style="text-decoration: none;" href="../index.php"><button  type="submit" class="login100-form-btn" id="backbtn">
								<p style="color: black; font-weight: bolder; font-size: 17px;">BACK TO MAIN MENU</p>
							</button></a>
						</div>
					</div>
				<form method="post" action="../view_myquote.php" id="getquote">
					<div>
						<br/><br/>
					</div>

					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100">Client Name</span>
						<input class="input100" type="text"  name="name" id="client_name" placeholder="Enter Client Name" >
						<i id="error1"></i>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Contact No.</span>
						<input class="input100" pattern="[1-9]{1}[0-9]{9}" type="number" name="contact" id="contact" placeholder="Enter Contact Number/Phone number/Tel no">
						<i id="error2"></i>
						<span class="focus-input100" data-symbol="&#xf2bb;"></span>
					</div>


					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Plate No.</span>
						<input class="input100" type="text" name="plate" id="plate" placeholder="Enter Plate Number / Induction Number">
						<i id="error3"></i>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>
					<div >
					<p>UNIT DETAILS </p>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Select Car Brand</span>
						<select class="input100 action" name="MAKE" id="major_area" disabled="" required="">
							<option value="">--Select Brand--</option>
							<?php
								include '../../dbcon.php';
								include 'php_function/function.php';
							?>
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Select Model</span>
						<select class="input100 action" name="MODEL" id="city" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100" >Select Variant</span>
						<select class="input100 action" name="VARIANT" id="zip_code" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Select Year Model</span>
						<select class="input100 action" name="YM" id="YM" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Select Transmission</span>
						<select class="input100 action" name="TRANS" id="trans" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100 ">Select Color</span>
						<select class="input100 action" name="COLOR" id="color" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Select Other Features</span>
						<select class="input100 action" name="OF" id="other" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Select Usage</span>
						<select class="input100 action" name="usage" id="usage">
							<option value="Private Use">Private Use</option>
							<option value="TNVS">TNVS</option>
							<option value="Yellow Plate">Yellow Plate</option>
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Market Value</span>
						<select class="input100 action" name="maraketval" id="mv" required=""></select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>					

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Enter Sum Insured</span>
						<input class="input100" type="number" min="1" name="fmv" id="fmv" placeholder="Enter Sum Ensured" required="">
						<span class="focus-input100" data-symbol="&#xf12345;"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<span class="label-input100" >Act of Nature </span>
						<select class="input100" name ="AOG">
							<option>YES</option>
							<option>NO</option>
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>	

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Bodily Injury</span>
						<select class="input100 action" name="rbi" id="rbi">
							<?php
								include '../../dbcon.php';
								$query = mysqli_query($conn,"SELECT rate,rbi from rate where cat_id = '1'")or die(mysqli_error($conn));
								$n = 0;
								while ($row = mysqli_fetch_array($query)) {
									$rate = $row['rate'];
									$rbi = $row['rbi'];
							 ?>
							<option value="<?php echo $rate;?>"><?php echo number_format($rate);?></option>
					        <?php
					        	$n++;
					        	}
					        ?>
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>	
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Property Damage</span>
						<select class="input100" name="rpd" id="rpd">
							<?php
								include '../../dbcon.php';
								$query = mysqli_query($conn,"SELECT rate,rpd from rate where cat_id = '1'")or die(mysqli_error($conn));
								$n = 0;
								while ($row = mysqli_fetch_array($query)) {
									$rate = $row['rate'];
									$rpd = $row['rpd'];
							 ?>
							<option value="<?php echo $rate;?>"><?php echo number_format($rate);?></option>
					        <?php
					        	$n++;
					        	}
					        ?>
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>	

					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Providers</span>
						<select class="input100" name="provider">
							<option>ALPHA</option>
					        <option>ASIANLIFE</option>
					        <option>ETIQA</option>
					        <option>FPG</option>
					        <option>MERCANTILE</option>
					        <option>PACIFIC UNION</option>
					        <option>STANDARD</option>
					        <option>WG</option>
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>	

					<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="button" class="login100-form-btn" name="compute"  id="compute">
								<p style="color: black; font-weight: bolder; font-size: 17px;">COMPUTE</p>
							</button>
							<div id="error"></div>
						</div>
					</div>
					
					<div class="wrap-input100 validate-input" >
						<span class="label-input100">Premium</span>
						<select class="input100" name="gross" id="gross" required="">
							
						</select>
						<span class="focus-input100" data-symbol="&#xf123;"></span>
					</div>	
					
					<div class="text-right p-t-8 p-b-31"></div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit"  class="login100-form-btn" name="login_button" id="validate" disabled="">
								<p style="color: black; font-weight: bolder; font-size: 17px;">SUBMIT FOR QUOTATION</p>
							</button>
						</div>
					</div>
				</form>	
				<?php include'../../templates/signature.php';?>
			</div>
		</div>
	</div>
	<script src="../../script/main.js"></script>
	<script src="../../script/getquote_ajax.js"></script>
	<script>
		$('#plate').on('keyup',function(event){
			event.preventDefault();
			var id = 'id';
			var plate = $("#plate").val();
			var form = $('#getquote').serialize();
			//console.log( $('#getquote').serialize() );
			$.ajax({				
			type : 'POST',
			url  : 'php_function/if_platenumber_existed.php',
			data : form,
			dataType: "json",
			success : function(data){
			if (data.auth == "exist") {
				//alert("Already Qouted by:"+"\t"+data.name+" "+ "with the Premium of"+" "+data.Premium);
				if (plate != '') {
					swal("Already Qouted by:"+"\t"+data.name+" "+data.lastname+" "+ "with the Premium of"+" "+"₱"+" "+data.PREM,"", "warning");
				 $('#major_area').attr('disabled',true);
				}else{

				}
			}
			if (data.ok == "pwede") {
					 $('#major_area').attr('disabled',false);
					 $('#validate').attr('disabled',false);
					
			}		

			if(plate == ''){
				 $('#major_area').attr('disabled',true);
			}															
			}
			});
		});

		$("#compute").on('click', function(event){
			event.preventDefault();
			var cn = $("#client_name").val();
			var contact = $("#contact").val();
			var plte = $("#plate").val();
			var sum =  $("#fmv").val();

			if (cn == '') {
				swal("Client Name is Required !", "Please Enter Client Name !");
				document.getElementById('client_name').style.borderColor = "red";
			}else if(contact == ''){
				swal("Contact is Required !", "Please Enter Contact Number !");
			}else if(plte == ''){
				swal("Plate Number is Required !", "Please Enter Plate Number!");
			}else if (sum == '') {
				swal("Sum Insured is Required !", "Please Enter Sum Insured !");
			}
			
		})
	</script>