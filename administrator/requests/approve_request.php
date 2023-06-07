<?php
   	include_once('../DBAccess/Database.inc.php');
   	include_once('../../emailme.php');	
	include_once('../TextMarksV2APIClient.php');
	include_once('approve_request_function.php');
	//set_time_limit(900);
	ini_set('max_execution_time', 900); 
	$db = new Database;	
	$db->connect();

	$calcmiles = $_POST['calcmiles'];
	$id = $_REQUEST['id'];
	$rqid = $_REQUEST['rqid'];
	$re= "SELECT * FROM ".TBL_FORMS." WHERE id = '".$id."' ";
				if($db->query($re) && $db->get_num_rows() > 0){
				 $dt=$db->fetch_all_assoc();
				}
	//print_r($dt);
	$opt1=$dt[0]['confirmation_type'];
	$pickaddrmiles=$dt[0]['pickaddr'];
	$destinationmiles=$dt[0]['destination'];
	//New code	
	$three_address	= $dt[0]['three_address'];
	$four_address	= $dt[0]['four_address'];
	$five_address	= $dt[0]['five_address'];
	$backto			= $dt[0]['backto'];
	$miles_string	= explode(',',$dt[0]['miles_string']);
	$miles1 = $miles_string[0];
	if($miles_string[1]) { 	$miles2 = $miles_string[1]; }
	if($miles_string[2]) { 	$miles3 = $miles_string[2]; }
	if($miles_string[3]) { 	$miles4 = $miles_string[3]; }
	if($miles_string[4]) { 	$miles5 = $miles_string[4]; }
	
	
	//End New code	
