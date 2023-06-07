<?php
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
	$total=$app=$pend=$disap=0;
	//$gappt="SELECT * FROM ".appointment_type; if($db->query($gappt) && $db->get_num_rows() >0){$appdata = $db->fetch_all_assoc();}		

	/*************** Paging ************** */
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	$limit = 20000;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 20000; 
 if(isset($_GET['st']) && $_GET['st'] != ''){
    $st = $_GET['st'];
 }else{
    $st = 'active';
  } 
	//GET LIST OF APPROVED USERS
		$getUsers = "SELECT id FROM ".accounts." ";
		   if($db->query($getUsers) && $db->get_num_rows() > 0)
			{ $users = $db->fetch_all_assoc();  }
	  if(count($users) > 0){	
		for($i=0; $i<count($users); $i++){  
			$gid =  $users[$i]['id'];
			array_push($usersid,"'".$gid."'"); 
		}
		$glueids = implode(',',$usersid);
       }
 if(isset($_REQUEST['submit'])){
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		 $cisid   = sql_replace($_REQUEST['cisid']);
		 $ssn   = sql_replace($_REQUEST['ssn']);		 
		 $address     = sql_replace($_REQUEST['address']);		 		 
		 $pname     = sql_replace($_REQUEST['pname']);
		 $code     = sql_replace($_REQUEST['code']);		
		 
		  $by_date     = sql_replace($_REQUEST['by_date']);		
		 $apptype     = sql_replace($_REQUEST['apptype']);		
		 $box1   = sql_replace($_REQUEST['box']);		 
		 $box2     = sql_replace($_REQUEST['box2']);	
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
       }	
if(isset($_REQUEST['box'])){
  if($cisid ==  '')
{ $error .= "AHCCCS# Missing !<br>"; }
}
if(isset($_REQUEST['box2'])){
  if($ssn ==  '')
{ $error .= "Social Security Number Missing !<br>"; }

}
$by_date = $_REQUEST['by_date']; 
//debug($_REQUEST);
 if(!$error){
	     	 $whr_clz .= " WHERE 1 ";
		     if($startdate != '' && $enddate != ''){
$whr_clz .= "  AND $by_date BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'";	  		  }
		     if($hospname != '' && $hospname != '0'){
              $whr_clz .= "  AND ".TBL_FORMS.".account = '".$hospname."'";   		  
		  }		  
	       if($cisid != ''){
            $whr_clz .= "  AND cisid='".$cisid."'";   		  
		  }	
		   if($code != ''){
            $whr_clz .= "  AND ccodea='".$code."'";   		  
		  }		  
	         if($ssn != ''){
            $whr_clz .= "  AND ssn='".$ssn."'";   		  
		  }	
	         if($pname != ''){
            $whr_clz .= "  AND clientname LIKE '%".trim($pname)."%'";   		  
		  }			  		  
	         if($address != ''){
            $whr_clz .= "  AND street_address LIKE '%".$address."%'";   		  
		  }		  
		   if($apptype != ''){
            $whr_clz .= "  AND appt_type = '".$apptype."'";   		  
		  }		  
 if($glueids != ''){	 
 	//Pagination
  /* if($hospname == '' && $cisid != ''){
	$groupBy1 = " GROUP BY ".TBL_FORMS.".clientname "; 
	$groupBy2 = " GROUP BY ".TBL_FORMS.".clientname ORDER BY ".TBL_FORMS.".id  DESC"; 
	$showClient = 'yes';	
	 }else{
	$groupBy1 = " GROUP BY ".accounts.".id ";
	$groupBy2 = " GROUP BY ".accounts.".id ORDER BY ".accounts.".id  DESC";	
	$showClient = 'no';	
	 }*/	
     $Querypg = "SELECT COUNT(*) FROM ".TBL_FORMS." $whr_clz ";	
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
$Query = "SELECT ".TBL_FORMS.".*,ac.account_name FROM ".TBL_FORMS." 
										LEFT JOIN accounts as ac on ".TBL_FORMS.".account=ac.id  $whr_clz GROUP BY ".TBL_FORMS.".account
			   LIMIT ".$pagination->startRow . ",".$pagination->maxRows;	  
	 if($db->query($Query) && $db->get_num_rows() > 0)
		  { $Requests = $db->fetch_all_assoc(); }
     $pages =  $pagination->display_pagination();	
	 $Query77 = "SELECT * FROM ".TBL_FORMS."  $whr_clz ";
	 if($db->query($Query77) && $db->get_num_rows() > 0){ $Requests77 = $db->fetch_all_assoc();
	 for($i=0;$i<sizeof($Requests77);$i++){
		 $total++;
		    $status88=$Requests77[$i]['reqstatus'];
		   switch($status88){
			   case 'approved': 	$app++;	 	break;
			   case 'active': 		$pend++;	break;
			   case 'disapproved': 	$disap++;	break;
			   break;
			   }
		 }
	 
	 
	  }
		  
	 //print_r($Requests77);        	
//DATA
	$g2data1 = "SELECT COUNT(*) FROM ".TBL_FORMS."  $whr_clz AND reqstatus='active'";
    $g2activeReqs = $db2->executeScalar($g2data1);
	$g2data2 = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS."  $whr_clz AND reqstatus='approved'";
    $g2appReqs = $db2->executeScalar($g2data2);
	$g2data3 = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS."  $whr_clz AND reqstatus='disapproved'";
   $g2disappReqs  = $db2->executeScalar($g2data3);
}
			$graph2 = new BAR_GRAPH("hBar");
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
		$Txt = 'SEARCH BASED GENERATED GRAPH';  
	    }   
   }else{
    $noReq = '0';
    $Txt = 'OVERALL REQUEST STATUS'; 	
   } 
	$graph1 = new BAR_GRAPH("hBar");
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
	$graph1->absValuesBorder = "2px groove white";
 $Queryhosp1 = "SELECT id,account_name FROM ".accounts." WHERE 1=1  ORDER BY `account_name` ASC";
   if($db2->query($Queryhosp1) && $db2->get_num_rows() > 0)
	{	   $hosp = $db2->fetch_all_assoc();    }
$Qccode = "SELECT * FROM ".companycodes." WHERE 1=1  ORDER BY `company` ASC";
   if($db->query($Qccode) && $db->get_num_rows() > 0)
	{	   $ccode = $db->fetch_all_assoc();    }	
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- ";
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
	$smarty->assign("by_date",$by_date);	
	$smarty->assign("appdata",$appdata);	
	$smarty->assign("apptype",$apptype);
	$smarty->assign("total",$total);
	$smarty->assign("app",$app);
	$smarty->assign("pend",$pend);
	$smarty->assign("disap",$disap);
	$smarty->assign("ccode",$ccode);
	$smarty->assign("code",$code);		
	$smarty->display('reportstpl/index.tpl');
?>