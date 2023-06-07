<?php



   	



   /*	include_once('../DBAccess/Database.inc.php');

	



		

	$msgs   = '';

	$errors = '';		

   	$sheetid = 0;

   

	$db1 = new Database;	

	$db1->connect();

		

	$id=$_REQUEST['id'];

   

	$cd = date("Y-m-d");

	//Check if sheet for the current date exists or not

	$query = "SELECT * FROM ".TBL_SHEET." WHERE dated = '".$cd."'";

	if($db1->query($query) && $db1->get_num_rows())

	{

		$sheet = $db1->fetch_all_assoc();

		$sheetid = $sheet[0]['sheet_id'];

	}

	

	function get_veh($drv)

	{

		$db = new Database;	

		$db->connect();

		$dQuery = "SELECT v.id  

					FROM ".TBL_DRIVERS." d

					INNER JOIN ".TBL_DVMAPPING." dm ON d.Drvid = dm.drv_id

					INNER JOIN ".TBL_VEHICLES." v ON dm.veh_id = v.id WHERE d.drv_code='$drv'";

		

		$id = $db->executeScalar($dQuery);

		

		return $id;

	}



	function insert_request(){

	 	$db = new Database;	

		$db->connect();

					

        	$mQuery = "SELECT id FROM hospitals WHERE hospname ='".trim($_POST['clinic'])."'";

		if($db->query($mQuery) && $db->get_num_rows())

		{

			$sr = $db->fetch_all_assoc();

		}

		$userid=$sr[0]['id'];

		$Query1  = "INSERT INTO ".TBL_REQUESTS." SET 

					userid='".$userid."',

					hospname='".$_POST['clinic']."',

					reqdate=NOW(),

					sessionn_id='0',

					req_status='active'";

	  	if($db->execute($Query1))

		{

	    		$req_id = $db->insert_id(); 

			if($_POST['address3']!=''){

				$miles = $_POST['miles1'] + $_POST['miles2'];

				$ttype = 'RW';

				$back_address = $_POST['address3'];

				$returnpickup = $_POST['pu2'].':00';

			}else{

				$miles = $_POST['miles1'];

				$ttype = 'OW';

				$returnpickup = '00:00:00';

			}

			$pck_address = $_POST['address1'];

			$dst_address = $_POST['address2'];

			$tdate = explode("/",$_POST['tdate']);

           		$appdate = date("Y-m-d",mktime(0,0,0,$tdate[0],$tdate[1],$tdate[2]));

			$apptime = $_POST['pu1'].':00';

			$pname = $_POST['consumer'];

			$phnum = $_POST['phone'];

			$cisid = $_POST['cisid'];

			$Query2  = "INSERT INTO ".TBL_FORMS." SET 

					prog='1',

					total='0',	

					milage='".$miles."',	

					triptype='".$ttype."',	

					vehtype='0',					

					ssn='',

					req_id='".$req_id."',

					pickaddr='".$pck_address."',

					destination='".$dst_address."',

					backto='".$back_address."',

					appdate='".$appdate."',

                    			apptime='".$apptime."',

					returnpickup='".$returnpickup."',

					casemanager='',

					today_date=NOW(),

					clientname='".$pname."',

                    			phnum='".$phnum."',

					dob='',

					email='',

					clientcasemanager='',

					cisid='".$cisid."',

					comments='',

					$appt_type='0',

					confirmation_type='Cash'";

			$db->execute($Query2);

	    }

	 }

    

	 //  F U N C T I O N     T O    I N  S E R T     T R I PS         I N     D A TA B A S E //

    

				function insert_trip()

				{

					$db = new Database;	

					$db->connect();

					

					$cd = date("Y-m-d");

					$query = "SELECT * FROM ".TBL_SHEET." WHERE dated = '".$cd."'";

					if($db->query($query) && $db->get_num_rows())

					{

						$sheet = $db->fetch_all_assoc();

						$sheetid = $sheet[0]['sheet_id'];

					}

			

					$sheet=$_POST['id'];

					$trip_code = $_POST['trip_code'];

					$clinic = $_POST['clinic'];

					$user = $_POST['consumer'];

					 $tel = $_POST['phone'];

					

					$miles = $_POST['miles1'] + $_POST['miles2'];

					$date = date('Y-m-d',time());

				    $tQuery = "INSERT INTO ".TBL_TRIPS." SET 

					                        trip_code = '$trip_code',

											trip_clinic = '$clinic',

											trip_user = '$user',

											trip_tel = '$tel',

											trip_date = '$date',

											sheet_id = '$sheetid',

											status = '0',

											trip_miles = '$miles'";

							

					if($db->execute($tQuery))

					{

					

						insert_tdetail();

					}

					

					$db->close();

					

				}

				 //  F U N C T I O N     T O    I N  S E R T     T R I PS         I N     D A TA B A S E //

				 

				

				//  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //

				

				function insert_tdetail()

				{

					$db = new Database;	

					$db->connect();

				

					$trip_id = mysql_insert_id();

					$qtime = $db->query('SELECT NOW() AS tym');

	

					$get = $db->fetch_one_assoc();

					 $xp = explode(' ',$get['tym']);

					 $date = $xp[0];

					 $time=$xp[1];		

					

					$prop = "10";

					//---------------------- check for pick time ---------------------------------//

					if(isset($_POST['pu1']))

					{

						$ptime=$_POST['pu1'].':00';

						$pck_ptime = date("H:i:s", strtotime("-$prop minutes".$ptime));

						$wc = '0';

					}

					else

					{

						$ptime = '00:00:00';

						$pck_ptime = '00:00:00';

						$wc = '1';

					}

					//---------------------- check for drop time ---------------------------------//

					if(isset($_POST['dt1']))

					{

						$dtime= $_POST['dt1'].':00';

						$drp_ptime =  date("H:i:s", strtotime("-$prop minutes".$dtime));

						$wc = '0';

					}

					else

					{

						$dtime = '00:00:00';

						$drp_ptime = '00:00:00';

						$wc = '1';

					}

					//----------------------------------------------------------------------------------//

					

					$drvid=$_POST['staff1'];

					$pckadd=$_POST['address1'];

					$drpaddr=$_POST['address2'];

					$trp_miles=$_POST['miles1'];

					$trp_remarks=sql_replace($_POST['remarks']);

					$veh_id = get_veh($_POST['staff1']);

					

					$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 

											trip_id 				=	 	'$trip_id',

											drv_id 				=		'$drvid',

											veh_id 				= 		'$veh_id',

											date					= 		'$date',

											pck_add 			= 		'$pckadd',

											pck_time 			= 		'$ptime',

											pck_ptime 		= 		'$pck_ptime',

											pck_atime 		= 		'',

											drp_add 			= 		'$drpaddr',

											drp_time 			= 		'$dtime',

											drp_ptime 		= 		'$drp_ptime',

											drp_atime 		= 		'',

											trip_miles 		= 		'$trp_miles',

											type 		= 		'1',

											wc 			= 		'$wc',

											status	=  '0',

											trip_remarks 	= 		\"".$trp_remarks."\"";

					if($db->execute($tQuery))

					{

						

					}

					

					if($_POST['address3']!='')

					{

						$prop = "10";

						

						 $qtime = $db->query('SELECT NOW() AS tym');

						 $get = $db->fetch_one_assoc();

						 $xp = explode(' ',$get['tym']);

						 $date = $xp[0];

						 $time=$xp[1];		

	 

	 					//---------------------- check for pick time ---------------------------------//

					if(isset($_POST['pu2']))

					{

						$ptime=$_POST['pu2'].':00';

						$pck_ptime = date("H:i:s", strtotime("+$prop minutes".$ptime));

						$wc = '0';

					}

					else

					{

						$ptime = '00:00:00';

						$pck_ptime = '00:00:00';

						$wc = '1';

					}

					//---------------------- check for drop time ---------------------------------//

					if(isset($_POST['dt2']))

					{

						$dtime= $_POST['dt2'].':00';

						$drp_ptime =  date("H:i:s", strtotime("+$prop minutes".$dtime));

						$wc = '0';

					}

					else

					{

						$dtime = '00:00:00';

						$drp_ptime = '00:00:00';

						$wc = '1';

					}

					//----------------------------------------------------------------------------------//

					

					

					/*	$ptime= $_POST['pu2'].':00';

						$pck_ptime = date("H:i:s", strtotime("+$prop minutes".$ptime));

						$dtime= $_POST['dt2'].':00';

						$drp_ptime =  date("H:i:s", strtotime("+$prop minutes".$dtime));

						//$date = date('Y-m-d',time());*/

					/*	

						$drvid=$_POST['staff2'];

					    $pckadd=$_POST['address2'];

					    $drpaddr=$_POST['address3'];

					    $trp_miles=$_POST['miles2'];

							$veh_id = get_veh($_POST['staff2']);

						$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 

												trip_id 				=	 	'$trip_id',

												drv_id 				=		'$drvid',

												veh_id 				= 		'$veh_id',

												date					= 		'$date',

												pck_add 			= 		'$pckadd',

												pck_time 			= 		'$ptime',

												pck_ptime 		= 		'$pck_ptime',

												pck_atime 		= 		'',

												drp_add 			= 		' $drpaddr',

												drp_time 			= 		'$dtime',

												drp_ptime 		= 		'$drp_ptime',

												drp_atime 		= 		'',

												trip_miles 		= 		' $trp_miles',

												type 		= 		'2',

												wc 			= 		'$wc',

												status	=  '0',

												trip_remarks 	= 		\"".$trp_remarks."\"";

							

							if($db->execute($tQuery))

									{

														

														  $chk=$_POST['chk'];

																			  if ($chk!=''){

																			  

																			    $stf1=$_POST['staff1'];

																				

																			  $Query = "SELECT cell_num FROM  drivers  

																			WHERE   drv_code='$stf1'";

																		

																		 	if($db->query($Query) && $db->get_num_rows())

															  				{

															  					$udata = $db->fetch_all_assoc();

															  				}

																			$num=$udata[0]['cell_num'];

																			//$message="Testing";

														$ch = curl_init('http://smsapi.Wire2Air.com/smsadmin/submitsm.aspx');

  curl_setopt($ch, CURLOPT_POST, 1);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "VERSION=2.0&userid=hybridTracktrans&password=hybrid123&VASId=1264&PROFILEID =7&FROM =81912&TO={$num}&Text={$user},{$tel},{$pckadd}");

   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

  $data = curl_exec($ch);	 



																			  

														             }else{

																	 

																	 

																	 $num=$_POST['mnum'];

																	// $message="Testing";

																		

																		$ch = curl_init('http://smsapi.Wire2Air.com/smsadmin/submitsm.aspx');

  curl_setopt($ch, CURLOPT_POST, 1);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "VERSION=2.0&userid=hybridTracktrans&password=hybrid123&VASId=1264&PROFILEID =7&FROM =81912&TO={$num}&Text={$user},{$tel},{$pckadd}");

   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

  $data = curl_exec($ch);	 

																	 

																	 }

																	 

																	 

																	 

														  $chk2=$_POST['chk2'];

																			  if ($chk2!=''){

																			  

																			    $stf2=$_POST['staff2'];

																				

																			  $Query = "SELECT cell_num FROM  drivers  

																			WHERE   drv_code='$stf2'";

																		

																		 	if($db->query($Query) && $db->get_num_rows())

															  				{

															  					$udata = $db->fetch_all_assoc();

															  				}

																			$num=$udata[0]['cell_num'];

																				$ch = curl_init('http://smsapi.Wire2Air.com/smsadmin/submitsm.aspx');

  curl_setopt($ch, CURLOPT_POST, 1);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "VERSION=2.0&userid=hybridTracktrans&password=hybrid123&VASId=1264&PROFILEID =7&FROM =81912&TO={$num}&Text={$user},{$tel},{$pckadd}");

   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

  $data = curl_exec($ch);	 

																			  

														             }else{

																	 

																	 

																	 $num2=$_POST['mnum2'];

																	 $message="Testing";

																			$ch = curl_init('http://smsapi.Wire2Air.com/smsadmin/submitsm.aspx');

  curl_setopt($ch, CURLOPT_POST, 1);

   curl_setopt($ch, CURLOPT_POSTFIELDS, "VERSION=2.0&userid=hybridTracktrans&password=hybrid123&VASId=1264&PROFILEID =7&FROM =81912&TO={$num2}&Text={$user},{$tel},{$pckadd}");

   curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

  $data = curl_exec($ch);	 

																	 

																	 

																	 }

									  

									}

						 }

											

					}

	      //  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //

	





 //if page is submitted

    if(isset($_POST['addgrid']))

     {

		

	insert_request();	

    	insert_trip();

            echo "<script>";

			echo "alert('Addon added Successfully');";

			echo "location.href='index.php";

			echo "</script>";

				exit;*/

		/*		 

		  if($db->execute($Query))

		    {

			 echo "<script>window.open('index.php?f=s','_parent');</script>"; 

			  }else{ 

				 $error .= 'Unable to add re-filling information.';

				 $smarty->assign("errors",$error);

				 $smarty->display('vehtpl/msg.tpl');

				 exit;

			 }

			 exit;*/

		    

  //  }

		

