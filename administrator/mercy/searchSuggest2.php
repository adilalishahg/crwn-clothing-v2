<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
if (isset($_GET['search']) && $_GET['search'] != '') {
 //Add slashes to any quotes to avoid SQL problems.
 $search = $_GET['search'];
 $Q = "SELECT DISTINCT(phnum) FROM request_info WHERE phnum like '%".$search."%'"; 
 if($db->query($Q) && $db->get_num_rows()>0){ $data = $db->fetch_all_assoc();
 for($i=0; $i<sizeof($data); $i++) {
  echo $data[$i]['phnum'] . "\n";
 }
}}
?>
