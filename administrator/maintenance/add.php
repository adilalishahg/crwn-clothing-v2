<?php

/* *************************** *

	   * Created On : 30 Jan 2010

	   * File : attendance/timeout.php

	   * Abid Mehmood Malik

	   *************************** */



include_once('../DBAccess/Database.inc.php');




$db3 = new Database;	

$db3 ->connect();

if(isset($_POST['update']))

{

	$veh_id = $_POST['veh_id'];

	$date =  convertDateToMySQL($_POST['date']);

	$type = $_POST['type'];

	$desc = $_POST['desc'];

	$cost = $_POST['cost'];

	$status = '1';//$_POST['status'];

	

	$dated = date('Y-m-d',time());

	$user = $_SESSION['admuser']['admin_id'];

	

	$query_u = "INSERT INTO ".TBL_MNTNCE." SET 

								veh_id					= 		'$veh_id',

								date 						= 		'$date',

								m_type					= 		'$type',

								m_description	= 		'$desc',

								cost						= 		'$cost',

								status					=		'$status',

								add_by					= 		'$user',

								u_date					= 		'$dated'";

		if($db3->query($query_u))

		{
			echo '<script>location.href="index.php";</script>';
			@header("location:index.php");

		}

}

else

{

	$date = date('Y-m-d',time());

	 $query = "SELECT  id, vnumber, vname FROM ".TBL_VEHICLES;

	if($db3->query($query) && $db3->get_num_rows() > 0)

	{

		$vehicles = $db3->fetch_all_assoc();

	}

	$t_query = "SELECT * FROM  " . TBL_MENTYPES ;

	if($db3->query($t_query) && $db3->get_num_rows() > 0)

	{

		$types = $db3->fetch_all_assoc();

	}



}





$date = convertDateFromMySQL($date);



		

	$db3 ->close();





	$smarty->assign("types",$types);

	$smarty->assign("drv_name",$drv_name);

	$smarty->assign("vehicles",$vehicles);

	$smarty->assign("date",$date);	

	$smarty->display('mntncetpl/add.tpl');

		

?>