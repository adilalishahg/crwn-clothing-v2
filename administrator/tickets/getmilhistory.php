<?php
   	/* *************************** *
	   * Date: 30-Jan-2010
	   * Attendance/index.php
	   * Abid Malik
	   *************************** */
   	

   	include_once('../DBAccess/Database.inc.php');
	
	$db = new Database;	
		
	$msgs   = '';
	$errors = '';
		
	$db->connect();
    $id = intval($_GET['id']);

 $vQuery = "SELECT * FROM ".TBL_VEHICLES." WHERE vstatus='Open'";
   if($db->query($vQuery) && $db->get_num_rows() > 0)
	{
		$vlist = $db->fetch_all_assoc();	
	} 
	
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [Select Vehicle to View Fuel History]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("vlist",$vlist);
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->display('vehtpl/getmilhistory.tpl');
		
?>