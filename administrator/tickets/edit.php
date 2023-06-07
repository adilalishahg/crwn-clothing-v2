<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/add_category.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;
	
	$msgs   = '';
	$errors = '';
		
	$db->connect();
	$db2->connect();

//GET VEHICLES
    $tcont = "SELECT * FROM ".TBL_VEHICLES." Where del = '0'";
		if($db->query($tcont) && $db->get_num_rows() > 0)
		 {
		   $vlist = $db->fetch_all_assoc();
		 }

//GET DRIVERS
    $tcont = "SELECT * FROM ".TBL_DRIVERS." Where del = '0'";
		if($db->query($tcont) && $db->get_num_rows() > 0)
		 {
		   $dlist = $db->fetch_all_assoc();
		 }


// Edit Vehicle

$vid = intval($_GET['id']);

 if(isset($_POST['submit'])){

		$id					=  sql_replace($_POST['id']);
	  $tck_num   	 = sql_replace($_POST['tck_num']);
	  $drv_id    		= sql_replace($_POST['drv_id']);	  	
      $veh_id    		  = sql_replace($_POST['veh_id']);
	  $date      			= convertDateToMySQL(sql_replace($_POST['date']));			  
      $reason  			 = sql_replace($_POST['reason']);
	  $cost  				= sql_replace($_POST['cost']);		
	 
	 
	 if(!$tck_num)
	    { $error .= "Ticket Number Missing!<br>"; }

	   if(!$drv_id || $drv_id == '')
	    { $error .= "Driver Missing!<br>"; }
		
	   if(!$veh_id || $veh_id == '')
	    { $error .= "Vehicle  not selected! <br>"; }

	   if(!$date)
	    { $error .= "Vehicle Model Missing!<br>"; }

	   if(!$reason)
	    { $error .= "Reason Missing!<br>"; }
		
		
	   if(!$cost)
	    { $error .= "Cost not Mentioned!<br>"; }
		
     
  if(!$error) {

		  //Update Vehicle
		 $Query  = "UPDATE ".TBL_TCKT." SET 
					tck_num='$tck_num',
					drv_id='$drv_id',
					veh_id='$veh_id',
					date='$date',
					reason='$reason',
					cost='$cost'  WHERE id='".$id."'";
			 	 
		  if($db->execute($Query))
		    { 
			 echo '<script>location.href="index.php?v=e";</script>';
			 exit;
			 
			}else{
           	 $error .= 'Unable to add Ticket, Please try again!<br>';
			}
		  } 
	  //End Add
     }
  else
  {
  
  $query = "SELECT * FROM ".TBL_TCKT." WHERE id='".$vid."'";
       
	      if($db->query($query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_row_assoc();
			  }
			  $udata['date'] = convertDateFromMySQL($udata['date']);
  
  }		
	$db->close();

 $pgTitle = "Admin Panel -- Ticket  Managment [Edit]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("vlist",$vlist);	
	$smarty->assign("dlist",$dlist);
	$smarty->assign("udata",$udata);
	$smarty->display('tkttpl/edit.tpl');
		
?>