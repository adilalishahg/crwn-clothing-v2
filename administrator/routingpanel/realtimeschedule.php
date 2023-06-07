<?php
require_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect(); 
		include_once('../include_file.php');
		$today=date('Y-m-d');
		$Q2="SELECT DISTINCT(drv_id) FROM trip_details WHERE date = '$today'";
		if($db->query($Q2) && $db->get_num_rows() > 0){ $drvids = $db->fetch_all_assoc(); }
		//print_r($drvids); exit;
		$time= date("H:i:s", strtotime("+30 minutes")); 
		$Q1=" UPDATE trip_details SET drv_id = ''   WHERE date = '$today' AND pck_time > '".$time."'";	
		$db->query($Q1);
		list($hours, $minutes, $seconds)= explode(":",$time);
			$free_from 			= ($hours*3600+$minutes*60+$seconds);
		$Qup2="UPDATE free_driver SET free_from = '".$free_from."' WHERE at_date = '".$today."'";
		   $db->query($Qup2); 
		 for($i = 0;$i<sizeof($drvids);$i++)
		   { $Q3="SELECT * FROM trip_details WHERE date = '$today' AND drv_id= '".$drvids[$i]['drv_id']."' AND status IN ('1','4','5','6') ORDER BY pck_time DESC LIMIT 1";
		   if($db->query($Q3) && $db->get_num_rows() > 0){ $lastupdates = $db->fetch_one_assoc(); 
		   list($hours, $minutes, $seconds)= explode(":",$lastupdates['drp_ptime']);
			$free_from 			= ($hours*3600+$minutes*60+$seconds);
			$Qup="UPDATE free_driver SET free_from = '".$free_from."', drv_address='".$lastupdates['drp_add']."' WHERE drv_code = '".$lastupdates['drv_id']."' AND at_date = '".$today."'";
		   $db->query($Qup);
		   //print_r($lastupdates); exit;
		   }
		   }						
	$db->close();
	echo "<script>window.open('autoscheduale.php?date=$today','_parent');</script>"; exit;
    ?>