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





// Delete Vehicle Script

    if(isset($_GET['delId']) && $_GET['delId'] != ''){

   		$QueryDel = "DELETE FROM ".TBL_FUELLOG." WHERE fid='".$_GET['delId']."'";

  		if($db->query($QueryDel))

		{  		

         $msg .= 'Record Removed Successfully<br>';

		}else{

		 $error .= 'Error occured while removing the record<br>';		

		}  

  	}





	/*************** Paging ************** */

	

	if(!empty($_GET['Page']))

	{ $page = $_GET['Page']; }

	else

	{ $page = 1; }

	

	$limit = 20;

	$offset = (($page * $limit) - $limit);

	$maxRecord = 20; 





// Fetch all vehicles list

	 $Querypg = "SELECT COUNT(*) FROM ".TBL_FUELLOG." WHERE veh_id=".$id;	

	 $totalRows = $db->executeScalar($Querypg);

 

     if(isset($_GET['pageNum'])){

	   $page_no = $_GET['pageNum'];

	 }else{

	   $page_no = '1';	 

	 }

	 

   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 

	  

	  

	$Query2 = "SELECT * FROM ".TBL_FUELLOG." WHERE veh_id=".$id." ORDER BY fid DESC LIMIT ".$pagination->startRow . ",".$pagination->maxRows;

	

   if($db->query($Query2) && $db->get_num_rows() > 0)

	{

	   $fdetails = $db->fetch_all_assoc();

	}
    
	$dt=convertDateFromMySQL($fdetails[0]['refil_date']);
	

	$query = "SELECT  vnumber, vname FROM ".TBL_VEHICLES." WHERE id  = '$id'";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$vehicle= $db->fetch_row_assoc();

	}

	$pages =  $pagination->display_pagination();	

	  

	$db->close();

	$db2->close();

    $pgTitle = "Admin Panel -- Fuel History ";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("vehicle",$vehicle);

	$smarty->assign("msgs",$msg);
	
	$smarty->assign("dt",$dt);

	$smarty->assign("errors",$error);	

	$smarty->assign_by_ref('id',$id);

	$smarty->assign_by_ref('fdetails',$fdetails);

	$smarty->assign("pages",$pages);		

	$smarty->display('vehtpl/history.tpl');

		

?> 