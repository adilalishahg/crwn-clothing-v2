<?php
   	/* *************************** *
	   * Date: 29-May-2008 
	   * CMS/index.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	


	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$id    = intval($_GET['id']);	
	$db2 = new Database;	
    	
	$db->connect();
	$db2->connect();


	/*************** Paging ************** */
	
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	
	$limit = 20;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20; 

  if(isset($_GET['delId'])){
  	$del_id = $_GET['delId'];
     $del_query = "Delete From ".TBL_TCKT." where id='$del_id'";
	if($db->query($del_query) )
	{
		@header("location:index.php");
	}

    }

// Fetch all vehicles list
	 $Querypg = "SELECT COUNT(*) FROM ".TBL_TCKT." WHERE id=".$id;	
	 $totalRows = $db->executeScalar($Querypg);
 
     if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
	 
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 
	  
	  
	$Query2 = "SELECT * FROM ".TBL_TCKT." WHERE id=".$id." ORDER BY date DESC LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
	
   if($db->query($Query2) && $db->get_num_rows() > 0)
	{
	   $tdetails = $db->fetch_all_assoc();
	}
	//debug($tdetails);
	$query = "SELECT  vnumber, vname FROM ".TBL_VEHICLES." WHERE id  = '$id'";
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$vehicle= $db->fetch_row_assoc();
	}
	for($i = 0;$i<sizeof($tdetails);$i++)
	{
		$dQuery  = "SELECT fname, lname FROM ".TBL_DRIVERS." WHERE Drvid = '".$tdetails[$i]['drv_id']."'";
		if($db->query($dQuery) && $db->get_num_rows() > 0)
		{
			$driver= $db->fetch_row_assoc();
		}
		$tdetails[$i]['driver'] = $driver['fname']. " " .$driver['lname'];
	}
	
	
	$pages =  $pagination->display_pagination();	
	  
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Fuel History ";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("vehicle",$vehicle);
	$smarty->assign("driver",$driver);
	$smarty->assign("msgs",$msg);
	$smarty->assign("errors",$error);	
	$smarty->assign_by_ref('id',$id);
	$smarty->assign_by_ref('tdetails',$tdetails);
	$smarty->assign("pages",$pages);		
	$smarty->display('tkttpl/history.tpl');
		
?> 