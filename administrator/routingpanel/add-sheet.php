<?php

		

include_once('../DBAccess/Database.inc.php');

include_once('ExcellReader.php');

			

$db = new Database;	

$db->connect();

$msgs   = '';

$errors = '';

// Get the Arizona time and Date
$time_data = get_server_time();
$time = $time_data[0];
$date = $time_data[1];
// ----------------------------------------------//

 /*$qtime = $db->query('SELECT NOW() AS tym');
 $get = $db->fetch_one_assoc();
 $xp = explode(' ',$get['tym']);
 $date = $xp[0];
 $time=$xp[1];		*/

//  F U N C T I O N     T O    I N  S E R T    S H E E T   I N     D A TA B A S E //

function insert_sheet($filename,$name)

{

	

	$db = new Database;	

	$db->connect();

	

/*$qtime = $db->query('SELECT NOW() AS tym');
$get = $db->fetch_one_assoc();
$xp = explode(' ',$get['tym']);
$date = $xp[0];
$time=$xp[1];		*/

// Get the Arizona time and Date
$time_data = get_server_time();
$time = $time_data[0];
$date = $time_data[1];

      global $dt;
	  $dt=$_POST['dt'];

			
			
			
			$date = $time_data[1];
			
		
	
// ----------------------------------------------//

 

$admin_id = $_SESSION['admuser']['admin_id'];                    						  						  





	$sQuery =  "SELECT sheet_id From ".TBL_SHEET." 

							WHERE dated='".$date."'";

							

	$uQuery = "UPDATE  " .TBL_SHEET. "  SET 

							sheet_name='$filename', 

							file_name='$name',

							dated='$date',

							timed='$time',

							blast = '0',

							upload_by='$admin_id' 

							WHERE dated='".$date."'";

							

	$iQuery = "INSERT INTO  " .TBL_SHEET. "  SET 

							sheet_name='$filename', 

							file_name='$name',

							dated='$date',

							timed='$time',

							blast = '0',

							upload_by='$admin_id' ";

	

	if($db->query($sQuery) && $db->get_num_rows() > 0)

	{

		$sheet= $db->fetch_row_assoc(); 

		$db->execute($uQuery);

		//if(delete_trips($sheet['sheet_id']))
//
//		{
//
//			return $sheet['sheet_id'];
//
//		}
         return $sheet['sheet_id'];
	}

	else

	{

		$db->execute($iQuery);

		return mysql_insert_id();

	}

}



//  F U N C T I O N     T O    DELETE TRIPS   I N     D A TA B A S E //

function delete_trips($sheet_id)

{

	$db = new Database;	

	$db->connect();

	$sQuery = "SELECT trip_id FROM ".TBL_TRIPS." 

							WHERE sheet_id = '$sheet_id'";

	if($db->query($sQuery) && $db->get_num_rows() > 0)

	{

		$trips =  $db->fetch_all_assoc(); 

	}

	

	$dQuery = "DELETE  FROM ".TBL_TRIPS." 

							WHERE sheet_id = '$sheet_id'";

	if($db->execute($dQuery))

	{

		for($t = 0;$t<sizeof($trips);$t++)

		{

			$trip_id = $trips[$t]['trip_id'];

			$dQuery = "DELETE FROM ".TBL_TRIP_DET." 

									WHERE trip_id = '$trip_id'";

			$db->execute($dQuery);

		}

		return true;

	}

	else

	{

		return false;

	}

	$db ->close();

}




////////////// DELETE SHEET /////////////////////
    function delete_sheet($sheet_id)

   {

	$db = new Database;	

	$db->connect();

	
	

	$dQuery = "DELETE  FROM ".TBL_SHEET." 

							WHERE sheet_id = '$sheet_id'";

	if($db->execute($dQuery))

	{

	
	}

	  else

	  {

		return false;

	   }

	  $db ->close();

     }
////////////// DELETE SHEET /////////////////////

//  F U N C T I O N     T O    G E T   BV E H I C L E    I D   F R O M     D A TA B A S E //

	function get_veh($drv)
{
	$db = new Database;	
	$db->connect();
	$dQuery = "SELECT dv.veh_id,dv.drv_id FROM ".TBL_DRIVERS."  d 
				INNER JOIN ".TBL_DVMAPPING." dv ON d.Drvid = dv.drv_id 
				INNER JOIN ".TBL_VEHICLES." v ON v.id = dv.veh_id WHERE d.drv_code='$drv'";
	
	$id = $db->executeScalar($dQuery);
	
	return $id;
}



