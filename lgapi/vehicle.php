<?php 
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect(); 

    if(isset($_POST['add_vehicle']) && $_POST['add_vehicle']!='')
  	{
		if($_POST['transportationProviderId']=='grecotrans-provider'){

	  	$modiv_id = sql_replace($_POST['modiv_id']);	
	  	$transportationProviderId = sql_replace($_POST['transportationProviderId']);	
	  	$vname = sql_replace($_POST['name']);	
	  	$vehmake = sql_replace($_POST['make']);	
	  	$vehmodel = sql_replace($_POST['model']);	
	  	$vehcolor = sql_replace($_POST['color']);	
	  	$year = sql_replace($_POST['year']);
	  	$vin = sql_replace($_POST['vin']);
	  	$vnumber = sql_replace($_POST['licensePlate']);
	  	$licensePlateState = sql_replace($_POST['licensePlateState']);
	  	$credentialingStatus = sql_replace($_POST['credentialingStatus']);
	  	$webhookURL = sql_replace($_POST['webhookURL']);

	    $chkvtype = "SELECT * FROM  " . TBL_VEHICLES . "  WHERE modiv_id='$modiv_id'"; 

		if($db->query($chkvtype) && $db->get_num_rows() > 0)
		{
		 	$response = array('message' =>'ID already exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();  
		}
		$modiv_created_date=date('Y-m-d H:i');
		
		
		$chkvehicle = "SELECT vnumber FROM  " . TBL_VEHICLES . "  WHERE vnumber='$vnumber'"; 
	   	if($db->query($chkvehicle) && $db->get_num_rows() > 0)
		{ $Query = "UPDATE " . TBL_VEHICLES . " SET
			modiv_id='$modiv_id',
	        transportationProviderId = '$transportationProviderId',
			vname 		=  '$vname',
			vehmake 		=  '$vehmake',
			vehmodel 	=  '$vehmodel',
			vehcolor 		=  '$vehcolor',
			year 	=  '$year',
			vin 	=  '$vin',
			licensePlateState 	=  '$licensePlateState',
			credentialingStatus = '$credentialingStatus',
			webhookURL = '$webhookURL',
			modiv_flage = '1',
			modiv_created_date = '$modiv_created_date' WHERE vnumber 	=  '$vnumber' ";}else{

	   	   $Query = "INSERT INTO " . TBL_VEHICLES . " SET
			modiv_id='$modiv_id',
	        transportationProviderId = '$transportationProviderId',
			vname 		=  '$vname',
			vehmake 		=  '$vehmake',
			vehmodel 	=  '$vehmodel',
			vehcolor 		=  '$vehcolor',
			year 	=  '$year',
			vin 	=  '$vin',
			vnumber 	=  '$vnumber',
			licensePlateState 	=  '$licensePlateState',
			credentialingStatus = '$credentialingStatus',
			webhookURL = '$webhookURL',
			modiv_flage = '1',
			modiv_created_date = '$modiv_created_date'"; }
	  	if($db->execute($Query))
	    {
	    	$module_id = mysql_insert_id();
	    	$value = "The $vname vehicle has been added by ModivCare";
	    	$link="vehicles/detailvehicle.php?id=$module_id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Vehicle',
			activity='Add',
	        module_id = '$module_id',
			link 		= '$link',
			value 		= '$value',
			created_date = '$modiv_created_date'";
		  	$db->execute($Query); 
	    	echo 1;
	    	exit();
		} else {
	    	$response = array('message' =>'Error in adding vehicle','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();		  
		}
		
	}
		
	} else if(isset($_POST['update_vehicle']) && $_POST['update_vehicle']!='')
	{ if($_POST['transportationProviderId']=='grecotrans-provider'){
		$modiv_id = sql_replace($_POST['modiv_id']);	
	  	$transportationProviderId = sql_replace($_POST['transportationProviderId']);	
	  	$vname = sql_replace($_POST['name']);	
	  	$vehmake = sql_replace($_POST['make']);	
	  	$vehmodel = sql_replace($_POST['model']);	
	  	$vehcolor = sql_replace($_POST['color']);	
	  	$year = sql_replace($_POST['year']);
	  	$vin = sql_replace($_POST['vin']);
	  	$vnumber = sql_replace($_POST['licensePlate']);
	  	$licensePlateState = sql_replace($_POST['licensePlateState']);
	  	$credentialingStatus = sql_replace($_POST['credentialingStatus']);

	   	$chkvehicle = "SELECT * FROM  " . TBL_VEHICLES . "  WHERE modiv_id='$modiv_id'"; 
	   	if($db->query($chkvehicle) && $db->get_num_rows() == 0)
		{
			$response = array('message' =>'ID not exist','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
		$module_id=$db->fetch_one_assoc()['id'];
		$modiv_updated_date=date('Y-m-d H:i');

   	   	$Query = "UPDATE " . TBL_VEHICLES . " SET
        transportationProviderId = '$transportationProviderId',
		vname 		=  '$vname',
		vehmake 	=  '$vehmake',
		vehmodel 	=  '$vehmodel',
		vehcolor 	=  '$vehcolor',
		year 	=  '$year',
		vin 	=  '$vin',
		vnumber 	=  '$vnumber',
		licensePlateState 	=  '$licensePlateState',
		modiv_updated_date 	=  '$modiv_updated_date',
		modiv_updated = '1',
		credentialingStatus = '$credentialingStatus' WHERE modiv_id='".$modiv_id."'";

	  	if($db->execute($Query))
	    {
	    	$value = "The $vname vehicle has been updated by ModivCare";
	    	$link="vehicles/detailvehicle.php?id=$module_id&notif_id=";
	   	  	$Query = "INSERT INTO tbl_notifications SET
			module='Vehicle',
			activity='Update',
	        module_id = '$module_id',
			link 		= '$link',
			value 		= '$value',
			created_date = '$modiv_updated_date'";
		  	$db->execute($Query); 

	    	echo 1;
	    	exit();	  
		} else {
	    	$response = array('message' =>'Error in adding vehicle','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();		  
		}
	}
	} else if(isset($_POST['get_vehicle']) && $_POST['get_vehicle']!='')
	{
		$uuid=$_POST['uuid']; 
  		$query = "SELECT uuid, vname, vehmake, vehmodel, vehcolor, year, vin, licensePlate, licensePlateState, credentialingStatus, transportationProviderId FROM ".TBL_VEHICLES." WHERE uuid='".$uuid."'";
  		
      	if($db->query($query) && $db->get_num_rows())
		{
		  	$udata = $db->fetch_one_assoc();
		  	
		  	$data['uuid']=$udata['uuid'];
		  	$data['name']=$udata['vname'];
		  	$data['make']=$udata['vehmake'];
		  	$data['model']=$udata['vehmodel'];
		  	$data['color']=$udata['vehcolor'];
		  	$data['year']=$udata['year'];
		  	$data['vin']=$udata['vin'];
		  	$data['licensePlate']=$udata['licensePlate'];
		  	$data['licensePlateState']=$udata['licensePlateState'];
		  	$data['credentialingStatus']=$udata['credentialingStatus'];
		  	$data['transportationProviderId']=$udata['transportationProviderId'];

		  	$response = array('data' =>$data,'error' =>false,'success' =>true);
	        echo json_encode($response);
		 	exit();

		} else {
			$response = array('message' =>'Vehicle not found','error' =>true,'success' =>false);
	        echo json_encode($response);
		 	exit();
		}
	}
?>