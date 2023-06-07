<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
		if(isset($_POST['searchby'])) {
			$by 		= sql_replace($_POST['by']);
			$searchby 	= sql_replace($_POST['searchby']);		
			
			
						
			if($_POST['searchby'] != ''){
if($by=='name'){$whr=" AND  LTRIM(LOWER(f.clientname))='".strtolower(trim($searchby))."'";}else{
					$whr=" AND  f.phnum='".$searchby."'";}
$Query = "SELECT f.* FROM ".TBL_FORMS." as f WHERE account='".$_SESSION['userdata']['id']."' $whr ORDER BY id DESC LIMIT 1";

		if($db->query($Query) && $db->get_num_rows() > 0) { $Details = $db->fetch_one_assoc(); 
		if($Details['dob']!='0000-00-00'){	$Details['dob']=  convertDateFromMySQL($Details['dob']); } //$Details['dob']=  convertDateFromMySQL('1983-10-14');
		if($Details['appdate']!='0000-00-00'){$Details['appdate']	=  convertDateFromMySQL($Details['appdate']); }
			  $paddr=explode(',',$Details['pickaddr'],3);
			  $daddr=explode(',',$Details['destination'],3);
			  $backaddr=explode(',',$Details['backto'],3);
			  $daddr2=explode(',',$Details['three_address'],3);
			  $daddr3=explode(',',$Details['four_address'],3);
				  
			  $Details['pickaddress']			=	$paddr[0].','.$paddr[2];
			  $Details['psuiteroom']			=	$paddr[1];
			  $Details['destination']			=	$daddr[0].','.$daddr[2];
			  $Details['dsuiteroom']			=	$daddr[1];
			  $Details['destination2']			=	$daddr2[0].','.$daddr2[2];
			  $Details['dsuiteroom2']			=	$daddr2[1];
			  $Details['destination3']			=	$daddr3[0].','.$daddr3[2];
			  $Details['dsuiteroom3']			=	$daddr3[1];
			  $Details['backto']	  			=	$backaddr[0].','.$backaddr[2];
			  $Details['bsuiteroom']			=	$backaddr[1];
			  //	$Details['apptime2']			=	$Details['apptime'];
			  $Details['apptime']				=	date('h:i',strtotime($Details['apptime']));
			  $Details['apptimerad']			=	date('a',strtotime($Details['apptime']));
			  $Details['org_apptime']			=	date('h:i',strtotime($Details['org_apptime']));
			  $Details['org_apptimerad']		=	date('a',strtotime($Details['org_apptime']));
			  $Details['returnpickup']			=	date('h:i',strtotime($Details['returnpickup']));
			  $Details['returnpickuprad']		=	date('a',strtotime($Details['returnpickup']));
			  
			 
		
		  echo json_encode($Details); }
		/*$Query2 = "SELECT * FROM ".patient." WHERE LTRIM(LOWER(name))='".strtolower(trim($pname))."' ORDER BY id DESC LIMIT 1";
				if($db->query($Query) && $db->get_num_rows() > 0) { $Details2 = $db->fetch_all_assoc(); }  */ 
				}
				
			
			
		} else {
			echo 'There should be no direct access to this script!';
		}
?>