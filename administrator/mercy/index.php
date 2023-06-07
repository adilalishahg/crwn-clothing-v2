<?php
error_reporting(1);
ini_set("display_errors", "on");
include_once('../DBAccess/Database.inc.php');
include_once('../Classes/MyMailer.php');
include_once('../../Classes/mapquest_google_miles.class.php');
include_once('../milesfunction.php');
$mile_C = new mapquest_google_miles;
$db = new Database;
$msgs = '';
$noRec = '';
$msgs .= $_GET['msg'];
$db = new Database;
$mail = new MyMailer;
$db->connect();
$capped_miles = 0;
//GET VEHICLE PREFERRENCE
$Qaccounts  = "SELECT * FROM " .  accounts . " ORDER BY account_name ASC ";
if ($db->query($Qaccounts) && $db->get_num_rows() > 0) {
	$accounts = $db->fetch_all_assoc();
}
//GET ACCOUNTS
$qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES;
if ($db->query($qry_vehtype) && $db->get_num_rows() > 0) {
	$vehiclepref = $db->fetch_all_assoc();
}
//GET STATES LIST
$gstat = "SELECT * FROM " . TBL_STATES;
if ($db->query($gstat) && $db->get_num_rows() > 0) {
	$slist = $db->fetch_all_assoc();
}
//GET App types
$query = "SELECT * FROM " . TBL_CONTACT . "  WHERE c_id='1'";
if ($db->query($query) && $db->get_num_rows() > 0) {
	$udata = $db->fetch_all_assoc();
}
$unload_add = $udata[0]['address'] . "," . $udata[0]['state'] . "," . $udata[0]['city'] . "," . $udata[0]['zip']; //for all other 
if (isset($_POST['submit'])) { //print_r($_POST); exit;
	$account		=	$_POST['account'];

	$hostpital_id	=	$_POST['hostpital_id'];
	if ($hostpital_id == '') {
		$hostpital_id = $_POST['hostpital_id_drop'];
	}
	if ($hostpital_id == '') {
	}

	$hostpital_id = '16';



	$QueryA = "SELECT rate_type FROM accounts WHERE id='$account' ";
	if ($db->query($QueryA) && $db->get_num_rows() > 0) {
		$DetailsA = $db->fetch_one_assoc();
	}
	$rate_type    = $DetailsA['rate_type'];
	$post = $_POST;
	//$progtype 		= sql_replace($_POST['progtype']);
	$cisid 			= sql_replace($_POST['cisid']); 	//if(empty($cisid))$errors .= 'Identification Number is required!';
	$insurance_name	= str_replace('\'', '`', sql_replace($_POST['insurance_name']));
	$pname 			= str_replace('\'', '`', sql_replace($_POST['pname']));		//if(empty($pname))$errors .= 'Patient Name is required!';
	$phnum 			= sql_replace($_POST['phnum']);		//if(empty($phnum))$errors .= 'Patient Phone Number is required!';
	$po 			= sql_replace($_POST['po']);
	$patient_weight	= sql_replace($_POST['patient_weight']);
	$bar_stretcher	= sql_replace($_POST['bar_stretcher']);
	$dob 			= convertDateToMySQL($_POST['dob']);
	$todaydate 		= convertDateToMySQL($_POST['todaydate']);
	$apptype	 	= sql_replace($_POST['type']);
	$fname 			= sql_replace($_POST['fname']);
	$lname 			= sql_replace($_POST['lname']);
	$clinic 		= sql_replace($_POST['clinic']);
	$phyaddress 	= sql_replace($_POST['phyaddress']);
	$phycity 		= sql_replace($_POST['phycity']);
	$phystate 		= sql_replace($_POST['phystate']);
	$phyzip 		= sql_replace($_POST['phyzip']);
	$phyphone 		= sql_replace($_POST['phyphone']);
	$phyfax 		= sql_replace($_POST['phyfax']);
	$reason 		= sql_replace($_POST['reason']);
	$triptype 		= sql_replace($_POST['triptype']); 		//if(empty($triptype))$errors .= 'Trip type is required!';
	$vehtype 		= sql_replace($_POST['vehtype']);		//if(empty($vehtype))$errors .= 'Vehicle is required!';
	$casemanager1 	= sql_replace($_POST['casemanager1']); //if(empty($casemanager1))$errors .= 'Case Manager is required!';
	$appdate 		= convertDateToMySQL($_POST['appdate']);		//if(empty($appdate))$errors .= 'Appoimnet Date is required!';
	$org_apptime	= sql_replace($_POST['org_apptime']); //($_POST['org_apptime']);
	// $org_apptime	= convertinto24($_POST['org_apptime'],$_POST['org_apptimerad']);//($_POST['org_apptime']);
	$apptime 		= sql_replace($_POST['apptime']); //sql_replace($_POST['apptime']);
	// $apptime 		= convertinto24($_POST['apptime'],$_POST['apptimerad']);//sql_replace($_POST['apptime']);
	$puchoice 		= sql_replace($_POST['puchoice']);
	// $returnpickup 	= convertinto24($_POST['returnpickup'],$_POST['returnpickuprad']); //sql_replace($_POST['returnpickup']); //return pickup time
	$returnpickup 	= sql_replace($_POST['returnpickup']); //sql_replace($_POST['returnpickup']); //return pickup time
	if ($puchoice == 'Will Call') {
		$returnpickup = 'Will Call';
	}
	$driver 		= sql_replace($_POST['driver']);
	$sex			= sql_replace($_POST['sex']);
	$childseat		= sql_replace($_POST['childseat']);
	$escort			= sql_replace($_POST['escort']);
	$wchair			= sql_replace($_POST['wchair']);
	$dwchair		= sql_replace($_POST['dwchair']);
	$stretcher		= sql_replace($_POST['stretcher']);
	$dstretcher		= sql_replace($_POST['dstretcher']);
	$oxygen			= sql_replace($_POST['oxygen']);
	$status			= sql_replace($_POST['status']);
	$ftof			= sql_replace($_POST['ftof']);
	$b_accountname	= sql_replace($_POST['b_accountname']);
	$passenger		= sql_replace($_POST['passenger']);
	$cellalert		= sql_replace($_POST['cellalert']);
	$cellalertoption = sql_replace($_POST['cellalertoption']);
	$trigerfor		= sql_replace($_POST['trigerfor']);
	$Qfind = "SELECT * FROM patient WHERE phone='" . $phnum . "' AND LTRIM(LOWER(name)) = '" . strtolower(trim(sql_replace($pname))) . "' ";
	if ($db->query($Qfind) && $db->get_num_rows() > 0) {
	} else {
		$Qinsert = "INSERT INTO patient SET 
					name			=	'" . sql_replace($pname) . "',
					insurance_name	=	'" . sql_replace($insurance_name) . "',
					insurance		=	'$cisid',
					ssn				=	'$ssn',
					dob				=	'$dob',
					claim_no		=	'" . $_POST['claim_no'] . "',
					address			=	'" . str_replace(',', '', sql_replace($_POST['pickaddress'])) . "',
					city			=	'" . str_replace(',', '', sql_replace($_POST['pckcity'])) . "',
					state			=	'" . str_replace(',', '', sql_replace($_POST['pckstate'])) . "',
					zip				=	'" . str_replace(',', '', sql_replace($_POST['pckzip'])) . "',
					phone			=	'$phnum'
			";
		$db->execute($Qinsert);
	}
	/*$pickadd 			= str_replace(',','',sql_replace($_POST['pickaddress'])).', '.str_replace(',','',sql_replace($_POST['psuiteroom'])).', '.str_replace(',','',sql_replace($_POST['pckcity'])).', '.str_replace(',','',sql_replace($_POST['pckstate'])).', '.str_replace(',','',sql_replace($_POST['pckzip']));
	
	$destination_one= str_replace(',','',sql_replace($_POST['destination'])).', '.str_replace(',','',sql_replace($_POST['dsuiteroom'])).', '.str_replace(',','',sql_replace($_POST['drpcity'])).', '.str_replace(',','',sql_replace($_POST['drpstate'])).', '.str_replace(',','',sql_replace($_POST['drpzip'])); 
	
	$destination_two= str_replace(',','',sql_replace($_POST['three_address'])).', '.str_replace(',','',sql_replace($_POST['p3suiteroom'])).', '.str_replace(',','',sql_replace($_POST['three_city'])).', '.str_replace(',','',sql_replace($_POST['three_state'])).','.str_replace(',','',sql_replace($_POST['three_zip']));
	
	$destination_three= str_replace(',','',sql_replace($_POST['four_address'])).', '.str_replace(',','',sql_replace($_POST['p4suiteroom'])).', '.str_replace(',','',sql_replace($_POST['four_city'])).', '.str_replace(',','',sql_replace($_POST['four_state'])).', '.str_replace(',','',sql_replace($_POST['four_zip']));
	
	$destination_four= str_replace(',','',sql_replace($_POST['five_address'])).', '.str_replace(',','',sql_replace($_POST['p5suiteroom'])).', '.str_replace(',','',sql_replace($_POST['five_city'])).', '.str_replace(',','',sql_replace($_POST['five_state'])).', '.str_replace(',','',sql_replace($_POST['five_zip']));
	
	$destination_last= str_replace(',','',sql_replace($_POST['backto'])).', '.str_replace(',','',sql_replace($_POST['bsuiteroom'])).', '.str_replace(',','',sql_replace($_POST['backtocity'])).', '.str_replace(',','',sql_replace($_POST['backtostate'])).', '.str_replace(',','',sql_replace($_POST['backtozip']));*/

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

	$three_pickup = $_POST['three_pickup']; //sql_replace($_POST['three_pickup']);
	// $three_pickup = convertinto24($_POST['three_pickup'],$_POST['three_pickuprad']);//sql_replace($_POST['three_pickup']);
	$three_will_call = sql_replace($_POST['three_will_call']);
	$four_pickup = $_POST['four_pickup']; //sql_replace($_POST['four_pickup']);
	// $four_pickup = convertinto24($_POST['four_pickup'],$_POST['four_pickuprad']);//sql_replace($_POST['four_pickup']);
	$four_will_call = sql_replace($_POST['four_will_call']);
	$five_pickup = sql_replace($_POST['five_pickup']);
	$five_will_call = sql_replace($_POST['five_will_call']);
	$comments		= sql_replace($_POST['comments']);

	$pickup_instruction			= sql_replace($_POST['pickup_instruction']);
	$destination_instruction	= sql_replace($_POST['destination_instruction']);
	$destination_instruction2	= sql_replace($_POST['destination_instruction2']);
	$destination_instruction3	= sql_replace($_POST['destination_instruction3']);
	$backto_instruction			= sql_replace($_POST['backto_instruction']);
	$d_phnum					= sql_replace($_POST['d_phnum']);
	$d_phnum2					= sql_replace($_POST['d_phnum2']);
	$d_phnum3					= sql_replace($_POST['d_phnum3']);
	$p_phnum					= sql_replace($_POST['p_phnum']);

	/*$billing_address		= str_replace(',','',sql_replace($_POST['b_address'])).', '.str_replace(',','',sql_replace($_POST['b_city'])).', '.str_replace(',','',sql_replace($_POST['b_state'])).', '.str_replace(',','',sql_replace($_POST['b_zip']));*/


	//reoccurence trips information
	$day 				= sql_replace($_POST['day']);
	$reocc_appicktime 	= sql_replace($_POST['reocc_appicktime']);
	$reocc_repicktime 	= sql_replace($_POST['reocc_repicktime']);
	$till_date 			= convertDateToMySQL($_POST['till_date']);

	$q = "SELECT * FROM " . TBL_CONTACT;
	if ($db->query($q) && $db->get_num_rows() > 0) {
		$d = $db->fetch_all_assoc();
		$tos = $d[0]['email'];
		$unload_add = $d[0]['address'] . ", " . $d[0]['city'] . ", " . $d[0]['state'] . ", " . $d[0]['zip'];
		$corporat_latlong = $d[0]['corporat_latlong'];
		$capped_miles_limit = $d[0]['capped_miles'];
		$starttime	=	$d[0]['starttime'];
		$endtime	=	$d[0]['endtime'];
	}


	//Miles Calculation
	//Un loaded miles it will be added into system if a company allow them
	$unloadedmiles = getmiles(utf8_encode($pickadd), utf8_encode($unload_add), $db, $mile_C);
	//End of unloaded miles charges 
	if ($triptype == 'One Way') {
		$milesAB = getmiles(utf8_encode($pickadd), utf8_encode($destination_one), $db, $mile_C);
		$miles_string = $milesAB;
		$miles 		= $milesAB;
		$base = 1;
		//$c1 = $mile_C->getLatLong($pickadd); 	 $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		//$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$returnpickup='12:00';
	}
	$after_hours = 0;
	$ptime = mktime($apptime);
	$dtime = @mktime($returnpickup);
	$starttime = mktime($starttime);
	$endtime = mktime($endtime);
	if ($ptime < $starttime) {
		$p_after_hours = 1;
	} else {
		$p_after_hours = 0;
	}
	if ($dtime > $endtime) {
		$r_after_hours = 1;
	} else {
		$r_after_hours = 0;
	}
	if (($ptime < $starttime) || ($dtime > $endtime)) {
		$after_hours = 1;
	} else {
		$after_hours = 0;
	}
	if ($triptype == 'Round Trip') {
		$milesAB = getmiles(utf8_encode($pickadd), utf8_encode($destination_one), $db, $mile_C);
		$milesBF = getmiles(utf8_encode($destination_one), utf8_encode($destination_last), $db, $mile_C);
		$miles_string = $milesAB . ',' . $milesBF;
		$miles 		= $milesAB + $milesBF;
		$base = 1;
		//$c1 = $mile_C->getLatLong($pickadd); 	$dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;} 	
		//$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c6 = $mile_C->getLatLong($destination_last); $dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}		
	}
	if ($triptype == 'Three Way') {
		$milesAB = getmiles(utf8_encode($pickadd), utf8_encode($destination_one), $db, $mile_C);
		$milesBC = getmiles(utf8_encode($destination_one), utf8_encode($destination2), $db, $mile_C);
		$milesCF = getmiles(utf8_encode($destination2), utf8_encode($destination_last), $db, $mile_C);
		$miles_string = $milesAB . ',' . $milesBC . ',' . $milesCF;
		$miles 	  = $milesAB + $milesBC + $milesCF;
		$base = 2;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if ($three_will_call == 'on') {
			$three_pickup = 'Will Call';
		}
		//$c1 = $mile_C->getLatLong($pickadd); $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		//$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c3 = $mile_C->getLatLong($destination2); $dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c6 = $mile_C->getLatLong($destination_last); $dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}		
	}
	if ($triptype == 'Four Way') {
		$milesAB = getmiles(utf8_encode($pickadd), utf8_encode($destination_one), $db, $mile_C);
		$milesBC = getmiles(utf8_encode($destination_one), utf8_encode($destination2), $db, $mile_C);
		$milesCD = getmiles(utf8_encode($destination2), utf8_encode($destination3), $db, $mile_C);
		$milesDF = getmiles(utf8_encode($destination3), utf8_encode($destination_last), $db, $mile_C);
		$miles_string = $milesAB . ',' . $milesBC . ',' . $milesCD . ',' . $milesDF;
		$miles	= $milesAB + $milesBC + $milesCD + $milesDF;
		$base = 3;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if ($three_will_call == 'on') {
			$three_pickup = 'Will Call';
		}
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if ($four_will_call == 'on') {
			$four_pickup = 'Will Call';
		}
		//$c1 = $mile_C->getLatLong($pickadd); $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		//$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c3 = $mile_C->getLatLong($destination2); $dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c4 = $mile_C->getLatLong($destination3); $dis = $mile_C->distance_cord($corporat_latlong,$c4); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c6 = $mile_C->getLatLong($destination_last);	$dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}	
	}
	if ($triptype == 'Five Way') {
		$milesAB = round($mile_C->distance($pickadd, $destination_one), 2);
		$milesBC = round($mile_C->distance($destination_one, $destination2), 2);
		$milesCD = round($mile_C->distance($destination2, $destination3), 2);
		$milesDE = round($mile_C->distance($destination3, $destination4), 2);
		$milesEF = round($mile_C->distance($destination4, $destination_last), 2);
		$miles_string = $milesAB . ',' . $milesBC . ',' . $milesCD . ',' . $milesDE . ',' . $milesEF;
		$miles = $milesAB + $milesBC + $milesCD + $milesDE + $milesEF;
		$base = 4;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if ($three_will_call == 'on') {
			$three_pickup = 'Will Call';
		}
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if ($four_will_call == 'on') {
			$four_pickup = 'Will Call';
		}
		$five_pickup 	= sql_replace($_POST['five_pickup']);
		if ($five_will_call == 'on') {
			$five_pickup = 'Will Call';
		}
		//$c1 = $mile_C->getLatLong($pickadd); 			$dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c2 = $mile_C->getLatLong($destination_one); 	$dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c3 = $mile_C->getLatLong($destination2);  	$dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c4 = $mile_C->getLatLong($destination3); 	$dis = $mile_C->distance_cord($corporat_latlong,$c4); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c5 = $mile_C->getLatLong($destination4); 	$dis = $mile_C->distance_cord($corporat_latlong,$c5); if($dis > $capped_miles_limit){$capped_miles=1;}
		//$c6 = $mile_C->getLatLong($destination_last);	$dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}
	}
	if ($rate_type == 'custom') {
		$capped_miles = 0;
	}
	//End of miles calculation
	//Amount calculation
	$miles = ($miles);
	if (isset($vehtype) && $vehtype != '') {
		$contype = "SELECT * FROM " . TBL_VEHTYPES . " Where id='" . $vehtype . "'";
		if ($db->query($contype) && $db->get_num_rows() > 0) {
			$ttype = $db->fetch_all_assoc();
		}
		$totchargesamb = ($ttype[0]['bcharges'] * $base) + ($miles * $ttype[0]['mcharges']);
	}
	$totcharges = $totchargesamb;
	//end of amount calculation

	//INSERT INTO REQUEST TABLE	   
	$Query1  = "INSERT INTO " . TBL_REQUESTS . " SET 
					userid='" . $hostpital_id . "',
					hospname='" . $hosname . "',
					reqdate=NOW(),
					sessionn_id='" . session_id() . "',
					req_status='active'";
	if ($db->execute($Query1)) {
		$req_id = $db->insert_id();
	}
	if (isset($req_id) && $req_id > 0) {

		$pickaddX 			= explode(',', $pickadd, 2);
		if ($pickaddX[1]) {
			$pickadd =	$pickaddX[0] . ',' . str_replace(',', '', sql_replace($_POST['psuiteroom'])) . ',' . $pickaddX[1];
		}
		$destination_oneX 	= explode(',', $destination_one, 2);
		if ($destination_oneX[1]) {
			$destination_one =	$destination_oneX[0] . ',' . str_replace(',', '', sql_replace($_POST['dsuiteroom'])) . ',' . $destination_oneX[1];
		}
		$destination2X 	= explode(',', $destination2, 2);
		if ($destination2X[1]) {
			$destination2 =	$destination2X[0] . ',' . str_replace(',', '', sql_replace($_POST['dsuiteroom2'])) . ',' . $destination2X[1];
		}
		$destination3X 	= explode(',', $destination3, 2);
		if ($destination3X[1]) {
			$destination3 =	$destination3X[0] . ',' . str_replace(',', '', sql_replace($_POST['dsuiteroom3'])) . ',' . $destination3X[1];
		}

		$destination_lastX 	= explode(',', $destination_last, 2);
		if ($destination_lastX[1]) {
			$destination_last =	$destination_lastX[0] . ',' . str_replace(',', '', sql_replace($_POST['bsuiteroom'])) . ',' . $destination_lastX[1];
		}
		$Query2  = "INSERT INTO " . TBL_FORMS . " SET 
					account='" . $account . "',
					claim_no		=	'" . $_POST['claim_no'] . "',
					unloadedmilage='" . $unloadedmiles . "',
					miles_string = '" . $miles_string . "',
					milage='" . $miles . "',
					charges	= '" . $totcharges . "',
					triptype='" . $triptype . "',	
					vehtype='" . $vehtype . "',	
					appt_type='" . $apptype . "',					
					po='" . $po . "',
					patient_weight='" . $patient_weight . "',
					bar_stretcher='" . $bar_stretcher . "',
					req_id='" . $req_id . "',
					pickaddr='" . $pickadd . "',
					destination='" . $destination_one . "',
					three_address='" . $destination2 . "',
					four_address='" . $destination3 . "',
					five_address='" . $destination4 . "',
					three_pickup 	= '" . $three_pickup . "',
					four_pickup 	= '" . $four_pickup . "',
					five_pickup 	= '" . $five_pickup . "',
					backto='" . $destination_last . "',
					appdate='" . $appdate . "',
                    org_apptime='" . $org_apptime . "',
					apptime='" . $apptime . "',
					returnpickup='" . $returnpickup . "',
					casemanager='" . $casemanager1 . "',
					today_date=NOW(),
					clientname='" . $pname . "',
                    phnum='" . $phnum . "',
					dob='" . $dob . "',
					email='',
					clientcasemanager='" . $casemanager2 . "',
					cisid='" . $cisid . "',
					insurance_name='" . $insurance_name . "',
					driver='" . $driver . "',
					sex='" . $sex . "',
					childseat='" . $childseat . "',
					escort='" . $escort . "',
					wchair='" . $wchair . "',
					dwchair='" . $dwchair . "',
					stretcher='" . $stretcher . "',
					dstretcher='" . $dstretcher . "',
					oxygen='" . $oxygen . "',
					ftof='" . $ftof . "',
					status='" . $status . "',
					b_accountname='" . $b_accountname . "',
					pickup_instruction='" . $pickup_instruction . "',
					destination_instruction='" . $destination_instruction . "',
					destination_instruction2='" . $destination_instruction2 . "',
					destination_instruction3='" . $destination_instruction3 . "',
					backto_instruction='" . $backto_instruction . "',
					d_phnum='" . $d_phnum . "',
					d_phnum2='" . $d_phnum2 . "',
					d_phnum3='" . $d_phnum3 . "',
					p_phnum='" . $p_phnum . "',
					billing_address='" . $billing_address . "',
					c1='" . $c1 . "',
					c2='" . $c2 . "',
					c3='" . $c3 . "',
					c4='" . $c4 . "',
					c5='" . $c5 . "',
					c6='" . $c6 . "',
					picklocation	='" . $picklocation . "',
					droplocation	='" . $droplocation . "',
					droplocation2	='" . $droplocation2 . "',
					droplocation3	='" . $droplocation3 . "',
					backtolocation	='" . $backtolocation . "',
					capped_miles	='" . $capped_miles . "',
					after_hours 	='" . $after_hours . "',
					p_after_hours 	='" . $p_after_hours . "',
					r_after_hours 	='" . $r_after_hours . "',
					passenger		='" . $_POST['passenger'] . "',
					
					unloaded_miles_a		='" . $_POST['unloaded_miles_a'] . "',
					unloaded_miles_b		='" . $_POST['unloaded_miles_b'] . "',
					unloaded_miles_c		='" . $_POST['unloaded_miles_c'] . "',
					unloaded_miles_d		='" . $_POST['unloaded_miles_d'] . "',
					
					cellalert 		='" . $cellalert . "',
					cellalertoption ='" . $cellalertoption . "',
					trigerfor 		='" . $trigerfor . "',
					comments		='" . $comments . "'";
		if ($db->execute($Query2)) {
			$last_id  = $db->insert_id();
			$for_ind = $last_id;
			$rec_count = 0;
			if ($picklocation) {
				$Qploc = "SELECT * FROM locations WHERE location='$picklocation'";
				if ($db->query($Qploc) && $db->get_num_rows() > 0) {
				} else {
					$Qpins = "INSERT INTO locations SET location='$picklocation',address='$pickadd'";
					$db->execute($Qpins);
				}
			}
			if ($droplocation) {
				$Qdloc = "SELECT * FROM locations WHERE location='$droplocation'";
				if ($db->query($Qdloc) && $db->get_num_rows() > 0) {
				} else {
					$Qdins = "INSERT INTO locations SET location='$droplocation',address='$destination_one'";
					$db->execute($Qdins);
				}
			}
			$SQ = "droplocation2='" . $droplocation2 . "',
					droplocation3='" . $droplocation3 . "',
					d_phnum2='" . $d_phnum2 . "',
					d_phnum3='" . $d_phnum3 . "',
					destination_instruction2='" . $destination_instruction2 . "',
					destination_instruction3='" . $destination_instruction3 . "',
					three_address='" . $destination2 . "',
					four_address	='" . $destination3 . "',
					five_address	='" . $destination4 . "',
					cellalert 		='" . $cellalert . "',
					cellalertoption ='" . $cellalertoption . "',
					trigerfor		='" . $trigerfor . "',					
					passenger		='" . $_POST['passenger'] . "',
					unloaded_miles_a		='" . $_POST['unloaded_miles_a'] . "',
					unloaded_miles_b		='" . $_POST['unloaded_miles_b'] . "',
					unloaded_miles_c		='" . $_POST['unloaded_miles_c'] . "',
					unloaded_miles_d		='" . $_POST['unloaded_miles_d'] . "',
					claim_no		=	'" . $_POST['claim_no'] . "' ";
			//reoccurence trips
			//Start For Monday
			if (($_POST['monday'] == 'on') && (!empty($_POST['tdmonday'])) && (!empty($_POST['aptmonday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['mon']);
				$till_date 		= convertDateToMySQL($_POST['tdmonday']);
				$apptimeR 		= convertinto24($_POST['aptmonday'], $_POST['aptmondayrad']); //sql_replace($_POST['aptmonday']); 
				$returnpickupR 	= convertinto24($_POST['retmonday'], $_POST['retmondayrad']); //sql_replace($_POST['retmonday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for Monday
			//Start For tuseday
			if (($_POST['tuseday'] == 'on') && (!empty($_POST['tdtuseday'])) && (!empty($_POST['apttuseday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['tus']);
				$till_date 		= convertDateToMySQL($_POST['tdtuseday']);
				$apptimeR 		= convertinto24($_POST['apttuseday'], $_POST['apttusedayrad']); // sql_replace($_POST['apttuseday']); 
				$returnpickupR 	= convertinto24($_POST['rettuseday'], $_POST['rettusedayrad']); // sql_replace($_POST['rettuseday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for tuseday
			//Start For wednesday
			if (($_POST['wednesday'] == 'on') && (!empty($_POST['tdwednesday'])) && (!empty($_POST['aptwednesday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['wed']);
				$till_date 		= convertDateToMySQL($_POST['tdwednesday']);
				$apptimeR 		= convertinto24($_POST['aptwednesday'], $_POST['aptwednesdayrad']); // sql_replace($_POST['aptwednesday']); 
				$returnpickupR 	= convertinto24($_POST['retwednesday'], $_POST['retwednesdayrad']); // sql_replace($_POST['retwednesday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for wednesday
			//Start For thursday
			if (($_POST['thirsday'] == 'on') && (!empty($_POST['tdthirsday'])) && (!empty($_POST['aptthirsday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['thi']);
				$till_date 		= convertDateToMySQL($_POST['tdthirsday']);
				$apptimeR 		= convertinto24($_POST['aptthirsday'], $_POST['aptthirsdayrad']); // sql_replace($_POST['aptthirsday']); 
				$returnpickupR 	= convertinto24($_POST['retthirsday'], $_POST['retthirsdayrad']); // sql_replace($_POST['retthirsday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for thursday
			//Start For friday
			if (($_POST['friday'] == 'on') && (!empty($_POST['tdfriday'])) && (!empty($_POST['aptfriday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['fri']);
				$till_date 		= sql_replace($_POST['tdfriday']);
				$apptimeR 		= convertinto24($_POST['aptfriday'], $_POST['aptfridayrad']); // sql_replace($_POST['aptfriday']); 
				$returnpickupR 	= convertinto24($_POST['retfriday'], $_POST['retfridayrad']); // sql_replace($_POST['retfriday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for friday
			//Start For saturday
			if (($_POST['saturday'] == 'on') && (!empty($_POST['tdsaturday'])) && (!empty($_POST['aptsaturday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['sat']);
				$till_date 		= convertDateToMySQL($_POST['tdsaturday']);
				$apptimeR 		= convertinto24($_POST['aptsaturday'], $_POST['aptsaturdayrad']); // sql_replace($_POST['aptsaturday']); 
				$returnpickupR 	= convertinto24($_POST['retsaturday'], $_POST['retsaturdayrad']); // sql_replace($_POST['retsaturday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for sunday
			if (($_POST['sunday'] == 'on') && (!empty($_POST['tdsunday'])) && (!empty($_POST['aptsunday']))) {
				$rec_count = 1;
				$day 			= sql_replace($_POST['sun']);
				$till_date 		= convertDateToMySQL($_POST['tdsunday']);
				$apptimeR 		= convertinto24($_POST['aptsunday'], $_POST['aptsundayrad']); // sql_replace($_POST['aptsunday']); 
				$returnpickupR 	= convertinto24($_POST['retsunday'], $_POST['retsundayrad']); // sql_replace($_POST['retsunday']); //print_r($_POST); exit;
				//INSERTING REOCCURING TRIPS
				rectrips($day, $till_date, $apptimeR, $returnpickupR, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ);
			} //End for sunday			 
			//END OF REOCCURING TRIPS
			if ($rec_count == 0) {
				$query = "UPDATE " . TBL_FORMS . " SET  rec_ind = 'ind' WHERE id = '" . $for_ind . "'";
				$db->query($query);
			}
			/*		$form_id = $db->insert_id(); 
	         }	   
	   //END
              $q = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($q) && $db->get_num_rows() > 0)
	{
	   $d = $db->fetch_all_assoc();
	$tos           = $d[0]['email'];
	}*/
			/*$from = 'requests@xcv.com';
			   $email = $tos;
			   $subject = 'New '.$totRequests.' Trip Request';
			   $body = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td width="63%"><a href="http://www.xcv.com"><img src="http://www.xcv.com/images/logo.png" border="0" /></a></td>
							<td width="37%"><strong>
						<font color="#000000" size="1px" >xcv TRANSPORTATION 4040 E,<br />
        Mc DOWELL ROAD, SUITE# 102, <br />
        PHOENIX, AZ, 85008 <br />
        TEL:(602)273-7000</font></strong></td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							Dear Admin,<br>
				A new Request is submitted by Mercy Care Clinic.<br/>
							<a href="http://www.xcv.com/administrator/requests/reqdetails.php?req='.$_SESSION['userid'].'"> Click here</a> to further process the requests.
							</td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							 <b>Thank you! <br> xcv Team!</b>
							</td>
						  </tr>
						</table>';*/
			// $sent = mail($email,$subject,$body,$headers);	
			//$sent = $mail->HtmlTxtMail($email,$from,$subject,$body);
			$sent = 1;
			if (1) {
				$msg = ' You have Successfully Submitted the Request.';
			}
		}
	}
}
//functions to insert data of reoccurence trips
function numWeekdays($start_ts, $end_ts, $day, $include_start_end = false)
{  //Count the number of days with dates.    
	$day = strtolower($day);
	$current_ts = $start_ts;
	// loop next $day until timestamp past $end_ts    
	while ($current_ts < $end_ts) {
		if (($current_ts = strtotime('next ' . $day, $current_ts)) < $end_ts) {
			$dt = date('Y-m-d', $current_ts);
			$days++;
		}
	}
	// include start/end days    
	if ($include_start_end) {
		if (strtolower(date('l', $start_ts)) == $day) {
			$days++;
		}
		if (strtolower(date('l', $end_ts)) == $day) {
			$days++;
		}
	}
	return (int)$days;
} //END OF Count the number of days with dates.		
function Weekdays($start_ts, $end_ts, $day, $include_start_end = true)
{
	$day = strtolower($day);
	$current_ts = $start_ts;
	// loop next $day until timestamp past $end_ts  
	$i = 0;
	while ($current_ts < $end_ts) {
		if (($current_ts = strtotime('next ' . $day, $current_ts)) < $end_ts) {
			$dt[$i] = date('Y-m-d', $current_ts);
			$days++;
			$i++;
		}
	}      // include start/end days    
	if ($include_start_end) {
		if (strtolower(date('l', $start_ts)) == $day) {
			$dt[$i] = date('Y-m-d', $current_ts);
			$days++;
		}
		if (strtolower(date('l', $end_ts)) == $day) {
			$dt[$i] = date('Y-m-d', $current_ts);
			$days++;
		}
	}
	return $dt;
}  //END OF FUNCTION NUMBER OF DAYS	
function rectrips($day, $till_date, $apptime, $returnpickup, $account, $unloadedmiles, $miles_string, $miles, $totcharges, $triptype, $vehtype, $ssn, $req_id, $pickadd, $destination_one, $destination_two, $destination_three, $destination_four, $three_pickup, $four_pickup, $five_pickup, $destination_last, $appdate, $casemanager1, $pname, $dob, $casemanager2, $cisid, $driver, $sex, $childseat, $escort, $wchair, $stretcher, $dstretcher, $oxygen, $comments, $status, $apptype, $insurance_name, $org_apptime, $phnum, $pickup_instruction, $billing_address, $po, $patient_weight, $bar_stretcher, $c1, $c2, $c3, $c4, $c5, $c6, $capped_miles, $after_hours, $p_after_hours, $r_after_hours, $dwchair, $b_accountname, $destination_instruction, $backto_instruction, $picklocation, $droplocation, $backtolocation, $d_phnum, $SQ)
{ //START of Reoccur Trips

	$dbus = new Database;
	$dbus->connect();
	$q = "SELECT * FROM " . TBL_CONTACT;
	if ($dbus->query($q) && $dbus->get_num_rows() > 0) {
		$d = $dbus->fetch_all_assoc();
		$starttime	=	$d[0]['starttime'];
		$endtime	=	$d[0]['endtime'];
	}
	$after_hours = 0;
	$ptime = mktime($apptime);
	$dtime = mktime($returnpickup);
	$starttime = mktime($starttime);
	$endtime = mktime($endtime);
	if ($ptime < $starttime) {
		$p_after_hours = 1;
	} else {
		$p_after_hours = 0;
	}
	if ($dtime > $endtime) {
		$r_after_hours = 1;
	} else {
		$r_after_hours = 0;
	}
	if (($ptime < $starttime) || ($dtime > $endtime)) {
		$after_hours = 1;
	}


	$gday =  $day;
	$start = strtotime($appdate);
	if ($till_date != '') {
		$dat = $till_date;
		$end = strtotime(date("Y-m-d", strtotime($dat)) . " +1 day");
		//$end = strtotime($dat);  
	}
	$num = numWeekDays($start, $end, $day, false);
	$dts = Weekdays($start, $end, $day, true);
	for ($i = 0; $i < $num; $i++) {
		$dt = $dts[$i];
		//INSERT INTO FORM TABLE
		$QueryQ  = "INSERT INTO " . TBL_FORMS . " SET 
					account='" . $account . "',$SQ,
					unloadedmilage='" . $unloadedmiles . "',
					miles_string = '" . $miles_string . "',
					milage='" . $miles . "',
					charges	= '" . $totcharges . "',	
					triptype='" . $triptype . "',	
					vehtype='" . $vehtype . "',	
					appt_type='" . $apptype . "',					
					po='" . $po . "',
					patient_weight='" . $patient_weight . "',
					bar_stretcher='" . $bar_stretcher . "',					
					req_id='" . $req_id . "',
					pickaddr='" . $pickadd . "',
					destination='" . $destination_one . "',
					three_pickup 	= '" . $three_pickup . "',
					four_pickup 	= '" . $four_pickup . "',
					five_pickup 	= '" . $five_pickup . "',
					backto='" . $destination_last . "',
					appdate='" . $dt . "',
					org_apptime='" . $org_apptime . "',
                    apptime='" . $apptime . "',
					returnpickup='" . $returnpickup . "',
					casemanager='" . $casemanager1 . "',
					today_date=NOW(),
					clientname='" . $pname . "',
                    phnum='" . $phnum . "',
					dob='" . $dob . "',
					email='',
					clientcasemanager='" . $casemanager2 . "',
					cisid='" . $cisid . "',
					insurance_name='" . $insurance_name . "',
					driver='" . $driver . "',
					sex='" . $sex . "',
					childseat='" . $childseat . "',
					escort='" . $escort . "',
					wchair='" . $wchair . "',
					dwchair='" . $dwchair . "',
					stretcher='" . $stretcher . "',
					dstretcher='" . $dstretcher . "',
					oxygen='" . $oxygen . "',
					status='" . $status . "',
					b_accountname='" . $b_accountname . "',
					pickup_instruction='" . $pickup_instruction . "',
					destination_instruction='" . $destination_instruction . "',
					backto_instruction='" . $backto_instruction . "',
					d_phnum='" . $d_phnum . "',
					billing_address='" . $billing_address . "',
					c1='" . $c1 . "',
					c2='" . $c2 . "',
					c3='" . $c3 . "',
					c4='" . $c4 . "',
					c5='" . $c5 . "',
					c6='" . $c6 . "',
					picklocation='" . $picklocation . "',
					droplocation='" . $droplocation . "',
					backtolocation='" . $backtolocation . "',
					capped_miles='" . $capped_miles . "',
					after_hours ='" . $after_hours . "',
					p_after_hours ='" . $p_after_hours . "',
					r_after_hours ='" . $r_after_hours . "',
					comments='" . $comments . "'";
		$dbus->execute($QueryQ);
	}
} //END OF Inserting Reoccur  Trips
$db->close();
$pgTitle = "Admin Panel -- Request";
$smarty->assign("pgTitle", $pgTitle);
$smarty->assign("msgs", $msg);
$smarty->assign("vehiclepref", $vehiclepref);
$smarty->assign("errors", $error);
$smarty->assign("hospitals", $hospitals);
$smarty->assign("foot", $foot);
$smarty->assign("post", $post);
$smarty->assign("states", $slist);
$smarty->assign("appdata", $appdata);
$smarty->assign("unloadaddr", $unloadaddr);
$smarty->assign("triptype", $triptype);
$smarty->assign("accounts", $accounts);
$smarty->display('mercytpl/add.tpl');
