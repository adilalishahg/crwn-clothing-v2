<?php

   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;
	$db->connect();
	$do = $_POST['action'];
	if($do == 'refresh'){ $qry_st  = "SELECT refresh FROM ".TBL_CONTACT." WHERE c_id='1'" ;
					if($db->query($qry_st) && $db->get_num_rows() > 0){
						$data = $db->fetch_one_assoc();
						} echo $data['refresh'];
				}
	if($do == 'refreshed') { $qry_refreshed = "UPDATE ".TBL_CONTACT." SET refresh = '0' WHERE c_id='1' "; $db->execute($qry_refreshed); }			
	$db->close();	

?> 