<?php
session_start();
include_once("../dbcon.php");
$user_check=$_SESSION['username'];
if (session_destroy()) {
	header("location:../index.php");
	//echo "<script>alert('Successfully Logout !'); window.location.href='../index.php';</script>";
	mysqli_query($conn,"update agent_list_tb set login_status = '0' where username = '".$user_check."'");
}
?>