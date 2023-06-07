<?php 
exit;
	include('include_file.php');
	$db = new Database;	
	$error = '';
	$msg   = '';
	$db->connect();
		$qry = "SELECT * FROM trip_details";
		if($db->query($qry) && $db->get_num_rows()){	$info = $db->fetch_all_assoc();		}
for($i=0; $i<sizeof($info); $i++){
	$type=$info[$i]['type'];
	if($type=='AB'){$type_type='1';}
	if($type=='BF'){$type_type='2';}
	$UP="UPDATE billing_info SET status = '".$info[$i]['status']."' WHERE trip_id= '".$info[$i]['reqid']."' AND leg='".$type_type."' LIMIT 1";
	$db->query($UP);
	}
echo 'Done'; exit;

	$db->close();


?>