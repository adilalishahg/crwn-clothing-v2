<?php
include_once('includefile.php');
include_once('functions.php');
include_once('emailme.php');
$errors=[];
$messages=[];
if(isset($_POST['submit'])){
    $facility_name=$_POST['facility_name'];
    $person_name=$_POST['person_name'];
    $phone_number=$_POST['phone_number'];
    $email=$_POST['email'];
    $client_address=$_POST['client_address'];
    $message=$facility_name.','.$person_name.','.$phone_number;
    $message.=','.$client_address;
    if(!preg_match('/^[a-zA-Z ]*$/', $facility_name)){
        writeLog($message.",1");
        $errors[]="Invalid Facility Name";
    }
    if(!preg_match('/^[a-zA-Z ]*$/', $person_name)){
        writeLog($message.",2");
        $errors[]="Invalid Person Name";
    }
    if(!preg_match("/\([0-9]{3}\)-[0-9]{3} [0-9]{4}/", $phone_number)) {
        writeLog($message.",3");
        $errors[]="Invalid Phone Numer";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        writeLog($message.",4");
        $errors[]="Invalid Email";
    }
    if(preg_match('/[<>:;@#+=^%!~]/', $client_address)){
        writeLog($message.",5");
        $errors[]="Invalid Address";
    }
    if(sizeof($errors)==0){
        $body="Hi Upscale, A client has sent request for sign up from the front portal. Following are the inforamtion:<br>";
        $body.="<table>
            <tr>
                <th>Facility Name : </th>
                <td>$facility_name</td>
            </tr>
            <tr>
                <th>Person Name : </th>
                <td>$person_name</td>
            </tr>
            <tr>
                <th>Phone Number : </th>
                <td>$phone_number</td>
            </tr>
            <tr>
                <th>Email : </th>
                <td>$email</td>
            </tr>
            <tr>
                <th>Client Address : </th>
                <td>$client_address</td>
            </tr>
        </table>";
        $query = "SELECT * FROM contact_info";
        if($db->query($query) && $db->get_num_rows()>0){
            $contactinfo=$db->fetch_one_assoc();
        }
        if(sendmail_to_contact($body,$contactinfo['email'],"Client Sign Up")){
            $messages[]="We will contact you as soon as we setup your account portal.";
        };
    }    
}
$db->close();
$smarty->assign("errors",$errors);
$smarty->assign("messages",$messages);
$smarty->assign("servicesdata",$servicesdata);
$smarty->assign("contactinfo",$contactinfo);
$smarty->assign("pg",'UpScale | Sign Up');			
$smarty->display('signup.tpl');	