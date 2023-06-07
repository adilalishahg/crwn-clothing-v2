<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db->connect();
$v_ids = '';
$Queryhosp1 = "SELECT ac.id,ac.account_name FROM ".accounts." ac  WHERE TRIM(LOWER(REPLACE(account_name,' ','')))='".strtolower(trim('logisticcare'))."' ORDER BY ac.account_name ASC";
   if($db->query($Queryhosp1) && $db->get_num_rows() > 0)
	{	   $hosp = $db->fetch_one_assoc(); $logiticid = $hosp['id'];    }
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
/*$query3="SELECT account_name FROM accounts WHERE id = '$id' ";
if($db->query($query3) && $db->get_num_rows() > 0)		{  $host_info = $db->fetch_one_assoc(); } */
	$db->close();
	$smarty->assign("v_rates",$v_rates);
	$smarty->assign("v_types",$v_types);
	$smarty->assign("id",$id);	
	$smarty->assign("hosp",$hosp);	
	$smarty->assign("host_info",$host_info);
	$smarty->assign("logiticid",$logiticid);			
	$smarty->display('rate_management2/index.tpl');
?>  