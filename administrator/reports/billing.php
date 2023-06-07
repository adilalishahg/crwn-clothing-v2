<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/index.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/graphs.inc.php');
    include('../Classes/pagination-class.php');	
	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
    $error = '';	
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
    	
	$db->connect();
	$db2->connect();
    $usersid = array();
	
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


	//GET LIST OF APPROVED USERS
		$getUsers = "SELECT * FROM ".TBL_HOSPITALS." WHERE `Status`='approved'";
		   if($db->query($getUsers) && $db->get_num_rows() > 0)
			{ $users = $db->fetch_all_assoc();  }
	
	  if(count($users) > 0){	
		for($i=0; $i<count($users); $i++){  
			$gid =  $users[$i]['id'];
			array_push($usersid,"'".$gid."'"); 
		}
		$glueids = implode(',',$usersid);
       }
 
 
 if(isset($_POST['submit'])){
	   
	     $startdate = sql_replace($_POST['startdate']);
		 $enddate   = sql_replace($_POST['enddate']);
		 $hospname   = sql_replace($_POST['hospname']);
		 $cisid   = sql_replace($_POST['cisid']);
		 $ssn   = sql_replace($_POST['ssn']);		 
		 $address     = sql_replace($_POST['address']);		 		 
		 $pname     = sql_replace($_POST['pname']);		
		 $box1   = sql_replace($_POST['box']);		 
		 $box2     = sql_replace($_POST['box2']);	
	
 
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
           if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
       }	

/*if(isset($_POST['box'])){
  if($cisid ==  '')
{ $error .= "AHCCCS# Missing !<br>"; }
}

if(isset($_POST['box2'])){
  if($ssn ==  '')
{ $error .= "Social Security Number Missing !<br>"; }
}*/


 if(!$error){
	     	 $whr_clz .= " WHERE reqid=req_id AND ".TBL_HOSPITALS.".id=userid AND userid IN(".$glueids.")";
		     if($startdate != '' && $enddate != ''){
            $whr_clz .= "  AND reqdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'";   		  
		  }
		     if($hospname != '' && $hospname != '0'){
              $whr_clz .= "  AND ".TBL_HOSPITALS.".id = '".$hospname."'";   		  
		  }		  
	         if($cisid != ''){
            $whr_clz .= "  AND cisid='".$cisid."'";   		  
		  }		  
	         if($ssn != ''){
            $whr_clz .= "  AND ssn='".$ssn."'";   		  
		  }	
	         if($pname != ''){
            $whr_clz .= "  AND clientname LIKE '%".$pname."%'";   		  
		  }			  		  
	         if($address != ''){
            $whr_clz .= "  AND street_address LIKE '%".$address."%'";   		  
		  }	
		  
		  $whr_clz .= " AND ".TBL_REQUESTS.".hospname = 'Online User'";
		  
		  $whr_clz .= " AND ".TBL_CREDIT_CARD.".request_id = reqid ";
  	
	
 if($glueids != ''){	 
 	//Pagination
   if($hospname == '' && $cisid != ''){
	$groupBy1 = " GROUP BY ".TBL_FORMS.".clientname "; 
	$groupBy2 = " GROUP BY ".TBL_FORMS.".clientname ORDER BY ".TBL_FORMS.".id  DESC"; 
	$showClient = 'yes';	
	 }else{
	$groupBy1 = " GROUP BY ".TBL_HOSPITALS.".id ";
	$groupBy2 = " GROUP BY ".TBL_HOSPITALS.".id ORDER BY ".TBL_HOSPITALS.".id  DESC";	
	$showClient = 'no';	
	 }	
	
    //echo '<br>', $Querypg = "SELECT COUNT(*) FROM ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_HOSPITALS.",".TBL_CREDIT_CARD." $whr_clz  $groupBy1";	
	$Querypg = "SELECT * FROM ".TBL_FORMS.", ".TBL_REQUESTS.", ".TBL_CREDIT_CARD.", ".TBL_HOSPITALS." $whr_clz  and reqid = request_id  $groupBy1";	
	 $totalRows = $db->executeScalar($Querypg);
 
     if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows);  
	$noReq = '1';  
 }

