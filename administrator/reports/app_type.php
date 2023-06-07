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
$gappt="SELECT * FROM ".appointment_type; if($db->query($gappt) && $db->get_num_rows() >0){$appdata = $db->fetch_all_assoc();}		
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

	if(isset($_REQUEST['submit']) || !empty($_GET['Page'])){	   
		$startdate = sql_replace($_REQUEST['startdate']);
		$dt = explode("/",$startdate);
		$startdate = $dt[2].'-'.$dt[0].'-'.$dt[1];
		$enddate   = sql_replace($_REQUEST['enddate']);
		$dt = explode("/",$enddate);
		$enddate = $dt[2].'-'.$dt[0].'-'.$dt[1];
		$apptype  = sql_replace($_REQUEST['apptype']);

   
			/*switch($apptype){
				case '' :
					$at = "";
					break;
				case '1' :
					$at = "1";
					break;
				case '0' :
					$at = "0";
					break;
					
			}			
		*/



	if($startdate == '' && $enddate == '')
	{
		$error .= "Start and End date Fields are mandatory!<br>";
	}else{   
		if($startdate !=  '' && $enddate == '')
		{ $error .= " End Date Missing !<br>"; }
		if($startdate ==  '' && $enddate != '')
		{ $error .= " Start Date Missing !<br>"; }
	}

	if(isset($_REQUEST['apptype'])){
		if($apptype ==  '')
		{
			$error .= "Appointment Type Missing !<br>"; }
		}

		if(!$error){
			//Fetch all categories list
			//$QueryCount = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS.", ".TBL_REQUESTS." WHERE reqid=req_id AND today_date BETWEEN '".$startdate."' AND '".$enddate."' ".$at;
		if($at != '')
			$whrcnt =  " AND appt_type = '$apptype'";	
			
				$QueryCount = "SELECT COUNT(*) AS rows FROM ".TBL_FORMS.", ".TBL_REQUESTS." WHERE reqid=req_id AND today_date BETWEEN '".$startdate."' AND '".$enddate."' ".$whrcnt;
			
	$QueryCount = "SELECT COUNT(*) AS rows FROM request_info, requests WHERE reqid=req_id AND today_date BETWEEN '$startdate' AND '$enddate'".$whrcnt; 

			
			
			if($db2->query($QueryCount) && $db2->get_num_rows())
			{
				$data = $db2->fetch_all_assoc();
				$totalRows = $data[0]['rows'];
			}
//	$Query = "SELECT * FROM ".TBL_FORMS.", ".TBL_REQUESTS." WHERE reqid=req_id AND today_date BETWEEN '".$startdate."' AND '".$enddate.' '.$at." LIMIT $offset, $limit";
		$whr =  " AND appt_type = '$apptype'";
	
	$Query =" SELECT * FROM request_info, requests WHERE reqid=req_id AND today_date BETWEEN '$startdate' AND '$enddate'".$whr." ORDER BY reqid DESC LIMIT $offset, $limit";
			
		   if($db->query($Query) && $db->get_num_rows() > 0)
			{
			   $reqdetails = $db->fetch_all_assoc();
			} else{
			   $noRec .=  "NO RECORD FOUND";	 
			}
			
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
		   
           $qry = '&startdate='.$startdate.'&enddate='.$enddate.'&apptype='.$apptype;
		   $paging2 .= "<a href=app_type.php?Page=$line$qry>$line</a>&nbsp;";
			   }
		  }
       $pages = $paging1.$paging2;
		}   
	} 
	//echo '<br>';
	//print_r($reqdetails);
	//exit;
 
	$db->close();
	$db2->close();
	
    $pgTitle = "Admin Panel -- Corporation";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("startdate",$_REQUEST['startdate']);
	$smarty->assign("enddate",$_REQUEST['enddate']);
	$smarty->assign("apptype",$_REQUEST['apptype']);
	$smarty->assign("errors",$error);	
	$smarty->assign("at",$at);
	$smarty->assign("pages",$pages);
	$smarty->assign("noReq",$noReq);
	$smarty->assign("appdata",$appdata);	
	$smarty->assign_by_ref('reqdetails',$reqdetails);
	$smarty->display('reportstpl/app_type.tpl');
		
?>