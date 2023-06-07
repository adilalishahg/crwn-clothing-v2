<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db->connect();
$v_ids = '';
if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0){ $id = $_REQUEST['id'];
$query="SELECT vt.vehtype,cr.* FROM vehtype as vt left join clinic_rates as cr on vt.id = cr.vehtype_id WHERE clinic_id = '$id'";
		if($db->query($query) && $db->get_num_rows() > 0)
		{ $v_rates = $db->fetch_all_assoc(); 		
		for($i=0; $i<sizeof($v_rates); $i++){
			$v_ids .= $v_rates[$i]['vehtype_id'].',';
			} $v_ids = substr($v_ids, 0, -1);
		}	}
		if(($v_ids=='')){$v_ids = 0; }
 $query2="SELECT id,vehtype FROM vehtype WHERE id NOT IN($v_ids)";
if($db->query($query2) && $db->get_num_rows() > 0)		{  $v_types = $db->fetch_all_assoc();   } 
$query3="SELECT account_name FROM accounts WHERE id = '$id' ";
if($db->query($query3) && $db->get_num_rows() > 0)		{  $host_info = $db->fetch_one_assoc(); } 
	$db->close();
	$smarty->assign("v_rates",$v_rates);
	$smarty->assign("v_types",$v_types);
	$smarty->assign("id",$id);	
	$smarty->assign("host_info",$host_info);			
	$smarty->display('rate_management/index.tpl');
?>  