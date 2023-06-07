<?php
   	include_once('../DBAccess/Database.inc.php');
	include('../Classes/pagination-class.php');	
	$db = new Database;	
	$noRec = '';
	$db->connect();
	
	  
	$Query = "SELECT * FROM patient ";
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $admdetail = $db->fetch_all_assoc();
	   for($i=0;$i<sizeof($admdetail);$i++){
		   $Qup="UPDATE patient SET name = '".str_replace('\'','`',$admdetail[$i]['name'])."' WHERE id = '".$admdetail[$i]['id']."'";
		   $db->execute($Qup);
		   }
	} 
   	$db->close();
    echo 'done';
?>