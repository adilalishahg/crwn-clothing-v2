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


//  Hard delete code
/*if ($_SESSION['admuser'] ['admin_level '] == '0')
{*/
	
	if(isset($_GET['resid']) && $_GET['resid'] != '')
	{
		$id = $_GET['resid'];
		$queryRestore = " Update ".TBL_VEHICLES." SET
																del = '0',
																del_by = '',
																del_date = ''
											where  id = '$id'";
		if($db->query($queryRestore))
		{  
			echo "<script>alert('Vehicle Restored!');</script>";
			echo "<script>location.href= 'veh_trash.php';</script>";
		}
					
	}
	
	// reset code end! ---------------------------//
	
	
	if(isset($_GET['delId']) && $_GET['delId'] != '')
	{
		$QueryDel = "DELETE FROM ".TBL_VEHICLES." WHERE id='".$_GET['delId']."'";
		if($db->query($QueryDel))
		{  
			$msgs .= 'Record Removed Successfully<br>';
		}
		else
		{
			$error .= 'Error occured while removing the record<br>';		
		}  
	}

//}

	/*************** Paging ************** */
	
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	
	$limit = 20;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20; 

	$del_by = $_SESSION['admuser']['admin_id'];
	$del_level =  $_SESSION['admuser']['admin_level'];
	if($del_level ==' 0')
	{
		$whr = " ";
	}
	else
	{
		$whr = " and del_by = '$del_by'";
	}
	
	
	 $Querypg = "SELECT COUNT(*) FROM ".TBL_VEHICLES." Where del = '1' $whr" ;	
	 $totalRows = $db->executeScalar($Querypg);
 
     if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
	 
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 
	  
	  
	$Query2 = "SELECT * FROM ".TBL_VEHICLES." Where del = '1' $whr LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
	  if($db->query($Query2) && $db->get_num_rows() > 0)
	   {
	   $vehdetails = $db->fetch_all_assoc();
	  } 
	  

	$vehqdetails = array();

 	for($i=0; $i<sizeof($vehdetails); $i++)
	{
		$id = $vehdetails[$i]['del_by'];
	$Query3 = "SELECT admin_name  FROM ".TBL_ADMIN." Where  admin_id = '$id'";
	  if($db->query($Query3) && $db->get_num_rows() > 0)
	   {
		   $name = $db ->fetch_row();
		   $vehdetails[$i]['del_by'] =  $name[0];
		   $vehdetails[$i]['del_date'] = convertDateFromMySQL( $vehdetails[$i]['del_date']);
	    }
		else
		{
	     
	   } 
    }
	 $pages =  $pagination->display_pagination();	
	  
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Vehicle Types";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign_by_ref('vehtypedetails',$vehdetails);
	//$smarty->assign_by_ref('vehqdetails',$vehqdetails);	
	$smarty->assign("pages",$pages);	
	$smarty->display('vehtpl/veh_trash.tpl');
		
?> 