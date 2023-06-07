<?php
   	include_once('../DBAccess/Database.inc.php');
	include('../Classes/pagination-class.php');	
	$db = new Database;	
	$noRec = '';
	$db->connect();
	//Update names	
/*	$Queryuu = "SELECT id, name, name_mid  FROM patient ";
     if($db->query($Queryuu) && $db->get_num_rows()) {
		 $data = $db->fetch_all_assoc();
		 for($i = 0; $i<sizeof($data); $i++){
			 $namepart = explode(',',$data[$i]['name']);
			 $name = $namepart[1].' '.$data[$i]['name_mid'].' '.$namepart[0];
			 $QueryUP = "UPDATE patient set name = '$name' WHERE id = '".$data[$i]['id']."'";
			 $db->query($QueryUP);
			 }
		 }*/
	//Updates names
	
	
	$whr ='';
	$whr = " WHERE 1 ";
	if(isset($_GET['status']) && $_GET['status'] !=''){
		$whr .= " AND status = '".$_GET['status']."' ";
		}
	if(isset($_GET['cisid']) && $_GET['cisid'] !=''){
		$whr .= " AND insurance = '".$_GET['cisid']."' ";
		}	
	if(isset($_GET['name']) && $_GET['name'] !=''){
		$whr .= " AND name LIKE '%".str_replace('\'','`',$_GET['name'])."%' ";
		}		
		
// Delete Category Script
    if(verify($_GET['did'],"index.php")){
   		$QueryDel = "DELETE FROM patient WHERE id='".$_GET['did']."'";
  		if($db->query($QueryDel))
		{
			echo '<script>location.href="index.php";</script>';
	   		@header("Location: index.php");
	   		exit;	
		}else{
			echo '<script>location.href="index.php";</script>';
	   		@header("Location: index.php");
	   		exit;	
		}  
  	}
// Update auto patient adding in database
if(isset($_GET['aap']) && $_GET['aap'] !=''){
$QueryUpdateaap = "UPDATE contact_info SET add_auto_patient = '".$_GET['aap']."' WHERE c_id = '1' "; $db->execute($QueryUpdateaap); }
// Fetch all categories list
	$QueryCounty = "SELECT COUNT(*) AS rows FROM patient $whr ";
     if($db->query($QueryCounty) && $db->get_num_rows())
	  {
      $data = $db->fetch_all_assoc();
      $totalRows = $data[0]['rows'];
	  }
 if(isset($_GET['pageNum'])){   $page_no = $_GET['pageNum']; }else{ $page_no = '1';	 }
 $pagination = new pagination($_GET['pageNum'],$maxRows=40,$totalRows);	  
	  
	  
	$Query = "SELECT * FROM patient $whr ORDER BY `name` ASC LIMIT ".$pagination->startRow . ",".$pagination->maxRows;
   if($db->query($Query) && $db->get_num_rows() > 0)
	{
	   $admdetail = $db->fetch_all_assoc();
	} else{
	   $noRec .=  "NO RECORD FOUND";	 
   }
   	  //check add auto patient 
	  //$Queryaddautop = "SELECT add_auto_patient FROM contact_info WHERE c_id = '1'";
	  //if($db->query($Queryaddautop) && $db->get_num_rows() > 0){ $aapdata = $db->fetch_one_assoc();}
	   $add_auto_patient = $aapdata['add_auto_patient'];
	$pages =  $pagination->display_pagination();
	$db->close();
    $pgTitle = "Admin Panel -- Home";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('admdetail',$admdetail);
	$smarty->assign("paging",$pages);
	$smarty->assign("status",$_GET['status']);
	$smarty->assign("cisid",$_GET['cisid']);
	$smarty->assign("byname",$_GET['name']);	
	$smarty->assign("add_auto_patient",$add_auto_patient);		
	$smarty->display('patientstpls/index.tpl');
?>