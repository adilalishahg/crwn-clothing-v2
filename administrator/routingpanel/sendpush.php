<?php
include_once('sendAPNS.php');
   	include_once('../DBAccess/Database.inc.php');
	include_once('sendAPNS.php');
function sendpush($driver_code,$message_admin,$db){
  	$Qsel="SELECT udid FROM drivers WHERE drv_code = '".$driver_code."' ";
	if($db->query($Qsel) && $db->get_num_rows()>0){
    $data=$db->fetch_one_assoc();
$Qsel3="SELECT reg_id FROM registered_ids WHERE udid = '".$data['udid']."' ";
if($db->query($Qsel3) && $db->get_num_rows()>0){
    $data3=$db->fetch_one_assoc();
	$regId=$data3['reg_id'];
	$url = 'https://android.googleapis.com/gcm/send';
 
$fields = array(
                'registration_ids'  => array($regId),
                'data'              => array( "notification" => $message_admin ),
                );
$headers = array( 
                    'Authorization: key=' . 'AIzaSyCCfPDewLVX4EuCaBIS-d4Rg3yELpycO6I',
                    'Content-Type: application/json'
                );
// Open connection
$ch = curl_init();
 
// Set the url, number of POST vars, POST data
curl_setopt( $ch, CURLOPT_URL, $url );
 
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
 
curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
 
// Execute post
$result = curl_exec($ch);
 
// Close connection
curl_close($ch);
	// $sq = "INSERT INTO log SET log			=   '$result' "; $db->execute($sq);
	}
	}
	if(!empty($message_admin) && !empty($driver_code)){
				 $sql = "INSERT INTO alerts SET 
												alerts.from 	=  'admin',
												alerts.to	 	=  '$driver_code',
												message 		=  '$message_admin',
												sent			= 	NOW(),
												recd			=   '0' "; 
				  $db->execute($sql);
			if($driver_code !='' && $message_admin !=''){
		$parameter = 1;
		sendAPNS($parameter,$driver_code,$message_admin);
		}	}}
?> 