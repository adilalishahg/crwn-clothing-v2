<?php
function getmiles($add1,$add2,$db,$mile_C){
	$Sl="SELECT miles FROM address WHERE TRIM(LOWER(REPLACE(pickaddress,' ','')))='".strtolower(trim(str_replace(' ','',$add1)))."' 
	AND  TRIM(LOWER(REPLACE(dropaddress,' ','')))='".strtolower(trim(str_replace(' ','',$add2)))."' AND miles > 0 ";
	if($db->query($Sl) && $db->get_num_rows() > 0){ 
		$data = $db->fetch_one_assoc(); $miles = round(($data['miles']),2);
	}else{
		$dt = round($mile_C->distance($add1,$add2),2); //echo 'select query'; exit;
		$up="INSERT INTO address SET pickaddress='".$add1."',dropaddress='".$add2."',miles='".$dt."',dated='".date('Y-m-d')."'";$db->execute($up);
		$miles = round(($dt),2);
	}
	return 	$miles;
}
function getmiles_times($add1,$add2,$db,$mile_C){
	$Sl="SELECT miles,meters,time_seconds FROM address_time_miles WHERE TRIM(LOWER(REPLACE(pickaddress,' ','')))='".strtolower(trim(str_replace(' ','',$add1)))."' 
	AND  TRIM(LOWER(REPLACE(dropaddress,' ','')))='".strtolower(trim(str_replace(' ','',$add2)))."' AND miles > 0 ";
	if($db->query($Sl) && $db->get_num_rows() > 0){ 
		$data = $db->fetch_one_assoc(); 
		return  array("distance"=>$data['meters'],"time"=>$data['time_seconds']);
	}else{
		$dt = $mile_C->distance2($add1,$add2,'',$db); 
		//print_r($dt); exit;
		$up="INSERT INTO address_time_miles SET pickaddress='".$add1."',dropaddress='".$add2."',miles='".($dt['distance']/1609.34)."',meters='".$dt['distance']."',time_seconds='".$dt['time']."',dated='".date('Y-m-d')."'";$db->execute($up);
	return $dt;
	}
}
?>

