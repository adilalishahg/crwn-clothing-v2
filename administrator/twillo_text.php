<?php 
//include_once('../smslog.php');
function twillo_text($message,$sendto){
	include_once('../twilio/Services/Twilio.php');
			$account_sid= 'ACf1449cf4e1795e14ea66d166fea72772'; 
			$auth_token = '56bb8e552c5dc8e2b0a8d383a580fae4'; 
			$client 	= new Services_Twilio($account_sid, $auth_token); 
			$sendalert= preg_replace("/[^0-9]/", "", $sendto);
			//$message='Dear Client, Your trip has been scheduled for date '.$_POST['appdate'].', Trip # '.$tripnumber.'. ';
			try { $client->account->messages->create(array( 
    		'To' 	=> "+1".$sendalert, 
    		'From' 	=> "+14802692931", 
    		'Body' 	=> $message));  
			
			$url = 'https://pax.hybriditservices.com/api/smslog';
     		   $clienttoken_post = array('Number'=> $sendalert,'Message'=> $message,'Source'=> 'Innovative Transport');
           		 $curl = curl_init($url);
            	curl_setopt($curl, CURLOPT_POST, true);
           		curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
            	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            	$json_response = curl_exec($curl);
            	curl_close($curl);
				$responce = json_decode($json_response, true);
			
			 return true;}
			catch (Exception $e) { return false;}
	//smslog($sendalert,$message);
	}
?>