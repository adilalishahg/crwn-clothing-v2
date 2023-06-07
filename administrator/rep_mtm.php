<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
	$db = new Database;	
    $yes = '0';
	$noRec = '';
    $error = '';	
	$msgs .= $_GET['msg'];
	$db->connect();
	$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$tmiles='';
	if(isset($_GET['submit']))
	{   $Qaccounts  = "SELECT id FROM " .  accounts ." WHERE TRIM(LOWER(account_name)) LIKE '%".strtolower(trim('MTM'))."%' " ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_all_assoc();	$hospname =  $accounts[]['id'];}
		$stdate = sql_replace($_GET['startdate']);
		$enddate   = sql_replace($_GET['enddate']);
       $hospname   = sql_replace($_GET['hospname']);
		//$hosp 		=  sql_replace($_GET['hosp']);
		$pname    	= sql_replace($_GET['pname']);
		$drv_id     = sql_replace($_GET['driver_id']);
		$status=sql_replace($_GET['status']);
		$whr = '';
		if($stdate!= '' && $enddate!='')
		{
			$stdate = convertDateToMySQL($stdate);
			$enddate = convertDateToMySQL($enddate);
			// Date range started
			$date1=date_create($stdate);
			$date2=date_create($enddate);
				 $diff=date_diff($date1,$date2);
						$rang = $diff->format("%a");
			if($rang>$LIMIT_DAYS){$enddate = date("Y-m-d",strtotime($stdate." +".$ADD_DAYS." day"));  
			$msgs='<span style="color:Red"; >You can`t Run this Report more than '.$LIMIT_DAYS.' days.</span>';}
			// Data Range ended
			
			$whr = "t.trip_date BETWEEN '$stdate 00:00:00' AND '$enddate 23:59:59'";
		}
		if($status!= '')
		{	}
	   if($status == '4'){ $whr .= " AND td.status IN ('1','4') "; }
	   elseif($status == '7'){ $whr .= " AND td.status IN ('7','8') "; }
	   elseif($status == ''){ $whr .= " AND td.status IN ('1','4','6','3','8','7','9','10') ";  }
	   else{ $whr .= " AND td.status='$status'";  }
	
		if($pname!= '')
		{
			$whr .= " AND t.trip_user LIKE '%".trim($pname)."%'"; 
		}
		if($drv_id!= '')
		{
			$whr .= " AND td.drv_id = '$drv_id'";
		}
		if($hospname!= '')
		{$whr .= " AND t.account = '$hospname'";}

   	 //$pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 
     $query = "SELECT td.*,t.trip_clinic, CONCAT(d.fname,' ',d.lname) as name,t.trip_user, d.drv_code,t.account 
			FROM ".TBL_TRIP_DET." td 
			LEFT JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			left join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			WHERE $whr ORDER BY td.aptime ASC  ";// LIMIT ".$pagination->startRow . ",".$pagination->maxRows;		
		if($db->query($query) && $db->get_num_rows() > 0)
		{	$totalRows = $db->get_num_rows();
			$data = $db->fetch_all_assoc(); $yes = '1';
			for($i = 0;$i<sizeof($data);$i++)
		   {	 
		   $statusC=$data[$i]['status'];
		   $tmiles=($tmiles+$tripsCount[$i]['trip_miles']);
		   switch($statusC){
			   case 1: $st4=$st4+1;	 break;
			  // case 2: $st2=$st2+1; $st5=$st5+1;  break;
			   case 3: $st3=$st3+1;	 break;
			   case 4: $st4=$st4+1;	 break;
			   //case 5: $st5=$st5+1;	 break;
			  // case 6: $st5=$st5+1;	 break;
			   case 7: $st7=$st7+1;	 break;
			   case 8: $st7=$st7+1;	 break;
			   // case 9: $st9=$st9+1;	 break;
			   break;
			   } }
			
		}
		//$pages =  $pagination->display_pagination();	
	}
	else
	{
	}
	// R E Q U I S E T S   F O R   R E P O R T I N G //
	$query = "SELECT  drv_code, fname, lname FROM ".TBL_DRIVERS." as a  Where a.drvstatus = 'Active' ORDER BY fname ASC";
	if($db->query($query) && $db->get_num_rows() > 0)
	{		$driver = $db->fetch_all_assoc();		}
	//print_r($data);
	$db->close();
	$stdate = convertDateFromMySQL($stdate);
	$enddate = convertDateFromMySQL($enddate);
	$pgTitle = "Admin Panel -- ";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("driver",$driver);	
	$smarty->assign("yes",$yes);
	$smarty->assign("errors",$error);	
	$smarty->assign("data",$data);	
	$smarty->assign("msgs",$msgs);
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("totalRows",$totalRows);
	$smarty ->assign("apptype",$apptype);
	$smarty->assign('drv_id',$drv_id);
	$smarty->assign('stdate',$stdate);	
	$smarty->assign("enddate",$enddate);		
	$smarty->assign("pname",$pname);		
	$smarty->assign("address",$address);	
	$smarty->assign("hosp",$hosp);
	$smarty->assign("hospname",$hospname);	
	$smarty->assign("pages",$pages);
	$smarty->assign("status",$status);	
	$smarty->assign("totalRows",$totalRows);
	$smarty->assign('tmiles',$tmiles);
	$smarty->assign("st9",$st9);
	$smarty->assign("st8",$st8);
	$smarty->assign("st7",$st7);
	$smarty->assign("st5",$st5);
	$smarty->assign("st4",$st4);
	$smarty->assign("st3",$st3);
	$smarty->assign("st2",$st2);
	$smarty->display('reportstpl/rep_mtm.tpl');
?>