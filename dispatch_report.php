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
 $whr="";
 $stdate= $_REQUEST['stdate'];
 $enddate=$_REQUEST['enddate'];
 $reqstatus=$_REQUEST['reqstatus'];
 if($stdate==''){$stdate=date("m/d/Y"); }
 if($enddate==''){$enddate=date("m/d/Y");}
 
 
 if($stdate!='' && $enddate!=''){$whr .=" td.date BETWEEN '".convertDateToMySQL($stdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' ";}
 
 if($reqstatus!=''){
	 
	 if($reqstatus == '4'){ $whr .= "AND td.status IN ('1','4') "; }
	 elseif($reqstatus == '5'){ $whr .= "AND td.status IN ('5','9') "; }
	 else{$whr.=" AND td.status='".$reqstatus."'"; }
	 
	 
	 }
 
//print_r($_SESSION);

	
	/*if(isset($_GET['delId']) && $_GET['delId'] != '')
	{   
   		$QueryDel = "update request_info set reqstatus='inactive' WHERE id='".$_GET['delId']."'";

  		$db->query($QueryDel);
  		 $QueryDel = "update ".TBL_TRIP_DET." set status='3' WHERE reqid='".$_GET['delId']."'";

  		$db->query($QueryDel);
  		// /exit();
	}*/



// echo "<pre>";
//  print_r($_SESSION);
//  exit();
if($_SESSION['type'] == 'ac'){
	$accountSql = "SELECT account_name FROM ".accounts." WHERE id='".$_SESSION['loginID']."'";
	if($db->query($accountSql) && $db->get_num_rows() > 0){ 
		$rcrAccount = $db->fetch_one_assoc();
		
		
		
	}
	 $v_ids = $_SESSION['userdata']['id'];
	$whr	.=	" AND  ri.account =".$v_ids." ";
	}
if($_SESSION['type'] == 'pa'){
	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	$whr	.=	" AND ri.cmid='".$_SESSION['userdata']['id']."' ";}


   $Q="SELECT td.tdid, td.date, t.trip_clinic, CONCAT(d.fname,' ',d.lname) as name,t.trip_user, d.drv_code, td.pck_add, td.drp_add, td.pck_time,td.drv_id,td.escort_id,td.drp_time, td.aptime,td.ac_noshowcancell,
			td.drp_atime, td.trip_miles, td.pickStatus, td.status,ri.clientname
			FROM ".TBL_TRIP_DET." td  
			left join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			LEFT JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			LEFT JOIN request_info AS ri ON ( td.reqid = ri.id ) 
			WHERE $whr  group by td.tdid ORDER BY td.date DESC ";

 if($db->query($Q) && $db->get_num_rows() > 0){$Requests = $db->fetch_all_assoc();
 
 }
	$db->close();
	
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("stdate",$stdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("reqstatus",$reqstatus);
	$smarty->assign("post",$_REQUEST);
	$smarty->assign("foot",$foot);
	$smarty->assign("Requests",$Requests);
	$smarty->assign("pg",'mytrips');			
    $smarty->display('dispatch_report.tpl');	
?>