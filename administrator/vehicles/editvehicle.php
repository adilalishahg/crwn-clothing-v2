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







//GET VEHICLE TYPES



    $tcont = "SELECT * FROM ".TBL_VEHTYPES." Where del = '0'";



		if($db->query($tcont) && $db->get_num_rows() > 0)



		 {



		   $tlist = $db->fetch_all_assoc();



		 }







// Edit Vehicle







   $vid = intval($_GET['id']);







 if(isset($_POST['submit'])){

	  $vnum    			= sql_replace($_POST['vnum']);
	  $vin    			= sql_replace($_POST['vin']);
	  $regno    		= sql_replace($_POST['regno']);
	  $expireon    		= sql_replace($_POST['expireon']);
	  $hidvnum    = sql_replace($_POST['hidvnum']);	  	
	  $vname      = sql_replace($_POST['vname']);
	  $vtype      = sql_replace($_POST['vtype']);		  
      $vmodel   = sql_replace($_POST['vmodel']);
	  $vpurchasedon  = sql_replace($_POST['vpurchasedon']);	
      $vcapacity     = sql_replace($_POST['vcapacity']);
	  $vmake      = sql_replace($_POST['vmake']);	
      $vmileage   = sql_replace($_POST['vmileage']);
	  $gps          = sql_replace($_POST['gps']);	
      $vcolor     = sql_replace($_POST['vcolor']);
	  $vtransmission  = sql_replace($_POST['vtransmission']);		  
	  $vstatus      = sql_replace($_POST['vstatus']);
	 $gpsurl          = sql_replace($_POST['gpsurl']);
   if(!$vnum)
	    { $error .= "Vehicle Number Missing!<br>"; }
	   if(!$vname)
	    { $error .= "Vehicle Name Missing!<br>"; }
	   if(!$vtype || $vtype == '')
	    { $error .= "Vehicle Type not selected! <br>"; }

	   if(!$vmodel)



	    { $error .= "Vehicle Model Missing!<br>"; }

	  // if(!$vpurchasedon) { $error .= "Purchased Date Missing!<br>"; }
	   

	   if(!$vcapacity)



	    { $error .= "Capacity not Mentioned!<br>"; }


	   if(!$vmake)



	    { $error .= "Vehicle make Missing! <br>"; }



		



	   if(!$vmileage)



	    { $error .= "Vehicle Mileage Missing!<br>"; }







	   //if(!$vcolor)    { $error .= "Vehicle Color Missing!<br>"; }

	   if(!$vstatus || $vstatus == '')



	    { $error .= "Vehicle Status not selected! <br>"; }



		



      if(!$error){



         if($hidvnum != $vnum){



 	      $chkVehicle = "SELECT * FROM ".TBL_VEHICLES." WHERE vnumber='".$vnum."'";



	        if($db->query($chkVehicle) && $db->get_num_rows() > 0 ){



			  $error .= 'Vehicle already exist. Try another one.<br>  ';



			}



		  }	



	



  if(!$error) {







		  //Update Vehicle



		 $Query  = "UPDATE ".TBL_VEHICLES." SET 
					vnumber				=	'$vnum',
					vin					=	'$vin',
					regno				=	'$regno',
					expireon			=	'".convertDateToMySQL($expireon)."',
					vname				=	'$vname',
					vtype='$vtype',
					vehmodel='$vmodel',
					purchasedon			=	'".convertDateToMySQL($vpurchasedon)."',
					licensePlateState	=	'".sql_replace($_POST['licensePlateState'])."',
					capacity='$vcapacity',
					vehmake='$vmake',
					vehmileage='$vmileage',
					gps='$gps',
					gpsurl='$gpsurl',
					vehcolor='$vcolor',					
					vehtransmission='$vtransmission',
					vehicle_id	=	'".sql_replace($_POST['vehicle_id'])."',
					vstatus = '$vstatus' WHERE id='".$vid."'";
		  if($db->execute($Query))



		    { 



			 echo '<script>location.href="index.php?v=e";</script>';



			 exit;



			 



			}else{



           	 $error .= 'Unable to add Vehicle, Please try again!<br>';



			}



		  } 



	  //End Add



     }



  }else{



  



  $query = "SELECT * FROM ".TBL_VEHICLES." WHERE id='".$vid."'";



       



	      if($db->query($query) && $db->get_num_rows())



			  {



			  $udata = $db->fetch_all_assoc();



			  }


	  $vnum       = $udata[0]['vnumber'];



	  $hidvnum       = $udata[0]['vnumber'];	  	



      $vname      = $udata[0]['vname'];



	  $vtype      = $udata[0]['vtype'];		  



      $vmodel     = $udata[0]['vehmodel'];



	  $vpurchasedon  = convertDateFromMySQL($udata[0]['purchasedon']);	



      $vcapacity     = $udata[0]['capacity'];



	  $vmake      = $udata[0]['vehmake'];	



      $vmileage   = $udata[0]['vehmileage'];



	  $gps        = $udata[0]['gps'];	

	  

	   $gpsurl        = $udata[0]['gpsurl'];	



      $vcolor     = $udata[0]['vehcolor'];



	  $vtransmission  = $udata[0]['vehtransmission'];
	  $vstatus    = $udata[0]['vstatus'];  



  



  }		

//Modivcare
	$readonly='';
	$disable_class='';
	$modiv_msg='';
  	if($udata[0]['modiv_flage']==1) {
  		$readonly='readonly';
  		$disable_class='disable_class';
  		$modiv_msg='Managed by ModivCare';
  	}
 $gstat = "SELECT * FROM ".TBL_STATES;		if($db->query($gstat) && $db->get_num_rows() > 0)		 {		   $slist = $db->fetch_all_assoc();		 		 }


//end modivcare

	$db->close();







    $pgTitle = "Admin Panel -- Vehicles Managment [Edit]";	



	$smarty->assign("title",$title);
	$smarty->assign("slist",$slist);

	$smarty->assign("pgname",$pgname);		



	$smarty->assign("msgs",$msgs);



	$smarty->assign("errors",$error);



	$smarty->assign("tlist",$tlist);	



	$smarty->assign("id",$vid);



	$smarty->assign("vnum",$vnum);



	$smarty->assign("hidvnum",$hidvnum);	



	$smarty->assign("vname",$vname);	



	$smarty->assign("vtype",$vtype);



	$smarty->assign("vmodel",$vmodel);	



	$smarty->assign("vpurchasedon",$vpurchasedon);



	$smarty->assign("vcapacity",$vcapacity);	



	$smarty->assign("vmake",$vmake);



	$smarty->assign("vmileage",$vmileage);	



	$smarty->assign("gps",$gps);



	$smarty->assign("gpsurl",$gpsurl);



	$smarty->assign("vcolor",$vcolor);	



	$smarty->assign("vtransmission",$vtransmission);
	$smarty->assign("readonly",$readonly);
	$smarty->assign("disable_class",$disable_class);
	$smarty->assign("modiv_msg",$modiv_msg);
	$smarty->assign("vstatus",$vstatus);
	$smarty->assign("data",$udata[0]);
	$smarty->display('vehtpl/editvehicle.tpl');
?>