<?php
   	include_once('../DBAccess/Database.inc.php');
    $db = new Database;	
    $yes = '0';
	$error = '';	
	$msgs .= $_GET['msg'];
	$db->connect();
	if(isset($_GET['submit']))
	{  
		$stdate = sql_replace($_GET['startdate']);
		if($stdate!= '')
		{
			$stdate = convertDateToMySQL($stdate);
			
			$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
	    	if($db->query($query) && $db->get_num_rows() > 0)
			{
			$udata = $db->fetch_one_assoc();
			}
			$provider_name=$udata['provider_name'];
			$hybrid_secret=$udata['hybrid_secret'];
			
		 
			$url='https://api.nemtclouddispatch.com/get_list/'.$provider_name;
			$data['uat']='false';
			$data['provider_name']=$provider_name;
			$data['hybrid_secret']=$hybrid_secret;
			$data['scheduledDate']=$stdate;
			
		$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_POST, true); //true
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $json_response = curl_exec($curl);
		curl_close($curl);
		 $output_array=json_decode($json_response);
		 $array = json_decode(json_encode($output_array), true);
	// echo '<pre>';	print_r($array); exit;
		
		$tdQuery  = "SELECT * FROM ".TBL_TRIP_DET." WHERE date ='".$stdate."' AND modiv_detail_id !='' AND modiv_flage = '1' ";
			if($db->query($tdQuery) && $db->get_num_rows() > 0) 
			{	$trips = $db->fetch_all_assoc();		}
		
		}
	}
	//print_r($data);
	$db->close();
	$stdate = convertDateFromMySQL($stdate);
	$pgTitle = "Admin Panel -- ";
	$smarty->assign("errors",$error);	
	$smarty->assign("data",$array);
	$smarty->assign("trips",$trips);	
	$smarty ->assign("totalRows",$totalRows);
	$smarty->assign('stdate',$stdate);	
	$smarty->display('reportstpl/rep_modivcare_compare.tpl');
?>