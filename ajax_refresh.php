<?php
include 'dbcon.php';
if (isset($_POST['ref'])) {
	$ref = $_POST['ref'];
	$sqll =  mysqli_query($conn,"SELECT username from agent_list_tb where username = '".$ref."'");
	$row = mysqli_fetch_array($sqll);	
	$username = $row['username'];
	$response = array();
	if ($username == $ref) {
			array_push($response,array("username"=>$username));
			$validate['user'] = $username;
			$validate['auth'] = 'pwede';
			echo json_encode($validate);
	}else{
			$ok['ok'] = 'exists';
			echo json_encode($ok);
	}
}
?>