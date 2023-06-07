<?php
   	include_once('../DBAccess/Database.inc.php');
		$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
   $Drvid=$_REQUEST['Drvid'];
   $pstart=$_REQUEST['pstart'];
   $pend=$_REQUEST['pend'];
   $drv_code=$_REQUEST['drv_code'];
 $Qd="SELECT * FROM drivers  WHERE Drvid = '".$Drvid."'";
		if($db->query($Qd) && $db->get_num_rows() > 0){$driverinfo = $db->fetch_one_assoc(); }
 $Qs="SELECT SUM(at.total_time) as totaltime,SUM(at.over_time) as totalovertime,dr.fname,dr.lname,dr.Drvid,dr.drv_code,dr.hrate,dr.per_run,dr.per_mile FROM attendance as at 
							LEFT JOIN drivers as dr on at.driver_id=dr.Drvid WHERE
							at.dated BETWEEN '".$pstart."' AND '".$pend."'
							AND at.dayonoff='on' AND approval = 'approved' AND at.driver_id='".$Drvid."' GROUP BY at.driver_id";
		if($db->query($Qs) && $db->get_num_rows() > 0){$totaldata = $db->fetch_all_assoc(); 
		$lalagee1=$lalagee2='';
			if($totaldata[0]['totaltime']>40*3600){
				$totaldata[0]['totalovertime'] = $totaldata[0]['totaltime']-(40*3600);
				$totaldata[0]['totaltime'] = (40*3600);}
			else{$totaldata[0]['totalovertime']='';}
			 $df1=secondsToTime(($totaldata[0]['totaltime']));
			 $lalagee1.=$df1['hours']!=0?$df1['hours'].'Hr ':'';
			 $lalagee1.=$df1['minutes']!=0?' '.$df1['minutes'].'Min ':'';
			 $totaldata[0]['totaltime'] 	= $lalagee1;
			 $df2=secondsToTime($totaldata[0]['totalovertime']);
			 $lalagee2.=$df2['hours']!=0?$df2['hours'].'Hr ':'';
			 $lalagee2.=$df2['minutes']!=0?' '.$df2['minutes'].'Min ':'';
			 $totaldata[0]['totalovertime'] 	= $lalagee2;
			 $totaldata[0]['totalhourpayment'] 	= round(($totaldata[0]['hrate']*($df1['hours']+($df1['minutes']/60))),2);
			 //echo ($df1['hours']+$df2['hours']);
			 $totaldata[0]['totalovertimepayment']=round($totaldata[0]['hrate']*(($df2['hours']+($df2['minutes']/60))*1.5),2);
			}

$Qs2="SELECT at.dated,at.total_time,at.over_time,dr.fname,dr.lname,dr.Drvid,dr.drv_code,dr.hrate,dr.per_run,dr.per_mile, (SELECT COUNT(*) as trun FROM trip_details WHERE trip_details.drv_id = dr.drv_code AND trip_details.date=at.dated AND status IN('1','4','6','7')) as runs, (SELECT SUM(trip_miles) as tmiles FROM trip_details WHERE trip_details.drv_id = dr.drv_code AND trip_details.date=at.dated AND status IN('1','4','6','7')) as tmiles FROM attendance as at 
							LEFT JOIN drivers as dr on at.driver_id=dr.Drvid WHERE
							at.dated BETWEEN '".$pstart."' AND '".$pend."'
							AND at.dayonoff='on' AND approval = 'approved' AND at.driver_id='".$Drvid."' ORDER BY at.dated";
		if($db->query($Qs2) && $db->get_num_rows() > 0){$data = $db->fetch_all_assoc(); 
		$totaltime = 0;
		for($k=0;$k<sizeof($data);$k++){
			 $lalagee1=$lalagee2='';
			 $df1=secondsToTime(($data[$k]['total_time']));
			 $lalagee1.=$df1['hours']!=0?$df1['hours'].'Hr ':'';
			 $lalagee1.=$df1['minutes']!=0?' '.$df1['minutes'].'Min ':'';
			 $totaltime = $totaltime +$df1['hours'];
			 $data[$k]['total_time'] 	= $lalagee1;
			 $df2=secondsToTime($data[$k]['over_time']);
			 $lalagee2.=$df2['hours']!=0?$df2['hours'].'Hr ':'';
			 $lalagee2.=$df2['minutes']!=0?' '.$df2['minutes'].'Min ':'';
			 $data[$k]['over_time'] 	= $lalagee2;
			 $data[$k]['hourpayment'] 		= ($df1['hours']+($df1['minutes']/60))*$data[$k]['hrate'];
			 $data[$k]['milesinsentive'] 	= $data[$k]['tmiles']*$data[$k]['per_mile'];
			 $data[$k]['runinsentive'] 		= $data[$k]['trun']*$data[$k]['per_run'];
			 $data[$k]['tmiles'] 			= round($data[$k]['tmiles'],2);
			 $data[$k]['dayamount']=round(($data[$k]['hrate']*($df1['hours']+($df1['minutes']/60)))+($data[$k]['per_run']*$data[$k]['trun'])+($data[$k]['per_mile']*$data[$k]['tmiles']),2);	
			 $dates .= "'".$data[$k]['dated']."'".','.""; 
					}
				}
	if($totaldata){ if($dates) {$dates = substr($dates, 0, -1);}
		$runs=$miles=0;	
		$Qtrips2="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details as td  WHERE td.drv_id = '".$drv_code."' AND td.date BETWEEN '".$pstart."' AND '".$pend."' AND td.status IN('1','4','6','7') AND td.date IN($dates)";
		$Qtrips22="SELECT COUNT(*) as trun, SUM(trip_miles) as tmiles FROM trip_details as td  WHERE td.escort_id = '".$drv_code."' AND td.date BETWEEN '".$pstart."' AND '".$pend."' AND td.status IN('1','4','6','7') AND td.date IN($dates)";
		if($db->query($Qtrips2) && $db->get_num_rows() > 0)
		{ $tripsdata2 = $db->fetch_one_assoc();   $runs= round($tripsdata2['trun'],2); $miles= round($tripsdata2['tmiles'],2);}
		if($db->query($Qtrips22) && $db->get_num_rows() > 0)
		{ $tripsdata22 = $db->fetch_one_assoc();   $runsEs= round($tripsdata22['trun'],2); $milesEs= round($tripsdata22['tmiles'],2);}	
		$runs=$runs+$runsEs;
		$miles=$miles+$milesEs;	 
		$totaldata[0]['runs'] 	= $runs;
		$totaldata[0]['miles'] = $miles;
		$totaldata[0]['payableamount']=round(($totaldata[0]['totalhourpayment'])+($totaldata[0]['totalovertimepayment'])+($totaldata[0]['per_run']*$runs)+($totaldata[0]['per_mile']*$miles),2);
		$totaldata[0]['totalmilesinsentive'] 	= round(($totaldata[0]['per_mile']*$miles),2);
		$totaldata[0]['totalruninsentive'] 		= round(($totaldata[0]['per_run']*$runs),2);
		
		}						
			
			//print_r($totaldata);  
	$con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0){
	 $contact = $db->fetch_all_assoc(); }
	 
	$db->close();
    $pgTitle = "Admin Panel -- REPORT";
	$smarty->assign("contact",$contact);
    $smarty->assign("data",$data);
	$smarty->assign("totaldata",$totaldata);
	$smarty->assign("driverinfo",$driverinfo);
	$smarty->assign("pstart",$pstart);
	$smarty->assign("pend",$pend);
	$smarty->assign("today",date('Y-m-d h:i:s'));
	$smarty->display('reportstpl/payperioddetails.tpl');
?>