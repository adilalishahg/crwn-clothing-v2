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

    $mid = intval($_GET['id']);

	

 //if page is submitted

    if(isset($_POST['editmentype']))

     {

	  $hidmentype = sql_replace($_POST['hidmentype']);	

	  $mentype = sql_replace($_POST['mentype']);

	  		 	

	   if(!$mentype)

	    { $error .= "Type title Missing !<br>"; }



      if($mentype != $hidmentype){

        $chkvtype = "SELECT * FROM  " . TBL_MENTYPES . "  WHERE mentype='$mentype'"; 

         if($db->query($chkvtype) && $db->get_num_rows() > 0)

		 {

		    $error .= 'Type already exist, Try another one.<br>';

			echo "<script>alert('Type already exist, Try another one');</script>";

            echo "<script>window.open('men_types.php','_parent');</script>";

			exit; 

		 }}



      if(!$error){	 

	 $mid = intval($_POST['id']);

       $Query = "UPDATE " . TBL_MENTYPES . " SET 

	             mentype = '$mentype' WHERE id='".$mid."'";

				 

		  if($db->execute($Query))

		    { echo "<script>alert('Maintenance Type updated Successfully');</script>";			  

			  }else{ echo "<script>alert('Unable to update Maintenance type');</script>";

			 }

             echo "<script>window.open('men_types.php','_parent');</script>";

			 exit;

	    }

    }



       else{

    $query = "SELECT * FROM ".TBL_MENTYPES." WHERE id='".$mid."'";

       

	      if($db->query($query) && $db->get_num_rows())

			  {

			  $udata = $db->fetch_all_assoc();

			  }

  

  	//debug($udata);

	  $mentype      = $udata[0]['mentype'];	

	  $hidmentype   = $udata[0]['mentype'];		  

  	}

  

  





		

	$db->close();



    $pgTitle = "Admin Panel -- Vehicle Types [Edit]";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("id",$mid);

	$smarty->assign("mentype",$mentype);

	$smarty->assign("hidmentype",$hidmentype);				

	$smarty->display('mntncetpl/edit_type.tpl');

		

?>