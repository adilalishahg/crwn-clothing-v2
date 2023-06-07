<?php
include_once('includefile.php');
//include_once('Classes/mapquest_google_miles.class.php');	
if($_SESSION['userdata']['request_option'] == '0'){echo '<script>location.href="index.php";</script>';  exit;}
//$mile_C = new mapquest_google_miles;
$qry_vehtype = "SELECT * FROM " . TBL_VEHTYPES ." WHERE status = 'Active'"; if($db->query($qry_vehtype) && $db->get_num_rows() > 0){$vehiclepref = $db->fetch_all_assoc();} 
if($_SESSION['type'] == 'ac' && isset($_SESSION['userdata']['officelocation'])){
 $qry_office = "SELECT * FROM " . officelocations ." WHERE id IN(".$_SESSION['userdata']['officelocation'].") ";if($db->query($qry_office) && $db->get_num_rows() > 0){$offices = $db->fetch_all_assoc();} 
 $WhrUser	=	" id IN(0) ";
//$v_ids = $_SESSION['userdata']['id'];

//if($_SESSION['type'] == 'cm'){$WhrUser	=	" id IN('".str_replace(",","','",$_SESSION['userdata']['accounts_ids'])."') ";}
  $query="SELECT * FROM associated_accounts WHERE associated_account_id = '".$_SESSION['userdata']['id']."'";
		if($db->query($query) && $db->get_num_rows() > 0)
		{ $data = $db->fetch_all_assoc(); 		$v_ids='';  //print_r($data);
		for($i=0; $i<sizeof($data); $i++){
			$v_ids .= ','.$data[$i]['account_id'];
			}  
		}	
		 $v_ids = ($_SESSION['userdata']['id'].$v_ids); 
if($_SESSION['type'] == 'ac' && isset($v_ids)){$WhrUser	=	" id IN(".$v_ids.") ";}

  $Qaccounts  = "SELECT * FROM " .  accounts ." WHERE $WhrUser";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
 
}

if($_SESSION['type'] == 'pa'){
	
	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	
 	if(isset($accounts[0]['officelocation'])){
		$qry_office = "SELECT * FROM " . officelocations ." WHERE id IN(".$accounts[0]['officelocation'].") ";if($db->query($qry_office) && $db->get_num_rows() > 0){$offices = $db->fetch_all_assoc();} 
	}
}
if($_SESSION['type'] == 'cm'){
	
	$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE id='".$_SESSION['userdata']['account']."'";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc(); }
	
	if(isset($accounts[0]['officelocation'])){
		$qry_office = "SELECT * FROM " . officelocations ." WHERE id IN(".$accounts[0]['officelocation'].") ";if($db->query($qry_office) && $db->get_num_rows() > 0){$offices = $db->fetch_all_assoc();} 
	}
}
if($_SESSION['allowUser'] == ''){

$Qaccounts  = "SELECT * FROM " .  accounts ." WHERE TRIM(LOWER(account_name)) LIKE '%Online User%' ";	if($db->query($Qaccounts) && $db->get_num_rows() > 0){$accounts = $db->fetch_all_assoc();}
$qry_office = "SELECT * FROM " . officelocations ."  ";if($db->query($qry_office) && $db->get_num_rows() > 0){$offices = $db->fetch_all_assoc();}
}
	//print_r($offices);
