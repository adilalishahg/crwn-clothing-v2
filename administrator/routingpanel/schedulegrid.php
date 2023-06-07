<?php

   ini_set("display_errors","on");

error_reporting(E_ALL & ~E_NOTICE);

session_start();

  // 	include_once('../DBAccess/Database.inc.php');

	

// set up DB



$date=$_GET['dt'];

 $sheet_id=$_GET['sid'];





										

										$cond = " AND td.status IN ('1','4','6','5','2','0')";

										

										

										  

										  

									

										  

										  



$conn = mysql_connect("httglobal.db.3694931.hostedresource.com", "httglobal", "Hybrid123!");

mysql_select_db("httglobal");

include("../inc/jqgrid_dist.php");





$g = new jqgrid();

$grid["caption"] = "---- SCHEDULE TRIPS ----";

$g->set_options($grid);



$g->select_command = "SELECT   t.trip_code,t.trip_id, t.trip_user,  t.trip_clinic,td.pck_add,td.drp_add,td.pck_time,t.trip_date

										  FROM trips as t,  trip_details as td 

										  WHERE t.trip_id=td.trip_id AND t.trip_date='$date' AND t.sheet_id='$sheet_id' $cond";

						

// set database table for CRUD operations

$g->table = "trips";





$out = $g->render("list1");

     

	

//

//		// 	S E A R C H    C O D  E  ///

//			

//		if(isset($_POST))

//		{

//			$drv = $_POST['driver'];

//			$user = $_POST['user'];

//			$clinic = $_POST['clinic'];

//			//$sheet = $_POST['id'];

//			$whr = '';

//			

//			if ($drv!='')

//			{

//				$whr .=" AND td.drv_id = '$drv'";

//			}

//			if ($user!='')

//			{

//				$whr .=" AND t.trip_user LIKE '%$user%'";

//			}

//			if ($clinic!='')

//			{

//				$whr .=" AND t.trip_clinic LIKE '%$clinic%'";

//			}

//		}

//		// S E A R  C  H    C O D I T I O N   E N D  //

//		if(isset($_GET['id']))

//		{

//			$sheet = $_SESSION['sheet'] = $_GET['id'];

//		}

//		else

//		{

//			$sheet = $_SESSION['sheet'] ;

//		}

//		

//		

//		//$st=$_GET['st'];

//		

//		if($st =='' || $st == '5' )

//		{

//			$st=5;

//			$cond = " AND td.status IN ('6','5','2','0')";

//		}

//		else

//		{

//		   if($st == '4'){ $cond = " AND td.status IN ('1','4')"; }

//		   else{

//		       $cond = " AND td.status = '".$st."' "; 

//			}

//		}

//		

//		if($pg==''){

//		$Query = "SELECT t.sheet_id, td.veh_id,  t.trip_code, t.trip_id,  t.trip_user,  t.trip_clinic,  t.trip_date, 

//		  t.trip_tel, td.tdid, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime, 

//		  td.drp_add,  td.drp_time,  td.trip_miles,td.wc,   td.trip_remarks,  td.drv_id, td.status 

//		  FROM trips as t,  trip_details as td 

//		  WHERE t.trip_id=td.trip_id AND t.sheet_id=$sheet $cond $whr ORDER by td.pck_time ASC";

//		  }else{

//		  

//		  $today=date('Y-m-d');

//		  $Query = "SELECT t.sheet_id, td.veh_id,  t.trip_code, t.trip_id,  t.trip_user,  t.trip_clinic,  t.trip_date, 

//		  t.trip_tel, td.tdid, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime, 

//		  td.drp_add,  td.drp_time,  td.trip_miles,td.wc,   td.trip_remarks,  td.drv_id, td.status 

//		  FROM trips as t,  trip_details as td 

//		  WHERE t.trip_id=td.trip_id AND t.trip_date='$today' AND t.sheet_id=$sheet $cond $whr ORDER by td.pck_time ASC";

//		  

//		  

//		  }

//		  

//		 

//		  

//		// print($Query." >> ");

//			

//		if($db->query($Query) && $db->get_num_rows() > 0)

//		{

//			$trips = $db->fetch_all_assoc();

//		   for ($i = 0;$i<sizeof($trips);$i++)

//		   {

//			 $did = $trips[$i]['drv_id'];

//	

//				$drvQuery = "SELECT  fname, lname, drv_code,sip

//											FROM ".TBL_DRIVERS."

//											WHERE  drv_code = '$did'";

//				if($db->query($drvQuery) && $db->get_num_rows() > 0)

//				 {

//					 $drv = $db->fetch_row_assoc();

//					 $trips[$i]['driver'] = $drv['fname']." ".$drv['lname'];

//					  $trips[$i]['sip'] = $drv['sip'];

