<?php
   	/* *************************** *
	   * Date: 12 March 2010
	   * routingpanel/grid.php
	   * Abid Malik
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');

	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
    $sheet=$_GET['id'];
	$reqid=$_GET['reqid'];
	$type=$_GET['type'];
	$status=$_GET['status'];
	//$ad=$_GET['ad'];

		
	$db->connect();
	$db2->connect();

	/*************** Paging ************** */	

		// 	S E A R C H    C O D  E  ///
		
	if(isset($status) && $status != ''){
		$stat = ($status == '0') ? '1' : '0';		
		$addrQuery = "UPDATE ".TBL_FORMS." SET
					  locks = '".$stat."'
					  WHERE id = '".$reqid."'";
		$db->execute($addrQuery);
	}
	
	if(isset($_GET['st']) && $_GET['st'] != ''){
		$st = $_GET['st'];
		$stat = ($st == '0') ? '1' : '0';
		$whr = " AND locks != '".$stat."'";
	}else{
		$st = 'locked';	
		$whr = " AND locks != '0'";
	}
			
	if(count($_POST) > 0){
		$ahid = $_POST['progid'];
		$wher = " WHERE cisid = '".$ahid."'";
		$drvQuery = "SELECT id,clientname,phnum,cisid,email,pickaddr,locks FROM ".TBL_FORMS.$wher;		
	}else
		$drvQuery = "SELECT id,clientname,phnum,cisid,email,pickaddr,locks FROM ".TBL_FORMS." WHERE cisid != ''".$whr;
	/*echo $drvQuery;
	exit;*/
	if($db->query($drvQuery) && $db->get_num_rows() > 0)
		$ahcccs = $db->fetch_all_assoc();
	
	/*echo '<pre>';
	print_r($ahcccs);
	exit;*/
	
	$db->close();
	$db2->close();
	
    $pgTitle = "Admin Panel -- Address Management";
	$smarty ->assign("id",$sheet);
	$smarty ->assign("user",$user);
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("drv",$drv);
	$smarty ->assign("usr",$usr);	
	$smarty->assign("userdata2",$userdata2);
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("st",$st);
	$smarty->assign("ad",$ad);
	$smarty->assign("ahid",$ahid);
	$smarty ->assign("ahcccs",$ahcccs);
	$smarty ->assign("users",$users);
	$smarty ->assign("clinic",$clinic);
	$smarty->assign("driverdata",$driverdata);
	$smarty->assign("userdata",$userdata);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('membdetail',$trips);
	$smarty->assign("paging",$paging);
	$smarty->display('addresstpl/grid.tpl');

?>