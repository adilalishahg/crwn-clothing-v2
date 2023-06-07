<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
  //GET REQUEST
  $id=$_GET['id'];
  $reqid=$_GET['reqid'];
   $st=$_GET['st'];
  
 if(isset($_GET['id']) ){
 
 if($_GET['id'] != '' ){    
	$Query1 = "SELECT * FROM ".TBL_FORMS." WHERE `id`='".$_GET['id']."' ";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {
          $RequestDetail = $db->fetch_all_assoc();
	     }
  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
		$vehiclepref = $db->fetch_all_assoc();
	 }
      for($i=0; $i<sizeof($vehiclepref); $i++){
	     if($RequestDetail[0]['vehtype'] == $vehiclepref[$i]['id']){
		   $vehtype  = $vehiclepref[$i]['vehtype']; 
	     }
	   }
      if($vehtype == '0') { $vehtype  = 'Any'; }
      $triptype      = $RequestDetail[0]['triptype'];
      $clinic        = $RequestDetail[0]['hospname'];
      $pickaddress   = $RequestDetail[0]['pickaddr'];
	  $destination   = $RequestDetail[0]['destination'];	
      $backto        = $RequestDetail[0]['backto'];
	  $appdate       = $RequestDetail[0]['appdate'];		  
      $apptime       = $RequestDetail[0]['apptime'];
	  $org_apptime   = $RequestDetail[0]['org_apptime'];
	  $returnpickup  = $RequestDetail[0]['returnpickup'];	
      $casemanager1  = $RequestDetail[0]['casemanager'];
	  $todaydate     = $RequestDetail[0]['today_date'];	
      $pname         = $RequestDetail[0]['clientname'];
	  $phnum         = $RequestDetail[0]['phnum'];	
      $dob           = $RequestDetail[0]['dob'];
	  $cisid         = $RequestDetail[0]['cisid'];	
	  $prog          = $RequestDetail[0]['prog'];	
	  $ssn           = $RequestDetail[0]['ssn'];		  	  	  
	  $po            = $RequestDetail[0]['po'];	
	  $casemanager2  = $RequestDetail[0]['clientcasemanager'];		  
	  $comments      = $RequestDetail[0]['comments'];	
	  $phyname		= $RequestDetail[0]['fname'].' '.$RequestDetail[0]['lname'];
	   $phyClinic	= $RequestDetail[0]['clinic'];
	   $phyadd		= $RequestDetail[0]['phyaddress'];
	   $phyPhone	= $RequestDetail[0]['phyphone'];
	   $phyfax		= $RequestDetail[0]['phyfax'];
	   $phyreason	= $RequestDetail[0]['reason'];
	  $Query3 = "SELECT signature,signature2,startmilage,endmilage,paperwork,personal_belonging,medication FROM trip_details WHERE reqid = '$id'";
	  if($db->query($Query3) && $db->get_num_rows() > 0){
		$signatures = $db->fetch_all_assoc();
	 } 
	 //print_r($signatures);
	 } 
  }
  $con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0){
	 $contact = $db->fetch_all_assoc(); }
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);
	$smarty->assign("contact",$contact);
	$smarty->assign("st",$st);
	$smarty->assign("id",$id);
	$smarty->assign("reqid",$reqid);
	$smarty->assign("units",$units);
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
	$smarty->assign("hic",$hic);
	$smarty->assign("returnpickup",$returnpickup);	
	$smarty->assign("casemanager1",$casemanager1);
	$smarty->assign("todaydate",$todaydate);	
	$smarty->assign("pname",$pname);
	$smarty->assign("phnum",$phnum);	
	$smarty->assign("dob",$dob);
	$smarty->assign("cisid",$cisid);	
	$smarty->assign("casemanager2",$casemanager2);
	$smarty->assign("comments",$comments);
	$smarty->assign("triptype",$triptype);	
	$smarty->assign("phyname",$phyname);
	$smarty->assign("phyclinic",$phyClinic);
	$smarty->assign("phyadd",$phyadd);
	$smarty->assign("phypnone",$phyPhone);
	$smarty->assign("phyfax",$phyfax);
	$smarty->assign("phyreason",$phyreason);
	$smarty->assign("prog",$prog);
	$smarty->assign("progassoc",$progassoc);
	$smarty->assign("RequestDetail",$RequestDetail);
	$smarty->assign("transportation_log",$transportation_log);
	$smarty->assign("signatures",$signatures);
	$smarty->display('reportstpl/requestpreview.tpl');
?>