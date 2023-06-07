<?php
/* *************************** *
	   * Created On : 21th August,2008 
	   * File : cms/addpage.php
	   * Created By : Danish Ejaz Qureshi
	   * Modified On : 20th August,2008 
	   * Modified By : Danish Ejaz Qureshi
	   *************************** */
   	

   	include_once('../DBAccess/Database.inc.php');
	
	$db = new Database;	
		
	$msgs   = '';
	$errors = '';
		
	$db->connect();
    $id = intval($_GET['id']);

 $vQuery = "SELECT fname, lname, Drvid, drv_code FROM ".TBL_DRIVERS." where del= '0' ";
   if($db->query($vQuery) && $db->get_num_rows() > 0)
	{   $vlist = $db->fetch_all_assoc();	} 

	
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [Select Vehicle to View Tickets History]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("vlist",$vlist);
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->display('tkttpl/gettckhistory.tpl');
		
?>