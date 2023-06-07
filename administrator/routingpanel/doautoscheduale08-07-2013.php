<?php
require_once('../DBAccess/Database.inc.php');
include_once('../../Classes/array_sorter.php');
ini_set('max_execution_time', 10000); 
	$db = new Database;	
	$db->connect();
	    $today= date('Y-m-d');
		$noftrips = $_POST['noftrips'];
		//$noftrips = $_GET['noftrips'];
		if($noftrips>4) { $noftrips = 4; }
	$do = '0';
	$U = 1;
			function multi_sort(&$array, $key, $asc=true)
			{
			$sorter = new array_sorter($array, $key, $asc);
			return $sorter->sortit();
			unset($sorter);
			}
			if($noftrips != ''){
	for($n=0; $n<$noftrips; $n++){
	$Qearltrip="SELECT tdid,pck_time,pick_latlong,drop_latlong,drp_time FROM trip_details WHERE date = '$today' AND drv_id = '' AND wc = '0' ORDER BY pck_time ASC LIMIT 1";
	if($db->query($Qearltrip) && $db->get_num_rows() > 0){  $tripdata = $db->fetch_one_assoc();  
	$pick_time = $tripdata['pck_time'];
	list($hours, $minutes, $seconds) = explode(":",$pick_time);
	$pick_time_in_seconds = ($hours*3600+$minutes*60+$seconds);
	$pick_aghatti_coordinates = explode(',',$tripdata['pick_latlong']);
	
	$Qfreedriver="SELECT * FROM free_driver WHERE at_date = '$today' AND free_from < '$pick_time'";
	if($db->query($Qfreedriver) && $db->get_num_rows() > 0){  $freedriversdata = $db->fetch_all_assoc(); 
	
			for($i=0; $i<sizeof($freedriversdata); $i++){
			$aghaticoordinate = explode(',',$freedriversdata[$i]['drv_latlong']);
			$q = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$pick_aghatti_coordinates[0].",".$pick_aghatti_coordinates[1]."&destinations=".$aghaticoordinate[0].','.$aghaticoordinate[1]."&mode=driving&sensor=false";
			$json = file_get_contents($q);
			$details = json_decode($json, TRUE);
			$distance_in_meter = $details['rows'][0]['elements'][0]['distance']['value'];
			$miles = round(($distance_in_meter * 0.000621371192), 2); 
			$time_in_second = $details['rows'][0]['elements'][0]['duration']['value']; 
			$time_in_minutes = ($time_in_second/60);
			$freedriversdata[$i]['distance'] = $distance_in_meter; 
			//$freedriversdata[$i]['distance'] = $miles; 
			//$freedriversdata[$i]['travel_in_seconds'] = $time_in_second;
			list($hours, $minutes, $seconds) = explode(":", $freedriversdata[$i]['free_from']);
			$freedriversdata[$i]['can_reach_seconds']=($time_in_second+($hours*3600+$minutes*60+$seconds));
			$freedriversdata[$i]['pick_time_in_seconds'] = $pick_time_in_seconds;
			 if(($U%10) == 0) { sleep(1); } 
			 $U++;
			}
			for($k=0; $k<sizeof($freedriversdata); $k++){
				if($freedriversdata[$k]['pick_time_in_seconds'] > $freedriversdata[$k]['can_reach_seconds']){
					$refinedriver[$U]['drv_code'] = $freedriversdata[$k]['drv_code'];
					$refinedriver[$U]['distance'] = $freedriversdata[$k]['distance'];
					$do = '1'; 
					}
				} 
				 if($do=='1'){
							
							$refinedriver1 = multi_sort($refinedriver, "distance", false);
							$drv_code_USS = $refinedriver1[0]['drv_code'];
							$tdid 		  = $tripdata['tdid'];
							$drv_latlong  = $tripdata['drop_latlong'];
							$free_from	  = $tripdata['drp_time'];
								$Qassigndriver = "UPDATE trip_details SET drv_id = '$drv_code_USS' WHERE tdid = '$tdid' ";
								$Qupdatefreedriver = "UPDATE free_driver SET drv_latlong = '$drv_latlong', free_from =  '$free_from' WHERE drv_code = '$drv_code_USS' ";
								$db->execute($Qassigndriver);
								$db->execute($Qupdatefreedriver);
								
								}
					 }
	} } } 
 echo $do; 


?>