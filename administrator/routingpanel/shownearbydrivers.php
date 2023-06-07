<?php



   	include_once('../DBAccess/Database.inc.php');

	$db = new Database;	



    $msgs = '';



	$noRec = '';



	$PickupAddress = $_POST['PickupAddress'];



	$db2 = new Database;	



    



	$db->connect();



	$db2->connect();



	$today=date('Y-m-d');



		  $pday = date("Y-m-d",strtotime("-1 day"));



	$mydrivers = array();	

$driversids = array();





	$drvQuery = "SELECT  fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus ='Active' ORDER BY  fname ASC";



	if($db->query($drvQuery) && $db->get_num_rows() > 0)



		$drivers = $db->fetch_all_assoc();



	$getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0' ORDER BY  fname ASC";



 	if($db->query($getDriver) && $db->get_num_rows())



	{



		$driverdata = $db->fetch_all_assoc();



	}



	$ad='0';



	$getuser = "SELECT trip_user FROM trips WHERE trip_date = '$today' ORDER BY trip_user ASC";



 	if($db->query($getuser) && $db->get_num_rows())



	{



		$userdata = $db->fetch_all_assoc();



	}



	$getuser2 = "SELECT id,vehtype  FROM vehtype";



 	if($db->query($getuser2) && $db->get_num_rows())



	{



		$userdata2 = $db->fetch_all_assoc();



	}



	$g2 = "SELECT id,account_name  FROM accounts ORDER BY account_name ASC";



 	if($db->query($g2) && $db->get_num_rows() > 0)



	{	$accounts = $db->fetch_all_assoc();	}



	 $st_time	= date("H:i:s");



	 $end_time 	= date("H:i:s", strtotime("+45 minutes",strtotime($st_time))); 



	 $j=0;



	 $Dr = "SELECT Drvid,lat,longt,drv_code,fname,lname FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0' AND login_status ='1' AND clockstatus='in' ORDER BY  fname ASC";



 	if($db->query($Dr) && $db->get_num_rows())



	{



		$driverdata2 = $db->fetch_all_assoc();



	}



	for($i=0;$i<sizeof($driverdata2);$i++){ $ohno = '';



	 $Qs="SELECT * FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND pck_time BETWEEN '".$st_time."' AND '".$end_time."'";	



	 if($db->query($Qs) && $db->get_num_rows() > 0){$ohno = '1';}



	 $Qs2="SELECT * FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND drp_time BETWEEN '".$st_time."' AND '".$end_time."'";	



	 if($db->query($Qs2) && $db->get_num_rows() > 0){$ohno = '1';}



 $Qs3="SELECT * FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND status IN ('6','10')";	



	 if($db->query($Qs3) && $db->get_num_rows() > 0){$ohno = '1';}



 $Qs4="SELECT * FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND status IN ('5') AND pck_time < '".$st_time."'";	



	 if($db->query($Qs4) && $db->get_num_rows() > 0){$ohno = '1';}





	 	 



	 if(!empty( $driverdata2[$j]['lat']) && !empty($driverdata2[$i]['longt']))

	 {

		 $freedrivers[$j]['driver']=$driverdata2[$i]['fname'].' '.$driverdata2[$i]['lname'].' -- '.$driverdata2[$i]['drv_code']; 

	 

	 $mydrivers[$j] = $driverdata2[$j]['lat'].",".$driverdata2[$i]['longt'];

	 $driversids[$j] = $driverdata2[$j]['Drvid'];

	 $j++;

	 }

	 



		}



	//echo $st11;

	$url = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.urlencode(implode('|',$mydrivers)).'&destinations='.urlencode($PickupAddress).'&mode=driving&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw';

	

	 $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //curl_setopt($ch, CURLOPT_PROXYPORT, 3128);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $response = curl_exec($ch);

    curl_close($ch);

    $response_a = json_decode($response);

	//print_r($response_a);

	$arrayofFinalDrivers = array();

	//$count = 0;

	//if(!empty($arrayofFinalDrivers)){

	foreach($response_a->origin_addresses as $iterator => $driveraddress)

	{

		$userid = $driversids[$iterator];

		$arrayofFinalDrivers[$userid]['DriverLocation'] = $driveraddress;

		$arrayofFinalDrivers[$userid]['Pickuplocation'] = $PickupAddress;

		$arrayofFinalDrivers[$userid]['Duration'] = $response_a->rows[$iterator]->elements[0]->duration->value;

		$arrayofFinalDrivers[$userid]['Distance'] = $response_a->rows[$iterator]->elements[0]->distance->value;

	}//}

	

	

	//print_r($response_a);



	// print_r($arrayofFinalDrivers);//exit;



	$db->close();



	$db2->close();



    $pgTitle = "Admin Panel -- Routing Panel";



	

	/*$smarty ->assign("freedrivers",$freedrivers);

	

	$smarty ->assign("arrayofFinalDrivers",$arrayofFinalDrivers);

$smarty ->assign("driversids",$driversids);

	$smarty->assign("pgTitle",$pgTitle);



	$smarty->assign("accounts",$accounts);

	$smarty->assign("NoRecord",$noRec);	



	

	

	$smarty->display('rpaneltpl/shownearbydriver.tpl');*/



?><br />

<div style="float:right" ><button type="button" onclick="$('#my_frame').addClass('hide');">Close</button></div><br />

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="center" bgcolor="#FFFFFF">



  <tr>

    <td>

    <table id="table_id" class="display">

    <thead>

        <tr>

            <th>Driver id</th>

            <th>Driver Name</th>

            <th>Driver Location</th>

            <th>Pickup Address</th>

            <th>Distance(Miles)</th>

            <th>Duration</th>

        </tr>

    </thead>

    <tbody>

     <?php

	 if(!empty($freedrivers)){

	 

	  foreach($freedrivers as $iterator=>$fdrivers){?>

     

        <tr>

            <td><?=$driversids[$iterator]?></td>

            <td><?=$freedrivers[$iterator]['driver']?></td>

            

            <td><?=$arrayofFinalDrivers[$driversids[$iterator]]['DriverLocation']?></td>

           

            <td><?=$arrayofFinalDrivers[$driversids[$iterator]]['Pickuplocation']?></td>

            <td><?=number_format($arrayofFinalDrivers[$driversids[$iterator]]['Distance'] * 0.000621371,2)?></td>

            <td><?=gmdate("H:i:s", $arrayofFinalDrivers[$driversids[$iterator]]['Duration'])?></td>

        </tr>

        <?php } }?>

        

    </tbody>

</table>

    </td>

  </tr>

</table>

