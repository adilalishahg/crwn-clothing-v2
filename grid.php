<?php
 include_once('includefile.php');
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;
	if($_SESSION['allowUser'] == ''){echo '<script>location.href="index.php";</script>';  exit;}	
    $sheet=$_GET['id'];
	$acknowledge_status = $_GET['acknowledge_status'];
	$st=$_GET['st'];
	$pg=$_GET['pg'];
	$st10=0;$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$st6=0;
	if(isset($_GET['acknowledge_status'])) { $acknowledge_status = $_GET['acknowledge_status']; }
	//$ad=$_GET['ad'];

if(isset($_GET['delId']) && $_GET['delId'] != '')
	{   
   		$QueryDel = "update ".TBL_TRIP_DET." set status='3' WHERE tdid='".$_GET['delId']."'";
  		$db->query($QueryDel);
		}
	// 	S E A R C H    C O D E  ///
		if(isset($_REQUEST))
		{ 
			$drv_code 			= $_REQUEST['drv_code'];
			$trip_userS 		= $_REQUEST['trip_userS'];
			$trip_userR 		= $_REQUEST['trip_userR'];
			$account 			= $_REQUEST['account'];
			$trip_type 			= $_REQUEST['trip_type']; 
			$veh_id	 			= $_REQUEST['veh_id'];
			$loc	 			= $_REQUEST['loc'];
			$whr = '';
			if ($drv_code!=''){		$whr .=" AND td.drv_id = '$drv_code'";			}
			if ($trip_userR!=''){	$whr .=" AND t.trip_user LIKE '%$trip_userR%'";	$trip_userS='';}
				elseif($trip_userS!=''){		$whr .=" AND t.trip_user = '$trip_userS'";}
			if ($account!=''){		$whr .=" AND t.account = '$account'";		}
			if ($trip_type!=''){	$whr .=" AND ri.triptype = '$trip_type'";	}
			if ($veh_id!=''){		$whr .=" AND td.veh_id = '$veh_id'";	}
			//if ($loc!=''){			$whr .=" AND td.location = '$loc'";	}
		}
		if($st == '5' )
		{	$st=5;
			$cond = " AND td.status IN ('5','2','0')";}
		elseif($st == '4')
		{$cond = " AND td.status IN ('1','4')"; }
		elseif($st == '3')
		{$cond = " AND td.status IN ('3','7','8')"; }
		elseif($st =='' || $st == '11')
		{$cond = " AND td.status IN ('6','10','5','9')"; }
	   else{   $cond = " AND td.status = '".$st."' "; 	}
	   
	   if($_SESSION['type'] == 'ac'){
	   	$accountSql = "SELECT account_name FROM ".accounts." WHERE id='".$_SESSION['loginID']."'";
	if($db->query($accountSql) && $db->get_num_rows() > 0){ 
		$rcrAccount = $db->fetch_one_assoc();
		
		//$account_referral=$rcrAccount['account_name'];
		
	}
	
		
		$whr	.=	" AND ri.account =".$_SESSION['userdata']['id']." ";
		

	   }
	if($_SESSION['type'] == 'pa'){$whr .= " AND ri.cmid='".$_SESSION['userdata']['id']."'";  }	
	//if($_SESSION['type'] == 'cm'){$whr .= " AND ri.casemanager='".$_SESSION['userdata']['cm_id']."'";  }	

		
		
	  	$today=date('Y-m-d');
		  $pday = date("Y-m-d",strtotime("-1 day"));
		  $QueryCount = "SELECT td.status 
		  FROM trips as t INNER JOIN trip_details as td ON t.trip_id=td.trip_id 
		  LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code
		  LEFT JOIN request_info as ri ON td.reqid=ri.id  WHERE t.trip_date = '$today'  $whr";
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

		  $Query = "SELECT t.sheet_id,td.veh_id,td.acknowledge_status,t.trip_code,t.trip_id,t.trip_user,t.trip_clinic,t.trip_date,t.trip_tel,td.tdid,td.trip_id, td.type,td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime,td.reqid,td.picklocation,td.droplocation,td.arrived_time, td.escort_id,
		  td.pickup_instruction, td.destination_instruction, td.d_phnum,td.p_phnum,t.account,td.drp_add,  td.drp_time,  td.trip_miles,td.wc,   td.trip_remarks,  td.drv_id, td.status, td.pick_latlong, td.drop_latlong,td.ccode
		  FROM trips as t INNER JOIN trip_details as td ON t.trip_id=td.trip_id
		 LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code
		 LEFT JOIN request_info as ri ON td.reqid=ri.id 
		   WHERE t.trip_date = '$today'  $cond $whr ORDER by td.pck_time ASC,td.tdid ASC";

		// print(TBL_TRIP_DET." >> ");
		if($db->query($Query) && $db->get_num_rows() > 0)
		{ 
			$trips = $db->fetch_all_assoc();
		   for ($i = 0;$i<sizeof($trips);$i++)
		   {
			 $did = $trips[$i]['drv_id'];
			$drvQuery = "SELECT  fname, lname, drv_code,sip
										FROM ".TBL_DRIVERS."
											WHERE  drv_code  = '$did'";
				if($db->query($drvQuery) && $db->get_num_rows() > 0)
				 {
					 $drv = $db->fetch_row_assoc();
					 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];
					 $trips[$i]['sip'] = $drv['sip'];
				 }
		//to get vehicle type
		$Q="SELECT vt.vehtype,ri.dstretcher,ri.bar_stretcher,ri.dwchair,ri.oxygen,ri.client_type FROM vehtype as vt,request_info as ri 
			WHERE ri.vehtype=vt.id AND
			ri.id='".$trips[$i]['reqid']."'";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }	 
				 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				 $trips[$i]['vehtype'] 			= 	$ata['vehtype'];
				 $trips[$i]['dstretcher'] 		= 	$ata['dstretcher'];
				 $trips[$i]['bar_stretcher'] 	= 	$ata['bar_stretcher'];
				 $trips[$i]['dwchair'] 			= 	$ata['dwchair'];
				 $trips[$i]['oxygen'] 			= 	$ata['oxygen'];
				 $trips[$i]['client_type'] 		= 	$ata['client_type'];
				 $Q222="SELECT account_name FROM accounts WHERE id = '".$trips[$i]['account']."'";
				 if($db->query($Q222) && $db->get_num_rows() > 0) {$accounts=$db->fetch_one_assoc();
				 $trips[$i]['account'] 			= 	$accounts['account_name'];
				  }
				 /*$trips[$i]['ins_name'] 		= 	$ata['ins_name'];


				 $trips[$i]['ins_billing_address'] 		= 	$ata['ins_billing_address'];
				 $trips[$i]['ins_claim'] 		= 	$ata['ins_claim'];
				 $trips[$i]['ins_adjuster'] 	= 	$ata['ins_adjuster'];
				 $trips[$i]['pp_billing_address']= 	$ata['pp_billing_address'];
				 $trips[$i]['pp_cash'] 			= 	$ata['pp_cash'];
				 $trips[$i]['pp_credit'] 			= 	$ata['pp_credit'];*/
				 //$trips[$i]['ins_name'] 			= 	$ata['ins_name'];
		   }
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
	$ad='0';
	$getuser = "SELECT trip_user FROM trips WHERE trip_date = '$today' AND account='".$_SESSION['userdata']['id']."' ORDER BY trip_user ASC";
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
	//echo $st9.'^'.$st8.'^'.$st7.'^'.$st5.'^'.$st4.'^'.$st3.'^'.$st2;
	$db->close();
    $pgTitle = "";
	$smarty ->assign("id",$sheet);
	$smarty ->assign("user",$user);
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("drv",$drv);
	$smarty ->assign("usr",$usr);
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
	$smarty->assign("pg",'grid');
	$smarty->assign("acknowledge_status",$acknowledge_status);
	$smarty->display('grid.tpl');
?>