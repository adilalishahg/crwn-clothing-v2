<?php
   	include_once('../DBAccess/Database.inc.php');
	include_once('../Classes/MyMailer.php');
	include_once('../../Classes/mapquest_google_miles.class.php');	
	$mile_C = new mapquest_google_miles;
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db = new Database;	
	$mail = new MyMailer;
	$db->connect();
    //GET VEHICLE PREFERRENCE
  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;
	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){
		$vehiclepref = $db->fetch_all_assoc();
	 }
$hospitalsq = "SELECT * FROM ".TBL_HOSPITALS." ORDER BY hospname ASC "; 
	if($db->query($hospitalsq) && $db->get_num_rows() > 0){
           $hospitals= $db->fetch_all_assoc();  
	}
//GET STATES LIST
    $gstat = "SELECT * FROM ".TBL_STATES;
		if($db->query($gstat) && $db->get_num_rows() > 0)
		 {
		   $slist = $db->fetch_all_assoc();		 
		 }
//GET App types
$gappt="SELECT * FROM ".appointment_type; if($db->query($gappt) && $db->get_num_rows() >0){$appdata = $db->fetch_all_assoc();}		 
	$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
	if($db->query($query) && $db->get_num_rows() > 0){
			$udata = $db->fetch_all_assoc();
	}
    $unload_add = $udata[0]['address'].",".$udata[0]['state'].",".$udata[0]['city'].",".$udata[0]['zip']; //for all other 
      if(isset($_POST['submit'])){
			 $hostpital_id=$_POST['hostpital_id'];
		  	$Queryp = "SELECT prog_type,hospname FROM hospitals WHERE id='$hostpital_id' "; 
			if($db->query($Queryp) && $db->get_num_rows() > 0)          
			{$Detailsp = $db->fetch_all_assoc(); }	  
	  $progtype      = $Detailsp[0]['prog_type'];//program type of hospital
	  $hosname      = $Detailsp[0]['hospname'];//program type of hospital
	  
     $post = $_POST;
		$account		=	$_POST['account'];
		$cisid 			= sql_replace($_POST['cisid']); 	//if(empty($cisid))$errors .= 'Identification Number is required!';
		$insurance_name	= sql_replace($_POST['insurance_name']);
		$pname 			= sql_replace($_POST['pname']);		//if(empty($pname))$errors .= 'Patient Name is required!';
		$phnum 			= sql_replace($_POST['phnum']);		//if(empty($phnum))$errors .= 'Patient Phone Number is required!';
		$ssn 			= sql_replace($_POST['ssn']);
		$dob 			= sql_replace($_POST['dob']);		
		$todaydate 		= sql_replace($_POST['todaydate']);
		$apptype	 	= sql_replace($_POST['type']);
		$fname 			= sql_replace($_POST['fname']);
		$lname 			= sql_replace($_POST['lname']);
		$clinic 		= sql_replace($_POST['clinic']);
		$phyaddress 	= sql_replace($_POST['phyaddress']);
		$phycity 		= sql_replace($_POST['phycity']);
		$phystate 		= sql_replace($_POST['phystate']);
		$phyzip 		= sql_replace($_POST['phyzip']);
		$phyphone 		= sql_replace($_POST['phyphone']);
		$phyfax 		= sql_replace($_POST['phyfax']);
		$reason 		= sql_replace($_POST['reason']);
		$triptype 		= sql_replace($_POST['triptype']); 		//if(empty($triptype))$errors .= 'Trip type is required!';
		$vehtype 		= sql_replace($_POST['vehtype']);		//if(empty($vehtype))$errors .= 'Vehicle is required!';
		$casemanager1 	= sql_replace($_POST['casemanager1']);//if(empty($casemanager1))$errors .= 'Case Manager is required!';
		$appdate 		= sql_replace($_POST['appdate']);		//if(empty($appdate))$errors .= 'Appoimnet Date is required!';
		$org_apptime	= sql_replace($_POST['org_apptime']);
		$apptime 		= sql_replace($_POST['apptime']);
		$puchoice 		= sql_replace($_POST['puchoice']);
		$returnpickup 	= sql_replace($_POST['returnpickup']); //return pickup time
		if($puchoice == 'Will Call'){ $returnpickup = 'Will Call'; }
		$driver 		= sql_replace($_POST['driver']);
		$sex			= sql_replace($_POST['sex']);
		$childseat		= sql_replace($_POST['childseat']);
		$escort			= sql_replace($_POST['escort']);
		$wchair			= sql_replace($_POST['wchair']);
		$stretcher		= sql_replace($_POST['stretcher']);
		$dstretcher		= sql_replace($_POST['dstretcher']);
		$oxygen			= sql_replace($_POST['oxygen']);
		$status			= sql_replace($_POST['status']);
		
	$pickadd 			= str_replace(',','',sql_replace($_POST['pickaddress'])).', '.str_replace(',','',sql_replace($_POST['pckcity'])).', '.str_replace(',','',sql_replace($_POST['pckstate'])).', '.str_replace(',','',sql_replace($_POST['pckzip']));
	$destination_one= str_replace(',','',sql_replace($_POST['destination'])).', '.str_replace(',','',sql_replace($_POST['drpcity'])).', '.str_replace(',','',sql_replace($_POST['drpstate'])).', '.str_replace(',','',sql_replace($_POST['drpzip'])); 
	$destination_two= str_replace(',','',sql_replace($_POST['three_address'])).', '.str_replace(',','',sql_replace($_POST['three_city'])).', '.str_replace(',','',sql_replace($_POST['three_state'])).','.str_replace(',','',sql_replace($_POST['three_zip']));
	$destination_three= str_replace(',','',sql_replace($_POST['four_address'])).', '.str_replace(',','',sql_replace($_POST['four_city'])).', '.str_replace(',','',sql_replace($_POST['four_state'])).', '.str_replace(',','',sql_replace($_POST['four_zip']));
	$destination_four= str_replace(',','',sql_replace($_POST['five_address'])).', '.str_replace(',','',sql_replace($_POST['five_city'])).', '.str_replace(',','',sql_replace($_POST['five_state'])).', '.str_replace(',','',sql_replace($_POST['five_zip']));
	$destination_last= str_replace(',','',sql_replace($_POST['backto'])).', '.str_replace(',','',sql_replace($_POST['backtocity'])).', '.str_replace(',','',sql_replace($_POST['backtostate'])).', '.str_replace(',','',sql_replace($_POST['backtozip']));
		
	$three_pickup = sql_replace($_POST['three_pickup']);
	$three_will_call = sql_replace($_POST['three_will_call']);
	$four_pickup = sql_replace($_POST['four_pickup']);
	$four_will_call = sql_replace($_POST['four_will_call']);
	$five_pickup = sql_replace($_POST['five_pickup']);	
	$five_will_call = sql_replace($_POST['five_will_call']);
	$comments		= sql_replace($_POST['comments']);
	//reoccurence trips information
		$day 			= sql_replace($_POST['day']);
		$reocc_appicktime = sql_replace($_POST['reocc_appicktime']);
		$reocc_repicktime = sql_replace($_POST['reocc_repicktime']);
		$till_date 		= sql_replace($_POST['till_date']);
	
		$q = "SELECT * FROM ".TBL_CONTACT;
		if($db->query($q) && $db->get_num_rows() > 0)
		{ $d = $db->fetch_all_assoc();
		$tos = $d[0]['email'];
		$unload_add = $d[0]['address'].", ".$d[0]['city'].", ".$d[0]['state'].", ".$d[0]['zip'];
		}
		
	//Miles Calculation
	//Un loaded miles it will be added into system if a company allow them
	$unloadedmiles = round($mile_C->distance($pickadd,$unload_add),2);
	//End of unloaded miles charges 
	if($triptype == 'One Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$miles_string = $milesAB;
		$miles 		= $milesAB;
		$base = 1;
		}
	if($triptype == 'Round Trip') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBF = round($mile_C->distance($destination_one,$destination_last),2);
		$miles_string = $milesAB.','.$milesBF;
		$miles 		= $milesAB + $milesBF;
		$base = 1; 
		}
	if($triptype == 'Three Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination_two),2);
		$milesCF = round($mile_C->distance($destination_two,$destination_last),2);
		$miles_string = $milesAB.','.$milesBC.','.$milesCF;
		$miles 	  = $milesAB + $milesBC + $milesCF; 
		$base = 2;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		}
	if($triptype == 'Four Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination_two),2);
		$milesCD = round($mile_C->distance($destination_two,$destination_three),2);
		$milesDF = round($mile_C->distance($destination_three,$destination_last),2);
		$miles_string = $milesAB.','.$milesBC.','.$milesCD.','.$milesDF;
		$miles	= $milesAB + $milesBC + $milesCD + $milesDF; 
		$base = 3;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; }
		}	
	if($triptype == 'Five Way') {
		$milesAB = round($mile_C->distance($pickadd,$destination_one),2);
		$milesBC = round($mile_C->distance($destination_one,$destination_two),2);
		$milesCD = round($mile_C->distance($destination_two,$destination_three),2);
		$milesDE = round($mile_C->distance($destination_three,$destination_four),2);
		$milesEF = round($mile_C->distance($destination_four,$destination_last),2);
		$miles_string = $milesAB.','.$milesBC.','.$milesCD.','.$milesDE.','.$milesEF;
		$miles = $milesAB + $milesBC + $milesCD + $milesDE + $milesEF; 
		$base = 4;
		$three_pickup 	= sql_replace($_POST['three_pickup']);
		if($three_will_call == 'on'){ $three_pickup = 'Will Call'; }
		$four_pickup 	= sql_replace($_POST['four_pickup']);
		if($four_will_call == 'on'){ $four_pickup = 'Will Call'; }
		$five_pickup 	= sql_replace($_POST['five_pickup']);
		if($five_will_call == 'on'){ $five_pickup = 'Will Call'; }
		}			
	
	//End of miles calculation
	//Amount calculation
	$miles = ($miles + $unloadedmiles);
		if(isset($vehtype) && $vehtype != ''){
			$contype = "SELECT * FROM ".TBL_VEHTYPES." Where id='".$vehtype."'";
			if($db->query($contype) && $db->get_num_rows() > 0){
			   $ttype = $db->fetch_all_assoc();
			}
			$totchargesamb = ($ttype[0]['bcharges'] * $base) + ($miles * $ttype[0]['mcharges']);
			}
			$totcharges = $totchargesamb;
	//end of amount calculation
	
	  //INSERT INTO REQUEST TABLE	   
	 $Query1  = "INSERT INTO ".TBL_REQUESTS." SET 
					userid='".$hostpital_id."',
					hospname='".$hosname."',
					reqdate=NOW(),
					sessionn_id='".session_id()."',
					req_status='active'";
		  if($db->execute($Query1))
		    {
	          $req_id = $db->insert_id(); 
	         
	         }
	          if(isset($req_id) && $req_id > 0){  
              //if($triptype == 'Round Trip') { $triptype = 'RW'; }else{ $triptype = 'OW'; }	  
	   //INSERT INTO FORM TABLE
        $Query2  = "INSERT INTO ".TBL_FORMS." SET 
					prog='".$progtype."',
					account='".$account."',
					unloadedmilage='".$unloadedmiles."',
					miles_string = '".$miles_string."',
					milage='".$miles."',
					charges	= '".$totcharges."',	
					triptype='".$triptype."',	
					vehtype='".$vehtype."',	
					appt_type='".$apptype."',					
					ssn='".$ssn."',
					req_id='".$req_id."',
					pickaddr='".$pickadd."',
					destination='".$destination_one."',
					three_address='".$destination_two."',
					four_address='".$destination_three."',
					five_address='".$destination_four."',
					three_pickup 	= '".$three_pickup."',
					four_pickup 	= '".$four_pickup."',
					five_pickup 	= '".$five_pickup."',
					backto='".$destination_last."',
					appdate='".$appdate."',
                    org_apptime='".$org_apptime."',
					apptime='".$apptime."',
					returnpickup='".$returnpickup."',
					casemanager='".$casemanager1."',
					today_date=NOW(),
					clientname='".$pname."',
                    phnum='".$phnum."',
					dob='".$dob."',
					email='',
					clientcasemanager='".$casemanager2."',
					cisid='".$cisid."',
					insurance_name='".$insurance_name."',
					driver='".$driver."',
					sex='".$sex."',
					childseat='".$childseat."',
					escort='".$escort."',
					wchair='".$wchair."',
					stretcher='".$stretcher."',
					dstretcher='".$dstretcher."',
					oxygen='".$oxygen."',
					status='".$status."',
					comments='".$comments."'";
		  if($db->execute($Query2))
		    {
			
			//reoccurence trips
			//Start For Monday
if(($_POST['monday']=='on')&&(!empty($_POST['tdmonday']))&&(!empty($_POST['aptmonday']))&&(!empty($_POST['retmonday']))) {
			$day 			= sql_replace($_POST['mon']);
			$till_date 		= sql_replace($_POST['tdmonday']); 
			$apptimeR 		= sql_replace($_POST['aptmonday']); 
			$returnpickupR 	= sql_replace($_POST['retmonday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$progtype, $unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account);
			 } //End for Monday
			 //Start For tuseday
if(($_POST['tuseday']=='on')&&(!empty($_POST['tdtuseday']))&&(!empty($_POST['apttuseday']))&&(!empty($_POST['rettuseday']))) {
			$day 			= sql_replace($_POST['tus']);
			$till_date 		= sql_replace($_POST['tdtuseday']); 
			$apptimeR 		= sql_replace($_POST['apttuseday']); 
			$returnpickupR 	= sql_replace($_POST['rettuseday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$progtype, $unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account);
			 } //End for tuseday
			 //Start For wednesday
if(($_POST['wednesday']=='on')&&(!empty($_POST['tdwednesday']))&&(!empty($_POST['aptwednesday']))&&(!empty($_POST['retwednesday']))) {
			$day 			= sql_replace($_POST['wed']);
			$till_date 		= sql_replace($_POST['tdwednesday']); 
			$apptimeR 		= sql_replace($_POST['aptwednesday']); 
			$returnpickupR 	= sql_replace($_POST['retwednesday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$progtype, $unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account);
			 } //End for wednesday
			 //Start For thursday
if(($_POST['thirsday']=='on')&&(!empty($_POST['tdthirsday']))&&(!empty($_POST['aptthirsday']))&&(!empty($_POST['retthirsday']))) {
			$day 			= sql_replace($_POST['thi']);
			$till_date 		= sql_replace($_POST['tdthirsday']); 
			$apptimeR 		= sql_replace($_POST['aptthirsday']); 
			$returnpickupR 	= sql_replace($_POST['retthirsday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$progtype, $unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account);
			 } //End for thursday
			 //Start For friday
if(($_POST['friday']=='on')&&(!empty($_POST['tdfriday']))&&(!empty($_POST['aptfriday']))&&(!empty($_POST['retfriday']))) {
			$day 			= sql_replace($_POST['fri']);
			$till_date 		= sql_replace($_POST['tdfriday']); 
			$apptimeR 		= sql_replace($_POST['aptfriday']); 
			$returnpickupR 	= sql_replace($_POST['retfriday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$progtype, $unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account);
			 } //End for friday
			 //Start For saturday
if(($_POST['saturday']=='on')&&(!empty($_POST['tdsaturday']))&&(!empty($_POST['aptsaturday']))&&(!empty($_POST['retsaturday']))) {
			$day 			= sql_replace($_POST['sat']);
			$till_date 		= sql_replace($_POST['tdsaturday']); 
			$apptimeR 		= sql_replace($_POST['aptsaturday']); 
			$returnpickupR 	= sql_replace($_POST['retsaturday']); //print_r($_POST); exit;
 //INSERTING REOCCURING TRIPS
				rectrips($day,$till_date,$apptimeR,$returnpickupR,$progtype, $unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account);
			 } //End for saturday
			 //END OF REOCCURING TRIPS
				
				
	/*		$form_id = $db->insert_id(); 
	         }	   
	   //END
              $q = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($q) && $db->get_num_rows() > 0)
	{
	   $d = $db->fetch_all_assoc();
	$tos           = $d[0]['email'];
	}*/
 /*$from = 'requests@xcv.com';
			   $email = $tos;
			   $subject = 'New '.$totRequests.' Trip Request';
			   $body = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td width="63%"><a href="http://www.xcv.com"><img src="http://www.xcv.com/images/logo.png" border="0" /></a></td>
							<td width="37%"><strong>
						<font color="#000000" size="1px" >xcv TRANSPORTATION 4040 E,<br />
        Mc DOWELL ROAD, SUITE# 102, <br />
        PHOENIX, AZ, 85008 <br />
        TEL:(602)273-7000</font></strong></td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							Dear Admin,<br>
				A new Request is submitted by Mercy Care Clinic.<br/>
							<a href="http://www.xcv.com/administrator/requests/reqdetails.php?req='.$_SESSION['userid'].'"> Click here</a> to further process the requests.
							</td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							 <b>Thank you! <br> xcv Team!</b>
							</td>
						  </tr>
						</table>';*/
                      // $sent = mail($email,$subject,$body,$headers);	
			  //$sent = $mail->HtmlTxtMail($email,$from,$subject,$body);
			   $sent = 1;		   
				 if(1){
				   $msg = ' You have Successfully Submitted the Request.';
			}   
         }
       }
	  } 
	  //functions to insert data of reoccurence trips
	function numWeekdays( $start_ts, $end_ts, $day, $include_start_end = false) {  //Count the number of days with dates.    
	   $day = strtolower( $day );    
	    $current_ts = $start_ts;    
	    // loop next $day until timestamp past $end_ts    
	    while( $current_ts < $end_ts ) {          
			if( ( $current_ts = strtotime( 'next '.$day, $current_ts ) ) < $end_ts) {             
			$dt= date('Y-m-d',$current_ts);   $days++;   }   
			 }         		      
		     // include start/end days    
		 if ( $include_start_end ) {         
		     if ( strtolower( date( 'l', $start_ts ) ) == $day ) {             
			    $days++;         }         
			 if ( strtolower( date( 'l', $end_ts ) ) == $day ) {             $days++;         }     
		 }         
	   return (int)$days;  } //END OF Count the number of days with dates.		
	   function Weekdays( $start_ts, $end_ts, $day, $include_start_end = true) {      
	   $day = strtolower( $day );    
	    $current_ts = $start_ts;    
	    // loop next $day until timestamp past $end_ts  
		  $i=0;
	    while( $current_ts < $end_ts ) {          
			if( ( $current_ts = strtotime( 'next '.$day, $current_ts ) ) < $end_ts) {             
		$dt[$i]= date('Y-m-d',$current_ts);   $days++; $i++;      }     
 				}      // include start/end days    
		 if ( $include_start_end ) {         
		     if ( strtolower( date( 'l', $start_ts ) ) == $day ) { 
			 $dt[$i]= date('Y-m-d',$current_ts);            
			    $days++;         }         
			 if ( strtolower( date( 'l', $end_ts ) ) == $day ) {      
			 $dt[$i]= date('Y-m-d',$current_ts);
			        $days++;         }     
		 }         
	   return $dt;  }  //END OF FUNCTION NUMBER OF DAYS	
	   function rectrips($day,$till_date,$apptime,$returnpickup,$progtype,$unloadedmiles,$miles_string,$miles,$totcharges,$triptype,$vehtype,$ssn,$req_id,$pickadd,$destination_one,$destination_two,$destination_three,$destination_four,$three_pickup,$four_pickup,$five_pickup,$destination_last,$appdate,$casemanager1,$pname,$dob,$casemanager2,$cisid,$driver,$sex,$childseat,$escort,$wchair,$stretcher,$dstretcher,$oxygen,$comments,$status,$apptype,$insurance_name,$org_apptime,$account){ //START of Reoccur Trips
	    $gday =  $day;
	    $start =strtotime($appdate);
		
	    if($till_date!=''){
		 $dat=$till_date;
		$end = strtotime(date("Y-m-d", strtotime($dat)) . " +1 day");
		
	     //$end = strtotime($dat);  
	    }
	    $num=numWeekDays($start,$end,$day, false);   		   
	    $dts=Weekdays($start,$end,$day, true);
		$dbus = new Database;	
	    $dbus->connect();	
	          for($i=0; $i<$num; $i++){
			  $dt=$dts[$i];
					   //INSERT INTO FORM TABLE
					$QueryQ  = "INSERT INTO ".TBL_FORMS." SET 
					prog='".$progtype."',
					unloadedmilage='".$unloadedmiles."',
					miles_string = '".$miles_string."',
					milage='".$miles."',
					charges	= '".$totcharges."',	
					triptype='".$triptype."',	
					vehtype='".$vehtype."',	
					appt_type='".$apptype."',					
					ssn='".$ssn."',
					req_id='".$req_id."',
					pickaddr='".$pickadd."',
					destination='".$destination_one."',
					three_address='".$destination_two."',
					four_address='".$destination_three."',
					five_address='".$destination_four."',
					three_pickup 	= '".$three_pickup."',
					four_pickup 	= '".$four_pickup."',
					five_pickup 	= '".$five_pickup."',
					backto='".$destination_last."',
					appdate='".$dt."',
					org_apptime='".$org_apptime."',
                    apptime='".$apptime."',
					returnpickup='".$returnpickup."',
					casemanager='".$casemanager1."',
					today_date=NOW(),
					clientname='".$pname."',
                    phnum='".$phnum."',
					dob='".$dob."',
					email='',
					clientcasemanager='".$casemanager2."',
					cisid='".$cisid."',
					insurance_name='".$insurance_name."',
					driver='".$driver."',
					sex='".$sex."',
					childseat='".$childseat."',
					escort='".$escort."',
					wchair='".$wchair."',
					stretcher='".$stretcher."',
					dstretcher='".$dstretcher."',
					oxygen='".$oxygen."',
					status='".$status."',
					comments='".$comments."'";
				  $dbus->execute($QueryQ);
                  }
	}//END OF Inserting Reoccur  Trips
	$db->close();
    $pgTitle = "Admin Panel -- Request";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msg);
	$smarty->assign("vehiclepref",$vehiclepref);
	$smarty->assign("errors",$error);
	$smarty->assign("hospitals",$hospitals);
	$smarty->assign("foot",$foot);	
	$smarty->assign("post",$post);	
	$smarty->assign("states",$slist);
	$smarty->assign("appdata",$appdata);
	$smarty->assign("unloadaddr",$unloadaddr);
	$smarty->assign("triptype",$triptype);		
	$smarty->display('mercytpl/add.tpl');
?>