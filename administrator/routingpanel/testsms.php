<?php
$key="Fmjtd%7Cluub29ur25%2Crl%3Do5-96z254";
require('../../twilio/Services/Twilio.php'); 
$account_sid = 'ACf1449cf4e1795e14ea66d166fea72772'; 
$auth_token = '56bb8e552c5dc8e2b0a8d383a580fae4'; 
$client = new Services_Twilio($account_sid, $auth_token); 
$message="Test message FROM QST using direct API";

$client->account->messages->create(array( 
    'To' 	=> "+14803077328",  
    'From' 	=> "+14802692931", 
    'Body' 	=> $message, 
    'MediaUrl' => "http://medicaltransportcompany.com/twilio/nemt.png"));  
?> 