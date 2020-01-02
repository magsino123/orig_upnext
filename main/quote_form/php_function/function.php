<?php 
// include '../../../dbcon.php';
// get brand
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$sql_department = "SELECT * FROM afmv GROUP BY MAKE";
$department_data = mysqli_query($conn,$sql_department);
while($row = mysqli_fetch_assoc($department_data) ){
    $departid = $row['fmv_id'];
    $depart_name = $row['MAKE'];
    echo "<option value='".$depart_name."' >".$depart_name."</option>";
}
?>

