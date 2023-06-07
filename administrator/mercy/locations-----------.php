<?php
   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	/*$Query = "SELECT DISTINCT(picklocation),pickaddr FROM request_info WHERE picklocation!=''";
	if($db->query($Query) && $db->get_num_rows() > 0)  {$locations = $db->fetch_all_assoc();
		for($i=0;$i<sizeof($locations);$i++){
		$Qins="INSERT INTO locations SET location = '".sql_replace($locations[$i]['picklocation'])."',address = '".sql_replace($locations[$i]['pickaddr'])."'"; $db->execute($Qins);
			}
	}
	$Query2 = "SELECT DISTINCT(droplocation),destination FROM request_info  WHERE droplocation!=''"; 
	if($db->query($Query2) && $db->get_num_rows() > 0)  {$locations2 = $db->fetch_all_assoc();
		for($i=0;$i<sizeof($locations2);$i++){
		$Qins="INSERT INTO locations SET location = '".sql_replace($locations2[$i]['droplocation'])."',address = '".sql_replace($locations2[$i]['destination'])."'"; $db->execute($Qins);
			}
	}	*/
	$Query3="SELECT DISTINCT(location),address FROM locations GROUP BY location";
	if($db->query($Query3) && $db->get_num_rows() > 0)  {$locations3 = $db->fetch_all_assoc(); }
	$Qdelete="DELETE FROM locations"; $db->execute($Qdelete);
	for($i=0;$i<sizeof($locations3);$i++){
		$Qins3="INSERT INTO locations SET location = '".sql_replace($locations3[$i]['location'])."',address = '".sql_replace($locations3[$i]['address'])."'"; $db->execute($Qins3);
			}
	
?>