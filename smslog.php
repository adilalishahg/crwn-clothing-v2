<?php

function smslog($number,$message,$test='lkjhjkk'){
	
	error_log(" Number : ".$number."  Message : ".$message."\n", 1);
	
	
				/*$url = 'https://voice.hybriditservices.com/bdm/smslog';
     		   $clienttoken_post = array('Number'=> $number,'Message'=> $message,'Source'=> 'Upscale');
           		 $curl = curl_init($url);
            	curl_setopt($curl, CURLOPT_POST, true);
           		curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
            	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            	$json_response = curl_exec($curl);
            	curl_close($curl);
				$responce = json_decode($json_response, true);*/
				//print_r($responce);
}

?>
