<?php
	include_once('../DBAccess/Database.inc.php');
  if(isset($_POST['admusersub']))
	   {
		$domain = str_replace('www.','',$_SERVER['HTTP_HOST']); 
	   	//$domain = 'hybriditservices.com/httmedical';
		$device_id	    = sql_replace(str_replace(' ','',$_POST['device_id']));	
	   if(!$device_id)

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Device ID Missing !<br>"; }
 if(!$error){
	 $data = (@file_get_contents('http://www.hybriditservices.com/devices/adddevice.php?domain='.$domain.'&device_id='.$device_id));
	 
			  echo '<script>alert("Device added Successfully");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
	}

}		
    $pgTitle = "Admin Panel -- [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("prgtitle",$prgtitle);
	$smarty->assign("prgassoctitle",$prgassoctitle);
	$smarty->display('devices/add.tpl');	
?>