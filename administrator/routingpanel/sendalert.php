<?php
include_once('sendAPNS.php');
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;
	$db->connect();

   include_once 'gcm.php';
	//$date = date('Y-m-d');
	$message_admin 	= sql_replace($_POST['messag']);
	$driver_code 	= sql_replace($_POST['driver_code']);
$Qsel="SELECT udid FROM drivers WHERE drv_code = '".$driver_code."' ";
if($db->query($Qsel) && $db->get_num_rows()>0){
    $data=$db->fetch_one_assoc();

$Qsel3="SELECT reg_id FROM registered_ids WHERE udid = '".$data['udid']."' ";
if($db->query($Qsel3) && $db->get_num_rows()>0){
    $data3=$db->fetch_one_assoc();
	$regId=$data3['reg_id'];
	//Send Push 
$title="New Message";
$ch = curl_init("https://fcm.googleapis.com/fcm/send");
$header=array('Content-Type: application/json',
"Authorization: key=AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s");//AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"data\": {    \"title\": \"$title\",    \"text\": \"$message_admin\", \"sound\": \"default\"  },    \"to\" : \"$regId\"}");
curl_exec($ch);
curl_close($ch);
//End of push	

}
}
	if(!empty($message_admin) && !empty($driver_code)){
	if($driver_code !='' && $message_admin !=''){
		
		}
	
				 $sql = "INSERT INTO alerts SET 
												alerts.from 	=  'admin',
												alerts.to	 	=  '$driver_code',
												message 		=  '$message_admin',
												sent			= 	NOW(),
												recd			=   '0' "; 
				  $db->execute($sql);
				$parameter = 1;
		sendAPNS($parameter,$driver_code,$message_admin);
		}
	//}
	echo 'send successfulluy!';
	$db->close();	
?> 