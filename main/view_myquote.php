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
	table{
		font-size: 12px;
	}thead{
		background: #FDC30F; 
	}td{
		
		font-weight: bold;
		font-size: 11px;
	}.table{
		border-top: none;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="sweetalert.js"></script>
<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/images/back1.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
<?php
include_once("../dbcon.php");
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
$unique = $today . $rand;
//-------------------------------------------------------------------------------//

include 'quote_form/php_function/calculated.php';

$sql = "SELECT * FROM agent_list_tb WHERE username='".$_SESSION['username']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_array($resultset);
?>

<form method="post">
<input type="hidden" id="make" name="make" value="<?php echo $make?>">
<input type="hidden" id="variant" name="variant" value="<?php echo $var?>">
<input type="hidden" id="model" name="model" value="<?php echo $model?>">
<input type="hidden" id="year" name="year" value="<?php echo $year?>">
<input type="hidden" id="trans" name="trans" value="<?php echo $trans?>">
<input type="hidden" id="color" name="color" value="<?php echo $color?>">

<input type="hidden" id="g_rate" name="g_rate" value="<?php echo $g_rate;?>">
<input type="hidden" id="rbi" name="rbi" value="<?php echo $rbi1?>">
<input type="hidden" id="rpd" name="rpd" value="<?php echo $rpd?>">
<input type="hidden" id="usage" name="usage" value="<?php echo $usage?>">
<input type="hidden" id="provider" name="provider" value="<?php echo $provider?>">
<input type="hidden" id="fmv" name="fmv" value="<?php echo $fmv;?>">
				<table class="table">
					<tr>
						<td><p style="font-weight: bolder; font-size: 12px;">Referrence:<u>  <?php echo $unique;?><input type="hidden" name="tracking_no" id="tracking_no" value="<?php echo $unique;?>"></u></p></td>
						<td><p style="font-weight: bolder; font-size: 12px;">RMO Name: <?php echo $row['firstname'];?> <?php echo $row['middlename_suffix'];?>. <?php echo $row['lastname'];?><input type="hidden" name="id" id="id" value="<?php echo $row['agentt_id']?>"></p></td>
					</tr>
					<tr>
						<td><p style="font-weight: bolder; font-size: 12px;">Plate No: <?php echo $p_no?><input type="hidden" name="plateno" id="plateno" value="<?php echo $p_no?>"></p></td>
						<td><p style="font-weight: bolder; font-size: 12px;">Date: <?php date_default_timezone_set('Asia/Manila'); echo date("F j, Y");?><input type="hidden" id="date" name="date" value="<?php date_default_timezone_set('Asia/Manila'); echo date("F j, Y");?>"></p></td>
					</tr>
					<tr>
						<td><p style="font-weight: bolder; font-size: 12px;">Contact No: <?php echo $mycon?><input type="hidden" name="contact" value="<?php echo $mycon?>" id="contact"></p></td>
						<td></td>
					</tr>
				</table>
						<div class="col-sm-12">
							<div class="col-sm-12">
								<center><img src="../assets/images/upnext.png" style="width: 60%;"></center>
							</div>
							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">SUBJECT</p>
								<p style="font-size: 11px;">AUTOMOBILE PROPOSAL FOR <i style="color: red; font-weight: bold;"><?php echo $make;?> | <?php echo $model;?></i></p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">Dear <?php echo $namex;?> <input type="hidden" name="namex" id="namex" value="<?php echo $namex;?>"></p>
								<p style="font-size: 11px; text-indent: 20px;" align="justify">It is a great pleasure that we were given a chance to quote on your <i style="color: red; font-weight: bold;"><?php echo $make;?> | <?php echo $model;?></i>  requirements, as such please refer to our indicative and no-binding premium quotation.</p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">INSURER </p>
								<p style="font-size: 11px;"><i style="color: red; font-weight: bold;"><?php echo $provider?></i></p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">DEDUCTIBLE </p>
								<p style="font-size: 11px;">3,000 PER ACCIDENT ON SUV / AUV</p>
								<p style="font-size: 11px;">2,000 PER ACCIDENT ON SEDAN</p>
							</div>
							
							<table class="table table-bordered">
								<thead>
									<tr>
										<th><center><p style="font-size: 11px;color: #000">COVERAGE</p></center></th>
										<th><center><p style="font-size: 11px;color: #000">LIMITS OF LIABILITY</p></center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><p style="font-size: 11px; color: #000">OWN DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($fmv,2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">THEFT AND LOSS</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($fmv,2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">ACTS OF NATURE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($fmv,2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">EXCESS BODILY DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($rbi,2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">PROPERTY DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($rpd,2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">PERSONAL ACCIDENT</p></td>
										<td><p style="font-size: 11px; color: #000">₱ 250,000.00</p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">ONE TIME PAYMENT(CASH)</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($gross,2);?><input type="hidden" name="gross" id="gross" value="<?php echo number_format($gross,2);?>"></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">3 MONTHS PAYMENT(PDC) 0% Interest</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($m3,2);?><input type="hidden" name="three" id="three" value="₱ <?php echo number_format($m3,2);?>"></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">6 MONTHS PAYMENT(PDC) 0% Interest</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($m6,2);?><input type="hidden" name="six" id="six" value="₱ <?php echo number_format($m6,2);?>"></p></td>
									</tr>
								</tbody>
							</table>
							<div class="col-sm-12">

								<div class="text-right p-t-8 p-b-31"></div>
									<div class="container-login100-form-btn">
										<div class="wrap-login100-form-btn">
											<div class="login100-form-bgbtn"></div>
											<button type="login_button" class="login100-form-btn" id="submit_quote">
												<p style="color: black; font-weight: bolder; font-size: 17px;">SAVE</p>
											</button>
										</div>
									</div>
							</div>
</form>
								<div class="text-right p-t-8 p-b-31"></div>
									<div class="container-login100-form-btn">
										<div class="wrap-login100-form-btn">
											<div class="login100-form-bgbtn"></div>
											<a style="text-decoration: none;" href="index.php"><button type="login_button" class="login100-form-btn" id="backbtn">
												<p style="color: black; font-weight: bolder; font-size: 17px;">BACK TO MAIN MENU</p>
											</button></a>
										</div>
									</div>
							</div>
							<?php include'../templates/signature.php';?>
						</div>
			</div>
		</div>
	</div>
	<script src="../script/main.js"></script>
	<script>


		$("#submit_quote").click(function(event){
			event.preventDefault();
			var form = $('#getquote').serialize();
			var id1 = "id";
			var make = $("#make").val();
			var variant = $("#variant").val();
			var model = $("#model").val();
			var year = $("#year").val();
			var color = $("#color").val();
			var trans = $("#trans").val();
			var g_rate = $("#g_rate").val();
			var rbi = $("#rbi").val();
			var rpd = $("#rpd").val();
			var usage = $("#usage").val();
			var provider = $("#provider").val();
			var tracking_no = $("#tracking_no").val();
			var id = $("#id").val();
			var plateno = $("#plateno").val();
			var date = $("#date").val();
			var contact = $("#contact").val();
			var namex = $("#namex").val();
			var gross = $("#gross").val();
			var fmv = $("#fmv").val();
			var three = $("#three").val();
			var six = $("#six").val();
			$.ajax({				
			type : 'POST',
			url  : 'quote_form/php_function/save_quote.php',
			data : {form:form,id:id,make:make,variant:variant,model:model,year:year,color:color,trans:trans,g_rate:g_rate,rbi:rbi,rpd:rpd,usage:usage,provider:provider,tracking_no:tracking_no,plateno:plateno,date:date,contact:contact,namex:namex,gross:gross,fmv:fmv,three:three,six:six},
			dataType: "json",
			success : function(data){
			if (data.ok == "ok") {
				$("#submit_quote").html('<img src="assets/images/ajax-loader.gif" width="80" /> &nbsp; Please Wait...');
				setTimeout(4000,swal("Save !","", "success").then(okay => {
                            if (okay) {
                            window.location.href = "index.php";
                            }
                        }));
			}else{
				alert("error");
			}					
															
			}
			});
		});
	</script>
	<script>
		function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1000);
  setTimeout(' window.location.href = "logout.php"; ',1000);
}
	</script>
	