<?php
   	include_once('../DBAccess/Database.inc.php');
	$db  = new Database;	
	$db->connect();
   	$id 	= $_REQUEST['id'];
	$atime 	= $_REQUEST['atime'];
	// ModivCare Start
    $json_response=00;
	 /*$get_fro_modiv = "SELECT drv.modiv_id as m_driver_id, drv.fname, drv.lname, drv.license, drv.licenseState, drv.cell_num,t_detail.date,t_detail.webhookURL,t_detail.modiv_detail_id as m_detail_id,req.clientname,veh.modiv_id as m_vehicle_id,veh.vin ,veh.licensePlateState FROM ".TBL_TRIP_DET." as t_detail 
	 LEFT JOIN drivers as drv ON t_detail.drv_id=drv.drv_code 
	 LEFT JOIN request_info as req ON t_detail.reqid=req.id 
	 LEFT JOIN vehicles as veh ON t_detail.veh_id=veh.id Where tdid = '$id'";*/
	 
	 $get_fro_modiv = "SELECT drv.modiv_id as m_driver_id, drv.fname, drv.lname, drv.license, drv.licenseState, drv.Drvid,t_detail.date, drv.cell_num,drv.lat,drv.longt,t_detail.legcharges,t_detail.signature,t_detail.signature2,t_detail.webhookURL,t_detail.modiv_detail_id as m_detail_id,req.clientname,req.billingRequired,t_detail.wc,t_detail.rideInitiated, t_detail.rideInitiated, t_detail.reqid FROM ".TBL_TRIP_DET." as t_detail 
		LEFT JOIN drivers as drv ON t_detail.drv_id=drv.drv_code 
		LEFT JOIN request_info as req ON t_detail.reqid=req.id Where tdid = '$id'";
	 

if($db->query($get_fro_modiv) && $db->get_num_rows())
{
	$driverdata = $db->fetch_one_assoc();

	if($driverdata['m_detail_id']!='' && $driverdata['wc']=='1' && $driverdata['rideInitiated']=='0') {
		
		$Qr="SELECT veh.vin ,veh.vnumber ,veh.licensePlateState,veh.modiv_id as m_vehicle_id FROM vehicles as veh 
						LEFT JOIN dv_mapping dv ON veh.id=dv.veh_id WHERE dv.drv_id='".$driverdata['Drvid']."' ";
						if($db->query($Qr) && $db->get_num_rows())
								{	$vehicleDT = $db->fetch_one_assoc();
								$driverdata['m_vehicle_id']		=	$vehicleDT['m_vehicle_id'];
								$driverdata['vin']				=	$vehicleDT['vin'];
								$driverdata['vnumber']			=	$vehicleDT['vnumber'];
								$driverdata['licensePlateState']=	$vehicleDT['licensePlateState']; 
								}

		date_default_timezone_set('UTC');
		$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
		$scheduledPickupTime=$driverdata['date'].'T'.$atime.':00';//date('H:i:s');
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

		$event_type='rideInitiated';
		@$ride->eventTime=$eventTime;
		$ride->eventType=$event_type;
		$ride->rideId=$driverdata['m_detail_id'];
		$ride->transportationProviderId=$udata['provider_name'];
		@$ride->vehicle->id=$driverdata['m_vehicle_id'];
		$ride->vehicle->vin=$driverdata['vin'];
		$ride->vehicle->licensePlate=$driverdata['licensePlate'];
		$ride->vehicle->licensePlateState=$driverdata['licensePlateState'];
		@$ride->driver->id=$driverdata['m_driver_id'];
		$ride->driver->firstName=$driverdata['fname'];
		$ride->driver->lastName=$driverdata['lname'];
		$ride->driver->licenseNumber=$driverdata['license'];
		$ride->driver->licenseState=$driverdata['licenseState'];
		$ride->driver->phoneNumber=$driverdata['cell_num'];
		$ride->scheduledPickupTime=$scheduledPickupTime;

		$data_final['ride']=json_encode($ride);

		$data_final['event_url']=$webhook_url;
		
		$url='https://api.nemtclouddispatch.com/ride/event_ride/'.$provider_name.'/'.$hybrid_secret;
		$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data_final);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $json_response = curl_exec($curl);
		curl_close($curl);

		if($json_response==200) {
			
			$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
			//$pck_time=date('H:i:s');
			//Changes in trip details
			$qudrst = "UPDATE trip_details SET rideInitiated =  '1', pck_time = '$atime', wc = '0' WHERE tdid = '$id'";
			$db->execute($qudrst);
			//Changes in request_info table
			$qudrst = "UPDATE request_info SET apptime = '$atime' WHERE id = '".$driverdata['reqid']."'";
			$db->execute($qudrst);

			$event_query = " INSERT INTO tbl_events SET 
			event_type		=    '$event_type',
			eventTime 		=	 '$eventTime',
			modiv_id		=	 '".$driverdata['m_detail_id']."',
			created_time	=	 '".date('Y-m-d H:i')."'";
	
			$db->execute($event_query);

			$value = "The ". $driverdata['trip_user']. " status change to ".$message_type;
	    	$link="reports/details.php?id=$id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Ride',
			activity='Status',
	        module_id = '$id',
			link 		= '$link',
			value 		= '$value',
			created_date = '".date('Y-m-d H:i')."'";
		  	$db->execute($Query); 
	  	}
	}
} 
// ModivCare End
	echo "1"; exit();

?>