<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/graphs.inc.php');
	

	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
    $error = '';	
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
	$db->connect();
	$db2->connect();
    $usersid = array();
	/*************** Paging ************** */
	if(!empty($_GET['Page']))
	{ $page = $_GET['Page']; }
	else
	{ $page = 1; }
	$limit = 200;
	$offset = (($page * $limit) - $limit);
	$maxRecord = 200; 
    $st = 'approved';

 if(isset($_POST['showpay']) || isset($_POST['payonce'])|| !empty($_GET['Page'])){
	  		 include_once('../requests/invoice_calculation_function.php');	
	   	//echo '<pre>'; print_r($_POST); //exit; 
	     $startdate 	= sql_replace($_REQUEST['startdate']);
		 $enddate   	= sql_replace($_REQUEST['enddate']);
		 $hospname   	= sql_replace($_REQUEST['hospname']);
		 $payment_status= sql_replace($_REQUEST['payment_status']);
		 $request_status= sql_replace($_REQUEST['request_status']);
		 $pname     	= sql_replace($_REQUEST['pname']);
		 $reclaim     	= sql_replace($_REQUEST['reclaim']);
		 $hic			= sql_replace($_REQUEST['hic']);
	if(isset($_POST['payonce']) && $_POST['payonce'] != '' && $request_status =='approved' ){
			 $whr_clzp = '';
			 $whr_clzp .= " WHERE  ".accounts.".id=account AND paystatus='0' ";
			 if($startdate != '' && $enddate != ''){ $whr_clzp .= "  AND appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'"; }  		  
				if($hospname != '' && $hospname != '0'){ $whr_clzp .= "  AND ".accounts.".id = '".$hospname."'";   }
				if($reclaim != '' && $reclaim =='reclaim'){ $whr_clzp .= "  AND reclaim_id != ''";  }
				if($request_status != ''){ $whr_clzp .= "  AND reqstatus='".$request_status."'"; }	
				if($hic != ''){ $whr_clzp .= "  AND hic='".$hic."'"; }				
				$Queryp = "UPDATE ".TBL_FORMS.",".accounts." SET paystatus = '1' $whr_clzp ";
	 if($db->execute($Queryp))
		  echo '<script>alert("Payment Status For All Search Records Updated Successfully!");</script>';
			 //echo $whr_clzp;
			 }
	if($hospname != ''){$whr3 .= "  AND tr.account='".$hospname."'  ";   }	
	if($pname != ''){$whr3 .= "  AND LTRIM(LOWER(tr.clientname))='".strtolower(trim($pname))."'  ";   }	 
               		  
					 
	if($startdate == '' && $enddate == ''){
	   $error .= "Start and End date Fields are mandatory!<br>";
	  }else{   
           if($startdate !=  '' && $enddate == '')
	       { $error .= " End Date Missing !<br>"; }
           if($startdate ==  '' && $enddate != '')
	      { $error .= " Start Date Missing !<br>"; }
       		}	
 		if(!$error){
	    $whr_clz .= " WHERE   ".accounts.".id=account ";
		if($startdate != '' && $enddate != ''){
        $whr_clz .= "  AND appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'";   		  
		  }              
			 if($hospname != '' && $hospname != '0'){
              $whr_clz .= "  AND ".accounts.".id = '".$hospname."'";   		  
		  }		  
	         if($payment_status != ''){
            $whr_clz .= "  AND paystatus='".$payment_status."'";   		  
		  }	
		  if($request_status != ''){
            $whr_clz .= "  AND reqstatus='".$request_status."'";   		  
		  }		  
	         if($reclaim != '' && $reclaim =='reclaim'){
            $whr_clz .= "  AND reclaim_id != ''";   		  
		  }	
	         if($pname != ''){
            $whr_clz .= "  AND clientname LIKE '%".trim($pname)."%'";   		  
		  }
		  if($hic != ''){ $whr_clz .= "  AND hic='".$hic."'"; }				  		  
	         /*if($address != ''){
            $whr_clz .= "  AND street_address LIKE '%".$address."%'";   		  
		  }		*/  
 if($glueids != ''){	 
   if($hospname == '' && $cisid != ''){
	$groupBy1 = " GROUP BY ".TBL_FORMS.".clientname "; 
	$groupBy2 = " GROUP BY ".TBL_FORMS.".clientname ORDER BY ".TBL_FORMS.".id  DESC"; 
	$showClient = 'yes';	
	 }else{
	$groupBy1 = " GROUP BY ".accounts.".id ";
	$groupBy2 = " GROUP BY ".accounts.".id ORDER BY ".accounts.".id  DESC";	
	 }	
     $Querypg = "SELECT COUNT(*) FROM ".TBL_FORMS.",".accounts." $whr_clz";	
	 $totalRows = $db->executeScalar($Querypg);
	 $Query_amount = "SELECT sum(charges) as totalamount FROM ".TBL_FORMS.", ".accounts." $whr_clz";	
	 if($db->query($Query_amount) && $db->get_num_rows() > 0)
		  { $amountquery = $db->fetch_all_assoc(); 
		  }
		  $tot_amount = $amountquery[0]['totalamount'];
 		  }
 
if(1){
 $Qinvoicesdata2 = "SELECT ac.account_name,bl.*,tr.vehtype,tr.pickaddr,tr.destination,tr.backto,TRIM(tr.clientname) as clientname,tr.appdate, tr.apptime,tr.returnpickup,tr.id as tid FROM billing_info as bl 
left join ".TBL_FORMS." as tr on bl.trip_id=tr.id 
left join ".accounts." as ac on tr.account=ac.id
 WHERE 1 $whr3  AND tr.appdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND tr.reqstatus = 'approved' $whr AND bl.cancel = '0' AND bl.status IN(1,4,6,7,8) ORDER BY tr.appdate ASC";
 if($db->query($Qinvoicesdata2) && $db->get_num_rows() > 0){ $invoicesdata = $db->fetch_all_assoc();
 // echo '<pre>';	print_r($invoicesdata);
//	debug($invoicesdata); exit;
//  echo 'this is the point.'; exit; 
$totalammount=0;
$collectedammount=0;
$pendingammount=0;
for($i=0;$i<sizeof($invoicesdata);$i++){ 
	if($invoicesdata[$i]['cancel']=='0'){	
	$totalammount=($totalammount+$invoicesdata[$i]['charges']); 
	if($invoicesdata[$i]['paystatus']=='1'){$collectedammount=($collectedammount+$invoicesdata[$i]['charges']);}
	if($invoicesdata[$i]['paystatus']=='0'){$pendingammount=($pendingammount+$invoicesdata[$i]['charges']);}
	if($invoicesdata[$i]['paystatus']=='2'){$pendingammount = ($pendingammount+($invoicesdata[$i]['charges'] - $invoicesdata[$i]['partial_collected']));  
											$collectedammount=($collectedammount+$invoicesdata[$i]['partial_collected']); }
	 }
	$invoicesdata[$i]['billablemile']	= chargeablemile($invoicesdata[$i]['miles'],$invoicesdata[$i]['freemiles']);
	$Q="SELECT vehtype FROM vehtype  WHERE id = '".$invoicesdata[$i]['vehtype']."' ";	
			if($db->query($Q) && $db->get_num_rows() > 0) { $ata=$db->fetch_one_assoc(); }	 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				 $invoicesdata[$i]['vehicle'] 			= 	$ata['vehtype'];
  		}} else {	$msgs .= 'No Records Found!';	}  // debug($invoicesdata); 
	}
	    }   
   }else{
    $noReq = '0';
    $Txt = 'OVERALL REQUEST STATUS'; 	
   } 
   $Queryhosp1 = "SELECT id,account_name FROM ".accounts." WHERE 1=1 ORDER BY `account_name` ASC";
   if($db2->query($Queryhosp1) && $db2->get_num_rows() > 0)
	{ $hosp = $db2->fetch_all_assoc(); }
	 if($invoicesdata){    $invoicesdata = sort_array_multidim($invoicesdata, "appdate ASC, clientname ASC"); }
	// echo '<pre>';	print_r($invoicesdata);
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Hospital/Clinic";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign("hosp",$hosp);		
	$smarty->assign("noReq",$noReq);	
	$smarty->assign_by_ref('reqdetails',$invoicesdata);
	$smarty->assign("pages",$pages);
	$smarty->assign("pname",$pname);		
	$smarty->assign("data",$data);	
	$smarty->assign("showClient",$showClient);	
	$smarty->assign('Txt',$Txt);	
	$smarty->assign('startdate',$startdate);	
	$smarty->assign("enddate",$enddate);		
	$smarty->assign("hospname",$hospname);		
	$smarty->assign("payment_status",$payment_status);		
	$smarty->assign("reclaim",$reclaim);		
	$smarty->assign("request_status",$request_status);		
	$smarty->assign("box1",$box1);		
	$smarty->assign("box2",$box2);	
	$smarty->assign("hic",$hic);	
    $smarty->assign("st",$st);
	$smarty->assign("totalRows",$totalRows);
	$smarty->assign("tot_amount",round(($totalammount),2));	
	$smarty->assign("collectedammount",round(($collectedammount),2));	
	$smarty->assign("pendingammount",round(($pendingammount),2));			
	$smarty->display('reportstpl/payment.tpl');
	
	
?>