<?php
include_once('DBAccess/Database2.inc.php');
$db = new Database;	
$db->connect();
$sqlTime = "SELECT * FROM ".TBL_CONTACT;
if($db->query($sqlTime) && $db->get_num_rows() > 0){
	$rcTime = $db->fetch_one_assoc();
}
@date_default_timezone_set($rcTime['time_zone']);


$currentDate = date('Y-m-d');
$sqlCountTrips = "select tdid from trip_details where date='".$currentDate."' and status NOT IN('1','3','4','7','8')";
$totalTrips=0;
if($db->query($sqlCountTrips) && $db->get_num_rows() > 0){
	$totalTrips = $db->get_num_rows();
}
$totalTripsArray = array('open_run'=>$totalTrips);
//print_r($totalTripsArray);
echo $totalTripsArray['open_run'];
?>