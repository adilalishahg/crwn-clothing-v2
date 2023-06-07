<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
  if(isset($_POST['admusersub']))
	   {
	   	$location	    	= sql_replace($_POST['location']);
	   	$address	= sql_replace($_POST['address']);
	  // if(!$name){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Type is Missing !<br>"; }
	    
    if($error == '')
         {
		  $Query3  = "INSERT INTO ".locations." SET 
		  					location		='$location',
							address	='$address'
							";
					
		  if($db->execute($Query3))
		    {			  		   
		  echo '<script>alert("Location added Successfully");</script>';
		  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}else{
			  echo '<script>alert("Unable to add Location ");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
	}
	 $gstat = "SELECT * FROM ".TBL_STATES; if($db->query($gstat) && $db->get_num_rows() > 0){ $slist=$db->fetch_all_assoc();}
	
	$db->close();
    $pgTitle = "Admin Panel --[Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("post",$_POST);
	$smarty->assign("slist",$slist);
	$smarty->display('locations/add.tpl');	
?>