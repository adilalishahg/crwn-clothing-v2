<?php

   	

   	include_once('../DBAccess/Database.inc.php');
	

		$db = new Database;	
		
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id=$_REQUEST['id'];
	
	
	 
  
	 
	 $Query = "SELECT * from request_info 
						WHERE  id='$id'";
						
						 if($db->query($Query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_all_assoc();
			  }
	           
	 $Query2 = "SELECT * from credit_catd 
						WHERE  request_id='$id'";
						
						 if($db->query($Query2) && $db->get_num_rows())
			  {
			  $udata2 = $db->fetch_all_assoc();
			  }
	           
					  
					

	   
		
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [VIEW REQUEST]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
	$smarty->assign_by_ref('udata',$udata);
	$smarty->assign_by_ref('udata2',$udata2);
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
	$smarty->display('reportstpl/bill_details.tpl');
		
?>