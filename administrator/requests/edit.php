<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');
	include_once('../../Classes/mapquest_google_miles.class.php');
	$mile_C = new mapquest_google_miles;	
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;
	$msgs   = '';
	$errors = '';
	$db->connect();
	$db2->connect();
	$capped_miles=0;
///GET VEHICLE PREFERRENCE
  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
		$vehiclepref = $db->fetch_all_assoc();
	 }
//GET STATES LIST
    $gstat = "SELECT * FROM ".TBL_STATES;
		if($db->query($gstat) && $db->get_num_rows() > 0)
		 {
		   $slist = $db->fetch_all_assoc();		 
		 }		 
// Get edit ids
$req_id = $_GET['reqid'];
$id = $_GET['id'];
$req = $_GET['req'];
if($_GET['id'] != ''){ 		
	  $Query1 = "SELECT * FROM ".TBL_FORMS." WHERE `id`='".$_GET['id']."'  ";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {  $RequestDetail = $db->fetch_all_assoc();  }
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
	  $prgQuery = "SELECT * FROM  ".TBL_PROGRAM." WHERE prgid = '".$progtype."'";
	  if($db->query($prgQuery) && $db->get_num_rows() > 0){
	   $prgstypes = $db->fetch_all_assoc();
	  }
	  $prgstitle = $prgstypes[0]['prgtitle'];
	  $prgsassoctitle = $prgstypes[0]['prgassoctitle']; 
	  $triptype=  $RequestDetail[0]['triptype'];
	  $paddr=explode(',',$pickaddress,3);
	  $daddr=explode(',',$destination,3);
	  $backaddr=explode(',',$backto,3);
	  $bck=$backaddr[0].','.$backaddr[2];
	  $bsuiteroom=$backaddr[1];
	 
	  $pckaddr=$paddr[0].','.$paddr[2];
	  $psuiteroom=$paddr[1];
	  
	  $drpaddr=$daddr[0].','.$daddr[2];
	  $dsuiteroom=$daddr[1];
	 
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
	 $addr3 				= explode(',',$RequestDetail[0]['three_address']);
	 $three_address 		= $addr3[0];
	 $p3suiteroom 			= $addr3[1];
	 $three_city			= trim($addr3[2]);
	 $three_state			= trim($addr3[3],' ');
	 $three_zip				= trim($addr3[4]);
	 
	 $three_pickup=$RequestDetail[0]['three_pickup'];
	 if($three_pickup=='00:00:00'){$three_pickup=''; $three_will_call='on';} 
	 
	 $addr4 		= explode(',',$RequestDetail[0]['four_address']);
	 $four_address  = $addr4[0];
	 $p4suiteroom  	= $addr4[1];
	 $four_city		= trim($addr4[2]);
	 $four_state	= trim($addr4[3],' ');
	 $four_zip		= trim($addr4[4]);
	 
	 $four_pickup=$RequestDetail[0]['four_pickup'];
	 if($four_pickup=='00:00:00'){$four_pickup=''; $four_will_call='on';}
	 	 
	 $addr5 		= explode(',',$RequestDetail[0]['five_address']);
	 $five_address 	= $addr5[0];
	 $p5suiteroom 	= $addr5[1];
	 $five_city		= trim($addr5[2]);
	 $five_state	= trim($addr5[3],' ');
	 $five_zip		= trim($addr5[4]);
	 
	 $five_pickup=$RequestDetail[0]['five_pickup'];
	 if($five_pickup=='00:00:00'){$five_pickup=''; $five_will_call='on';}
	 
	  $miles_string=$RequestDetail[0]['miles_string'];
	 //End of new data from db
	   if($returnpickup == 'Will Call' || $returnpickup == '00:00:00' || $returnpickup == '00:00'){
	   $puchoice = 'Will Call';
	 }else{
	   $puchoice = 'Time';
	 }
	}	 