function get_hinfo($hname){
	$db = new Database;	
	$db->connect();
	$dQuery = "SELECT CONCAT(firstname,' ',lastname) as name, email_address FROM ".TBL_HOSPITALS."  WHERE hospname='$hname'";
 	
	 if($db->query($dQuery) && $db->get_num_rows())
			  {
			  $tinfo = $db->fetch_all_assoc();
			  }	
	
	return $tinfo[0];
}


//  F U N C T I O N     T O    I N  S E R T     T R I PS     I N     D A TA B A S E //

function insert_trip($data,$sh_id)

{


	$db = new Database;	

	$db->connect();

		

	  
				 for($i=0;$i<sizeof($data);$i++){

		 if($data[14]=='RT' ){
			 
			   if($data[13]=='' ||  $data[12]=='' || $data[11]==''){
				   
			    delete_trips($sh_id);
				delete_sheet($sh_id);
	
							echo '<script>alert("For Round Trip Pick Time, Drop Time, Driver ID, Miles are required fields");</script>';
			
							echo '<script>location.href="index.php?csv=down";</script>';
			
							exit;
			             }
				   }
             }

				

		

		

						  

	/*$qtime = $db->query('SELECT NOW() AS tym');
	 $get = $db->fetch_one_assoc();
	 $xp = explode(' ',$get['tym']);
	 $date = $xp[0];
*/

// Get the Arizona time and Date
$time_data = get_server_time();
$time = $time_data[0];
$date = $time_data[1];
// ----------------------------------------------//
       $dt=$_POST['dt']; 

			if($dt==1){
			
			$da=mktime(0,0,0,date("m"),date("d")+1,date("Y"));
			$date=date("Y-m-d", $da);


			}else{
			
			$time_data = get_server_time();
			$time = $time_data[0];
			$date = $time_data[1];
			
			}
		
	
	//$sheet =  mysql_insert_id();
	$trip_code = $data[0];
	$clinic = $data[1];

	$user = $data[2];

	$tel = $data[3];

	$miles = $data[7] + $data[13];
    $hospinfo = get_hinfo($clinic);
	
	//$date = date('Y-m-d',time());

	$tQuery = "INSERT INTO ".TBL_TRIPS." SET 
	                        trip_code = '$trip_code',
							trip_clinic = '$clinic',
							trip_clinicemail = '".$hospinfo['email_address']."',
							trip_clinicowner = '".$hospinfo['name']."',							
							trip_user = '$user',
							trip_date = '$date',
							trip_tel = '$tel',
							sheet_id = '$sh_id',
							addon = '0',
							trip_miles = '$miles'";

	if($db->execute($tQuery))

	{

		insert_tdetail($data);

	}

	

	$db->close();

	

}

//  F U N C T I O N     T O    I N  S E R T     T R I PS    D E T A I L S     I N     D A TA B A S E //



function insert_tdetail($data)

