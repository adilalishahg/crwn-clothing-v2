<?php
   	include_once('../DBAccess/Database.inc.php');
	ini_set('memory_limit', '-1');
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
	$whr = '';
	$pname 			= sql_replace($_REQUEST['pname']);			if($pname !=''){$whr .= " AND trim(tr.clientname) = '".trim($pname)."' ";}
	$picklocation   = sql_replace($_REQUEST['picklocation']);	if($picklocation !=''){$whr .= " AND trim(picklocation)='".trim($picklocation)."' ";}	
	$droplocation   = sql_replace($_REQUEST['droplocation']);	if($droplocation !=''){$whr .= " AND trim(droplocation)='".trim($droplocation)."' ";}
	//echo $whr;

 if(isset($_REQUEST['showreport'])){ //echo 'yes in showreport'; exit;
 
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
		if($startdate == '' && $enddate == ''){
	   	$error .= "Start and End date Fields are mandatory!<br>";
	  	}else{   
          if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
		   if($hospname ==  '')
	      { $error .= "Please select Account !<br>"; }
       }	
 if(!$error){
$Qinvoicesdata = "SELECT tr.*,ac.account_name,vt.vehtype FROM ".TBL_FORMS." as tr,accounts as ac, vehtype as vt WHERE ac.id=tr.account AND tr.vehtype = vt.id AND ac.id='".$hospname."' AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr ORDER BY tr.appdate"; if($db->query($Qinvoicesdata) && $db->get_num_rows() > 0){ $invoicesdata = $db->fetch_all_assoc();

}

 } else {	$msgs .= 'No Records Found!';	}
  		  }
 if(isset($_REQUEST['submit'])){
	 	 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
		   if($hospname ==  '')
	      { $error .= "Please select Hospital !<br>"; }
       }	
 if(!$error){
	 $query = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id AND tr.account='".$hospname."' AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr ORDER BY tr.appdate";
		if($db->query($query) && $db->get_num_rows() > 0)
		{ 		$tdata = $db->fetch_all_assoc();
			for($i=0; $i<sizeof($tdata); $i++){
				invoice_calculation($tdata[$i]['id']);
				}
		if($db->query($query) && $db->get_num_rows() > 0) $tdata = $db->fetch_all_assoc();
		$ratequery = "SELECT cr.*,vt.vehtype FROM ".clinic_rates." as cr,vehtype as vt WHERE vt.id= cr.vehtype_id AND cr.clinic_id= ".$hospname." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$rates = $db->fetch_all_assoc();	}

//End of rates retriving
for($i=0; $i<sizeof($tdata); $i++){
	$net_balance=$net_balance+$tdata[$i]['charges'];
	$vrates=vrates($tdata[$i]['vehtype'],$tdata[$i]['account'],$db);
	//print_r($vrates); exit;
  $html8.='<tr>
    <td>'.($i+1).'</td>
	<td>'.date("M, d Y",strtotime($tdata[$i]['appdate'])).'</td> 
    <td>'.$tdata[$i]['clientname'].'</td>
	<td>'.$tdata[$i]['account_name'].'</td>
	<td>'.$tdata[$i]['pickaddr'].'</td>
	<td>'.$tdata[$i]['destination'].'</td>
	<td>'.$tdata[$i]['apptime'].'</td>
	<td>';
	$fr_miles = $tdata[$i]['frmiles'];
	if($tdata[$i]['custom_rates']=='1'){ $fr_miles = $tdata[$i]['freemiles'];}
	$html10='';
	if($tdata[$i]['miscellaneous_charges'] >0){$html10.='Misc. Charges: '.$tdata[$i]['miscellaneous_charges'].'<br/>';}
	if($tdata[$i]['dstretcher'] =='Yes'){$html10.='2 Man Team Charges: '.$vrates['dstretcher_ch'].'<br/>';}
	if($tdata[$i]['oxygen'] =='Yes'){$html10.='Oxygen. Charges: '.$vrates['oxygen_ch'].'<br/>';}
	if($tdata[$i]['bar_stretcher'] =='Yes'){$html10.='Bariatric Stretcher Charges: '.$vrates['bstretcher_ch'].'<br/>';}
	if($tdata[$i]['dwchair'] =='Yes'){$html10.='Wheel Chair Rental Charges: '.$vrates['doublewheel_ch'].'<br/>';}
	$html8.=$html10.'</td>
    <td>Total Miles = '.$tdata[$i]['milage'].'<br/>Free Miles = '.$fr_miles.'<br/>Bilable Miles = '.($tdata[$i]['milage']-$fr_miles).' </td>
    <td>'.$tdata[$i]['vehtypes'].'</td>
    <td> $ '.$tdata[$i]['charges'].'</td>
  </tr>';
	}
 $query2 = "SELECT * FROM contact_info WHERE c_id = '1' ";
 if($db->query($query2) && $db->get_num_rows()>0){$cdata = $db->fetch_one_assoc(); }	

$html9.='</table>
    </td></tr>
</table>';

$html77.='<table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:7px;">
<tr>
<td align="center"><img src="../images/logo.png" alt="" width="120" height:"100" /></td>
<td align="center">INVOICE<br/ >
'.$cdata['title'].'.<br/ >
'.$cdata['address'].'<br/ >
'.$cdata['city'].', '.$cdata['state'].' '.$cdata['zip'].'<br/ >
'.$cdata['phone'].'<br/ >
'.$cdata['url'].'</td>
 <td align="center">
        <span style="font-weight:bold; text-decoration:underline;">Billing Information</span><br>
        <strong>Account Name:</strong> '.$tdata[0]['account_name'].'<br/>
        <strong>Billing address:</strong> '.$tdata[0]['address'].', <br/>'.$tdata[0]['city'].', '.$tdata[0]['state'].' '.$tdata[0]['zip'].' 
 </td>
  </tr>';
  
  $html7.='<tr>
    <td colspan="3">
    <table width="100%" border="0">
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
  	<td></td>
    <td colspan="3">Invoice From: '.date('M, d Y',strtotime($startdate)).' To: '.date('M, d Y',strtotime($enddate)).' </td>
	<td colspan="2">Invoic Generated on: '.date('M, d Y').'</td>
    <td>Total Amount Billed: </td>
    <td>$ '.$net_balance.' </td>
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
    <td align="center" width="2%">#</td>
    <td align="center" width="7%">Date</td>
    <td align="center" width="9%">Customer Name</td>
	<td align="center" width="10%">Account</td>
	<td align="center" width="13%">Pick Up Address</td>
	<td align="center" width="13%">Delivery Address</td>
	<td align="center" width="5%">Time</td>
	<td align="center" width="14%">Out of Area / Misc Fee</td>
    <td align="center" width="10%">Miles</td>
    <td align="center" width="9%">Vehicle Service</td>
    <td align="center" width="5%">Total Cost </td>
  </tr>';
  $html=$html77.$html7.$html8.$html9;
 // echo $html; exit;
//End of pdf html
	//echo $html; exit;
		require_once('../grid/inc/tcpdf/config/lang/eng.php');
		require_once('../grid/inc/tcpdf/tcpdf.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);	
		$pdf->setPageOrientation ('L', $autopagebreak='', $bottommargin='');	
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Transportation');
		$pdf->SetTitle('HITS');
		$pdf->SetSubject('PDF Invoice');
		$pdf->SetKeywords('HITS, PDF');
		$pdf->SetFont('helvetica', '', 9);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT, true);
		//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->SetMargins( 36, 36, 36, true );
		$pdf->SetAutoPageBreak( true, 36 );
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);		
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_clean();
		$pdf->Output('invoice.pdf', 'D');	
 } else {	$msgs .= 'No Records Found!';}
  		  }}
		   if(isset($_REQUEST['csv']) ){ //echo 'IN'; exit;
		$header="Sr. No,Date,Customer Name,Account,Pick Up Address,Delivery Address,Time,Out of Area - Misc Fee,Miles,Vehicle Service,Total \n";
		$csv_str="";
		$csv_body="";
		$body="";
		 include_once('../requests/invoice_calculation_function.php');	
	     $startdate = sql_replace($_REQUEST['startdate']);
		 $enddate   = sql_replace($_REQUEST['enddate']);
		 $hospname   = sql_replace($_REQUEST['hospname']);
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
          if($startdate !=  '' && $enddate == '')	{ $error .= " End Date Missing !<br>"; }
          if($startdate ==  '' && $enddate != '')  { $error .= " Start Date Missing !<br>"; }
		  if($hospname ==  '') { $error .= "Please select Hospital !<br>"; }
       }	
 if(!$error){ //echo 'In'; exit;
	 $query = "SELECT ac.account_name,vt.vehtype as vehtypes,ac.address,ac.city,ac.state,ac.zip,ac.freemiles as frmiles,tr.* FROM ".TBL_FORMS." as tr, accounts as ac, vehtype as vt WHERE  tr.vehtype = vt.id AND tr.account=ac.id AND tr.account='".$hospname."' AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr ORDER BY tr.appdate";
		if($db->query($query) && $db->get_num_rows() > 0)
		{ 		$tdata = $db->fetch_all_assoc();
			for($i=0; $i<sizeof($tdata); $i++){
				invoice_calculation($tdata[$i]['id']);
				}
		if($db->query($query) && $db->get_num_rows() > 0) $tdata = $db->fetch_all_assoc();
		$ratequery = "SELECT cr.*,vt.vehtype FROM ".clinic_rates." as cr,vehtype as vt WHERE vt.id= cr.vehtype_id AND cr.clinic_id= ".$hospname." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$rates = $db->fetch_all_assoc();	}
			  
	for($i=0; $i<sizeof($tdata); $i++){
	$net_balance=$net_balance+$tdata[$i]['charges'];
	$vrates=vrates($tdata[$i]['vehtype'],$tdata[$i]['account'],$db);
	$fr_miles = $tdata[$i]['frmiles'];
	if($tdata[$i]['custom_rates']=='1'){ $fr_miles = $tdata[$i]['freemiles'];}
	$html10='';
	if($tdata[$i]['miscellaneous_charges'] >0){$html10.='Misc. Charges: '.$tdata[$i]['miscellaneous_charges'].'  ';}
	if($tdata[$i]['dstretcher'] =='Yes'){$html10.='2 Man Team Charges: '.$vrates['dstretcher_ch'].'  ';}
	if($tdata[$i]['oxygen'] =='Yes'){$html10.='Oxygen. Charges: '.$vrates['oxygen_ch'].'  ';}
	if($tdata[$i]['bar_stretcher'] =='Yes'){$html10.='Bariatric Stretcher Charges: '.$vrates['bstretcher_ch'].'  ';}
	if($tdata[$i]['dwchair'] =='Yes'){$html10.='Wheel Chair Rental Charges: '.$vrates['doublewheel_ch'].'  ';}
	$html11 = 'Total Miles = '.$tdata[$i]['milage'].'  Free Miles = '.$fr_miles.'  Bilable Miles = '.($tdata[$i]['milage']-$fr_miles);
$array = array("~", "\n","\n\r","<br/>","<br>",",","\r");	

			$csv_str = ($i+1).','.date("M-d Y",strtotime($tdata[$i]['appdate'])).','.str_replace($array,'-',$tdata[$i]['clientname']).','.str_replace($array,'-',$tdata[$i]['account_name']).','.str_replace($array,'-',$tdata[$i]['pickaddr']).','.str_replace($array,'-',$tdata[$i]['destination']).','.$tdata[$i]['apptime'].','.str_replace($array,'-',$html10).','.str_replace($array,'-',$html11).','.$tdata[$i]['vehtypes'].','.$tdata[$i]['charges'];  
			$csv_body = $csv_body.$csv_str."~ ";
		} } }
			
			 $body=substr($csv_body,0,-1); 
			if($body)
			{
			$files = glob('cvs/*'); // get all files path
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
			//print_r($body_arr); exit;
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
	}		  
 $Queryhosp1 = "SELECT id,account_name FROM ".accounts." ORDER BY `account_name` ASC";
   if($db->query($Queryhosp1) && $db->get_num_rows() > 0)
	{	   $hosp = $db->fetch_all_assoc();     }
  $Qp = "SELECT DISTINCT(picklocation) FROM ". request_info." WHERE picklocation!='' ORDER BY `picklocation` ASC";
   if($db->query($Qp) && $db->get_num_rows() > 0)	{	$picklocations = $db->fetch_all_assoc();    }
   $Qd = "SELECT DISTINCT(droplocation) FROM ". request_info." WHERE droplocation!='' ORDER BY `droplocation` ASC";
   if($db->query($Qd) && $db->get_num_rows() > 0)	{	$droplocations = $db->fetch_all_assoc();    } 
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
	$smarty->display('reportstpl/invoices.tpl');
?>