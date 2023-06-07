<?php
   	include_once('../DBAccess/Database.inc.php');
	//include_once('Courier.php');
	//$courier = new Courier;
	//$courier->setRecipient('4807175032')->setBody('Text message from Muhammad Usman free text API')->send();
	$db = new Database;	
    $msgs = '';
	$noRec = '';
	$msgs .= $_GET['msg'];
	$db2 = new Database;	
    $sheet=$_GET['id'];
	$acknowledge_status = $_GET['acknowledge_status'];
	$st=$_GET['st'];
	$pg=$_GET['pg'];
	//$st10=0;$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$st6=0;$st11=0;
	$st10=0;$st9=0;$st8=0;$st7=0;$st5=0;$st4=0;$st3=0;$st2=0;$st6=0;$st11=0;$st14=0;$st13=0;$st12=0;
	if(isset($_GET['acknowledge_status'])) { $acknowledge_status = $_GET['acknowledge_status']; }
	$current_time=date("Y-m-d H:i:s");
	$db->connect();
	$db2->connect();
	echo '<noscript><p style="color:#F00; font-size:18px;">Please enable JavaScript in your browser for better use of the website.</p></noscript>';
	// Check if user has open more than one session 	
	$QV="SELECT admin_session FROM ".TBL_ADMIN." WHERE admin_id ='".$_SESSION['userid']."'";
	if($db->query($QV) && $db->get_num_rows() > 0){ 
		$vtypedata = $db->fetch_one_assoc(); 
		if($vtypedata['admin_session']!=$_SESSION['admin_session']){
			echo '<script>window.open("../logout.php?ds=1","_self");</script>'; exit;
		}  
	}
	
	/*************** Paging ************** */
	// Delete Category Script
    if(isset($_GET['delId']) && $_GET['delId'] != '')
	{   
    $json_response=00;
    $id=$_GET['delId'];
		$get_fro_modiv = "SELECT drv.lat,drv.longt,t_detail.legcharges,t_detail.webhookURL,t_detail.modiv_detail_id as m_detail_id 
		FROM ".TBL_TRIP_DET." as t_detail 
		LEFT JOIN drivers as drv ON t_detail.drv_id=drv.drv_code Where tdid = '$id'";
		//$get_fro_modiv = "SELECT legcharges,webhookURL,modiv_detail_id as m_detail_id FROM ".TBL_TRIP_DET." tdid='".$_GET['delId']."'";
		if($db->query($get_fro_modiv) && $db->get_num_rows())
		{
			$driverdata = $db->fetch_one_assoc();
			if ($driverdata['m_detail_id']!='') {
		date_default_timezone_set('UTC');
		$eventTime=date('Y-m-d').'T'.date('H:i:s');//.'-'.$time_zone;
		date_default_timezone_set('America/New_York');
				$query = "SELECT * FROM ".TBL_CONTACT."  WHERE c_id='1'";
		    if($db->query($query) && $db->get_num_rows() > 0)
				{
					$udata = $db->fetch_one_assoc();
				}
			$provider_name=$udata['provider_name'];
			$hybrid_secret=$udata['hybrid_secret'];
			$webhook_url=$driverdata['webhookURL'];
			$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 34; $i++) {
			    $randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			@$ride->eventId = substr($randomString, 0, 8).'-'.substr($randomString, 8, 4).'-'.substr($randomString, 12, 4).'-'.substr($randomString, 16, 4).'-'.substr($randomString, 20, 12);
			$event_type='rideCanceled';  
			@$ride->eventTime=$eventTime;
			$ride->eventType=$event_type;
			$ride->rideId=$driverdata['m_detail_id'];
			$ride->transportationProviderId=$udata['provider_name'];
			//@$ride->billAmount=$driverdata['legcharges'];
			@$ride->reasonCode=4;//Rider cancelled with usfficent notice
			$data_final['ride']=json_encode($ride);
			$data_final['ride'];
			$data_final['event_url']=$webhook_url;
			$url='https://api.nemtclouddispatch.com/ride/event_ride/'.$provider_name.'/'.$hybrid_secret;
			$curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS,$data_final);
	    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $json_response = curl_exec($curl);
			curl_close($curl);
			if($json_response==200) {
				$eventTime=date('Y-m-d').'T'.date('H:i:s');
				$event_query = " INSERT INTO tbl_events SET 
				event_type		=    '$event_type',
				eventTime 		=	 '$eventTime',
				latitude		=    '".$driverdata['lat']."',
				longitude		=    '".$driverdata['longt']."',
				modiv_id		=	 '".$driverdata['m_detail_id']."',
				created_time	=	 '".date('Y-m-d H:i')."'";
				$db->execute($event_query);
				$value = "The ". $driverdata['trip_user']. " status change to ".$message_type;
		    $link="reports/details.php?id=$id&notif_id=";
		   	$Query = "INSERT INTO tbl_notifications SET
				module='Ride',
				activity='Status',
		    	module_id = '$id',
				link 		= '$link',
				value 		= '$value',
				created_date = '".date('Y-m-d H:i')."'";
			  $db->execute($Query);
			  $QueryDel = "update ".TBL_TRIP_DET." set status='3' WHERE tdid='".$_GET['delId']."'";
	  		if($db->query($QueryDel))
				{
					echo "<script>location.href='grid.php?st=5&ad=0&id=".$sheet."'";
					echo "</script>";
				 	exit;
					  	   //Delete subcategories as wel
				} else {
				   	header("Location: grid.php?id=".$sheet);
					  exit;
				}
			} else{
		  		header("Location: grid.php?id=".$sheet);
			 	 	exit;
			}
		} else {
			$QueryDel = "update ".TBL_TRIP_DET." set status='3' WHERE tdid='".$_GET['delId']."'";
	  	if($db->query($QueryDel))
			{
				echo "<script>location.href='grid.php?st=5&ad=0&id=".$sheet."'";
				echo "</script>";
		 		exit;
				  	   //Delete subcategories as wel
	  	} else {
		 		header("Location: grid.php?id=".$sheet);
		   	exit;
	  	}
		}
	}
}
	// 	S E A R C H    C O D E  ///
		if(isset($_POST))
		{
			$drv = $_POST['driver'];
			$drv = $_GET['driver'];
			$usr = $_POST['user'];
			$usr = $_GET['user'];
			$user = $_POST['user'];
			$user = $_GET['user'];
			$account = $_POST['account'];
			$account = $_GET['account'];
			//$sheet = $_POST['id'];
			$whr = '';
			if ($drv!='')
			{
				$whr .=" AND td.drv_id = '$drv'";
			}
			if ($user!='')
			{
				$whr .=" AND t.trip_user LIKE '%$user%'";
			}
			if ($account!='')
			{
				$whr .=" AND t.account = '$account'";
			}
		}
		if($st == '5' )
		{	$st=5;
			$cond = " AND td.status IN ('5','2','0')";}
		elseif($st == '4')
		{$cond = " AND td.status IN ('1','4')"; }
		elseif($st == '3')
		{$cond = " AND td.status IN ('3','7','8')"; }
		elseif($st =='' || $st == '11')
		{$cond = " AND td.status IN ('6','10','5','9','11','12','13','14')"; }
	   else{   $cond = " AND td.status = '".$st."' "; 	}
				$VhicleArray = array();
