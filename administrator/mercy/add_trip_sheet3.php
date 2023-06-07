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
$getWorksheetName = array();
function daystodate($days){
	return date('Y-m-d', strtotime('1970-01-01') + strtotime("+".($days-25569)." days",0));}
//return DateTime::createFromFormat('Y-m-d', '1900-01-01')->modify('+ '.$days.' days')->modify('-2 day')->format('Y-m-d');
function nameorder($name){$A=explode(",",$name); return trim($A[1]).' '.trim($A[0]);}
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
function daystotime($day){ $total_seconds = $day*24*60*60;
return  gmdate("H:i:s", $total_seconds);
}
function pickuptime($day,$mile){ $total_seconds = $day*24*60*60;
$minus=$mile*3*60;
if($total_seconds > 60*60){$total_seconds =($total_seconds-($minus));}
return  gmdate("H:i:s", $total_seconds);
}
function vehtype($vehtype,$db){ //$vehtype='Ambulatory';
	 $Query = "SELECT id FROM  vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='".strtolower(trim(str_replace(' ','',$vehtype)))."' ";
	if($db->query($Query) && $db->get_num_rows() > 0){
	 $data = $db->fetch_one_assoc(); } return $data['id'];
	}	
	
// Insert genral data from excel sheet
function gen_data($data,$db,$dated){ 	//print_r($data); exit;
	 	$legid	 	  				= (trim($data[1])); 		
		$pname 	  					= str_replace("'"," ",trim($data[3]));
		$dob 	  					= daystodate(trim($data[4]));
		$patient_weight 			= (trim($data[5]));
		$pickaddress  				= trim(str_replace("'"," ",$data[7])).',,'.trim(str_replace("'"," ",$data[8])); 
		$phnum						= phone_format(str_replace("-","",trim($data[9])));
	 	//$vehicle	  				= explode('/',(trim($data[11])));
		
		 $vehicle_abbr 	  			= (trim($data[11])); 
	if($vehicle_abbr=='Sedan/VanNONE'){$vehicle='Ambulatory';}
	if($vehicle_abbr=='Sedan/Van CAN TRANSPORT'){$vehicle='Wheel Chair Van';}
	if($vehicle_abbr=='ParaTran / WC Van'){$vehicle='Wheel Chair Van';}
	//if($vehicle_abbr=='Sedan/Van CAN TRANSPORT'){$vehicle='Bariatric Stretcher';}
		$vehtype  					= vehtype($vehicle,$db);
		
	  	//$vehtype  					= vehtype($vehicle[0],$db);
	  	$droplocation				= trim($data[14]);
	  	$d_phnum					= phone_format(str_replace("-","",trim($data[15])));
		$dropaddress  				= trim(str_replace("'"," ",$data[16])).',,'.trim(str_replace("'"," ",$data[17]));
		$appdate 	  				= convertDateToMySQL($dated);//daystodate($data[20]);
		$mile 	  					= trim($data[23]);
		$org_apptime  				= daystotime($data[21]);
		$apptime  					= daystotime(trim($data[22])); 
		if(trim($data[22])==''){$apptime  	= pickuptime($data[21],$mile); }
	  	$comments 	  				= trim($data[24]); //  exit;
    	$picklocation				= '';//trim($data[6]); 
		$pickup_instruction 	  	= trim($data[12]);//($data[9]);
		$destination_instruction 	= '';//($data[18]);
    	 
		$sex 	  					= '';//trim($data[27]);
		//$phnum						= trim($data[28]); 
		$company_code						= trim($data[32]); 
	if($company_code==''){$company_code='BB';}
	$Q33="SELECT * FROM ".TBL_FORMS." WHERE appdate = '".$appdate."' AND legaid='$legid' AND reqstatus !='disapproved' || 
											appdate = '".$appdate."' AND legbid='$legid' AND reqstatus !='disapproved' || 
											appdate = '".$appdate."' AND legcid='$legid' AND reqstatus !='disapproved' ||
											appdate = '".$appdate."' AND legdid='$legid' AND reqstatus !='disapproved' ORDER BY id DESC LIMIT 1";
	if($db->query($Q33) && $db->get_num_rows() > 0){}else{										
	$Q4="SELECT * FROM ".TBL_FORMS." WHERE appdate = '".$appdate."' AND clientname = '".$pname."' AND reqstatus !='disapproved' ORDER BY id DESC LIMIT 1 ";
	if($db->query($Q4) && $db->get_num_rows() > 0){$d5 = $db->fetch_one_assoc();
	//$totalmile=$d5['miles_string']+$mile;
	$totalmile=$d5['milage']+$mile;
	$pickup_instruction 	  	= $d5['pickup_instruction'].' - '.$destination_instruction;
	$destination_instruction 	= $d5['destination_instruction'].' - '.$pickup_instruction;
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
								  ccodeb='".$company_code."',
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
								  ccodec='".$company_code."',
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
								  ccoded='".$company_code."',
								  legdid='".$legid."'";
							break;		
						default :
							break;	}
	$Q5="UPDATE ".TBL_FORMS." SET
				miles_string 		=	'".$d5['miles_string'].','.$mile."',
				milage				=	'".$totalmile."'
				$QR
				WHERE id = '".$d5['id']."'";
	$db->execute($Q5);
	
	
	
	/*$Q5="UPDATE ".TBL_FORMS." SET
				miles_string 		=	'".$d5['miles_string'].','.$mile."',
				milage				=	'".$totalmile."',
				triptype			=	'Round Trip',
				backto				=	'".$dropaddress."',
				returnpickup		=	'".$org_apptime."',
				pickup_instruction	=	'".$pickup_instruction."',
				destination_instruction='".$destination_instruction."',
				legbid='".$legid."',
				ccodeb='".$company_code."'
				WHERE id = '".$d5['id']."'";
	$db->execute($Q5);*/
	}else{
		$Qfind="SELECT * FROM patient WHERE phone='".$phnum."' AND LTRIM(LOWER(name)) = '".strtolower(trim(sql_replace($pname)))."' ";
		if($db->query($Qfind) && $db->get_num_rows()>0){}else{
			$Qinsert="INSERT INTO patient SET 
					name			=	'".sql_replace($pname)."',
					insurance_name	=	'".sql_replace($insurance_name)."',
					insurance		=	'$cisid',
					ssn				=	'$ssn',
					dob				=	'$dob',
					address			=	'".str_replace(',','',$pickaddress)."',
					city			=	'',
					state			=	'',
					zip				=	'',
					phone			=	'$phnum'"; $db->execute($Qinsert);
			}
	$Qaccounts  = "SELECT id FROM " .  accounts ." WHERE TRIM(LOWER(account_name))='".strtolower(trim('Access2Care'))."' " ;
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc(); //	print_r($accounts); exit;
	 	  $Q3  = "INSERT INTO ".TBL_FORMS." SET 
	   					account='".$accounts['id']."',
						miles_string = '".$mile."',
						milage='".$mile."',
						triptype='One Way',	
						vehtype='".$vehtype."',	
						req_id='".$req_id."',
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
						ccodea='".$company_code."',
						comments='".str_replace("'"," ",$comments)."'"; //exit;
	 $db->execute($Q3);
	       }		
	}
	}
}
if((!empty($_FILES["file_csv"])) && ($_FILES['file_csv']['error'] == 0)) { // print_r($_FILES); exit;
	$limitSize	= 150000000; //(150000 kb) - Maximum size of uploaded file, t
	$fileName	= basename($_FILES['file_csv']['name']);
	$fileSize	= $_FILES["file_csv"]["size"];
		$dated		= $_POST['dated'];

	$fileExt	= substr($fileName, strrpos($fileName, '.') + 1);
	if (($fileExt == "xlsx") || ($fileExt == "csv") && ($fileSize < $limitSize)) {
	$getWorksheetName = array();
		$xlsx = new SimpleXLSX( $_FILES['file_csv']['tmp_name'] );
		$getWorksheetName = $xlsx->getWorksheetName();
		$count = $xlsx->sheetsCount();
		for($j=1; $j<=$count; $j++){
			$sheetdata = $xlsx->rows($j);  //print_r($xlsx->rows); exit;
			 for($k=1; $k<sizeof($sheetdata); $k++)
			 {  //print_r($sheetdata[$k] ); exit;
			  gen_data($sheetdata[$k],$db,$dated);
			  } 
		}
		echo '<script>alert("Trips Sheet Uploaded Successfully");</script>';
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
			$smarty->display('mercytpl/add_listing_csv3.tpl'); 
/*
Array ( 
[0] => C 
	[1] => 13237322T 
	[3] => CYNTHIA T NEWSON YOPP 
	[4] => 19144 
	[5] => 0 
	[7] => 1000 Burlington Ave N APT 610 
	[8] => SAINT PETERSBURG FL 33705 
	[9] => 727-623-5810 
[10] => PINELLAS 
	[11] => Sedan/VanNONE 
[13] => 
	[14] => LIVE BETTER HEALTH CENTER 
	[15] => 727-827-2825 
	[16] => 4423 Park Blvd N 
	[17] => PINELLAS PARK FL 33781 
[18] => 0 
[19] => None 
	[20] => 42172 
	[21] => 0.41666666666667 
[23] => 10 
[25] => 
[26] => 
[27] => )
*/
?>