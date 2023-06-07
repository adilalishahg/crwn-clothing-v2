<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$coount = 0;
if($_POST['updatenow']){
	//print_r($_POST); exit;
	for($i=0;$i<sizeof($_POST['tdid']);$i++){
		$Qupdate = "UPDATE trip_details SET 
					date 		= '".convertDateToMySQL($_POST['date'][$i])."',
					pck_time	= '".$_POST['pck_time'][$i]."',
					drp_time	= '".$_POST['drp_time'][$i]."',
					drv_id		= '".$_POST['drv_id'][$i]."'
					WHERE tdid	= '".$_POST['tdid'][$i]."'"; 
					$db->execute($Qupdate); $coount++;
		} if($coount>0){		echo '<script>alert("Records Updated Successfully!");
								window.open("onego.php","_parent");</script>'; exit;}
	}
	$db->close();
?>