<?php
/* *************************** *
	   * Created On : 30 Jan 2010
	   * File : attendance/timeout.php
	   * Abid Mehmood Malik
	   *************************** */

include_once('../DBAccess/Database.inc.php');

$db3 = new Database;	
$db3 ->connect();
if(isset($_POST['id']) && $_POST['id'] != '')
{
	
	if($_POST['emp'] == '1'){
	  $query ="SELECT hrate FROM ".TBL_DRIVERS."
	      	  WHERE 
			  Drvid='".$_POST['id']."'";		
		}
		
	if($_POST['emp'] == '2'){
	  $query ="SELECT hrate FROM ".TBL_STAFF."
	      	  WHERE 
			  Drvid='".$_POST['id']."'";	
		}

	if($db3->query($query) && $db3->get_num_rows() > 0){
		$chk = $db3->fetch_row_assoc();
		echo $chk['hrate'];
	 }
}
else
{
  echo 'invalid';
}

?>