<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
	$account_id = $_POST['account_id'];
	$location_id	= $_POST['location_id'];
    $Query = "SELECT officelocation FROM ".accounts." WHERE id ='$account_id' "; 
   if($db->query($Query) && $db->get_num_rows() > 0)
	{	   $data1 = $db->fetch_one_assoc();
	
	
	 $Query = "SELECT * FROM ".officelocations." WHERE id IN (".$data1['officelocation'].") "; 
   if($db->query($Query) && $db->get_num_rows() > 0)
	{	   $data = $db->fetch_all_assoc();
	
	//$str='<select   name="account" class="txt_box required" id="account" onchange="isprivate(this.value);" >';
	$str='';
	if($db->get_num_rows() > 1){$str.='<option value=""> --Select Office Location-- </option>';}
	for($i=0;$i<sizeof($data);$i++){ if($location_id==$data[$i]['id']){$selected='selected';}else{$selected='';}
		  $str.='<option value="'.$data[$i]['id'].'" '.$selected.' >'.$data[$i]['abrivation']. ' - '. $data[$i]['name'].'</option>'; 
                 } // $str.='</select>';
	print_r($str);
	 }
	}

?>