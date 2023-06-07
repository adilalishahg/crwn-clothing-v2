<?php
   	include_once('../DBAccess/Database.inc.php');

    include('../Classes/pagination-class.php');	

	

	$db = new Database;	

    $msgs = '';

	$noRec = '';

    $error = '';	

	$msgs .= $_GET['msg'];

	$db2 = new Database;	

    	

	$db->connect();

	$db2->connect();

	//  S E A R C H   C O D E   F O R   R E P O R T I N  G //

	if(isset($_GET['submit']))

	{ 

		

		// PA G I N G   C O D E  //

		if(isset($_GET['pageNum']))

		{

			$page_no = $_GET['pageNum'];

		}

		else

		{

			$page_no = '1';	 

		}

		

		$limit = 10;

		$offset = (($page * $limit) - $limit);

		$maxRecord = 10; 

	

		// E N D   P A  G I N  G   C O D E //

		$stdate = sql_replace($_GET['startdate']);

		$enddate   = sql_replace($_GET['enddate']);

	  

	   $hospname   = sql_replace($_GET['hospname']);

	

		$hosp =  sql_replace($_GET['hosp']);

		$patient    = sql_replace($_GET['patient']);

		$drv_id     = sql_replace($_GET['driver_id']);

		$status=sql_replace($_GET['status']);

		

		

		if($hospname == 'other')

		{

			$hospsearch = $hosp;

		}else{

		

		$hospsearch = $hospname;

		

		}

		

		$whr = '';

		

		if($stdate!= '' && $enddate!='')

		{

			$stdate = convertDateToMySQL($stdate);

			$enddate = convertDateToMySQL($enddate);

			$whr = "AND a.trip_date BETWEEN '$stdate' AND '$enddate'";

		}

		

		

		if($status!= '')

		{

			$whr .= "AND b.status='$status'";

		}

		

		

		if($hospsearch!= '')

		{

			$whr .= "AND a.trip_clinic LIKE '%$hospsearch%'";

		}

		

		if($address!= '')

		{

			$whr .= "AND a.trip_user LIKE '%$patient%'";

		}

		

		if($drv_id!= '')

		{

			$whr .= "AND b.drv_id = '$drv_id'";

		}

		

		$cquery = 		"SELECT Count(*) as rows FROM ".TBL_TRIPS." as a, ".TBL_TRIP_DET." as b WHERE a.trip_id=b.trip_id $whr";

		if($db->query($cquery) && $db->get_num_rows() > 0)

		{

			$rows = $db->fetch_row_assoc();

			$totalRows = $rows['rows'];

		}

		

		$pagination = new pagination($_GET['pageNum'],$maxRows=20, $totalRows );

		

	$query = 		"SELECT a.trip_clinic, a.trip_user, b.tdid, b.drv_id, b.trip_miles, b.pck_add, b.drp_add, b.date, c.fname, c.lname, d.drv_rating, d.comments FROM ".TBL_TRIPS." as a, ".TBL_TRIP_DET." as b, ".TBL_DRIVERS."  as c, ".TBL_RATING." as d WHERE a.trip_id=b.trip_id AND c.drv_code = b.drv_id  AND d.trp_id = b.tdid $whr  LIMIT ".$pagination->startRow . ",".$pagination->maxRows;

		if($db->query($query) && $db->get_num_rows() > 0)

		{

			$data = $db->fetch_all_assoc();

		}

		$pages =  $pagination->display_pagination();	

		//debug($data);

	}

	else

	{

		

	}

	

	

	// R E Q U I S E T S   F O R   R E P O R T I N G //

	$query = "SELECT  drv_code, fname, lname FROM ".TBL_DRIVERS." as a,".TBL_DRVTYPES." as b  Where a.drvtype = b.dtype_id AND a.del='0' AND b.del = '0' AND a.drvstatus = 'Active'";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$driver = $db->fetch_all_assoc();

	}

 $cQuery = "SELECT  * FROM ".TBL_HOSPITALS;

		if($db->query($cQuery) && $db->get_num_rows() > 0)

	   			$clinic = $db->fetch_all_assoc();	

					//debug($clinic);	

	$db->close();

	$db2->close();

	

	$stdate = convertDateFromMySQL($stdate);

	$enddate = convertDateFromMySQL($enddate);

	

	$pgTitle = "Admin Panel -- Corporation";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("driver",$driver);	

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);	

	$smarty->assign("data",$data);	

	$smarty ->assign("clinic",$clinic);

		$smarty->assign("pages",$pages);	

	$smarty->assign('drv_id',$drv_id);

	$smarty->assign('stdate',$stdate);	

	$smarty->assign("enddate",$enddate);		

	$smarty->assign("hospname",$hospname);		

	$smarty->assign("address",$address);	

	$smarty->assign("hosp",$hosp);	

	

	$smarty->display('reportstpl/rep_MMT3.tpl');

	

?>