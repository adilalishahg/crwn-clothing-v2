<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
    $sheet=$_GET['id'];
	$acknowledge_status = $_GET['acknowledge_status'];
	$st=$_GET['st'];
	$pg=$_GET['pg'];
	$st11=0;$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$st6=0;
	if(isset($_GET['acknowledge_status'])) { $acknowledge_status = $_GET['acknowledge_status']; }
	//$ad=$_GET['ad'];
	$db->connect();
	$db2->connect();
	/*************** Paging ************** */
	// Delete Category Script
    if(isset($_GET['delId']) && $_GET['delId'] != '')
	{   
   		$QueryDel = "update ".TBL_TRIP_DET." set status='3' WHERE tdid='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{
		echo "<script>location.href='grid2.php?st=5&ad=0&id=".$sheet."'";
		echo "</script>";
   		exit;
	  	   //Delete subcategories as wel
	 //$db2->query($QuerypicDel = "DELETE FROM `categories` WHERE id='".$_GET['delId']."'");	   		
		}else{
	   		 header("Location: grid2.php?id=".$sheet);
	   		exit;	
		}  
 	}
	// 	S E A R C H    C O D E  ///
		if(isset($_POST))
		{
			$drv = $_POST['driver'];
			$drv = $_GET['driver'];
			$usr = $_POST['user'];
			$usr = $_GET['user'];
			$user = $_POST['user'];
			$user = $_GET['user'];
			$account = $_POST['account'];
			$account = $_GET['account'];
			//$sheet = $_POST['id'];
			$whr = '';
			if ($drv!='')
			{
				$whr .=" AND td.drv_id = '$drv'";
			}
			if ($user!='')
			{
				$whr .=" AND t.trip_user LIKE '%$user%'";
			}
			if ($account!='')
			{
				$whr .=" AND t.account = '$account'";
			}
	}
		if($st =='' || $st == '5' )
		{	$st=5;
			$cond = " AND td.status IN ('5','2','0')";}
		elseif($st == '4')
		{$cond = " AND td.status IN ('1','4')"; }
		elseif($st == '3')
		{$cond = " AND td.status IN ('3','7','8')"; }
		elseif($st =='' || $st == '11')
		{$cond = " AND td.status IN ('6','10','5','9')"; }
	   else{  $cond = " AND td.status = '".$st."' "; 	}
		  $today=date('Y-m-d');
		  $pday = date("Y-m-d",strtotime("-1 day"));
		  
		   $Query = "SELECT td.reqid FROM trip_details as td WHERE td.date = '$pday' AND td.modiv_id != '' AND td.modiv_detail_id	!=	'' AND legcharges = 0";
		 	  if($db->query($Query) && $db->get_num_rows() > 0){ 
		   $tripsX = $db->fetch_all_assoc();
		  include_once('../requests/invoice_calculation_function.php');
		   for ($i = 0;$i<sizeof($tripsX);$i++)
		   {	 
		   //$status=$tripsCount[$i]['status'];
		   invoice_generation($tripsX[$i]['reqid'],$db);	
		   
		   }
		   }
		  				$VhicleArray = array();
