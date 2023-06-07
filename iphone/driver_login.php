<?php
include_once('DatabaseUS.inc.php');
$db = new Database;
$db->connect();
ini_set("display_errors", "on");
$current_time = date("Y-m-d H:i:s");
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getvehicles') {
	$veh_ids = '0';
	$Q = "SELECT veh_id FROM dv_mapping ";
	if ($db->query($Q) && $db->get_num_rows() > 0) {
		$dt = $db->fetch_all_assoc();
		for ($i = 0; $i < sizeof($dt); $i++) {
			$veh_ids = $veh_ids . ',' . $dt[$i]['veh_id'];
		}
	}
	$querygetvehicles = "SELECT id,vnumber,vname FROM vehicles"; // WHERE id  NOT IN ($veh_ids)
	if ($db->query($querygetvehicles) && $db->get_num_rows() > 0) {
		$jsonarray['status'] = 'true';
		$data = $db->fetch_all_assoc();
		$jsonarray['data'] = $data;
	} else {
		$jsonarray['status'] = 'false';
	}
	echo json_encode($jsonarray);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'login') {
	if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
		$username = sql_replace($_REQUEST['username']);
		$password = sql_replace($_REQUEST['password']);
		$query = "SELECT * FROM drivers WHERE username='$username' AND password='$password' LIMIT 1";
		if ($db->query($query) && $db->get_num_rows() > 0) {
			$data = $db->fetch_all_assoc();
		}
		$rowcount = count($data);
		$jsonarray = array();
		if ($rowcount == 0) {
			$jsonarray['status'] = 'false';
			$jsonarray['error'] = 'Login Failed';
		} else {
			$querylogin = "UPDATE drivers SET login_status = '1' WHERE   Drvid = '" . sql_replace($data[0]['Drvid']) . "' ";
			if ($db->execute($querylogin)) {
				/*if(isset($_REQUEST['id']) && isset($_REQUEST['id']) !=''){
				 $vnumber	= $_REQUEST['vnumber'];
				 $vname		= $_REQUEST['vname'];
				 $id		= $_REQUEST['id'];
			$querydelete 	= "DELETE FROM dv_mapping WHERE veh_id = '".$id."'";	 $db->execute($querydelete);
			$querydelete2 	= "DELETE FROM dv_mapping WHERE drv_id = '".$data[0]['Drvid']."'";	 $db->execute($querydelete2);
			$queryinsertdvmap = "INSERT INTO dv_mapping SET 
									veh_id 			= '".$id."', 
									veh_numplate 	= '".$vnumber."', 
									vehname		 	= '".$vname."', 
									drv_id 			= '".$data[0]['Drvid']."',
									drv_name 		= '".$data[0]['fname'].' '.$data[0]['lname']."',  
									dv_date			= '".date("Y-m-d H:i:s")."' "; 
				  $db->execute($queryinsertdvmap);
				    }	*/
				$jsonarray['status'] = 'true';
				$data[0]['hourformat']	=	'24';
				$data[0]['drop_signature']	=	'1';
				$data[0]['pick_signature']	=	'1';
				$data[0]['clockinout']	=	'1';
				$data[0]['fulereceipt']	=	'1';
				$jsonarray['userdata'] = $data;
			} else {
				$jsonarray['status'] = 'false';
				$jsonarray['error'] = 'Login Failed';
			}
		}
		echo json_encode($jsonarray);
	} else {
		$jsonarray = array();
		$jsonarray['status'] = 'false';
		$jsonarray['error'] = 'parameters are missing';
		echo json_encode($jsonarray);
		exit();
	}
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'logout') {
	if (isset($_REQUEST['driverID'])) {
		// file_put_contents($_REQUEST['driverID'] . '_Driver_Login_.txt', "Date:" . date("Y-m-d H:i:s") . " -> " . json_encode($_REQUEST) . "\n\n", FILE_APPEND);
		$querylogout = "UPDATE drivers SET login_status = '0' WHERE   drv_code = '" . sql_replace($_REQUEST['driverID']) . "' ";
		$querydelete = "DELETE FROM apns WHERE driver_code = '" . sql_replace($_REQUEST['driverID']) . "'";
		if ($db->execute($querylogout) && $db->execute($querydelete)) {
			$Qs = "SELECT * FROM drivers WHERE   drv_code = '" . ($_REQUEST['driverID']) . "'";
			if ($db->query($Qs) && $db->get_num_rows() > 0) {
				$data22 = $db->fetch_one_assoc();
			}
			//$querydelete2 = "DELETE FROM dv_mapping WHERE drv_id = '".($data22['Drvid'])."'";	 $db->execute($querydelete2);	  
			$jsonarray['status'] = 'true';
		} else {
			$jsonarray['error'] = 'Logout Failed!';
		}
	}
	echo json_encode($jsonarray);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'clockin') {
	if (isset($_REQUEST['driverID'])) {
		$Qup = "UPDATE drivers SET clockin = '" . $current_time . "',clockstatus='in' WHERE drv_code = '" . $_REQUEST['driverID'] . "'";
		if ($db->execute($Qup)) {
			$jsonarray['status'] = 'true';
			$jsonarray['clockintime'] = date("H:i:s");
		} else {
			$jsonarray['status'] = 'false';
			$jsonarray['error'] = 'Clock In Failed';
		}
	}
	echo json_encode($jsonarray);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'clockout') {
	if (isset($_REQUEST['driverID'])) {
		$Qse = "SELECT * FROM " . drivers . " WHERE drv_code = '" . $_REQUEST['driverID'] . "'";
		if ($db->query($Qse) && $db->get_num_rows() > 0) {
			$data = $db->fetch_one_assoc();
			$Qup = "UPDATE drivers SET clockout = '" . $current_time . "',clockstatus='out' WHERE drv_code = '" . $_REQUEST['driverID'] . "'";
			$db->execute($Qup);
			$duration = (strtotime($current_time) - strtotime($data['clockin'])); // exit;
			$Qins = "INSERT INTO clockinout_history SET
										Drvid	=	'" . $data['Drvid'] . "',
										date	=	'" . date("Y-m-d", strtotime($data['clockin'])) . "',
										clockin	=	'" . $data['clockin'] . "',
										clockout=	'" . $current_time . "',
										duration=	'" . $duration . "'";
		}
		if ($db->execute($Qins)) {
			$jsonarray['status'] = 'true';
			$jsonarray['clockouttime'] = date("H:i:s");
		} else {
			$jsonarray['status'] = 'false';
			$jsonarray['error'] = 'Clock Out Failed';
		}
	}
	echo json_encode($jsonarray);
}
if (isset($_POST['action']) && $_POST['action'] == 'getdevicetoken') {
	if (isset($_POST['driverID'])) {
		$driver_code = $_POST['driverID'];
		$device_token = $_POST['deviceToken'];
		$applicationidentifier = $_POST['HBMAppIdentifier'];
		$querydelete = "DELETE FROM apns WHERE driver_code = '$driver_code'";
		$querygetdevicetoken = "INSERT INTO apns SET driver_code = '$driver_code', device_token = '$device_token', datetime = NOW(), applicationidentifier = '$applicationidentifier' ";
		if ($db->execute($querydelete) && $db->execute($querygetdevicetoken)) {
			$jsonarray['status'] = 'true';
		} else {
			$jsonarray['status'] = 'false';
		}
		echo json_encode($jsonarray);
	}
}
$db->close();