<?php

   	

   	include_once('../DBAccess/Database.inc.php');
	

		
	$msgs   = '';
	$errors = '';
		
   $id=$_REQUEST['id'];
	
	function get_veh($drv)
{
	$db = new Database;	
	$db->connect();
	$dQuery = "SELECT Drvid
							FROM ".TBL_DRIVERS."
							WHERE drv_code = '$drv'";
	if($db->query($dQuery) && $db->get_num_rows() > 0)
	{
		$drvs =  $db->fetch_row_assoc(); 
	}
	 $drv_id = $drvs['Drvid'];
	$vQuery = "SELECT  veh_id
							FROM ".TBL_DVMAPPING."
							WHERE  drv_id = '$drv_id'";
	if($db->query($vQuery) && $db->get_num_rows() > 0)
	{
		$vehs =  $db->fetch_row_assoc(); 
	}
	return $vehs['veh_id'];
}
    
	 //  F U N C T I O N     T O    I N  S E R T     T R I PS         I N     D A TA B A S E //
    
				function insert_trip()
				{
					$db = new Database;	
					$db->connect();

			
						$sheet=$_POST['id'];
					$clinic = $_POST['clinic'];
					$user = $_POST['consumer'];
					 $tel = $_POST['phone'];
					
					$miles = $_POST['miles1'] + $_POST['miles2'];
					$date = date('Y-m-d',time());
				    $tQuery = "INSERT INTO ".TBL_TRIPS." SET 
											trip_clinic = '$clinic',
											trip_user = '$user',
											trip_tel = '$tel',
											trip_date = '$date',
											sheet_id = '$sheet',
											addon = '0',
											status = '0',
											trip_miles = '$miles'";
											
											
											
					if($db->execute($tQuery))
					{
					
						insert_tdetail();
					}
					
					$db->close();
					
				}
				 //  F U N C T I O N     T O    I N  S E R T     T R I PS         I N     D A TA B A S E //
				 
				
				//  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //
				
				function insert_tdetail()
				{
					$db = new Database;	
					$db->connect();
				
					$trip_id = mysql_insert_id();
					$prop = "10";
					$ptime=$_POST['pu1'].':00';
					$pck_ptime = date("H:i:s", strtotime("+$prop minutes".$ptime));
					$dtime= $_POST['dt1'].':00';
					$drp_ptime =  date("H:i:s", strtotime("+$prop minutes".$dtime));
					$date = date('Y-m-d',time());
					$drvid=$_POST['staff1'];
					$pckadd=$_POST['address1'];
					$drpaddr=$_POST['address2'];
					$trp_miles=$_POST['miles1'];
					$trp_remarks=$_POST['remarks'];
					$veh_id = get_veh($_POST['staff1']);
					
					$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 
											trip_id 				=	 	'$trip_id',
											drv_id 				=		'$drvid',
											veh_id 				= 		'$veh_id',
											pck_add 			= 		'$pckadd',
											pck_time 			= 		'$ptime',
											pck_ptime 		= 		'$pck_ptime',
											pck_atime 		= 		'',
											drp_add 			= 		'$drpaddr',
											drp_time 			= 		'$dtime',
											drp_ptime 		= 		'$drp_ptime',
											drp_atime 		= 		'',
											trip_miles 		= 		'$trp_miles',
											type 		= 		'1',
											trip_remarks 	= 		\"".$trp_remarks."\"";
					if($db->execute($tQuery))
					{
						
					}
					
					if($_POST['address3']!='')
					{
						$prop = "10";
						$ptime= $_POST['pu2'].':00';
						$pck_ptime = date("H:i:s", strtotime("+$prop minutes".$ptime));
						$dtime= $_POST['dt2'].':00';
						$drp_ptime =  date("H:i:s", strtotime("+$prop minutes".$dtime));
						$date = date('Y-m-d',time());
						
						$drvid=$_POST['staff2'];
					    $pckadd=$_POST['address2'];
					    $drpaddr=$_POST['address3'];
					    $trp_miles=$_POST['miles2'];
							$veh_id = get_veh($_POST['staff2']);
						$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 
												trip_id 				=	 	'$trip_id',
												drv_id 				=		'$drvid',
												veh_id 				= 		'$veh_id',
												pck_add 			= 		'$pckadd',
												pck_time 			= 		'$ptime',
												pck_ptime 		= 		'$pck_ptime',
												pck_atime 		= 		'',
												drp_add 			= 		' $drpaddr',
												drp_time 			= 		'$dtime',
												drp_ptime 		= 		'$drp_ptime',
												drp_atime 		= 		'',
												trip_miles 		= 		' $trp_miles',
												type 		= 		'2',
												trip_remarks 	= 		\"".$trp_remarks."\"";
							
							if($db->execute($tQuery))
							{
							}
						 }
											
					}
	      //  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //
	


 //if page is submitted
    if(isset($_POST['addgrid']))
     {
		
		
    insert_trip();
            echo "<script>";
			echo "alert('Addon added Successfully');";
			echo "location.href='grid.php?st=5&ad=0&id=".$id."'";
			echo "</script>";
				exit;
		/*		 
		  if($db->execute($Query))
		    {
			 echo "<script>window.open('index.php?f=s','_parent');</script>"; 
			  }else{ 
				 $error .= 'Unable to add re-filling information.';
				 $smarty->assign("errors",$error);
				 $smarty->display('vehtpl/msg.tpl');
				 exit;
			 }
			 exit;*/
		    
     }
		
	

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [ADD REQUEST]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->display('rpaneltpl/add_grid.tpl');
		
?>