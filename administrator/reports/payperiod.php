<?php
include_once('../DBAccess/Database.inc.php');
//include_once('addattendance.php');
$db = new Database;	
$db->connect();
$whr=' WHERE 1 ';
$whrd=' ';
//$datainfo = array();
$count=0;
if($_POST){
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];
	
	$strseconds = strtotime(convertDateToMySQL($startdate));
	$endseconds = strtotime(convertDateToMySQL($enddate));
	$datediff = $endseconds - $strseconds;
      $periods = floor((($datediff+(60*60*24))/(60*60*24))/7);
	
	$drv_id=$_POST['drv_id'];
	}
//if($startdate==''){$startdate = date("m/d/Y",strtotime("-1 day"));}
//if($enddate==''){$enddate = date("m/d/Y",strtotime("-1 day"));}
if($startdate!='' && $enddate!=''){//$whr .= "AND at.dated BETWEEN '".convertDateToMySQL($startdate)."' AND '".convertDateToMySQL($enddate)."'";
if($drv_id!=''){ $whrd .= "AND Drvid = '".$drv_id."'";}
$queryD = "SELECT  * FROM ".TBL_DRIVERS." WHERE del = '0'  AND drvstatus='Active'  $whrd   ORDER BY fname ASC";
if($db->query($queryD) && $db->get_num_rows() > 0)
	{	$drivers = $db->fetch_all_assoc();	} 

for($i=0;$i<sizeof($drivers);$i++){
	for($j=0;$j<$periods;$j++){  $st = $j*7; $end = $st+6;
		$std = gmdate("Y-m-d", $strseconds+($st*60*60*24));
		$endd = gmdate("Y-m-d", $strseconds+($end*60*60*24));
		$Qs="SELECT SUM(at.total_time) as totaltime,SUM(at.over_time) as totalovertime,dr.fname,dr.lname,dr.Drvid,dr.drv_code,dr.hrate,dr.per_run,dr.per_mile FROM attendance as at 
							LEFT JOIN drivers as dr on at.driver_id=dr.Drvid WHERE
							at.dated BETWEEN '".$std."' AND '".$endd."'
							AND at.dayonoff='on' AND approval = 'approved' AND at.driver_id='".$drivers[$i]['Drvid']."' GROUP BY at.driver_id";
		if($db->query($Qs) && $db->get_num_rows() > 0){$data = $db->fetch_all_assoc(); 
		$datainfo[$count]=$data[0];
			 $lalagee1=$lalagee2='';
			 if($data[0]['totaltime']>40*3600){
				$data[0]['totalovertime'] = $data[0]['totaltime']-(40*3600);
				$data[0]['totaltime'] = (40*3600);}
			else{$data[0]['totalovertime']='';}
			 $df1=secondsToTime($data[0]['totaltime']);
			 $lalagee1.=$df1['hours']!=0?$df1['hours'].'Hr ':'';
			 $lalagee1.=$df1['minutes']!=0?' '.$df1['minutes'].'Min ':'';
			 $datainfo[$count]['totaltime'] 	= $lalagee1;
			 $df2=secondsToTime($data[0]['totalovertime']);
			 $lalagee2.=$df2['hours']!=0?$df2['hours'].'Hr ':'';
			 $lalagee2.=$df2['minutes']!=0?' '.$df2['minutes'].'Min ':'';
			 $datainfo[$count]['totalovertime'] 	= $lalagee2;
			 $datainfo[$count]['totalhourpayment'] 	= round(($data[0]['hrate']*($df1['hours']+($df1['minutes']/60))),2);
			 $datainfo[$count]['totalovertimepayment']=round($data[0]['hrate']*(($df2['hours']+($df2['minutes']/60))*1.5),2);
		$runs=$miles=0;	 
		$dates='';
		$QSl="SELECT * FROM attendance as at WHERE at.dated BETWEEN '".$std."' AND '".$endd."'
					AND at.dayonoff='on' AND approval = 'approved' AND at.driver_id='".$drivers[$i]['Drvid']."'";
		if($db->query($QSl) && $db->get_num_rows() > 0)
		{ $datesd = $db->fetch_all_assoc();
		for($t=0;$t<sizeof($datesd);$t++){ $dates .= "'".$datesd[$t]['dated']."'".','.""; }
		 if($dates) {$dates = substr($dates, 0, -1);} }
		$Qtrips2="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details WHERE drv_id = '".$drivers[$i]['drv_code']."' AND date BETWEEN '".$std."' AND '".$endd."' AND status IN('1','4','6','7') AND date IN($dates)";
		$Qtrips22="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details WHERE escort_id = '".$drivers[$i]['drv_code']."' AND date BETWEEN '".$std."' AND '".$endd."' AND status IN('1','4','6','7') AND date IN($dates)";		
		
		if($db->query($Qtrips2) && $db->get_num_rows() > 0)
		{ $tripsdata2 = $db->fetch_one_assoc(); $runs = $tripsdata2['trun']; $miles= $tripsdata2['tmiles'];}
		if($db->query($Qtrips22) && $db->get_num_rows() > 0)
		{ $tripsdata22 = $db->fetch_one_assoc(); $runsEs = $tripsdata22['trun']; $milesEs= $tripsdata22['tmiles'];}	 
		$runs=$runs+$runsEs;
		$miles=$miles+$milesEs;
		$datainfo[$count]['runs'] 	= $runs;
		$datainfo[$count]['miles'] 	= $miles;
		$datainfo[$count]['pstart']=$std;
		$datainfo[$count]['pend']=$endd;
		$datainfo[$count]['payableamount']=round($datainfo[$count]['totalhourpayment']+($datainfo[$count]['totalovertimepayment'])+($data[0]['per_run']*$runs)+($data[0]['per_mile']*$miles),2);
		$count++;
		}
		}
	}
	 }
$querydr = "SELECT  * FROM ".TBL_DRIVERS." WHERE del = '0' AND drvstatus='Active'  ORDER BY fname ASC";
if($db->query($querydr) && $db->get_num_rows() > 0)
	{	$datadr = $db->fetch_all_assoc();	}
$db->close();
	$smarty->assign("startdate",$startdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("datainfo",$datainfo);
	$smarty->assign("datadr",$datadr);
	$smarty->assign("drv_id",$drv_id);			
	$smarty->display('reportstpl/payperiod.tpl');
?>