<?php 
include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
	$Qhomecontent="SELECT * FROM contents WHERE name='home'"; 
if($db->query($Qhomecontent) && $db->get_num_rows()>0){	$homecontent=$db->fetch_all_assoc(); }

$qry_footer  = "SELECT * FROM " .  TBL_COPY_RIGHTS ;
	if($db->query($qry_footer) && $db->get_num_rows() > 0){	$footer = $db->fetch_one_assoc();	$smarty->assign("footer",$footer); 	 }
$Qhomecontentfooter="SELECT * FROM contents WHERE name='footertext'"; 
if($db->query($Qhomecontentfooter) && $db->get_num_rows()>0){ $footertext=$db->fetch_one_assoc(); $smarty->assign("footertext",$footertext);}	
$Qcontactinfo="SELECT * FROM contact_info WHERE c_id = '1'";
if($db->query($Qcontactinfo) && $db->get_num_rows()>0){	$contactinfo=$db->fetch_one_assoc();  $smarty->assign("contactinfo",$contactinfo);}	 

$smarty->assign("contentdata",$homecontent);
$pagetitle='';
 $pg=$_REQUEST['pg'];
 if($pg==''){$pg='home'; }
  $smarty->assign("pg",$pg); 
?>