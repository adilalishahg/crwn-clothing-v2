<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/add_category.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;
	
	$msgs   = '';
	$errors = '';
		
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

 if(isset($_POST['submit'])){

      $hid       = sql_replace($_POST['hid']);
	  $hosp_name = sql_replace($_POST['hosp_name']);	
      $h_address = sql_replace($_POST['h_address']);
	  $h_city    = sql_replace($_POST['h_city']);		  
      $h_state   = sql_replace($_POST['h_state']);
	  $h_zip     = sql_replace($_POST['h_zip']);	
      $h_phone   = sql_replace($_POST['h_phone']);
	  $fname     = sql_replace($_POST['fname']);	
      $lname     = sql_replace($_POST['lname']);
	  $phnum     = sql_replace($_POST['phnum']);	
      $email     = sql_replace($_POST['email']);
	  $username  = sql_replace($_POST['username']);		  
	  $pwd1      = sql_replace($_POST['pwd1']);		  
	  $pwd2      = sql_replace($_POST['pwd2']);		  
	  $ustatus      = sql_replace($_POST['ustatus']);	
    
	   if(!$hid)
	    { $error .= "Hospital ID Missing !<br>"; }
		else{
		   if(!ctype_alnum($hid)){
		   $error .= "Hospital ID Should be alphanumeric!<br>";
		   }
		}
		
	   if(!$hosp_name)
	    { $error .= "Hospital Name Missing !<br>"; }

	   if(!$h_address)
	    { $error .= "Hospital Address Missing !<br>"; }
		
	   if(!$h_city)
	    { $error .= "City Missing !<br>"; }

	   if(!$h_state || $h_state == '')
	    { $error .= "State not selected!<br>"; }

	   if(!$h_zip)
	    { $error .= "Zip code Missing !<br>"; }
		else{
		   if(!ctype_digit($h_zip)){
		   $error .= "Characters allowed only in Zip code !<br>";
		   }
		}
		
	   if(!$h_phone)
	    { $error .= "Hospital Phone Number Missing !<br>"; }

	   if(!$fname)
	    { $error .= "Contact Person First Name Missing !<br>"; }
		
	   if(!$lname)
	    { $error .= "Contact Person Last Name Missing !<br>"; }

	   if(!$phnum)
	    { $error .= "Contact Person Phone Number Missing!<br>"; }

	   if(!$email)
	    { $error .= "Contact Person Email Address Missing !<br>"; }
        else{
		   if(!checkEmail($email)){
		   $error .= "Invalid Email address. !<br>";
		   }
		}
		
	   if(!$username)
	    { $error .= "Username Missing !<br>"; }
		else{
		   if(eregi(' ', $username))
			{ $error .= "Spaces not allowed in username!<br>"; }	
        }

	   if(!$pwd1)
	    { $error .= "Password Missing !<br>"; }
		else{
		   if(eregi(' ', $pwd1))
			{ $error .= "Spaces not allowed in username!<br>"; }		  
		  }
				
	   if(!$pwd2)
	    { $error .= "Confirm Password Missing !<br>"; }
       else{
		   if(eregi(' ', $pwd2))
			{ $error .= "Spaces not allowed in username!<br>"; }		  
		  }

		
	   if($pwd1 != '' && $pwd2 != '')
	    { 
		  if($pwd1 != $pwd2)
		$error .= "Passwords mismatched!<br>"; }


	   if($ustatus == '')
	    { $error .= "Status Missing!<br>"; }


      if(!$error){
       
	   //Generate Verification Code
	   function RandomName( $nameLength ) 
				{
				 $NameChars = 'abcdefghijklmnopqrstuvwxyz0123456789';
				 $Vouel = 'aeiou';
				 $keyval = "";
				 for ($index = 1; $index <= $nameLength; $index++) 
				 { 
					if ($index % 3 == 0)
					{
					  $randomNumber = rand(1,strlen($Vouel));
					  $keyval .= substr($Vouel,$randomNumber-1,1); 
					}else
					  {
						$randomNumber = rand(1,strlen($NameChars));
						$keyval .= substr($NameChars,$randomNumber-1,1);
					  } 
				 }
				 return $keyval;
				}
		
           $key = ucfirst(RandomName(rand(12,64)));
	      //End Code Generation
		  

	      $chkHospName = "SELECT * FROM ".TBL_HOSPITALS." WHERE hospname='".$hosp_name."'";
	        if($db->query($chkHospName) && $db->get_num_rows() > 0 ){
			  $error .= 'Hosptial already exist. Try another one.<br>  ';
			}

	      $chkHosp = "SELECT * FROM ".TBL_HOSPITALS." WHERE cis='".$hid."'";
	        if($db->query($chkHosp) && $db->get_num_rows() > 0){
			  $error .= 'Hosptial ID already exist. Try another one.<br>  ';
			}
	
	      $chkUser = "SELECT * FROM ".TBL_HOSPITALS." WHERE username='".$username."'";
	        if($db->query($chkUser) && $db->get_num_rows() > 0){
			  $error .= 'Username already exist. Try another one.<br>  ';
			}	
	
  if(!$error) {
		  //Add Hospital
		 $Query  = "INSERT INTO ".TBL_HOSPITALS." SET 
					hospname='$hosp_name',
					cis='$hid',
					hosp_phnum='$h_phone',
					firstname='$fname',
					lastname='$lname',
					email_address='$email',
					telephone='$phnum',
					username='$username',
					password='$pwd1',
					street_address='$h_address',
					city='$h_city',
					postcode='$h_zip', 
					state='$h_state',
					date_account_created=NOW(),
					Status='$ustatus',
					Verifykey='$key'";
					 	 
		  if($db->execute($Query))
		    {
			
			  if($ustatus == 'approved'){
			   //EMAIL SCRIPT FOR SIGNED UP USER
			
			   $from = 'support@hybridTracktrans.com';
			   $subject = 'Confirmation Email --  MMT';
			   $body = 'Your request for a new account on MMT has been approved successfully .<br>';
			   $body .= 'You can now <a href="#">login</a> with following credentials:.<br>';
			   $body .= 'Username: '.$username.'.<br> Password: '.$pwd1.'<br>';   			   
			   $body .= '<br> <b>Thank you! <br> MMT Team!</b>';
			
			   $sent = $mail->HtmlTxtMail($email,$from,$subject,$body);
			  }		
			 
			 echo '<script>alert("You have successfully added a record");</script>';
			 echo '<script>location.href="index.php";</script>';
			 exit;
			 
			}else{
           	 echo '<script>alert("Unable to add the record.");</script>';
			 echo '<script>location.href="add.php";</script>';
			 exit;
			}
		  } 
	  //End Add
     }
  }		
	$db->close();

    $pgTitle = "Admin Panel -- Corporation [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("states",$slist);
		
	$smarty->assign("hid",$hid);
	$smarty->assign("hosp_name",$hosp_name);	
	$smarty->assign("h_address",$h_address);
	$smarty->assign("h_city",$h_city);	
	$smarty->assign("h_state",$h_state);
	$smarty->assign("h_zip",$h_zip);	
	$smarty->assign("h_phone",$h_phone);
	$smarty->assign("fname",$fname);	
	$smarty->assign("lname",$lname);
	$smarty->assign("phnum",$phnum);	
	$smarty->assign("email",$email);
	$smarty->assign("username",$username);	
	$smarty->assign("pwd1",$pwd1);
	$smarty->assign("pwd2",$pwd2);		
	$smarty->display('hosptpls/add.tpl');
		
?>