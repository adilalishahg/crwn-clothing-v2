<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
	if(isset($_GET['action']) && $_GET['action'] == 'add_reg_id'){
	$reg_id	= sql_replace($_GET['reg_id']);
	$udid 	= sql_replace($_GET['udid']);
	$Qdel="DELETE FROM registered_ids WHERE udid = '$udid'"; $db->execute($Qdel);
	$queryadd = "INSERT INTO registered_ids SET 
					reg_id	=	'$reg_id',
					udid	=	'$udid',
					created_date=	NOW() ";
				if($db->execute($queryadd)){
				$jsonarray = array();
				 $jsonarray['status'] 	= 'true';
				 				 
				 echo json_encode($jsonarray);
					} else{
						$jsonarray = array();
				 $jsonarray['status'] 	= 'false';
				 echo json_encode($jsonarray); } 
		 }
	
$db->close();
?>