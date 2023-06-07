<?php
   	include_once('../DBAccess/Database.inc.php');
  //  include('../Classes/pagination-class.php');	
	$db = new Database;	
	$db->connect();
	$date 	= date('Y-m-d');	
	
	$sqlUp = "UPDATE alerts set recd=1 WHERE sent <= '".date('Y-m-d H:i:s')."' AND alerts.to = 'admin' AND message !='Driver GPS is Disabled'";
	$db->execute($sqlUp);	
		
 	$qcount  = "SELECT  a.*,d.fname,d.lname FROM ".alerts." as a LEFT JOIN drivers as d on a.to=d.drv_code || a.from=d.drv_code WHERE a.sent BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' AND a.message !='Driver GPS is Disabled' ORDER BY sent DESC";
	if($db->query($qcount) && $db->get_num_rows() > 0)
		{ $data = $db->fetch_all_assoc(); }
/*   	 $query2 = "SELECT  drv_code, fname, lname FROM ".TBL_DRIVERS."  Where drv_code = '$drv_id' ORDER BY fname ASC";
	if($db->query($query2) && $db->get_num_rows() > 0)
	{		$driver2 = $db->fetch_one_assoc();	}
	$query = "SELECT  drv_code, fname, lname FROM ".TBL_DRIVERS." as a  Where a.drvstatus = 'Active' ORDER BY fname ASC";
	if($db->query($query) && $db->get_num_rows() > 0)
	{		$driver = $db->fetch_all_assoc();	}*/
	$db->close();
	//print_r($data);
	$smarty->assign("data",$data);
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->display('rpaneltpl/chat.tpl');
?>