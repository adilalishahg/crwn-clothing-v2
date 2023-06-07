<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
   $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
	$db->connect();
	$db2->connect();
	$whr = '';
	
	/*************** Paging ************** */
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	$limit = 20;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20; 
 if(isset($_GET['st']) && $_GET['st'] != ''){
    $st = $_GET['st'];
 }else{
    $st = 'active';
  } 
 if(isset($_GET['req']) && $_GET['req'] != ''){
    $uid = $_GET['req'];
 }

	if($_GET['type']) {$whr = " AND appt_type = '".$_GET['type']."' ";}
// Fetch all categories list
	$QueryCount = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS." WHERE reqstatus='$st'  AND account='".$uid."' $whr";
    if($db2->query($QueryCount) && $db2->get_num_rows())
	{
		$data = $db2->fetch_all_assoc();
		$totalRows = $data[0]['rows'];
	}
	$Query = "SELECT * FROM ".TBL_FORMS." WHERE reqstatus='$st' AND account='".$uid."' $whr ORDER BY appdate ASC LIMIT $offset, $limit";
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $reqdetails = $db->fetch_all_assoc();
	} else{
	   $noRec .=  "NO RECORD FOUND";	 
    }
    $add=$reqdetails[0]['pickaddr'];
	$dsadd=$reqdetails[0]['destination'];
	$paddr=explode(',',$add);
	$daddr=explode(',',$dsadd);
	$pckaddr=$paddr[0];  
	$srpaddr=$daddr[0];  
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
		   if($uid != ''){
		   	$qry = '&req='.$uid;
		      }
		   if($st != ''){
		    $qry .= '&st='.$st;
		    }
		if($_GET['type']){
		    $qry .= '&type='.$_GET['type'];
		    }	
			$paging2 .= "<a href=reqdetails.php?Page=$line$qry>$line</a>&nbsp;";
			   }
		  }
       $paging = $paging1.$paging2;
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- ";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);
	$smarty->assign("pck",$pckaddr);
	$smarty->assign("drp",$srpaddr);	
	$smarty->assign_by_ref('reqdetails',$reqdetails);
	$smarty->assign("paging",$paging);	
	$smarty->assign("st",$st);
	$smarty->assign("req",$uid);
	$smarty->assign("appdata",$appdata);
	$smarty->assign("type",$_GET['type']);				
	$smarty->display('reqtpls/reqdetails.tpl');
?>