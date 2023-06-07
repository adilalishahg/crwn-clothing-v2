<?php
include_once('DatabaseUS.inc.php');
include_once('../administrator/routingpanel/rating.php');
	$db = new Database;	
	$db->connect();
if (isset($_GET['action']) && isset($_GET['driverID'])) { 
    $action = $_GET['action'];
  	switch ($action)
    {  
        case 'getPendingSchedule_List':
           $data = getPendingSchedule_List($db);        
            break;
		case 'getpay_detail':
           	$data = getpay_detail($db);        
            break;	
		case 'getnextday_List':
           	$data = getnextday_List($db);        
            break;	
			
        case 'updateAcknowledge_status':
         	$data = updateAcknowledge_status($db);
        break;
		
		case 'denytrip_status':
         	$data = denytrip_status($db);
        break;
		
		case 'updateCurrentTrip_Status':
        	$data = updateCurrentTrip_Status($db);
        break;
		case 'MessageReceived':
        	$data = MessageReceived($db);
        break;
		case 'addToCurrentTrip':
        	$data = addToCurrentTrip($db);
        break;
		case 'GetMessages':
        	$data = GetMessages($db);
        break;
        default:
            $data['invalid_access'] = "action is undefined";
    } $db->close();
  echo json_encode($data);   }
else {  
    $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['error'] = 'parameters are missing';
     echo json_encode($jsonarray);
    exit();  }