//				 }

//		   }

//		   for ($i = 0;$i<sizeof($trips);$i++)

//		   {

//			 $vid = $trips[$i]['veh_id'];

//	

//				$drvQuery2 = "SELECT gpsurl

//											FROM ".TBL_VEHICLES."

//											WHERE  id  = '$vid'";

//				if($db->query($drvQuery2) && $db->get_num_rows() > 0)

//				 {

//					 $vh = $db->fetch_row_assoc();

//					 $trips[$i]['gps'] = $vh['gpsurl'];

//				 }

//		   }

//	   

//		}

//	//debug($trips);  

//	$drvQuery = "SELECT  fname, lname, drv_code FROM ".TBL_DRIVERS." WHERE del = '0' and drvstatus !='Suspended'";

//	if($db->query($drvQuery) && $db->get_num_rows() > 0)

//		$drivers = $db->fetch_all_assoc();

//	

//	$getDriver = "SELECT * FROM ".TBL_DRIVERS." WHERE drvstatus='Active' AND del='0'";

// 	if($db->query($getDriver) && $db->get_num_rows())

//	{

//		$driverdata = $db->fetch_all_assoc();

//	}

//

//	$db->close();

//	$db2->close();

//    $pgTitle = "Admin Panel -- Routing Panel";

//	$smarty ->assign("id",$sheet);

//	$smarty ->assign("user",$user);

//	$smarty ->assign("clinic",$clinic);

//	$smarty ->assign("drv",$drv);

//	

//

//	

//	$smarty->assign("pgTitle",$pgTitle);

//	$smarty->assign("st",$st);

//	$smarty->assign("ad",$ad);

//	$smarty ->assign("drivers",$drivers);

//	$smarty->assign("driverdata",$driverdata);

//	$smarty->assign("msgs",$msgs);

//	$smarty->assign("NoRecord",$noRec);	

//	$smarty->assign_by_ref('membdetail',$trips);

//	$smarty->assign("paging",$paging);

//	

//	$smarty->display('rpaneltpl/schedulegrid.tpl');





?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.hybriditservices.com/demos/httglobal-2/w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html>

<head>

<title>Schedule Trips</title>

<link rel="stylesheet" type="text/css" media="screen" href="../js/themes/redmond/jquery-ui-1.8.2.custom.css"></link>	

	<link rel="stylesheet" type="text/css" media="screen" href="../js/jqgrid/css/ui.jqgrid.css"></link>	<link rel="stylesheet" href="../theme/style.css" type="text/css">

<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />

<link href="../theme/styles.css" rel="stylesheet" type="text/css">

	<link href="../facebox/facebox.css" rel="stylesheet" type="text/css">







	<script src="../js/jquery-1.4.2.min.js" type="text/javascript"></script>

	<script src="../js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>

	<script src="../js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	

	<script src="../js/themes/jquery-ui-1.8.2.custom.min.js"  type="text/javascript"></script>

	<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>

	<script>

	

	 $(document).ready(function($) {



			  $('a[rel*=facebox]').facebox({



				loading_image : 'loading.gif',



				close_image   : 'closelabel.gif'



			  }) 

	});

	</script>

</head>

<body>

<div id="wrapper_outer">

 

	<!-- start of inter container -->

    <div id="wrapper_inner">

        

        <!-- start of top banner -->

        <div id="banner">        	        	

<div class="banner_menu float_right">

            	<ul>

                	<li><a href="../routingpanel/index.php"><img src="../images/home.png" alt="" border="0" /></a></li>

                    <li><a rel="facebox" href="../routingpanel/scheduletrips.php"><img src="../images/calender.png" alt="" border="0" /></a></li>

                    

                </ul>

            </div>

            <!-- start of logo-->

            <div class="logo float_left">

				<img src="../images/logo.png" alt="" />

            </div><!-- end of logo-->

        </div> <!-- end of top banner -->



<div >

<!-- start of left side bar -->

             <!-- end of left side bar -->

		<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">



  <tr>



    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="outer_table1">



        <tr>



          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>



                <td><div style="width:100%;" align="center">

	<?php echo $out ?>

	</div></td>



              </tr>



            </table></td>



        </tr>



      </table></td>



  </tr>



</table>	

			

			

			

			

<div id="footer" align="left"><?php echo  $t=$_SESSION['footer']; ?><br />

      <a class="hybrid_link" href="http://www.hybriditservices.com/demos/httglobal-2/hybridTracktrans.com" target="_blank">A Product of Hybrid IT Services Inc. </a> </div><a href="http://www.hybriditservices.com/demos/httglobal-2/hybridTracktrans.com" target="_blank"/>

</div>

</div> <!-- end of body container -->

	<div class="margin_bottom_10"></div>        

    </div>

