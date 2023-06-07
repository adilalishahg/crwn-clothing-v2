<?php
include_once('includefile.php');
include_once('Classes/mapquest_google_miles.class.php');	
/*if($_SESSION['allowUser'] == ''){echo '<script>location.href="index.php";</script>';  exit;}*/
$mile_C = new mapquest_google_miles;
$qry_vehtype = "SELECT * FROM " . TBL_VEHTYPES ." WHERE  TRIM(LOWER(REPLACE(vehtype,' ',''))) = 'wheelchair'"; if($db->query($qry_vehtype) && $db->get_num_rows() > 0){$vehiclepref = $db->fetch_all_assoc();} 
$account_name = '';
if($_SESSION['type'] == 'ac'){
//$v_ids = $_SESSION['userdata']['id'];
$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['id']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();      $account_name = $accounts[0]['account_name'];}
}
if($_SESSION['type'] == 'pa'){
	//$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
 $Qaccounts  = "SELECT * FROM " .  accounts ." WHERE  TRIM(LOWER(REPLACE(account_name,' ','')))='privatepay'" ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_all_assoc();     $account_name = $accounts[0]['account_name']; }	
}
if($_SESSION['allowUser'] == ''){
$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE TRIM(LOWER(account_name)) LIKE '%Online User%' ";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
//$qry_office = "SELECT * FROM " . officelocations ."  ";if($db->query($qry_office) && $db->get_num_rows() > 0){$offices = $db->fetch_all_assoc();}
}
// print_r($offices);
/* $Query = "SELECT r.id,r.region FROM ".cmregions." as cr LEFT JOIN regions as r on cr.region_id=r.id WHERE cr.cm_id='".$_SESSION['userdata']['cm_id']."' ORDER BY r.region ASC "; 
 //$Q="SELECT * FROM cmregions";
if($db->query($Query) && $db->get_num_rows() > 0){$regions = $db->fetch_all_assoc();  }
*/ //print_r($regions); //exit;
function check_validation(){
	$error='';
	if(empty($_REQUEST['account'])){
		$error.='Account Name is required<br/>';
	}
	
	if(empty($_REQUEST['pname'])){
		$error.='Patient Name is required<br/>';
	}
	if(empty($_REQUEST['phnum'])){
		$error.='Patient Phone No is required<br/>';
	}
	$triptype='';
	if(empty($_REQUEST['triptype'])){
		$error.='Trip Type is required<br/>';
	}else{
		$triptype=$_REQUEST['triptype'];	
	}
	if(empty($_REQUEST['vehtype'])){
		$error.='Vehicle Preference is required<br/>';
	}
	if(empty($_REQUEST['appdate'])){
		$error.='Appointment Date is required<br/>';
	}
	if(empty($_REQUEST['apptime'])){
		$error.='PickUp Time is required<br/>';
	}
	if(empty($_REQUEST['org_apptime'])){
		$error.='Appointment Time is required<br/>';
	}
	if(empty($_REQUEST['pickaddress'])){
		$error.='Pickup Address is required<br/>';
	}
	//if(empty($_REQUEST['psuiteroom'])){		$error.='Suite / Apt / Bld is required<br/>';	}
	if(empty($_REQUEST['destination'])){
		$error.='Destination Address is required<br/>';
	}
//validation is if trip type 2nd	
	/*if(empty($_REQUEST['three_pickup']) && $triptype=='Three Way'){
		$error.='2nd Pick Time is required<br/>';
	}
	if(empty($_REQUEST['three_will_call']) && $triptype=='Three Way'){
		$error.='Will Call is required<br/>';
	}
	if(empty($_REQUEST['droplocation2']) && $triptype=='Three Way'){
		$error.='2nd Destination Location is required<br/>';
	}*/
	if(empty($_REQUEST['destination2']) && $triptype=='Three Way'){
		$error.='2nd Destination Address is required<br/>';
	}
	if(empty($_REQUEST['destination3']) && $triptype=='Four Way'){
		$error.='3rd Destination Address is required<br/>';
	}
	return $error;
}

 if($_POST['submit']){ 
 
 	$error = check_validation();

	if(empty($error)){
		// print_r($_POST); exit;
		//echo 'Coooooooooool'; exit;
		//$region 		= sql_replace($_POST['region']);
		//$cisid 			= sql_replace($_POST['cisid']); 	//if(empty($cisid))$errors .= 'Identification Number is required!';
		//$casemanager 	= sql_replace($_POST['casemanager']);
		$pname 			= str_replace('\'','`',sql_replace($_POST['pname']));		//if(empty($pname))$errors .= 'Patient Name is required!';
		$phnum 			= sql_replace($_POST['phnum']);		//if(empty($phnum))$errors .= 'Patient Phone Number is required!';
		$po 			= sql_replace($_POST['po']);
		$dob 			= convertDateToMySQL($_POST['dob']);		
		$todaydate 		= sql_replace($_POST['todaydate']);
		$triptype 		= sql_replace($_POST['triptype']); 		//if(empty($triptype))$errors .= 'Trip type is required!';
		$vehtype 		= sql_replace($_POST['vehtype']);		//if(empty($vehtype))$errors .= 'Vehicle is required!';
		$appdate 		= convertDateToMySQL($_POST['appdate']);		//if(empty($appdate))$errors .= 'Appoimnet Date is required!';
		$org_apptime	= sql_replace($_POST['org_apptime']);
		$apptime 		= sql_replace($_POST['apptime']);
		$puchoice 		= sql_replace($_POST['puchoice']);
		$returnpickup 	= sql_replace($_POST['returnpickup']); //return pickup time
		if($puchoice == 'Will Call'){ $returnpickup = 'Will Call'; }
		$passenger		= sql_replace($_POST['passenger']);		///phone='".$phnum."' AND
		/*
		//Start Logic to implement free driver time slots
		
		$driversFreeSlots=array(); $count=0;
	$q = "SELECT * FROM ".TBL_CONTACT; 		if($db->query($q) && $db->get_num_rows() > 0)	{ $contactinfo = $db->fetch_one_assoc(); }
$drvQuery = "SELECT  Drvid,fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus ='Active' ORDER BY  fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0){
		$drivers = $db->fetch_all_assoc();
		for($i = 0; $i < sizeof($drivers); $i++) {
			
			$tripsQ = "SELECT td.tdid,td.aptime,td.pck_time,td.drp_atime,td.drp_time,td.status  FROM trip_details as td  WHERE td.date = '$appdate' AND td.drv_id = '".$drivers[$i]['drv_code']."' ORDER by td.pck_time ASC";
			if($db->query($tripsQ) && $db->get_num_rows() > 0) { $total_trips	=	$db->get_num_rows();	$trips = $db->fetch_all_assoc();
					for($u = 0; $u < ($total_trips+1); $u++){ 
						if($u == 0){ 
									$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
									$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
									$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
									$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$contactinfo['starttime']; 
									$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u]['pck_time'];
									$count++;
						}elseif($u	==	$total_trips){
										$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
										$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
										$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
										$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['drp_time'];
										$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$contactinfo['endtime']; 
										$count++;
										}
						elseif($u != 0 && $u	!=	$total_trips ){ 
									$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
									$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
									$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
									$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$trips[$u-1]['drp_time'];
									$driversFreeSlots[$count]['free_end'] 	= 	$today.'T'.$trips[$u]['pck_time']; 
									$count++;
						
						}
					}
				 }else{
				$driversFreeSlots[$count]['drv_code'] = 	$drivers[$i]['drv_code'];
				$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
				$driversFreeSlots[$count]['free_start'] = 	$today.'T'.$contactinfo['starttime'];
				$driversFreeSlots[$count]['free_end'] = 	$today.'T'.$contactinfo['endtime'];
				$count++;
				}
			}
		//delete previouse free slots
		
		$driversFreeSlots=array(); $count=0;   $Qdl="DELETE FROM driversfreeslots"; $db->execute($Qdl);
		$today	=	$appdate;
$q = "SELECT * FROM ".TBL_CONTACT; 		if($db->query($q) && $db->get_num_rows() > 0)	{ $contactinfo = $db->fetch_one_assoc();}
$drvQuery = "SELECT  Drvid,fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus ='Active' ORDER BY  fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0){
		$drivers = $db->fetch_all_assoc();
		for($i = 0; $i < sizeof($drivers); $i++) {
			
			$tripsQ = "SELECT td.tdid,td.aptime,td.pck_time,td.drp_atime,td.drp_time,td.status  FROM trip_details as td  WHERE td.date = '$today' AND td.drv_id = '".$drivers[$i]['drv_code']."' ORDER by td.pck_time ASC";
			if($db->query($tripsQ) && $db->get_num_rows() > 0) { $total_trips	=	$db->get_num_rows();	$trips = $db->fetch_all_assoc();
			
					for($u = 0; $u < ($total_trips+1); $u++){ 
						
						if($u == 0){ 
									$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
									$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
									$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
									$driversFreeSlots[$count]['free_start'] = 	$today.' '.$contactinfo['starttime']; 
									$driversFreeSlots[$count]['free_end'] 	= 	$today.' '.$trips[$u]['pck_time'];
									$count++;
						}elseif($u	==	$total_trips){
										$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
										$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
										$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
										$driversFreeSlots[$count]['free_start'] = 	$today.' '.$trips[$u-1]['drp_time'];
										$driversFreeSlots[$count]['free_end'] 	= 	$today.' '.$contactinfo['endtime']; 
										$count++;
										}
						elseif($u != 0 && $u	!=	$total_trips ){ 
									$driversFreeSlots[$count]['Uvalue'] 	= 	$u;
									$driversFreeSlots[$count]['drv_code'] 	= 	$drivers[$i]['drv_code'];
									$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
									$driversFreeSlots[$count]['free_start'] = 	$today.' '.$trips[$u-1]['drp_time'];
									$driversFreeSlots[$count]['free_end'] 	= 	$today.' '.$trips[$u]['pck_time']; 
									$count++;
						
						}
					}
				
				
				 }else{
				$driversFreeSlots[$count]['drv_code'] = 	$drivers[$i]['drv_code'];
				$driversFreeSlots[$count]['Drvid'] 		= 	$drivers[$i]['Drvid'];
				$driversFreeSlots[$count]['free_start'] = 	$today.' '.$contactinfo['starttime'];
				$driversFreeSlots[$count]['free_end'] = 	$today.' '.$contactinfo['endtime'];
				$count++;
				}
			
			}
		
		
		}
		if(!empty($driversFreeSlots)){
			
			foreach ($driversFreeSlots as $rec) {
 			
				$Qinsert="INSERT INTO driversfreeslots SET 
									dated				=	'".($today)."',
									free_from			=	'".$rec['free_start']."',
									free_to				=	'".$rec['free_end']."',
									free_from_string	=	'".strtotime($rec['free_start'])."',
									free_to_string		=	'".strtotime($rec['free_end'])."' "; 
									$db->execute($Qinsert);
			
				}
			
			}
		//Insert new free slots
		}
		
		//End Logic to implement free driver time slots
		*/
				$Qfind="SELECT name FROM patient WHERE  LTRIM(LOWER(name)) = '".strtolower(trim(sql_replace($pname)))."' ";
		if($db->query($Qfind) && $db->get_num_rows()>0){}else{
			$Qinsert="INSERT INTO patient SET 
					name			=	'".sql_replace($pname)."',
					insurance_name	=	'".sql_replace($insurance_name)."',
					insurance		=	'$cisid',
					dob				=	'$dob',
					address			=	'".str_replace(',','',sql_replace($_POST['pickaddress']))."',
					phone			=	'$phnum'"; $db->execute($Qinsert);
			}	
	$pickadd 			= sql_replace($_POST['pickaddress']);
	$destination_one	= sql_replace($_POST['destination']);
	$destination2		= sql_replace($_POST['destination2']);
	$destination3		= sql_replace($_POST['destination3']); 
	$destination_last	= sql_replace($_POST['backto']);
	$picklocation		= sql_replace($_POST['picklocation']);
	$droplocation		= sql_replace($_POST['droplocation']);
	$droplocation2		= sql_replace($_POST['droplocation2']);
	$droplocation3		= sql_replace($_POST['droplocation3']); 
	$backtolocation		= sql_replace($_POST['backtolocation']);
	$three_pickup 		= sql_replace($_POST['three_pickup']);
	$three_will_call 	= sql_replace($_POST['three_will_call']);
	$four_pickup 		= sql_replace($_POST['four_pickup']);
	$four_will_call 	= sql_replace($_POST['four_will_call']);
	$five_pickup 		= sql_replace($_POST['five_pickup']);	
	$five_will_call 	= sql_replace($_POST['five_will_call']);
	$comments			= sql_replace($_POST['comments']);
	$pickup_instruction			= sql_replace($_POST['pickup_instruction']);
	$destination_instruction	= sql_replace($_POST['destination_instruction']);
	$destination_instruction2	= sql_replace($_POST['destination_instruction2']);
	$destination_instruction3	= sql_replace($_POST['destination_instruction3']);
	$backto_instruction			= sql_replace($_POST['backto_instruction']);
	$d_phnum					= sql_replace($_POST['d_phnum']);
	$d_phnum2					= sql_replace($_POST['d_phnum2']);
	$d_phnum3					= sql_replace($_POST['d_phnum3']);
	$p_phnum					= sql_replace($_POST['p_phnum']);
	//reoccurence trips information
		$day 				= sql_replace($_POST['day']);
		$reocc_appicktime 	= sql_replace($_POST['reocc_appicktime']);
		$reocc_repicktime 	= sql_replace($_POST['reocc_repicktime']);
		$till_date 			= convertDateToMySQL($_POST['till_date']);
	
		$q = "SELECT * FROM ".TBL_CONTACT;		if($db->query($q) && $db->get_num_rows() > 0){ $contactinfo = $db->fetch_one_assoc();
		$unload_add = $contactinfo['address'].", ".$contactinfo['city'].", ".$contactinfo['state'].", ".$contactinfo['zip'];
//$corporat_latlong=$d[0]['corporat_latlong'];$capped_miles_limit=$d[0]['capped_miles'];$starttime=$d[0]['starttime'];$endtime=$d[0]['endtime'];
		}	
		$unloadedmiles = round($mile_C->distance($pickadd,$unload_add),2);		
	if($triptype == 'One Way') {
		//$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		//$milesAB = $_POST['bus'];
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$miles_string = $milesAB;
		$miles 		= $milesAB;
		$base = 1;
		//$c1 = $mile_C->getLatLong($pickadd); 	 $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		//$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$returnpickup='12:00';
		}
		$after_hours = 0;
		$ptime = @mktime($apptime);
		$dtime = @mktime($returnpickup);
		$starttime = @mktime($starttime);
		$endtime = @mktime($endtime);
		if($ptime < $starttime){	$p_after_hours = 1;	}else{		$p_after_hours = 0;	}
		if($dtime > $endtime){		$r_after_hours = 1;	}else{		$r_after_hours = 0;	}
		if(($ptime < $starttime) || ($dtime > $endtime)){	$after_hours = 1;	}else{		$after_hours = 0;	}
	if($triptype == 'Round Trip') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		//$milesAB =$_POST['bus'];
		$milesBF = round($mile_C->distance($destination_one,$destination_last),2);
		//$milesBF =$_POST['truck'];
		$miles_string = $milesAB.','.$milesBF;
		$miles 		= $milesAB + $milesBF;
		}
	if($triptype == 'Three Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination2),2);
		$milesCF = round($mile_C->distance($destination2,$destination_last),2);
		//$milesAB = $_POST['bus'];
		//$milesBC = $_POST['truck'];
		//$milesCF = $_POST['car'];
		$miles_string = $milesAB.','.$milesBC.','.$milesCF;
		$miles 	  = $milesAB + $milesBC + $milesCF; 
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		}
	if($triptype == 'Four Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination2),2);
		$milesCD = round($mile_C->distance($destination2,$destination3),2);
		$milesDF = round($mile_C->distance($destination3,$destination_last),2);
		//$milesAB = $_POST['bus'];
		//$milesBC = $_POST['truck'];
		//$milesCD = $_POST['car'];
		//$milesDF = $_POST['train'];
		$miles_string = $milesAB.','.$milesBC.','.$milesCD.','.$milesDF;
		$miles	= $milesAB + $milesBC + $milesCD + $milesDF; 
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; }
		}	

  
			  
	$pickaddX 			= explode(',',$pickadd,2);
	if($pickaddX[1]){	$pickadd =	$pickaddX[0].','.str_replace(',','',sql_replace($_POST['psuiteroom'])).','.$pickaddX[1]; }
	$destination_oneX 	= explode(',',$destination_one,2);
	if($destination_oneX[1]){	$destination_one =	$destination_oneX[0].','.str_replace(',','',sql_replace($_POST['dsuiteroom'])).','.$destination_oneX[1]; }
	$destination2X 	= explode(',',$destination2,2);
	if($destination2X[1]){	$destination2 =	$destination2X[0].','.str_replace(',','',sql_replace($_POST['dsuiteroom2'])).','.$destination2X[1]; }
	$destination3X 	= explode(',',$destination3,2);
	if($destination3X[1]){	$destination3 =	$destination3X[0].','.str_replace(',','',sql_replace($_POST['dsuiteroom3'])).','.$destination3X[1]; }
	$destination_lastX 	= explode(',',$destination_last,2);
	if($destination_lastX[1]){	$destination_last =	$destination_lastX[0].','.str_replace(',','',sql_replace($_POST['bsuiteroom'])).','.$destination_lastX[1]; }
	
	$Qaccounts  = "SELECT id FROM " .  accounts ." WHERE  TRIM(LOWER(REPLACE(account_name,' ','')))='privatepay'" ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc();  $privatepayid=$accounts['id'];  }
	
	
	
	if($privatepayid==$_POST['account']){$billingtype='Privatepay';}else{$billingtype='Account';}
	
	/*if($_POST['samecaller']=='Yes'){
			$Q=" samecaller='Yes', "; $sendalert=$phnum;}else{
			$Q=" samecaller='No',
				 callername='".$_POST['callername']."',
				 relationship='".$_POST['relationship']."',
				 calbackno='".$_POST['calbackno']."', ";	$sendalert=$_POST['calbackno']; }*/
			/*if($_POST['wait_time']!='No'){$Q222="wait_timeA			='".$_POST['wait_timeA']."',
						wait_timeB			='".$_POST['wait_timeB']."',
						wait_timeC			='".$_POST['wait_timeC']."',
						wait_timeD			='".$_POST['wait_timeD']."',";}	*/ 
			$QW=" 
				 wchair					='".$_POST['wchair']."' ";
				 
			
			$accountId=0;
			$accountName='';
			if(!empty($_POST['account'])){
				$accountSql = "SELECT * FROM ".accounts." WHERE id='".$_POST['account']."'";
				if($db->query($accountSql) && $db->get_num_rows() > 0){ 
					$rcAccount = $db->fetch_one_assoc();
					$accountId=$rcAccount['id'];

					$accountName=$rcAccount['account_name'];
					$account_referral=$accountName;
					
				}
			}
			if(empty($_SESSION['type'])){
				$accountName='Online User';
			}elseif($_SESSION['type'] == 'ac'){
				$accountName=$accountName.'(Account Portal)';
			}elseif($_SESSION['type'] == 'pa'){
				$accountName=$pname.'(Customer Portal)';
				$QW .= ",cmid='".$_SESSION['userdata']['id']."'";  
			}
		
		// $org_apptime	= convertinto24($_POST['org_apptime'],$_POST['org_apptimerad']);//($_POST['org_apptime']);
		$org_apptime	= sql_replace($_POST['org_apptime']);//($_POST['org_apptime']);
		$apptime	= sql_replace($_POST['apptime']);//($_POST['org_apptime']);
		// $apptime 		= convertinto24($_POST['apptime'],$_POST['apptimerad']);
		$returnpickup	= sql_replace($_POST['returnpickup']);//($_POST['org_apptime']);
		// $returnpickup	= convertinto24($_POST['returnpickup'],$_POST['returnpickuprad']);
		if($puchoice == 'Will Call'){ $returnpickup = 'Will Call'; }
		$three_pickup 	= convertinto24($_POST['three_pickup'],$_POST['three_pickuprad']);//sql_replace($_POST['three_pickup']);
		$three_will_call= sql_replace($_POST['three_will_call']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= convertinto24($_POST['four_pickup'],$_POST['four_pickuprad']);//sql_replace($_POST['four_pickup']);
		$four_will_call = sql_replace($_POST['four_will_call']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; }
	/*	
		//To check pick time availibility
		$drptime	=	strtotime($appdate.' '.$apptime) + (round($milesAB)*3);
		$Sel 		=	"SELECT * FROM driversfreeslots WHERE dated = '$appdate' AND free_from_string < '".strtotime($appdate.' '.$apptime)."' AND free_to_string > '".$drptime."' ";
					if($db->query($Sel) && $db->get_num_rows() > 0){ }else{ echo '<script>alert("There is no driver available for given pick up time.");</script>'; 
					
					$error.='<br/>There is no driver available for given pick up time.';
					}
		//To check return pick up time availibility			
		if($triptype != 'One Way' && $returnpickup != 'Will Call') { 
			
		//echo $returnpickup; exit;
			$drptime	=	strtotime($appdate.' '.$returnpickup) + (round($milesBF)*3);
			 $Sel=	"SELECT * FROM driversfreeslots WHERE dated = '$appdate' AND free_from_string < '".strtotime($appdate.' '.$returnpickup)."' AND free_to_string > '".$drptime."' "; 
					if($db->query($Sel) && $db->get_num_rows() > 0){ }else{ echo '<script>alert("There is no driver available for given Return pick up time.");</script>'; 
					
					$error.='<br/>There is no driver available for given Return pick up time.';
					}
						}
		*/
	//	exit;
		if(empty($error)){
				  $Qr="account	='".$_POST['account']."',  $Q $QW,
					unloadedmilage='".$unloadedmiles."',
					miles_string = '".$miles_string."',
					milage='".$miles."',
					triptype='".$triptype."',	
					vehtype='".$vehtype."',	
					po='".$po."',
					patient_weight='".$_POST['patient_weight']."',
					pickaddr='".$pickadd."',
					destination='".$destination_one."',
					three_address='".$destination2."',
					four_address='".$destination3."',
					five_address='".$destination4."',
					three_pickup 	= '".$three_pickup."',
					four_pickup 	= '".$four_pickup."',
					five_pickup 	= '".$five_pickup."',
					backto='".$destination_last."',
					 
					today_date=NOW(),
					clientname='".$pname."',
                    phnum='".$phnum."',
					dob='".$dob."',
					notification=1,
					 
					stretcher				='".$stretcher."',
					dstretcher				='".$dstretcher."',
					oxygen					='".$_POST['oxygen']."',
					pickup_instruction='".$pickup_instruction."',
					destination_instruction='".$destination_instruction."',
					destination_instruction2='".$destination_instruction2."',
					destination_instruction3='".$destination_instruction3."',
					backto_instruction='".$backto_instruction."',
					d_phnum='".$d_phnum."',
					d_phnum2='".$d_phnum2."',
					d_phnum3='".$d_phnum3."',
					p_phnum='".$p_phnum."',
					picklocation	='".$picklocation."',
					droplocation	='".$droplocation."',
					droplocation2	='".$droplocation2."',
					droplocation3	='".$droplocation3."',
					backtolocation	='".$backtolocation."',
					capped_miles	='".$capped_miles."',
					after_hours 	='".$after_hours."',
					comments		='".$comments."' ";
				
					
	    $Query2  = "INSERT INTO ".TBL_FORMS." SET $Qr,
									appdate='".$appdate."',
									org_apptime='".$org_apptime."',
									apptime='".$apptime."',	
									returnpickup='".$returnpickup."'				";
		  if($db->execute($Query2))
		    { 
				//if($picklocation){$Qploc="SELECT * FROM locations WHERE location='$picklocation'"; if($db->query($Qploc) && $db->get_num_rows()>0){}
				//else{$Qpins="INSERT INTO locations SET location='$picklocation',address='$pickadd'"; $db->execute($Qpins);} }
				//if($droplocation){$Qdloc="SELECT * FROM locations WHERE location='$droplocation'"; if($db->query($Qdloc) && $db->get_num_rows()>0){}
				//else{$Qdins="INSERT INTO locations SET location='$droplocation',address='$destination_one'"; $db->execute($Qdins);}}
			//reoccurence trips
			//Start For Monday
if(($_POST['monday']=='on')&&(!empty($_POST['tdmonday']))&&(!empty($_POST['aptmonday']))) {
			$day 			= sql_replace($_POST['mon']);
			$till_date 		= sql_replace($_POST['tdmonday']); 
			$apptimeR 		= sql_replace($_POST['aptmonday']); 
			$returnpickupR 	= sql_replace($_POST['retmonday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$Qr,$_POST,$db);
			 } //End for Monday
			 //Start For tuseday
if(($_POST['tuseday']=='on')&&(!empty($_POST['tdtuseday']))&&(!empty($_POST['apttuseday']))) {
			$day 			= sql_replace($_POST['tus']);
			$till_date 		= sql_replace($_POST['tdtuseday']); 
			$apptimeR 		= sql_replace($_POST['apttuseday']); 
			$returnpickupR 	= sql_replace($_POST['rettuseday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$Qr,$_POST,$db);
			 } //End for tuseday
			 //Start For wednesday
if(($_POST['wednesday']=='on')&&(!empty($_POST['tdwednesday']))&&(!empty($_POST['aptwednesday']))) {
			$day 			= sql_replace($_POST['wed']);
			$till_date 		= sql_replace($_POST['tdwednesday']); 
			$apptimeR 		= sql_replace($_POST['aptwednesday']); 
			$returnpickupR 	= sql_replace($_POST['retwednesday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$Qr,$_POST,$db);
			 } //End for wednesday
			 //Start For thursday
if(($_POST['thirsday']=='on')&&(!empty($_POST['tdthirsday']))&&(!empty($_POST['aptthirsday']))) {
			$day 			= sql_replace($_POST['thi']);
			$till_date 		= sql_replace($_POST['tdthirsday']); 
			$apptimeR 		= sql_replace($_POST['aptthirsday']); 
			$returnpickupR 	= sql_replace($_POST['retthirsday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$Qr,$_POST,$db);
			 } //End for thursday
			 //Start For friday
if(($_POST['friday']=='on')&&(!empty($_POST['tdfriday']))&&(!empty($_POST['aptfriday']))) {
			$day 			= sql_replace($_POST['fri']);
			$till_date 		= sql_replace($_POST['tdfriday']); 
			$apptimeR 		= sql_replace($_POST['aptfriday']); 
			$returnpickupR 	= sql_replace($_POST['retfriday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$Qr,$_POST,$db);
			 } //End for friday
			 //Start For saturday
if(($_POST['saturday']=='on')&&(!empty($_POST['tdsaturday']))&&(!empty($_POST['aptsaturday']))) {
			$day 			= sql_replace($_POST['sat']);
			$till_date 		= sql_replace($_POST['tdsaturday']); 
			$apptimeR 		= sql_replace($_POST['aptsaturday']); 
			$returnpickupR 	= sql_replace($_POST['retsaturday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$Qr,$_POST,$db);
			 } //End for saturday
			 //END OF REOCCURING TRIPS
			 if($_SESSION['type'] == 'ac' || $_SESSION['type'] == 'pa'){
			 //Send email to site admin
			 include_once('emailme.php');
			 	 $html    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td colspan="2" align="left">
							Dear Admin,<br>
							One new trip request is submitted on '.$contactinfo['title'].' Portal. Trip detail is given below.
							<br><br>
							
							
							<b>Account Name:</b> '.$account_name.'.<br>
							<b>Customer Name:</b> '.$pname.'.<br> 
							<b>Appointment Date:</b> '.convertDateFromMySQL($appdate).'<br> 
							<b>PickUp Time:</b> '.$apptime.'<br><br>
							</td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">Regards, <br>  Support Team</td>
						  </tr>
						</table>';
	 
	 	sendmail_to_contact($html,$contactinfo['email'],'New Trip Request');
	  // send email to account/customer
	  if($_SESSION['type'] == 'ac'){ $nn=$_SESSION['userdata']['account_name'];}
	  if($_SESSION['type'] == 'pa'){$nn=$_SESSION['userdata']['fname'].' '.$_SESSION['userdata']['lname'];} 
	  
	  $html    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td colspan="2" align="left">
							Dear '.$nn.',<br>
							You have submitted a new trip request on '.$contactinfo['title'].' Portal. Trip detail is given below.
							<br><br>
							
							
							<b>Account Name:</b> '.$account_name.'.<br>
							<b>Customer Name:</b> '.$pname.'.<br> 
							<b>Appointment Date:</b> '.convertDateFromMySQL($appdate).'<br> 
							<b>PickUp Time:</b> '.$apptime.'<br><br>
							</td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">Regards, <br>  Support Team</td>
						  </tr>
						</table>';
			//  @sendmail_to($html,$_SESSION['userdata']['email'],'New Trip Request');
			 }
			 
			 
	echo '<script>alert("You have Successfully Submitted the Request.");</script>';  		 
	echo '<script>location.href="mytrips.php";</script>';  exit;
         }
		}
		 
		 
	}
  //functions to insert data of reoccurence trips
}
 function numWeekdays( $start_ts, $end_ts, $day, $include_start_end = false) {  //Count the number of days with dates.    
	   $day = strtolower( $day );    
	    $current_ts = $start_ts;    
	    // loop next $day until timestamp past $end_ts    
	    while( $current_ts < $end_ts ) {          
			if( ( $current_ts = strtotime( 'next '.$day, $current_ts ) ) < $end_ts) {             
			$dt= date('Y-m-d',$current_ts);   $days++;   }   
			 }         		      
		     // include start/end days    
		 if ( $include_start_end ) {         
		     if ( strtolower( date( 'l', $start_ts ) ) == $day ) {             
			    $days++;         }         
			 if ( strtolower( date( 'l', $end_ts ) ) == $day ) {             $days++;         }     
		 }         
	   return (int)$days;  } //END OF Count the number of days with dates.		
 function Weekdays( $start_ts, $end_ts, $day, $include_start_end = true) {      
	   $day = strtolower( $day );    
	    $current_ts = $start_ts;    
	    // loop next $day until timestamp past $end_ts  
		  $i=0;
	    while( $current_ts < $end_ts ) {          
			if( ( $current_ts = strtotime( 'next '.$day, $current_ts ) ) < $end_ts) {             
		$dt[$i]= date('Y-m-d',$current_ts);   $days++; $i++;      }     
 				}      // include start/end days    
		 if ( $include_start_end ) {         
		     if ( strtolower( date( 'l', $start_ts ) ) == $day ) { 
			 $dt[$i]= date('Y-m-d',$current_ts);            
			    $days++;         }         
			 if ( strtolower( date( 'l', $end_ts ) ) == $day ) {      
			 $dt[$i]= date('Y-m-d',$current_ts);
			        $days++;         }     
		 }         
	   return $dt;  }  //END OF FUNCTION NUMBER OF DAYS	
 function rectrips($day,$till_date,$apptime,$returnpickup,$Qr,$pst,$db){ //START of Reoccur Trips
		/*$dbus = new Database;	*/
	    $dbus=$db;
		$q = "SELECT * FROM ".TBL_CONTACT;
		if($dbus->query($q) && $dbus->get_num_rows() > 0)
		{ $d = $dbus->fetch_all_assoc();
		$starttime	=	$d[0]['starttime'];
		$endtime	=	$d[0]['endtime'];	}
		$after_hours = 0;
		$ptime = @mktime($apptime);
		$dtime = @mktime($returnpickup);
		$starttime = @mktime($starttime);
		$endtime = @mktime($endtime);
		if($ptime < $starttime){	$p_after_hours = 1;	}else{		$p_after_hours = 0;	}
		if($dtime > $endtime){		$r_after_hours = 1;	}else{		$r_after_hours = 0;	}
		if(($ptime < $starttime) || ($dtime > $endtime)){	$after_hours = 1;	}
	    $gday =  $day;
	    $start =strtotime(convertDateToMySQL($pst['appdate']));
	    if($till_date!=''){
		 $dat=$till_date;
		$end = strtotime(date("Y-m-d", strtotime($dat)) . " +1 day");
	     //$end = strtotime($dat);  
	    }
	    (int)$num=numWeekDays($start,$end,$day, false);   	   
	    $dts=Weekdays($start,$end,$day, true);  //print_r($num); //exit;	
	          for($i=0; $i<$num; $i++){
			  $dt=$dts[$i];
					   //INSERT INTO FORM TABLE
					$QueryQ  = "INSERT INTO ".TBL_FORMS." SET 
					$Qr,
					appdate='".$dt."',
					org_apptime='".$org_apptime."',
                    apptime='".$apptime."',
					returnpickup='".$returnpickup."'";
				  $dbus->execute($QueryQ);
				//print_r($num); exit;	
                  }
	}
//	$QS="SELECT MAX(tripnumber) as trn FROM ".TBL_FORMS." ";  if($db->query($QS) && $db->get_num_rows() > 0){ $dat=$db->fetch_one_assoc(); $tripnumber=($dat['trn'])+1; }
	
	//generate 15 minute interval list
	$intervalList = [];
	for($index = 0; $index < 24; ++$index){
		for($kthIndex = 0; $kthIndex < 4; ++$kthIndex){
			$intervalList[] = date('H:i',strtotime($index.":".($kthIndex*15)));
		}
	}

	//generate patient name list
	$clientName=[];
	$Q = "SELECT DISTINCT(clientname) FROM request_info WHERE account='".$_SESSION['userdata']['id']."' order by clientname"; 
    //print_r($Q);
    if($db->query($Q) && $db->get_num_rows()>0){ 
        $data = $db->fetch_all_assoc();
        for($i=0; $i<sizeof($data); $i++) {
            $clientName[]=$data[$i]['clientname'];
        }
    }
	//$clientName[] = "Linda Thomas";
	$intervalList[0]="12:00";
	$intervalList[1]="12:15";
	$intervalList[2]="12:30";
	$intervalList[3]="12:45";
	$db->close();
	//for calander
	$nextDay = date('m/d/Y', strtotime(' +0 day'));
	$chkNextDay = date('Y/m/d', strtotime(' +0 day'));
	//print_r($regions);
	$smarty->assign("error",$error);
	$smarty->assign("vehiclepref",$vehiclepref);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("post",$_POST);
	$smarty->assign("foot",$foot);
	$smarty->assign("offices",$offices);
	$smarty->assign("tripnumber",$tripnumber);
	$smarty->assign("itemstypes",$itemstypes);
	$smarty->assign("nextDay",$nextDay);
	$smarty->assign("chkNextDay",$chkNextDay);
	$smarty->assign("intervalList",$intervalList);
	$smarty->assign("clientName",$clientName);
	$smarty->assign("pg",'triprequest');			
    $smarty->display('triprequest.tpl');	
?>