<?php
   	include_once('../DBAccess/Database.inc.php');
		$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id=$_REQUEST['id'];
				 	  
	$con = "SELECT * FROM ".receipts." WHERE id = '$id'";
    if($db->query($con) && $db->get_num_rows() > 0){
	 $data = $db->fetch_one_assoc(); }
	$db->close();
    //print_r($data);
	$smarty->assign("data",$data);				
	$smarty->display('reportstpl/receiptdatail.tpl');
?>