<?php
 include_once('includefile.php');
 
 if(isset($_SESSION['allowUser']) || $_SESSION['allowUser'] != ''){
	echo '<script>location.href="index.php";</script>';
	exit; }
if($_POST && $_POST['username'] !='' && $_POST['password'] !='' && $_POST['token_sent']==$_SESSION['token']){
	 $chkUser = "SELECT ac.request_option,ca.* FROM casemanagers as ca LEFT JOIN accounts as ac on ca.account_id=ac.id WHERE ca.username='".$_POST['username']."' AND ca.password='".$_POST['password']."' AND ca.username!='' AND ca.`password`!=''"; 
		if($db->query($chkUser) && $db->get_num_rows() > 0){ 
			$userData = $db->fetch_one_assoc();
			if($userData['status']=='Open'){ 
				$_SESSION['allowUser'] = 1;  
				$_SESSION['type'] = 'cm'; 
				$userData['account']=$userData['account_id']; 
				$userData['cm_id']=$userData['id'];
				$_SESSION['userdata'] = $userData;
				echo '<script>location.href="index.php";</script>';  exit;	
			}else{
				$messages='Your account is inactive. Please contact your dispatch admin.';
			}
		}else{
			$errors='Unable to login. Please try again.';
		}
		 // print_r($userData);
	}	
if( !session_id() ) {  session_start();  }
if(empty($_SESSION['token'])) {
    if(function_exists('mcrypt_create_iv')) {
        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    }else{
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
	$token = $_SESSION['token'];

	$db->close();
	$smarty->assign("errors",$errors);
	$smarty->assign("messages",$messages);
	$smarty->assign("servicesdata",$servicesdata);
	$smarty->assign("foot",$foot);
	$smarty->assign("token",$token);
	$smarty->assign("pg",'triprequest');			
    $smarty->display('login_casemanager.tpl');	
?>