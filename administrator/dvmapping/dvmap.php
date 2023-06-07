<?php

   	/* *************************** *

	   * Date: 29-May-2008 

	   * CMS/index.php

	   * Muhammad Sajid

	   *************************** */

   	include_once('../DBAccess/Database.inc.php');



    $msgs = '';

	$noRec = '';

	$db = new Database;	

	$db2 = new Database;	

	$db3 = new Database;	

	$db4 = new Database;			

    	

	$db->connect();

	$db2->connect();

	$db3->connect();

	$db4->connect();



//CHECK IF EVERY POSTED DATA IS VALID AND SET

if(isset($_POST['drv']) && $_POST['veh'] && $_POST['vehnp'] && $_POST['drv'] != '' && $_POST['veh'] != '' && $_POST['vehnp'] != ''){

 

 

 //GET DRIVER DETAILS

 $drvQuery1 = "SELECT * FROM ".TBL_DRIVERS." WHERE Drvid='".$_POST['drv']."'";

   if($db->query($drvQuery1) && $db->get_num_rows() > 0)

	{   $drvdetails = $db->fetch_all_assoc();	} 

	

	

//GET VEHICLE DETAILS	

 $vehQuery1 = "SELECT * FROM ".TBL_VEHICLES." WHERE id='".$_POST['veh']."'";

   if($db->query($vehQuery1) && $db->get_num_rows() > 0)

	{   $vehdetails = $db->fetch_all_assoc();	} 



//CHECK	

 $vehQuery3 = "SELECT * FROM ".TBL_DVMAPPING." WHERE veh_id='".$_POST['veh']."'";

   if($db->query($vehQuery3) && $db->get_num_rows() > 0)

	{

	   $d2 = $db->fetch_all_assoc();

	   $prid = $d2[0]['drv_id'];

	 //DELETE PREVIOUS ENTRY



	 

	// $DelQuery = "DELETE FROM ".TBL_DVMAPPING." WHERE veh_id='".$_POST['veh']."'";

    // $db3->execute($DelQuery);

    }



//CHECK IF THIS DRIVER IS ALREADY ASSIGNED A VEHICLE OR NOT

 $chkQuery1 = "SELECT * FROM ".TBL_DVMAPPING." WHERE drv_id='".$_POST['drv']."'";

   if($db->query($chkQuery1) && $db->get_num_rows() > 0)

	{ 

	   $d1 = $db->fetch_all_assoc(); 



	$Query2 = "UPDATE ".TBL_DVMAPPING." SET 

            veh_id='".$_POST['veh']."',

            vehname='".$vehdetails[0]['vname']."',			

			veh_numplate='".$vehdetails[0]['vnumber']."',

			drv_id='".$_POST['drv']."',

			drv_licnum='".$drvdetails[0]['license']."',

			drv_name='".$drvdetails[0]['fname'].' '.$drvdetails[0]['lname']."',

			dv_date=NOW() WHERE mid='".$d1[0]['mid']."'";

			



      if($db2->execute($Query2))

	    { //ADD DATA TO THE MAPPING LOG TABLE  



	/*	$logQuery =	"INSERT INTO ".TBL_MAPPINGLOG." SET 

	            did='".$_POST['drv']."',

				vid='".$_POST['drv']."',

			    drvname='".$drvdetails[0]['fname'].' '.$drvdetails[0]['lname']."',

				vnumplate='".$_POST['vehnp']."',

				vname='".$vehdetails[0]['fname']."',

				mapping_date=NOW()";	

            $db4->execute($logQuery);*/

			echo 'Record Updated^'.$prid;

			exit;

				/*}else{

			echo 'Unable to update vehicle^fail';

			exit;*/

				}    	

	

}else{ 

//IF THIS DRIVER IS NOT ASSIGNED ANY VEHICLE 

     $Query2 = "INSERT INTO ".TBL_DVMAPPING." SET 

	            veh_id='".$_POST['veh']."',

                vehname='".$vehdetails[0]['vname']."',					

				veh_numplate='".$_POST['vehnp']."',

			    drv_id='".$_POST['drv']."',

				drv_licnum='".$drvdetails[0]['license']."',

				drv_name='".$drvdetails[0]['fname'].' '.$drvdetails[0]['lname']."',

				dv_date=NOW()";	

      if($db->execute($Query2))

	    { //ADD DATA TO THE MAPPING LOG TABLE  

			/*$logQuery =	"INSERT INTO ".TBL_MAPPINGLOG." SET 

	            did='".$_POST['drv']."',

				vid='".$_POST['drv']."',

			    drvname='".$drvdetails[0]['fname'].' '.$drvdetails[0]['lname']."',

				vnumplate='".$_POST['vehnp']."',

				vname='".$vehdetails[0]['fname']."',

				mapping_date=NOW()";	

            $db2->execute($logQuery);*/

			if(!isset($prid) && $prid == ''){

			echo 'Record Updated^0'; }else{

				echo 'Record Updated^'.$prid; 

			}

			

			exit;	

        }else{

			echo 'Unable to assign vehicle^fail';

			exit;			

		}

}



}else{



//IF DATA IS NOT POSTED IN DESIRED FORM OR PAGE IS ACCESSSED DIRECTLY

    echo 'Oops! I guess you hit a wrong url';

}



	$db->close();

	$db2->close();

	$db3->close();

	$db4->close();	

?> 