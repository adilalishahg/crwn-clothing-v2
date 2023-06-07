<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db->connect();
	$whr_name ='';
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
   		$QueryDel = "DELETE FROM ".accounts." WHERE id='".$_GET['delId']."'";
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
	 if(isset($_GET['name']) && $_GET['name'] !=''){
		$whr_name .= " AND account_name LIKE '%".$_GET['name']."%' ";
		}
// Fetch all categories list
	$QueryCounty = "SELECT COUNT(*) AS rows FROM ".accounts." WHERE 1=1  $whr_clz $whr_name " ;
     if($db->query($QueryCounty) && $db->get_num_rows())
	  {
      $data = $db->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }
	$Query = "SELECT * FROM ".accounts." WHERE 1=1  $whr_clz $whr_name ORDER BY `account_name` ASC LIMIT $offset, $limit";
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
    $pgTitle = "Admin Panel -- Program Types";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('admdetail',$admdetail);
	$smarty->assign("paging",$paging);		
	$smarty->display('accounts/index.tpl');
?>