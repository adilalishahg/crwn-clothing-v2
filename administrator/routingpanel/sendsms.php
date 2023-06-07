<?php
   	include_once('../DBAccess/Database.inc.php');
	include_once('../../Classes/mapquest_google_miles.class.php');
	$mile_C = new mapquest_google_miles;
	$db = new Database;	
	$db->connect();
	$current_time = timetoseconds(date('H:i:s')); 
	$str = $current_time -3600;
	$end = $current_time +3601;
	$mlimit = 3;
	$key="Fmjtd%7Cluub29ur25%2Crl%3Do5-96z254";
	require('../../twilio/Services/Twilio.php'); 
$account_sid = 'ACf1449cf4e1795e14ea66d166fea72772'; 
$auth_token = '56bb8e552c5dc8e2b0a8d383a580fae4'; 
$client = new Services_Twilio($account_sid, $auth_token); 
	/*echo $address = str_replace(' ','%20','4065 E Bell Rd,, Phoenix, AZ, United States');
	$json = file_get_contents('http://open.mapquestapi.com/geocoding/v1/address?key='.$key.'&location='.$address);
$jsonArr = json_decode($json, true); print_r($jsonArr);
print_r($jsonArr['results'][0]['locations'][0]['latLng']['lat']); exit;*/
 	 $sQuery = "SELECT t.trip_user, td.tdid,td.pck_add,td.drp_add,td.drop_latlong, td.pick_latlong,td.cellalert, td.smssend, td.trigerfor,td.pck_time, dr.lat,dr.longt FROM ".trip_details." as td
	LEFT JOIN trips as t on td.trip_id=t.trip_id
	LEFT JOIN drivers as dr on td.drv_id=dr.drv_code WHERE td.date = '".date('Y-m-d')."' AND td.type = 'AB' AND td.drv_id !='' AND td.status IN('6','5','10') AND td.cellalertoption = 'Yes' AND td.cellalert !='' AND td.smssend='0' AND TIME_TO_SEC(td.pck_time) BETWEEN $str AND $end "; 
		if($db->query($sQuery) && $db->get_num_rows() > 0)
		{	$trips =  $db->fetch_all_assoc();

		for($i=0;$i<sizeof($trips);$i++){
			if(strlen($trips[$i]['drop_latlong']) < 3 ){ 
			$json = file_get_contents('http://open.mapquestapi.com/geocoding/v1/address?key='.$key.'&location='.str_replace(' ','%20',$trips[$i]['drp_add']));
$jsonArr = json_decode($json, true);
	$dlatlong = $jsonArr['results'][0]['locations'][0]['latLng']['lat'].','.$jsonArr['results'][0]['locations'][0]['latLng']['lng']; //exit;
				if($dlatlong){$Qup="UPDATE ".trip_details." SET drop_latlong = '".$dlatlong."' WHERE tdid= '".$trips[$i]['tdid']."'";
				$db->execute($Qup); }
				 }else{	$dlatlong=($trips[$i]['drop_latlong']); }
			if(strlen($trips[$i]['pick_latlong']) < 3){ 
				$json = file_get_contents('http://open.mapquestapi.com/geocoding/v1/address?key='.$key.'&location='.str_replace(' ','%20',$trips[$i]['pck_add']));
$jsonArr = json_decode($json, true);
$platlong = $jsonArr['results'][0]['locations'][0]['latLng']['lat'].','.$jsonArr['results'][0]['locations'][0]['latLng']['lng'];
			
				if($platlong){$Qup="UPDATE ".trip_details." SET pick_latlong = '".$platlong."' WHERE tdid= '".$trips[$i]['tdid']."'";
				$db->execute($Qup); }
				 }else{	$platlong=($trips[$i]['pick_latlong']); }	
				if($trips[$i]['trigerfor'] == 'pick'){
					 $pdistance= $mile_C->distance_cord($platlong,$trips[$i]['lat'].','.$trips[$i]['longt']); //exit;
					/**/if($pdistance < $mlimit) {
						$message='Pick Up Alert:
Driver is approaching pick up location in approximatly 10 minutes for patient '.$trips[$i]['trip_user'].' scheduled for '.$trips[$i]['pck_time'].' This is an automated message from Medstar Medical Transport.';


// $client->account->messages->create(array( 
//     'To' 	=> "+1".$trips[$i]['cellalert'],  
//     'From' 	=> "+14802692931", 
//     'Body' 	=> $message, 
//     'MediaUrl' => "http://medicaltransportcompany.com/twilio/nemt.png"));  

$Qup="UPDATE ".trip_details." SET smssend = '1' WHERE tdid= '".$trips[$i]['tdid']."'";
				$db->execute($Qup);
						}
					}
				if($trips[$i]['trigerfor'] == 'drop'){
					 $pdistance= $mile_C->distance_cord($dlatlong,$trips[$i]['lat'].','.$trips[$i]['longt']); //exit;
					/**/if($pdistance < $mlimit) {
						$message='Drop-off Alert:
Driver is approaching destination in approximately 10 minutes with onboard patient :  '.$trips[$i]['trip_user'].'  
This is an automated message from Medstar Medical Transport.';

/*require('../../twilio/Services/Twilio.php'); 
$account_sid = 'ACf1449cf4e1795e14ea66d166fea72772'; 
$auth_token = '56bb8e552c5dc8e2b0a8d383a580fae4'; 
$client = new Services_Twilio($account_sid, $auth_token);*/ 
// $client->account->messages->create(array( 
//     'To' 	=> "+1".$trips[$i]['cellalert'], 
//     'From' 	=> "+14802692931", 
//     'Body' 	=> $message, 
//     'MediaUrl' => "http://medicaltransportcompany.com/twilio/nemt.png"));  

$Qup="UPDATE ".trip_details." SET smssend = '1' WHERE tdid= '".$trips[$i]['tdid']."'";
				$db->execute($Qup);
						}
					}	
			} 		}  //echo '<pre/>'; print_r($trips);
?> 