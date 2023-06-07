<?php
require_once('../DBAccess/Database.inc.php');

	$db = new Database;	
	$db->connect();
	$sun = '';
	    $id = $_POST['id'];
		$addtype = $_POST['addtype'];
		$qursel = "SELECT pck_add,drp_add FROM trip_details WHERE tdid = '$id'";
		if($db->query($qursel) && $db->get_num_rows() > 0) { $data = $db->fetch_one_assoc(); }
		 $add = $data['pck_add'];
		 $add2 = $data['drp_add'];
		 $c = getLatLong($add);
		 $c2 = getLatLong($add2);
		 if($c !=''){
		$qu = "UPDATE trip_details SET pick_latlong = '$c', drop_latlong = '$c2' WHERE tdid = '$id'";
		if($db->execute($qu)) { echo 1; } } 
	
function getLatLong($address){
    if (!is_string($address))die("All Addresses must be passed as a string");
    $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
    $_result = false;
    if($_result = file_get_contents($_url)) {
        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
        $lat  = $_match[1];
        $long = $_match[2];
		$_coords = $lat.','.$long; 
    }
    return $_coords;
}	


	$db->close();
    ?>