$QR = "SELECT id,vehtype FROM vehtype";
if($db->query($QR) && $db->get_num_rows() > 0)
		{	$tdata = $db->fetch_all_assoc();
			for($i=0;$i< $db->get_num_rows();$i++)
			{	$row = $tdata[$i];
				$VhicleArray[$row['id']] = $row['vehtype'];
			}
		}
		  $QueryCount = "SELECT t.sheet_id,td.veh_id,td.acknowledge_status,t.trip_code,t.trip_id,t.trip_user,t.trip_clinic,t.trip_date, 
		  t.trip_tel,td.tdid,td.trip_id,td.type,td.pck_add,td.aptime,td.pck_time,td.aptime,td.drp_atime,t.account,td.p_phnum,td.picklocation,td.droplocation, 
		  td.drp_add,td.drp_time,td.trip_miles,td.wc,td.trip_remarks,td.drv_id,td.status,td.pick_latlong,td.drop_latlong 
		  FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code WHERE t.trip_date = '$pday'  $whr ORDER by td.pck_time ASC,td.tdid ASC";
		  if($db->query($QueryCount) && $db->get_num_rows() > 0){ $tripsCount = $db->fetch_all_assoc();
		   for ($i = 0;$i<sizeof($tripsCount);$i++)
		   {	 
		   $status=$tripsCount[$i]['status'];
		   switch($status){
			   case 1: $st4=$st4+1; 	 break;
			   case 2: $st2=$st2+1; $st5=$st5+1;  break;
			   case 3: $st3=$st3+1;	 break;
			   case 4: $st4=$st4+1;	 break;
			   case 5: $st5=$st5+1;	$st11=$st11+1; break;
			   case 6: $st6=$st6+1;	$st11=$st11+1; break;
			   case 7: $st3=$st3+1;	 break;
			   case 8: $st3=$st3+1;	 break;
			   case 9: $st9=$st9+1;		$st11=$st11+1; break;
			   case 10: $st10=$st10+1;	$st11=$st11+1; break;
			   break;
			   } }
		  }
		  $Query = "SELECT t.sheet_id,td.veh_id,td.acknowledge_status,t.trip_code,t.trip_id,t.trip_user,t.trip_clinic,t.trip_date,t.trip_tel,td.tdid,td.trip_id, td.type,td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime,td.reqid,td.picklocation,td.droplocation,td.arrived_time,td.escort_id, 
		  td.pickup_instruction, td.destination_instruction, td.d_phnum,td.p_phnum,t.account,td.drp_add,  td.drp_time,  td.trip_miles,td.wc,   td.trip_remarks,  td.drv_id, td.status, td.pick_latlong, td.drop_latlong,td.ccode,td.legcharges,ri.dstretcher,ri.bar_stretcher,ri.dwchair,ri.oxygen,ri.org_apptime, ri.modiv_flage,td.modiv_id,td.rideInitiated, td.modiv_detail_id, ri.vehtype 
		  FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id LEFT JOIN request_info as ri ON ri.id = td.reqid WHERE t.trip_date = '$pday' $cond $whr ORDER by td.pck_time ASC,td.tdid ASC";

		// print($Query." >> ");
		if($db->query($Query) && $db->get_num_rows() > 0)
		{ 
			$trips = $db->fetch_all_assoc();
		   for ($i = 0;$i<sizeof($trips);$i++)
		   { $trip_user = $trips[$i]['trip_user'];
		   	$Qcomments="SELECT comments FROM patient WHERE LTRIM(LOWER(name)) = '".strtolower(trim(($trip_user)))."'";
			if($db->query($Qcomments) && $db->get_num_rows() > 0)
				 {	 $dc = $db->fetch_one_assoc();  $trips[$i]['pcomments'] = $dc['comments']; }
			 $did = $trips[$i]['drv_id'];
			/*$drvQuery = "SELECT  fname, lname, drv_code,sip
										FROM ".TBL_DRIVERS."
											WHERE  drv_code  = '$did'";
				if($db->query($drvQuery) && $db->get_num_rows() > 0)
				 {
					 $drv = $db->fetch_row_assoc();
					 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];
					 $trips[$i]['sip'] = $drv['sip'];
				 }*/
		//to get vehicle type
		/*$Q="SELECT vt.vehtype,ri.org_apptime FROM vehtype as vt,request_info as ri 
			WHERE ri.vehtype=vt.id AND
			ri.id='".$trips[$i]['reqid']."'";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }	*/ 
				 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				  $trips[$i]['vehtype'] 		= 	@$VhicleArray[$trips[$i]['vehtype']];//	$ata['vehtype'];
				  if($trips[$i]['type']=='AB'){$trips[$i]['org_apptime'] 			= 	$trips[$i]['org_apptime'];
				 if($trips[$i]['org_apptime']=='00:00:00' || $trips[$i]['org_apptime']=='00:00'){$trips[$i]['org_apptime'] = 	'';}
				 }
				 
		   }
/*		   for ($i = 0;$i<sizeof($trips);$i++)
		   {	 
		   
		 $vid = $trips[$i]['veh_id'];
				$drvQuery2 = "SELECT gpsurl,id
											FROM ".TBL_VEHICLES."
											WHERE  id  = '$vid'";
				if($db->query($drvQuery2) && $db->get_num_rows() > 0)
				 {
					 $vh = $db->fetch_row_assoc();
					 $trips[$i]['gps'] = $vh['gpsurl'];
				 }
		   }*/
		}
	//print_r($trips);  
	$drvQuery = "SELECT  fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus !='Suspended' ORDER BY  fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0)
		$drivers = $db->fetch_all_assoc();
	$getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0' ORDER BY  fname ASC";
 	if($db->query($getDriver) && $db->get_num_rows())
	{
		$driverdata = $db->fetch_all_assoc();
	}
	$getDriver = "SELECT dr.* FROM ".TBL_DRIVERS." as dr LEFT JOIN ".TBL_DVMAPPING." as drv on dr.Drvid=drv.drv_id WHERE dr.drvstatus='Active' AND dr.modiv_flage='1' AND dr.del='0' AND drv.drv_id !='' ORDER BY  dr.fname ASC";
 	if($db->query($getDriver) && $db->get_num_rows())
	{
		$driverdata_modiv = $db->fetch_all_assoc(); // print_r($driverdata_modiv);
	}
	$ad='0';
	$getuser = "SELECT trip_user FROM trips WHERE trip_date = '$today' ORDER BY trip_user ASC";
 	if($db->query($getuser) && $db->get_num_rows())
	{
		$userdata = $db->fetch_all_assoc();
	}
	$getuser2 = "SELECT id,vehtype  FROM vehtype";
 	if($db->query($getuser2) && $db->get_num_rows())
	{
		$userdata2 = $db->fetch_all_assoc();
	}
	$g2 = "SELECT id,account_name  FROM accounts ORDER BY account_name ASC";
 	if($db->query($g2) && $db->get_num_rows() > 0)
	{	$accounts = $db->fetch_all_assoc();	}
		
	//print_r($trips);
	// echo $st9.'^'.$st8.'^'.$st7.'^'.$st5.'^'.$st4.'^'.$st3.'^'.$st2;
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Routing Panel";
	$smarty ->assign("id",$sheet);
	$smarty ->assign("user",$user);
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("drv",$drv);
	$smarty ->assign("usr",$usr);
	$smarty->assign("driverdata_modiv",$driverdata_modiv);
	$smarty->assign("userdata2",$userdata2);
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("st",$st);
	$smarty->assign("st10",$st10);
	$smarty->assign("st9",$st9);
	$smarty->assign("st8",$st8);
	$smarty->assign("st7",$st7);
	$smarty->assign("st5",$st5);
	$smarty->assign("st6",$st6);
	$smarty->assign("st4",$st4);
	$smarty->assign("st3",$st3);
	$smarty->assign("st2",$st2);
	$smarty->assign("st11",$st11);
	$smarty->assign("st12",$st12);
	$smarty->assign("st13",$st13);
	$smarty->assign("st14",$st14);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("userdata2",$userdata2);
	$smarty->assign("ad",$ad);
	$smarty ->assign("drivers",$drivers);
	$smarty ->assign("users",$users);
	$smarty ->assign("clinic",$clinic);
	$smarty->assign("driverdata",$driverdata);
	$smarty->assign("userdata",$userdata);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('membdetail',$trips);
	$smarty->assign("paging",$paging);
	$smarty->assign("acknowledge_status",$acknowledge_status);
	$smarty->display('rpaneltpl/grid2.tpl');
?>