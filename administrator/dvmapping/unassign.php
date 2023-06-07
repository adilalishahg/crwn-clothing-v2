<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$id=$_REQUEST['id'];
 $Query1 = "DELETE FROM ".TBL_DVMAPPING." WHERE drv_id='$id'";   $db->execute($Query1);   $db->close();
	echo '<script>window.open("index.php","_parent");</script>'; exit;
?> 