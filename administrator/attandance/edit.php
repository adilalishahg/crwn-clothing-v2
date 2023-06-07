<?php
include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
    $id		=	$_REQUEST['id'];
	$drvid	=	$_REQUEST['drvid'];
	$dated	=	$_REQUEST['dated'];
	
	$startdate	=	$_REQUEST['startdate'];
	$enddate	=	$_REQUEST['enddate'];
	$drv_id		=	$_REQUEST['drv_id'];
	
	$Query2 = "SELECT dr.*,(SELECT dtype_duration FROM drivertype where dtype_id=dr.drvtype) dtype_duration  FROM  ".drivers." as dr where dr.Drvid = '".$drvid."'";
	if($db->query($Query2) && $db->get_num_rows()) {  $driver  = $db->fetch_one_assoc(); //print_r($driver); 
	}
	$Query = "SELECT * FROM  ".attendance." where id = '".$id."'";
	if($db->query($Query) && $db->get_num_rows()) {  $data  = $db->fetch_one_assoc();
		$data['total_time']= gmdate("H:i", $data['total_time']);
		$data['over_time']= gmdate("H:i", $data['over_time']);
		}
if($_POST){ //print_r($_POST);
	$dayonoff		=	$_REQUEST['dayonoff'];
	$clockin		=	date("Y-m-d",$data['clockin']).' '.$_REQUEST['clockin'];
	$clockout		=	date("Y-m-d",$data['clockout']).' '.$_REQUEST['clockout'];
	
	
	$total_time = (strtotime($clockout) - strtotime($clockin));// exit;
	if($total_time > ($driver['dtype_duration']*60*60)){$over_time	=	($total_time-($driver['dtype_duration']*60*60));}else{$over_time=0;}
	
	//$total_time		=	timetoseconds($_REQUEST['total_time']);
	//$over_time		=	timetoseconds($_REQUEST['over_time']); //exit;
	$Query3 = "UPDATE  ".attendance." SET 
										dayonoff	=	'$dayonoff',
										clockin		=	'$clockin',
										clockout	=	'$clockout',
										total_time	=	'$total_time',
										over_time	=	'$over_time',
										updated		=	'1' 		where id = '".$id."'";
										$db->execute($Query3);
						$Qd="DELETE FROM clockinout_history WHERE Drvid = '".$drvid."' AND `date`='".$dated."'";
						$db->execute($Qd);
						$Qin="INSERT INTO clockinout_history SET 
															Drvid		=	'$drvid',
															clockin		=	'$clockin',
															clockout	=	'$clockout',
															`date`		=	'$dated',
															duration	=	'$total_time'";				
						  $db->execute($Qin);				
						  echo '<script>alert("Info updated successfully!");</script>'; 
						  echo "<script>window.open('index.php?startdate=$startdate&enddate=$enddate&drv_id=$drv_id','_parent');</script>";
						  exit;
	}
	
	//print_r($data);
	$db->close();
	$smarty->assign("data",$data);
	$smarty->assign("driver",$driver);
	$smarty->assign("id",$id);
	$smarty->assign("drvid",$drvid);
	
	$smarty->assign("startdate",$startdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("drv_id",$drv_id);
	$smarty->assign("dated",$dated);
	$smarty->assign("totalduration",gmdate("H:i:s", $tot));				
	$smarty->display('atdncetpl/edit.tpl');
?>