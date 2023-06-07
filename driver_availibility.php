<?php
 include_once('includefile.php');
 

	error_reporting(E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR);



	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);



	ini_set("display_errors","on");

$DB = new Database;
$DB2 = new Database;
$msg = $_GET['msg'];
$sheet = $_GET['id'];

$DB->connect();
$DB2->connect();

$total_trips=0;
//all trips information
$tripsCount=array();
//all drivers that are assigned trips
$vehicleInfo=array();
//save event colors
$colors=array();

//event color palette
$deliveredColor = '#00FF00';
$cancelledColor = '#663399';
$scheduledColor = '#800000';
$unscheduledColor = '#0099ff';
$noShowColor = '#A020F0';
$driverOnRouteColor = '#FF0000';
$pickUpRouteColor = '#FFA500';
$otherColor = '#0000FF';

//store count of each event
$scheduled=$driverOnRoute=0;
$pickUp=$delivered=$cancelled=0;
$noShow=$missed=$reroute=0;
$unscheduled=0;
//events
$today=date('Y-m-d');
$pday = date("Y-m-d",strtotime("-1 day"));
if(isset($_GET['date'])){
    $today	=	convertDateToMySQL($_GET['date']);
}
// echo $today;
/*
 * This query selects al the trips with their status and values from trips and trip_details tables
 * */
/*$QueryCount = "SELECT t.sheet_id,td.veh_id,td.acknowledge_status,t.trip_code,t.trip_id,t.trip_user,t.trip_clinic,t.trip_date, 
t.trip_tel,td.tdid,td.trip_id,td.type,td.pck_add,td.aptime,td.pck_time,td.aptime,td.drp_atime,t.account,td.p_phnum,td.picklocation,td.droplocation,td.drp_add,td.drp_time,td.trip_miles,td.wc,td.trip_remarks,td.drv_id,td.status,td.pick_latlong,td.drop_latlong 
		  FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code WHERE t.trip_date = '$today'  ORDER by td.pck_time ASC,td.tdid ASC";
if($DB->query($QueryCount) && $DB->get_num_rows() > 0) {
    $tripsCount = $DB->fetch_all_assoc();
    //print_r($tripsCount);
    $total_trips = sizeof($tripsCount);
    foreach ($tripsCount as $value) {
        //print_r($value['drv_id']);
       if($value['drv_id']!=null){
           $vehicleQuery = "SELECT d.drv_code,dvm.vehname,dvm.veh_id FROM dv_mapping as dvm LEFT JOIN drivers as d ON dvm.drv_id=d.Drvid WHERE d.drv_code=" . $value['drv_id'];
           if ($DB->query($vehicleQuery) && $DB->get_num_rows() > 0) {
               $vehicles = $DB->fetch_one_assoc();
               //print_r($vehicles);

               $vehicleInfo[] = $vehicles;
           }
       }

    }


    for ($index = 0; $index < sizeof($tripsCount); ++$index) {
        if($vehicleInfo[$index]==null){
            $unscheduled += 1;
            $colors[] = $unscheduledColor;
        } elseif ($tripsCount[$index]['status'] == 1 or $tripsCount[$index]['status'] == 4) {
            $delivered += 1;
            $colors[] = $deliveredColor;
        } elseif ($tripsCount[$index]['status'] == 3) {
            $cancelled += 1;
            $colors[] = $cancelledColor;
        } elseif ($tripsCount[$index]['status'] == 5 or $tripsCount[$index]['status'] == 9 ) {
            $scheduled += 1;
            $colors[] = $scheduledColor;
        } elseif ($tripsCount[$index]['status'] == 6) {
            $pickUp += 1;
            $colors[] = $pickUpRouteColor;
        } elseif ($tripsCount[$index]['status'] == 7 or $tripsCount[$index]['status'] == 8) {
            $noShow += 1;
            $colors[] = $noShowColor;
        } elseif ($tripsCount[$index]['status'] == 13) {
            $driverOnRoute += 1;
            $colors[] = $driverOnRouteColor;
        }
        else{
            $colors[]=$otherColor;
        }
    }
}
*/
$driversFreeSlots=array(); $count=0;
//$q = "SELECT * FROM ".TBL_CONTACT; 		if($db->query($q) && $db->get_num_rows() > 0)	{ $contact_info = $db->fetch_one_assoc(); print_r($contact_info);}
$drvQuery = "SELECT  Drvid,fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus ='Active' ORDER BY  fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0){
		$drivers = $db->fetch_all_assoc();
		for($i = 0; $i < sizeof($drivers); $i++) {
			
			$tripsQ = "SELECT td.tdid,td.aptime,td.pck_time,td.drp_atime,td.drp_time,td.status  FROM trip_details as td  WHERE td.date = '$today' AND td.drv_id = '".$drivers[$i]['drv_code']."' AND td.status NOT IN('3','7','8') ORDER by td.pck_time ASC";
			if($db->query($tripsQ) && $db->get_num_rows() > 0) { $total_trips	=	$db->get_num_rows();	$trips = $db->fetch_all_assoc();
			
					for($u = 0; $u < ($total_trips+1); $u++){ 
						
						if($u == 0){ 
									$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
									$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
									$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
									$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$contactinfo['starttime']; 
									$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u]['pck_time'];
									$count++;
						}elseif($u	==	$total_trips){
										$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
										$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
										$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
										$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['drp_time'];
										$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$contactinfo['endtime']; 
										$count++;
										}
						elseif($u != 0 && $u	!=	$total_trips ){ 
									$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
									$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
									$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
									$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['drp_time'];
									$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u]['pck_time']; 
									$count++;
						
						}
						
							
					
					}
				
				
				 }else{
				$driversFreeSlots[$count]['drv_code'] = 	$drivers[$i]['drv_code'];
				$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
				$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$contactinfo['starttime'];
				$driversFreeSlots[$count]['free_end'] = 	$today.'T'.$contactinfo['endtime'];
				$count++;
				}
			
			}
		
		
		}		
