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





// Add User



  if(isset($_POST['admusersub']))

	   {

	   $admname   = sql_replace($_POST['admname']);	

	   $lname   = sql_replace($_POST['lname']);	

	   $admuname  = sql_replace($_POST['admuname']);	

       $admemail  = sql_replace($_POST['admemail']);

	   $admpwd1   = sql_replace($_POST['admpwd1']);

	   $admpwd2   = sql_replace($_POST['admpwd2']);	   

	   $Status    = sql_replace($_POST['status']);

	   

	

  

	

	   if(!$admname)

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Administrator Name Missing !<br>"; }



	   if(!$admuname)

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Administrator Username Missing !<br>"; }



	   if(eregi(" ",$admuname))

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Spaces not allowed in Username !<br>";        }



	   if(!$admemail)

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Spaces not allowed in Email address!<br>"; }



       if(!$admpwd1)

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Password 1 Missing !<br>"; }



	   if(!$admpwd2)

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Password 2 Missing !<br>"; }

		

		if($admpwd1 != '' && $admpwd2 != ''){

		  if($admpwd1 != $admpwd2){

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Password Mismatched !<br>"; }		  

		  }

		}

	   if(eregi(" ",$admpwd1))

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Spaces not allowed in password !<br>";        }



	   if(eregi(" ",$admpwd2))

	    { $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Spaces not allowed in confirm password field !<br>";          }



	   if(!$Status || $Status == '')

	    { $Status = 'Active';	}

	

 if(!$error){



     $chkEmail = "SELECT * FROM ".TBL_ADMIN." WHERE admin_email_address='$admemail'"; 

         

		if($db->query($chkEmail) && $db->get_num_rows() > 0)

		 {

		    $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Email address already exists, Try another one.<br>";    

		 }

		 

		 

     $chkUname = "SELECT * FROM ".TBL_ADMIN." WHERE admin_uname='$admuname'"; 

         

		if($db->query($chkUname) && $db->get_num_rows() > 0)

		 {

		    $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Username already exists, Try another one.<br>";    

		 }		 

		 

		 

    if($error == '')

         {

		  $Query3  = "INSERT INTO ".TBL_ADMIN." SET 

					admin_uname='$admuname',

					admin_name='$admname',

					admin_lname='$lname',

					admin_email_address='$admemail',

					admin_password='$admpwd1',

					admin_level='1',

					admin_status='$Status'";

					 	 

		  if($db->execute($Query3))

		    {
	        $qemail = "SELECT * FROM ".TBL_EMAIL;	
		    if($db->query($qemail) && $db->get_num_rows() > 0)
		    {       $emaildata = $db->fetch_all_assoc();   }   

			$contactmail = "SELECT * FROM ".contact_info;	
		    if($db->query($contactmail) && $db->get_num_rows() > 0)
		    {       $emaildata2 = $db->fetch_all_assoc();   }   

			//EMAIL SCRIPT FOR ADDED ADMIN USER

			$subject = 'Congratulations, you have been added as Admin User -- '.$emaildata[0]['cname'].'';

			$to 	= $admemail;
			$to2 	= $emaildata2[0]['email2'];

			$from =$emaildata[0]['email'];

			$name = $adminname." ".$lname;		

			$message    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">

					<tr>

					<td width="63%"><a href="http://'.$emaildata[0]['url'].'"><img src="http://'.$emaildata[0]['url'].'/'.$emaildata[0]['image'].'" border="0" /></a></td>

					<td width="37%"><strong>

					<font color="#000000" size="1px" >'.$emaildata[0]['cname'].',<br />

        '.$emaildata[0]['address'].',<br />

		'.$emaildata[0]['city'].', '.$emaildata[0]['state'].', '.$emaildata[0]['zip'].'

        TEL:'.$emaildata[0]['phone'].'</font></strong></td>

					</tr>

					<tr>

					<td colspan="2" align="left">			

							Congratulations '.$admname.',<br>

							You have been added as a secondary admin user on '.$emaildata[0]['cname'].' administrative Panel .<br>

							You can now <a href="http://'.$emaildata[0]['url'].'/administrator/login.php">login</a> to use your administrative panel:.<br> 

							Username: '.$admuname.'.<br> Password: '.$admpwd1.'<br><br>

							</td>

					</tr>

					<tr>

					<td colspan="2" align="left">

					<b>Thank you! <br> '.$emaildata[0]['cname'].' Team!</b>

					</td>

					</tr>

					</table>';

			

			  $sent = $mail->HtmlTxtMail($to,$from,$subject,$message);
			  $mail->HtmlTxtMail($to2,$from,$subject,$message);

	//	$sent =  mail_it($to, $from, $subject, $message, $name, $contact,'');

			  		   

		   if($sent){			

			  echo '<script>alert("Admin User added Successfully");</script>';

			  echo '<script>window.open("index.php","_parent");</script>';			  

			  exit;

			  }else{

			  echo '<script>alert("Unable to send confirmation email to Admin User");</script>';

			  echo '<script>window.open("index.php","_parent");</script>';			  

			  exit;

			}

			}else{

			  echo '<script>alert("Unable to add Admin User");</script>';

			  echo '<script>window.open("index.php","_parent");</script>';			  

			  exit;

			}

		}

	}

}		

	$db->close();



    $pgTitle = "Admin Panel -- Secondary Admin Users [Add]";	

	$smarty->assign("title",$title);

	$smarty->assign("pgname",$pgname);		

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("admname",$admname);

	$smarty->assign("lname",$lname);

	$smarty->assign("admuname",$admuname);

	$smarty->assign("admemail",$admemail);

	$smarty->assign("admpwd",$admpwd);

	$smarty->assign("status",$Status);

	$smarty->display('admtpl/adduser.tpl');

		

?>