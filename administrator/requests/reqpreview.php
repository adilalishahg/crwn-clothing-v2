<?php


   	include_once('../DBAccess/Database.inc.php');

	

	$db = new Database;	

	$db->connect();

	

	 $id=$_GET['id'];

  $reqid=$_GET['reqid'];

  //GET REQUEST

 if(isset($_GET['id']) && $_GET['reqid']){

 

     if($_GET['id'] != '' && $_GET['reqid'] != ''){    



	$Query1 = "SELECT * FROM ".TBL_FORMS.",".TBL_REQUESTS." WHERE `id`='".$_GET['id']."' AND req_id='".$_GET['reqid']."' AND req_id=reqid";

	    if($db->query($Query1) && $db->get_num_rows() > 0)

	    {

          $RequestDetail = $db->fetch_all_assoc();

	     }

		 

		 

		 



	$Query2 = "SELECT * FROM ".TBL_REOCCURENCE." WHERE `info_id`='".$_GET['id']."' AND req_id='".$_GET['reqid']."'";

	    if($db->query($Query2) && $db->get_num_rows() > 0)

	    {

          $occurences = $db->fetch_all_assoc();       

	     }

//GET VEHICLE PREFERRENCE



  $qry_vehtype  = "SELECT * FROM " .  TBL_VEHTYPES ;

	if($db->query($qry_vehtype) && $db->get_num_rows() > 0){

		$vehiclepref = $db->fetch_all_assoc();

		

	 }

   /** END **/





      for($i=0; $i<sizeof($vehiclepref); $i++){

	     if($RequestDetail[0]['vehtype'] == $vehiclepref[$i]['id']){

		   $vehtype  = $vehiclepref[$i]['vehtype']; 

	     }

	   }



      if($vehtype == '0') { $vehtype  = 'Any'; }



      $triptype      = $RequestDetail[0]['triptype'];

      $clinic        = $RequestDetail[0]['hospname'];

      $pickaddress   = $RequestDetail[0]['pickaddr'];

	  $destination   = $RequestDetail[0]['destination'];

	

	if( $triptype =='OW'){

	

	$ttype='One Way';

	

	}else{

	

	$ttype='Round Trip';

	

	}

	

    

	$paddr=explode(',',$pickaddress);

	$daddr=explode(',',$destination);

	

	$pckaddr=$paddr[0];  

	$srpaddr=$daddr[0];  

	  

	  	

      $backto        = $RequestDetail[0]['backto'];

	  $appdate       = $RequestDetail[0]['appdate'];		  

      $apptime       = $RequestDetail[0]['apptime'];

	  $returnpickup  = $RequestDetail[0]['returnpickup'];	

      $casemanager1  = $RequestDetail[0]['casemanager'];

	  $todaydate     = $RequestDetail[0]['today_date'];	

       $pname          = $RequestDetail[0]['clientname'];

     $prog          = $RequestDetail[0]['prog'];

	  $phnum         = $RequestDetail[0]['phnum'];	

      $dob           = $RequestDetail[0]['dob'];

	  $cisid         = $RequestDetail[0]['cisid'];

	   $hic         = $RequestDetail[0]['hic'];		  		  

	  $ssn         = $RequestDetail[0]['ssn'];

	  $casemanager2  = $RequestDetail[0]['clientcasemanager'];		

	   $st         = $RequestDetail[0]['reqstatus'];

	   $phyname		= $RequestDetail[0]['fname'].' '.$RequestDetail[0]['lname'];

	   $phyClinic	= $RequestDetail[0]['clinic'];

	   $phyadd		= $RequestDetail[0]['phyaddress'];

	   $phyPhone	= $RequestDetail[0]['phyphone'];

	   $phyfax		= $RequestDetail[0]['phyfax'];

	   $phyreason	= $RequestDetail[0]['reason'];



	    

	  $comments      = $RequestDetail[0]['comments'];

      if($prog == '0'){ $prog = 'Behavioral Health'; }

      if($prog == '1'){ $prog = 'A.H.C.C.C.S'; }	 		  		



	 }   

  }
  $con = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($con) && $db->get_num_rows() > 0)
	{
	 $contact = $db->fetch_all_assoc();
		}

	//Close DB Connection	

	$db->close();



    $smarty->assign("pgTitle",$pgTitle);

    $smarty->assign("pgName",$name);	
	$smarty->assign("contact",$contact);
	

	$smarty->assign("pck",$pickaddress);

	$smarty->assign("drp",$destination);	

	

	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	

	$smarty->assign("content",$pgContent);	

    $smarty->assign("seokeywords",$seokeywords);

	$smarty->assign('seodescription',$seodescription);	

	$smarty->assign("msg",$msg);

	$smarty->assign("error",$error);

	$smarty->assign("clinic",$clinic);		

	$smarty->assign("prog",$prog);	

	$smarty->assign("ssn",$ssn);	

	$smarty->assign("vehtype",$vehtype);		

	$smarty->assign("triptype",$ttype);	

	$smarty->assign("occurences",$occurences);		

	$smarty->assign("pickaddress",$pickaddress);

	$smarty->assign("destination",$destination);	

	$smarty->assign("backto",$backto);

	$smarty->assign("appdate",$appdate);	

	$smarty->assign("apptime",$apptime);

	$smarty->assign("returnpickup",$returnpickup);	

	$smarty->assign("casemanager1",$casemanager1);

	$smarty->assign("todaydate",$todaydate);	

	$smarty->assign("pname",$pname);

	$smarty->assign("phnum",$phnum);	

	$smarty->assign("dob",$dob);

	$smarty->assign("cisid",$cisid);	

	$smarty->assign("casemanager2",$casemanager2);

	$smarty->assign("comments",$comments);	

	$smarty->assign("id",$id);

	$smarty->assign("reqid",$reqid);

	$smarty->assign("hic",$hic);	

	$smarty->assign("st",$st);	

	$smarty->assign("phyname",$phyname);

	$smarty->assign("phyclinic",$phyClinic);

	$smarty->assign("phyadd",$phyadd);

	$smarty->assign("phypnone",$phyPhone);

	$smarty->assign("phyfax",$phyfax);

	$smarty->assign("phyreason",$phyreason);

	

	$smarty->display('reqtpls/requestpreview.tpl');

?>