function getpay_detail($db)
{
	$drv_code = $_GET['driverID']; 
if($drv_code!=''){
		$Qsd="SELECT * FROM drivers WHERE drv_code ='".$drv_code."'";
		if($db->query($Qsd) && $db->get_num_rows()>0){
		$dt['status'] 				= 'true';
		$driver = $db->fetch_one_assoc();
		
		 $cr_start1 	= date("Y-m-d", strtotime("last Wednesday"));// exit;
		$cr_start 	= date('Y-m-d', strtotime($cr_start1 . ' -1 day'));
		 $cr_end 	= date('Y-m-d', strtotime($cr_start1 . ' +6 day'));//date("Y-m-d",strtotime("next Tuesday"));
		$pr_start 	= date('Y-m-d', strtotime($cr_start1 . ' -7 day'));
		$pr_end 	= date('Y-m-d', strtotime($pr_start . ' +6 day'));//date("Y-m-d",strtotime("last Tuesday"));
		
		// echo date("l"); exit;
		 $Qcurrent="SELECT * FROM attendance WHERE  dated BETWEEN '".$cr_start1."' AND '".$cr_end."' AND dayonoff = 'on' AND approval ='approved' AND  driver_id = '".$driver['Drvid']."'";
		if($db->query($Qcurrent) && $db->get_num_rows() > 0)
		{ $data1 = $db->fetch_all_assoc(); //echo '<pre/>';print_r($data1); exit;
		$Qtrips="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details WHERE drv_id = '".$driver['drv_code']."' AND date BETWEEN '".$cr_start1."' AND '".$cr_end."' AND status IN('1','4','6','7')";
		if($db->query($Qtrips) && $db->get_num_rows() > 0)
		{ $tripsdata = $db->fetch_one_assoc(); $cr_runs= $tripsdata['trun']; $cr_miles= $tripsdata['tmiles'];}
		$tothourrs=$toovertimehourrs=0;
		$tot1=$toovertime1= 0;
		for($i=0;$i<sizeof($data1);$i++){
			 $tot1 =$tot1+$data1[$i]['total_time'];
			 $toovertime1 =$toovertime1+$data1[$i]['over_time'];
			}
		$df1=secondsToTime($tot1);
			 $tot1=$df1['hours']!=0?$df1['hours']:'0';	
		$df2=secondsToTime($toovertime1);
			 $toovertime1=$df2['hours']!=0?$df2['hours']:'0';	
		$payableamount1 = $driver['hrate']*$tot1;	
		 $jsonarray['cr_totalhours'] 		= $tot1;
		 $jsonarray['cr_totalovetime'] 		= $toovertime1;
		 $jsonarray['cr_hourrate'] 			= $driver['hrate'];
		 $jsonarray['cr_payableamount'] 	= round(($payableamount1+($cr_runs*$driver['per_run'])+($cr_miles*$driver['per_mile'])),0);
		 $jsonarray['cr_runs'] 				= $cr_runs.'*'.$driver['per_run'].'='.$cr_runs*$driver['per_run'];
		 $jsonarray['cr_miles'] 			= round($cr_miles,2).'*'.$driver['per_mile'].'='.round(($cr_miles*$driver['per_mile']),2);
		 
		 $jsonarray['cr_daystart'] 	= date("l m-d-y", strtotime($cr_start1));
		 $jsonarray['cr_dayend'] 	= date("l m-d-y", strtotime($cr_end));		
		}else{
		 $jsonarray['cr_totalhours'] 		= 0;
		 $jsonarray['cr_totalovetime'] 		= 0;
		 $jsonarray['cr_hourrate'] 			= '0';
		 $jsonarray['cr_payableamount'] 	= 0;
		 $jsonarray['cr_runs'] 				= "0";
		 $jsonarray['cr_miles'] 			= "0";
		 $jsonarray['cr_daystart'] 	= date("l m-d-y", strtotime($cr_start1));
		 $jsonarray['cr_dayend'] 	= date("l m-d-y", strtotime($cr_end));			}
		 $Qpre="SELECT * FROM attendance WHERE  dated BETWEEN '".$pr_start."' AND '".$pr_end."' AND dayonoff = 'on' AND approval ='approved' AND  driver_id = '".$driver['Drvid']."'";
		if($db->query($Qpre) && $db->get_num_rows() > 0)
		{ $data2 = $db->fetch_all_assoc(); //echo '<pre/>';print_r($data2); exit;
		$Qtrips2="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details WHERE drv_id = '".$driver['drv_code']."' AND date BETWEEN '".$pr_start."' AND '".$pr_end."' AND status IN('1','4','6','7')";
		if($db->query($Qtrips2) && $db->get_num_rows() > 0)
		{ $tripsdata2 = $db->fetch_one_assoc(); $pr_runs= $tripsdata2['trun']; $pr_miles= $tripsdata2['tmiles'];}
		$tothourrs2=$toovertimehourrs2=0;
		$tot2=$toovertime2=0;
		for($j=0;$j<sizeof($data2);$j++){
			 $tot2 =$tot2+$data2[$j]['total_time'];
			 $toovertime2 =$toovertime2+$data2[$j]['over_time'];
			} 
		$df3=secondsToTime($tot2); 
			$tot2=$df3['hours']!=0?$df3['hours']:'0';	
		$df4=secondsToTime($toovertime2);
			 $toovertime2=$df4['hours']!=0?$df4['hours']:'0';	
		$payableamount2 = $driver['hrate']*$tot2;	
		 $jsonarray['pr_totalhours'] 		= $tot2;
		 $jsonarray['pr_totalovetime'] 		= $toovertime2;
		 $jsonarray['pr_hourrate'] 			= $driver['hrate'];
		 $jsonarray['pr_payableamount'] 	= round(($payableamount2)+($pr_runs*$driver['per_run'])+($pr_miles*$driver['per_mile']),0);
		 $jsonarray['pr_runs'] 				= round($pr_runs,2).'*'.$driver['per_run'].'='.round(($pr_runs*$driver['per_run']),2);
		 $jsonarray['pr_miles'] 			= round($pr_miles,2).'*'.$driver['per_mile'].'='.round(($pr_miles*$driver['per_mile']),2);
		 $jsonarray['pr_daystart'] 			= date("l m-d-y", strtotime($pr_start));
		 $jsonarray['pr_dayend'] 			= date("l m-d-y", strtotime($pr_end));			
		}else{
		 $jsonarray['pr_totalhours'] 		= 0;
		 $jsonarray['pr_totalovetime'] 		= 0;
		 $jsonarray['pr_hourrate'] 			= '0';
		 $jsonarray['pr_payableamount'] 	= 0;
		 $jsonarray['pr_runs'] 				= "0";
		 $jsonarray['pr_miles'] 			= "0";
		 $jsonarray['pr_daystart'] 			= date("l m-d-y", strtotime($pr_start));
		 $jsonarray['pr_dayend'] 			= date("l m-d-y", strtotime($pr_end));}
		 $Qlast="SELECT * FROM attendance WHERE  dayonoff = 'on' AND  driver_id = '".$driver['Drvid']."' ORDER BY id DESC LIMIT 1";
		if($db->query($Qlast) && $db->get_num_rows() > 0)
		{ $data3 = $db->fetch_one_assoc(); // print_r($data3);
		$Qtrips3="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details WHERE drv_id = '".$driver['drv_code']."' AND date ='".$data3['dated']."' AND status IN('1','4','6','7')";
		if($db->query($Qtrips3) && $db->get_num_rows() > 0)
		{ $tripsdata3 = $db->fetch_one_assoc();  $last_runs= $tripsdata3['trun']; $last_miles= $tripsdata3['tmiles'];}
		$df5=secondsToTime($data3['total_time']);
			 $tot3=$df5['hours']!=0?$df5['hours']:'0';	
		$df6=secondsToTime($data3['over_time']);
			 $toovertime3=$df6['hours']!=0?$df6['hours']:'0';
		 $jsonarray['last_totalhours'] 		= $tot3;
		 $jsonarray['last_totalovetime'] 	= $toovertime3;
		 $jsonarray['last_payableamount'] 	= round(($driver['hrate']*$tot3)+($last_runs*$driver['per_run'])+($last_miles*$driver['per_mile']),0);
		 $jsonarray['last_approval'] 		= $data3['approval'];
		 $jsonarray['last_runs'] 			= round($last_runs,2).'*'.$driver['per_run'].'='.round(($last_runs*$driver['per_run']),2);
		 $jsonarray['last_miles'] 			= round($last_miles,2).'*'.$driver['per_mile'].'='.round(($last_miles*$driver['per_mile']),2);		
		 }else{
		 $jsonarray['last_totalhours'] 		= 0;
		 $jsonarray['last_totalovetime'] 	= 0;
		 $jsonarray['last_payableamount'] 	= 0;
		 $jsonarray['last_approval'] 		= '';
		 $jsonarray['last_runs'] 			= "0";
		 $jsonarray['last_miles'] 			= "0";}
		 }else{$dt['status'] 				= 'false';}
		}else{$dt['status'] 				= 'false';}
			$dt['data'] = $jsonarray;
			return $dt; }
