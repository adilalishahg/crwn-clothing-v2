<?php

/* *************************** *

	   * Created On : 21th August,2008 

	   * File : cms/addpage.php

	   * Created By : Danish Ejaz Qureshi

	   * Modified On : 20th August,2008 

	   * Modified By : Danish Ejaz Qureshi

	   *************************** */

   	



   	include_once('../DBAccess/Database.inc.php');

	

	$db = new Database;	

		

	$msgs   = '';

	$errors = '';

		

	$db->connect();



 //if page is submitted

    if(isset($_POST['Addvehtype']))

     {
	 
	  $vcode = sql_replace($_POST['vcode']);	
	  $vehtype = sql_replace($_POST['vehtype']);
	  $pickup_ch 	= sql_replace($_POST['pickup_ch']);
	  $permile_ch 	= sql_replace($_POST['permile_ch']);
	  $waittime_ch 	= sql_replace($_POST['waittime_ch']);
	  $noshow_ch 		= sql_replace($_POST['noshow_ch']);
	  $afterhour_ch 	= sql_replace($_POST['afterhour_ch']);
	  $stretcher_ch	= sql_replace($_POST['stretcher_ch']);
	  $dstretcher_ch 	= sql_replace($_POST['dstretcher_ch']);
	  $bstretcher_ch 	= sql_replace($_POST['bstretcher_ch']);
	  $doublewheel_ch	= sql_replace($_POST['doublewheel_ch']);
	  $oxygen_ch 	= sql_replace($_POST['oxygen_ch']);

	  if(!$vcode)
	  
	    { $error .= "Vehicle Code Missing!<br>"; }	 	

	   if(!$vehtype)

	    { $error .= "Type title Missing !<br>"; }



        $chkvtype = "SELECT * FROM  " . TBL_VEHTYPES . "  WHERE vehtype='$vehtype'"; 

         

		if($db->query($chkvtype) && $db->get_num_rows() > 0)

		 {

		    $error .= 'Type already exist, Try another one.<br>';

			echo "<script>alert('Type already exist, Try another one');</script>";

            echo "<script>window.open('vehtypes.php','_parent');</script>";

			exit; 

		 }



      if(!$error){	 

	 

       $Query = "INSERT INTO  " . TBL_VEHTYPES . " SET 
				 vcode='$vcode',
	             vehtype = '$vehtype',
				 pickup_ch 		=  '$pickup_ch',
				 permile_ch 		=  '$permile_ch',
				 waittime_ch 	=  '$waittime_ch',
				 noshow_ch 		=  '$noshow_ch',
				 afterhour_ch 	=  '$afterhour_ch',
				 stretcher_ch 	=  '$stretcher_ch',
				 dstretcher_ch 	=  '$dstretcher_ch',
				 bstretcher_ch 	=  '$bstretcher_ch',
				 doublewheel_ch 	=  '$doublewheel_ch',
				 oxygen_ch 	=  '$oxygen_ch'
				 ";				 

		  if($db->execute($Query))

		    { echo "<script>alert('Vehicle Type added Successfully');</script>";			  

			  }else{ echo "<script>alert('Unable to add vehicle type');</script>";

			 }

             echo "<script>window.open('vehtypes.php','_parent');</script>";

			 exit;

		    }

          }

		

	$db->close();



    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [Add Vehicle Type]";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("vehtype",$vehtype);		

	$smarty->display('vehtpl/addvehtype.tpl');

		

?>