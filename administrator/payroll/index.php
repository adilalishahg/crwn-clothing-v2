<?php

   	/* *************************** *

	   * Date: 30-Jan-2010

	   * Attendance/index.php

	   * Abid Malik

	   *************************** */



include_once('../DBAccess/Database.inc.php');

	//Get Server Time
	 $curtime_data = get_server_time();
	 $curdate = $curtime_data[1]; //Time
	 $curtime = $curtime_data[0]; //Time
	 
	 $ttrim = explode(':',$curtime);
	 $sdate = explode('-',$curdate);     

    $pgTitle = "Admin Panel -- Attendance Management";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign('sdate',$sdate);
	$smarty->assign('ttrim',$ttrim);
	$smarty->assign("pages",$pages);
	$smarty->assign("st",$st);	
	$smarty->display('payrolltpl/index.tpl');
?>  