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
if(verify($_GET['delid'],""))
{
	$del_id = $_GET['delid'];
	echo $del_query = "Delete From ".TBL_MNTNCE." where id='$del_id'";
	if($db->query($del_query) )
	{
		echo '<script>alert("Record Deleted Successfully!;</script>';
		@header("location:index.php");
	}
}

else
{
	if(verify($_POST['search'] ,"index.php"))
	{
		$sdate =convertDateToMySQL(sql_replace($_POST['startdate']));
		$edate = convertDateToMySQL(sql_replace($_POST['enddate']));
		$veh_id = sql_replace($_POST['veh_id']);
		$condition = " AND date between '$sdate' and '$edate'";
		if(verify($_POST['veh_id'],"index.php"))
		{
			$condition .= " AND veh_id = '$veh_id' ";
		}
	}
	
	else if(verify($_GET['q_date'] ,"index.php"))
	{
		$month = $_GET['q_date'] ;
		$sdate =$month.'-01';
		$edate = $month.'-31';
		$condition = "AND date between '$sdate' and '$edate'";
	}
	/*			Code for Trash can, if added in future	
	
	else if(isset($_GET['state']) && $_GET['state'] != '')
	{
		$condition = " del = '1' ";
	}
	
	end of trash can code	*/
	//$query = "Select * From ".TBL_ATNDS." where date='$date'";
	$query = "SELECT a.*, b.vnumber, b.vname FROM ".TBL_MNTNCE." as a, ".TBL_VEHICLES." as b WHERE a.veh_id = b.id  $condition  ORDER BY date";
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$data = $db->fetch_all_assoc();
	}
}
for($i = 0 ;$i<sizeof($data);$i++)
{
	$id = $data[$i]['m_type'];
	$tquery = "SELECT mentype FROM ".TBL_MENTYPES." WHERE  id = '$id'";
	if($db->query($tquery) && $db->get_num_rows() > 0)
	{
		$type = $db->fetch_row_assoc();
	}
	$data[$i]['type'] = $type['mentype'];
}

$query = "SELECT  Drvid, fname, lname FROM ".TBL_DRIVERS;
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$drivers = $db->fetch_all_assoc();
	}
$query = 'SELECT  DISTINCT date_format(date, "%m-%Y") as list  FROM '.TBL_MNTNCE;
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
$sdate = convertDateFromMySQL($sdate);
$edate = convertDateFromMySQL($edate);

 $query = "SELECT  id, vnumber, vname FROM ".TBL_VEHICLES;
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$vehicles = $db->fetch_all_assoc();
	}
//----------------------------------- End page code -----------------------------------//


    /*if(isset($_GET['v']) && $_GET['v'] != ''){
	  if($_GET['v'] == 's'){ $msgs .= "Vehicle Added Successfully! <br>"; }
	  if($_GET['v'] == 'e'){ $msgs .= "Vehicle Updated Successfully! <br>"; }	
	}

    if(isset($_GET['f']) && $_GET['f'] != ''){
	  if($_GET['f'] == 's'){ $msgs .= "Vehicles Fuel re-filling updated! <br>"; }
	  if($_GET['f'] == 'f'){ $msgs .= "Unable to add fuel data! <br>"; }	
	}
	

// Delete Vehicle Script
    if(isset($_GET['delId']) && $_GET['delId'] != ''){
   		$QueryDel = "DELETE FROM ".TBL_VEHICLES." WHERE id='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{  		
         $msgs .= 'Record Removed Successfully<br>';
		}else{
		 $error .= 'Error occured while removing the record<br>';		
		}  
  	}



	
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	
	$limit = 20;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20; 


// Fetch all vehicles list
     
	 if(isset($_GET['st']) && $_GET['st'] != ''){
		$st = $_GET['st'];
		$whr_clz = " AND vstatus='".$_GET['st']."'";
	 }else{
		$st = '';
	  } 	 
	
 
	 $Querypg = "SELECT COUNT(*) FROM ".TBL_VEHICLES.",".TBL_VEHTYPES." WHERE vtype=".TBL_VEHTYPES.".id $whr_clz";	
	 $totalRows = $db->executeScalar($Querypg);
 
     if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
	 
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 
	  
	  
	$Query2 = "SELECT ".TBL_VEHICLES.".*,".TBL_VEHTYPES.".id AS vtid,".TBL_VEHTYPES.".vehtype FROM ".TBL_VEHICLES.",".TBL_VEHTYPES." WHERE vtype=".TBL_VEHTYPES.".id $whr_clz LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
   if($db->query($Query2) && $db->get_num_rows() > 0)
	{
	   $vehdetails = $db->fetch_all_assoc();
	} 

   for($i=0; $i<sizeof($vehdetails); $i++){
   
   	 $rQuery = "SELECT * FROM ".TBL_FUELLOG." WHERE veh_id=".$vehdetails[$i]['id']." ORDER BY fid DESC LIMIT 1";	
      if($db->query($rQuery) && $db->get_num_rows() > 0)
	   {
	    $rf = $db->fetch_all_assoc();
	    $vehdetails[$i]['refildate'] = convertDateFromMySQL($rf[0]['refil_date']); 
	   }else{
	   $vehdetails[$i]['refildate'] = 'Not Refilled Yet'; 
	   }
   }*/
/*echo "<pre>";
print_r($dates);
exit;*/
   //   $pages =  $pagination->display_pagination();	
	 

	$db->close();
//	$db2->close();
	$smarty->assign("quicksearch",$quicksearch);
	$smarty->assign("sdate",$sdate);
	$smarty->assign("edate",$edate);
	$smarty->assign("dates",$dates);
	
    $pgTitle = "Admin Panel -- Attendance Managment";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign('data',$data);
	$smarty->assign("vehicles",$vehicles);
	$smarty->assign("pages",$pages);
	$smarty->assign("st",$st);			
	$smarty->display('mntncetpl/index.tpl');
		
?>  