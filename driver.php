<?php
include_once('DBAccess/Database2.inc.php');
$dri_code = $_GET['dri_code'];
	$a	=	$_GET['a'];
	$b	=	$_GET['b'];
$smarty->assign("dri_code",$dri_code);
$smarty->assign("a",$a);
$smarty->assign("b",$b);
$smarty->display('onedriver.tpl');



?> 
