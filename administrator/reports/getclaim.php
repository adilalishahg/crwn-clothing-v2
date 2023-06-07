<?php

/* *************************** *

	   * Created On : 31st March,2009 

	   * Coded By : Muhammad Sajid

	   * All Rights Reserved 2009 by : HITS (Hybrid IT Services) 

	   * MMTp://www.hybriditservices.com/demos/MMTglobal-2/hybridTracktrans.com

	   *************************** */

	

   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	

	$db->connect();

	$db1 = new Database;	

	$db1->connect();
	$close = '';

	//$id=$_REQUEST['id'];

	//$reqid=$_GET['reqid'];

  	//GET REQUEST
	

	if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')

	{
			
			// check if record exists

			$req_query = "SELECT * FROM ".TBL_FORMS." WHERE id = '".$_POST['id']."' ";

			if($db1->query($req_query) && $db1->get_num_rows() > 0){
				$reclaimid = $_POST['reclaimid1'].'-'.$_POST['reclaimid2'];
				$query = "UPDATE ".TBL_FORMS." SET reclaim_id = '".$reclaimid."' WHERE id = '".$_POST['id']."'";			
			    if($db->query($query)){
					 echo "<script type='text/javascript'>alert('Reclaim ID set successfully')</script>";
					 $close = '1';
					 //exit;
            		/* echo "<script>location.href='reclaim.php';</script>";*/
				}
			}
	}

	else

	{

		if(isset($_GET['id']) && $_GET['id'] != '')

		{			
			$id = $_GET['id'];
			$req_query = "SELECT reclaim_id FROM ".TBL_FORMS." WHERE id = '".$id."'";
			if($db->query($req_query) && $db->get_num_rows() > 0){
				$req = $db->fetch_all_assoc();				
				$recid = explode('-',$req[0]['reclaim_id']);
				$recid1 = $recid[0];
				$recid2 = $recid[1];
			}
		}
	}

	//Close DB Connection	

	$db->close();

    $smarty->assign("pgTitle",$pgTitle);

    $smarty->assign("pgName",$name);

	$smarty->assign("msg",$msg);

	$smarty->assign("id",$id);
	$smarty->assign("close",$close);

	$smarty->assign("recid1",$recid1);
	
	$smarty->assign("recid2",$recid2);

	$smarty->display('reqtpls/getclaim.tpl');

?>