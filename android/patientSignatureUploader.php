<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
define("UPLOAD_DIR", "../iphone/signature/");
    if (isset($_POST['driverID']) && isset($_POST['tripID']) && ($_FILES["myFile"]["size"] > 0)) {  
        $driverID = $_POST['driverID'];
        $tripID = $_POST['tripID']; 
    }   
    else {
        //echo 'username or passward is missing!';
        $jsonarray = array();
        $jsonarray['status'] = 'false';
        $jsonarray['error'] = 'parameters are missing';
        echo json_encode($jsonarray);
        exit();
    }

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
	$year_folder = UPLOAD_DIR . date("Y");
	$month_folder = $year_folder . '/' . date("m");
	!file_exists($year_folder) && mkdir($year_folder , 0777);
	!file_exists($month_folder) && mkdir($month_folder, 0777);
	
    $maxid = $tripID;
    $filename = $name;
    $parts = pathinfo($filename);
    $filename_modified = $parts["filename"] . $maxid . "." . $parts["extension"];
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . date("Y"). '/' . date("m"). '/' . $filename_modified);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }
    chmod(UPLOAD_DIR . date("Y"). '/' . date("m"). '/' . $filename_modified, 0644);
	
}
$filepath = date("Y"). '/' . date("m"). '/' .$filename_modified;   
if($_POST['patient_initial']){$Q = ",patient_initial='".$_POST['patient_initial']."'";}else{$Q = " ";}
$insertquery = "UPDATE trip_details SET signature = '$filepath' $Q WHERE tdid ='$tripID' ";
if ($db->execute($insertquery)) { 
   
     $jsonarray = array();
   $jsonarray['status'] = 'true'; 
   $jsonarray['userdata'] = 'file data uploaded successfully';
    echo json_encode($jsonarray);
    
}

 else {
  
     $jsonarray = array();
    $jsonarray['status'] = 'false';
    $jsonarray['error'] = 'Failed to insert filedata !';
    echo json_encode($jsonarray);
    //echo "<br>" . $status . "<br>";
 }
//mysql_close();


?>
