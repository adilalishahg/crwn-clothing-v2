<?php
include_once('DatabaseUS.inc.php');
if (isset($_GET['action'])) {
    
    $action = $_GET['action'];
    
  switch ($action)
    {
        case 'getVoiceMessageURL':
            getVoiceMessageURL();        
            break;
        
        default:
            echo "action is undefined";
    }
    
}

else {
    
    $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['error'] = 'parameters are missing';

     echo json_encode($jsonarray);
    exit();
}
function getVoiceMessageURL()
{

    if (isset($_GET['driverID']) && isset($_GET['currentVMID'])) {
        $driverID = $_GET['driverID'];
        $currentVMID = $_GET['currentVMID'];
    }   
 else {
    //echo 'username or passward is missing!';
     $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['error'] = 'parameters are missing';

     echo json_encode($jsonarray);
    exit();
}

//MySql connection
  $conn =  mysql_connect('httmedical.db.3694931.hostedresource.com','httmedical','HTTmed123!');
	mysql_select_db('httmedical');

if ($conn->connect_errno) { //connection failed
    echo "Failed to connect to MySQL : " . $conn->connect_error;
    exit();
}

$query = "SELECT * FROM recordedvoice_driver WHERE driver_id != '$driverID' AND voice_id > '$currentVMID' ORDER BY voice_id LIMIT 1";
$result = mysql_query($query);

if (!$result) {
    echo "Failed to run query:" . $conn->error;
    $conn->mysql_close();
    exit();
}

$numberofrows = mysql_num_rows($result);
$jsonarray = array();


if ($numberofrows > 0)
{
    $jsonarray['status'] = 'true'; 
    $row = mysql_fetch_assoc($result);
    $jsonarray['userdata'] = $row;

}
else
{
    $jsonarray['status'] = 'false'; 
    $jsonarray['userdata'] = 'no data found';

    
}
    
    
    echo json_encode($jsonarray);

    
   mysql_close();
}




?>
