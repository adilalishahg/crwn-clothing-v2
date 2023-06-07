<?php
include_once('../DBAccess/Database.inc.php');
include_once('../Classes/MyMailer.php');
include_once('../../Classes/mapquest_google_miles.class.php');
include_once('../milesfunction.php');
$mile_C = new mapquest_google_miles;
$db = new Database;
$db2 = new Database;
$mail = new MyMailer;
$msgs   = '';
$errors = '';
$db->connect();
$db2->connect();
$capped_miles = 0;
function minutes($totmiles)
{
	switch ($totmiles) {
		case ($totmiles <= 10):
			$min = 20;
			break;
		case ($totmiles <= 15):
			$min = 30;
			break;
		case ($totmiles <= 20):
			$min = 40;
			break;
		case ($totmiles <= 25):
			$min = 45;
			break;
		case ($totmiles <= 30):
			$min = 50;
			break;
		case ($totmiles <= 35):
			$min = 55;
			break;
		case ($totmiles <= 40):
			$min = 60;
			break;
		case ($totmiles <= 45):
			$min = 65;
			break;
		case ($totmiles <= 50):
			$min = 70;
			break;
		case ($totmiles > 50):
			$min = 120;
			break;
		default:
			$min = 0;
			break;
	}
	$min = round($totmiles * 1.5);
	return $min;
}
///GET VEHICLE PREFERRENCE
$qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES;
if ($db->query($qry_vehtype) && $db->get_num_rows() > 0) {
	$vehiclepref = $db->fetch_all_assoc();
}
//GET STATES LIST
$gstat = "SELECT * FROM " . TBL_STATES;
if ($db->query($gstat) && $db->get_num_rows() > 0) {
	$slist = $db->fetch_all_assoc();
}
// Get edit ids
$req_id = $_GET['reqid'];
$id = $_GET['id'];
$req = $_GET['req'];
if ($_GET['id'] != '') {
	
	
	
	$Query1 = "SELECT * FROM " . TBL_FORMS . " WHERE `id`='" . $_GET['id'] . "'  ";
	if ($db->query($Query1) && $db->get_num_rows() > 0) {
		$RequestDetail = $db->fetch_all_assoc();
	}
	
	// Modiv Start
	    $Qsltripid_modiv="SELECT modiv_id,status FROM trip_details WHERE reqid ='".$id."'";
		if($db->query($Qsltripid_modiv) && $db->get_num_rows() > 0)
	    {
	      $trip_detail_modiv = $db->fetch_one_assoc(); 

	      	if ($trip_detail_modiv['modiv_id']!='' /*&& ($trip_detail_modiv['status']==3 || $trip_detail_modiv['status']==4 || $trip_detail_modiv['status']==6 || $trip_detail_modiv['status']==12)*/) {
				echo "<script> alert('You can not update ModiVCare ride.');window.close(); </script>"; exit;	    	
			}
	    }
		// Modiv End
	// print_r($RequestDetail[0]['apptime']);exit;
	$tripdata = $RequestDetail;
	$data = $tripdata;
	$pickaddress   = $RequestDetail[0]['pickaddr'];
	$vehtype       = $RequestDetail[0]['vehtype'];
	$destination   = $RequestDetail[0]['destination'];
	$backto        = $RequestDetail[0]['backto'];
	$appdate1      = $RequestDetail[0]['appdate'];
	$apptime       = $RequestDetail[0]['apptime'];
	$returnpickup  = $RequestDetail[0]['returnpickup'];
	$casemanager1  = $RequestDetail[0]['casemanager'];
	$todaydate     = $RequestDetail[0]['today_date'];
	$pname         = $RequestDetail[0]['clientname'];
	$phnum         = $RequestDetail[0]['phnum'];
	$d_phnum         = $RequestDetail[0]['d_phnum'];
	$diagnosis         = $RequestDetail[0]['diagnosis'];
	$procedure         = $RequestDetail[0]['procedure1'];
	$authnum         = $RequestDetail[0]['authnum'];
	$policynum         = $RequestDetail[0]['policynum'];
	$apptid         = $RequestDetail[0]['apptid'];
	$wcs         = $RequestDetail[0]['totchargeswcs'];
	$sts         = $RequestDetail[0]['totchargessts'];
	$stp         = $RequestDetail[0]['totchargesstp'];
	$oxy         = $RequestDetail[0]['totchargesoxy'];
	$wcr         = $RequestDetail[0]['totchargeswcr'];
	$dob1          = $RequestDetail[0]['dob'];
	$dob          = $RequestDetail[0]['dob'];
	$cisid         = $RequestDetail[0]['cisid'];
	$ssn           = $RequestDetail[0]['ssn'];
	$doa           = $RequestDetail[0]['doa'];
	$claim           = $RequestDetail[0]['claim'];
	$casemanager2  = $RequestDetail[0]['clientcasemanager'];
	$comments      = $RequestDetail[0]['comments'];
	$reqstatus      = $RequestDetail[0]['reqstatus'];
	$adminComments  = $RequestDetail[0]['adminComments'];
	$patient_id = $RequestDetail[0]['patient_id'];
	$progtype      = $RequestDetail[0]['prog'];
	$status      = $RequestDetail[0]['status'];
	$prgQuery = "SELECT * FROM  " . TBL_PROGRAM . " WHERE prgid = '" . $progtype . "'";
	if ($db->query($prgQuery) && $db->get_num_rows() > 0) {
		$prgstypes = $db->fetch_all_assoc();
	}
	$prgstitle = $prgstypes[0]['prgtitle'];
	$prgsassoctitle = $prgstypes[0]['prgassoctitle'];
	$triptype =  $RequestDetail[0]['triptype'];
	$paddr = explode(',', $pickaddress, 3);
	$daddr = explode(',', $destination, 3);
	$backaddr = explode(',', $backto, 3);
	$bck = $backaddr[0] . ',' . $backaddr[2];
	$bsuiteroom = $backaddr[1];

	$pckaddr = $paddr[0] . ',' . $paddr[2];
	$psuiteroom = $paddr[1];

	$drpaddr = $daddr[0] . ',' . $daddr[2];
	$dsuiteroom = $daddr[1];

	// New data extracting from db
	$roomapt				=  $RequestDetail[0]['roomapt'];
	$destination_place		=  $RequestDetail[0]['destination_place'];
	$destination_place3	=  $RequestDetail[0]['destination_place3'];
	$destination_place4	=  $RequestDetail[0]['destination_place4'];
	$destination_place5	=  $RequestDetail[0]['destination_place5'];
	$stebldg				=  $RequestDetail[0]['stebldg'];
	$stebldg3				=  $RequestDetail[0]['stebldg3'];
	$stebldg4				=  $RequestDetail[0]['stebldg4'];
	$stebldg5				=  $RequestDetail[0]['stebldg5'];
	$destination2   		= $RequestDetail[0]['three_address'];
	$destination3   		= $RequestDetail[0]['four_address'];

	$daddr2 = explode(',', $destination2, 3);
	$destination2 = $daddr2[0] . ',' . $daddr2[2];
	$dsuiteroom2 = $daddr2[1];
	$daddr3 = explode(',', $destination3, 3);
	$destination3 = $daddr3[0] . ',' . $daddr3[2];
	$dsuiteroom3 = $daddr3[1];

	$three_pickup = $RequestDetail[0]['three_pickup'];
	if ($three_pickup == '00:00:00') {
		$three_pickup = '';
		$three_will_call = 'on';
	}

	$four_pickup = $RequestDetail[0]['four_pickup'];
	if ($four_pickup == '00:00:00') {
		$four_pickup = '';
		$four_will_call = 'on';
	}


	$five_pickup = $RequestDetail[0]['five_pickup'];
	if ($five_pickup == '00:00:00') {
		$five_pickup = '';
		$five_will_call = 'on';
	}

	$miles_string = $RequestDetail[0]['miles_string'];
	//End of new data from db
	if ($returnpickup == 'Will Call' || $returnpickup == '00:00:00' || $returnpickup == '00:00') {
		$puchoice = 'Will Call';
	} else {
		$puchoice = 'Time';
	}
}
// Update request
if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {

	// print_r($_POST); exit;
	$date = $_REQUEST['date'];
	$req = $POST['req'];
	$id = $_POST['id'];
	$reqid = $_POST['reqid'];


	$cisid 			= sql_replace($_POST['cisid']); 	//if(empty($cisid))$errors .= 'Identification Number is required!';
	$pname 			= sql_replace(str_replace('\'', '`', $_POST['pname']));		//if(empty($pname))$errors .= 'Patient Name is required!';
	$phnum 			= sql_replace($_POST['phnum']);		//if(empty($phnum))$errors .= 'Patient Phone Number is required!';
	$po 			= sql_replace($_POST['po']);
	$patient_weight	= sql_replace($_POST['patient_weight']);
	$bar_stretcher	= sql_replace($_POST['bar_stretcher']);
	$pickup_instruction	= sql_replace($_POST['pickup_instruction']);
	$destination_instruction	= sql_replace($_POST['destination_instruction']);
	$destination_instruction2	= sql_replace($_POST['destination_instruction2']);
	$destination_instruction3	= sql_replace($_POST['destination_instruction3']);
	$backto_instruction			= sql_replace($_POST['backto_instruction']);
	$d_phnum					= sql_replace($_POST['d_phnum']);
	$d_phnum2					= sql_replace($_POST['d_phnum2']);
	$d_phnum3					= sql_replace($_POST['d_phnum3']);
	$p_phnum					= sql_replace($_POST['p_phnum']);
	$dob 						= convertDateToMySQL($_POST['dob']);
	$pre_triptype				= sql_replace($_POST['pre_triptype']);

	$triptype 		= sql_replace($_POST['triptype']); 		//if(empty($triptype))$errors .= 'Trip type is required!';
	$vehtype 		= sql_replace($_POST['vehtype']);		//if(empty($vehtype))$errors .= 'Vehicle is required!';
	$casemanager1 	= sql_replace($_POST['casemanager1']); //if(empty($casemanager1))$errors .= 'Case Manager is required!';
	$appdate 		= convertDateToMySQL($_POST['appdate']);		//if(empty($appdate))$errors .= 'Appoimnet Date is required!';
	$apptime 		= sql_replace($_POST['apptime']); //($_POST['apptime']);
	$org_apptime 		= sql_replace($_POST['org_apptime']);
	$puchoice 		= sql_replace($_POST['puchoice']);

	$returnpickup 	= sql_replace($_POST['returnpickup']); //($_POST['returnpickup']); //return pickup time
	if ($puchoice == 'Will Call') {
		$returnpickup = 'Will Call';
	}

	$wchair			= sql_replace($_POST['wchair']);
	$dwchair		= sql_replace($_POST['dwchair']);
	$stretcher		= sql_replace($_POST['stretcher']);
	$dstretcher		= sql_replace($_POST['dstretcher']);
	$oxygen			= sql_replace($_POST['oxygen']);
	$appt_type		= sql_replace($_POST['appt_type']);
	$insurance_name	= sql_replace($_POST['insurance_name']);

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

	/**/
	$three_pickup = sql_replace($_POST['three_pickup']);
	$three_will_call = sql_replace($_POST['three_will_call']);
	$four_pickup = sql_replace($_POST['four_pickup']);
	$four_will_call = sql_replace($_POST['four_will_call']);
	$five_pickup = sql_replace($_POST['five_pickup']);
	$five_will_call = sql_replace($_POST['five_will_call']);
	$comments		= sql_replace($_POST['comments']);
	$reqstatus     = sql_replace($_POST['reqstatus']);
	$passenger		= sql_replace($_POST['passenger']);
	$cellalert		= sql_replace($_POST['cellalert']);
	$cellalertoption = sql_replace($_POST['cellalertoption']);
	$trigerfor = sql_replace($_POST['trigerfor']);
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
	$after_hours = 0;
	//$ptime = mktime($apptime);
	//$dtime = mktime($returnpickup);
	//$starttime = mktime($starttime);
	//$endtime = mktime($endtime);
	//if(($ptime < $starttime) || ($dtime > $endtime)){	$after_hours = 1;	}

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
		$three_pickup 	= sql_replace($_POST['three_pickup']); //($_POST['three_pickup']);
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
		$three_pickup 	= sql_replace($_POST['three_pickup']); //($_POST['three_pickup']);
		if ($three_will_call == 'on') {
			$three_pickup = 'Will Call';
		}
		$four_pickup 	= sql_replace($_POST['four_pickup']); //($_POST['four_pickup']);
		if ($four_will_call == 'on') {
			$four_pickup = 'Will Call';
		}
		//$c1 = $mile_C->getLatLong($pickadd); $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		//$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c3 = $mile_C->getLatLong($destination2); $dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//$c4 = $mile_C->getLatLong($destination3); $dis = $mile_C->distance_cord($corporat_latlong,$c4); if($dis > $capped_miles_limit){$capped_miles=1;}	
		//	$c6 = $mile_C->getLatLong($destination_last);	$dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}	
	}

	if ($rate_type == 'custom') {
		$capped_miles = 0;
	}
	//End of miles calculation
	//Amount calculation
	$miles = ($miles + $unloadedmiles);

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
	//$totcharges = $_POST['charges'];charges	= '".$totcharges."',
	$Query2  = "UPDATE " . TBL_FORMS . " SET
  					account			=	'" . sql_replace($_POST['account']) . "',
					claim_no		=	'" . $_POST['claim_no'] . "',
					unloadedmilage='" . $unloadedmiles . "',
					rec_ind = 'ind',
					miles_string = '" . $miles_string . "',
					milage='" . $miles . "',
					vehtype='" . $vehtype . "',	
					triptype='" . $triptype . "',	
					invoice_gen='0',									
					po='" . $po . "',
					patient_weight='" . $patient_weight . "',
					bar_stretcher='" . $bar_stretcher . "',
					pickup_instruction='" . $pickup_instruction . "',
					destination_instruction='" . $destination_instruction . "',
					destination_instruction2='" . $destination_instruction2 . "',
					destination_instruction3='" . $destination_instruction3 . "',
					backto_instruction='" . $backto_instruction . "',
					d_phnum='" . $d_phnum . "',
					d_phnum2='" . $d_phnum2 . "',
					d_phnum3='" . $d_phnum3 . "',
					p_phnum='" . $p_phnum . "',
					pickaddr='" . $pickadd . "',
					destination='" . $destination_one . "',

					three_address='" . $destination2 . "',
					four_address='" . $destination3 . "',
					five_address='" . $destination4 . "',
					backto='" . $destination_last . "',
					appdate='" . $appdate . "',
                    apptime='" . $apptime . "',
					org_apptime='" . $org_apptime . "',
					three_pickup 	= '" . $three_pickup . "',
					four_pickup 	= '" . $four_pickup . "',
					five_pickup 	= '" . $five_pickup . "',
					returnpickup='" . $returnpickup . "',
					clientname='" . $pname . "',
                    phnum='" . $phnum . "',
					dob='" . $dob . "',
					wchair='" . $wchair . "',
					dwchair='" . $dwchair . "',
					stretcher='" . $stretcher . "',
					oxygen='" . $oxygen . "',
					dstretcher='" . $dstretcher . "',
					c1='" . $c1 . "',
					c2='" . $c2 . "',
					c3='" . $c3 . "',
					c4='" . $c4 . "',
					c5='" . $c5 . "',
					c6='" . $c6 . "',
					picklocation='" . $picklocation . "',
					droplocation='" . $droplocation . "',
					droplocation2='" . $droplocation2 . "',
					droplocation3='" . $droplocation3 . "',
					backtolocation='" . $backtolocation . "',
					after_hours ='" . $after_hours . "',
					passenger				='" . $_POST['passenger'] . "',
					unloaded_miles_a		='" . $_POST['unloaded_miles_a'] . "',
					unloaded_miles_b		='" . $_POST['unloaded_miles_b'] . "',
					unloaded_miles_c		='" . $_POST['unloaded_miles_c'] . "',
					unloaded_miles_d		='" . $_POST['unloaded_miles_d'] . "',
					cellalert 		='" . $cellalert . "',
					cellalertoption ='" . $cellalertoption . "',
					trigerfor ='" . $trigerfor . "',
					comments='" . $comments . "' WHERE  id='" . $id . "'";
	if ($db->execute($Query2)) {
		$Quptrips = "UPDATE trips	SET trip_user	=	'" . $pname . "',
										trip_tel	=	'" . $phnum . "',
										trip_date	=	'" . $appdate . "',
										account		=	'" . sql_replace($_POST['account']) . "' WHERE reqid ='" . $id . "'";
		$db->execute($Quptrips);

		$QPup = "UPDATE patient SET 
					insurance_name	=	'" . sql_replace($insurance_name) . "',
					insurance		=	'$cisid',
					ssn				=	'$ssn',
					dob				=	'$dob',
					claim_no		=	'" . $_POST['claim_no'] . "',
					address			=	'" . $_POST['pickaddress'] . "',
					city			=	'" . $city . "',
					state			=	'" . trim($state) . "',
					zip				=	'" . $zip . "',
					phone			=	'$phnum' WHERE LTRIM(LOWER(name)) = '" . strtolower(trim(sql_replace($pname))) . "'";
		$db->execute($QPup);

		$ptime		= $apptime;
		$prop 	= "10";
		$pptime = strtotime($ptime);
		$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
		$totmiles = $milesAB;
		$min = minutes($totmiles);
		$min = round($totmiles * 1.5);
		$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
		$dptime = strtotime($drp_time);
		$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
		$wc 		= '0';

		$Quptripsdetail = "UPDATE trip_details SET date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $pickadd . "',
													drp_add					=	'" . $destination_one . "',
													picklocation			=	'" . $picklocation . "',
													droplocation			=	'" . $droplocation . "',
													pickup_instruction		=	'" . $pickup_instruction . "',
													destination_instruction	=	'" . $destination_instruction . "',
													p_phnum					=	'" . $p_phnum . "',
													d_phnum					=	'" . $d_phnum . "',
													trip_miles				=	'" . $milesAB . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_a'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													cellalert 				=	'" . $cellalert . "',
													cellalertoption 		=	'" . $cellalertoption . "',
													trigerfor 				=	'" . $trigerfor . "',
													trip_remarks			=	'" . $comments . "',
													wc 						= 	'" . $wc . "',
													passenger				=	'" . $_POST['passenger'] . "'													
													WHERE reqid ='" . $id . "' AND type = 'AB'";
		$db->execute($Quptripsdetail);
		$Qsltripid = "SELECT trip_id FROM trip_details WHERE reqid ='" . $id . "'";
		if ($db->query($Qsltripid) && $db->get_num_rows()) {
			$Qsltripiddata = $db->fetch_one_assoc();
			$trip_id = $Qsltripiddata['trip_id'];
		}

		if ($triptype == 'Round Trip') {
			if ($returnpickup != "00:00:00" && $returnpickup != "Will Call") {
				$ptime		= $returnpickup;

				$prop 	= "10";
				$pptime = strtotime($ptime);
				$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
				$totmiles = $milesBF;
				$min = minutes($totmiles);
				$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
				$dptime = strtotime($drp_time);
				$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
				$wc 		= '0';
			} else {
				$ptime 		= '23:59:59';
				$pck_ptime 	= '00:00:00';
				$drp_time	= '00:00:00';
				$drp_ptime 	= '00:00:00';
				$wc 		= '1';
			}

			$Qrst = "date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $destination_one . "',
													drp_add					=	'" . $destination_last . "',
													picklocation			=	'" . $droplocation . "',
													droplocation			=	'" . $picklocation . "',
													pickup_instruction		=	'" . $destination_instruction . "',
													destination_instruction	=	'" . $backto_instruction . "',
													p_phnum					=	'" . $d_phnum . "',
													d_phnum					=	'" . $p_phnum . "',
													trip_miles				=	'" . $milesBF . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_b'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													wc 						= 	'" . $wc . "',
													trip_remarks			=	'" . $comments . "',
													passenger				=	'" . $_POST['passenger'] . "'";
			if ($pre_triptype == 'One Way') {
				$Quptripsdetail2 = "INSERT INTO trip_details SET $Qrst, reqid ='" . $id . "', type = 'BF',trip_id = '" . $trip_id . "' ";
			} elseif ($pre_triptype == 'Three Way' || $pre_triptype == 'Four Way') {
				$Quptripsdetail2 = "UPDATE trip_details SET $Qrst,type='BF' WHERE reqid ='" . $id . "' AND type = 'BC'";
			} else {
				$Quptripsdetail2 = "UPDATE trip_details SET $Qrst WHERE reqid ='" . $id . "' AND type = 'BF'";
			}
			$db->execute($Quptripsdetail2);
		}
		if ($triptype == 'Three Way') {
			if ($three_pickup != "00:00:00" && $three_pickup != "Will Call") {
				$ptime		= $three_pickup;
				$prop 	= "10";
				$pptime = strtotime($ptime);
				$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
				$totmiles = $milesBC;
				$min = minutes($totmiles);
				$min = round($totmiles * 1.5);
				$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
				$dptime = strtotime($drp_time);
				$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
				$wc 		= '0';
			} else {
				$ptime 		= '23:59:59';
				$pck_ptime 	= '00:00:00';
				$drp_time	= '00:00:00';
				$drp_ptime 	= '00:00:00';
				$wc 		= '1';
			}
			$Qrst = "	date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $destination_one . "',
													drp_add					=	'" . $destination2 . "',
													picklocation			=	'" . $droplocation . "',
													droplocation			=	'" . $droplocation2 . "',
													pickup_instruction		=	'" . $destination_instruction . "',
													destination_instruction	=	'" . $destination_instruction2 . "',
													p_phnum					=	'" . $d_phnum . "',
													d_phnum					=	'" . $d_phnum2 . "',
													trip_miles				=	'" . $milesBC . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_b'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													wc 						= 	'" . $wc . "',
													passenger 				= 	'" . $passenger . "'";
			if ($pre_triptype == 'One Way') {
				$Quptripsdetail2 = "INSERT INTO trip_details SET $Qrst, reqid ='" . $id . "', type = 'BC',trip_id = '" . $trip_id . "' ";
			} elseif ($pre_triptype == 'Round Trip') {
				$Quptripsdetail2 = "UPDATE trip_details SET 	$Qrst,type = 'BC'	WHERE reqid ='" . $id . "' AND type = 'BF'";
			} else {
				$Quptripsdetail2 = "UPDATE trip_details SET 	$Qrst	WHERE reqid ='" . $id . "' AND type = 'BC'";
			}
			$db->execute($Quptripsdetail2);



			if ($returnpickup != "00:00:00" && $returnpickup != "Will Call") {
				$ptime		= $returnpickup;
				$prop 	= "10";
				$pptime = strtotime($ptime);
				$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
				$totmiles = $milesCF;
				$min = minutes($totmiles);
				$min = round($totmiles * 1.5);
				$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
				$dptime = strtotime($drp_time);
				$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
				$wc 		= '0';
			} else {
				$ptime 		= '23:59:59';
				$pck_ptime 	= '00:00:00';
				$drp_time	= '00:00:00';
				$drp_ptime 	= '00:00:00';
				$wc 		= '1';
			}
			$Qrst = " date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $destination2 . "',
													drp_add					=	'" . $destination_last . "',
													picklocation			=	'" . $droplocation2 . "',
													droplocation			=	'" . $backtolocation . "',
													pickup_instruction		=	'" . $destination_instruction2 . "',
													destination_instruction	=	'" . $backto_instruction . "',
													p_phnum					=	'" . $d_phnum2 . "',
													d_phnum					=	'" . $p_phnum . "',
													trip_miles				=	'" . $milesCF . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_c'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													wc 						= 	'" . $wc . "',
													trip_remarks			=	'" . $comments . "',
													passenger 				= 	'" . $passenger . "'";

			if ($pre_triptype == 'One Way' || $pre_triptype == 'Round Trip') {
				$Quptripsdetail2 = "INSERT INTO trip_details SET $Qrst, reqid ='" . $id . "', type = 'CF',trip_id = '" . $trip_id . "' ";
			} elseif ($pre_triptype == 'Four Way') {
				$Quptripsdetail2 = "UPDATE trip_details SET 	$Qrst,type='CF'	WHERE reqid ='" . $id . "' AND type = 'CD'";
			} else {
				$Quptripsdetail2 = "UPDATE trip_details SET 	$Qrst	WHERE reqid ='" . $id . "' AND type = 'CF'";
			}
			$db->execute($Quptripsdetail2);
		}
		if ($triptype == 'Four Way') {
			if ($three_pickup != "00:00:00" && $three_pickup != "Will Call") {
				$ptime		= $three_pickup;
				$prop 	= "10";
				$pptime = strtotime($ptime);
				$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
				$totmiles = $milesBC;
				$min = minutes($totmiles);
				$min = round($totmiles * 1.5);
				$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
				$dptime = strtotime($drp_time);
				$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
				$wc 		= '0';
			} else {
				$ptime 		= '23:59:59';
				$pck_ptime 	= '00:00:00';
				$drp_time	= '00:00:00';
				$drp_ptime 	= '00:00:00';
				$wc 		= '1';
			}
			$Qrst = " date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $destination_one . "',
													drp_add					=	'" . $destination2 . "',
													picklocation			=	'" . $droplocation . "',
													droplocation			=	'" . $droplocation2 . "',
													pickup_instruction		=	'" . $destination_instruction . "',
													destination_instruction	=	'" . $destination_instruction2 . "',
													p_phnum					=	'" . $d_phnum . "',
													d_phnum					=	'" . $d_phnum2 . "',
													trip_miles				=	'" . $milesBC . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_b'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													wc 						= 	'" . $wc . "',
													passenger 				= 	'" . $passenger . "'";
			//WHERE reqid ='".$id."' AND type = 'BC'";  $db->execute($Quptripsdetail2);

			if ($pre_triptype == 'One Way') {
				$Quptripsdetail2 = "INSERT INTO trip_details SET $Qrst, reqid ='" . $id . "', type = 'BC',trip_id = '" . $trip_id . "' ";
			} else {
				$Quptripsdetail2 = "UPDATE trip_details SET $Qrst, type = 'BC'	WHERE reqid ='" . $id . "' AND type IN ('BC','BF')";
			}
			$db->execute($Quptripsdetail2);

			if ($four_pickup != "00:00:00" && $four_pickup != "Will Call") {
				$ptime		= $four_pickup;
				$prop 	= "10";
				$pptime = strtotime($ptime);
				$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
				$totmiles = $milesCD;
				$min = minutes($totmiles);
				$min = round($totmiles * 1.5);
				$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
				$dptime = strtotime($drp_time);
				$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
				$wc 		= '0';
			} else {
				$ptime 		= '23:59:59';
				$pck_ptime 	= '00:00:00';
				$drp_time	= '00:00:00';
				$drp_ptime 	= '00:00:00';
				$wc 		= '1';
			}
			$Qrst = "	date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $destination2 . "',
													drp_add					=	'" . $destination3 . "',
													picklocation			=	'" . $droplocation2 . "',
													droplocation			=	'" . $droplocation3 . "',
													pickup_instruction		=	'" . $destination_instruction2 . "',
													destination_instruction	=	'" . $destination_instruction3 . "',
													p_phnum					=	'" . $d_phnum2 . "',
													d_phnum					=	'" . $d_phnum3 . "',
													trip_miles				=	'" . $milesCD . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_c'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													wc 						= 	'" . $wc . "',
													passenger 				= 	'" . $passenger . "'";
			//WHERE reqid ='".$id."' AND type = 'CD'";  $db->execute($Quptripsdetail2);	
			if ($pre_triptype == 'One Way' || $pre_triptype == 'Round Trip') {
				$Quptripsdetail2 = "INSERT INTO trip_details SET $Qrst, reqid ='" . $id . "', type = 'CD',trip_id = '" . $trip_id . "' ";
			} else {
				$Quptripsdetail2 = "UPDATE trip_details SET $Qrst,type='CD'	WHERE reqid ='" . $id . "' AND type IN ('CF','CD')";
			}
			$db->execute($Quptripsdetail2);

			if ($returnpickup != "00:00:00" && $returnpickup != "Will Call") {
				$ptime		= $returnpickup;
				$prop 	= "10";
				$pptime = strtotime($ptime);
				$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes", $pptime));
				$totmiles = $milesDF;
				$min = minutes($totmiles);
				$min = round($totmiles * 1.5);
				$drp_time 	= date("H:i:s", strtotime("+$min minutes", $pptime));
				$dptime = strtotime($drp_time);
				$drp_ptime = date("H:i:s", strtotime("+$prop minutes", $dptime));
				$wc 		= '0';
			} else {
				$ptime 		= '23:59:59';
				$pck_ptime 	= '00:00:00';
				$drp_time	= '00:00:00';
				$drp_ptime 	= '00:00:00';
				$wc 		= '1';
			}
			$Qrst = "	date					=	'" . $appdate . "',
													veh_id					=	'" . $vehtype . "',
													pck_add					=	'" . $destination3 . "',
													drp_add					=	'" . $destination_last . "',
													picklocation			=	'" . $droplocation3 . "',
													droplocation			=	'" . $backtolocation . "',
													pickup_instruction		=	'" . $destination_instruction3 . "',
													destination_instruction	=	'" . $backto_instruction . "',
													p_phnum					=	'" . $d_phnum3 . "',
													d_phnum					=	'" . $p_phnum . "',
													trip_miles				=	'" . $milesDF . "',
													unloaded_miles			=	'" . $_POST['unloaded_miles_d'] . "',
													pck_time 				= 	'" . $ptime . "',
													pck_ptime 				= 	'" . $pck_ptime . "',
													drp_time 				= 	'" . $drp_time . "',
													drp_ptime 				= 	'" . $drp_ptime . "',
													wc 						= 	'" . $wc . "',
													trip_remarks			=	'" . $comments . "',
													passenger 				= 	'" . $passenger . "'";
			//WHERE reqid ='".$id."' AND type = 'DF'";  $db->execute($Quptripsdetail2);										

			if ($pre_triptype == 'One Way' || $pre_triptype == 'Round Trip' || $pre_triptype == 'Three Way') {
				$Quptripsdetail2 = "INSERT INTO trip_details SET $Qrst, reqid ='" . $id . "', type = 'DF',trip_id = '" . $trip_id . "' ";
			} else {
				$Quptripsdetail2 = "UPDATE trip_details SET 	$Qrst	WHERE reqid ='" . $id . "' AND type = 'DF'";
			}
			$db->execute($Quptripsdetail2);
		}

		if ($triptype == 'One Way') {
			$db->execute("DELETE FROM trip_details WHERE trip_id ='" . $trip_id . "' AND type IN ('BF','BC','CF','CD','DF')");
		}
		if ($triptype == 'Round Trip') {
			$db->execute("DELETE FROM trip_details WHERE trip_id ='" . $trip_id . "' AND type IN ('BC','CF','CD','DF')");
		}
		if ($triptype == 'Three Way') {
			$db->execute("DELETE FROM trip_details WHERE trip_id ='" . $trip_id . "' AND type IN ('BF','CD','DF')");
		}
		if ($triptype == 'Four Way') {
			$db->execute("DELETE FROM trip_details WHERE trip_id ='" . $trip_id . "' AND type IN ('BF','CF')");
		}



		echo '<script>alert("Trip request updated successfully!");</script>';
		//echo "<script>javascript:history.back(); 
		echo "<script>window.close();</script>";
		exit;
		$success = 'yes';
	} else {
		echo '<script>alert("Failed to update trip request. Please try again!");</script>';
		echo "<script>javascript:history.back();</script>";
		exit;
		$success = 'no';
	}
}
$getacc = "SELECT id,account_name FROM " . accounts . " ORDER BY account_name ASC";
if ($db->query($getacc) && $db->get_num_rows()) {
	$accounts = $db->fetch_all_assoc();
}
$db->close(); //echo $dob;
//print_r($RequestDetail);
$pgTitle = "Edit Request";
$smarty->assign("pgTitle", $pgTitle);
$smarty->assign("pgName", $name);
$smarty->assign("HeadingTitle", $contentDetails[0]['contTitle']);
$smarty->assign("accounts", $accounts);
$smarty->assign("seokeywords", $seokeywords);
$smarty->assign("msg", $msg);
$smarty->assign("error", $error);
$smarty->assign("testi", $testi);
$smarty->assign("data", $data);
$smarty->assign("pckstate", trim($pckstate));
$smarty->assign("drpstate", trim($drpstate));
$smarty->assign("pickupchoice", $puchoice);
$smarty->assign("states", $slist);
$smarty->assign("progtype", $progtype);
$smarty->assign("vehtype", $vehtype);
$smarty->assign("vehiclepref", $vehiclepref);
$smarty->assign("ssn", $ssn);
$smarty->assign("cisid", $cisid);
$smarty->assign("doa", $doa);
$smarty->assign("claim", $claim);
$smarty->assign("pickaddress", $pckaddr);
$smarty->assign("destination", $drpaddr);
$smarty->assign("backto", $backto);
$smarty->assign("appdate", $appdate1);
$smarty->assign("apptime", $apptime);
$smarty->assign("returnpickup", $returnpickup);
$smarty->assign("p_mad", $p_mad);
$smarty->assign("r_mad", $r_mad);
$smarty->assign("casemanager1", $casemanager1);
$smarty->assign("todaydate", $todaydate);
$smarty->assign("pname", $pname);
$smarty->assign("phnum", $phnum);
$smarty->assign("email", $email);
$smarty->assign("dob", $dob1);
$smarty->assign("cisid", $cisid);
$smarty->assign("triptype", $triptype);
$smarty->assign("mondayid", $mondayid);
$smarty->assign("tuesdayid", $tuesdayid);
$smarty->assign("thursdayid", $thursdayid);
$smarty->assign("wednesdayid", $wednesdayid);
$smarty->assign("fridayid", $fridayid);
$smarty->assign("saturdayid", $saturdayid);
$smarty->assign("sundayid", $sundayid);
$smarty->assign("foot", $foot);
$smarty->assign("reqstatus", $reqstatus);
$smarty->assign("casemanager2", $casemanager2);
$smarty->assign("comments", $comments);
$smarty->assign("reqid", $reqid);
$smarty->assign("id", $id);
$smarty->assign("pck", $pckaddr);
$smarty->assign("pckcity", $pckcity);
$smarty->assign("pckzip", $pckzip);
$smarty->assign("pckstate", $pckstate);
$smarty->assign("backto", $bck);
$smarty->assign("backtocity", $bckcity);
$smarty->assign("backtozip", $bckzip);
$smarty->assign("backtostate", $bckstate);
$smarty->assign("prgs", $prgs);
$smarty->assign("prgstitle", $prgstitle);
$smarty->assign("prgsassoctitle", $prgsassoctitle);
$smarty->assign("drp", $drpaddr);
$smarty->assign("drpcity", $drpcity);
$smarty->assign("drpstate", $drpstate);
$smarty->assign("drpzip", $drpzip);
$smarty->assign("adminComments", $adminComments);
$smarty->assign("patient_id", $patient_id);
$smarty->assign("tripdata", $RequestDetail);
$smarty->assign("three_address", $three_address);
$smarty->assign("three_city", $three_city);
$smarty->assign("three_state", $three_state);
$smarty->assign("three_zip", $three_zip);
$smarty->assign("three_will_call", $three_will_call);
$smarty->assign("three_pickup", $three_pickup);
$smarty->assign("am_pm3", $am_pm3);
$smarty->assign("four_address", $four_address);
$smarty->assign("four_city", $four_city);
$smarty->assign("four_state", $four_state);
$smarty->assign("four_zip", $four_zip);
$smarty->assign("four_will_call", $four_will_call);
$smarty->assign("four_pickup", $four_pickup);
$smarty->assign("am_pm4", $am_pm4);
$smarty->assign("five_address", $five_address);
$smarty->assign("five_city", $five_city);
$smarty->assign("five_state", $five_state);
$smarty->assign("five_zip", $five_zip);
$smarty->assign("five_will_call", $five_will_call);
$smarty->assign("five_pickup", $five_pickup);
$smarty->assign("am_pm5", $am_pm5);
$smarty->assign("destination2", $destination2);
$smarty->assign("destination3", $destination3);
//// $psuiteroom,$dsuiteroom,$p3suiteroom,$p4suiteroom,$p5suiteroom,$bsuiteroom
$smarty->assign("psuiteroom", $psuiteroom);
$smarty->assign("dsuiteroom", $dsuiteroom);
$smarty->assign("dsuiteroom2", $dsuiteroom2);
$smarty->assign("dsuiteroom3", $dsuiteroom3);
$smarty->assign("p5suiteroom", $p5suiteroom);
$smarty->assign("bsuiteroom", $bsuiteroom);
$smarty->assign("miles_string", $miles_string);
$smarty->assign("reqid", $req_id);
$smarty->assign("id", $id);
$smarty->assign("req", $req);
$smarty->assign("status", $status);
$smarty->assign("date", $_REQUEST['date']);
$smarty->display('rpaneltpl/edit2.tpl');