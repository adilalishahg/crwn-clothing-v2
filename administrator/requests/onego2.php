<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
   $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db->connect();
	$c=0;
	$dt1=date("m/d/Y",strtotime("+1 day"));
	$dt=date("m/d/Y",strtotime("+1 year"));
	function Weekdays( $start_ts, $end_ts, $day, $include_start_end = true) {      
	   $day = strtolower( $day );    
	    $current_ts = $start_ts;    
		  $i=0;
		$firstdate =   strtotime( 'next '.$day, $start_ts );
		//$firstdate = date('Y-m-d',$firstdate);
		if($firstdate < $end_ts){
		$dt[$i]= date('Y-m-d',$firstdate); }
		while( $firstdate < $end_ts ) { $i++;
		//$firstdate = strtotime(date("Y-m-d", strtotime($firstdate)) . " +7 day");
		$firstdate = $firstdate +(7*24*60*60);
		if($firstdate < $end_ts){		$dt[$i]= date('Y-m-d',$firstdate);}
			     }
	   return $dt;  } 

if($_POST['search']){ //print_r($_POST);
	$hostpital_id 		= $_POST['hostpital_id'];
	$startdate 			= convertDateToMySQL($_POST['startdate']);
	$enddate 			= convertDateToMySQL($_POST['enddate']);
	$dob 				= $_POST['dob'];
	$dt 				= $_POST['enddate'];
	$clientname 		= str_replace('\'','`',$_POST['clientname']);
	$day=$_POST['day'];
	if($day!=''){ //echo $day; //exit;
	$dates_array=implode("','",(Weekdays(strtotime($startdate),strtotime($enddate),$day,true)));
	$whr_date="AND appdate IN ('$dates_array')";
	}else{$whr_date="AND appdate BETWEEN '".$startdate." 00:00:00' AND '".$enddate." 23:59:59'";}

	
	
	$Query2 = "SELECT f.*,r.hospname,r.userid FROM ".TBL_FORMS." as f 
	left join ".TBL_REQUESTS." as r on r.reqid=f.req_id 
	WHERE LTRIM(LOWER(f.clientname))='".strtolower(trim(mysql_real_escape_string($clientname)))."' 
	 $whr_date AND rec_ind = 'rec'   
	 ORDER BY f.appdate ASC ";
	/* $Query2 = "SELECT f.*,r.hospname FROM ".TBL_FORMS." as f 
	left join ".TBL_REQUESTS." as r on r.reqid=f.req_id 
	WHERE f.dob='".convertDateToMySQL($dob)."' 
	AND LTRIM(LOWER(f.clientname))='".strtolower(trim($clientname))."' 
	AND r.userid = '$hostpital_id'
	AND appdate BETWEEN '".$startdate." 00:00:00' AND '".$enddate." 23:59:59'   
	 ORDER BY f.appdate ASC ";*/
		if($db->query($Query2) && $db->get_num_rows()){ $data = $db->fetch_all_assoc(); 
		$clinic = $data[0]['hospname'];
	$dates = array();
	$Monday=array();
	$Tuesday=array();
	$Wednesday=array();
	$Thursday=array();
	$Friday=array();
	$Saturday=array();
	$Sunday=array();
	for($i=0;$i<sizeof($data);$i++){$pendingids.=$data[$i]['id'].'@'; $c++;
	$s=explode('-',$data[$i]['appdate']);
	$ss=$data[$i]['appdate'].'#'.date("l", mktime(0,0,0,$s[1],$s[2],$s[0]));
	
	/*if(preg_match('/Monday/', $ss )){ 	array_push($Monday,str_replace('#Monday','',$ss));} 
	if(preg_match('/Tuesday/', $ss )){ 	array_push($Tuesday,str_replace('#Tuesday','',$ss));} 
	if(preg_match('/Wednesday/', $ss )){array_push($Wednesday,str_replace('#Wednesday','',$ss));} 
	if(preg_match('/Thursday/', $ss )){ array_push($Thursday,str_replace('#Thursday','',$ss));} 
	if(preg_match('/Friday/', $ss )){ 	array_push($Friday,str_replace('#Friday','',$ss));} 
	if(preg_match('/Saturday/', $ss )){ array_push($Saturday,str_replace('#Saturday','',$ss));}
	if(preg_match('/Sunday/', $ss )){ 	array_push($Sunday,str_replace('#Sunday','',$ss)); } 
	*/
	
	if(preg_match('/Monday/', $ss )){ 	array_push($Monday,str_replace('#Monday','',$ss));
	$data[0]['apptimeM']		=	$data[$i]['apptime'];
	$data[0]['returnpickupM']	=	$data[$i]['returnpickup'];} 
	if(preg_match('/Tuesday/', $ss )){ 	array_push($Tuesday,str_replace('#Tuesday','',$ss));
	$data[0]['apptimeTU']		=	$data[$i]['apptime'];
	$data[0]['returnpickupTU']	=	$data[$i]['returnpickup'];} 
	if(preg_match('/Wednesday/', $ss )){array_push($Wednesday,str_replace('#Wednesday','',$ss));
	$data[0]['apptimeW']		=	$data[$i]['apptime'];
	$data[0]['returnpickupW']	=	$data[$i]['returnpickup'];} 
	if(preg_match('/Thursday/', $ss )){ array_push($Thursday,str_replace('#Thursday','',$ss));
	$data[0]['apptimeTH']		=	$data[$i]['apptime'];
	$data[0]['returnpickupTH']	=	$data[$i]['returnpickup'];} 
	if(preg_match('/Friday/', $ss )){ 	array_push($Friday,str_replace('#Friday','',$ss));
	$data[0]['apptimeF']		=	$data[$i]['apptime'];
	$data[0]['returnpickupF']	=	$data[$i]['returnpickup'];} 
	if(preg_match('/Saturday/', $ss )){ array_push($Saturday,str_replace('#Saturday','',$ss));
	$data[0]['apptimeSA']		=	$data[$i]['apptime'];
	$data[0]['returnpickupSA']	=	$data[$i]['returnpickup'];}
	if(preg_match('/Sunday/', $ss )){ 	array_push($Sunday,str_replace('#Sunday','',$ss));
	$data[0]['apptimeSU']		=	$data[$i]['apptime'];
	$data[0]['returnpickupSU']	=	$data[$i]['returnpickup'];} 
	
	
	array_push($dates,$ss);
	} $pendingids = substr($pendingids, 0, -1); }
//print_r($Monday);
if($Monday)		{	$Mondaycheck=1;		$tdmonday=@end(array_values($Monday));	}
if($Tuesday)	{	$Tuesdaycheck=1;	$tdtuseday=@end(array_values($Tuesday));	}
if($Wednesday)	{	$Wednesdaycheck=1;	$tdwednesday=@end(array_values($Wednesday));}
if($Thursday)	{	$Thursdaycheck=1;	$tdthirsday=@end(array_values($Thursday));	}
if($Friday)		{	$Fridaycheck=1;		$tdfriday=@end(array_values($Friday));	}
if($Saturday)	{	$Saturdaycheck=1;	$tdsaturday=@end(array_values($Saturday));	}
if($Sunday)		{	$Sundaycheck=1;	$tdsunday=@end(array_values($Sunday));	}
//echo $Tuesdaycheck;
 //if(preg_match('/Distance/', $result[$i] )){ $required = $result[$i];} 
//print_r($data);// exit;

	 $paddr=explode(',',$data[0]['pickaddr'],3);
	  $daddr=explode(',',$data[0]['destination'],3);
	  $backaddr=explode(',',$data[0]['backto'],3);
	  $bck=$backaddr[0].','.$backaddr[2];
	  $bsuiteroom=$backaddr[1];
	  $pckaddr=$paddr[0].','.$paddr[2];
	  $psuiteroom=$paddr[1];
	  $drpaddr=$daddr[0].','.$daddr[2];
	  $dsuiteroom=$daddr[1];
	  
	   // New data extracting from db
	 $roomapt				=  $data[0]['roomapt'];
	 $destination_place		=  $data[0]['destination_place'];
	 $destination_place3	=  $data[0]['destination_place3'];
	 $destination_place4	=  $data[0]['destination_place4'];
	 $destination_place5	=  $data[0]['destination_place5'];
	 $stebldg				=  $data[0]['stebldg'];
	 $stebldg3				=  $data[0]['stebldg3'];
	 $stebldg4				=  $data[0]['stebldg4'];
	 $stebldg5				=  $data[0]['stebldg5'];
	 $destination2   		=  $data[0]['three_address'];
	 $destination3   		=  $data[0]['four_address'];
	 
 	  $daddr2=explode(',',$destination2,3);
	  $destination2=$daddr2[0].','.$daddr2[2];
	  $dsuiteroom2=$daddr2[1];
	  $daddr3=explode(',',$destination3,3);
	  $destination3=$daddr3[0].','.$daddr3[2];
	  $dsuiteroom3=$daddr3[1];
	 
	 $three_pickup=$RequestDetail[0]['three_pickup'];
	 if($three_pickup=='00:00:00'){$three_pickup=''; $three_will_call='on';} 

	 $four_pickup=$RequestDetail[0]['four_pickup'];
	 if($four_pickup=='00:00:00'){$four_pickup=''; $four_will_call='on';}

	 
	 $five_pickup=$RequestDetail[0]['five_pickup'];
	 if($five_pickup=='00:00:00'){$five_pickup=''; $five_will_call='on';}

}
   $Qaccounts  = "SELECT * FROM " .  accounts ." ORDER BY account_name ASC " ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){
		$accounts = $db->fetch_all_assoc();
	 }
 $drvQuery = "SELECT  d.fname, d.lname, d.drv_code FROM ".TBL_DRIVERS." as d WHERE d.drvstatus !='Suspended' ORDER BY d.fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0)
		$drivers = $db->fetch_all_assoc();
		
 $qv="SELECT * FROM " .TBL_VEHTYPES;if($db->query($qv)&&$db->get_num_rows()>0){$vehiclepref=$db->fetch_all_assoc();}
 //GET STATES LIST
 $gstat = "SELECT * FROM ".TBL_STATES; if($db->query($gstat) && $db->get_num_rows() > 0){$slist=$db->fetch_all_assoc();}
 	//print_r($data);
	//End of admin level devision	
	$db->close();
    $pgTitle = "Admin Panel -- ";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("st",$st);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("req",$uid);
	$smarty->assign("data",$data);
	$smarty->assign("post",$_POST);	
	$smarty->assign("clinic",$clinic);	
	$smarty->assign("drivers",$drivers);	
	$smarty->assign("hospitals",$hospitals);	
	$smarty->assign("hostpital_id",$_POST['hostpital_id']);		
	$smarty->assign("pendingids",$pendingids);
	$smarty->assign("vehiclepref",$vehiclepref);
	$smarty->assign("c",$c);
	$smarty->assign("dob",$_POST['dob']);
	$smarty->assign("enddate",$dt);	
	$smarty->assign("startdate",$dt1);	
	$smarty->assign("states",$slist);	
	$smarty->assign("appdata",$appdata);

	$smarty->assign("bck",$bck);
	$smarty->assign("bsuiteroom",$bsuiteroom);
	$smarty->assign("pckaddr",$pckaddr);
	$smarty->assign("psuiteroom",$psuiteroom);
	$smarty->assign("drpaddr",$drpaddr);
	$smarty->assign("dsuiteroom",$dsuiteroom);
	 $smarty->assign("destination2",$destination2);
	 $smarty->assign("destination3",$destination3);
	 $smarty->assign("psuiteroom",$psuiteroom);
	 $smarty->assign("dsuiteroom",$dsuiteroom);
	 $smarty->assign("dsuiteroom2",$dsuiteroom2);
	 $smarty->assign("dsuiteroom3",$dsuiteroom3);
	 $smarty->assign("p5suiteroom",$p5suiteroom);
	 $smarty->assign("bsuiteroom",$bsuiteroom);
	
	$smarty->assign("Mondaycheck",$Mondaycheck);	
	$smarty->assign("Tuesdaycheck",$Tuesdaycheck);
	$smarty->assign("Wednesdaycheck",$Wednesdaycheck);
	$smarty->assign("Thursdaycheck",$Thursdaycheck);
	$smarty->assign("Fridaycheck",$Fridaycheck);
	$smarty->assign("Saturdaycheck",$Saturdaycheck);
	$smarty->assign("Sundaycheck",$Sundaycheck);
	
	$smarty->assign("tdmonday",$tdmonday);
	$smarty->assign("tdtuseday",$tdtuseday);	
    $smarty->assign("tdwednesday",$tdwednesday);	
    $smarty->assign("tdthirsday",$tdthirsday);
	$smarty->assign("tdfriday",$tdfriday);
	$smarty->assign("tdsaturday",$tdsaturday);
	$smarty->assign("tdsunday",$tdsunday);
	$smarty->assign("clientname",$clientname);
	$smarty->assign("day",$day);
			
	$smarty->display('reqtpls/onego2.tpl');
?>