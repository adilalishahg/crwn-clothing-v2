<?php
 include_once('includefile.php');
 include_once('Classes/mapquest_google_miles.class.php');	
 include('administrator/Classes/pagination-class.php');	
 if($_SESSION['allowUser'] == ''){echo '<script>location.href="index.php";</script>';  exit;}
 if(isset($_GET['pageNum'])){ $page_no = $_GET['pageNum'];  }else{  $page_no = '1';  }
$cQuery = "SELECT Count(*) FROM ".TBL_ALOG."  $condition";
$totalRows = $db->executeScalar($cQuery);
$pagination = new pagination($_GET['pageNum'],$maxRows=10,$totalRows);
$mile_C = new mapquest_google_miles;
$qry_vehtype = "SELECT * FROM " . TBL_VEHTYPES;if($db->query($qry_vehtype) && $db->get_num_rows() > 0){$vehiclepref = $db->fetch_all_assoc();} 
$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['id']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
 $whr="";
 $stdate= $_REQUEST['stdate'];
 $enddate=$_REQUEST['enddate'];
 $reqstatus=$_REQUEST['reqstatus'];
 if($stdate==''){$stdate=date("m/d/Y"); }
 if($enddate==''){$enddate=date("m/d/Y");}
 
 
 if($stdate!='' && $enddate!=''){$whr .=" td.date BETWEEN '".convertDateToMySQL($stdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' ";}
 
 /*if($reqstatus!=''){
	 if($reqstatus == '4'){ $whr .= "AND td.status IN ('1','4') "; }
	 elseif($reqstatus == '5'){ $whr .= "AND td.status IN ('5','9') "; }
	 else{$whr.=" AND td.status='".$reqstatus."'"; }
	 }*/
 
if($_SESSION['type'] == 'ac'){
	$accountSql = "SELECT account_name FROM ".accounts." WHERE id='".$_SESSION['loginID']."'";
	if($db->query($accountSql) && $db->get_num_rows() > 0){ 
		$rcrAccount = $db->fetch_one_assoc();
	}
	 $v_ids = $_SESSION['userdata']['id'];
	$whr	.=	" AND  tr.account =".$v_ids." ";
	}
if($_SESSION['type'] == 'pa'){
	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	$whr	.=	" AND ri.cmid='".$_SESSION['userdata']['id']."' ";}


   $Q="SELECT ac.account_name, bl.*,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,TRIM(tr.clientname) as clientname,tr.appdate, tr.apptime,tr.returnpickup,tr.id as tid,
   tr.account, td.pck_add, td.drp_add, tr.claim_no FROM billing_info as bl 
 left join ".TBL_FORMS." as tr on bl.trip_id=tr.id
 left join accounts as ac on tr.account=ac.id
 left join trip_details as td on bl.tdid=td.tdid
  WHERE $whr AND tr.reqstatus = 'approved' AND bl.cancel = '0' AND bl.status IN(1,4,6,7)  ORDER BY bl.id   ";
   /*SELECT td.tdid, td.date, t.trip_clinic, CONCAT(d.fname,' ',d.lname) as name,t.trip_user, d.drv_code, td.pck_add, td.drp_add, td.pck_time,td.drv_id,td.escort_id,td.drp_time, td.aptime,td.ac_noshowcancell,
			td.drp_atime, td.trip_miles, td.pickStatus, td.status,ri.clientname
			FROM ".TBL_TRIP_DET." td  
			left join ".TBL_DRIVERS." AS d on (d.drv_code = td.drv_id)
			LEFT JOIN ".TBL_TRIPS." AS t ON ( t.trip_id = td.trip_id ) 
			LEFT JOIN request_info AS ri ON ( td.reqid = ri.id ) 
			WHERE $whr  group by td.tdid ORDER BY td.date DESC */

 if($db->query($Q) && $db->get_num_rows() > 0){$Requests =$tdata= $db->fetch_all_assoc();
 
 if(isset($_REQUEST['submit2'])){
	 
	 
	 
	 for($i=0; $i<sizeof($tdata); $i++){
		if($tdata[$i]['cancel']=='0'){	$net_balance=($net_balance+$tdata[$i]['charges']);  }
	//$net_balance=$net_balance+$tdata[$i]['charges'];
	$tdata[$i]['billablemile']	= chargeablemile($tdata[$i]['miles'],$tdata[$i]['freemiles']);
	$Q="SELECT vehtype FROM vehtype  
			WHERE id = '".$tdata[$i]['vehtype']."' ";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }	 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				 $tdata[$i]['vehicle'] 			= 	$ata['vehtype'];
	
			if($tdata[$i]['leg']=='1'){
 $legid	=	$tdata[$i]['legaid'];
	}else{		$legid	=	$tdata[$i]['legbid'];}			 
  $html8.='<tr>
    <td>'.($i+1).'</td>
	<td>'.$tdata[$i]['tid'].'</td>
	<td>'.date("M, d Y",strtotime($tdata[$i]['appdate'])).'<br/>'.$tdata[$i]['account_name'].'</td> 
    <td>'.$tdata[$i]['clientname'].'</td>';
	 if($hospname !=  ''){
	if(strtolower($tdata[0]['account_name'])=='mercy care' || strtolower($tdata[0]['account_name'])=='mercycare' ){
			if($tdata[$i]['dob'] !='0000-00-00'){
			$html8.='<td>'. date("m-d-Y",strtotime($tdata[$i]['dob'])).'</td>'; } else{$html8.='<td></td>';}
			} }
	
	$html8.='<td>'.$tdata[$i]['po'].' '.$legid.'<br/>'.$tdata[$i]['claim_no'].'</td>';
		switch($tdata[$i]['leg']){
		case 1: $leg='A'; break;
		case 2: $leg='B'; break;
		case 3: $leg='C'; break;
		case 4: $leg='D'; break;
		case 5: $leg='E'; break;
		}
	$html8.='<td>Leg '.$leg.'</td>'; 


	if($tdata[$i]['leg']=='1'){
	$html8.='<td>'.$tdata[$i]['pickaddr'].'</td>
	<td>'.$tdata[$i]['destination'].'</td>'; 
	}else{	
	$html8.='<td>'.$tdata[$i]['destination'].'</td>
	<td>'.$tdata[$i]['backto'].'</td>';}
	
	if($tdata[$i]['leg']=='1'){
	$html8.='<td>'.$tdata[$i]['apptime'].'</td>'; 
	// $html8.='<td>'.date('h:i A',strtotime($tdata[$i]['apptime'])).'</td>'; 
	}else{	$html8.='<td>'.$tdata[$i]['returnpickup'].'</td>';}
	// }else{	$html8.='<td>'.date('h:i A',strtotime($tdata[$i]['returnpickup'])).'</td>';}
	
	
	$html8.='<td>'.$tdata[$i]['vehicle'].'<br>Pickup Charges:'.$tdata[$i]['pickup_ch'].'<br>Price Per Miles:'.$tdata[$i]['permile_ch'].'</td>
    <td>Total Miles = '.$tdata[$i]['miles'].'<br/>Free Miles = '.$tdata[$i]['freemiles'].'<br/>Billable Miles = '.$tdata[$i]['billablemile'].' </td>
    <td>';
	
	$html10='';
	if($tdata[$i]['miscellaneous_charges'] >0){$html10.='Misc. Charges: '.$tdata[$i]['miscellaneous_charges'].'<br/>';}
	if($tdata[$i]['dstretcher'] =='Yes'){$html10.='2 Man Team Charges: '.$tdata[$i]['dstretcher_rate'].'<br/>';}
	if($tdata[$i]['oxygen'] =='Yes'){$html10.='Oxygen. Charges: '.$tdata[$i]['oxygen_rate'].'<br/>';}
	if($tdata[$i]['bstretcher'] =='Yes'){$html10.='Bariatric Stretcher Charges: '.$tdata[$i]['bstretcher_rate'].'<br/>';}
	if($tdata[$i]['doublewheel'] =='Yes'){$html10.='Wheel Chair Rental Charges: '.$tdata[$i]['doublewheel_rate'].'<br/>';}
	
	if($tdata[$i]['after_hours']=='1'){$html10.='After Hour Charges: '.$tdata[$i]['afterhour_rate'].'<br/>';}
	if($tdata[$i]['noshow']=='1'){$html10.='No Show Charges: '.$tdata[$i]['noshow_rate'].'<br/>';}
	if($tdata[$i]['waittime_unit']!='0'){$html10.='Wait Time Charges: '.$tdata[$i]['waittime_rate'].'<br/>';}
	
	if($tdata[$i]['unloaded_miles_ch']!='0'){$html10.='Un.M Charges['.$tdata[$i]['unloaded_miles'].']: '.$tdata[$i]['unloaded_miles_ch'].'<br/>';}
	
	$html8.=$html10.'</td>
    <td> $ '.sprintf('%0.2f',$tdata[$i]['charges']).'</td>
  </tr>';
	}
	



	
	
 $query2 = "SELECT * FROM contact_info WHERE c_id = '1' ";
 if($db->query($query2) && $db->get_num_rows()>0){$cdata = $db->fetch_one_assoc(); }
 $query3 = "SELECT * FROM accounts WHERE id = '".$hospname."' ";
 if($db->query($query3) && $db->get_num_rows()>0){$acdata = $db->fetch_one_assoc(); }
 //print_r($acdata); exit;	
$html9.='</table>
    </td></tr>
</table>';
$html77.='<table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:7px;">
<tr>
<td align="center"><img src="images/logo.png" alt="" style="max-height:70px; max-width:70px;"/></td>
<td align="center">INVOICE<br/ >
'.$cdata['title'].'.<br/ >
'.$cdata['address'].'<br/ >
'.$cdata['city'].', '.$cdata['state'].' '.$cdata['zip'].'<br/ >
'.$cdata['phone'].'<br/ >
'.$cdata['url'].'</td>
 <td align="center">
        <span style="font-weight:bold; text-decoration:underline;">Billing Information</span><br>
        <strong>Account Name:</strong> '.$acdata['account_name'].'<br/>
        <strong>Billing address:</strong> '.$acdata['address'].', <br/>'.$acdata['city'].', '.$acdata['state'].' '.$acdata['zip'].' 
 </td>
  </tr>';
  
  $html7.='<tr>
    <td colspan="3">
    <table width="100%" border="0">
	<tr>
   <td colspan="10" height="20"></td>
  	</tr>
  
  <tr>
    <td colspan="10" height="20"></td>
  </tr>';

  $html7.='<tr>
     <td colspan="10" height="20"></td>
  </tr>
 
  <tr>
  	<td></td>
    <td colspan="3">Invoice From: '.date('M, d Y',strtotime($startdate)).' To: '.date('M, d Y',strtotime($enddate)).' </td>
	<td colspan="2">Invoice Generated on: '.date('M, d Y').'</td>
    <td>Total Amount Billed: </td>
    <td>$ '.sprintf('%0.2f',$net_balance).' </td>
	<td></td>
  </tr>
  <tr>
   <td colspan="10" height="20"></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="3">
    <table width="100%" border="1">
  <tr  style="background-color:#0FF;">
    <td align="center" width="3%">S.No</td>
	<td align="center" width="5%">Invoice#</td>
    <td align="center" width="7%">Date<br/>Account Name</td>
    <td align="center" width="9%">Customer Name</td>';
	if($hospname !=  ''){
	if(strtolower($tdata[0]['account_name'])=='mercy care' || strtolower($tdata[0]['account_name'])=='mercycare' ){$html7.='<td align="center" width="5%">DOB</td>';}}
	
	
	$html7.='
	<td align="center" width="5%">PO#/Claim#</td>
	<td align="center" width="5%">Leg</td>
	<td align="center" width="13%">Pick Up Address</td>
	<td align="center" width="13%">Delivery Address</td>
	<td align="center" width="4%">Time</td>
	<td align="center" width="9%">Vehicle Service</td>
    <td align="center" width="9%">Miles</td>
    <td align="center" width="11%">Out of Area / Misc Fee</td>
    <td align="center" width="5%">Total Cost </td>
  </tr>';
  
  
  $html11='
  <table width="100%" border="0">
  <tr>
     <td colspan="12" height="20"></td>
  </tr>
 
  <tr>
  	<td></td>
    <td colspan="3"> </td>
	
    <td colspan="2"><b>Total Billing Amount: </b></td>
    <td><b>$ '.sprintf('%0.2f',$net_balance).' </b></td>
	<td colspan="1"></td>
	<td colspan="2"><b>Due Amount: </b></td>
    <td><b>$ '.sprintf('%0.2f',$net_balance).' </b></td>
	<td></td>
  </tr></table>';
  
  $html=$html77.$html7.$html8.$html9.$html11;
	 
	 
	 
	 require_once('administrator/tcpdf_min/tcpdf.php');
		//tcpdf();
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Invoices-".convertDateToMySQL($stdate).'-To-'.convertDateToMySQL($enddate);
		$obj_pdf->SetTitle($title);
		$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		//ob_start();
		$obj_pdf->writeHTML($html, true, false, true, false, '');
		ob_end_clean();
		$obj_pdf->Output($title.'.pdf', 'D');
	 echo 'pdf'; exit;
	 } 
 } 
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
	$db->close();
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("stdate",$stdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("reqstatus",$reqstatus);
	$smarty->assign("post",$_REQUEST);
	$smarty->assign("foot",$foot);
	$smarty->assign("Requests",$Requests);
	$smarty->assign("pg",'mytrips');			
    $smarty->display('invoice_report.tpl');	
?>