//echo 'IN';exit;		
//	echo '<pre>'; print_r($driversFreeSlots); exit;
//$min = round(12*3);
//$drp_time 	= date("H:i:s", strtotime("+$min minutes",strtotime('15:30:20')));
//print_r($drp_time);
$smarty->assign('currentDate',$today);
$smarty->assign("drivers",$drivers);
$smarty->assign("driversFreeSlots",$driversFreeSlots);
$smarty->assign("unscheduled",$unscheduled);
$smarty->assign("driverOnRoute",$driverOnRoute);
$smarty->assign("pickUp",$pickUp);
$smarty->assign("delivered",$delivered);
$smarty->assign("cancelled",$cancelled);
$smarty->assign("today",$today);
$smarty->assign("missed",$missed);
$smarty->assign("reroute",$reroute);
//providing trips information to be displayed on tpl page
$smarty->assign('trips',$tripsCount);
//providing drivers information to be displayed on tpl page
$smarty->assign('vehicles',$vehicleInfo);
//providing colors to be displayed in tpl page
$smarty->assign('colors',$colors);
$smarty->display('driver_availibility.tpl');


/*if($u == 0){
							$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
							$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$contactinfo['starttime']; 
							$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u]['pck_time'];
							$count++;}
						
						elseif(($u+1)	==	$total_trips){
							$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
							$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['drp_time'];
							$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$contactinfo['endtime']; 
							$count++;
							}
							
							
						elseif($u != 0 && ($u+1)	!=	$total_trips ){ 
						
							$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
							$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['drp_time'];
							$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u]['pck_time']; 
							$count++;
						
							}*/
							
							
							
						/*if($u == 0){
						$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$contactinfo['starttime']; }
							else{$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['pck_time'];}
							
						if(($u+1)	==	$total_trips){
						$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$contactinfo['endtime']; }
							else{$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u-1]['drp_time'];}*/
						
?>
