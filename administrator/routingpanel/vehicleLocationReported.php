<?php
   	include_once('../DBAccess/Database.inc.php');
	$db  = new Database;	

	$db->connect();
	$pck_time=date('H:i:s'); 

	$get_fro_modiv = "SELECT drv.modiv_id as m_driver_id, drv.fname, drv.lname, drv.license, drv.licenseState, drv.cell_num,drv.plat,drv.plong,t_detail.webhookURL,t_detail.tdid,t_detail.drp_time,t_detail.modiv_detail_id as m_detail_id,req.clientname,veh.modiv_id as m_vehicle_id,veh.vin ,veh.vnumber ,veh.licensePlateState FROM ".TBL_TRIP_DET." as t_detail INNER JOIN drivers as drv ON t_detail.drv_id=drv.drv_code INNER JOIN request_info as req ON t_detail.reqid=req.id INNER JOIN vehicles as veh ON t_detail.veh_id=veh.id Where t_detail.modiv_flage = '1'";

	$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
    if($db->query($query) && $db->get_num_rows() > 0)
	{
		$udata = $db->fetch_one_assoc();
	}

	$provider_name=$udata['provider_name'];
	$hybrid_secret=$udata['hybrid_secret'];
	$event_type='vehicleLocationReported';
	
		date_default_timezone_set('UTC');
		$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
		date_default_timezone_set('America/New_York');

	if($db->query($get_fro_modiv) && $db->get_num_rows())
	{
		$driverdata = $db->fetch_all_assoc();
		for($i=0; $i<count($driverdata); $i++) { 
			if ($driverdata[$i]['m_detail_id']!='') {

				$webhook_url=$driverdata[$i]['webhookURL'];

				@$ride->eventId =get_event(); 
				@$ride->eventTime=$eventTime;
				$ride->eventType=$event_type;
				$ride->transportationProviderId=$udata['provider_name'];
				@$ride->vehicle->id=$driverdata[$i]['m_vehicle_id'];
				$ride->vehicle->vin=$driverdata[$i]['vin'];
				$ride->vehicle->licensePlate=$driverdata[$i]['vnumber'];
				$ride->vehicle->licensePlateState=$driverdata[$i]['licensePlateState'];
				@$ride->driver->id=$driverdata[$i]['m_driver_id'];
				$ride->driver->firstName=$driverdata[$i]['fname'];
				$ride->driver->lastName=$driverdata[$i]['lname'];
				$ride->driver->licenseNumber=$driverdata[$i]['license'];
				$ride->driver->licenseState=$driverdata[$i]['licenseState'];
				$ride->driver->phoneNumber=$driverdata[$i]['cell_num'];
				$ride->latitude=$driverdata[$i]['plat'];
				$ride->longitude=$driverdata[$i]['plong'];
				$ride->riderOnBoard=true;
				@$ride->remainingCapacity->A=true;
				$ride->remainingCapacity->W=false;
				$ride->remainingCapacity->S=false;		

				if ($driverdata[$i]['drp_time']!='00:00:00'){
					  	list($h, $m, $s) = explode(':', $driverdata[$i]['drp_time']);
	  					$pick_eta=($h * 3600) + ($m * 60) + $s;

					@$ride->rideIds->$driverdata[$i]['m_detail_id']->pickupETA=$pick_eta;
				} else {
					@$ride->rideIds->$driverdata[$i]['m_detail_id']=array();
				}
			  	
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

					$eventTime=date('Y-m-d').'T'.date('H:i:s');
					
					$qudrst = "UPDATE trip_details SET pck_time = '$pck_time', wc = '0' WHERE tdid = '$id'";
					$db->execute($qudrst);

					$event_query = " INSERT INTO tbl_events SET 
					event_type		=    '$event_type',
					eventTime 		=	 '$eventTime',
					modiv_id		=	 '".$driverdata[$i]['m_detail_id']."',
					created_time	=	 '".date('Y-m-d H:i')."'";

					$db->execute($event_query);

					$id=$driverdata[$i]['tdid'];

					$value = "The ". $driverdata[$i]['trip_user']. " status change to ".$message_type;
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
	}
 
	function get_event()
	{

		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 34; $i++) {
	    	$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return substr($randomString, 0, 8).'-'.substr($randomString, 8, 4).'-'.substr($randomString, 12, 4).'-'.substr($randomString, 16, 4).'-'.substr($randomString, 20, 12);
	}
?>