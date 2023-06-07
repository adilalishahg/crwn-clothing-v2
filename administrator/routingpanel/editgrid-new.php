<?php
   	include_once('../DBAccess/Database.inc.php');
    include_once("../Classes/MyMailer.php");
	$db  = new Database;	
	$db2 = new Database;	
	$msgs   = '';
	$errors = '';
	$db->connect();
   $id = $_REQUEST['id'];
   $type = $_REQUEST['type'];
	 $time_data = get_server_time();
	 $datime = $time_data[0];	
	 $patime = $time_data[0];	
include_once('rating.php');
 //if page is submitted
if(count($_POST) > 0){
       if(isset($_POST['updgrid'])){//print_r($_POST); exit;
           $updated = updateTrip($_REQUEST,$id,$db,$db2);
		   $sid = getSheetId($id,$db);
	   $st  = sql_replace($_POST['status']);
		   if($updated){
		   		if($st == '6'){ $st = '5'; }
				echo "<script>alert('Trip Record has been successfully updated!');</script>";
			/*echo "<script>location.href='grid.php?st=".$st."&ad=0&id=".$sid."';</script>";*/	
			echo "<script>javascript:history.back();</script>";	
				exit;	
		   }
       }
     }
else{
	    $tripDetail = getTripInformation($id,$db);
	    //debug($tripDetail);
		$trip_id  = $tripDetail[0]['trip_id']; 
		$trip_code= $tripDetail[0]['trip_code']; 		
		$cname    = $tripDetail[0]['trip_user'];
		$clinic   = $tripDetail[0]['trip_clinic'];
		$phone    = $tripDetail[0]['trip_tel'];
		$addr1    = $tripDetail[0]['pck_add'];
		$ptime    = $tripDetail[0]['pck_time'];
		$aptime   = $tripDetail[0]['aptime'];
		$dtime    = $tripDetail[0]['drp_time'];
		$adtime   = $tripDetail[0]['drp_atime'];
		$m1       = $tripDetail[0]['trip_miles']; 
		$staff1   = $tripDetail[0]['drv_id'];
		$remarks  = $tripDetail[0]['trip_remarks'];
		$addr2    = $tripDetail[0]['drp_add'];
		$status   = $tripDetail[0]['status'];
		$st       = $tripDetail[0]['status'];
		$tdate       = $tripDetail[0]['date'];
	    $pickStatus = $tripDetail[0]['pickStatus'];
	    $dropStatus = $tripDetail[0]['dropStatus']; 
	    $wc         = $tripDetail[0]['wc']; 
		$account    = $tripDetail[0]['account']; 
		$picklocation         = $tripDetail[0]['picklocation']; 
		$droplocation         = $tripDetail[0]['droplocation']; 		
	   }
//Get Trip Information
function getTripInformation($id,$db){	 
	$db->connect();
	 $Query = "SELECT td.trip_id, td.date, t.trip_code, t.trip_user, t.trip_clinic,t.trip_clinicemail, t.trip_tel, td.pck_add, td.drp_add, td.pck_time, 
	                  td.aptime, td.drp_time, td.drp_atime,td.trip_miles, td.drv_id, td.status, td.pickStatus,td.wc,t.account,td.picklocation,td.droplocation, 
					  td.trip_remarks FROM trip_details td, trips t  
			   WHERE  t.trip_id=td.trip_id AND td.tdid='$id'";
		 if($db->query($Query) && $db->get_num_rows()){
				  $udata = $db->fetch_all_assoc();
				  }
                  return $udata;
}
function get_veh($drv)
{
	$db = new Database;	
	$db->connect();
	$dQuery = "SELECT Drvid
						FROM ".TBL_DRIVERS."
						WHERE drv_code = '$drv'";
	if($db->query($dQuery) && $db->get_num_rows() > 0)
	{
		$drvs =  $db->fetch_row_assoc(); 
	}
	 $drv_id = $drvs['Drvid'];
	$vQuery = "SELECT  veh_id
						FROM ".TBL_DVMAPPING."
						WHERE  drv_id = '$drv_id'";
	if($db->query($vQuery) && $db->get_num_rows() > 0)
	{
		$vehs =  $db->fetch_row_assoc(); 
	}
	return ($vehs['veh_id'] > 0) ? $vehs['veh_id'] : '0';        }

