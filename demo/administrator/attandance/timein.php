<?php
/* *************************** *
	   * Created On : 30 Jan 2010
	   * File : attendance/timeout.php
	   * Abid Mehmood Malik
	   *************************** */

include_once('../DBAccess/Database.inc.php');
$db3 = new Database;	
$db3 ->connect();
if(isset($_POST['timein']))
{
	$time_in = $_POST['in'];
	$smilage = $_POST['smilage'];
	$date = convertDateToMySQL($_POST['date']);
	$drv_id = $_POST['driver'];
	$query_chk = "SELECT * FROM ".TBL_ATNDS." WHERE drv_id ='$drv_id'  AND  date = '$date'";
	if($db3->query($query_chk) && $db3->get_num_rows() > 0)
	{
		$chk = $db3->fetch_row_assoc();
	}
	$drv_name = $chk['fname'].' '.$chk['lname'];
	if($chk['time_out']=='00:00:00')
	{
		echo '<script>
							alert("Driver is not timed out yet!");
							location.href = "index.php";
					</script>';
	}
	else
	{
		$admin = $_SESSION['admuser']['admin_id'];
		$query_u = "INSERT INTO ".TBL_ATNDS." SET 
							drv_id ='$drv_id' ,
							date = '$date',
							time_in = '$time_in',
							smilage='$smilage',
							time_out = '00:00:00',
							tin_by = '$admin'";
		if($db3->query($query_u))
		{
					echo '<script>location.href = "index.php"</script>';
			@header("location:index.php");
		}
	}
}
else
{
	/* $qtime = $db3->query('SELECT NOW() AS tym');
	 $get = $db3->fetch_one_assoc();
	 $xp = explode(' ',$get['tym']);
	 $date = $xp[0];
	 $time=$xp[1];	*/
	 
	 $data=get_server_time();
 $date=$data[1];
	
   $time=$data[0];
	
	/*$date = date('Y-m-d',time());
	$time = date('h:i ', time());*/
/*	$query = "SELECT  Drvid, fname, lname FROM ".TBL_DRIVERS;*/
$query ="SELECT * FROM ".TBL_DRIVERS.",".TBL_DRVTYPES." WHERE drvtype=".TBL_DRVTYPES.".dtype_id  AND ".TBL_DRIVERS.".del='0' and drvstatus !='Suspended'";
	if($db3->query($query) && $db3->get_num_rows() > 0)
	{
		$drivers = $db3->fetch_all_assoc();
	}
/*	echo "<pre>";
	print_r($drivers);
	exit; */
}
/*	$msgs   = '';
	$errors = '';
		
	$db->connect();
    $vid = intval($_GET['id']);
	
 //if page is submitted
    if(isset($_POST['editvehtype']))
     {
	  $hidvehtype = sql_replace($_POST['vehtype']);	
	  $vehtype = sql_replace($_POST['vehtype']);
	  		 	
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
	             vehtype = '$vehtype' WHERE id='".$vid."'";
				 
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
  
	  $vehtype      = $udata[0]['vehtype'];	
	  $hidvehtype   = $udata[0]['vehtype'];		  
  	}
  
  */

	$date  = convertDateFromMySQL($date);	
	$db3 ->close();

/*    $pgTitle = "Admin Panel -- Vehicle Types [Edit]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);*/
	$smarty->assign("drv_name",$drv_name);
	$smarty->assign("drivers",$drivers);
	$smarty->assign("date",$date);	
	$smarty->assign("time",$time);	
	$smarty->display('atdncetpl/timein.tpl');
		
?>