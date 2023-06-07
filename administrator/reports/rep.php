<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
    $error = '';
	$error = '';
	$html='';
	$html9='';
	$html8='';
	$html7='';	
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
	$db->connect();
	$db2->connect();
	$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$tmiles='';
	if(isset($_GET['submit']))
	{ 
	if(isset($_GET['pageNum']))
		{
			$page_no = $_GET['pageNum'];
		}
		else
		{
			$page_no = '1';	 
		}
		$limit = 40;
		$offset = (($page * $limit) - $limit);
		$maxRecord = 40; 
		$stdate = sql_replace($_GET['startdate']);
		$enddate   = sql_replace($_GET['enddate']);
        $hospname   = sql_replace($_GET['hospname']);
		$hosp =  sql_replace($_GET['hosp']);
		$pname    = sql_replace($_GET['pname']);
		$drv_id     = sql_replace($_GET['driver_id']);
		$status=sql_replace($_GET['status']);
		 $code     = sql_replace($_REQUEST['code']);
		$apptype=$_GET['apptype'];
		if($hospname == 'other')
		{
			$hospsearch = $hosp;
		}else{
		$hospsearch = $hospname;
		}
		$whr = '';
		if($stdate!= '' && $enddate!='')
		{
			$stdate = convertDateToMySQL($stdate);
			$enddate = convertDateToMySQL($enddate);
			$whr = "t.trip_date BETWEEN '$stdate 00:00:00' AND '$enddate 23:59:59'";
		}
		if($status!= '')
		{
	   if($status == '4'){ $whr .= "AND td.status IN ('1','4') "; }
		   elseif($status == ''){ $whr .= "AND td.status IN ('1','4','3','8','7','9') ";  }
		   else{ $whr .= "AND td.status='$status'";  }
		}
		if($hospname != '' && $hospname != '0'){
              $whr .= "  AND t.account = '".$hospname."'";   		  
		  }		
		if($pname!= '')
		{
			$whr .= "AND t.trip_user LIKE '%".trim($pname)."%'"; 
		}
		if($code != ''){
            $whr .= "  AND td.ccode='".$code."'";   		  
		  }	
		if($drv_id!= '')
		{
			$whr .= "AND td.drv_id = '$drv_id' || $whr AND td.escort_id = '$drv_id' ";
		}
	$qcount  = "SELECT  td.trip_miles, td.status 
			FROM ".TBL_TRIP_DET." td 
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			WHERE $whr
			group by td.tdid ORDER BY t.trip_user ASC";  
		if($db->query($qcount) && $db->get_num_rows() > 0)
		{
			$totalRows = $db->get_num_rows();
			 $tripsCount = $db->fetch_all_assoc();
		   for ($i = 0;$i<sizeof($tripsCount);$i++)
		   {	 
		   $statusC=$tripsCount[$i]['status'];
		   $tmiles=($tmiles+$tripsCount[$i]['trip_miles']);
		   switch($statusC){
			   case 1: $st4=$st4+1;	 break;
			   case 2: $st2=$st2+1; $st5=$st5+1;  break;
			   case 3: $st3=$st3+1;	 break;
			   case 4: $st4=$st4+1;	 break;
			   case 5: $st5=$st5+1;	 break;
			   case 6: $st5=$st5+1;	 break;
			   case 7: $st7=$st7+1;	 break;
			   case 8: $st8=$st8+1;	 break;
			   case 9: $st9=$st9+1;	 break;
			   break;
			   } }
		}
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=40,$totalRows); 
     $query = "SELECT td.tdid, td.date, t.trip_clinic, CONCAT(d.fname,' ',d.lname) as name,t.trip_user, d.drv_code, td.pck_add, td.drp_add, td.pck_time,td.drv_id,td.escort_id,td.drp_time, td.aptime,td.ac_noshowcancell,
			td.drp_atime, td.trip_miles, td.pickStatus, td.status,at.clockin,at.clockout,at.total_time,td.modiv_id    
			FROM ".TBL_TRIP_DET." td 
			left outer join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			
			left outer join attendance AS at on (d.Drvid = at.driver_id)
			
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			WHERE $whr  group by td.tdid ORDER BY td.date DESC LIMIT ".$pagination->startRow . ",".$pagination->maxRows;		
		if($db->query($query) && $db->get_num_rows() > 0)
		{
			$data = $db->fetch_all_assoc();
		}
		$pages =  $pagination->display_pagination();	
	}elseif(isset($_GET['submit2']))
	{ 
		$stdate = sql_replace($_GET['startdate']);
		$enddate   = sql_replace($_GET['enddate']);
        $hospname   = sql_replace($_GET['hospname']);
		$hosp =  sql_replace($_GET['hosp']);
		$pname    = sql_replace($_GET['pname']);
		$drv_id     = sql_replace($_GET['driver_id']);
		$status=sql_replace($_GET['status']);
		$apptype=$_GET['apptype'];
		 $code     = sql_replace($_REQUEST['code']);
		if($hospname == 'other')
		{
			$hospsearch = $hosp;
		}else{
		$hospsearch = $hospname;
		}
		$whr = '';
		if($stdate!= '' && $enddate!='')
		{
			$stdate = convertDateToMySQL($stdate);
			$enddate = convertDateToMySQL($enddate);
			$whr = "t.trip_date BETWEEN '$stdate 00:00:00' AND '$enddate 23:59:59'";
		}
		if($status!= '')
		{
	   if($status == '4'){ $whr .= "AND td.status IN ('1','4') "; }
		   elseif($status == ''){ $whr .= "AND td.status IN ('1','4','3','8','7','9') ";  }
		   else{ $whr .= "AND td.status='$status'";  }
		}
		if($hospname != '' && $hospname != '0'){
              $whr .= "  AND t.account = '".$hospname."'";   		  
		  }		
		if($pname!= '')
		{
			$whr .= "AND t.trip_user LIKE '%".trim($pname)."%'"; 
		}
		if($code != ''){
            $whr .= "  AND td.ccode='".$code."'";   		  
		  }	
		if($drv_id!= '')
		{
			$whr .= "AND td.drv_id = '$drv_id' || $whr AND td.escort_id = '$drv_id' ";
		}
	/*$qcount  = "SELECT  td.trip_miles, td.status 
			FROM ".TBL_TRIP_DET." td 
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			WHERE $whr
			group by td.tdid ORDER BY t.trip_user ASC";  
		if($db->query($qcount) && $db->get_num_rows() > 0)
		{
			$totalRows = $db->get_num_rows();
			 $tripsCount = $db->fetch_all_assoc();
		   for ($i = 0;$i<sizeof($tripsCount);$i++)
		   {	 
		   $statusC=$tripsCount[$i]['status'];
		   $tmiles=($tmiles+$tripsCount[$i]['trip_miles']);
		   switch($statusC){
			   case 1: $st4=$st4+1;	 break;
			   case 2: $st2=$st2+1; $st5=$st5+1;  break;
			   case 3: $st3=$st3+1;	 break;
			   case 4: $st4=$st4+1;	 break;
			   case 5: $st5=$st5+1;	 break;
			   case 6: $st5=$st5+1;	 break;
			   case 7: $st7=$st7+1;	 break;
			   case 8: $st8=$st8+1;	 break;
			   case 9: $st9=$st9+1;	 break;
			   break;
			   } }
		}*/
   	// $pagination = new pagination($_GET['pageNum'],$maxRows=40,$totalRows); 
    $query = "SELECT td.tdid, td.date,td.type, t.trip_clinic, CONCAT(d.fname,' ',d.lname) as name,d.Drvid,t.trip_user, d.drv_code, td.pck_add, td.drp_add, td.pck_time,td.drv_id,td.escort_id,td.drp_time, td.aptime,td.ac_noshowcancell,
			td.drp_atime, td.trip_miles, td.pickStatus, td.status,td.pickup_instruction, td.destination_instruction,vt.vehtype,td.modiv_id   
			FROM ".TBL_TRIP_DET." td 
			left outer join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id )
			LEFT OUTER JOIN ".TBL_VEHTYPES." AS vt ON ( vt.id = td.veh_id) 
			WHERE $whr  group by td.tdid ORDER BY td.date DESC ";		
		if($db->query($query) && $db->get_num_rows() > 0)
		{
			$tdata = $db->fetch_all_assoc();
			//print_r($tdata); exit;  left join attendance AS at on (at.driver_id = d.Drvid)
		//CSV writing  , at.clockin,at.clockout,at.total_time  
		$header="Trip ID,Patient Name,Date,Leg,Driver,Vehicle Preference,Pick Up Address,Drop Address,Pick Time,Actual Pick Time,Total Miles,Status,Pick Instruction,Drop Instruction,Clock in,Clock Out,Total Hours \n";
	for($i=0; $i<sizeof($tdata); $i++){
	
	$leg='';
	switch($tdata[$i]['type']){
		case 'AB' : 	$leg = 'A'; 	break;
		case 'BF' : 	case 'BC' : 	$leg = 'B'; 	break;
		case 'CF' :		case 'CD' :		$leg = 'C';		break;
		case 'DF' :		case 'DE' :		$leg = 'D';		break;
		case 'EF' :		$leg = 'E';		break;											
		}
	  switch($tdata[$i]['status']){
			   case 1: $status='Completed';	 break;
			   //case 2: $status='Completed';	 break;
			   case 3: $status='Cancelled';	 break;
			   case 4: $status='Completed';	 break;
			   case 5: $status='In Progress';	 break;
			   case 6: $status='Picked';	 break;
			   case 7: $status='No Show';	 break;
			   case 8: $status='No Show';	 break;
			   case 9: $status='Pending';	 break;
			   break;// 0-addon,1-Delayed (Completed with Delay),2-Rescheduled,3-Cancelled,4-Dropped (Successfully Completed),5-In progress, 6-Picked,7-Not at Home, 8-Not Going, 9-Pending Trips,10-Arrived
			
			   } 	
	      $QSl="SELECT clockin,clockout,total_time  FROM attendance WHERE driver_id='".$tdata[$i]['Drvid']."' AND dated='".$tdata[$i]['date']."'"; 
			 if($db->query($QSl) && $db->get_num_rows() > 0)	{$attdata = $db->fetch_one_assoc();
			 if($attdata['clockin']!='0000-00-00 00:00:00'){$ci=date('h:i:s',strtotime($attdata['clockin']));}else{$ci='--:--';}
			 if($attdata['clockout']!='0000-00-00 00:00:00'){$co=date('h:i:s',strtotime($attdata['clockout']));}else{$co='--:--';}
			 }else{$attdata=''; $ci='--:--'; $co='--:--'; }
			 
			   //print_r($attdata);
	$array = array("~", "\n","\n\r","<br/>","<br>",",","\r");	
	if($tdata[$i]['pck_time']=='23:59:59'){$tdata[$i]['pck_time']='Will Call';}
			$csv_str = trim($tdata[$i]['ccode']).' '.trim($tdata[$i]['modiv_id']).','.trim($tdata[$i]['trip_user']).','.date('m/d/Y',strtotime($tdata[$i]['date'])).','.$leg.','.str_replace($array,'-',$tdata[$i]['name']).','.str_replace($array,'-',$tdata[$i]['vehtype']).','.str_replace($array,'-',$tdata[$i]['pck_add']).','.str_replace($array,'-',$tdata[$i]['drp_add']).','.date('h:i:s',strtotime($tdata[$i]['pck_time'])).','.date('h:i:s',strtotime($tdata[$i]['aptime'])).','.$tdata[$i]['trip_miles'].','.$status.','.str_replace($array,'-',$tdata[$i]['pickup_instruction']).','.str_replace($array,'-',$tdata[$i]['destination_instruction']).','.$ci.','.$co.','.fulltime($attdata['total_time']);  
			$csv_body = $csv_body.$csv_str."~";
		} 
		//$firstline = ",,,Invoice Generated On: ".date('M. d Y')."\n,,,Invoice From: ".date('M. d Y',strtotime($startdate))." To: ".date('M. d Y',strtotime($enddate))."\n,,,Total Amount Billed: ".sprintf('%0.2f',$net_balance)."~";
			$firstline ='';
			 $body=substr($firstline.$csv_body,0,-1); 
			if($body)
			{
			$files = glob('csv/*'); // get all files path
			foreach($files as $file){ // iterate files
				if(is_file($file))
				unlink($file); // delete file
			}
			$filename = "Dispatch_Report_".time().".csv";
			$body_arr=explode("~",$body);
			ob_end_clean();
			$fp=@fopen('csv/'.$filename,"w");
			$write=fputs($fp,$header,strlen($header));
			foreach($body_arr as $c)
			{
				$c.="\n";
				$write=fputs($fp,$c,strlen($c));
			}
			fclose($fp);
			$file_path = $filename; 
			$mm_type="application/octet-stream";
			$fullpath= 'csv/'.$filename;
			header("Cache-Control: public, must-revalidate");
			header("Pragma: hack");
			header("Content-Type: " . $mm_type);
			header("Content-Length: " .(string)(filesize($fullpath)) );
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary\n");
			readfile($fullpath);
		}		
		}
		//$pages =  $pagination->display_pagination();	
	}
	
	// R E Q U I S E T S   F O R   R E P O R T I N G //
	$query = "SELECT  drv_code, fname, lname FROM ".TBL_DRIVERS." as a  Where a.drvstatus = 'Active' ORDER BY fname ASC";
	if($db->query($query) && $db->get_num_rows() > 0)
	{
		$driver = $db->fetch_all_assoc();
	}
 
	 $Queryhosp1 = "SELECT id,account_name FROM ".accounts." WHERE 1=1  ORDER BY `account_name` ASC";
   if($db2->query($Queryhosp1) && $db2->get_num_rows() > 0)
	{	   $hosp = $db2->fetch_all_assoc();    }					
	$Qccode = "SELECT * FROM ".companycodes." WHERE 1=1  ORDER BY `company` ASC";
   if($db->query($Qccode) && $db->get_num_rows() > 0)
	{	   $ccode = $db->fetch_all_assoc();    }	
	$db->close();
	$stdate = convertDateFromMySQL($stdate);
	$enddate = convertDateFromMySQL($enddate);
	$pgTitle = "Admin Panel -- ";
	$smarty->assign("hosp",$hosp);
	$smarty->assign("hospname",$hospname);
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("driver",$driver);	
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign("data",$data);	
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("totalRows",$totalRows);
	$smarty ->assign("apptype",$apptype);
	$smarty->assign('drv_id',$drv_id);
	$smarty->assign('stdate',$stdate);	
	$smarty->assign("enddate",$enddate);		
	$smarty->assign("pname",$pname);		
	$smarty->assign("address",$address);	
	$smarty->assign("hosp",$hosp);	
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
	$smarty->assign("ccode",$ccode);
	$smarty->assign("code",$code);	
	$smarty->display('reportstpl/rep_vmt3.tpl');
?>