<?php	

	$conn = mysql_connect("localhost", "midnimo_midnimo", "MiD123!");
	mysql_select_db("midnimo_midnimo");	
	 
	$sUser = @$_REQUEST["user"];
	$sReq  = @$_REQUEST["req"];
	
	$exp = explode(' ',$sReq);
	$code = $exp[0];
	$tripid = $exp[1];
	if(isset($exp[2]) && $exp[2] != ''){
		$time = $exp[2];
	}
	if ($sReq == NULL) 
    { 
        echo "Thank You for joining Midnimo Group."; 
        exit; 
    }
	$codearr = array('RES','CAN','DRP','PCK','NHO','NGO');
	if(!in_array($code,$codearr)){
		echo "Unknown Trip status. Reply with the three letter abbreviation."; 
        exit;
	}	
	function getTripInformation($id){		
		$getdrv ="SELECT date,drv_id FROM trip_details WHERE tdid='$id'";
		$tripdata = array();
		$tripdata1 = mysql_query($getdrv) or die("Couldn't execute query. ".mysql_error());
		$udata = mysql_fetch_array($tripdata1);		
        return $udata;
	}
	function getField($id,$field){		
		$getdrv ="SELECT $field FROM trip_details WHERE tdid='$id'";
		$tripdata = array();
		$tripdata1 = mysql_query($getdrv) or die("Couldn't execute query. ".mysql_error());
		$udata = mysql_fetch_array($tripdata1);		
        return $udata[$field];
	}
	function getRating($id){		
		$getdrv ="SELECT count(*) AS rows FROM rating WHERE trp_id='$id' AND rtype='0'";
		$tripdata = array();
		$tripdata1 = mysql_query($getdrv) or die("Couldn't execute query. ".mysql_error());
		$udata = mysql_fetch_array($tripdata1);		
        return $udata['rows'];
	}
	function getCurrent(){		
		$getdrv ="SELECT NOW() AS tym";
		$tripdata = array();
		$tripdata1 = mysql_query($getdrv) or die("Couldn't execute query. ".mysql_error());
		$udata = mysql_fetch_array($tripdata1);		
        return $udata['tym'];
	}
	function getDriverInformation($id){
		$getdrv ="SELECT cell_num FROM drivers WHERE Drvid='$id'";
		$tripdata = array();
		$tripdata1 = mysql_query($getdrv) or die("Couldn't execute query. ".mysql_error());
		$udata = mysql_fetch_array($tripdata1);		
        return $udata;
	}
	function getPuTripInfo($tdid){
		$getdrv = "SELECT pickStatus FROM trip_details WHERE tdid='$tdid'";
		$tripdata = array();
		$tripdata1 = mysql_query($getdrv) or die("Couldn't execute query. ".mysql_error());
		$udata = mysql_fetch_array($tripdata1);		
        return $udata['pickStatus'];
	}
	function puRating($tdid,$time,$drv_id,$status,$stinwords){
   		if($status == '5'){
      		return false;
   		}else{
   			$tripStatus = $status;
       		$aptime = $time;
       		$pt = getTripInfo($tdid,$time,'pck_time'); 
			if(count($pt) > 0){
				if($pt[1] == 0 ){
			  		$pickStatus = '1';		   
				}else{
			  		$pickStatus = '2';		
				} 
			}
			if($pickStatus == 1){ 
				$rate = '5';
			}else{
				if($pt[0] > 0 && $pt[0] < 300){
		   			$rate='3';
        		}else{
		   			$rate='1';		
				}  
	   		}
			mysql_query("UPDATE trip_details SET 
					status = '$tripStatus',
					aptime='$aptime',
					pickStatus = '$pickStatus'
					WHERE tdid = '$tdid'");		
	      	$blasted = blastEmail($tdid,$stinwords);
	        if($blasted){
				$result = getRating($tdid);
      		    if($result < 1){
					mysql_query("INSERT INTO rating SET 
					drv_id = '$drv_id', 
					drv_rating = '$rate', 
					rtype = '0' ,  
					trp_id = '$tdid'");
		        }
				if($status == '3' || $status == '7' || $status == '8'){
                	dropRating($tdid,$time,$drv_id,$status,$stinwords);
			    }	  
			}
			return true;
		}
	}
	function getTripInfo($tdid,$time,$field){
		$fieldtime = strtotime(getField($tdid,$field));	
      	$aptime = strtotime($time);
   		if($fieldtime >= $aptime){
     		$delay = '0';
   		}else{
     		$delay = '1';
   		}
   		$difference = $fieldtime - $aptime;
   		$timediff =  $difference.'^'.$delay;   	
        if($timediff == 'error'){
			die('No time provided for difference');
	    }else{
			$t = explode('^',$timediff);
           	return $t;
	  	}
	}
	function blastEmail($id,$status){
		return true;
	}
	function dropRating($tdid,$time,$drv_id,$status,$stinwords){
   		if($status == '5'){
      		return false;
   		}else{
   			$tripStatus = $status;
       		$adtime = $time;
      		$dt = getTripInfo($tdid,$time,'drp_time');	   
			if(count($dt) > 0){
				if($dt[1] == 0 ){
			  		$dropStatus = '1';		   
				}else{
			  		$dropStatus = '2';		
				} 
			}
	   		if($dropStatus == 1){
				$rate = '5';
			}else{
				if($dt[0] > 0 && $dt[0] < 300){
		   			$rate='3';
        		}else{
		   			$rate='1';		
				}  
	   		}	
			$xtradetail = '';
      		switch($status){
         		case '3': //Cancelled
		 			$tripStatus = $status;
		 			$dropStatus = '0';
		 			$xtradetail = ", pickStatus='0', aptime = '', drp_atime = '' ";
		 			break;
		 		case '7': //Not Going
		 			$tripStatus = $status;
		 			break;
				case '8': //Not at Home
		 			$tripStatus = $status;
		 			break;
				default: {
		  			$finalStatus = getPuTripInfo($tdid,$db);
					if($finalStatus == '1' && $dropStatus == '1'){ $tripStatus = '4'; } //If Pick & Drop are Successful
	  		  		elseif($finalStatus == '1' && $dropStatus == '2'){ $tripStatus = '1'; }
		  			elseif($finalStatus == '2' && $dropStatus == '1'){ $tripStatus = '1'; }
		  			elseif($finalStatus == '2' && $dropStatus == '2'){ $tripStatus = '1'; }
		  			else { $tripStatus = $status; } //If none of condition met it means, Trip is Pick trip status is not marked.
		  		}
		  			break;
			}
			mysql_query("UPDATE trip_details SET 
					status = '$tripStatus',
					drp_atime='$adtime',
					dropStatus = '$dropStatus' $xtradetail
					WHERE tdid = '$tdid'");	  
	    	if($status != '3' && $status != '2' ) {
				$result = getRating($tdid);     
      		    if($result < 1){
					mysql_query("INSERT INTO rating SET 
					drv_id = '$drv_id', 
					drv_rating = '$rate', 
					rtype = '1' ,  
					trp_id = '$tdid'");
              	}
				return true;					
	     	}
		}
	}
	function get_server_time(){
		$get = getCurrent();
		$xp = explode(' ',$get['tym']);
		$date = $xp[0];
		$time1 = explode(':',$xp[1]);
		$timehr=$time1[0]-2;
		if($time1[0] > 2){
			$timehr = $time1[0] - 2;
		}else{
			$timehr = 2 - $time1[0];
		}
		$timemin=$time1[1]+3;
		if($timemin>59){
			$diff = $timemin - 59;
			$timehr = $timehr +1;
			$timemin = $diff;
		}
		$timesec=$time1[2];
		$timet=$timehr.":".$timemin.":".$timesec;
		$t=explode(':',$timet);
		$thr=$t[0]+2;
		$tin=$t[1]-3;
		$tsec=$t[2];
		$tt=$thr.":".$tin.":".$tsec;
		$data = array($tt, $date);
		return $data;
	}
	$tripDetail = getTripInformation($tripid);
	if(empty($tripDetail)){
		echo "Unknown Trip ID. Reply with the one sent to you with trip details."; 
        exit;
	}
	$date = date('Y-m-d');
	if($date != $tripDetail['date']){
		echo "You are too late. Unable to update trip status."; 
        exit;
	}
	$drvDetail = getDriverInformation($tripDetail['drv_id']);
	/*if($sUser != $drvDetail['cell_num']){
		echo "You are not the concerned person to respond to it."; 
        exit;
	}*/	
	$time_data  = 	get_server_time();		
    $stime 		= 	$time_data[0];
	switch($code){
		case 'RES':
			$status = '2';
			mysql_query("DELETE FROM rating 
				WHERE trp_id = '$tripid'");
			break;
		case 'CAN':
			$status = '3';
			$rating = puRating($tripid,$stime,$tripDetail['drv_id'],3,'Cancelled');
			break;
		case 'DRP':
			$status = '4';
			$rating = dropRating($tripid,$stime,$tripDetail['drv_id'],4,'Dropped');
			break;
		case 'PCK':
			$status = '6';
			$rating = puRating($tripid,$stime,$tripDetail['drv_id'],6,'Picked');
			break;
		case 'NHO':
			$status = '7';
			$rating = puRating($tripid,$stime,$tripDetail['drv_id'],7,'Not at Home');
			break;
		case 'NGO':
			$status = '8';
			$rating = puRating($tripid,$stime,$tripDetail['drv_id'],8,'Not Going');
			break;
	}
	mysql_query("UPDATE trip_details SET 
				status = '$status'
				WHERE tdid = '$tripid'");
	if($status == '2'){
		if(isset($time)){
			$ptime=$time.':00';
			$pck_ptime = date("H:i:s", strtotime("-10 minutes".$ptime)); 
		}else{
			$ptime = '00:00:00';
			$pck_ptime = '00:00:00';
		}
		mysql_query("UPDATE trip_details SET 
				pck_time = '$ptime',
				pck_ptime = '$pck_ptime'
				WHERE tdid = '$tripid'");
	}
	{
		echo "Trip Request Updated. Thank You for your time."; 
    	exit;
	}
?>