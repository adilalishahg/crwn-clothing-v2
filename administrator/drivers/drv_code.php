<?php
include_once('../DBAccess/Database.inc.php');
if(verify($_POST['drv_code'],''))
{
	$db = new Database;
	$db -> connect();
	$val = $_POST['drv_code'];
	$chkCode = "SELECT drv_code FROM ".TBL_DRIVERS." WHERE drv_code='".$val."'";
				if($db->query($chkCode) && $db->get_num_rows() > 0 )
				{
					echo "<span style='color:red;'>Code Already Exists! try another one.</span>";
				}
				else
				{
					echo "Code Verified!";
				}
$db->close();
}
?>