$QR = "SELECT id,vehtype FROM vehtype";
if($db->query($QR) && $db->get_num_rows() > 0)
		{	$tdata = $db->fetch_all_assoc();
			for($i=0;$i< $db->get_num_rows();$i++)
			{	$row = $tdata[$i];
				$VhicleArray[$row['id']] = $row['vehtype'];
			}
		}
	  	  $today=date('Y-m-d');
		  $pday = date("Y-m-d",strtotime("-1 day"));
		  $QueryCount = "SELECT t.sheet_id,td.veh_id,td.acknowledge_status,t.trip_code,t.trip_id,t.trip_user,t.trip_clinic,t.trip_date, 
t.trip_tel,td.tdid,td.trip_id,td.type,td.pck_add,td.aptime,td.pck_time,td.aptime,td.drp_atime,t.account,td.p_phnum,td.picklocation,td.droplocation,td.drp_add,td.drp_time,td.trip_miles,td.wc,td.trip_remarks,td.drv_id,td.status,td.pick_latlong,td.drop_latlong, td.modiv_id, td.modiv_detail_id 
		  FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code WHERE t.trip_date = '$today'  $whr ORDER by td.pck_time ASC,td.tdid ASC";
		  if($db->query($QueryCount) && $db->get_num_rows() > 0){ $tripsCount = $db->fetch_all_assoc();
		   $tripLimit = round(sizeof($tripsCount)/20);
		   for ($i = 0;$i<sizeof($tripsCount);$i++)
		   {	 
		   $status=$tripsCount[$i]['status'];
		   switch($status){
			   case 1: $st4=$st4+1; 	 break;
			   case 2: $st2=$st2+1; $st5=$st5+1;  break;
			   case 3: $st3=$st3+1;	 break;
			   case 4: $st4=$st4+1;	 break;
			   case 5: $st5=$st5+1;	$st11=$st11+1; break;
			   case 6: $st6=$st6+1;	$st11=$st11+1; break;
			   case 7: $st3=$st3+1;	 break;
			   case 8: $st3=$st3+1;	 break;
			   case 9: $st9=$st9+1;		$st11=$st11+1; break;
			   case 10: $st10=$st10+1;	$st11=$st11+1; break;
			   case 12: $st12=$st12+1;	$st11=$st11+1; break;
			   case 13: $st13=$st13+1;	$st11=$st11+1; break;
			   break;
			   } }
		  }
		  $Query = "SELECT t.sheet_id,td.veh_id,td.acknowledge_status,t.trip_code,t.trip_id,t.trip_user,t.trip_clinic,t.trip_date,t.trip_tel,td.tdid,td.trip_id, td.type,td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime,td.reqid,td.picklocation,td.droplocation,td.arrived_time,td.escort_id, 
		  td.pickup_instruction, td.destination_instruction, td.d_phnum,td.p_phnum,t.account,td.drp_add,  td.drp_time,  td.trip_miles,td.wc,   td.trip_remarks,  td.drv_id, td.status, td.pick_latlong, td.drop_latlong,td.ccode,td.legcharges,ri.dstretcher,ri.bar_stretcher,ri.dwchair,ri.oxygen,ri.org_apptime, ri.modiv_flage,td.modiv_id,td.rideInitiated, td.modiv_detail_id, ri.vehtype 
		  FROM trips as t INNER JOIN trip_details as td 
		  ON t.trip_id=td.trip_id LEFT JOIN request_info as ri ON ri.id = td.reqid WHERE t.trip_date = '$today'  $cond $whr ORDER by td.pck_time ASC,td.tdid ASC LIMIT 0,20";

		// print($Query." >> ");
		if($db->query($Query) && $db->get_num_rows() > 0)
		{ 
			$trips = $db->fetch_all_assoc();
		   for ($i = 0;$i<sizeof($trips);$i++)
		   { $trip_user = $trips[$i]['trip_user'];
		   $trips[$i]['color_class'] = ''; 
		   if(($trips[$i]['status']=='5' || $trips[$i]['status']=='9') && $trips[$i]['pck_time'] < date('H:i:s') ){ $trips[$i]['color_class'] = 'pick_class'; }
		   if(($trips[$i]['status']=='6' ) && $trips[$i]['drp_time'] < date('H:i:s') ){ $trips[$i]['color_class'] = 'drop_class'; }
		   
		   	$Qcomments="SELECT comments FROM patient WHERE LTRIM(LOWER(name)) = '".strtolower(trim(($trip_user)))."'";
			if($db->query($Qcomments) && $db->get_num_rows() > 0)
				 {	 $dc = $db->fetch_one_assoc();  $trips[$i]['pcomments'] = $dc['comments']; }
			
			 $did 					= $trips[$i]['drv_id'];
			 $dif= (strtotime($current_time) - strtotime($trips[$i]['arrived_time']));
			 $lalagee='';
			 if($dif>5*60){
				 $df=secondsToTime($dif);
				 $lalagee.=$df['hours']!=0?$df['hours'].'hr &':'';
				 $lalagee.=$df['minutes']!=0?' '.$df['minutes'].'min ':'';
				 	$trips[$i]['wait_time'] 	= $lalagee; }//$trips[$i]['drv_id'];
/*			$drvQuery 	= "SELECT  fname, lname, drv_code,sip
										FROM ".TBL_DRIVERS."
											WHERE  drv_code  = '$did'";
				if($db->query($drvQuery) && $db->get_num_rows() > 0)
				 {
					 $drv = $db->fetch_row_assoc();
					 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];
					 $trips[$i]['sip'] = $drv['sip'];
				 }*/
		//to get vehicle type
		/*$Q="SELECT vt.vehtype,ri.dstretcher,ri.bar_stretcher,ri.dwchair,ri.oxygen,ri.org_apptime FROM vehtype as vt,request_info as ri 
			WHERE ri.vehtype=vt.id AND
			ri.id='".$trips[$i]['reqid']."'";		 
			if($db->query($Q) && $db->get_num_rows() > 0) {$ata=$db->fetch_one_assoc(); }*/	 
				 
				 // $tripdata[$i]['oxygen'] 	=	$ata['oxygen'];
				  $trips[$i]['vehtype'] 		= 	@$VhicleArray[$trips[$i]['vehtype']];//	$ata['vehtype'];
				// $trips[$i]['dstretcher'] 		= 	$ata['dstretcher'];
				// $trips[$i]['bar_stretcher'] 	= 	$ata['bar_stretcher'];
				// $trips[$i]['dwchair'] 			= 	$ata['dwchair'];
				// $trips[$i]['oxygen'] 			= 	$ata['oxygen'];
				 
				 
				  if($trips[$i]['type']=='AB'){$trips[$i]['org_apptime'] 			= 	$trips[$i]['org_apptime'];
				 if($trips[$i]['org_apptime']=='00:00:00' || $trips[$i]['org_apptime']=='00:00'){$trips[$i]['org_apptime'] = 	'';}
				 }
				 
		   }
		}
	//print_r($trips);  
	$drvQuery = "SELECT  fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus ='Active' ORDER BY  fname ASC";
	if($db->query($drvQuery) && $db->get_num_rows() > 0)
		$drivers = $db->fetch_all_assoc();
	$getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0' ORDER BY  fname ASC";
 	if($db->query($getDriver) && $db->get_num_rows())
	{
		$driverdata = $db->fetch_all_assoc();
	}
	$getDriver = "SELECT dr.* FROM ".TBL_DRIVERS." as dr LEFT JOIN ".TBL_DVMAPPING." as drv on dr.Drvid=drv.drv_id WHERE dr.drvstatus='Active' AND dr.modiv_flage='1' AND dr.del='0' AND drv.drv_id !='' ORDER BY  dr.fname ASC";
 	if($db->query($getDriver) && $db->get_num_rows())
	{
		$driverdata_modiv = $db->fetch_all_assoc(); // print_r($driverdata_modiv);
	}
	$ad='0';
	$getuser = "SELECT trip_user FROM trips WHERE trip_date = '$today' ORDER BY trip_user ASC";
 	if($db->query($getuser) && $db->get_num_rows())
	{
		$userdata = $db->fetch_all_assoc();
	}
	$getuser2 = "SELECT id,vehtype  FROM vehtype";
 	if($db->query($getuser2) && $db->get_num_rows())
	{
		$userdata2 = $db->fetch_all_assoc();
	}
	$g2 = "SELECT id,account_name  FROM accounts ORDER BY account_name ASC";
 	if($db->query($g2) && $db->get_num_rows() > 0)
	{	$accounts = $db->fetch_all_assoc();	}
	 $st_time	= date("H:i:s");
	 $end_time 	= date("H:i:s", strtotime("+45 minutes",strtotime($st_time))); 
	 $j=0;
	 $Dr = "SELECT drv_code,fname,lname FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0' AND login_status ='1' AND clockstatus='in' ORDER BY  fname ASC";
 	if($db->query($Dr) && $db->get_num_rows())
	{
		$driverdata2 = $db->fetch_all_assoc();
	}
	for($i=0;$i<sizeof($driverdata2);$i++){ $ohno = '';
	 $Qs="SELECT tdid FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND pck_time BETWEEN '".$st_time."' AND '".$end_time."'";	
	 if($db->query($Qs) && $db->get_num_rows() > 0){$ohno = '1';}
	 $Qs2="SELECT tdid FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND drp_time BETWEEN '".$st_time."' AND '".$end_time."'";	
	 if($db->query($Qs2) && $db->get_num_rows() > 0){$ohno = '1';}
 $Qs3="SELECT tdid FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND status IN ('6','10')";	
	 if($db->query($Qs3) && $db->get_num_rows() > 0){$ohno = '1';}
 $Qs4="SELECT tdid FROM trip_details WHERE (drv_id = '".$driverdata2[$i]['drv_code']."' || escort_id = '".$driverdata2[$i]['drv_code']."') AND  date = '".date('Y-m-d')."'  AND status IN ('5') AND pck_time < '".$st_time."'";	
	 if($db->query($Qs4) && $db->get_num_rows() > 0){$ohno = '1';}
//For Escort Checking
 /*$Qs="SELECT * FROM trip_details WHERE date = '".date('Y-m-d')."' AND escort_id = '".$driverdata2[$i]['drv_code']."' AND pck_time BETWEEN '".$st_time."' AND '".$end_time."'";	
	 if($db->query($Qs) && $db->get_num_rows() > 0){$ohno = '1';}
	 $Qs2="SELECT * FROM trip_details WHERE date = '".date('Y-m-d')."' AND escort_id = '".$driverdata2[$i]['drv_code']."' AND drp_time BETWEEN '".$st_time."' AND '".$end_time."'";	
	 if($db->query($Qs2) && $db->get_num_rows() > 0){$ohno = '1';}
 $Qs3="SELECT * FROM trip_details WHERE date = '".date('Y-m-d')."' AND escort_id = '".$driverdata2[$i]['drv_code']."' AND status IN ('6','10')";	
	 if($db->query($Qs3) && $db->get_num_rows() > 0){$ohno = '1';}
 $Qs4="SELECT * FROM trip_details WHERE date = '".date('Y-m-d')."' AND escort_id = '".$driverdata2[$i]['drv_code']."' AND status IN ('5') AND pck_time < '".$st_time."'";	
	 if($db->query($Qs4) && $db->get_num_rows() > 0){$ohno = '1';}	*/ 
	 	 
	 if($ohno == ''){$freedrivers[$j]['driver']=$driverdata2[$i]['fname'].' '.$driverdata2[$i]['lname'].' -- '.$driverdata2[$i]['drv_code']; $j++;}
		}
	
	//$newtimestamp = strtotime(date('Y-m-d H:i:s').' - 3 minute'); $stdate =  date('Y-m-d H:i:s', $newtimestamp);
	 $alert = '0';
	$sql = "SELECT id FROM alerts WHERE sent <= '".date('Y-m-d H:i:s')."' AND alerts.to = 'admin' and recd=0 AND message !='Driver GPS is Disabled'";
	//echo $sql;
	if($db->query($sql) && $db->get_num_rows() > 0) { $alert = '1'; }
	$qryString = $_SERVER['QUERY_STRING'];	
	//echo $st11;
	// print_r($driverdata2);
	$db->close();
	$db2->close();
    $pgTitle = "Admin Panel -- Routing Panel";
	$smarty ->assign("id",$sheet);
	$smarty ->assign("freedrivers",$freedrivers);
	$smarty ->assign("user",$user);
	$smarty ->assign("clinic",$clinic);
	$smarty ->assign("drv",$drv);
	$smarty ->assign("usr",$usr);
	$smarty->assign("driverdata_modiv",$driverdata_modiv);
	$smarty ->assign("alert",$alert);
	$smarty->assign("userdata2",$userdata2);
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("st",$st);
	$smarty->assign("st10",$st10);
	$smarty->assign("st9",$st9);
	$smarty->assign("st8",$st8);
	$smarty->assign("st7",$st7);
	$smarty->assign("st5",$st5);
	$smarty->assign("st6",$st6);
	$smarty->assign("st4",$st4);
	$smarty->assign("st3",$st3);
	$smarty->assign("st2",$st2);
	$smarty->assign("st11",$st11);
	$smarty->assign("st12",$st12);
	$smarty->assign("st13",$st13);
	$smarty->assign("st14",$st14);
	$smarty->assign("accounts",$accounts);
	$smarty->assign("userdata2",$userdata2);
	$smarty->assign("ad",$ad);
	$smarty ->assign("drivers",$drivers);
	$smarty ->assign("users",$users);
	$smarty ->assign("clinic",$clinic);
	$smarty->assign("driverdata",$driverdata);
	$smarty->assign("userdata",$userdata);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("NoRecord",$noRec);	
	$smarty->assign_by_ref('membdetail',$trips);
	$smarty->assign("paging",$paging);
	$smarty->assign("acknowledge_status",$acknowledge_status);
	$smarty ->assign("qryString",$qryString);
	$smarty ->assign("tripLimit",$tripLimit);
	$smarty->display('rpaneltpl/grid.tpl');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>JS Bin</title>
