<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db ->connect();
$current_date=date("Y-m-d");
$Qs="SELECT MAX(date) as lastdate FROM dates";
if($db->query($Qs) && $db->get_num_rows()>0){ $data=$db->fetch_one_assoc(); 
//
/*$d1=date_create($data['lastdate']);
$d2=date_create($current_date);
$p=date_diff($d2,$d1);
 $days = $p->format('%d'); */
 
 $your_date = strtotime($data['lastdate']);
    $datediff = strtotime($current_date) - $your_date;
    $days = floor($datediff/(60*60*24));
 
 
for($i=1;$i<$days;$i++){ 
 $require_date = date('Y-m-d', strtotime($data['lastdate'] .'+'.$i. ' day')); 
$query = "SELECT  dr.*,dt.dtype_duration FROM ".TBL_DRIVERS." as dr LEFT JOIN drivertype as dt on dr.drvtype = dt.dtype_id WHERE dr.del = '0' AND dr.drvstatus='Active'";
if($db->query($query) && $db->get_num_rows() > 0)
	{	$drivers = $db->fetch_all_assoc();
	for($j=0;$j<sizeof($drivers);$j++){
		$Query = "SELECT * FROM  ".clockinout_history." where Drvid = '".$drivers[$j]['Drvid']."' AND date = '".$require_date."'";
		if($db->query($Query) && $db->get_num_rows()) {  $clockhistory  = $db->fetch_all_assoc();	//print_r($clockhistory); exit;
			$tot =0;
			for($k=0;$k<sizeof($clockhistory);$k++){
			$tot	 	= $tot+$clockhistory[$k]['duration'];
			$clockin=$clockhistory[0]['clockin'];
			$clockout	=$clockhistory[$k]['clockout'];
			//$data[$i]['duration1']= gmdate("H:i:s", $data[$i]['duration']);
			} if($tot > ($drivers[$j]['dtype_duration']*60*60)){$overtime	=	($tot-($drivers[$j]['dtype_duration']*60*60));}else{$overtime=0;}
				$Qins="INSERT INTO attendance SET
										dated		=	'".$require_date."',
										dayonoff	=	'on',
										driver_id	=	'".$drivers[$j]['Drvid']."',
										clockin		=	'".$clockin."',
										clockout	=	'".$clockout."',
										total_time	=	'".$tot."',
										dutty_hour	=	'".$drivers[$j]['dtype_duration']."',
										over_time	=	'".$overtime."'"; 
										$db->execute($Qins);
		
		}else{$Qins="INSERT INTO attendance SET
										dated		=	'".$require_date."',
										dayonoff	=	'off',
										dutty_hour	=	'".$drivers[$j]['dtype_duration']."',
										driver_id	=	'".$drivers[$j]['Drvid']."'";
										$db->execute($Qins);}}
	} $Qins2="INSERT INTO dates SET date='".$require_date."'"; $db->execute($Qins2);
}

}


if(isset($_POST['id']) && isset($_POST['option']))
{	$id 	= $_POST['id'];
	$option = $_POST['option'];
	if($option=='in'){$Qup="UPDATE drivers SET clockin = '".$current_time."',clockstatus='in' WHERE Drvid = '".$id."'";
	$db->execute($Qup); echo 1;
	}else{$Qse = "SELECT * FROM ".drivers." WHERE Drvid = '".$id."'";
	if($db->query($Qse) && $db->get_num_rows() > 0)
	{	$data = $db->fetch_one_assoc();
	$Qup="UPDATE drivers SET clockout = '".$current_time."',clockstatus='out' WHERE Drvid = '".$id."'";
	$db->execute($Qup);
	$duration = (strtotime($current_time) - strtotime($data['clockin']));// exit;
	$Qins="INSERT INTO clockinout_history SET
										Drvid	=	'".$data['Drvid']."',
										date	=	'".date("Y-m-d",strtotime($data['clockin']))."',
										clockin	=	'".$data['clockin']."',
										clockout=	'".$current_time."',
										duration=	'".$duration."'";
										$db->execute($Qins);
	} echo 1;}	
	}
	$db->close();
?>