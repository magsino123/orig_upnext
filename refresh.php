<?php
if (isset($_POST['btn'])) {
  include 'dbcon.php';
  $refresh = $_POST['ref'];
  $sqll =  mysqli_query($conn,"SELECT username from agent_list_tb where username = '".$refresh."'");
  $roww = mysqli_fetch_array($sqll, MYSQLI_ASSOC);
  $username = $roww['username'];
  if ($username != $refresh) {
    //echo "<script>swal('Username not exists !');</script>";
   // echo "<script>alert('Username not exists !');  window.location = 'index.php';</script>";
    // echo '<script> swal("Successfully Refresh","", "success").then(okay => {
    //                         if (okay) {
    //                         window.location.href = "index.php";
    //                         }
    //                     });</script>';
  }else{
    $sql = mysqli_query($conn,"UPDATE agent_list_tb SET login_status = '0' where username = '".$refresh."'");
    //header("location:index.php");
    echo "<script>alert('Success !'); window.location = 'index.php';</script>";
  }
}
?>