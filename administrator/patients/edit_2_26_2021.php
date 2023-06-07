<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$msgs   = '';
	$errors = '';
$db->connect();
  if(isset($_POST['admusersub']))
	   { //print_r($_POST); exit;
	   $name   		= sql_replace(str_replace('\'','`',$_POST['name']));	
	   $sex   		= sql_replace($_POST['sex']);	
	   $insurance_name  			= sql_replace(str_replace('\'','`',$_POST['insurance_name']));
	   $insurance   	= sql_replace($_POST['insurance']);
	   $ssn   		= sql_replace($_POST['ssn']);
	   $dob    		= convertDateToMySQL(sql_replace($_POST['dob']));	   
	   $address    	= sql_replace($_POST['address']);
	   $roomsite    	= sql_replace($_POST['roomsite']);
	   $city    		= sql_replace($_POST['city']);
	   $state    		= sql_replace($_POST['state']);
	   $zip    		= sql_replace($_POST['zip']);
	   $phone    		= sql_replace($_POST['phone']);
	   $id    			= sql_replace($_POST['id']);
	   $comments   		= sql_replace($_POST['comments']);
	   
	   /*if(!$name){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Name is required.<br>"; }
	   if(!$insurance){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Patient ID is required.<br>"; }
	   if($insurance){$Qin="SELECT * FROM patient WHERE insurance = '".$insurance."' AND id!='".$id."' LIMIT 1";
	   					if($db->query($Qin) && $db->get_num_rows()>0){
							$error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Insurance ID Already exist.<br>"; }}
	   if(!$address){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Address is required.<br>"; }
	   if(!$city){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;City is required.<br>"; }
	   if(!$state){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;State is required.<br>"; }
	   if(!$zip){ $error .= "<img src='../images/arrow.jpg'>&nbsp;&nbsp;Zip is required.<br>"; }*/
	   	   
    if($error == '')
         {
		  $Query3  = "UPDATE patient SET
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
					comments='$comments'
					 WHERE id = '$id'";
		  if($db->execute($Query3))
		    { 
	$Query4  = "UPDATE request_info SET
						clientname='$name',
						sex='$sex',
						insurance_name='$insurance_name',
						dob='$dob',
						phnum='$phone'
						WHERE clientname = '".$_POST['pre_name']."' ";
			$db->execute($Query4);
			$Query5  = "UPDATE trips SET 
						trip_user	=	'$name',
						trip_tel	=	'$phone'
						WHERE trip_user = '".$_POST['pre_name']."' ";
			$db->execute($Query5);			
			  echo '<script>alert("Patient Updated Successfully");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;    }else{
			  echo '<script>alert("Unable to Update Patient");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
}
if(isset($_GET['id'])){ $id= $_GET['id']; }	
$QuerySelect = "SELECT * FROM patient WHERE id = '$id'"; if($db->query($QuerySelect) && $db->get_num_rows() > 0){ $data = $db->fetch_one_assoc(); }
//GET STATES LIST
    $gstat = "SELECT * FROM ".TBL_STATES; if($db->query($gstat) && $db->get_num_rows() > 0){$slist=$db->fetch_all_assoc();}	
	$db->close();
    $pgTitle = "Admin Panel -- [Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("post",$_POST);
	$smarty->assign("data",$data);
	$smarty->assign("id",$id);
	$smarty->assign("slist",$slist);
	$smarty->display('patientstpls/edit.tpl');
?>