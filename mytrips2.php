<?php
 include_once('includefile.php');
// include_once('Classes/mapquest_google_miles.class.php');	
 //include('administrator/Classes/pagination-class.php');	
 if($_SESSION['allowUser'] == ''){echo '<script>location.href="index.php";</script>';  exit;}
// if(isset($_GET['pageNum'])){ $page_no = $_GET['pageNum'];  }else{  $page_no = '1';  }
/*$cQuery = "SELECT Count(*) FROM ".TBL_ALOG."  $condition";
$totalRows = $db->executeScalar($cQuery);
$pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows);
$mile_C = new mapquest_google_miles;
$qry_vehtype = "SELECT * FROM " . TBL_VEHTYPES;if($db->query($qry_vehtype) && $db->get_num_rows() > 0){$vehiclepref = $db->fetch_all_assoc();} 
$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['id']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}*/
/*$Query = "SELECT r.id,r.region FROM ".cmregions." as cr LEFT JOIN regions as r on cr.region_id=r.id WHERE cr.cm_id='".$_SESSION['userdata']['cm_id']."' ORDER BY r.region ASC "; 
if($db->query($Query) && $db->get_num_rows() > 0){$regions = $db->fetch_all_assoc();  }*/
//print_r($regions); //exit;
if($_REQUEST){
 $whr="";
 $stdate= $_REQUEST['stdate'];
 $enddate=$_REQUEST['enddate'];
 $reqstatus=$_REQUEST['reqstatus'];
 if($stdate==''){$stdate=date("m/d/Y"); }
 if($enddate==''){$enddate=date("m/d/Y");}
 $date1=date_create(convertDateToMySQL($stdate));
			$date2=date_create(convertDateToMySQL($enddate));
				 $diff=date_diff($date1,$date2);
						$rang = $diff->format("%a");
			if($rang>30){$enddate = date("m/d/Y",strtotime($stdate." +30 day"));  
			$msgs='<span style="color:Red"; >You can`t Run this Report more than 30 days.</span>';}
 if($reqstatus!=''){$whr.=" AND reqstatus='".$reqstatus."'";}
 
if($_SESSION['type'] == 'ac'){
	$accountSql = "SELECT account_name FROM ".accounts." WHERE id='".$_SESSION['loginID']."'";
	if($db->query($accountSql) && $db->get_num_rows() > 0){ 
		$rcrAccount = $db->fetch_one_assoc();
		
		
		
	}
	 $v_ids = $_SESSION['userdata']['id'];
	$whr	.=	" AND  ri.account =".$v_ids." ";

	
	}
if($_SESSION['type'] == 'pa'){
//	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	$whr	.=	" AND ri.cmid='".$_SESSION['userdata']['id']."' ";}
	
 $new_time = date("Y-m-d H:i:s", strtotime('+24 hours'));
   $query = "SELECT td.tdid,td.ccode, td.date,td.type, CONCAT(d.fname,' ',d.lname) as nameD,t.trip_user, d.drv_code, td.pck_add, td.drp_add, td.pck_time,td.drv_id,td.escort_id,td.drp_time, td.aptime,td.ac_noshowcancell,td.arrived_time,td.picked_time,
			td.drp_atime, td.trip_miles, td.pickStatus, td.status, vt.vehtype,ri.org_apptime,ri.comments,ac.account_name, ri.wait_time, 
			ri.clientname, ri.dob,td.reqid
			FROM ".TBL_TRIP_DET." td 
			left outer join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id )
			LEFT OUTER JOIN ".vehtype." AS vt ON ( td.veh_id = vt.id )
			LEFT OUTER JOIN ".request_info." AS ri ON ( td.reqid = ri.id ) 
			LEFT JOIN accounts ac on ri.account=ac.id
			WHERE td.date BETWEEN '".convertDateToMySQL($stdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' 
						$whr ORDER BY td.date ASC ";
 if($db->query($query) && $db->get_num_rows() > 0){$tdata = $db->fetch_all_assoc();
 			$header="Trip Date,Patient Name,Account Name,Driver Name,Pick Address,Schedule Time,Actual Pick Time,Drop Address,Drop Time,Actual Drop Time,Trip Miles,Vehicle Type,Status \n";
			
 for ($i = 0;$i<sizeof($tdata);$i++)
		   {  
		   $array = array("~", "\n","\n\r","<br/>","<br>",",","\r");	
	if($tdata[$i]['pck_time']=='23:59:59'){$tdata[$i]['pck_time']='Will Call';}
			$csv_str = date('m/d/Y',strtotime($tdata[$i]['date'])).','.trim($tdata[$i]['trip_user']).','.str_replace($array,'-',$tdata[$i]['account_name']).','.str_replace($array,'-',$tdata[$i]['nameD']).','.str_replace($array,'-',$tdata[$i]['pck_add']).','.$tdata[$i]['pck_time'].','.$tdata[$i]['aptime'].','.str_replace($array,'-',$tdata[$i]['drp_add']).','.$tdata[$i]['drp_time'].','.$tdata[$i]['drp_atime'].','.$tdata[$i]['trip_miles'].','.str_replace($array,'-',$tdata[$i]['vehtype']).','.status($tdata[$i]['status']);  
			$csv_body = $csv_body.$csv_str."~";   }
			
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
		
		   
		   
		   /*$panme=explode(' ',$data[$i]['trip_user'],2); $pfname=$panme[0]; if($panme[1]){$plname=$panme[1];}else{$plname='';}
			   $excel23->getActiveSheet()->setCellValue('A'.($i+3), convertDateFromMySQL($data[$i]['date']))
		   							 ->setCellValue('B'.($i+3), $data[$i]['trip_user'])
									 ->setCellValue('C'.($i+3), $data[$i]['account_name'])
									 ->setCellValue('D'.($i+3), $data[$i]['nameD'])
									 ->setCellValue('E'.($i+3), $data[$i]['pck_add'])   
									 ->setCellValue('F'.($i+3), date("h:i A",strtotime($data[$i]['pck_time'])))
									 ->setCellValue('G'.($i+3), ($data[$i]['aptime']=='00:00:00')?'--:--':date("h:i A",strtotime($data[$i]['aptime'])))
									 ->setCellValue('H'.($i+3), $data[$i]['drp_add'])
									 ->setCellValue('I'.($i+3), date("h:i A",strtotime($data[$i]['drp_time'])))
									 ->setCellValue('J'.($i+3), ($data[$i]['drp_atime']=='00:00:00')?'--:--':date("h:i A",strtotime($data[$i]['drp_atime'])))
									 ->setCellValue('K'.($i+3), $data[$i]['trip_miles'])
									 ->setCellValue('L'.($i+3), status($data[$i]['status']));*/
									// ->setCellValue('N'.($i+4), $data[$i]['systemcode']);
		   						} $dt = date('YmdHis');
		   					//	$objWriter = PHPExcel_IOFactory::createWriter($excel23, 'Excel2007');
								//if(is_file('Dispatch_Report_'.$dt.'.xlsx')) 		unlink('Dispatch_Report_'.$_SESSION['loginID'].'.xlsx');
		   					//	$objWriter->save('xlsx/Dispatch_Report_'.$dt.'.xlsx'); 
		   					//	$filename='xlsx/Dispatch_Report_'.$dt.'.xlsx';
								//$objWriter->save('Dispatch_Report.xlsx'); 
		   						//$filename='Dispatch_Report.xlsx';
								//echo '<pre>'; print_r($Requests); exit;
  								}

	}
	$db->close();
	  function status($status2){
	  switch($status2){
			   case 1: $status='Completed';	 break;
			   case 2: $status='In Progress';	 break;
			   case 3: $status='Cancelled';	 break;
			   case 4: $status='Completed';	 break;
			   case 5: $status='In Progress';	 break;
			   case 6: $status='Picked';	 break;
			   case 7: $status='Billable No-Show';	 break;
			   case 8: $status='non-Billable No-Show';	 break;
			   case 9: $status='Pending';	 break;
			   case 10: $status='Arrived';	 break;
			   case 15: $status='Denied';	 break;
			   break;
			   }  return $status;	
	  }
	//print_r($Requests);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("stdate",$stdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("reqstatus",$reqstatus);
	$smarty->assign("post",$_REQUEST);
	$smarty->assign("foot",$foot);
	$smarty->assign("messages",$msgs);
	$smarty->assign("filename",$filename);
	$smarty->assign("Requests",$Requests);
	$smarty->assign("pg",'mytrips');			
    $smarty->display('mytrips2.tpl');	
?>