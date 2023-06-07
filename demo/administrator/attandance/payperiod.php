<?php
include_once('../DBAccess/Database.inc.php');
include_once('addattendance.php');
$db = new Database;	
$db->connect();
$whr=' WHERE 1 ';
if($_REQUEST){
	$startdate=$_REQUEST['startdate'];
	$enddate=$_REQUEST['enddate'];
	$drv_id=$_REQUEST['drv_id'];
	}

if($startdate==''){$startdate = date("m/d/Y",strtotime("-1 day"));}
if($enddate==''){$enddate = date("m/d/Y",strtotime("-1 day"));}
if($startdate!='' && $enddate!=''){$whr .= "AND at.dated BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59'";}
if($drv_id!=''){$whr .= " AND at.driver_id = '".$drv_id."'";}

if($whr!=''){
		$Qs="SELECT at.*,dr.fname,dr.lname FROM attendance as at LEFT JOIN drivers as dr on at.driver_id=dr.Drvid $whr ORDER BY at.dated DESC";
		if($db->query($Qs) && $db->get_num_rows() > 0)
		{$data = $db->fetch_all_assoc(); 
		for($i=0;$i<sizeof($data);$i++){
			 $lalagee1=$lalagee2='';
			 $df1=secondsToTime($data[$i]['total_time']);
			 $lalagee1.=$df1['hours']!=0?$df1['hours'].'Hr ':'';
			 $lalagee1.=$df1['minutes']!=0?'& '.$df1['minutes'].'Min ':'';
			 $data[$i]['totaltime'] 	= $lalagee1;
			 
			 $df2=secondsToTime($data[$i]['over_time']);
			 $lalagee2.=$df2['hours']!=0?$df2['hours'].'Hr ':'';
			 $lalagee2.=$df2['minutes']!=0?'& '.$df2['minutes'].'Min ':'';
			 $data[$i]['overtime'] 	= $lalagee2; 
			}
		
		}
}
//print_r($data);
$querydr = "SELECT  * FROM ".TBL_DRIVERS." WHERE del = '0'";
if($db->query($querydr) && $db->get_num_rows() > 0)
	{	$datadr = $db->fetch_all_assoc();	}
$db->close();


	$smarty->assign("startdate",$startdate);
	$smarty->assign("enddate",$enddate);
	$smarty->assign("data",$data);
	$smarty->assign("datadr",$datadr);
	$smarty->assign("drv_id",$drv_id);			



	$smarty->display('atdncetpl/index.tpl');



		



?>
