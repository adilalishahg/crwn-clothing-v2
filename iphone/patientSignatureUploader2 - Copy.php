<?php
include_once('DatabaseUS.inc.php');
define("UPLOAD_DIR", "signature/");
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

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    //MySqli connection
    $conn =  mysql_connect($dbname,$dbs,$dbpasswd);
	mysql_select_db($dbs);

    if ($conn->connect_errno) { //connection failed
    echo "Failed to connect to MySQL : " . $conn->connect_error;
    exit();
    }
    
    /*$maxidquery = "SELECT voice_id FROM recordedvoice_driver ORDER BY voice_id DESC LIMIT 1";

    $maxidresult = mysql_query($maxidquery);
    $row = mysql_fetch_assoc($maxidresult);
    $maxid = $row['voice_id'];*/
    $maxid = $tripID;
    $filename = $name;
    $parts = pathinfo($filename);
    $filename_modified = $parts["filename"] . $maxid . "." . $parts["extension"];
   
   // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . $filename_modified);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $filename_modified, 0644);
}
//Inserting driverid,drivername and filepath in database 
$filepath = $filename_modified; 
$insertquery = "UPDATE trip_details SET signature2 = '$filepath' WHERE tdid ='$tripID' ";
$insertqueryresult = mysql_query($insertquery);

$affetedrows = mysql_affected_rows($conn);

if ($affetedrows == 0) { //query failed to execute
    //echo "Failed to run query:" . $conn->error;
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
 
 
mysql_close();


?>
