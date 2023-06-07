<?php
   	include_once('../DBAccess/Database.inc.php');
	function getfreemiles($ac_id,$db){$Q="SELECT freemiles FROM accounts WHERE id = '$ac_id'";
	if($db->query($Q) && $db->get_num_rows() > 0){	$dt=$db->fetch_one_assoc(); return $dt['freemiles'];}else{return '0';}}
	function chargeablemile($totmilages,$freemiles){
		$df=$totmilages-$freemiles;
		if($df>0) return $df; else return 0;
		//return (($totmilages-$freemiles)>0)?($totmilages-$freemiles):0;
		}
	function chargeablemile2($totmilages,$rates){
		$charges = 0;
		if($totmilages < 4 ){$charges = $rates['rate3'];}
		if(7 > $totmilages && $totmilages > 3.9999 ){$charges = $rates['rate6'];}
		if(10.00001 > $totmilages && $totmilages > 6.9999 ){$charges = $rates['rate10'];}
		if(10 < $totmilages){   $charges = $rates['rate10'] + (($totmilages - 10)*$rates['permile_ch'] );}
		return $charges;
		}
	function invoice_generation($id,$db){
	//$db = new Database;	
	//$db->connect();
		$re="SELECT ac.id,ac.freemiles as frmiles,ac.account_name,tr.* FROM request_info as tr LEFT JOIN ".accounts." as ac on tr.account=ac.id WHERE tr.id= '$id'";
			if($db->query($re) && $db->get_num_rows() > 0){
			$dt=$db->fetch_one_assoc();
			$milearry=explode(',',$dt['miles_string']);
			if($milearry[0]){$miles1=$milearry[0];}
			if($milearry[1]){$miles2=$milearry[1];}
			if($milearry[2]){$miles3=$milearry[2];}
			if($milearry[3]){$miles4=$milearry[3];}
			
		$Qdelete="DELETE FROM billing_info WHERE trip_id = '".$dt['id']."' "; 
		$db->execute($Qdelete); 
		$Qselect_contactinfo="SELECT * FROM contact_info ";
		if($db->query($Qselect_contactinfo) && $db->get_num_rows() > 0){ $contactinfo = $db->fetch_one_assoc();	
		//print_r($contactinfo);
		$starttime=timetoseconds($contactinfo['starttime']);
		$endtime=timetoseconds($contactinfo['endtime']);
		
		 } 
		switch($dt['triptype']){
			case 'One Way':
			$ch1=insert_billing($db,$dt,'AB',$miles1,'1',$starttime,$endtime,$dt['unloaded_miles_a']);
			break;
			case 'Round Trip':
			 $ch1=insert_billing($db,$dt,'AB',$miles1,'1',$starttime,$endtime,$dt['unloaded_miles_a']);
			 $ch2=insert_billing($db,$dt,'BF',$miles2,'2',$starttime,$endtime,$dt['unloaded_miles_b']);
			break;
			case 'Three Way':
			 $ch1=insert_billing($db,$dt,'AB',$miles1,'1',$starttime,$endtime,$dt['unloaded_miles_a']);
			 $ch2=insert_billing($db,$dt,'BC',$miles2,'2',$starttime,$endtime,$dt['unloaded_miles_b']);
			 $ch3=insert_billing($db,$dt,'CF',$miles3,'3',$starttime,$endtime,$dt['unloaded_miles_c']);
			break;
			case 'Four Way':
			 $ch1=insert_billing($db,$dt,'AB',$miles1,'1',$starttime,$endtime,$dt['unloaded_miles_a']);
			 $ch2=insert_billing($db,$dt,'BC',$miles2,'2',$starttime,$endtime,$dt['unloaded_miles_b']);
			 $ch3=insert_billing($db,$dt,'CD',$miles3,'3',$starttime,$endtime,$dt['unloaded_miles_c']);
			 $ch4=insert_billing($db,$dt,'DF',$miles4,'4',$starttime,$endtime,$dt['unloaded_miles_d']);
			break;
			default:
			break;
		} $totcharges=($ch1+$ch2+$ch3+$ch4);
		$Qselect="SELECT tdid FROM trip_details  WHERE reqid ='".$dt['id']."' AND status IN ('5','6','9','10')";
		if($db->query($Qselect) && $db->get_num_rows() > 0){	$invoice_gen_q =",invoice_gen='0'";	}else{$invoice_gen_q =",invoice_gen='1'";}
			$query = "UPDATE ".TBL_FORMS." SET  charges = '".$totcharges."' $invoice_gen_q  WHERE id = '".$dt['id']."'";
			$db->query($query);	 
				}
			}	
	function insert_billing($db,$dt,$type,$miles,$leg,$starttime,$endtime,$unloaded_miles){		  
		//$rate_type	=	$dt['rate_type'];
	
			  $ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= ".$dt['vehtype']." AND clinic_id= ".$dt['account']." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}
			  if($r==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$dt['vehtype'];
			  if($db->query($ratequery55) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}}
			$freemiles = $dt['frmiles'];
		  
		$Qselect_status="SELECT status,arrived_time,picked_time,pck_time,drp_time,legcharges,tdid FROM trip_details WHERE reqid ='".$dt['id']."' AND type = '$type' ";
		if($db->query($Qselect_status) && $db->get_num_rows() > 0){	$statusdata = $db->fetch_one_assoc();	
		$status1=$statusdata['status'];
		//echo $statusdata['arrived_time'].'mmmmm'.date("H:i:s",$statusdata['arrived_time']); exit;
		
		
		if($statusdata['arrived_time']=='00:00:00' || $statusdata['arrived_time']==''){ $statusdata['arrived_time'] = $statusdata['picked_time']; }
		$temp  = new DateTime($statusdata['picked_time']);
		$temp = $temp->diff(new DateTime($statusdata['arrived_time']));
		$time_seconds = ($temp->h *3600)+($temp->i * 60)+($temp->s);

		  $wait_time = gmdate("H:i:s", $time_seconds);
		  $extra_time = ($time_seconds );//- (5*60)
		  if($extra_time > 60){
		  $times_units	=	(int)($extra_time)/(60);//(15*60) 
			if($times_units > .99999){
				if(($times_units-$r['free_wait_time'])<=0){
					$wait_time_charges=0;
				}
				else{
					$wait_time_charges = ($times_units-$r['free_wait_time']) * ($r['waittime_ch']);//; 
				}
			}
		 
		}
		}else{ $status1='3';}

		 $pck_timeinseconds = timetoseconds($statusdata['pck_time']);
		if($starttime > $pck_timeinseconds || $pck_timeinseconds > $endtime) {$dt['p_after_hours'] = 1;}else{$dt['p_after_hours']=0;}
		if($statusdata['pck_time']=='23:59:59'){$dt['p_after_hours']=0;}
		if($status1=='7' ){$dt['noshow']=1;}else{$dt['noshow']=0;}
		  if($status1=='3' || $status1=='8'){$cancel=1;}else{$cancel=0;}
		if($dt['account'] == $_SESSION['logiticid']){
			$unml=$oneUnCharges=0;
			if($type=='AB' && $dt['unloadedmilage']>20){
				$unml=0;//$dt['unloadedmilage'];
				$oneUnCharges=0;//($dt['unloadedmilage']-20)*$r['un_loaded_ch'];
			}
			
			$milescharges = chargeablemile2($miles,$r);
			$totcharges = round((($dt['p_after_hours'] *  $r['afterhour_ch'])+($milescharges)+($oneUnCharges)),2);
		}else{
		  
		if($dt['bar_stretcher']=='Yes'){	$bstr_charges 	=	$r['bstretcher_ch'];}
		if($dt['dstretcher']=='Yes'){	    $dstr_charges 	=	$r['dstretcher_ch'];}
		if($dt['oxygen']=='Yes'){			$oxygen_charges =	$r['oxygen_ch'];}
		if($dt['dwchair']=='Yes'){			$dwchair_charges=	$r['doublewheel_ch'];}
		$chargeablemile = chargeablemile($miles,$freemiles);
		$unml=$oneUnCharges=0;
		if($type=='AB' && $dt['unloadedmilage']>20){
			$unml=0;//$dt['unloadedmilage'];
			$oneUnCharges=0;//($dt['unloadedmilage']-20)*$r['un_loaded_ch'];
		}else{
			$oneUnCharges=$r['un'.$unloaded_miles];	
		}
		
		$totcharges = round((( $r['pickup_ch']) + 
						($chargeablemile  *  $r['permile_ch']) +
						($dt['p_after_hours'] *  $r['afterhour_ch'])+
						($dt['noshow'] 	  *  $r['noshow_ch'])+
						$dt['miscellaneous_charges']+ $str_charges + $r['un'.$unloaded_miles] + $bstr_charges + $dstr_charges + $wait_time_charges + $oxygen_charges+$dwchair_charges+$oneUnCharges),2);
						// if($status1=='7' ){$totcharges =$r['noshow_ch'];}
			if($statusdata['legcharges']>0){ $totcharges =$statusdata['legcharges']; }
		}
			$Qinsert1="INSERT INTO billing_info SET
					trip_id				=	'".$dt['id']."',
					tdid				=	'".$statusdata['tdid']."',
					leg					=	'$leg',
					cancel				=	'".$cancel."',
					status				=	'".$status1."',
					charges				=	'".$totcharges."',
					pickup_ch			=	'".$r['pickup_ch']."',
					permile_ch			=	'".$r['permile_ch']."',
					waittime			=	'".$wait_time."',
					waittime_unit		=	'".$times_units."',
					waittime_rate		=	'".$r['waittime_ch']."',
					noshow				=	'".$dt['noshow']."',
					noshow_rate			=	'".$r['noshow_ch']."',	
					dstretcher			=	'".$dt['dstretcher']."',
					dstretcher_rate		=	'".$r['dstretcher_ch']."',				
					bstretcher			=	'".$dt['bar_stretcher']."',
					bstretcher_rate		=	'".$r['bstretcher_ch']."',
					afterhour			=	'".$dt['p_after_hours']."',
					afterhour_rate		=	'".$r['afterhour_ch']."',
					oxygen				=	'".$dt['oxygen']."',
					oxygen_rate			=	'".$r['oxygen_ch']."',
					doublewheel			=	'".$dt['dwchair']."',
					doublewheel_rate	=	'".$r['doublewheel_ch']."',
					freemiles			=	'".$freemiles."',
					unloaded_miles		=	'".$unml."',
					unloaded_miles_ch	=	'".$oneUnCharges."',
					miles				=	'".$miles."'";
		
		$db->execute($Qinsert1); 		return $totcharges; 
		
		}			
?>