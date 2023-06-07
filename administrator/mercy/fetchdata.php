<?php
   	include_once('../DBAccess/Database.inc.php');

	$db = new Database;	

	$db->connect();



		// Is there a posted query string?

		if(isset($_POST['hid'])) {

				 

			//$clientname = sql_replace($_POST['clientname']);

			//$fone = sql_replace($_POST['fone']);	

			//$dateofbirth = sql_replace($_POST['dateofbirth']);

			$hid = sql_replace($_POST['hid']);	

			//$casemanager = sql_replace($_POST['casemanager']);

								

			if($hid != '') {

			

		      $returnedData = '';

		

		        if($_POST['id'] != '' && $_POST['id'] == '0'){

		

				$Query = "SELECT userid,reqid,".TBL_FORMS.".* FROM ".TBL_FORMS.", ".TBL_REQUESTS." 

				          WHERE cisid='$hid' AND reqid=req_id ORDER BY id DESC LIMIT 1";

                }			

                if($db->query($Query) && $db->get_num_rows() > 0)

	                 {

					 $Details = $db->fetch_all_assoc();     			

	         		 }

				$phyaddr = explode(",",$Details[0]['phyaddress']);

				$ind = count($phyaddr);

				$phyzip = $phyaddr[$ind-1];

				$phystate = $phyaddr[$ind-2];

				$phycity = $phyaddr[$ind-3];

				$phyaddress1 = array_slice($phyaddr,0,$ind-3);

				$phyaddress = implode(",",$phyaddress1);

				

				$pickaddr = explode(",",$Details[0]['pickaddr']);

				$indp = count($pickaddr);

				$pickzip = $pickaddr[$indp-1];

				$pickstate = $pickaddr[$indp-2];

				$pickcity = $pickaddr[$indp-3];

				$pickaddress1 = array_slice($pickaddr,0,$indp-3);

				$pickaddress = implode(",",$pickaddress1);

				

				$destaddr = explode(",",$Details[0]['destination']);

				$indd = count($destaddr);

				$destzip = $destaddr[$indd-1];

				$deststate = $destaddr[$indd-2];

				$destcity = $destaddr[$indd-3];

				$destaddress1 = array_slice($destaddr,0,$indd-3);

				$destaddress = implode(",",$destaddress1);

				

				$backaddr = explode(",",$Details[0]['backto']);

				$indb = count($backaddr);

				$backzip = $backaddr[$indb-1];

				$backstate = $backaddr[$indb-2];

				$backcity = $backaddr[$indb-3];

				$backaddress1 = array_slice($backaddr,0,$indb-3);

				$backaddress = implode(",",$backaddress1);

				/*

				$returnedData .= 'pickaddr='.$Details[0]['pickaddr'].'^destination='.$Details[0]['destination'];

				$returnedData .= '^backto='.$Details[0]['backto'].'^appdate='.$Details[0]['appdate'];				

				$returnedData .= '^apptime='.$Details[0]['apptime'].'^returnpickup='.$Details[0]['returnpickup'];

				$returnedData .= '^casemanager='.$Details[0]['casemanager'];								

				*/

				$returnedData .= $Details[0]['clientname'].'^'.$Details[0]['phnum'].'^'.$Details[0]['email'];

				$returnedData .= '^'.$Details[0]['dob'].'^'.$Details[0]['clientcasemanager'];	

				$returnedData .= '^'.$Details[0]['fname'].'^'.$Details[0]['lname'].'^'.$Details[0]['clinic'];

				$returnedData .= '^'.$phyaddress.'^'.$phycity.'^'.$phystate;

				$returnedData .= '^'.$phyzip.'^'.$Details[0]['phyphone'].'^'.$Details[0]['phyfax'].'^'.$Details[0]['reason'];

				$returnedData .= '^'.$pickaddress.'^'.$pickcity.'^'.$pickstate.'^'.$pickzip;

				$returnedData .= '^'.$destaddress.'^'.$destcity.'^'.$deststate.'^'.$destzip;

				$returnedData .= '^'.$backaddress.'^'.$backcity.'^'.$backstate.'^'.$backzip;				

				$returnedData .= '^'.$Details[0]['appdate'];				

				$returnedData .= '^'.substr($Details[0]['apptime'],0,-3).'^'.$Details[0]['returnpickup'];

				$returnedData .= '^'.$Details[0]['casemanager'].'^'.$Details[0]['comments'];
				
				$returnedData .= '^'.$Details[0]['triptype'].'^'.$Details[0]['vehtype'].'^'.$Details[0]['prog'];					

				echo $returnedData;	

				} else {

					echo 'ERROR: There was a problem with the query.';

				}

		} else {

			echo 'There should be no direct access to this script!';

		}



?>