<?php
if (isset($_POST['MAKE'])) {
	include '../../../dbcon.php';
	$fmv_res['rate'] = array();
	$fmv = $_POST['fmv'];
	$usage = $_POST['usage'];
	$aog = $_POST['AOG'];
	$rbi1 = $_POST['rbi'];
	$rpd1 = $_POST['rpd'];
	$sagot['sagot'] = '';
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
      //$frate = $rate;
      $result = mysqli_query($conn,"SELECT * FROM afmv WHERE MAKE='".$_POST['MAKE']."' AND MODEL='".$_POST['MODEL']."' AND VARIANT='".$_POST['VARIANT']."' AND YM='".$_POST['YM']."' AND COLOR='".$_POST['COLOR']."' AND TRANS='".$_POST['TRANS']."' ");
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
  
  
  if($aog=='NO')
  {
      $aon=0;
  }
  
      $i = 1;
      $query = mysqli_query($conn,"SELECT * FROM gross_rate ");
      while ($rows = mysqli_fetch_array($query)) {
          
          if ($rows) {
          
          $rate = $rows["g_rate"];
          $aog1 = $aon*$fmv;
          $frate = $rate/100;
          $ld = $fmv*$frate;
          $prem = $ld+$aog1+$ratebi+$ratepd;
          $dst = $prem*(12.5/100);
          $evat = $prem * (12/100);
          $lgt = $prem * (0.2/100);
          $gross = $prem+$dst+$evat+$lgt;
          $temp = array();
          $gross = number_format($gross,2);
          $temp["rate"] = $i.".) ".$gross;
          array_push($fmv_res["rate"], $temp);
          }else{

          }
          $sagot['sagot'] .= "<option>".$temp["rate"] = $i.".) ".$gross."</option>"  ;
					$i++;
    } 
     echo json_encode($sagot); 					   					
}    
?>
