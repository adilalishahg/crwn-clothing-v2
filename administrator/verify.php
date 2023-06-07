<?php
require_once('DBAccess/Database.inc.php');
include_once('configuration/site_functions.php');
$db1 = new Database;
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


$admin_session	=	generatetripnumber();
$ipaddress		= 	get_client_ip();
$browser		= 	get_browser_name($_SERVER['HTTP_USER_AGENT']);
$user	    	= base64_decode(sql_replace($_REQUEST['user']));	
$password   	= base64_decode(sql_replace($_REQUEST['password']));
$validateqry = "SELECT * FROM ".TBL_ADMIN." WHERE admin_status='Active' AND admin_uname='".$user."' AND admin_password='".$password."'";
if($db1->query($validateqry) && $db1->get_num_rows() > 0){
	$userdet = $db1->fetch_all_assoc();
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
	$db1->execute($Qup);
	$db1->close();
	echo '<script>window.open("index.php","_parent");</script>';
	exit;
}else{
	echo '<script>window.open("login.php","_parent");</script>';
	exit;	
}
?>