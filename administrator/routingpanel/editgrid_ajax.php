<?php
   	include_once('../DBAccess/Database.inc.php');
    include_once("../Classes/MyMailer.php");
	include_once('sendAPNS.php');
	//include_once('../TextMarksV2APIClient.php');	
	$db  = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id = $_REQUEST['id'];
   $type = $_REQUEST['type'];
	 $time_data = get_server_time();
	 $datime = $time_data[0];	
	 $patime = $time_data[0];	
include_once('rating.php');
 //if page is submitted
if(count($_POST) > 0){
       if(isset($_POST['id']) && isset($_POST['st'])){
		   $id=$_POST['id']; $st=$_POST['st'];
         
		 // ModivCare Start
		$request_id=$_POST['request_id'];
		$json_response=00;
	    $bill_data =0;
		$get_fro_modiv = "SELECT drv.modiv_id as m_driver_id, drv.fname, drv.lname, drv.license, drv.licenseState, drv.Drvid, drv.cell_num,drv.lat,drv.longt,t_detail.legcharges,t_detail.signature,t_detail.signature2,t_detail.webhookURL,t_detail.modiv_detail_id as m_detail_id,req.clientname,req.billingRequired,t_detail.wc,t_detail.rideInitiated FROM ".TBL_TRIP_DET." as t_detail 
		LEFT JOIN drivers as drv ON t_detail.drv_id=drv.drv_code 
		LEFT JOIN request_info as req ON t_detail.reqid=req.id Where tdid = '$id'";
		// 	LEFT JOIN vehicles as veh ON t_detail.veh_id=veh.id //,veh.modiv_id as m_vehicle_id,veh.vin ,veh.vnumber ,veh.licensePlateState
	if($db->query($get_fro_modiv) && $db->get_num_rows())
	{
		$driverdata = $db->fetch_one_assoc();
		if ($driverdata['m_detail_id']!='') {
			
			$Qr="SELECT veh.vin ,veh.vnumber ,veh.licensePlateState,veh.modiv_id as m_vehicle_id FROM vehicles as veh 
						LEFT JOIN dv_mapping dv ON veh.id=dv.veh_id WHERE dv.drv_id='".$driverdata['Drvid']."' ";
						if($db->query($Qr) && $db->get_num_rows())
								{	$vehicleDT = $db->fetch_one_assoc();
								$driverdata['m_vehicle_id']		=	$vehicleDT['m_vehicle_id'];
								$driverdata['vin']				=	$vehicleDT['vin'];
								$driverdata['vnumber']			=	$vehicleDT['vnumber'];
								$driverdata['licensePlateState']=	$vehicleDT['licensePlateState']; 
								}
			
			$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
		    if($db->query($query) && $db->get_num_rows() > 0)
			{ 				$udata = $db->fetch_one_assoc(); 			}
			date_default_timezone_set('UTC');
			$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
			date_default_timezone_set('America/New_York');
				
			
			if ($st==13) {
				//if($driverdata['wc']=='1' && $driverdata['rideInitiated']=='1'){}
				$event_type='onTheWay';
				$message_type='onTheWay';
			} else if ($st==10) {
				$event_type='pickupArrived';
				$message_type='pickup Arrive';
			} else if ($st==6) {
				$event_type='pickupCompleted';
				$message_type='pickup Complete';
			} else if ($st==12) {
				$event_type='dropoffArrived';
				$message_type='dropoff Arrive';
			} else if ($st==4) {
				include_once("../requests/invoice_calculation_function.php");
				invoice_generation($request_id,$db);
				$bill_fro_modiv = "SELECT charges FROM billing_info Where tdid = '$id'";
				if($db->query($bill_fro_modiv) && $db->get_num_rows())
				{
					$bill_data = $db->fetch_one_assoc()['charges'];
				}
				$event_type='dropoffCompleted';
				$message_type='dropoff Complete';
			} else if ($st==3 || $st==7 || $st==8) {
				$bill_fro_modiv = "SELECT charges FROM billing_info Where tdid = '$id'";
				if($db->query($bill_fro_modiv) && $db->get_num_rows())
				{
					$bill_data = $db->fetch_one_assoc()['charges'];
				}
				$event_type='rideCanceled';
				$message_type='Canceled';
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
			@$ride->eventTime=$eventTime;
			$ride->eventType=$event_type;
			$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			if($st==4 && $driverdata['billingRequired']=='1') {
				//@$ride->billAmount=$bill_data;
			}
			if($st==3 || $st==7 || $st==8) {
				//@$ride->billAmount=$bill_data;
				@$ride->reasonCode=4; //Rider cancelled with usfficent notice
			 } else{
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
			}
			if($st==4 || $st==12 || $st==10 || $st==6 || $st==13 || $st==12) {
				$ride->latitude=$driverdata['lat'];
				$ride->longitude=$driverdata['longt'];
			}
			if ($driverdata['signature']=='') {
				$driverdata['signature']='test.png';
			}
			if ($driverdata['signature2']=='') {
				$driverdata['signature2']='test.png';
			}
				if($st==6) {
					$ride->signatureURL=urlencode('https://gretrans.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature']);
					//$path = 'https://city.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature'];
					//$type = pathinfo($path, PATHINFO_EXTENSION);
					//$data = file_get_contents($path);
					//$ride->signature='data:image/' . $type . ';base64,' . urlencode(base64_encode($data));
					//$ride->signature=urlencode($ride->signature);
				}
				if($st==4) {
					$ride->signatureURL=urlencode('https://gretrans.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature2']);
					//$path = 'https://city.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature2'];
					//$type = pathinfo($path, PATHINFO_EXTENSION);
					//$data = file_get_contents($path);
					//$ride->signature='data:image/' . $type . ';base64,' . base64_encode($data);
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
					$updated = updateTrip($st,$id,$db);
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
			  	} else {
						echo "<script>alert('Error occur in trip updating');</script>";
						echo "<script>location.href='grid.php?st=".$st."&ad=0&id=".$sid."';</script>";
						exit;
					}
			} else {
				//	$updated = updateTrip($st,$id,$db);
				}
		}
// ModivCare End
		 
		   $updated = updateTrip($st,$id,$db);
	   //$st  = sql_replace($_POST['status']);
		   if($updated){
		   		if($st == '6'){ $st = '5'; }
				echo "<script>alert('Trip Record has been successfully updated!');</script>";
				echo "<script>location.href='grid.php?st=".$st."&ad=0&id=".$sid."';</script>";	
			/*echo "<script>this.close();</script>";	*/
				exit;	
		   }
       }
     }
