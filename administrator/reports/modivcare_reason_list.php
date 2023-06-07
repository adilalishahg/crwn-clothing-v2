<?php
   	include_once('../DBAccess/Database.inc.php');
    $db = new Database;	
    $yes = '0';
	$error = '';	
	$msgs .= $_GET['msg'];
	$db->connect();
	//Delete old values from the table
	$QDel="DELETE FROM reasons_codes WHERE 1=1 "; $db->execute($QDel);
	
			$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
	    	if($db->query($query) && $db->get_num_rows() > 0)
			{
			$udata = $db->fetch_one_assoc();
			}
			$provider_name=$udata['provider_name'];
			$hybrid_secret=$udata['hybrid_secret'];
			$url='https://api.nemtclouddispatch.com/reason_list/'.$provider_name;
			$data['event_url']=$webhook_url;
			$data['provider_name']=$provider_name;
			$data['hybrid_secret']=$hybrid_secret;
			$data['type']			='cancel';
			$data['ride_status']	='pending';
			$data['requester_type']	='dispatch';
		$curl = curl_init($url);
    	curl_setopt($curl, CURLOPT_POST, true); //true
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $json_response = curl_exec($curl);
		curl_close($curl);
		//print_r($json_response); exit;
		 $output_array=json_decode($json_response);
		 $array = json_decode(json_encode($output_array), true);
	
	foreach($array as $key=>$data1) {$Qinst="INSERT INTO reasons_codes SET code='".$key."',detail='".$data1."',`type`='cancel_pending_dispatch' ";
		$db->execute($Qinst);	    }
		
			$data['type']			='cancel';
			$data['ride_status']	='inProgress';
			$data['requester_type']	='dispatch';
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
	
	foreach($array as $key=>$data1) {$Qinst="INSERT INTO reasons_codes SET code='".$key."',detail='".$data1."',`type`='cancel_inProgress_dispatch' ";
		$db->execute($Qinst);	    }
		
			$data['type']			='reject';
			$data['ride_status']	='pending';
			$data['requester_type']	='dispatch';
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
	
	foreach($array as $key=>$data1) {$Qinst="INSERT INTO reasons_codes SET code='".$key."',detail='".$data1."',`type`='reject_pending_dispatch' ";
		$db->execute($Qinst);	    }
	
	//print_r($array);
	 exit;
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