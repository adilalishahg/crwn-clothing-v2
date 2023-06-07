<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
    $eId = intval($_GET['eId']);
	 $gstat = "SELECT * FROM ".TBL_STATES;
		if($db->query($gstat) && $db->get_num_rows() > 0)
		 {
		   $slist = $db->fetch_all_assoc();		 
		 }
if(isset($_POST['admusersub']))
{
	   $account_name	    = sql_replace($_POST['account_name']);	
	   $address   			= sql_replace($_POST['address']);	
	   $city	    		= sql_replace($_POST['city']);	
	   $state   			= sql_replace($_POST['state']);	
	   $zip	    			= sql_replace($_POST['zip']);	
	   $phone   			= sql_replace($_POST['phone']);	
	   $freemiles  			= sql_replace($_POST['freemiles']);	
	   $rate_type  			= sql_replace($_POST['rate_type']);
	   $portal_access		= sql_replace($_POST['portalAccess']);
$chkuser = "SELECT * FROM accounts WHERE TRIM(LOWER(REPLACE(account_name,' ','')))='".strtolower(trim(str_replace(' ','',(sql_replace($_POST['account_name'])))))."' AND id!='$eId'"; 
		if($db->query($chkuser) && $db->get_num_rows() > 0)
		 {
		    $error .= "Account name already exists, Try another one.<br>";    
		 }		 
	$chkuser = "SELECT * FROM ".accounts." WHERE username='".sql_replace($_POST['username'])."' AND username!='' AND id!='$eId'"; 

		if($db->query($chkuser) && $db->get_num_rows() > 0)

		 {

		    $error .= "User name already exists, Try another one.<br>";    

		 }		 
		if($error == ''){ if($_SESSION['adminuser']=='NEMTUS'){$qr="pick_signature='".$_POST['pick_signature']."',drop_signature='".$_POST['drop_signature']."',";}
			$Query3  = "UPDATE ".accounts." SET 
			account_name	=	'$account_name',
			address			=	'$address',
			city			=	'$city',
			state			=	'$state',
			zip				=	'$zip',
			freemiles		=	'$freemiles',
			
			username		=	'".$_POST['username']."',
			password		=	'".$_POST['password']."',
			email			=	'".$_POST['email']."',
			portal_access	=	'".$_POST['portalAccess']."',
			$qr
			phone			=	'$phone'
			WHERE id		=	'$eId'";		/*rate_type		=	'$rate_type',*/
			
			$portalAcessQuery ="SELECT * FROM accounts WHERE portal_access=true";
			if($_POST['portalAccess']){
				if($db->query($portalAcessQuery) && $db->get_num_rows()<30){
					if($db->execute($Query3)){
						echo '<script>alert("Account Edit Successfully!");</script>';
						echo '<script>window.open("index.php","_parent");</script>';			  
						exit;
					}
					else{ 
						echo '<script>alert("Unable to edit Account");</script>';
						echo '<script>window.open("index.php","_parent");</script>';			  
						exit;
					}
				}
				else{
					echo '<script>alert("Account Portal Access Limit Reached");</script>';
					echo '<script>window.open("index.php","_parent");</script>';			  
					exit;
				}
			}else{
				if($db->execute($Query3)){
						echo '<script>alert("Account Edit Successfully!");</script>';
						echo '<script>window.open("index.php","_parent");</script>';			  
						exit;
					}
				
				}
		}
	}
	$getDetails = "SELECT * FROM ".accounts." WHERE id='$eId'"; 
	if($db->query($getDetails) && $db->get_num_rows() > 0)
	{
		$data = $db->fetch_one_assoc();   
	}  	
$db->close();
$pgTitle = "Admin Panel --  [Edit]";	
$smarty->assign("title",$title);
$smarty->assign("pgname",$pgname);		
$smarty->assign("msgs",$msgs);
$smarty->assign("errors",$error);
$smarty->assign("states",$slist);
$smarty->assign("data",$data);
$smarty->assign("eId",$eId);	
$smarty->display('accounts/edit.tpl');
?>