<?php
   	include_once('DBAccess/Database2.inc.php');
   	include_once('Classes/MyMailer.php');	
	//print_r($_SESSION['user2']);  echo $_SESSION['allowUser2'];
	$db = new Database;	
	$db->connect();
	$msg = '';
	$errors = '';
    if(isset($_POST['submit'])){
		//if($_POST['usertype']==''){$errors = '<br/> User type is required.';}
		//if($_POST['name']==''){$errors = '<br/> Customer/Account name is required.';}
		if($_POST['username']==''){$errors = '<br/> User name is required.';}
		if($_POST['password']==''){$errors = '<br/> Password is required.';}
		
		if($errors==''){
		if($_SESSION['allowUser2'] == '1'){			
			 $Query3  = "update ".patient." SET 
					phone			='".$_POST['phone']."',
					username		='".$_POST['username']."',
					password		='".$_POST['password']."' WHERE id='".$_SESSION['user2']['id']."' AND username='".$_SESSION['user2']['username']."' AND `password`='".$_SESSION['user2']['password']."'"; 
		  if($db->execute($Query3)){echo '<script>alert("Your profile updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
			}
		if($_SESSION['allowUser'] == '1'){	
			$Query3  = "update ".accounts." SET 
					phone			='".$_POST['phone']."',
					username		='".$_POST['username']."',
					password		='".$_POST['password']."' WHERE id='".$_SESSION['user']['id']."' AND username='".$_SESSION['user']['username']."' AND `password`='".$_SESSION['user']['password']."'";
		  if($db->execute($Query3)){echo '<script>alert("Your profile updated successfully.");</script>'; 
			echo "<script>location.href='index.php';</script>"; exit;};
						
			}	
			
		}
  }
  if($_SESSION['allowUser'] == '1'){
  $chkUser="SELECT * FROM accounts WHERE id='".$_SESSION['user']['id']."' AND username='".$_SESSION['user']['username']."' AND `password`='".$_SESSION['user']['password']."'";
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }

  if($_SESSION['allowUser2'] == '1'){
  $chkUser="SELECT * FROM patient WHERE id='".$_SESSION['user2']['id']."' AND username='".$_SESSION['user2']['username']."' AND `password`='".$_SESSION['user2']['password']."'";
					if($db->query($chkUser) && $db->get_num_rows() > 0){  $userData = $db->fetch_one_assoc(); } }

 include_once('includefile.php');
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
	//print_r($userData);
	$smarty->assign("data",$userData);
	$smarty->assign("errors",$errors);
	$smarty->assign("msg",$msg);
	$smarty->display('profile2.tpl');	
?>