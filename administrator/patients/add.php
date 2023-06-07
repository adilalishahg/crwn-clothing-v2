<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
$db->connect();
  if(isset($_POST['admusersub']))
	   { //print_r($_POST); exit;
	    $name   		= sql_replace(str_replace('\'','`',$_POST['name']));	
	   $sex   			= sql_replace($_POST['sex']);	
	   $insurance_name  = sql_replace(str_replace('\'','`',$_POST['insurance_name']));
	   $insurance   	= sql_replace($_POST['insurance']);
	   $ssn   		= sql_replace($_POST['ssn']);
	   $dob    		= convertDateToMySQL(sql_replace($_POST['dob']));	   
	   $address    	= sql_replace($_POST['address']);
	   $roomsite    	= sql_replace($_POST['roomsite']); 
	   $city    		= sql_replace($_POST['city']);
	   $state    		= sql_replace($_POST['state']);
	   $zip    			= sql_replace($_POST['zip']);
	   $phone    		= sql_replace($_POST['phone']);
	   $comments   		= sql_replace($_POST['comments']);
	   
	   /* if(!$name){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Name is required.<br>"; }
	  if(!$insurance){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Patient ID is required.<br>"; }
	   if(!$address){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Address is required.<br>"; }
	   if(!$city){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;City is required.<br>"; }
	   if(!$state){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;State is required.<br>"; }
	   if(!$zip){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Zip is required.<br>"; }
	   if($insurance){$Qin="SELECT * FROM patient WHERE insurance = '".$insurance."' LIMIT 1";
	   					if($db->query($Qin) && $db->get_num_rows()>0){
							$error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Insurance ID Already exist.<br>"; }}*/
    if($error == '')
         {
		  $Query3  = "INSERT INTO patient SET
					name='$name',
					sex='$sex',
					insurance_name='$insurance_name',
					insurance='$insurance',
					ssn='$ssn',
					dob='$dob',
					address='$address',
					roomsite='$roomsite',
					city='$city',
					state='$state',
					zip='$zip',
					phone='$phone',
					comments='$comments' ";
		  if($db->execute($Query3))
		    {
			  echo '<script>alert("Patient added Successfully");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;    }else{
			  echo '<script>alert("Unable to add Patient");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
}	


//GET STATES LIST
    $gstat = "SELECT * FROM ".TBL_STATES; if($db->query($gstat) && $db->get_num_rows() > 0){$slist=$db->fetch_all_assoc();}	
	$db->close();
    $pgTitle = "Admin Panel -- [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("data",$_POST);
	$smarty->assign("slist",$slist);
	$smarty->assign("net_center",$net_center);
	$smarty->display('patientstpls/add.tpl');
?>