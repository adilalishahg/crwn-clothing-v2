<?php

   	include_once('../DBAccess/Database.inc.php');

	

	$db= new Database;    	

	$db->connect();

	

	$did 	=	$_POST['drv_id'];

	$tid 	=	$_POST['trp_id'];

	$tdate 	=	$_POST['trp_date'];

	$ttime 	=	$_POST['trp_time'];


  	$chkQuery1 = "SELECT * FROM ".TBL_TRIP_DET." WHERE drv_id = '".$did."' AND date = '".$tdate."' AND pck_time = '".$ttime."' ";

    	if($db->query($chkQuery1) && $db->get_num_rows() > 0)

	 	echo '0';

	 else

	 	echo '1';

?>