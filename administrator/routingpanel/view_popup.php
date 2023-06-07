<?php

   	

   	include_once('../DBAccess/Database.inc.php');
	

		$db = new Database;	
		
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id=$_REQUEST['id'];
	
	
	 
  
	 
	 $Query = "SELECT td.tdid,td.trip_id,t.trip_user,t.trip_clinic,t.trip_tel,td.pck_add,td.pck_time,td.drp_time,td.trip_miles,td.drv_id,td.trip_remarks,td.pickStatus FROM trip_details td, trips t  
						WHERE t.trip_id=td.trip_id AND  td.tdid='$id'";
						
						 if($db->query($Query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_all_assoc();
			  }
	           
	
              $trip_id=$udata[0]['trip_id']; 
			   $cname=$udata[0]['trip_user'];
			   $clinic=$udata[0]['trip_clinic'];
			    $phone=$udata[0]['trip_tel'];
				 $addr1=$udata[0]['pck_add'];
	              $ptime=$udata[0]['pck_time'];
				   $dtime=$udata[0]['drp_time'];
				   $pustatus=$udata[0]['pickStatus']; 
				    $m1=$udata[0]['trip_miles']; 
					 $staff1=$udata[0]['drv_id'];
					  $remarks=$udata[0]['trip_remarks'];
					  
					  if($pustatus == '0') { $pustatus = 'In Progress'; }
					  if($pustatus == '1'){ $pustatus = 'Yes'; }
					  if($pustatus == '2'){ $pustatus = 'No'; }
					  

	   
		
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [VIEW REQUEST]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
	
	$smarty->assign("sheetid",$sheetid);
	$smarty->assign("tripid",$trip_id);
	$smarty->assign("cname",$cname);
	$smarty->assign("clinic",$clinic);
	$smarty->assign("phone",$phone);
	$smarty->assign("addr1",$addr1);
	$smarty->assign("ptime",$ptime);
	$smarty->assign("dtime",$dtime);
	$smarty->assign("m1",$m1);
	$smarty->assign("staff1",$staff1);
	$smarty->assign("remarks",$remarks);
	$smarty->assign("pustatus",$pustatus);	
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->display('rpaneltpl/view_popup.tpl');
		
?>