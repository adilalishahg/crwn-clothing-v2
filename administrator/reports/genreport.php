<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$chargesOK = '';
  //GET REQUEST
 $id=$_REQUEST['id'];
$reqid=$_REQUEST['reqid'];

$reclaim = $_REQUEST['reclaim'];
if(isset($reclaim) && $reclaim == 'true'){
	$showreclaim = 1;
}else{
	$showreclaim = 0;
}
if($_GET['units'] && $_GET['units'] != '' ){
	$units=$_GET['units'];
if($units < 1) $units = 2; 
//echo $units; 
//exit;
if($units){
	$query_units = "UPDATE ".TBL_FORMS." SET 
			  units = '$units'
              WHERE id = '$id'";
			   $db->execute($query_units);
			   }
}
	//$milage=$_POST['milage'];
//exit;	//$charges=$_POST['charges'];
	$qtime = $db->query('SELECT NOW() AS tym');
 $get = $db->fetch_one_assoc();
 $xp = explode(' ',$get['tym']);
 $dates = $xp[0];
 $date=date('m-d-y', strtotime($dates)); 
 $dt=explode("-",$date);
 $dtm=$dt[0];
 $dtd=$dt[1];
 $dty=$dt[2];
 $time=$xp[1];		
 $st=1;
 // if($milage=='' || $charges==''){
       $query = 		"SELECT * FROM ".TBL_FORMS." WHERE id='$id'";
		if($db->query($query) && $db->get_num_rows() > 0)
		{
			$rows = $db->fetch_all_assoc();
		$tt=(($rows[0]['triptype'] == 'One Way') ? '1' : '2');
		$milage1=$rows[0]['milage'] * $tt;
		//$milage = $milage1 + $rows[0]['unloadedmilage'];
		$milage = $milage1;
		
		$charges=$rows[0]['charges'];
		} 
		if($milage == '' || $charges == ''){			
			  echo '<script>alert("Either the milage or the charges are not specified.");</script>';
			  echo '<script>window.open("reqpreview.php?id='.$id.'&reqid='.$reqid.'","_parent");</script>';			  
			  exit;
		}
   //}
   $query = "SELECT price_per_mile FROM rates  WHERE rate_id='1'";
    if($db->query($query) && $db->get_num_rows() > 0){
		$ratedata = $db->fetch_all_assoc();
	}
	 $price_per_miles = $ratedata[0]['price_per_mile']; 
	$charges_of_miles = ($price_per_miles*$milage1)*1.00;   
	$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
    if($db->query($query) && $db->get_num_rows() > 0){
		$hicdata = $db->fetch_all_assoc();
	}
  $units_db = $rows[0]['units'];
  if($units_db == 0) $units_db = 2;
 $units_db_charges = ($units_db*$hicdata[0]['scharges']);  
  $extra1=$charges-$tt*($hicdata[0]['scharges']);
  $extra=number_format($extra1,2,'.','');
  $to=$charges;	
  $total=number_format($to,2,'.','');
  $exp = explode(".",$units_db_charges);
  /*$dollars = (($exp[0] < 10) ? '0'.$exp[0] : $exp[0]);*/
  $dollars = $exp[0];
  if($exp[1] == '' || $exp[1] == '0' || $exp[1] == '00') { $cents = '00';  } else {
  $cents = (($exp[1] < 10) ? $exp[1].'0' : $exp[1]); }
 /* $cents = $exp[1];	*/
 
  $addressTR = 	$hicdata[0]['address'].', '.$hicdata[0]['city'].', '.$hicdata[0]['state'].', '.$hicdata[0]['zip'];
  $query_u = "UPDATE ".TBL_FORMS." SET 
			  hic = '$st'
              WHERE id = '$id'";
  $db->execute($query_u);  
 if(isset($_REQUEST['id']) && $_REQUEST['reqid']){
     if($_REQUEST['id'] != '' && $_REQUEST['reqid'] != ''){    
	$Query1 = "SELECT * FROM ".TBL_FORMS.",".TBL_REQUESTS." WHERE `id`='".$_REQUEST['id']."' AND req_id='".$_REQUEST['reqid']."' AND req_id=reqid";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {
          $RequestDetail = $db->fetch_all_assoc();
	     }
	$Query2 = "SELECT * FROM ".TBL_REOCCURENCE." WHERE `info_id`='".$_REQUEST['id']."' AND req_id='".$_REQUEST['reqid']."'";
	    if($db->query($Query2) && $db->get_num_rows() > 0)
	    {
          $occurences = $db->fetch_all_assoc();       
	     }
//GET VEHICLE PREFERRENCE
  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
		$vehiclepref = $db->fetch_all_assoc();
	 }
   /** END **/
      for($i=0; $i<sizeof($vehiclepref); $i++){
	     if($RequestDetail[0]['vehtype'] == $vehiclepref[$i]['id']){
		   $vehtype  = $vehiclepref[$i]['vehtype']; 
	     }
	   }
      if($vehtype == '0') { $vehtype  = 'Any'; }
      $clinic        = $RequestDetail[0]['hospname'];
      $pickaddress   = $RequestDetail[0]['pickaddr'];
	  $phyaddress    = $RequestDetail[0]['phyaddress'];
	  if($phyaddress != ''){
		$destination = $phyaddress;
	  }else{
	  	$destination = $RequestDetail[0]['destination'];	
	  }	
	  $paddr=explode(',',$pickaddress);
	  $daddr=explode(',',$destination);
	  $pckaddr=$paddr[0];
	  $pckcity=$paddr[1]; 
	  $pckstate=$paddr[2]; 
	  $pckzip=$paddr[3];
	  $drpaddr=$daddr[0];
	  $drpcity=$paddr[1]; 
	  $drpstate=$paddr[2]; 
	  $drpzip=$paddr[3];  
      $backto        = $RequestDetail[0]['backto'];
	  $appdates       = $RequestDetail[0]['appdate'];
	  $reclaimid       = explode('-',$RequestDetail[0]['reclaim_id']);
	  $reclaimid1 = $reclaimid[0];
	  $reclaimid2 = $reclaimid[1];	  
      $apptime       = $RequestDetail[0]['apptime'];
	  $returnpickup  = $RequestDetail[0]['returnpickup'];	
      $casemanager1  = $RequestDetail[0]['casemanager'];
	  $todaydate     = $RequestDetail[0]['today_date'];	
       $pname          = $RequestDetail[0]['clientname'];
       $prog          = $RequestDetail[0]['prog'];
	  $phnum         = $RequestDetail[0]['phnum'];	
      $dobs           = $RequestDetail[0]['dob'];
	  $cisid         = $RequestDetail[0]['cisid'];		  
	  $ssn         = $RequestDetail[0]['ssn'];
	  $casemanager2  = $RequestDetail[0]['clientcasemanager'];		  
	  $comments      = $RequestDetail[0]['comments'];
      if($prog == '0'){ $prog = 'Behavioral Health'; }
      if($prog == '1'){ $prog = 'A.H.C.C.C.S'; } 	
	 }   
  }
	 $dob=date('m-d-y',strtotime($dobs)); 
	 $xp=explode('-', $dob);
	 $d=$xp[0];
	 $o=$xp[1];
	 $b=$xp[2];
	 $appdate=date('m-d-y',strtotime($appdates));
	 $appdate2=date('m-d-Y',strtotime($appdates)); 
	$app2=explode("-",$appdate2);
	$app2y=$app2[2];
	 $app=explode("-",$appdate);
	 $appm=$app[0];
	 $appd=$app[1];
	 $appy=$app[2];
	 //$chrg=explode('.',$extra);
	 $chrg=explode('.',$charges_of_miles);
	// $chg_f = (($chrg[0] < 10) ? '0'.$chrg[0] : $chrg[0]);
	//echo $extra.' next '.$chrg[0].'last -- '.$chrg[1]; 
	if($chrg[1] == '' || $chrg[1] == '0' || $chrg[1] == '00') { $chg_s = '00'; } else {
  	$chg_s = (($chrg[1] < 10) ? $chrg[1].'0' : $chrg[1]);}
	 $chg_f = $chrg[0];
	 //echo $chg_s; exit;
  	 //$chg_s = $chrg[1];	
	/* $tot=explode('.',$total);*/
	 //$tot=explode('.',($units_db_charges + $extra1));
     $tot=explode('.',($units_db_charges + $charges_of_miles));
	 $tot_f=$tot[0];
	 if($tot[1] == '' || $tot[1] == '0' || $tot[1] == '00') { $tot_s = '00'; } else {
  	 $tot_s = (($tot[1] < 10) ? $tot[1].'0' : $tot[1]);}
	$chargesOK = $_GET['charges'];
	if($chargesOK == '1'){ $new_charges = ($units_db_charges + $charges_of_miles);
		$query_charges = "UPDATE ".TBL_FORMS." SET 
			  charges = '$new_charges'
              WHERE id = '$id'";
			   $db->execute($query_charges);
		}
	//Close DB Connection	
	$db->close();
      $smarty->assign("m",$d);
	  $smarty->assign("d",$o);
	  $smarty->assign("y",$b);
	  $smarty->assign("dm",$dtm);
	  $smarty->assign("dd",$dtd);
	  $smarty->assign("dy",$dty);
	  $smarty->assign("appm",$appm);
	  $smarty->assign("appd",$appd);
	  $smarty->assign("appy",$appy);
	  $smarty->assign("app2y",$app2y);
	$smarty->assign("pck",$pckaddr);
	$smarty->assign("pckcity",$pckcity);
	$smarty->assign("pckzip",$pckzip);
	$smarty->assign("pckstate",$pckstate);
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	$smarty->assign("content",$pgContent);	
    $smarty->assign("seokeywords",$seokeywords);
	$smarty->assign('seodescription',$seodescription);	
	$smarty->assign("msg",$msg);
	$smarty->assign("error",$error);
	$smarty->assign("clinic",$clinic);	
	$smarty->assign("prog",$prog);	
	$smarty->assign("ssn",$ssn);		
	$smarty->assign("occurences",$occurences);		
	$smarty->assign("pickaddress",$pickaddress);
	$smarty->assign("destination",$destination);	
	$smarty->assign("backto",$backto);
	$smarty->assign("appdate",$appdate);	
	$smarty->assign("apptime",$apptime);
	$smarty->assign("vehtype",$vehtype);
	$smarty->assign("returnpickup",$returnpickup);	
	$smarty->assign("casemanager1",$casemanager1);
	$smarty->assign("todaydate",$todaydate);	
	$smarty->assign("pname",$pname);
	$smarty->assign("phnum",$phnum);	
	$smarty->assign("dob",$dob);
	$smarty->assign("cisid",$cisid);	
	$smarty->assign("casemanager2",$casemanager2);
	$smarty->assign("comments",$comments);	
	$smarty->assign("id",$id);
	$smarty->assign("reqid",$reqid);
	$smarty->assign("date",$date);	
	$smarty->assign("milage",$milage);
	$smarty->assign("chgf",$chg_f);
	$smarty->assign("chgs",$chg_s);
	$smarty->assign("totf",$tot_f);
	$smarty->assign("tots",$tot_s);
	$smarty->assign("total",$total);
	$smarty->assign("addressTR",$addressTR);
	$smarty->assign("hicdata",$hicdata);
	$smarty->assign("dollars",$dollars);	
	$smarty->assign("cents",$cents);
	$smarty->assign("units_db",$units_db);				
	$smarty->assign("showreclaim",$showreclaim);
	$smarty->assign("reclaimid",$reclaimid);
	$smarty->assign("reclaimid1",$reclaimid1);
	$smarty->assign("reclaimid2",$reclaimid2);
	$smarty->display('reqtpls/genreport.tpl');
?>