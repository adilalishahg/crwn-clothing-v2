<?php

   	include_once('../DBAccess/Database.inc.php');
	$db = new Database;
	$db->connect();
				{ $sql = "UPDATE ".TBL_DRIVERS." SET trip_status = '0',trip_assingment='0' "; 
					$db->execute($sql);
				}
	$db->close();	

?> 