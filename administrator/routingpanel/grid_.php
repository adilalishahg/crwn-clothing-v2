<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/index.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');

	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
    $sheet=$_GET['id'];
	$st=$_GET['st'];
	$ad=$_GET['ad'];

		
	$db->connect();
	$db2->connect();

	/*************** Paging ************** */
	

	

// Delete Category Script
    if(isset($_GET['delId']) && $_GET['delId'] != '')
	{   
	 
	    
   		$QueryDel = "DELETE FROM ".TBL_TRIP_DET." WHERE tdid='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{
		echo "<script>location.href='grid.php?st=5&ad=0&id=".$sheet."'";
		
	   
	   		exit;
	  	   //Delete subcategories as wel
	 //$db2->query($QuerypicDel = "DELETE FROM `categories` WHERE id='".$_GET['delId']."'");	   		
		}else{
	   		 header("Location: grid.php?id=".$sheet);
	   		exit;	
		}  
  	}

	if(isset($_POST))
	{
		$drv = $_POST['driver'];
		$user = $_POST['user'];
		$clinic = $_POST['clinic'];
		//$sheet = $_POST['id'];
		$whr = '';
		
		if ($drv!='')
		{
			$whr .=" AND td.drv_id = '$drv'";
		}
		if ($user!='')
		{
			$whr .=" AND t.trip_user LIKE '%$user%'";
		}
		if ($clinic!='')
		{
			$whr .=" AND t.trip_clinic LIKE '%$clinic%'";
		}
	}
	
         $st=$_REQUEST['st'];
     		 $addon=$_REQUEST['ad'];  

     if($st==''&& $addon==''){
	 
	 $Query = "SELECT td.tdid,td.type,t.status,t.sheet_id,  t.trip_id,  t.trip_user,  t.trip_clinic,  t.trip_date,  t.trip_tel,
									td.pck_add,  td.pck_time,  td.drp_add,  td.drp_time,  td.trip_miles,  td.trip_remarks,  td.drv_id
						FROM trips as t,  trip_details as td 
						WHERE t.trip_id=td.trip_id AND td.status='0' $whr AND  t.sheet_id=$sheet";
			
			
							 if($db->query($Query) && $db->get_num_rows() > 0)
							{
							   $trips = $db->fetch_all_assoc();
							   
							   
							   for ($i = 0;$i<sizeof($trips);$i++)
							   {
								 $did = $trips[$i]['drv_id'];
						
									$drvQuery = "SELECT  fname, lname, drv_code
																FROM ".TBL_DRIVERS."
																WHERE  drv_code = '$did'";
									if($db->query($drvQuery) && $db->get_num_rows() > 0)
									 {
										 $drv = $db->fetch_row_assoc();
										 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];
									 }
							   }
							  
							} 
							else
							{
							   $noRec .=  "NO RECORD FOUND";	 
							}
	   
	 
	 }else{
		 

 $Query = "SELECT td.tdid,td.type,  t.sheet_id,  t.trip_id,  t.trip_user,  t.trip_clinic,  t.trip_date,  t.trip_tel,
									td.pck_add,  td.pck_time,  td.drp_add,  td.drp_time,  td.trip_miles,  td.trip_remarks,  td.drv_id
						FROM trips as t,  trip_details as td 
						WHERE t.trip_id=td.trip_id AND td.status='$st' AND t.addon='$addon'  $whr AND  t.sheet_id=$sheet";
			
			
							 if($db->query($Query) && $db->get_num_rows() > 0)
							{
							   $trips = $db->fetch_all_assoc();
							   for ($i = 0;$i<sizeof($trips);$i++)
							   {
								 $did = $trips[$i]['drv_id'];
						
									$drvQuery = "SELECT  fname, lname, drv_code
																FROM ".TBL_DRIVERS."
																WHERE  drv_code = '$did'";
									if($db->query($drvQuery) && $db->get_num_rows() > 0)
									 {
										 $drv = $db->fetch_row_assoc();
										 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];
									 }
							   }
							   
							} 
							else
							{
							   $noRec .=  "NO RECORD FOUND";	 
							}
					
			    }
			  
	 $drvQuery = "SELECT  fname, lname, drv_code
		   						   FROM ".TBL_DRIVERS;
		if($db->query($drvQuery) && $db->get_num_rows() > 0)
	   			$drivers = $db->fetch_all_assoc();

	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Members";
	$smarty ->assign("id",$sheet);
	$smarty ->assign("user",$user);
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("drv",$drv);
	

	
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("st",$st);
		$smarty->assign("ad",$ad);
	$smarty ->assign("drivers",$drivers);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('membdetail',$trips);
	$smarty->assign("paging",$paging);		
	$smarty->display('rpaneltpl/grid.tpl');
		

?>