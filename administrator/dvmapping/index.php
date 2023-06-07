<?php
   	include_once('../DBAccess/Database.inc.php');

    include('../Classes/pagination-class.php');	





	$db = new Database;	

    $msgs = '';

	$noRec = '';

	$db2 = new Database;	

    	

	$db->connect();

	$db2->connect();

    $dvdetails = array(); 
	$vehicleids = array();   

 

 $Query1 = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' and del = '0' ORDER BY fname ASC";

   if($db->query($Query1) && $db->get_num_rows() > 0)

	{   $drvdetails = $db->fetch_all_assoc();	} 



 for($i=0; $i<sizeof($drvdetails); $i++){



  $Query2 = "SELECT * FROM ".TBL_DVMAPPING." WHERE drv_id='".$drvdetails[$i]['Drvid']."'";

   if($db->query($Query2) && $db->get_num_rows() > 0)

	{   $mapdetails = $db->fetch_all_assoc();	

	    array_push($dvdetails,$mapdetails[0]['veh_numplate']);
		
		array_push($vehicleids,$mapdetails[0]['veh_id']);

	}else{

	    array_push($dvdetails,0);

	} 

   }



$vehids = implode(',',$vehicleids);
if($vehids==''){$vehids='0';}
//echo '<br/>';
  $Query3 = "SELECT * FROM ".TBL_VEHICLES." WHERE vstatus='Open'and del ='0'"; // AND id NOT IN ($vehids)

   if($db->query($Query3) && $db->get_num_rows() > 0)

	{   $vlist = $db->fetch_all_assoc();	} 



	$db->close();

	$db2->close();

    $pgTitle = "Admin Panel -- Driver & Vehicle Mapping";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);	

	$smarty->assign_by_ref('drvdetails',$drvdetails);

	$smarty->assign_by_ref('dvdetails',$dvdetails);

	$smarty->assign_by_ref('vlist',$vlist);			

	$smarty->display('dvtpl/index.tpl');

		

?> 