<?php
include '../../dbcon.php';
// Check connection
if(isset($_POST["action"]))
{ 
 $output = '';
 //get Model
 if($_POST["action"] == "major_area")
 {
  $query = "SELECT MODEL FROM afmv WHERE MAKE = '".$_POST["query"]."' GROUP BY MODEL";
  $result = mysqli_query($conn, $query);
  $output .= '<option value="">--Select Model--</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["MODEL"].'">'.$row["MODEL"].'</option>';
  }
 }
//end get Model
 //get variant
 if($_POST["action"] == "city")
 {
  $query = "SELECT VARIANT FROM afmv WHERE MAKE = '".$_POST['major_area']."' && MODEL = '".$_POST["query"]."' GROUP BY VARIANT";
  $result = mysqli_query($conn, $query);
   $output .= "<option value=''>--Select Variant--</option>";
   
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["VARIANT"].'">'.$row["VARIANT"].'</option>';
  }
 }
//end get variant
//get yearmodel
 if($_POST["action"] == "zip_code")
 {
  $query = "SELECT YM FROM afmv WHERE MAKE = '".$_POST['major_area']."' && MODEL = '".$_POST["city"]."' && VARIANT = '".$_POST["query"]."' GROUP BY YM";
  $result = mysqli_query($conn, $query);
   $output .= "<option value=''>--Select Year Model--</option>";
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["YM"].'">'.$row["YM"].'</option>';
  }
 }
//end get yearmodel
//get transmission
  if($_POST["action"] == "YM")
 {
  $query = "SELECT TRANS FROM afmv WHERE MAKE = '".$_POST['major_area']."' && MODEL = '".$_POST["city"]."' && VARIANT = '".$_POST["zip_code"]."'&& YM ='".$_POST['query']."' GROUP BY TRANS";
  $result = mysqli_query($conn, $query);
   $output .= "<option value=''>--Select Transmission--</option>";
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["TRANS"].'">'.$row["TRANS"].'</option>';
  }
 }
//end get transmission
// get color
 if($_POST["action"] == "trans")
 {
  $query = "SELECT COLOR FROM afmv WHERE MAKE = '".$_POST['major_area']."' && MODEL = '".$_POST["city"]."' && VARIANT = '".$_POST["zip_code"]."'&& YM ='".$_POST['YM']."' && TRANS = '".$_POST['query']."' GROUP BY COLOR";
  $result = mysqli_query($conn, $query);
   $output .= "<option value=''>--Select COLOR--</option>";
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["COLOR"].'">'.$row["COLOR"].'</option>';
  }
 }
//end get color
// get other features
 if($_POST["action"] == "color")
 {
  $query = "SELECT OF FROM afmv WHERE MAKE = '".$_POST['major_area']."' && MODEL = '".$_POST["city"]."' && VARIANT = '".$_POST["zip_code"]."'&& YM ='".$_POST['YM']."' && TRANS = '".$_POST['trans']."' && COLOR = '".$_POST['query']."' GROUP BY OF";
  $result = mysqli_query($conn, $query);
   $output .= "<option value=''>--Select Other Feature--</option>";
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["OF"].'">'.$row["OF"].'</option>';
  }
 }
//end get other features
//display fmv
 if($_POST["action"] == "other")
 {
  $query = "SELECT FMV FROM afmv WHERE MAKE = '".$_POST['major_area']."' && MODEL = '".$_POST["city"]."' && VARIANT = '".$_POST["zip_code"]."'&& YM ='".$_POST['YM']."' && TRANS = '".$_POST['trans']."' && COLOR = '".$_POST['color']."'&& OF = '".$_POST['query']."' GROUP BY FMV";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["FMV"].'">'.$row["FMV"].'</option>';
  }
 }
 //end display fmv
 echo $output;
 json_encode($output);
}
?>