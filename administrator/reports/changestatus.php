<?php
   	include_once('../DBAccess/Database.inc.php');	
	$db = new Database;	
	$db->connect();
		// Is there a posted query string?
	if(isset($_POST['pay']) && $_POST['pay'] != '') {
		$ps = sql_replace($_POST['pay']);	
		if($ps != '') {
		  $fid = $_POST['fid'];			
		  $Query  = "UPDATE ".billing_info." SET 
				   paystatus = '$ps'
				   WHERE id='$fid'";
		  $db->execute($Query);			
		  echo 'success';
		}else{
			echo '';
		}
	}else{
		echo '';
	}
?>