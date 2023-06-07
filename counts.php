<?php

include_once('DBAccess/Database2.inc.php');

	$db = new Database;	

	$db->connect();

	$dt = array();

	$getDriver = "SELECT COUNT(drvstatus) as count FROM ".TBL_DRIVERS." WHERE drvstatus='Active' ";

 	if($db->query($getDriver) && $db->get_num_rows())	{$driverdata = $db->fetch_one_assoc(); 	}

	$dt['activedrivers']=$driverdata['count'];

	

	$Q2 = "SELECT COUNT(id) as count FROM vehicles WHERE vstatus='Open' ";

 	if($db->query($Q2) && $db->get_num_rows())	{$vehiclesdata = $db->fetch_one_assoc(); 	}

	$dt['activevehicles']=$vehiclesdata['count'];

	

	$Q3 = "SELECT COUNT(tdid) as count FROM trip_details WHERE date BETWEEN '".@$_REQUEST['startdate']."' AND '".@$_REQUEST['enddate']."' ";

 	if($db->query($Q3) && $db->get_num_rows())	{$tripsdata = $db->fetch_one_assoc(); 	}

	$dt['alltrips']=$tripsdata['count'];

	

	echo json_encode($dt);

	

	

	

	

	

	//echo $vehiclesdata['count'];

?>