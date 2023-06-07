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

	//$query = "SELECT SUM(trip_distance) as miles FROM ".TBL_TRIPS."  WHERE   trip_veh  = '$veh_id'";

	$query = "SELECT * FROM ".TBL_TRIP_DET."  WHERE   veh_id  = '$veh_id'";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$data = $db->fetch_all_assoc();

	}

	for($i = 0 ;$i<sizeof($data);$i++)

	{

		$id  = $data[$i]['trip_id'];

	

		$query = "SELECT  trip_user, trip_clinic, trip_date FROM ".TBL_TRIPS." WHERE trip_id  = '$id'";

		if($db->query($query) && $db->get_num_rows() > 0)

		{

			$trip= $db->fetch_row_assoc();

		}

		$data[$i]['trip_user']  = $trip['trip_user'];

		$data[$i]['trip_clinic'] = $trip['trip_clinic'];

		$data[$i]['trip_date'] = convertDateFROMMySQL($trip['trip_date']);

	}

	

	$query = "SELECT  vnumber, vname FROM ".TBL_VEHICLES." WHERE id  = '$veh_id'";

	if($db->query($query) && $db->get_num_rows() > 0)

	{

		$vehicle= $db->fetch_row_assoc();

	}

	//$data[$i]['veh_num']  = $veh['vnumber'];

	//$data[$i]['veh_name'] = $veh['vname'];

	//debug($data);

}





//----------------------------------- End page code -----------------------------------//

	 
    //debug($data);


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

	$smarty->display('vehtpl/mil_history.tpl');

		

?>  