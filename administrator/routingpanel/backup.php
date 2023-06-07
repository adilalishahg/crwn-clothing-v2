<?php
		
			include_once('../DBAccess/Database.inc.php');
			include_once('ExcellReader.php');
			
	
			
			$db = new Database;	
			$db2 = new Database;	
	
			$msgs   = '';
			$errors = '';
				
			$db->connect();
			$db2->connect();
		
							if($_POST){
						
							 $type = $_FILES['file_csv']['type']; 
						
						   if($_FILES['file_csv']['tmp_name'] != '' && ($type == 'application/octet-stream' || $type ==                       'application/vnd.ms-excel')){
						
						
							$target_path = "../routing-sheets/";
							 $f = str_replace(" ","",$_FILES['file_csv']['name']);
						
						
							$target_path1 = $target_path .time().'_'. basename($f); 
							
							$xplode = explode('/',$target_path1);
									 
							$file_name=$xplode[2];
						
						
							 
							 $adminname=$_SESSION['adminuser'];
							
								$Query= "Select * FROM ".TBL_ADMIN." WHERE admin_uname = '$adminname'";	
								if($db->query($Query) && $db->get_num_rows() > 0)
								{
								 $qadmin= $db->fetch_all_assoc();
								} 
								 $upload_by=$qadmin[0]['admin_id'];
								
								
								
									
							
									 
									  $start_time=date("y-m-d/H:i:s A ",strtotime("11:00:00 AM"));
							       
									 
							
									
									  $qtime = $db->query('SELECT NOW() AS tym');
									  $get = $db->fetch_one_assoc();
									  $xp = explode(' ',$get['tym']);
									  $time = $xp[1];
							  $curr=date("y-m-d/H:i:s A",strtotime($time)); 
			            
							    $date = date('y-m-d',time());
					            $time1 = date("H:i:s A",strtotime($time)); 
								$end=date("H:i:s A",strtotime("03:00:00 AM"));
								$tom = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
							
							     $tomor=date('y-m-d',$tom);
						      $tomorrow=$tomor."/".$end;
							
								if($curr <  $start_time || $curr >  $tomorrow ){
								
								 echo'<script>alert("Routing Sheet can upload only between (6PM-3AM)"); </script>';
								 echo '<script>location.href="index.php?csv=down";</script>';
								 exit;
								}
				
					
						
							
							
					$chk= "SELECT * FROM  " . TBL_SHEET . "  WHERE dated='$date' and dated ='$tomor' and timed ='$end'";
						
						if($db->query($chk) && $db->get_num_rows() > 0){
			           
			          echo "<script>alert('Routing Sheet uploading limit expires for current date');</script>";
			          echo "<script>window.open('index.php','_parent');</script>";
			          exit;
		              }
					  
					  
				     $chk2= "SELECT * FROM  " . TBL_SHEET . "  WHERE dated='$date' and dated !='$tomor' and timed !='$end'";
						
						if($db->query($chk2) && $db->get_num_rows() > 0){
			           
		                $sheet= $db->fetch_all_assoc();    		          
					    $sheet_id=$sheet[0]['sheet_id'];
						$row = 0;
						
						
									//  H E  R E   I  A M   R E A D I N G    E X C E L L    F I L E  //
										echo  $_FILES['file_csv']['tmp_name'];
										exit;
										$data = new Spreadsheet_Excel_Reader($_FILES['file_csv']['tmp_name']);
										debug($data);
										/*$handle = fopen($_FILES['file_csv']['tmp_name'], "r");
										$q = '';
										   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {    
											$num = count($data);  */
											  
										 if($row > 0) //if  # 1
										 {
										 
						
						                   $t1= "$data[4]";
											$prop_t1 = "10";
										
										   $prop = date("H:i:s A", strtotime("+$prop_t1 minutes".$t1));
										
											$t2= "$data[11]";
											$prop_t2 = "10";
										
											$prop2 = date("H:i:s A", strtotime("+$prop_t2 minutes".$t2));
											
											$trip1="$data[6]";
											$trip2="$data[12]";
											
											if($trip2=='')   // if # 2
											{
											
											$tripmiles=$trip1;
											}
											else
											{
											
											$tripmiles=$trip1+$trip2;
											} // end if # 2
					
					   
			          
		 $Query  = "UPDATE  " .TBL_SHEET. "  SET sheet_name='$file_name', dated='$date',timed='$time1',upload_by='$upload_by' WHERE dated='".$date."'";
		 
		 $Query1  = "UPDATE  " .TBL_TRIPS. "  SET sheet_id='$sheet_id', trip_user='$data[1]',trip_clinic='$data[0]',trip_tel='$data[2]',trip_date='$date',trip_miles='$trip_miles' WHERE trip_date='".$date."'";
		 
		 	$trip="SELECT * FROM  " . TBL_TRIPS . "  WHERE trip_date='$date' and sheet_id='$sheet_id'";
						if($db->query($trip) && $db->get_num_rows() > 0){
						$trips= $db->fetch_all_assoc();    		          
					    $trips_id=$trips[0]['trip_id'];
						
						}
						    
		 
		 for($i=0; $i<sizeof($trips); $i++){
		   $trp=$trips_id+$i;
	
	 $Query2  = "UPDATE  " .TBL_TRIP_DET. "  SET trip_id='$trips_id',drv_id='$data[7]',veh_id=  '',pck_add='$data[3]',pck_time='$data[4]',pck_ptime='$prop_t1',drp_add='$data[9]',drp_time='$data[5]',drp_ptime='',trip_miles='$data[6]',trip_remarks='$data[8]' where trip_id='".$trp."'";
	                 
					 if($data[14]!='')   
																					{
		  $Query2  = "UPDATE  " .TBL_TRIP_DET. "  SET trip_id='$trips_id',drv_id='$data[13]',veh_id=  '',pck_add='$data[9]',pck_time='$data[10]',pck_ptime='$prop_t1',drp_add='$data[14]',drp_time='$data[11]',drp_ptime='',trip_miles='$data[12]',trip_remarks='$data[8]' where trip_id='".$trp."'";
	               
		  
		        $q3=$db->execute($Query2);
					                   }
	               
				    $q=$db->execute($Query);
					$q1=$db->execute($Query1);
	                $q2=$db->execute($Query2);
	             }
	
		 
		 
		                   
							  
		
					
						  
							
						   
						                                } $row++;   
												 }
										  
											 fclose($handle);
											 if(move_uploaded_file($_FILES['file_csv']['tmp_name'], $target_path1)) {
										  echo '<script>alert("File Uploaded Successfully");</script>';
									   echo '<script>location.href="index.php?csv=up";</script>';
									   exit;
									  }
				           
					  
		             }else{
					
				
						
							 $import="INSERT into sheets(sheet_name,dated,timed,upload_by,status,remarks)                      		  values('$file_name','$date','$time1','$upload_by','','')";   
							
								$db->execute($import);
											
											$shid= mysql_insert_id();
									
								 
									
							
										$row = 0;
										$handle = fopen($_FILES['file_csv']['tmp_name'], "r");
										$q = '';
										   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {    
											$num = count($data);  
											  
										 if($row > 0) //if  # 1
										 {
										 
										
										   
											$t1= "$data[4]";
											$prop_t1 = "10";
										
										   $prop = date("H:i:s A", strtotime("+$prop_t1 minutes".$t1));
										
											$t2= "$data[11]";
											$prop_t2 = "10";
										
											$prop2 = date("H:i:s A", strtotime("+$prop_t2 minutes".$t2));
											
											$trip1="$data[6]";
											$trip2="$data[12]";
											
											if($trip2=='')   // if # 2
											{
											
											$tripmiles=$trip1;
											}
											else
											{
											
											$tripmiles=$trip1+$trip2;
											} // end if # 2
										//$date = date('Y-m-d',time());
										$import1="INSERT into trips(sheet_id,trip_user,trip_clinic,trip_tel,trip_date,trip_miles) values('$shid','$data[1]','$data[0]','$data[2]','$date','$tripmiles')";  
										
										
														if($db->execute($import1))  // if # 3
														{
															$tid= mysql_insert_id();
										
															$import2="INSERT into trip_details (
																								trip_id,
																								drv_id,
																								veh_id,
																								pck_add,
																								pck_time,
																								pck_ptime,
																								drp_add,
																								drp_time, 
																								drp_ptime,
																								trip_miles,
																								trip_remarks) 
																				values(
																					   '$tid',
																					   '$data[7]',
																					   '', 
																					   '$data[3]',
																					   '$data[4]',
																					   '',
																					   '$data[9]',
																					   '$data[5]',
																					   '',
																					   '$data[6]',
																					   '$data[8]')";  
																				if($db->execute($import2))   // if # 4
																				{
																					if($data[14]!='')   // if # 5
																					{
																						$import3="INSERT into trip_details (
																								trip_id,
																								drv_id,
																								veh_id,
																								pck_add,
																								pck_time,
																								pck_ptime,
																								drp_add,
																								drp_time, 
																								drp_ptime,
																								trip_miles,
																								trip_remarks) 
																				values(
																					   '$tid',
																					   '$data[13]',
																					   '', 
																					   '$data[9]',
																					   '$data[10]',
																					   '',
																					   '$data[14]',
																					   '$data[11]',
																					   '',
																					   '$data[12]',
																					   '$data[8]')";  
																					$db->execute($import3);
																					} // end if # 5
																				}// end if # 4
														$prop='';
														$prop2='';
														
														}
									
								 
													}  
												  $row++;   
												 }
										  
											 fclose($handle);
							
									   
									   if(move_uploaded_file($_FILES['file_csv']['tmp_name'], $target_path1)) {
										  echo '<script>alert("File Uploaded Successfully");</script>';
									   echo '<script>location.href="index.php?csv=up";</script>';
									   exit;
									  } else{
													  echo '<script>alert("File not uploaded ");</script>';
									   echo '<script>location.href="index.php?csv=down";</script>';
									   exit;
									}
									
								  }	
							  }
							
						//}	
						
						
			$db->close();
			$db2->close();
		
			$pgname  = "add-csv.php"; 
			$smarty->assign("pgTitle",'Add Routing CSV Sheet');
			$smarty->assign("pgname",$pgname);	
			$smarty->display('rpaneltpl/add_listing_csv.tpl');
?>
