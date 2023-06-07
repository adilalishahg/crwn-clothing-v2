<?php
include_once('DatabaseUS.inc.php');
	ini_set("display_errors","off");
	$db = new Database;	
	$db->connect();
	if(isset($_REQUEST['action']) && isset($_REQUEST['driverID']) && $_REQUEST['action'] == 'updateCurrentUserLocation'){
if (isset($_REQUEST['latitude']) && isset($_REQUEST['longitude'])) {
	$lat 				= sql_replace($_REQUEST['latitude']);
	$long 				= sql_replace($_REQUEST['longitude']);
	$speed 				= sql_replace($_REQUEST['speed']);
	$driverID 			= sql_replace($_REQUEST['driverID']);
	$plat 				= sql_replace($_REQUEST['plat']);
	$plong 				= sql_replace($_REQUEST['plong']);
	$location_method 	= sql_replace($_REQUEST['location_method']);
	$accuracy 			= sql_replace($_REQUEST['accuracy']);
	$direction 			= sql_replace($_REQUEST['direction']);
	//$location_network_status 	= sql_replace($_REQUEST['location_network_status']);
	$last_updated=date("Y-m-d H:i:s");
	$query = "UPDATE drivers SET 	lat 				= '$lat',
					 				longt 				= '$long',
									speed 				= '$speed',
									last_updated 		= '$last_updated',
									plat 				= '$plat',
									plong 				= '$plong',
									location_method 	= '$location_method',
									accuracy			= '$accuracy',
									direction			= '$direction' WHERE drv_code='$driverID' "; 
					$db->execute($query);// echo 'ok'; else echo 'not ok';
}
//Code for ModiVcare data 
$SLDRV="SELECT * FROM drivers WHERE drv_code='$driverID'  ";
	if($db->query($SLDRV) && $db->get_num_rows()> 0) { $driverdata = $db->fetch_one_assoc();
		if($driverdata['modiv_flage']=='1'){
			$Qr="SELECT veh.vin ,veh.vnumber ,veh.licensePlateState,veh.modiv_id as m_vehicle_id,veh.webhookURL FROM vehicles as veh 
						LEFT JOIN dv_mapping dv ON veh.id=dv.veh_id WHERE dv.drv_id='".$driverdata['Drvid']."' ";
						if($db->query($Qr) && $db->get_num_rows())
								{	$vehicleDT = $db->fetch_one_assoc();
								$driverdata['m_vehicle_id']		=	$vehicleDT['m_vehicle_id'];
								$driverdata['vin']				=	$vehicleDT['vin'];
								$driverdata['webhookURL']		=	$vehicleDT['webhookURL'];
								$driverdata['vnumber']			=	$vehicleDT['vnumber'];
								$driverdata['licensePlateState']=	$vehicleDT['licensePlateState']; 
								}
							//	print_r($vehicleDT); exit;
	$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
		    if($db->query($query) && $db->get_num_rows() > 0)
			{ 				$udata = $db->fetch_one_assoc(); 			}
			
			
			}
	
	 }


//  Inserting data for tracking history
//	$qtime = $db->query('SELECT NOW() AS tym');
//	$get = $db->fetch_one_assoc();
//	$currenttime = date('Y-m-d H:i:s');
 $time1 = strtotime(date('Y-m-d H:i:s')); // it is big one
 $query = "SELECT datetime,datetime2 FROM trackinghistory WHERE driver_code = '$driverID' ORDER BY id DESC LIMIT 1 ";
 if($db->query($query) && $db->get_num_rows()> 0) { $timearray = $db->fetch_one_assoc(); }
  $time2 = strtotime($timearray['datetime']);
  $time3 = strtotime($timearray['datetime2']);
if(($time1 - $time2) > 29){
	if($driverdata['modiv_flage']=='1'){
	$queryA = "INSERT  trackinghistory SET lat = '$lat', lang = '$long', datetime='".date('Y-m-d H:i:s')."', datetime2='".$timearray['datetime2']."', driver_code ='$driverID', hsitory_for='30 seconds' "; 
	$db->execute($queryA);
	//echo 'In hy '; exit;
			//To check either driver have have any rider inside the vehicle
		 	$get_fro_modiv = "SELECT status,modiv_detail_id FROM ".TBL_TRIP_DET." Where drv_id = '".$driverdata['drv_code']."' 
								AND date = '".date('Y-m-d')."' AND status IN('13','10','6','12') "; //exit;
					if($db->query($get_fro_modiv) && $db->get_num_rows()>0)
						{	$tripsdata = $db->fetch_all_assoc();	
						
	//					print_r($tripsdata);
//	echo 'In hy '; exit;
			date_default_timezone_set('UTC');
			$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
			date_default_timezone_set('America/New_York');
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
			@$ride->eventTime=$eventTime;
			$ride->eventType='locationReported';
			//$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			
			
				/*@$ride->vehicle->id=$driverdata['m_vehicle_id'];
				$ride->vehicle->vin=$driverdata['vin'];
				$ride->vehicle->licensePlate=$driverdata['vnumber'];
				$ride->vehicle->licensePlateState=$driverdata['licensePlateState'];
				@$ride->driver->id=$driverdata['m_driver_id'];
				$ride->driver->firstName=$driverdata['fname'];
				$ride->driver->lastName=$driverdata['lname'];
				$ride->driver->licenseNumber=$driverdata['license'];
				$ride->driver->licenseState=$driverdata['licenseState'];
				$ride->driver->phoneNumber=$driverdata['cell_num'];	*/			
			$ride->latitude=$driverdata['lat'];
			$ride->longitude=$driverdata['longt'];
			$ride->bearing=$direction;
			$ride->speed=$speed;
			$ride->accuracy=$accuracy;
						
			if($tripsdata){
				for($i=0;$i<sizeof($tripsdata);$i++){
								$ride->rideIds->$tripsdata[$i]['modiv_detail_id']=(object)[]; }
				
				}else{
									$ride->rideIds=(object)[];
					}
			$data_final['ride']=json_encode($ride);
			//echo $data_final['ride']; exit;
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
				if($json_response==200 || $json_response==400) {
					$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
					//$updated = updateTrip($st,$id,$db);
					$event_query = " INSERT INTO tbl_events SET 
					event_type		=    '$event_type',
					eventTime 		=	 '$eventTime',
					latitude		=    '".$driverdata['lat']."',
					longitude		=    '".$driverdata['longt']."',
					modiv_id		=	 '".$driverdata['m_detail_id']."',
					created_time	=	 '".date('Y-m-d H:i')."'";
					$db->execute($event_query);
					$value = "The ". $driverdata['trip_user']. " status change to ".$message_type;
			    	$link="reports/details.php?id=$id&notif_id=";
			   	  	$Query = "INSERT INTO tbl_notifications SET
					module='Ride',
					activity     ='Status',
			        module_id    = '$id',
					link 		 = '$link',
					value 		 = '$value',
					created_date = '".date('Y-m-d H:i')."'";
				  	$db->execute($Query);
			  				} 	
						}
	
	}
	
	
	
	
	}
if(($time1 - $time3) > 299){   //299
	if($driverdata['modiv_flage']=='1'){
	$queryA = "INSERT  trackinghistory SET lat = '$lat', lang = '$long', datetime='".date('Y-m-d H:i:s')."', datetime2='".date('Y-m-d H:i:s')."', driver_code ='$driverID', hsitory_for='300 seconds' "; 
	$db->execute($queryA);
	
	
			//To check either driver have have any rider insode the vehicle
			$riderOnBoard	=	false;
			$get_fro_modiv = "SELECT status FROM ".TBL_TRIP_DET." Where drv_id = '".$driverdata['drv_code']."' AND date = '".date('Y-m-d')."' 
								AND status IN('13','10','6','12') ";
					if($db->query($get_fro_modiv) && $db->get_num_rows())
						{	/*$tripsdata = $db->fetch_one_assoc();*/	$riderOnBoard	=	true; }
			//To check either driver have more riders of the day			
			$get_fro_modiv = "SELECT modiv_detail_id FROM ".TBL_TRIP_DET." Where drv_id = '".$driverdata['drv_code']."' AND date = '".date('Y-m-d')."' 
								AND status IN('13','5','9') ";
					if($db->query($get_fro_modiv) && $db->get_num_rows())
						{	$tripsdata = $db->fetch_all_assoc(); }			
			
			
			
			
			
			date_default_timezone_set('UTC');
			$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
			date_default_timezone_set('America/New_York');
			
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
			@$ride->eventTime=$eventTime;
			$ride->eventType='vehicleLocationReported';
			//$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			
			
				@$ride->vehicle->id=$driverdata['m_vehicle_id'];
				$ride->vehicle->vin=$driverdata['vin'];
				$ride->vehicle->licensePlate=$driverdata['vnumber'];
				$ride->vehicle->licensePlateState=$driverdata['licensePlateState'];
				@$ride->driver->id=$driverdata['m_driver_id'];
				$ride->driver->firstName=$driverdata['fname'];
				$ride->driver->lastName=$driverdata['lname'];
				$ride->driver->licenseNumber=$driverdata['license'];
				$ride->driver->licenseState=$driverdata['licenseState'];
				$ride->driver->phoneNumber=$driverdata['cell_num'];				
			$ride->latitude=$driverdata['lat'];
			$ride->longitude=$driverdata['longt'];
			$ride->riderOnBoard=$riderOnBoard;
			$ride->remainingCapacity->A=true;
			$ride->remainingCapacity->W=false;
			$ride->remainingCapacity->S=false;
			
			if($tripsdata){
				for($i=0;$i<sizeof($tripsdata);$i++){
				$ride->rideIds->$tripsdata[$i]['modiv_detail_id']=(object)[]; }
				}else{
					$ride->rideIds=(object)[];
					}
			$data_final['ride']=json_encode($ride);
			//echo $data_final['ride']; exit;
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
				if($json_response==200 || $json_response==400) {
					$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
					//$updated = updateTrip($st,$id,$db);
					$event_query = " INSERT INTO tbl_events SET 
					event_type		=    '$event_type',
					eventTime 		=	 '$eventTime',
					latitude		=    '".$driverdata['lat']."',
					longitude		=    '".$driverdata['longt']."',
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
 //End of tracking history
  $jsonarray['status'] = 'true';
  } echo json_encode($jsonarray);
$db->close();
?>