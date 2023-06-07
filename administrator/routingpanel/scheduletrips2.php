<?php
require_once('../DBAccess/Database.inc.php');
	$db = new Database;	
	$db->connect();
				function calculate_trips($date,$db){
											$sheet_id = '0';
										$ad=0;
										$cond = " AND td.status IN ('1','4','6','5','2','0')";
										$Query2 = "SELECT t.sheet_id,  t.trip_code, t.trip_id,  t.trip_user,  t.trip_clinic,t.trip_miles,t.trip_date, t.trip_tel, td.tdid, td.type, td.pck_add,td.aptime,td.pck_time,td.aptime, td.drp_atime, td.drp_add,  td.drp_time,td.wc,   td.trip_remarks,  td.drv_id, td.status, CONCAT(dr.fname,' ',dr.lname,'--',dr.drv_code) AS driver 

FROM trips as t INNER JOIN trip_details as td ON t.trip_id=td.trip_id LEFT JOIN drivers as dr ON td.drv_id = dr.drv_code WHERE t.trip_date='$date' ORDER by td.pck_time ASC";

										  

										   if($db->query($Query2) && $db->get_num_rows() > 0)

										{

										

										 $trips = $db->fetch_all_assoc(); 

										 

										}

								 //$date="$year-"."$month-"."$ia"; 	

								

								$trip=$db->get_num_rows();

								

								

							    $sid=$trips[0]['sheet_id'];

								$trp['id']=$trips[$i]['trip_id'];

								if($trip ==0){

								$trp['title']="Trips:".""."$trip";

								}else{

								$trp['title']="Trips:$trip";

								}

								$trp['start']="$date";

								$trp['url']="../grid/index.php?dt=$date&sid=$sid";

								

								return $trp;

				}

         
$num=15;
	      $total = $num;



		  for ($i = 1;$i<=$num;$i++){

		  

		  

		 $data=calculate_trips(date("Y-m-d",strtotime("+".($i-1)." day")),$db);

		  

		   if($total == $i){

		   echo json_encode($data);

		   echo ']';

		   }else{

		   if($i == 1){ echo '['; }

		   echo json_encode($data).',';			   

			   }

		  }

	$db->close();
?>