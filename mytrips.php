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
 
//print_r($_SESSION);

	
	if(isset($_GET['delId']) && $_GET['delId'] != '')
	{   
   		$QueryDel = "update request_info set reqstatus='inactive' WHERE id='".$_GET['delId']."'";

  		$db->query($QueryDel);
  		 $QueryDel = "update ".TBL_TRIP_DET." set status='3' WHERE reqid='".$_GET['delId']."'";

  		$db->query($QueryDel);
  		// /exit();
	}



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

 // echo "<pre>";
 // print_r($_SESSION);
 // exit();

 
 // $whr.=" AND account='".$_SESSION['userdata']['id']."'";
 
//  echo "<pre>";
// print_r($_SESSION);
// exit();

 $new_time = date("Y-m-d H:i:s", strtotime('+24 hours'));
 $new_time2 = date("Y-m-d H:i:s", strtotime('+48 hours'));
   $Q="SELECT ri.* FROM request_info as ri  WHERE ri.appdate BETWEEN '".convertDateToMySQL($stdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' $whr ORDER BY ri.appdate DESC LIMIT 100";

 if($db->query($Q) && $db->get_num_rows() > 0){$Requests = $db->fetch_all_assoc();
 for ($i = 0;$i<sizeof($Requests);$i++)
		   { if($new_time < $Requests[$i]['appdate'].' '.$Requests[$i]['apptime']){$Requests[$i]['editable'] = 'Yes';}else{$Requests[$i]['editable'] = 'No'; } 
		  if($new_time2 < $Requests[$i]['appdate'].' '.$Requests[$i]['apptime']){$Requests[$i]['cancellable'] = 'Yes';}else{$Requests[$i]['cancellable'] = 'No'; } 
		   //echo $new_time .' < '. $Requests[$i]['appdate'].' '.$Requests[$i]['apptime'];
		   }
 
 }
	$db->close();
	// echo "<pre>";
	// print_r($Requests);
	// exit();
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