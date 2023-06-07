<?php
   	include_once('../DBAccess/Database.inc.php');
	include_once('../../Classes/mapquest_google_miles.class.php');	
	$mile_C = new mapquest_google_miles;
	function get_veh($drv)
			{
				$db = new Database;	
				$db->connect();
				$dQuery = "SELECT Drvid
										FROM ".TBL_DRIVERS."
										WHERE drv_code = '$drv'";
				if($db->query($dQuery) && $db->get_num_rows() > 0)
				{
					$drvs =  $db->fetch_row_assoc(); 
				}
				 $drv_id = $drvs['Drvid'];
				$vQuery = "SELECT  veh_id
										FROM ".TBL_DVMAPPING."
										WHERE  drv_id = '$drv_id'";
				if($db->query($vQuery) && $db->get_num_rows() > 0)
				{
					$vehs =  $db->fetch_row_assoc(); 
				}
				return ($vehs['veh_id'] > 0) ? $vehs['veh_id'] : '0';
			}
			function insert_trip($id)
			{ $google = new mapquest_google_miles;	
				$db = new Database;	
				$db->connect();
				$queryDel = "DELETE FROM  ".TBL_TRIPS." WHERE reqid = '$id'";
				$queryDel2 = "DELETE FROM  ".TBL_TRIP_DET." WHERE reqid = '$id'";
				$db->query($queryDel); $db->query($queryDel2);
				$req_query = "SELECT * FROM ".TBL_FORMS." WHERE id = '".$id ."' ";
				if($db->query($req_query) && $db->get_num_rows() > 0)
				{
					$req_info 	= $db->fetch_all_assoc();					
					$reqqr = "SELECT * FROM ".TBL_REQUESTS." WHERE reqid = '".$req_info[0]['req_id']."' ";
					if($db->query($reqqr) && $db->get_num_rows() > 0)
					{
						$req = $db->fetch_all_assoc();
					}
					
					$clinic		= $req_info[0]['clientname'];
					$patient_id	= $req_info[0]['patient_id'];
					//$user		= $trip_code;
					$tel		= $req_info[0]['phnum'];
					$date		= $req_info[0]['appdate'];
					$miles		= $req_info[0]['milage'];
					$sheet		= $sheetid;
				}
				if($req_info[0]['triptype'] == 'One Way') 		$trip_code = 1;
				if($req_info[0]['triptype'] == 'Round Trip') 	$trip_code = 2;
				if($req_info[0]['triptype'] == 'Three Way') 	$trip_code = 3;
				if($req_info[0]['triptype'] == 'Four Way') 		$trip_code = 4;
				if($req_info[0]['triptype'] == 'Five Way') 		$trip_code = 5;
				$sheet		= $sheetid;
				$reqsid 	= $req_info[0]['id'];
				$user 		= $req[0]['hospname'];
				$tel 		= $req_info[0]['phnum'];
				$account	= $req_info[0]['account'];
				$tQuery = "INSERT INTO ".TBL_TRIPS." SET 
									reqid 	= '$reqsid',
									trip_code 	= '$trip_code',
									trip_clinic = '".sql_replace($user)."',
									trip_user 	= '".sql_replace($clinic)."',
									trip_tel 	= '$tel',
									trip_date 	= '$date',
									sheet_id 	= '$sheet',
									status 		= '0',
									account		='$account',
									trip_miles 	= '$miles'";
				if($db->execute($tQuery))
				{ //new data getting start here
				//address
				$pickaddr 		= $req_info[0]['pickaddr'];
				$destination 	= $req_info[0]['destination'];
				$three_address 	= $req_info[0]['three_address'];
				$four_address 	= $req_info[0]['four_address'];
				$five_address 	= $req_info[0]['five_address'];
				$backto 		= $req_info[0]['backto'];
				//Times
				$apptime 		= $req_info[0]['apptime']; 
				$three_pickup 	= $req_info[0]['three_pickup'];
				$four_pickup 	= $req_info[0]['four_pickup'];
				$five_pickup 	= $req_info[0]['five_pickup'];
				$returnpickup 	= $req_info[0]['returnpickup'];
				//Geo cordinates
				$c1 		= $req_info[0]['c1'];
				$c2 		= $req_info[0]['c2'];
				$c3 		= $req_info[0]['c3'];
				$c4 		= $req_info[0]['c4'];
				$c5 		= $req_info[0]['c5'];
				$c6 		= $req_info[0]['c6'];
				//miles string
				$miles_string 	= explode(',',$req_info[0]['miles_string']);
				$legcharges 	= explode(',',$req_info[0]['legcharges']);
				//$m1 = $miles_string[0];
				//new data getting End here
				$trip_id = mysql_insert_id();
	if($req_info[0]['triptype'] == 'One Way'){
insert_tdetail($id,$trip_id,$apptime,$pickaddr,$destination,'AB',$miles_string[0],$reqsid,$c1,$c2,$req_info[0]['picklocation'],$req_info[0]['droplocation'],$req_info[0]['p_phnum'],$req_info[0]['d_phnum'],$req_info[0]['pickup_instruction'],$req_info[0]['destination_instruction'],$req_info[0]['legaid'],$req_info[0]['unloaded_miles_a'],$legcharges[0]);  		


	$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
	if($db->query($query) && $db->get_num_rows() > 0){
		$udata = $db->fetch_one_assoc();
		$unload_add = $udata['address'].",".$udata['state'].",".$udata['city'].",".$udata['zip'];
		$unloadedmiles = round($google->distance($pickaddr,$unload_add),2);
		$tQueryUn = "UPDATE ".TBL_TRIP_DET." SET unloaded_miles='".$unloadedmiles."' where trip_id='".$trip_id."'";
		//echo $pickaddr.' ----- '.$unload_add.' '.$tQueryUn;exit;
		$db->execute($tQueryUn);
	}
}
	if($req_info[0]['triptype'] == 'Round Trip'){
		
insert_tdetail($id,$trip_id,$apptime,$pickaddr,$destination,'AB',$miles_string[0],$reqsid,$c1,$c2,$req_info[0]['picklocation'],$req_info[0]['droplocation'],$req_info[0]['p_phnum'],$req_info[0]['d_phnum'],$req_info[0]['pickup_instruction'],$req_info[0]['destination_instruction'],$req_info[0]['legaid'],$req_info[0]['unloaded_miles_a'],$legcharges[0]);
insert_tdetail($id,$trip_id,$returnpickup,$destination,$backto,'BF',$miles_string[1],$reqsid,$c2,$c6,$req_info[0]['droplocation'],$req_info[0]['backtolocation'],$req_info[0]['d_phnum'],$req_info[0]['p_phnum'],$req_info[0]['destination_instruction'],$req_info[0]['backto_instruction'],$req_info[0]['legbid'],$req_info[0]['unloaded_miles_b'],$legcharges[1]);   		}
	
	if($req_info[0]['triptype'] == 'Three Way') 	{
		
insert_tdetail($id,$trip_id,$apptime,$pickaddr,$destination,'AB',$miles_string[0],$reqsid,$c1,$c2,$req_info[0]['picklocation'],$req_info[0]['droplocation'],$req_info[0]['p_phnum'],$req_info[0]['d_phnum'],$req_info[0]['pickup_instruction'],$req_info[0]['destination_instruction'],$req_info[0]['legaid'],$req_info[0]['unloaded_miles_a'],$legcharges[0]);
insert_tdetail($id,$trip_id,$three_pickup,$destination,$three_address,'BC',$miles_string[1],$reqsid,$c2,$c3,$req_info[0]['droplocation'],$req_info[0]['droplocation2'],$req_info[0]['d_phnum'],$req_info[0]['d_phnum2'],$req_info[0]['destination_instruction'],$req_info[0]['destination_instruction2'],$req_info[0]['legbid'],$req_info[0]['unloaded_miles_b'],$legcharges[1]);
insert_tdetail($id,$trip_id,$returnpickup,$three_address,$backto,'CF',$miles_string[2],$reqsid,$c3,$c4,$req_info[0]['droplocation2'],$req_info[0]['backtolocation'],$req_info[0]['d_phnum2'],$req_info[0]['p_phnum'],$req_info[0]['destination_instruction2'],$req_info[0]['backto_instruction'],$req_info[0]['legcid'],$req_info[0]['unloaded_miles_c'],$legcharges[2]);  }
	if($req_info[0]['triptype'] == 'Four Way'){
		
insert_tdetail($id,$trip_id,$apptime,$pickaddr,$destination,'AB',$miles_string[0],$reqsid,$c1,$c2,$req_info[0]['picklocation'],$req_info[0]['droplocation'],$req_info[0]['p_phnum'],$req_info[0]['d_phnum'],$req_info[0]['pickup_instruction'],$req_info[0]['destination_instruction'],$req_info[0]['legaid'],$req_info[0]['unloaded_miles_a'],$legcharges[0]);
insert_tdetail($id,$trip_id,$three_pickup,$destination,$three_address,'BC',$miles_string[1],$reqsid,$c2,$c3,$req_info[0]['droplocation'],$req_info[0]['droplocation2'],$req_info[0]['d_phnum'],$req_info[0]['d_phnum2'],$req_info[0]['destination_instruction'],$req_info[0]['destination_instruction2'],$req_info[0]['legbid'],$req_info[0]['unloaded_miles_b'],$legcharges[1]);
insert_tdetail($id,$trip_id,$four_pickup,$three_address,$four_address,'CD',$miles_string[2],$reqsid,$c3,$c4,$req_info[0]['droplocation2'],$req_info[0]['droplocation3'],$req_info[0]['d_phnum2'],$req_info[0]['d_phnum3'],$req_info[0]['destination_instruction2'],$req_info[0]['destination_instruction3'],$req_info[0]['legcid'],$req_info[0]['unloaded_miles_c'],$legcharges[2]);
insert_tdetail($id,$trip_id,$returnpickup,$four_address,$backto,'DF',$miles_string[3],$reqsid,$c4,$c5,$req_info[0]['droplocation3'],$req_info[0]['backtolocation'],$req_info[0]['d_phnum3'],$req_info[0]['p_phnum'],$req_info[0]['destination_instruction3'],$req_info[0]['backto_instruction'],$req_info[0]['legdid'],$req_info[0]['unloaded_miles_d'],$legcharges[3]); }
	if($req_info[0]['triptype'] == 'Five Way'){
insert_tdetail($id,$trip_id,$apptime,$pickaddr,$destination,'AB',$miles_string[0],$reqsid,$c1,$c2);
insert_tdetail($id,$trip_id,$three_pickup,$destination,$three_address,'BC',$miles_string[1],$reqsid,$c2,$c3);
insert_tdetail($id,$trip_id,$four_pickup,$three_address,$four_address,'CD',$miles_string[2],$reqsid,$c3,$c4);
insert_tdetail($id,$trip_id,$five_pickup,$four_address,$five_address,'DE',$miles_string[3],$reqsid,$c4,$c5);
insert_tdetail($id,$trip_id,$returnpickup,$five_address,$backto,'EF',$miles_string[4],$reqsid,$c5,$c6);  }
					//Below is sample function
		//insert_tdetail($id,$trip_id,$picktime,$pickaddress,$dropaddress,$tripdirection,$trp_miles);
				}
				//$db->close();
			}
	function insert_tdetail($id,$trip_id,$picktime,$pickaddress,$dropaddress,$tripdirection,$trp_miles,$reqsid,$cp,$cd,$picklocation,$droplocation,$p_phnum,$d_phnum,$pickup_instruction,$destination_instruction,$ccode,$unloaded_miles,$legcharges)
			{	$db = new Database;	
				$db->connect();
				//$trip_id = mysql_insert_id();
				$req_query = "SELECT * FROM ".TBL_FORMS." WHERE id = '".$id."' ";
				if($db->query($req_query) && $db->get_num_rows() > 0)
					$req_info 	= $db->fetch_all_assoc();				
				$req = "SELECT * FROM ".TBL_REQUESTS." WHERE reqid = '".$req_info[0]['req_id']."' ";
				if($db->query($req) && $db->get_num_rows() > 0)
				{  $req = $db->fetch_all_assoc();
				}
				
				$prop 	= "10";
			    //$req_info[0]['apptime'];
				//---------------------- check for pick time ---------------------------------//
				//if(!empty($req_info[0]['apptime']) && $req_info[0]['apptime'] != "00:00:00")
				if($picktime != "00:00:00" && $picktime != "0:00" && $picktime != "00:00" && $picktime != "0:00:00" && $picktime != "Will Call")
				{	$ptime		= $picktime;
					$pptime = strtotime($ptime);
					$pck_ptime 	= date("H:i:s", strtotime("+$prop minutes",$pptime));
					$totmiles = $trp_miles;
					switch($totmiles){
						case ($totmiles <= 10) :
							$min = 20;
							break;
						case ($totmiles <= 15) :
							$min = 30;
							break;
						case ($totmiles <= 20) :
							$min = 40;
							break;
						case ($totmiles <= 25) :
							$min = 45;
							break;
						case ($totmiles <= 30) :
							$min = 50;
							break;
						case ($totmiles <= 35) :
							$min = 55;
							break;
						case ($totmiles <= 40) :
							$min = 60;
							break;
						case ($totmiles <= 45) :
							$min = 65;
							break;
						case ($totmiles <= 50) :
							$min = 70;
							break;
						case ($totmiles > 50) :
							$min = 120;
							break;
						default :
							$min = 0;
							break;		
					}
					$min = round($totmiles*1.5);
					$drp_time 	= date("H:i:s", strtotime("+$min minutes",$pptime));
					$dptime = strtotime($drp_time);
					$drp_ptime = date("H:i:s", strtotime("+$prop minutes",$dptime));
					$wc 		= '0';
				}
				else
				{
					$ptime 		= '23:59:59';
					$pck_ptime 	= '00:00:00';
					$drp_time	= '00:00:00';
					$drp_ptime 	= '00:00:00';
					$wc 		= '1';
				}
				//----------------------------------------------------------------------------------//
				$drvid			= $req_info[0]['drv_code'];
				$pckadd			= $pickaddress;
				$drpaddr		= $dropaddress;
				$trp_miles		= $trp_miles;
				$type			= $tripdirection;
				$trp_total		= $req_info[0]['charges'];
				$trp_remarks	= $req_info[0]['comments'];
				$fname			= $req_info[0]['fname'];
				$date			= $req_info[0]['appdate'];
				$lname			= $req_info[0]['lname'];
				$clinic			= $req_info[0]['clinic'];
				$phyaddress		= $req_info[0]['phyaddress'];
				$phyphone		= $req_info[0]['phyphone'];
				$phyfax			= $req_info[0]['phyfax'];
				$reason			= $req_info[0]['reason'];
				$ccname			= $req_info[0]['clientname']; 
			    $ccphone		= $req_info[0]['phnum'];
				if($date < date('Y-m-d')){$status=4;}else{$status=9;}
				$veh_id 		= $req_info[0]['vehtype'];
				$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 
									drv_id 			=		'$drvid',
									trip_id 		=     	'$trip_id',
									veh_id 			= 		'$veh_id',
									date			= 		'$date',
									pck_add 		= 		'".sql_replace($pckadd)."',
									pck_time 		= 		'$ptime',
									pck_ptime 		= 		'$pck_ptime',
									pck_atime 		= 		'',
									drp_add 		= 		'".sql_replace($drpaddr)."',
									drp_time 		= 		'$drp_time',
									drp_ptime 		= 		'$drp_ptime',
									drp_atime 		= 		'',
									trip_miles 		= 		'$trp_miles',
									total	 		= 		'$trp_total',									
									type 			= 		'$type',
									wc 				= 		'$wc',
									status			=  		'$status',
									lname	 		= 		'".sql_replace($lname)."',
									clinic	 		= 		'$clinic',
									legcharges 		= 		'".($legcharges)."',
									reqid 			= 		'$reqsid',
									pick_latlong	= 		'$cp',
									drop_latlong	= 		'$cd',   
									picklocation	=		'".sql_replace($picklocation)."',
									droplocation	=		'".sql_replace($droplocation)."',
									pickup_instruction	= 	'".sql_replace($pickup_instruction)."',
									destination_instruction	='".sql_replace($destination_instruction)."',
									d_phnum			= 		'$d_phnum',
									p_phnum			= 		'$p_phnum',
									ccode			= 		'$ccode',
									unloaded_miles	=		'$unloaded_miles',
									cellalertoption	=		'".$req_info[0]['cellalertoption']."',
									cellalert		=		'".$req_info[0]['cellalert']."',
									trip_remarks 	= 		\"".sql_replace($trp_remarks)."\"";
				$db->execute($tQuery);  return;
																
			}
			
?>