<?php

   	include_once('../DBAccess/Database.inc.php');
	$db 	= new Database;
	$date 	= date('Y-m-d');
	$dataarray=''; 
	$db->connect();
	if(isset($_POST['recid']) && $_POST['recid'] > 0){
		$sqll = "UPDATE alerts SET recd = '1' WHERE id = ".$_POST['recid']." ";
		$db->execute($sqll);
		} else{
	$sql = "SELECT al.*,dr.fname,dr.lname FROM alerts as al LEFT JOIN drivers as dr on al.from=dr.drv_code WHERE al.sent BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' AND al.to = 'admin' AND al.recd = '0'  ORDER BY al.id ASC LIMIT 1 ";  
				  if($db->query($sql) && $db->get_num_rows() > 0)
				  { $data = $db->fetch_one_assoc();
				  $dataarray .= $data['id'];
				  $dataarray .= '@'.$data['fname'].' '.$data['lname'];
				  $dataarray .= '@'.$data['message'];
				  $dataarray .= '@'.$data['sent'];
				 

					  //print_r($data);
					  } else  { $dataarray = null; }
	}
	 echo $dataarray;
	
	$db->close();	
?> 