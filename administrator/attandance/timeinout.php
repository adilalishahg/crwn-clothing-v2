<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db ->connect();
$current_time=date("Y-m-d H:i:s");
if(isset($_POST['id']) && isset($_POST['option']))
{	$id 	= $_POST['id'];
	$option = $_POST['option'];
	if($option=='in'){$Qup="UPDATE drivers SET clockin = '".$current_time."',clockstatus='in' WHERE Drvid = '".$id."'";
	$db->execute($Qup); echo 1;
	}else{$Qse = "SELECT * FROM ".drivers." WHERE Drvid = '".$id."'";
	if($db->query($Qse) && $db->get_num_rows() > 0)
	{	$data = $db->fetch_one_assoc();
	$Qup="UPDATE drivers SET clockout = '".$current_time."',clockstatus='out' WHERE Drvid = '".$id."'";
	$db->execute($Qup);
	$duration = (strtotime($current_time) - strtotime($data['clockin']));// exit;
	$Qins="INSERT INTO clockinout_history SET
										Drvid	=	'".$data['Drvid']."',
										date	=	'".date("Y-m-d",strtotime($data['clockin']))."',
										clockin	=	'".$data['clockin']."',
										clockout=	'".$current_time."',
										duration=	'".$duration."'";
										$db->execute($Qins);
	} echo 1;}	
	}
	$db->close();
?>