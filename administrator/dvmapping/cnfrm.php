<?php

   	include_once('../DBAccess/Database.inc.php');

		$db= new Database;			

    	

	$db->connect();

	

$id = $_POST['id'];

 $chkQuery1 = "SELECT * FROM ".TBL_DVMAPPING." WHERE veh_id='".$id."'";

   if($db->query($chkQuery1) && $db->get_num_rows() > 0)

	{ 

	   echo '1';

	}

	else

	{

		echo '1';

	}

?>