<?php
include_once('../DBAccess/Database.inc.php');
include('../Classes/pagination-class.php');	
$db = new Database;	
$db->connect();
if(verify($_GET['dataset'],"index.php"))
{
	if(!empty($_GET['Page']))
	{ 
		$page = $_GET['Page']; 
	}
	else
	{ 
		$page =0; 
	}
	$limit = 20;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20; 
	$drv_id = $_GET['dataset'];
/*
	$qcount  = "SELECT Count(*) FROM ".TBL_RATING.",".TBL_TRIP_DET." Where  ".TBL_RATING.".drv_id='$drv_id ' AND ".TBL_RATING.".trp_id=".TBL_TRIP_DET.".tdid";
*/
	$qcount  = "SELECT td.tdid, td.date, t.trip_clinic, td.pck_add, td.drp_add, td.pck_time, td.aptime, td.drp_time, td.drp_atime, td.trip_miles, CAST(avg(r.drv_rating) as SIGNED) as drv_rating, td.pickStatus, td.status 
		    FROM ".TBL_DRIVERS." d 
			left outer join ".TBL_TRIP_DET." AS td on (d.drv_code = td.drv_id)
			LEFT OUTER JOIN ".TBL_RATING." AS r ON ( td.tdid = r.trp_id ) 
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			WHERE d.drv_code = '$drv_id'
			group by td.tdid";  
	if($db->query($qcount) && $db->get_num_rows() > 0)
	{
		$totalRows = $db->get_num_rows();
	}
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 
	//$query = "SELECT * From ".TBL_TRIP_DET." Where  drv_id 	= '$drv_id ' AND status != '0' LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
/*
	$query = "SELECT * From ".TBL_RATING.",".TBL_TRIP_DET." Where  ".TBL_RATING.".drv_id='$drv_id ' AND ".TBL_RATING.".trp_id=".TBL_TRIP_DET.".tdid AND ".TBL_TRIP_DET.".status != '0' LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
*/
   $query = "SELECT td.tdid, td.date,td.drp_ptime, t.trip_clinic, td.pck_add, td.drp_add, td.pck_time, td.aptime, td.drp_time, td.drp_atime, td.trip_miles, CAST(avg(r.drv_rating) as SIGNED) as drv_rating, td.pickStatus, td.status 
			FROM ".TBL_DRIVERS." d 
			left outer join ".TBL_TRIP_DET." AS td on (d.drv_code = td.drv_id)
			LEFT OUTER JOIN ".TBL_RATING." AS r ON ( td.tdid = r.trp_id ) 
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			WHERE d.drv_code = '$drv_id'
			group by td.tdid LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
	if($db->query($query) && $db->get_num_rows() > 0)
	{
	$trips = $db->fetch_all_assoc();
	}
/*
	for($i = 0;$i<sizeof($trips);$i++)
	{
		$id = $trips[$i]['tdid'];
		$trip = $trips[$i]['trip_id'];
		$tQuery = "SELECT trip_clinic, trip_date
							  FROM ".TBL_TRIPS."
							  WHERE trip_id = $trip";
		if($db->query($tQuery) && $db->get_num_rows() > 0)
		{
			$trip_rec = $db->fetch_row_assoc();
			$trips[$i]['trip_clinic'] = $trip_rec['trip_clinic'];
			$trips[$i]['trip_date'] = $trip_rec['trip_date'];
		}
		$q_rating = "SELECT AVG(drv_rating) From ".TBL_RATING." WHERE trp_id ='$id'";
		if($db->query($q_rating) && $db->get_num_rows() > 0)
		{
			$rate = $db->fetch_row_assoc();
			$trips[$i]['rating'] = $rate['drv_rating'];
		}
	}
*/
	      $pages =  $pagination->display_pagination();	
}
//debug($trips);
$db->close();
$pgTitle = "Admin Panel -- Trips History";
$smarty->assign('trips',$trips);
$smarty->assign("pages",$pages);	
$smarty->display('drvtpl/history.tpl');
?> 