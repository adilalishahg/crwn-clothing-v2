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
    $id = intval($_GET['id']);


        $getvstatus = "SELECT * FROM ".TBL_VEHICLES."  WHERE id='$id'"; 
         
		if($db->query($getvstatus) && $db->get_num_rows() > 0)
		 {
		   $vSS = $db->fetch_all_assoc();
		      if($vSS[0]['vstatus'] != 'Open'){
		 $error .= 'Vehicle is not active Change its status before refilling';
	     $smarty->assign("errors",$error);
		 $smarty->display('vehtpl/msg.tpl');
		 exit;		  
			  }
		   }


        $getvInfo = "SELECT * FROM ".TBL_DVMAPPING."  WHERE veh_id='$id'"; 
         
		if($db->query($getvInfo) && $db->get_num_rows() > 0)
		 {
		   $vf = $db->fetch_all_assoc();
		 
		   $veh_num_plate = $vf[0]['veh_numplate'];
		   $veh_name = $vf[0]['vehname'];
		   $drvid    = $vf[0]['drv_id'];
		   $driver   = $vf[0]['drv_name'];		   		   
		 }else{
		 $error .= 'Vehicle not assigned to any driver.<br> Assign it first before refilling.';
	     $smarty->assign("errors",$error);
		 $smarty->display('vehtpl/msg.tpl');
		 exit;
		 }





 //if page is submitted
    if(isset($_POST['AddFuel']))
     {
	  $rfdate  = sql_replace($_POST['rfdate']);
	  $fuelQty = sql_replace($_POST['qty']);
	  $fuelAmt = sql_replace($_POST['amt']);	  	
		 	
	   if(!$fuelQty)
	    { $error .= "Fuel Quantity Missing !<br>"; }
		 	
	   if(!$fuelAmt)
	    { $error .= "Fuel Amount Missing !<br>"; }
		
      if(!$error){	 
	 
      $Query = "INSERT INTO  ".TBL_FUELLOG." SET 
	            veh_id='".$id."',
				veh_num_plate='".$veh_num_plate."',
				veh_name='".$veh_name."',
				driver_id='".$drvid."',
				driver='".$driver."',
				refil_date='".convertDateToMySQL($rfdate)."',
				qty='".$fuelQty."',
				fuel_amt='".$fuelAmt."'";
				 
		  if($db->execute($Query))
		    {
			 echo "<script>window.open('index.php?f=s','_parent');</script>"; 
			  }else{ 
				 $error .= 'Unable to add re-filling information.';
				 $smarty->assign("errors",$error);
				 $smarty->display('vehtpl/msg.tpl');
				 exit;
			 }
			 exit;
		    }
          }
		
	$db->close();

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [Add Fuel]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->display('vehtpl/addfuel.tpl');
		
?>