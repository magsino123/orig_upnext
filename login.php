<?php
session_start();
include_once("dbcon.php");
if(isset($_POST['login_button'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT agentt_id,username, password FROM agent_list_tb WHERE username='$username' and password='$password' and login_status = '0'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_array($resultset);	
		
	if($row['username']==$username){				
		echo "ok";
		$_SESSION['username'] = $row['username'];
		$_SESSION['id'] = $row['agentt_id'];
		//update user status
		mysqli_query($conn,"update agent_list_tb set login_status = '1' where username = '$username'");

	} else {				
		echo "username or password does not exist or Account is Already in use !"; // wrong details 
	}		
}
?>