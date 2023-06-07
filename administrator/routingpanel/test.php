<?php
include_once('../DBAccess/Database.inc.php');
 
 
 	$db = new Database;	
	$db->connect();
	$limit = "10";
		
	$data = get_server_time();
	$time = $data[0];
	$date = $data[1];
	
	echo"<br>";								  
	echo $curdate = $date;
	echo"<br>"; 
	echo $curtime =  $time; 
	echo"<br>"; 
//	echo $endtime = date("H:i:s", strtotime("+$limit minutes".$time));
	
	$str = '';
	/*$sQuery = "SELECT tdid 
						  FROM ".TBL_TRIP_DET." 
						  WHERE date = '$curdate' AND status = '5' AND drp_ptime  BETWEEN '$curtime'                          AND '$endtime' ORDER by drp_ptime";*/
						  
					echo $sQuery = "SELECT tdid 
						  FROM ".TBL_TRIP_DET." 
						  WHERE date = '$curdate' AND status IN ('5','2','0') AND pck_time < '$curtime' AND wc='0' AND pickStatus = '0' ORDER by pck_ptime ASC";
	/*$sQuery = "SELECT tdid 
						  FROM ".TBL_TRIP_DET." 
						  WHERE date = '$curdate' AND status = '0' ORDER by drp_ptime";*/
	if($db->query($sQuery) && $db->get_num_rows() > 0)
	{
		echo $db->get_num_rows();
		$trips =  $db->fetch_all_assoc(); 
	}
	for($i = 0;$i<sizeof($trips);$i++)
	{
		$str  .= '^'.$trips[$i]['tdid'];
 	}
	echo $str;
	exit;
?>