function getPendingSchedule_List($db)
{  $todaydate = date('Y-m-d'); 
		$today=date('Y-m-d');//,strtotime("+1 day"));
		$pday = date("Y-m-d",strtotime("-1 day"));
    if (isset($_GET['driverID']) && $_GET['driverID'] !='') {
        $driverID = $_GET['driverID'];
		// To get driver information		
$queryD = "SELECT  * FROM ".TBL_DRIVERS." WHERE drv_code = '".$driverID."'";
if($db->query($queryD) && $db->get_num_rows() > 0)	{	$dataD = $db->fetch_one_assoc();	 }
		
	$sql = "SELECT * FROM alerts WHERE sent BETWEEN '".$todaydate." 00:00:00' AND '".$todaydate." 23:59:59' AND alerts.to = '$driverID' AND recd = '0' ORDER BY id ASC LIMIT 1 "; //
		 if($db->query($sql) && $db->get_num_rows() > 0)
		{ $data = $db->fetch_one_assoc();
			$id = $data['id'];
			$sqll = "UPDATE alerts SET recd = '1' WHERE id = ".$id." ";
		$db->execute($sqll);
					  } 
			
	$Query = "SELECT t.trip_user,t.trip_clinic,t.trip_tel,td.tdid,td.tdid,td.drv_id,td.date,td.pck_add,td.pck_time,td.pickStatus,td.dropStatus, td.trip_remarks,td.startmilage,td.reqid,td.pickup_instruction,td.destination_instruction,td.d_phnum,td.p_phnum,td.picklocation,td.droplocation,
	td.drp_add,td.drp_time,td.trip_miles,td.wc,td.type,td.status,td.acknowledge_status,td.add_current 
		  FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id  WHERE t.trip_date BETWEEN '$pday' AND '$today' AND td.acknowledge_status IN('0','1') AND td.status IN('2','10','5','6','9') AND td.drv_id ='$driverID' ORDER by td.pck_time ASC";
		
	if($db->query($Query) && $db->get_num_rows() > 0) { 
	
		$jsonarray['status'] = 'true';
		$tripdata=$db->fetch_all_assoc();
		for($i=0;$i<sizeof($tripdata);$i++){
			$Q="SELECT vt.vehtype,h.account_name	,ri.patient_weight,ri.oxygen,ri.dstretcher,ri.bar_stretcher,ri.stretcher,ri.dwchair,ri.wchair,ri.escort FROM vehtype as vt,request_info as ri,accounts as h 
			WHERE ri.vehtype=vt.id AND
			ri.account=h.id  AND
			ri.id='".$tripdata[$i]['reqid']."'";
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }
			$tripdata[$i]['v_pref']=$ata['vehtype'];
			$tripdata[$i]['clinic_tel']=$ata['hosp_phnum'];
			$tripdata[$i]['patient_weight']=$ata['patient_weight'];
			$tripdata[$i]['stretcher']		=	$ata['stretcher'];
			$tripdata[$i]['dstretcher']		=	$ata['dstretcher'];
			$tripdata[$i]['bar_stretcher']	=	$ata['bar_stretcher'];
			$tripdata[$i]['escort']			=	$ata['escort'];
			$tripdata[$i]['wchair']			=	$ata['wchair'];
			$tripdata[$i]['dwchair']		=	$ata['dwchair'];
			$tripdata[$i]['oxygen']			=	$ata['oxygen'];
			
			}
		
		$jsonarray['userdata'] = $tripdata;
		if($data){
			$jsonarray['Adminmessage'] 		= $data['message'];
			$jsonarray['AdminmessageID'] 	= $data['id'];
			$jsonarray['DateTime'] 			= $data['sent']; } 
		
			//return $jsonarray;
			} else {  $jsonarray['status'] = 'false'; $jsonarray['error'] = 'NoTrips';
			if($data){
			$jsonarray['Adminmessage'] 		= $data['message'];
			$jsonarray['AdminmessageID'] 	= $data['id'];
			$jsonarray['DateTime'] 			= $data['sent']; }
			  }
    } 
	// Query for Asscort 
