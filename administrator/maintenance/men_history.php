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



if(verify($_GET['id'] ,"index.php"))

{

	$veh_id = $_GET['id'];

	$query = "SELECT * FROM ".TBL_MNTNCE."  WHERE   veh_id  = '$veh_id'  ORDER BY date";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$data = $db->fetch_all_assoc();

	}

	

	for($i = 0 ;$i<sizeof($data);$i++)

	{

		$data[$i]['date'] = convertDateFROMMySQL($data[$i]['date']);
		$tQuery = "SELECT * from ".TBL_MENTYPES." WHERE id = ".$data[$i]['m_type']."";
		if($db->query($tQuery) && $db->get_num_rows() > 0)
		{
			$type = $db->fetch_row_assoc();
		}
		$data[$i]['m_type'] = $type['mentype']; 

	}
	//debug($data);
	$query = "SELECT  vnumber, vname FROM ".TBL_VEHICLES." WHERE  id  = '$veh_id'";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$vehicle = $db->fetch_row_assoc();

	}

}





//----------------------------------- End page code -----------------------------------//

	 



	$db->close();

//	$db2->close();

	

    $pgTitle = "Admin Panel -- Attendance Managment";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);	

	$smarty->assign('data',$data);

	$smarty->assign("vehicle",$vehicle);

	$smarty->assign("pages",$pages);

	$smarty->assign("st",$st);			

	$smarty->display('mntncetpl/men_history.tpl');

		

?>  