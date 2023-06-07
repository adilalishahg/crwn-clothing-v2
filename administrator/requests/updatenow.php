<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$coount = 0;
if($_POST['updatenow']){
	//print_r($_POST); exit;
	for($i=0;$i<sizeof($_POST['id']);$i++){
		$Qupdate = "UPDATE request_info SET 
					appdate 		= '".convertDateToMySQL($_POST['appdate'][$i])."',
					apptime			= '".$_POST['apptime'][$i]."',
					returnpickup	= '".$_POST['returnpickup'][$i]."'
					WHERE id 		= '".$_POST['id'][$i]."'"; 
					$db->execute($Qupdate); $coount++;
		} if($coount>0){		echo '<script>alert("Records Updated Successfully!");
								window.open("onego.php","_parent");</script>'; exit;}
	}
	$db->close();
?>