<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
		if(isset($_POST['h_id'])) {
			$h_id = sql_replace($_POST['h_id']);	
			if($h_id != '') {
				
		      $returnedData = '';
			  $Queryp = "SELECT prog_type FROM hospitals  
			          WHERE id='$h_id' ";
					   if($db->query($Queryp) && $db->get_num_rows() > 0)
	                 {
					 $Detailsp = $db->fetch_all_assoc();     			
	         		 }
					 $p_id =  $Detailsp[0]['prog_type'];
				$Query = "SELECT prgtitle,prgassoctitle FROM program_types  
			          WHERE prgid='$p_id' ";
                if($db->query($Query) && $db->get_num_rows() > 0)
	                 {
					 $Details = $db->fetch_all_assoc();     			
	         		 }
				//$prgtitle = $Details[0]['prgtitle'];
				//$prgassoctitle = $Details[0]['prgassoctitle'];
				$returnedData .= $Details[0]['prgtitle'].'^'.$Details[0]['prgassoctitle'];					
				echo $returnedData;	
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
		} else {
			echo 'There should be no direct access to this script!';
		}
?>