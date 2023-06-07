<?php
/* *************************** *
	   * Created On : 30 Jan 2010
	   * File : attendance/timeout.php
	   *************************** */

include_once('../DBAccess/Database.inc.php');

$db3 = new Database;	
$db3 ->connect();

	//Get Server Time
	 $curtime_data = get_server_time();
	 $curdate = $curtime_data[1]; //Time
	 $curtime = $curtime_data[0]; //Time
	 
	 $ttrim = explode(':',$curtime);
	 $sdate = explode('-',$curdate); 



if(isset($_POST['id']) && $_POST['id'] != '')
{
   $date = $sdate[0].'-'.$sdate[1].'-'.$_POST['dte'];
   $id = $_POST['id'];
	
	if($_POST['wc'] == 'weekly'){
	  $query ="SELECT Date_format(date,'%W') as day, time_format(TimeDiff(time_out,time_in), '%H') as hrs ,time_format(TimeDiff(time_out,time_in), '%i') as mints FROM ".TBL_ATNDS." WHERE drv_id='$id' AND date BETWEEN '".$date."' AND DATE_ADD('".$date."', INTERVAL 8 DAY)";
	}
	if($_POST['wc'] == 'bi-weekly'){
	  $query ="SELECT Date_format(date,'%W') as day, time_format(TimeDiff(time_out,time_in), '%H') as hrs ,time_format(TimeDiff(time_out,time_in), '%i') as mints FROM ".TBL_ATNDS." WHERE drv_id='$id' AND  date BETWEEN '".$date."' AND DATE_ADD('".$date."', INTERVAL 16 DAY)";
	}
	if($_POST['wc'] == 'monthly'){
	  $query ="SELECT Date_format(date,'%W') as day, time_format(TimeDiff(time_out,time_in), '%H') as hrs ,time_format(TimeDiff(time_out,time_in), '%i') as mints  FROM ".TBL_ATNDS." WHERE  drv_id='$id' AND date BETWEEN '".$date."' AND DATE_ADD('".$date."', INTERVAL 34 DAY)";
	}	

	if($db3->query($query) && $db3->get_num_rows() > 0){
		$chk = $db3->fetch_all_assoc();
	 }


   $totalhrs = 0;

    if(count($chk) > 0){  
        for($i=0; $i < count($chk); $i++){
          $val .=  '<table width="90%" border="0" cellspacing="0" cellpadding="0"><tr>
                      <td width="50%" class="tbl_row_height">'.$chk[$i]['day'].'</td>
                      <td width="50%" style="padding-left:15px; border-bottom:1px solid #e4e4e4; border-right:1px solid #e4e4e4;">'.$chk[$i]['hrs'].' Hrs</td>
                    </tr></table>';
					
			$totalhrs = $totalhrs + $chk[$i]['hrs'];
         }

			$val = $val.'^'.$totalhrs;	


	  }else{
          $val .=  '<table width="90%" border="0" cellspacing="0" cellpadding="0"><tr>
                      <td colspan="2" class="tbl_row_height">No Record Found</td>
                    </tr></table>'.'^0'; 
	  }	 
		 echo $val; 
		 
}
else
{
  echo 'invalid';
}

?>