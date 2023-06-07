<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
 if(isset($_GET['id'])){
	$updateNotification = "UPDATE request_info SET notification=0 WHERE id=".$_GET['id'];
	$db->execute($updateNotification);
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
	 }   
  }

//   print_r($apptime);exit;
  $qry_vehtype  = "SELECT * FROM " .  TBL_PROGRAM . " WHERE prgid='".$prog."'";
	  if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
	  	$prgs = $db->fetch_all_assoc();
	  }
      $prog = $prgs[0]['prgtitle'];
	  $progassoc = $prgs[0]['prgassoctitle'];
 $con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0)
	{
	 $contact = $db->fetch_all_assoc();
		}
		
		// print_r($RequestDetail[0]['org_apptime']);exit;
	//Close DB Connection	
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	 $smarty->assign("contact",$contact);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	$smarty->assign("content",$pgContent);	
    $smarty->assign("seokeywords",$seokeywords);
	$smarty->assign('seodescription',$seodescription);	
	$smarty->assign("msg",$msg);
	$smarty->assign("error",$error);
	$smarty->assign("vehtype",$vehtype);		
	$smarty->assign("prog",$prog);
	$smarty->assign("org_apptime",$org_apptime);
	// $smarty->assign("progassoc",$progassoc);
	$smarty->assign("progassoc",$progassoc);
	$smarty->assign("RequestDetail",$RequestDetail);
    $smarty->display('requestpreview.tpl');	

?>