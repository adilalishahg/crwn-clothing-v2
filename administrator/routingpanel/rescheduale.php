<?php
require_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect(); 
		include_once('../include_file.php');
		$Qofficecor = "SELECT * FROM contact_info WHERE c_id = '1' "; 
	if($db->query($Qofficecor) && $db->get_num_rows()>0){  $corgeodata = $db->fetch_one_assoc();  }
	$corpo_latlong 	= $corgeodata['address'].','.$corgeodata['city'].','.$corgeodata['state'].' '.$corgeodata['zip'];
	$starttime 		= $corgeodata['starttime'];
	list($hours, $minutes, $seconds)= explode(":",$starttime);
			$free_from 			= ($hours*3600+$minutes*60+$seconds);			
					$Qup1 = "UPDATE free_driver SET 	free_from 		=  '".$free_from."',drv_address='".$corpo_latlong."' "; 
						  									$db->query($Qup1);
					$Qup2 = "UPDATE trip_details SET 	drv_id 		=  '' WHERE date = '".$today."' "; 
						  									$db->query($Qup2);										
	$db->close();
	echo "<script>window.open('autoscheduale.php?date=$today','_parent');</script>"; exit;
    ?>