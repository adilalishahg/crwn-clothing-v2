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

//echo $time						= sprintf("%04d", '800'); exit;

$getWorksheetName = array();
function daystodate($days)
{
	return date('Y-m-d', strtotime('1970-01-01') + strtotime("+" . ($days - 25569) . " days", 0));
}
//return DateTime::createFromFormat('Y-m-d', '1900-01-01')->modify('+ '.$days.' days')->modify('-2 day')->format('Y-m-d');
function nameorder($name)
{
	$A = explode(",", $name);
	$name = trim($A[1]) . ' ' . trim($A[0]);
	if ($A[2]) {
		$name = $A[2] . ' ' . $name;
	}
	return $name;
}
function address_formate($address)
{
	$A = explode(",", $address);
	$A0 = $A[0]; //address
	$city = $A[1]; //city
	$A2 = trim($A[2]); //State and zip
	$state = substr($A2, 0, 2); //State
	$zip = substr($A2, 2); //Zip code
	$ADD = explode("-", $A0);
	$address = $ADD[0];
	if ($ADD[1]) {
		$room = $ADD[1];
	}
	return trim($address) . ',' . trim($room) . ',' . trim($city) . ',' . trim($state) . ',' . trim($zip);
}
function phone_format($number)
{
	$number = '(' . substr($number, 0, 3) . ') ' . substr($number, 3, 3) . '-' . substr($number, 6);
	return $number;
}
function daystotime($day)
{
	$total_seconds = $day * 24 * 60 * 60;
	$h = floor($total_seconds / (60 * 60));
	$i = floor(($total_seconds % (60 * 60)) / 60);
	//return $h.':'.$i.':00';
	return  gmdate("H:i:s", $total_seconds);
}
function time_format($number)
{
	$number = substr($number, 0, 2) . ':' . substr($number, 2, 2);
	return $number;
}
function pickuptime($number)
{
	$total_seconds = (substr($number, 0, 2)) * 3600 + (substr($number, 2, 2)) * 60;
	if ($total_seconds > 60 * 60) {
		$total_seconds = ($total_seconds - (60 * 60));
	}
	return  gmdate("H:i:s", $total_seconds);
}
function vehtype($vehtype, $db)
{
	$Query = "SELECT id FROM  vehtype WHERE TRIM(LOWER(REPLACE(vehtype,' ','')))='" . strtolower(trim(str_replace(' ', '', $vehtype))) . "' ";
	if ($db->query($Query) && $db->get_num_rows() > 0) {
		$data = $db->fetch_one_assoc();
		return $data['id'];
	} else {
		return '0';
	}
}