//GET DRIVERS LIST

	/*$db = new Database;	

	$db->connect();

	 $getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0'";

 		 if($db->query($getDriver) && $db->get_num_rows())

			  {

			  $driverdata = $db->fetch_all_assoc();

			  }		



    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [ADD REQUEST]";

	$smarty->assign("pgTitle",$pgTitle);

		$smarty->assign("driverdata",$driverdata);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("id",$id);

	$smarty->assign("qty",$qty);

	$smarty->assign("amt",$amt);				

	$smarty->display('rpaneltpl/add_addon.tpl');*/





   	



   	include_once('../DBAccess/Database.inc.php');
	include_once('../TextMarksV2APIClient.php');
	



		

	$msgs   = '';

	$errors = '';

		

   $id=$_REQUEST['id'];

	

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

	return ($vehs['veh_id'] > 0) ? $vehs['veh_id'] : '0';

}



function insert_request(){

	$db = new Database;	

	$db->connect();					

		 

    $mQuery = "SELECT id FROM hospitals WHERE hospname ='".trim($_POST['clinic'])."'";

	if($db->query($mQuery) && $db->get_num_rows())

	{

		$sr = $db->fetch_all_assoc();

	}

	$userid=$sr[0]['id'];

	$Query1  = "INSERT INTO ".TBL_REQUESTS." SET 

				userid='".$userid."',

				hospname='".$_POST['clinic']."',

				reqdate=NOW(),

				sessionn_id='0',

				req_status='active'";

	if($db->execute($Query1))

	{

		$req_id = $db->insert_id(); 

		if($_POST['address3'] != ''){

			$miles = $_POST['miles1'] + $_POST['miles2'];

			$ttype = 'RW';

			$back_address = $_POST['address3'];

			$returnpickup = $_POST['pu2'].':00';

		}else{

			$miles = $_POST['miles1'];

			$ttype = 'OW';

			$returnpickup = '00:00:00';

		}

		$pck_address = $_POST['address1'];

		$dst_address = $_POST['address2'];

		$tdate = explode("/",$_POST['tdate']);

    	$appdate=date("Y-m-d",mktime(0,0,0,$tdate[0],$tdate[1],$tdate[2]));

		$apptime = $_POST['pu1'].':00';

		$pname = $_POST['consumer'];

		$phnum = $_POST['phone'];

		$cisid = $_POST['cisid'];

					

		$Query2  = "INSERT INTO ".TBL_FORMS." SET 

					prog='1',

					total='0',	

					milage='".$miles."',	

					triptype='".$ttype."',	

					vehtype='',					

					ssn='',

					req_id='".$req_id."',

					pickaddr='".$pck_address."',

					destination='".$dst_address."',

					backto='".$back_address."',

					appdate='".$appdate."',

                    apptime='".$apptime."',

					returnpickup='".$returnpickup."',

					casemanager='',

					today_date=NOW(),

					clientname='".$pname."',

                    phnum='".$phnum."',

					dob='',

					email='',

					clientcasemanager='',

					cisid='".$cisid."',

					comments='',

					appt_type='0',

					reqstatus='approved',

					confirmation_type='Cash'";

		$db->execute($Query2);

	}

}

    

	 //  F U N C T I O N     T O    I N  S E R T     T R I PS         I N     D A TA B A S E //

    

				function insert_trip()

				{

					$db = new Database;	

					$db->connect();

					

					$tdate = explode("/",$_POST['tdate']);

                    $date=date("Y-m-d",mktime(0,0,0,$tdate[0],$tdate[1],$tdate[2]));	 

      $mQuery = "SELECT * FROM trips   WHERE trip_date ='$date'";



	if($db->query($mQuery) && $db->get_num_rows())

															  				{

															  					$sr = $db->fetch_all_assoc();

															  				}



	

						$sheet=$sr[0]['sheet_id'];

				

					$clinic = $_POST['clinic'];

					$user = $_POST['consumer'];

					$tel = $_POST['phone'];

					$trip_code = $_POST['trip_code'];

					$miles = $_POST['miles1'] + $_POST['miles2'];

				    $tQuery = "INSERT INTO ".TBL_TRIPS." SET 

					                        trip_code = '$trip_code',

											trip_clinic = '$clinic',

											trip_user = '$user',

											trip_tel = '$tel',

											trip_date = '$date',

											sheet_id = '$sheet',

											status = '0',

											trip_miles = '$miles'";

							

					if($db->execute($tQuery))

					{

					

						insert_tdetail();

					}

					

					$db->close();

					

				}

				 //  F U N C T I O N     T O    I N  S E R T     T R I PS         I N     D A TA B A S E //

				 

				

				//  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //

				

				function insert_tdetail()

				{

					$db = new Database;	

					$db->connect();

				

					$trip_id = mysql_insert_id();

					/*$qtime = $db->query('SELECT NOW() AS tym');

	

					$get = $db->fetch_one_assoc();

					 $xp = explode(' ',$get['tym']);

					 $date = $xp[0];

					 $time=$xp[1];*/

					$tdate = explode("/",$_POST['tdate']);

                    $date=date("Y-m-d",mktime(0,0,0,$tdate[0],$tdate[1],$tdate[2]));		

					

					$prop = "10";

					//---------------------- check for pick time ---------------------------------//

					if(isset($_POST['pu1']))

					{

						$ptime=$_POST['pu1'].':00';

						$pck_ptime = date("H:i:s", strtotime("-$prop minutes".$ptime));

						$wc = '0';

					}

					else

					{

						$ptime = '00:00:00';

						$pck_ptime = '00:00:00';

						$wc = '1';

					}

					//---------------------- check for drop time ---------------------------------//

					if(isset($_POST['dt1']))

					{

						$dtime= $_POST['dt1'].':00';

						$drp_ptime =  date("H:i:s", strtotime("-$prop minutes".$dtime));

						$wc = '0';

					}

					else

					{

						$dtime = '00:00:00';

						$drp_ptime = '00:00:00';

						$wc = '1';

					}

					//----------------------------------------------------------------------------------//

					

					$drvid=$_POST['staff1'];

					$pckadd=$_POST['address1'];

					$drpaddr=$_POST['address2'];

					$trp_miles=$_POST['miles1'];

					$trp_remarks=sql_replace($_POST['remarks']);

					$veh_id = get_veh($_POST['staff1']);
					$pname = $_POST['consumer'];
					$phnum = $_POST['phone'];


					

					$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 

					                       

											trip_id 				=	 	'$trip_id',

											drv_id 				=		'$drvid',

											veh_id 				= 		'$veh_id',

											date					= 		'$date',

											pck_add 			= 		'$pckadd',

											pck_time 			= 		'$ptime',

											pck_ptime 		= 		'$pck_ptime',

											pck_atime 		= 		'',

											drp_add 			= 		'$drpaddr',

											drp_time 			= 		'$dtime',

											drp_ptime 		= 		'$drp_ptime',

											drp_atime 		= 		'',

											trip_miles 		= 		'$trp_miles',

											type 		= 		'1',

											wc 			= 		'$wc',

											status	=  '0',

											trip_remarks 	= 		\"".$trp_remarks."\"";

					if($db->execute($tQuery))

					{
						$tipid = $db->insert_id();					
					    if ($drvid!=''){
							$stf1=$drvid;
							$Query = "SELECT cell_num FROM drivers WHERE drv_code='$stf1'";
							if($db->query($Query) && $db->get_num_rows()){
								$udata = $db->fetch_all_assoc();
							}
							$num=$udata[0]['cell_num'];
							$sMyApiKey        = 'midnimomedtrans__13b1df9a';
							$sMyTextMarksUser = 'hybrid_dispatch';
							$sMyTextMarksPass = 'hybrid123';
							$sKeyword         = 'MIDNIMO';
							$sPhone           = $num;
							$tmapi = new TextMarksV2APIClient($sMyApiKey, $sMyTextMarksUser, $sMyTextMarksPass);
							$resp = $tmapi->call('GroupLeader', 'has_member', array(
							   'tm' => $sKeyword,
							   'user' => $sPhone
							));
							if($resp['body']['member'] == 1){
								$sMyApiKey        = 'midnimomedtrans__13b1df9a';
								$sMyTextMarksUser = 'hybrid_dispatch';
								$sMyTextMarksPass = 'hybrid123';
								$sKeyword         = 'MIDNIMO';
								$sPhone           = $num;
								$sMessage = "Tripid:$tipid\n-\nName:$pname\n-\nPh#$phnum\n-\nPick:$pckadd\n-\nDrop:$drpaddr\n-\nTime:$ptime\n-\nDate:$date";
								$tmapi = new TextMarksV2APIClient($sMyApiKey, $sMyTextMarksUser, $sMyTextMarksPass);
								$resp = $tmapi->call('GroupLeader', 'send_one_message', array(
								   'tm' => $sKeyword,
								   'msg' => $sMessage,
								   'to' => $sPhone
								));	
							}
						}					
					}

					

					if($_POST['address3']!='')

					{

						$prop = "10";

						

						 /*$qtime = $db->query('SELECT NOW() AS tym');

						 $get = $db->fetch_one_assoc();

						 $xp = explode(' ',$get['tym']);

						 $date = $xp[0];

						 $time=$xp[1];*/

						 $tdate = explode("/",$_POST['tdate']);

                    	 $date=date("Y-m-d",mktime(0,0,0,$tdate[0],$tdate[1],$tdate[2]));		

	 

	 					//---------------------- check for pick time ---------------------------------//

					if(isset($_POST['pu2']))

					{

						$ptime=$_POST['pu2'].':00';

						$pck_ptime = date("H:i:s", strtotime("+$prop minutes".$ptime));

						$wc = '0';

					}

					else

					{

						$ptime = '00:00:00';

						$pck_ptime = '00:00:00';

						$wc = '1';

					}

					//---------------------- check for drop time ---------------------------------//

					if(isset($_POST['dt2']))

					{

						$dtime= $_POST['dt2'].':00';

						$drp_ptime =  date("H:i:s", strtotime("+$prop minutes".$dtime));

						$wc = '0';

					}

					else

					{

						$dtime = '00:00:00';

						$drp_ptime = '00:00:00';

						$wc = '1';

					}

					//----------------------------------------------------------------------------------//

					

					

					/*	$ptime= $_POST['pu2'].':00';

						$pck_ptime = date("H:i:s", strtotime("+$prop minutes".$ptime));

						$dtime= $_POST['dt2'].':00';

						$drp_ptime =  date("H:i:s", strtotime("+$prop minutes".$dtime));

						//$date = date('Y-m-d',time());*/

						

						$drvid=$_POST['staff2'];

					    $pckadd=$_POST['address2'];

					    $drpaddr=$_POST['address3'];

					    $trp_miles=$_POST['miles2'];
						$veh_id = get_veh($_POST['staff2']);
						$pname = $_POST['consumer'];
						$phnum = $_POST['phone'];


						$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 

						                        

												trip_id 				=	 	'$trip_id',

												drv_id 				=		'$drvid',

												veh_id 				= 		'$veh_id',

												date					= 		'$date',

												pck_add 			= 		'$pckadd',

												pck_time 			= 		'$ptime',

												pck_ptime 		= 		'$pck_ptime',

												pck_atime 		= 		'',

												drp_add 			= 		' $drpaddr',

												drp_time 			= 		'$dtime',

												drp_ptime 		= 		'$drp_ptime',

												drp_atime 		= 		'',

												trip_miles 		= 		' $trp_miles',

												type 		= 		'2',

												wc 			= 		'$wc',

												status	=  '0',

												trip_remarks 	= 		\"".$trp_remarks."\"";

							

							if($db->execute($tQuery))

							{

							$tippid = $db->insert_id();					
							if ($drvid!=''){
								$stf2=$drvid;
								$Query = "SELECT cell_num FROM drivers WHERE drv_code='$stf2'";
								if($db->query($Query) && $db->get_num_rows()){
									$udata = $db->fetch_all_assoc();
								}
								$num=$udata[0]['cell_num'];
								$sMyApiKey        = 'midnimomedtrans__13b1df9a';
								$sMyTextMarksUser = 'hybrid_dispatch';
								$sMyTextMarksPass = 'hybrid123';
								$sKeyword         = 'MIDNIMO';
								$sPhone           = $num;
								$tmapi = new TextMarksV2APIClient($sMyApiKey, $sMyTextMarksUser, $sMyTextMarksPass);
								$resp = $tmapi->call('GroupLeader', 'has_member', array(
								   'tm' => $sKeyword,
								   'user' => $sPhone
								));
								if($resp['body']['member'] == 1){
									$sMyApiKey        = 'midnimomedtrans__13b1df9a';
									$sMyTextMarksUser = 'hybrid_dispatch';
									$sMyTextMarksPass = 'hybrid123';
									$sKeyword         = 'MIDNIMO';
									$sPhone           = $num;
									$sMessage = "Tripid:$tippid\n-\nName:$pname\n-\nPh#$phnum\n-\nPick:$pckadd\n-\nDrop:$drpaddr\n-\nTime:$ptime\n-\nDate:$date";
									$tmapi = new TextMarksV2APIClient($sMyApiKey, $sMyTextMarksUser, $sMyTextMarksPass);
									$resp = $tmapi->call('GroupLeader', 'send_one_message', array(
									   'tm' => $sKeyword,
									   'msg' => $sMessage,
									   'to' => $sPhone
									));	
								}
							}

							

							}

						 }

											

					}

	      //  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //

	





 //if page is submitted

    if(isset($_POST['addgrid']))

     {

		

		insert_request();

    insert_trip();

           echo "<script>";

			echo "alert('Addon added Successfully');";

			//echo "location.href='grid.php?id=".$id."'";

			echo "this.close();";	

			echo "</script>";

				exit;

		/*		 

		  if($db->execute($Query))

		    {

			 echo "<script>window.open('index.php?f=s','_parent');</script>"; 

			  }else{ 

				 $error .= 'Unable to add re-filling information.';

				 $smarty->assign("errors",$error);

				 $smarty->display('vehtpl/msg.tpl');

				 exit;

			 }

			 exit;*/

		    

     }

		

//GET DRIVERS LIST

	$db = new Database;	

	$db->connect();

	 $getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0'";

 		 if($db->query($getDriver) && $db->get_num_rows())

			  {

			  $driverdata = $db->fetch_all_assoc();

			  }		

 $getuser = "SELECT distinct(trip_user),trip_clinic  FROM trips ";

 	if($db->query($getuser) && $db->get_num_rows())

	{

		$userdata = $db->fetch_all_assoc();

	}



$getuser2 = "SELECT distinct(hospname)  FROM hospitals ORDER BY hospname ASC ";

 	if($db->query($getuser2) && $db->get_num_rows())

	{

		$userdata2 = $db->fetch_all_assoc();

	}

    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [ADD REQUEST]";

	$smarty->assign("pgTitle",$pgTitle);

		$smarty->assign("driverdata",$driverdata);

		$smarty->assign("userdata",$userdata);

		$smarty->assign("userdata2",$userdata2);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("id",$id);

	$smarty->assign("qty",$qty);

	$smarty->assign("amt",$amt);				

	$smarty->display('rpaneltpl/add_addon.tpl');

		

?>

		