$Query2 = "SELECT t.trip_user,t.trip_clinic,t.trip_tel,td.tdid,td.tdid,td.drv_id,td.date,td.pck_add,td.pck_time,td.pickStatus,td.dropStatus, td.trip_remarks,td.startmilage,td.reqid,td.pickup_instruction,td.destination_instruction,td.d_phnum,td.p_phnum,td.picklocation,td.droplocation,
	td.drp_add,td.drp_time,td.trip_miles,td.wc,td.type,td.status,td.acknowledge_status,td.add_current 
		  FROM trips as t INNER JOIN trip_details as td ON t.trip_id=td.trip_id
		    WHERE t.trip_date BETWEEN '$pday' AND '$today' AND td.acknowledge_status IN('0','1') AND td.status IN('2','10','5','6','9') AND td.escort_id ='$driverID'  ORDER by td.pck_time ASC";

		if($db->query($Query2) && $db->get_num_rows() > 0) { 	
		$jsonarray['status2'] = 'true';
		$tripdata2=$db->fetch_all_assoc();
		for($i=0;$i<sizeof($tripdata2);$i++){
			$tripdata2[$i]['triptype']		=	'twomanteam';
			$Q="SELECT vt.vehtype,h.account_name	,ri.patient_weight,ri.oxygen,ri.dstretcher,ri.bar_stretcher,ri.stretcher,ri.dwchair,ri.wchair,ri.escort FROM vehtype as vt,request_info as ri,accounts as h 
			WHERE ri.vehtype=vt.id AND
			ri.account=h.id  AND
			ri.id='".$tripdata2[$i]['reqid']."'";
			if($db->query($Q) && $db->get_num_rows() > 0) { $ata=$db->fetch_one_assoc(); }
			$tripdata2[$i]['v_pref']			=	$ata['vehtype'];
			$tripdata2[$i]['clinic_tel']		=	$ata['hosp_phnum'];
			$tripdata2[$i]['patient_weight']	=	$ata['patient_weight'];
			$tripdata2[$i]['stretcher']		=	$ata['stretcher'];
			$tripdata2[$i]['dstretcher']		=	$ata['dstretcher'];
			$tripdata2[$i]['bar_stretcher']	=	$ata['bar_stretcher'];
			$tripdata2[$i]['escort']			=	$ata['escort'];
			$tripdata2[$i]['wchair']			=	$ata['wchair'];
			$tripdata2[$i]['dwchair']		=	$ata['dwchair'];
			$tripdata2[$i]['oxygen']			=	$ata['oxygen'];
			/*if($tripdata2[$i]['oxygen']=='yes' || $tripdata2[$i]['oxygen']=='Yes'){	$tripdata2[$i]['oxygen']			=	$ata['oxygen']; }else{$tripdata2[$i]['oxygen']='';}*/
			
			
			$paddr=explode(',',$tripdata2[$i]['pck_add'],3);
			$tripdata2[$i]['pck_add_withoutroom'] = $paddr[0].','.$paddr[2];
			
			$daddr=explode(',',$tripdata2[$i]['drp_add'],3);
			$tripdata2[$i]['drp_add_withoutroom'] = $daddr[0].','.$daddr[2];
			}
		
		$jsonarray['userdata2'] = $tripdata2;

			} else {  $jsonarray['status2'] = 'false'; $jsonarray['error2'] = 'No Two Manteam';  }
	
	if($dataD){$jsonarray['clockstatus'] 		= $dataD['clockstatus'];}  return $jsonarray;}
