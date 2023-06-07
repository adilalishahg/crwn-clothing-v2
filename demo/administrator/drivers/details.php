<?php

   	

   	include_once('../DBAccess/Database.inc.php');
	

		$db = new Database;	
		
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id=$_REQUEST['id'];
	
	$idQuery = "SELECT trip_id FROM  ".TBL_TRIP_DET." where tdid = '$id'";
	if($db->query($idQuery) && $db->get_num_rows())
	 {
			  $get_id  = $db->fetch_row_assoc();
	}
	$t_id =  $get_id['trip_id'];


	 

	 
	  $Query = "SELECT r.comments,r.drv_rating,d.fname,d.lname,td.pickStatus,td.trip_id,t.trip_user,t.trip_clinic,t.trip_tel,td.pck_add,td.pck_time,td.drp_add, td.drp_time,td.trip_miles,td.drv_id,td.status,td.trip_remarks , v.vnumber, v.vname
	 FROM trip_details td, trips t , vehicles v ,drivers d, rating r
						WHERE   t.trip_id= '$t_id' AND td.trip_id = t.trip_id AND   v.id = td.veh_id AND td.drv_id=d.drv_code ";
						
				if($db->query($Query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_all_assoc();
			  }
	           
			  // debug($udata);
             /* $trip_status=$udata[0]['status']; 
			  $trip_id=$udata[0]['trip_id']; 
			   $cname=$udata[0]['trip_user'];
			   $clinic=$udata[0]['trip_clinic'];
			    $phone=$udata[0]['trip_tel'];
				 $addr1=$udata[0]['pck_add'];
				  $addr2=$udata[0]['drp_add'];
	              $ptime=$udata[0]['pck_time'];
				   $dtime=$udata[0]['drp_time'];
				    $m1=$udata[0]['trip_miles']; 
					 $staff1=$udata[0]['drv_id'];
					  $remarks=$udata[0]['trip_remarks'];*/

	
		
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [ADD REQUEST]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
	
    $smarty->assign("data",$udata);
	/*$smarty->assign("tripid",$trip_id);
	$smarty->assign("cname",$cname);
	$smarty->assign("clinic",$clinic);
	$smarty->assign("phone",$phone);
	$smarty->assign("addr1",$addr1);
		$smarty->assign("addr2",$addr2);
	$smarty->assign("ptime",$ptime);
	$smarty->assign("dtime",$dtime);
	$smarty->assign("m1",$m1);
	$smarty->assign("staff1",$staff1);
	$smarty->assign("remarks",$remarks);*/
	
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->display('reportstpl/details.tpl');
		
?>