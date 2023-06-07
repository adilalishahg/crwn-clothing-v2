<?php
	include_once('DBAccess/Database.inc.php');
	$db = new Database;	
	$error = '';
	$msg   = '';
	$db->connect();
	if(count($_POST)){
		$ts			=	$_POST['ts'];
		$te			=	$_POST['te'];
		$ts_rad		=	$_POST['ts_rad'];
		$te_rad		=	$_POST['te_rad'];
		
		
		// print_r($_POST);// exit;
		 $Query  = "UPDATE ".contact_info." SET 
		           endtime 		=	'".convertinto24($te,$te_rad)."',
				   starttime 	=	'".convertinto24($ts,$ts_rad)."' 
				   WHERE c_id  	=	'1'";
		  if($db->query($Query))  {  echo 1;	}else {echo '';}
	 exit; }
	 
	$qry ="SELECT starttime,endtime FROM ".contact_info;
	if($db->query($qry) && $db->get_num_rows() > 0){
		$timing = $db->fetch_one_assoc();
		
		//convertDateFromMySQL();
		
		
 }	
//  print_r($timing['endtime']);exit;
    $db->close();
    $pgTitle = "Admin Panel -- Manage Timing";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("errors",$error);
	$smarty->assign("msgs",$msg);	
	$smarty->assign("starttime",($timing['starttime']));
	// $smarty->assign("starttime",date('h:i:s',strtotime($timing['starttime'])));
	$smarty->assign("starttime_rad",($timing['starttime']));
	// $smarty->assign("starttime_rad",date('h:i:s',strtotime($timing['starttime'])));
	$smarty->assign("endtime",date($timing['endtime']));
	// $smarty->assign("endtime",date('h:i:s',strtotime($timing['endtime'])));
	$smarty->assign("endtime_rad",date($timing['endtime']));
	// $smarty->assign("endtime_rad",date('h:i:s',strtotime($timing['endtime'])));
	//$smarty->assign("timing",$timing);
	//$smarty->assign("timing",$timing);
	//$smarty->assign("timing",$timing);		
	$smarty->display('operatinghours.tpl');
?>