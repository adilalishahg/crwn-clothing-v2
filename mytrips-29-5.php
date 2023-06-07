<?php
 include_once('includefile.php');
 include_once('Classes/mapquest_google_miles.class.php');	
 include('administrator/Classes/pagination-class.php');	
 if($_SESSION['allowUser'] == ''){echo '<script>location.href="index.php";</script>';  exit;}
 if(isset($_GET['pageNum'])){ $page_no = $_GET['pageNum'];  }else{  $page_no = '1';  }
$cQuery = "SELECT Count(*) FROM ".TBL_ALOG."  $condition";
$totalRows = $db->executeScalar($cQuery);
$pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows);
$mile_C = new mapquest_google_miles;
$qry_vehtype = "SELECT * FROM " . TBL_VEHTYPES;if($db->query($qry_vehtype) && $db->get_num_rows() > 0){$vehiclepref = $db->fetch_all_assoc();} 
$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['id']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
/*$Query = "SELECT r.id,r.region FROM ".cmregions." as cr LEFT JOIN regions as r on cr.region_id=r.id WHERE cr.cm_id='".$_SESSION['userdata']['cm_id']."' ORDER BY r.region ASC "; 
if($db->query($Query) && $db->get_num_rows() > 0){$regions = $db->fetch_all_assoc();  }*/
//print_r($regions); //exit;
 $whr="";
 $stdate= $_REQUEST['stdate'];
 $enddate=$_REQUEST['enddate'];
 $reqstatus=$_REQUEST['reqstatus'];
 if($stdate==''){$stdate=date("m/d/Y"); }
 if($enddate==''){$enddate=date("m/d/Y");}
 if($reqstatus!=''){$whr.=" AND reqstatus='".$reqstatus."'";}
 
if($_SESSION['type'] == 'ac'){
	
	 $query="SELECT ac.account_name,ac.id FROM associated_accounts as ass left join accounts as ac on  ass.associated_account_id=ac.id  WHERE ass.account_id = '".$_SESSION['userdata']['id']."'";
		if($db->query($query) && $db->get_num_rows() > 0)
		{ $data = $db->fetch_all_assoc(); 		
		for($i=0; $i<sizeof($data); $i++){
			$v_ids .= ','.$data[$i]['id'];
			} $v_ids = ($_SESSION['userdata']['id'].$v_ids);  
		}else{$v_ids = $_SESSION['userdata']['id'];}
	
	
	$whr	.=	" AND ri.account IN(".$v_ids.") ";}
if($_SESSION['type'] == 'pa'){
	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	$whr	.=	" AND ri.cmid='".$_SESSION['userdata']['id']."' ";}
if($_SESSION['type'] == 'cm'){
	//$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	
	$whr	.=	" AND ri.casemanager='".$_SESSION['userdata']['cm_id']."' ";}	
	
 
 
 // $whr.=" AND account='".$_SESSION['userdata']['id']."'";
 
 $new_time = date("Y-m-d H:i:s", strtotime('+24 hours'));
 
  $Q="SELECT ri.*,cm.casemanager_name FROM request_info as ri LEFT JOIN casemanagers  as cm on ri.casemanager=cm.id WHERE ri.appdate BETWEEN '".convertDateToMySQL($stdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' $whr ORDER BY ri.appdate DESC";
 if($db->query($Q) && $db->get_num_rows() > 0){$Requests = $db->fetch_all_assoc();
 for ($i = 0;$i<sizeof($Requests);$i++)
		   { if($new_time < $Requests[$i]['appdate'].' '.$Requests[$i]['apptime']){$Requests[$i]['editable'] = 'Yes';}else{$Requests[$i]['editable'] = 'No'; } 
		   //echo $new_time .' < '. $Requests[$i]['appdate'].' '.$Requests[$i]['apptime'];
		   }
 
 }
	$db->close();
	//print_r($Requests);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("stdate",$stdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("reqstatus",$reqstatus);
	$smarty->assign("post",$_REQUEST);
	$smarty->assign("foot",$foot);
	$smarty->assign("Requests",$Requests);
	$smarty->assign("pg",'mytrips');			
    $smarty->display('mytrips.tpl');	
?>