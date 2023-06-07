<?php
include_once('../DBAccess/Database.inc.php');
//include_once('../routingpanel/ExcellReader.php');
include_once('../../classes/simplexlsx.class.php');
ini_set('memory_limit', '500M');
ini_set('max_execution_time', 1000); //300 seconds = 5 minutes
$db = new Database;	
$db->connect();
$msgs   = '';
$errors = '';
$getWorksheetName = array();
// Insert genral data from excel sheet
function gen_data($data,$db){
	$status 	  			= $data[0];
	$name 	  				= str_replace("'","`",$data[1]);
	if($name)	$s_name 	= explode(",",$name);
	if($s_name[1]){ $p_name = $s_name[1].' '.$s_name[0]; } else { $p_name = $s_name[0]; } 
	$p_id 	  				= $data[2];
	$p_address 	  			= str_replace("'","`",$data[4]);
	$p_address2 	  		= str_replace("'","`",$data[5]);
	$p_city 	  			= $data[6];
	$p_state 	  			= $data[7];
	$p_zip 	  				= $data[8];
	$p_county				= $data[10];
	$p_phone 	  			= $data[11];
	$p_dob 	  				= convertDateToMySQL($data[12]);
	$p_age 	  				= $data[13];
	$p_sex 	  				= $data[14];
	$center_name 	  		= $data[39];
	if($data[40]) $enroll_date  			= substr($data[40], 0, -4).'-'.substr($data[40], 4, -2).'-'.substr($data[40], 6); //20090501
							//yyyy-mm-dd
	$QueryPredata = "SELECT * FROM patients WHERE p_id='$p_id' ";
	if($db->query($QueryPredata) && $db->get_num_rows() > 0){
	$pre_data = $db->fetch_one_assoc(); 
	$ch = 0; $ch2 = 0;
	//observation of changes
	$r1 = strcmp(strtolower($status),strtolower($pre_data['status'])); if($r1!=0){ $ch = 1;  $ch2 = 1; } //Check Status
	$r2 = strcmp(strtolower($p_age),strtolower($pre_data['p_age'])); if($r2!=0){ $ch = 1; } //Check age
	$r3 = strcmp(strtolower($center_name),strtolower($pre_data['center_name'])); if($r3!=0){ $ch = 1; } //Check center name
	$r4 = strcmp(strtolower($enroll_date),strtolower($pre_data['enroll_date'])); if($r4!=0){ $ch = 1; } //Check enroll date
	$r5 = strcmp(strtolower($p_address),strtolower($pre_data['p_address'])); if($r5!=0){ $ch = 1; $ch2 = 1; } //Check address
	$Qstr = "UPDATE patients SET 
					status='$status',
					p_age='$p_age',
					center_name='$center_name',
					p_phone='$p_phone',
					";
	if($ch2 == 1){	$last_ch_date = date("Y-m-d");
		   $Qstr.= "p_address='$p_address',
					p_city='$p_city',
					p_state='$p_state',
					p_zip='$p_zip',
					p_county='$p_county',					
					p_pre_address='".$pre_data['p_address']."',
					p_pre_city='".$pre_data['p_city']."',
					p_pre_state='".$pre_data['p_state']."',
					p_pre_zip='".$pre_data['p_zip']."',
					p_pre_county='".$pre_data['p_county']."',
					last_changed_date='$last_ch_date',
					 ";}				
	$Qstr 		.= " enroll_date='$enroll_date'
				 	WHERE id = '".$pre_data['id']."' 
					";				
		if($ch == 1){ $db->execute($Qstr); }
		} else{
	$Query  = "INSERT INTO patients SET
					status='$status',
					p_name='$p_name',
					p_id='$p_id',
					p_address='$p_address',
					p_city='$p_city',
					p_state='$p_state',
					p_zip='$p_zip',
					p_county='$p_county',
					p_phone='$p_phone',
					p_dob='$p_dob',
					p_age='$p_age',
					p_sex='$p_sex',
					enroll_date='$enroll_date',
					center_name='$center_name'";
		  $db->execute($Query);
		}
	}
if((!empty($_FILES["file_csv"])) && ($_FILES['file_csv']['error'] == 0)) {
	$limitSize	= 150000000; //(150000 kb) - Maximum size of uploaded file, t
	$fileName	= basename($_FILES['file_csv']['name']);
	$fileSize	= $_FILES["file_csv"]["size"];
	$fileExt	= substr($fileName, strrpos($fileName, '.') + 1);
	if (($fileExt == "xlsx") && ($fileSize < $limitSize)) {
	$getWorksheetName = array();
		$xlsx = new SimpleXLSX( $_FILES['file_csv']['tmp_name'] );
		$getWorksheetName = $xlsx->getWorksheetName();
		$count = $xlsx->sheetsCount();
		for($j=1; $j<=$count; $j++){
			$sheetdata = $xlsx->rows($j);
			 for($k=2; $k<sizeof($sheetdata); $k++)
			 { print_r($sheetdata[$k] ); 
			 //gen_data($sheetdata[$k],$db);
			  } exit;
		}
		echo '<script>alert("File Uploaded Successfully");</script>';
				echo '<script>location.href="index.php";</script>';
				exit;
	}
	else{ echo "<script>alert('The Selected file is not supported!');</script>";
	      echo '<script>location.href="index.php";</script>'; exit; }
}
			$db->close();
			$pgname="add sheet"; 
			$smarty->assign("pgTitle",'Add Trips Sheet');
			$smarty->assign("pgname",$pgname);	
			$smarty->display('patientstpls/add_patients_xlsx.tpl'); 
/*
 Array ( [0] => current [1] => ADAMS, GERTRUDE R [2] => H5907001500 [3] => H5907001500 [4] => 2824 LIMESTONE CT [5] => [6] => MIDDLEBURG [7] => FL [8] => 320687734 [9] => 019 [10] => CLAY [11] => (904)215-8064 [12] => 4/13/1942 [13] => 71 [14] => F [15] => 01 [16] => 6/1/2013 [17] => [18] => [19] => [20] => Q3250001 [21] => MEDICARE HMO [22] => 0 [23] => 0 [24] => 0 [25] => 65 [26] => 2 [27] => N [28] => [29] => Y [30] => 861 [31] => 85921 [32] => 076/512 [33] => 78917 [34] => 6 [35] => MED [36] => MED [37] => CMTY [38] => Jacksonville [39] => KINGSLEY VILLAGE MEDICAL CENT 000105256 [40] => 20090501 [41] => [42] => [43] => 71 ) 
*/
?>