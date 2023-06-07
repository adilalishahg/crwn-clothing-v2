<?php
   	/* *************************** *
	   * Date: 26-May-2008 
	   * categories/add_category.php
	   * Muhammad Sajid
	   *************************** */

   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
		
	$db = new Database;	
	$db2 = new Database;	

	$db->connect();
	$db2->connect();

 if(isset($_POST['queryString']) && $_POST['sta']){

       if($_POST['sta'] == '3' && $_POST['rea'] == ''){ echo 'Fail'; exit;	 }
 
	     $hospQuery = "SELECT * FROM ".TBL_FORMS." WHERE id='".$_POST['queryString']."'";
	       if($db->query($hospQuery) && $db->get_num_rows() > 0 ){
			 $hospinfo = $db->fetch_all_assoc(); 
			 $found = 'yes';
			}else{
			 $found = 'no';
			}

  if($found == 'yes'){
		if($_POST['sta'] == '3'){ $ustatus = 'disapproved'; }else { $ustatus = 'approved'; }
		
	
if($_POST['sta'] != '3'){
	$Query  = "UPDATE ".TBL_FORMS." SET 
			 	   reqstatus='$ustatus' WHERE id='".$_POST['queryString']."'";
   	}else{
	$Query  = "UPDATE ".TBL_FORMS." SET reqstatus='$ustatus', adminComments='".addslashes($_POST['rea'])."' WHERE id='".$_POST['queryString']."'";
	}		 
	  if($db->execute($Query)){
             echo 'Success';
			}else{ echo 'Fail';	 }
        }else{ echo 'Fail'; }	
	 }else{ echo 'prob'; }

  $db->close();
  exit;
?>