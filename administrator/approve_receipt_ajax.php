<?php 
	include_once('DBAccess/Database.inc.php');
	$db  = new Database;	
	$db->connect();

   	$id = $_REQUEST['id'];
   	$status = $_REQUEST['status'];

	$pck_time=date('H:i:s');

    $json_response=00;
	$get_fro_modiv = "SELECT trip.trip_user, trip_detail.type,trip_detail.reqid, trip_detail.legcharges, trip_detail.webhookURL, trip_detail.modiv_detail_id as m_detail_id FROM ".TBL_TRIP_DET." as trip_detail INNER JOIN trips as trip ON trip_detail.trip_id=trip.trip_id Where tdid = '$id'"; 

if($db->query($get_fro_modiv) && $db->get_num_rows())
{
	$driverdata = $db->fetch_one_assoc();

	if ($driverdata['m_detail_id']!='') {

			date_default_timezone_set('UTC');
			$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
			date_default_timezone_set('America/New_York');

		$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
	    if($db->query($query) && $db->get_num_rows() > 0)
		{
			$udata = $db->fetch_one_assoc();
		}

		$provider_name=$udata['provider_name'];
		$hybrid_secret=$udata['hybrid_secret'];
		$webhook_url=$driverdata['webhookURL'];

		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 34; $i++) {
		    $randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		  
		@$ride->eventId = substr($randomString, 0, 8).'-'.substr($randomString, 8, 4).'-'.substr($randomString, 12, 4).'-'.substr($randomString, 16, 4).'-'.substr($randomString, 20, 12);

		if($status=='time') {
			$pck_time = $_REQUEST['pick_time'];
			$event_type='rideChanged';
			@$ride->eventTime=$eventTime;
			$ride->eventType=$event_type;
			$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			@$ride->scheduledPickupTime=date('Y-m-d').'T'.$pick_time;

		} 
		else if($status=='reject') {
			$st=15;
			$event_type='rideRejected';
			@$ride->eventTime=$eventTime;
			$ride->eventType=$event_type;
			$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			@$ride->reasonCode=1;

		} 
		else if ($status=='approve') {
			$st=9;
			$event_type='rideApproved';
			@$ride->eventTime=$eventTime;
			$ride->eventType=$event_type;
			$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			@$ride->reasonCode=1;
			
		}
		else if ($status=='receipt') {
			$event_type='rideReceipt';

			$bill_fro_modiv = "SELECT charges FROM billing_info Where tdid = '$id'";
			if($db->query($bill_fro_modiv) && $db->get_num_rows())
			{
				$bill_data = $db->fetch_one_assoc()['charges'];
			}
				
			@$ride->eventTime=$eventTime;
			$ride->eventType=$event_type;
			$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			@$ride->billAmount=$bill_data;
		}
		$data_final['ride']=json_encode($ride);
		$data_final['ride'];
		$data_final['event_url']=$webhook_url;
		
		if($event_type=='rideRejected'){
		$url='https://api.nemtclouddispatch.com/ride/event_ride2/'.$provider_name.'/'.$hybrid_secret;}else{
			$url='https://api.nemtclouddispatch.com/ride/event_ride/'.$provider_name.'/'.$hybrid_secret; }

		$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data_final);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $json_response = curl_exec($curl);
		curl_close($curl);
		if($event_type=='rideRejected'){
			if($status=='approve'|| $status=='reject') {
				//print_r($reponse_array); echo '';
				$reponse_array=json_decode($json_response);
				if($reponse_array->Status=='APPROVED'){
		  		$qudrst = "UPDATE trip_details SET status = '$st' WHERE tdid = '$id'";
						$db->execute($qudrst); echo '1'; exit; }
				if($reponse_array->Status=='DENIED'){ echo $reponse_array->Reason; exit;}
		  	
			
			}

			
			}else{

		if($json_response==200) {

			$eventTime=date('Y-m-d').'T'.date('H:i:s');
			
			$event_query = " INSERT INTO tbl_events SET 
			event_type		=    '$event_type',
			eventTime 		=	 '$eventTime',
			modiv_id		=	 '".$driverdata['m_detail_id']."',
			created_time	=	 '".date('Y-m-d H:i')."'";
	
			$db->execute($event_query);

			$value = "The ". $driverdata['trip_user']. " status change to ".$status;
	    	$link="reports/details.php?id=$id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Ride',
			activity='Status',
	        module_id = '$id',
			link 		= '$link',
			value 		= '$value',
			created_date = '".date('Y-m-d H:i')."'";
		  	$db->execute($Query); 

		  	if($status=='approve'|| $status=='reject') {
		  		$qudrst = "UPDATE trip_details SET status = '$st' WHERE tdid = '$id'";
				$db->execute($qudrst);
		  	}
			if($status=='receipt') {
		  		$qudrst = "UPDATE billing_info SET receipt_send_modivcare = '1' WHERE tdid = '$id'";
				$db->execute($qudrst);
		  	}

		  	if($status=='time') {
				if($driverdata['type']=='AB') {		
					$set_req="apptime = '$pck_time'";
				} else {
					$set_req="returnpickup = '$pck_time'";
				}
			
				$reqid = $driverdata['reqid'];

	  			$qudrst = "UPDATE request_info SET $set_req WHERE id = '$reqid'";
	  			$db->execute($qudrst);
	  			$qudrst = "UPDATE trip_details SET pck_time = '$pck_time' WHERE tdid = '$id'";
				$db->execute($qudrst); 
		  	}
	  	echo 1;} }
	} else if($status=='time') {

		echo 'else Time';

			if($driverdata['type']=='AB') {		
				$set_req="apptime = '$pck_time'";
			} else {
				$set_req="returnpickup = '$pck_time'";
			}
			
			$reqid = $driverdata['reqid'];
	  		$qudrst = "UPDATE request_info SET $set_req WHERE id = '$reqid'";
	  		$db->execute($qudrst);
	  		$qudrst = "UPDATE trip_details SET pck_time = '$pck_time' WHERE tdid = '$id'";
			$db->execute($qudrst); 
	}
}
?> 	