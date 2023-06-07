<?php
   	include_once('DBAccess/Database2.inc.php');
   	include_once('Classes/MyMailer.php');	
	//print_r($_SESSION['user2']);  echo $_SESSION['allowUser2'];
	$db = new Database;	
	$db->connect();
	$msg = '';
	$errors = '';
  if($_SESSION['type'] == 'ac'){
  $chkUser="SELECT * FROM accounts WHERE id='".$_SESSION['userdata']['id']."' "; 
  //AND username='".$_SESSION['userdata']['username']."' AND `password`='".$_SESSION['userdata']['password']."'
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }

  if($_SESSION['type'] == 'pa'){
  $chkUser="SELECT * FROM patient WHERE id='".$_SESSION['userdata']['id']."' ";
  //AND username='".$_SESSION['userdata']['username']."' AND `password`='".$_SESSION['userdata']['password']."'
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }
 if($_SESSION['type'] == 'cm'){
  $chkUser="SELECT * FROM casemanagers WHERE id='".$_SESSION['userdata']['cm_id']."' ";
  //AND username='".$_SESSION['userdata']['username']."' AND `password`='".$_SESSION['userdata']['password']."'
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }						
    if(isset($_POST['submit'])){
		if($_SESSION['type'] == 'ac'){
			
			
		$chkuser = "SELECT * FROM accounts WHERE username='".sql_replace($_POST['username'])."' AND username!='' AND  id !='".$_SESSION['userdata']['id']."' "; 
		if($db->query($chkuser) && $db->get_num_rows() > 0)
		 {
		    $errors .= "User name already exists, Try another one.<br>";    
		 }
	$chkuser = "SELECT * FROM accounts WHERE TRIM(LOWER(REPLACE(account_name,' ','')))='".strtolower(trim(str_replace(' ','',(sql_replace($_POST['account_name'])))))."'  AND  id !='".$_SESSION['userdata']['id']."' "; 
		if($db->query($chkuser) && $db->get_num_rows() > 0)
		 {
		    $errors .= "Account name already exists, Try another one.<br>";    
		 }
		 
			
			
		if($errors==''){ 
			$Query3  = "update ".accounts." SET 
					account_name				='".$_POST['account_name']."',
					address				='".$_POST['address']."',
					city				='".$_POST['city']."',
					state				='".$_POST['state']."',
					zip					='".$_POST['zip']."',
					username			='".$_POST['username']."',
					password			='".$_POST['password']."',
					phone				='".$_POST['phone']."'		 WHERE id='".$_SESSION['userdata']['id']."'    ";
		  if($db->execute($Query3)){echo '<script>alert("Your profile updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
			}
		}
		if($_SESSION['type'] == 'pa'){
		if($errors==''){ 
			$Query3  = "update ".patient." SET 
				phone	=	'".$_POST['phone']."' WHERE id='".$_SESSION['userdata']['id']."'    ";
		  if($db->execute($Query3)){echo '<script>alert("Your profile updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
			}
		}
		if($_SESSION['type'] == 'cm'){
		if($errors==''){ 
			$Query3  = "update casemanagers SET 
				phone	=	'".$_POST['phone']."' WHERE id='".$_SESSION['userdata']['cm_id']."'    ";
		  if($db->execute($Query3)){echo '<script>alert("Your profile updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
			}
		}
		}
$qstates  = "SELECT * FROM " .  states ;
	if($db->query($qstates) && $db->get_num_rows() > 0){	$states = $db->fetch_all_assoc();	$smarty->assign("states",$states); 	 }
 include_once('includefile.php');
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("data",$userData);
	$smarty->assign("errors",$errors);
	$smarty->assign("msg",$msg);
	$smarty->display('account_profile.tpl');	
?>