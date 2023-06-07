<?php
/* *************************** *
	   * Created On : 14th october,2009 
	   * File : configuration/database_tables.php
	   * Created By : Muhammad Sajid
	   * Modified On : 14th october,2009 
	   * Modified By : Muhammad Sajid
	   *************************** */
	
   	//include_once('DBAccess/Database.inc.php');
	
   	include('include_file.php');
	
	$db = new Database;	
	$db->connect();
	
    $db->close();
	
	/*echo $_SESSION['adminuser'] . "<br>";
	echo $_SESSION['userid'] . "<br>";*/
	$pgTitle = "Admin Panel -- Home";
	$smarty->assign("pgTitle",$pgTitle);
	
    $smarty->display('index.tpl');
		
?>