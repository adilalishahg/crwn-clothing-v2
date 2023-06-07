<?php
 include_once('includefile.php');

	$current_time=date("H:i:s");
	$end_time 	= date("H:i:s", strtotime("+33 minutes",strtotime($current_time))); 
	
		/*$chkQuery1 = "SELECT td.smssend2,td.tdid,td.pck_time,t.trip_user,t.trip_tel FROM ".TBL_TRIP_DET." as td LEFT JOIN trips as t on td.trip_id=t.trip_id  WHERE td.pck_time BETWEEN '".$current_time."' AND '".$end_time."' AND date = '".date('Y-m-d')."' AND td.smssend2='0' AND td.wc='0' ORDER BY td.pck_time ASC LIMIT 10";
		if($db->query($chkQuery1) && $db->get_num_rows() > 0)
		{ 
			$trips = $db->fetch_all_assoc(); 
				
			
	//	echo '<pre>';	print_r($trips);	exit;
			
			require_once('twilio/Services/Twilio.php'); 
			//require_once('../../smslog.php'); 
			$account_sid= 'AC2358363082f0f8a087886c66e56d2009'; 
			$auth_token = '712f4ff1eaa3f70635b128674e9c155f'; 
			$client 	= new Services_Twilio($account_sid, $auth_token); 
 			
			for ($i = 0;$i<sizeof($trips);$i++){
					if($trips[$i]['smssend2']=='0'){
			
			$sendalert= preg_replace("/[^0-9]/", "", $trips[$i]['trip_tel']);
			$message='Dear '.$trips[$i]['trip_user'].', your Driver is on way.';// on '.$udata['title'].".";
			try { $res = $client->account->messages->create(array( 
    		'To' 	=> "+1".$sendalert, 
    		'From' 	=> "+16692912860", 
    		'Body' 	=> $message));   //smslog($sendalert,$message,'Upscale');
			$file = date('Ym').'messagesinfo.txt';
			 $current = file_get_contents($file);
			 $current .= date('m-d-Y H:i:s')." Number: ".$sendalert." Message: ".$message."\n";
				file_put_contents($file, $current);				
				
				$Query2 = "UPDATE ".TBL_TRIP_DET." SET 	smssend2 = '1' WHERE tdid = '".$trips[$i]['tdid']."'";
				$db->execute($Query2);
				
				}
			catch (Exception $e) {  $er='Message not sent';  //smslog($sendalert,$message,'Upscale');
			$file = date('Ym').'messagesinfo.txt';
			$current = file_get_contents($file);
			$current .= date('m-d-Y H:i:s')." Number: ".$er." Message: ".$e."\n";
			file_put_contents($file, $current);
			}
			
			 
					}	
	
				}
		}*/
	$db->close();
			 $file = date('Ym').'messagesinfo.txt';
			 $current = file_get_contents($file);
			 $current .= date('m-d-Y H:i:s')." Cron job executed successfully. \n";
			 file_put_contents($file, $current);		
?> 