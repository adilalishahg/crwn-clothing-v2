<?php
include_once('../DBAccess/Database.inc.php');
//include_once('../routingpanel/ExcellReader.php');
include_once('../../Classes/simplexlsx.class.php');
ini_set('memory_limit', '500M');
ini_set('max_execution_time', 1000); //300 seconds = 5 minutes
$db = new Database;	
$db->connect();
$msgs   = '';
$errors = '';
//echo date("H:i", strtotime("12:25 PM")); exit;
//echo time_format_ampm('1230P');
$getWorksheetName = array();
function daystodate($days){
	return date('Y-m-d', strtotime('1970-01-01') + strtotime("+".($days-25569)." days",0));}
	
	
//return DateTime::createFromFormat('Y-m-d', '1900-01-01')->modify('+ '.$days.' days')->modify('-2 day')->format('Y-m-d');
function nameorder($name){$A=explode(",",$name); return $A[1].' '.$A[0];}
function address_formate($address){
	$A=explode(",",$address);
	$A0=$A[0];//address
	$city=$A[1];//city
	$A2=trim($A[2]);//State and zip
	$state=substr($A2, 0,2); //State
	$zip=substr($A2, 2); //Zip code
	$ADD=explode("-",$A0);
	$address=$ADD[0];
	if($ADD[1]){$room=$ADD[1];}
	return trim($address).','.trim($room).','.trim($city).','.trim($state).','.trim($zip); 
	}
function phone_format($number){
	$number = '('. substr($number,0,3) .') '.substr($number,3,3).'-'.substr($number,6);
	return $number;}
function dateted_format($number){
	$number = substr($number,0,4) .'-'.substr($number,4,2).'-'.substr($number,6);
	return $number;}	
function time_format($number){
	$number = substr($number,0,2) .':'.substr($number,2,2);
	return $number;}
function time_format_ampm($number){
	if(substr($number,4,1)=='p' || substr($number,4,1)=='P'){$rad = 'PM';
	}else{$rad = 'AM';}
	$time = substr($number,0,2) .':'.substr($number,2,2);
	
	$number = date("H:i", strtotime($time." ".$rad));
	//$number = substr($number,0,2) .':'.substr($number,2,2);
	
	return $number;}	
function pickuptime($number){
	$total_seconds = (substr($number,0,2))*3600 + (substr($number,2,2))*60;
	if($total_seconds > 60*60){$total_seconds =($total_seconds-(60*60));}
return  gmdate("H:i:s", $total_seconds);}				
function daystotime($day){ $total_seconds = $day*24*60*60;
$h= floor($total_seconds / (60*60));
$i= floor(($total_seconds%(60*60)) / 60);
return  gmdate("H:i:s", $total_seconds);
// return $h.':'.$i.':00';
}
function vehtype($vehtype,$db){
	 $Query = "SELECT id FROM  vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='".strtolower(trim(str_replace(' ','',$vehtype)))."' ";
	if($db->query($Query) && $db->get_num_rows() > 0){
	 $data = $db->fetch_one_assoc(); } return $data['id'];
	}	
	