$appdate=$dt[0]['appdate'];
$apptime=$dt[0]['apptime'];
$vehtype=$dt[0]['vehtype'];
$waittime=$dt[0]['waittime'];
$after_hours=$dt[0]['after_hours'];
$noshow=$dt[0]['noshow'];
$ttype = $dt[0]['triptype'];
$triptype = $dt[0]['triptype'];
$totmilages=str_replace("&nbps;","",$dt[0]['milage']);
$unloadedmilage = $dt[0]['unloadedmilage'];
$loadedmilage 	= ($totmilages); 
	//$totmilages = $unloadedmilage + $calcmilage1;
	if($opt1=='S'){
	$msg="Confirmation SMS will be sent to Client";	
	}
	if($opt1=='E'){
	$msg="Confirmation Email will be sent to Client";	
	}
	if($opt1=='B'){
	$msg="Confirmation Email and SMS will be sent to Client";	
	}
	
	//print_r($r);
	
	if(isset($_POST['submit']) && $_POST > 0)
	{
		
			  $rate_type=$USS['rate_type'];
			  $ratequery = "SELECT * FROM ".clinic_rates." WHERE vehtype_id= '$vehtype' AND clinic_id= ".$dt[0]['account']." ";
			  if($db->query($ratequery) && $db->get_num_rows() > 0){	$r = $db->fetch_one_assoc();	}
	
		if(isset($_POST['submit']) && $_POST > 0){
			//Start of new code
	$miles1 = $_POST['miles1'];
	$miles2 = $_POST['miles2'];
	$miles3 = $_POST['miles3'];
	$miles4 = $_POST['miles4'];
	$miles5 = $_POST['miles5'];
	
	if($ttype == 'One Way') 	{$miles_string = $miles1; $base = 1;}
	if($ttype == 'Round Trip') 	{$miles_string = $miles1.','.$miles2; $base = 1;}
	if($ttype == 'Three Way') 	{$miles_string = $miles1.','.$miles2.','.$miles3; $base = 2;}
	if($ttype == 'Four Way') 	{$miles_string = $miles1.','.$miles2.','.$miles3.','.$miles4; $base = 3;}
	if($ttype == 'Five Way') 	{$miles_string = $miles1.','.$miles2.','.$miles3.','.$miles4.','.$miles5; $base = 4;}
	$loadedmilage = ($miles1 + $miles2 + $miles3 + $miles4 + $miles5);
	$unloadedmilage = $_POST['unloadedmilage'];
	$totmilages 	= ($loadedmilage);
	//End of new code	
			}
		if($dt[0]['stretcher']=='Yes'){		$str_charges	=	$r['stretcher_ch'];}
		if($dt[0]['bar_stretcher']=='Yes'){	$bstr_charges 	=	$r['bstretcher_ch'];}
		if($dt[0]['dstretcher']=='Yes'){	$dstr_charges 	=	$r['dstretcher_ch'];}
		
		if($dt[0]['oxygen']=='Yes'){	$oxygen_charges 	=	$r['oxygen_ch'];}
		if($dt[0]['dwchair']=='Yes'){	$dwchair_charges 	=	$r['doublewheel_ch'];}
		
	$totcharges = round((($base 	  *	$r['pickup_ch']) + 
						($totmilages  *  $r['permile_ch']) +
						($after_hours *  $r['afterhour_ch'])+
						($noshow 	  *  $r['noshow_ch'])+$str_charges+$bstr_charges+$dstr_charges+$oxygen_charges+$dwchair_charges),2);

		//$totcharges = round(($bcharges * $base) + ($totmilages * $mcharges),2);
		$query = "UPDATE ".TBL_FORMS." SET milage = '".$totmilages."', miles_string = '".$miles_string."', charges = '".$totcharges."', unloadedmilage = '".$unloadedmilage."', reqstatus = 'approved' WHERE id = '".$id."'";
		if($db->query($query))
		{
		//-------------------------------------- Start of Functions------------------------
			// check if record exists
			$req_query = "SELECT * FROM ".TBL_FORMS." WHERE id = '".$id."' ";
			if($db->query($req_query) && $db->get_num_rows() > 0)
			{
				$req_info = $db->fetch_all_assoc();
				 insert_trip($id);
		 $hospQuery = "SELECT r.userid,r.reqid,f.* 		          
		  FROM ".TBL_FORMS." as f,  ".TBL_REQUESTS." as r 
		  WHERE f.id='".$rid."'  AND r.reqid=f.req_id GROUP BY f.id";
	       if($db->query($hospQuery) && $db->get_num_rows() > 0 ){
			 $hospinfo = $db->fetch_all_assoc(); 
			} 
			$ems=$hospinfo[0]['email'];
			 if($ems != '')
			 {
			 $em=$hospinfo[0]['email'];
			 }else{
			$em= $hospinfo[0]['email_address'];
			 };	
			 
			 $qemail = "SELECT * FROM ".TBL_EMAIL;	
		    if($db->query($qemail) && $db->get_num_rows() > 0)
		    {
		       $emaildata = $db->fetch_all_assoc();
		    }
			
			 $Q = "SELECT * FROM accounts WHERE id =".$dt[0]['account']." ";	
		    if($db->query($Q) && $db->get_num_rows() > 0)
		    {
		       $accountinfo = $db->fetch_one_assoc();
		    }
		$Qcontactinfo="SELECT * FROM contact_info WHERE c_id = '1'";
				if($db->query($Qcontactinfo) && $db->get_num_rows()>0){	$contactinfo=$db->fetch_one_assoc(); }	
				
			$from = $contactinfo['email'];
			$subject = 'Trip request Approved -- '.$contactinfo['title'];
			$email =	$accountinfo['email'];
			$body    = '<table width="90%" border="0" cellspacing="2" cellpadding="2">
						  <tr>
					<td width="63%"><a href="http://'.$contactinfo['url'].'"><img src="http://'.$contactinfo['url'].'/images/logo.png" border="0" /></a></td>
							<td width="37%"><strong>
						<font color="#000000" size="1px" >'.$contactinfo['title'].',<br />
        '.$contactinfo['address'].',<br />
		'.$contactinfo['city'].', '.$contactinfo['state'].', '.$contactinfo['zip'].'
        TEL:'.$contactinfo['phone'].'</font></strong></td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">
							Dear '.$accountinfo['account_name'].',<br>
							Your trip request for the following Client is approved successfully:.<br><br>
							<b>Client Name:</b> '.$dt[0]['clientname'].'.<br> 
			<b>Appointment Date:</b> '.convertDateFromMySQL($dt[0]['appdate']).'<br> <b>Pick Time: </b>'.date('h:i:s a',strtotime($dt[0]['apptime'])).'<br><br>
		if you have any questions, contact us at <a href="mailto:'.$contactinfo['email'].'">'.$contactinfo['email'].'</a>
							</td>
						  </tr>
						  <tr>
							<td colspan="2" align="left">Regards! <br> '.$contactinfo['title'].' Support Team!</td>
						  </tr>
						</table>';
				    //$sent = $mail->HtmlTxtMail($email,$from,$subject,$body);
					// sendmail_to_contact($body,$email,$subject,$attachment='');
			}
			//GET DRIVERS LIST
			$db = new Database;	
			$db->connect();
			$getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0'";
			if($db->query($getDriver) && $db->get_num_rows())
			{
				$driverdata = $db->fetch_all_assoc();
			}		
            $to=$driverdata[0]['cell_num'];
  		    $req= "SELECT * FROM ".TBL_FORMS." as r WHERE r.id = '".$rid."' ";
				if($db->query($req) && $db->get_num_rows() > 0){
				 $dt=$db->fetch_all_assoc();
				}
			  $apptime=$dt[0]['apptime'];
			  $appdate=$dt[0]['appdate']; 	
		      $name=$dt[0]['firstname']; 
			  $phone=$dt[0]['phnum']; 
		      $addr1=$dt[0]['pickaddr'];
			  $addr2=$dt[0]['destination'];
		      $opt=$dt[0]['confirmation_type'];
		      $cell=$dt[0]['cell_num'];
		 	  $tripid=$dt[0]['id'];
			  $smarty->assign("driverdata",$driverdata);
			  $smarty->assign("id",$id);
			//---------------------------------------------------------------------------------
			 $t= "SELECT * FROM ".TBL_TRIPS." WHERE reqid = '".$rqid."' ";
				if($db->query($t) && $db->get_num_rows() > 0){
				 $td=$db->fetch_all_assoc();
				}
			$trpid=$td[0]['reqid'];
			echo "<script type='text/ecmascript'>alert('Request approved successfully')</script>";
          /*  //echo "<script>location.href='index.php';</script>";*/
			echo "<script>javascript:history.back();</script>"; exit;
		}
		else
		{
			echo "<script type='text/javascript'>alert('Request approval unsuccessfull ');</script>";
			/*echo "<script>location.href='index.php';</script>";*/
			echo "<script>javascript:history.back();</script>"; exit;
		}
	}
	//Close DB Connection	
	$db->close();
    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);
	$smarty->assign("drivers",$drivers);
	$smarty->assign("msg",$msg);
	$smarty->assign("id",$id);
	$smarty->assign("rqid",$rqid);
	$smarty->assign("appdate",$_GET['appdate']);
	$smarty->assign("pickaddrmiles",$pickaddrmiles);
	$smarty->assign("destinationmiles",$destinationmiles);
	$smarty->assign("loadedmilage",$loadedmilage);
	$smarty->assign("ttype",$ttype);
	$smarty->assign("currdate",date("Y-m-d"));
	//New code
	$smarty->assign("three_address",$three_address);
	$smarty->assign("four_address",$four_address);
	$smarty->assign("five_address",$five_address);
	$smarty->assign("backto",$backto);
	$smarty->assign("miles1",$miles1);
	$smarty->assign("miles2",$miles2);
	$smarty->assign("miles3",$miles3);
	$smarty->assign("miles4",$miles4);
	$smarty->assign("miles5",$miles5);
	
	$smarty->assign("unloadedmilage",$unloadedmilage);
	$smarty->assign("totmilages",$totmilages);
	$smarty->assign("detail",$dt[0]);
	//End of new code
	$smarty->display('reqtpls/approve_request.tpl');
