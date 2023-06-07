<?php
require_once('../DBAccess/Database.inc.php');
include_once('../../Classes/array_sorter.php');
ini_set('max_execution_time', 10000); 
$db = new Database;	
$db->connect();
$today= date('Y-m-d');
//$noftrips = $_POST['noftrips'];
$noftrips = $_GET['noftrips'];
//if($noftrips>4) { $noftrips = 4; }
$do = '0';
$U = 1;
function multi_sort(&$array, $key, $asc=true)
	{
	$sorter = new array_sorter($array, $key, $asc);
	return $sorter->sortit();
	unset($sorter);
}
if($noftrips > 0){ //Start 0
for($n=0; $n<$noftrips; $n++){ //Start 1

$Qearynexttrip="SELECT tdid,pck_time,drp_time,pick_latlong,drop_latlong FROM trip_details WHERE date = '$today' AND drv_id = '' AND wc = '0' ORDER BY pck_time ASC LIMIT 1";
if($db->query($Qearynexttrip) && $db->get_num_rows() > 0){ //St 2
	$tripdata 						= $db->fetch_one_assoc();
	$pick_time 						= $tripdata['pck_time'];
	list($hours, $minutes, $seconds)= explode(":",$pick_time);
	$pick_time_in_seconds 			= ($hours*3600+$minutes*60+$seconds);
	$pick_coordinates 				= explode(',',$tripdata['pick_latlong']);
	$drv_latlong  					= $tripdata['drop_latlong'];
	$tdid 		  					= $tripdata['tdid'];
	$free_from	  					= $tripdata['drp_time'];

	
	 echo $Queryfreedriver="SELECT * FROM free_driver WHERE at_date = '$today' AND free_from < '$pick_time'";
	if($db->query($Queryfreedriver) && $db->get_num_rows() > 0){ //St 3
	$freedriversdata = $db->fetch_all_assoc();
	$x= 0;
	for($i=0; $i<sizeof($freedriversdata); $i++){ //ST 4
			$drv_coordinate = explode(',',$freedriversdata[$i]['drv_latlong']);
			$q = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$drv_coordinate[0].",".$drv_coordinate[1]."&destinations=".$pick_coordinates[0].','.$pick_coordinates[1]."&mode=driving&sensor=false";
			$json 				= file_get_contents($q);
			$details 			= json_decode($json, TRUE);   
			if($details['status'] == 'OK'){ //Start 5
			$distance_in_meter 	= $details['rows'][0]['elements'][0]['distance']['value'];
			$time_in_second 	= $details['rows'][0]['elements'][0]['duration']['value']; 
			
			$updated_freedriversdata[$x]['distance'] 			= $distance_in_meter;  
			//$freedriversdata[$i]['distance'] 			= $distance_in_meter; 
			list($hours1, $minutes1, $seconds1) 				= explode(":", $freedriversdata[$i]['free_from']);
			$updated_freedriversdata[$x]['can_reach_seconds']	=($time_in_second+($hours1*3600+$minutes1*60+$seconds1));
			$updated_freedriversdata[$x]['pick_time_in_seconds']= $pick_time_in_seconds;
			$updated_freedriversdata[$x]['drv_code']			= $freedriversdata[$i]['drv_code'];
			 if(($U%10) == 0) { sleep(1); }
			 $x++; 
			  } // End 5
			 $U++;
			} // End 4
			if(sizeof($updated_freedriversdata) > 0){ //Start 6
			$y = 0;
			for($j=0; $j<sizeof($updated_freedriversdata); $j++){ //Start 7
			if($updated_freedriversdata[$j]['pick_time_in_seconds'] > $updated_freedriversdata[$j]['can_reach_seconds']){
			$required_drivers[$y]['drv_code']			= $updated_freedriversdata[$j]['drv_code'];
			$required_drivers[$y]['distance']			= $updated_freedriversdata[$j]['distance'];
			$y++; } 
			} //End 7
			$refinedriver = multi_sort($required_drivers, "distance", false);
			$drv_code_USS = $refinedriver[0]['drv_code'];
			$Qassigndriver= "UPDATE trip_details SET drv_id = '$drv_code_USS' WHERE tdid = '$tdid' ";
			$Qupdatefreedriver = "UPDATE free_driver SET drv_latlong = '$drv_latlong', 
									free_from =  '$free_from' WHERE drv_code = '$drv_code_USS' ";
								$db->execute($Qassigndriver);
								$db->execute($Qupdatefreedriver); 
								$do = '1'; 
			}else{ $Querynonassign= "UPDATE trip_details SET drv_id = '000000' WHERE tdid = '$tdid'";
	 $db->execute($Querynonassign);   $do = '1';    } //End 6
	echo '<br /><br /> Trip detail <br /><br />';  print_r($tripdata); 
	echo '<br /><br /> Selected Driver <br /><br />';  print_r($freedriversdata);  
	echo '<br /><br /> Updated Drivers <br /><br />';  print_r($updated_freedriversdata);  
	echo '<br /><br /> Only required driver <br /><br />';  print_r($required_drivers); 
	echo '<br /><br /> order in driver <br /><br />';  print_r($refinedriver);    
	} else { $Querynonassign= "UPDATE trip_details SET drv_id = '000000' WHERE tdid = '$tdid'";
	 $db->execute($Querynonassign);   $do = '1';    }//St 3

} //End 2

} //End 1
} //End 0


 echo $do; 
 exit;
?>