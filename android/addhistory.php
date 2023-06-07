<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
	$qtime = $db->query('SELECT NOW() AS tym');
	$get = $db->fetch_one_assoc();
	$currenttime = $get['tym'];
	echo $time1 = date("H:i",strtotime($currenttime));
	$drv_code = $_GET['driverID'];
 $query = "SELECT datetime FROM trackinghistory WHERE driver_code = '$drv_code' ORDER BY id DESC LIMIT 1 ";
 if($db->query($query) && $db->get_num_rows()> 0) { $timearray = $db->fetch_one_assoc(); 
echo  $time2 = date("H:i",strtotime($timearray['datetime']));
if($time1 !== $time2){
	$lat 		= sql_replace($_GET['latitude']);
	$lang 		= sql_replace($_GET['longitude']);	
	$queryA = "INSERT  trackinghistory SET lat = '$lat', lang = '$lang', driver_code ='$drv_code' "; 
	$db->execute($queryA);
	
	}
 }
 
/*
  $jsonarray['status'] = 'true';
   echo json_encode($jsonarray);*/
$db->close();
?>