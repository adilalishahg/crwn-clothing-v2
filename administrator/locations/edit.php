<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
    $eId = intval($_REQUEST['eId']);
if(isset($_POST['admusersub']))
{
   		$location	= sql_replace($_POST['location']);
	   	$address	= sql_replace($_POST['address']);	
	  // if(!$name)  {$error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Title Missing !<br>"; }
		if($error == '')
			 {
			  			$Query3  = "UPDATE ".locations." SET 
						 	location		='$location',
							address	='$address'  WHERE id='$eId'";
			if($db->execute($Query3))
				{
					  echo '<script>alert("Updated Successfully!");</script>';
					  echo '<script>window.open("index.php","_parent");</script>';			  
					  exit;
				}
				else
				{
					  echo '<script>alert("Unable to Update!");</script>';
					  echo '<script>window.open("index.php","_parent");</script>';			  
					  exit;
				}
				}
	}
else
{	$getDetails = "SELECT * FROM ".locations." WHERE id='$eId'"; 
	if($db->query($getDetails) && $db->get_num_rows() > 0)	{	$data = $db->fetch_one_assoc();  	}  }
	 $gstat = "SELECT * FROM ".TBL_STATES; if($db->query($gstat) && $db->get_num_rows() > 0){ $slist=$db->fetch_all_assoc();}
$db->close();
$pgTitle = "Admin Panel -- Admin Users [Edit]";	
$smarty->assign("title",$title);
$smarty->assign("pgname",$pgname);		
$smarty->assign("msgs",$msgs);
$smarty->assign("errors",$error);
$smarty->assign("data",$data);
$smarty->assign("eId",$eId);
$smarty->assign("slist",$slist);	
$smarty->display('locations/edit.tpl');
?>