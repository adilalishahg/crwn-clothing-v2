<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$whr_name ='';
	$db2 = new Database;	
    $db->connect();
	$db2->connect();
	if(isset($_GET['d']) && $_GET['d'] != ''){
	  if($_GET['d'] == 's'){ $msgs .= "Driver Added Successfully! <br>"; }
	  if($_GET['d'] == 'e'){ $msgs .= "Driver Updated Successfully! <br>"; }	
	}
// Delete Vehicle Script
    if(isset($_GET['delId']) && $_GET['delId'] != ''){
		
		$date = date('Y-m-d',time());
		$del_by = $_SESSION['admuser']['admin_id'];
   		//$QueryDel = "UPDATE ".TBL_DRIVERS." SET del = '1', del_date = '$date', del_by = '$del_by' WHERE Drvid='".$_GET['delId']."'";
  		$QueryDel = "DELETE FROM ".TBL_DRIVERS." WHERE Drvid='".$_GET['delId']."'";
		if($db->query($QueryDel))
		{  		
         $msgs .= 'Record Removed Successfully<br>';
		}else{
		 $error .= 'Error occured while removing the record<br>';		
		}  
  	}
	/*************** Paging ************** */
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	$limit = 6;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 6; 
// Fetch all drivers list
	 if(isset($_GET['st']) && $_GET['st'] != '')
	 {
		$st = $_GET['st'];
		if($st == 'All')
		{
			$whr_clz = '';
		}
		else
		{
			$st = $_GET['st'];
			$whr_clz = " AND d.drvstatus='".$_GET['st']."'";
		}
	 }else{
		$st = 'Active';
		$whr_clz = " AND d.drvstatus='Active'";
	  } 	 
	 if(isset($_GET['name']) && $_GET['name'] !=''){
		$whr_name .= " AND d.fname LIKE '%".$_GET['name']."%' OR d.lname LIKE '%".$_GET['name']."%' ";
		}
	// $Querypg = "SELECT COUNT(*) FROM ".TBL_DRIVERS.",".TBL_DRVTYPES." WHERE  drvtype=".TBL_DRVTYPES.".dtype_id  $whr_clz";	
	$Querypg = "SELECT d.Drvid	FROM ".TBL_DRIVERS." as d
	WHERE 1=1  $whr_clz $whr_name 	group by d.fname"  ;
	
	
		   if($db->query($Querypg) && $db->get_num_rows() > 0)
			{
			   $totalRows = $db->get_num_rows();
			} 
 
     if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
	 
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=200,$totalRows); 
		/*$Query2 = "SELECT d.Drvid,d.drv_code, d.ssn,  CONCAT(d.fname,' ',d.lname) as name, dt.dtype_name, d.addr,d.city,d.day_phnum, COUNT( DISTINCT (td.tdid) ) as tot, CAST(AVG( r.drv_rating )as signed ) as rating
	FROM ".TBL_DRIVERS." as d
	LEFT outer JOIN ".TBL_DRVTYPES." as dt ON (dt.dtype_id=d.drvtype) 
	LEFT JOIN ".TBL_TRIP_DET." as td ON (td.drv_id=d.drv_code) 
	left outer join ".TBL_RATING." as r on (r.drv_id = d.drv_code) 
	WHERE 1=1 $whr_clz $whr_name 
	group by d.fname order by d.fname ASC  LIMIT ".$pagination->startRow . ",".$pagination->maxRows;*/
	$Query2 = "SELECT d.Drvid,d.drv_code, d.ssn,  CONCAT(d.fname,' ',d.lname) as name, dt.dtype_name, d.addr,d.city,d.day_phnum
	FROM ".TBL_DRIVERS." as d
	LEFT outer JOIN ".TBL_DRVTYPES." as dt ON (dt.dtype_id=d.drvtype) 
	WHERE 1=1 $whr_clz $whr_name 
	order by d.fname ASC  LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
		   if($db->query($Query2) && $db->get_num_rows() > 0)
			{ 
			   $drvdetails = $db->fetch_all_assoc();
			} 
$Query22 = "SELECT COUNT(*) as count 	FROM ".TBL_DRIVERS." WHERE drvstatus='Active'";
		   if($db->query($Query22) && $db->get_num_rows() > 0)
			{ 
			   $dt = $db->fetch_one_assoc(); $count=$dt['count'];
			} 
		
	
			
      $pages =  $pagination->display_pagination();	
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Drivers Managment";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign_by_ref('drvdetails',$drvdetails);
	$smarty->assign("pages",$pages);
	$smarty->assign("st",$st);	
	$smarty->assign("count",$count);	
	$smarty->assign("byname",$_GET['name']);			
	$smarty->display('drvtpl/index.tpl');
?> 