<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
	$db->connect();
 	$fa = $_POST['center'];
	$ta = $_POST['c1'];
	$Query = "SELECT * FROM  ".TBL_RATES;
	if($db->query($Query) && $db->get_num_rows() > 0)
	{
		$rates = $db->fetch_all_assoc();
	}
	$price_per_mile = $rates[0]['price_per_mile']; 
	$pickup_charges = $rates[0]['pickup_charges']; 
$from= $fa;
$to= $ta;
	$letters1 = array(' ','#');
	$replace1 = array('+','No');	
	$add1 = str_replace($letters1,$replace1,$from);
	$add2 = str_replace($letters1,$replace1,$to);
	$geocode1=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add1.'&sensor=false'); 
	$output1= json_decode($geocode1);  	
	$lat1 = $output1->results[0]->geometry->location->lat;  	
	$long1 = $output1->results[0]->geometry->location->lng; 		
	$geocode2=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add2.'&sensor=false'); 	
	$output2= json_decode($geocode2);  	
	$lat2 = $output2->results[0]->geometry->location->lat;  	
	$long2 = $output2->results[0]->geometry->location->lng;
//New code Usmania
	 	$dist = 'http://maps.google.com/maps/nav?q=from:'.$lat1.','.$long1.'%20to:'.$lat2.','.$long2.'';
		$data = @file_get_contents($dist);
		$result = explode(',', $data);
		//print_r($result);
		for($i=0; $i<count($result); $i++){
			if (preg_match('/Distance/', $result[$i] )){
				 $required = $result[$i]; break; 
				 }
		}
		$required; 
		$kholo =explode(':',$required);
		$mile_hisa = $kholo[2];
		$miles = round(($mile_hisa * 0.000621371192), 2);
	$cost = ($price_per_mile * $miles) + $pickup_charges;
	$smarty->assign("from",$fa);
	$smarty->assign("to",$ta);
	$smarty->assign("miles",$miles);
	$smarty->assign("pickup_charges",$pickup_charges);
	$smarty->assign("price_per_mile",$price_per_mile);
	$smarty->assign("cost",$cost);
	
$smarty->display('rpaneltpl/calculate_rate.tpl');
?>