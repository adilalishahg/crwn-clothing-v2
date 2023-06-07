<?php
   	/* *************************** *
	   * Date: 17-Nov-2009 
	   * admin_profile.php
	   * Fahad Waheed Khan
	   *************************** */

   	//include_once('DBAccess/Database.inc.php');
	include_once('DBAccess/Database.inc.php');
	$db = new Database;	

	$error = '';
	$msg   = '';
	$user_name = $_SESSION['adminuser'];
		
	$db->connect();
	
	if(count($_POST)){
		$admin_user = sql_replace($_POST['admin_user']);
		$admin_name = sql_replace($_POST['admin_name']);
		
		if(!$error){
		$Query  = "UPDATE ".TBL_ADMIN." SET 
		           admin_uname='$admin_user', 
				   admin_name='$admin_name' 
				   WHERE admin_uname ='".$user_name."'";
		  
		  if($db->execute($Query))
		    {
			  $msg = "Profile Updated Successfully<br>";
			  unset($_SESSION['adminuser']);
			  $_SESSION['adminuser'] = $admin_user;
			}
		  else{
		      $msg = "Profile Updating Failed<br>";
		  
		  } // end if
    	}
	 }
	else{
	 $qry = "SELECT * FROM ".TBL_ADMIN." WHERE admin_uname ='".$user_name."'";
     if($db->query($qry) && $db->get_num_rows())
	  {
      $info = $db->fetch_all_assoc();
	  }
		$admin_user = $info[0]['admin_uname'];
		$admin_name = $info[0]['admin_name'];
	}
		
	$db->close();
    $pgTitle = "Admin Panel -- Manage Profile";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("errors",$error);
	$smarty->assign("msgs",$msg);	
	$smarty->assign("admin_user",$admin_user);
    $smarty->assign("admin_name",$admin_name);	
    //$smarty->assign("admin_email",$email);		
	$smarty->display('admin_profile.tpl');
		
?>