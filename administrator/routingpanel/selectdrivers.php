<?php
require_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db->connect();
include_once('../include_file.php');
if(isset($_POST['add'])){ // print_r($_POST); exit;
$Qdelete = "DELETE FROM free_driver "; $db->execute($Qdelete);

for($i = 0; $i<sizeof($_POST["drv_code"]); $i++)
		{ 
		if($_POST["att"][$i] == 'on'){
			$Q1="SELECT Drvid FROM drivers WHERE drv_code = '".$_POST["drv_code"][$i]."'";
			if($db->query($Q1) && $db->get_num_rows()){ $Drviddata = $db->fetch_one_assoc();
				$Q2="SELECT veh_id FROM dv_mapping WHERE drv_id = '".$Drviddata['Drvid']."'";
				if($db->query($Q2) && $db->get_num_rows()){ $VMdata = $db->fetch_one_assoc(); 
					$Q3="SELECT capacity,id,vtype FROM vehicles WHERE id = '".$VMdata['veh_id']."'";
					if($db->query($Q3) && $db->get_num_rows()){ $VHdata = $db->fetch_one_assoc();
					$veh_id=$VHdata['id'];  $capacity=$VHdata['capacity'];   $vtype=$VHdata['vtype']; 
			}}}
			list($hours, $minutes, $seconds)= explode(":",$_POST["free_from"]);
			$free_from 			= ($hours*3600+$minutes*60+$seconds);
			$Qinsert = "INSERT INTO free_driver SET drv_code 	= '".$_POST["drv_code"][$i]."', 
													at_date 	= '$today',
													veh_id 		= '".$veh_id."',
													capacity 	= '".$capacity."',
													veh_type_id = '".$vtype."',
													drv_address = '".$_POST["loc"][$i]."', 
													free_from 	= '".$free_from."' "; 
				$db->query($Qinsert);
		}
		 } echo "<script>window.open('autoscheduale.php?date=$today','_parent');</script>"; exit;
}
	$getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0' ORDER BY  fname ASC";
 	if($db->query($getDriver) && $db->get_num_rows())
	{ $driverdata = $db->fetch_all_assoc();	
	for($i=0;$i<sizeof($driverdata);$i++){
		$Qselect="SELECT id from free_driver WHERE drv_code = '".$driverdata[$i]['drv_code']."' AND at_date = '$today'";
		if($db->query($Qselect) && $db->get_num_rows()>0){  $driverdata[$i]['selected'] = 'yes';  }
		}
	}
	$Qofficecor = "SELECT * FROM contact_info WHERE c_id = '1' "; 
	if($db->query($Qofficecor) && $db->get_num_rows()>0){  $corgeodata = $db->fetch_one_assoc();  }
	$corpo_latlong 	= $corgeodata['address'].','.$corgeodata['city'].','.$corgeodata['state'].' '.$corgeodata['zip']; 
	$starttime 		= $corgeodata['starttime'];
	//print_r($driverdata); //exit;
$db->close();
$smarty->assign("driverdata",$driverdata);
$smarty->assign("corpo_latlong",$corpo_latlong);
$smarty->assign("date",$today);
$smarty->assign("starttime",$starttime);
$smarty->assign("setupdata",$setupdata);
$smarty->display('rpaneltpl/selectdrivers.tpl'); 
?>