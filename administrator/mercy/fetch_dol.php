<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
		if(isset($_POST['id'])) {
			$id = sql_replace($_POST['id']);	
			if($id != '') {
		$returnedData = '';
       	$Query = "SELECT * FROM hospitals WHERE id='$id'";
                if($db->query($Query) && $db->get_num_rows() > 0)
	                 {
					 $Details = $db->fetch_all_assoc();     			
	         		 }
		$returnedData .= str_replace(",",".",$Details[0]['street_address']).'^'.$Details[0]['city'].'^'.$Details[0]['state'];											        $returnedData .= '^'.$Details[0]['postcode'].'^'.$Details[0]['telephone'];	
				echo $returnedData;	
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
		} else {
			echo 'There should be no direct access to this script!';
		}
?>