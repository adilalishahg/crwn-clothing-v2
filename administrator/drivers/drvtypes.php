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

		$date = date('Y-m-d',time());

		$del_by = $_SESSION['admuser']['admin_id'];

   		$QueryDel = "UPDATE ".TBL_DRVTYPES." SET del = '1', del_date = '$date', del_by = '$del_by'

									WHERE dtype_id='".$_GET['delId']."'";

  		if($db->query($QueryDel))

		{  

		   /*$QueryDel2 = "DELETE FROM ".TBL_DRIVERS." WHERE drvtype='".$_GET['delId']."'";

		     if($db2->query($QueryDel2)){	*/			

         $msgs .= 'Record Removed Successfully<br>';/*}else{

		 $error .= 'Driver Type removed Successfully but Error occured while removing the drivers under that driver type.<br>';		   */

		  }

		  else

		  {

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





	 $Querypg = "SELECT COUNT(*) FROM ".TBL_DRVTYPES." where del='1'";	

	 $totalRows = $db->executeScalar($Querypg);

 

     if(isset($_GET['pageNum'])){

	   $page_no = $_GET['pageNum'];

	 }else{

	   $page_no = '1';	 

	 }

	 

   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 

	  

	  

	$Query2 = "SELECT * FROM ".TBL_DRVTYPES." WHERE `del` ='0'  LIMIT ".$pagination->startRow . ",".$pagination->maxRows;

	  if($db->query($Query2) && $db->get_num_rows() > 0)

	   {

	   $drvdetails = $db->fetch_all_assoc();

	  } 



$drvqdetails = array();



 for($i=0; $i<sizeof($drvdetails); $i++){

	$Query3 = "SELECT COUNT(*) AS trows FROM ".TBL_DRVTYPES." as a,".TBL_DRIVERS." as b WHERE drvtype= a.dtype_id AND a.dtype_id='".$drvdetails[$i]['dtype_id']."' AND b.del = '0' AND b.drvstatus = 'Active' GROUP BY b.Drvid";

	  if($db->query($Query3) && $db->get_num_rows() > 0)

	   {

	     array_push($drvqdetails,$db->get_num_rows());

	   }else{

	     array_push($drvqdetails,$db->get_num_rows());	   

	   } 

    }

    	

	      $pages =  $pagination->display_pagination();	

	  

	$db->close();

	$db2->close();

    $pgTitle = "Admin Panel -- Driver Types";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);	

	$smarty->assign_by_ref('drvtypedetails',$drvdetails);

	$smarty->assign_by_ref('drvqdetails',$drvqdetails);	

	$smarty->assign("pages",$pages);	

	$smarty->display('drvtpl/drvtypes.tpl');

		

?> 