function getnextday_List($db)
{  		$crtime=strtotime(date("H:i:s"));
		$maxtime=strtotime(("20:00:00"));
		//if($crtime > $maxtime){
			
		$nextday = date("Y-m-d",strtotime("+1 day"));
	   if (isset($_GET['driverID']) && $_GET['driverID'] !='') {
        $driverID = $_GET['driverID'];
$queryD = "SELECT  * FROM ".TBL_DRIVERS." WHERE drv_code = '".$driverID."'";
if($db->query($queryD) && $db->get_num_rows() > 0)	{	$dataD = $db->fetch_one_assoc();	 }
	$Query = "SELECT t.trip_user,t.trip_clinic,t.trip_tel,td.tdid,td.tdid,td.drv_id,td.date,td.pck_add,td.pck_time,td.pickStatus,td.dropStatus, td.trip_remarks,td.startmilage,td.reqid,td.pickup_instruction,td.destination_instruction,td.d_phnum,td.p_phnum,td.picklocation,td.droplocation,
	td.drp_add,td.drp_time,td.trip_miles,td.wc,td.type,td.status,td.acknowledge_status,td.add_current 
		  FROM trips as t INNER JOIN trip_details as td ON t.trip_id=td.trip_id
		    WHERE t.trip_date = '$nextday' AND td.acknowledge_status IN('0','1') AND td.status IN('2','10','5','6','9') AND td.drv_id ='$driverID'  ORDER by td.pck_time ASC";
		if($db->query($Query) && $db->get_num_rows() > 0) { 
		$jsonarray['status'] = 'true';
		$tripdata=$db->fetch_all_assoc();
		for($i=0;$i<sizeof($tripdata);$i++){
			$Q="SELECT vt.vehtype,h.account_name	,ri.patient_weight,ri.oxygen,ri.dstretcher,ri.bar_stretcher,ri.stretcher,ri.dwchair,ri.wchair,ri.escort FROM vehtype as vt,request_info as ri,accounts as h 
			WHERE ri.vehtype=vt.id AND
			ri.account=h.id  AND
			ri.id='".$tripdata[$i]['reqid']."'";
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }
			$tripdata[$i]['v_pref']			=	$ata['vehtype'];
			$tripdata[$i]['clinic_tel']		=	$ata['hosp_phnum'];
			$tripdata[$i]['patient_weight']	=	$ata['patient_weight'];
			$tripdata[$i]['stretcher']		=	$ata['stretcher'];
			$tripdata[$i]['dstretcher']		=	$ata['dstretcher'];
			$tripdata[$i]['bar_stretcher']	=	$ata['bar_stretcher'];
			$tripdata[$i]['escort']			=	$ata['escort'];
			$tripdata[$i]['wchair']			=	$ata['wchair'];
			$tripdata[$i]['dwchair']		=	$ata['dwchair'];
			$tripdata[$i]['oxygen']			=	$ata['oxygen'];
			/*if($tripdata[$i]['oxygen']=='yes' || $tripdata[$i]['oxygen']=='Yes'){	$tripdata[$i]['oxygen']			=	$ata['oxygen']; }else{$tripdata[$i]['oxygen']='';}*/
			$paddr=explode(',',$tripdata[$i]['pck_add'],3);
			$tripdata[$i]['pck_add_withoutroom'] = $paddr[0].','.$paddr[2];
			$daddr=explode(',',$tripdata[$i]['drp_add'],3);
			$tripdata[$i]['drp_add_withoutroom'] = $daddr[0].','.$daddr[2];
			}
		$jsonarray['userdata'] = $tripdata;
			} else {  $jsonarray['status'] = 'false'; $jsonarray['error'] = 'NoTrips';
			  }
    } 
	   else { $jsonarray['status'] = 'false'; $jsonarray['error'] = 'NoTrips'; }
		
		//}else { $jsonarray['status'] = 'false'; $jsonarray['error'] = 'Schedule will be available after 8 PM'; }
		
		 return $jsonarray; }		
