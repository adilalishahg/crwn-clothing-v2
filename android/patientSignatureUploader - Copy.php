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
  /*  // $conn =  mysql_connect($dbname,$dbs,$dbpasswd);
	mysql_select_db($dbs);

   if ($conn->connect_errno) { 
    echo "Failed to connect to MySQL : " . $conn->connect_error;
    exit();
    }*/
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
	
}
$filepath = $filename_modified; 
$insertquery = "UPDATE trip_details SET signature = '$filepath' WHERE tdid ='$tripID' ";
if ($db->execute($insertquery)) { 
   
     $jsonarray = array();
   $jsonarray['status'] = 'true'; 
   $jsonarray['userdata'] = 'file data uploaded successfully';
    echo json_encode($jsonarray);
    
}

 else {
  
     $jsonarray = array();
    $jsonarray['status'] = 'true'; 
   $jsonarray['userdata'] = 'file data uploaded successfully';
    echo json_encode($jsonarray);
    //echo "<br>" . $status . "<br>";
 }
//mysql_close();


?>
