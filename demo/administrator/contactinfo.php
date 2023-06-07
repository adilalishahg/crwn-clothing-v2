<?php
	/* *************************** *
	* Date: 12-May-2009 
	* admin_profile.php
	* Abrar Kiyani
	*************************** */
	
	include('include_file.php');
	$user_name = $_SESSION['adminuser'];
	$db = new Database;	
	
	$error = '';
	$msg   = '';
	
	$db->connect();
	
	if(count($_POST)){
		$admin_name		=	sql_replace($_POST['admin_name']);
		$admin_contact	=	sql_replace($_POST['admin_contact']);
		$email			=	sql_replace($_POST['email']);
	
		if(!$error){
			$Query  = "UPDATE contactus SET 
			admin_name='$admin_name', 
			admin_contact='$admin_contact', 
			email = '$email' 
			WHERE id =1";
	
			if($db->query($Query)){
				$msg .= "Profile Updated Successfully<br>";
			}else{
				$msg .= "Profile Updating Failed<br>";
			}
		}
	}else{
		$qry = "SELECT * FROM contactus WHERE id = 1";
		if($db->query($qry) && $db->get_num_rows()){
			$info = $db->fetch_all_assoc();
		}
		$admin_name = $info[0]['admin_name'];
		$admin_contact = $info[0]['admin_contact'];
		$email = $info[0]['email'];	
	}
	
	$db->close();
	$pgTitle = "Admin Panel -- Manage Contact Information";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("errors",$error);
	$smarty->assign("msgs",$msg);	
	$smarty->assign("admin_name",$admin_name);
	$smarty->assign("admin_contact",$admin_contact);	
	$smarty->assign("admin_email",$email);		
	$smarty->display('contactinfo.tpl');

?>