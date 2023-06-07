<?php

function sendAPNS($parameter,$driver_code,$message_admin = '', $tripID= '0'){

   	include_once('../DBAccess/Database.inc.php');

	$db = new Database;



	$db->connect();



if($parameter == '1'){



$NotificationType = 'AdminNotification';



$message = ''.$_SESSION['admuser']['admin_name'].' '.$_SESSION['admuser']['admin_lname'];//You Have A New Message From 



$AdminMessage = $message_admin;



$body['NotificationType'] = $NotificationType;



$body['AdminMessage'] = $AdminMessage;
$body['title'] = $message;


$qtime = $db->query('SELECT NOW() AS tym');



$time = $db->fetch_one_assoc();



$body['MessageDateTime'] = date('Y-m-d H:i:s');



}



if($parameter == '2'){



$NotificationType = 'TripNotification';



$message = 'You Have A New Pending Trip';
$body['title'] = $message;


$body['NotificationType'] = $NotificationType;



$body['TripID'] = $tripID;
	}



$qurey = "SELECT device_token,applicationidentifier FROM apns WHERE driver_code = '$driver_code' ";



if($db->query($qurey) && $db->get_num_rows() > 0) {



$data = $db->fetch_one_assoc();	



$deviceToken 			= $data['device_token'];



$applicationidentifier  = $data['applicationidentifier']; 



// Put your device token here (without spaces):



//$deviceToken = 'b74067155debb06a502cbf9052c9bd11ae704582a352e910ada6536d902d03ad';



// Put your private key's passphrase here:



//$passphrase = 'hybrid';



$passphrase = '12345';



// Put your alert message here:



//$message = 'HBM:A new admin Message arrived!';



////////////////////////////////////////////////////////////////////////////////



$ctx = stream_context_create();

stream_context_set_option($ctx,'ssl','local_cert','nemt_secure.pem');

stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);



// Open a connection to the APNS server



$fp = stream_socket_client(



	//'ssl://gateway.sandbox.push.apple.com:2195', $err,



	'ssl://gateway.push.apple.com:2195', $err,



	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);



if (!$fp)



	exit("Failed to connect: $err $errstr" . PHP_EOL);



echo 'Connected to APNS' . PHP_EOL;



// Create the payload body



$body['aps'] = array(



	'alert' => $message,



	'sound' => 'default',

	 'content-available' => 1,

    'badge' => 1



	);



// Encode the payload as JSON



$payload = json_encode($body);



// Build the binary notification



$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;



// Send it to the server



$result = fwrite($fp, $msg, strlen($msg));



if (!$result)



	echo 'Message not delivered' . PHP_EOL;



else



	echo 'Message successfully delivered' . PHP_EOL;



// Close the connection to the server



fclose($fp); 



		}



		}



?> 