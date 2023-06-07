<?php
   	include_once('../DBAccess/Database.inc.php');
//	include_once('../TextMarksV2APIClient.php');
	include_once('sendAPNS.php');
   $msgs = '';
	$noRec = '';
	$db = new Database;	
	$db->connect();
	$tid = $_POST['tid'];
	$did = $_POST['did'];
	$tdate = $_POST['tdate'];
	$ttime = $_POST['ttime'];
	$current_time=date("Y-m-d H:i:s");
	$acknowledge_status = $_POST['acknowledge_status'];
	$duplicate = $_POST['dup'];
	//CHECK IF EVERY POSTED DATA IS VALID AND SET
	if(!empty($tid)  && !empty($tdate) && !empty($ttime))//&& !empty($did)
	{
		//GET DRIVER DETAILS
		/*$drvQuery1 = "SELECT * FROM ".TBL_DRIVERS." WHERE Drvid='".$_POST['drv']."'";
		if($db->query($drvQuery1) && $db->get_num_rows() > 0){
			$drvdetails = $db->fetch_all_assoc();
		}*/ 
		function get_veh($drv)
			{

				$db = new Database;	

				$db->connect();

				$dQuery = "SELECT Drvid

										FROM ".TBL_DRIVERS."

										WHERE drv_code = '$drv'";

				if($db->query($dQuery) && $db->get_num_rows() > 0)

				{

					$drvs =  $db->fetch_row_assoc(); 

				}

				 $drv_id = $drvs['Drvid'];

				$vQuery = "SELECT  veh_id

										FROM ".TBL_DVMAPPING."

										WHERE  drv_id = '$drv_id'";

				if($db->query($vQuery) && $db->get_num_rows() > 0)

				{

					$vehs =  $db->fetch_row_assoc(); 

				}

				return ($vehs['veh_id'] > 0) ? $vehs['veh_id'] : '0';

			}
		function get_num($drv)
			{

				$db = new Database;	

				$db->connect();

				$dQuery = "SELECT cell_num

										FROM ".TBL_DRIVERS."

										WHERE drv_code = '$drv'";

				if($db->query($dQuery) && $db->get_num_rows() > 0)

				{

					$drvs =  $db->fetch_row_assoc(); 

				}

				$drv_id = $drvs['cell_num'];

				return $drv_id;

			}
		$chkQuery1 = "SELECT * FROM ".TBL_TRIP_DET." WHERE tdid='".$tid."'";
		if($db->query($chkQuery1) && $db->get_num_rows() > 0)
		{ 
			$d1 = $db->fetch_all_assoc(); 
			$pre_drv_id=$d1[0]['drv_id'];
	//		if($pre_drv_id!=''){
				
				$chkQuery2 = "SELECT trip_user,trip_tel FROM trips WHERE trip_id='".$d1[0]['trip_id']."'";
		if($db->query($chkQuery2) && $db->get_num_rows() > 0)
		{ 
			$d2 = $db->fetch_one_assoc(); }
				
				 $message_admin='Please Note: A trip assigned to you has been cancelled and reassigned to another driver by dispatcher. Detail is: Patient name: '.$d2['trip_user'].', Pick Address: '.$d1[0]['pck_add'].' And Drop Address: '.$d1[0]['drp_add'].' ';
	  $driver_code=$d1[0]['drv_id'];
	  $message_admin2='Please Note: A New trip assign to you. Detail is: Patient name: '.$d2['trip_user'].', Pick Address: '.$d1[0]['pck_add'].' And Drop Address: '.$d1[0]['drp_add'].' ';
	  $driver_code=$d1[0]['drv_id'];
	  
	  	  
//   include_once 'gcm.php';
$Qsel="SELECT udid FROM drivers WHERE drv_code = '".$driver_code."' ";
if($db->query($Qsel) && $db->get_num_rows()>0){
    $data=$db->fetch_one_assoc();

$Qsel3="SELECT reg_id FROM registered_ids WHERE udid = '".$data['udid']."' ";
if($db->query($Qsel3) && $db->get_num_rows()>0){
    $data3=$db->fetch_one_assoc();
	$regId=$data3['reg_id'];
	//Send Push 
$title="Trip Cancelled";
$ch = curl_init("https://fcm.googleapis.com/fcm/send");
$header=array('Content-Type: application/json',
"Authorization: key=AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": {    \"title\": \"$title\",    \"text\": \"$message_admin\"  },    \"to\" : \"$regId\"}");
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"data\": {    \"title\": \"$title\",    \"text\": \"$message_admin\", \"sound\": \"default\"  },    \"to\" : \"$regId\"}");

curl_exec($ch);
curl_close($ch);
//End of push	
}
}
//Message to driver on assignment trip
$Qsel2="SELECT udid FROM drivers WHERE drv_code = '".$did."' ";
if($db->query($Qsel2) && $db->get_num_rows()>0){
    $data2=$db->fetch_one_assoc();

$Qsel32="SELECT reg_id FROM registered_ids WHERE udid = '".$data2['udid']."' ";
if($db->query($Qsel32) && $db->get_num_rows()>0){
    $data32=$db->fetch_one_assoc();
	$regId2=$data32['reg_id'];
	//Send Push 
$title="Trip Assigned";
$ch = curl_init("https://fcm.googleapis.com/fcm/send");
$header=array('Content-Type: application/json',
"Authorization: key=AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s");//AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": {    \"title\": \"$title\",    \"text\": \"$message_admin2\"  },    \"to\" : \"$regId2\"}");
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"data\": {    \"title\": \"$title\",    \"text\": \"$message_admin2\", \"sound\": \"default\"  },    \"to\" : \"$regId2\"}");
curl_exec($ch);
curl_close($ch);
//End of push
}
}
	  

	  
	  		
			$sql = "INSERT INTO alerts SET 		alerts.from 	=  'admin',
												alerts.to	 	=  '$did',
												message 		=  '$message_admin2',
												sent			= 	NOW(),
												recd			=   '0' "; 
				  $db->execute($sql);
			//	}
			$vehid = get_veh($did);
			$Query2 = "UPDATE ".TBL_TRIP_DET." SET 
				drv_id = '".$did."',
				tripassign_time = '$current_time',
				duplicate = '".$duplicate."'";
				if($acknowledge_status == '2')
				{ $Query2 .= ",acknowledge_status = '0' "; }
			$Query2 .="  WHERE tdid = '".$tid."'";
				if($db->execute($Query2))
				{ 
						
	$sql = "UPDATE ".TBL_DRIVERS." SET trip_assingment = '1',trip_status= '9' WHERE drv_code = '".$did."' "; 
					$db->execute($sql);
	$sq22 = "SELECT * FROM ".TBL_DRIVERS." WHERE drv_code = '".$did."' AND clockstatus = 'out' "; 
					if($db->query($sq22) && $db->get_num_rows() > 0){ $drdata= $db->fetch_one_assoc(); $yes = "This trip has been assigned to '".$drdata['fname'].' '.$drdata['lname'];}else{$yes = " Assigned";}		//."' but '".$drdata['fname'].' '.$drdata['lname']."' is not Clocked-In"
					
				//ADD DATA TO THE MAPPING LOG TABLE  
		$eQuery = "SELECT * FROM ".TBL_TRIP_DET." as td, ".TBL_TRIPS." as t WHERE td.trip_id=t.trip_id and td.tdid = '$tid'";
					if($db->query($eQuery) && $db->get_num_rows() > 0)
						{
							$to_email = $db->fetch_row_assoc();
						}
					 $to =  get_num($did);



				echo 'Record Updated^1^'.$yes.'^';
				

			//Start ModiVCare Code here
			$get_fro_modiv = "SELECT drv.modiv_id as m_driver_id, drv.fname, drv.lname, drv.license, drv.licenseState, drv.cell_num,t_detail.webhookURL,t_detail.modiv_detail_id as m_detail_id,req.clientname, drv.Drvid FROM ".TBL_TRIP_DET." as t_detail 
	 				LEFT JOIN drivers as drv ON t_detail.drv_id=drv.drv_code 
					LEFT JOIN request_info as req ON t_detail.reqid=req.id Where tdid = '$tid'";
		if($db->query($get_fro_modiv) && $db->get_num_rows())
		{
			$driverdata = $db->fetch_one_assoc();
			if ($driverdata['m_detail_id']!='' && $did !='') {
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
				$event_type='rideScheduled';
				@$ride->eventTime=$eventTime;
				$ride->eventType=$event_type;
				$ride->rideId=$driverdata['m_detail_id'];
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
				if($json_response==200) {} 
			} 
			if ($driverdata['m_detail_id']!='' && $did =='') {
				
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
				$event_type='rideUnscheduled';
				@$ride->eventTime=$eventTime;
				$ride->eventType=$event_type;
				$ride->rideId=$driverdata['m_detail_id'];
				$ride->transportationProviderId=$udata['provider_name'];
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
				if($json_response==200) {}
				
				
				}
		}
		//End ModiVCare Code here				
				sendAPNS(1,$driver_code,$message_admin);	
				$parameter = 1;
				sendAPNS($parameter,$did,$message_admin,$tid);
					//exit;

					/*}else{

					echo 'Unable to update vehicle^fail';

					exit;*/

				}    	

		}else{ 

			//IF THIS DRIVER IS NOT ASSIGNED ANY VEHICLE 

			/*$Query2 = "INSERT INTO ".TBL_DVMAPPING." SET 

					veh_id='".$_POST['veh']."',

					vehname='".$vehdetails[0]['vname']."',					

					veh_numplate='".$_POST['vehnp']."',

					drv_id='".$_POST['drv']."',

					drv_licnum='".$drvdetails[0]['license']."',

					drv_name='".$drvdetails[0]['fname'].' '.$drvdetails[0]['lname']."',

					dv_date=NOW()";	

			if($db->execute($Query2))

			{ */

				//ADD DATA TO THE MAPPING LOG TABLE  

				/*$logQuery =	"INSERT INTO ".TBL_MAPPINGLOG." SET 

					did='".$_POST['drv']."',

					vid='".$_POST['drv']."',

					drvname='".$drvdetails[0]['fname'].' '.$drvdetails[0]['lname']."',

					vnumplate='".$_POST['vehnp']."',

					vname='".$vehdetails[0]['fname']."',

					mapping_date=NOW()";	

					$db2->execute($logQuery);*/

				/*if(!isset($prid) && $prid == '')

					echo 'Record Updated^0';

				else

					echo 'Record Updated^'.$prid; 

				exit;

	

				}else{

					echo 'Unable to assign vehicle^fail';

					exit;			

				}*/

			}

			}else{

			//IF DATA IS NOT POSTED IN DESIRED FORM OR PAGE IS ACCESSSED DIRECTLY

			echo 'Oops! I guess you hit a wrong url';

		}



	$db->close();
?> 