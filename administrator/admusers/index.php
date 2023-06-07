<?php
   	/* *************************** *
	   * Date: 26-Jan-2010 
	   * Admin users/index.php
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
    if(verify($_GET['delId'],"index.php")){
   		$QueryDel = "DELETE FROM ".TBL_ADMIN." WHERE admin_id='".$_GET['delId']."'";
  		if($db->query($QueryDel))
		{
			echo '<script>location.href="index.php";</script>';
	   		@header("Location: index.php");
	   		exit;	
		}else{
			echo '<script>location.href="index.php";</script>';
	   		@header("Location: index.php");
	   		exit;	
		}  
  	}

// Fetch all categories list
	$QueryCounty = "SELECT COUNT(*) AS rows FROM ".TBL_ADMIN." WHERE admin_level != '0'";
     if($db2->query($QueryCounty) && $db2->get_num_rows())
	  {
      $data = $db2->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }

	$Query = "SELECT * FROM ".TBL_ADMIN." WHERE admin_level != '0'  ORDER BY `admin_name` ASC LIMIT $offset, $limit";
	$Query2 = "SELECT * FROM ".TBL_ADMIN." WHERE admin_level != '0' ORDER BY `admin_name` ASC";
	
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $admdetail = $db->fetch_all_assoc();
	} else{
	   $noRec .=  "NO RECORD FOUND";	 
    }



   // Footer paging
      $show = ceil($totalRows/$maxRecord);
	  if($totalRows > $maxRecord){	
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
	   }	  
       $paging = $paging1.$paging2;

	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Admin Users";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('admdetail',$admdetail);
	$smarty->assign("paging",$paging);		
	$smarty->display('admtpl/index.tpl');
?>