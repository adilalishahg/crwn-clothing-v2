<?php 
	include_once('DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
if(isset($_GET['sub']) && $_GET['sub'] == 'success'){
	$msgs = "Setting Updated Successfully";
}
if(isset($_GET['sub']) && $_GET['sub'] == 'failure'){
	$msgs = "Unable to Update Setting";
}
$db->connect();
if(count($_POST) > 0)
{	
	$select_all_dv    		= sql_replace($_POST['select_all_dv']);
	$multi_run_same_loc     = sql_replace($_POST['multi_run_same_loc']);	
	$multi_run_diff_loc		= sql_replace($_POST['multi_run_diff_loc']);
	$live_trafic_ip			= sql_replace($_POST['live_trafic_ip']);
	$time_cap_window		= sql_replace($_POST['time_cap_window']);
	$mile_cap_window		= sql_replace($_POST['mile_cap_window']);
	$start_location			= sql_replace($_POST['start_location']);
	$starttime				= sql_replace($_POST['starttime']);
			 $Query3  = "UPDATE setup SET 
						start_location		='$start_location',
						select_all_dv		='$select_all_dv',
						multi_run_same_loc	='$multi_run_same_loc',
						multi_run_diff_loc	='$multi_run_diff_loc',
						live_trafic_ip		='$live_trafic_ip',
						time_cap_window 	= '$time_cap_window',
						mile_cap_window		='$mile_cap_window' ";
						$Query4  = "UPDATE contact_info SET 
						starttime		='$starttime'";
					  	if($db->execute($Query3))
						{ $db->execute($Query4);	
							echo '<script>location.href="setup.php?sub=success";</script>';
								exit;
						}
						else
						{	echo '<script>location.href="setup.php?sub=failure";</script>';
								exit;
						}
}else{ 
	$query = "SELECT * FROM setup ";  if($db->query($query) && $db->get_num_rows() > 0)  {$udata = $db->fetch_one_assoc();}
	$query2 = "SELECT * FROM contact_info ";  if($db->query($query2) && $db->get_num_rows() > 0)  {$udata2 = $db->fetch_one_assoc();}
} 
$db->close();
$pgTitle='Admin Panel | Contact Details';
$smarty->assign("pgTitle",$pgTitle);
$smarty->assign("udata",$udata);
$smarty->assign("udata2",$udata2);
$smarty->assign("msgs",$msgs);			
$smarty->display('setup.tpl');
?>