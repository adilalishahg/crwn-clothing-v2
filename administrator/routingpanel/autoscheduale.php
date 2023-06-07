<?php
require_once('../DBAccess/Database.inc.php');

	$db = new Database;	
	$db->connect(); //echo date('Y-m-d');
	    //$today = date("Y-m-d",strtotime("+1 day"));
		include_once('../include_file.php');
		$Qs="SELECT trips FROM  date_auto_schedule WHERE datefor='".$today."'";
if($db->query($Qs) && $db->get_num_rows() > 0){
}else{
	$Qins="INSERT INTO date_auto_schedule SET datefor='".$today."',trips='0'"; $db->execute($Qins);
}
		$tot_availble_drivers = 0;
		$Querytotdrivers = "SELECT COUNT(*) as  tot FROM drivers WHERE drvstatus = 'Active' ";
		if($db->query($Querytotdrivers) && $db->get_num_rows() > 0)
		{  $totdata = $db->fetch_all_assoc(); $totdrivers = $totdata[0]['tot']; }
		$Querydrv = "SELECT * FROM free_driver WHERE at_date = '$today' ";
		if($db->query($Querydrv) && $db->get_num_rows() > 0){
		 $availble_drivers = $db->fetch_all_assoc();
		 $tot_availble_drivers = $db->get_num_rows(); }
		 
		 $Qup="UPDATE trip_details SET drv_id = '' WHERE date = '$today' AND drv_id = '000000' "; $db->execute($Qup);
		 
		$Qtotnumoftrips = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND status IN ('9','5') ";
		if($db->query($Qtotnumoftrips) && $db->get_num_rows() > 0) { $tottripdata = $db->fetch_all_assoc(); }
		$tot_trips = $tottripdata[0]['tot'];
		
		$Qtotnumofassigntrips = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND drv_id != ''  AND status IN ('9','5') ";
		if($db->query($Qtotnumofassigntrips) && $db->get_num_rows() > 0) { $totassigntripdata = $db->fetch_all_assoc(); }
		$tot_assign_trips = $totassigntripdata[0]['tot'];
		
		$Qtotnumofunassigntrips = "SELECT COUNT(*) as tot FROM trip_details WHERE date = '$today' AND drv_id = '' AND status IN ('9','5') ";
		if($db->query($Qtotnumofunassigntrips) && $db->get_num_rows() > 0) { $totunassigntripdata = $db->fetch_all_assoc(); }
		$tot_unassign_trips = $totunassigntripdata[0]['tot'];
		
		
		
		/*$Qtotnumoftrips = "SELECT COUNT(*) as tot FROM `order` WHERE Pickup_Date = '$today' AND Status IN ('Open','Accepted','Pending') ";
		if($db->query($Qtotnumoftrips) && $db->get_num_rows() > 0) { $tottripdata = $db->fetch_all_assoc(); }
		$tot_trips = $tottripdata[0]['tot'];
		
		$Qtotnumofassigntrips = "SELECT COUNT(*) as tot FROM `order` WHERE Pickup_Date = '$today' AND dumy_Car NOT IN ('99','') AND Status IN ('Open','Accepted','Pending') ";
		if($db->query($Qtotnumofassigntrips) && $db->get_num_rows() > 0) { $totassigntripdata = $db->fetch_all_assoc(); }
		$tot_assign_trips = $totassigntripdata[0]['tot'];
		
		$Qtotnumofunassigntrips = "SELECT COUNT(*) as tot FROM `order` WHERE Pickup_Date = '$today' AND dumy_Car IN ('99','') AND Status IN ('Open','Accepted','Pending')";
		if($db->query($Qtotnumofunassigntrips) && $db->get_num_rows() > 0) { $totunassigntripdata = $db->fetch_all_assoc(); }
		$tot_unassign_trips = $totunassigntripdata[0]['tot'];*/
		if($tot_trips>0){$percentage=floor($tot_assign_trips*100/($tot_assign_trips+$tot_unassign_trips));}
		
		 
		//print_r($totdata);
	$db->close();
	$smarty->assign("totdrivers",$totdrivers);
	$smarty->assign("tot_availble_drivers",$tot_availble_drivers);
	$smarty->assign("tot_trips",$tot_trips);
	$smarty->assign("percentage",$percentage);	
	$smarty->assign("date",$today);
	$smarty->assign("tot_assign_trips",$tot_assign_trips);
	$smarty->assign("tot_unassign_trips",$tot_unassign_trips);	
	$smarty->display('rpaneltpl/autoscheduale.tpl');
    ?>