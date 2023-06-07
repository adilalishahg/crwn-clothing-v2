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
function pickuptime($number){
	$total_seconds = (substr($number,0,2))*3600 + (substr($number,2,2))*60;
	if($total_seconds > 30*60){$total_seconds =($total_seconds-(30*60));}
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
function gen_data($data,$db,$dated,$account){ //$officelocation
			//  print_r($data); exit;
			  $pname 	  				= str_replace("'"," ",trim($data[2])).' '.str_replace("'"," ",trim($data[1]));
			  $dob 	  					= dateted_format(trim($data[3]));
			  $phnum					= phone_format(str_replace("-","",trim($data[5]))); 
			  $legid	 	  			= (trim($data[7]));
			  $appdate 	  				= dateted_format($data[8]); //convertDateToMySQL($dated);
			  $time						= sprintf("%04d", $data[10]);
			  $apptime 					= pickuptime($time);
			  $org_apptime  			= time_format($time);
			$akhry = substr($legid, -1);
			if($akhry=='B'){ 
			$apptime 					= time_format($time); $org_apptime ='--';
		//	if($apptime=='00:00' || $apptime=='00:00:00'){$apptime='Will Call';}
			
			}
			
			//  $apptime 					= time_format($time);
			//  $org_apptime  			= pickuptime($time);
			  $mile 	  				= trim($data[21]);
			  $cost 	  				= trim($data[22]);
			  $pickaddress  			= trim(str_replace("'"," ",$data[23])).',,'.trim(str_replace("'"," ",$data[24])).','.trim(str_replace("'"," ",$data[25])).','.trim(str_replace("'"," ",$data[26]));
			  $droplocation				= trim(str_replace(",","",$data[27]));
			  $dropaddress  			= trim(str_replace("'"," ",$data[28])).',,'.trim(str_replace("'"," ",$data[29])).','.trim(str_replace("'"," ",$data[30])).','.trim(str_replace("'"," ",$data[31])); 
			  $d_phnum					= phone_format(str_replace("-","",trim($data[32])));
			  $comments 	  			= trim($data[33]).' - '.trim($data[34]);   
		 	  $today_date 				=  dateted_format(trim($data[38])); 
			  
			   $vehicle_abbr 	  			= (trim($data[13])); 
	if($vehicle_abbr=='P'){$vehicle='Wheelchair';}
	if($vehicle_abbr=='C'){$vehicle='Ambulatory';} //Ambulatory
	if($vehicle_abbr=='ParaTran / WC Van'){$vehicle='Wheel Chair Van';}
		$vehtype  					= vehtype($vehicle,$db);
		// $data[10];
		// $vehtype  				= vehtype('Sedan',$db);
		//echo  exit;
		$pickup_instruction 	  	= 'LegID: '.$legid;//($data[9]);
		$destination_instruction 	= '';//($data[18]);
		$sex 	  					= '';//trim($data[27]);
		//$phnum						= trim($data[28]); 

	if($pname!=' '){
		$Q444="SELECT id FROM ".TBL_FORMS." WHERE legaid = '".$legid."' AND appdate = '".$appdate."' AND reqstatus != 'disapproved' 
												OR legbid = '".$legid."' AND appdate = '".$appdate."' AND reqstatus != 'disapproved' 
												OR legcid = '".$legid."' AND appdate = '".$appdate."'  AND reqstatus != 'disapproved' 
												OR legdid = '".$legid."' AND appdate = '".$appdate."' AND reqstatus != 'disapproved'  ";
if($db->query($Q444) && $db->get_num_rows() > 0){}else{
			
	//$tripnumber=generatetripnumber();tripnumber			='".$tripnumber."',
			//officelocation		='".$officelocation."',	cost='".$cost."',account_lable		='mmt',	
	   $Q3  = "INSERT INTO ".TBL_FORMS." SET 
	  					
	   					account				='".$account."',
						
						miles_string 		= '".$mile."',
						milage='".$mile."',
						
						triptype='One Way',	
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
						
						comments='".str_replace("'"," ",$comments)."'";// exit;
	 $db->execute($Q3);
	 // phone='".$phnum."' AND
	 $Qfind="SELECT name FROM patient WHERE  LTRIM(LOWER(name)) = '".strtolower(trim(sql_replace($pname)))."' ";
		if($db->query($Qfind) && $db->get_num_rows()>0){}else{
			$Qinsert="INSERT INTO patient SET 
					name			=	'".sql_replace($pname)."',
					
					dob				=	'$dob',
					address			=	'".$pickaddress."',
					phone			=	'$phnum'"; $db->execute($Qinsert);
			}
	       
}
		   }
}
	
if((!empty($_FILES["file_csv"])) && ($_FILES['file_csv']['error'] == 0)) {
	
	$limitSize	= 150000000; //(150000 kb) - Maximum size of uploaded file, t
	$fileName	= basename($_FILES['file_csv']['name']);
	$fileSize	= $_FILES["file_csv"]["size"];
		$dated		= $_POST['dated'];
	//$officelocation	= $_POST['officelocation'];
	$Qaccounts  = "SELECT id FROM " .  accounts ." WHERE TRIM(LOWER(REPLACE(account_name,' ','')))='MTM'";// AND officelocation='".$officelocation."'";
	if($db->query($Qaccounts) && $db->get_num_rows() > 0){	$accounts = $db->fetch_one_assoc();}
	$account=$accounts['id'];

	$fileExt	= substr($fileName, strrpos($fileName, '.') + 1);
	if (($fileExt == "xlsx") && ($fileSize < $limitSize)) {
	$getWorksheetName = array();
		$xlsx = new SimpleXLSX( $_FILES['file_csv']['tmp_name'] );
		$getWorksheetName = $xlsx->getWorksheetName();
		$count = $xlsx->sheetsCount();
		for($j=1; $j<=$count; $j++){ 
			$sheetdata = $xlsx->rows($j); //print_r($sheetdata); exit;
			 for($k=1; $k<sizeof($sheetdata); $k++)
			 { //print_r($sheetdata[$k] ); exit;
			  gen_data($sheetdata[$k],$db,$dated,$account);//$officelocation
			  } 
		}
		echo '<script>alert("Trip Sheet Uploaded Successfully");</script>'; // exit;
				echo '<script>javascript:history.back();</script>';
				exit;
	}
	else{ echo "<script>alert('The Selected file is not supported!');</script>";
	      echo '<script>javascript:history.back();</script>'; exit; }
}
			/*$Qlocs  = "SELECT * FROM ".  officelocations ." WHERE 1=1 ORDER BY location ASC " ;// id IN(".$_SESSION['admuser']['officelocation'].")
			if($db->query($Qlocs) && $db->get_num_rows() > 0){	$locs = $db->fetch_all_assoc();	 }	*/ 

			$db->close();
			$pgname="add sheet"; 
			$smarty->assign("pgTitle",'Add Trips Sheet');
			$smarty->assign("pgname",$pgname);	
			$smarty->assign("locs",$locs);	
			$smarty->display('mercytpl/mmt.tpl'); 
?>