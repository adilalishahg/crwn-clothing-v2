<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
  if(isset($_POST['admusersub']))
	   {
	   	$title	 	= sql_replace($_POST['title']);
	   	$name		= sql_replace($_POST['name']);
		$content	= sql_replace($_POST['content']);
		
if($error == '')
         {
		  $Query3  = "INSERT INTO ".contents." SET 
		  					title		=	'$title',
							name		=	'$name',
							content		=	'$content' ";
		  if($db->execute($Query3))
		    {			  		   
		  echo '<script>alert("Record added Successfully");</script>';
		  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}else{
			  echo '<script>alert("Unable to add Record");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
	}
	
	$db->close();
    $pgTitle = "Admin Panel --[Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("post",$_POST);
	$smarty->display('cms/add.tpl');	
?>