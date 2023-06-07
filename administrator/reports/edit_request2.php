<?php
   	include_once('../DBAccess/Database.inc.php');
	include_once('../requests/invoice_calculation_function.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
	$id = $_GET['id'];
/*	function chargeablemile($totmilages,$freemiles){
		$df=$totmilages-$freemiles;
		if($df>0) return $df; else return 0;
		//return (($totmilages-$freemiles)>0)?($totmilages-$freemiles):0;
		}*/
	/*function getfreemiles($ac_id,$db){$Q="SELECT freemiles FROM accounts WHERE id = '$ac_id'";
	if($db->query($Q) && $db->get_num_rows() > 0){	$dt=$db->fetch_one_assoc(); return $dt['freemiles'];}else{return '0';}}
	function getfreemiles($ac_id,$db){$Q="SELECT freemiles FROM accounts WHERE id = '$ac_id'";
	if($db->query($Q) && $db->get_num_rows() > 0){	$dt=$db->fetch_one_assoc(); return $dt['freemiles'];}else{return '0';}}*/
	function vrates($vehtype,$account,$db){
			   $ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= ".$vehtype." AND clinic_id= ".$account." ";
					if($db->query($ratequery) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}
					if($r==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$vehtype;
					if($db->query($ratequery55) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}}
			  return $r;}	
if(isset($_GET['id']) && $_GET['id'] != ''){ 		
	  $Query1 = "SELECT * FROM ".TBL_FORMS." WHERE `id`='".$_GET['id']."' LIMIT 1";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {  $RequestDetail = $db->fetch_one_assoc();  }
		$Qbilling="SELECT * FROM billing_info WHERE trip_id='".$_GET['id']."' ORDER BY id ASC";
		if($db->query($Qbilling) && $db->get_num_rows() > 0)
		{ 
		$billingdata = $db->fetch_all_assoc(); }		
		} 
	//	print_r($billingdata);		
if(isset($_POST['submit']) && $_POST['id']!=''){
	  
	$miles_string='';
								
	for($i=0; $i<sizeof($_POST['leg_id']); $i++ ){ 							
								
		 /* $wait_time = $_POST['waittime'][$i];
		  sscanf($wait_time, "%d:%d:%d", $hours, $minutes, $seconds);
		  $time_seconds =  $hours * 3600 + $minutes * 60 + $seconds;
		  $extra_time[$i] = ($time_seconds );//- (30*60)
		  if($extra_time[$i] > 60){
		  $times_units[$i]	=	(int)($extra_time[$i])/(1*60); 
		  $wait_time_charges[$i] = $times_units[$i] * $_POST['waittime_rate'][$i]; 	  }
		if($_POST['bstretcher'][$i]=='Yes'){		$bstr_charges[$i] 			=	$_POST['bstretcher_rate'][$i];}
		if($_POST['dstretcher'][$i]=='Yes'){	    $dstr_charges[$i] 			=	$_POST['dstretcher_rate'][$i];}
		if($_POST['oxygen'][$i]=='Yes'){			$oxygen_charges[$i] 		=	$_POST['oxygen_rate'][$i];}
		if($_POST['doublewheel'][$i]=='Yes'){		$dwchair_charges[$i] 		=	$_POST['doublewheel_rate'][$i];}*/
		
		//$chargeablemile = chargeablemile($_POST['miles'][$i],$_POST['freemiles'][$i]);
		 $ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= ".$_POST['vehtype']." AND clinic_id= ".$_POST['account']." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}
			  if($r==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$_POST['vehtype'];
			  if($db->query($ratequery55) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}}
		
		$milescharges = chargeablemile2($_POST['miles'][$i],$r);
		/* $totcharges = round((($_POST['pickup_ch'][$i]) + 
						($chargeablemile  			*  	$_POST['permile_ch'][$i]) +
						($_POST['afterhour'][$i] 	* 	$_POST['afterhour_rate'][$i])+
						($_POST['noshow'][$i] 	  	*  	$_POST['noshow_rate'][$i])+
						$_POST['miscellaneous_charges'][$i] + $_POST['unloaded_miles_ch'][$i] + $bstr_charges[$i] + $dstr_charges[$i] + $wait_time_charges[$i]+$oxygen_charges[$i]+$dwchair_charges[$i]),2);*/
						
						$totcharges = round((($_POST['afterhour'][$i] 	* 	$_POST['afterhour_rate'][$i])+($_POST['miscellaneous_charges'][$i])+($milescharges)),2);
				// print_r($_POST); exit;				
	 $QUp1="Update ".billing_info." SET 
					charges				=	'".$totcharges."',
					pickup_ch			=	'".$_POST['pickup_ch'][$i]."',
					permile_ch			=	'".$_POST['permile_ch'][$i]."',
					waittime			=	'".$_POST['waittime'][$i]."',
					waittime_unit		=	'".$times_units[$i]."',
					waittime_rate		=	'".$_POST['waittime_rate'][$i]."',
					noshow				=	'".$_POST['noshow'][$i]."',
					noshow_rate			=	'".$_POST['noshow_rate'][$i]."',	
					dstretcher			=	'".$_POST['dstretcher'][$i]."',
					dstretcher_rate		=	'".$_POST['dstretcher_rate'][$i]."',				
					bstretcher			=	'".$_POST['bstretcher'][$i]."',
					bstretcher_rate		=	'".$_POST['bstretcher_rate'][$i]."',
					afterhour			=	'".$_POST['afterhour'][$i]."',
					afterhour_rate		=	'".$_POST['afterhour_rate'][$i]."',
					oxygen				=	'".$_POST['oxygen'][$i]."',
					oxygen_rate			=	'".$_POST['oxygen_rate'][$i]."',
					doublewheel			=	'".$_POST['doublewheel'][$i]."',
					doublewheel_rate	=	'".$_POST['doublewheel_rate'][$i]."',
					freemiles			=	'".$_POST['freemiles'][$i]."',
					miles				=	'".$_POST['miles'][$i]."',
					unloaded_miles		=	'".$_POST['unloaded_miles'][$i]."',
					unloaded_miles_ch	=	'".$_POST['unloaded_miles_ch'][$i]."',
					miscellaneous_charges=  '".$_POST['miscellaneous_charges'][$i]."'
					WHERE 	id  		= 	'".$_POST['leg_id'][$i]."' LIMIT 1";
					$db->query($QUp1);	
					
}
	$miles_string = $_POST['miles'][0].','.$_POST['miles'][1].','.$_POST['miles'][2].','.$_POST['miles'][3].','.$_POST['miles'][4];
	$QUp="Update ".TBL_FORMS." SET 
								clientname 			= '".$_POST['clientname']."',
								account 			= '".$_POST['account']."',
								phnum 				= '".$_POST['phnum']."',
								po	 				= '".$_POST['po']."',
								dob	 				= '".convertDateToMySQL($_POST['dob'])."',
								vehtype 			= '".$_POST['vehtype']."',
								picklocation 		= '".$_POST['picklocation']."',
								pickaddr 			= '".$_POST['pickaddr']."',
								droplocation 		= '".$_POST['droplocation']."',
								destination 		= '".$_POST['destination']."',
								droplocation2 		= '".$_POST['droplocation2']."',
								three_address 		= '".$_POST['three_address']."',
								droplocation3 		= '".$_POST['droplocation3']."',
								four_address 		= '".$_POST['four_address']."',
								backtolocation 		= '".$_POST['backtolocation']."',
								backto 				= '".$_POST['backto']."',
								miles_string		= '".$miles_string."',
								milage				= '".$miles_total."',
								legaid				= '".$_POST['legaid']."',
								legbid				= '".$_POST['legbid']."',
								legcid				= '".$_POST['legcid']."',
								legdid				= '".$_POST['legdid']."'
								WHERE 			 id = '".$_POST['id']."' LIMIT 1";
		  					
					if($db->query($QUp)){ if($_POST['regenrate']=='on'){  invoice_generation($_POST['id'],$db);}

						
						
						
			echo "<script type='text/ecmascript'>alert('Trip and Invoice Information Updated Successfully')</script>";
			echo "<script>window.close();</script>";
			}else{
			echo "<script type='text/ecmascript'>alert('Unable to Update Trip Informations!.')</script>";
			echo "<script>window.close();</script>";
			}		

	}	
	 $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){	$vehiclepref = $db->fetch_all_assoc(); }
 $Queryhosp1 = "SELECT id,account_name FROM ".accounts." WHERE 1=1  ORDER BY `account_name` ASC";
   if($db->query($Queryhosp1) && $db->get_num_rows() > 0)
	{   $accounts = $db->fetch_all_assoc();  }
	/*for($i=0;$i<sizeof($billingdata);$i++){
		//$billingdata[$i]['chargeablemile']=chargeablemile($billingdata[$i]['miles'],$billingdata[$i]['freemiles']);
		
		}*/
	//print_r($RequestDetail);
	$db->close();
	$pgTitle="Edit Request";
    $smarty->assign('id',$id); 
	$smarty->assign('accounts',$accounts);
	$smarty->assign('dt',$RequestDetail); 
	$smarty->assign('dob',convertDateFromMySQL($RequestDetail['dob'])); 
	$smarty->assign("legA",$billingdata[0]);
	$smarty->assign("billingdata",$billingdata); 
	//$smarty->assign("chargeablemile1",chargeablemile($billingdata[0]['miles'],$billingdata[0]['freemiles']));
	$smarty->assign("legB",$billingdata[1]);
	//$smarty->assign("chargeablemile2",chargeablemile($billingdata[1]['miles'],$billingdata[1]['freemiles']));
	$smarty->assign("total_charges",round(($billingdata[0]['charges']+$billingdata[1]['charges']),2));
	$smarty->assign('vehiclepref',$vehiclepref); 
	$smarty->display('reportstpl/edit_request2.tpl');
?>