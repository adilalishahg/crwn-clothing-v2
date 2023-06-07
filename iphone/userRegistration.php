<?php
include_once('DatabaseUS.inc.php');
	$db = new Database;	
	$db->connect();
	if(isset($_GET['action']) && $_GET['action'] == 'creatingUserAccount'){
	$firstname	= sql_replace($_GET['firstname']);
	$lastname 	= sql_replace($_GET['lastname']);
	$email 		= sql_replace($_GET['email']);
	$password 	= sql_replace($_GET['password']);
	$un = rand(1,10000);
	$uname = $lastname.$un;
	$drcode = randomString(); 
	$queryadd = "INSERT INTO drivers SET 
					fname	=	'$firstname',
					lname	=	'$lastname',
					email	=	'$email',
					username=	'$uname',
					drv_code=	'$drcode',
					password=	'$password' ";
				if($db->execute($queryadd)){
				$jsonarray = array();
				 $jsonarray['status'] 	= 'true';
				 $jsonarray['response']['username'] = $uname;
				 $jsonarray['response']['password'] = $password;
				 $jsonarray['response']['domainname'] = 'hybriditservices.com/httmedical';
				 endmail($uname,$password,$email);
				 
				 echo json_encode($jsonarray);
					} else{
						$jsonarray = array();
				 $jsonarray['status'] 	= 'false';
				 $jsonarray['errormessage'] = 'Account is not created!';
				 echo json_encode($jsonarray); } 
		 }
	function endmail($uname,$password,$email){
		$message = 'This is your credentials:<br/>  User name: '.$uname.'<br/>  Password: '.$password;
		mail($email,'This is your credentials',$message);
		
		}	 
function randomString($length = 6) {
	  $str = "";  $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	  $max = count($characters) - 1;  for ($i = 0; $i < $length; $i++) {   
	  $rand = mt_rand(0, $max);   $str .= $characters[$rand];  }
	  return $str; } 

$db->close();
?>