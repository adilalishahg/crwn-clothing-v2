<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	if(isset($_REQUEST['startdate']))
	{//print_r($_POST); exit;
	$startdate 	= $_REQUEST['startdate'];
	$enddate 	= $_REQUEST['enddate'];
	$reportby 	= $_REQUEST['reportby'];
	$driver_id  = $_REQUEST['driver_id'];
	$veh_id  	= $_REQUEST['veh_id'];
	$whr= " WHERE 1 ";
	if($startdate!='' && $enddate!=''){
	$whr.= "AND uploadedon BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'";}
	if($reportby=='drivers'){$whr.= " AND driver_code = '".$driver_id."'";}
	if($reportby=='vehicles'){$whr.= " AND vehicle_id = '".$veh_id."'";}
	 $query = "SELECT  r.*, (SELECT CONCAT(fname,' ',lname) driver FROM drivers where r.driver_code = drv_code) driver,
	(SELECT CONCAT(vname,' - ',vnumber) vehicle FROM vehicles where r.vehicle_id = id) vehicle  FROM ". receipts." r $whr ORDER BY id DESC";
	if($db->query($query) && $db->get_num_rows() > 0)
	{$data = $db->fetch_all_assoc();} }
	$Qsd="SELECT * FROM drivers WHERE drvstatus ='Active'  ORDER BY fname ASC";
		if($db->query($Qsd) && $db->get_num_rows()>0){			$drivers = $db->fetch_all_assoc();	 }
	$Qsv="SELECT * FROM vehicles WHERE del ='0'  ORDER BY vname ASC";
		if($db->query($Qsv) && $db->get_num_rows()>0){			$vehicles = $db->fetch_all_assoc();	 }
	//print_r($data); 	
	$db->close();
	$stdate = convertDateFromMySQL($stdate);
	$enddate = convertDateFromMySQL($enddate);
	$smarty->assign("vehicles",$vehicles);	
	$smarty->assign("drivers",$drivers);
	$smarty->assign("data",$data);
	$smarty->assign("post",$_REQUEST);
	$smarty->display('reportstpl/gasreceipts.tpl');
?>