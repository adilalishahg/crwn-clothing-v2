<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
	$db = new Database;	
	$db->connect();
	$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$tmiles=0;
	{ 
		$stdate = sql_replace($_GET['startdate']);
		$enddate   = sql_replace($_GET['enddate']);
        $hospname   = sql_replace($_GET['hospname']);
		$hosp 		=  sql_replace($_GET['hosp']);
		$pname    	= sql_replace($_GET['pname']);
		$drv_id     = sql_replace($_GET['driver_id']);
		$status=sql_replace($_GET['status']);
		$whr = '';
		if($stdate!= '' && $enddate!='')
		{
			$stdate = convertDateToMySQL($stdate);
			$enddate = convertDateToMySQL($enddate);
			$whr = "t.trip_date BETWEEN '$stdate 00:00:00' AND '$enddate 23:59:59'";
		}
		if($status!= '')
		{	}
	   if($status == '4'){ $whr .= "AND td.status IN ('1','4') "; }
	   elseif($status == '7'){ $whr .= "AND td.status IN ('7','8') "; }
	   elseif($status == ''){ $whr .= "AND td.status IN ('1','4','6','3','8','7','9','10') ";   }
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
   	 // $pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows); 
    $query = "SELECT td.*,t.trip_clinic, CONCAT(d.fname,' ',d.lname) as name,d.license,t.trip_user, d.drv_code,d.Drvid,vt.vcode,d.signature as drsignature
			FROM ".TBL_TRIP_DET." td 
			left outer join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			LEFT OUTER JOIN ".vehtype." AS vt ON ( td.veh_id = vt.id ) 
			WHERE $whr ORDER BY td.aptime ASC  ";// LIMIT ".$pagination->startRow . ",".$pagination->maxRows;			
		if($db->query($query) && $db->get_num_rows() > 0)
		{
			$data = $db->fetch_all_assoc();
			$Qv="SELECT v.vin FROM vehicles as v, dv_mapping as dm WHERE dm.veh_id=v.id AND dm.drv_id = '".$data[0]['Drvid']."'";
			if($db->query($Qv) && $db->get_num_rows() > 0){$dataV = $db->fetch_one_assoc();}
		}
		for ($i = 0;$i<sizeof($data);$i++)
		   {	 
		   $statusC=$data[$i]['status'];
		   $tmiles=($tmiles+$data[$i]['trip_miles']);
		   //$data[$i]['trip_amount']=cal_amount($data[$i]['trip_miles'],$data[$i]['veh_id'],$db);
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
		//$pages =  $pagination->display_pagination();	
	}
	$con = "SELECT * FROM ".TBL_CONTACT;    if($db->query($con) && $db->get_num_rows() > 0){	 $contact = $db->fetch_one_assoc(); }
	//print_r($dataV);
	$db->close();
	$smarty->assign("data",$data);
	$smarty->assign("dataV",$dataV);
	$smarty->assign('stdate',$stdate);	
	$smarty->assign("enddate",$enddate);
	$smarty->assign('tmiles',$tmiles);
	$smarty->assign("st4",$st4);	
	$smarty->assign("contact",$contact);		
	$smarty->display('reportstpl/rep_print.tpl');
?>