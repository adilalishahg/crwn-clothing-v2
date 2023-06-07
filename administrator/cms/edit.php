<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
    $eId = intval($_REQUEST['eId']);
if(isset($_POST['admusersub']))
{  		$title	 	= sql_replace($_POST['title']);
	   	$name		= sql_replace($_POST['name']);
		$content	= sql_replace($_POST['content']);
		if($error == '')
			 {
			  			$Query3  = "UPDATE ".contents." SET 
						 				title		=	'$title',
										name		=	'$name',
										content		=	'$content'  WHERE id='$eId'";
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
{	$getDetails = "SELECT * FROM ".contents." WHERE id='$eId'"; 
	if($db->query($getDetails) && $db->get_num_rows() > 0)	{	$data = $db->fetch_one_assoc();  	}  }
$db->close();
$pgTitle = "Admin Panel -- [Edit]";	
$smarty->assign("title",$title);
$smarty->assign("pgname",$pgname);		
$smarty->assign("msgs",$msgs);
$smarty->assign("errors",$error);
$smarty->assign("data",$data);
$smarty->assign("eId",$eId);
$smarty->display('cms/edit.tpl');
?>