<?php
include_once('includefile.php');

if (isset($_SESSION['allowUser']) || $_SESSION['allowUser'] != '') {
	echo '<script>location.href="index.php";</script>';
	exit;
}
if ($_POST && $_POST['username'] != '' && $_POST['password'] != '' && $_POST['token_sent'] == $_SESSION['token']) {

	$chkUser1 = "SELECT * FROM " . accounts . " WHERE username='" . $_POST['username'] . "' AND `password`='" . $_POST['password'] . "' AND username!='' AND `password`!=''";
	//$chkUser2 = "SELECT * FROM ".patient." WHERE username='".$_POST['username']."' AND `password`='".$_POST['password']."' AND username!='' AND `password`!=''";
	// print_r($chkUser1);exit;
	if ($db->query($chkUser1) && $db->get_num_rows() > 0) {
		$userData = $db->fetch_one_assoc();
		if ($userData['status'] == 'Active' && $userData['portal_access']) {
			$_SESSION['allowUser'] = 1;
			$_SESSION['type'] = 'ac';
			$_SESSION['userdata'] = $userData;
			$_SESSION['loginID'] = $userData['id'];
			$_SESSION['loginName'] = $userData['account_name'];
			echo '<script>location.href="index.php";</script>';
			exit;
		} else {
			$messages = '<br/><br/>Your account is inactive. Please contact your dispatch admin.';
		}
	} else {
		$errors = '<br/><br/>Wrong credentials. Invalid username or password.';
	}

	// print_r($userData);



}
if (!session_id()) {
	session_start();
}

if (empty($_SESSION['token'])) {
	if (function_exists('mcrypt_create_iv')) {
		$_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	} else {
		$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	}
}
$token = $_SESSION['token'];
if ($account_type == '') {
	$account_type = 'account';
}
$db->close();
$smarty->assign("errors", $errors);
$smarty->assign("messages", $messages);
$smarty->assign("servicesdata", $servicesdata);
$smarty->assign("foot", $foot);
$smarty->assign("token", $token);
$smarty->assign("account_type", $account_type);
$smarty->assign("pg", 'triprequest');
$smarty->display('login.tpl');
