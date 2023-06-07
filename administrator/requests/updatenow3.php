<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$coount = 0;
if($_POST['updatenow3']){ //print_r($_POST);
	$pendingids = $_POST['pendingids'];
	$pendingids=explode("@",$pendingids);
	//print_r($pendingids); exit;
	for($i=0;$i<sizeof($pendingids);$i++){
		$Qupdate = "UPDATE request_info SET 
					clientname	= '".$_POST['clientname']."',
					dob			= '".convertDateToMySQL($_POST['dob'])."',
					cisid		= '".$_POST['cisid']."',
					vehtype		= '".$_POST['vehtype']."',
					phnum		= '".$_POST['phnum']."',
					apptime		= '".$_POST['apptime']."',
					returnpickup= '".$_POST['returnpickup']."',
					pickaddr	= '".$_POST['pickaddr']."',
					destination	= '".$_POST['destination']."',
					backto		= '".$_POST['backto']."'
					WHERE id 	= '".$pendingids[$i]."'"; 
					$db->execute($Qupdate); $coount++;
		} if($coount>0){		echo '<script>alert("Records Updated Successfully!");
								window.open("onego.php","_parent");</script>'; exit;}
	}
	$db->close();
?>