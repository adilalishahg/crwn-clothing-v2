<?php
 include_once('includefile.php');
 include_once('Classes/mapquest_google_miles.class.php');	
 function minutes($totmiles){switch($totmiles){
						case ($totmiles <= 10) :
							$min = 20;
							break;
						case ($totmiles <= 15) :
							$min = 30;
							break;
						case ($totmiles <= 20) :
							$min = 40;
							break;
						case ($totmiles <= 25) :
							$min = 45;
							break;
						case ($totmiles <= 30) :
							$min = 50;
							break;
						case ($totmiles <= 35) :
							$min = 55;
							break;
						case ($totmiles <= 40) :
							$min = 60;
							break;
						case ($totmiles <= 45) :
							$min = 65;
							break;
						case ($totmiles <= 50) :
							$min = 70;
							break;
						case ($totmiles > 50) :
							$min = 120;
							break;
						default :
							$min = 0;
							break;		
					}
					$min = round($totmiles*1.5); return $min;	}
if($_SESSION['allowUser'] == ''){echo '<script>location.href="index.php";</script>';  exit;}
 
$mile_C = new mapquest_google_miles;
$qry_vehtype = "SELECT * FROM " . TBL_VEHTYPES ." WHERE  TRIM(LOWER(REPLACE(vehtype,' ',''))) = 'wheelchair'"; if($db->query($qry_vehtype) && $db->get_num_rows() > 0){$vehiclepref = $db->fetch_all_assoc();} 

 
if($_SESSION['type'] == 'ac'){

//$v_ids = $_SESSION['userdata']['id'];
	
  $Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['id']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
 
}

if($_SESSION['type'] == 'pa'){
	
	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
}



//$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['id']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
 /*$Query = "SELECT r.id,r.region FROM ".cmregions." as cr LEFT JOIN regions as r on cr.region_id=r.id WHERE cr.cm_id='".$_SESSION['userdata']['cm_id']."' ORDER BY r.region ASC "; 
if($db->query($Query) && $db->get_num_rows() > 0){$regions = $db->fetch_all_assoc();  }*/
$id=$_GET['id'];
 $Qs="SELECT * FROM ".TBL_FORMS." WHERE id = '".$id."' $wrAC";
if($db->query($Qs) && $db->get_num_rows() > 0){$tripdata = $db->fetch_one_assoc(); //print_r($tripdata);
if($tripdata['dob']!='0000-00-00'){$tripdata['dob']=date('m/d/Y',strtotime($tripdata['dob']));}
if($tripdata['returnpickup']!='00:00' || $tripdata['returnpickup']!='00:00:00' || $tripdata['returnpickup']!='Will Call'){
	$tripdata['pickupchoice']='Time';}else{$tripdata['pickupchoice']='Will Call';} 

 	  $paddr=explode(',',$tripdata['pickaddr'],3);
	  $daddr=explode(',',$tripdata['destination'],3);
	  $backaddr=explode(',',$tripdata['backto'],3);
	  $daddr2=explode(',',$tripdata['three_address'],3);
	  $daddr3=explode(',',$tripdata['four_address'],3);
	  	  
	  $tripdata['pickaddress']			=	$paddr[0].','.$paddr[2];
	  $tripdata['psuiteroom']			=	$paddr[1];
	  $tripdata['destination']			=	$daddr[0].','.$daddr[2];
	  $tripdata['dsuiteroom']			=	$daddr[1];
	  $tripdata['destination2']			=	$daddr2[0].','.$daddr2[2];
	  $tripdata['dsuiteroom2']			=	$daddr2[1];
	  $tripdata['destination3']			=	$daddr3[0].','.$daddr3[2];
	  $tripdata['dsuiteroom3']			=	$daddr3[1];
	  $tripdata['backto']	  			=	$backaddr[0].','.$backaddr[2];
	  $tripdata['bsuiteroom']			=	$backaddr[1];
	  
	  $mls=explode(',',$tripdata['miles_string']);
	  $tripdata['mileA']			=	$mls[0];
	  if($mls[1]){$tripdata['mileB']			=	$mls[1];}
	  if($mls[2]){$tripdata['mileC']			=	$mls[2];}
	  if($mls[3]){$tripdata['mileD']			=	$mls[3];}
	  
	  $items							=	explode(',',$tripdata['items']);	
	  $tripdata['appdate']				=	date('m/d/Y',strtotime($tripdata['appdate']));
	  $tripdata['apptimerad']			=	date('a',strtotime($tripdata['apptime']));
	  $tripdata['org_apptimerad']		=	date('a',strtotime($tripdata['org_apptime']));
	  $tripdata['returnpickuprad']		=	date('a',strtotime($tripdata['returnpickup']));
	  $tripdata['apptime']				=	date('h:i',strtotime($tripdata['apptime']));
	  $tripdata['org_apptime']			=	date('h:i',strtotime($tripdata['org_apptime']));
	  $tripdata['returnpickup']			=	date('h:i',strtotime($tripdata['returnpickup']));
	 //		echo '<pre>'; print_r($tripdata); 
  }
