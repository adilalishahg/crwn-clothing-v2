<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
define("UPLOAD_DIR", "../receipts/");
    if (isset($_POST['driverID']) ) {  
        $driverID 			= $_POST['driverID'];
		$total_galon 		= $_POST['total_galon'];
		$price_per_galon 	= $_POST['price_per_galon'];
		$current_vehicle_milage = $_POST['current_vehicle_milage'];
		$receipt_amount			= round(($total_galon*$price_per_galon),2); 
		$Qsd="SELECT * FROM drivers WHERE drv_code ='".$driverID."'";
		if($db->query($Qsd) && $db->get_num_rows()>0){
			$drvdata = $db->fetch_one_assoc();
		$drv_id = $drvdata['Drvid'];
		$Qdv="SELECT * FROM dv_mapping WHERE drv_id ='".$drv_id."' LIMIT 1";
		if($db->query($Qdv) && $db->get_num_rows()>0){
			$dvmap = $db->fetch_one_assoc();}
		 }
        $vehicle_id = $dvmap['veh_id']; 
    }   
    else {
        $jsonarray = array();
        $jsonarray['status'] = 'false';
        $jsonarray['error'] = 'parameters are missing';
        echo json_encode($jsonarray);
        exit();
    }
/*if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    $maxid = $tripID;
    $filename = $name;
    $parts = pathinfo($filename);
    $filename_modified = $parts["filename"] . $maxid . "." . $parts["extension"];
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . $filename_modified);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }
    chmod(UPLOAD_DIR . $filename_modified, 0644);
}*/

if (!empty($_POST["myFile"])) {
    // Your file name you are uploading 
	
	/**************************item picture********************************************/
  $name=date('YmdHis');
  //$name='name';
  $image=$_POST['myFile'];
  $decodedImage=base64_decode("$image");
  file_put_contents(UPLOAD_DIR . $name. ".JPG", $decodedImage);
  $filepath=UPLOAD_DIR . $name. ".JPG";
 
/**************************item picture********************************************/
	
	
/*$file_name = $_FILES['myFile']['name'];
$random_digit=date('YmdHis');//rand(0000,9999);
$new_file_name=$random_digit.$file_name;
$path= UPLOAD_DIR.$new_file_name;
if(copy($_FILES['myFile']['tmp_name'], $path))
{ $filepath = $new_file_name;}
else{ $filepath = $new_file_name;}}*/
//	$filepath = $filename_modified; 
}
$insertquery = "INSERT INTO receipts SET receipt_path 		= '$filepath',
										driver_code			='$driverID',
										vehicle_id			='$vehicle_id',
										total_galon			='$total_galon',
										price_per_galon		='$price_per_galon',
										current_vehicle_milage='$current_vehicle_milage',
										receipt_amount		='$receipt_amount',
										uploadedon ='".date('Y-m-d H:i:s')."' ";
if ($db->execute($insertquery)) { 
    $jsonarray = array();
	$jsonarray['status'] = 'true'; 
    $jsonarray['userdata'] = 'file data uploaded successfully';
    echo json_encode($jsonarray);
}
 else {
   $jsonarray = array();
   $jsonarray['status'] = 'false';
   $jsonarray['error'] = 'Failed to insert file data !';
    echo json_encode($jsonarray);
 }
?>
