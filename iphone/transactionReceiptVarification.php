<?php

// Product Transaction Receipt Verification

if (isset($_POST['TransactionReceipt'])){
$ReceiptData = $_POST['TransactionReceipt'];
$keynamed = "receipt-data";

$json_array = array();
$json_array['receipt-data'] = $ReceiptData;
$appleServer_postData = json_encode($json_array);

//Now post this data to Apple Sever for verification
//https://buy.itunes.apple.com/verifyReceipt
    
    
//$url = "https://buy.itunes.apple.com/verifyReceipt"; //Live mode
$url = "https://sandbox.itunes.apple.com/verifyReceipt"; //Testing mode
$myvars = 'receipt-data=' . $appleServer_postData;       // . '&myvar2=' . $myvar2;

$ch = curl_init($url);
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

//execute post
$response = curl_exec($ch);
//close connection
curl_close($ch);    
//Process the response
$response_array = json_decode($response,true);
if ($response_array['status'] == 0)
    {
     			 $jsonarray = array();
				 $jsonarray['status'] 	= 'true';
				 $jsonarray['response'] 	= $response;
				 $jsonarray['response'] = 'Successfull';
				 echo json_encode($jsonarray);   
        //Receipt verified successfully
    } else {	
			 $jsonarray = array();
				 $jsonarray['status'] 	= 'true';
				 $jsonarray['response'] 	= $response;
				 $jsonarray['response'] = 'Successfull';
				 echo json_encode($jsonarray); 
				 /*$jsonarray = array();
				 $jsonarray['status'] 	= 'false';
				 $jsonarray['response'] 	= $response;
				 $jsonarray['errormessage'] = 'Varification Failed!';
				 echo json_encode($jsonarray);*/
		}


}

?>