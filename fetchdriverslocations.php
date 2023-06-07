<?php
 include_once('DBAccess/Database2.inc.php');
  $db = new Database;	
	$db->connect();
	$fetch = $_POST['sheetid'];
	$driver_id = $_POST['driver_id'];
	/*$data = get_server_time();
	$time = $data[0];
	$date = $data[1];
	$curdate = $date;*/
	$str = '';
	//$time= date("H:i:s");
	 $cc = date("Y-m-d").' 00:00:01';;
	if($fetch == 'onedriver' && $driver_id != ''){				  
$queryone = " SELECT CONCAT('Driver Name:', fname,' ',lname,' Phone#: ',day_phnum,'<br> Speed: ',speed) as drinfo,lat,longt,trip_assingment,trip_status, fname as firstname, lname as lastname FROM drivers WHERE drv_code='$driver_id' AND login_status = '1' LIMIT 1";
	if($db->query($queryone) && $db->get_num_rows() > 0)
	{		$trips =  $db->fetch_all_assoc(); 
	}
	for($i = 0;$i<sizeof($trips);$i++)
	{  $row = $trips[$i];
		for($j=0; $j<1;$j++){
		$str  .= '^'.$row['lat'];
		$str  .= '^'.$row['longt'];
		$str  .= '^'.$row['drinfo'];
		$str  .= '^'.$row['trip_assingment'];
		$str  .= '^'.$row['trip_status'];
		$str  .= '^'.$row['firstname'];
		$str  .= '^'.$row['lastname'];
 		} 
		$str  .= '@';
	} 
	$str = substr($str, 0, -1);
	}
/*	if($fetch == 'alldrivers'){				  
$query = " SELECT CONCAT('Driver Name:', fname,' ',lname,' Phone#: ',day_phnum) as drinfo,lat,longt  FROM drivers WHERE del='0' AND drvstatus='Active'";
	if($db->query($query) && $db->get_num_rows() > 0)
	{		$trips =  $db->fetch_all_assoc(); 
	}
	for($i = 0;$i<sizeof($trips);$i++)
	{  $row = $trips[$i];
		for($j=0; $j<sizeof($row);$j++){
		$str  .= '^'.$row['lat'];
		$str  .= '^'.$row['longt'];
		$str  .= '^'.$row['drinfo'];
 		} 
		$str  .= '@';
	} 
	$str = substr($str, 0, -1);
	}*/
	if($fetch == 'allsch'){				  
/*$sQuery = "SELECT DISTINCT(td.drv_id), td.tdid, CONCAT('Driver Name:',dr.fname,' ',dr.lname,' Phone#: ',dr.day_phnum) as drinfo,dr.lat,dr.longt FROM ".TBL_TRIP_DET." as td left join ".TBL_DRIVERS." as dr on td.drv_id = dr.drv_code  WHERE td.date = '$curdate' AND td.drv_id = dr.drv_code GROUP BY td.drv_id ";*/
$sQuery = " SELECT CONCAT('Driver Name:', fname,' ',lname,' Phone#: ',day_phnum) as drinfo,speed,lat,longt,trip_assingment,trip_status, fname as firstname, lname as lastname  FROM drivers WHERE  drvstatus='Active' AND login_status = '1' ";
	if($db->query($sQuery) && $db->get_num_rows() > 0)
	{
		$trips =  $db->fetch_all_assoc(); 
	for($i = 0;$i<sizeof($trips);$i++)
	{  $row = $trips[$i];
		$str  .= '^'.$row['lat'];
		$str  .= '^'.$row['longt'];
		$str  .= '^'.$row['drinfo'].'<br/>Speed: '.str_replace('KM','MP',$row['speed']);
		$str  .= '^'.$row['trip_assingment'];
		$str  .= '^'.$row['trip_status'];
		$str  .= '^'.$row['firstname'];
		$str  .= '^'.$row['lastname'];
		$str  .= '@';
	} 
	$str = substr($str, 0, -1);
	} }
	echo $str;
?>
