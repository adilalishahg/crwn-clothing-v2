<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
 if(isset($_GET['id'])){
     if($_GET['id'] != '' ){    
	$Query1 = "SELECT r.*,ac.account_name,(SELECT account_name FROM accounts WHERE id=r.backto_account) as backto_account,(SELECT account_name FROM accounts WHERE id=r.destination_account) as destination_account,(SELECT account_name FROM accounts WHERE id=r.destination2_account) as destination2_account,(SELECT account_name FROM accounts WHERE id=r.destination3_account) as destination3_account
	,(SELECT name FROM officelocations WHERE id=r.destination_officelocation) as destination_officelocation
	,(SELECT name FROM officelocations WHERE id=r.destination2_officelocation) as destination2_officelocation
	,(SELECT name FROM officelocations WHERE id=r.destination3_officelocation) as destination3_officelocation
	,(SELECT name FROM officelocations WHERE id=r.backto_officelocation) as backto_officelocation
	,office.name FROM ".TBL_FORMS." as r 
	LEFT JOIN accounts as ac on r.account=ac.id
	LEFT JOIN officelocations as office on r.officelocation=office.id
				 WHERE r.id='".$_GET['id']."' ";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {
          $RequestDetail = $db->fetch_all_assoc();
	     }
$Query2 = "SELECT * FROM tripsactivity WHERE `tripid`='".$_GET['id']."' ";
	    if($db->query($Query2) && $db->get_num_rows() > 0)
	    { $tripativities = $db->fetch_all_assoc();	 }		 
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
  $Q  = "SELECT casemanager_name FROM casemanagers WHERE id = '".$RequestDetail[0]['casemanager']."'";
	  if($db->query($Q) && $db->get_num_rows() > 0){
	  	$cm = $db->fetch_one_assoc();		$RequestDetail[0]['casemanager_name'] = $cm['casemanager_name'];
	  }
     
	
	  
 $con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0)
	{	 $contact = $db->fetch_all_assoc();		}
	
$Qaccounts  = "SELECT id FROM " .  accounts ." WHERE  TRIM(LOWER(REPLACE(account_name,' ','')))='privatepay'" ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc();  $privatepayid=$accounts['id'];  }		
		
	//	print_r($RequestDetail);
	//	Close DB Connection	
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	 $smarty->assign("contact",$contact);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	$smarty->assign("content",$pgContent);	
    $smarty->assign("privatepayid",$privatepayid);
	$smarty->assign('tripativities',$tripativities);	
	$smarty->assign("msg",$msg);
	$smarty->assign("error",$error);
	$smarty->assign("vehtype",$vehtype);		
	$smarty->assign("prog",$prog);
	$smarty->assign("progassoc",$progassoc);
	$smarty->assign("RequestDetail",$RequestDetail);
    $smarty->display('requestpreview.tpl');	

?>