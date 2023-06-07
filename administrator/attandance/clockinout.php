<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db->connect();
//$date=$_REQUEST['date'];
if($date==''){ $date=date('Y-m-d'); }
/*$query2 = "SELECT  * FROM ".TBL_DRIVERS." WHERE del = '0' AND drvstatus='Active' ORDER BY clockin";
if($db->query($query2) && $db->get_num_rows() > 0)
	{	$data2 = $db->fetch_all_assoc();
	for($i=0;$i<sizeof($data2);$i++){}}*/
		$Qup="UPDATE ".TBL_DRIVERS." SET clockstatus = 'out' WHERE clockin NOT BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59'";
	//	$db->execute($Qup);
		
		
$query = "SELECT  * FROM ".TBL_DRIVERS." WHERE del = '0' AND drvstatus='Active' ORDER BY fname";
if($db->query($query) && $db->get_num_rows() > 0)
	{	$data = $db->fetch_all_assoc();	
	// $data = sort_array_multidim($data, "appdate ASC, clientname ASC");
	 	}
	
$db->close();
$smarty->assign("data",$data);
$smarty->assign("date",$date);
$smarty->assign("today",date('Y-m-d'));
$smarty->display('atdncetpl/clockinout.tpl');
?>  