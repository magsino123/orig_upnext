<?php include'../../templates/header.php';?>
<?php
session_start();
if(!isset($_SESSION['username'])&& !isset($_SESSION['id'])){
header("location:../../index.php");
}
include_once("../../dbcon.php");
$sql = "SELECT * FROM agent_list_tb WHERE username='".$_SESSION['username']."'";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$row = mysqli_fetch_array($resultset);
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
		text-align: center;
		font-weight: bold;
		font-size: 11px;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/images/back1.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
<?php
include '../../dbcon.php';
$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
$unique = $today . $rand;


if(isset($_POST['MAKE']))
{
    $make = $_POST['MAKE'];
    $var = $_POST['VARIANT'];
    $model = $_POST['MODEL'];
    $rbi1 = $_POST['rbi'];
    $rpd1 = $_POST['rpd'];
    $year = $_POST['YM'];
    $color = $_POST['COLOR'];
    $aog = $_POST['AOG'];
    $fmv = $_POST['fmv'];
    $trans = $_POST['TRANS'];
    $rate = $_POST['rate'];
    $rate1 = $_POST['rate1'];
    $namex = $_POST['name'];
    $usage = $_POST['usage'];
    $markup = 0;
    $p_no = $_POST['plate'];
    $mycon = $_POST['contact'];
    $provider = $_POST['provider'];
    $rbi = str_replace( ',', '', $rbi1 );
    
    $rpd = str_replace( ',', '', $rpd1 );

    $result = mysqli_query($conn,"SELECT * FROM rate WHERE rate = $rbi AND cat_id='1'");
    while($row = mysqli_fetch_array($result))
    {
        $ratebi = $row['rbi'];
    }
    $result = mysqli_query($conn,"SELECT * FROM rate WHERE rate = $rpd AND cat_id='1'");
    while($row = mysqli_fetch_array($result))
    {
        $ratepd = $row['rpd'];
    }
    
    if($usage=="Private Use")
    {
        $frate = $rate;
        $result = mysqli_query($conn,"SELECT * FROM afmv WHERE MAKE='".$make."' AND MODEL='".$model."' AND VARIANT='".$var."' AND YM='".$year."' AND COLOR='".$color."' AND TRANS='".$trans."' ");
    while($row = mysqli_fetch_array($result))
    {
        $BT = $row['BT'];
    }
    if($BT=='SEDAN' || $BT =='HATCHBACK')
    {
        $aon = 0.5/100;
    }
    else
    {
        $aon = 0.3/100;
    }
    }
    else if ($usage =="TNVS")
    {
        $frate = $rate1;
        $aon = 0.5/100;
    }
    if($aog=='NO')
    {
        $aon=0;
    }
    $output = array();
    $check = mysqli_query($conn,"SELECT * from user_quotes t1 inner join agent_list_tb t2 On t1.a_id = t2.agentt_id where a_id = t2.agentt_id and plate_no = '".$p_no."'");
     $roww = mysqli_fetch_array($check, MYSQLI_ASSOC);
      $name = $roww['firstname'];
      $lastname = $roww['lastname'];
      $premium = $roww['gross'];
      $response = array();
    if ($roww['plate_no'] == $p_no) {
        array_push($response,array("X"=>"1","Name"=>$name, "PREM"=>$premium));
        echo json_encode(array("server_response"=>$response));
        
    }else{
    $frate = (int)$frate;
    $aog1 = $aon*$fmv;
    $frate = $frate/100;
    $ld = $fmv*$frate;
    $prem = $ld+$aog1+$ratebi+$ratepd;
    $dst = $prem*(12.5/100);
    $evat = $prem * (12/100);
    $lgt = $prem * (0.2/100);
    $gross = $prem+$dst+$evat+$lgt;
    
    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
    $gross = $gross + $markup;
    $unique = $today . $rand;
    
    $n_rate = preg_split("/[)]/", $_POST['gross'], -1, PREG_SPLIT_NO_EMPTY);
    $gross = $n_rate[1];
    $gross = str_replace( ',', '', $gross );
    $m3 = $gross/3;
    $m6 = $gross/6;
    $result = mysqli_query($conn,"SELECT * FROM gross_rate WHERE g_id='".$n_rate[0]."' ");
    while($row = mysqli_fetch_array($result))
    {
      $g_rate = $row['g_rate'];
    }
     
        array_push($response,array("X"=>"2","MAKE"=>$make,"VAR"=>$var,"MODEL"=>$model,"YM"=>$year,"COLOR"=>$color,"rbi"=>"₱".$rbi1.".00","rpd"=>"₱".$rpd1.".00","TRANS"=>$trans,"FMV"=>"₱".number_format($_POST['fmv'],2),"AOG"=>"₱".number_format($aog1,2),"GROSS"=>$n_rate[1],"M3"=>"₱".number_format($m3,2),"M6"=>"₱".number_format($m6,2),"ref"=>$unique,"name"=>$namex,"usage"=>$usage,"RATE"=>$g_rate,"plate"=>$p_no,"contact"=>$mycon,"provider"=>$provider));
    echo json_encode(array("server_response"=>$response));
    }
    
      
}
				?>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<p style="font-weight: bolder; font-size: 12px;">Referrence: <?php echo $unique;?></p>
							</div>
							<div class="col-sm-6">
								<p style=" font-weight: bolder; font-size: 12px;">RMO Name: <?php echo $row['firstname'];?> <?php echo $row['middlename_suffix'];?>. <?php echo $row['lastname'];?></p>
							</div>
							<div class="col-sm-6">
								<p style="font-weight: bolder; font-size: 12px;">Plate No: <?php echo $_POST['plate'];?></p>
							</div>
							<div class="col-sm-6">
								<p style=" font-weight: bolder; font-size: 12px;"><?php date_default_timezone_set('Asia/Manila'); echo date("F j, Y");?></p>
							</div>
							<div class="col-sm-12">
								<center><img src="../assets/images/upnext.png" style="width: 60%;"></center>
							</div>
							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">SUBJECT</p>
								<p style="font-size: 11px;">AUTOMOBILE PROPOSAL FOR <i style="color: red;"><?php echo $make;?> | <?php echo $model;?></i></p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">Dear </p>
								<p style="font-size: 11px; text-indent: 20px;" align="justify">It is a great pleasure that we were given a chance to quote on your <i style="color: red;"><?php echo $make;?> | <?php echo $model;?></i>  requirements, as such please refer to our indicative and no-binding premium quotation.</p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">INSURER </p>
								<p style="font-size: 11px;">STANDARD INSURER</p>
							</div>

							<div class="col-sm-12">
								<p style="font-size: 12px; font-weight: bolder;">DEDUCTIBLE </p>
								<p style="font-size: 11px;">3,000 PER ACCIDENT ON SUV / AUV</p>
								<p style="font-size: 11px;">2,000 PER ACCIDENT ON SEDAN</p>
							</div>
							
							<table class="table">
								<thead>
									<tr>
										<th><center><p style="font-size: 11px;color: #000">COVERAGE</p></center></th>
										<th><center><p style="font-size: 11px;color: #000">LIMITS OF LIABILITY</p></center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><p style="font-size: 11px; color: #000">OWN DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000"><span>&#8369;</span> <?php echo number_format($fmv,2) ?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">THEFT AND LOSS</p></td>
										<td><p style="font-size: 11px; color: #000"><span>&#8369;</span> <?php echo number_format($fmv,2) ?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">ACTS OF NATURE</p></td>
										<td><p style="font-size: 11px; color: #000"><span>&#8369;</span> <?php echo number_format($fmv,2) ?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">EXCESS BODILY DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo $_POST['rbi'];?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">PROPERTY DAMAGE</p></td>
										<td><p style="font-size: 11px; color: #000">₱ <?php echo $_POST['rpd'];?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">PERSONAL ACCIDENT</p></td>
										<td><p style="font-size: 11px; color: #000">₱ 250,000.00</p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">ONE TIME PAYMENT(CASH)</p></td>
										<td><p style="font-size: 11px; color: #000">asd</p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">3 MONTHS PAYMENT(PDC) 0% Interest</p></td>
										<td><p style="font-size: 11px; color: #000"><?php echo $m3?></p></td>
									</tr>
									<tr>
										<td><p style="font-size: 11px; color: #000">6 MONTHS PAYMENT(PDC) 0% Interest</p></td>
										<td><p style="font-size: 11px; color: #000"><?php echo $m6?></p></td>
									</tr>
								</tbody>
							</table>
							<div class="col-sm-12">
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
						</div>
				
				<?php include'../../templates/signature.php';?>
			</div>
		</div>
	</div>
	<script src="../../script/main.js"></script>
