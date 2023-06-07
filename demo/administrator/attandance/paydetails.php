<?php
include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
	$tottime=$totovertime=$days=0;
	$whr=' WHERE 1 ';
    $driver_id		=	$_REQUEST['id'];
	$startdate		=	$_REQUEST['startdate'];
	$enddate		=	$_REQUEST['enddate'];
	if($startdate!='' && $enddate!='' && $driver_id!=''){$whr .= " AND at.dated BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND at.driver_id = '".$driver_id."' AND at.dayonoff = 'on'";
	if($whr!=''){
	 $Qs="SELECT at.* FROM attendance as at $whr ORDER BY at.dated DESC";
		if($db->query($Qs) && $db->get_num_rows() > 0)
		{$data = $db->fetch_all_assoc(); 
		for($i=0;$i<sizeof($data);$i++){
			 $lalagee1=$lalagee2='';
			 $tottime=$tottime+$data[$i]['total_time'];
			 $df1=secondsToTime($data[$i]['total_time']);
			 $lalagee1.=$df1['hours']!=0?$df1['hours'].'Hr ':'';
			 $lalagee1.=$df1['minutes']!=0?'& '.$df1['minutes'].'Min ':'';
			 $data[$i]['totaltime'] 	= $lalagee1;
			 $totovertime=$totovertime+$data[$i]['over_time'];
			 $df2=secondsToTime($data[$i]['over_time']);
			 $lalagee2.=$df2['hours']!=0?$df2['hours'].'Hr ':'';
			 $lalagee2.=$df2['minutes']!=0?'& '.$df2['minutes'].'Min ':'';
			 $data[$i]['overtime'] 	= $lalagee2; 
			 $days++;
			}
		} 
		$Qdr="SELECT * FROM drivers where Drvid='$driver_id'";
		if($db->query($Qdr) && $db->get_num_rows() > 0)
		{$datadr = $db->fetch_one_assoc();  }
		$df3=secondsToTime($tottime);
		$datadr['totalhours']=$df3['hours'] ;
		$df4=secondsToTime($totovertime);
		$datadr['totalovertimehours']=$df4['hours'];
		$datadr['hourrate']=$datadr['hrate'];
		$datadr['days']=$days;
		$datadr['totalamount']=round(($datadr['totalhours']*$datadr['hrate']),2);
	}
	}
	//print_r($data);
	$db->close();
	$smarty->assign("data",$data);
	$smarty->assign("data2",$datadr);
	//$smarty->assign("totalduration",gmdate("H:i:s", $tot));				
	$smarty->display('atdncetpl/paydetails.tpl');
?>