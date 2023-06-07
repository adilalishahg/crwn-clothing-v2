<?php

	
require_once('../DBAccess/Database.inc.php');
	
	$db = new Database;	
	$db->connect();



				function calculate_trips($year,$month,$i){
				
								$db = new Database;	
								$db->connect();
								
								if(strlen($i)==1){
								
								$ia="0".$i;
								
								}else{
								
								$ia=$i;
								
								}
				
				
					
								 $date="$year-"."$month-"."$ia"; 
					 
				
								// $today= date('Y-m-d');
										$Querypg	="SELECT * FROM ".TBL_SHEET." where dated='$date' ";
										if($db->query($Querypg) && $db->get_num_rows() > 0)
										{
											$vehdetails = $db->fetch_all_assoc();
											$sheet_id=	$vehdetails[0]['sheet_id'];
										}
										
										if($sheet_id==''){
										
											$sheet_id = '0';
											
										}	
										//$st=5;
										
										$ad=0;
										
										$cond = " AND td.status IN ('1','4','6','5','2','0')";
										
										
										  
										  
										$Query2 = "SELECT t.sheet_id,  t.trip_code, t.trip_id,  t.trip_user,  t.trip_clinic,t.trip_miles,t.trip_date, 
										  t.trip_tel, td.tdid, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime, 
										  td.drp_add,  td.drp_time,td.wc,   td.trip_remarks,  td.drv_id, td.status 
										  FROM trips as t,  trip_details as td 
										  WHERE t.trip_id=td.trip_id AND t.trip_date='$date' AND t.sheet_id=$sheet_id $cond  ORDER by td.pck_time ASC";
										  
										   if($db->query($Query2) && $db->get_num_rows() > 0)
										{
										
										 $trips = $db->fetch_all_assoc(); 
										 
										}
								 $date="$year-"."$month-"."$ia"; 	
								
								$trip=$db->get_num_rows();
								
								
							    $sid=$trips[0]['sheet_id'];
								$trp['id']=$trips[$i]['trip_id'];
								if($trip ==0){
								$trp['title']="Schedule";
								}else{
								$trp['title']="Total Trips:$trip";
								}
								$trp['start']="$date";
								$trp['url']="schedulegrid.php?dt=$date&sid=$sid";
								
								return $trp;
				}
  
   
    	            $year = date('Y');
					$month = date('m');
					$day = date('d');
     
	  $num = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
       
	      $total = $num;

		  for ($i = 1;$i<=$num;$i++){
		  
		  
		 $data=calculate_trips($year,$month,$i);
		  
		   if($total == $i){
		   echo json_encode($data);
		   echo ']';
		   }else{
		   if($i == 1){ echo '['; }
		   echo json_encode($data).',';			   
			   }
		  }

         
		
	
	
				  
		 
	

		
		
//print_r($trips);
	$db->close();

    $smarty->assign("pgTitle",$pgTitle);
    $smarty->assign("pgName",$name);	
	$smarty->assign("HeadingTitle",$contentDetails[0]['contTitle']);	
	//$smarty->assign("content",$pgContent);	
	$smarty->assign("testi",$testi);
    $smarty->assign("seokeywords",$seokeywords);
	$smarty->assign('seodescription',$seodescription);	
	$smarty->assign("foot",$foot);	
	$smarty->assign("st",$st);
	$smarty->assign("ad",$ad);
	$smarty ->assign("drivers",$drivers);
    $smarty ->assign("total",$total);
	$smarty ->assign("date",$date);
	$smarty ->assign("duration",$duration);
	$smarty->assign_by_ref('membdetail',$trips);
	$smarty->assign_by_ref('req',$requests);
   // $smarty->display('rpaneltpl/scheduletrips.tpl');	

?>