function updateAcknowledge_status($db)
{  if (isset($_GET['driverID']) && isset($_GET['tripID'])) {
	$current_time=date("Y-m-d H:i:s");
	$qu = "UPDATE trip_details SET acknowledge_status = '1', status = '5',driverconfirm_time = '$current_time' WHERE tdid = '".$_GET['tripID']."' AND drv_id = '".$_GET['driverID']."' ";
	if($db->execute($qu)) { 
$qry_refreshed = "UPDATE ".TBL_CONTACT." SET refresh = '1' WHERE c_id='1' "; $db->execute($qry_refreshed);	
	 $jsonarray = array();
     $jsonarray['status'] = 'true';
     $jsonarray['userdata'] = 'AcknowledgementUpdated';  return $jsonarray; } 
	 else { $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['userdata'] = 'Acknowledgement Failed!.'; return $jsonarray; }
	} }
	
function denytrip_status($db)
{  if (isset($_GET['driverID']) && isset($_GET['tripID'])) {
	$qu = "UPDATE trip_details SET acknowledge_status = '2'  WHERE tdid = ".$_GET['tripID']." AND drv_id = ".$_GET['driverID']." ";
	if($db->execute($qu)) { 
$qry_refreshed = "UPDATE ".TBL_CONTACT." SET refresh = '1' WHERE c_id='1' "; $db->execute($qry_refreshed);		
	$jsonarray = array();
     $jsonarray['status'] = 'true';
     $jsonarray['userdata'] = 'DenyUpdated';  return $jsonarray; } 
	 else { $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['userdata'] = 'Deny Failed!.'; return $jsonarray; }
	} }
