<?php
   	include_once('../DBAccess/Database.inc.php');
    include('../Classes/pagination-class.php');	
	$db = new Database;	
    $msgs = '';
	$noRec = '';
    $error = '';	
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
	$db->connect();
	$db2->connect();
	//  S E A R C H   C O D E   F O R   R E P O R T I N  G //
	if(isset($_GET['appmiledate']))
	{ 
		// PA G I N G   C O D E  //
		if(isset($_GET['pageNum']))
		{
			$page_no = $_GET['pageNum'];
		}
		else
		{
			$page_no = '1';	 
		}
		$limit = 200;
		$offset = (($page * $limit) - $limit);
		$maxRecord = 200; 
		// E N D   P A  G I N  G   C O D E //
		$appmiledate = sql_replace($_GET['appmiledate']);
		$code     	 = sql_replace($_REQUEST['code']);
		$whr = '';
		if($appmiledate!= '')
		{
			$appmiledate = convertDateToMySQL($appmiledate);
			$whr = "appdate = '$appmiledate'";
			if($code != ''){
            $whr .= "  AND ccodea='".$code."'";   		  
		  }	
		}

	$qcount  = "SELECT id, appdate, clientname, pickaddr, destination, apptime,	milage, charges, phnum 
			FROM ".TBL_FORMS."
			WHERE $whr AND reqstatus = 'approved'";  
		if($db->query($qcount) && $db->get_num_rows() > 0)
		{
			$totalRows = $db->get_num_rows();
		}
   	 $pagination = new pagination($_GET['pageNum'],$maxRows=200,$totalRows); 
     $query = "SELECT id, appdate, clientname, pickaddr, destination, apptime, milage, charges, phnum, triptype 
			FROM ".TBL_FORMS." 
			WHERE $whr  AND reqstatus = 'approved'
			LIMIT ".$pagination->startRow . ",".$pagination->maxRows;		
		if($db->query($query) && $db->get_num_rows() > 0)
		{
			$data = $db->fetch_all_assoc();
		} $totalmilage=0;
		for($i=0; $i<count($data); $i++){
			
			$data[$i]['totmilage'] = ($data[$i]['milage']);
			$totalmilage=$totalmilage+$data[$i]['milage'];
		}
			$pages =  $pagination->display_pagination();	
		//debug($data);
	}	
	$Qccode = "SELECT * FROM ".companycodes." WHERE 1=1  ORDER BY `company` ASC";
    if($db->query($Qccode) && $db->get_num_rows() > 0)
	{	   $ccode = $db->fetch_all_assoc();    }
	$db->close();
	$db2->close();
	$pgTitle = "Admin Panel -- Hospital/Clinic";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("driver",$driver);	
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);	
	$smarty->assign("data",$data);	
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("totalRows",$totalRows);
	$smarty ->assign("apptype",$apptype);
	$smarty->assign('drv_id',$drv_id);
	$smarty->assign('stdate',$stdate);	
	$smarty->assign("enddate",$enddate);		
	$smarty->assign("hospname",$hospname);		
	$smarty->assign("address",$address);	
	$smarty->assign("hosp",$hosp);	
	$smarty->assign("pages",$pages);
	$smarty->assign("ccode",$ccode);
	$smarty->assign("code",$code);
	$smarty->assign("totalmilage",$totalmilage);
	$smarty->assign("appmiledate",convertDateFromMySQL($appmiledate));	
	$smarty->display('reportstpl/milagereport.tpl');
?>