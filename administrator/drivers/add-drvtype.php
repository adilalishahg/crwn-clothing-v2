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
    if(isset($_POST['Adddrvtype']))
     {
	  $drvtype     = sql_replace($_POST['drvtype']);	
	  $drvduration = sql_replace($_POST['drvduration']);	
	  	 	
	   if(!$drvtype)
	    { $error .= "Type title Missing !<br>"; }
	  	 	
	   if(!$drvduration)
	    { $error .= "Job Duration Missing !<br>"; }		

        $chkdtype = "SELECT * FROM  " . TBL_DRVTYPES . "  WHERE dtype_name='$drvtype'"; 
         
		if($db->query($chkdtype) && $db->get_num_rows() > 0)
		 {
		    $error .= 'Type already exist, Try another one.<br>';
			echo "<script>alert('Type already exist, Try another one');</script>";
            echo "<script>window.open('drvtypes.php','_parent');</script>";
			exit; 
		 }

      if(!$error){	 
	 
       $Query = "INSERT INTO  " . TBL_DRVTYPES . " SET 
	             dtype_name = '$drvtype', dtype_duration='$drvduration'";
				 
		  if($db->execute($Query))
		    { echo "<script>alert('Driver Type added Successfully');</script>";			  
			  }else{ echo "<script>alert('Unable to add driver type');</script>";
			 }
             echo "<script>window.open('drvtypes.php','_parent');</script>";
			 exit;
		    }
          }
		
	$db->close();

    $pgTitle = "Admin Panel -- DRIVERS MANAGMENT [Add Driver Type]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("drvtype",$drvtype);
	$smarty->assign("drvduration",$drvduration);			
	$smarty->display('drvtpl/add-drvtype.tpl');
		
?>