<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
  if(isset($_POST['admusersub']))
	   {
	   	$company   	= sql_replace($_POST['company']);
	   	$code		= sql_replace($_POST['code']);
	  // if(!$name){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Type is Missing !<br>"; }
	    
    if($error == '')
         {
		  $Query3  = "INSERT INTO ".companycodes." SET 
		  					company		='$company',
							code		='".strtoupper($code)."'";
					
		  if($db->execute($Query3))
		    {			  		   
		  echo '<script>alert("Company Code added Successfully");</script>';
		  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}else{
			  echo '<script>alert("Unable to add Company Code");</script>';
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
	$smarty->assign("slist",$slist);
	$smarty->display('ccode/add.tpl');	
?>