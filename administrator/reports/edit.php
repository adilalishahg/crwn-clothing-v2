<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;
	$msgs   = '';
	$errors = '';
	$db->connect();
	$db2->connect();
///GET VEHICLE PREFERRENCE
  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
		$vehiclepref = $db->fetch_all_assoc();
	 }
//GET STATES LIST
    $gstat = "SELECT * FROM ".TBL_STATES;
		if($db->query($gstat) && $db->get_num_rows() > 0)
		 {
		   $slist = $db->fetch_all_assoc();		 
		 }		 
// Get edit ids
$req_id = $_GET['reqid'];
$id = $_GET['id'];
$req = $_GET['req'];
if($_GET['id'] != '' && $_GET['reqid'] != ''){ 		
	  $Query1 = "SELECT * FROM ".TBL_FORMS." WHERE `id`='".$_GET['id']."' AND req_id='".$_GET['reqid']."'";
	    if($db->query($Query1) && $db->get_num_rows() > 0)
	    {  $RequestDetail = $db->fetch_all_assoc();  }
	  $pickaddress   = $RequestDetail[0]['pickaddr'];
	  $vehtype       = $RequestDetail[0]['vehtype'];	  
	  $destination   = $RequestDetail[0]['destination'];	
      $backto        = $RequestDetail[0]['backto'];
	  $appdate1      = $RequestDetail[0]['appdate'];		  
      $apptime       = $RequestDetail[0]['apptime'];
	  $returnpickup  = $RequestDetail[0]['returnpickup'];	
      $casemanager1  = $RequestDetail[0]['casemanager'];
	  $todaydate     = $RequestDetail[0]['today_date'];	
      $pname         = $RequestDetail[0]['clientname'];
	  $phnum         = $RequestDetail[0]['phnum'];	
	  //$email        = $RequestDetail[0]['email'];
      $dob1          = $RequestDetail[0]['dob'];
	  $dob          = $RequestDetail[0]['dob'];
	  $cisid         = $RequestDetail[0]['cisid'];		  
	  $casemanager2  = $RequestDetail[0]['clientcasemanager'];		  
	  $comments      = $RequestDetail[0]['comments'];
	  $reqstatus      = $RequestDetail[0]['reqstatus'];	  
	  $adminComments  = $RequestDetail[0]['adminComments'];	  	  
      $progtype      = $RequestDetail[0]['prog'];
      $ssn           = $RequestDetail[0]['ssn'];	
	  $triptype=  $RequestDetail[0]['triptype'];
	  $paddr=explode(',',$pickaddress);
	  $daddr=explode(',',$destination);
	  $backaddr=explode(',',$backto);
	  $bck=$backaddr[0];
	  $bckcity=$backaddr[1]; 
	  $bckstate=$backaddr[2]; 
	  $bckzip=$backaddr[3];
	  $pckaddr=$paddr[0];
	  $pckcity=$paddr[1]; 
	  $pckstate=$paddr[2]; 
	  $pckzip=$paddr[3];
	  $drpaddr=$daddr[0];
	  $drpcity=$daddr[1]; 
	  $drpstate=$daddr[2]; 
	  $drpzip=$daddr[3];  
	   $h_state= $pckstate;
	   $h_state2= $drpstate;
	   if($returnpickup != ''){
	   $puchoice = 'Time';
	 }else{
	   $puchoice = 'Will Call';
	 }
	 $Query33 = "SELECT hospname FROM ".TBL_REQUESTS." WHERE reqid = '".$_GET['reqid']."'";
	  if($db->query($Query33) && $db->get_num_rows() > 0)
	    {
          $hosp = $db->fetch_all_assoc();       
	     }
    $hospitalname = $hosp[0]['hospname']; 	 
   $Query2 = "SELECT * FROM ".TBL_REOCCURENCE." WHERE `info_id`='".$_GET['id']."' AND req_id='".$_GET['reqid']."'";
	    if($db->query($Query2) && $db->get_num_rows() > 0)
	    {
          $occurences = $db->fetch_all_assoc();       
	     }	  
	  for($i=0; $i<count($occurences); $i++){
		if($occurences[$i]['recur_day'] == 'monday'){
		 $mondayid = $occurences[$i]['recur_id'] ;
		  $_SESSION['monday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['monday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['monday'][2] = $occurences[$i]['address'];
   		  $_SESSION['monday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);		  		  		  		
		}
		if($occurences[$i]['recur_day'] == 'tuesday'){
		  $tuesdayid = $occurences[$i]['recur_id'] ;
   		  $_SESSION['tuesday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['tuesday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['tuesday'][2] = $occurences[$i]['address'];
   		  $_SESSION['tuesday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);			  
		}		
		if($occurences[$i]['recur_day'] == 'wednesday'){
		  $wednesdayid = $occurences[$i]['recur_id'] ;
   		  $_SESSION['wednesday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['wednesday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['wednesday'][2] = $occurences[$i]['address'];
   		  $_SESSION['wednesday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);			  
		}
		if($occurences[$i]['recur_day'] == 'thursday'){
		  $thursdayid = $occurences[$i]['recur_id'] ;
   		  $_SESSION['thursday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['thursday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['thursday'][2] = $occurences[$i]['address'];
   		  $_SESSION['thursday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);			  
		}
		if($occurences[$i]['recur_day'] == 'friday'){
		  $fridayid = $occurences[$i]['recur_id'] ;
   		  $_SESSION['friday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['friday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['friday'][2] = $occurences[$i]['address'];
   		  $_SESSION['friday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);			  
		}
		if($occurences[$i]['recur_day'] == 'saturday'){
		  $saturdayid = $occurences[$i]['recur_id'] ;
   		  $_SESSION['saturday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['saturday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['saturday'][2] = $occurences[$i]['address'];
   		  $_SESSION['saturday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);			  
		}								
		if($occurences[$i]['recur_day'] == 'sunday'){
		  $sundayid = $occurences[$i]['recur_id'] ;
   		  $_SESSION['sunday'][0] = $occurences[$i]['apptime'];
   		  $_SESSION['sunday'][1] = $occurences[$i]['returntime'];
   		  $_SESSION['sunday'][2] = $occurences[$i]['address'];
   		  $_SESSION['sunday'][3] = convertDateFromMySQL($occurences[$i]['fromto']);			  
		}		
      }
	}	 
		 
		 
// Update request
if(isset($_POST['submit'])){
 $reqid = $_GET['reqid'];
 $id = $_GET['id'];
 $req = $_GET['req'];
 	/*echo'<pre>';
	print_r($_POST);
	exit;*/
      $progtype      = sql_replace($_POST['progtype']);
	  $triptype      = sql_replace($_POST['triptype']);
      $vehtype      = sql_replace($_POST['vehtype']);		  
      $ssn           = sql_replace($_POST['ssn']);	  
      $pickaddress   = sql_replace($_POST['pickaddress']);
	  $destination   = sql_replace($_POST['destination']);	
      $backto        = sql_replace($_POST['backto']);
	  $appdate       = sql_replace($_POST['appdate']);	  
	  $appdate1      = sql_replace($_POST['appdate']);
      $apptime       = sql_replace($_POST['apptime']);
	  $returnpickup  = sql_replace($_POST['returnpickup']);	
      $casemanager1  = sql_replace($_POST['casemanager1']);
	  $todaydate     = sql_replace($_POST['todaydate']);	
      $pname         = sql_replace($_POST['pname']);
	  $phnum         = sql_replace($_POST['phnum']);	
      $dob           = sql_replace($_POST['dob']);
	  //$email         = sql_replace($_POST['email']);
      $dob1          = sql_replace($_POST['dob']);
	  $cisid         = sql_replace($_POST['cisid']);
	  $puch			 = sql_replace($_POST['puchoice']);
	  $casemanager2  = sql_replace($_POST['casemanager2']);		  
	  $comments      = sql_replace($_POST['comments']);	
	  $reqstatus     = sql_replace($_POST['reqstatus']);	
      $pckzip  = $_POST['pckzip'];
	  $pckcity  = $_POST['pckcity'];
	  $pckstate  = $_POST['pckstate'];
      $drpzip= $_POST['drpzip'];
	  $drpcity= $_POST['drpcity'];
	  $drpstate= $_POST['drpstate'];
 $pck_address= str_replace(',','',$pickaddress).",".str_replace(',','',$pckcity).",".$pckstate.",".str_replace(',','',$pckzip);
 $dst_address= str_replace(',','',$destination).",".str_replace(',','',$drpcity).",".$drpstate.",".str_replace(',','',$drpzip);
	// $backto=$_SESSION['step1']['backto'];
       $backtozip= $_POST['backtozip'];
	   $backtocity= $_POST['backtocity'];
	   $backtostate= $_POST['backtostate'];
		   if($backto != ''){ 
	 $back_address= str_replace(',','',$backto).",".str_replace(',','',$backtocity).",".$backtostate.",".str_replace(',','',$backtozip);
	 }else{
 $back_address='';
     }
	 if($triptype=='One Way'){
	 $ttype='One Way';
	 }else{
	  $ttype='Round Trip';
	 }
     /*if($reqstatus == 'disapproved'){
				  $reqstatus1= 'active';
				  }	
	  if($reqstatus == 'active'){
	  			   $reqstatus1= 'active';
	  				}	
	  if($reqstatus == 'approved'){
	  			   $reqstatus1= 'active';
	  				}*/
		if($puch != 'Time')
		{
			$returnpickup = "Will Call";
		}
	  $adminComments = sql_replace($_POST['adminComments']);		  	   	
	  $mondayid = sql_replace($_POST['hidmonday']) ;
	  $tuesdayid = sql_replace($_POST['hidtuesday']) ;
	  $wednesdayid = sql_replace($_POST['hidwednesday']) ;
	  $thursdayid = sql_replace($_POST['hidthursday']) ;
	  $fridayid = sql_replace($_POST['hidfriday']) ;
	  $saturdayid = sql_replace($_POST['hidsaturday']) ;
	  $sundayid = sql_replace($_POST['hidsunday']) ;	  	  	  	  	  	  
     if(!isset($vehtype) || $vehtype == ''){
	    $error .= "<img src='images/bulit.gif'> Vehicle Type not selected !</img><br>"; 
	  }	
	   if(!$pickaddress)
	    { $error .= "<img src='images/bulit.gif'> Pick Up address Missing !</img><br>"; }
	   if(!$destination)
	    { $error .= "<img src='images/bulit.gif'> Destination address Missing !</img><br>"; }
       if($pickaddress == $destination)
	    { $error .= "<img src='images/bulit.gif'> Pick Address and Destination address can not be same !</img><br>"; }
	   if(!$appdate)
	    { $error .= "<img src='images/bulit.gif'> Appointment date Missing !</img><br>"; }
	   if(!$apptime)
	    { $error .= "<img src='images/bulit.gif'> Appointment time Missing!</img><br>"; }
	   if(!$pname)
	    { $error .= "<img src='images/bulit.gif'> Name Missing !</img><br>"; }
	   if(!$phnum)
	    { $error .= "<img src='images/bulit.gif'> Phone number Missing !</img><br>"; }
		//UNSET SESSIONS
	    $_SESSION['monday'] = '';
	    $_SESSION['tuesday'] = '';	  
	    $_SESSION['wednesday'] = '';	  
	    $_SESSION['thursday'] = '';	 
	    $_SESSION['friday'] = '';	  
	    $_SESSION['saturday'] = '';	  
	    $_SESSION['sunday'] = '';		
	    $_SESSION['monday']    = $_POST['monday'];
	    $_SESSION['tuesday']   = $_POST['tuesday'];	  
	    $_SESSION['wednesday'] = $_POST['wednesday'];	  
	    $_SESSION['thursday']  = $_POST['thursday'];	 
	    $_SESSION['friday']    = $_POST['friday'];	  
	    $_SESSION['saturday']  = $_POST['saturday'];	  
	    $_SESSION['sunday']    = $_POST['sunday'];			
 // UPDATE INTO FORM TABLE
  $Query2  = "UPDATE ".TBL_FORMS." SET 
					vehtype='".$vehtype."',						
				    triptype='".$ttype."',
					pickaddr='".$pck_address."',
					destination='".$dst_address."',
					backto='".$back_address."',
					appdate='".$appdate."',
                    apptime='".$apptime."',
					returnpickup='".$returnpickup."',
					clientname='".$pname."',
                    phnum='".$phnum."',
					dob='".$dob."',
					casemanager='".$casemanager1."',
					comments='".$comments."' WHERE 
					req_id='".$reqid."' AND id='".$id."'";
		  if($db->execute($Query2))
		    { echo '<script>alert("Trip request updated successfully!");</script>'; 
			echo "<script>window.open('index.php','_parent');</script>"; exit;
			$success = 'yes';
	         }else{ 
			 echo '<script>alert("Failed to update trip request. Please try again!");</script>'; 
			 echo "<script>window.open('index.php','_parent');</script>"; exit;
			 $success = 'no'; }	   
	 	}
	$db->close();
	$pgTitle="Edit Request";
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	$smarty->assign("content",$pgContent);	
    $smarty->assign("seokeywords",$seokeywords);
	$smarty->assign('seodescription',$seodescription);	
	$smarty->assign("msg",$msg);
	$smarty->assign("error",$error);
	$smarty->assign("testi",$testi);
    $smarty->assign("data",$data);	
	$smarty->assign("h_state",$h_state);
	$smarty->assign("h_state2",$h_state2);	
	$smarty->assign("pickupchoice",$puchoice);	
    $smarty->assign("states",$slist);
	$smarty->assign("progtype",$progtype);
	$smarty->assign("vehtype",$vehtype);	
	$smarty->assign("vehiclepref",$vehiclepref);	
	$smarty->assign("ssn",$ssn);		
	$smarty->assign("pickaddress",$pckaddr);
	$smarty->assign("destination",$drpaddr);	
	$smarty->assign("backto",$backto);
	$smarty->assign("appdate",$appdate1);	
	$smarty->assign("apptime",$apptime);
	$smarty->assign("returnpickup",$returnpickup);	
	$smarty->assign("casemanager1",$casemanager1);
	$smarty->assign("todaydate",$todaydate);	
	$smarty->assign("pname",$pname);
	$smarty->assign("phnum",$phnum);
	$smarty->assign("email",$email);	
	$smarty->assign("dob",$dob1);
	$smarty->assign("cisid",$cisid);
	$smarty->assign("triptype",$triptype);
	$smarty->assign("mondayid",$mondayid);
	$smarty->assign("tuesdayid",$tuesdayid);
	$smarty->assign("thursdayid",$thursdayid);
	$smarty->assign("wednesdayid",$wednesdayid);
	$smarty->assign("fridayid",$fridayid);
	$smarty->assign("saturdayid",$saturdayid);
	$smarty->assign("sundayid",$sundayid);							
	$smarty->assign("foot",$foot);	
	$smarty->assign("reqstatus",$reqstatus);		
	$smarty->assign("casemanager2",$casemanager2);
	$smarty->assign("comments",$comments);
 	$smarty->assign("reqid",$req_id);  	
	$smarty->assign("id",$id);	
	$smarty->assign("req",$req);	
	$smarty->assign("pck",$pckaddr);
	$smarty->assign("pckcity",$pckcity);
	$smarty->assign("pckzip",$pckzip);
	$smarty->assign("pckstate",$pckstate);
	$smarty->assign("bck",$bck);
	$smarty->assign("bckcity",$bckcity);
    $smarty->assign("bckzip",$bckzip);
	$smarty->assign("bckstate",$bckstate);
	$smarty->assign("drp",$drpaddr);
	$smarty->assign("drpcity",$drpcity);	
    $smarty->assign("drpstate",$drpstate);	
    $smarty->assign("drpzip",$drpzip);	
	$smarty->assign("adminComments",$adminComments);
	$smarty->assign("hospitalname",$hospitalname);	
	$smarty->display('reportstpl/edit.tpl');
?>