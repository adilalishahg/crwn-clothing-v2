<?php

/* *************************** *

	   * Created On : 31st March,2009 

	   * Coded By : Muhammad Sajid

	   * All Rights Reserved 2009 by : HITS (Hybrid IT Services) 

	   * http://www.hybriditservices.com/demos/httglobal-2/hybridTracktrans.com

	   *************************** */

	

require_once('../DBAccess/Database.inc.php');
$duration = '';
	

	$db = new Database;	

	$db->connect();
	if(isset($_POST['duration'])){
       $duration=$_POST['duration']; }
	elseif(isset($_GET['duration'])) {
	   $duration=$_GET['duration'];  }
	else{
		$duration = '5';
		}

		

		

		

	    $today= date('Y-m-d');

		$Querypg	="SELECT * FROM ".TBL_SHEET." where dated='$today' ";

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

		  WHERE s.reqid=rs.req_id and rs.reqstatus ='active'  ORDER by s.reqid ASC";

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

	  $today= date('Y-m-d');

	$Query = "SELECT t.sheet_id,  t.trip_code, t.trip_id,  t.trip_user,  t.trip_clinic,t.trip_miles,t.trip_date, 

		  t.trip_tel, td.tdid, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime, 

		  td.drp_add,  td.drp_time,td.wc,   td.trip_remarks,  td.drv_id, td.status 

		  FROM trips as t,  trip_details as td 

		  WHERE t.trip_id=td.trip_id AND t.trip_date='$today' AND t.sheet_id=$sheet_id $cond  ORDER by td.pck_time ASC";

		

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
$waqfa = ($duration * 1000);
	$db->close();



    $smarty->assign("pgTitle",$pgTitle);

    $smarty->assign("pgName",$name);	

	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	$smarty->assign("testi",$testi);
    $smarty->assign("seokeywords",$seokeywords);

	$smarty->assign('seodescription',$seodescription);	

	$smarty->assign("foot",$foot);	

	$smarty->assign("st",$st);

	$smarty->assign("ad",$ad);

	$smarty ->assign("drivers",$drivers);

    $smarty ->assign("total",$total);

	$smarty ->assign("today",$today);

	$smarty ->assign("duration",$duration);

	$smarty->assign_by_ref('membdetail',$trips);

	$smarty->assign_by_ref('req',$requests);
	$smarty->assign("waqfa",$waqfa);

    $smarty->display('rpaneltpl/latesttrip.tpl');	



?>