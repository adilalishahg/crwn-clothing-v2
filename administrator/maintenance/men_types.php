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

	$db2 = new Database;	

    	

	$db->connect();

	$db2->connect();





// Delete Vehicle Script

    if(isset($_GET['delId']) && $_GET['delId'] != '')

	{

   		$QueryDel = "DELETE  FROM  ".TBL_MENTYPES."  WHERE id='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{  	
			$tQuery = "DELETE FROM  ".TBL_MNTNCE."  WHERE m_type='".$_GET['delId']."'";
			if($db->query($tQuery))
			{
				$msgs .= 'Record Removed Successfully<br>';
				echo '<script>alert("Record Deleted Successfully");</script>';
			}
		}
		else
		{
			$error .= 'Error occured while removing the record<br>';		
		} 

		echo "<script>location.href= 'men_types.php';</script>";

  	}





	/*************** Paging ************** */

	

	if(!empty($_GET['Page']))

	{ $page = $_GET['Page']; }

	else

	{ $page = 1; }

	

	$limit = 20;

	$offset = (($page * $limit) - $limit);

	$maxRecord = 20; 





	 $Querypg = "SELECT COUNT(*) FROM ".TBL_MENTYPES;	

	 $totalRows = $db->executeScalar($Querypg);

 

     if(isset($_GET['pageNum'])){

	   $page_no = $_GET['pageNum'];

	 }else{

	   $page_no = '1';	 

	 }

	 

   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 

	  

	  

	$Query2 = "SELECT * FROM ".TBL_MENTYPES." LIMIT ".$pagination->startRow . ",".$pagination->maxRows;

	  if($db->query($Query2) && $db->get_num_rows() > 0)

	   {

	   $data = $db->fetch_all_assoc();

	  } 

	   $pages =  $pagination->display_pagination();	

	  

	$db->close();

	$db2->close();

    $pgTitle = "Admin Panel -- Vehicle Types";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);	

	$smarty->assign('data',$data);	

	$smarty->assign("pages",$pages);	

	$smarty->display('mntncetpl/men_types.tpl');

		

?> 