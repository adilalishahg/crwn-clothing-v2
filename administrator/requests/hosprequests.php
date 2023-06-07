<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
 if(isset($_POST['ustatus'])){
	$Query  = "UPDATE ".TBL_FORMS." SET reqstatus='".$_POST['ustatus']."' WHERE id='".$_POST['id']."'";
	  if($db->execute($Query)){
            if($sending == 'yes'){  echo 'Success'; }
			}else{ echo 'Fail';	 }
        }else{ echo 'Fail'; }	
  $db->close();
  exit;
?>