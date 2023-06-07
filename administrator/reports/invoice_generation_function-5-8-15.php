<?php
   	include_once('../DBAccess/Database.inc.php');
	function getfreemiles($ac_id,$db){$Q="SELECT freemiles FROM accounts WHERE id = '$ac_id'";
	if($db->query($Q) && $db->get_num_rows() > 0){	$dt=$db->fetch_one_assoc(); return $dt['freemiles'];}else{return '0';}}
	function chargeablemile($totmilages,$freemiles){
		$df=$totmilages-$freemiles;
		if($df>0) return $df; else return 0;
		//return (($totmilages-$freemiles)>0)?($totmilages-$freemiles):0;
		}
  	function invoice_generation($id,$db){
	//$db = new Database;	
	//$db->connect();
		$re="SELECT ac.id,ac.freemiles as frmiles,ac.account_name,tr.* FROM ".accounts." as ac,request_info as tr WHERE tr.account = ac.id  AND tr.id= '$id'";
				if($db->query($re) && $db->get_num_rows() > 0){
				 $dt=$db->fetch_one_assoc();
				}
			  //$rate_type	=	$dt['rate_type'];
			  $ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= ".$dt['vehtype']." AND clinic_id= ".$dt['account']." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}
			  if($r==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$dt['vehtype'];
			  if($db->query($ratequery55) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}}
			$freemiles = $dt['frmiles'];
			$milearry=explode(',',$dt['miles_string']);
			if($milearry[0]){$miles1=$milearry[0];}
			if($milearry[1]){$miles2=$milearry[1];}
	 //	if($dt['custom_rates']=='1'){ $freemiles = $dt['freemiles']; $r = $dt;}
		  $wait_time = $dt['wait_time'];
		  sscanf($wait_time, "%d:%d:%d", $hours, $minutes, $seconds);
		  $time_seconds =  $hours * 3600 + $minutes * 60 + $seconds;
		  $extra_time = ($time_seconds - (30*60));
		  if($extra_time > 60){
		  $times_units	=	(int)($extra_time)/(30*60); 
		  $wait_time_charges = $times_units * $r['waittime_ch']; 	  }
		  
		  
		$Qselect_status="SELECT status FROM trip_details WHERE reqid ='".$dt['id']."' AND type = 'AB' ";
		if($db->query($Qselect_status) && $db->get_num_rows() > 0){	$statusdata = $db->fetch_one_assoc();	}
		$status1=$statusdata['status'];
		  if($status1=='7' || $status1=='8'){$dt['noshow']=1;}else{$dt['noshow']=0;}
		  if($status1=='3'){$cancel=1;}else{$cancel=0;}
		if($dt['bar_stretcher']=='Yes'){	$bstr_charges 	=	$r['bstretcher_ch'];}
		if($dt['dstretcher']=='Yes'){	    $dstr_charges 	=	$r['dstretcher_ch'];}
		if($dt['oxygen']=='Yes'){			$oxygen_charges =	$r['oxygen_ch'];}
		if($dt['dwchair']=='Yes'){			$dwchair_charges=	$r['doublewheel_ch'];}
		$chargeablemile = chargeablemile($miles1,$freemiles);
		$totcharges = round((( $r['pickup_ch']) + 
						($chargeablemile  *  $r['permile_ch']) +
						($dt['after_hours'] *  $r['afterhour_ch'])+
						($dt['noshow'] 	  *  $r['noshow_ch'])+
						$dt['miscellaneous_charges']+ $str_charges + $bstr_charges + $dstr_charges + $wait_time_charges+$oxygen_charges+$dwchair_charges),2);
		$Qdelete="DELETE FROM billing_info WHERE trip_id = '".$dt['id']."' "; 
		$db->execute($Qdelete);
		$Qinsert1="INSERT INTO billing_info SET
					trip_id				=	'".$dt['id']."',
					leg					=	'1',
					cancel				=	'".$cancel."',
					status				=	'".$status1."',
					charges				=	'".$totcharges."',
					pickup_ch			=	'".$r['pickup_ch']."',
					permile_ch			=	'".$r['permile_ch']."',
					waittime			=	'".$dt['wait_time']."',
					waittime_unit		=	'".$times_units."',
					waittime_rate		=	'".$r['waittime_ch']."',
					noshow				=	'".$dt['noshow']."',
					noshow_rate			=	'".$r['noshow_ch']."',	
					dstretcher			=	'".$dt['dstretcher']."',
					dstretcher_rate		=	'".$r['dstretcher_ch']."',				
					bstretcher			=	'".$dt['bar_stretcher']."',
					bstretcher_rate		=	'".$r['bstretcher_ch']."',
					afterhour			=	'".$dt['after_hours']."',
					afterhour_rate		=	'".$r['afterhour_ch']."',
					oxygen				=	'".$dt['oxygen']."',
					oxygen_rate			=	'".$r['oxygen_ch']."',
					doublewheel			=	'".$dt['dwchair']."',
					doublewheel_rate	=	'".$r['doublewheel_ch']."',
					freemiles			=	'".$freemiles."',
					miles				=	'".$miles1."'";
		$db->execute($Qinsert1);
		if($dt['triptype'] == 'Round Trip'){
			$Qselect_status2="SELECT status FROM trip_details WHERE reqid ='".$dt['id']."' AND type = 'BF' ";
		if($db->query($Qselect_status2) && $db->get_num_rows() > 0){	$statusdata2 = $db->fetch_one_assoc();	}
		$status2=$statusdata2['status'];
		  if($status2=='7' || $status2=='8'){$dt['noshow']=1;}else{$dt['noshow']=0;}
		  if($status2=='3'){$cancel2=1;}else{$cancel2=0;}
			$chargeablemile = chargeablemile($miles2,$freemiles);
		$totcharges = round((($r['pickup_ch']) + 
						($chargeablemile  *  $r['permile_ch']) +
						($dt['after_hours'] *  $r['afterhour_ch'])+
						($dt['noshow'] 	  *  $r['noshow_ch'])+
						$dt['miscellaneous_charges']+ $str_charges + $bstr_charges + $dstr_charges + $wait_time_charges+$oxygen_charges+$dwchair_charges),2);
			$Qinsert2="INSERT INTO billing_info SET
					trip_id				=	'".$dt['id']."',
					leg					=	'2',
					cancel				=	'".$cancel."',
					status				=	'".$status2."',
					charges				=	'".$totcharges."',
					pickup_ch			=	'".$r['pickup_ch']."',
					permile_ch			=	'".$r['permile_ch']."',
					waittime			=	'".$dt['wait_time']."',
					waittime_unit		=	'".$times_units."',
					waittime_rate		=	'".$r['waittime_ch']."',
					noshow				=	'".$dt['noshow']."',
					noshow_rate			=	'".$r['noshow_ch']."',	
					dstretcher			=	'".$dt['dstretcher']."',
					dstretcher_rate		=	'".$r['dstretcher_ch']."',				
					bstretcher			=	'".$dt['bar_stretcher']."',
					bstretcher_rate		=	'".$r['bstretcher_ch']."',
					afterhour			=	'".$dt['after_hours']."',
					afterhour_rate		=	'".$r['afterhour_ch']."',
					oxygen				=	'".$dt['oxygen']."',
					oxygen_rate			=	'".$r['oxygen_ch']."',
					doublewheel			=	'".$dt['dwchair']."',
					doublewheel_rate	=	'".$r['doublewheel_ch']."',
					freemiles			=	'".$freemiles."',
					miles				=	'".$miles2."'";
		$db->execute($Qinsert2);}
		$query = "UPDATE ".TBL_FORMS." SET  charges = '".$totcharges."',invoice_gen='1'  WHERE id = '".$dt['id']."'";
		$db->query($query);
			}
?>