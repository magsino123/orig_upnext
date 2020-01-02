<?php
//include_once '../../../dbcon.php';

if(isset($_POST['MAKE']))
{
    $make = $_POST['MAKE'];
    $var = $_POST['VARIANT'];
    $model = $_POST['MODEL'];
    $rbi1 = $_POST['rbi'];
    $rpd1 = $_POST['rpd'];
    $year = $_POST['YM'];
    $color = $_POST['COLOR'];
    $aog = $_POST['AOG'];
    $fmv = $_POST['fmv'];
    $trans = $_POST['TRANS'];
    $rate = 0;
    $namex = $_POST['name'];
    $rate1 = 0;
    $usage = $_POST['usage'];
    $markup = 0;
    $p_no = $_POST['plate'];
    $mycon = $_POST['contact'];
    $provider = $_POST['provider'];
    $gross1 = $_POST['gross'];
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
    
    if($usage=="Private Use")
    {
        $frate = $rate;
        $result = mysqli_query($conn,"SELECT * FROM afmv WHERE MAKE='".$make."' AND MODEL='".$model."' AND VARIANT='".$var."' AND YM='".$year."' AND COLOR='".$color."' AND TRANS='".$trans."' ");
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
    }
    else if ($usage =="TNVS")
    {
        $frate = $rate1;
        $aon = 0.5/100;
    }
    if($aog=='NO')
    {
        $aon=0;
    }
    $output = array();
    $check = mysqli_query($conn,"SELECT * from user_quotes t1 inner join agent_list_tb t2 On t1.a_id = t2.agentt_id where a_id = t2.agentt_id and plate_no = '".$p_no."'");
     $roww = mysqli_fetch_array($check, MYSQLI_ASSOC);
      $name = $roww['firstname'];
      $lastname = $roww['lastname'];
      $middlename = $roww['middlename_suffix'];
      $premium = $roww['gross'];
      $response = array();
    if ($roww['plate_no'] == $p_no) {
        
        array_push($response,array("X"=>"1","Name"=>$name, "Lastname"=>$lastname,"Middlename"=>$middlename, "PREM"=>$premium));
        $validation['name'] = $name;
        $validation['PREM'] = $premium;
        $validation['lastname'] = $lastname;
        $validation['middlename'] = $middlename;
        $validation['auth'] = 'ok';

        echo json_encode($validation);
        //echo '<script>alert("0");</script>';
        
    }else{
    
    $frate = (int)$frate;
    $aog1 = $aon*$fmv;
    $frate = $frate/100;
    $ld = $fmv*$frate;
    $prem = $ld+$aog1+$ratebi+$ratepd;
    $dst = $prem*(12.5/100);
    $evat = $prem * (12/100);
    $lgt = $prem * (0.2/100);
    $gross = $prem+$dst+$evat+$lgt;
    
    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
    $gross = $gross + $markup;
    $unique = $today . $rand;
    
    $n_rate = preg_split("/[)]/", $_POST['gross'], -1, PREG_SPLIT_NO_EMPTY);
    $gross = $n_rate[1];
    $gross = str_replace( ',', '', $gross );
    $m3 = $gross/3;
    $m6 = $gross/6;
    $result = mysqli_query($conn,"SELECT * FROM gross_rate WHERE g_id='".$n_rate[0]."' ");
    while($row = mysqli_fetch_array($result))
    {
      $g_rate = $row['g_rate'];
    }
     
     // array_push($response,array("X"=>"2","MAKE"=>$make,"VAR"=>$var,"MODEL"=>$model,"YM"=>$year,"COLOR"=>$color,"rbi"=>"₱".$rbi1.".00","rpd"=>"₱".$rpd1.".00","TRANS"=>$trans,"FMV"=>"₱".number_format($_POST['fmv'],2),"AOG"=>"₱".number_format($aog1,2),"GROSS"=>$n_rate[1],"M3"=>"₱".number_format($m3,2),"M6"=>"₱".number_format($m6,2),"ref"=>$unique,"name"=>$namex,"usage"=>$usage,"RATE"=>$g_rate,"plate"=>$p_no,"contact"=>$mycon,"provider"=>$provider));
     // echo json_encode(array("server_response"=>$response));
    }
    
      
}
?>
