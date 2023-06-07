<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
   $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db->connect();
if($_POST['search']){
	//$hostpital_id 		= $_POST['hostpital_id'];
	$st 				= $_POST['st'];
	$startdate 			= convertDateToMySQL($_POST['startdate']);
	$enddate 			= convertDateToMySQL($_POST['enddate']);
	$clientname 		= $_POST['clientname'];
	
	$leg		 		= $_POST['leg'];
	if($leg=='AB'){$legwhere = " AND td.type='AB' ";}elseif($leg=='BF'){$legwhere = " AND td.type!='AB' ";}
	
	if($st && $st == 'active'){
	$Query2 = "SELECT f.*,r.hospname FROM ".TBL_FORMS." as f 
	left join ".TBL_REQUESTS." as r on r.reqid=f.req_id 
	WHERE f.reqstatus='$st' 
	AND LTRIM(LOWER(f.clientname))='".strtolower(trim($clientname))."' 
	AND appdate BETWEEN '".$startdate." 00:00:00' AND '".$enddate." 23:59:59'   
	 ORDER BY f.appdate ASC ";
		if($db->query($Query2) && $db->get_num_rows()){ $data = $db->fetch_all_assoc(); 
		$clinic = $data[0]['hospname'];
	for($i=0;$i<sizeof($data);$i++){$pendingids.=$data[$i]['id'].'@';} $pendingids = substr($pendingids, 0, -1); }

		}
	
	if($st && $st == 'approved'){
	$Query2 = "SELECT t.trip_code, t.trip_id, t.trip_user, t.trip_clinic, td.date,td.tdid, td.trip_id, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime,td.drp_add, td.drp_time, td.trip_miles,td.drv_id, td.status 		  FROM trips as t INNER JOIN trip_details as td
		  ON t.trip_id=td.trip_id LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code WHERE t.trip_date BETWEEN '".$startdate." 00:00:00' AND '".$enddate." 23:59:59' $legwhere AND LTRIM(LOWER(t.trip_user)) = '".strtolower(trim($clientname))."' ORDER by t.trip_date ASC,td.tdid ASC";
		if($db->query($Query2) && $db->get_num_rows()){ $data = $db->fetch_all_assoc(); }
		$clinic = $data[0]['trip_clinic'];
		//echo '<pre>'; print_r($data); exit;
		}
	}
 
 $drvQuery = "SELECT  d.fname, d.lname, d.drv_code FROM ".TBL_DRIVERS." as d WHERE d.drvstatus ='Active' ORDER BY d.fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0)
		$drivers = $db->fetch_all_assoc();
		
	//Admin level division
 $qv="SELECT * FROM " .TBL_VEHTYPES;if($db->query($qv)&&$db->get_num_rows()>0){$vehiclepref=$db->fetch_all_assoc();}	
 	//print_r($drivers);
	//End of admin level devision	
	$db->close();
    $pgTitle = "Admin Panel -- ";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("st",$st);
	$smarty->assign("req",$uid);
	$smarty->assign("data",$data);
	$smarty->assign("post",$_POST);	
	$smarty->assign("clinic",$clinic);	
	$smarty->assign("drivers",$drivers);	
	$smarty->assign("hospitals",$hospitals);	
	$smarty->assign("hostpital_id",$_POST['hostpital_id']);		
	$smarty->assign("pendingids",$pendingids);
	$smarty->assign("vehiclepref",$vehiclepref);		
	$smarty->display('reqtpls/onego.tpl');
?>