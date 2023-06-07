<?php

	
require_once('../DBAccess/Database.inc.php');
	
	$db = new Database;	
	$db->connect();

        $date=$_POST['date'];
		

		
		
		
	   // $today= date('Y-m-d');
		$Querypg	="SELECT * FROM ".TBL_SHEET." where dated='$date' ";
		if($db->query($Querypg) && $db->get_num_rows() > 0)
		{
			$vehdetails = $db->fetch_all_assoc();
			$sheet_id=	$vehdetails[0]['sheet_id'];
		}
		
		if($sheet_id==''){
		
			$sheet_id = '0';
			
		}	
		//$st=5;
		
		$ad=0;
	   	
		$cond = " AND td.status IN ('1','4','6','5','2','0')";
		
		
		  
		  
		  $Query2 = "SELECT *
		  FROM requests as s, request_info as rs    
		  WHERE s.reqid=rs.req_id and s.reqdate BETWEEN '$date 00:00:00' AND '$date 23:59:59' ";
		   if($db->query($Query2) && $db->get_num_rows() > 0)
		{
		
		 $requests = $db->fetch_all_assoc(); 
		 
		
		  
		  for ($i = 0;$i<sizeof($requests );$i++)
		   {
			 $drvid = $requests[$i]['drv_code'];
	
				$drQuery = "SELECT  fname, lname, drv_code
											FROM ".TBL_DRIVERS."
											WHERE  Drvid = '$drvid'";
				if($db->query($drQuery) && $db->get_num_rows() > 0)
				 {
					 $dr = $db->fetch_row_assoc();
					 $requests[$i]['driver'] = $dr['fname']." ".$dr['lname'];
				 }
				 
			

		   }
		   
		   
		   
		 
		
		}
	
	$Query = "SELECT t.sheet_id,  t.trip_code, t.trip_id,  t.trip_user,  t.trip_clinic,t.trip_miles,t.trip_date, 
		  t.trip_tel, td.tdid, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime, 
		  td.drp_add,  td.drp_time,td.wc,   td.trip_remarks,  td.drv_id, td.status 
		  FROM trips as t,  trip_details as td 
		  WHERE t.trip_id=td.trip_id AND t.trip_date='$date' AND t.sheet_id=$sheet_id $cond  ORDER by td.pck_time ASC";
		
        if($db->query($Query) && $db->get_num_rows() > 0)
		{
			$trips = $db->fetch_all_assoc();
			
		   for ($i = 0;$i<sizeof($trips);$i++)
		   {
			 $did = $trips[$i]['drv_id'];
	
				$drvQuery = "SELECT  fname, lname, drv_code
											FROM ".TBL_DRIVERS."
											WHERE  Drvid = '$did'";
				if($db->query($drvQuery) && $db->get_num_rows() > 0)
				 {
					 $drv = $db->fetch_row_assoc();
					 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];
				 }
		   }
	   
		}
		
  
		
		

		
		
//print_r($trips);
	$db->close();

    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	//$smarty->assign("content",$pgContent);	
	$smarty->assign("testi",$testi);
    $smarty->assign("seokeywords",$seokeywords);
	$smarty->assign('seodescription',$seodescription);	
	$smarty->assign("foot",$foot);	
	$smarty->assign("st",$st);
	$smarty->assign("ad",$ad);
	$smarty ->assign("drivers",$drivers);
    $smarty ->assign("total",$total);
	$smarty ->assign("date",$date);
	$smarty ->assign("duration",$duration);
	$smarty->assign_by_ref('membdetail',$trips);
	$smarty->assign_by_ref('req',$requests);
    $smarty->display('rpaneltpl/scheduletrips.tpl');	

?>