function updateCurrentTrip_Status($db)
{ 
$key="Fmjtd%7Cluub29ur25%2Crl%3Do5-96z254";
require('../twilio/Services/Twilio.php'); 
$account_sid= 'ACf1449cf4e1795e14ea66d166fea72772'; 
$auth_token = '56bb8e552c5dc8e2b0a8d383a580fae4'; 
$client 	= new Services_Twilio($account_sid, $auth_token); 
if (isset($_GET['driverID']) && isset($_GET['tripID']) && isset($_GET['tripstatus'])) {
	$comments = $_GET['comments'];
	$st = sql_replace($_GET['tripstatus']);
	$tdid = sql_replace($_GET['tripID']);
	$driver_id = $_GET['driverID'];
	$startMilage = $_GET['startMilage'];
	$endMilage = $_GET['endMilage'];
	$selcomm = "SELECT td.*,t.* FROM trip_details td, trips t  
			   WHERE  t.trip_id=td.trip_id AND td.tdid='$tdid' ";
	if($db->query($selcomm) && $db->get_num_rows() > 0) 
	{ $datacomment = $db->fetch_all_assoc(); $trip_comment = $datacomment[0]['trip_remarks']; }		   
/*	$selcomm = "SELECT trip_remarks from trip_details WHERE tdid = '$tdid' ";
	if($db->query($selcomm) && $db->get_num_rows() > 0) 
	{ $datacomment = $db->fetch_all_assoc(); $trip_comment = $datacomment[0]['trip_remarks']; }
	if($_GET['tripstatus'] == '6') { $allcomment = $trip_comment.'::Pick:: '.$comments;  }
	if($_GET['tripstatus'] == '4') { $allcomment = $trip_comment.'::Drop:: '.$comments;  }
	if($_GET['tripstatus'] == '3') { $allcomment = $trip_comment.'::Cancell:: '.$comments;  }
	if($_GET['tripstatus'] == '7') { $allcomment = $trip_comment.'::Not at Home:: '.$comments;  }
	if($_GET['tripstatus'] == '8') { $allcomment = $trip_comment.'::Not Going:: '.$comments;  }
	$qu = "UPDATE trip_details SET trip_remarks  = '$allcomment'  WHERE tdid = '$tdid'";
	if($db->execute($qu)){} { */
		if($_GET['tripstatus'] == '6') { 
					$paperwork 			= sql_replace($_GET['paperwork']);
					$personal_belonging = sql_replace($_GET['personal_belonging']);
					$medication 		= sql_replace($_GET['medication']);
					$qu1 = "UPDATE trip_details SET paperwork  			= '$paperwork',
													personal_belonging  = '$personal_belonging',
													medication  		= '$medication',
													comments	  		= '$comments'
													WHERE tdid 			= '$tdid'";
					$db->execute($qu1);
					 }
	$qudrst = "UPDATE drivers SET trip_status = '$st',trip_assingment='1'  WHERE drv_code = '$driver_id'";
	$db->execute($qudrst);
	$time_data  = get_server_time();
	$current_time=date("Y-m-d H:i:s");		
	$time 		= $time_data[0];
	switch($_GET['tripstatus']){
	  //Cancelled
	  case '3':
	         $rating = puRating($_GET['tripID'],$time,$_GET['tripID'],3,'Cancelled',$db,$db,$comments);
			break;		
	  //Dropped		
	  case '4':
	        $rating = dropRating($_GET['tripID'],$time,$_GET['tripID'],4,'Dropped',$db,$db,$comments,$endMilage);
			break;	 
      //Picked		
	  case '6':
	  		$rating = puRating($_GET['tripID'],$time,$_GET['tripID'],6,'Picked',$db,$db,$comments,$startMilage);
			break;	  
	  //Not at home		
	  case '7':
		    $rating = puRating($_GET['tripID'],$time,$_GET['tripID'],7,'Not at Home',$db,$db,$comments);	
			break;
	  //Not Going		
	  case '8':
			$rating = puRating($_GET['tripID'],$time,$_GET['tripID'],8,'Not Going',$db,$db,$comments);  
			break;	
	// Arrived		
	  case '10': {
	  if($datacomment[0]['cellalertoption']=='Yes'){
	$message='The driver from Medstar Medical Transport has arrived to pick up '.$datacomment[0]['trip_user'].'.

Thank you for choosing Medstar -we appreciate your business.';	//print_r($data); exit;	
	$client->account->messages->create(array( 
    'To' 	=> "+1".$datacomment[0]['cellalert'],
    'From' 	=> "+14802692931", 
    'Body' 	=> $message));  }
			$query_u = "UPDATE ".TBL_TRIP_DET." SET  status = '10', arrived_time = '$current_time'  Where tdid = '".$_GET['tripID']."'"; 
			$db->execute($query_u);
			
			break; }		
	} 
	$qry_refreshed = "UPDATE ".TBL_CONTACT." SET refresh = '1' WHERE c_id='1' "; $db->execute($qry_refreshed);	
	
	$jsonarray = array();
     $jsonarray['status'] = 'true';
     $jsonarray['userdata'] = 'Status Updated';  return $jsonarray; } 
	 else { $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['userdata'] = 'Failed to Update Status!.'; return $jsonarray; }
	}
