<?php
include '../../../dbcon.php';
if (isset($_POST['plate'])) {
	$p_no = $_POST['plate'];
	//$p_no = "WHO 149";
	$select = "SELECT * FROM user_quotes t1 INNER JOIN agent_list_tb t2 on t1.a_id = t2.agentt_id where plate_no = '".$p_no."'";
	$query = mysqli_query($conn,$select)or die(mysqli_error($conn));

	$row = mysqli_fetch_array($query);	
	$platenumber = $row['plate_no'];
	$name = $row['firstname'];
	$lastname = $row['lastname'];
	$middlename = $row['middlename_suffix'];
	$premium = $row['gross'];
	$response = array();
		if ($platenumber == $p_no) {
				array_push($response,array("X"=>"1","Name"=>$name, "Lastname"=>$lastname,"Middlename"=>$middlename, "PREM"=>$premium));
				$validation['name'] = $name;
        $validation['PREM'] = $premium;
        $validation['lastname'] = $lastname;
        $validation['middlename'] = $middlename;
        $validation['auth'] = 'exist';
        echo json_encode($validation);
		}
		else{
			$ok['ok'] = 'pwede';
			echo json_encode($ok);
		}
}
?>