//Get Trip Information
function getTripInformation($id,$db){	 
	$db->connect();
	 $Query = "SELECT td.cellalertoption,td.cellalert,td.trip_id, td.date, t.trip_code, t.trip_user, t.trip_clinic,t.trip_clinicemail, t.trip_tel, td.pck_add, td.drp_add, td.pck_time,
	                  td.aptime, td.drp_time, td.drp_atime,td.trip_miles, td.drv_id, td.status, td.pickStatus, 
					  td.trip_remarks FROM trip_details td, trips t  
			   WHERE  t.trip_id=td.trip_id AND td.tdid='$id'";
		 if($db->query($Query) && $db->get_num_rows()){
				  $udata = $db->fetch_one_assoc();
				  }
                  return $udata;}
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
	return ($vehs['veh_id'] > 0) ? $vehs['veh_id'] : '0';        }
//Update Trip Information
function updateTrip($st,$id,$db){
/*$key="Fmjtd%7Cluub29ur25%2Crl%3Do5-96z254";
require('../../twilio/Services/Twilio.php'); 
$account_sid= 'ACf1449cf4e1795e14ea66d166fea72772'; 
$auth_token = '56bb8e552c5dc8e2b0a8d383a580fae4'; 
$client 	= new Services_Twilio($account_sid, $auth_token); */

	$db->connect();
	$data = getTripInformation($id,$db);
		$prop    = 10;
		$current_time=date("Y-m-d H:i:s");
		$drv_id = $data['drv_id'];
		$wcall 	= $data['wc'];
		$tdid = $id;
	   $time_data = get_server_time();		
	   $time = 	$time_data[0];
	   $qudrst = "UPDATE drivers SET trip_status = '$st',trip_assingment='1'  WHERE drv_code = '$drv_id'";
	$db->execute($qudrst);
/*//---------------------- check for pick time ---------------------------------//
			if(isset($post['pu1'])){
				$ptime=$post['pu1'].':00';
				$pck_ptime = date("H:i:s", strtotime("-$prop minutes".$ptime)); 
				$wc = '0';
			}
			else
			{
				$ptime = '00:00:00';
				$pck_ptime = '00:00:00';
				$wc = '1';
			}
		//---------------------- check for drop time ---------------------------------//
			if(isset($post['dt1'])){
				$dtime= $post['dt1'].':00';
				$drp_ptime =  date("H:i:s", strtotime("-$prop minutes".$dtime));
				$wc = '0';
			}
			else{
				$dtime = '00:00:00';
				$drp_ptime = '00:00:00';
				$wc = '1';
			}
		//----------------------------------------------------------------------------------//
		$set = '';
		$type = $post['type'];
		  if($type == '1'){
			   if($aptime == '00:00:00' || $aptime == ''){
				 $aptime = $post['apu1'];
			   }
			   if($adtime == '00:00:00' || $adtime == '' ){
				 $adtime = $post['adt1'];	   
			   }
			   $set = ",aptime = '$aptime', drp_atime='$adtime'";
			   $status = '6';
		 }*/
    	//If Status is In Progress
	switch($st){
	  //Cancelled
	  case '3':
	  $message_admin='Please Note: A trip assign to you has been cancelled by dispatcher. Detail is: Patient name: '.$data['trip_user'].', Pick Address: '.$data['pck_add'].' And Drop Address: '.$data['drp_add'].' ';
	  $driver_code=$data['drv_id'];
   
$Qsel="SELECT udid FROM drivers WHERE drv_code = '".$driver_code."' ";
if($db->query($Qsel) && $db->get_num_rows()>0){
    $data2=$db->fetch_one_assoc();

$Qsel3="SELECT reg_id FROM registered_ids WHERE udid = '".$data2['udid']."' ";
if($db->query($Qsel3) && $db->get_num_rows()>0){
    $data3=$db->fetch_one_assoc();
	$regId=$data3['reg_id'];
	//Send Push 
$title="Trip Cancelled";
$ch = curl_init("https://fcm.googleapis.com/fcm/send");
$header=array('Content-Type: application/json',
"Authorization: key=AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s");//AIzaSyB8xQY8mQm_vGRF1VK-sJ2QIH1gdUqsc1s
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
	  
	  
	  		
			$sql = "INSERT INTO alerts SET 		alerts.from 	=  'admin',
												alerts.to	 	=  '$driver_code',
												message 		=  '$message_admin',
												sent			= 	NOW(),
												recd			=   '0' "; 
			$db->execute($sql);
	        if($wcall == '0'){
	          $rating = puRating($tdid,$time,$drv_id,3,'Cancelled',$db,$db,$t_comments);
			}else{
			    blastEmail($tdid,'Cancelled',$db);
			}
			break;		
	  //Dropped		
	  case '4':
	        $rating = dropRating($id,$time,$drv_id,4,'Dropped',$db,$db,$t_comments);		
			break;	 
      //Picked		
	  case '6':
	        { $rating = puRating($id,$time,$drv_id,6,'Picked',$db,$db,$t_comments);		
			
			$query = "SELECT Drvid FROM ".drivers." WHERE drv_code = '".$drv_id."'  ";
					if($db->query($query) && $db->get_num_rows() > 0)	{	$dataX = $db->fetch_one_assoc();	 
					$query = "SELECT veh_id FROM ".dv_mapping." WHERE drv_id = '".$dataX['Drvid']."'  ";
						if($db->query($query) && $db->get_num_rows() > 0)	{	$data2 = $db->fetch_one_assoc(); 
					$query = "SELECT * FROM vehicles WHERE id = '".$data2['veh_id']."'  ";
							if($db->query($query) && $db->get_num_rows() > 0)	{	$data22 = $db->fetch_one_assoc(); 
					$vehicle_info= 'Vehicle Name: '.$data22['vname'].' <br/> Vin #: '.$data22['vin'].' <br/> Make: '.$data22['vehmake'].' <br/> Model: '.$data22['vehmodel'].' <br/> Vehicle ID: '.$data22['vehicle_id'];
								} } }
							//	print_r($dataX);	print_r($data2); print_r($data22);
					
					$qu1 = "UPDATE trip_details SET vehicle_name 		= '".$data22['vname']."', 
													vehicle_id			= '".$data22['id']."', 
													vehicle_info		= '".$vehicle_info."'
													WHERE tdid 			= '$id'";
					$db->execute($qu1);
			
			
		//	exit;
			}
			break;	  
	  //Not at home		
	  case '7':	
        if($wcall == '0'){	    	  	  
	        $rating = puRating($id,$time,$drv_id,7,'Not at Home',$db,$db,$t_comments);	
			}else{
			   blastEmail($tdid,'Not at Home',$db);
			}	
			break;
	  //Not Going		
	  case '8':
        if($wcall == '0'){	  
	        $rating = puRating($id,$time,$drv_id,8,'Not Going',$db,$db,$t_comments);	
			}else{
			   blastEmail($tdid,'Not Going',$db);
			}	
			break;	
	} 
    //If Reschedule
	if($st == '2'){
	   $reschedule = " status = '".$st."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '', ac_noshowcancell = '$time' ";
	   //Delete Rescheduled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}
	//If Arrived
	if($st == '10'){ 
	$reschedule = " status = '".$st."', arrived_time = '$current_time' ";
	}
	if($st == '12'){ 	$reschedule = " status = '".$st."', arrived_atdrop = '$current_time' ";	
	}
	if($st == '13'){ 	
		$reschedule = " status = '".$st."', enroute_time = '$current_time' ";	}
	
    //If Cancelled
	if($st == '3'){
		   $reschedule = " status = '".$st."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '', ac_noshowcancell = '$time'  ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}
	   //If Not going
	if($st == '8'){
	   $reschedule = " status = '".$st."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '', ac_noshowcancell = '$time' ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}  
	  //If Inprogress
	  	if($st == '5'){
	   $reschedule = " status = '".$st."' ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}  
	   //If Not at home
	if($st == '7'){
	   $reschedule = " status = '".$st."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '', ac_noshowcancell = '$time' ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	} 	
   //If Will call & status is set
	if($wcall == '1'){
	  	if($st == '3' || $st == '7' || $st == '8' ){
	      $reschedule = " status = '".$st."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '', ac_noshowcancell = '$time' ";
	   }
	}    	
	  $query_u = "UPDATE ".TBL_TRIP_DET." SET 
					$reschedule
					Where tdid = '$id'"; 
	if($db->execute($query_u) ){}	
	
///
if($st==3){	sendAPNS(1,$driver_code,$message_admin); }
				   
}	$db->close();
?>