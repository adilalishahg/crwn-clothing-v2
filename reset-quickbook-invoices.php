<?php
include_once('DBAccess/Database2.inc.php');

	$db = new Database;	

	$db->connect();
	
	
	if(isset($_GET['account']) && isset($_GET['start']) && isset($_GET['end'])){
		$start_date=$_GET['start'];
		$end_date=$_GET['end'];
		$account=$_GET['account'];

		if((!empty($start_date))&&(!empty($end_date))&&(!empty($account)))
		{
			$query_trips="SELECT trip_id FROM trips WHERE account='".$account."' AND  trip_date >='".$start_date."' AND trip_date <='".$end_date."'";
			if($db->query($query_trips) && $db->get_num_rows() > 0)
			{ 
				$data = $db->fetch_all_assoc();
				for($i=0; $i<sizeof($data); $i++){
					$trip_id=$data[$i]['trip_id'];
					$query_update="UPDATE trip_details SET detail_quick=0 WHERE date >= '".$start_date."' AND date <='".$end_date."' AND trip_id='".$trip_id."'";
					$db->execute($query_update);
				}
				echo "quickbook sync status reset";
			}
		}
		else{
			echo "missing required request URI data";
		}
	}
	