if($totalRows > 0){

$Query = "SELECT * FROM ".TBL_FORMS.", ".TBL_REQUESTS.", ".TBL_CREDIT_CARD.", ".TBL_HOSPITALS." $whr_clz  and reqid = request_id $groupBy2   LIMIT ".$pagination->startRow . ",".$pagination->maxRows;

/*SELECT * FROM request_info f, requests r,credit_card c,hospitals 
WHERE r.reqid=f.req_id AND hospitals.id=userid AND userid IN('91','93','94','95','96') AND r.reqdate BETWEEN '2011-01-01 00:00:00' AND '2011-12-31 23:59:59' AND hospitals.hospname = 'Online User' AND c.request_id = r.reqid and r.reqid=c.request_id GROUP BY hospitals.id ORDER BY hospitals.id DESC LIMIT 0,10*/
	 
	 
	 
	if($db->query($Query) && $db->get_num_rows() > 0)
	{ 
		$Requests = $db->fetch_all_assoc();
	}		  
	$pages =  $pagination->display_pagination();

//echo '<pre>';
//print_r($Requests);
//exit;


//DATA
	$g2data1 = "SELECT COUNT(*) FROM ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_HOSPITALS.",".TBL_CREDIT_CARD."  $whr_clz AND reqstatus='active'";
    $g2activeReqs = $db2->executeScalar($g2data1);

	$g2data2 = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_HOSPITALS.",".TBL_CREDIT_CARD."  $whr_clz AND reqstatus='approved'";
    $g2appReqs = $db2->executeScalar($g2data2);

	$g2data3 = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_HOSPITALS.",".TBL_CREDIT_CARD."  $whr_clz AND reqstatus='disapproved'";
    $g2disappReqs  = $db2->executeScalar($g2data3);
}
	  
	  
			/*$graph2 = new BAR_GRAPH("hBar");
			$graph2->values = "$g2activeReqs,$g2appReqs,$g2disappReqs";
			$graph2->labels = "Pending,Approved,Disapproved";
			$graph2->showValues = 1;
			$graph2->barWidth = 20;
			$graph2->barLength = 1.0;
			$graph2->labelSize = 12;
			$graph2->absValuesSize = 12;
			$graph2->percValuesSize = 12;
			$graph2->graphPadding = 10;
			$graph2->graphBGColor = "#ABCDEF";
			$graph2->graphBorder = "1px solid blue";
			$graph2->barColors = "#A0C0F0";
			$graph2->barBGColor = "#E0F0FF";
			$graph2->barBorder = "2px outset white";
			$graph2->labelColor = "#000000";
			$graph2->labelBGColor = "#C0E0FF";
			$graph2->labelBorder = "2px groove white";
			$graph2->absValuesColor = "#000000";
			$graph2->absValuesBGColor = "#FFFFFF";
			$graph2->absValuesBorder = "2px groove white";	  
	
			$Txt = 'SEARCH BASED GENERATED GRAPH';  */
	    }   
   }else{
    $noReq = '0';
    $Txt = 'OVERALL REQUEST STATUS'; 	
   } 
 
	  if(count($users) > 0){	

//DATA
  $g1data1 = "SELECT COUNT(*) AS rows FROM 
	              ".TBL_HOSPITALS.", ".TBL_FORMS.", ".TBL_REQUESTS." 
				  WHERE reqstatus = 'active' 
				  AND reqid=req_id AND userid=".TBL_HOSPITALS.".id AND userid IN (".$glueids.")";

  $g1activeReqs = $db2->executeScalar($g1data1);

  $g1data2 = "SELECT COUNT(*) AS rows FROM 
	              ".TBL_HOSPITALS.", ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_CREDIT_CARD." 
				  WHERE reqstatus = 'approved' 
				  AND reqid=req_id AND userid=".TBL_HOSPITALS.".id AND userid IN (".$glueids.")";
   
  $g1appReqs = $db2->executeScalar($g1data2);
	 

  $g1data3 = "SELECT COUNT(*) AS rows FROM 
	              ".TBL_HOSPITALS.", ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_CREDIT_CARD." 
				  WHERE reqstatus = 'disapproved' 
				  AND reqid=req_id AND userid=".TBL_HOSPITALS.".id AND userid IN (".$glueids.")";
   
  $g1disappReqs = $db2->executeScalar($g1data3);

}
 
	/*$graph1 = new BAR_GRAPH("hBar");
	$graph1->values = "$g1activeReqs,$g1appReqs,$g1disappReqs";
	$graph1->labels = "Pending,Approved,Disapproved";
	$graph1->showValues = 1;
	$graph1->barWidth = 20;
	$graph1->barLength = 1.0;
	$graph1->labelSize = 12;
	$graph1->absValuesSize = 12;
	$graph1->percValuesSize = 12;
	$graph1->graphPadding = 10;
	$graph1->graphBGColor = "#ABCDEF";
	$graph1->graphBorder = "1px solid blue";
	$graph1->barColors = "#A0C0F0";
	$graph1->barBGColor = "#E0F0FF";
	$graph1->barBorder = "2px outset white";
	$graph1->labelColor = "#000000";
	$graph1->labelBGColor = "#C0E0FF";
	$graph1->labelBorder = "2px groove white";
	$graph1->absValuesColor = "#000000";
	$graph1->absValuesBGColor = "#FFFFFF";
	$graph1->absValuesBorder = "2px groove white";*/
 
 
 $Queryhosp1 = "SELECT id,hospname,firstname FROM ".TBL_HOSPITALS." WHERE `Status`='approved'  ORDER BY `firstname` ASC";
	
   if($db2->query($Queryhosp1) && $db2->get_num_rows() > 0)
	{
	   $hosp = $db2->fetch_all_assoc();
    }

	$db->close();
	$db2->close();
	
    $pgTitle = "Admin Panel -- Billing";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("drawChart",'yes');	
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign("hosp",$hosp);		
	$smarty->assign("noReq",$noReq);	
	$smarty->assign_by_ref('reqdetails',$Requests);
	$smarty->assign("pages",$pages);
	$smarty->assign("pname",$pname);		
	$smarty->assign("data",$data);	
	$smarty->assign('graph1',$graph1);
	$smarty->assign('graph2',$graph2);		
	$smarty->assign("g2activeReqs",$g2activeReqs);		
	$smarty->assign("g2appReqs",$g2appReqs);		
	$smarty->assign("g2disappReqs",$g2disappReqs);	
	$smarty->assign("showClient",$showClient);	
	$smarty->assign('Txt',$Txt);	
	$smarty->assign('startdate',$startdate);	
	$smarty->assign("enddate",$enddate);		
	$smarty->assign("hospname",$hospname);		
	$smarty->assign("cisid",$cisid);		
	$smarty->assign("ssn",$ssn);		
	$smarty->assign("address",$address);		
	$smarty->assign("box1",$box1);		
	$smarty->assign("box2",$box2);	
   	$smarty->assign("pages",$pages);	
      
    $smarty->assign("st",$st);			
	$smarty->display('reportstpl/billing.tpl');
		
?>