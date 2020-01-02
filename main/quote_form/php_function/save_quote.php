<?php
	if (isset($_POST['tracking_no'])) {
		include '../../../dbcon.php';

		$make = $_POST['make'];
		$var = $_POST['variant'];
		$model = $_POST['model'];
		$year = $_POST['year'];
		$trans = $_POST['trans'];
		$color = $_POST['color'];
		$tracking_no = $_POST['tracking_no'];
		$a_id = $_POST['id'];
		$plateno = $_POST['plateno'];
		$date = $_POST['date'];
		$contact = $_POST['contact'];
		$namex = $_POST['namex'];
		$gross = $_POST['gross'];
		$g_rate = $_POST['g_rate'];
		$rbi = $_POST['rbi'];
		$rpd = $_POST['rpd'];
		$usage = $_POST['usage'];
		$provider = $_POST['provider'];
		$fmv = $_POST['fmv'];
		$fmv = $fmv;
		$aog = '';
		$three = '';
		$six = '';
		$response = array();

		$result = mysqli_query($conn,"SELECT * FROM afmv WHERE MAKE='".$make."' AND MODEL='".$model."' AND VARIANT='".$var."' AND COLOR='".$color."' AND TRANS='".$trans."' AND YM='".$year."'");

		while ($row = mysqli_fetch_array($result)) {
			$fmv_id = $row['fmv_id'];
		}

		$result1 = mysqli_query($conn,"INSERT INTO user_quotes ( `tracking_no`, `aog`, `gross`, `fmv_id`, `rbi`, `rpd`, `client_name`, `markup`, `date_created`, `a_id`,`car_usage`,`sum_insured`,`a_type`,`plate_no`,`contact_no`,`providers`, `one_time_payment`,`proposal_status`) VALUES ('".$tracking_no."','".$aog."','".$gross."','".$fmv_id."','".$rbi."','".$rpd."','".$namex."','".$g_rate."','".$date."','".$a_id."','".$usage."','".$fmv."','upnext','".$plateno."','".$contact."','".$provider."','".$gross."','')");

		if($result)
    {
    	$ok['ok']="ok";
    	echo json_encode($ok);
    }else{
    	$error['error'] = "Not Save !";
    }
}
?>