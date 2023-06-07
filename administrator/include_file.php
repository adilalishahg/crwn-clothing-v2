<?php
$daily_quta = 60;
$today=$_REQUEST['date'];
$Q = "SELECT * FROM setup";
		if($db->query($Q) && $db->get_num_rows() > 0){  $setupdata = $db->fetch_one_assoc();  }
?>