<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;
	$id 		= ($_POST['id']);
	$db->connect();
				if(!empty($id) ){
				 $sql = "DELETE FROM request_info WHERE id = '$id' ";
				 $sq2 = "DELETE FROM trips WHERE reqid = '$id' "; 
				 $sq3 = "DELETE FROM trip_details WHERE reqid = '$id' "; 
				 $sq4 = "DELETE FROM billing_info WHERE trip_id = '$id' ";  
				  $db->execute($sql);
				  $db->execute($sq2);
				  $db->execute($sq3);
				  $db->execute($sq4); {	 echo 'Good';	}
				}
	$db->close();	
?> 