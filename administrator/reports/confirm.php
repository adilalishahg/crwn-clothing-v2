<?php

   	/* *************************** *
	   * Date: 12-May-2009 
	   * changepass.php
	   * Abrar Kiyani
	   *************************** */
	   
   	//include_once('DBAccess/Database.inc.php');
	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	

	$error = '';
	$msg   = '';
		
	$db->connect();
    $id=$_GET['id'];
    $reqid=$_GET['reqid'];
	
		
	$db->close();
    $pgTitle = "Admin Panel -- Change Password";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("id",$id);

	
	$smarty->assign("reqid",$reqid);
	$smarty->assign("errors",$error);
	$smarty->assign("msgs",$msg);	
	$smarty->assign("adminname",$adminname);
    $smarty->assign("adminpass",$adminpass);	
	$smarty->display('reqtpls/confirm.tpl');
		
?>