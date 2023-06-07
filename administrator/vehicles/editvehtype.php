<?php

/* *************************** *

	   * Created On : 21th August,2008 

	   * File : CMS/editpage.php

	   * Created By : Danish Ejaz Qureshi

	   * Modified On : 20th August,2008 

	   * Modified By : Danish Ejaz Qureshi

	   *************************** */



   	include_once('../DBAccess/Database.inc.php');



	$db = new Database;	

		

	$msgs   = '';

	$errors = '';

		

	$db->connect();

    $vid = intval($_GET['id']);

	

 //if page is submitted

    if(isset($_POST['editvehtype']))

     {

	 $hidvehtype = sql_replace($_POST['hidvehtype']);	

	 $vehtype = sql_replace($_POST['vehtype']);
	  
	 $vcode    = sql_replace($_POST['vcode']);
	
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



      if($vehtype != $hidvehtype){

	

	  

        $chkvtype = "SELECT * FROM  " . TBL_VEHTYPES . "  WHERE vehtype='$vehtype'"; 

         if($db->query($chkvtype) && $db->get_num_rows() > 0)

		 {

		    $error .= 'Type already exist, Try another one.<br>';

			echo "<script>alert('Type already exist, Try another one');</script>";

            echo "<script>window.open('vehtypes.php','_parent');</script>";

			exit; 

		 }}



      if(!$error){	 

	 

       $Query = "UPDATE " . TBL_VEHTYPES . " SET 
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
				 oxygen_ch 	=  '$oxygen_ch' WHERE id='".$vid."'";

				 

		  if($db->execute($Query))

		    { echo "<script>alert('Vehicle Type updated Successfully');</script>";			  

			  }else{ echo "<script>alert('Unable to update vehicle type');</script>";

			 }

             echo "<script>window.open('vehtypes.php','_parent');</script>";

			 exit;

	    }

    }



       else{

    $query = "SELECT * FROM ".TBL_VEHTYPES." WHERE id='".$vid."'";

       

	      if($db->query($query) && $db->get_num_rows())

			  {

			  $udata = $db->fetch_all_assoc();

			  }

  	  $vcode       = $udata[0]['vcode'];	

	  $vehtype      = $udata[0]['vehtype'];	

	  $hidvehtype   = $udata[0]['vehtype'];		  
		
	  $pickup_ch 	= $udata[0]['pickup_ch'];
	  $permile_ch 	= $udata[0]['permile_ch'];
	  $waittime_ch 	= $udata[0]['waittime_ch'];
	  $noshow_ch 		= $udata[0]['noshow_ch'];
	  $afterhour_ch 	= $udata[0]['afterhour_ch'];
	  $stretcher_ch	= $udata[0]['stretcher_ch'];
	  $dstretcher_ch 	= $udata[0]['dstretcher_ch'];
	  $bstretcher_ch 	= $udata[0]['bstretcher_ch'];
	  $doublewheel_ch	= $udata[0]['doublewheel_ch'];
	  $oxygen_ch 	= $udata[0]['oxygen_ch'];
  	}

  

  





		

	$db->close();



    $pgTitle = "Admin Panel -- Vehicle Types [Edit]";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("id",$vid);

	$smarty->assign("vehtype",$vehtype);

	$smarty->assign("hidvehtype",$hidvehtype);
	
	$smarty->assign("vcode",$vcode);
	$smarty->assign("bcharges",$bcharges);
	$smarty->assign("mcharges",$mcharges);
	$smarty->assign("wtcharges",$wtcharges);
	$smarty->assign("acharges",$acharges);	
	
	$smarty->assign("pickup_ch",$pickup_ch );	
	$smarty->assign("permile_ch",$permile_ch );	
	$smarty->assign("waittime_ch",$waittime_ch );
	$smarty->assign("noshow_ch",$noshow_ch );
	$smarty->assign("afterhour_ch",$afterhour_ch );
	$smarty->assign("stretcher_ch",$stretcher_ch );
	$smarty->assign("dstretcher_ch",$dstretcher_ch );
	$smarty->assign("bstretcher_ch",$bstretcher_ch );
	$smarty->assign("doublewheel_ch",$doublewheel_ch );
	$smarty->assign("oxygen_ch",$oxygen_ch );

	$smarty->display('vehtpl/editvehtype.tpl');

		

?>