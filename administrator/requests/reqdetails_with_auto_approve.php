<?php
   	include_once('../DBAccess/Database.inc.php');
	include_once('approve_request_function.php');
	include_once('invoice_calculation_function.php');
	ignore_user_abort(true); 
	set_time_limit(3000);
	$db = new Database;	
   	$msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db = new Database;	
	$db->connect();
	if(isset($_GET['reqid']) && $_GET['reqid'] != ''){
	$uid = $_GET['reqid'];
	$tp = $_GET['tp'];

	$QueryPending = "SELECT ".TBL_FORMS.".id FROM ".TBL_FORMS." WHERE reqstatus='active' AND account='".$uid."'  ";
	if($db->query($QueryPending) && $db->get_num_rows() > 0) {	$dataids = $db->fetch_all_assoc();	}
    if($tp=='1'){
	for($i=0; $i<sizeof($dataids); $i++){
	//invoice_calculation($dataids[$i]['id']);
	insert_trip($dataids[$i]['id']);
	$query = "UPDATE ".TBL_FORMS." SET reqstatus = 'approved' WHERE id = '".$dataids[$i]['id']."'";
		$db->query($query); 
	}//end of for loop
	}
	if($tp=='2'){
	for($i=0; $i<sizeof($dataids); $i++){
	$query = "UPDATE ".TBL_FORMS." SET reqstatus = 'disapproved' WHERE id = '".$dataids[$i]['id']."'";
		$db->query($query); 
	}//end of for loop
	}  echo "<script>window.open('reqdetails_with_auto_approve.php?req=$uid','_parent');</script>"; exit;}
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

// Fetch all categories list
	$QueryCount = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS." WHERE reqstatus='$st' AND account='".$uid."'";
    if($db->query($QueryCount) && $db->get_num_rows())
	{
		$data = $db->fetch_all_assoc();
		$totalRows = $data[0]['rows'];
	}
	$Query = "SELECT * FROM ".TBL_FORMS." WHERE reqstatus='$st' AND account='".$uid."' ORDER BY appdate ASC LIMIT $offset, $limit";
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
			$paging2 .= "<a href=reqdetails.php?Page=$line$qry>$line</a>&nbsp;";
			   }
		  }
       $paging = $paging1.$paging2;
	$db->close();
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
	$smarty->display('reqtpls/reqdetails_with_auto_approve.tpl');
?>