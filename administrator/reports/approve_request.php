<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$db1 = new Database;	
	$db1->connect();
	function precision($num){
		$exp1 = explode(".",$num);
		$exp = "$exp1[1]";
		$num1 = intval($exp{0});
		$num2 = intval($exp{1});
		if($num1 >= 5){
			$res = ceil($num).'.0';
		}elseif($num2 >= 5){
			$num1 += 1;
			$num2 = 0;
			$num = $exp1[0].'.'.$num1.$num2;
			if($num1 == 5)
				$res = ceil($num).'.0';
			else
				$res = $num;
		}else{
			$res = $num;
		}
		return $res;
	}
	function getfreemiles($ac_id,$db){$Q="SELECT freemiles FROM accounts WHERE id = '$ac_id'";
	if($db->query($Q) && $db->get_num_rows() > 0){	$dt=$db->fetch_one_assoc(); return $dt['freemiles'];}else{return '0';}}
	function chargeablemile($totmilages,$freemiles){
		return (($totmilages-$freemiles)>0)?($totmilages-$freemiles):0;
		}
	$tid=$_REQUEST['tid'];
	$tdate=$_REQUEST['date'];
	$re= "SELECT * FROM ".TBL_FORMS." as r, ".requests." as re WHERE r.id = '".$tid."' AND re.reqid = r.req_id ";
	if($db->query($re) && $db->get_num_rows() > 0){			 
		 $dt=$db->fetch_all_assoc();
	}
	$miles_string	= explode(',',$dt[0]['miles_string']);
	$miles1 = $miles_string[0];
	if($miles_string[1]) { 	$miles2 = $miles_string[1]; }
	if($miles_string[2]) { 	$miles3 = $miles_string[2]; }
	if($miles_string[3]) { 	$miles4 = $miles_string[3]; }
	if($miles_string[4]) { 	$miles5 = $miles_string[4]; }
	$totmilages			= str_replace("&nbps;","",$dt[0]['milage']);
	$unloadmilage 		= $dt[0]['unloadedmilage'];
	$loadedmilage 		= ($totmilages); 
	//Amount calculation
	$freemiles = getfreemiles($dt[0]['account'],$db);
	if(isset($_POST['submit'])){
		//print_r($_POST); exit;
	//Start of new code
	
	$miles1 = $_POST['miles1'];
	$miles1 = $_POST['miles1'];
	$miles2 = $_POST['miles2'];
	$miles3 = $_POST['miles3'];
	$miles4 = $_POST['miles4'];
	$miles5 = $_POST['miles5'];
	if($dt[0]['triptype'] == 'One Way') 	{$miles_string = $miles1; $base = 1;}
	if($dt[0]['triptype'] == 'Round Trip') 	{$miles_string = $miles1.','.$miles2; $base = 1;}
	if($dt[0]['triptype'] == 'Three Way') 	{$miles_string = $miles1.','.$miles2.','.$miles3; $base = 2;}
	if($dt[0]['triptype'] == 'Four Way') 	{$miles_string = $miles1.','.$miles2.','.$miles3.','.$miles4; $base = 3;}
	if($dt[0]['triptype'] == 'Five Way') 	{$miles_string = $miles1.','.$miles2.','.$miles3.','.$miles4.','.$miles5; $base = 4;}
	$loadedmilage 	= ($miles1 + $miles2 + $miles3 + $miles4 + $miles5);
	$unloadmilage 	= $_POST['unloadmilage'];
	$totmilages 	= ($loadedmilage);
	//Amount Calculation
	$query7= "SELECT * FROM  clinic_rates WHERE vehtype_id = '".$dt[0]['vehtype']."' AND clinic_id='".$dt[0]['account']."'";
		if($db->query($query7) && $db->get_num_rows() > 0){ $vr = $db->fetch_one_assoc();}
		 if($vr==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$dt[0]['vehtype'];
			  if($db->query($ratequery55) && $db->get_num_rows() > 0){	$vr = $db->fetch_one_assoc();	}}
		$wait_time = $_POST['wait_time'];
		sscanf($wait_time, "%d:%d:%d", $hours, $minutes, $seconds);
	   $time_seconds =  $hours * 3600 + $minutes * 60 + $seconds;
	  	$extra_time = ($time_seconds - (30*60));
		if($extra_time > 60){
		 $times_units	=	(int)($extra_time)/(30*60); 
		$wait_time_charges = $times_units * $vr['waittime_ch'];
		}
		//print_r($vr); exit;
	/*	if($_POST['stretcher']=='Yes'){		$str_charges	=	$vr['stretcher_ch'];}*/
		if($_POST['bar_stretcher']=='Yes'){	$bstr_charges 	=	$vr['bstretcher_ch'];}
		if($_POST['dstretcher']=='Yes'){	$dstr_charges 	=	$vr['dstretcher_ch'];}
		if($_POST['oxygen']=='Yes'){	$oxygen_charges 	=	$vr['oxygen_ch'];}
		if($_POST['dwchair']=='Yes'){	$dwchair_charges 	=	$vr['doublewheel_ch'];}
		$chargeablemile = chargeablemile($totmilages,$freemiles);
	$totcharges = round((($base 	  *	 $vr['pickup_ch']) + 
						($chargeablemile  *  $vr['permile_ch']) +
						($_POST['after_hours'] *  $vr['afterhour_ch'])+
						($_POST['noshow'] 	  *  $vr['noshow_ch'])+
						$_POST['miscellaneous_charges']+ $str_charges + $bstr_charges + $dstr_charges + $wait_time_charges+$oxygen_charges+$dwchair_charges),2);

		$query = "UPDATE ".TBL_FORMS." SET 
		milage = '".$totmilages."', 
		unloadedmilage = '".$unloadmilage."', 
		charges = '".$totcharges."', 
		miles_string = '".$miles_string."', 
		miscellaneous_charges = '".$_POST['miscellaneous_charges']."',
		wait_time = '".$_POST['wait_time']."',
		noshow = '".$_POST['noshow']."',
		stretcher = '".$_POST['stretcher']."',
		bar_stretcher = '".$_POST['bar_stretcher']."',
		dstretcher = '".$_POST['dstretcher']."',
		oxygen = '".$_POST['oxygen']."',
		dwchair = '".$_POST['dwchair']."',
		after_hours = '".$_POST['after_hours']."' WHERE id = '".$tid."'";
		if($db->query($query)){ 
			echo "<script type='text/ecmascript'>alert('Trip Miles Updated successfully')</script>";
			if($tdate != '')
            	echo "<script>location.href='milagereport.php?appmiledate=$tdate';</script>";
			else
				echo "<script>location.href='milagereport.php';</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Trip Miles Updation unsuccessfull ');</script>";
			if($tdate != '')
           	echo "<script>location.href='milagereport.php?appmiledate=$tdate';</script>";
			else
				echo "<script>location.href='milagereport.php';</script>";
		}
	}	
	//Close DB Connection	
	//print_r($dt);
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);
	$smarty->assign("msg",$msg);
	$smarty->assign("tid",$tid);
	$smarty->assign("tdate",$tdate);
	$smarty->assign("totmilages",$totmilages);
	$smarty->assign("loadedmilage",$loadedmilage);
	$smarty->assign("unloadmilage",$unloadmilage);
	$smarty->assign("dt",$dt);
	$smarty->assign("miles1",$miles1);
	$smarty->assign("miles2",$miles2);
	$smarty->assign("miles3",$miles3);
	$smarty->assign("miles4",$miles4);
	$smarty->assign("miles5",$miles5);
	$smarty->assign("freemiles",$freemiles);
	$smarty->display('reportstpl/approve_request.tpl');
?>