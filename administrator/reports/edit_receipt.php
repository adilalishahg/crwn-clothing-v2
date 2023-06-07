<?php
include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
    $id			= $_REQUEST['id'];
	$startdate 	= $_REQUEST['startdate'];
	$enddate 	= $_REQUEST['enddate'];
	$reportby 	= $_REQUEST['reportby'];
	$driver_id  = $_REQUEST['driver_id'];
	$veh_id  	= $_REQUEST['veh_id'];
	$Query = "SELECT *  FROM  ".receipts." where id = '".$id."'";
	if($db->query($Query) && $db->get_num_rows()) {  $receiptinfo  = $db->fetch_one_assoc(); //print_r($driver); 
	}
	$Dr = "SELECT * FROM ".TBL_DRIVERS." WHERE 1 ORDER BY  fname ASC";
 	if($db->query($Dr) && $db->get_num_rows())
	{	$driverdata = $db->fetch_all_assoc();}
	$Ve = "SELECT * FROM ".vehicles." WHERE 1 ORDER BY  vnumber ASC";
 	if($db->query($Ve) && $db->get_num_rows())
	{	$vehicledata = $db->fetch_all_assoc();}
	if($_POST){ //print_r($_POST); exit;
	
	$Query3 = "UPDATE  ".receipts." SET 
										driver_code		=	'".$_POST['driver_code']."',
										vehicle_id		=	'".$_POST['vehicle_id']."',
										total_galon		=	'".$_POST['total_galon']."',
										price_per_galon	=	'".$_POST['price_per_galon']."',
										receipt_amount	=	'".round((($_POST['total_galon'])*($_POST['price_per_galon'])),2)."',
										current_vehicle_milage	=	'".$_POST['current_vehicle_milage']."',
										uploadedon		=	'".convertDateToMySQL($_POST['uploadedon'])." 00:00:00'
										where id 		= 	'".$_POST['id']."'";
										$db->execute($Query3);
						
						echo '<script>alert("Info updated successfully!");</script>'; 
						echo "<script>window.open('gasreceipts.php?startdate=$startdate&enddate=$enddate&reportby=$reportby&driver_id=$driver_id&veh_id=$veh_id','_parent');</script>";
						  exit;
	}
	//print_r($data);
	$db->close();
	$smarty->assign("receiptinfo",$receiptinfo);
	$smarty->assign("driverdata",$driverdata);
	$smarty->assign("vehicledata",$vehicledata);
	$smarty->assign("id",$id);
	$smarty->assign("startdate",$startdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("reportby",$reportby);
	$smarty->assign("driver_id",$driver_id);
	$smarty->assign("veh_id",$veh_id);
	
			
	$smarty->display('reportstpl/edit_reciept.tpl');
?>