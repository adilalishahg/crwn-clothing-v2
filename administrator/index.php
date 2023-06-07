<?php
   	require_once('DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$expired=0;
	$expiring=0;
	  $upmonth 	= date('Y-m-d',strtotime("+ 1 month"));
	  $today	= date('Y-m-d');
	$Querypg = "SELECT vnumber FROM ".TBL_VEHICLES." WHERE del = '0' AND expireon < '".$upmonth."'";	
	if($db->query($Querypg) && $db->get_num_rows() > 0)
	{   $expiredata = $db->fetch_all_assoc();      $expiredata2 = $db->get_num_rows();	}
	
	$Querypg2 = "SELECT vnumber FROM ".TBL_VEHICLES." WHERE del = '0' AND expireon < '".$today."'";	
	if($db->query($Querypg2) && $db->get_num_rows() > 0)
	{   $expired = $db->get_num_rows();	}
	$expiring = ($expiredata2-$expired);

	
	//print_r($expiredata2); 
	$db->close();
	$pgTitle = "Admin Panel -- Home";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("expiredata2",$expiredata2);
	$smarty->assign("expiredata",$expiredata);
	$smarty->assign("expiring",$expiring);
	$smarty->assign("expired",$expired);
    $smarty->display('index.tpl');
?>