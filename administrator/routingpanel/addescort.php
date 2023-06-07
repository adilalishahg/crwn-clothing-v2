<?php
require_once('../DBAccess/Database.inc.php');
include_once('sendpush.php');
	$db = new Database;	
	$db->connect();
	    $tdid = $_POST['tdid'];
		$drvid = $_POST['drvid'];
		 if($tdid !='' && $drvid !=''){
		$qu = "UPDATE trip_details SET escort_id = '$drvid' WHERE tdid = '$tdid'";
		if($db->execute($qu)){
			$Qselect="SELECT td.*,tr.trip_user,
			(SELECT CONCAT(fname,' ',lname) as drivername FROM drivers WHERE drv_code = td.drv_id) as drivername,
			(SELECT CONCAT(fname,' ',lname) as escortname FROM drivers WHERE drv_code = td.escort_id) as escortname
			 FROM trip_details as td
			 left join trips as tr on td.trip_id = tr.trip_id WHERE td.tdid = '$tdid'";
			if($db->query($Qselect) && $db->get_num_rows()>0){
				$data=$db->fetch_one_assoc(); //print_r($data);
				$drivername=$data['drivername'];
				$escortname=$data['escortname'];
				$tripuser  =$data['trip_user'];
				 $message_admin = "You have been added to the ride with driver ".$drivername." for Patient ".$tripuser." and pickup time ".$data['pck_time']." ";
					sendpush($drvid,$message_admin,$db);
				$message_admin = "A driver ".$escortname." as an escort added with you for Patient ".$tripuser." and pickup time ".$data['pck_time']." ";	
					sendpush($data['drv_id'],$message_admin,$db);
				}	
			
		echo 1; }else{echo 0;} } else{echo 0;}
	

    ?>