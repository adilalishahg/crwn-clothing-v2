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

$h= floor($total_seconds / (60*60));

$i= floor(($total_seconds%(60*60)) / 60);

//return $h.':'.$i.':00';

return  gmdate("H:i:s", $total_seconds);

}

function vehtype($vehtype,$db){

	 $Query = "SELECT id FROM  vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='".strtolower(trim(str_replace(' ','',$vehtype)))."' ";

	if($db->query($Query) && $db->get_num_rows() > 0){

	 $data = $db->fetch_one_assoc(); } return $data['id'];

	}	

	

// Insert genral data from excel sheet

function gen_data($data,$db,$dated){ 

	 	$legid	 	  				= (trim($data[1])); 

	 	$appdate 	  				= daystodate($data[2]);

	 $vehicle_abbr 	  			= (trim($data[3])); 

	if($vehicle_abbr=='A'){$vehicle='Ambulatory';}

	if($vehicle_abbr=='W'){$vehicle='Wheel Chair';}

	if($vehicle_abbr=='VS'){$vehicle='Regular Stretcher';}

	if($vehicle_abbr=='BS'){$vehicle='Bariatric Stretcher';}

	if($vehicle_abbr=='BW'){$vehicle='Bariatric Wheel Chair';}

	

		$vehtype  					= vehtype($vehicle,$db);

   		$pname 	  					= nameorder(str_replace("'","`",trim($data[4])));//str_replace('\'','`',

    	$picklocation				= trim($data[6]); 

		$pickaddress  				= trim(str_replace("'"," ",$data[7])).','.trim(str_replace("'"," ",$data[8])).','.trim(str_replace("'"," ",$data[10])).','.trim(str_replace("'"," ",$data[11])).','.trim(str_replace("'"," ",$data[12]));

		$pickup_instruction 	  	= ($data[9]);

		$p_phnum					= trim($data[13]);

		

		if($data[14]<1){$apptime  	= daystotime($data[14]);}else{    	

		$apptime  					= ($data[14]); //daystotime($data[14]); 

		}

		$droplocation				= trim($data[15]); 

		$dropaddress  				= trim(str_replace("'"," ",$data[16])).','.trim(str_replace("'"," ",$data[17])).','.trim(str_replace("'"," ",$data[19])).','.trim(str_replace("'"," ",$data[20])).','.trim(str_replace("'"," ",$data[21]));

		$destination_instruction 	= ($data[18]);

		$d_phnum					= trim($data[22]); 

		

		if($data[23]<1){    	$org_apptime  				= daystotime(trim($data[23]));  }else{

		

		$org_apptime  				= (trim($data[23])); }

		

		

		$dob 	  					= convertDateToMySQL(trim($data[25]));//daystodate(trim($data[25]));

		$sex 	  					= trim($data[27]);

		$phnum						= trim($data[28]); 

		$mile 	  					= trim($data[33]); 

		$comments 	  				= trim($data[34]).' - '.trim($data[35]).' - '.trim($data[36]); 

	

	$Q33="SELECT * FROM ".TBL_FORMS." WHERE appdate = '".$appdate."' AND legaid='$legid' AND reqstatus !='disapproved' || 

											appdate = '".$appdate."' AND legbid='$legid' AND reqstatus !='disapproved' || 

											appdate = '".$appdate."' AND legcid='$legid' AND reqstatus !='disapproved' ||

											appdate = '".$appdate."' AND legdid='$legid' AND reqstatus !='disapproved' ORDER BY id DESC LIMIT 1";

	if($db->query($Q33) && $db->get_num_rows() > 0){}else{

	

	$Q4="SELECT * FROM ".TBL_FORMS." WHERE appdate = '".$appdate."' AND clientname = '".$pname."' ORDER BY id DESC LIMIT 1 ";

	if($db->query($Q4) && $db->get_num_rows() > 0){$d5 = $db->fetch_one_assoc();

	$totalmile=$d5['milage']+$mile;

	$pickup_instruction 	  	= $d5['pickup_instruction'].' - '.$destination_instruction;

	$destination_instruction 	= $d5['destination_instruction'].' - '.$pickup_instruction;

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

				milage				=	'".$totalmile."'

				$QR

				WHERE id = '".$d5['id']."'";

	$db->execute($Q5);

	}else{

		

	 $Qaccounts  = "SELECT id FROM " .  accounts ." WHERE TRIM(LOWER(account_name))='".strtolower(trim('Logistic Care'))."' " ;

	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc();

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

						p_phnum='".$p_phnum."',

						droplocation='".str_replace("'"," ",$droplocation)."',

						destination_instruction='".str_replace("'"," ",$destination_instruction)."',

						d_phnum='".$d_phnum."',

						org_apptime='".$org_apptime."',

						dob='".$dob."',

						sex='".$sex."',

						comments='".str_replace("'"," ",$comments)."'";

	 $db->execute($Q3);

	 

	 

	 $Qfind="SELECT name FROM patient WHERE LTRIM(LOWER(name)) = '".strtolower(trim(sql_replace($pname)))."' ";

		if($db->query($Qfind) && $db->get_num_rows()>0){}else{

			$Qinsert="INSERT INTO patient SET 

					name			=	'".sql_replace($pname)."',

					dob				=	'$dob',

					address			=	'".str_replace(',','',sql_replace($pickaddress))."',

					phone			=	'$phnum'"; 

					$db->execute($Qinsert);

			}

	 

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

		$count = $xlsx->sheetsCount(); //print_r($xlsx->rows); exit;

		for($j=1; $j<=$count; $j++){

			$sheetdata = $xlsx->rows($j);

			 for($k=0; $k<sizeof($sheetdata); $k++)

			 { //print_r($sheetdata[$k] ); exit;

			  gen_data($sheetdata[$k],$db,$dated); 

			  } 

		}

		echo '<script>alert("LGTC Trips Uploaded Successfully");</script>';

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

			$smarty->display('mercytpl/add_listing_csv2.tpl'); 

/*

Array ( 

	[0] => AZUM 

	[1] => 1-32565-A 

	[2] => 42145 

	[3] => W 

	[4] => ALBARADO, ARTURO 

[5] => T T S 

	[6] => Residence 

	[7] => 13215 N 94th Dr 

	[8] => 

[9] => 

	[10] => Peoria 

	[11] => AZ 

	[12] => 85381 

	[13] => (602) 643-6986 

	[14] => 0.375 

	[15] => Davita (Brookwood) Dialysis 

	[16] => 8910 N 43rd Ave 

	[17] => 

[18] => 

	[19] => Glendale 

	[20] => AZ 

	[21] => 85302 

	[22] => (623) 937-2735 

	[23] => 0.41319444444444 

[24] => 0.41666666666667 

	[25] => 18582 

[26] => 64 

	[27] => M 

	[28] => (602) 643-6986 

[29] => 0 

[30] => 0 

[31] => 0 

[32] => 0 

	[33] => 9 

	[34] => MANUAL WC//NEEDS LIFT//HT WT; 5'6 130 LBS//RTN 1400 

	[35] => 

	[36] => 

[37] => )

*/

?>