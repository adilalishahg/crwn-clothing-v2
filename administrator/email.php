<?php 
	include_once('DBAccess/Database.inc.php');
	include_once('Classes/imgUploader.php');
	include_once('Classes/imgUploaderResizer.php');
	include_once('Classes/resizeimage.php');
	$db = new Database;	
	$db2 = new Database;	
	$image = new imgUploader; 
	$msgs   = '';

if(isset($_GET['sub']) && $_GET['sub'] == 'success'){
	$msgs = "Email Details Updated Successfully";
}
if(isset($_GET['sub']) && $_GET['sub'] == 'failure'){
	$msgs = "Unable to Update Email Details";
}

$db->connect();
$db2->connect();
$id = 1;
// update Contact Details
if(count($_POST) > 0)
{	
	/*echo '<pre>';
	print_r($_POST);
	echo $_FILES['dimage']['name'][0];
	exit;*/
	$uid    	= sql_replace($_POST['id']);
	$cname      = sql_replace($_POST['cname']);	
	$phone		= sql_replace($_POST['phone']);
	$email		= sql_replace($_POST['email']);
	$address	= sql_replace($_POST['address']);
	$city		= sql_replace($_POST['city']);
	$state		= sql_replace($_POST['state']);
	$zip		= sql_replace($_POST['zip']);
	$url1       = sql_replace($_POST['url']);
    $url 		= str_replace("http://","",$url1);
    $img	  =   $_FILES['dimage']['name'][0];
	if(isset($_FILES['dimage']['name'][0]) && $_FILES['dimage']['name'][0] != '') {


	        $filename = 'dimage';
			$updFile = $filename;
            $big_path   = '../images/logo/';
            $thumb_path = '../images/thumbs/';
			$w = '50';
			$h = '50';
            $imgUp = $image->uploadImgwithThumbnail($filename,$big_path,$thumb_path,$w,$h,0);
         	$xp = explode(',',$imgUp);
			$thumb = str_replace('../','',urldecode($xp[1]));
			$image = str_replace('../','',urldecode($xp[0]));
	 }else{
	  $image = sql_replace($_POST['hidimage']);
	  $thumb = sql_replace($_POST['hidthumb']);
	 }
			 $Query3  = "UPDATE email SET 
						cname='$cname',
						image='$image',
						thumb='$thumb',
						phone='$phone',
						email = '$email',
						url='$url',
						address='$address',
						city='$city',
						state='$state',
						zip='$zip'
						WHERE id='$id'";
					  	if($db->execute($Query3))
						{
								echo '<script>location.href="email.php?sub=success";</script>';
								exit;
						}
						else
						{
								echo '<script>location.href="index.php?sub=failure";</script>';
								exit;
						}
}else{
	$query = "SELECT * FROM email ";
    if($db->query($query) && $db->get_num_rows() > 0)
		{
			$udata = $db->fetch_all_assoc();
		}
}	
$db->close();
$db2->close();
$pgTitle='Admin Panel | Contact Details';
$smarty->assign("pgTitle",$pgTitle);
$smarty->assign("cname",$cname);
$smarty->assign("pgname",$pgname);	
$smarty->assign("image",$image);
$smarty->assign("thumb",$thumb);	
$smarty->assign("msgs",$msgs);
$smarty->assign("stat",$stat);
$smarty->assign("page",$pageno);
$smarty->assign("udata",$udata);			
$smarty->display('email.tpl');
?>