/* $Query = "SELECT r.id,r.region FROM ".cmregions." as cr LEFT JOIN regions as r on cr.region_id=r.id WHERE cr.cm_id='".$_SESSION['userdata']['cm_id']."' ORDER BY r.region ASC "; 
 //$Q="SELECT * FROM cmregions";
if($db->query($Query) && $db->get_num_rows() > 0){$regions = $db->fetch_all_assoc();  }
*/ //print_r($regions); //exit;
function check_validation(){
	$error='';
	if(empty($_POST['submitter_name'])){
		$error.='Facility Employee Completing Request is required<br/>';
	}
	if(empty($_POST['officelocation'])){
		$error.='Office Location is required<br/>';
	}
	if(empty($_POST['clientname'])){
		$error.='Patient Name is required';
	}
	if(empty($_POST['patient_weight'])){
		$error.='Patient Weight is required<br/>';
	}
	if(empty($_POST['consult_requested'])){
		$error.='Procedure/ Consult Requested is required<br/>';
	}	
	if(empty($_POST['appdate_requested'])){
		$error.='Appointment Date Requested is required<br/>';
	}
	/*if(empty($_POST['appdate'])){
		$error.='Actual Appointment Date is required<br/>';
	}*/
	if(empty($_POST['apptime'])){
		$error.='Time is required<br/>';
	}
	if(empty($_POST['appointment_location'])){
		$error.='Appointment Location/Office Name is required<br/>';
	}
	if(empty($_POST['address'])){
		$error.='Address is required<br/>';
	}
	if(empty($_POST['phone'])){
		$error.='Location Telephone is required<br/>';
	}	
	return $error; }

 if($_POST['submit']){ 
 
 	$error = check_validation();

	if($error==''){
		
		if(!empty($_FILES['facesheet']))
  		{
    	$path = "borrifiles/";
    	$facesheet= date('dmYHis').str_replace(" ", "", basename($_FILES["facesheet"]["name"]));
		move_uploaded_file($_FILES["facesheet"]["tmp_name"], $path . $facesheet);
	  	}
		if(!empty($_FILES['facesheet']))
  		{
    	$path = "borrifiles/";
    	$necessityform= date('dmYHis').str_replace(" ", "", basename($_FILES["necessityform"]["name"]));
		move_uploaded_file($_FILES["necessityform"]["tmp_name"], $path . $necessityform);
	  	}
		
		/*echo '<pre>'; 
		print_r($_POST); 
		print_r($_FILES);
		exit;*/
		
			if(empty($_SESSION['type'])){
				$accountName='Online User';
			}elseif($_SESSION['type'] == 'ac'){
				$account_id	=	$_SESSION['userdata']['id'];
				$accountName=$accountName.'(Corporate Portal)';
			}elseif($_SESSION['type'] == 'cm'){
				$account_id				=	$_SESSION['userdata']['account'];
				$accountName=$accountName.'(Employee Portal)';
			}elseif($_SESSION['type'] == 'pa'){
				$accountName=$pname.'(Customer Portal)';
				$QW .= ",cmid='".$_SESSION['userdata']['id']."'";  
			}
		//	appdate					=	'".convertDateToMySQL($_POST['appdate'])."',
				  $Qr="submitter_name		=	'".$_POST['submitter_name']."',
				    clientname				=	'".$_POST['clientname']."',
					officelocation				=	'".$_POST['officelocation']."',
					room_number				=	'".$_POST['room_number']."',
					dob						=	'".convertDateToMySQL($_POST['dob'])."',
					patient_weight			=	'".$_POST['patient_weight']."',
					consult_requested		=	'".$_POST['consult_requested']."',
					physician_name			=	'".$_POST['physician_name']."',
					physician_phone			=	'".$_POST['physician_phone']."',
					reason					=	'".$_POST['reason']."',
					appdate_requested		=	'".convertDateToMySQL($_POST['appdate_requested'])."',
					
					apptime					=	'".$_POST['apptime']."',
					appointment_location	=	'".$_POST['appointment_location']."',
					address					=	'".$_POST['address']."',
					suite					=	'".$_POST['suite']."',
					phone					=	'".$_POST['phone']."',
					triptype				=	'".$_POST['triptype']."',
					vehtype					=	'".$_POST['vehtype']."',
					clinical_needs			=	'".$_POST['clinical_needs']."',
					anticoagulant_therapy	=	'".$_POST['anticoagulant_therapy']."',
					needtobeheld			=	'".$_POST['needtobeheld']."',
					holddays				=	'".$_POST['holddays']."',
					npo_prior				=	'".$_POST['npo_prior']."',
					npo_prior_hours			=	'".$_POST['npo_prior_hours']."',
					attendant				=	'".$_POST['attendant']."',
					notification_name		=	'".$_POST['notification_name']."',
					notification_relationship	='".$_POST['notification_relationship']."',
					notification_phone		=	'".$_POST['notification_phone']."',
					reason_ambulance		=	'".$_POST['reason_ambulance']."',
					bed_confinement			=	'".$_POST['bed_confinement']."',
					bed_confinement1		=	'".$_POST['bed_confinement1']."',
					bed_confinement2		=	'".$_POST['bed_confinement2']."',
					bed_confinement3		=	'".$_POST['bed_confinement3']."',
					casemanager_id			=	'".$_SESSION['userdata']['cm_id']."',
					account_id				=	'".$account_id."',
					facesheet				=	'".$facesheet."',
					necessityform			=	'".$necessityform."' ";

					
	    $Query2  = "INSERT INTO appointment_requests SET $Qr ";
		  if($db->execute($Query2))
		    {  echo '<script>alert("Appointment Request Added Successfully");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
	} }
	$db->close();
	
	$smarty->assign("error",$error);
	$smarty->assign("vehiclepref",$vehiclepref);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("regions",$regions);
	$smarty->assign("post",$_POST);
	$smarty->assign("foot",$foot);
	$smarty->assign("offices",$offices);
	$smarty->assign("tripnumber",$tripnumber);
	$smarty->assign("itemstypes",$itemstypes);
	$smarty->assign("nextDay",$nextDay);
	$smarty->assign("chkNextDay",$chkNextDay);
	$smarty->assign("pg",'triprequest');			
    $smarty->display('appointment_request.tpl');	
?>