// Insert genral data from excel sheet
function gen_data($data,$db,$dated){ 
			
			  $pname 	  				= nameorder(str_replace("'"," ",trim($data[1])));//.' '.str_replace("'"," ",trim($data[1]));
			  $phnum					= phone_format(str_replace("-","",trim($data[2]))); 
			  $apptime					= time_format_ampm(trim($data[4]) );//sprintf("%04d", $data[9]);
			  $org_apptime  			= time_format_ampm(trim($data[5]) );
			  $address					= trim(str_replace("'"," ",$data[6]));
			  $address_ar 				= explode(',,',$address);
			  $city  					= trim(str_replace("'"," ",$data[7]));
			  $pickaddress 				= @$address_ar[0].','.$city.','.@$address_ar[1];
			  
			  $address2					= trim(str_replace("'"," ",$data[8]));
			  $address_ar2 				= explode(',,',$address2);
			  $city2  					= trim(str_replace("'"," ",$data[9]));
			  $dropaddress 				= @$address_ar2[0].','.$city2.','.@$address_ar2[1];
			  $mile 	  				= trim($data[10]);
			  $charges 	  				= trim($data[11]);
			  $vehicle_abbr 	  			= (trim($data[13])); 
				if($vehicle_abbr=='WC'){$vehicle='Wheelchair';}
				if($vehicle_abbr=='WCH'){$vehicle='Wheelchair';}
				if($vehicle_abbr=='C'){$vehicle='Wheelchair';}
				if($vehicle_abbr=='D'){$vehicle='Ambulatory';}
				if($vehicle_abbr=='T'){$vehicle='Ambulatory';}
				if($vehicle_abbr=='ParaTran / WC Van'){$vehicle='Wheel Chair Van';}
				$vehtype  					= vehtype($vehicle,$db); 
			 $legid	 	  			= (trim($data[16]));
			 $appdate 	  				= daystodate($data[3]);//dateted_format($data[8]);
			 $comments 	  			= trim(str_replace("'"," ",$data[20])); 
			  //$dob 	  					= dateted_format(trim($data[3]));
			 // $droplocation				= trim(str_replace(",","",$data[26]));
			 // $dropaddress  			= trim(str_replace("'"," ",$data[27])).',,'.trim(str_replace("'"," ",$data[28])).','.trim(str_replace("'"," ",$data[29])).','.trim(str_replace("'"," ",$data[30])); 
			//$d_phnum					= phone_format(str_replace("-","",trim($data[32])));
			  $today_date 				=  date('Y-m-d');//dateted_format(trim($data[38])); 
			 //  echo exit;  
			 // $data[10];
			 // $vehtype  				= vehtype('Sedan',$db);
		//echo  exit;
   			//$pickup_instruction 	  	= '';//($data[9]);
		//$destination_instruction 	= '';//($data[18]);
		//$sex 	  					= '';//trim($data[27]);
		//$phnum						= trim($data[28]); 

	
	$Q4="SELECT * FROM ".TBL_FORMS." WHERE appdate = '".$appdate."' AND clientname = '".$pname."' ORDER BY id DESC LIMIT 1 ";
	if($db->query($Q4) && $db->get_num_rows() > 0){$d5 = $db->fetch_one_assoc();
	$totalmile=$d5['milage']+$mile;
	$totalcharges=$d5['charges']+$charges;
	$legcharges=$d5['legcharges'].','.$charges;
	
	
	
	$pickup_instruction 	  	= $d5['pickup_instruction'];
	$destination_instruction 	= $d5['destination_instruction'];
	if($apptime=='00:00' || $apptime=='00:00:00'){$apptime='Will Call';}
	
	switch($d5['triptype']){
						case ('One Way') :
							$QR=", triptype				=	'Round Trip',
								  droplocation			=	'".str_replace("'"," ",$picklocation)."',
								  backtolocation		=	'".str_replace("'"," ",$droplocation)."',
								  backto				=	'".str_replace("'"," ",$dropaddress)."',
								  returnpickup			=	'".$apptime."',
								  pickup_instruction	=	'".str_replace("'"," ",$pickup_instruction)."',
								  destination_instruction='".str_replace("'"," ",$destination_instruction)."',
								  legbid='".$legid."'";
							break;
						case ('Round Trip') :
							$QR=", triptype				=	'Three Way',
								  droplocation2			=	'".str_replace("'"," ",$picklocation)."',
								  backtolocation		=	'".str_replace("'"," ",$droplocation)."',
								  three_address			=	'".str_replace("'"," ",$pickaddress)."',
								  backto				=	'".str_replace("'"," ",$dropaddress)."',
								  three_pickup			=	'".$d5['returnpickup']."',
								  returnpickup			=	'".$apptime."',
								  destination_instruction2='".str_replace("'"," ",$pickup_instruction)."',
								  legcid='".$legid."'";
							break;	
						case ('Three Way') :
							$QR=", triptype				=	'Four Way',
								  droplocation3			=	'".str_replace("'"," ",$picklocation)."',
								  backtolocation		=	'".str_replace("'"," ",$droplocation)."',
								  four_address			=	'".str_replace("'"," ",$pickaddress)."',
								  backto				=	'".str_replace("'"," ",$dropaddress)."',
								  four_pickup			=	'".$d5['returnpickup']."',
								  returnpickup			=	'".$apptime."',
								  destination_instruction3='".str_replace("'"," ",$pickup_instruction)."',
								  legdid='".$legid."'";
							break;		
						default :
							break;	}
	$Q5="UPDATE ".TBL_FORMS." SET
				miles_string 		=	'".$d5['miles_string'].','.$mile."',
				milage				=	'".$totalmile."',
				charges				=	'".$totalcharges."',
				legcharges			=	'".$legcharges."'
				$QR
				WHERE id = '".$d5['id']."'";
	$db->execute($Q5);
	
	
	}else{
		
	 $Qaccounts  = "SELECT id FROM " .  accounts ." WHERE TRIM(LOWER(account_name))='".strtolower(trim('mart'))."' " ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc();	
	
	 
	  $Q3  = "INSERT INTO ".TBL_FORMS." SET 
	   				account='".$accounts['id']."',
						miles_string = '".$mile."',
						milage='".$mile."',
						triptype='One Way',	
						
						charges			= '".$charges."',
						legcharges		='".$charges."',
						
						
						vehtype='".$vehtype."',	
						pickaddr='".$pickaddress."',
						destination='".$dropaddress."',
						appdate='".$appdate."',
						apptime='".$apptime."',
						today_date=NOW(),
						clientname='".str_replace("'"," ",$pname)."',
                    	phnum='".$phnum."',
						legaid='".$legid."',
						picklocation='".str_replace("'"," ",$picklocation)."',
						pickup_instruction='".str_replace("'"," ",$pickup_instruction)."',
						p_phnum='".$phnum."',
						droplocation='".str_replace("'"," ",$droplocation)."',
						destination_instruction='".str_replace("'"," ",$destination_instruction)."',
						d_phnum='".$d_phnum."',
						org_apptime='".$org_apptime."',
						dob='".$dob."',
						sex='".$sex."',
						comments='".str_replace("'"," ",$comments)."'";
	 $db->execute($Q3);
	       }	}	}
	
	
