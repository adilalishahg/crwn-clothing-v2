<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
	$id = $_GET['id'];
if(isset($_REQUEST['tdid']) && $_REQUEST['tdid'] != ''){ 		

// Modiv Start
	    /**/$Qsltripid_modiv="SELECT modiv_id,status FROM trip_details WHERE tdid ='".$_REQUEST['tdid']."'";
		if($db->query($Qsltripid_modiv) && $db->get_num_rows() > 0)
	    {
	      $trip_detail_modiv = $db->fetch_one_assoc(); 

	      	if ($trip_detail_modiv['modiv_id']!='') {
				echo "<script> alert('You nan not update ModiVCare trip.');window.close(); </script>"; exit;	    	
			}
	    }
	// Modiv End
	
	
	  $Query1 = "SELECT * FROM ".trip_details." WHERE `tdid`='".$_REQUEST['tdid']."' LIMIT 1";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {  $RequestDetail = $db->fetch_one_assoc();  }}
if(isset($_POST['submit']) && $_POST['tdid']!=''){ //print_r($RequestDetail); exit;

$Qsl="SELECT * FROM ".TBL_FORMS."  WHERE id = '".$RequestDetail['reqid']."'";
if($db->query($Qsl) && $db->get_num_rows()>0){$triprequest = $db->fetch_one_assoc();
if($triprequest['invoice_gen']=='1'){
	$query = "UPDATE ".TBL_FORMS." SET  invoice_gen='0'  WHERE id = '".$triprequest['id']."'";
			$db->query($query);	 }}
//date				=	'".$_POST['date']."',
$QUp1="Update ".trip_details." SET 

tripassign_time		=	'".($_POST['tripassign_date']).' '.convertinto24($_POST['tripassign_time'],$_POST['tripassign_timerad'])."',
driverconfirm_time	=	'".convertDateToMySQL($_POST['date']).' '.convertinto24($_POST['driverconfirm_time'],$_POST['driverconfirm_timerad'])."',
arrived_time		=	'".convertDateToMySQL($_POST['date']).' '.convertinto24($_POST['arrived_time'],$_POST['arrived_timerad'])."',
pck_time			=	'".convertinto24($_POST['pck_time'],$_POST['pck_timerad'])."',
picked_time			=	'".convertDateToMySQL($_POST['date']).' '.convertinto24($_POST['pck_time'],$_POST['pck_timerad'])."',
aptime				=	'".convertinto24($_POST['aptime'],$_POST['aptimerad'])."',
drp_time			=	'".convertinto24($_POST['drp_time'],$_POST['drp_timerad'])."',
drp_atime			=	'".convertinto24($_POST['drp_atime'],$_POST['drp_atimerad'])."',
drv_id				=	'".$_POST['driver_id']."',
status				=	'".$_POST['status']."'
WHERE 	tdid  		= 	'".$_POST['tdid']."' LIMIT 1";
if($db->query($QUp1)){ 
			echo "<script type='text/ecmascript'>alert('Trip Information Updated Successfully')</script>";
			echo "<script>window.close();</script>";
			}else{
			echo "<script type='text/ecmascript'>alert('Unable to Update Trip Informations!.')</script>";
			echo "<script>window.close();</script>";
			}}	
	 $query = "SELECT  drv_code, fname, lname FROM ".TBL_DRIVERS." as a  Where a.drvstatus = 'Active' ORDER BY fname ASC";
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$driver = $db->fetch_all_assoc();
	}
	//	print_r($RequestDetail);
	$db->close();
	$pgTitle="Edit Request";
    $smarty->assign('id',$id); 
	$smarty->assign('dt',$RequestDetail); 
	$smarty->assign('driver',$driver); 
	$smarty->display('reportstpl/edit_trip.tpl');
?>