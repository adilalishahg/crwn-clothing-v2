<?php

   	/* *************************** *
	   * Date: 12-May-2009 
	   * changepass.php
	   * Abrar Kiyani
	   *************************** */
	   
   	//include_once('DBAccess/Database.inc.php');
	include_once('DBAccess/Database.inc.php');
	$db = new Database;	

	$error = '';
	$msg   = '';
		
	$db->connect();
	
	if(count($_POST)){
		$adminOldpass = sql_replace($_POST['adminOldpass']);
		$adminpass1 = sql_replace($_POST['adminpass1']);
		$adminpass2 = sql_replace($_POST['adminpass2']);
		
		if($adminOldpass == $adminpass1){
		  $error .= "New Password Must Not Be Same As Old One!<br>";		
		}
		
		$old= $adminOldpass;
		//echo $old."<br>";
		//exit;
		if($old){
		
	$oldPass  = "SELECT admin_uname,admin_password FROM " . TBL_ADMIN . " WHERE  admin_password ='" . $old . "'";
		 //echo $oldPass;
		 //exit;
		  if($db->query($oldPass) && mysql_affected_rows() < 1)
		    {
			  $error .= "Invalid Old Password<br>";

}	
		  $ro = mysql_fetch_array(mysql_query($oldPass));
		  $uname = $ro['admin_uname'];

}
			
		if(!empty($adminpass1) && $adminpass2){
		if($adminpass1 != $adminpass2){
		  $error .= "Mismatched New Passwords!<br>";		
		}
		}		

			
		if(!$error){
		
		$ps = $adminpass1;
		
		 $Query  = "UPDATE " . TBL_ADMIN . " SET admin_password='$ps' WHERE  
		             admin_uname ='" . $uname . "'";
					
		 	 
		  if($db->query($Query))
		    {
			  $msg .= "Password Changed Successfully<br>";
			}
		  else{
		      $msg .= "Invalid Old Password<br>";
		  
		  } // end if
    	}
	 }
	
		
	$db->close();
    $pgTitle = "Admin Panel -- Change Password";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("errors",$error);
	$smarty->assign("msgs",$msg);	
	$smarty->assign("adminname",$adminname);
    $smarty->assign("adminpass",$adminpass);	
	$smarty->display('changepass.tpl');
		
?>