if((!empty($_FILES["file_csv"])) && ($_FILES['file_csv']['error'] == 0)) {
	
	$limitSize	= 150000000; //(150000 kb) - Maximum size of uploaded file, t
	$fileName	= basename($_FILES['file_csv']['name']);
	$fileSize	= $_FILES["file_csv"]["size"];
		$dated		= $_POST['dated'];

	$fileExt	= substr($fileName, strrpos($fileName, '.') + 1);
	if (($fileExt == "xlsx") && ($fileSize < $limitSize)) {
	$getWorksheetName = array();
		$xlsx = new SimpleXLSX( $_FILES['file_csv']['tmp_name'] );
		$getWorksheetName = $xlsx->getWorksheetName();
		$count = $xlsx->sheetsCount();
		for($j=1; $j<=$count; $j++){ 
			$tdata = $xlsx->rows($j); 
			
			$sheetdata = sort_array_multidim($tdata, "14 ASC, 15 ASC");
			//echo '<pre>';
			//print_r($tdata); exit;
			
			
			 for($k=0; $k<sizeof($sheetdata); $k++)
			 { //print_r($sheetdata[$k] ); exit;
			  gen_data($sheetdata[$k],$db,$dated);
			  } 
		}
		echo '<script>alert("Trip Sheet Uploaded Successfully");</script>'; 
				echo '<script>javascript:history.back();</script>';
				exit;
	}
	else{ echo "<script>alert('The Selected file is not supported!');</script>";
	      echo '<script>javascript:history.back();</script>'; exit; }
}
			$db->close();
			$pgname="add sheet"; 
			$smarty->assign("pgTitle",'Add Trips Sheet');
			$smarty->assign("pgname",$pgname);	
			$smarty->display('mercytpl/mart.tpl'); 


?>