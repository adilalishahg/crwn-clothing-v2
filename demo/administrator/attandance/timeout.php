<?php
/* *************************** *
	   * Created On : 30 Jan 2010
	   * File : attendance/timeout.php
	   * Abid Mehmood Malik
	   *************************** */

include_once('../DBAccess/Database.inc.php');
 $db3 = new Database;	
$db3 ->connect();
 
/* $qtime = $db3->query('SELECT NOW() AS tym');
 $get = $db3->fetch_one_assoc();
 $xp = explode(' ',$get['tym']);
 $date = $xp[0];
 $time=$xp[1];	
 */
 $time_data = get_server_time();
$time = $time_data[0];
$date = $time_data[1];

if(isset($_POST['timeout']))
{
	 $id = $_POST['id'];

	$query = "SELECT  * FROM ".TBL_ATNDS." WHERE id = '$id'";
		if($db3->query($query) && $db3->get_num_rows() > 0)
		{
			$user = $db3->fetch_all_assoc();
		}
  	$smilage = $user[0]['smilage'];
	
		
	$timeout = $_POST['out'];

		$emileage = $_POST['emileage']; 

		$tmileage=$emileage-$smilage;
		

		
	$admin = $_SESSION['admuser']['admin_id'];
	 $query_u = "UPDATE ".TBL_ATNDS." SET 
						time_out ='$timeout',
						emilage ='$emileage',
						tmileage='$tmileage',
						tout_by  = '$admin' 
						WHERE id = '$id'";
	if($db3->query($query_u))
	{
		echo '<script>location.href = "index.php"</script>';
		@header("location:index.php");
	}
}
else
{
	if(verify($_GET['id'] ,"index.php"))
	{
		$id = $_GET['id'];
		$query = "SELECT  * FROM ".TBL_ATNDS." WHERE id = '$id'";
		if($db3->query($query) && $db3->get_num_rows() > 0)
		{
			$user = $db3->fetch_all_assoc();
		}
		$uid = $user[0]['id'];
		//--------------- get user name ---------------//
		$query = "SELECT  fname, lname FROM ".TBL_DRIVERS." WHERE Drvid = '$uid'";
		if($db3->query($query) && $db3->get_num_rows() > 0)
		{
			$name = $db3->fetch_row_assoc();
		}
		
		$user[0]['drv_name'] = $name['fname']." " .$name['lname'];
		$user[0]['date'] = convertDateFromMySQL($user[0]['date']);
		//-------------------------end ------------------------//
	}
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


	$db3 ->close();

/*    $pgTitle = "Admin Panel -- Vehicle Types [Edit]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$vid);*/
	$smarty->assign("user",$user);
	$smarty->assign("id",$id);
	$smarty->assign("time",$time);				
	$smarty->display('atdncetpl/timeout.tpl');
		
?>