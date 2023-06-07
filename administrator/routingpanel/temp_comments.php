<?php
	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
$tdid=$_REQUEST['tdid'];
if($_POST){
	$QUp="UPDATE trip_details SET temp_comments = '".$_POST['temp_comments']."' WHERE tdid = '".$tdid."'";
	$db->query($QUp); echo '<script>window.close();</script>'; exit;
	}
	 $Qgetcom = "SELECT temp_comments,tdid FROM ".trip_details." WHERE tdid='".$tdid."'";
	  if($db->query($Qgetcom) && $db->get_num_rows())
		  {			  $cdata = $db->fetch_one_assoc(); 			  }		
	$temp_comments = $cdata['temp_comments'];
   	$smarty->assign("temp_comments",$temp_comments);
	$smarty->assign("tdid",$tdid);
	$smarty->display('rpaneltpl/temp_comments.tpl');
?>