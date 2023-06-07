<?PHP

/* *************************** *

	   * Created On : 27th May,2009 

	   * Coded By : Abrar Kiyani

	   * All Rights Reserved 2009 by : HITS (Hybrid IT Services) 

	   * MMTp://www.hybriditservices.com/demos/MMTglobal-2/hybridTracktrans.com

	   *************************** */ 
	include_once('DBAccess/Database.inc.php'); 
	if(empty($_REQUEST['ds'])){
		
		$db = new Database;
		$db->connect();
		$Qups="UPDATE ".TBL_ADMIN." SET 
			admin_session='',
			ipaddress	='',
			browser		='',
			computername=''
		WHERE admin_id ='".$_SESSION['userid']."' and admin_session='".$_SESSION['admin_session']."'"; 
		$db->execute($Qups);
	}	
	unset($_SESSION['allowUser']);

	session_destroy();

	

	//header("Location: login.php")

	echo '<script>location.href="login.php";</script>';

    exit;	

	

?>