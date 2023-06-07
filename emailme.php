<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

require 'vendor/autoload.php';

function sendmail_to_contact($body,$emailto,$title,$attachment=''){ 

	$mail = new PHPMailer(true);

	try {

	//Server settings

	$mail->SMTPDebug = 0; //Enable verbose debug output

	$mail->isSMTP(); //Send using SMTP

	$mail->Host = 'smtp.office365.com'; //Set the SMTP server to send through

	$mail->SMTPAuth = true; //Enable SMTP authentication

	$mail->Username = 'quote@hybriditservices.com'; //SMTP username

	$mail->Password = 'Yat28413'; //SMTP password

	$mail->SMTPSecure = 'SSL';PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption

	$mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients

	$mail->setFrom('quote@hybriditservices.com', 'Up Scale');

	$mail->addAddress($emailto, $title); //Add a recipient

	//$mail->addAddress('ellen@example.com'); //Name is optional

	//$mail->addReplyTo('usman@azlaantechnologies.com', 'Information');

	//$mail->addCC($cc);

	//$mail->addBCC('bcc@example.com');

	if($attachment !=''){

		//Attachments

		$mail->addAttachment('pdf/File_'.$attachment.'.pdf'); //Add attachments

		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

	}else{

	}

	//Content

	$mail->isHTML(true); //Set email format to HTML

	$mail->Subject = $title;

	$mail->Body = $body;

	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$result = $mail->send();

		//echo 'Message has been sent';

	} catch (Exception $e) {

		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

	}

	return $result;

}

//sendmail_to_contact('Testing email from developer','usman@azlaantechnologies.com','Testing SMTP mail setting');

?>