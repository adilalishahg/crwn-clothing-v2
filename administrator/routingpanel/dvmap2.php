<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$current_time=date("Y-m-d H:i:s");
	$tid = $_POST['tid'];
	$did = $_POST['did'];
	if(!empty($tid) )
	{$Query2 = "UPDATE ".TBL_TRIP_DET." SET drv_id = '".$did."',
				tripassign_time = '$current_time' WHERE tdid = '".$tid."'";
		$db->execute($Query2);
		echo 1;}else{echo 0;}
	$db->close();
?> 