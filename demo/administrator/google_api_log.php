<?php 
$type = $_REQUEST['type'];
		try{	$url = 'voice.hybriditservices.com/googleapi.php';
     		   	$clienttoken_post = array('strSource'=> 'RubyMedical','SourceType'=> $type,'apikeyused'=> 'AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw');
           		$curl = curl_init($url);
            	curl_setopt($curl, CURLOPT_POST, true);
           		curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
            	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            	$json_response = curl_exec($curl);
            	curl_close($curl);
			//	$responce = json_decode($json_response, true);
				 return true;
			 }
			catch (Exception $e) { } 
	//google_api_log('Address Populate');

	?>
	
    