<?php
   	//include_once('../DBAccess/Database.inc.php');
	$req_miles = '';
	if(isset($_POST['address1']) && isset($_POST['address2'])){
	$letters1 = array(' ','#');
	$replace1 = array('+','No');	
	$add1 = str_replace($letters1,$replace1,$_POST['address1']);
	$add2 = str_replace($letters1,$replace1,$_POST['address2']);
	/**/
	$geocode1	= file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add1.'&sensor=false'); 
	$output1	= json_decode($geocode1);  	
	$lat1 		= $output1->results[0]->geometry->location->lat;  	
	$long1 		= $output1->results[0]->geometry->location->lng; 		

	$geocode2   = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add2.'&sensor=false'); 	
	$output2	= json_decode($geocode2);  	
	$lat2 		= $output2->results[0]->geometry->location->lat;  	
	$long2 		= $output2->results[0]->geometry->location->lng;
	
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
		$req_miles = $miles;
		echo $req_miles;
		//echo 12;
		
		}
?>

		

