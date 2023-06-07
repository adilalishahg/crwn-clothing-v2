<?php
require_once('../DBAccess/Database.inc.php');
include_once('../../Classes/array_sorter.php');
ini_set('max_execution_time', 10000); 
$db = new Database;	
$db->connect();
$today = date("Y-m-d",strtotime("+1 day"));
$noftrips = $_POST['noftrips'];
//$noftrips = $_GET['noftrips'];
if($noftrips>6) { $noftrips = 6; }
 $do 		= 0;
 $U  		= 1;
function multi_sort(&$array, $key, $asc=true){
	$sorter = new array_sorter($array, $key, $asc);
	return $sorter->sortit();
	unset($sorter);}
function get_trip($db,$today){
$Qearynexttrip="SELECT tdid,pck_time,drp_time,pick_latlong,drop_latlong FROM trip_details WHERE date = '$today' AND drv_id = '' AND wc = '0' ORDER BY pck_time ASC LIMIT 1";
if($db->query($Qearynexttrip) && $db->get_num_rows() > 0){ 
	$tripdata 	= $db->fetch_one_assoc(); } return $tripdata;   }
function get_free_drivers($db,$pick_time,$today){
	 	$Queryfreedriver="SELECT * FROM free_driver WHERE at_date = '$today' AND free_from < '$pick_time'";
		if($db->query($Queryfreedriver) && $db->get_num_rows() > 0){ 
		$freedriversdata = $db->fetch_all_assoc(); }  return $freedriversdata;   }	
function get_driver_distance_from_loc($db,$free_drivers,$pick_time_in_seconds,$pick_coordinates){
$x = 0;
  for($i=0; $i<sizeof($free_drivers); $i++){ 
			$drv_coordinate = explode(',',$free_drivers[$i]['drv_latlong']);
			$q = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$drv_coordinate[0].",".$drv_coordinate[1]."&destinations=".$pick_coordinates[0].','.$pick_coordinates[1]."&mode=driving&sensor=false";
			$json 				= file_get_contents($q);
			$details 			= json_decode($json, TRUE);   
			if($details['status'] == 'OK'){ 
			$distance_in_meter 	= $details['rows'][0]['elements'][0]['distance']['value'];
			$time_in_second 	= $details['rows'][0]['elements'][0]['duration']['value']; 
			$updated_freedriversdata[$x]['distance'] 			= $distance_in_meter;  
			list($hours1, $minutes1, $seconds1) 				= explode(":", $free_drivers[$i]['free_from']);
			$updated_freedriversdata[$x]['can_reach_seconds']	=($time_in_second+($hours1*3600+$minutes1*60+$seconds1));
			$updated_freedriversdata[$x]['pick_time_in_seconds']= $pick_time_in_seconds;
			$updated_freedriversdata[$x]['drv_code']			= $free_drivers[$i]['drv_code'];
			 if(($U%10) == 0) { sleep(1); }
			 $x++; 
			  } // End 5
			 $U++;
			}  return $updated_freedriversdata;
   }	
function get_reachable_drivers($driver_distanaces){
			$y = 0;
			for($j=0; $j<sizeof($driver_distanaces); $j++){ 
			if($driver_distanaces[$j]['pick_time_in_seconds'] > $driver_distanaces[$j]['can_reach_seconds']){
			$reachable[$y]['drv_code']			= $driver_distanaces[$j]['drv_code'];
			$reachable[$y]['distance']			= $driver_distanaces[$j]['distance'];
			$y++; } 
			}  return $reachable;  }
function sum_the_time($time1, $time2) {
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }			
if($noftrips > 0){
for($n=0; $n<$noftrips; $n++){ 
	$yellow 	= 0; // flag for conurrent trips assignment
	$tripdata 						= get_trip($db,$today);
	$pick_time 				= $tripdata['pck_time'];
	$pick_time_busy1		= sum_the_time($pick_time,'00:15:00');
	$pick_time_busy2		= sum_the_time($pick_time,'00:30:00');
	$pick_time_busy3		= sum_the_time($pick_time,'00:45:00');
	$pick_time_busy4		= sum_the_time($pick_time,'01:00:00');
	list($hours, $minutes, $seconds)= explode(":",$pick_time);
	$pick_time_in_seconds 			= ($hours*3600+$minutes*60+$seconds);
	$pick_coordinates 				= explode(',',$tripdata['pick_latlong']);
	$drv_latlong  					= $tripdata['drop_latlong'];
	$tdid 		  					= $tripdata['tdid'];
	$free_from	  					= $tripdata['drp_time'];
	$free_drivers 					= get_free_drivers($db,$pick_time,$today);
	if(!$free_drivers){  $free_drivers = get_free_drivers($db,$pick_time_busy1,$today); $yellow 	= 1;}
	if(!$free_drivers){  $free_drivers = get_free_drivers($db,$pick_time_busy2,$today); $yellow 	= 1;}
	if(!$free_drivers){  $free_drivers = get_free_drivers($db,$pick_time_busy3,$today); $yellow 	= 1;}
	if(!$free_drivers){  $free_drivers = get_free_drivers($db,$pick_time_busy4,$today); $yellow 	= 1;}
if($free_drivers){
$driver_distanaces = get_driver_distance_from_loc($db,$free_drivers,$pick_time_in_seconds,$pick_coordinates);
$reachable_driver  = get_reachable_drivers($driver_distanaces);
if(!$reachable_driver){ $reachable_driver = $driver_distanaces; $yellow 	= 1;}
$refinedriver      = multi_sort($reachable_driver, "distance", false); 
		if($refinedriver){
			$drv_code_USS = $refinedriver[0]['drv_code'];
			$current_time=date("Y-m-d H:i:s");
			$Qassigndriver= "UPDATE trip_details SET drv_id = '$drv_code_USS',duplicate='$yellow',tripassign_time = '$current_time' WHERE tdid = '$tdid' ";
			$Qupdatefreedriver = "UPDATE free_driver SET drv_latlong = '$drv_latlong', 
									free_from =  '$free_from' WHERE drv_code = '$drv_code_USS' ";
								$db->execute($Qassigndriver);
								$db->execute($Qupdatefreedriver); 
								$do = '1';  } 
								else { $Querynonassign= "UPDATE trip_details SET drv_id = '000000' WHERE tdid = '$tdid'";
	 $db->execute($Querynonassign);   $do = '1'; }
								} else {   $Querynonassign= "UPDATE trip_details SET drv_id = '000000' WHERE tdid = '$tdid'";
	 $db->execute($Querynonassign);   $do = '1';}
	//echo '<br /><br /> Trip detail <br /><br />';  print_r($tripdata); 
	//echo '<br /><br /> Selected Driver <br /><br />';  print_r($free_drivers);  
	//echo '<br /><br /> Updated Drivers <br /><br />';  print_r($driver_distanaces);  
	//echo '<br /><br /> reachable driver <br /><br />';  print_r($reachable_driver); 
	//echo '<br /><br /> order in driver <br /><br />';  print_r($refinedriver);    
	} 
}
 echo $do; 
?>