<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
   $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db->connect();
	/*************** Paging ************** */
	if(!empty($_GET['Page']))	{ $page = $_GET['Page']; }	else	{ $page = 1; }
	$limit = 200;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 200; 
// Delete Category Script
    if(verify($_GET['delId'],"index.php")){
   		$QueryDel = "DELETE FROM ".contents." WHERE id='".$_GET['delId']."'";
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
	$QueryCounty = "SELECT COUNT(*) AS rows FROM ".contents;
     if($db->query($QueryCounty) && $db->get_num_rows())
	  {
      $data = $db->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }
	$Query = "SELECT * FROM ".contents." ORDER BY `id` DESC LIMIT $offset, $limit";
	//$Query2 = "SELECT * FROM ".site_type." ORDER BY `prgtitle` ASC";
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
    $pgTitle = "Admin Panel -- ";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('admdetail',$admdetail);
	$smarty->assign("paging",$paging);		
	$smarty->display('cms/index.tpl');
?>