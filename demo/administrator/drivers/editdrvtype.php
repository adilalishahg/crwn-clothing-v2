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

	  $hiddrvtype  = sql_replace($_POST['hiddrvtype']);

	  $drvtype     = sql_replace($_POST['drvtype']);	

	  $drvduration = sql_replace($_POST['drvduration']);	

	  	 	

	   if(!$drvtype)

	    { $error .= "Type title Missing !<br>"; }

	  	 	

	   if(!$drvduration)

	    { $error .= "Job Duration Missing !<br>"; }		



       if($hiddrvtype != $drvtype){

        $chkvtype = "SELECT * FROM  " . TBL_DRVTYPES . "  WHERE dtype_name='$drvtype'"; 

         

		if($db->query($chkvtype) && $db->get_num_rows() > 0)

		 {

		    $error .= 'Type already exist, Try another one.<br>';

			echo "<script>alert('Type already exist, Try another one');</script>";

            echo "<script>window.open('drvtypes.php','_parent');</script>";

			exit; 

		 }

       }

	   

      if(!$error){	 

	 

       $Query = "UPDATE " . TBL_DRVTYPES . " SET 

	             dtype_name = '$drvtype',dtype_duration='$drvduration' WHERE dtype_id='".$vid."'";

				 

		  if($db->execute($Query))

		    { echo "<script>alert('Driver Type updated Successfully');</script>";			  

			  }else{ echo "<script>alert('Unable to update driver type');</script>";

			 }

             echo "<script>window.open('drvtypes.php','_parent');</script>";

			 exit;

	    }

    }



       else{

    $query = "SELECT * FROM ".TBL_DRVTYPES." WHERE dtype_id='".$vid."'";

       

	      if($db->query($query) && $db->get_num_rows())

			  {

			  $udata = $db->fetch_all_assoc();

			  }

  

	  $hiddrvtype    = $udata[0]['dtype_name'];

	  $drvtype       = $udata[0]['dtype_name'];

	  $drvduration   = $udata[0]['dtype_duration']; 		  

  	}

  

  





		

	$db->close();



    $pgTitle = "Admin Panel -- Driver Types [Edit]";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("id",$vid);

	$smarty->assign("hiddrvtype",$hiddrvtype);

	$smarty->assign("drvtype",$drvtype);

	$smarty->assign("drvduration",$drvduration);				

	$smarty->display('drvtpl/editdrvtype.tpl');

		

?>