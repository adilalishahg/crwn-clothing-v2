<?php
   	include_once('../DBAccess/Database.inc.php');
	include_once('../Classes/imgUploader.php');
	$image3 = new imgUploader; 
	$db = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
  if(isset($_POST['admusersub']))
	   {
	   	$title	 	= sql_replace($_POST['title']);
	   	$content	= sql_replace($_POST['content']);
	    $excerpt	= sql_replace($_POST['excerpt']); 
		//print_r($_FILES); exit;
	if(isset($_FILES['dimage']['name'][0]) && $_FILES['dimage']['name'][0] != '') { 
	        $filename = 'dimage';
			$updFile = $filename;
            $big_path   = '../../images/';
            $thumb_path = '../../images/';
			$w = '50';
			$h = '50';
           $imgUp = $image3->uploadImgwithThumbnail($filename,$big_path,$thumb_path,$w,$h,0); 
         	$xp = explode(',',$imgUp);
			$thumb = str_replace('../','',urldecode($xp[1]));
			$image = str_replace('../','',urldecode($xp[0]));
	 }	    
if($error == '')
         {
		  $Query3  = "INSERT INTO ".services." SET 
		  					title		='$title',
							content		='$content',
							excerpt		='$excerpt',
							thumb		='$thumb',
							image		='$image'	";
						
					
		  if($db->execute($Query3))
		    {			  		   
		  echo '<script>alert("Record added Successfully");</script>';
		  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}else{
			  echo '<script>alert("Unable to add Record");</script>';
			  echo '<script>window.open("index.php","_parent");</script>';			  
			  exit;
			}
		}
	}
	
	$db->close();
    $pgTitle = "Admin Panel --[Add]";	
	$smarty->assign("title",$title);
	$smarty->assign("pgname",$pgname);		
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("post",$_POST);
	$smarty->display('services/add.tpl');	
?>