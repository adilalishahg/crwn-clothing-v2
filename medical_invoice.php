<?php
   	include_once('includefile.php');
	//include_once('administrator/requests/invoice_calculation_function.php');
	$db = new Database;	
	$db->connect();
function chargeablemile($totmilages,$freemiles){
		$df=$totmilages-$freemiles;
		if($df>0) return $df; else return 0;
		//return (($totmilages-$freemiles)>0)?($totmilages-$freemiles):0;
		}	
	
	$chargesOK = '';
 $id=$_REQUEST['id'];
$reqid=$_REQUEST['reqid'];
$qtime = $db->query('SELECT NOW() AS tym');
 $get = $db->fetch_one_assoc();
 $xp = explode(' ',$get['tym']);
 $dates = $xp[0];
 $date=date('m-d-Y', strtotime($dates)); 
 $due_date = date("m-d-Y",strtotime("+10 day"));
 $dt=explode("-",$date);
 $dtm=$dt[0];
 $dtd=$dt[1];
 $dty=$dt[2];
 $time=$xp[1];		
 $st=1;

 $query2 = "SELECT * FROM contact_info WHERE c_id = '1' ";
		if($db->query($query2) && $db->get_num_rows()>0){$cdata = $db->fetch_one_assoc(); }
	   $query="SELECT ac.id,ac.freemiles as frmiles,ac.account_name,ac.address,ac.city,ac.state,ac.zip,tr.* FROM request_info as tr LEFT JOIN ".accounts." as ac on tr.account=ac.id WHERE tr.id= '$id'";
		if($db->query($query) && $db->get_num_rows() > 0)
		{ $tdata = $db->fetch_one_assoc(); //print_r($tdata);
		 $queryB = "SELECT bl.*,tr.three_address,tr.four_address,tr.five_address,tr.triptype,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,tr.clientname,tr.appdate,tr.apptime,tr.returnpickup,tr.three_pickup,tr.four_pickup,tr.phnum,tr.id as tid,tr.po,tr.legaid,tr.legbid,tr.legcid,tr.legdid,tr.dob FROM billing_info as bl left join ".TBL_FORMS." as tr on bl.trip_id=tr.id WHERE 1  AND tr.reqstatus = 'approved'  AND bl.cancel = '0' AND bl.status IN(1,4,6,7) AND bl.trip_id ='".$id."' ORDER BY bl.id";
		 if($db->query($queryB) && $db->get_num_rows() > 0)
		{ 
		$tdataB = $db->fetch_all_assoc(); //print_r($tdataB); 
		$gtotal=0;
		for($d=0;$d<sizeof($tdataB);$d++){
			$tdataB[$d]['chargeablemile']=chargeablemile($tdataB[$d]['miles'],$tdataB[$d]['freemiles']);
			$gtotal=$gtotal+$tdataB[$d]['charges'];
			}
		}
		
		$Qbilling="SELECT * FROM billing_info WHERE trip_id='$id' AND status !='3' ORDER BY id ASC";
		if($db->query($Qbilling) && $db->get_num_rows() > 0)
		{ 
		$billingdata = $db->fetch_all_assoc(); }
		//Get comapny info
		} 
		$ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= ".$tdata['vehtype']." AND clinic_id= ".$tdata['account']." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$rates = $db->fetch_one_assoc();	}
			  if($rates==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$tdata['vehtype'];
			  if($db->query($ratequery55) && $db->get_num_rows() > 0){	$rates = $db->fetch_one_assoc();	}}
			 // if($tdata['custom_rates']=='1'){ $freemiles = $tdata['freemiles']; $rates = $tdata;}
	$ratequery = "SELECT vehtype FROM ".vehtype." WHERE id= ".$tdata['vehtype']."  ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$vdata = $db->fetch_one_assoc();	}	  
	$db->close();
	//print_r($cdata);
	$smarty->assign("cdata",$cdata);
	$smarty->assign("rates",$rates);
	$smarty->assign("tdata",$tdata);
	$smarty->assign("tdataB",$tdataB);
	$smarty->assign("vdata",$vdata); 
	$smarty->assign("base",$base);
	$smarty->assign("date",$date);
	$smarty->assign("legA",$billingdata[0]); 
	$smarty->assign("chargeablemile1",chargeablemile($billingdata[0]['miles'],$billingdata[0]['freemiles']));
	$smarty->assign("legB",$billingdata[1]);
	$smarty->assign("chargeablemile2",chargeablemile($billingdata[1]['miles'],$billingdata[1]['freemiles']));
	$smarty->assign("total_charges",round(($billingdata[0]['charges']+$billingdata[1]['charges']),2));
	
	$smarty->assign("due_date",$due_date);
	$smarty->assign("freemiles",$freemiles);
	$smarty->assign("gtotal",$gtotal);
	$smarty->assign('billable_niles',chargeablemile($tdata[$i]['milage'],$fr_miles));
	$smarty->display('medical_invoice.tpl');
?>