// Insert genral data from excel sheet
function gen_data($data, $db, $dated, $account)
{
	echo "<br/>";
	print_r($data);
	$name = $data[5];
	$address = trim(str_replace("'", " ", $data[6]))  .  ' ' . $data[7] . ' ' . $data[8] . ' ' . $data[9];
	$zip =  $data[8];
	$city =  $data[7];
	$phnum =  $data[10];
	$email =  $data[11];
	$dob =  daystodate($data[13]);
	$sex =  ($data[14]);
	if ($sex == 'F') {
		$gender = 'Female';
	} else if ($sex == 'M') {
		$gender = 'Male';
	} else {
		$gender = '';
	}
	$Qfind = "SELECT name FROM patient WHERE  LTRIM(LOWER(name)) = '" . strtolower(trim(sql_replace($name))) . "' "; //phone='".$phnum."' AND
	if ($db->query($Qfind) && $db->get_num_rows() > 0) {
	} else {
		$Qinsert = "INSERT INTO patient SET 
					name			=	'" . sql_replace($name) . "',
					dob				=	'$dob',
					sex				=	'$gender',
					zip				=	'$zip',
					city				=	'$city', 
					address			=	'" . str_replace('\'', '`', $address) . "',
					phone			=	'$phnum'";
		$db->execute($Qinsert);
	}
	// print_r(($sex));
	// echo "<br/>";
	// print_r($address);
	exit;
	//if($data[0]=='Logisticare'){$account=48;}
	//if($data[0]=='Medi-Cal'){$account=49;}
	$legid	 	  				= (trim($data[1]));
	//$appdate 	  				= convertDateToMySQL($dated);//convertDateToMySQL($data[2]);//daystodate($data[2]);



	$datedXXX = trim($data[2]);

	if (strpos($datedXXX, '/') !== false) {
		$appdate = convertDateToMySQL($datedXXX);
	} else {
		$appdate = daystodate(trim($data[2]));
	}

	//echo  $appdate;exit;

	$vehicle_abbr 	  			= (trim($data[3]));
	if ($vehicle_abbr == 'A' || $vehicle_abbr == 'ADD') {
		$vehicle = 'Ambulatory';
	}
	if ($vehicle_abbr == 'W' || $vehicle_abbr == 'W/C') {
		$vehicle = 'Wheel Chair';
	}
	if ($vehicle_abbr == 'A') {
		$vehicle = 'Ambulatory';
	}
	if ($vehicle_abbr == 'W') {
		$vehicle = 'Wheel Chair';
	}
	if ($vehicle_abbr == 'VS') {
		$vehicle = 'Regular Stretcher';
	}
	if ($vehicle_abbr == 'BS') {
		$vehicle = 'Bariatric Stretcher';
	}
	if ($vehicle_abbr == 'BW') {
		$vehicle = 'Bariatric Wheel Chair';
	}
	$vehtype  					= vehtype($vehicle, $db);
	$pname 	  					= nameorder(str_replace("'", "`", trim($data[4]))); //str_replace('\'','`',
	$picklocation				= trim($data[6]);
	$pickaddress  				= trim(str_replace("'", " ", $data[7])) . ',' . trim(str_replace("'", " ", $data[9])) . ',' . trim(str_replace("'", " ", $data[10])) . ' ' . $data[11] . ' ' . $data[12];
	$pickup_instruction 	  	= trim($data[34]); //($data[8]);
	$p_phnum					= $data[13]; //phone_format(str_replace("-","",$data[13]));
	$droplocation				= trim($data[15]);
	$dropaddress  				= trim(str_replace("'", " ", $data[16])) . ',' . trim(str_replace("'", " ", $data[18])) . ',' . trim(str_replace("'", " ", $data[19])) . ', ' . $data[20] . ' ' . $data[21];
	$destination_instruction 	= ($data[17]);
	$d_phnum					= $data[22]; //phone_format(str_replace("-","",$data[22])); 
	$time						= $data[14]; //sprintf("%04d", $data[23]);
	$time2						= $data[24]; //sprintf("%04d", $data[24]);

	$apptime  					= daystotime($time);
	$org_apptime  				= daystotime($time2);

	$dobDate 	  				= trim($data[25]);
	if (strpos($dobDate, '/') !== false) {
		$dob 					= convertDateToMySQL(trim($data[25]));
	} else {
		$dob 					= daystodate(trim($data[25]));
	}

	$sex 	  					= trim($data[31]);
	$phnum						= $p_phnum;
	$mile 	  					= trim($data[33]);
	$legcharges					= trim($data[11]);
	$driver	  					= trim($data[38]);
	$comments 	  				= trim($data[35]) . ' - ' . trim($data[36]);
	if (trim($data[2]) != '' && trim($data[2]) != ' ') {

		$Q4 = "SELECT * FROM " . TBL_FORMS . " WHERE appdate = '" . $appdate . "' AND clientname = '" . $pname . "' ORDER BY id DESC LIMIT 1 ";
		if ($db->query($Q4) && $db->get_num_rows() > 0) {
			$d5 = $db->fetch_one_assoc();
			$totalmile	=	$d5['milage'] + $mile;
			$charges	=	$d5['charges'] + $legcharges;
			$pickup_instruction 	  	= $d5['pickup_instruction'] . ' - ' . $destination_instruction;
			$destination_instruction 	= $d5['destination_instruction'] . ' - ' . $pickup_instruction;
			switch ($d5['triptype']) { //unloaded_miles_b='".$driver."',
				case ('One Way'):
					$QR = ", triptype				=	'Round Trip',
									
								  droplocation			=	'" . str_replace("'", " ", $picklocation) . "',
								  backtolocation		=	'" . str_replace("'", " ", $droplocation) . "',
								  backto				=	'" . str_replace("'", " ", $dropaddress) . "',
								  returnpickup			=	'" . $apptime . "',
								  pickup_instruction	=	'" . str_replace("'", " ", $pickup_instruction) . "',
								  destination_instruction='" . str_replace("'", " ", $destination_instruction) . "',
								  legbid='" . $legid . "'";
					break; //unloaded_miles_c='".$driver."',
				case ('Round Trip'):
					$QR = ", triptype				=	'Three Way',
									
								  droplocation2			=	'" . str_replace("'", " ", $picklocation) . "',
								  backtolocation		=	'" . str_replace("'", " ", $droplocation) . "',
								  three_address			=	'" . str_replace("'", " ", $pickaddress) . "',
								  backto				=	'" . str_replace("'", " ", $dropaddress) . "',
								  three_pickup			=	'" . $d5['returnpickup'] . "',
								  returnpickup			=	'" . $apptime . "',
								  destination_instruction2='" . str_replace("'", " ", $pickup_instruction) . "',
								  legcid='" . $legid . "'";
					break;
				case ('Three Way'):
					$QR = ", triptype				=	'Four Way',
								  droplocation3			=	'" . str_replace("'", " ", $picklocation) . "',
								  backtolocation		=	'" . str_replace("'", " ", $droplocation) . "',
								  four_address			=	'" . str_replace("'", " ", $pickaddress) . "',
								  backto				=	'" . str_replace("'", " ", $dropaddress) . "',
								  four_pickup			=	'" . $d5['returnpickup'] . "',
								  returnpickup			=	'" . $apptime . "',
								  destination_instruction3='" . str_replace("'", " ", $pickup_instruction) . "',
								  legdid='" . $legid . "'";
					break;
				default:
					break;
			}
			//legcharges	 		=	'".$d5['legcharges'].','.$legcharges."',
			$Q5 = "UPDATE " . TBL_FORMS . " SET
				miles_string 		=	'" . $d5['miles_string'] . ',' . $mile . "',
				
				milage				=	'" . $totalmile . "',
				charges				=	'" . $charges . "'
				$QR
				WHERE id = '" . $d5['id'] . "'";
			$db->execute($Q5);
		} else {

			$Qfind = "SELECT name FROM patient WHERE  LTRIM(LOWER(name)) = '" . strtolower(trim(sql_replace($pname))) . "' "; //phone='".$phnum."' AND
			if ($db->query($Qfind) && $db->get_num_rows() > 0) {
			} else {
				$Qinsert = "INSERT INTO patient SET 
					name			=	'" . sql_replace($pname) . "',
					dob				=	'$dob',
					address			=	'" . str_replace('\'', '`', $pickaddress) . "',
					phone			=	'$phnum'";
				$db->execute($Qinsert);
			}

			//unloaded_miles_a='".$driver."',legcharges='".$legcharges."',
			$Q3  = "INSERT INTO " . TBL_FORMS . " SET 
	   					account='" . $account . "',
						
						miles_string = '" . $mile . "',
						milage='" . $mile . "',
						triptype='One Way',	
						vehtype='" . $vehtype . "',	
						req_id='" . $req_id . "',
						pickaddr='" . $pickaddress . "',
						destination='" . $dropaddress . "',
						appdate='" . $appdate . "',
						apptime='" . $apptime . "',
						today_date=NOW(),
						clientname='" . str_replace("'", " ", $pname) . "',
                    	phnum='" . $phnum . "',
						legaid='" . $legid . "',
						
						picklocation='" . str_replace("'", " ", $picklocation) . "',
						pickup_instruction='" . str_replace("'", " ", $pickup_instruction) . "',
						p_phnum='" . $p_phnum . "',
						droplocation='" . str_replace("'", " ", $droplocation) . "',
						destination_instruction='" . str_replace("'", " ", $destination_instruction) . "',
						d_phnum='" . $d_phnum . "',
						org_apptime='" . $org_apptime . "',
						dob='" . $dob . "',
						sex='" . $sex . "',
						comments='" . str_replace("'", " ", $comments) . "'";
			$db->execute($Q3); //exit;

		}
	}
}
if ((!empty($_FILES["file_csv"])) && ($_FILES['file_csv']['error'] == 0)) { // print_r($_FILES); exit;
	$limitSize	= 150000000; //(150000 kb) - Maximum size of uploaded file, t
	$fileName	= basename($_FILES['file_csv']['name']);
	$fileSize	= $_FILES["file_csv"]["size"];
	$dated		= $_POST['dated'];
	//$account	= $_POST['account'];
	// $officelocation	= $_POST['officelocation'];
	// $hostname='logisticare';
	//  $Qaccounts  = "SELECT id FROM " .  accounts ." WHERE TRIM(LOWER(REPLACE(account_name,' ',''))) IN('logisticcare','logisticare','modivcare')";
	// if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc();   }
	// //$account = @$accounts[$tripfor];
	// $account=trim($accounts['id']);

	$fileExt	= substr($fileName, strrpos($fileName, '.') + 1);
	if (($fileExt == "xlsx") || ($fileExt == "csv") && ($fileSize < $limitSize)) {
		$getWorksheetName = array();
		$xlsx = new SimpleXLSX($_FILES['file_csv']['tmp_name']);
		$getWorksheetName = $xlsx->getWorksheetName();
		$count = $xlsx->sheetsCount(); //print_r($xlsx->rows); exit;
		for ($j = 1; $j <= $count; $j++) {
			$sheetdata = $xlsx->rows($j);
			for ($k = 4; $k < sizeof($sheetdata); $k++) {
				// print_r($sheetdata[$k]);
				// exit;
				gen_data($sheetdata[$k], $db, $dated, $account);
			}
		}
		echo '<script>alert("Trips Uploaded Successfully");</script>'; // exit;
		echo '<script>javascript:history.back();</script>';
		exit;
	} else {
		echo "<script>alert('The Selected file is not supported!');</script>";
		echo '<script>javascript:history.back();</script>';
		exit;
	}
}
// $Qlocs  = "SELECT * FROM ".  officelocations ." WHERE 1=1 ORDER BY location ASC " ;// id IN(".$_SESSION['admuser']['officelocation'].")
// 			if($db->query($Qlocs) && $db->get_num_rows() > 0){	$locs = $db->fetch_all_assoc();	 }	


$db->close();
$pgname = "add sheet";
$smarty->assign("pgTitle", 'Add Trips Sheet');
// $smarty->assign("locs",$locs);	
$smarty->assign("pgname", $pgname);
$smarty->display('mercytpl/logistic.tpl');