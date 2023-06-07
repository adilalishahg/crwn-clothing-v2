<?php
include_once('DatabaseUS.inc.php');
define("UPLOAD_DIR", "audios/");

//echo 
//$serverpath = 'http://'.$_SERVER['HTTP_HOST'].'/iphone/audios/'; //For live sites


//exit;
//$_SERVER['HTTP_HOST']

    if (isset($_POST['driverID']) && isset($_POST['driverName']) && ($_FILES["myFile"]["size"] > 0)) {  
        $driverID = $_POST['driverID'];
        $driverName = $_POST['driverName']; 
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
    $conn =  mysql_connect('httmedical.db.3694931.hostedresource.com','httmedical','HTTmed123!');
	mysql_select_db('httmedical');

    if ($conn->connect_errno) { //connection failed
    echo "Failed to connect to MySQL : " . $conn->connect_error;
    exit();
    }
    
    $maxidquery = "SELECT voice_id FROM recordedvoice_driver ORDER BY voice_id DESC LIMIT 1";

    $maxidresult = mysql_query($maxidquery);
    $row = mysql_fetch_assoc($maxidresult);
    $maxid = $row['voice_id'];
    $maxid = $maxid + 1;
    echo $maxid;
    $filename = $name;
    $parts = pathinfo($filename);
    $filename_modified = $parts["filename"] . $maxid . "." . $parts["extension"];
    
    echo $filename_modified;
    
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

$voice_time = date("H:i:s");
$voice_date = date("Y-m-d");

$filepath = $serverpath.$filename_modified; 
$insertquery = "INSERT INTO recordedvoice_driver (driver_id,drivername,voicename,voicepath,voicetime,voicedate) VALUES ('$driverID','$driverName','$filename_modified','$filepath','$voice_time','$voice_date')";
$insertqueryresult = mysql_query($insertquery);

$affetedrows = mysql_affected_rows($conn);

if ($affetedrows == 0) { //query failed to execute
    //echo "Failed to run query:" . $conn->error;
    $jsonarray = array();
    $jsonarray['status'] = 'false';
    $jsonarray['error'] = 'Failed to insert filedata !';
    
    echo json_encode($jsonarray);
    
}

 else {
   $jsonarray = array();
   $status = 'true'; 
   $jsonarray['status'] = $status;
   $jsonarray['userdata'] = 'file data uploaded successfully';
    
    echo json_encode($jsonarray);
    //echo "<br>" . $status . "<br>";
 }
 
 
mysql_close();


?>
