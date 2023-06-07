<?php

   	/* *************************** *

	   * Date: 08-April-2010 

	   * Reports/rep_vmt3.php

	   * Abid Malik

	   *************************** */



   	include_once('../DBAccess/Database.inc.php');

    include('../Classes/pagination-class.php');	

    include('../Classes/excelwriter.inc.php');	

		

	$db = new Database;	

    $msgs = '';

	$noRec = '';

    $error = '';	

	$msgs .= $_GET['msg'];

	$db2 = new Database;	

    	

	$db->connect();

	$db2->connect();

	$numRows = '0';

	//  S E A R C H   C O D E   F O R   R E P O R T I N  G //

	if(isset($_GET['submit']))

				{ 

					

					// PA G I N G   C O D E  //

					if(isset($_GET['pageNum']))

					{

						$page_no = $_GET['pageNum'];

					}

					else

					{

						$page_no = '1';	 

					}

					

					$limit = 10;

					$offset = (($page * $limit) - $limit);

					$maxRecord = 10; 

				

					// E N D   P A  G I N  G   C O D E //

					$stdate = sql_replace($_GET['startdate']);

					

					if($stdate!= '')

					{

						$stdate = convertDateToMySQL($stdate);

						$whr = "f.appdate  BETWEEN '$stdate 00:00:00' AND '$stdate 23:59:59' AND";

					}

					

			

			

			

			// Fetch all categories list



$getUsers = "SELECT DISTINCT(".TBL_HOSPITALS.".id) FROM ".TBL_HOSPITALS.",".TBL_REQUESTS." 

             WHERE userid = ".TBL_HOSPITALS.".id AND `Status` = 'approved'";

   if($db->query($getUsers) && $db->get_num_rows() > 0)

	{

      $users = $db->fetch_all_assoc();

     }

$usersid = array();



for($i=0; $i<count($users); $i++){

    

	$gid =  $users[$i]['id'];

	array_push($usersid,"'".$gid."'"); 

}

$glueids = implode(',',$usersid);







/* $QueryCount = "SELECT COUNT(*) AS rows FROM 

	              ".TBL_HOSPITALS.", ".TBL_FORMS.", ".TBL_REQUESTS." 

				  WHERE reqstatus != 'inactive'  AND reqid=req_id AND userid=".TBL_HOSPITALS.".id AND userid IN (".$glueids.")"; */

   

if($glueids != ''){

/*

$query = "SELECT CONCAT(f.clientname,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',f.dob) as name,f.cisid,CONCAT(f.appdate,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',f.apptime) as time,h.hospname,CONCAT(f.pickaddr,' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ',f.phnum) as paddr,CONCAT(f.destination,' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ',f.phnum) as daddr,f.comments   FROM 

	              ".TBL_HOSPITALS." h, ".TBL_FORMS." f, ".TBL_REQUESTS." r  

				  WHERE $whr f.reqstatus = 'approved'  AND r.reqid=f.req_id AND r.userid=h.id AND userid IN (".$glueids.")";

*/



$query = "SELECT CONCAT(f.clientname,'^',f.dob) as name,f.cisid,CONCAT(f.appdate,'^',f.apptime) as time,h.hospname,CONCAT(f.pickaddr,'^',f.phnum) as paddr,CONCAT(f.destination,'^',f.phnum) as daddr,f.comments,CONCAT(f.fname,'^',f.lname,'^',f.phyaddress) as phyaddr,f.phyaddress FROM 

	              ".TBL_HOSPITALS." h, ".TBL_FORMS." f, ".TBL_REQUESTS." r  

				  WHERE $whr f.reqstatus = 'active'  AND r.reqid=f.req_id AND r.userid=h.id AND userid IN (".$glueids.")";



   

   }

			

			

			

					

					if($db->query($query) && $db->get_num_rows() > 0)

					{

						$data = $db->fetch_all_assoc();						

					}	
					
					 $numRows = $db->get_num_rows();

					

				   if($db->get_num_rows() > 0 ){	

					

					$filename = '../trip-sheets/'.time().'_Sheet.xls';

					$excel = new ExcelWriter($filename);

						

						$st = downloadXL($query, $filename,$db,$excel,convertDateFromMySQL($stdate));

						

						if($st){

			

							$url = '<strong>Trips Generated Sheet</strong><br>';	

						}else{

							$url = '';				

						}

						

					}

					

				}

	

	

				



			function downloadXL($sql, $filename,$db,$excel,$date){

			$excel->GetHeader();

				if($excel==false)	

					echo $excel->error;

			

			//	$myArr=array("MT - MASS","TRANSPORTATION REQUEST","","","","","");

			//	$excel->writeLineH1($myArr);	

				

				

			//	$myArr=array("","","","","","","","");

			//	$excel->writeLine($myArr);	

				

				$myArr=array("Please fax Multiple Transportation Requests (MTR's) at least 48 hours prior to the member's appointments to (602) 351-2313. Mercy Care Plan will verify patient eligibility and return a confirmation to your office by 10:00 a.m. the day before the appointment.  Be sure to leave your fax machine on overnight. All trips are considered as Round-Trip, and all pickup times will be 1 hour before the scheduled appointment time unless otherwise specified. Number of passengers will be 1 unless otherwise requested. ");

				$excel->writeLineH1($myArr);		

			   

			 

			

				$myArr=array("","","","","","","");

				$excel->writeLine($myArr);

				

				$myArr=array("Requested By:","Mohamed Ali","","","","Today's Date:","________________");

				$excel->writeLineH1($myArr);	

				

				

				$myArr=array("","","","","","","","");

				$excel->writeLine($myArr);

				

			 

			    $myArr=array("Company Name:","Midnimo Transportation","","","","Sender Phone:","602-273-7000");

				$excel->writeLineH1($myArr);	

			

			    $myArr=array("","","","","","","","");

				$excel->writeLine($myArr);

				

				

				$myArr=array("","","","","","Sender Fax:","602-273-7003");

				$excel->writeLineH1($myArr);	

				

				

			

				$myArr=array("MEMBER NAME&DOB","MERCY ID#","APPT DATE&TIME","PROVIDER NAME","PICKUP ADDRESS/PHONE","DESTINATION ADDRESS/PHONE","NOTES");

				$excel->writeLineH1($myArr);

			

			

				

			

			/*		if($db->query($sql) && $db->get_num_rows() > 0){

						$rep = $db->fetch_all_assoc();	

					}*/

					

			   $db->query($sql);			
			   $count = 1;	

				while($row = $db->fetch_row_assoc()) { 
				
				$padd = $row['phyaddress'];
				if($padd != '')
					$row['daddr'] = $row['phyaddr'];

				$excel->writeRow();

				 

				    $in = 0;

					foreach($row as $value) {                                             

						if ((!isset($value)) OR ($value == "")) { 

						  $excel->writeCol("");

						  $in++;

						} else { 

						  if($in == 3){ 

						  $excel->writeCol('Midnimo Transportation');

						  }else{

                           if($in == 0){

                              $xp1 = explode("^",$value);

                              $excel->writeCol($xp1[0].'<br>'.$xp1[1]);	   

                             }

                           elseif($in == 2){

                              $xp2 = explode("^",$value);

                              $excel->writeCol($xp2[0].'<br>'.$xp2[1]);	   

                             }  

                           elseif($in == 4){

                              $xp3 = explode("^",$value);

                              $excel->writeCol($xp3[0].'<br>'.$xp3[1]);	   

                             }   

                           elseif($in == 5){

                              $xp4 = explode("^",$value);
							  
							  if($padd != '')
							  	$pcol = $xp4[0].' '.$xp4[1].'<br>ADDR: '.$xp4[2].'<br>TEL: '.$xp4[3];                        	   
							  else
							  	$pcol = $xp4[0].'<br>'.$xp4[1];
							  $excel->writeCol($pcol);
                          }                           

                           else{

						       $excel->writeCol($value);

                               }						  

						  }

						  $in++;

						} 

					} 

					$count++;

				} 

				

			

			

				//$myArr=array("","","","","","","","");

//				$excel->writeLine($myArr);

//				

//				$myArr=array("","","","","Completed by:____________","Date:____________","Time:____________");

//				$excel->writeLineH1($myArr);;

//				

				$excel->GetFooter();

				$excel->close();

				return true;	

			

					

			

				exit;

			}





	$db->close();

	$db2->close();

	

	$stdate = convertDateFromMySQL($stdate);

	$enddate = convertDateFromMySQL($enddate);

	

	$pgTitle = "Admin Panel -- Hospital/Clinic";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("numRows",$numRows);		

	$smarty->assign('stdate',$stdate);		

	$smarty->assign('url',$url);

	$smarty->assign('filename',$filename);			

	$smarty->display('reportstpl/genrep1.tpl');

	

?>