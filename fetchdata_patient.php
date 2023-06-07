<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
		if(isset($_POST['phnum']) || isset($_POST['pname'])) {
			$phnum = sql_replace($_POST['phnum']);
			$pname = sql_replace($_POST['pname']);		
			if($phnum != '' || $pname != '') {
		      $returnedData = '';
				if($_POST['phnum'] != ''){
				$Query = "SELECT f.* FROM ".TBL_FORMS." as f WHERE phnum='$phnum' ORDER BY id DESC LIMIT 1";
				if($db->query($Query) && $db->get_num_rows() > 0) { $Details = $db->fetch_all_assoc(); }
				$Query2 = "SELECT * FROM ".patient." WHERE phone='$phnum' ORDER BY id DESC LIMIT 1";
				if($db->query($Query2) && $db->get_num_rows() > 0) { $Details2 = $client_data = $db->fetch_all_assoc(); }   }
				
				if($_POST['pname'] != ''){
$Query = "SELECT f.* FROM ".TBL_FORMS." as f WHERE LTRIM(LOWER(clientname))='".strtolower(trim($pname))."' ORDER BY id DESC LIMIT 1";
		if($db->query($Query) && $db->get_num_rows() > 0) { $Details = $db->fetch_all_assoc(); }
		$Query2 = "SELECT * FROM ".patient." WHERE LTRIM(LOWER(name))='".strtolower(trim($pname))."' ORDER BY id DESC LIMIT 1";
				if($db->query($Query2) && $db->get_num_rows() > 0) { $Details2 = $client_data = $db->fetch_all_assoc(); }   }
				
	$Details2 = $Details;
				//$phyaddr = explode(",",$Details[0]['phyaddress']);
				//$ind = count($phyaddr);
				//$phyzip = trim($phyaddr[$ind-1]);
				//$phystate = trim($phyaddr[$ind-2]);
				//$phycity = trim($phyaddr[$ind-3]);
				//$phyaddress1 = array_slice($phyaddr,0,$ind-3);
				//$phyaddress = implode(",",$phyaddress1);
				/*$pickaddr = explode(",",$Details2[0]['pickaddr']);
				$pickzip = trim($pickaddr[4]);
				$pickstate = trim($pickaddr[3]);
				$pickcity = trim($pickaddr[2]);
				$pickaddress = trim($pickaddr[0]);convertDateToMySQL
				$pickroom = trim($pickaddr[1]);*/
				
				$pickaddr = $client_data[0]['address'];
				//$pickzip = trim($pickaddr[4]);
				//$pickstate = trim($pickaddr[3]);
				//$pickcity = trim($pickaddr[2]);
				$pickaddress =$pickaddr;
				$pickroom = trim($client_data[0]['roomsite']);
				
				$destaddr = explode(",",$Details2[0]['destination'],3);
				//$destzip = trim($destaddr[4]);
				//$deststate = trim($destaddr[3]);
				//$destcity = trim($destaddr[2]);
				$destaddress = trim($destaddr[0]).','.trim($destaddr[2]);
				$destroom = trim($destaddr[1]);
				$backaddr = explode(",",$Details[0]['backto'],3);
				//$backzip = trim($backaddr[4]);
				//$backstate = trim($backaddr[3]);
				//$backcity = trim($backaddr[2]);
				$backaddress = trim($backaddr[0]).','.trim($backaddr[2]);
				$backroom = trim($backaddr[1]);
				
				$b_addr = explode(",",$Details[0]['billing_address']);
				$indb = count($b_addr);
				$b_zip = trim($b_addr[$indb-1]);
				$b_state = trim($b_addr[$indb-2]);
				$b_city = trim($b_addr[$indb-3]);
				$b_address1 = array_slice($b_addr,0,$indb-3);
				$b_address = implode(",",$b_address1);
				
				
				$returnedData .= trim($client_data[0]['name']).'^'.$client_data[0]['phone'].'^'.$Details[0]['email'];
				$returnedData .= '^'.convertDateFromMySQL($client_data[0]['dob']).'^'.$client_data[0]['claim_no'];	
				$returnedData .= '^'.$Details2[0]['patient_weight'].'^'.$Details[0]['lname'].'^'.$Details[0]['clinic'];
				$returnedData .= '^'.date('a',strtotime($Details[0]['apptime'])).'^'.date('a',strtotime($Details[0]['org_apptime'])).'^'.date('a',strtotime($Details[0]['returnpickup']));
$returnedData .= '^'.$Details[0]['charges'].'^'.$Details[0]['phyphone'].'^'.$Details[0]['phyfax'].'^'.$Details[0]['reason'];
			/**/$returnedData .= '^'.$pickaddress.'^'.$pickcity.'^'.$pickstate.'^'.$pickzip;
/*$returnedData .= '^'.$Details2[0]['address'].'^'.$Details2[0]['city'].'^'.$Details2[0]['state'].'^'.$Details2[0]['zip'];*/			
				$returnedData .= '^'.$destaddress.'^'.$destcity.'^'.$deststate.'^'.$destzip;
				$returnedData .= '^'.$backaddress.'^'.$backcity.'^'.$backstate.'^'.$backzip;				
				$returnedData .= '^'.convertDateFromMySQL($Details[0]['appdate']);				
				$returnedData .= '^'.substr(date('h:i',strtotime($Details[0]['apptime'])),0,-3).'^'.date('h:i',strtotime($Details[0]['returnpickup']));
				$returnedData .= '^'.$Details[0]['casemanager'].'^'.$Details[0]['comments']; //new Data
				$returnedData .= '^'.$Details2[0]['insurance_name'].'^'.$Details2[0]['ssn'].'^'.$Details[0]['appt_type'];//34
				$returnedData .= '^'.$Details[0]['triptype'].'^'.$Details[0]['vehtype'].'^'.date('h:i',strtotime($Details[0]['org_apptime']));//37
				$returnedData .= '^'.date('h:i',strtotime($Details[0]['apptime'])).'^'.$Details2[0]['sex'].'^'.date('h:i',strtotime($Details[0]['org_apptime']));//40					
				$returnedData .= '^'.$Details2[0]['insurance'].'^'.$Details[0]['userid'];//41-42
				$returnedData .= '^'.$Details2[0]['pickup_instruction'].'^'.$Details2[0]['stretcher'].'^'.$Details2[0]['dstretcher'].'^'.$Details2[0]['bar_stretcher'].'^'.$Details2[0]['escort'].'^'.$Details2[0]['wchair'].'^'.$Details2[0]['dwchair'].'^'.$Details2[0]['oxygen'].'^'.$Details2[0]['picklocation'].'^'.$Details2[0]['droplocation'].'^'.$Details2[0]['backtolocation'].'^'.$Details2[0]['account'].'^'.$pickroom.'^'.$destroom.'^'.$backroom.'^--Automation--';//43-44-45-46-47-48-49-50-51-52-53-54-55-56-57
				echo $returnedData;	
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
		} else {
			echo 'There should be no direct access to this script!';
		}
?>