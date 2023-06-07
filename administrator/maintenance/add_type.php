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
    if(isset($_POST['Addmentype']))
     {
	  $mentype = sql_replace($_POST['mentype']);	
		 	
	   if(!$mentype)
	    { 
			$error .= "Type title Missing !<br>"; 
		}

		$chkvtype = "SELECT * FROM  " . TBL_MENTYPES . "  WHERE mentype='$mentype'"; 
         if($db->query($chkvtype) && $db->get_num_rows() > 0)
		 {
		    $error .= 'Type already exist, Try another one.<br>';
			echo "<script>alert('Type already exist, Try another one');</script>";
            echo "<script>window.open('men_types.php','_parent');</script>";
			@header("header:men_types.php");
			exit; 
		 }
		 
       $Query = "INSERT INTO  " . TBL_MENTYPES . " SET 
	             mentype = '$mentype'";
				 
		  if($db->execute($Query))
		    { 
				echo "<script>alert('Maintenance Type added Successfully');</script>";			  
			}
			else
			{
				echo "<script>alert('Unable to add Maintenance type');</script>";
			 }
             echo "<script>window.open('men_types.php','_parent');</script>";
			 exit;
          }
		
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [Add Vehicle Type]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("vehtype",$vehtype);		
	$smarty->display('mntncetpl/add_type.tpl');
		
?>