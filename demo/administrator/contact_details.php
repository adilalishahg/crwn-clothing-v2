<?php
include_once('DBAccess/Database.inc.php');
include_once('../Classes/mapquest_google_miles.class.php');	
$google = new mapquest_google_miles;
$db = new Database;	
$msgs   = '';
if(isset($_GET['sub']) && $_GET['sub'] == 'success'){
	$msgs = "Contact Details Updated Successfully";
}
if(isset($_GET['sub']) && $_GET['sub'] == 'failure'){
	$msgs = "Unable to Update Contact Details";
}
$db->connect();
$id = 1;
// update Contact Details

if(count($_POST) > 0)

{
	$uid    	= sql_replace($_POST['id']);
	$title      = sql_replace($_POST['title']);	
	$address	= sql_replace($_POST['address']);
	$city		= sql_replace($_POST['city']);
	$state		= sql_replace($_POST['state']);
	$zip		= sql_replace($_POST['zip']);
 	$corporat_address = $address.', '.$city.', '.$state.', '.$zip;
	$letters1 	= array(' ','#');
	$replace1 	= array('+','No');	
	$corporat_address	= str_replace($letters1,$replace1,$corporat_address);
	$corporat_latlong    = '';//$google->getLatLong($corporat_address); 	
	$phone		= sql_replace($_POST['phone']);
	$fax		= sql_replace($_POST['fax']);
	$email		= sql_replace($_POST['email']);	
	$email2		= sql_replace($_POST['email2']);	
	$url1       = sql_replace($_POST['url']);
    $url 		= str_replace("http://","",$url1);
	$capped_miles   	= sql_replace($_POST['capped_miles']);
	$time_zone   		= sql_replace($_POST['time_zone']);
	$google_coordinates = sql_replace($_POST['google_coordinates']);

			 $Query3  = "UPDATE ".TBL_CONTACT." SET 
						title='$title',
						address='$address',
						city='$city',
						state='$state',
						zip='$zip',
						corporat_latlong='$corporat_latlong',
						phone='$phone',
						fax='$fax',
						state = '$state',
						email = '$email',
						email2 = '$email2',
						url='$url',
						capped_miles='$capped_miles',
						time_zone='$time_zone',
						google_coordinates='$google_coordinates'
						WHERE c_id='$id'";
					  	if($db->execute($Query3))
						{
								echo '<script>location.href="contact_details.php?sub=success";</script>';
								exit;
						}
						else
						{
								echo '<script>location.href="index.php?sub=failure";</script>';
								exit;
						}

}else{



	$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='".$id."'";

    if($db->query($query) && $db->get_num_rows() > 0)

		{

			$udata = $db->fetch_all_assoc();

		}

}	
$db->close();
$pgTitle='Admin Panel | Contact Details';
$smarty->assign("pgTitle",$pgTitle);
$smarty->assign("title",$title);
$smarty->assign("pgname",$pgname);		
$smarty->assign("msgs",$msgs);
$smarty->assign("stat",$stat);
$smarty->assign("page",$pageno);
$smarty->assign("udata",$udata);			
$smarty->display('contact_details.tpl');
?>