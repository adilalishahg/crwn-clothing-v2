<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;
	$msgs   = '';
	$errors = '';
	$db->connect();
	$db2->connect();
    $tcont = "SELECT * FROM ".TBL_VEHTYPES." Where del='0'";
		if($db->query($tcont) && $db->get_num_rows() > 0)
		 {
		   $tlist = $db->fetch_all_assoc();
		 }
	// Add Vehicle
 if(isset($_POST['submit'])){
	  $vnum    		= sql_replace($_POST['vnum']);	
	  $vin    		= sql_replace($_POST['vin']);
	  $regno    		= sql_replace($_POST['regno']);
	  $expireon    		= sql_replace($_POST['expireon']);
      $vname      	= sql_replace($_POST['vname']);
	  $vtype      = sql_replace($_POST['vtype']);		  
      $vmodel   = sql_replace($_POST['vmodel']);
	  $vpurchasedon  = sql_replace($_POST['vpurchasedon']);	
      $vcapacity     = sql_replace($_POST['vcapacity']);
	  $vmake      = sql_replace($_POST['vmake']);	
      $vmileage   = sql_replace($_POST['vmileage']);
	  $gps          = sql_replace($_POST['gps']);	
	 $gpsurl          = sql_replace($_POST['gpsurl']);	
     $vcolor     = sql_replace($_POST['vcolor']);
	  $vtransmission  = sql_replace($_POST['vtransmission']);		  





	   if(!$vnum)



	    { $error .= "Vehicle Number Missing!<br>"; }







	   if(!$vname)



	    { $error .= "Vehicle Name Missing!<br>"; }



		



	   if(!$vtype || $vtype == '')



	    { $error .= "Vehicle Type not selected! <br>"; }







	   if(!$vmodel)



	    { $error .= "Vehicle Model Missing!<br>"; }







	  // if(!$vpurchasedon)    { $error .= "Purchased Date Missing!<br>"; }

	   if(!$vcapacity)



	    { $error .= "Capacity not Mentioned!<br>"; }







	   if(!$vmake)



	    { $error .= "Vehicle make Missing! <br>"; }



		



	   if(!$vmileage)



	    { $error .= "Vehicle Mileage Missing!<br>"; }







	   //if(!$vcolor)  { $error .= "Vehicle Color Missing!<br>"; }

      if(!$error){



 



 	      $chkVehicle = "SELECT * FROM ".TBL_VEHICLES." WHERE vnumber='".$vnum."'";



	        if($db->query($chkVehicle) && $db->get_num_rows() > 0 ){



			  $error .= 'Vehicle already exist. Try another one.<br>  ';



			}



	



  if(!$error) {;







		  //Add Vehicle



		  $Query  = "INSERT INTO ".TBL_VEHICLES." SET 

					vnumber				=	'$vnum',
					vin					=	'$vin',
					regno				=	'$regno',
					expireon			=	'".convertDateToMySQL($expireon)."',
					vname	='$vname',



					vtype='$vtype',



					vehmodel='$vmodel',



					purchasedon='".convertDateToMySQL($vpurchasedon)."',
					licensePlateState	=	'".sql_replace($_POST['licensePlateState'])."',


					capacity='$vcapacity',



					vehmake='$vmake',



					vehmileage='$vmileage',



					gps='$gps',

					

					gpsurl='$gpsurl',



					vehcolor='$vcolor',
					vehicle_id	=	'".sql_replace($_POST['vehicle_id'])."',
					vehtransmission='$vtransmission'";
		  if($db->execute($Query))



		    { 



			 echo '<script>location.href="index.php?v=s";</script>';



			 exit;



			 



			}else{



           	 $error .= 'Unable to add Vehicle, Please try again!<br>';



			}



		  } 



	  //End Add



     }



  }		

//Modivcare
$gstat = "SELECT * FROM ".TBL_STATES;		if($db->query($gstat) && $db->get_num_rows() > 0)		 {		   $slist = $db->fetch_all_assoc();		 		 }
//Modivcare
	$db->close();
    $pgTitle = "Admin Panel -- Vehicles Managment [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("slist",$slist);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("tlist",$tlist);	
	$smarty->assign("vnum",$vnum);
	$smarty->assign("vname",$vname);	
	$smarty->assign("vtype",$vtype);
	$smarty->assign("vmodel",$vmodel);	
	$smarty->assign("vpurchasedon",$vpurchasedon);
	$smarty->assign("vcapacity",$vcapacity);	
	$smarty->assign("vmake",$vmake);
	$smarty->assign("vmileage",$vmileage);	
	$smarty->assign("gps",$gps);
	$smarty->assign("vcolor",$vcolor);	
	$smarty->assign("vtransmission",$vtransmission);
	$smarty->assign("post",$_POST);
	$smarty->display('vehtpl/addvehicle.tpl');



		



?>