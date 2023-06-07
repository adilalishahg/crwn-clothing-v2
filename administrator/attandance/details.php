<?php
include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$today 	= 	date("Y-m-d");
    $id		=	$_REQUEST['id'];
	$date	=	$_REQUEST['date'];
	$tot	=	0;
	if($_POST['updatetimes']){ 
		for($i=0;$i<sizeof($_POST['atid']);$i++){
			$clockin = $_POST['clockin'][0];
			$clockout = $_POST['clockout'][$i];
			$duration = (strtotime($_POST['clockout'][$i].':00') - strtotime($_POST['clockin'][$i].':00'));
			if($duration<0){$duration = 0;}
			 $Qup="UPDATE clockinout_history SET 
										clockin		=	'".$_POST['date'].' '.$_POST['clockin'][$i]."',
										clockout	=	'".$_POST['date'].' '.$_POST['clockout'][$i]."',
										duration	=	'".$duration."' WHERE id = '".$_POST['atid'][$i]."' ";
				 $db->execute($Qup);			
				$lin=$_POST['date'].' '.$_POST['clockin'][$i];
				$lout=$_POST['date'].' '.$_POST['clockout'][$i];			
			
			}
		if(($today==$_POST['date']) && $_POST['clockstatus'] =='in'){
			$clockin= $date." ".$_POST['drclockin'];
			$Qupd="UPDATE ".TBL_DRIVERS." SET clockin = '".$clockin."' WHERE Drvid = '".$id."'";
			$db->execute($Qupd);   
			}
			if(($today==$_POST['date']) && $_POST['clockstatus'] =='out'){
			 	$Qupd="UPDATE ".TBL_DRIVERS." SET clockin =	'".$lin.":00',
												  clockout=	'".$lout.":00' WHERE Drvid = '".$id."'"; 
			$db->execute($Qupd);}	
			
	$queryD = "SELECT  dr.*,dt.dtype_duration FROM ".TBL_DRIVERS." as dr LEFT JOIN drivertype as dt on dr.drvtype = dt.dtype_id WHERE dr.del = '0' AND dr.Drvid = '".$id."' ";
if($db->query($queryD) && $db->get_num_rows() > 0)
	{	$drivers = $db->fetch_one_assoc(); }	
	$Query = "SELECT * FROM  ".clockinout_history." where Drvid = '".$id."' AND date = '".$_POST['date']."'";
		if($db->query($Query) && $db->get_num_rows()) {  $clockhistory  = $db->fetch_all_assoc();	//print_r($clockhistory); exit;
			$tot =0;
			for($k=0;$k<sizeof($clockhistory);$k++){
			$tot	 	= $tot+$clockhistory[$k]['duration'];
			$clockin=$clockhistory[0]['clockin'];
			$clockout	=$clockhistory[$k]['clockout'];
			} if($tot > ($drivers['dtype_duration']*60*60)){$overtime	=	($tot-($drivers['dtype_duration']*60*60));}else{$overtime=0;}
				$Qins="UPDATE attendance SET
										clockin		=	'".$clockin."',
										clockout	=	'".$clockout."',
										total_time	=	'".$tot."',
										dutty_hour	=	'".$drivers['dtype_duration']."',
										over_time	=	'".$overtime."' WHERE driver_id = '".$id."' AND dated = '".$date."'"; 
										$db->execute($Qins);
	
	
		}
		
		}
	$queryDr = "SELECT  dr.* FROM ".TBL_DRIVERS." as dr WHERE dr.Drvid = '".$id."' ";
if($db->query($queryDr) && $db->get_num_rows() > 0)
	{	$driversdata = $db->fetch_one_assoc(); }
	$tot=0;
	$Query = "SELECT * FROM  ".clockinout_history." where Drvid = '".$id."' AND date = '".$date."'";
	if($db->query($Query) && $db->get_num_rows()) {  $data  = $db->fetch_all_assoc();}
	for($i=0;$i<sizeof($data);$i++){
		$tot = $tot+$data[$i]['duration'];
		$data[$i]['duration1']= gmdate("H:i:s", $data[$i]['duration']);
		}
	//print_r($driversdata);
	$db->close();
	$smarty->assign("data",$data);
	$smarty->assign("date",$date);
	$smarty->assign("today",$today);
	$smarty->assign("driversdata",$driversdata);
	$smarty->assign("id",$id);
	$smarty->assign("id",$id);
	$smarty->assign("totalduration",gmdate("H:i:s", $tot));				
	$smarty->display('atdncetpl/details.tpl');
?>