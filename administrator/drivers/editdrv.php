<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	include_once('../../Classes/mapquest_google_miles.class.php');		
	include_once('../Classes/imgUploader.php');
	include_once('../Classes/imgUploaderResizer.php');
	include_once('../Classes/resizeimage.php');	
	$image  = new imgUploader; 
	$db = new Database;	
	$db2 = new Database;	
	$mail = new MyMailer;
	$google = new mapquest_google_miles;	
	$msgs   = '';
	$errors = '';
	$db->connect();
	$db2->connect();
    $tcont = "SELECT * FROM ".TBL_DRVTYPES." WHERE del = '0'";
		if($db->query($tcont) && $db->get_num_rows() > 0)
		 { $tlist = $db->fetch_all_assoc();
		 }
    $gcont = "SELECT * FROM ".TBL_COUNTRIES;
		if($db->query($gcont) && $db->get_num_rows() > 0)
		 { $clist = $db->fetch_all_assoc();
		 }
    $gstat = "SELECT * FROM ".TBL_STATES;
		if($db->query($gstat) && $db->get_num_rows() > 0)
		 {
		   $slist = $db->fetch_all_assoc();		 
		 }
   $vid = intval($_GET['id']);
 if(isset($_POST['submit'])){
	  $drvtype    = sql_replace($_POST['drvtype']);	
	  $drv_code     = sql_replace($_POST['drv_code']);
	  $v_code     = sql_replace($_POST['d_code_x']);
      $fname      = sql_replace($_POST['fname']);
	  $lname      = sql_replace($_POST['lname']);		  
      $ssn        = sql_replace($_POST['ssn']);
	  $hrate        = sql_replace($_POST['hrate']);
      $hidssn     = sql_replace($_POST['hidssn']);	  
	  $license    = sql_replace($_POST['license']);	
      $lic_expirydate   = sql_replace($_POST['lic_expirydate']);
	  $addr       = sql_replace($_POST['addr']);	
      $city       = sql_replace($_POST['city']);
	  $state      = sql_replace($_POST['state']);	
      $zip        = sql_replace($_POST['zip']);
	   $driver_address = $addr.', '.$city.', '.$state.', '.$zip;
	  	$letters1 	= array(' ','#');
		$replace1 	= array('+','No');	
	$driver_address	= str_replace($letters1,$replace1,$driver_address);
	  $drv_latlong    = ',';//$google->getLatLong($driver_address); 
	  $sip        = sql_replace($_POST['sip']); 
	  $day_phnum  = sql_replace($_POST['day_phnum']);		  
	  $cell_num   = sql_replace($_POST['cell_num']);
      $age        = sql_replace($_POST['age']);
	  $sex        = sql_replace($_POST['sex']);	
      $nationality   = sql_replace($_POST['nationality']);
	  $emg_contactinfo  = sql_replace($_POST['emg_contactinfo']);	
      $dob        = sql_replace($_POST['dob']);
	  $prev_addr  = sql_replace($_POST['prev_addr']);	
	  $email      = sql_replace($_POST['email']);
	  
	  $username      = sql_replace($_POST['username']);
	  $password      = sql_replace($_POST['password']);
	  
	  $hidemail      = sql_replace($_POST['hidemail']);
	  $drvstatus  = sql_replace($_POST['drvstatus']);	  	  
	   /*if(!$drvtype || $drvtype == '')
	    { $error .= "Driver Type not selected! <br>"; }*/
	   if(!$drv_code || $drv_code == '')
	    { $error .= "Driver Code Missing! <br>"; }
	   if(!$fname)
	    { $error .= "First Name Missing!<br>"; }
	   if(!$lname)
	    { $error .= "Last Name Missing!<br>"; }
	   if(!$username || trim($username) == '')
	    { $error .= "Username Missing! <br>"; }
		if(!$password || trim($password) == '')
	    { $error .= "Password Missing! <br>"; }
	 
      if(!$error)
	  {
		if($email != $hidemail && $email!='')
		{
			$chkEmail = "SELECT * FROM ".TBL_DRIVERS." WHERE email='".$email."'";
			if($db->query($chkEmail) && $db->get_num_rows() > 0 )
				{
				  $error .= 'Driver with this Email already exist. Try another one.<br>  ';
				}
		}
        /* if($hidssn != $ssn)
		 {
			$chkDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE ssn='".$ssn."'";
			if($db->query($chkDriver) && $db->get_num_rows() > 0 )
			{
				$error .= 'Driver with this SSN already exist. Try another one.<br>  ';
			}
		}*/
		if($v_code != $drv_code)
		 {
			$chkCode = "SELECT * FROM ".TBL_DRIVERS." WHERE drv_code='".$drv_code."'";
			if($db->query($chkCode) && $db->get_num_rows() > 0 )
			{
				$error .= 'Driver with this Code already exist. Try another one.<br>  ';
			}
		}
	if($username){
		$usernamechk = "SELECT * FROM ".TBL_DRIVERS." WHERE username='".$username."' AND Drvid!='$vid'";
			if($db->query($usernamechk) && $db->get_num_rows() > 0 )
			{
				$error .= 'Driver with this User Name already exist. Try another one.<br>  ';
			}
	}
			 $img	  =   $_FILES['dimage']['name'][0];
	if(isset($_FILES['dimage']['name'][0]) && $_FILES['dimage']['name'][0] != '') { //echo 'zfkjf'; exit;
	        $filename = 'dimage';
			$updFile = $filename;
            $big_path   = '../images/signature/';
            $imgUp = $image->uploadImgwithnoThumbnail($filename,$big_path,0);
         	$xp = explode(',',$imgUp);
			$imagepath = str_replace('../','',urldecode($xp[0]));
	 }/**/else{
	  $imagepath = sql_replace($_POST['hidimage']);
	 }
	if($_SESSION['driver_quota']=='over'){ 

 $query = "SELECT drvstatus FROM ".TBL_DRIVERS." WHERE Drvid='".$vid."'"; if($db->query($query) && $db->get_num_rows()){$predata = $db->fetch_one_assoc();}
if($drvstatus=='Active' && $_SESSION['update']=='0'){
$error .= 'Your subscription has exceeded the Driver quota limit on allocated tier. Please contact billing to enhance tier limit.<br>  ';}
if($drvstatus=='Active' && $_SESSION['driver_quota']=='over' && $predata['drvstatus'] !='Active'){ 
	$error .= 'Your subscription has exceeded the Driver quota limit on allocated tier. Please contact billing to enhance tier limit.<br>  ';}
}
  if(!$error) {
		  $Query  = "UPDATE ".TBL_DRIVERS." SET 
					drvtype='$drvtype',
					drv_code = '$drv_code',
					fname='$fname',
					lname='$lname',
					ssn='$ssn',
					hrate='$hrate',
					per_run='".$_POST["per_run"]."',
					per_mile='".$_POST["per_mile"]."',
					license='$license',
					lic_expirydate='".convertDateToMySQL($lic_expirydate)."',
					addr='$addr',
					city='$city',
					state='$state',
					zip='$zip',
					drv_latlong='$drv_latlong',
					sip='$sip',
					day_phnum='$day_phnum',
					cell_num='$cell_num',
					age='$age',
					sex='$sex',
					nationality='$nationality',
					emg_contactinfo='$emg_contactinfo',
					dob='".convertDateToMySQL($dob)."',
					prev_addr='$prev_addr',
					email='$email',
					username='$username',
					password='$password',
					signature='$imagepath',
					drvstatus='$drvstatus' WHERE Drvid='$vid'";
		  if($db->execute($Query))
		    { 	 
			 echo '<script>location.href="index.php?d=e";</script>';
			 exit; 
			}else{
           	 $error .= 'Unable to update Driver, Please try again!<br>';
			}
		  } 
     }
  }else{
  $query = "SELECT * FROM ".TBL_DRIVERS." WHERE Drvid='".$vid."'";
	      if($db->query($query) && $db->get_num_rows())
			  {
			  $udata = $db->fetch_all_assoc();
			  }
	  $drvtype   = $udata[0]['drvtype'];
	  $drv_code   = $udata[0]['drv_code'];
	  $hidssn    = $udata[0]['ssn'];	  	
      $fname     = $udata[0]['fname'];
	  $lname     = $udata[0]['lname'];		  
      $ssn       = $udata[0]['ssn'];
	  $hrate       = $udata[0]['hrate'];
	  $license   = $udata[0]['license'];	
      $lic_expirydate  = convertDateFromMySQL($udata[0]['lic_expirydate']);
	  $addr      = $udata[0]['addr'];	
      $city      = $udata[0]['city'];
	  $state     = $udata[0]['state'];	
      $zip       = $udata[0]['zip'];
	  $sip       = $udata[0]['sip'];
	  $day_phnum = $udata[0]['day_phnum'];	
	  $cell_num  = $udata[0]['cell_num'];
	  $age       = $udata[0]['age'];	  	
      $sex       = $udata[0]['sex'];
	  $nationality     = $udata[0]['nationality'];		  
      $emg_contactinfo = $udata[0]['emg_contactinfo'];
	  $dob       = convertDateFromMySQL($udata[0]['dob']);	
      $prev_addr = $udata[0]['prev_addr'];
	  $email     = $udata[0]['email'];
	  $username     = $udata[0]['username'];
	  $password     = $udata[0]['password'];	
      $drvstatus = $udata[0]['drvstatus'];
  }		
  $readonly='';
	$disable_class='';
	$modiv_msg='';
  	if($udata[0]['modiv_flage']==1) {
  		
  		$readonly='readonly';
  		$disable_class='disable_class';
  		$modiv_msg='Managed by ModivCare';
  	}
	$db->close();
	$pgTitle = "Admin Panel -- Drivers Managment [Edit]";	
	$smarty->assign("readonly",$readonly);
	$smarty->assign("disable_class",$disable_class);
	$smarty->assign("modiv_msg",$modiv_msg);
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("tlist",$tlist);	
	$smarty->assign("id",$vid);
	$smarty->assign("tlist",$tlist);
	$smarty->assign("slist",$slist);
	$smarty->assign("clist",$clist);		
	$smarty->assign("drvtype",$drvtype);
	$smarty->assign("drv_code",$drv_code);
	$smarty->assign("fname",$fname);	
	$smarty->assign("lname",$lname);
	$smarty->assign("ssn",$ssn);
	$smarty->assign("hrate",$hrate);
	$smarty->assign("hidssn",$hidssn);		
	$smarty->assign("license",$license);
	$smarty->assign("lic_expirydate",$lic_expirydate);	
	$smarty->assign("addr",$addr);
	$smarty->assign("city",$city);	
	$smarty->assign("state",$state);
	$smarty->assign("zip",$zip);	
	$smarty->assign("sip",$sip);	
	$smarty->assign("day_phnum",$day_phnum);
	$smarty->assign("cell_num",$cell_num);
	$smarty->assign("age",$age);	
	$smarty->assign("sex",$sex);
	$smarty->assign("nationality",$nationality);	
	$smarty->assign("emg_contactinfo",$emg_contactinfo);
	$smarty->assign("dob",$dob);	
	$smarty->assign("prev_addr",$prev_addr);
	$smarty->assign("email",$email);	
	$smarty->assign("drvstatus",$drvstatus);
	$smarty->assign("username", $username);
	$smarty->assign("password", $password);	
	$smarty->assign("data", $udata[0]);	
	$smarty->assign("udata",$udata);
	$smarty->display('drvtpl/editdrv.tpl');
?>