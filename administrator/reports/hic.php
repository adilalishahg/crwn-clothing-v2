<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/index.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/graphs.inc.php');
  //  include('../Classes/pagination-class.php');	
	
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




    $st = 'approved';
  


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
 
 
 if(isset($_POST['submit']) || !empty($_GET['Page'])){
	   
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		 $cisid   = sql_replace($_REQUEST['cisid']);
		 $ssn   = sql_replace($_REQUEST['ssn']);		 
		 $address     = sql_replace($_REQUEST['address']);		 		 
		 $pname     = sql_replace($_REQUEST['pname']);		
		 $box1   = sql_replace($_REQUEST['box']);		 
		 $box2     = sql_replace($_REQUEST['box2']);	
		 $hic=$_REQUEST['hic'];
	
 
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
{ $error .= "CIS ID Missing !<br>"; }
}



 if(!$error){
 

 
	     	 $whr_clz .= " WHERE  reqid=req_id AND ".TBL_HOSPITALS.".id=userid AND userid IN(".$glueids.")";
		    
			
			 if($startdate != '' && $enddate != ''){
            $whr_clz .= "  AND appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'";   		  
		  }
		     
			  if($hic != '' && $hic != '0'){
              $whr_clz .= "  AND hic = '".$hic."'";   		  
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
  	
	
 if($glueids != ''){	 
 	//Pagination
   if($hospname == '' && $cisid != ''){
	$groupBy1 = " GROUP BY ".TBL_FORMS.".clientname "; 
	$groupBy2 = " GROUP BY ".TBL_FORMS.".clientname ORDER BY ".TBL_FORMS.".id  DESC"; 
	$showClient = 'yes';	
	 }else{
	$groupBy1 = " GROUP BY ".TBL_HOSPITALS.".id ";
	$groupBy2 = " GROUP BY ".TBL_HOSPITALS.".id ORDER BY ".TBL_HOSPITALS.".id  DESC";	
	//$showClient = 'no';	
	 }	
	
     $Querypg = "SELECT COUNT(*) FROM ".TBL_FORMS.", ".TBL_REQUESTS.",".TBL_HOSPITALS." $whr_clz";	
	 $totalRows = $db->executeScalar($Querypg);
 
    /* if(isset($_GET['pageNum'])){
	   $page_no = $_GET['pageNum'];
	 }else{
	   $page_no = '1';	 
	 }
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows);  
	$noReq = '1';  */
 }

if($totalRows > 0){


	 $Query = "SELECT *,f.id FROM ".TBL_FORMS." as f, ".TBL_REQUESTS.",".TBL_HOSPITALS."  $whr_clz
	              
			  ORDER BY appdate LIMIT $offset, $limit";
			  // 	$Query = "SELECT * FROM ".TBL_FORMS." as f, ".TBL_REQUESTS.",".TBL_HOSPITALS."  $whr_clz  LIMIT $offset, $limit";
	 
	 
	 
	 if($db->query($Query) && $db->get_num_rows() > 0)
		  { $Requests = $db->fetch_all_assoc(); 
		  
		  
		  }
		 /*echo '<pre>';
		  print_r($Requests);
		  exit;*/
		  
    /* $pages =  $pagination->display_pagination();	 */       	

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
		   
           $qry = '&startdate='.$startdate.'&enddate='.$enddate;
		   if($hospname != '0'){
		   	$qry .= '&hospname='.$hospname;
		      }
		   if($cisid != ''){
		    $qry .= '&cisid='.$cisid;
		    }
			if($ssn != ''){
		    $qry .= '&ssn='.$ssn;
		    }
			if($address != ''){
		    $qry .= '&address='.$address;
		    }
			
			if($pname != ''){
		    $qry .= '&pname='.$pname;
		    }
			if($box1 != ''){
		    $qry .= '&box='.$box1;
		    }
			if($box2 != ''){
		    $qry .= '&box2='.$box2;
		    }
			if($hic != ''){
		    $qry .= '&hic='.$hic;
		    }
		 	
           				  
	    
		$paging2 .= "<a href=hic.php?Page=$line$qry>$line</a>&nbsp;";
			   }
		  }
       $pages = $paging1.$paging2;


}
	  
	  
			
	    }   
   }else{
    $noReq = '0';
    $Txt = 'OVERALL REQUEST STATUS'; 	
   } 
 
	 
 
	
 
   $Queryhosp1 = "SELECT id,hospname,firstname FROM ".TBL_HOSPITALS." WHERE `Status`='approved'  ORDER BY `firstname` ASC";
	
   if($db2->query($Queryhosp1) && $db2->get_num_rows() > 0)
	{
	   $hosp = $db2->fetch_all_assoc();
    }

	$db->close();
	$db2->close();
	
    $pgTitle = "Admin Panel -- Hospital/Clinic";
	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign("hosp",$hosp);		
	$smarty->assign("noReq",$noReq);	
	$smarty->assign_by_ref('reqdetails',$Requests);
	$smarty->assign("pages",$pages);
	$smarty->assign("pname",$pname);		
	$smarty->assign("data",$data);	
	
	
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
	$smarty->assign("hic",$hic);	

    $smarty->assign("st",$st);			
	$smarty->display('reportstpl/hic.tpl');
		
?>