<?php
   	include_once('../DBAccess/Database.inc.php');
	include('../Classes/pagination-class.php');	
	$db = new Database;	
	$noRec = '';
	$db->connect();
	
	  
	$Query = "SELECT * FROM request_info ";
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $admdetail = $db->fetch_all_assoc();
	   for($i=0;$i<sizeof($admdetail);$i++){
		   $Qup="UPDATE request_info SET clientname = '".str_replace('\'','`',$admdetail[$i]['clientname'])."' WHERE id = '".$admdetail[$i]['id']."'";
		   $db->execute($Qup);
		   }
	} 
   	$db->close();
    echo 'done';
?>