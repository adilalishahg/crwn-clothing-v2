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
 
 		 $cisid1   = sql_replace($_REQUEST['cisid1']);
		 $cisid2   = sql_replace($_REQUEST['cisid2']);
		 $cisid3   = sql_replace($_REQUEST['cisid3']);
		 $cisid4   = sql_replace($_REQUEST['cisid4']);
		 $cisid5   = sql_replace($_REQUEST['cisid5']);
		 $cisid6   = sql_replace($_REQUEST['cisid6']);
		 $cisid7   = sql_replace($_REQUEST['cisid7']);
		 $cisid8   = sql_replace($_REQUEST['cisid8']);
		 $cisid9   = sql_replace($_REQUEST['cisid9']);
		 $cisid10   = sql_replace($_REQUEST['cisid10']);
		 $cisid11   = sql_replace($_REQUEST['cisid11']);
		 $cisid12   = sql_replace($_REQUEST['cisid12']);
		 $cisid13   = sql_replace($_REQUEST['cisid13']);
		 $cisid14   = sql_replace($_REQUEST['cisid14']);
		 $cisid15   = sql_replace($_REQUEST['cisid15']);
		 $cisid16   = sql_replace($_REQUEST['cisid16']);
		 $cisid17   = sql_replace($_REQUEST['cisid17']);
		 $cisid18   = sql_replace($_REQUEST['cisid18']);
		 $cisid19   = sql_replace($_REQUEST['cisid19']);
		 $cisid20   = sql_replace($_REQUEST['cisid20']);
		 
		
	     $hicdate1 = sql_replace($_REQUEST['hicdate1']);
		 $hicdate2 = sql_replace($_REQUEST['hicdate2']);
		 $hicdate3 = sql_replace($_REQUEST['hicdate3']);
		 $hicdate4 = sql_replace($_REQUEST['hicdate4']);
		 $hicdate5 = sql_replace($_REQUEST['hicdate5']);
		 $hicdate6 = sql_replace($_REQUEST['hicdate6']);
		 $hicdate7 = sql_replace($_REQUEST['hicdate7']);
		 $hicdate8 = sql_replace($_REQUEST['hicdate8']);
		 $hicdate9 = sql_replace($_REQUEST['hicdate9']);
		 $hicdate10 = sql_replace($_REQUEST['hicdate10']);
		 $hicdate11 = sql_replace($_REQUEST['hicdate11']);
		 $hicdate12 = sql_replace($_REQUEST['hicdate12']);
		 $hicdate13 = sql_replace($_REQUEST['hicdate13']);
		 $hicdate14 = sql_replace($_REQUEST['hicdate14']);
		 $hicdate15 = sql_replace($_REQUEST['hicdate15']);
		 $hicdate16 = sql_replace($_REQUEST['hicdate16']);
		 $hicdate17 = sql_replace($_REQUEST['hicdate17']);
		 $hicdate18 = sql_replace($_REQUEST['hicdate18']);
		 $hicdate19 = sql_replace($_REQUEST['hicdate19']);
		 $hicdate20 = sql_replace($_REQUEST['hicdate20']);
		 
		 		 

 if(!$error){
 

 		$whr_clz .= " WHERE  reqid=req_id AND ".TBL_HOSPITALS.".id=userid AND userid IN(".$glueids.") AND hic='1'";
		 $j=0;
		 for($i=1;$i<=20;$i++){		 	
		 	$t = sql_replace($_REQUEST['cisid'.$i]);
			$q = sql_replace($_REQUEST['hicdate'.$i]);
		 	if($t != '' AND $q != ''){
				$j++;
				$whr_clz .= ($j==1) ? " AND ( " : " OR ";
				$whr_clz .= " (appdate = '".convertDateToMySQL($q)."' AND cisid = '".$t."')"; 
			}elseif($q != ''){
				$j++;
				$whr_clz .= ($j==1) ? " AND " : " OR ";
				$whr_clz .= " (appdate = '".convertDateToMySQL($q)."')";
			}elseif($t != ''){
				$j++;
				$whr_clz .= ($j==1) ? " AND " : " OR ";
				$whr_clz .= " (cisid = '".$t."')";
			}
		 }
	     $whr_clz .= ($j>0) ? ")" : "";	 
	
 if($glueids != ''){	 
 	//Pagination
   if($cisid != ''){
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
	              
			  ORDER BY appdate DESC LIMIT $offset, $limit";
			  // 	$Query = "SELECT * FROM ".TBL_FORMS." as f, ".TBL_REQUESTS.",".TBL_HOSPITALS."  $whr_clz  LIMIT $offset, $limit";
	 
	 
	 
	 if($db->query($Query) && $db->get_num_rows() > 0)
		  { $Requests = $db->fetch_all_assoc(); 
		  
		  
		  }
		  
		  //New code for reclaim by Muhammad Usman
		   for($i=1; $i<21; $i++)
		  {
		   $cisid =  sql_replace($_REQUEST['cisid'.$i]);
		   $appdate = convertDateToMySQL(sql_replace($_REQUEST['hicdate'.$i]));
		   
		  $Query = "SELECT * FROM ".TBL_FORMS." where cisid = '$cisid' AND appdate = '$appdate' ";
		  if($db->query($Query) && $db->get_num_rows() > 0)
		  { $Requests1 = $db->fetch_all_assoc(); 
		  if($i == 1) $hole_arr = $Requests1;
		  else
		  $hole_arr = array_merge($hole_arr,$Requests1);
		   //debug($Requests1);
		   }
		   	  
		  }
		  //end of new code for reclaim 
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
		   
		   if($hicdate != ''){
		   	$qry = '&hicdate='.$hicdate;
		   }
		   if($cisid != ''){
		    $qry .= '&cisid='.$cisid;
		    }         				  
	    
		$paging2 .= "<a href=reclaim.php?Page=$line$qry>$line</a>&nbsp;";
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
	//Old one 
	//$smarty->assign_by_ref('reqdetails',$Requests);
	$smarty->assign_by_ref('reqdetails',$hole_arr);
	//$smarty->assign("pages",$pages);
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
	
	$smarty->assign("hicdate1",$hicdate1);
	$smarty->assign("hicdate2",$hicdate2);
	$smarty->assign("hicdate3",$hicdate3);
	$smarty->assign("hicdate4",$hicdate4);
	$smarty->assign("hicdate5",$hicdate5);
	$smarty->assign("hicdate6",$hicdate6);
	$smarty->assign("hicdate7",$hicdate7);
	$smarty->assign("hicdate8",$hicdate8);
	$smarty->assign("hicdate9",$hicdate9);
	$smarty->assign("hicdate10",$hicdate10);
	$smarty->assign("hicdate11",$hicdate11);
	$smarty->assign("hicdate12",$hicdate12);
	$smarty->assign("hicdate13",$hicdate13);
	$smarty->assign("hicdate14",$hicdate14);
	$smarty->assign("hicdate15",$hicdate15);
	$smarty->assign("hicdate16",$hicdate16);
	$smarty->assign("hicdate17",$hicdate17);
	$smarty->assign("hicdate18",$hicdate18);
	$smarty->assign("hicdate19",$hicdate19);
	$smarty->assign("hicdate20",$hicdate20);
	
	$smarty->assign("cisid1",$cisid1);
	$smarty->assign("cisid2",$cisid2);
	$smarty->assign("cisid3",$cisid3);
	$smarty->assign("cisid4",$cisid4);
	$smarty->assign("cisid5",$cisid5);
	$smarty->assign("cisid6",$cisid6);
	$smarty->assign("cisid7",$cisid7);
	$smarty->assign("cisid8",$cisid8);
	$smarty->assign("cisid9",$cisid9);
	$smarty->assign("cisid10",$cisid10);
	$smarty->assign("cisid11",$cisid11);
	$smarty->assign("cisid12",$cisid12);
	$smarty->assign("cisid13",$cisid13);
	$smarty->assign("cisid14",$cisid14);
	$smarty->assign("cisid15",$cisid15);
	$smarty->assign("cisid16",$cisid16);
	$smarty->assign("cisid17",$cisid17);
	$smarty->assign("cisid18",$cisid18);
	$smarty->assign("cisid19",$cisid19);
	$smarty->assign("cisid20",$cisid20);	

    $smarty->assign("st",$st);			
	$smarty->display('reportstpl/reclaim.tpl');		
?>