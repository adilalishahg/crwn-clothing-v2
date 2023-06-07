<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
	if(isset($_GET['driverID']) && $_GET['driverMessage'] ){
	$message 		= sql_replace($_GET['driverMessage']);
	$driverID 		= sql_replace($_GET['driverID']);
	$qtime 			= $db->query('SELECT NOW() AS tym');
	$time 			= $db->fetch_one_assoc();
	$datetime 		= $time['tym'];
	$query = "INSERT INTO alerts SET alerts.to = 'admin', alerts.from = '$driverID', message = '$message', sent = '".date('Y-m-d H:i:s')."'";										if($db->execute($query)) {$jsonarray['status'] = 'true';} else {$jsonarray['status'] = 'false';}
} else { $jsonarray['status'] = 'false';}
echo json_encode($jsonarray);
$db->close();
?>