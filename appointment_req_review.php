<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
 if(isset($_GET['id'])){
     if($_GET['id'] != '' ){    
	/*$Query1 = "SELECT r.*,ac.account_name,(SELECT account_name FROM accounts WHERE id=r.backto_account) as backto_account,(SELECT account_name FROM accounts WHERE id=r.destination_account) as destination_account,(SELECT account_name FROM accounts WHERE id=r.destination2_account) as destination2_account,(SELECT account_name FROM accounts WHERE id=r.destination3_account) as destination3_account
	,(SELECT name FROM officelocations WHERE id=r.destination_officelocation) as destination_officelocation
	,(SELECT name FROM officelocations WHERE id=r.destination2_officelocation) as destination2_officelocation
	,(SELECT name FROM officelocations WHERE id=r.destination3_officelocation) as destination3_officelocation
	,(SELECT name FROM officelocations WHERE id=r.backto_officelocation) as backto_officelocation
	,office.name FROM ".TBL_FORMS." as r 
	LEFT JOIN accounts as ac on r.account=ac.id
	LEFT JOIN officelocations as office on r.officelocation=office.id
				 WHERE r.id='".$_GET['id']."' ";*/
	$Q="SELECT ap.*,ac.account_name,office.name officelocation FROM appointment_requests ap 
									LEFT JOIN accounts as ac on ap.account_id=ac.id
									LEFT JOIN officelocations as office on ap.officelocation=office.id   WHERE ap.id='".$_GET['id']."' "; 
	if($db->query($Q) && $db->get_num_rows() > 0){ $RequestDetail = $db->fetch_one_assoc();   }	 }}
	  
 $con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0)
	{	 $contact = $db->fetch_all_assoc();		}
	//	echo "<pre>";	
	//	print_r($RequestDetail);
	//	Close DB Connection	
	$db->close();

    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("contact",$contact);	
	$smarty->assign("progassoc",$progassoc);
	$smarty->assign("dt",$RequestDetail);
    $smarty->display('appointment_req_review.tpl');	

?>