<?php
/* *************************** *
	   * Created On : 30 Jan 2010
	   * File : attendance/timeout.php
	   * Abid Mehmood Malik
	   *************************** */

include_once('../DBAccess/Database.inc.php');

$db3 = new Database;	
$db3 ->connect();
if(isset($_POST['plist']))
{
   if($_POST['plist'] == '1'){
            $query ="SELECT * FROM ".TBL_DRIVERS.",".TBL_DRVTYPES." 
			WHERE ".TBL_DRIVERS.".
			drvtype=".TBL_DRVTYPES.".dtype_id  AND 
			".TBL_DRIVERS.".del='0' AND 
			drvstatus !='Suspended'";
	
	if($db3->query($query) && $db3->get_num_rows() > 0){
		$drivers = $db3->fetch_all_assoc();
	}
	
   $output = '<select name="emplist" id="emplist" class="required" onchange="verify();" style="width:200px;">
		   <option value="">-- Select --</option>';	
		   
	for($i=0; $i<count($drivers); $i++){
   $output .= '<option value="'.$drivers[$i]['Drvid'].'">'.$drivers[$i]['fname'].' '.$drivers[$i]['lname'].'</option>';	

	}
   $output .= '</select>';	

}else{
            $query ="SELECT * FROM ".TBL_STAFF." 
			WHERE ".TBL_STAFF.".del='0' AND drvstatus !='Suspended'";
	if($db3->query($query) && $db3->get_num_rows() > 0){
		$staff = $db3->fetch_all_assoc();
	 }  
	 
   $output = '<select name="emplist" id="emplist" class="required" onchange="verify();" style="width:200px;">
		   <option value="">-- Select --</option>';	
		   
	for($i=0; $i<count($staff); $i++){
   $output .= '<option value="'.$staff[$i]['Drvid'].'">'.$staff[$i]['fname'].' '.$staff[$i]['lname'].'</option>';	

	}
   $output .= '</select>';	
	  
  }	
  
  echo $output;
  
}
else
{
  echo 'invalid';
}

?>