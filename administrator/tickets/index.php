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

if(verify($_GET['del_id'],""))

{

	$del_id = $_GET['del_id'];

	$del_query = "Delete From ".TBL_TCKT." where id='$del_id'";

	if($db->query($del_query) )

	{

		@header("location:index.php");

	}

}



else

{

	if(verify($_POST['search'] ,"index.php"))

	{

		$sdate =convertDateToMySQL($_POST['startdate']);

		$edate = convertDateToMySQL($_POST['enddate']);

		$drv_id = sql_replace($_POST['drv_id']);

		$condition = "Where date between '$sdate' and '$edate'";

		if(verify($_POST['drv_id'],"index.php"))

		{

			$condition .= " and drv_id = '$drv_id' ";

		}

	}

	

	else if(verify($_GET['q_date'] ,"index.php"))

	{

		$month = $_GET['q_date'] ;

		$sdate =$month.'-01';

		$edate = $month.'-31';

		$condition = "Where date between '$sdate' and '$edate'";

	}

	/*			Code for Trash can, if added in future	

	

	else if(isset($_GET['state']) && $_GET['state'] != '')

	{

		$condition = " del = '1' ";

	}

	

	end of trash can code	

	else

	{

		$date = date('Y-m-d',time());

		$condition = "Where date = '$date'";

	}*/

	//$query = "Select * From ".TBL_ATNDS." where date='$date'";

	$query = "SELECT* FROM ".TBL_TCKT. " $condition  ORDER BY id";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$today = $db->fetch_all_assoc();

	}

}



for($i = 0 ;$i<sizeof($today);$i++)

{

	$today[$i]['date'] = convertDateFROMMySQL($today[$i]['date']);

	$id = $today[$i]['drv_id'];

	

	$query = "SELECT  fname, lname FROM ".TBL_DRIVERS." Where Drvid = '$id'";

		if($db->query($query) && $db->get_num_rows() > 0)

		{

			$drivers = $db->fetch_row_assoc();

		}

		$today[$i]['driver'] = $drivers['fname']." ".$drivers['lname'];

}

$query = "SELECT  Drvid, fname, lname FROM ".TBL_DRIVERS." WHERE del!='1'";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$drivers = $db->fetch_all_assoc();

	}

//debug($drivers);

$query = 'SELECT  DISTINCT date_format(date, "%m-%Y") as list  FROM '.TBL_TCKT;

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



//----------------------------------- End page code -----------------------------------//



/*	 $Querypg = "SELECT COUNT(*) FROM ".TBL_VEHICLES.",".TBL_VEHTYPES." WHERE vtype=".TBL_VEHTYPES.".id $whr_clz";	

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

   }



	$pages =  $pagination->display_pagination();	*/

	 



	$db->close();

//	$db2->close();

	$smarty->assign("quicksearch",$quicksearch);

	$smarty->assign("sdate",$sdate);

	$smarty->assign("edate",$edate);

	$smarty->assign("month",$month);

	$smarty->assign("drv_id",$drv_id);

	$smarty->assign("drivers",$drivers);

	$smarty->assign("dates",$dates);

	

    $pgTitle = "Admin Panel -- Ticket Managment";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);	

	$smarty->assign('ticket',$today);

	$smarty->assign("pages",$pages);

	$smarty->assign("st",$st);			

	$smarty->display('tkttpl/index.tpl');

		

?>  