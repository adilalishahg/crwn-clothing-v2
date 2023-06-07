<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
	if(isset($_POST['driverID']) && isset($_POST['driverName']) && ($_FILES["myFile"]["size"] > 0)){
		$jsonarray['driverid'] = $_POST['driverID'];
		$jsonarray['driverName'] = $_POST['driverName'];
		
		$folder = "audios/";
		$file = $_FILES['myFile'];
		$fullpath = $folder.$file;
		if(move_uploaded_file($file, $fullpath)){
		$jsonarray['status'] = 'true';
		$jsonarray['userdata'] = 'FileUploaded';
		}
		else {$jsonarray['status'] = 'false';
		$jsonarray['userdata'] = 'UnabletoUploadFile';}
		echo json_encode($jsonarray);
		
/*if (isset($_GET['username']) && isset($_GET['password'])) {
	$username = sql_replace($_GET['username']);
	$password = sql_replace($_GET['password']);
	$query = "SELECT * FROM drivers WHERE username='$username' AND password='$password' LIMIT 1"; 
	if($db->query($query) && $db->get_num_rows() > 0)
	{
	$data = $db->fetch_all_assoc();
	}
	$rowcount = count($data);	
	$jsonarray = array();
		  if ($rowcount == 0) {
		  $jsonarray['status'] = 'false';
		  $jsonarray['error'] = 'Login Failed';
		  }else {
			  $querylogin = "UPDATE drivers SET login_status = '1' WHERE   Drvid = ".sql_replace($data[0]['Drvid']);
			  if($db->execute($querylogin)){
		  $jsonarray['status'] = 'true';
		  $jsonarray['userdata'] = $data; } else { $jsonarray['status'] = 'false'; $jsonarray['error'] = 'Login Failed'; }
		  }
		  echo json_encode($jsonarray);
  }else {
     $jsonarray = array();
     $jsonarray['status'] = 'false';
     $jsonarray['error'] = 'parameters are missing';
     echo json_encode($jsonarray);
    exit();} 
	*/
	
	
	}
	
$db->close();
?>
