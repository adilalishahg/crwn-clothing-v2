<?php 
ini_set('max_execution_time', 0);
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect(); 
    if(isset($_POST['add_ride']) && $_POST['add_ride']!='')
  	{ //print_r($_POST); exit;
  	if($_POST['transportationProviderId']=='grecotrans-provider'){
		if($_POST['levelOfServiceDescription']=='Ambulatory Door-Door'){	$_POST['levelOfServiceDescription']='Ambulatory DD';	}
		
		$array= explode('-', $_POST['referenceId']);
		$modiv_id=$array[0].'-'.$array[1].'-'.$array[2];
		$modiv_detail_id=$_POST['modiv_detail_id'];
		//$chkvtype = "SELECT tdid FROM  " . TBL_TRIP_DET . " WHERE modiv_detail_id='$modiv_detail_id'";
		$chkvtype = "SELECT tdid,reqid,trip_id FROM  " . TBL_TRIP_DET . " WHERE modiv_id='".$_POST['referenceId']."'";
		if($db->query($chkvtype) && $db->get_num_rows() > 0)
		{			$tripExistData = $db->fetch_one_assoc();
		  	//$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	 	        //echo json_encode($response);
				//Start of Add request for update one
				
			$date_pck_time=explode('T', $_POST['pk_scheduledTime']);
			$pck_time=explode('+',$date_pck_time[1]);
			$date_drp_time=explode('T', $_POST['dp_scheduledTime']);
			$drp_time=explode('+',$date_drp_time[1]);
			//Logic to convert Pick up time fromat [ UTC time to Estern DST time zone ]
			if(trim($_POST['pk_scheduledTime'])!=''){
			$IST = new DateTime($_POST['pk_scheduledTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			$app_date	=	$IST->format('Y-m-d');
	        $pick_time	=	$IST->format('H:i:s'); }
			$new_scheduledDate=$_POST['scheduledDate'];
					if(trim($_POST['scheduledDate'])=='') {
						$new_scheduledDate=$app_date;		//$date_pck_time[0];
					}		
			
			//Logic to convert Drop off time fromat [ UTC time to Estern DST time zone ]
			/**/if(trim($_POST['dp_scheduledTime'])!=''){
			$IST = new DateTime($_POST['dp_scheduledTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			//$drop_date	=	$IST->format('Y-m-d');
	        $drop_time	=	$IST->format('H:i:s'); }else{$drop_date=$drop_time='';}
			
			//Logic to convert Appointment time fromat [ UTC time to Estern DST time zone ]
			if(trim($_POST['appointmentTime'])!=''){
			$IST = new DateTime($_POST['appointmentTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			$appoinment_time	=	$IST->format('H:i:s'); }else{$appoinment_time='';}
			//$_POST['appointmentTime']
			
			$modiv_created_date=date('Y-m-d H:i');
	  	 	$modiv_detail_id = sql_replace($_POST['modiv_detail_id']);
		  	$pk_data=$_POST['pk_addressLine1'].','.$_POST['pk_addressLine2'].','.$_POST['pk_city'].','.$_POST['pk_state'].','.$_POST['pk_zipCode'];
	  		$dp_data=$_POST['dp_addressLine1'].','.$_POST['dp_addressLine2'].','.$_POST['dp_city'].','.$_POST['dp_state'].','.$_POST['dp_zipCode'];

	  		if($_POST['pk_addressLine2']=='') {
				$pk_data=$_POST['pk_addressLine1'].','.$_POST['pk_city'].','.$_POST['pk_state'].','.$_POST['pk_zipCode'];
			}
	  		if($_POST['dp_addressLine2']=='') {
	  			$dp_data=$_POST['dp_addressLine1'].','.$_POST['dp_city'].','.$_POST['dp_state'].','.$_POST['dp_zipCode'];
	   		}
			$ride_account='';
			$ride_vehicle='';
			$Query = "SELECT id FROM vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='".strtolower(trim(str_replace(' ','',$_POST['levelOfServiceDescription'])))."' ";
			if($db->query($Query) && $db->get_num_rows() > 0)
			{
				$ride_vehicle = $db->fetch_one_assoc()['id']; 
			}
			$Qaccounts  = "SELECT id FROM " . accounts ." WHERE TRIM(LOWER(REPLACE(account_name,' ',''))) IN('logisticcare','logisticare','modivcare') " ;
			if($db->query($Qaccounts) && $db->get_num_rows() > 0) 
			{
				$accounts = $db->fetch_one_assoc();
				$ride_account=$accounts['id'];
			}

			//  Event Start 
				date_default_timezone_set('UTC');
				$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
				date_default_timezone_set('America/New_York');

		    	$json_response=00;
				$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
			    if($db->query($query) && $db->get_num_rows() > 0)
				{
					$udata = $db->fetch_one_assoc();
				}
				$leg_status=14;
				
				$leg_status=9;  // To by pass trip approve process from modivcare As new ducment policy,  rideApprove does not exist
			//	}
			//  Event End

			$leg_type='AB'; 
			$qr = " apptime	='".$pick_time."', ";
			$address_qry = " pickaddr ='".$pk_data."', destination		='".$dp_data."',";

			$wc=0;
			if(trim($_POST['willCall'])=='1'){
			//if ($pck_time[0]=='') {}
				$qr = " apptime	='', ";	
				$wc=1;
				$pick_time='';
			}		//unloaded_miles_a	='".$_POST['billableMiles']."',
			$Query  = "UPDATE ".TBL_FORMS." SET 
			account			='".$ride_account."',
			vehtype			='".$ride_vehicle."',
			miles_string	='".$_POST['billableMiles']."',
			milage			='".$_POST['billableMiles']."',
			charges			='".$_POST['billableAmount']."',
			comments		='".$_POST['tripComments']."',
			triptype		='One Way',
			reqstatus		='approved',
			patient_weight	='".$_POST['weight']."',
			escort			='".$_POST['escorts']."',
			passenger		='".$_POST['attendants']."',
			picklocation	='',
			pickup_instruction		='".$_POST['pk_comments']."',
			p_phnum			='".$_POST['pk_phone']."',
			droplocation	='', 
			destination_instruction	 ='".$_POST['dp_comments']."',
			d_phnum			='".$_POST['dp_phone']."',
			appdate			='".$new_scheduledDate."', 
			$address_qry
			$qr
			org_apptime		='".$appoinment_time."',
			clientname		='".$_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName']."',
			phnum		='".$_POST['phone']."',
			dob		='".$_POST['dateOfBirth']."',
			sex		='".$_POST['gender']."',
			c5	='".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
			c6	='".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
			today_date		='".date('Y-m-d')."',
			modiv_id		='".$modiv_id."',
			 
			linkedRideIds	='".$_POST['linkedRideIds']."',
			transportationProviderId ='".$_POST['transportationProviderId']."',
			scheduledDate	='".$_POST['scheduledDate']."',
			appointmentTime	='".$_POST['appointmentTime']."',
			attendants		='".$_POST['attendants']."',
			escorts			='".$_POST['escorts']."',
			willCall		='".$_POST['willCall']."',
			billableAmount	='".$_POST['billableAmount']."',
			billableMiles	='".$_POST['billableMiles']."',
			assistanceNeeds	='".$_POST['assistanceNeeds']."',
			billingRequired	='".$_POST['billingRequired']."',
			levelOfService	='".$_POST['levelOfService']."',
			levelOfServiceDescription	='".$_POST['levelOfServiceDescription']."',
			levelOfServiceGroup	='".$_POST['levelOfServiceGroup']."',
			unableToSign	='".$_POST['unableToSign']."',
			signatureRequired	='".$_POST['signatureRequired']."',
			condition_ap	='".$_POST['condition_ap']."',
			carseats		='".$_POST['carseats']."',
			copay		='".$_POST['copay']."',
			member_number	='".$_POST['member_number']."',
			ordering_medical_provider_name	='".$_POST['ordering_medical_provider_name']."',
			ordering_medical_provider_npi	='".$_POST['ordering_medical_provider_npi']."',
			prior_auth_num	='".$_POST['prior_auth_num']."',
			passener_rider_id	='".$_POST['passener_rider_id']."',
			rider_id		='".$_POST['rider_id']."',
			rider_firstName	='".$_POST['firstName']."',
			rider_middleName	='".$_POST['middleName']."',
			rider_lastName	='".$_POST['lastName']."',
			rider_dateOfBirth	='".$_POST['dateOfBirth']."',
			rider_gender	='".$_POST['gender']."',
			rider_weight	='".$_POST['weight']."',
			rider_phone		='".$_POST['phone']."',
			pk_addressLine1	='".$_POST['pk_addressLine1']."',
			pk_addressLine2	='".$_POST['pk_addressLine2']."',
			pk_city			='".$_POST['pk_city']."',
			pk_county		='".$_POST['pk_county']."',
			pk_state		='".$_POST['pk_state']."',
			pk_zipCode		='".$_POST['pk_zipCode']."',
			pk_latitude		='".$_POST['pk_latitude']."',
			pk_longitude	='".$_POST['pk_longitude']."',
			pk_scheduledTime	='".$_POST['pk_scheduledTime']."',
			pk_comments 	= '".$_POST['pk_comments']."',
			pk_name 	= '".$_POST['pk_name']."',
			pk_phone	='".$_POST['pk_phone']."',
			pk_ext		='".$_POST['pk_ext']."',
			dp_addressLine1	='".$_POST['dp_addressLine1']."',
			dp_addressLine2	='".$_POST['dp_addressLine2']."',
			dp_city		='".$_POST['dp_city']."',
			dp_county		='".$_POST['dp_county']."',
			dp_state		='".$_POST['dp_state']."',
			dp_zipCode		='".$_POST['dp_zipCode']."',
			dp_latitude		='".$_POST['dp_latitude']."',
			dp_longitude	='".$_POST['dp_longitude']."',
			dp_scheduledTime	='".$_POST['dp_scheduledTime']."',
			dp_comments 	= '".$_POST['dp_comments']."',
			dp_phone		='".$_POST['dp_phone']."',
			dp_name 	= '".$_POST['dp_name']."',
			dp_ext		='".$_POST['dp_ext']."',
			tripComments 	= '".$_POST['tripComments']."',
			webhookURL		='".$_POST['webhookURL']."',
			modiv_flage = '1',
			modiv_created_date = '".date('Y-m-d H:i')."' WHERE referenceId		='".$_POST['referenceId']."' ";

			$trip_user= $_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName'];
			if($db->execute($Query))
		    {
		    	//	$reqsid = mysql_insert_id();  reqid		='$reqsid',
	    		$tQuery = "UPDATE ".TBL_TRIPS." SET 
				modiv_id	='".$modiv_id."',
				trip_code 	= '',
				trip_clinic = '',
				trip_tel 	= '".$_POST['phone']."',
				trip_date 	= '".$new_scheduledDate."',
				trip_user 	= '".str_replace("'"," ",$trip_user)."',
				sheet_id 	= '',
				status 		= '0',
				
				account		='$ride_account',
				trip_miles 	= '".$_POST['billableMiles']."' WHERE trip_id = '".$tripExistData['trip_id']."' ";
				if($db->execute($tQuery))
				{
					//$trip_id = mysql_insert_id();  trip_id 		=     	'$trip_id',  reqid 			= 		'$reqsid',
					$tdQuery = " UPDATE ".TBL_TRIP_DET." SET 
					
					rideId			=		'".$_POST['rideId']."',
					
					veh_id 			= 		'$ride_vehicle',
					date			= 		'".$new_scheduledDate."',
					modiv_detail_id	= 		'".$_POST['modiv_detail_id']."',
					pck_add 		= 		'".sql_replace($pk_data)."',
					pck_time 		= 		'".$pick_time."',
					pck_ptime 		= 		'".$_POST['appointmentTime']."',
					drp_add 		= 		'".sql_replace($dp_data)."',
					drp_time 		= 		'".$drop_time."',
					trip_miles 		= 		'".$_POST['billableMiles']."',								
					type 			= 		'".$leg_type."',
					status 			= 		'".$leg_status."',
					wc 				= 		'".$wc."',
					legcharges 		= 		'".$_POST['billableAmount']."',
					
					pick_latlong	= 		'".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
					drop_latlong	= 		'".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
					pickup_instruction		='".sql_replace($_POST['pk_comments'])."',
					destination_instruction	= '".sql_replace($_POST['dp_comments'])."',
					d_phnum			= 		'".$_POST['dp_phone']."',
					p_phnum			= 		'".$_POST['pk_phone']."',
					webhookURL		=       '".$_POST['webhookURL']."',
					modiv_flage 	= 		'1',
					trip_remarks 	= 		'' WHERE modiv_id		=		'".$_POST['referenceId']."' ";
					if($db->execute($tdQuery))
			    	{    	// include_once('../administrator/requests/invoice_calculation_function.php');
							// invoice_generation($reqsid,$db);		
			    		if($_POST['type']==1)
			    		{
		    			/*$value = "The". $_POST['firstName']." " .$_POST['middleName']." " .$_POST['lastName']." Ride has been updated by ModivCare";
					    	$link="../reqpreview.php?id=$reqsid&notif_id=";
					   	  	$Query = "INSERT INTO tbl_notifications SET
							module='Ride',
							activity='Add',
					        module_id = '$reqsid',
							link 		= '$link',
							value 		= '$value',
							created_date = '$modiv_created_date'";
						  	$db->execute($Query);*/ 
			    			echo 1;
			    			exit();
			    		}
			    	} else {
		    			$response = array('message' =>'Error in adding ride','error' =>true,'success' =>false);
		        		echo json_encode($response);
			 			exit();	
		    		}  
				} else {
					$response = array('message' =>'Error in adding ride','error' =>true,'success' =>false);
		        	echo json_encode($response);
			 		exit();
				}
			} else {
		    	$response = array('message' =>'Error in adding ride','error' =>true,'success' =>false);
		        echo json_encode($response);
			 	exit();		   
			}
		
				//End of Add request for update one
				
		} else {
			$date_pck_time=explode('T', $_POST['pk_scheduledTime']);
			$pck_time=explode('+',$date_pck_time[1]);
			$date_drp_time=explode('T', $_POST['dp_scheduledTime']);
			$drp_time=explode('+',$date_drp_time[1]);
			//Logic to convert Pick up time fromat [ UTC time to Estern DST time zone ]
			if(trim($_POST['pk_scheduledTime'])!=''){
			$IST = new DateTime($_POST['pk_scheduledTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			$app_date	=	$IST->format('Y-m-d');
	        $pick_time	=	$IST->format('H:i:s'); }
			$new_scheduledDate=$_POST['scheduledDate'];
					if(trim($_POST['scheduledDate'])=='') {
						$new_scheduledDate=$app_date;		//$date_pck_time[0];
					}
				
			
			//Logic to convert Drop off time fromat [ UTC time to Estern DST time zone ]
			/**/if(trim($_POST['dp_scheduledTime'])!=''){
			$IST = new DateTime($_POST['dp_scheduledTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			//$drop_date	=	$IST->format('Y-m-d');
	        $drop_time	=	$IST->format('H:i:s'); }else{$drop_date=$drop_time='';}
			
			//Logic to convert Appointment time fromat [ UTC time to Estern DST time zone ]
			if(trim($_POST['appointmentTime'])!=''){
			$IST = new DateTime($_POST['appointmentTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			$appoinment_time	=	$IST->format('H:i:s'); }else{$appoinment_time='';}
			//$_POST['appointmentTime']
			
			$modiv_created_date=date('Y-m-d H:i');
	  	 	$modiv_detail_id = sql_replace($_POST['modiv_detail_id']);
		  	$pk_data=$_POST['pk_addressLine1'].','.$_POST['pk_addressLine2'].','.$_POST['pk_city'].','.$_POST['pk_state'].','.$_POST['pk_zipCode'];
	  		$dp_data=$_POST['dp_addressLine1'].','.$_POST['dp_addressLine2'].','.$_POST['dp_city'].','.$_POST['dp_state'].','.$_POST['dp_zipCode'];

	  		if($_POST['pk_addressLine2']=='') {
				$pk_data=$_POST['pk_addressLine1'].','.$_POST['pk_city'].','.$_POST['pk_state'].','.$_POST['pk_zipCode'];
			}
	  		if($_POST['dp_addressLine2']=='') {
	  			$dp_data=$_POST['dp_addressLine1'].','.$_POST['dp_city'].','.$_POST['dp_state'].','.$_POST['dp_zipCode'];
	   		}
			$ride_account='';
			$ride_vehicle='';
			$Query = "SELECT id FROM vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='".strtolower(trim(str_replace(' ','',$_POST['levelOfServiceDescription'])))."' ";
			if($db->query($Query) && $db->get_num_rows() > 0)
			{
				$ride_vehicle = $db->fetch_one_assoc()['id']; 
			}
			$Qaccounts  = "SELECT id FROM " . accounts ." WHERE TRIM(LOWER(REPLACE(account_name,' ',''))) IN('logisticcare','logisticare','modivcare') " ;
			if($db->query($Qaccounts) && $db->get_num_rows() > 0) 
			{
				$accounts = $db->fetch_one_assoc();
				$ride_account=$accounts['id'];
			}

			//  Event Start 
				date_default_timezone_set('UTC');
				$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
				date_default_timezone_set('America/New_York');

		    	$json_response=00;
				$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
			    if($db->query($query) && $db->get_num_rows() > 0)
				{
					$udata = $db->fetch_one_assoc();
				}
				$leg_status=14;
				
				$leg_status=9;  // To by pass trip approve process from modivcare As new ducment policy,  rideApprove does not exist
			//	}
			//  Event End

			$leg_type='AB'; 
			$qr = " apptime	='".$pick_time."', ";
			$address_qry = " pickaddr ='".$pk_data."', destination		='".$dp_data."',";

			$wc=0;
			if(trim($_POST['willCall'])=='1'){
			//if ($pck_time[0]=='') {}
				$qr = " apptime	='', ";	
				$wc=1;
				$pick_time='';
			}		//unloaded_miles_a	='".$_POST['billableMiles']."',
			$Query  = "INSERT INTO ".TBL_FORMS." SET 
			account			='".$ride_account."',
			vehtype			='".$ride_vehicle."',
			miles_string	='".$_POST['billableMiles']."',
			milage			='".$_POST['billableMiles']."',
			charges			='".$_POST['billableAmount']."',
			comments		='".$_POST['tripComments']."',
			triptype		='One Way',
			reqstatus		='approved',
			patient_weight	='".$_POST['weight']."',
			escort			='".$_POST['escorts']."',
			passenger		='".$_POST['attendants']."',
			picklocation	='',
			pickup_instruction		='".$_POST['pk_comments']."',
			p_phnum			='".$_POST['pk_phone']."',
			droplocation	='', 
			destination_instruction	 ='".$_POST['dp_comments']."',
			d_phnum			='".$_POST['dp_phone']."',
			appdate			='".$new_scheduledDate."', 
			$address_qry
			$qr
			org_apptime		='".$appoinment_time."',
			clientname		='".$_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName']."',
			phnum		='".$_POST['phone']."',
			dob		='".$_POST['dateOfBirth']."',
			sex		='".$_POST['gender']."',
			c5	='".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
			c6	='".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
			today_date		='".date('Y-m-d')."',
			modiv_id		='".$modiv_id."',
			referenceId		='".$_POST['referenceId']."', 
			linkedRideIds	='".$_POST['linkedRideIds']."',
			transportationProviderId ='".$_POST['transportationProviderId']."',
			scheduledDate	='".$_POST['scheduledDate']."',
			appointmentTime	='".$_POST['appointmentTime']."',
			attendants		='".$_POST['attendants']."',
			escorts			='".$_POST['escorts']."',
			willCall		='".$_POST['willCall']."',
			billableAmount	='".$_POST['billableAmount']."',
			billableMiles	='".$_POST['billableMiles']."',
			assistanceNeeds	='".$_POST['assistanceNeeds']."',
			billingRequired	='".$_POST['billingRequired']."',
			levelOfService	='".$_POST['levelOfService']."',
			levelOfServiceDescription	='".$_POST['levelOfServiceDescription']."',
			levelOfServiceGroup	='".$_POST['levelOfServiceGroup']."',
			unableToSign	='".$_POST['unableToSign']."',
			signatureRequired	='".$_POST['signatureRequired']."',
			condition_ap	='".$_POST['condition_ap']."',
			carseats		='".$_POST['carseats']."',
			copay		='".$_POST['copay']."',
			member_number	='".$_POST['member_number']."',
			ordering_medical_provider_name	='".$_POST['ordering_medical_provider_name']."',
			ordering_medical_provider_npi	='".$_POST['ordering_medical_provider_npi']."',
			prior_auth_num	='".$_POST['prior_auth_num']."',
			passener_rider_id	='".$_POST['passener_rider_id']."',
			rider_id		='".$_POST['rider_id']."',
			rider_firstName	='".$_POST['firstName']."',
			rider_middleName	='".$_POST['middleName']."',
			rider_lastName	='".$_POST['lastName']."',
			rider_dateOfBirth	='".$_POST['dateOfBirth']."',
			rider_gender	='".$_POST['gender']."',
			rider_weight	='".$_POST['weight']."',
			rider_phone		='".$_POST['phone']."',
			pk_addressLine1	='".$_POST['pk_addressLine1']."',
			pk_addressLine2	='".$_POST['pk_addressLine2']."',
			pk_city			='".$_POST['pk_city']."',
			pk_county		='".$_POST['pk_county']."',
			pk_state		='".$_POST['pk_state']."',
			pk_zipCode		='".$_POST['pk_zipCode']."',
			pk_latitude		='".$_POST['pk_latitude']."',
			pk_longitude	='".$_POST['pk_longitude']."',
			pk_scheduledTime	='".$_POST['pk_scheduledTime']."',
			pk_comments 	= '".$_POST['pk_comments']."',
			pk_name 	= '".$_POST['pk_name']."',
			pk_phone	='".$_POST['pk_phone']."',
			pk_ext		='".$_POST['pk_ext']."',
			dp_addressLine1	='".$_POST['dp_addressLine1']."',
			dp_addressLine2	='".$_POST['dp_addressLine2']."',
			dp_city		='".$_POST['dp_city']."',
			dp_county		='".$_POST['dp_county']."',
			dp_state		='".$_POST['dp_state']."',
			dp_zipCode		='".$_POST['dp_zipCode']."',
			dp_latitude		='".$_POST['dp_latitude']."',
			dp_longitude	='".$_POST['dp_longitude']."',
			dp_scheduledTime	='".$_POST['dp_scheduledTime']."',
			dp_comments 	= '".$_POST['dp_comments']."',
			dp_phone		='".$_POST['dp_phone']."',
			dp_name 	= '".$_POST['dp_name']."',
			dp_ext		='".$_POST['dp_ext']."',
			tripComments 	= '".$_POST['tripComments']."',
			webhookURL		='".$_POST['webhookURL']."',
			modiv_flage = '1',
			modiv_created_date = '".date('Y-m-d H:i')."'";

			$trip_user= $_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName'];
			if($db->execute($Query))
		    {
		    	$reqsid = mysql_insert_id();
	    		$tQuery = "INSERT INTO ".TBL_TRIPS." SET 
				modiv_id	='".$modiv_id."',
				trip_code 	= '',
				trip_clinic = '',
				trip_tel 	= '".$_POST['phone']."',
				trip_date 	= '".$new_scheduledDate."',
				trip_user 	= '".str_replace("'"," ",$trip_user)."',
				sheet_id 	= '',
				status 		= '0',
				reqid		='$reqsid',
				account		='$ride_account',
				trip_miles 	= '".$_POST['billableMiles']."'";
				if($db->execute($tQuery))
				{
					$trip_id = mysql_insert_id();
					$tdQuery = " INSERT INTO ".TBL_TRIP_DET." SET 
					modiv_id		=		'".$_POST['referenceId']."',
					rideId			=		'".$_POST['rideId']."',
					trip_id 		=     	'$trip_id',
					veh_id 			= 		'$ride_vehicle',
					date			= 		'".$new_scheduledDate."',
					modiv_detail_id	= 		'".$_POST['modiv_detail_id']."',
					pck_add 		= 		'".sql_replace($pk_data)."',
					pck_time 		= 		'".$pick_time."',
					pck_ptime 		= 		'".$_POST['appointmentTime']."',
					drp_add 		= 		'".sql_replace($dp_data)."',
					drp_time 		= 		'".$drop_time."',
					trip_miles 		= 		'".$_POST['billableMiles']."',								
					type 			= 		'".$leg_type."',
					status 			= 		'".$leg_status."',
					wc 				= 		'".$wc."',
					legcharges 		= 		'".$_POST['billableAmount']."',
					reqid 			= 		'$reqsid',
					pick_latlong	= 		'".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
					drop_latlong	= 		'".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
					pickup_instruction		='".sql_replace($_POST['pk_comments'])."',
					destination_instruction	= '".sql_replace($_POST['dp_comments'])."',
					d_phnum			= 		'".$_POST['dp_phone']."',
					p_phnum			= 		'".$_POST['pk_phone']."',
					webhookURL		=       '".$_POST['webhookURL']."',
					modiv_flage 	= 		'1',
					trip_remarks 	= 		''";
					if($db->execute($tdQuery))
			    	{    	 include_once('../administrator/requests/invoice_calculation_function.php');
							 invoice_generation($reqsid,$db);		
			    		if($_POST['type']==1)
			    		{
		    			$value = "The". $_POST['firstName']." " .$_POST['middleName']." " .$_POST['lastName']." Ride has been updated by ModivCare";
					    	$link="../reqpreview.php?id=$reqsid&notif_id=";
					   	  	$Query = "INSERT INTO tbl_notifications SET
							module='Ride',
							activity='Add',
					        module_id = '$reqsid',
							link 		= '$link',
							value 		= '$value',
							created_date = '$modiv_created_date'";
						  	$db->execute($Query); 
			    			echo 1;
			    			exit();
			    		}
			    	} else {
		    			$response = array('message' =>'Error in adding ride','error' =>true,'success' =>false);
		        		echo json_encode($response);
			 			exit();	
		    		}  
				} else {
					$response = array('message' =>'Error in adding ride','error' =>true,'success' =>false);
		        	echo json_encode($response);
			 		exit();
				}
			} else {
		    	$response = array('message' =>'Error in adding ride','error' =>true,'success' =>false);
		        echo json_encode($response);
			 	exit();		   
			}
		}
	}
		//Ambulatory Door-Door	
	} else if(isset($_POST['update_ride']) && $_POST['update_ride']!='') //Update Ride
	 {
		 if($_POST['transportationProviderId']=='grecotrans-provider'){
			 if($_POST['levelOfServiceDescription']=='Ambulatory Door-Door'){	$_POST['levelOfServiceDescription']='Ambulatory DD';	}
		 
		
	  	$referenceId= $_POST['referenceId'];
	  	$array= explode('-', $_POST['referenceId']);
		$modiv_id=$array[0].'-'.$array[1].'-'.$array[2];
		if($_POST['modiv_detail_id']=='') {
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
		
	   // $chkride = "SELECT tdid, reqid, trip_id FROM  " . TBL_TRIP_DET . " WHERE modiv_id='$referenceId' AND modiv_flage=1";
	   // $chkride = "SELECT tdid, reqid, trip_id FROM  " . TBL_TRIP_DET . " WHERE modiv_detail_id='".$_POST['modiv_detail_id']."' AND modiv_flage='1'";
		$chkride = "SELECT tdid, reqid, trip_id FROM  " . TBL_TRIP_DET . " WHERE modiv_detail_id='".$_POST['id']."' AND modiv_flage='1'";
	   	if($db->query($chkride) && $db->get_num_rows() == 0)
		{
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
		//	print_r($_POST); exit;
		$detail_id=$db->fetch_one_assoc();
		$module_id=$detail_id['reqid'];
		$tdid=$detail_id['tdid'];
		$trip_id=$detail_id['trip_id'];
//print_r($detail_id);
		$date_pck_time=explode('T', $_POST['pk_scheduledTime']);
		$pck_time=explode('+',$date_pck_time[1]);
		$date_drp_time=explode('T', $_POST['dp_scheduledTime']);
		$drp_time=explode('+',$date_drp_time[1]);
		//Logic to convert Pick up time fromat [ UTC time to Estern DST time zone ]
		if(trim($_POST['pk_scheduledTime'])!=''){
			$IST = new DateTime($_POST['pk_scheduledTime'], new DateTimeZone('UTC'));
		    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
			$app_date	=	$IST->format('Y-m-d');
	        $pick_time	=	$IST->format('H:i:s'); }
			$new_scheduledDate=$_POST['scheduledDate'];
					if(trim($_POST['scheduledDate'])=='') {
						$new_scheduledDate=$app_date;		//$date_pck_time[0];
					}
			
		//Logic to convert Drop off time fromat [ UTC time to Estern DST time zone ]
		/**/$IST = new DateTime($_POST['dp_scheduledTime'], new DateTimeZone('UTC'));
	    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
		//$drop_date	=	$IST->format('Y-m-d');
        $drop_time	=	$IST->format('H:i:s');
		//Logic to convert Appointment time fromat [ UTC time to Estern DST time zone ]
		$IST = new DateTime($_POST['appointmentTime'], new DateTimeZone('UTC'));
	    $IST->setTimezone(new DateTimeZone('America/New_York'));// With DST
		$appoinment_time	=	$IST->format('H:i:s');

		/*$new_scheduledDate=$_POST['scheduledDate'];
		if(trim($_POST['scheduledDate'])=='') {
			$new_scheduledDate=$app_date;//$date_pck_time[0];
		}*/
		$modiv_created_date=date('Y-m-d H:i');
	  	$pk_data=$_POST['pk_addressLine1'].','.$_POST['pk_addressLine2'].','.$_POST['pk_city'].','.$_POST['pk_state'].','.$_POST['pk_zipCode'];

  		$dp_data=$_POST['dp_addressLine1'].','.$_POST['dp_addressLine2'].','.$_POST['dp_city'].','.$_POST['dp_state'].','.$_POST['dp_zipCode'];

  		if($_POST['pk_addressLine2']=='') {
			$pk_data=$_POST['pk_addressLine1'].','.$_POST['pk_city'].','.$_POST['pk_state'].','.$_POST['pk_zipCode'];
		}
  		if($_POST['dp_addressLine2']=='') {
  			$dp_data=$_POST['dp_addressLine1'].','.$_POST['dp_city'].','.$_POST['dp_state'].','.$_POST['dp_zipCode'];
   		}	
		$ride_account='';
		$ride_vehicle='';
		$Query = "SELECT id FROM vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='".strtolower(trim(str_replace(' ','',$_POST['levelOfServiceDescription'])))."' ";
		if($db->query($Query) && $db->get_num_rows() > 0)
		{
			$ride_vehicle = $db->fetch_one_assoc()['id']; 
		}
		$Qaccounts  = "SELECT id FROM " . accounts ." WHERE TRIM(LOWER(REPLACE(account_name,' ',''))) IN('logisticcare','logisticare','modivcare') " ;
		if($db->query($Qaccounts) && $db->get_num_rows() > 0) 
		{
			$accounts = $db->fetch_one_assoc();
			$ride_account=$accounts['id'];
		}
		$qr = " apptime	='".$pick_time."', ";
		$address_qry = " pickaddr ='".$pk_data."', destination		='".$dp_data."',";

		$wc=0;
		if(trim($_POST['willCall'])=='1'){
		//if ($pck_time[0]=='') {}
			$qr = " apptime	='', ";	
			$wc=1;
			$pick_time='';
		}
			//	unloaded_miles_a	='".$_POST['billableMiles']."',
		$clientname	= $_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName'];
		$Query = "UPDATE " . TBL_FORMS . " SET 
		account		='".$ride_account."',
		vehtype		='".$ride_vehicle."',
		
		miles_string	='".$_POST['billableMiles']."',
		milage		='".$_POST['billableMiles']."',
		charges		='".$_POST['billableAmount']."',
		comments		='".$_POST['tripComments']."',
		patient_weight	='".$_POST['weight']."',
		escort		='".$_POST['escorts']."',
		$address_qry
		passenger		='".$_POST['attendants']."',
		pickup_instruction		='".$_POST['pk_comments']."',
		p_phnum		='".$_POST['pk_phone']."',
		destination_instruction	 ='".$_POST['dp_comments']."',
		d_phnum		='".$_POST['dp_phone']."',
		appdate		='".$new_scheduledDate."', 
		$qr
		org_apptime		='".$appoinment_time."',
		clientname		='".$_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName']."',
		phnum		='".$_POST['phone']."',
		dob		='".$_POST['dateOfBirth']."',
		sex		='".$_POST['gender']."',
		c5	='".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
		c6	='".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
		today_date		='".date('Y-m-d')."',
		referenceId		='".$_POST['referenceId']."', 
		linkedRideIds	='".$_POST['linkedRideIds']."',
		transportationProviderId ='".$_POST['transportationProviderId']."',
		scheduledDate	='".$_POST['scheduledDate']."',
		appointmentTime	='".$_POST['appointmentTime']."',
		attendants		='".$_POST['attendants']."',
		escorts		='".$_POST['escorts']."',
		willCall		='".$_POST['willCall']."',
		billableAmount	='".$_POST['billableAmount']."',
		billableMiles	='".$_POST['billableMiles']."',
		assistanceNeeds	='".$_POST['assistanceNeeds']."',
		billingRequired	='".$_POST['billingRequired']."',
		levelOfService	='".$_POST['levelOfService']."',
		levelOfServiceDescription	='".$_POST['levelOfServiceDescription']."',
		levelOfServiceGroup	='".$_POST['levelOfServiceGroup']."',
		unableToSign	='".$_POST['unableToSign']."',
		signatureRequired	='".$_POST['signatureRequired']."',
		condition_ap	='".$_POST['condition_ap']."',
		carseats		='".$_POST['carseats']."',
		copay		='".$_POST['copay']."',
		member_number	='".$_POST['member_number']."',
		ordering_medical_provider_name	='".$_POST['ordering_medical_provider_name']."',
		ordering_medical_provider_npi	='".$_POST['ordering_medical_provider_npi']."',
		prior_auth_num	='".$_POST['prior_auth_num']."',
		passener_rider_id	='".$_POST['passener_rider_id']."',
		rider_id		='".$_POST['rider_id']."',
		rider_firstName	='".$_POST['firstName']."',
		rider_middleName	='".$_POST['middleName']."',
		rider_lastName	='".$_POST['lastName']."',
		rider_dateOfBirth	='".$_POST['dateOfBirth']."',
		rider_gender	='".$_POST['gender']."',
		rider_weight	='".$_POST['weight']."',
		rider_phone		='".$_POST['phone']."',
		pk_addressLine1	='".$_POST['pk_addressLine1']."',
		pk_addressLine2	='".$_POST['pk_addressLine2']."',
		pk_city		='".$_POST['pk_city']."',
		pk_county		='".$_POST['pk_county']."',
		pk_state		='".$_POST['pk_state']."',
		pk_zipCode		='".$_POST['pk_zipCode']."',
		pk_latitude		='".$_POST['pk_latitude']."',
		pk_longitude	='".$_POST['pk_longitude']."',
		pk_scheduledTime	='".$_POST['pk_scheduledTime']."',
		pk_comments 	= '".$_POST['pk_comments']."',
		pk_name 	= '".$_POST['pk_name']."',
		pk_phone	='".$_POST['pk_phone']."',
		pk_ext		='".$_POST['pk_ext']."',
		dp_addressLine1	='".$_POST['dp_addressLine1']."',
		dp_addressLine2	='".$_POST['dp_addressLine2']."',
		dp_city		='".$_POST['dp_city']."',
		dp_county		='".$_POST['dp_county']."',
		dp_state		='".$_POST['dp_state']."',
		dp_zipCode		='".$_POST['dp_zipCode']."',
		dp_latitude		='".$_POST['dp_latitude']."',
		dp_longitude	='".$_POST['dp_longitude']."',
		dp_scheduledTime	='".$_POST['dp_scheduledTime']."',
		dp_comments 	= '".$_POST['dp_comments']."',
		dp_phone		='".$_POST['dp_phone']."',
		dp_name 	= '".$_POST['dp_name']."',
		dp_ext		='".$_POST['dp_ext']."',
		tripComments 	= '".$_POST['tripComments']."',
		webhookURL		='".$_POST['webhookURL']."',
		modiv_updated_date 	=  '".date('Y-m-d H:i')."',
		modiv_updated = '1' WHERE modiv_flage='1' AND id='".$module_id."' LIMIT 1";

		if($db->execute($Query))
	    {  
    		$tQuery = "UPDATE ".TBL_TRIPS." SET 
			modiv_id	='".$modiv_id."',
			trip_tel 	= '".$_POST['phone']."',
			trip_date 	= '".$new_scheduledDate."',
			trip_user 	= '".str_replace("'"," ",$clientname)."',
			account		='$ride_account',
			trip_miles 	= '".$_POST['billableMiles']."'
			WHERE modiv_id!='' AND trip_id='".$trip_id."' LIMIT 1";
			if($db->execute($tQuery))
			{
				$tdQuery = " UPDATE ".TBL_TRIP_DET." SET 
				veh_id 			= 		'$ride_vehicle',
				date			= 		'".$new_scheduledDate."',
				
				pck_add 		= 		'".sql_replace($pk_data)."',
				pck_time 		= 		'".$pick_time."',
				pck_ptime 		= 		'".$_POST['appointmentTime']."',
				drp_add 		= 		'".sql_replace($dp_data)."',
				drp_time 		= 		'".$drop_time."',
				trip_miles 		= 		'".$_POST['billableMiles']."',								
				wc 				= 		'".$wc."',
				legcharges 		= 		'".$_POST['billableAmount']."',
				pick_latlong	= 		'".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
				drop_latlong	= 		'".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
				pickup_instruction	= 	'".sql_replace($_POST['pk_comments'])."',
				destination_instruction	= '".sql_replace($_POST['dp_comments'])."',
				d_phnum			= 		'".$_POST['dp_phone']."',
				p_phnum			= 		'".$_POST['pk_phone']."',
				webhookURL		=       '".$_POST['webhookURL']."'
				WHERE modiv_flage='1' AND tdid='".$tdid."' LIMIT 1";
				if($db->execute($tdQuery))
		    	{
	    			$value = "The". $_POST['firstName']." " .$_POST['middleName']." " .$_POST['lastName']." Ride has been updated by ModivCare";
			    	$link="../reqpreview.php?id=$module_id&notif_id=";
			   	  	$Query = "INSERT INTO tbl_notifications SET
					module='Ride',
					activity='Update',
			        module_id = '$module_id',
					link 		= '$link',
					value 		= '$value',
					created_date = '".date('Y-m-d H:i')."'";
				  	$db->execute($Query); 
		    		echo 1;
		    		exit();
		    	} else{
	    			$response = array('message' =>'Error in updating ride','error' =>true,'success' =>false);
	        		echo json_encode($response);
		 			exit();	
	    		}  
			} else {
				$response = array('message' =>'Error in updating ride','error' =>true,'success' =>false);
	        	echo json_encode($response);
		 		exit();
			}
		} else {
	    	$response = array('message' =>'Error in updating ride','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();		  
		}
		 }}
	else if(isset($_POST['get_event']) && $_POST['get_event']!='') //////not confiremd from MODIVCARE its working
	{
	 	$modiv_id = sql_replace($_POST['modiv_id']);
	    $chkride = "SELECT * FROM  trip_details WHERE modiv_detail_id='$modiv_id'";
	   	if($db->query($chkride) && $db->get_num_rows() == 0)
		{
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
		$on_query = "SELECT event_id,eventTime,latitude,longitude FROM tbl_events WHERE modiv_id='$modiv_id' AND event_type='onTheWay' ORDER BY event_id DESC LIMIT 1";
		if($db->query($on_query) && $db->get_num_rows())
		{
			$on_way = $db->fetch_one_assoc();
			@$ride->onTheWay->eventTime=$on_way['eventTime'];
			@$ride->onTheWay->latitude=$on_way['latitude'];
			@$ride->onTheWay->longitude=$on_way['longitude'];
		}
		$pick_query = "SELECT event_id,event_type,eventTime,latitude,longitude FROM tbl_events WHERE modiv_id='$modiv_id' AND event_type='pickupArrived' ORDER BY event_id DESC LIMIT 1";
		if($db->query($pick_query) && $db->get_num_rows())
		{
			$pickup_arrive = $db->fetch_one_assoc();
			@$ride->pickupArrive->eventTime=$pickup_arrive['eventTime'];
			@$ride->pickupArrive->latitude=$pickup_arrive['latitude'];
			@$ride->pickupArrive->longitude=$pickup_arrive['longitude'];
		}
		$cancel_query = "SELECT event_id,event_type,eventTime,latitude,longitude FROM tbl_events WHERE modiv_id='$modiv_id' AND event_type='rideCanceled' ORDER BY event_id DESC LIMIT 1";
		if($db->query($cancel_query) && $db->get_num_rows())
		{
			$cancel = $db->fetch_one_assoc();
			@$ride->rideCanceled->eventTime=$cancel['eventTime'];
			@$ride->rideCanceled->latitude=$cancel['latitude'];
			@$ride->rideCanceled->longitude=$cancel['longitude'];
		}
		$completed_query = "SELECT event_id,event_type,eventTime,latitude,longitude FROM tbl_events WHERE modiv_id='$modiv_id' AND event_type='pickupCompleted' ORDER BY event_id DESC LIMIT 1";
		if($db->query($completed_query) && $db->get_num_rows())
		{
			$completed = $db->fetch_one_assoc();
			@$ride->pickupComplete->eventTime=$completed['eventTime'];
			@$ride->pickupComplete->latitude=$completed['latitude'];
			@$ride->pickupComplete->longitude=$completed['longitude'];
		}
		$dropoff_query = "SELECT event_id,event_type,eventTime,latitude,longitude FROM tbl_events WHERE modiv_id='$modiv_id' AND event_type='dropoffArrived' ORDER BY event_id DESC LIMIT 1";
		if($db->query($dropoff_query) && $db->get_num_rows())
		{
			$dropoff = $db->fetch_one_assoc();
			@$ride->dropoffArrive->eventTime=$dropoff['eventTime'];
			@$ride->dropoffArrive->latitude=$dropoff['latitude'];
			@$ride->dropoffArrive->longitude=$dropoff['longitude'];
		}
		$dropoff_complete_query = "SELECT event_id,event_type,eventTime,latitude,longitude FROM tbl_events WHERE modiv_id='$modiv_id' AND event_type='dropoffCompleted' ORDER BY event_id DESC LIMIT 1";
		if($db->query($dropoff_complete_query) && $db->get_num_rows())
		{
			$dropoff_complete = $db->fetch_one_assoc();
			@$ride->dropoffComplete->eventTime=$dropoff_complete['eventTime'];
			@$ride->dropoffComplete->latitude=$dropoff_complete['latitude'];
			@$ride->dropoffComplete->longitude=$dropoff_complete['longitude'];
		}
		$get_fro_modiv = "SELECT drv.modiv_id as m_driver_id,t_detail.legcharges, drv.fname, drv.lname, drv.license,t_detail.signature,t_detail.modiv_detail_id as m_detail_id,veh.modiv_id as m_vehicle_id,veh.vin  FROM ".TBL_TRIP_DET." as t_detail LEFT JOIN drivers as drv ON t_detail.drv_id=drv.drv_code LEFT JOIN vehicles as veh ON t_detail.veh_id=veh.id Where t_detail.modiv_detail_id='$modiv_id'";
		if($db->query($get_fro_modiv) && $db->get_num_rows())
		{
			$driverdata = $db->fetch_one_assoc();
			if ($driverdata['signature']=='') {
				$driverdata['signature']='test.png';		
			}
			@$ride->vehicleId=$driverdata['m_vehicle_id'];
			$ride->vin=$driverdata['vin'];
			@$ride->driverId=$driverdata['m_driver_id'];
			$ride->licenseNumber=$driverdata['license'];
			@$ride->billAmount=$driverdata['legcharges'];
			//$ride->signatureURL='https://gretrans.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature'];
			$ride->signatureURL='https://gretrans.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature'];
			//$path = 'https://gretrans.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature'];
			//$type = pathinfo($path, PATHINFO_EXTENSION);
			//$data = file_get_contents($path);
			//$ride->signature='data:image/' . $type . ';base64,' . base64_encode($data);
		}
		echo $ride=json_encode($ride);
		exit;
	} else if(isset($_POST['cancel_ride']) && $_POST['cancel_ride']!='')
	{
		if($_POST['transportationProviderId']=='grecotrans-provider'){
		
		$modiv_id = sql_replace($_POST['modiv_id']);	
	  	$transportationProviderId = sql_replace($_POST['transportationProviderId']);	
	  	$reason = sql_replace($_POST['reason']);
		$chkvehicle = "SELECT * FROM  " . TBL_TRIP_DET . " WHERE modiv_detail_id='$modiv_id'"; 
		if($db->query($chkvehicle) && $db->get_num_rows() == 0)
		{
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
		$tdQuery  = "UPDATE ".TBL_TRIP_DET." SET cancell_reason ='".$reason."', status ='3' WHERE modiv_detail_id='".$modiv_id."'";
		if($db->execute($tdQuery))
		{
		    $value = "The". $_POST['firstName']." " .$_POST['middleName']." " .$_POST['lastName']." Ride has been updated by ModivCare";
	    	$link="../reqpreview.php?id=$module_id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Ride',
			activity='Add',
	        module_id = '$module_id',
			link 		= '$link',
			value 		= '$value',
			created_date = '".date('Y-m-d H:i')."'";
		  	$db->execute($Query); 
		    echo 1;
		    exit();
		} else {
	    	$response = array('message' =>'Error in cancel ride','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();		  
		}
		}}
?>