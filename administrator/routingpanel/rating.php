<?php
include_once("../Classes/MyMailer.php");
//Pick Up Rating
function puRating($tdid,$time,$drv_id,$status,$stinwords,$db,$db2,$t_comments,$startMilage=0){
   $db->connect();
   $db2->connect(); 
   $current_time=date("Y-m-d H:i:s");
  //If Status is In Progress 
   if($status == '5'){
      return false;
   }else{
   $tripStatus = $status;
       $aptime = $time;
  //Get Trip Time difference on the basis of pick time and actual pick time i.e. current time  
	  //$pt = getTripInfopt($tdid,$time,$db);
       $pt = getTripInfo($tdid,$time,'pck_time',$db); 
	   // debug($pt);
	   //$pt[0] for Hours
	   //$pt[1] for mints
	   //$pt[2] for Delay status if delayed flag is 1 otherwise flag is 0
		if(count($pt) > 0){
			if($pt[1] == 0 ){
			  $pickStatus = '1';		   
			}else{
			  $pickStatus = '2';		
			} 
		}
	   if($pickStatus == 1){ $rate = '5'; }
	   else{
        //Within 5mint delay		  
		if($pt[0] > 0 && $pt[0] < 300){
		   $rate='3';
        }else{
		   $rate='1';		
		}  
	   }
	//Update Trip Status
	$sQuery = "UPDATE ".TBL_TRIP_DET." 
				SET  status = '$tripStatus',
				aptime='$aptime',
				picked_time = '$current_time',
				startmilage='$startMilage',
				pickStatus = '$pickStatus',
				ac_noshowcancell = '$time'
				WHERE tdid = '$tdid'";
	if($db->execute($sQuery)){
	      $blasted = blastEmail($tdid,$stinwords,$db); //Email Admin about status Change
	           if($blasted){
	             //Check if rating is not done for specific Trip type & Trip
			      $Query1 = "SELECT  COUNT(*) AS rows FROM ".TBL_RATING." 
				             WHERE trp_id='$tdid' AND rtype='0'";  		    
						$result = $db2->executeScalar($Query1);
     		      if($result < 1){
						$rQuery = "INSERT INTO ".TBL_RATING." 
									SET  drv_id = '$drv_id', 
									drv_rating = '$rate', 
									rtype = '0',
									comments = '$t_comments',  
									trp_id = '$tdid'";
						 $res = $db2->execute($rQuery); 
		              }
		        //if Status is Not Going(8) or Not at Home(7) or Cancelled(3)			  
				  if($status == '3' || $status == '7' || $status == '8'){
				  	   //Check if rating is not done for specific Trip type & Trip
                        dropRating($tdid,$time,$drv_id,$status,$stinwords,$db,$db2,$t_comments,$endMilage=0);
				      }	  
					}
		         }
		return true;
	}
}
//Drop Rating
function dropRating($tdid,$time,$drv_id,$status,$stinwords,$db,$db2,$t_comments,$endMilage=0){
    $db->connect();
    $db2->connect();	
  //If Status is In Progress 
   if($status == '5'){
      return false;
   }else{
   $tripStatus = $status;
       $adtime = $time;
  //Get Trip Time difference on the basis of drop time and actual drop time i.e. current time  
	 // $dt = getTripInfodt($tdid,$time,$db);
      $dt = getTripInfo($tdid,$time,'drp_time',$db);	   
	   //debug($dt); 
	   //$dt[0] for Hours
	   //$dt[1] for mints
	   //$dt[2] for Delay status if delayed flag is 1 otherwise flag is 0
		if(count($dt) > 0){
			if($dt[1] == 0 ){
			  $dropStatus = '1';		   
			}else{
			  $dropStatus = '2';		
			} 
		}
	   if($dropStatus == 1){ $rate = '5'; }
	   else{
        //Within 5mint delay		  
		if($dt[0] > 0 && $dt[0] < 300){
		   $rate='3';
        }else{
		   $rate='1';		
		}  
	   }	
/**********************************************/
/*       COMPLETE TRIP EVALUATION
/*********************************************/  
	$xtradetail = '';
	//Get Final Status From Pick Status
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
		 default:
     	  {
		  $finalStatus = getPuTripInfo($tdid,$db);
		  if($finalStatus == '1' && $dropStatus == '1'){ $tripStatus = '4'; } //If Pick & Drop are Successful
		  //If Pick OR Drop any is Delayed
		  elseif($finalStatus == '1' && $dropStatus == '2'){ $tripStatus = '1'; }
		  elseif($finalStatus == '2' && $dropStatus == '1'){ $tripStatus = '1'; }
		  elseif($finalStatus == '2' && $dropStatus == '2'){ $tripStatus = '1'; }
		  else { $tripStatus = $status; } //If none of condition met it means, Trip is Pick trip status is not marked.
		  }
		  break;
	}	  
/**********************************************/
/*                   END
/*********************************************/  
	//Update Trip Status
	$sQuery = "UPDATE ".TBL_TRIP_DET." 
				SET  status = '$tripStatus',
				drp_atime   = '$adtime',
				endmilage   = '$endMilage',
				dropStatus  = '$dropStatus' $xtradetail
				WHERE tdid  = '$tdid'";
	if($db->execute($sQuery)){
	       if($status != '3' && $status != '2' ) {     
	             //Check if rating is not done for specific Trip type & Trip
			      $Query1 = "SELECT  COUNT(*) AS rows FROM ".TBL_RATING." 
				             WHERE trp_id='$tdid' AND rtype='1'";  		    
							 $result = $db2->executeScalar($Query1);
      		      if($result < 1){
						 $rQuery = "INSERT INTO ".TBL_RATING." 
									SET  drv_id = '$drv_id', 
									drv_rating = '$rate', 
									rtype = '1',
									comments = '$t_comments',  
									trp_id = '$tdid'";
						 $res = $db2->execute($rQuery);
		              }
		return true;					
		         }
            }
	}
}
//Trip Information Pick Time
function getTripInfo($tdid,$time,$field,$db){
    $db->connect();
     $cquery = "SELECT ".$field." FROM ".TBL_TRIP_DET." WHERE tdid = '$tdid'";	
    	if($db->query($cquery) && $db->get_num_rows() > 0){
				$data = $db->fetch_all_assoc();
			}
      $aptime = strtotime($time);
   $fieldtime = strtotime($data[0][$field]);
   if($fieldtime >= $aptime){
     $delay = '0';
   }else{
     $delay = '1';
   }
   $difference = $fieldtime - $aptime;
     //debug($data);		
   $timediff =  $difference.'^'.$delay;   	
	 // $picktime = timdiff($pcktime, $aptime);
	 //$picktime = get_time_difference($pcktime, $aptime);
        if($timediff == 'error'){
		   die('No time provided for difference');
		   }else{
		   $t = explode('^',$timediff);
           return $t;
		  }
}
//Get Trip Complete Information
function getTripCInfo($id,$db){	 
	$db->connect();
	 $Query = "SELECT td.trip_id, t.trip_user, t.trip_clinic,t.trip_clinicemail,t.trip_clinicowner, t.trip_tel, td.pck_add, td.drp_add, td.pck_time, 
	                  td.aptime, td.drp_time, td.drp_atime,td.trip_miles, td.drv_id, td.status, td.pickStatus, 
					  td.trip_remarks FROM trip_details td, trips t  
			   WHERE  t.trip_id=td.trip_id AND td.tdid='$id'";
		 if($db->query($Query) && $db->get_num_rows()){
				  $udata = $db->fetch_all_assoc();
				  }
                  return $udata;
}
//Blast Email Script
function blastEmail($tdid,$st,$db){
   //Get trip information
      $db->connect();
	  $tCinfo = getTripCInfo($tdid,$db);
	  //print_r($tCinfo);
	  $q = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($q) && $db->get_num_rows() > 0)
	{
	   $d = $db->fetch_all_assoc();
		$tos           = $d[0]['email'];
	}	
	  $qemail = "SELECT * FROM ".TBL_EMAIL;	
	if($db->query($qemail) && $db->get_num_rows() > 0)
	{
	   $emaildata = $db->fetch_all_assoc();
	}
      $mail = new MyMailer;
	  $from    = $emaildata[0]['email'];
	  //$email   = 'agent@hybridTracktrans.com';
	  $subject = 'Auto-Generated Trip Request Notification!';
	  //$to      = 'admin@hybridTracktrans.com';	
	  $to = $tos;	 
	  $body    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td width="63%"><a href="http://'.$emaildata[0]['url'].'"><img src="http://'.$emaildata[0]['url'].'/'.$emaildata[0]['image'].'" border="0" /></a></td>
					<td width="37%"><strong>
					<font color="#000000" size="1px" >'.$emaildata[0]['cname'].',<br />
        '.$emaildata[0]['address'].',<br />
		'.$emaildata[0]['city'].', '.$emaildata[0]['state'].', '.$emaildata[0]['zip'].'
        TEL:'.$emaildata[0]['phone'].'</font></strong></td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							Dear Admin,<br><br>
							Status for following trip has been changed to <b>'.$st.'</b> :<br>
							Clinic/Hospital : '.$tCinfo[0]['trip_clinic'].'<br>
							Consumer: '.$tCinfo[0]['trip_user'].'<br>
							Pick Address: '.$tCinfo[0]['pck_add'].'<br>
							Drop Address: '.$tCinfo[0]['drp_add'].'<br>
							Pick Time: '.$tCinfo[0]['pck_time'].'<br>
							Drop Time: '.$tCinfo[0]['drp_time'].'<br><br>
							Contact No.: '.$tCinfo[0]['trip_tel'].'<br><br>							
							<b>Note:</b> This is an Auto-generated Email notification. Kindly do not reply.</b>
							</td>
						  </tr>
				</table>';			
	if($st != 'Picked'){
	 $to1 = $tCinfo[0]['trip_clinicemail'];				
	  //$to1 = $tos;		  
	  $body1    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td width="63%"><a href="http://'.$emaildata[0]['url'].'"><img src="http://'.$emaildata[0]['url'].'/'.$emaildata[0]['image'].'" border="0" /></a></td>
					<td width="37%"><strong>
					<font color="#000000" size="1px" >'.$emaildata[0]['cname'].',<br />
        '.$emaildata[0]['address'].',<br />
		'.$emaildata[0]['city'].', '.$emaildata[0]['state'].', '.$emaildata[0]['zip'].'
        TEL:'.$emaildata[0]['phone'].'</font></strong></td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							Dear '.$tCinfo[0]['trip_clinicowner'].',<br><br>
							Status for following trip has been changed to <b>'.$st.'</b> :<br>
							Consumer: '.$tCinfo[0]['trip_user'].'<br>
							Pick Address: '.$tCinfo[0]['pck_add'].'<br>
							Drop Address: '.$tCinfo[0]['drp_add'].'<br>
							Pick Time: '.$tCinfo[0]['pck_time'].'<br>
							Drop Time: '.$tCinfo[0]['drp_time'].'<br><br>
							Contact No.: '.$tCinfo[0]['trip_tel'].'<br><br>							
							<b>Note:</b> This is an Auto-generated Email notification. Kindly do not reply.</b>
							</td>
						  </tr>
						</table>';							
		//$to1.'  <br/>'.$from.'<br/>'.$subject.'<br/>'.$body1; 
		 ///$sent1 = $mail->HtmlTxtMail($to1,$from,$subject,$body1); 
if($sent1) {}
	}					
//$sent = $mail->HtmlTxtMail($to,$from,$subject,$body);
	  # send e-mail
// return $sent;
return 1;
}
function getSheetId($tdid,$db){
    $db->connect();
    $Query = "SELECT t.sheet_id from trips t, trip_details td 
			  WHERE t.trip_id=td.trip_id AND td.tdid='$tdid'";
	 if($db->query($Query) && $db->get_num_rows()){
		  $udata1 = $db->fetch_all_assoc();
 	  }
	return $sheetid=$udata1[0]['sheet_id'];
}
//Trip Information
function getPuTripInfo($tdid,$db){
    $db->connect();
    $cquery = "SELECT pickStatus FROM ".TBL_TRIP_DET." WHERE tdid = '$tdid'";    
	$status = $db->executeScalar($cquery);	
	return $status;	 
}
?>