if($_POST['submit']){ 
$id=$_POST['id'];


		if(!empty($_POST['account'])){
				$accountSql = "SELECT * FROM ".accounts." WHERE id='".$_POST['account']."'";
				if($db->query($accountSql) && $db->get_num_rows() > 0){ 
					$rcrAccount = $db->fetch_one_assoc();
					
					$account_referral=$rcrAccount['account_name'];
					
				}
			}

  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
		$vehiclepref = $db->fetch_all_assoc(); 
		for($i=0;$i<sizeof($vehiclepref);$i++){ $vtypesarray[$vehiclepref[$i]['id']]= $vehiclepref[$i]['vehtype']; }
		}
$getacc = "SELECT id,account_name FROM ".accounts." WHERE 1=1 $strwhere ORDER BY account_name ASC";
 		 if($db->query($getacc) && $db->get_num_rows())
			  {  $accounts = $db->fetch_all_assoc(); 
			  for($i=0;$i<sizeof($accounts);$i++){ $accountsarray[$accounts[$i]['id']]= $accounts[$i]['account_name']; }
			  }
 
 $changedlogs='';
 $Query1 = "SELECT * FROM ".TBL_FORMS." WHERE `id`='".$_POST['id']."'  ";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {  $olddata = $db->fetch_one_assoc();}
 
 if($olddata['officelocation']!=$_POST['officelocation']){$changedlogs.='Office Location changed  From [ '.$officelocarray[$olddata['officelocation']] .' ] To &raquo; [ '.$officelocarray[$_POST['officelocation']]  .' ]<br/>';}

