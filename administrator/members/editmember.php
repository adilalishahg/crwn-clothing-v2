<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/add_category.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
	
	$db = new Database;	
	$db2 = new Database;	

	
	$msgs   = '';
	$errors = '';
	$uid = $_GET['id'];	
	$db->connect();
	$db2->connect();


//GET COUNTRY LIST
    $gcont = "SELECT * FROM ".TBL_COUNTRIES;
		if($db->query($gcont) && $db->get_num_rows() > 0)
		 {
		   $clist = $db->fetch_all_assoc();
		 }
		 
//GET STATES LIST
    $gstat = "SELECT * FROM ".TBL_STATES;
		if($db->query($gstat) && $db->get_num_rows() > 0)
		 {
		   $slist = $db->fetch_all_assoc();		 
		 }


// Add Member

      if(count($_POST) > 0){

	   $fname       = sql_replace($_POST['fname']);	
	   $lname		= sql_replace($_POST['lname']);	
       $email       = sql_replace($_POST['email']);
	   $company     = sql_replace($_POST['company']);
	   $taxid       = sql_replace($_POST['taxid']);

	   $ppalemail   = sql_replace($_POST['ppalemail']);	
	   $street		= sql_replace($_POST['street']);	
       $pcode       = sql_replace($_POST['pcode']);
	   $city        = sql_replace($_POST['city']);
	   $country     = sql_replace($_POST['country']);

	   $state       = sql_replace($_POST['state']);	
	   $telefone	= sql_replace($_POST['telefone']);	
       $fax         = sql_replace($_POST['fax']);
	   $homepage    = sql_replace($_POST['homepage']);
	   $pass1       = sql_replace($_POST['pass1']);
	   $pass2       = sql_replace($_POST['pass2']);
	   $newsletter  = sql_replace($_POST['newsletter']);
	   $Status      = sql_replace($_POST['status']);	   
	
	   if(!$fname)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;First Name Missing !<br>"; }

	   if(!$lname)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Last Name Missing !<br>"; }

	   if(!$email)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Email Missing !<br>"; }
/*
	   if(!$company)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Company Name Missing !<br>"; }

	   if(!$taxid)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Tax ID Missing !<br>"; }

	   if(!$ppalemail)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;PayPal email address Missing !<br>"; }
*/
	   if(!$street)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Street Missing !<br>"; }

	   if(!$pcode)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Postal Code Missing !<br>"; }

	   if(!$city)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;City Missing !<br>"; }

	   if(!$country)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Country not selected !<br>"; }

	   if(!$state)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;State not selected !<br>"; }

	   if(!$telefone)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Telophone number Missing !<br>"; }
/*
	   if(!$fax)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Fax number Missing !<br>"; }
*/
      if(!$pass1)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Password 1 Missing !<br>"; }

	   if(!$pass2)
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Password 2 Missing !<br>"; }
		
		if($pass1 != '' && $pass2 != ''){
		  if($pass1 != $pass2){
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Password Mismatched !<br>"; }		  
		  }
		}
	   if(eregi(" ",$pass1))
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Spaces not allowed in password !<br>"; }

	   if(eregi(" ",$pass2))
	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Spaces not allowed in password !<br>"; }

	   if(!$Status || $Status == '')
	    { 
		$Status = 'verified';
		}

	
 if(!$error){
 
         $chkEmail = "SELECT * FROM ".TBL_HOSPITALS." WHERE email_address='$email' OR payment_paypal='$ppalemail'"; 
         
		if($db->query($chkEmail) && $db->get_num_rows() > 0)
		 {
		    //$msgs .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;PayPal Email/Email address already exists, Try another one.<br>";    
			/*
			  echo '<script>alert("PayPal Email/Email address already exists, Try another one");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;		*/ 
		 }
		 
        if($msgs == '')
         {
	 
		 $Query3  = "UPDATE ".TBL_HOSPITALS." SET 
					firstname='$fname',
					lastname='$lname',
					email_address='$email',
					telephone='$telefone',
					fax='$fax',
					password='$pass1',
					homepage='$homepage',
					street_address='$street',
					city='$city',
					postcode='$pcode',
					state='$state', 
					country_id='$country',
					company='$company',
					company_taxid='$taxid',
					payment_paypal='$ppalemail',
					zone_id='',
					Status='$Status' WHERE id='$uid'";
					 	 
		  if($db->execute($Query3))
		    {
			  echo '<script>alert("Member edit Successfully");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}else{
			  echo '<script>alert("Unable to edit Member");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
	}
	}
  else{

      $query = "SELECT * FROM ".TBL_HOSPITALS." WHERE id='".$uid."'";
       
	      if($db->query($query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_all_assoc();
			  }
              $fname = $udata[0]['firstname'];
              $lname = $udata[0]['lastname'];
              $email = $udata[0]['email_address'];			  			  
              $company  = $udata[0]['company']; 
              $taxid    = $udata[0]['company_taxid'];
              $ppalemail    = $udata[0]['payment_paypal'];
              $street = $udata[0]['street_address'];
              $pcode  = $udata[0]['postcode'];
              $city   = $udata[0]['city'];	
              $country  = $udata[0]['country_id']; 
              $state    = $udata[0]['state'];
              $telefone    = $udata[0]['telephone'];
              $fax   = $udata[0]['fax'];
              $homepage    = $udata[0]['homepage'];
              $newsletter     = $udata[0]['newsletter'];	
              $Status     = $udata[0]['status'];				  			  		  
      }	
	
		
	$db->close();
	
    $pgTitle = "Admin Panel -- Memebers [Edit]";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("fname",$fname);
	$smarty->assign("lname",$lname);
	$smarty->assign("email",$email);
	$smarty->assign("company",$company);
	$smarty->assign("taxid",$taxid);
	$smarty->assign("ppalemail",$ppalemail);						
	$smarty->assign("street",$street);	
	$smarty->assign("pcode",$pcode);
	$smarty->assign("city",$city);
	$smarty->assign("country",$country);
	$smarty->assign("state",$state);						
	$smarty->assign("telefone",$telefone);	
	$smarty->assign("fax",$fax);
	$smarty->assign("homepage",$homepage);	
	$smarty->assign("newsletter",$newsletter);	
	$smarty->assign("status",$Status);
	$smarty->assign("clist",$clist);	
	$smarty->assign("slist",$slist);			
    $smarty->assign("id",$uid);			
	$smarty->display('membertpl/editmember.tpl');
		
?>