//}
function MessageReceived($db)
{  if (isset($_GET['driverID']) && isset($_GET['AdminmessageID'])) {
	$qu = "UPDATE alerts SET recd = '1'  WHERE id = ".$_GET['AdminmessageID']." AND alerts.to = ".$_GET['driverID']." ";
	$db->execute($qu); 
	} }
function addToCurrentTrip($db)
{  if (isset($_GET['driverID']) && isset($_GET['tripID'])) {
	$qu = "UPDATE trip_details SET add_current = '1'  WHERE tdid = ".$_GET['tripID']." AND drv_id = ".$_GET['driverID']." ";
	if($db->execute($qu)) { $jsonarray['status'] = 'true';} else {$jsonarray['status'] = 'false';}
	
	} else { $jsonarray['status'] = 'false'; }
	return $jsonarray;
	}	
function GetMessages($db)
{   $todaydate = date('Y-m-d'); 
	$today=date('Y-m-d');//,strtotime("+1 day"));
	$pday = date("Y-m-d",strtotime("-1 day"));
    if (isset($_GET['driverID'])) {
        $drv_code = $_GET['driverID'];
	 $sql = "SELECT * FROM alerts WHERE sent BETWEEN '".$todaydate." 00:00:00' AND '".$todaydate." 23:59:59' AND alerts.to = '$drv_code' AND recd = '0' ORDER BY id ASC LIMIT 1 "; 
		 if($db->query($sql) && $db->get_num_rows() > 0)
		{ $data = $db->fetch_one_assoc();
			$id = $data['id'];
			$sqll = "UPDATE alerts SET recd = '1' WHERE id = ".$id." ";  	$db->execute($sqll);
						  } 
		 	$QueryCount = "SELECT COUNT(*) AS total FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id  WHERE t.trip_date BETWEEN '$pday' AND '$today' AND td.acknowledge_status IN('0','1') AND td.status IN('2','5','6','9') AND td.drv_id ='$drv_code'";
		if($db->query($QueryCount) && $db->get_num_rows() > 0) { 
		 $datakk= $db->fetch_all_assoc();
		 $jsonarray['total']=$datakk[0]['total']; }	
		if($data){
			$jsonarray['status'] 			= 'true';
			$jsonarray['Adminmessage'] 		= $data['message'];
			$jsonarray['AdminmessageID'] 	= $data['id'];
			$jsonarray['DateTime'] 	= $data['sent']; }  else {$jsonarray['status'] = 'NoMessage';}
			$queryD = "SELECT  * FROM ".TBL_DRIVERS." WHERE drv_code = '".$driverID."'";
			if($db->query($queryD) && $db->get_num_rows() > 0)	{	$dataD = $db->fetch_one_assoc();	 }
			if($dataD){$jsonarray['clockstatus'] 		= $dataD['clockstatus'];}
			return $jsonarray;
			  }
    }  
?>