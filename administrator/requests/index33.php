<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
      if(isset($_POST['submit'])){
			 //END OF REOCCURING TRIPS
		$pendingids = $_POST['pendingids'];
		$pendingids=explode("@",$pendingids);
		if($pendingids){ for($u=0;$u<sizeof($pendingids);$u++){
			$D1="DELETE FROM ".TBL_FORMS." WHERE id ='".$pendingids[$u]."' ";
			$D2="DELETE FROM trips WHERE reqid ='".$pendingids[$u]."' ";
			$D3="DELETE FROM trip_details WHERE reqid ='".$pendingids[$u]."' "; 
			$db->execute($D1); $db->execute($D2); $db->execute($D3); }
		}
			   $sent = 1;		   
				 if(1){
				   $msg = ' You have Successfully Submitted the Request.';
				   echo '<script>alert("Records Deleted Successfully!");
								window.open("onego2.php","_parent");</script>'; exit;
			}   
      
      
	  } 
?>