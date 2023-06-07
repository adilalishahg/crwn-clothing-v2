<?php
   	include_once('../DBAccess/Database.inc.php');
	//ini_set('memory_limit', '-1');
	ini_set('memory_limit', '500M');
	ini_set('max_execution_time', 1000); //300 seconds = 5 minutes
	$db = new Database;	
    $msgs = '';
	$noRec = '';
    $error = '';
	$html='';
	$html9='';
	$html8='';
	$html7=''; 	
	$msgs .= $_GET['msg'];
	$db->connect();
	$due_date = date("m-d-Y",strtotime("+10 day"));
	function vrates($vehtype,$account,$db){
			   $ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= ".$vehtype." AND clinic_id= ".$account." ";
					if($db->query($ratequery) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}
					if($r==''){ $ratequery55 = "SELECT * FROM ".vehtype." WHERE id= ".$vehtype;
					if($db->query($ratequery55) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}}
			  return $r;}	
	$net_balance=0;
	$whr=$whr1=$whr2 = '';
	$pname 			= sql_replace($_REQUEST['pname']);		 if($pname !=''){$whr .= " AND LTRIM(LOWER(tr.clientname)) = '".strtolower(trim($pname))."' ";}
	$picklocation   = sql_replace($_REQUEST['picklocation']);if($picklocation !=''){$whr .= " AND trim(picklocation)='".trim($picklocation)."' ";}	
	$droplocation   = sql_replace($_REQUEST['droplocation']);if($droplocation !=''){$whr .= " AND trim(droplocation)='".trim($droplocation)."' ";}
	//echo $whr;

 if(isset($_REQUEST['showreport'])){ // echo 'yes in showreport'; exit;
 		 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		  $code     = sql_replace($_REQUEST['code']);
		  if($code != ''){ $whrC1 = "  AND tr.ccodea='".$code."'"; $whrC2 = "  AND bl.ccode='".$code."'"; }	
		if($startdate == '' && $enddate == ''){
	   	$error .= "Start and End date Fields are mandatory!<br>";
	  	}else{   
          if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
		   if($hospname !=  '')
	      { $whr1=" AND tr.account='".$hospname."' ";
		  	$whr2=" AND ac.id='".$hospname."' ";
		  //$error .= "Please select Account !<br>"; 
		  }
       }	
 if(!$error){
  $QGen= "SELECT * FROM ".TBL_FORMS." as tr WHERE tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr1 AND tr.invoice_gen='0' $whrC1 ";
  /* $queryGen = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr
LEFT JOIN accounts as ac on tr.account=ac.id
LEFT JOIN vehtype as vt on tr.vehtype = vt.id WHERE 1 $whr1 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND tr.invoice_gen='0' ORDER BY tr.appdate";*/
		if($db->query($QGen) && $db->get_num_rows() > 0)
		{$tdata = $db->fetch_all_assoc(); 
		for($i=0; $i<sizeof($tdata); $i++){invoice_generation($tdata[$i]['id'],$db);	}
		}	
		//	print_r($tdata); exit; 

$Qinvoicesdata = "SELECT tr.*,ac.account_name,ac.freemiles as acfreemiles,vt.vehtype,tr.vehtype as vid FROM ".TBL_FORMS." as tr,accounts as ac, vehtype as vt WHERE ac.id=tr.account AND tr.vehtype = vt.id  AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr2 $whr ORDER BY tr.appdate";

$Qinvoicesdata2 = "SELECT ac.account_name, bl.*,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,TRIM(tr.clientname) as clientname,tr.appdate, tr.apptime,tr.returnpickup,tr.id as tid,tr.account,td.modiv_id FROM billing_info as bl 
 left join ".TBL_FORMS." as tr on bl.trip_id=tr.id
 left join ".accounts." as ac on tr.account=ac.id
 left join trip_details as td on bl.tdid=td.tdid
  WHERE tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr1 $whr $whrC2 AND bl.cancel = '0' AND bl.status IN(1,4,6,7)  ORDER BY bl.id";
 if($db->query($Qinvoicesdata2) && $db->get_num_rows() > 0){ $invoicesdata = $db->fetch_all_assoc();
	//print_r($invoicesdata);
//debug($invoicesdata); exit;
//  echo 'this is the point.'; exit; 
$totalammount=0;
for($i=0;$i<sizeof($invoicesdata);$i++){
	if($invoicesdata[$i]['cancel']=='0'){	$totalammount=($totalammount+$invoicesdata[$i]['charges']);  }
	$invoicesdata[$i]['billablemile']	= chargeablemile($invoicesdata[$i]['miles'],$invoicesdata[$i]['freemiles']);
	$Q="SELECT vehtype FROM vehtype  
			WHERE id = '".$invoicesdata[$i]['vehtype']."' ";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }	 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				 $invoicesdata[$i]['vehicle'] 			= 	$ata['vehtype'];
  }  $invoicesdata = sort_array_multidim($invoicesdata, "appdate ASC, clientname ASC");} else {	$msgs .= 'No Records Found!';	}  // debug($invoicesdata); 
   //print_r($invoicesdata); 
 }}
 if(isset($_REQUEST['submit'])){
	 	 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		  $code     = sql_replace($_REQUEST['code']);
		  if($code != ''){ $whrC1 = "  AND tr.ccodea='".$code."'"; $whrC2 = "  AND bl.ccode='".$code."'"; }	
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
		     if($hospname !=  '')
	      { $whr1=" AND tr.account='".$hospname."' ";
		  	$whr2=" AND ac.id='".$hospname."' ";
			$whr3=" AND cr.clinic_id='".$hospname."' ";
		  //$error .= "Please select Account !<br>"; 
		  }
       }	
 if(!$error){
//	 $query = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id AND tr.account='".$hospname."' AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr ORDER BY tr.appdate";

	  $queryGen = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id $whr1 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND invoice_gen='0' $whrC1 ORDER BY tr.appdate";
		if($db->query($queryGen) && $db->get_num_rows() > 0)
		{$tdata = $db->fetch_all_assoc(); for($i=0; $i<sizeof($tdata); $i++){invoice_generation($tdata[$i]['id'],$db);	}		}
	 
$Qinvoicesdata2 = "SELECT ac.account_name, bl.*,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,TRIM(tr.clientname) as clientname,tr.appdate,tr.apptime,tr.returnpickup,tr.id as tid,tr.po,tr.legaid,tr.legbid,tr.dob,tr.claim_no FROM billing_info as bl 
left join ".TBL_FORMS." as tr on bl.trip_id=tr.id
left join ".accounts." as ac on tr.account=ac.id
 WHERE 1 $whr1 $whrC2  AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND bl.cancel = '0'  AND bl.status IN(1,4,6,7) ORDER BY bl.id";
 		if($db->query($Qinvoicesdata2) && $db->get_num_rows() > 0)
		{ 		$tdata = $db->fetch_all_assoc();
	if($hospname !=  ''){		 
	$ratequery = "SELECT cr.*,vt.vehtype FROM ".clinic_rates." as cr,vehtype as vt WHERE vt.id= cr.vehtype_id $whr3 ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$rates = $db->fetch_all_assoc();	} }
//debug($tdata); 
//End of rates retriving
$tdata = sort_array_multidim($tdata, "appdate ASC, clientname ASC");
for($i=0; $i<sizeof($tdata); $i++){
		if($tdata[$i]['cancel']=='0'){	$net_balance=($net_balance+$tdata[$i]['charges']);  }
	//$net_balance=$net_balance+$tdata[$i]['charges'];
	$tdata[$i]['billablemile']	= chargeablemile($tdata[$i]['miles'],$tdata[$i]['freemiles']);
	$Q="SELECT vehtype FROM vehtype  
			WHERE id = '".$tdata[$i]['vehtype']."' ";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }	 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				 $tdata[$i]['vehicle'] 			= 	$ata['vehtype'];
	//$vrates=vrates($tdata[$i]['vehtype'],$tdata[$i]['account'],$db);
	
	//print_r($vrates); exit;
/*	$fr_miles = $tdata[$i]['frmiles'];
		  if($tdata[$i]['custom_rates']=='1'){ 
		  $fr_miles = $tdata[$i]['freemiles']; 
		  $Qrates = "SELECT * FROM ".TBL_FORMS." WHERE id = '".$tdata[$i]['id']."'"; 
		  if($db->query($Qrates) && $db->get_num_rows() > 0){	$vrates = $db->fetch_one_assoc();	}
			  }*/
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
	// }else{	$html8.='<td>'.date('h:i A',strtotime($tdata[$i]['returnpickup'])).'</td>';}
	}else{	$html8.='<td>'.$tdata[$i]['returnpickup'].'</td>';}
	
	
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
<td align="center"><img src="../images/logo.png" alt="" style="max-height:70px; max-width:70px;"/></td>
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
/*<tr>
    <td  width="10%"><strong>Service Type</strong></td>
    <td  width="10%"><strong>Pickup Charges</strong></td>
    <td width="10%"><strong>Per Mile Charges</strong></td>
    <td width="10%"><strong>Wait Time Charges</strong></td>
    <td width="10%"><strong>No Show Fee</strong></td>
    <td width="10%"><strong>After Hours Fee</strong></td>
	<td width="10%"><strong>2 Man Team Charges</strong></td>
    <td width="10%"><strong>Bariatric Stretcher<br/>Charges</strong></td>
	<td width="10%"><strong>Oxygen Charges</strong></td>
    <td width="10%"><strong>Wheelchair Rental<br/>Charges</strong></td>
  </tr>*/
/*for($i=0;$i<sizeof($rates);$i++){

  $html7.='<tr>
    <td>   '.$rates[$i]['vehtype'].' </td>
	<td> $ '.$rates[$i]['pickup_ch'].' </td>
	<td> $ '.$rates[$i]['permile_ch'].' </td>
	<td> $ '.$rates[$i]['waittime_ch'].' </td>
	<td> $ '.$rates[$i]['noshow_ch'].' </td>
	<td> $ '.$rates[$i]['afterhour_ch'].' </td>
	<td> $ '.$rates[$i]['dstretcher_ch'].' </td>
	<td> $ '.$rates[$i]['bstretcher_ch'].' </td>
	<td> $ '.$rates[$i]['oxygen_ch'].' </td>
	<td> $ '.$rates[$i]['doublewheel_ch'].' </td>
  </tr>';
}*/

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
  
  $html=$html77.$html7.$html8.$html9.$html11; //sleep(10);
 // echo $html; exit;
//End of pdf html

	require_once('../tcpdf_min/tcpdf.php');
		//tcpdf();
		$obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Invoices";
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
		$obj_pdf->Output('output.pdf', 'D');
	  } else {	$msgs .= 'No Records Found!';}
  		  }}
 if(isset($_REQUEST['submit2'])){
	 	 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		 $code     = sql_replace($_REQUEST['code']);
		 if($code != ''){ $whrC1 = "  AND tr.ccodea='".$code."'"; $whrC2 = "  AND bl.ccode='".$code."'"; }	
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
		     if($hospname !=  '')
	      { $whr1=" AND tr.account='".$hospname."' ";
		  	$whr2=" AND ac.id='".$hospname."' ";
			$whr3=" AND cr.clinic_id='".$hospname."' ";
		  //$error .= "Please select Account !<br>"; 
		  }
       }	
 if(!$error){
//	 $query = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id AND tr.account='".$hospname."' AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr ORDER BY tr.appdate";

  $queryGen = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id $whr1 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND invoice_gen='0' $whrC1 ORDER BY tr.appdate";
		if($db->query($queryGen) && $db->get_num_rows() > 0)
		{$tdata = $db->fetch_all_assoc(); for($i=0; $i<sizeof($tdata); $i++){invoice_generation($tdata[$i]['id'],$db);	}		}
		
	 $Qinvoicesdata2 = "SELECT ac.account_name, bl.*,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,TRIM(tr.clientname) as clientname,tr.appdate,tr.apptime,tr.returnpickup,tr.id as tid,tr.po,tr.legaid,tr.legbid,tr.dob,tr.claim_no FROM billing_info as bl 
	 left join ".TBL_FORMS." as tr on bl.trip_id=tr.id
	 left join ".accounts." as ac on tr.account=ac.id
	  WHERE 1 $whr1 $whrC2 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND bl.cancel = '0'  AND bl.status IN(1,4,6,7) ORDER BY bl.id";
 		if($db->query($Qinvoicesdata2) && $db->get_num_rows() > 0)
		{ 		$tdata = $db->fetch_all_assoc();
			/*for($i=0; $i<sizeof($tdata); $i++){
				invoice_calculation($tdata[$i]['id']);
				}*/
		//if($db->query($query) && $db->get_num_rows() > 0) $tdata = $db->fetch_all_assoc();
	if($hospname !=  ''){		
	$ratequery = "SELECT cr.*,vt.vehtype FROM ".clinic_rates." as cr,vehtype as vt WHERE vt.id= cr.vehtype_id $whr3 ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$rates = $db->fetch_all_assoc();	} }
	$tdata = sort_array_multidim($tdata, "appdate ASC, clientname ASC");
//End of rates retriving
for($i=0; $i<sizeof($tdata); $i++){
	if($tdata[$i]['cancel']=='0'){	$net_balance=($net_balance+$tdata[$i]['charges']);  }//$net_balance=$net_balance+$tdata[$i]['charges'];
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
			}}
	
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
$html9.='</table>
    </td></tr>
</table>';
$html77.='
<style type="text/css">
 .bg_col {  background-color:#ffe5d8; !important;
 background-image: none !important;
}
   #printable { display: block; }
    @media print
    {
      #non-printable { display: none; }
      .printable { display: block; }
    }
    </style>
<table width="795" border="0" cellspacing="0" cellpadding="0" id="non-printable">
      <tr>
        <td width="572"><span style="color:#F00; font-size:12px;" ></span>
        </td>
        <td width="26" align="center" valign="middle"></td>
       <td width="27" align="left" valign="middle"><a href="javascript:window.print();"><img src="../images/print.gif" width="16" height="16" border="0" /></a></td>
      </tr>
    </table>	
<table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:7px;" class="non-printable">
<tr>
<td align="center"><img src="../images/logo.png" alt="" style="max-height:70px; max-width:70px;"/></td>
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
    <table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:9px;"  class="non-printable">
	<tr>
   <td colspan="10" height="20"></td>
  	</tr>
  <tr>
    <td  width="10%"><strong>Service Type</strong></td>
    <td  width="10%"><strong>Pickup Charges</strong></td>
    <td width="10%"><strong>Per Mile Charges</strong></td>
    <td width="10%"><strong>Wait Time Charges</strong></td>
    <td width="10%"><strong>No Show Fee</strong></td>
    <td width="10%"><strong>After Hours Fee</strong></td>
	<td width="10%"><strong>2 Man Team Charges</strong></td>
    <td width="10%"><strong>Bariatric Stretcher<br/>Charges</strong></td>
	<td width="10%"><strong>Oxygen Charges</strong></td>
    <td width="10%"><strong>Wheelchair Rental<br/>Charges</strong></td>
  </tr>
  <tr>
    <td colspan="10" height="20"></td>
  </tr>';

for($i=0;$i<sizeof($rates);$i++){

  $html7.='<tr>
    <td>   '.$rates[$i]['vehtype'].' </td>
	<td> $ '.$rates[$i]['pickup_ch'].' </td>
	<td> $ '.$rates[$i]['permile_ch'].' </td>
	<td> $ '.$rates[$i]['waittime_ch'].' </td>
	<td> $ '.$rates[$i]['noshow_ch'].' </td>
	<td> $ '.$rates[$i]['afterhour_ch'].' </td>
	<td> $ '.$rates[$i]['dstretcher_ch'].' </td>
	<td> $ '.$rates[$i]['bstretcher_ch'].' </td>
	<td> $ '.$rates[$i]['oxygen_ch'].' </td>
	<td> $ '.$rates[$i]['doublewheel_ch'].' </td>
  </tr>';
}

  $html7.='<tr>
     <td colspan="10" height="20"></td>
  </tr>
 
  <tr>
 
    <td colspan="4">Invoice From: '.date('M, d Y',strtotime($startdate)).' To: '.date('M, d Y',strtotime($enddate)).' </td>
	<td colspan="3">Invoice Generated on: '.date('M, d Y').'</td>
    <td colspan="4">Total Amount Billed: $ '.sprintf('%0.2f',$net_balance).' </td>


  </tr>
  <tr>
   <td colspan="10" height="20"></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="3">
    <table width="100%" border="1" style="font-family:Verdana, Geneva, sans-serif; font-size:8px;" class="non-printable">
  <tr  style="background-color:#0FF;">
    <td align="center" width="2%">S.No</td>
	<td align="center" width="2%">Invoice#</td>
    <td align="center" width="7%">Date<br/>Account Name</td>
    <td align="center" width="9%">Customer Name</td>';
	if($hospname !=  ''){
	if(strtolower($tdata[0]['account_name'])=='mercy care' || strtolower($tdata[0]['account_name'])=='mercycare' ){$html7.='<td align="center" width="5%">DOB</td>';}}	
	$html7.='<td align="center" width="5%">PO#/Claim#</td>
	<td align="center" width="5%">Leg</td>
	<td align="center" width="13%">Pick Up Address</td>
	<td align="center" width="13%">Delivery Address</td>
	<td align="center" width="5%">Time</td>
	<td align="center" width="9%">Vehicle Service</td>
    <td align="center" width="10%">Miles</td>
    <td align="center" width="14%">Out of Area / Misc Fee</td>
    <td align="center" width="5%">Total Cost </td>
  </tr>';
  $html=$html77.$html7.$html8.$html9; //sleep(10);
  echo $html; exit;
//End of pdf html
	  } else {	$msgs .= 'No Records Found!';}
  		  }}
 if(isset($_REQUEST['csv']) ){ 
		
		$csv_str="";
		$csv_body="";
		$body="";
		 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		 $code     = sql_replace($_REQUEST['code']);
		 if($code != ''){ $whrC1 = "  AND tr.ccodea='".$code."'"; $whrC2 = "  AND bl.ccode='".$code."'"; }	
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')	{ $error .= " End Date Missing !<br>"; }
          if($startdate ==  '' && $enddate != '')  { $error .= " Start Date Missing !<br>"; }
		    if($hospname !=  '')
	      { $whr1=" AND tr.account='".$hospname."' ";
		  	$whr2=" AND ac.id='".$hospname."' ";
			$whr3=" AND cr.clinic_id='".$hospname."' ";
		  //$error .= "Please select Account !<br>"; 
		  }
       }	
 if(!$error){ //echo 'In'; exit;
//	 $query = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id AND tr.account='".$hospname."' AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr ORDER BY tr.appdate";

	  $queryGen = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id $whr1 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND invoice_gen='0' $whrC1 ORDER BY tr.appdate";
		if($db->query($queryGen) && $db->get_num_rows() > 0)
		{$tdata = $db->fetch_all_assoc(); for($i=0; $i<sizeof($tdata); $i++){invoice_generation($tdata[$i]['id'],$db);	}		}
		
	 $Qinvoicesdata2 = "SELECT ac.account_name, bl.*,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,TRIM(tr.clientname) as clientname,tr.appdate,tr.apptime,tr.returnpickup,tr.id as tid,tr.po,tr.legaid,tr.legbid,tr.dob,tr.claim_no FROM billing_info as bl 
	 left join ".TBL_FORMS." as tr on bl.trip_id=tr.id
	 left join ".accounts." as ac on tr.account=ac.id
	  WHERE 1 $whr1 $whrC2 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND bl.cancel = '0'  AND bl.status IN(1,4,6,7) ORDER BY bl.id";
 		if($db->query($Qinvoicesdata2) && $db->get_num_rows() > 0)
		{ 		$tdata = $db->fetch_all_assoc();
		
		$header="Sr. No,Invoice #,Date [Account Name],Customer Name";
		if($hospname !=  ''){
		if(strtolower($tdata[0]['account_name'])=='mercy care' || strtolower($tdata[0]['account_name'])=='mercycare' ){$header.=",DOB";}
		}
		$header.=",PO#/Claim#,Leg,Pick Up Address,Delivery Address,Time,Vehicle Service,Total Miles,Free Miles,Billable Miles,Out of Area - Misc Fee,Total \n";	
			
			
			
		if($hospname !=  ''){	
		$ratequery = "SELECT cr.*,vt.vehtype FROM ".clinic_rates." as cr,vehtype as vt WHERE vt.id= cr.vehtype_id $whr3 ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$rates = $db->fetch_all_assoc();	} }
	$tdata = sort_array_multidim($tdata, "appdate ASC, clientname ASC");		  
	for($i=0; $i<sizeof($tdata); $i++){
	if($tdata[$i]['cancel']=='0'){	$net_balance=($net_balance+$tdata[$i]['charges']);  }//$net_balance=$net_balance+$tdata[$i]['charges'];
	$tdata[$i]['billablemile']	= chargeablemile($tdata[$i]['miles'],$tdata[$i]['freemiles']);
	$Q="SELECT vehtype FROM vehtype  
			WHERE id = '".$tdata[$i]['vehtype']."' ";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }	 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				 $tdata[$i]['vehicle'] 			= 	$ata['vehtype'];
				 
	/*$html10='';
	if($tdata[$i]['miscellaneous_charges'] >0){$html10.='Misc. Charges: '.$tdata[$i]['miscellaneous_charges'].'  ';}
	if($tdata[$i]['dstretcher'] =='Yes'){$html10.='2 Man Team Charges: '.$vrates['dstretcher_ch'].'  ';}
	if($tdata[$i]['oxygen'] =='Yes'){$html10.='Oxygen. Charges: '.$vrates['oxygen_ch'].'  ';}
	if($tdata[$i]['bar_stretcher'] =='Yes'){$html10.='Bariatric Stretcher Charges: '.$vrates['bstretcher_ch'].'  ';}
	if($tdata[$i]['dwchair'] =='Yes'){$html10.='Wheel Chair Rental Charges: '.$vrates['doublewheel_ch'].'  ';}
	if($tdata[$i]['after_hours']=='1'){$html10.='After Hour Charges: '.$vrates['afterhour_ch'].' ';}
	if($tdata[$i]['noshow']=='1'){$html10.='No Show Charges: '.$vrates['noshow_ch'].' ';}
	if($tdata[$i]['wait_time']!='00:00:00'){
		 $wait_time = $tdata[$i]['wait_time'];
		  sscanf($wait_time, "%d:%d:%d", $hours, $minutes, $seconds);
		  $time_seconds =  $hours * 3600 + $minutes * 60 + $seconds;
		  $extra_time 	= ($time_seconds - (30*60));
		  if($extra_time > 60){
		  $times_units	=	(int)($extra_time)/(30*60); 
		  $wait_time_charges = $times_units * $vrates['waittime_ch']; }
		  $html10.='Wait Time Charges: '.$wait_time_charges.' ';}*/
		  
	$html10='';
	if($tdata[$i]['miscellaneous_charges'] >0){$html10.='Misc. Charges: '.$tdata[$i]['miscellaneous_charges'].'  ';}
	if($tdata[$i]['dstretcher'] =='Yes'){$html10.='2 Man Team Charges: '.$tdata[$i]['dstretcher_rate'].'  ';}
	if($tdata[$i]['oxygen'] =='Yes'){$html10.='Oxygen. Charges: '.$tdata[$i]['oxygen_rate'].'  ';}
	if($tdata[$i]['bstretcher'] =='Yes'){$html10.='Bariatric Stretcher Charges: '.$tdata[$i]['bstretcher_rate'].'  ';}
	if($tdata[$i]['doublewheel'] =='Yes'){$html10.='Wheel Chair Rental Charges: '.$tdata[$i]['doublewheel_rate'].'  ';}
	if($tdata[$i]['after_hours']=='1'){$html10.='After Hour Charges: '.$tdata[$i]['afterhour_rate'].'   ';}
	if($tdata[$i]['noshow']=='1'){$html10.='No Show Charges: '.$tdata[$i]['noshow_rate'].'   ';}
	if($tdata[$i]['waittime_unit']!='0'){$html10.='Wait Time Charges: '.$tdata[$i]['waittime_rate'].'   ';}	
	
	if($tdata[$i]['unloaded_miles_ch']!='0'){$html10.='Un.M Charges['.$tdata[$i]['unloaded_miles'].']: '.$tdata[$i]['unloaded_miles_ch'].'   ';}
	  
	$html11 = $tdata[$i]['miles'].','.$tdata[$i]['freemiles'].','.$tdata[$i]['billablemile'];
	$array = array("~", "\n","\n\r","<br/>","<br>",",","\r");	
if($tdata[$i]['leg']=='1'){
	$html33='Leg A'; 
	}else{	$html33='Leg B';}
	if($tdata[$i]['leg']=='1'){
	$legid=$tdata[$i]['legaid'];	
	$html34=$tdata[$i]['pickaddr'];
	$html35=$tdata[$i]['destination']; 
	}else{	
	$legid=$tdata[$i]['legbid'];
	$html34=$tdata[$i]['destination'];
	$html35=$tdata[$i]['backto'];}
	if($tdata[$i]['leg']=='1'){
	// $html36=date('h:i A',strtotime($tdata[$i]['apptime'])); 
	$html36=$tdata[$i]['apptime']; 
	}else{	$html36=$tdata[$i]['returnpickup'];}
			$csv_str = ($i+1).','.$tdata[$i]['tid'].','.date("M-d Y",strtotime($tdata[$i]['appdate'])).'['.$tdata[$i]['account_name'].'],'.str_replace($array,'-',$tdata[$i]['clientname']).',';
			
			if($hospname !=  ''){
			if(strtolower($tdata[0]['account_name'])=='mercy care' || strtolower($tdata[0]['account_name'])=='mercycare' ){
			if($tdata[$i]['dob'] !='0000-00-00'){
			$csv_str .= date("m-d-Y",strtotime($tdata[$i]['dob'])); } $csv_str .=',';
			} }			
			$chrg=sprintf('%0.2f',$tdata[$i]['charges']);
			$csv_str .= str_replace($array,'-',$tdata[$i]['po']).' '.$legid.' '.$tdata[$i]['claim_no'].','.str_replace($array,'-',$html33).','.str_replace($array,'-',$html34).','.str_replace($array,'-',$html35).','.$html36.','.$tdata[$i]['vehicle'].' - Pickup Charges: '.$tdata[$i]['pickup_ch'].' - Price Per Miles: '.$tdata[$i]['permile_ch'].','.$tdata[$i]['miles'].','.$tdata[$i]['freemiles'].','.$tdata[$i]['billablemile'].','.str_replace($array,'-',$html10).','.$chrg;  
			$csv_body = $csv_body.$csv_str."~ ";
		} } 
		$firstline = ",,,Invoice Generated On: ".date('M. d Y')."\n,,,Invoice From: ".date('M. d Y',strtotime($startdate))." To: ".date('M. d Y',strtotime($enddate))."\n,,,Total Amount Billed: ".sprintf('%0.2f',$net_balance)."~";
			
			 $body=substr($firstline.$csv_body,0,-1); 
			if($body)
			{
			$files = glob('csv/*'); // get all files path
			foreach($files as $file){ // iterate files
				if(is_file($file))
				unlink($file); // delete file
			}
			$filename = "Invoices_".time().".csv";
			$body_arr=explode("~",$body);
			ob_end_clean();
			$fp=@fopen('csv/'.$filename,"w");
			$write=fputs($fp,$header,strlen($header));
			foreach($body_arr as $c)
			{
				$c.="\n";
				$write=fputs($fp,$c,strlen($c));
			}
			fclose($fp);
			$file_path = $filename; 
			$mm_type="application/octet-stream";
			$fullpath= 'csv/'.$filename;
			header("Cache-Control: public, must-revalidate");
			header("Pragma: hack");
			header("Content-Type: " . $mm_type);
			header("Content-Length: " .(string)(filesize($fullpath)) );
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary\n");
			readfile($fullpath);
		}
	}		  }
 if(isset($_REQUEST['generate']) ){ //echo 'IN'; exit;
		 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		  $code     = sql_replace($_REQUEST['code']);
		  if($code != ''){ $whrC1 = "  AND tr.ccodea='".$code."'"; $whrC2 = "  AND bl.ccode='".$code."'"; }	
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')	{ $error .= " End Date Missing !<br>"; }
          if($startdate ==  '' && $enddate != '')  { $error .= " Start Date Missing !<br>"; }
		  if($hospname !=  '')
	      { $whr1=" AND tr.account='".$hospname."' ";
		  	$whr2=" AND ac.id='".$hospname."' ";
			$whr3=" AND cr.clinic_id='".$hospname."' ";
		  //$error .= "Please select Account !<br>"; 
		  }
       }	
 if(!$error){ //echo 'In'; exit;
	 $queryGen = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id $whr1 AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND invoice_gen='0' ORDER BY tr.appdate";
		if($db->query($queryGen) && $db->get_num_rows() > 0)
		{ 		$tdata = $db->fetch_all_assoc();
			for($i=0; $i<sizeof($tdata); $i++){
				invoice_generation($tdata[$i]['id'],$db);
				}
				echo '<script>alert("Invoices Generated Successfully.");</script>';
	}	}}
 $Queryhosp1 = "SELECT id,account_name FROM ".accounts." ORDER BY `account_name` ASC";
   if($db->query($Queryhosp1) && $db->get_num_rows() > 0)
	{	   $hosp = $db->fetch_all_assoc();     }
  $Qp = "SELECT DISTINCT(picklocation) FROM ". request_info." WHERE picklocation!='' ORDER BY `picklocation` ASC";
   if($db->query($Qp) && $db->get_num_rows() > 0)	{	$picklocations = $db->fetch_all_assoc();    }
   $Qd = "SELECT DISTINCT(droplocation) FROM ". request_info." WHERE droplocation!='' ORDER BY `droplocation` ASC";
   if($db->query($Qd) && $db->get_num_rows() > 0)	{	$droplocations = $db->fetch_all_assoc();    } 
  $Qccode = "SELECT * FROM ".companycodes." WHERE 1=1  ORDER BY `company` ASC";
   if($db->query($Qccode) && $db->get_num_rows() > 0)
	{	   $ccode = $db->fetch_all_assoc();    }	 
	$db->close();
    $pgTitle = "Admin Panel -- Invoices";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign("hosp",$hosp);		
	$smarty->assign('startdate',$startdate);	
	$smarty->assign("enddate",$enddate);		
	$smarty->assign("hospname",$hospname);
	$smarty->assign("pname",$pname);
	$smarty->assign("picklocation",$picklocation);
	$smarty->assign("droplocation",$droplocation);
	$smarty->assign("picklocations",$picklocations);
	$smarty->assign("droplocations",$droplocations);
	$smarty->assign("invoicesdata",$invoicesdata);	
	$smarty->assign("totalammount",$totalammount);	
	$smarty->assign("ccode",$ccode);
	$smarty->assign("code",$code);		
	$smarty->display('reportstpl/invoices.tpl');
?>