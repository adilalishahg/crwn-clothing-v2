<?php
require_once('../DBAccess/Database.inc.php');
include_once('../../Classes/array_sorter.php');
include_once('../../Classes/mapquest_google_miles.class.php');
	$mile_C = new mapquest_google_miles;
ini_set('max_execution_time', 10000); 
error_reporting(E_ALL);
ini_set('display_errors', '1');
$db = new Database;	
$db->connect();
include_once('../include_file.php');
$noftrips = $_REQUEST['noftrips'];
if($noftrips>6) { $noftrips = 6; }
 $do = 0;
 $U  = 1;

function secondstotime3($seconds){
return gmdate("H:i:s", $seconds); 
} 
function multi_sort(&$array, $key, $asc=true)
	{
	$sorter = new array_sorter($array, $key, $asc);
	return $sorter->sortit();
	unset($sorter);}
function get_trip($db,$today,$limit,$veh_type_id=''){  sleep(2);  $qadd="";
	if($veh_type_id!=''){$qadd=" AND veh_id = '".$veh_type_id."' ";}
   $Qearynexttrip="SELECT tdid,pck_time,drp_time,pick_latlong,drop_latlong,pck_add,drp_add,passenger,veh_id FROM trip_details WHERE date = '$today' AND drv_id = '' AND wc = '0' AND status IN ('9','5') $qadd ORDER BY pck_time ASC, tdid ASC LIMIT $limit "; //exit;
if($db->query($Qearynexttrip) && $db->get_num_rows() > 0){ 
	$tripdata 	= $db->fetch_all_assoc(); } return $tripdata;   }
