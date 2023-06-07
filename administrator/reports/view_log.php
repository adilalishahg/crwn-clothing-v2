<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$id = $_GET['id'];
	$reqid = $_GET['reqid'];	
	$query_select = "SELECT transportation_log  FROM ".TBL_FORMS." WHERE id = '$id' AND req_id = '$reqid' ";
	if($db->query($query_select) && $db->get_num_rows() > 0){
		$data = $db->fetch_all_assoc();   }
		$transportation_log = $data[0]['transportation_log'];
		
		
	$db->close();
    $smarty->assign("pgTitle",' Transportation Log');
	$smarty->assign("transportation_log",$transportation_log);
	$smarty->display('reportstpl/view_log.tpl');
?>