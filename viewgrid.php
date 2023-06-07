<?php
 include_once('includefile.php');
	$msgs   = '';
	$errors = '';
   $id=$_REQUEST['id'];
	 $Query = "SELECT  td.trip_id,t.trip_code,t.trip_user,t.trip_clinic,t.trip_tel,td.pck_add,td.drp_add,td.pck_time,td.aptime,td.drp_atime,td.drp_time,td.trip_miles
,td.drv_id,td.status,td.trip_remarks,td.wc,td.picklocation,td.droplocation FROM trip_details td, trips t  
						WHERE  t.trip_id=td.trip_id AND td.tdid='$id'";
			if($db->query($Query) && $db->get_num_rows())
		  {
			  $udata = $db->fetch_all_assoc();
			  }
				$trip_status=$udata[0]['status']; 
				$trip_id=$udata[0]['trip_id']; 
				$trip_code=$udata[0]['trip_code'];
				$cname=$udata[0]['trip_user'];
				$clinic=$udata[0]['trip_clinic'];
				$phone=$udata[0]['trip_tel'];
				$addr1=$udata[0]['pck_add'];
				$ptime=$udata[0]['pck_time'];
				$aptime=$udata[0]['aptime'];				  
				$dtime=$udata[0]['drp_time'];
				$adtime=$udata[0]['drp_atime']; 
				$m1=$udata[0]['trip_miles']; 
				$staff1=$udata[0]['drv_id'];
				$remarks=$udata[0]['trip_remarks'];
				$drpaddr=$udata[0]['drp_add'];
				$pickStatus=$udata[0]['pickStatus'];
				$dropStatus=$udata[0]['dropStatus']; 
				$wc=$udata[0]['wc']; 
				$start = strtotime($udata[0]['arrived_time']);
				$end = strtotime($udata[0]['picked_time']);
			    $elapsed = $end - $start;
				$waitingtime=  gmdate("H:i:s", $elapsed);

	$db->close();
    $pgTitle = "";
	$smarty->assign("waitingtime",$waitingtime);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
   $smarty->assign("status",$trip_status);
    $smarty->assign("pickStatus",$pickStatus);
    $smarty->assign("dropStatus",$dropStatus);		
	$smarty->assign("tripid",$trip_id);
	$smarty->assign("trip_code",$trip_code);
	$smarty->assign("cname",$cname);
	$smarty->assign("clinic",$clinic);
	$smarty->assign("phone",$phone);
	$smarty->assign("addr1",$addr1);
	$smarty->assign("ptime",$ptime);
	$smarty->assign("dtime",$dtime);
	$smarty->assign("aptime",$aptime);
	$smarty->assign("adtime",$adtime);	
	$smarty->assign("m1",$m1);
	$smarty->assign("staff1",$staff1);
	$smarty->assign("remarks",$remarks);
	$smarty->assign("drpadd",$drpaddr);
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);	
	$smarty->assign("wc",$wc);	
	$smarty->assign("udata",$udata);				
	$smarty->display('view_grid.tpl');
?>