<style>
#tobecloseornot
{
  display:table;
  width:100%;
  height:.1px;
  border:0px solid black;
}
/*span
{
  vertical-align:middle;
  text-align:center; 
  margin:0 auto;
  font-size:50px;
  font-family:arial;
  color:#ba3fa3;  
  display:none;
}*/

#tobecloseornot.main .mainWindow,
#tobecloseornot.child .childWindow
{
  display:table-cell;
}

.mainWindow
{
  background-color:#22d86e;
}
.childWindow
{
  background-color:#70aeff;
}
</style>
  </head>
<body >
  <div id='tobecloseornot'> 
    <span class='mainWindow'></span>
    <span class='childWindow'></span>
  </div>
 
    <script>
  

var statusWindow = document.getElementById('tobecloseornot');
(function (win)
{ 
    //Private variables
    var _LOCALSTORAGE_KEY = 'WINDOW_VALIDATION';
    var RECHECK_WINDOW_DELAY_MS = 100;
    var _initialized = false;
    var _isMainWindow = false;
    var _unloaded = false;
    var _windowArray;
    var _windowId;
    var _isNewWindowPromotedToMain = false;
    var _onWindowUpdated;

    
    function WindowStateManager(isNewWindowPromotedToMain, onWindowUpdated)
    {
        //this.resetWindows();
        _onWindowUpdated = onWindowUpdated;
        _isNewWindowPromotedToMain = isNewWindowPromotedToMain;
        _windowId = Date.now().toString();

        bindUnload();

        determineWindowState.call(this);

        _initialized = true;

        _onWindowUpdated.call(this);
    }

    //Determine the state of the window 
    //If its a main or child window
    function determineWindowState()
    {
        var self = this;
        var _previousState = _isMainWindow;

        _windowArray = localStorage.getItem(_LOCALSTORAGE_KEY);

        if (_windowArray === null || _windowArray === "NaN")
        {
            _windowArray = [];
        }
        else
        {
            _windowArray = JSON.parse(_windowArray);
        }

        if (_initialized)
        {
			var IE='';
            if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )){
			 	IE='yes';
			}
            //Determine if this window should be promoted
            if (_windowArray.length <= 1 ||
               ((_isNewWindowPromotedToMain ? _windowArray[_windowArray.length - 1] : _windowArray[0]) === _windowId) && IE=='')
            {
                _isMainWindow = true;		
            }
            else
            {      //  This is the tab which is to be close in this time.  
			//alert('Changed');
				
				
                _isMainWindow = false;
				window.open('close.php','_self');
				//$('#body').hide();
				//window.close();
				//window.close();
				//window.open('','_self').close();
            }
        }
        else
        {
            if (_windowArray.length === 0)
            { 
                _isMainWindow = true;
                _windowArray[0] = _windowId;
                localStorage.setItem(_LOCALSTORAGE_KEY, JSON.stringify(_windowArray));
            }
            else
            {
                _isMainWindow = false;
                _windowArray.push(_windowId);
                localStorage.setItem(_LOCALSTORAGE_KEY, JSON.stringify(_windowArray));
            }
        }

        //If the window state has been updated invoke callback
        if (_previousState !== _isMainWindow)
        {
            _onWindowUpdated.call(this);
        }

        //Perform a recheck of the window on a delay
        setTimeout(function()
                   {
                     determineWindowState.call(self);
                   }, RECHECK_WINDOW_DELAY_MS);
    }

    //Remove the window from the global count
    function removeWindow()
    {
        var __windowArray = JSON.parse(localStorage.getItem(_LOCALSTORAGE_KEY));
        for (var i = 0, length = __windowArray.length; i < length; i++)
        {
            if (__windowArray[i] === _windowId)
            {
                __windowArray.splice(i, 1);
                break;
            }
        }
        //Update the local storage with the new array
        localStorage.setItem(_LOCALSTORAGE_KEY, JSON.stringify(__windowArray));
    }

    //Bind unloading events  
    function bindUnload()
    {
        win.addEventListener('beforeunload', function ()
        {
            if (!_unloaded)
            {
                removeWindow();
            }
        });
        win.addEventListener('unload', function ()
        {
            if (!_unloaded)
            {
                removeWindow();
            }
        });
    }

    WindowStateManager.prototype.isMainWindow = function ()
    {
        return _isMainWindow;
    };

    WindowStateManager.prototype.resetWindows = function ()
    {
        localStorage.removeItem(_LOCALSTORAGE_KEY);
    };

    win.WindowStateManager = WindowStateManager;
})(window);

var WindowStateManager = new WindowStateManager(true, windowUpdated);

function windowUpdated()
{
    //"this" is a reference to the WindowStateManager
    statusWindow.className = (this.isMainWindow() ? 'main' : 'child');
}
//Resets the count in case something goes wrong in code
//WindowStateManager.resetWindows()
  </script>
</body>
</html>