<?php



   	



   	include_once('../DBAccess/Database.inc.php');

	



		$db = new Database;	

		

	$msgs   = '';

	$errors = '';

	$db->connect();

   $id=$_REQUEST['id'];

	

	$idQuery = "SELECT trip_id FROM  ".TBL_TRIP_DET." where tdid = '$id'";

	if($db->query($idQuery) && $db->get_num_rows())

	 {

			  $get_id  = $db->fetch_row_assoc();

	}

	$t_id =  $get_id['trip_id'];





	 



	 

	  $Query = "SELECT * FROM attendance a, drivers d  where a.id= '$id' and a.drv_id=d.Drvid";

						

				if($db->query($Query) && $db->get_num_rows())

			  {

			  $udata = $db->fetch_all_assoc();

			  }

	  $Query2 = "SELECT * FROM rating r,trip_details td 

						WHERE  td.tdid='$id'";

						

				if($db->query($Query2) && $db->get_num_rows())

			  {

			  $udata2 = $db->fetch_all_assoc();

			  }		  

	           

			//debug($udata);

             /* $trip_status=$udata[0]['status']; 

			  $trip_id=$udata[0]['trip_id']; 

			   $cname=$udata[0]['trip_user'];

			   $clinic=$udata[0]['trip_clinic'];

			    $phone=$udata[0]['trip_tel'];

				 $addr1=$udata[0]['pck_add'];

				  $addr2=$udata[0]['drp_add'];

	              $ptime=$udata[0]['pck_time'];

				   $dtime=$udata[0]['drp_time'];

				    $m1=$udata[0]['trip_miles']; 

					 $staff1=$udata[0]['drv_id'];

					  $remarks=$udata[0]['trip_remarks'];*/

					  

		 $date=convertDateFROMMySQL($udata[0]['date']);

		 	  

         $timein= $udata[0]['time_in'];

		 $timeout= $udata[0]['time_out'];

	

		 if($timeout !=''){

		 

	  $thr=$timeout-$timein;

		 

		 }
$con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0)
	{
	 $contact = $db->fetch_all_assoc();
		}		

	$db->close();



    $pgTitle = "Admin Panel -- VEHICLE MANAGMENT [ADD REQUEST]";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("msgs",$msgs);

	$smarty->assign("errors",$error);

	$smarty->assign("id",$id);

		$smarty->assign("thr",$thr);

		$smarty->assign("date",$date);

	

    $smarty->assign("data",$udata);

	$smarty->assign("data2",$udata2);

	$smarty->assign("contact",$contact);

	/*$smarty->assign("cname",$cname);

	$smarty->assign("clinic",$clinic);

	$smarty->assign("phone",$phone);

	$smarty->assign("addr1",$addr1);

		$smarty->assign("addr2",$addr2);

	$smarty->assign("ptime",$ptime);

	$smarty->assign("dtime",$dtime);

	$smarty->assign("m1",$m1);

	$smarty->assign("staff1",$staff1);

	$smarty->assign("remarks",$remarks);*/

	

	$smarty->assign("qty",$qty);

	$smarty->assign("amt",$amt);				

	$smarty->display('atdncetpl/details.tpl');

		

?>