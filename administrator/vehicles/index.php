<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
   	
	$db->connect();
	$db2->connect();

   if(isset($_GET['v']) && $_GET['v'] != ''){
	  if($_GET['v'] == 's'){ $msgs .= "Vehicle Added Successfully! <br>"; }
	  if($_GET['v'] == 'e'){ $msgs .= "Vehicle Updated Successfully! <br>"; }	
	}

  if(isset($_GET['f']) && $_GET['f'] != ''){
	  if($_GET['f'] == 's'){ $msgs .= "Vehicles Fuel re-filling updated! <br>"; }
  if($_GET['f'] == 'f'){ $msgs .= "Unable to add fuel data! <br>"; }	
	}


// Delete Vehicle Script


    if(isset($_GET['delId']) && $_GET['delId'] != '')


	{
		$chkmodiv = "SELECT modiv_flage FROM ".TBL_VEHICLES." WHERE id='".$vid."'";

			if($db->query($chkmodiv) && $db->get_num_rows() > 0 )
			{
				$slist = $db->fetch_one_assoc();
				if($slist['modiv_flage']==1) {		
			  		$error .= 'Vehicle can not be Deleted. Try another one.<br>  ';
					echo '<script>location.href="index.php?v=d";</script>';
			 		exit;
				}
			}

		$date = date('Y-m-d',time());


		$del_by = $_SESSION['admuser']['admin_id'];


   		$QueryDel = "DELETE  FROM ".TBL_VEHICLES." 	WHERE id='".$_GET['delId']."'";


  		if($db->query($QueryDel))


		{  		


         $msgs .= 'Record Removed Successfully<br>';


		}else{


		 $error .= 'Error occured while removing the record<br>';		


		}  


  	}








	/*************** Paging ************** */

	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }

	else
	{ $page = 1; }


	$limit = 50;


	$offset = (($page * $limit) - $limit);


	$maxRecord = 50; 








// Fetch all vehicles list


     


	 if(isset($_GET['st']) && $_GET['st'] != '' && $_GET['st'] != 'All'){


		$st = $_GET['st'];


		$whr_clz = " AND vstatus='".$st."'";


	 }else{


		 $st = 'All';


		$whr_clz = " ";


	  } 	 


	


 


	 //$Querypg = "SELECT COUNT(*) FROM ".TBL_VEHICLES.",".TBL_VEHTYPES." WHERE vtype=".TBL_VEHTYPES.".id $whr_clz";	


	$Querypg = "SELECT COUNT(*) FROM ".TBL_VEHICLES." WHERE del = '0' $whr_clz";	


	 $totalRows = $db->executeScalar($Querypg);


 


     if(isset($_GET['pageNum'])){


	   $page_no = $_GET['pageNum'];


	 }else{


	   $page_no = '1';	 


	 }


	 


   	 $pagination = new pagination($_GET['pageNum'],$maxRows=50,$totalRows); 
	/*$Query2 = "SELECT ".TBL_VEHICLES.".*,".TBL_VEHTYPES.".id AS vtid,".TBL_VEHTYPES.".vehtype FROM ".TBL_VEHICLES.",".TBL_VEHTYPES." WHERE vtype=".TBL_VEHTYPES.".id $whr_clz LIMIT ".$pagination->startRow . ",".$pagination->maxRows;*/
	// ------------------------------- main query to fetch vehicles ---------------------------------------------//


	 $Query2 = "SELECT *, SUBSTRING(vin,-5) AS vinn  FROM ".TBL_VEHICLES." where del = '0' $whr_clz ORDER BY vinn ASC LIMIT ".$pagination->startRow . ",".$pagination->maxRows;


	


   if($db->query($Query2) && $db->get_num_rows() > 0)


	{


	   $vehdetails = $db->fetch_all_assoc();


	} 


	





   for($i=0; $i<sizeof($vehdetails); $i++)


   {


	     //------------------------------ Vehicle type details ---------------------------------//


	   $rQuery = "SELECT * FROM ".TBL_VEHTYPES." WHERE id=".$vehdetails[$i]['vtype'];	


      if($db->query($rQuery) && $db->get_num_rows() > 0)


	   {


	    $vt = $db->fetch_all_assoc();





	    $vehdetails[$i]['vehtype'] = $vt[0]['vehtype'];


	   }


	   else


	   {


	  		$vehdetails[$i]['vehtype'] = 'Not assigned yet'; 


			$vehdetails[$i]['vtype'] = ''; 


	   }


	   //------------------------------ Refuling details ---------------------------------//


	   


   	 $rQuery = "SELECT * FROM ".TBL_FUELLOG." WHERE veh_id=".$vehdetails[$i]['id']." ORDER BY fid DESC LIMIT 1";	


      if($db->query($rQuery) && $db->get_num_rows() > 0)


	   {


	    $rf = $db->fetch_all_assoc();


	    $vehdetails[$i]['refildate'] = convertDateFromMySQL($rf[0]['refil_date']); 


	   }else{


	   $vehdetails[$i]['refildate'] = 'Not Refilled Yet'; 


	   }


   }





      $pages =  $pagination->display_pagination();	


	  


	$db->close();


	$db2->close();


    $pgTitle = "Admin Panel -- Vehicle Managment";


	$smarty->assign("pgTitle",$pgTitle);


	$smarty->assign("msgs",$msgs);


	$smarty->assign("errors",$error);	


	$smarty->assign_by_ref('vehdetails',$vehdetails);


	$smarty->assign("pages",$pages);


	$smarty->assign("st",$st);			


	$smarty->display('vehtpl/index.tpl');


		


?> 