<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
	$db->connect();
	$db2->connect();
	/*************** Paging ************** */

	

	if(!empty($_GET['Page']))

	{ $page = $_GET['Page']; }

	else

	{ $page = 1; }

	

	$limit = 800;

	$offset = (($page * $limit) - $limit);

	$maxRecord = 800; 

 if(isset($_GET['st']) && $_GET['st'] != ''){

    $st = $_GET['st'];

 }else{

    $st = 'active';

  } 
    if(isset($_GET['delId']) && $_GET['delId'] != ''){

   		$QueryDel = "DELETE FROM ".TBL_HOSPITALS." WHERE id='".$_GET['delId']."'";

  		if($db->query($QueryDel))

		{

	   		header("Location: index.php");

	   		exit;
		}else{

	   		header("Location: index.php");

	   		exit;	

		}  

  	}

$usersid = array();
//if($glueids != ''){
 $QueryCount = "SELECT COUNT(*) AS rows FROM 
	              ".accounts.", ".TBL_FORMS."	  WHERE reqstatus = 'active'  AND account=".accounts.".id ";
     if($db2->query($QueryCount) && $db2->get_num_rows() > 0)
	  {
      $data = $db2->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }
  // }
//if($glueids != ''){
$Query = "SELECT ".TBL_FORMS.".*,COUNT(req_id) as cnt,".accounts.".*  
			 FROM ".accounts.", ".TBL_FORMS."
			 WHERE reqstatus = 'active'  AND account=".accounts.".id GROUP BY ".accounts.".account_name ORDER BY ".accounts.".account_name ASC LIMIT $offset, $limit";
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $reqdetails = $db->fetch_all_assoc();
} else{
	   $noRec .=  "NO RECORD FOUND";	 
    } 
//}

	



   // Footer paging

      $show = ceil($totalRows/$maxRecord);



	   if($totalRows == 0){

		 }else{

       $paging1 = "Page : ";

		}

         for($line=1; $line<=$show; $line++) 

		  {

		   if($line == $_GET['Page']){

			$paging2 .= "$line &nbsp;";

			}

		   else{

			$paging2 .= "<a href=index.php?Page=$line>$line</a>&nbsp;";

			   }

		  }

       $paging = $paging1.$paging2;


//	 print_r($reqdetails);


	$db->close();

	$db2->close();

    $pgTitle = "Admin Panel -- ";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("NoRecord",$noRec);	

	$smarty->assign_by_ref('reqdetails',$reqdetails);

	$smarty->assign("paging",$paging);	

	$smarty->assign("data",$data);		

	$smarty->assign("st",$st);		

	$smarty->assign("totCount",$totCount);			

	$smarty->display('reqtpls/index.tpl');

?>