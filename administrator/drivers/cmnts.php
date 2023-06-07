<?php
include_once('../DBAccess/Database.inc.php');
include('../Classes/pagination-class.php');	
$db = new Database;	
	
$db->connect();

if(isset($_GET['trip_id']))
{	
	$trp_id  = $_GET['trip_id'];
	//$query = "SELECT * From ".TBL_TRIP_DET." Where  trip_id 	= '".$trp_id."'" ;
	
	$query = "SELECT a.trip_remarks, a.pck_add, a.drv_id, a.drp_add, a.status, b.trip_clinic,b.trip_user, c.comments
						FROM ".TBL_TRIP_DET." as a,  ".TBL_TRIPS." as b, ".TBL_RATING." as c
						WHERE a.trip_id  = b.trip_id AND c.trp_id = a.tdid AND a.tdid = '$trp_id'";
	if($db->query($query) && $db->get_num_rows() > 0)
	{

		$trips = $db->fetch_row_assoc();
	}
	$Query_comments = "SELECT comments FROM ".TBL_RATING." WHERE  trp_id = '$trp_id' "; 
			 if($db->query($Query_comments) && $db->get_num_rows())
			  {
			  $data_comments = $db->fetch_all_assoc();
			  }
	//debug($trips);
	$qdrv_name = "SELECT fname,lname FROM ".TBL_DRIVERS." WHERE drv_code = '".$trips['drv_id']."'";
	$db->query($qdrv_name);
	$drv =  $db->fetch_row_assoc();
	$trips ['drv_name']= $drv['fname']." " .$drv['lname'];
}

/*echo "<pre>";
print_r($trips);
exit;*/
//debug($trips);
$db->close();

$pgTitle = "Admin Panel -- Trips History";
$smarty->assign('trips',$trips);
$smarty->assign("data_comments",$data_comments);
$smarty->display('drvtpl/cmnts.tpl');
		
?> 