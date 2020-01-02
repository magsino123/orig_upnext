<?php
$sql = "SELECT * FROM user_quotes t1 INNER JOIN agent_list_tb t2 on t1.a_id = t2.agentt_id INNER JOIN afmv t3 on t1.fmv_id = t3.fmv_id where a_id = '".$_SESSION['id']."'";
$mysql = mysqli_query($conn,$sql)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($mysql)) {
$id = $row['id'];
$trackno = $row['tracking_no'];
$clientname = $row['client_name'];
$make = $row['MAKE'];
$variant = $row['VARIANT'];
$model = $row['MODEL'];
$date_created = $row['date_created'];
?>
<tr>
<td><a style="text-decoration: none;" href="display_quotation.php?n=<?php echo "$trackno" ?>"><center><?php echo $trackno;?><br><?php echo $make;?> | <?php echo $model;?> | <?php echo $variant;?><br><?php echo $clientname;?><br><?php echo $date_created;?></center></a></td>
</tr>
<?php
}
?>
