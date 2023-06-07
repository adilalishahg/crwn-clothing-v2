<?php



   	/* *************************** *



	   * Date: 29-May-2008 



	   * CMS/index.php



	   * Muhammad Sajid



	   *************************** */







   	include_once('../DBAccess/Database.inc.php');



    include('../Classes/pagination-class.php');	











	$db = new Database;	



    $msgs = '';



	$noRec = '';



	$msgs .= $_GET['msg'];



	$db2 = new Database;	



    	



	$db->connect();



	$db2->connect();











// Delete Vehicle Script



    if(isset($_GET['delId']) && $_GET['delId'] != '')



	{



		$date = date('Y-m-d',time());



		$del_by = $_SESSION['admuser']['admin_id'];
   		$QueryDel = "DELETE FROM  ".TBL_VEHTYPES."  WHERE id='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{  
		  $QueryDel2 = "Update ".TBL_VEHICLES." SET vtype = '' WHERE vtype='".$_GET['delId']."'";
		     if($db2->query($QueryDel2))
			 {				
       			  $msgs .= 'Record Removed Successfully<br>';
		 	}



			 else



			 {



		 	$error .= 'Vehicle Type removed Successfully but Error occured while removing the vehicles under that vehicle type.<br>';		   



		  	}



		}



		else



		{



		 $error .= 'Error occured while removing the record<br>';		



		} 



		echo "<script>location.href= 'vehtypes.php';</script>";



  	}











	/*************** Paging ************** */



	



	if(!empty($_GET['Page']))



	{ $page = $_GET['Page']; }



	else



	{ $page = 1; }



	



	$limit = 20;



	$offset = (($page * $limit) - $limit);



	$maxRecord = 20; 











	 $Querypg = "SELECT COUNT(*) FROM ".TBL_VEHTYPES;	



	 $totalRows = $db->executeScalar($Querypg);



 



     if(isset($_GET['pageNum'])){



	   $page_no = $_GET['pageNum'];



	 }else{



	   $page_no = '1';	 



	 }



	 



   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 



	  



	  



	$Query2 = "SELECT * FROM ".TBL_VEHTYPES."  Where del = '0' LIMIT ".$pagination->startRow . ",".$pagination->maxRows;



	  if($db->query($Query2) && $db->get_num_rows() > 0)



	   {



	   $vehdetails = $db->fetch_all_assoc();



	  } 









    for($i=0; $i<count($vehdetails); $i++){

	  $Query3 = "SELECT COUNT(*) AS trows FROM ".TBL_VEHICLES." WHERE vtype = '".$vehdetails[$i]['id']."'";

	  if($db->query($Query3)){

	  	  $vehd = $db->fetch_all_assoc(); 

		  $vehdetails[$i]['total'] = $vehd[0]['trows'];

	   } 

    }



	      $pages =  $pagination->display_pagination();	



	  



	$db->close();



	$db2->close();



    $pgTitle = "Admin Panel -- Vehicle Types";



	$smarty->assign("pgTitle",$pgTitle);



	$smarty->assign("msgs",$msgs);



	$smarty->assign("errors",$error);	



	$smarty->assign_by_ref('vehtypedetails',$vehdetails);



	$smarty->assign_by_ref('vehqdetails',$vehqdetails);	



	$smarty->assign("pages",$pages);	



	$smarty->display('vehtpl/vehtypes.tpl');



		



?> 