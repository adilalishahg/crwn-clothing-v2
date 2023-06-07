<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
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
	   
	  /* if(!$prgtitle)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Title Missing !<br>"; }
	   if(!$prgassoctitle)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Associated Label Missing !<br>"; }		
 if(!$error){
    $chkEmail = "SELECT * FROM ".accounts." WHERE prgtitle='$prgtitle'"; 
		if($db->query($chkEmail) && $db->get_num_rows() > 0)
		 {
		    $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Title already exists, Try another one.<br>";    
		 }		 */
    if($error == '')
         {
		  $Query3  = "INSERT INTO ".accounts." SET 
					account_name='$account_name',
					address='$address',
					city='$city',
					state='$state',
					zip='$zip',
					freemiles='$freemiles',
					rate_type='$rate_type',
					phone='$phone'";
		  if($db->execute($Query3))
		    {			  		   
			  echo '<script>alert("Account added Successfully");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}else{
			  echo '<script>alert("Unable to add Account");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
	}
	$db->close();
    $pgTitle = "Admin Panel -- Account [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("post",$_POST);
	$smarty->assign("states",$slist);
	$smarty->display('accounts/add.tpl');	
?>