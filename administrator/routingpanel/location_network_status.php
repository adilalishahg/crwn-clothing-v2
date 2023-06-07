<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$g2 = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0'  ORDER BY  fname ASC";
 	if($db->query($g2) && $db->get_num_rows() > 0)
	{	$data = $db->fetch_all_assoc();	}
	$db->close();
	//  print_r($data);
    $pgTitle = "Admin Panel -- Routing Panel";
	$smarty ->assign("data",$data);
	$smarty->display('rpaneltpl/location_network_status.tpl');
?>