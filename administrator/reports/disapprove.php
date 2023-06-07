<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
$id = $_POST['tripid'];
$reqid = $_POST['req_id'];

$Query = "UPDATE ".TBL_FORMS." SET reqstatus = 'disapproved' WHERE id ='$id' AND req_id = '$reqid' ";
$db->execute($Query);
	$db->close();
echo 'Disapproved';
		
?>