<?php
	include('../include_file.php');
	$user_name = $_SESSION['adminuser'];
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
    include('../Classes/excelwriter.inc.php');	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
    $error = '';	
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
	$db->connect();
	$db2->connect();
	$numRows = '0';
	//  S E A R C H   C O D E   F O R   R E P O R T I N  G //
	if(isset($_GET['submit']))
				{ 
			// PA G I N G   C O D E  //
					if(isset($_GET['pageNum']))
					{
						$page_no = $_GET['pageNum'];
					}
					else
					{
						$page_no = '1';	 
					}
				$limit = 10;
					$offset = (($page * $limit) - $limit);
					$maxRecord = 10; 
			// E N D   P A  G I N  G   C O D E //
					$stdate = sql_replace($_GET['startdate']);
					$dt = explode("/",$stdate);
					if(count($dt) > 1)
						$stdate = $dt[2].'-'.$dt[0].'-'.$dt[1];
					if($stdate!= '')
					{
						$stdate = $stdate;
						$whr = "f.appdate  BETWEEN '$stdate 00:00:00' AND '$stdate 23:59:59' AND";
					}
			// Fetch all categories list
	$getUsers = "SELECT DISTINCT(".TBL_HOSPITALS.".id) FROM ".TBL_HOSPITALS.",".TBL_REQUESTS." 
             WHERE userid = ".TBL_HOSPITALS.".id AND `Status` = 'approved'";
   if($db->query($getUsers) && $db->get_num_rows() > 0)
	{
      $users = $db->fetch_all_assoc();
     }
$usersid = array();
for($i=0; $i<count($users); $i++){
	$gid =  $users[$i]['id'];
	array_push($usersid,"'".$gid."'"); 
}
$glueids = implode(',',$usersid);
/* $QueryCount = "SELECT COUNT(*) AS rows FROM 
	              ".TBL_HOSPITALS.", ".TBL_FORMS.", ".TBL_REQUESTS." 
				  WHERE reqstatus != 'inactive'  AND reqid=req_id AND userid=".TBL_HOSPITALS.".id AND userid IN (".$glueids.")"; */
if($glueids != ''){
$query = "SELECT r.hospname as name,f.clientname,f.phnum,f.pickaddr,f.destination,f.apptime,f.milage,f.unloadedmilage,Concat(dr.fname,' ',dr.lname) as dr_name,f.comments,f.returnpickup,Concat(dr.fname,' ',dr.lname) as dr_name2,f.triptype   FROM  ".TBL_FORMS." f
LEFT JOIN ".TBL_REQUESTS." as r ON f.req_id = r.reqid
LEFT JOIN drivers as dr ON f.drv_code = dr.drv_code WHERE $whr f.reqstatus = 'approved'  AND r.reqid=f.req_id AND userid IN (".$glueids.") order by apptime";
	/*$query = "SELECT r.hospname as name,f.clientname,f.phnum,f.pickaddr,f.destination,f.apptime,f.milage,f.unloadedmilage,Concat(dr.fname,' ',dr.lname) as dr_name,f.comments,f.returnpickup,Concat(dr.fname,' ',dr.lname) as dr_name2,f.triptype   FROM ".TBL_HOSPITALS." h, ".TBL_FORMS." f, ".TBL_REQUESTS." r, drivers as dr WHERE $whr f.reqstatus = 'approved'  AND r.reqid=f.req_id AND r.userid=h.id AND userid IN (".$glueids.") order by apptime";*/
   /*  if($db2->query($QueryCount) && $db2->get_num_rows() > 0)
	  {
      $data = $db2->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }*/
   }
			/*   $query = "SELECT t.trip_user as Consumer, t.trip_id  as USER, t.trip_date  as `DATE`, trip_clinic  as 'P', td.pck_add   as `Pickup address`,td.drp_add  as `Drop Address` ,td.trip_remarks   as `Remarks`
						FROM ".TBL_DRIVERS." d 
						left outer join ".TBL_TRIP_DET." AS td on (d.drv_code = td.drv_id)
						LEFT OUTER JOIN ".TBL_RATING." AS r ON ( td.tdid = r.trp_id ) 
						LEFT OUTER JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
						WHERE $whr 
						group by td.tdid ";		*/
					if($db->query($query) && $db->get_num_rows() > 0)
					{
						$data = $db->fetch_all_assoc();
					}
					 $numRows = $db->get_num_rows();
				   if($db->get_num_rows() > 0 ){	
					$filename = '../trip-sheets/'.time().'_data_Sheet.xls';
					//$SheetName = date($stdate,'l d F Y ');
					$SheetName = $dt[0].'-'.$dt[1].'-'.$dt[2];
					 
					$excel = new ExcelWriter($filename,$SheetName);
						$st = downloadXL($query, $filename,$db,$excel,convertDateFromMySQL($stdate));
						if($st){
			/*				header("Pragma: no-cache"); 
							header("Expires: 0"); 		
							header("Content-Type: application/force-download");
							header("Content-Type: application/download");
							header('Content-type: application/ms-excel');
							header("Content-Disposition: attachment; filename=$filename"); 
							exit;*/
							$url = '<strong>Data Exported Sheet</strong><br>';	
						}else{
							$url = '';				
					}
				}
				//debug($data);
				}
			function downloadXL($sql, $filename,$db,$excel,$stdate){
				if($excel==false)	
					echo $excel->error;
				
				$myArr=array("","","","","","","Z MEDICAL BESTTRANS -- $stdate  SCHEDULE","","","","","","","","","");
				$excel->writeLineH1($myArr);	
				$myArr=array("Trip ID","Clinic","Consumer","Phone","Pickup Address","Drop Address","Pickup Time","Loaded Miles","Unloaded Miles","Driver Leg A","Pickup Remarks","Return Pickup Time","Driver Leg B","Tag");
				$excel->writeLineH1($myArr);
			/*		if($db->query($sql) && $db->get_num_rows() > 0){
						$rep = $db->fetch_all_assoc();	
					}*/
			   $db->query($sql);	
				$count = 1;
				while($row = $db->fetch_row_assoc()) { 
				$excel->writeRow();
				  $excel->writeCol($count);
					foreach($row as $value) {                                             
						if ((!isset($value)) OR ($value == "")) { 
						  $excel->writeCol("");
						} else { 
						  $excel->writeCol($value);
						} 
					} 
					$count++;
				} 
				$excel->close();
				return true;	
			/*	
				header("Pragma: no-cache"); 
				header("Expires: 0"); 		
				header("Content-Type: application/force-download");
				header("Content-Type: application/download");
				header('Content-type: application/ms-excel');
				header("Content-Disposition: attachment; filename=".time().'_'."$filename.xls"); 
					$myFile = "sample.xls";
			$fh = fopen($myFile, 'a') or die("can't open file");
				$stringData = $data;
					fwrite($fh, $stringData);
					fclose($fh);*/
				//print "$header\n\n$data";
			exit;
			}
	//exit;
	$db->close();
	$db2->close();
	$stdate = convertDateFromMySQL($stdate);
	$enddate = convertDateFromMySQL($enddate);
	$pgTitle = "Admin Panel -- Hospital/Clinic";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("numRows",$numRows);		
	$smarty->assign('stdate',$stdate);		
	$smarty->assign('url',$url);
	$smarty->assign('filename',$filename);			
	$smarty->display('reportstpl/exp_data.tpl');

?>