//Update Trip Information
function updateTrip($post,$id,$db,$db2){
	$db->connect();
		$prop    = 10;
	  $trip_code = sql_replace($post['trip_code']);
		$user    = sql_replace($post['consumer']);
		$clinic  = sql_replace($post['clinic']);
		$tel     = sql_replace($post['phone']);
		$addr1   = sql_replace($post['addr1']);
		$addr2   = sql_replace($post['addr2']);		
		$m1      = sql_replace($post['miles1']);
		$staff1  = sql_replace($post['staff1']);
		$vehicle = get_veh($post['staff1']);
		$remarks = sql_replace($post['remarks']);
		$t_comments = sql_replace($post['t_comments']);
		$status  = sql_replace($post['status']);
		$tdate  = sql_replace($post['tdate']);
		$drv_id  = sql_replace($post['staff1']);
        $tripid  = sql_replace($post['tripid']);
        $pck_wc  	 = sql_replace($post['pck_wc']);
        $wcall   = sql_replace($post['willcall']);
		
		$account   = sql_replace($post['account']);
		$picklocation   = sql_replace($post['picklocation']);
		$droplocation   = sql_replace($post['droplocation']);		
		$tdid = $id;
	   $time_data = get_server_time();		
	   $time = 	$time_data[0];
	   $qudrst = "UPDATE drivers SET trip_status = '$status',trip_assingment='1'  WHERE drv_code = '$drv_id'";
	$db->execute($qudrst);
		//---------------------- check for pick time ---------------------------------//
			if(isset($post['pu1']) && $post['pck_wc'] !='on'){
				$ptime=$post['pu1'].'';
				$pck_ptime = date("H:i:s", strtotime("-10 minutes".$ptime)); 
				$wc = '0';
				$totmiles = $m1;
					switch($totmiles){
						case ($totmiles <= 10) :
							$min = 20;
							break;
						case ($totmiles <= 15) :
							$min = 30;
							break;
						case ($totmiles <= 20) :
							$min = 40;
							break;
						case ($totmiles <= 25) :
							$min = 45;
							break;
						case ($totmiles <= 30) :
							$min = 50;
							break;
						case ($totmiles <= 35) :
							$min = 55;
							break;
						case ($totmiles <= 40) :
							$min = 60;
							break;
						case ($totmiles <= 45) :
							$min = 65;
							break;
						case ($totmiles <= 50) :
							$min = 70;
							break;
						case ($totmiles > 50) :
							$min = 120;
							break;
						default :
							$min = 0;
							break;		
					}
				$dtime 	= date("H:i:s", strtotime("+$min minutes".$ptime));
				$drp_ptime =  date("H:i:s", strtotime("-10 minutes".$dtime));
				
				
				
				
			}
			else
			{
				$ptime = '23:59';
				$pck_ptime = '00:00';
				$wc = '1';
			}
		//---------------------- check for drop time ---------------------------------//
			/*if(isset($post['dt1'])){
				$dtime= $post['dt1'].':00';
				$drp_ptime =  date("H:i:s", strtotime("-$prop minutes".$dtime));
				$wc = '0';
			}
			else{
				$dtime = '00:00:00';
				$drp_ptime = '00:00:00';
				$wc = '1';
			}*/
		//----------------------------------------------------------------------------------//
		$set = '';
		$type = $post['type'];
		  if($type == '1'){
			   if($aptime == '00:00:00' || $aptime == ''){
				 $aptime = $post['apu1'];
			   }
			   if($adtime == '00:00:00' || $adtime == '' ){
				 $adtime = $post['adt1'];	   
			   }
			   $set = ",aptime = '$aptime', drp_atime='$adtime'";
			   $status = '6';
		 }
    	//If Status is In Progress
	switch($post['status']){
	  //Cancelled
	  case '3':
	        if($wcall == '0'){
	          $rating = puRating($tdid,$time,$drv_id,3,'Cancelled',$db,$db2,$t_comments);
			}else{
			    blastEmail($tdid,'Cancelled',$db);
			}
			break;		
	  //Dropped		
	  case '4':
	        $rating = dropRating($id,$time,$drv_id,4,'Dropped',$db,$db2,$t_comments);		
			break;	 
      //Picked		
	  case '6':
	        $rating = puRating($id,$time,$drv_id,6,'Picked',$db,$db2,$t_comments);		
			break;	  
	  //Not at home		
	  case '7':	
        if($wcall == '0'){	    	  	  
	        $rating = puRating($id,$time,$drv_id,7,'Not at Home',$db,$db2,$t_comments);	
			}else{
			   blastEmail($tdid,'Not at Home',$db);
			}	
			break;
	  //Not Going		
	  case '8':
        if($wcall == '0'){	  
	        $rating = puRating($id,$time,$drv_id,8,'Not Going',$db,$db2,$t_comments);	
			}else{
			   blastEmail($tdid,'Not Going',$db);
			}	
			break;	
	} 
    //If Reschedule
	if($post['status'] == '2'){
	   $reschedule = ", status = '".$post['status']."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '' ";
	   //Delete Rescheduled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}
    //If Cancelled
	if($post['status'] == '3'){
	 $post['status']; 
	   $reschedule = ", status = '".$post['status']."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '' ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}
	   //If Not going
	if($post['status'] == '8'){
	   $reschedule = ", status = '".$post['status']."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '' ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	}  
	   //If Not at home
	if($post['status'] == '7'){
	   $reschedule = ", status = '".$post['status']."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '' ";
	   //Delete Cancelled Trip Rating
	   $qdel = "DELETE FROM ".TBL_RATING." WHERE trp_id='$id'";
	   $db->execute($qdel);
	} 	
   //If Will call & status is set
	if($wcall == '1'){
	  	if($post['status'] == '3' || $post['status'] == '7' || $post['status'] == '8' ){
	      $reschedule = ", status = '".$post['status']."', pickStatus = '0', dropStatus='0', aptime='', drp_atime = '' ";
	   }
	}    	
	  $query_u = "UPDATE ".TBL_TRIP_DET." SET 
					pck_add	   = '$addr1',
					drp_add    ='$addr2',
					pck_time   = '$ptime',
					pck_ptime  = '$pck_ptime',			
					drp_time   = '$dtime',				
					trip_miles = '$m1',
					picklocation = '$picklocation',
					droplocation = '$droplocation',
					drp_ptime  = '$drp_ptime',	
					trip_remarks = '$remarks',
					wc 		   = '$wc' $reschedule $set
					Where tdid = '$id'"; //drv_id	   = '$staff1',veh_id	   = '$vehicle',
	 $query_s = "UPDATE ".TBL_TRIPS." SET 
				   trip_code	= '$trip_code',
				   trip_user	= '$user',
				   trip_tel		= '$tel',
				   account		= '$account'				 
				   Where trip_id = '$tripid'";	//	
	if($db->execute($query_u) && $db->execute($query_s) ){	return true;
	      }				   
}
//GET DRIVERS LIST	
	 $getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0'";
 		 if($db->query($getDriver) && $db->get_num_rows())
			  {  $driverdata = $db->fetch_all_assoc(); }
	$getacc = "SELECT id,account_name FROM ".accounts." ORDER BY account_name ASC";
 		 if($db->query($getacc) && $db->get_num_rows())
			  {  $accounts = $db->fetch_all_assoc(); }		  

	$db->close();
    $pgTitle = "Admin Panel -- Edit Trip";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("id",$id);
    $smarty->assign("driverdata",$driverdata);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("sheetid",$sheetid);
	$smarty->assign("tripid",$trip_id);
	$smarty->assign("cname",$cname);
	$smarty->assign("trip_code",$trip_code);	
	$smarty->assign("clinic",$clinic);
	$smarty->assign("phone",$phone);
	$smarty->assign("addr1",$addr1);
	$smarty->assign("ptime",$ptime);
	$smarty->assign("dtime",$dtime);
	$smarty->assign("aptime",$aptime);
	$smarty->assign("adtime",$adtime);	
	$smarty->assign("m1",$m1);
	$smarty->assign("staff1",$staff1);
	$smarty->assign("remarks",$remarks);
	$smarty->assign("addr2",$addr2);
	$smarty->assign("sts",$status);
	$smarty->assign("st",$st);
	$smarty->assign("wc",$wc);	
    $smarty->assign("pickStatus",$pickStatus);
    $smarty->assign("dropStatus",$dropStatus);		
	$smarty->assign("qty",$qty);
	$smarty->assign("amt",$amt);				
	$smarty->assign("type",$type);
	$smarty->assign("tdate",$tdate);
	$smarty->assign("account",$account);
	$smarty->assign("picklocation",$picklocation);
	$smarty->assign("droplocation",$droplocation);
	$smarty->display('rpaneltpl/edit.tpl');
?>