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

// Add Vehicle

 if(isset($_POST['submit']))
 {
	 $tck_num    = sql_replace($_POST['tck_num']);
	  $drv_id    = sql_replace($_POST['drv_id']);	  	
      $veh_id      = sql_replace($_POST['veh_id']);
	 $date      = convertDateToMySQL(sql_replace($_POST['date']));		  
      $reason   = sql_replace($_POST['reason']);
	  $cost  = sql_replace($_POST['cost']);		  

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

		
  if(!$error) 
  {

		  //Add Vehicle
		 $Query  = "INSERT INTO ".TBL_TCKT." SET 
					tck_num='$tck_num',
					drv_id='$drv_id',
					veh_id='$veh_id',
					date='$date',
					reason='$reason',
					cost='$cost'";
		 	 
		  if($db->execute($Query))
		    { 
			 echo '<script>location.href="index.php?v=s";</script>';
			 exit;
			 
			}
			else
			{
           	 	$error .= 'Unable to add Ticket, Please try again!<br>';
			}
		  } 
  }		
	$db->close();

    $pgTitle = "Admin Panel -- Ticket  Managment [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("vlist",$vlist);	
	$smarty->assign("dlist",$dlist);
	$smarty->assign("tck_num",$tck_num);
	$smarty->assign("drv_id",$drv_id);	
	$smarty->assign("veh_id",$veh_id);
	$smarty->assign("reason",$reason);	
	$smarty->assign("cost",$cost);
	$smarty->assign("date",$date);	
	$smarty->display('tkttpl/add.tpl');
		
?>