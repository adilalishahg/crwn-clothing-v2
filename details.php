<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id=$_REQUEST['id'];
	$Query = "SELECT re.*,td.tripassign_time,td.driverconfirm_time,td.arrived_time,td.picked_time,td.tdid, td.date, t.trip_clinic,t.trip_tel,td.ac_noshowcancell, CONCAT(d.fname,' ',d.lname) as name,t.trip_user, d.drv_code, td.pck_add, td.drp_add,td.temp_comments, td.pck_time,td.aptime,td.drp_atime,td.drv_id,td.drp_time,ac.account_name,td.picklocation,td.droplocation,td.drp_atime,td.trip_miles, r.drv_rating,td.pickStatus,td.status,td.trip_remarks,v.vname,v.vnumber,r.comments,td.signature,td.signature2,re.comments as re_comments,  td.startmilage,td.endmilage,td.paperwork,td.personal_belonging,td.medication,re.vehtype,re.claim_no FROM ".TBL_TRIP_DET." td 
					LEFT OUTER JOIN ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
					LEFT OUTER JOIN ".TBL_RATING." AS r ON ( td.tdid = r.trp_id) 
					LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id) 
					LEFT OUTER JOIN ".TBL_VEHICLES." AS v ON ( v.id = td.veh_id)
					LEFT OUTER JOIN ".accounts." AS ac ON ( ac.id = t.account)
					LEFT OUTER JOIN ".TBL_FORMS." AS re ON (td.reqid = re.id)  
					WHERE  td.tdid = '$id'
					group by td.tdid";					
				if($db->query($Query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_all_assoc();
			  }
			 $Query_comments = "SELECT comments FROM ".TBL_RATING." WHERE  trp_id = '$id' "; 
			 if($db->query($Query_comments) && $db->get_num_rows())
			  {
			  $data_comments = $db->fetch_all_assoc();
			  }
	 $Query_vtype = "SELECT vehtype FROM ".vehtype." WHERE  id = '".$udata[0]['vehtype']."' "; 
			 if($db->query($Query_vtype) && $db->get_num_rows())
			  { $vtypedata = $db->fetch_one_assoc(); }
			 	
				$start = strtotime($udata[0]['arrived_time']);
				$end = strtotime($udata[0]['picked_time']);
			    $elapsed = $end - $start;
				$waitingtime=  gmdate("H:i:s", $elapsed);		
				
			 	  
	$con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0){
	 $contact = $db->fetch_all_assoc(); }
	$db->close();
    $pgTitle = "Admin Panel -- REPORT";
	$smarty->assign("waitingtime",$waitingtime);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("vehtype",$vtypedata['vehtype']);
	$smarty->assign("contact",$contact);
	$smarty->assign("id",$id);
    $smarty->assign("data",$udata);
	$smarty->assign("data2",$udata2);
	$smarty->assign("driver",$driver);
	$smarty->assign("data_comments",$data_comments);
	$smarty->assign("qty",$qty); 
	$smarty->assign("privatepayid",$privatepayid);
	$smarty->assign("amt",$amt);
	$smarty->assign("tripativities",$tripativities);					
	$smarty->display('details.tpl');
?>