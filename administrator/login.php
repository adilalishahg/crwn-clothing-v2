<?php

	require_once('DBAccess/Database.inc.php');
	include_once('configuration/site_functions.php');
	$db = new Database;	
	$db1 = new Database;	
    
	$error = '';
		
	$db->connect();
	$db1->connect();
	
	
	function get_client_ip(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
		  $ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
		  $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
		  $ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
		  $ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		  $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
		  $ipaddress = getenv('REMOTE_ADDR');
		else
		  $ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
		
	function get_browser_name($user_agent){
		if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
		elseif (strpos($user_agent, 'Edge')) return 'Edge';
		elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
		elseif (strpos($user_agent, 'Safari')) return 'Safari';
		elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
		elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
		return 'Other';
	}
	
	
	if(count($_POST)){



	$admin_user = sql_replace($_POST['adminname']);

		$password1 = sql_replace($_POST['adminpass']);

		$secode = sql_replace($_POST['pincode']);
if(!$admin_user){

		  $msg .= "Username Missing !<br>";

		}

		

		if(!$password1){

		  $msg .= "Password Missing !<br>";

		}

		
/*
		if(!$secode){

		  $msg .= "Security Code Missing !<br>";

		}else{		

		if($_SESSION['security_code'] != $secode){

		  $msg .= "Invalid Security Code !<br>";

		}}				
*/


if(strstr($password," ")){
	 $msg = 'Spaces not allowed in password'; 
}  

if($msg == ''){	

	$status='Active';
	$hashpwd = "";
	$hashpwd = $password1;
	$status='Active';
	$validateqry = "SELECT * FROM ".TBL_ADMIN." WHERE admin_status='$status' AND admin_uname='".$admin_user."' AND admin_password='".$hashpwd."'";
	if($db1->query($validateqry) && $db1->get_num_rows() > 0){
		$userdet = $db1->fetch_all_assoc();
		if(!empty($userdet[0]['admin_session'])){
			$admin_user = base64_encode($admin_user);
			$hashpwd = base64_encode($hashpwd);
	?>
	<script type="text/javascript" language="javascript">
		var ok=confirm("Are you sure you want to create new session?\n\nAfter creating new session you will be logged out automatically from previous session if on dispatch screen.\n\nPrevious Session Details Below; \n\nIP Address: <?php echo $userdet[0]['ipaddress'];?>\nBrowser Name: <?php echo $userdet[0]['browser'];?>\nLast login on: <?php echo $userdet[0]['lastlogin']?>\n\nClick Cancel to go back to login screen");
		if(ok){
			window.open("verify.php?user=<?php echo $admin_user;?>&password=<?php echo $hashpwd;?>","_parent");
		}else{
			window.open("login.php","_parent");
		}
        </script> 
	<?php
		}else{
			$admin_session	=	generatetripnumber();
			$ipaddress		= 	get_client_ip();
			$browser		= 	get_browser_name($_SERVER['HTTP_USER_AGENT']);
			
			$_SESSION['allow_print'] = 'accessInFileAllowed';	  
			$_SESSION['adminuser']   = $userdet[0]['admin_uname'];
			$_SESSION['adminname']   = $userdet[0]['admin_name'];
			$_SESSION['userid']      = $userdet[0]['admin_id'];
			$_SESSION['username']    = 'admin';
			$_SESSION['admuser']     = $userdet[0];
			$_SESSION['admin_session']= $admin_session;
			//update admin session
			$computername=php_uname('n');
			$Qup="UPDATE ".TBL_ADMIN." SET admin_session='".$admin_session."',
				ipaddress	=	'".$ipaddress."',
				browser		=	'".$browser."',
				computername=	'".$computername."',
				lastlogin	=	'".date('Y-m-d H:i:s')."' 
			WHERE admin_id ='".$userdet[0]['admin_id']."'";  
			$db->execute($Qup);
			echo '<script>window.open("index.php","_parent");</script>';
			exit;
		}
  }
  
   else{

		     $msg .= "Invalid Username/Password<br>";

		  

		  } 
  }
}  

	if(!isset($_SESSION['footer'])){
		// Footer
		$qry_footer  = "SELECT * FROM " .  TBL_COPY_RIGHTS ;
	if($db->query($qry_footer) && $db->get_num_rows() > 0){
		$footer = $db->fetch_all_assoc();
		
	 }
	 $foot = $footer[0]['description'];
	 $_SESSION['footer'] =  $foot;
    }
	
		
	$db->close();
	$db1->close();
	
    $pgTitle = "Admin Panel -- Login";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msg",$msg);
	$smarty->assign("adminname",$adminname);
    $smarty->assign("adminpass",$adminpass);	
	$smarty->display('login.tpl');
		
?>