{

	$db = new Database;	

	$db->connect();

	
//echo '<pre>';
//print_r($data);
//exit;


	

	 $trip_id = mysql_insert_id();

/*	 $qtime = $db->query('SELECT NOW() AS tym');
	 $get = $db->fetch_one_assoc();
	 $xp = explode(' ',$get['tym']);
	 $date = $xp[0];
	 $time=$xp[1];		*/

	// Get the Arizona time and Date
	$time_data = get_server_time();
	//$time = $data[0];
	$date = $time_data[1];
	// ----------------------------------------------//

			
			$date = $time_data[1];
			
			


	$prop = "10";



	$veh_id = get_veh($data[8]);


	
	if($data[5]=='W/C' || $data[5]=='' ||$data[5]=='O/W' )
		{
		
		   
		$ptime1= 'W/C';
		$pck_ptime1 = 'W/C';
		 $wc1 = 1;
		 
	
		
		}
		else
		{
			$ptime1= $data[5];
			$pck_ptime1 = date("H:i:s", strtotime("-$prop minutes".$ptime1));
			$wc1 = 0;
		}
		
		if($data[6]=='W/C' || $data[6]=='' || $data[6]=='O/W')
		{
			$dtime1= 'W/C';
			$drp_ptime1 =  'W/C';
			$wc1 = 1;
		}
		else
		{
			$dtime1= $data[6];
			$drp_ptime1 =  date("H:i:s", strtotime("-$prop minutes".$dtime1));
			$wc1 = 0;
		}

      
	$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 

							trip_id 				=	 	'$trip_id',

							drv_id 				=		'".$data[8]."',

							veh_id 				= 		'".get_veh($data[8])."',

							date					= 		'$date',

							pck_add 			= 		'".$data[4]."',

							pck_time 			= 		'$ptime1',

							pck_ptime 		= 		'$pck_ptime1',

							pck_atime 		= 		'',

							drp_add 			= 		'".$data[10]."',

							drp_time 			= 		'$dtime1',

							drp_ptime 		= 		'$drp_ptime1',

							drp_atime 		= 		'',

							trip_miles 		= 		'".$data[7]."',

							status = '5',
							
							wc 		= 		'$wc1',

							type 		= 		'1',

							trip_remarks 	= 		\"".$data[9]."\"";

	if($db->execute($tQuery))

	{

		

	}

	

if($data[14]=="RT")


	{

		$prop = "10";
		
		if($data[11]=='W/C' || $data[11]=='' ||$data[11]=='O/W' )
		{
			$ptime= 'W/C';
			$pck_ptime = 'W/C';
			$wc2 = 1;
		}
		else
		{
			$ptime= $data[11];
			$pck_ptime = date("H:i:s", strtotime("-$prop minutes".$ptime));
			$wc = 0;
		}
		
		if($data[12]=='W/C' || $data[12]=='' || $data[12]=='O/W')
		{
			$dtime= 'W/C';
			$drp_ptime =  'W/C';
			$wc = 1;
		}
		else
		{
			$dtime= $data[12];
			$drp_ptime =  date("H:i:s", strtotime("-$prop minutes".$dtime));
			$wc = 0;
		}
		

		$veh_id  = get_veh($data[14]);

		

		

		//$date = date('Y-m-d',time());

		$tQuery = " INSERT INTO ".TBL_TRIP_DET." SET 

								trip_id 				=	 	'$trip_id',

								drv_id 				=		'$data[13]',

								veh_id 				= 		'".get_veh($data[8])."',

								date					= 		'$date',

								pck_add 			= 		'$data[10]',

								pck_time 			= 		'$ptime',

								pck_ptime 		= 		'$pck_ptime',

								pck_atime 		= 		'',

								drp_add 			= 		'$data[4]',

								drp_time 			= 		'$dtime',

								drp_ptime 		= 		'$drp_ptime',

								drp_atime 		= 		'',

								trip_miles 		= 		'$data[7]',

								status = '5',

								type 		= 		'2',
									
								wc 		= 		'$wc',

								trip_remarks 	= 		\"".$data[9]."\"";

			

			if($db->execute($tQuery))

			{

			}

	}

							

}



//  M A I N    C O D E    O F    O P E  R A T I O N  //

if($_POST)

{

     /* echo $date;

	   echo $time;*/

	       
			

	         $currtime= $time;

	         $start_time= STIME;

			 $end_time= ETIME; 

if($currtime > $start_time && $currtime < end_time)

{

	 $type = $_FILES['file_csv']['type'];

	// debug($_FILES);

	  if(verify($_FILES['file_csv']['tmp_name'],"") || ($type == "application/vnd.ms-excel"))

	  {

		
		// $date = date('Y-m-d',time());

		$dir = "../routing-sheets/";

		 $f = str_replace(" ","",$_FILES['file_csv']['name']);

		$target_path = $dir .$date.'_'. basename($f); 

		 $xplode = explode('/',$target_path);

	

		$file_name=$xplode[2];



		  //debug($xplode);

		  $excel = new Spreadsheet_Excel_Reader($_FILES['file_csv']['tmp_name']);

		  $sheet = insert_sheet($file_name,$f);

		  if($sheet!= '' && $sheet >0)

		  {  
	  $data = $excel ->xlsToArray(true,true);

			  for($index = 0;$index<sizeof($data);$index++)

			  {

				   insert_trip($data[$index],$sheet);

			  }

		  }

		   if(move_uploaded_file($_FILES['file_csv']['tmp_name'], $target_path)) 

		   {

				echo '<script>alert("File Uploaded Successfully");</script>';

				echo '<script>location.href="index.php?csv=up";</script>';

				exit;

			} 

	  }	

	  else

	  {

		  echo "<script>alert('The Selected file is not supported!');</script>";

		   echo '<script>location.href="index.php";</script>';

	  }

   

  }//time check ends here	  

 /* else

  {

		echo'<script>alert("Routing Sheet can upload only between (6PM-3AM)"); </script>';

		echo '<script>location.href="index.php?csv=down";</script>';

		exit;

	}*/

	  

	  

	  

}

	

			$pgname  = "add-csv.php"; 

			$smarty->assign("pgTitle",'Add Routing CSV Sheet');

			$smarty->assign("pgname",$pgname);	

			$smarty->display('rpaneltpl/add_sheet.tpl');

?>

