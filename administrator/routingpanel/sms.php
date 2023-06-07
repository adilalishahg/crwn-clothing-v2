<?php



# Blast-email.php



# Abid Mehmood Malik



# March 23, 2010







include_once('../DBAccess/Database.inc.php');
include_once("../Classes/MyMail.php");
include_once('../TextMarksV2APIClient.php');




 //	include_once('../Classes/MailAttach.php');	



//$mail = new MyMailer;



$db = new Database;	



$db->connect();















 if (isset($_GET))



{



	$s_id = $_GET['id'];



    $tQuery = 	"SELECT  DISTINCT (td.drv_id)



							   FROM ".TBL_TRIPS." as t, ".TBL_TRIP_DET." as td



							   WHERE t.sheet_id = $s_id AND  td.trip_id = t.trip_id ";



	if($db->query($tQuery) && $db->get_num_rows() > 0)



	{



		$trips = $db->fetch_all_assoc();



	}



	



   $sQuery = 	"SELECT * FROM ".TBL_SHEET." WHERE sheet_id = $s_id";



	if($db->query($sQuery) && $db->get_num_rows() > 0)



	{



		$sheet = $db->fetch_all_assoc();



	}







 



  



  $sheet_file=$sheet[0]['sheet_name'];







  $f_name="../routing-sheets/".$sheet_file;    // use relative path OR ELSE big headaches. $letter is my file for attaching. 







  $handle=fopen($f_name, 'rb'); 



  $f_size=filesize($f_name); 



  $f_contents=fread($handle, filesize($f_name)); 



  $f_contents=chunk_split(base64_encode($f_contents));    //Encode The Data For Transition using base64_encode(); 



  $f_type=filetype($f_name); 



  $num = md5(time());







#--------------------------------------- E mail Body --------------------------------------------------#







	$subject = 'Auto-Generated Trip Request Notification!';



	



	$message = 'Dear,<br><br>Please find the attached Routing sheet, and mark your trips.<br><br>';



#-------------------------------------------------- end ------------------------------------------------#







 //Normal headers







       $headers  = "From: Support<agent@hybridTracktrans.com>\r\n";



       $headers  .= "MIME-Version: 1.0\r\n";

       $headers  .= "Content-Type: multipart/mixed; ";

      $headers  .= "boundary=".$num."\r\n";

       $headers  .= "--$num\r\n";







        // This two steps to help avoid spam   







     /*  $headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n";



       $headers .= "X-Mailer: PHP v".phpversion()."\r\n";   */      







        // With message



       



       $headers .= "Content-Type: text/html; charset='iso-8859-1'";

       $headers .= "Content-Transfer-Encoding: 8bit\r\n";

       $headers .= "".$message."\n";

       $headers .= "--".$num."\n"; 



        // Attachment headers



      $headers  .= "Content-Type:".$f_type." ";

       $headers  .= "name=\"".$sheet_file."\"r\n";

       $headers  .= "Content-Transfer-Encoding: base64\r\n";

       $headers  .= "Content-Disposition: attachment; ";

       $headers  .= "filename=\"".$sheet_file."\"\r\n\n";

       $headers  .= "".$f_contents."\r\n";

       $headers  .= "--".$num."--";









    // SEND MAIL



       



	$count = 0;



	$total = sizeof($trips);



	for($i=0;$i<$total;$i++)



	{



		$code  = $trips[$i]['drv_id'];



		$eQuery = "SELECT  *

								 FROM ".TBL_DRIVERS." as d, ".TBL_TRIP_DET." as td ,".TBL_TRIPS." as t ,".TBL_SHEET." as sh

								WHERE d.drv_code=td.drv_id and sh.sheet_id = $s_id and d.drv_code = '$code'";



		if($db->query($eQuery) && $db->get_num_rows() > 0)



		{



			$to_email = $db->fetch_row_assoc();



		}



     $to =  $to_email['cell_num'];
	 $name=$to_email['trip_clinic'];
     $phone=$to_email['trip_tel'];
	 $addr1=$to_email['pck_add'];		
	 $addr2=$to_email['drp_add'];
	 $ptime=$to_email['pck_time'];
	 $date=$to_email['date'];
	 $tipid=$to_email['tdid'];



		if($to != '')



		{		  

		    $sMyApiKey        = 'midnimomedtrans__13b1df9a';
			$sMyTextMarksUser = 'hybrid_dispatch';
			$sMyTextMarksPass = 'hybrid123';
			$sKeyword         = 'MIDNIMO';
			$sPhone           = $to;
			$tmapi = new TextMarksV2APIClient($sMyApiKey, $sMyTextMarksUser, $sMyTextMarksPass);
			$resp = $tmapi->call('GroupLeader', 'has_member', array(
			   'tm' => $sKeyword,
			   'user' => $sPhone
			));
			if($resp['body']['member'] == 1){
				$sMyApiKey        = 'midnimomedtrans__13b1df9a';
				$sMyTextMarksUser = 'hybrid_dispatch';
				$sMyTextMarksPass = 'hybrid123';
				$sKeyword         = 'MIDNIMO';
				$sPhone           = $to;
				$sMessage = "Tripid:$tipid\n-\nName:$name\n-\nPh#$phone\n-\nPick:$addr1\n-\nDrop:$addr2\n-\nTime:$ptime\n-\nDate:$date";
				$tmapi = new TextMarksV2APIClient($sMyApiKey, $sMyTextMarksUser, $sMyTextMarksPass);
				$resp = $tmapi->call('GroupLeader', 'send_one_message', array(
				   'tm' => $sKeyword,
				   'msg' => $sMessage,
				   'to' => $sPhone
				));	
			}	

					  

		  

	

 $count = $count + 1;



		}



	}



	$sQuery = "UPDATE ".TBL_SHEET."



							SET sms = '1'



							WHERE sheet_id  = '$s_id' ";



	if($db->execute($sQuery))



	{



		echo "<script>alert('Sms sent to ".$count." Drivers out of ".$total."');</script>";



		echo'<script>location.href="index.php";</script>';



		exit;



	}



}























?>