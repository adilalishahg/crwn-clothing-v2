<?php
   	include_once('../DBAccess/Database.inc.php');	
	$db = new Database;	
	$db->connect();
	if(isset($_POST['amount']) && $_POST['amount'] > 0) {
		$id = sql_replace($_POST['id']);
		$amount = sql_replace($_POST['amount']);	
		if($id != '') {
			$Qselect="SELECT * FROM billing_info WHERE id ='".$id."'";
		if($db->query($Qselect) && $db->get_num_rows() > 0){	$data = $db->fetch_one_assoc(); 
		$paystatus='';
		if($data['charges'] > $amount){$paystatus = ",paystatus='2'";}else{$paystatus = ",paystatus='1'";}
		}
			
			
		  $Query  = "UPDATE billing_info SET partial_collected = '$amount' $paystatus   WHERE id='$id'";
		   $db->execute($Query);	
		  echo 'success';
		}else{
			echo '';
		}
	}else{
		echo '';
	}
?>