// Update request
if(isset($_POST['submit']) && $_POST['submit'] == 'Update'){  //print_r($_POST); exit;
	$req = $POST['req'];
 	$id = $_POST['id'];
    $reqid = $_POST['reqid'];
	$Q=" SELECT h.rate_type,h.id FROM ".TBL_HOSPITALS." as h, requests as r WHERE r.userid = h.id AND r.reqid = '$reqid'";
			  if($db->query($Q) && $db->get_num_rows() > 0){$USS = $db->fetch_one_assoc();	}
			  $rate_type    = $USS['rate_type'];
      	$progtype 		= sql_replace($_POST['progtype']);
		$cisid 			= sql_replace($_POST['cisid']); 	//if(empty($cisid))$errors .= 'Identification Number is required!';
		$pname 			= sql_replace($_POST['pname']);		//if(empty($pname))$errors .= 'Patient Name is required!';
		$phnum 			= sql_replace($_POST['phnum']);		//if(empty($phnum))$errors .= 'Patient Phone Number is required!';
		$po 			= sql_replace($_POST['po']);
		$patient_weight	= sql_replace($_POST['patient_weight']);
		$bar_stretcher	= sql_replace($_POST['bar_stretcher']);
		$pickup_instruction	= sql_replace($_POST['pickup_instruction']);
		$destination_instruction	= sql_replace($_POST['destination_instruction']);
		$backto_instruction			= sql_replace($_POST['backto_instruction']);
		$d_phnum					= sql_replace($_POST['d_phnum']);
		$p_phnum					= sql_replace($_POST['p_phnum']);
		$dob 			= sql_replace($_POST['dob']);		
		$todaydate 		= sql_replace($_POST['todaydate']);
		$apptype	 	= sql_replace($_POST['apptype']);
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
		$casemanager1 	= sql_replace($_POST['casemanager1']);//if(empty($casemanager1))$errors .= 'Case Manager is required!';
		$appdate 		= sql_replace($_POST['appdate']);		//if(empty($appdate))$errors .= 'Appoimnet Date is required!';
		$apptime 		= sql_replace($_POST['apptime']);
		$puchoice 		= sql_replace($_POST['puchoice']);
		$returnpickup 	= sql_replace($_POST['returnpickup']); //return pickup time
		if($puchoice == 'Will Call'){ $returnpickup = 'Will Call'; }
		$driver 		= sql_replace($_POST['driver']);
		$sex			= sql_replace($_POST['sex']);
		$childseat		= sql_replace($_POST['childseat']);
		$escort			= sql_replace($_POST['escort']);
		$wchair			= sql_replace($_POST['wchair']);
		$stretcher		= sql_replace($_POST['stretcher']);
		$dstretcher		= sql_replace($_POST['dstretcher']);
		$oxygen			= sql_replace($_POST['oxygen']);
		$appt_type		= sql_replace($_POST['appt_type']);
		$insurance_name	= sql_replace($_POST['insurance_name']);
		
	$pickadd 			= sql_replace($_POST['pickaddress']);
	$destination_one	= sql_replace($_POST['destination']); 
	$destination_last	= sql_replace($_POST['backto']);
	
	$picklocation		= sql_replace($_POST['picklocation']);
	$droplocation		= sql_replace($_POST['droplocation']); 
	$backtolocation		= sql_replace($_POST['backtolocation']);
		
	$three_pickup = sql_replace($_POST['three_pickup']);
	$three_will_call = sql_replace($_POST['three_will_call']);
	$four_pickup = sql_replace($_POST['four_pickup']);
	$four_will_call = sql_replace($_POST['four_will_call']);
	$five_pickup = sql_replace($_POST['five_pickup']);	
	$five_will_call = sql_replace($_POST['five_will_call']);
	$comments		= sql_replace($_POST['comments']);
	 $reqstatus     = sql_replace($_POST['reqstatus']);
	
		$q = "SELECT * FROM ".TBL_CONTACT;
		if($db->query($q) && $db->get_num_rows() > 0)
		{ $d = $db->fetch_all_assoc();
		$tos = $d[0]['email'];
		$unload_add = $d[0]['address'].", ".$d[0]['city'].", ".$d[0]['state'].", ".$d[0]['zip'];
		$corporat_latlong=$d[0]['corporat_latlong'];
		$capped_miles_limit=$d[0]['capped_miles'];
		$starttime	=	$d[0]['starttime'];
		$endtime	=	$d[0]['endtime'];
		}
		$after_hours = 0;
		$ptime = mktime($apptime);
		$dtime = mktime($returnpickup);
		$starttime = mktime($starttime);
		$endtime = mktime($endtime);
		if(($ptime < $starttime) || ($ptime > $endtime)){	$p_after_hours = 1;	}
		if(($dtime < $starttime) || ($dtime > $endtime)){	$r_after_hours = 1;	}
		if(($ptime < $starttime) || ($dtime > $endtime)){	$after_hours = 1;	}
		
	//Miles Calculation
	//Un loaded miles it will be added into system if a company allow them
	$unloadedmiles = round($mile_C->distance($pickadd,$unload_add),2);
	//End of unloaded miles charges 
	if($triptype == 'One Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$miles_string = $milesAB;
		$miles 		= $milesAB;
		$base = 1;
		$c1 = $mile_C->getLatLong($pickadd); 	 $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		}
	if($triptype == 'Round Trip') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBF = round($mile_C->distance($destination_one,$destination_last),2);
		$miles_string = $milesAB.','.$milesBF;
		$miles 		= $milesAB + $milesBF;
		$base = 1;
		$c1 = $mile_C->getLatLong($pickadd); 	$dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;} 	
		$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c6 = $mile_C->getLatLong($destination_last); $dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;} 
		}
	if($triptype == 'Three Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination_two),2);
		$milesCF = round($mile_C->distance($destination_two,$destination_last),2);
		$miles_string = $milesAB.','.$milesBC.','.$milesCF;
		$miles 	  = $milesAB + $milesBC + $milesCF; 
		$base = 2;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$c1 = $mile_C->getLatLong($pickadd); $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c3 = $mile_C->getLatLong($destination_two); $dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c6 = $mile_C->getLatLong($destination_last); $dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}	
		}
	if($triptype == 'Four Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination_two),2);
		$milesCD = round($mile_C->distance($destination_two,$destination_three),2);
		$milesDF = round($mile_C->distance($destination_three,$destination_last),2);
		$miles_string = $milesAB.','.$milesBC.','.$milesCD.','.$milesDF;
		$miles	= $milesAB + $milesBC + $milesCD + $milesDF; 
		$base = 3;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; }
		$c1 = $mile_C->getLatLong($pickadd); $dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}		
		$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c3 = $mile_C->getLatLong($destination_two); $dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c4 = $mile_C->getLatLong($destination_three); $dis = $mile_C->distance_cord($corporat_latlong,$c4); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c6 = $mile_C->getLatLong($destination_last);	$dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}	
		}	
	if($triptype == 'Five Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination_two),2);
		$milesCD = round($mile_C->distance($destination_two,$destination_three),2);
		$milesDE = round($mile_C->distance($destination_three,$destination_four),2);
		$milesEF = round($mile_C->distance($destination_four,$destination_last),2);
		$miles_string = $milesAB.','.$milesBC.','.$milesCD.','.$milesDE.','.$milesEF;
		$miles = $milesAB + $milesBC + $milesCD + $milesDE + $milesEF; 
		$base = 4;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; }
		$five_pickup 	= sql_replace($_POST['five_pickup']);
		if($five_will_call == 'on'){ $five_pickup = 'Will Call'; }
		$c1 = $mile_C->getLatLong($pickadd); 	$dis = $mile_C->distance_cord($corporat_latlong,$c1); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c2 = $mile_C->getLatLong($destination_one); $dis = $mile_C->distance_cord($corporat_latlong,$c2); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c3 = $mile_C->getLatLong($destination_two);  $dis = $mile_C->distance_cord($corporat_latlong,$c3); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c4 = $mile_C->getLatLong($destination_three); $dis = $mile_C->distance_cord($corporat_latlong,$c4); if($dis > $capped_miles_limit){$capped_miles=1;}	
		$c5 = $mile_C->getLatLong($destination_four); 	$dis = $mile_C->distance_cord($corporat_latlong,$c5); if($dis > $capped_miles_limit){$capped_miles=1;}
		$c6 = $mile_C->getLatLong($destination_last);	$dis = $mile_C->distance_cord($corporat_latlong,$c6); if($dis > $capped_miles_limit){$capped_miles=1;}
		}			
		if($rate_type=='custom'){	$capped_miles=0;	}
	//End of miles calculation
	//Amount calculation
	$miles = $miles;

	$pickaddX 			= explode(',',$pickadd,2);
	if($pickaddX[1]){	$pickadd =	$pickaddX[0].','.str_replace(',','',sql_replace($_POST['psuiteroom'])).','.$pickaddX[1]; }
	$destination_oneX 	= explode(',',$destination_one,2);
	if($destination_oneX[1]){	$destination_one =	$destination_oneX[0].','.str_replace(',','',sql_replace($_POST['dsuiteroom'])).','.$destination_oneX[1]; }
	$destination_lastX 	= explode(',',$destination_last,2);
	if($destination_lastX[1]){	$destination_last =	$destination_lastX[0].','.str_replace(',','',sql_replace($_POST['bsuiteroom'])).','.$destination_lastX[1]; }

  $Query2  = "UPDATE ".TBL_FORMS." SET
					prog='".$progtype."',
					unloadedmilage='".$unloadedmiles."',
					miles_string = '".$miles_string."',
					milage='".$miles."',
					triptype='".$triptype."',	
					vehtype='".$vehtype."',					
					po='".$po."',
					patient_weight='".$patient_weight."',
					bar_stretcher='".$bar_stretcher."',
					pickup_instruction='".$pickup_instruction."',
					destination_instruction='".$destination_instruction."',
					backto_instruction='".$backto_instruction."',
					d_phnum='".$d_phnum."',
					p_phnum='".$p_phnum."',
					pickaddr='".$pickadd."',
					destination='".$destination_one."',
					three_address='".$destination_two."',
					four_address='".$destination_three."',
					five_address='".$destination_four."',
					three_pickup 	= '".$three_pickup."',
					four_pickup 	= '".$four_pickup."',
					five_pickup 	= '".$five_pickup."',
					backto='".$destination_last."',
					appdate='".$appdate."',
                    apptime='".$apptime."',
					returnpickup='".$returnpickup."',
					today_date=NOW(),
					clientname='".$pname."',
                    phnum='".$phnum."',
					dob='".$dob."',
					cisid='".$cisid."',
					escort='".$escort."',
					wchair='".$wchair."',
					stretcher='".$stretcher."',
					dstretcher='".$dstretcher."',
					appt_type='".$appt_type."',	
					c1='".$c1."',
					c2='".$c2."',
					c3='".$c3."',
					c4='".$c4."',
					c5='".$c5."',
					c6='".$c6."',
					picklocation='".$picklocation."',
					droplocation='".$droplocation."',
					backtolocation='".$backtolocation."',
					capped_miles='".$capped_miles."',
					after_hours ='".$after_hours."',
					p_after_hours ='".$p_after_hours."',
					r_after_hours ='".$r_after_hours."',
					comments='".$comments."' WHERE  id='".$id."'"; 
		  if($db->execute($Query2))
		    { echo '<script>alert("Trip request updated successfully!");</script>'; 
			echo "<script>window.close();</script>"; exit;
			$success = 'yes';
	         }else{ 
			 echo '<script>alert("Failed to update trip request. Please try again!");</script>'; 
			 echo "<script>window.close();</script>"; exit;
			 $success = 'no'; }	   
	 	}
	$db->close();
	$pgTitle="Edit Request";
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	$smarty->assign("content",$pgContent);	
    $smarty->assign("seokeywords",$seokeywords);
	$smarty->assign("msg",$msg);
	$smarty->assign("error",$error);
	$smarty->assign("testi",$testi);
    $smarty->assign("data",$data);	
	$smarty->assign("pckstate",trim($pckstate));
	$smarty->assign("drpstate",trim($drpstate));	
	$smarty->assign("pickupchoice",$puchoice);	
    $smarty->assign("states",$slist);
	$smarty->assign("progtype",$progtype);
	$smarty->assign("vehtype",$vehtype);	
	$smarty->assign("vehiclepref",$vehiclepref);	
	$smarty->assign("ssn",$ssn);
	$smarty->assign("cisid",$cisid);
	$smarty->assign("doa",$doa);
	$smarty->assign("claim",$claim);		
	$smarty->assign("pickaddress",$pckaddr);
	$smarty->assign("destination",$drpaddr);	
	$smarty->assign("backto",$backto);
	$smarty->assign("appdate",$appdate1);	
	$smarty->assign("apptime",$apptime);
	$smarty->assign("returnpickup",$returnpickup);
	$smarty->assign("p_mad",$p_mad);
	$smarty->assign("r_mad",$r_mad);	
	$smarty->assign("casemanager1",$casemanager1);
	$smarty->assign("todaydate",$todaydate);	
	$smarty->assign("pname",$pname);
	$smarty->assign("phnum",$phnum);
	$smarty->assign("email",$email);	
	$smarty->assign("dob",$dob1);
	$smarty->assign("cisid",$cisid);
	$smarty->assign("triptype",$triptype);
	$smarty->assign("mondayid",$mondayid);
	$smarty->assign("tuesdayid",$tuesdayid);
	$smarty->assign("thursdayid",$thursdayid);
	$smarty->assign("wednesdayid",$wednesdayid);
	$smarty->assign("fridayid",$fridayid);
	$smarty->assign("saturdayid",$saturdayid);
	$smarty->assign("sundayid",$sundayid);							
	$smarty->assign("foot",$foot);	
	$smarty->assign("reqstatus",$reqstatus);		
	$smarty->assign("casemanager2",$casemanager2);
	$smarty->assign("comments",$comments);
 	$smarty->assign("reqid",$reqid);  	
	$smarty->assign("id",$id);	
	$smarty->assign("pck",$pckaddr);
	$smarty->assign("pckcity",$pckcity);
	$smarty->assign("pckzip",$pckzip);
	$smarty->assign("pckstate",$pckstate);
	$smarty->assign("backto",$bck);
	$smarty->assign("backtocity",$bckcity);
	$smarty->assign("backtozip",$bckzip);
	$smarty->assign("backtostate",$bckstate);
	$smarty->assign("prgs",$prgs);
	$smarty->assign("prgstitle",$prgstitle);
	$smarty->assign("prgsassoctitle",$prgsassoctitle);
	$smarty->assign("drp",$drpaddr);
	$smarty->assign("drpcity",$drpcity);	
    $smarty->assign("drpstate",$drpstate);	
    $smarty->assign("drpzip",$drpzip);	
	$smarty->assign("adminComments",$adminComments);
	$smarty->assign("patient_id",$patient_id);
	$smarty->assign("tripdata",$RequestDetail);
	 $smarty->assign("three_address",$three_address);
	 $smarty->assign("three_city",$three_city);
	 $smarty->assign("three_state",$three_state);
	 $smarty->assign("three_zip",$three_zip);
	 $smarty->assign("three_will_call",$three_will_call);
	 $smarty->assign("three_pickup",$three_pickup);
	 $smarty->assign("am_pm3",$am_pm3);
	 $smarty->assign("four_address",$four_address);
	 $smarty->assign("four_city",$four_city);
	 $smarty->assign("four_state",$four_state);
	 $smarty->assign("four_zip",$four_zip);
	 $smarty->assign("four_will_call",$four_will_call);
	 $smarty->assign("four_pickup",$four_pickup);
	 $smarty->assign("am_pm4",$am_pm4);
	 $smarty->assign("five_address",$five_address);
	 $smarty->assign("five_city",$five_city);
	 $smarty->assign("five_state",$five_state);
	 $smarty->assign("five_zip",$five_zip);
	 $smarty->assign("five_will_call",$five_will_call);
	 $smarty->assign("five_pickup",$five_pickup);
	 $smarty->assign("am_pm5",$am_pm5);
//// $psuiteroom,$dsuiteroom,$p3suiteroom,$p4suiteroom,$p5suiteroom,$bsuiteroom
	 $smarty->assign("psuiteroom",$psuiteroom);
	 $smarty->assign("dsuiteroom",$dsuiteroom);
	 $smarty->assign("p3suiteroom",$p3suiteroom);
	 $smarty->assign("p4suiteroom",$p4suiteroom);
	 $smarty->assign("p5suiteroom",$p5suiteroom);
	 $smarty->assign("bsuiteroom",$bsuiteroom);
	 $smarty->assign("miles_string",$miles_string);
	 $smarty->assign("reqid",$req_id);
	 $smarty->assign("id",$id);
	 $smarty->assign("req",$req);
	 $smarty->assign("status",$status);
	$smarty->display('reqtpls/edit.tpl');
?>