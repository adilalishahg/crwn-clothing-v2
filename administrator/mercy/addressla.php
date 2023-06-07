<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
		if(isset($_POST['id'])) {
			$id = sql_replace($_POST['id']);
			$loc = trim(sql_replace($_POST['loc']));	
			if($id != '' && $loc !='') {
		   	$Query = "SELECT * FROM locations WHERE location='$loc' ORDER BY id LIMIT 1"; 
                if($db->query($Query) && $db->get_num_rows() > 0)  { $address = $db->fetch_one_assoc(); $q = explode(',',$address['address'],3); echo $q[0].', '.$q[2];  }  
			}
		}
?>