function get_driver_distance_from_loc($db,$free_drivers,$pick_time_in_seconds,$pick_adress,$departure,$setupdata,$mile_C){
$x = 0;  $U  = 1;
if($setupdata['live_trafic_ip']=='yes'){$dp= "&departure_time=".$departure;}else{$dp="";}
  for($i=0; $i<sizeof($free_drivers); $i++){ 
			$drv_address = $free_drivers[$i]['drv_address'];
			$ussdata=$mile_C->distance2($drv_address,$pick_adress,$dp,$db);	
			//print_r($ussdata); exit;
			if($ussdata){
			$distance_in_meter 	= $ussdata['distance'];
			$time_in_second 	= $ussdata['time'];
			$updated_freedriversdata[$x]['distance'] 			= $distance_in_meter;  
			$updated_freedriversdata[$x]['can_reach_seconds']	=($time_in_second+$free_drivers[$i]['free_from']);//
			$updated_freedriversdata[$x]['pick_time_in_seconds']= $pick_time_in_seconds;
			$updated_freedriversdata[$x]['drv_code']			= $free_drivers[$i]['drv_code'];
			 if(($U%9) == 0) { sleep(1); }
			 $x++; 
			  } 
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
function get_distance_time($pick_adress,$drp_add,$departure,$setupdata,$mile_C,$db){
if($setupdata['live_trafic_ip']=='yes'){$dp= "&departure_time=".$departure;}else{$dp="";} 
			 return $mile_C->distance2($pick_adress,$drp_add,$dp,$db);	  //echo 'In'; exit;
   }
function get_free_drivers($db,$pick_time,$today,$veh_type_id){ $freedriversdata=array();
	 	 $Queryfreedriver="SELECT * FROM free_driver WHERE at_date = '$today' AND veh_type_id ='$veh_type_id' AND free_from < '$pick_time'"; 
		//$Queryfreedriver="SELECT * FROM free_driver WHERE at_date = '$today' AND free_from < '$pick_time'"; 
		if($db->query($Queryfreedriver) && $db->get_num_rows() > 0){ 
		$freedriversdata = $db->fetch_all_assoc(); }  return $freedriversdata;   }   
if($noftrips > 0){
	$mile_cap_window	= 	1609.34 * $setupdata['mile_cap_window'];
	$time_cap_window	= 	60 * $setupdata['time_cap_window'];
for($n=0; $n<$noftrips; $n++){ 

// To check daily quota for auto schedule
$quota = 60; $limit = 0;
$Qs="SELECT trips FROM  date_auto_schedule WHERE datefor='".$today."'"; 
if($db->query($Qs) && $db->get_num_rows() > 0){ $quota_data = $db->fetch_one_assoc();  $limit=$quota_data['trips'];}
$limit = $limit+1;
if($limit>$quota){}else{
	
	
$tripdata = get_trip($db,$today,1);

//print_r($tripdata); exit;
	$pick_adress_p					= explode(',',$tripdata[0]['pck_add'],3);
 	$pick_adress					= $pick_adress_p[0].','.$pick_adress_p[2];
	$drp_add_p						= explode(',',$tripdata[0]['drp_add'],3);
	$drp_add						= $drp_add_p[0].','.$drp_add_p[2];
	$pick_time 						= $tripdata[0]['pck_time'];
	$passenger 						= $tripdata[0]['passenger'];
	$veh_type_id 					= $tripdata[0]['veh_id'];
	$departure 						= strtotime($today.' '.$pick_time);
	$data 							= get_distance_time($pick_adress,$drp_add,$departure,$setupdata,$mile_C,$db);
	
	list($hours, $minutes, $seconds)= explode(":",$pick_time);
	$pick_time_in_seconds 			= ($hours*3600+$minutes*60+$seconds);
	$free_drivers = get_free_drivers($db,$pick_time_in_seconds,$today,$veh_type_id);
	//print_r($free_drivers); exit;
	$tdid 		  					= $tripdata[0]['tdid'];
	if($free_drivers){
$driver_distanaces = get_driver_distance_from_loc($db,$free_drivers,$pick_time_in_seconds,$pick_adress,$departure,$setupdata,$mile_C);
//print_r($driver_distanaces); exit;
$reachable_driver = get_reachable_drivers($driver_distanaces);
$refinedriver = multi_sort($reachable_driver, "distance", false);
		if($refinedriver){
			$drv_code_USS = $refinedriver[0]['drv_code'];
			$free_from= $pick_time_in_seconds + $data['time'] + $time_cap_window;
			if($data['time']){ $Qr=", drp_time = '".secondstotime3($free_from-$time_cap_window)."'  ";}
			 $Qassigndriver= "UPDATE trip_details SET drv_id = '".$drv_code_USS."',assign_type = 'Auto'  WHERE tdid = '$tdid' "; 
			 $db->execute($Qassigndriver); 
			 $Qcapacity="SELECT capacity FROM free_driver WHERE at_date = '$today' AND drv_code = '".$drv_code_USS."'";
			 if($db->query($Qcapacity) && $db->get_num_rows() > 0){	$capacitydata	= $db->fetch_one_assoc(); }
			 $capacity=$capacitydata['capacity'];
			 $capacity = ($capacity-$passenger);			  
			 
			 //Logic to assign an other trip for the same driver
			$T0 = ( $pick_time_in_seconds + $data['time'] + $time_cap_window);//Acceptiable drop time of first trip 
			$moretrips = get_trip($db,$today,2,$veh_type_id);
			if($moretrips){ 
			for($x=0;$x<sizeof($moretrips);$x++){
			$assignkar=0;			
			list($hours, $minutes, $seconds)= explode(":",$moretrips[$x]['pck_time']);
			$pick_time_in_secondsX 			= ($hours*3600+$minutes*60+$seconds);
	
			$departure		= strtotime($today.' '.$moretrips[$x]['pck_time']);
			$pick1_p		= explode(',',$moretrips[$x]['pck_add'],3);
 			$pick1			= $pick1_p[0].','.$pick1_p[2];
			$drp1_p			= explode(',',$moretrips[$x]['drp_add'],3);
			$drp1			= $drp1_p[0].','.$drp1_p[2];
			$data1= get_distance_time($pick_adress,$pick1,$departure,$setupdata,$mile_C,$db);
				$T1=$data1['time']; $m1=$data1['distance'];
			$data2= get_distance_time($pick1,$drp1,$departure,$setupdata,$mile_C,$db);
				$T2=$data2['time']; $m2=$data2['distance'];
			$data3= get_distance_time($drp1,$drp_add,$departure,$setupdata,$mile_C,$db);
				$T3=$data3['time']; $m3=$data3['distance'];
			$data4= get_distance_time($pick1,$drp_add,$departure,$setupdata,$mile_C,$db);
				$T4=$data4['time']; $m4=$data4['distance'];	
			$RT1=$pick_time_in_seconds+$T1+$T2+$T3;
			$RT2=$pick_time_in_seconds+$T1+$T4+$T3;	
			$pick_time_in_secondsX =$pick_time_in_secondsX+$data2['time'];//+$time_cap_window;
			if($capacity >= $moretrips[$x]['passenger'] && $T0 >=$RT1 && $mile_cap_window > $m1 ){
				$assignkar=1;	$free_from = $T0; }else{$assignkar=0;}
			if($capacity >= $moretrips[$x]['passenger'] && $pick_time_in_secondsX >=$RT2 && $mile_cap_window > $m1 ){
				$assignkar=1;	$free_from = $pick_time_in_secondsX;
						$drp_add = $drp1; }else{$assignkar=0;}
			if($assignkar==1){
				if($data2['time']){ $Qr2=", drp_time = '".secondstotime3($pick_time_in_secondsX)."'  ";}else{$Qr2="";}
				$capacity = ($capacity-$moretrips[$x]['passenger']);
				$QassigndriverX= "UPDATE trip_details SET drv_id = '".$drv_code_USS."',assign_type = 'Auto'  WHERE tdid = '".$moretrips[$x]['tdid']."' ";
			 	$db->execute($QassigndriverX);  $n++;
				}}}
			 //End of logic
			$Qupdatefreedriver = "UPDATE free_driver SET drv_address = '$drp_add', 
									free_from =  '$free_from' WHERE drv_code = '$drv_code_USS' ";
								$db->execute($Qupdatefreedriver); 
								$do = '1';  
								} 
								else { $Querynonassign= "UPDATE trip_details SET drv_id = '000000' WHERE tdid = '$tdid'";
	 $db->execute($Querynonassign);   $do = '1'; }
								} else {   $Querynonassign= "UPDATE trip_details SET drv_id = '000000' WHERE tdid = '$tdid'";
	 $db->execute($Querynonassign);   $do = '1';}
	 
	 }  //End of checking quota limit
	} 
}
 		$Qtotnumoftrips = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND status IN ('9','5')";
		if($db->query($Qtotnumoftrips) && $db->get_num_rows() > 0) { $tottripdata = $db->fetch_all_assoc(); }
		$tot_trips = $tottripdata[0]['tot'];
		
		$Qtotnumofassigntrips = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND drv_id != '' AND status IN ('9','5')";
		if($db->query($Qtotnumofassigntrips) && $db->get_num_rows() > 0) { $totassigntripdata = $db->fetch_all_assoc(); }
		$tot_assign_trips = $totassigntripdata[0]['tot'];
		
		$Qtotnumofunassigntrips = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND drv_id = '' AND status IN ('9','5')";
		if($db->query($Qtotnumofunassigntrips) && $db->get_num_rows() > 0) { $totunassigntripdata = $db->fetch_all_assoc(); }
		$tot_unassign_trips = $totunassigntripdata[0]['tot'];
		
		$Qtotnumofunassigntrips2nd = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND drv_id = '' AND wc != '1' AND status IN ('9','5')";
		if($db->query($Qtotnumofunassigntrips2nd) && $db->get_num_rows() > 0) { $totunassigntripdata2nd = $db->fetch_all_assoc(); }
		$tot_unassign_trips2nd = $totunassigntripdata2nd[0]['tot'];
		
		if($tot_unassign_trips2nd==0){$bus='^1';}else{$bus='';}
		$percentage=floor($tot_assign_trips*100/($tot_assign_trips+$tot_unassign_trips));
		$total_trips=$tot_assign_trips+$tot_unassign_trips;
		if(($tot_assign_trips%10)==0){
			$Query = "SELECT * FROM googlekeys WHERE 1=1  ORDER BY `id` ASC LIMIT 1";
   			if($db->query($Query) && $db->get_num_rows() > 0){	   $keydata = $db->fetch_one_assoc(); }$key=$keydata['gkey'];
			$Qd="DELETE FROM googlekeys WHERE gkey= '".$key."' LIMIT 1"; if($db->execute($Qd)){ $Qinstr="INSERT INTO googlekeys SET gkey = '".$key."'"; $db->query($Qinstr); }
			}
 echo 	$do.'^'.$tot_assign_trips.'^'.$tot_unassign_trips.'^'.$percentage.'^'.$total_trips.$bus;
?>