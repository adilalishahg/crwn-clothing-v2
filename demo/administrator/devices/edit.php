<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	$db = new Database;	
	$mail = new MyMailer;
	$msgs   = '';
	$errors = '';
	$db->connect();
    $eId = intval($_GET['eId']);
if(isset($_POST['admusersub']))
		{
	   $prgtitle   = sql_replace($_POST['prgtitle']);	
	   $prgassoctitle   = sql_replace($_POST['prgassoctitle']);	
	   $prgstatus  = sql_replace($_POST['prgstatus']);	
  if(!$prgtitle)
	    {
			$error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Title Missing !<br>"; 
		}
	   if(!$prgassoctitle)
	    { 
	$error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Associated Label Title Missing !<br>"; 
		}
	  if(!$error)
	  {
	 	$chkEmail = "SELECT * FROM ".TBL_PROGRAM." WHERE prgtitle='$prgtitle' AND prgid != '$eId'"; 
			if($db->query($chkEmail) && $db->get_num_rows() > 0)
			 {
$error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Program Title already exists, Try another one.<br>";  
			 }
		if($error == '')
			 {
		  			$Query3  = "UPDATE ".TBL_PROGRAM." SET 
						  prgtitle='$prgtitle',
						  prgassoctitle = '$prgassoctitle',
						  prgstatus='$prgstatus'
						  WHERE prgid='$eId'";
			  if($db->execute($Query3))
				{
				  echo '<script>alert("Program Type Edit Successfully!");</script>';
					  echo '<script>window.open("index.php","_parent");</script>';			  
				  exit;
				}
				else
				{
					  echo '<script>alert("Unable to edit Program Type");</script>';
					  echo '<script>window.open("index.php","_parent");</script>';			  
					  exit;
				}

					

				}

	}

	

}

else

{

	//Get User details

	$getDetails = "SELECT * FROM ".TBL_PROGRAM." WHERE prgid='$eId'"; 

	

	if($db->query($getDetails) && $db->get_num_rows() > 0)

	{

		$data = $db->fetch_all_assoc();   

	}  

	

	$prgtitle	    = $data[0]['prgtitle'];

	$prgassoctitle  = $data[0]['prgassoctitle'];

	$prgstatus  	= $data[0]['prgstatus'];			

}

				   

						

$db->close();



$pgTitle = "Admin Panel -- Admin Users [Edit]";	

$smarty->assign("title",$title);

$smarty->assign("pgname",$pgname);		

$smarty->assign("msgs",$msgs);

$smarty->assign("errors",$error);

$smarty->assign("prgtitle",$prgtitle);

$smarty->assign("prgassoctitle",$prgassoctitle);

$smarty->assign("prgstatus",$prgstatus);

$smarty->assign("eId",$eId);	

$smarty->display('prgtpl/editprg.tpl');



?>