<?php
   	/* *************************** *
	   * Date: 30-Jan-2010
	   * Attendance/index.php
	   * Abid Malik
	   *************************** */

include_once('../DBAccess/Database.inc.php');
include('../Classes/pagination-class.php');	

function Date_convertor($date)
{
	$date = explode('-',$date);
	$year  = $date[1];
	$month = $date[0];
	$mon  = date("M", mktime(0, 0, 0, $month));
	$result = $mon.' - '.$year.'|'.$year.'-'.$month;
	return $result;
}

$db = new Database;	
//$db2 = new Database;	

$db->connect();
//$db2->connect();

//-------------------------------- page code -------------------------------------------//
	if(verify($_REQUEST['search'] ,"index.php"))
	{
		$sdate =convertDateToMySQL(sql_replace($_REQUEST['startdate']));
		$edate = convertDateToMySQL(sql_replace($_REQUEST['enddate']));
		 if(isset($_REQUEST['uid']))
		 {
			 $user_id = sql_replace($_REQUEST['uid']);
		 }
		 else
		 {
			$user_id = sql_replace($_REQUEST['user']);
		 }
		$condition = "WHERE date between '$sdate' and '$edate'";
		if(verify($_REQUEST['user'],"index.php"))
		{
			$condition .= " and user = '$user_id' ";
		}
	}
	
	else if(verify($_GET['q_date'] ,"index.php"))
	{
		$month = $_GET['q_date'] ;
		$sdate =$month.'-01';
		$edate = $month.'-31';
		$condition = "WHERE date between '$sdate' and '$edate'";
	}
	/*			Code for Trash can, if added in future	
	
	else if(isset($_GET['state']) && $_GET['state'] != '')
	{
		$condition = " del = '1' ";
	}
	
	end of trash can code	*/
	else
	{
		$condition = "";
	}
//-------------------------------- page code -------------------------------------------//	
	if(verify($_REQUEST['clear'] ,"index.php"))
	{
		$delQuery = "Delete From ".TBL_ALOG." $condition";
		if($db->query($delQuery))
		{  		
         	$msgs .= 'Record Removed Successfully<br>';
		}
		else
		{
		 	$error .= 'Error occured while removing the record<br>';		
		}  
	}	
	
	if(verify($_REQUEST['uid'] ,"index.php"))
	{
		$condition .=  'Where user = '.$_GET['uid'];
		$smarty->assign("uid",$_GET['uid']);
	}
	
	//$query = "Select * From ".TBL_ATNDS." where date='$date'";
	$cQuery = "SELECT Count(*) FROM ".TBL_ALOG."  $condition";
	$totalRows = $db->executeScalar($cQuery);
 
     if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
	 
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows);
	 
	 
	$query = "SELECT * FROM ".TBL_ALOG."  $condition ORDER BY date LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$log = $db->fetch_all_assoc();
	}
for($i = 0 ;$i<sizeof($log);$i++)
{
	$log[$i]['date'] = convertDateFromMySQL($log[$i]['date']);
	$user = $log[$i]['user'];
	$query = "SELECT admin_name, admin_lname FROM ".TBL_ADMIN." WHERE admin_id = '$user'";
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$drivers = $db->fetch_row_assoc();
	}
	$log[$i]['user'] = $drivers['admin_name'].' '.$drivers['admin_lname'];
	
}
$query = 'SELECT  DISTINCT date_format(date, "%m-%Y") as list  FROM '.TBL_ALOG;
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$dates = $db->fetch_all_assoc();
	}
for($d = 0;$d<sizeof($dates);$d++)
{
	$list = explode('|',Date_convertor($dates[$d]['list']));
	$dates[$d]['name'] = $list[0];
	$dates[$d]['date'] = $list[1];
}
$qUsers = "SELECT  admin_name, admin_lname, admin_id FROM ".TBL_ADMIN." WHERE admin_level != '0'";
if($db->query($qUsers) && $db->get_num_rows() > 0)
	{
		$users = $db->fetch_all_assoc();
	}
$sdate = convertDateFromMySQL($sdate);
$edate = convertDateFromMySQL($edate);
$pages =  $pagination->display_pagination();	
$url ="http://".$_SERVER['MMTP_HOST'].$_SERVER['REQUEST_URI'];
//----------------------------------- End page code -----------------------------------//


	$db->close();
//	$db2->close();
	$smarty->assign("quicksearch",$quicksearch);
	$smarty->assign("sdate",$sdate);
	$smarty->assign("edate",$edate);
	$smarty->assign("month",$month);
	$smarty->assign("user_id",$user_id);
	$smarty->assign("users",$users);
	$smarty->assign("dates",$dates);
	$smarty->assign("url",$url);
	
    $pgTitle = "Admin Panel -- Attendance Managment";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign('log',$log);
	$smarty->assign("pages",$pages);
	$smarty->assign("st",$st);			
	$smarty->display('logtpl/index.tpl');
		
?>  