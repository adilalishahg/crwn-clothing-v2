<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db->connect();
	$id  = $_POST['id'];
	$query="DELETE FROM clinic_rates WHERE id='$id'"; 
		$db->query($query); 
		echo 1;
	?>  