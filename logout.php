<?php
 include_once('includefile.php');
 $_SESSION['allowUser'] = '0';
 $_SESSION['allowUser'] = '';
 $_SESSION['userdata'] = ''; 
 $_SESSION['type'] = ''; 

 unset($_SESSION['allowUser']);
 unset($_SESSION['userdata']);
 session_destroy();
 
 if(date('d')==1){
	 $files = glob('csv/*'); // get all files path
			foreach($files as $file){ // iterate files
				if(is_file($file))
				unlink($file); // delete file
			}
	 }
 
echo '<script>location.href="index.php";</script>';  exit;	

  
?>