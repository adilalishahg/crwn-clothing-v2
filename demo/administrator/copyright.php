<?php
 /* *************************** *
	   * Created On : 14th october,2009 
	   * File : configuration/database_tables.php
	   * Created By : Muhammad Sajid
	   * Modified On : 14th october,2009 
	   * Modified By : Muhammad Sajid
	   *************************** */

   	//include_once('DBAccess/Database.inc.php');
	include_once('DBAccess/Database.inc.php');
	$db = new Database;	

	$error = '';
	$msg   = '';
		
	$db->connect();
	
	if(count($_POST)){
		$copyright1 = sql_replace(htmlentities($_POST['copyright']));
		$copyright = html_entity_decode($copyright1);		
				
		if(!$copyright1){
		  $error .= "Copyright Text missing !<br>";
		}
		
		
		
	
		if(!$error){
		 $Query  = "UPDATE ".TBL_COPY_RIGHTS." SET 
		           description ='$copyright1' 
				   WHERE right_id  ='1'";
		 	 
		  if($db->query($Query))
		    {
			  $msg .= "Copyright Updated Successfully<br>";
			}
		  else{
		      $msg .= "Updating Failed<br>";
		  
		  } // end if
    	}
	 }

		
	// Footer
	
	$qry_footer  = "SELECT * FROM " .  TBL_COPY_RIGHTS ;
	if($db->query($qry_footer) && $db->get_num_rows() > 0){
		$footer = $db->fetch_all_assoc();
		
	 }
	 $copyright = html_entity_decode($footer[0]['description']);	

    $db->close();

	
	
	
	
	
    $pgTitle = "Admin Panel -- Manage Copyright";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("errors",$error);
	$smarty->assign("msgs",$msg);	
	$smarty->assign("copyright",$copyright);		
	$smarty->display('copyright.tpl');
		
?>