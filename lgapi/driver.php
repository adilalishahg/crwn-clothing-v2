<?php 
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();

		function check_code($val,$db)
		{

			$chkCode = "SELECT drv_code FROM ".TBL_DRIVERS." WHERE drv_code='".$val."'";
			
			if($db->query($chkCode) && $db->get_num_rows() > 0 )
			{
				$val=rand(1000,9999);
				check_code($val,$db);
			}
			return $val;

		}
		$val=rand(1000,9999);
		$driv_code= check_code($val,$db);

	if(isset($_POST['add_driver']) && $_POST['add_driver']!='')
    {
		if($_POST['transportationProviderId']=='grecotrans-provider'){
		
	  	$modiv_id = sql_replace($_POST['modiv_id']);	
	  	$transportationProviderId = sql_replace($_POST['transportationProviderId']);	
	  	$fname = sql_replace($_POST['firstName']);	
	  	$lname = sql_replace($_POST['lastName']);	
	  	$drv_code = sql_replace($driv_code);	
	  	$cell_num = sql_replace($_POST['phone']);	
	  	$email = sql_replace($_POST['email']);	
	  	$license = sql_replace($_POST['licenseId']);
	  	$licenseState = sql_replace($_POST['licenseState']);
	  	$lic_expirydate = sql_replace($_POST['licenseExpiration']);
	  	$credentialingStatus = sql_replace($_POST['credentialingStatus']);
	  	$dob = sql_replace($_POST['dob']);

	    $chkvtype = "SELECT * FROM  " . TBL_DRIVERS . "  WHERE modiv_id='$modiv_id'";
		if($db->query($chkvtype) && $db->get_num_rows() > 0)
		{
		 	$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}

		$modiv_created_date=date('Y-m-d H:i');
		
		 $chkdriver = "SELECT * FROM  " . TBL_DRIVERS . "  WHERE  TRIM(LOWER(REPLACE(license,'-','')))='".strtolower(trim(str_replace('-','',$license)))."'"; 
	   	if($db->query($chkdriver) && $db->get_num_rows() > 0)
		{ 
		$Query = "UPDATE " . TBL_DRIVERS . " SET
		modiv_id='$modiv_id',
        transportationProviderId = '$transportationProviderId',
		fname 		=  '$fname',
		lname 		=  '$lname',
		cell_num 	=  '$cell_num',
		email 		=  '$email',
		
		licenseState 	=  '$licenseState',
		lic_expirydate 	=  '$lic_expirydate',
		credentialingStatus = '$credentialingStatus',
		dob = '$dob',
		drvstatus = 'Active',
		modiv_flage = '1',
		modiv_created_date = '$modiv_created_date' WHERE license 	=  '$license' ";
		}else{
   	  	$Query = "INSERT INTO " . TBL_DRIVERS . " SET
		modiv_id='$modiv_id',
        transportationProviderId = '$transportationProviderId',
		fname 		=  '$fname',
		lname 		=  '$lname',
		drv_code 		='$drv_code',
		cell_num 	=  '$cell_num',
		email 		=  '$email',
		license 	=  '$license',
		licenseState 	=  '$licenseState',
		lic_expirydate 	=  '$lic_expirydate',
		credentialingStatus = '$credentialingStatus',
		dob = '$dob',
		drvstatus = 'Active',
		modiv_flage = '1',
		modiv_created_date = '$modiv_created_date'";
		}
	  	if($db->execute($Query))
	    {
	    	$module_id = mysql_insert_id();
	    	$value = "The $fname $lname driver has been added by ModivCare";
	    	$link="drivers/detaildrv.php?id=$module_id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Driver',
			activity='Update',
	        module_id = '$module_id',
			link 		= '$link',
			value 		= '$value',
			created_date = '$modiv_created_date'";
		  	$db->execute($Query); 
	    	echo 1;
	    	exit();
		} else {
	    	$response = array('message' =>'Error in adding driver','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();		  
		}
		}} else if(isset($_POST['update_driver']) && $_POST['update_driver']!='')
    {if($_POST['transportationProviderId']=='grecotrans-provider'){
		
	  	$modiv_id = sql_replace($_POST['modiv_id']);	
	  	$transportationProviderId = sql_replace($_POST['transportationProviderId']);	
	  	$fname = sql_replace($_POST['firstName']);	
	  	$lname = sql_replace($_POST['lastName']);	
	  	$cell_num = sql_replace($_POST['phone']);	
	  	$email = sql_replace($_POST['email']);	
	  	$license = sql_replace($_POST['licenseId']);
	  	$licenseState = sql_replace($_POST['licenseState']);
	  	$lic_expirydate = sql_replace($_POST['licenseExpiration']);
	  	$credentialingStatus = sql_replace($_POST['credentialingStatus']);
	  	$dob = sql_replace($_POST['dob']);
 
	    $chkdriver = "SELECT * FROM  " . TBL_DRIVERS . "  WHERE modiv_id='$modiv_id'"; 
	   	if($db->query($chkdriver) && $db->get_num_rows() == 0)
		{
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}

		$module_id=$db->fetch_one_assoc()['Drvid'];

   	   	$Query = "UPDATE " . TBL_DRIVERS . " SET
        transportationProviderId = '$transportationProviderId',
		fname 		=  '$fname',
		lname 		=  '$lname',
		cell_num 	=  '$cell_num',
		email 		=  '$email',
		license 	=  '$license',
		licenseState 	=  '$licenseState',
		lic_expirydate 	=  '$lic_expirydate',
		credentialingStatus = '$credentialingStatus',
		dob = '$dob',
		modiv_updated_date 	=  '$modiv_updated_date',
		modiv_updated = '1' WHERE modiv_id='".$modiv_id."'";

	  	if($db->execute($Query))
	    {
	    	$value = "The $fname $lname driver has been updated by ModivCare";
	    	$link="drivers/detaildrv.php?id=$module_id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Driver',
			activity='Update',
	        module_id = '$module_id',
			link 		= '$link',
			value 		= '$value',
			created_date = '$modiv_created_date'";
		  	$db->execute($Query); 

	    	echo 1;
	    	exit();
		} else {
	    	$response = array('message' =>'Error in adding driver','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();		  
		}

	}}  else if(isset($_POST['get_driver']) && $_POST['get_driver']!='')
    {
    	$uuid=$_POST['uuid'];
  		$query = "SELECT uuid, transportationProviderId, fname, lname, cell_num, email, licenseId, licenseState, licenseExpiration, credentialingStatus, dob FROM ".TBL_DRIVERS." WHERE uuid='".$uuid."'";
  		
      	if($db->query($query) && $db->get_num_rows())
		{

		  	$udata = $db->fetch_one_assoc();
		  	$data['id']=$udata['uuid'];
		  	$data['transportationProviderId']=$udata['transportationProviderId'];
		  	$data['firstName']=$udata['fname'];
		  	$data['lastName']=$udata['lname'];
		  	$data['phone']=$udata['cell_num'];
		  	$data['email']=$udata['email'];
		  	$data['licenseId']=$udata['licenseId'];
		  	$data['licenseState']=$udata['licenseState'];
		  	$data['licenseExpiration']=$udata['licenseExpiration'];
		  	$data['credentialingStatus']=$udata['credentialingStatus'];
		  	$data['dob']=$udata['dob'];
		  	$response = array('data' =>$data,'error' =>false,'success' =>true);
	        echo json_encode($response);
		 	exit();

		} else {
			$response = array('message' =>'Driver not found','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
  	}
?>