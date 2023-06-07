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

	if(isset($_POST['submit']))

				{ 

					

					// PA G I N G   C O D E  //

					if(isset($_POST['pageNum']))

					{

						$page_no = $_POST['pageNum'];

					}

					else

					{

						$page_no = '1';	 

					}

					

					$limit = 10;

					$offset = (($page * $limit) - $limit);

					$maxRecord = 10; 

				

					$startdate = sql_replace($_POST['startdate']);

		            $enddate   = sql_replace($_POST['enddate']);

					if($startdate != '' && $enddate != ''){

            $whr= " r.reqdate BETWEEN '".convertDateToMySQL($startdate)." 00:00:00' AND '".convertDateToMySQL($enddate)." 23:59:59' AND";   		  

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



 $query = "SELECT f.appdate,f.cisid,f.clientname,f.reqstatus,f.charges,f.comments   FROM 

	               ".TBL_HOSPITALS." h, ".TBL_FORMS." f, ".TBL_REQUESTS." r  

				  WHERE $whr f.reqstatus = 'approved'  AND hic='1' AND r.reqid=f.req_id AND r.userid=h.id AND userid IN (".$glueids.")";



   

   }

			

			

			

					

					if($db->query($query) && $db->get_num_rows() > 0)

					{

						$data = $db->fetch_all_assoc();

					}

				

		

					 $numRows = $db->get_num_rows();

					

				   if($db->get_num_rows() > 0 ){	

					

					$filename = '../claim-sheets/'.time().'_Sheet.xls';

					$excel = new ExcelWriter($filename);

						

						$st = downloadXL($query, $filename,$db,$excel,convertDateFromMySQL($stdate));

						

						if($st){

			

							$url = '<strong>Claim Generated Sheet</strong><br>';	

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

				

				$myArr=array("claimid","D.O.S","AHCCCS ID#","PATIENT NAME","PAY TO","BILLED AMOUNT","TIN","STATUS","PAID AMOUNT");

				$excel->writeLineH1($myArr);

			

			

				

			

			/*		if($db->query($sql) && $db->get_num_rows() > 0){

						$rep = $db->fetch_all_assoc();	

					}*/

					

			   $db->query($sql);	

				

				$count = 1;

			while($row = $db->fetch_row_assoc()) { 

				$excel->writeRow();

				

				  $excel->writeCol($count);

				  $in = 0;

					foreach($row as $value) {                                             

						if ((!isset($value)) OR ($value == "")) { 

						  if($in == 5){

							 $excel->writeCol('711049837');  

							 }else{

						      $excel->writeCol("");

                             } 



                           $in++;



						} else { 

						

									 if($in == 3){ 

									  $excel->writeCol('AZ Secure Trans'); 	  

									

									 }elseif($in == 5){

									

									 $excel->writeCol('711049837');  

									 } 

									 elseif($in == 6){

									

									 $excel->writeCol('sdfsdf');  

									 } 

									 

									 else{

									  

										 $excel->writeCol($value);

									 } 	 

									 

									$in++; 

						} 

					} 

					$count++;

				} 	

				

				/*while($row = $db->fetch_row_assoc()) { 

				

				$excel->writeRow();

				 

				    $in = 0;

					foreach($row as $value) {                                             

						if ((!isset($value)) OR ($value == "")) { 

						  $excel->writeCol("");

						  $in++;

						} else { 

						  if($in == 3){ 

						   $excel->writeCol($xp1[0].'<br>'.$xp1[1]);	  

						

						  }else{

                          

                          if($in == 2){

                            //  $xp2 = explode("^",$value);

                              $excel->writeCol($xp2[0].'<br>'.$xp2[1]);	   

                             }  

                           elseif($in == 4){

                            //  $xp3 = explode("^",$value);

                              $excel->writeCol($xp3[0].'<br>'.$xp3[1]);	   

                             }   

                           elseif($in == 5){

                              //$xp4 = explode("^",$value);

                                $excel->writeCol('Midnimo Transportation');  

                             }            

							  elseif($in == 6){

                             // $xp4 = explode("^",$value);

                                $excel->writeCol('711049837');  

                             }        

							  elseif($in == 7){

                             // $xp4 = explode("^",$value);

                                $excel->writeCol('');  

                             }         

							 elseif($in == 9){

                             // $xp4 = explode("^",$value);

                                $excel->writeCol('');  

                             }                           

                           else{

						       $excel->writeCol($value);

                               }						  

						  }

						  $in++;

						} 

					} 

					$count++;

				} */

				

			

			

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

	

	

	$pgTitle = "Admin Panel -- Hospital/Clinic";

	$smarty->assign("pgTitle",$pgTitle);

	$smarty->assign("numRows",$numRows);		

	$smarty->assign('stdate',$startdate);

	$smarty->assign('enddate',$enddate);		

	$smarty->assign('url',$url);

	$smarty->assign('filename',$filename);			

	$smarty->display('reportstpl/claims.tpl');

	

?>