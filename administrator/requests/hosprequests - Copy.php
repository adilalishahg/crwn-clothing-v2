<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;	
	$db->connect();
	$db2->connect();


 if(isset($_POST['queryString']) && $_POST['sta']){



       if($_POST['sta'] == '3' && $_POST['rea'] == ''){ echo 'Fail'; exit;	 }

 

	   $hospQuery = "SELECT ".TBL_HOSPITALS.".id,".TBL_HOSPITALS.".email_address,".TBL_HOSPITALS.".hospname,".TBL_REQUESTS.".userid,".TBL_REQUESTS.".reqid,  ".TBL_FORMS.".* 		          

		  FROM ".TBL_FORMS.",".TBL_HOSPITALS.",".TBL_REQUESTS." 

		  WHERE ".TBL_FORMS.".id='".$_POST['queryString']."' AND ".TBL_HOSPITALS.".id=".TBL_REQUESTS.".userid AND ".TBL_REQUESTS.".reqid=".TBL_FORMS.".req_id GROUP BY ".TBL_FORMS.".id";



	       if($db->query($hospQuery) && $db->get_num_rows() > 0 ){

			 $hospinfo = $db->fetch_all_assoc(); 

			 $found = 'yes';

			}else{

			 $found = 'no';

			}



  if($found == 'yes'){

		if($_POST['sta'] == '3'){ $ustatus = 'disapproved'; }else { $ustatus = 'approved'; }

		$qemail = "SELECT * FROM ".TBL_EMAIL;	

		if($db->query($qemail) && $db->get_num_rows() > 0)

		{

		   $emaildata = $db->fetch_all_assoc();

		}

	

  if($_POST['sta'] != '3'){

	$Query  = "UPDATE ".TBL_FORMS." SET 

			 	   reqstatus='$ustatus' WHERE id='".$_POST['queryString']."'";

		

			$from = $emaildata[0]['email'];

			$subject = 'Trip request Approved -- '.$emaildata[0]['cname'].'';

			$email = $hospinfo[0]['email_address'];			

			$body    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">

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

							Dear '.$hospinfo[0]['hospname'].',<br>

							Your trip request for the following Client is approved successfully:.<br><br>

							<b>Corporate Name:</b> '.$hospinfo[0]['clientname'].'.<br> 

							<b>Appointment Date:</b> '.convertDateFromMySQL($hospinfo[0]['appdate']).'<br> <b>Appointment Time:</b>'.$hospinfo[0]['apptime'].'<br><br>

							if you have any questions, contact us at <a href="mailto:'.$emaildata[0]['email'].'">'.$emaildata[0]['email'].'</a>

							</td>

						  </tr>

						  <tr>

							<td colspan="2" align="left">Regards! <br> '.$emaildata[0]['cname'].' Support Team!</td>

						  </tr>

						</table>';

			    

				    $sent = $mail->HtmlTxtMail($email,$from,$subject,$body);

					if($sent) { $sending = 'yes'; }				   

			   

   	}else{

	$Query  = "UPDATE ".TBL_FORMS." SET reqstatus='$ustatus', adminComments='".addslashes($_POST['rea'])."' WHERE id='".$_POST['queryString']."'";

 

$ems=$hospinfo[0]['email'];

			

			 if($ems != '')

			 {

			 $em=$hospinfo[0]['email'];

			 

			 }else{

			$em= $hospinfo[0]['email_address'];

			 };		

            $reason = addslashes($_POST['rea']);

  	        $from    = $emaildata[0]['email'];

 			$subject = 'Trip request Disapproved -- '.$emaildata[0]['cname'].'';

			$email   = $em;

			$body    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">

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

							Dear '.$hospinfo[0]['hospname'].',<br>

							Your trip request for the following Client has been disapproved:.<br>

							<b>Client Name:</b> '.$hospinfo[0]['clientname'].'.<br>

							<b>Appointment Date:</b> '.convertDateFromMySQL($hospinfo[0]['appdate']).'<br> <b>Appointment Time:</b>'.$hospinfo[0]['apptime'].'<br>

							<b>Reason:</b><i>'.$reason.'</i><br><br>

							if you have any questions, contact us at <a href="mailto:'.$emaildata[0]['email'].'">'.$emaildata[0]['email'].'</a>

							</td>

						  </tr>

						  <tr>

							<td colspan="2" align="left">Regards! <br> '.$emaildata[0]['cname'].' Support Team!</td>

						  </tr>

						</table>';

				    $sent = $mail->HtmlTxtMail($email,$from,$subject,$body);	

					if($sent) { $sending = 'yes'; }	



	}		 

	  if($db->execute($Query)){

            if($sending == 'yes'){  echo 'Success'; }

			}else{ echo 'Fail';	 }

        }else{ echo 'Fail'; }	

	 }else{ echo 'prob'; }



  $db->close();

  exit;

?>