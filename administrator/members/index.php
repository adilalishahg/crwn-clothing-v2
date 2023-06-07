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
    	
	$db->connect();
	$db2->connect();

	/*************** Paging ************** */
	
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	
	$limit = 20;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20; 


	
// Delete Category Script
    if(isset($_GET['delId']) && $_GET['delId'] != ''){
   		$QueryDel = "DELETE FROM ".TBL_HOSPITALS." WHERE id='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{
	   		header("Location: index.php");
	   		exit;
	  	   //Delete subcategories as wel
	 //$db2->query($QuerypicDel = "DELETE FROM `categories` WHERE id='".$_GET['delId']."'");	   		
		}else{
	   		header("Location: index.php");
	   		exit;	
		}  
  	}

// Fetch all categories list
	$QueryCounty = "SELECT COUNT(*) AS rows FROM ".TBL_HOSPITALS;
     if($db2->query($QueryCounty) && $db2->get_num_rows())
	  {
      $data = $db2->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }

	$Query = "SELECT * FROM ".TBL_HOSPITALS."  ORDER BY `firstname` ASC LIMIT $offset, $limit";
	$Query2 = "SELECT * FROM ".TBL_HOSPITALS." ORDER BY `firstname` ASC";
	
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $membdetail = $db->fetch_all_assoc();
	} else{
	   $noRec .=  "NO RECORD FOUND";	 
    }



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

	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Members";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('membdetail',$membdetail);
	$smarty->assign("paging",$paging);		
	$smarty->display('membertpl/index.tpl');
		

?>