<?php
include_once('../DBAccess/Database.inc.php');
//include_once('../routingpanel/sendAPNS.php');
include_once('../routingpanel/sendpush.php');
	$db = new Database;	
	$db->connect();
    $id		=	$_REQUEST['id'];
	$val	=	$_REQUEST['val'];
	if($id!='' && $val!=''){
	$Query = "UPDATE  ".attendance." SET  approval = '".$val."' WHERE id = '".$id."'";
	if($db->execute($Query)){
	$Query2 = "SELECT * FROM ".attendance." WHERE id = '".$id."'";
	if($db->query($Query2) && $db->get_num_rows()>0){ $data=$db->fetch_one_assoc();
	$Query3 = "SELECT * FROM ".drivers." WHERE Drvid = '".$data['driver_id']."'";
	if($db->query($Query3) && $db->get_num_rows()>0){ $data2=$db->fetch_one_assoc(); 
	$message_admin 	= 'Your working hours for date :'.date('m/d/Y',strtotime($data['dated'])).' Approved';
	$driver_code 	= $data2['drv_code'];
	if($val=='approved'){ 	sendpush($driver_code,$message_admin,$db); }
		 }	}
	echo 1;}
	} 	
?>