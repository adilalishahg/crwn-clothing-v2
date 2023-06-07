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


 if(isset($_GET['st']) && $_GET['st'] != ''){
    $st = $_GET['st'];
 }else{
    $st = 'active';
  } 

 if(isset($_GET['req']) && $_GET['req'] != ''){
    $uid = $_GET['req'];
 }
 
 if(isset($_GET['cisid']) && $_GET['cisid'] != ''){
    $cisid = $_GET['cisid'];
	$whr = '';
	$whr .= " AND ".TBL_FORMS.".cisid = '".$cisid."' ";
 } 
	

if(isset($_GET['startdate']) && $_GET['enddate'] && $_GET['startdate'] != '' && $_GET['enddate'] != ''){
    $qry .= '&startdate='.$_GET['startdate'].'&enddate='.$_GET['enddate'];
	$whr .= " AND today_date BETWEEN '".sql_replace(convertDateToMySQL($_GET['startdate']))." 00:00:00' AND '".sql_replace(convertDateToMySQL($_GET['enddate']))." 23:59:59' ";   

}

if(isset($_GET['pname']) && $_GET['pname'] != ''){
    $qry .= '&pname='.$_GET['pname'];
	$whr .= " AND ".TBL_FORMS.".clientname LIKE '%".$_GET['pname']."%'";   

}

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
$QueryCount = "SELECT COUNT(DISTINCT(id)) AS rows FROM ".TBL_FORMS.", ".TBL_REQUESTS." WHERE reqstatus='$st' AND reqid=req_id AND userid='".$uid."' $whr ";
     if($db2->query($QueryCount) && $db2->get_num_rows())
	  {
      $data = $db2->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }

	$Query = "SELECT * FROM ".TBL_FORMS.", ".TBL_REQUESTS." WHERE reqstatus='$st' AND reqid=req_id AND userid='".$uid."' $whr LIMIT $offset, $limit";
	
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $reqdetails = $db->fetch_all_assoc();
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
		   if($uid != ''){
		   	$qry = '&req='.$uid;
		      }
		   if($st != ''){
		    $qry .= '&st='.$st;
		    }
           if(isset($_GET['startdate']) && $_GET['enddate'] && $_GET['startdate'] != '' && $_GET['enddate'] != ''){
            $qry .= '&startdate='.$_GET['startdate'].'&enddate='.$_GET['enddate'];
	       }				  
	
		$paging2 .= "<a href=reqdetails.php?Page=$line$qry>$line</a>&nbsp;";
			   }
		  }
       $paging = $paging1.$paging2;

	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Hospital/Clinic";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('reqdetails',$reqdetails);
	$smarty->assign("paging",$paging);	
	$smarty->assign("st",$st);
	$smarty->assign("req",$uid);				
	$smarty->display('reqtpls/reqdetails.tpl');
		
?>