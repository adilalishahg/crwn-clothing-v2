<?php 
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect(); 
    if(isset($_POST['add_ride']) && $_POST['add_ride']!='')
  	{
  		$array= explode('-', $_POST['referenceId']);
		$modiv_id=$array[0].'-'.$array[1].'-'.$array[2];
		 $modiv_detail_id=$_POST['modiv_detail_id'];
		 //$chkvtype = "SELECT * FROM  " . TBL_FORMS . " WHERE modiv_id='$modiv_id'";
		$chkvtype = "SELECT * FROM  " . TBL_TRIP_DET . " WHERE modiv_detail_id='$modiv_detail_id'";
		 if($db->query($chkvtype) && $db->get_num_rows() > 0)
		 {
		  	//$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	 	        //echo json_encode($response);
		 } else {
  	 	// $chkvtype = "SELECT * FROM  " . TBL_FORMS . " WHERE modiv_id='$modiv_id'";
		// if($db->query($chkvtype) && $db->get_num_rows() > 0)
		// {
		//  	$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	 	//        echo json_encode($response);
		//  	exit(); 
		// }
		$date_pck_time=explode('T', $_POST['pk_scheduledTime']);
		$pck_time=explode('+',$date_pck_time[1]);
		$date_drp_time=explode('T', $_POST['dp_scheduledTime']);
		$drp_time=explode('+',$date_drp_time[1]);
		$wc=0;
		if ($pck_time[0]=='') {
			$wc=1;
		}
		$new_scheduledDate=$_POST['scheduledDate'];
		if(trim($_POST['scheduledDate'])=='') {
			$new_scheduledDate=$date_pck_time[0];
		}
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
		$Qaccounts  = "SELECT id FROM " . accounts ." WHERE TRIM(LOWER(account_name))='".strtolower(trim('Logistic Care'))."' " ;
		if($db->query($Qaccounts) && $db->get_num_rows() > 0) 
		{
			$accounts = $db->fetch_one_assoc();
			$ride_account=$accounts['id'];
		}
		$leg_type='AB';
		if($array[3]=='B') {
			$leg_type='BF';
		}
    		$select_trip="SELECT trip_id,reqid FROM trips WHERE modiv_id = '".$modiv_id."' LIMIT 1 ";
			if($db->query($select_trip) && $db->get_num_rows() > 0)	{
				$trip_data = $db->fetch_one_assoc();
				$trip_id=$trip_data['trip_id'];
				$reqid=$trip_data['reqid'];
				$trip_date_update="UPDATE trips SET trip_date = '".$new_scheduledDate."' WHERE trip_id = '".$trip_id."'";
				if($db->execute($trip_date_update))
				{
				 	$two_way_update="UPDATE ".TBL_FORMS." SET miles_string = CONCAT(miles_string, ',".$_POST['billableMiles']."'), charges = charges + '".$_POST['billableAmount']."' , appdate = '".$new_scheduledDate."', backto = '".$dp_data."', triptype = 'Round Trip' WHERE id = '".$reqid."'";
					if($db->execute($two_way_update))
					{
						$two_way_detail = " INSERT INTO ".TBL_TRIP_DET." SET 
						modiv_id		='".$modiv_id."',
						drv_id 			=		'',
						assign_type		=		'',
						trip_id 		=     	'$trip_id',
						veh_id 			= 		'$ride_vehicle',
						date			= 		'".$new_scheduledDate."',
						modiv_detail_id	= 		'".$_POST['modiv_detail_id']."',
						pck_add 		= 		'".sql_replace($pk_data)."',
						pck_time 		= 		'".$pck_time[0]."',
						pck_ptime 		= 		'".$_POST['appointmentTime']."',
						pck_atime 		= 		'',
						drp_add 		= 		'".sql_replace($dp_data)."',
						drp_time 		= 		'".$drp_time[0]."',
						drp_ptime 		= 		'',
						drp_atime 		= 		'',
						trip_miles 		= 		'".$_POST['billableMiles']."',
						trip_miles2		= 		'',
						total	 		= 		'',									
						type 			= 		'".$leg_type."',
						status 			= 		'14',
						wc 				= 		'".$wc."',
						clinic	 		= 		'',
						legcharges 		= 		'".$_POST['billableAmount']."',
						reqid 			= 		'$reqid',
						pick_latlong	= 		'".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
						drop_latlong	= 		'".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
						picklocation	=		'',
						droplocation	=		'',
						pickup_instruction	= 	'".sql_replace($_POST['pk_comments'])."',
						destination_instruction	= 	'".sql_replace($_POST['dp_comments'])."',
						d_phnum			= 		'".$_POST['dp_phone']."',
						p_phnum			= 		'".$_POST['pk_phone']."',
						webhookURL		=       '".$_POST['webhookURL']."',
						modiv_flage 	=       '1',
						ccode			= 		'',
						legid			= 		'',
						unloaded_miles	=		'',
						cellalertoption	=		'',
						cellalert		=		'',
						trip_remarks 	= 		''";
						if($db->execute($two_way_detail))
						{
		    				$value = "The". $_POST['firstName']." " .$_POST['middleName']." " .$_POST['lastName']." Ride has been added by ModivCare";
					    	$link="../reqpreview.php?id=$reqid&notif_id=";
					   	  	$Query = "INSERT INTO tbl_notifications SET
							module='Ride',
							activity='Add',
					        module_id = '$reqid',
							link 		= '$link',
							value 		= '$value',
							created_date = '$modiv_created_date'";
						  	$db->execute($Query); 
							echo 1;
				    		exit();
				    	}
					}
				}
 			}
		$Query  = "INSERT INTO ".TBL_FORMS." SET 
		account		='".$ride_account."',
		vehtype		='".$ride_vehicle."',
		unloaded_miles_a	='".$_POST['billableMiles']."',
		miles_string	='".$_POST['billableMiles']."',
		milage		='".$_POST['billableMiles']."',
		charges		='".$_POST['billableAmount']."',
		comments		='".$_POST['tripComments']."',
		triptype		='One Way',
		reqstatus		='approved',
		patient_weight	='".$_POST['weight']."',
		escort		='".$_POST['escorts']."',
		passenger		='".$_POST['attendants']."',
		picklocation	='',
		pickaddr		='".$pk_data."',
		pickup_instruction		='".$_POST['pk_comments']."',
		p_phnum		='".$_POST['pk_phone']."',
		droplocation	='', 
		destination_instruction	 ='".$_POST['dp_comments']."',
		destination		='".$dp_data."',
		d_phnum		='".$_POST['dp_phone']."',
		appdate		='".$new_scheduledDate."',
		apptime	 ='".$pck_time[0]."',
		org_apptime		='".$_POST['appointmentTime']."',
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
				modiv_id		='".$modiv_id."',
				drv_id 			=		'',
				assign_type		=		'',
				trip_id 		=     	'$trip_id',
				veh_id 			= 		'$ride_vehicle',
				date			= 		'".$new_scheduledDate."',
				modiv_detail_id	= 		'".$_POST['modiv_detail_id']."',
				pck_add 		= 		'".sql_replace($pk_data)."',
				pck_time 		= 		'".$pck_time[0]."',
				pck_ptime 		= 		'".$_POST['appointmentTime']."',
				pck_atime 		= 		'',
				drp_add 		= 		'".sql_replace($dp_data)."',
				drp_time 		= 		'".$drp_time[0]."',
				drp_ptime 		= 		'',
				drp_atime 		= 		'',
				trip_miles 		= 		'".$_POST['billableMiles']."',
				trip_miles2		= 		'',
				total	 		= 		'',									
				type 			= 		'".$leg_type."',
				status 			= 		'14',
				wc 				= 		'".$wc."',
				clinic	 		= 		'',
				legcharges 		= 		'".$_POST['billableAmount']."',
				reqid 			= 		'$reqsid',
				pick_latlong	= 		'".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
				drop_latlong	= 		'".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
				picklocation	=		'',
				droplocation	=		'',
				pickup_instruction	= 	'".sql_replace($_POST['pk_comments'])."',
				destination_instruction	= '".sql_replace($_POST['dp_comments'])."',
				d_phnum			= 		'".$_POST['dp_phone']."',
				p_phnum			= 		'".$_POST['pk_phone']."',
				webhookURL		=       '".$_POST['webhookURL']."',
				modiv_flage = '1',
				ccode			= 		'',
				legid			= 		'',
				unloaded_miles	=		'',
				cellalertoption	=		'',
				cellalert		=		'',
				trip_remarks 	= 		''";
				if($db->execute($tdQuery))
		    	{    	
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
	} else if(isset($_POST['update_ride']) && $_POST['update_ride']!='') //Update Ride
	 {
	 	$modiv_id = sql_replace($_POST['modiv_id']);
	    $chkride = "SELECT * FROM  " . TBL_FORMS . " WHERE modiv_id='$modiv_id'";
	   	if($db->query($chkride) && $db->get_num_rows() == 0)
		{
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
		$module_id=$db->fetch_one_assoc()['id'];
	  	//$array= explode('-', $_POST['referenceId']);
		//$modiv_id=$array[0].'-'.$array[1].'-'.$array[2];
  	 	// $chkvtype = "SELECT * FROM  " . TBL_FORMS . " WHERE modiv_id='$modiv_id'";
		// if($db->query($chkvtype) && $db->get_num_rows() > 0)
		// {
		//  	$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	 	//        echo json_encode($response);
		//  	exit(); 
		// }
		$date_pck_time=explode('T', $_POST['pk_scheduledTime']);
		$pck_time=explode('+',$date_pck_time[1]);
		$date_drp_time=explode('T', $_POST['dp_scheduledTime']);
		$drp_time=explode('+',$date_drp_time[1]);
		$wc=0;
		if ($pck_time[0]=='') {
			$wc=1;
		}
		$new_scheduledDate=$_POST['scheduledDate'];
		if(trim($_POST['scheduledDate'])=='') {
			$new_scheduledDate=$date_pck_time[0];
		}
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
		$Qaccounts  = "SELECT id FROM " . accounts ." WHERE TRIM(LOWER(account_name))='".strtolower(trim('Logistic Care'))."' " ;
		if($db->query($Qaccounts) && $db->get_num_rows() > 0) 
		{
			$accounts = $db->fetch_one_assoc();
			$ride_account=$accounts['id'];
		}
		$leg_type='AB'; 
		if($array[3]=='B') {
			$leg_type='BF';
		}
		$clientname	= $_POST['firstName'].' '.$_POST['middleName'].' '.$_POST['lastName'];
		$Query = "UPDATE " . TBL_FORMS . " SET 
		account		='".$ride_account."',
		vehtype		='".$ride_vehicle."',
		miles_string	='".$_POST['billableMiles']."',
		milage		='".$_POST['billableMiles']."',
		charges		='".$_POST['billableAmount']."',
		comments	='".str_replace("'"," ",$_POST['tripComments'])."',
		triptype		='One Way',
		patient_weight	='".$_POST['weight']."',
		escort		='".$_POST['escorts']."',
		passenger		='".$_POST['attendants']."',
		picklocation	='',
		pickaddr		='".$pk_data."',
		pickup_instruction	='".str_replace("'"," ",$_POST['pk_comments'])."',
		p_phnum		='".$_POST['pk_phone']."',
		droplocation	='', 
		destination_instruction	='".str_replace("'"," ",$_POST['dp_comments'])."',
		destination	='".str_replace("'"," ",$dp_data)."',
		d_phnum		='".$_POST['dp_phone']."',
		appdate		='".$_POST['scheduledDate']."',
		apptime	 ='".explode('+',explode('T', $_POST['pk_scheduledTime'])[1])[0]."',
		org_apptime		='".$_POST['appointmentTime']."',
		clientname	='".str_replace("'"," ",$clientname)."',
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
		assistanceNeeds	='".json_encode($_POST['assistanceNeeds'])."', 
		billingRequired	='".$_POST['billingRequired']."',
		levelOfService	='".$_POST['levelOfService']."',
		levelOfServiceDescription	='".$_POST['levelOfServiceDescription']."',
		levelOfServiceGroup	='".$_POST['levelOfServiceGroup']."',
		unableToSign	='".$_POST['unableToSign']."',
		signatureRequired	='".$_POST['signatureRequired']."',
		condition_ap	='".$_POST['condition_ap']."',
		carseats		='".$_POST['carseats']."',
		copay			='".$_POST['copay']."',
		member_number	='".$_POST['member_number']."',
		ordering_medical_provider_name	='".$_POST['ordering_medical_provider_name']."',
		ordering_medical_provider_npi	='".$_POST['ordering_medical_provider_npi']."',
		prior_auth_num	='".$_POST['prior_auth_num']."',
		passener_rider_id	='".$_POST['passener_rider_id']."',
		rider_id		='".$_POST['rider_id']."',
		rider_firstName	='".str_replace("'"," ",$_POST['firstName'])."',
		rider_middleName	='".str_replace("'"," ",$_POST['middleName'])."',
		rider_lastName	='".str_replace("'"," ",$_POST['lastName'])."',
		rider_dateOfBirth	='".$_POST['dateOfBirth']."',
		rider_gender	='".$_POST['gender']."',
		rider_weight	='".$_POST['weight']."',
		rider_phone		='".$_POST['phone']."',
		pk_addressLine1	='".str_replace("'"," ",$_POST['pk_addressLine1'])."',
		pk_addressLine2	='".str_replace("'"," ",$_POST['pk_addressLine2'])."',
		pk_city		='".$_POST['pk_city']."',
		pk_county		='".$_POST['pk_county']."',
		pk_state		='".$_POST['pk_state']."',
		pk_zipCode		='".$_POST['pk_zipCode']."',
		pk_latitude		='".$_POST['pk_latitude']."',
		pk_longitude	='".$_POST['pk_longitude']."',
		pk_scheduledTime	='".$_POST['pk_scheduledTime']."',
		pk_comments	='".str_replace("'"," ",$_POST['pk_comments'])."',
		pk_name	='".str_replace("'"," ",$_POST['pk_name'])."',
		pk_phone		='".$_POST['pk_phone']."',
		pk_ext		='".$_POST['pk_ext']."',
		dp_addressLine1	='".str_replace("'"," ",$_POST['dp_addressLine1'])."',
		dp_addressLine2	='".str_replace("'"," ",$_POST['dp_addressLine2'])."',
		dp_city		='".$_POST['dp_city']."',
		dp_county		='".$_POST['dp_county']."',
		dp_state		='".$_POST['dp_state']."',
		dp_zipCode		='".$_POST['dp_zipCode']."',
		dp_latitude		='".$_POST['dp_latitude']."',
		dp_longitude	='".$_POST['dp_longitude']."',
		dp_scheduledTime	='".$_POST['dp_scheduledTime']."',
		dp_comments	='".str_replace("'"," ",$_POST['dp_comments'])."',
		dp_phone		='".$_POST['dp_phone']."',
		dp_name		='".$_POST['dp_name']."',
		dp_ext		='".$_POST['dp_ext']."',
		tripComments	='".str_replace("'"," ",$_POST['tripComments'])."',
		webhookURL		='".$_POST['webhookURL']."',
		modiv_updated_date 	=  '".date('Y-m-d H:i')."',
		modiv_updated = '1' WHERE modiv_id='".$modiv_id."'";
		if($db->execute($Query))
	    {  
    		$tQuery = "UPDATE ".TBL_TRIPS." SET 
			trip_code 	= '',
			trip_clinic = '',
			trip_user 	= '',
			trip_tel 	= '".$_POST['phone']."',
			trip_date 	= '".$_POST['scheduledDate']."',
			sheet_id 	= '',
			status 		= '0',
			account		='$ride_account',
			trip_miles 	= '".$_POST['billableMiles']."'
			WHERE modiv_id='".$modiv_id."'";
			if($db->execute($tQuery))
			{
				$tdQuery = " UPDATE ".TBL_TRIP_DET." SET 
				drv_id 			=		'',
				assign_type		=		'',
				veh_id 			= 		'$ride_vehicle',
				date			= 		'".$_POST['scheduledDate']."',
				pck_add 		= 		'".sql_replace($pk_data)."',
				pck_time 		= 		'".explode('+',explode('T', $_POST['pk_scheduledTime'])[1])[0]."',
				pck_ptime 		= 		'".$_POST['appointmentTime']."',
				pck_atime 		= 		'',
				drp_add 		= 		'".sql_replace($dp_data)."',
				drp_time 		= 		'".explode('+',explode('T', $_POST['dp_scheduledTime'])[1])[0]."',
				drp_ptime 		= 		'',
				drp_atime 		= 		'',
				trip_miles 		= 		'".$_POST['billableMiles']."',
				trip_miles2		= 		'',
				total	 		= 		'',									
				type 			= 		'AB',
				wc 				= 		'0',
				status			=  		'9',
				clinic	 		= 		'',
				legcharges 		= 		'".$_POST['billableAmount']."',
				pick_latlong	= 		'".$_POST['pk_latitude'].' '.$_POST['pk_longitude']."',
				drop_latlong	= 		'".$_POST['dp_latitude'].' '.$_POST['dp_longitude']."',
				picklocation	=		'',
				droplocation	=		'',
				pickup_instruction	= 	'".sql_replace($_POST['pk_comments'])."',
				destination_instruction	= '".sql_replace($_POST['dp_comments'])."',
				d_phnum			= 		'".$_POST['dp_phone']."',
				p_phnum			= 		'".$_POST['pk_phone']."',
				ccode			= 		'',
				legid			= 		'',
				unloaded_miles	=		'',
				cellalertoption	=		'',
				cellalert		=		'',
				trip_remarks 	= 		''
				WHERE modiv_id='".$modiv_id."'";
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
	 }
	else if(isset($_POST['get_event']) && $_POST['get_event']!='')
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
		$get_fro_modiv = "SELECT drv.modiv_id as m_driver_id,t_detail.legcharges, drv.fname, drv.lname, drv.license,t_detail.signature,t_detail.modiv_detail_id as m_detail_id,veh.modiv_id as m_vehicle_id,veh.vin  FROM ".TBL_TRIP_DET." as t_detail INNER JOIN drivers as drv ON t_detail.drv_id=drv.drv_code INNER JOIN vehicles as veh ON t_detail.veh_id=veh.id Where t_detail.modiv_detail_id='$modiv_id'";
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
			$ride->signatureURL='https://city.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature'];
			$path = 'https://city.nemtclouddispatch.com/iphone/signature/'.$driverdata['signature'];
			$type = pathinfo($path, PATHINFO_EXTENSION);
			$data = file_get_contents($path);
			$ride->signature='data:image/' . $type . ';base64,' . base64_encode($data);
		}
		echo $ride=json_encode($ride);
		exit;
	} else if(isset($_POST['cancel_ride']) && $_POST['cancel_ride']!='')
	{
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
	}
	 	// $chkvtype = "SELECT * FROM  " . TBL_DRIVERS . "  WHERE uuid='$uuid'";
		// if($db->query($chkvtype) && $db->get_num_rows() > 0)
		// {
		//  	$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	 	//       echo json_encode($response);
		//  	exit();
		// }
			// account='".$account."',
			// unloadedmilage='".$unloadedmiles."',
			// miles_string = '".$miles_string."',
			// milage='".$miles."',
			// charges	= '".$totcharges."',	
			// triptype='".$triptype."',	
			// vehtype='".$vehtype."',	
			// appt_type='".$apptype."',					
			// po='".$po."',
			// patient_weight='".$patient_weight."',
			// bar_stretcher='".$bar_stretcher."',
			// req_id='".$req_id."',
			// pickaddr='".$pickadd."',
			// destination='".$destination_one."',
			// three_address='".$destination2."',
			// four_address='".$destination3."',
			// five_address='".$destination4."',
			// three_pickup 	= '".$three_pickup."',
			// four_pickup 	= '".$four_pickup."',
			// five_pickup 	= '".$five_pickup."',
			// backto='".$destination_last."',
			// appdate='".$appdate."',
//                org_apptime='".$org_apptime."',
			// apptime='".$apptime."',
			// returnpickup='".$returnpickup."',
			// casemanager='".$casemanager1."',
			// today_date=NOW(),
			// clientname='".$pname."',
//                phnum='".$phnum."',
			// dob='".$dob."',
			// email='',
			// clientcasemanager='".$casemanager2."',
			// cisid='".$cisid."',
			// insurance_name='".$insurance_name."',
			// driver='".$driver."',
			// sex='".$sex."',
			// childseat='".$childseat."',
			// escort='".$escort."',
			// wchair='".$wchair."',
			// dwchair='".$dwchair."',
			// stretcher='".$stretcher."',
			// dstretcher='".$dstretcher."',
			// oxygen='".$oxygen."',
			// ftof='".$ftof."',
			// status='".$status."',
			// b_accountname='".$b_accountname."',
			// pickup_instruction='".$pickup_instruction."',
			// destination_instruction='".$destination_instruction."',
			// destination_instruction2='".$destination_instruction2."',
			// destination_instruction3='".$destination_instruction3."',
			// backto_instruction='".$backto_instruction."',
			// d_phnum='".$d_phnum."',
			// d_phnum2='".$d_phnum2."',
			// d_phnum3='".$d_phnum3."',
			// p_phnum='".$p_phnum."',
			// billing_address='".$billing_address."',
			// c1='".$c1."',
			// c2='".$c2."',
			// c3='".$c3."',
			// c4='".$c4."',
			// c5='".$c5."',
			// c6='".$c6."',
			// picklocation	='".$picklocation."',
			// droplocation	='".$droplocation."',
			// droplocation2	='".$droplocation2."',
			// droplocation3	='".$droplocation3."',
			// backtolocation	='".$backtolocation."',
			// capped_miles	='".$capped_miles."',
			// after_hours 	='".$after_hours."',
			// p_after_hours 	='".$p_after_hours."',
			// r_after_hours 	='".$r_after_hours."',
			// passenger		='".$_POST['passenger']."',
			// cellalert 		='".$cellalert."',
			// cellalertoption ='".$cellalertoption."',
			// trigerfor 		='".$trigerfor."',
			// comments		='".$comments."'
// function pm($value)
// {
// 	echo "<pre>";
// 	print_r($value);
// 	exit();
// }
?>