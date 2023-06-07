<?php
   	include_once('DBAccess/Database2.inc.php');
   	include_once('Classes/MyMailer.php');	
	//print_r($_SESSION['user2']);  echo $_SESSION['allowUser2'];
	$db = new Database;	
	$db->connect();
	$getDetails = "SELECT * FROM ".contents." WHERE TRIM(LOWER(name))='terms'"; 
	if($db->query($getDetails) && $db->get_num_rows() > 0)	{	$data = $db->fetch_one_assoc();  	}

 include_once('includefile.php');
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
	//print_r($userData);
	$smarty->assign("data",$data);

	$smarty->display('terms.tpl');	
?>