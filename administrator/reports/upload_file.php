<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	if(isset($_POST['submit'])){
		if(isset($_FILES['upload_files']['name'][0]) && $_FILES['upload_files']['name'][0] != '') {
		$id		=	$_POST['id'];
		$reqid	=	$_POST['reqid'];
		$path = "tr_logs/";
		$up_path = "log".time("now").(str_replace(' ','_',$_FILES['upload_files']['name'][0]));	
		$full_path = $path.$up_path;
		move_uploaded_file($_FILES["upload_files"]["tmp_name"][0] , '../'.$full_path);
		$query_upoad = "UPDATE ".TBL_FORMS." SET transportation_log = '$full_path' WHERE id = '$id' AND req_id = '$reqid' ";
		if($db->execute($query_upoad)){ echo '<script>alert("Transportation Log Uploaded Successfully!");</script>'; exit; }	
		else {echo '<script>alert("Failed to upload your file!");</script>'; exit;}
		}
		//print_r($_FILES['upload_files']['name'][0]);
		}
	if($_GET['id']) $id = $_GET['id'];
	if($_GET['reqid']) $reqid = $_GET['reqid'];	
	$db->close();
    $smarty->assign("pgTitle",'Upload Transportation Log');
	$smarty->assign("id",$id);
	$smarty->assign("reqid",$reqid);
	$smarty->display('reportstpl/upload_file.tpl');
?>