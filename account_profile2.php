<?php
   	include_once('DBAccess/Database2.inc.php');
   	include_once('Classes/MyMailer.php');	
	$db = new Database;	
	$db->connect();
	$msg = '';
	$errors = '';
  if($_SESSION['type'] == 'ac'){
  $chkUser="SELECT * FROM accounts WHERE id='".$_SESSION['userdata']['id']."' "; 
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }
  if($_SESSION['type'] == 'pa'){
  $chkUser="SELECT * FROM patient WHERE id='".$_SESSION['userdata']['id']."' ";
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }	
	if($_SESSION['type'] == 'cm'){
  $chkUser="SELECT * FROM casemanagers WHERE id='".$_SESSION['userdata']['cm_id']."' ";
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }					

    if(isset($_POST['submit'])){
		if($_SESSION['type'] == 'ac'){
		if($_POST['username']==''){$errors .= '<br/> User Name is required.';}
		if($_POST['password']==''){$errors .= '<br/> Password is required.';}
		if($errors==''){ 
			$Query3  = "update ".accounts." SET 
					username			='".$_POST['username']."',
					password			='".$_POST['password']."' WHERE id='".$_SESSION['userdata']['id']."'    ";
		  if($db->execute($Query3)){echo '<script>alert("Your setting updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
						
			}
		}
		if($_SESSION['type'] == 'pa'){
		if($_POST['username']==''){$errors .= '<br/> User Name is required.';}
		if($_POST['password']==''){$errors .= '<br/> Password is required.';}
		if($errors==''){ 
			$Query3  = "update ".patient." SET 
					username			='".$_POST['username']."',
					password			='".$_POST['password']."' WHERE id='".$_SESSION['userdata']['id']."'    ";
		  if($db->execute($Query3)){echo '<script>alert("Your setting updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
			}
		}
		if($_SESSION['type'] == 'cm'){
		if($_POST['username']==''){$errors .= '<br/> User Name is required.';}
		if($_POST['password']==''){$errors .= '<br/> Password is required.';}
		if($errors==''){ 
			$Query3  = "update casemanagers SET 
					username			='".$_POST['username']."',
					password			='".$_POST['password']."' WHERE id='".$_SESSION['userdata']['cm_id']."'    ";
		  if($db->execute($Query3)){echo '<script>alert("Your setting updated successfully.");</script>'; 
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
	$smarty->display('account_profile2.tpl');	
?>