if($olddata['account']!=$_POST['account']){$changedlogs.='
Billing Account on File changed  From [ '.$accountsarray[$olddata['account']].' ] To &raquo; [ '.$accountsarray[$_POST['account']].' ]<br/>';}

if($olddata['triptype']!=$_POST['triptype']){$changedlogs.='Trip type changed  From [ '.$olddata['triptype'].' ] To &raquo; [ '.$_POST['triptype'].' ]<br/>';}

if($olddata['vehtype']!=$_POST['vehtype']){$changedlogs.='Vehicle type changed  From [ '.$vtypesarray[$olddata['vehtype']].' ] To &raquo; [ '.$vtypesarray[$_POST['vehtype']].' ]<br/>';}
		
if($olddata['wchair']!=$_POST['wchair']){$changedlogs.='Wheel Chair Needed changed  From [ '.$olddata['wchair'].' ] To &raquo; [ '.$_POST['wchair'].' ]<br/>';}

if($olddata['patient_weight']!=$_POST['patient_weight']){$changedlogs.='Patient Weight changed  From [ '.$olddata['patient_weight'].' ] To &raquo; [ '.$_POST['patient_weight'].' ]<br/>';}
if($olddata['patient_height']!=$_POST['patient_height']){$changedlogs.='Patient Height changed  From [ '.$olddata['patient_height'].' ] To &raquo; [ '.$_POST['patient_height'].' ]<br/>';}
if($olddata['oxygen']!=$_POST['oxygen']){$changedlogs.='Oxygen Needed changed  From [ '.$olddata['oxygen'].' ] To &raquo; [ '.$_POST['oxygen'].' ]<br/>';}

if($olddata['wait_time']!=$_POST['wait_time']){$changedlogs.='Wait Time changed  From [ '.$olddata['wait_time'].' ] To &raquo; [ '.$_POST['wait_time'].' ]<br/>';}
if($olddata['callername']!=$_POST['callername']){$changedlogs.='Caller Name changed  From [ '.$olddata['callername'].' ] To &raquo; [ '.$_POST['callername'].' ]<br/>';}
if($olddata['relationship']!=$_POST['relationship']){$changedlogs.='Relationship/Agency changed  From [ '.$olddata['relationship'].' ] To &raquo; [ '.$_POST['relationship'].' ]<br/>';}
if($olddata['calbackno']!=$_POST['calbackno']){$changedlogs.='Call Back Number changed  From [ '.$olddata['calbackno'].' ] To &raquo; [ '.$_POST['calbackno'].' ]<br/>';}
if($olddata['clientname']!=$_POST['pname']){$changedlogs.='Patient Name changed  From [ '.$olddata['clientname'].' ] To &raquo; [ '.$_POST['pname'].' ]<br/>';}
if($olddata['phnum']!=$_POST['phnum']){$changedlogs.='Patient Phone changed  From [ '.$olddata['phnum'].' ] To &raquo; [ '.$_POST['phnum'].' ]<br/>';}
if($_POST['dob']!=$_POST['dob_old']){$changedlogs.='Patient DOB changed  From [ '.$_POST['dob_old'].' ] To &raquo; [ '.$_POST['dob'].' ]<br/>';}
if($olddata['po']!=$_POST['po']){$changedlogs.='P.O # changed  From [ '.$olddata['po'].' ] To &raquo; [ '.$_POST['po'].' ]<br/>';}
if($olddata['appdate']!=$_POST['appdate']){$changedlogs.='Service Date changed  From [ '.$olddata['appdate'].' ] To &raquo; [ '.$_POST['appdate'].' ]<br/>';}
if(substr($olddata['apptime'],0,5)!=substr($_POST['apptime'],0,5)){$changedlogs.='Pick up Time changed  From [ '.$olddata['apptime'].' ] To &raquo; [ '.$_POST['apptime'].' ]<br/>';}
if(substr($olddata['org_apptime'],0,5)!=substr($_POST['org_apptime'],0,5)){$changedlogs.='Appointment Time changed  From [ '.$olddata['org_apptime'].' ] To &raquo; [ '.$_POST['org_apptime'].' ]<br/>';}
if(substr($olddata['returnpickup'],0,5)!=substr($_POST['returnpickup'],0,5)){$changedlogs.='Return Pickup Time changed  From [ '.$olddata['returnpickup'].' ] To &raquo; [ '.$_POST['returnpickup'].' ]<br/>';}
if($olddata['passenger']!=$_POST['passenger']){$changedlogs.='Total Passengers changed  From [ '.$olddata['passenger'].' ] To &raquo; [ '.$_POST['passenger'].' ]<br/>';}
if($olddata['comments']!=$_POST['comments']){$changedlogs.='Comments changed  From [ '.$olddata['comments'].' ] To &raquo; [ '.$_POST['comments'].' ]<br/>';}
if($olddata['picklocation']!=$_POST['picklocation']){$changedlogs.='Pick Up Location changed  From [ '.$olddata['picklocation'].' ] To &raquo; [ '.$_POST['picklocation'].' ]<br/>';}

if($_POST['pickaddress']!=$_POST['pickaddress_old']){$changedlogs.='Pick up address changed  From [ '.$_POST['pickaddress_old'].' ] To &raquo; [ '.$_POST['pickaddress'].' ]<br/>';}
if($_POST['psuiteroom']!=$_POST['psuiteroom_old']){$changedlogs.='Pick up Suite #/Room # changed  From [ '.$_POST['psuiteroom_old'].' ] To &raquo; [ '.$_POST['psuiteroom'].' ]<br/>';}

if($olddata['pickup_instruction']!=$_POST['pickup_instruction']){$changedlogs.='Pick Up Instructions changed  From [ '.$olddata['pickup_instruction'].' ] To &raquo; [ '.$_POST['pickup_instruction'].' ]<br/>';}
if($olddata['p_phnum']!=$_POST['p_phnum']){$changedlogs.='Pickup Phone changed From [ '.$olddata['p_phnum'].' ] To &raquo; [ '.$_POST['p_phnum'].' ]<br/>';}


if($olddata['destination_officelocation']!=$_POST['destination_officelocation']){$changedlogs.='First Destination Office Location changed  From [ '.$officelocarray[$olddata['destination_officelocation']] .' ] To &raquo; [ '.$officelocarray[$_POST['destination_officelocation']]  .' ]<br/>';}
if($olddata['destination_account']!=$_POST['destination_account']){$changedlogs.='First Destination Secondary Billing Account on File changed  From [ '.$accountsarray[$olddata['destination_account']].' ] To &raquo; [ '.$accountsarray[$_POST['destination_account']].' ]<br/>';}
if($olddata['droplocation']!=$_POST['droplocation']){$changedlogs.='First Destination Location changed  From [ '.$olddata['droplocation'].' ] To &raquo; [ '.$_POST['droplocation'].' ]<br/>';}

if($_POST['destination']!=$_POST['destination_old']){$changedlogs.='First Destination address changed  From [ '.$_POST['destination_old'].' ] To &raquo; [ '.$_POST['destination'].' ]<br/>';}
if($_POST['dsuiteroom']!=$_POST['dsuiteroom_old']){$changedlogs.='First Destination Suite #/Room # changed  From [ '.$_POST['dsuiteroom_old'].' ] To &raquo; [ '.$_POST['dsuiteroom'].' ]<br/>';}
if($olddata['destination_instruction']!=$_POST['destination_instruction']){$changedlogs.='First destination instruction changed  From [ '.$olddata['destination_instruction'].' ] To &raquo; [ '.$_POST['destination_instruction'].' ]<br/>';}
if($olddata['d_phnum']!=$_POST['d_phnum']){$changedlogs.='First Destination Phone changed  From [ '.$olddata['d_phnum'].' ] To &raquo; [ '.$_POST['d_phnum'].' ]<br/>';}

//// for three way  trips changes
if($olddata['destination2_officelocation']!=$_POST['destination2_officelocation']){$changedlogs.='Second Destination Office Location changed  From [ '.$officelocarray[$olddata['destination2_officelocation']] .' ] To &raquo; [ '.$officelocarray[$_POST['destination2_officelocation']]  .' ]<br/>';}
if($olddata['destination2_account']!=$_POST['destination2_account']){$changedlogs.='Second Destination Secondary Billing Account on File changed  From [ '.$accountsarray[$olddata['destination2_account']].' ] To &raquo; [ '.$accountsarray[$_POST['destination2_account']].' ]<br/>';}
if($olddata['droplocation2']!=$_POST['droplocation2']){$changedlogs.='Second Destination Location changed  From [ '.$olddata['droplocation2'].' ] To &raquo; [ '.$_POST['droplocation2'].' ]<br/>';}
if($_POST['destination2']!=$_POST['destination2_old']){$changedlogs.='Second Destination address changed  From [ '.$_POST['destination2_old'].' ] To &raquo; [ '.$_POST['destination2'].' ]<br/>';}
if($_POST['dsuiteroom2']!=$_POST['dsuiteroom2_old']){$changedlogs.='Second Destination Suite #/Room # changed  From [ '.$_POST['dsuiteroom2_old'].' ] To &raquo; [ '.$_POST['dsuiteroom2'].' ]<br/>';}
if($olddata['destination_instruction2']!=$_POST['destination_instruction2']){$changedlogs.='Second destination instruction changed  From [ '.$olddata['destination_instruction2'].' ] To &raquo; [ '.$_POST['destination_instruction2'].' ]<br/>';}
if($olddata['d_phnum2']!=$_POST['d_phnum2']){$changedlogs.='Second Destination Phone changed  From [ '.$olddata['d_phnum2'].' ] To &raquo; [ '.$_POST['d_phnum2'].' ]<br/>';}
//// for  four way trips changes
if($olddata['destination3_officelocation']!=$_POST['destination3_officelocation']){$changedlogs.='Third Destination Office Location changed  From [ '.$officelocarray[$olddata['destination3_officelocation']] .' ] To &raquo; [ '.$officelocarray[$_POST['destination3_officelocation']]  .' ]<br/>';}
if($olddata['destination3_account']!=$_POST['destination3_account']){$changedlogs.='Third Destination Secondary Billing Account on File changed  From [ '.$accountsarray[$olddata['destination3_account']].' ] To &raquo; [ '.$accountsarray[$_POST['destination3_account']].' ]<br/>';}
if($olddata['droplocation3']!=$_POST['droplocation3']){$changedlogs.='Third Destination Location changed  From [ '.$olddata['droplocation3'].' ] To &raquo; [ '.$_POST['droplocation3'].' ]<br/>';}
if($_POST['destination3']!=$_POST['destination3_old']){$changedlogs.='Third Destination address changed  From [ '.$_POST['destination3_old'].' ] To &raquo; [ '.$_POST['destination3'].' ]<br/>';}
if($_POST['dsuiteroom3']!=$_POST['dsuiteroom3_old']){$changedlogs.='Third Destination Suite #/Room # changed  From [ '.$_POST['dsuiteroom3_old'].' ] To &raquo; [ '.$_POST['dsuiteroom3'].' ]<br/>';}
if($olddata['destination_instruction3']!=$_POST['destination_instruction3']){$changedlogs.='Third destination instruction changed  From [ '.$olddata['destination_instruction3'].' ] To &raquo; [ '.$_POST['destination_instruction3'].' ]<br/>';}
if($olddata['d_phnum3']!=$_POST['d_phnum3']){$changedlogs.='Third Destination Phone changed  From [ '.$olddata['d_phnum3'].' ] To &raquo; [ '.$_POST['d_phnum3'].' ]<br/>';}



// print_r($_POST); exit;
 //echo 'Coooooooooool'; exit;
	 	$region 		= sql_replace($_POST['region']);
		$cisid 			= sql_replace($_POST['cisid']); 	//if(empty($cisid))$errors .= 'Identification Number is required!';
		//$casemanager 	= sql_replace($_POST['casemanager']);
		$pname 			= str_replace('\'','`',sql_replace($_POST['pname']));		//if(empty($pname))$errors .= 'Patient Name is required!';
		$phnum 			= sql_replace($_POST['phnum']);		//if(empty($phnum))$errors .= 'Patient Phone Number is required!';
		$po 			= sql_replace($_POST['po']);
		$dob 			= convertDateToMySQL($_POST['dob']);		
		$todaydate 		= sql_replace($_POST['todaydate']);
		$triptype 		= sql_replace($_POST['triptype']); 		//if(empty($triptype))$errors .= 'Trip type is required!';
		$pre_triptype				= sql_replace($_POST['pre_triptype']);	
		$vehtype 		= sql_replace($_POST['vehtype']);		//if(empty($vehtype))$errors .= 'Vehicle is required!';
		$appdate 		= convertDateToMySQL($_POST['appdate']);		//if(empty($appdate))$errors .= 'Appoimnet Date is required!';
		$org_apptime	= sql_replace($_POST['org_apptime']);
		$apptime 		= sql_replace($_POST['apptime']);
		$puchoice 		= sql_replace($_POST['puchoice']);
		$returnpickup 	= sql_replace($_POST['returnpickup']); //return pickup time
		if($puchoice == 'Will Call'){ $returnpickup = 'Will Call'; }
		$passenger		= sql_replace($_POST['passenger']); // phone='".$phnum."' AND
				$Qfind="SELECT * FROM patient WHERE  LTRIM(LOWER(name)) = '".strtolower(trim(sql_replace($pname)))."' ";
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
	
	$org_apptime	= convertinto24($_POST['org_apptime'],$_POST['org_apptimerad']);
		$apptime 		= convertinto24($_POST['apptime'],$_POST['apptimerad']);
		$returnpickup	= convertinto24($_POST['returnpickup'],$_POST['returnpickuprad']);
		if($puchoice == 'Will Call'){ $returnpickup = 'Will Call'; }
		$three_pickup 	= convertinto24($_POST['three_pickup'],$_POST['three_pickuprad']);
		$three_will_call= sql_replace($_POST['three_will_call']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= convertinto24($_POST['four_pickup'],$_POST['four_pickuprad']);
		$four_will_call = sql_replace($_POST['four_will_call']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; } 
 
	if($privatepayid==$_POST['account']){$billingtype='Privatepay';}else{$billingtype='Account';}
   
			$QW=" 
				 
				  $Q222
				 wchair					='".$_POST['wchair']."'
				 
				 
				  ";
	//account	='".$_POST['account']."',
				$Qr="unloadedmilage='".$unloadedmiles."', $Q $QW,
					
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
					cisid='".$cisid."',
					insurance_name='".$insurance_name."',
					stretcher='".$stretcher."',
					dstretcher='".$dstretcher."',
					oxygen='".$_POST['oxygen']."',
					pickup_instruction='".$pickup_instruction."',
					destination_instruction='".$destination_instruction."',
					destination_instruction2='".$destination_instruction2."',
					destination_instruction3='".$destination_instruction3."',
					backto_instruction='".$backto_instruction."',
					d_phnum			='".$d_phnum."',
					d_phnum2		='".$d_phnum2."',
					d_phnum3		='".$d_phnum3."',
					p_phnum			='".$p_phnum."',
					picklocation	='".$picklocation."',
					droplocation	='".$droplocation."',
					droplocation2	='".$droplocation2."',
					droplocation3	='".$droplocation3."',
					backtolocation	='".$backtolocation."',
					capped_miles	='".$capped_miles."',
					after_hours 	='".$after_hours."',
					 
					comments		='".$comments."'";
					
		if($_SESSION['type'] == 'pa'){$WherePA = " AND cmid='".$_SESSION['userdata']['id']."'";  }
					
	     $Query2  = "UPDATE ".TBL_FORMS." SET $Qr,
									appdate='".$appdate."',
									org_apptime='".$org_apptime."',
									apptime='".$apptime."',	
									returnpickup='".$returnpickup."'  WHERE id ='".$id."' $WherePA ";
									
		  if($db->execute($Query2))
		    { 
			 // triplog($db,'Trip Updated. ',$id,'','',$changedlogs);
			 
			$Quptrips="UPDATE trips	SET trip_user	=	'".$pname."',
										trip_tel	=	'".$phnum."',
										trip_date	=	'".$appdate."',
										account		=	'".sql_replace($_POST['account'])."' WHERE reqid ='".$id."'";  $db->execute($Quptrips);
										
			$QPup="UPDATE patient SET 
					insurance_name	=	'".sql_replace($insurance_name)."',
					insurance		=	'$cisid',
					ssn				=	'$ssn',
					dob				=	'$dob',
					address			=	'".$_POST['pickaddress']."',
					city			=	'".$city."',
					state			=	'".trim($state)."',
					zip				=	'".$zip."',
					phone			=	'$phnum' WHERE LTRIM(LOWER(name)) = '".strtolower(trim(sql_replace($pname)))."'"; 
					$db->execute($QPup);
										
			$ptime		= $apptime;
			$prop 	= "10";
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $milesAB;
					$min = minutes($totmiles);
					$min = round($totmiles*3);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';									
										
			$Quptripsdetail="UPDATE trip_details SET date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$pickadd."',
													drp_add					=	'".$destination_one."',
													picklocation			=	'".$picklocation."',
													droplocation			=	'".$droplocation."',
													pickup_instruction		=	'".$pickup_instruction."',
													destination_instruction	=	'".$destination_instruction."',
													p_phnum					=	'".$p_phnum."',
													d_phnum					=	'".$d_phnum."',
													trip_miles				=	'".$milesAB."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													cellalert 				=	'".$cellalert."',
													cellalertoption 		=	'".$cellalertoption."',
													trigerfor 				=	'".$trigerfor."',
													trip_remarks			=	'".$comments."',
													wc						=	'0',
													
													passenger				=	'".$_POST['passenger']."'
																										
													 WHERE reqid ='".$id."' AND type = 'AB'";  $db->execute($Quptripsdetail);
								$Qsltripid="SELECT trip_id FROM trip_details WHERE reqid ='".$id."'";	
								if($db->query($Qsltripid) && $db->get_num_rows())
			  {  $Qsltripiddata = $db->fetch_one_assoc(); $trip_id=$Qsltripiddata['trip_id']; }					 
													 
			if($triptype == 'Round Trip') {
				if($returnpickup != "00:00:00" && $returnpickup != "Will Call")
				{	
				$ptime		= $returnpickup;
				
					$prop 	= "10";
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $milesBF;
					$min = minutes($totmiles);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';	}
					else{ 
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';	}	
										
												$Qrst="date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$destination_one."',
													drp_add					=	'".$destination_last."',
													picklocation			=	'".$droplocation."',
													droplocation			=	'".$picklocation."',
													pickup_instruction		=	'".$destination_instruction."',
													destination_instruction	=	'".$backto_instruction."',
													p_phnum					=	'".$d_phnum."',
													d_phnum					=	'".$p_phnum."',
													trip_miles				=	'".$milesBF."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													wc 						= 	'".$wc."',
													trip_remarks			=	'".$comments."',
													
													ccode					=	'".$_POST['tripnumber']."',
													passenger				=	'".$_POST['passenger']."'";		
			if($pre_triptype=='One Way'){										
			$Quptripsdetail2="INSERT INTO trip_details SET $Qrst, reqid ='".$id."', type = 'BF',trip_id = '".$trip_id."' "; }
			elseif($pre_triptype=='Three Way' || $pre_triptype=='Four Way'){$Quptripsdetail2="UPDATE trip_details SET $Qrst,type='BF' WHERE reqid ='".$id."' AND type = 'BC'";}
			else{$Quptripsdetail2="UPDATE trip_details SET $Qrst WHERE reqid ='".$id."' AND type = 'BF'";  }
			$db->execute($Quptripsdetail2);
				}
			if($triptype == 'Three Way') {
				if($three_pickup != "00:00:00" && $three_pickup != "Will Call")
				{	
					$ptime		= $three_pickup;
					$prop 		= "10";
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $milesBC;
					$min = minutes($totmiles);
					$min = round($totmiles*3);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';	}
					else{
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';	
							}		
											$Qrst="	date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$destination_one."',
													drp_add					=	'".$destination2."',
													picklocation			=	'".$droplocation."',
													droplocation			=	'".$droplocation2."',
													pickup_instruction		=	'".$destination_instruction."',
													destination_instruction	=	'".$destination_instruction2."',
													p_phnum					=	'".$d_phnum."',
													d_phnum					=	'".$d_phnum2."',
													trip_miles				=	'".$milesBC."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													wc 						= 	'".$wc."',
													
													ccode					=	'".$_POST['tripnumber']."',
													passenger 				= 	'".$passenger."'";	
			if($pre_triptype=='One Way'){
			$Quptripsdetail2="INSERT INTO trip_details SET $Qrst, reqid ='".$id."', type = 'BC',trip_id = '".$trip_id."' ";	}
			elseif($pre_triptype=='Round Trip'){$Quptripsdetail2="UPDATE trip_details SET 	$Qrst,type = 'BC'	WHERE reqid ='".$id."' AND type = 'BF'";}else{											
			$Quptripsdetail2="UPDATE trip_details SET 	$Qrst	WHERE reqid ='".$id."' AND type = 'BC'"; 	}
								$db->execute($Quptripsdetail2);
			if($returnpickup != "00:00:00" && $returnpickup != "Will Call")
				{	
					$ptime		= $returnpickup;
					$prop 		= "10";
					$pptime 	= strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles 	= $milesCF;
					$min 		= minutes($totmiles);
					$min 		= round($totmiles*3);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';	}
					else{
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';	
							}			
							$Qrst=" date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$destination2."',
													drp_add					=	'".$destination_last."',
													picklocation			=	'".$droplocation2."',
													droplocation			=	'".$backtolocation."',
													pickup_instruction		=	'".$destination_instruction2."',
													destination_instruction	=	'".$backto_instruction."',
													p_phnum					=	'".$d_phnum2."',
													d_phnum					=	'".$p_phnum."',
													trip_miles				=	'".$milesCF."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													wc 						= 	'".$wc."',
													trip_remarks			=	'".$comments."',													
													ccode					=	'".$_POST['tripnumber']."',
													passenger 				= 	'".$passenger."'";		
		 
			if($pre_triptype=='One Way' || $pre_triptype=='Round Trip'){
			$Quptripsdetail2="INSERT INTO trip_details SET $Qrst, reqid ='".$id."', type = 'CF',trip_id = '".$trip_id."' ";	}
			elseif($pre_triptype=='Four Way' ){$Quptripsdetail2="UPDATE trip_details SET 	$Qrst,type='CF'	WHERE reqid ='".$id."' AND type = 'CD'"; }else{												
			$Quptripsdetail2="UPDATE trip_details SET 	$Qrst	WHERE reqid ='".$id."' AND type = 'CF'"; 	}		
													$db->execute($Quptripsdetail2);										
				}	
			if($triptype == 'Four Way') {
				if($three_pickup != "00:00:00" && $three_pickup != "Will Call")
				{	
					$ptime		= $three_pickup;
					$prop 	= "10";
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $milesBC;
					$min = minutes($totmiles);
					$min = round($totmiles*3);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';	}
					else{
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';	
							}	
				//$Quptripsdetail2="UPDATE trip_details SET							
											 $Qrst="date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$destination_one."',
													drp_add					=	'".$destination2."',
													picklocation			=	'".$droplocation."',
													droplocation			=	'".$droplocation2."',
													pickup_instruction		=	'".$destination_instruction."',
													destination_instruction	=	'".$destination_instruction2."',
													p_phnum					=	'".$d_phnum."',
													d_phnum					=	'".$d_phnum2."',
													trip_miles				=	'".$milesBC."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													wc 						= 	'".$wc."',
													
													
													ccode					=	'".$_POST['tripnumber']."',
													passenger 				= 	'".$passenger."'";
																										
													//WHERE reqid ='".$id."' AND type = 'BC'";  $db->execute($Quptripsdetail2);
			if($pre_triptype=='One Way'){
			$Quptripsdetail2="INSERT INTO trip_details SET $Qrst, reqid ='".$id."', type = 'BC',trip_id = '".$trip_id."' ";	}
			else{												
			$Quptripsdetail2="UPDATE trip_details SET $Qrst, type = 'BC'	WHERE reqid ='".$id."' AND type IN ('BC','BF')"; 	}	
			$db->execute($Quptripsdetail2);										
													
			if($four_pickup != "00:00:00" && $four_pickup != "Will Call")
				{	
					$ptime		= $four_pickup;
					$prop 	= "10";
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $milesCD;
					$min = minutes($totmiles);
					$min = round($totmiles*3);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';	}
					else{
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';	
							}					
											$Qrst=" date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$destination2."',
													drp_add					=	'".$destination3."',
													picklocation			=	'".$droplocation2."',
													droplocation			=	'".$droplocation3."',
													pickup_instruction		=	'".$destination_instruction2."',
													destination_instruction	=	'".$destination_instruction3."',
													p_phnum					=	'".$d_phnum2."',
													d_phnum					=	'".$d_phnum3."',
													trip_miles				=	'".$milesCD."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													wc 						= 	'".$wc."',
													
													ccode					=	'".$_POST['tripnumber']."',
													passenger 				= 	'".$passenger."'";
													//WHERE reqid ='".$id."' AND type = 'CD'";  $db->execute($Quptripsdetail2);	
			if($pre_triptype=='One Way' || $pre_triptype=='Round Trip'){
			$Quptripsdetail2="INSERT INTO trip_details SET $Qrst, reqid ='".$id."', type = 'CD',trip_id = '".$trip_id."' ";	
			}else{												
			$Quptripsdetail2="UPDATE trip_details SET $Qrst,type='CD'	WHERE reqid ='".$id."' AND type IN ('CF','CD')"; 	}			
													$db->execute($Quptripsdetail2);																		
																						
			if($returnpickup != "00:00:00" && $returnpickup != "Will Call")
				{	
					$ptime		= $returnpickup;
					$prop 	= "10";
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $milesDF;
					$min = minutes($totmiles);
					$min = round($totmiles*3);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';	}
					else{
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';	
							}					
											$Qrst=" date					=	'".$appdate."',
													veh_id					=	'".$vehtype."',
													pck_add					=	'".$destination3."',
													drp_add					=	'".$destination_last."',
													picklocation			=	'".$droplocation3."',
													droplocation			=	'".$backtolocation."',
													pickup_instruction		=	'".$destination_instruction3."',
													destination_instruction	=	'".$backto_instruction."',
													p_phnum					=	'".$d_phnum3."',
													d_phnum					=	'".$p_phnum."',
													trip_miles				=	'".$milesDF."',
													pck_time 				= 	'".$ptime."',
													pck_ptime 				= 	'".$pck_ptime."',
													drp_time 				= 	'".$drp_time."',
													drp_ptime 				= 	'".$drp_ptime."',
													wc 						= 	'".$wc."',
													
													ccode					=	'".$_POST['tripnumber']."',
													trip_remarks			=	'".$comments."',
													passenger 				= 	'".$passenger."'";													
													//WHERE reqid ='".$id."' AND type = 'DF'";  $db->execute($Quptripsdetail2);										
				
			if($pre_triptype=='One Way' || $pre_triptype=='Round Trip' || $pre_triptype=='Three Way'){
			$Quptripsdetail2="INSERT INTO trip_details SET $Qrst, reqid ='".$id."', type = 'DF',trip_id = '".$trip_id."' ";	}else{												
			$Quptripsdetail2="UPDATE trip_details SET 	$Qrst	WHERE reqid ='".$id."' AND type = 'DF'"; 	}				
													$db->execute($Quptripsdetail2);	
				}
					
			if($triptype=='One Way'){
				$db->execute("DELETE FROM trip_details WHERE trip_id ='".$trip_id."' AND type IN ('BF','BC','CF','CD','DF')");}
		if($triptype=='Round Trip'){
				$db->execute("DELETE FROM trip_details WHERE trip_id ='".$trip_id."' AND type IN ('BC','CF','CD','DF')");}		
	    if($triptype=='Three Way'){
				$db->execute("DELETE FROM trip_details WHERE trip_id ='".$trip_id."' AND type IN ('BF','CD','DF')");}
		if($triptype=='Four Way'){
				$db->execute("DELETE FROM trip_details WHERE trip_id ='".$trip_id."' AND type IN ('BF','CF')");}		
							
			
			
			
			
			//$Qdel="DELETE FROM passengers WHERE request_id = '".$id."'"; $db->execute($Qdel);
			/*	if($picklocation){$Qploc="SELECT * FROM locations WHERE location='$picklocation'"; if($db->query($Qploc) && $db->get_num_rows()>0){}
				else{$Qpins="INSERT INTO locations SET location='$picklocation',address='$pickadd'"; $db->execute($Qpins);} }
				if($droplocation){$Qdloc="SELECT * FROM locations WHERE location='$droplocation'"; if($db->query($Qdloc) && $db->get_num_rows()>0){}
				else{$Qdins="INSERT INTO locations SET location='$droplocation',address='$destination_one'"; $db->execute($Qdins);}}*/
	echo '<script>alert("You have Successfully Updated the Request.");</script>';  		 
	echo '<script>location.href="mytrips.php";</script>';  exit;
         
		 
		 //Send email to site admin
			 include_once('emailme.php');
			 	 $html    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td colspan="2" align="left">
							Dear Admin,<br>
							One existing trip request is updated on '.$contactinfo['title'].' Portal. Trip detail is given below.
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
	 
	  @sendmail_to($html,$contactinfo['email'],'Trip Request Updated');
			 
			 //end email to site admin
		 
		 }
			 }
	$db->close();
	//print_r($tripdata);
	$smarty->assign("vehiclepref",$vehiclepref);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("post",$_POST);
	$smarty->assign("foot",$foot);
	$smarty->assign("id",$id);
	$smarty->assign("tripdata",$tripdata);
	$smarty->assign("offices",$offices);
	$smarty->assign("tripnumber",$tripnumber);
	$smarty->assign("itemstypes",$itemstypes);
	$smarty->assign("items",$items);
	$smarty->assign("pg",'triprequest');		
    $smarty->display('edittriprequest.tpl');	
?>