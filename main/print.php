<?php include'../templates/header.php';?>
<?php
session_start();
if(!isset($_SESSION['username'])&& !isset($_SESSION['id'])){
header("location:../index.php");
}
?>
<?php
include_once("../dbcon.php");
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
$unique = $today . $rand;
//-------------------------------------------------------------------------------//

//include 'quote_form/php_function/calculated.php';

$sql = "SELECT * FROM agent_list_tb WHERE username='".$_SESSION['username']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_array($resultset);

$track = $_GET['n'];
$query = mysqli_query($conn,"SELECT * FROM user_quotes t1 INNER JOIN agent_list_tb t2 on t1.a_id = t2.agentt_id INNER JOIN afmv t3 on t1.fmv_id = t3.fmv_id where tracking_no = '".$track."'")or die(mysqli_error($conn));
$row = mysqli_fetch_array($query);
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<body class="container-fluid">
	<div >
				<table class="table">
					<tr>
						<td><p style="font-weight: bolder; font-size: 10px;">Referrence:<u>  <?php echo $row['tracking_no'];?></u></p></td>
						<td><p style="font-weight: bolder; font-size: 10px;">RMO Name: <?php echo $row['firstname'];?> <?php echo $row['middlename_suffix'];?>. <?php echo $row['lastname'];?></p></td>
					</tr>
					<tr>
						<td><p style="font-weight: bolder; font-size: 10px;">Plate No: <?php echo $row['plate_no'];?></p></td>
						<td><p style="font-weight: bolder; font-size: 10px;">Date: <?php echo $row['date_created']?></p></td>
					</tr>
					<tr>
						<td><p style="font-weight: bolder; font-size: 10px;">Contact No: <?php echo $row['contact_no'];?></p></td>
						<td></td>
					</tr>
				</table>
						<div class="col-sm-12">
							<div class="col-sm-12">
								<center><img src="../assets/images/upnext.png" style="width: 60%; height: 100px; margin-top: -8%;"></center>
							</div>
							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">SUBJECT</p>
								<p style="font-size: 11px;">AUTOMOBILE PROPOSAL FOR <i  style="color: red; font-weight: bolder;"><?php echo $row['MAKE'];?> | <?php echo $row['MODEL'];?></i></p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">Dear <u><?php echo strtoupper($row['client_name']);?></u> </p>
								<p style="font-size: 11px; text-indent: 20px;" align="justify">It is a great pleasure that we were given a chance to quote on your <i style="color: red; font-weight: bold;"><?php echo $row['MAKE'];?> | <?php echo $row['MODEL'];?></i>  requirements, as such please refer to our indicative and no-binding premium quotation.</p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">INSURER </p>
								<p style="font-size: 11px;"><i style="color: red; font-weight: bold;"><?php echo $row['providers']?></i></p>
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
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($row['sum_insured'],2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">THEFT AND LOSS</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($row['sum_insured'],2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">ACTS OF NATURE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($row['sum_insured'],2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">EXCESS BODILY DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($row['rbi'],2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">PROPERTY DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($row['rpd'],2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">PERSONAL ACCIDENT</p></td>
										<td><p style="font-size: 11px; color: #000">₱ 250,000.00</p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">ONE TIME PAYMENT(CASH)</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo $row['one_time_payment'];?></p></td>
									</tr>
									<tr>
										<?php
											$onetime = str_replace(",", "", $row['one_time_payment']);
										  $t3 = $onetime / 3;
										  $onetime = str_replace(",", "", $row['one_time_payment']);
										  $t6 =  $onetime / 6;
										?>
										<td><p style="font-size: 11px; color: #000">3 MONTHS PAYMENT(PDC) 0% Interest</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($t3,2);?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">6 MONTHS PAYMENT(PDC) 0% Interest</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo number_format($t6,2);?></p></td>
									</tr>
								</tbody>
							</table>
				
</form>
<?php include'../templates/signature.php';?>
</div>
</div>
</body>