<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
$db->connect();
	$pickup_ch 		= $_POST['pickup_ch'];
	$permile_ch 	= $_POST['permile_ch'];
	$waittime_ch 	= $_POST['waittime_ch'];
	$noshow_ch 		= $_POST['noshow_ch'];
	$afterhour_ch 	= $_POST['afterhour_ch'];
	$stretcher_ch	= $_POST['stretcher_ch'];
	$dstretcher_ch 	= $_POST['dstretcher_ch'];
	$bstretcher_ch 	= $_POST['bstretcher_ch'];
	$doublewheel_ch	= $_POST['doublewheel_ch'];
	$oxygen_ch 	= $_POST['oxygen_ch'];
	$id 	    = $_POST['id'];
	$query="UPDATE  clinic_rates SET
							pickup_ch 		=  '$pickup_ch',
							permile_ch 		=  '$permile_ch',
							waittime_ch 	=  '$waittime_ch',
							noshow_ch 		=  '$noshow_ch',
							afterhour_ch 	=  '$afterhour_ch',
							stretcher_ch 	=  '$stretcher_ch',
							dstretcher_ch 	=  '$dstretcher_ch',
							bstretcher_ch 	=  '$bstretcher_ch',
							doublewheel_ch 	=  '$doublewheel_ch',
							
							un25 	=  '".$_POST['un25']."',
							un30 	=  '".$_POST['un30']."',
							un35 	=  '".$_POST['un35']."',
							un40 	=  '".$_POST['un40']."',
							un45 	=  '".$_POST['un45']."',
							rate3 	=  '".$_POST['rate3']."',
							rate6 	=  '".$_POST['rate6']."',
							rate10 	=  '".$_POST['rate10']."',
							
							
							oxygen_ch 	=  '$oxygen_ch' WHERE 	id 	=  '$id'"; 
		$db->query($query); 
		echo 1;
	?>  