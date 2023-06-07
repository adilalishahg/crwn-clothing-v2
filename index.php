<?php

 /* echo '<script>window.open("administrator","_parent");</script>'; exit; */



 include_once('includefile.php');



/*  if(!isset($_SESSION['allowUser']) || $_SESSION['allowUser'] == ''){

	echo '<script>location.href="login.php";</script>';

	exit; }*/

 //   print_r($_SESSION);



$Qhomecontent="SELECT * FROM contents WHERE name='$pg'"; 



if($db->query($Qhomecontent) && $db->get_num_rows()>0){	

	$homecontent=$db->fetch_one_assoc(); 

}

$Qhomecontent2="SELECT * FROM contents WHERE name='request'"; 



if($db->query($Qhomecontent2) && $db->get_num_rows()>0){	

	$homecontent2=$db->fetch_one_assoc(); 

}

$services="SELECT * FROM services ORDER BY id "; 

if($db->query($services) && $db->get_num_rows()>0){	

	$servicesdata=$db->fetch_all_assoc(); 

}



$db->close();



//print_r($homecontent);

$smarty->assign("contentdata",$homecontent);

$smarty->assign("contentdata2",$homecontent2);

$smarty->assign("servicesdata",$servicesdata);

//	$smarty->assign("pg",$name);

$smarty->assign("foot",$foot);			

$smarty->display('index.tpl');

