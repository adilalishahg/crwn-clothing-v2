<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../Classes/MyMailer.php');	
	$db = new Database;
	$db->connect();
	$server_time = get_server_time();
	$date = $server_time[1];
	$time = $server_time[0];
	$duration = 30;
	/*$prop = 40;
	$etime = $time;
	$stime = date("H:i:s", strtotime("-$prop minutes".$time));*/
	//$stime = '13:00:00';
	//$etime = '20:00:00';
	function process($stime, $etime, $array)
	{
		$lim = sizeof($array) ;
		for($i = 0;$i<=$lim;$i++)
		{
			if($i<1)
			{
				$time1 = $stime;
				$time2 = $array[$i]['pck_time'];
			}
			else if($i>($lim-2))
			{
				$time1 = $array[$i-1]['drp_time'];
				$time2 = $etime;
			}
			else
			{
				$time1 = $array[$i-1]['drp_time'];
				$time2 = $array[$i]['pck_time'];
			}
			
			$array[$i]['last_time'] = $time1;
			$array[$i]['next_time'] = $time2;
			$array[$i]['slot'] =  calculate($time2, $time1);
		}
		return $array;
	}
	/*if(isset($_GET['search']))
	{
		$whr1 = '';
		$whr2 = '';
		$stime = $_GET['stime'].":00";
		$etime = $_GET['etime'].":00"; 
		if(($stime) and ($etime))
		{
			$whr1 = " AND drp_time BETWEEN '$stime' AND '$etime' ";
			$whr2 = " AND drp_time BETWEEN '$stime' AND '$etime' AND pck_time  > '$ltime'";
			$lim = '';
		}
	}*/
	
	//  F U N C T I O N     T O    C A L C U L A T E    T H E    F R E E   S L O T  ///
	function calculate($time1, $time2)
	{
		if(!empty($time1)  && !empty($time2))
		{
			$time1 = strtotime($time1);
			$time2 = strtotime($time2);			
			
			$diff = $time1 - $time2;
			
			if( $hours=intval((floor($diff/3600))) )
				$diff = $diff % 3600;
			if( $minutes=intval((floor($diff/60))) )
				$diff = $diff % 60;
			$diff    =    intval( $diff );  
			
			if(empty($hours))
				$out = $minutes;
			else
			{
				$ex = 60 * $hours;
				$out = $ex + $minutes;
			}
			return  $out;
			
		}
	}
	
	//   F U N C  T I O N     T O     C R E A T E    A    N E W    A R R A Y   ///
	function verification($array,$duration)
	{
		// Empty slot duration can be changed here!
		
		
		$index = 0;
		$main = 0;
		$slots =  array();
		if(!empty($array))
		{
			foreach($array as $trip)
			{
				//debug($trip);
				for($a = 0; $a<sizeof($trip['trips']);$a++)
				{
					if(isset($trip['trips'][$a]['slot']) && $trip['trips'][$a]['slot'] > $duration)
					{
						$slots[$index] = $trip['trips'][$a];
						$slots[$index] ['drv_id'] = $trip['drv_id'];
						$slots[$index] ['drv_code'] = $trip['drv_code'];
						$slots[$index] ['drv_name'] = $trip['drv_name'];
						$index++;
						//array_push($slots,$array[$a]);
					}
				}
				$main++;
			}
		}
		/*for($a = 0; $a<sizeof($array);$a++)
		{
			if(isset($array[$a]['slot']) && $array[$a]['slot'] >= $duration)
			{
				$slots[$index] = $array[$a];
				$index++;
				//array_push($slots,$array[$a]);
			}
		}*/
		return $slots;
	}
	if(isset($_POST))
	{
		$stime = $_POST['stime'];
		$etime = $_POST['etime'];
		// T O   G E T    T H E   P R E S E N T    D R I V E R S  //
		$tQuery = "SELECT drv_id FROM ".TBL_ATNDS." WHERE date = '$date' AND time_out = '00:00:00'";
		if($db->query($tQuery) && $db->get_num_rows() > 0)
		{
			$aDrvs = $db->fetch_all_assoc();
		}
		// T 0  G E T   T H E   D R I V E R   C O D E   O F   A C T I V E    D R I V E R S  //
		for($i=0;$i< sizeof($aDrvs);$i++)
		{
			$id = $aDrvs[$i]['drv_id'];		
			$aQuery = "SELECT drv_code, fname, lname FROM ".TBL_DRIVERS." WHERE Drvid = '$id'";
			if($db->query($aQuery) && $db->get_num_rows() > 0)
			{
				$Drvs = $db->fetch_row_assoc();
			}
			$drv_code = $aDrvs[$i]['drv_code'] = $Drvs['drv_code'];
			$aDrvs[$i]['drv_name'] = $Drvs['fname']." ".$Drvs['lname'] ;
		
		
		// T O  G E T  T H E  L A S T  T R I P   O F   A C T I V E   D R I V E R  //
			
			$tQurey  = "SELECT pck_time, drp_time, tdid FROM ".TBL_TRIP_DET." WHERE date = '$date' AND  drp_time > '$stime' AND pck_time < '$etime' AND drv_id = '$drv_code' $whr1 ORDER By drp_time ASC";
			if($db->query($tQurey) && $db->get_num_rows() > 0)
			{
				$trips = $db->fetch_all_assoc();
				$tindex = 0;
				foreach($trips as $trip)
				{
					$aDrvs[$i]['trips'][$tindex] = $trip;
					$tindex++;
				}
				
					} else { 	$v_drivers[$i]['drv_code'] = $Drvs['drv_code'];
								$v_drivers[$i]['drv_name']  = $Drvs['fname']." ".$Drvs['lname'] ; 
								}
			
			for($a = 0;$a<sizeof($aDrvs);$a++)
			{
				$aDrvs[$a]['trips'] = process($stime, $etime,$aDrvs[$a]['trips']);
			}
			/*$tQurey  = "SELECT drp_time, tdid FROM ".TBL_TRIP_DET." WHERE date = '$date' AND drv_id = '$drv_code' $whr1 ORDER By drp_time DESC $lim";
			if($db->query($tQurey) && $db->get_num_rows() > 0)
			{
				$trips = $db->fetch_all_assoc();
				$tindex = 0;
				foreach($trips as $trip)
				{
					$aDrvs[$i]['trips'][$tindex]['last_id'] = $trip['tdid'];
					$ltime = $aDrvs[$i]['trips'][$tindex]['last_time'] = $trip['drp_time'];
				}
			
			
				$tQurey  = "SELECT pck_time, tdid FROM ".TBL_TRIP_DET." WHERE date = '$date' AND drv_id = '$drv_code' AND status in ('0','2','5')  $whr2 AND pck_time  > '$ltime' ORDER By pck_time ASC  $lim";
				if($db->query($tQurey) && $db->get_num_rows() > 0)
				{
					$trips = $db->fetch_all_assoc();
					$tindex = 0;
					foreach($trips as $trip)
					{
						$aDrvs[$i]['next_id'] = $trip['tdid'];
						$aDrvs[$i]['next_time'] = $trip['pck_time'];
						$aDrvs[$i]['trips'][$tindex]['next_id'] = $trip['tdid'];
						$aDrvs[$i]['trips'][$tindex]['next_time'] = $trip['pck_time'];
						$aDrvs[$i]['trips'][$tindex]['slot'] = calculate($aDrvs[$i]['trips'][$tindex]['next_time'], $aDrvs[$i]['trips'][$tindex]['last_time']);
						$tindex ++;
					}
				}
				
			
		}*/
		}
	}
	$u = 0;
	foreach($v_drivers as $row){ $records[$u] = $row; $u++; }
	//debug($records);
	$final = verification($aDrvs,$duration);
	$smarty->assign("v_drivers",$records);
	$smarty->assign("stime",$stime);
	$smarty->assign("etime",$etime);
	$smarty->assign("duration",$duration);
	$pgTitle = "Admin Panel -- Drivers Managment [Free Driver]";	
	$smarty->assign("title",$pgTitle);
	$smarty ->assign("data",$final);
	$smarty->display('drvtpl/free_drv.tpl');
?>