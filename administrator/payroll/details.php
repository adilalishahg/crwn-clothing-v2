<?php
  	include_once('../DBAccess/Database.inc.php');
	
	$db = new Database;	
	$db->connect();	
	
	$db3 = new Database;	
	$db3->connect();		
	$msgs   = '';
	$errors = '';

 
  if(isset($_POST['category']) && $_POST['category'] != ''){
    
	   //POSTED VARIABLES
	   $category = sql_replace($_POST['category']);
	   $employee = sql_replace($_POST['emplist']); 
	   $Wchoice  = sql_replace($_POST['wchoice']);
	   $Cdate    = sql_replace($_POST['cur']);
       $dhalf    = sql_replace($_POST['dhalf']); 
       $payrate  = $_POST['payrate'];
	   $totHours  = sql_replace($_POST['totalhours']);
	   $totSalary = ($payrate*$totHours);	   
	   //From date
	  $from_date = convertDateFromMySQL($dhalf.$Cdate);
	   
	   //To date
	   if($Wchoice == 'monthly'){	   
       $to_date = date("m/d/Y",strtotime(date("m/d/Y", strtotime($from_date)) . " +1 month"));
	   }elseif($Wchoice == 'bi-weekly'){
         $to_date = date("m/d/Y",strtotime(date("m/d/Y", strtotime($from_date)) . " +2 week"));
	   }else{
	       $to_date = date("m/d/Y",strtotime(date("m/d/Y", strtotime($from_date)) . " +1 week"));
	   }
 
       //Get Staff/Driver Information
       if($category == '1'){
            $query ="SELECT fname,lname,drv_code AS code FROM ".TBL_DRIVERS."
			         WHERE Drvid = '".$employee."'";
			
		   }else{
		    $query = "SELECT fname,lname,drv_code AS code FROM ".TBL_STAFF." 
			          WHERE Drvid='".$employee."'";	   
	    }
   
		if($db3->query($query) && $db3->get_num_rows() > 0){
				$chk = $db3->fetch_all_assoc();
		}

	    //Name
        $fname = $chk['0']['fname'];
		$lname = $chk['0']['lname'];
		$code  = $chk['0']['code']; 
   
   //Get Payroll
    
	if($Wchoice == 'weekly'){
	   $query = "SELECT  date,Date_format(date,'%W') as day, time_format(TimeDiff(time_out,time_in), '%H:%i') as duration,time_in,time_out,smilage,emilage FROM ".TBL_ATNDS." WHERE drv_id='".$employee."' AND date BETWEEN '".$dhalf.$Cdate."' AND DATE_ADD('".$dhalf.$Cdate."', INTERVAL 8 DAY)";
	}
	if($Wchoice == 'bi-weekly'){
	    $query ="SELECT date,Date_format(date,'%W') as day, time_format(TimeDiff(time_out,time_in), '%H:%i') as duration ,time_in,time_out,smilage,emilage FROM ".TBL_ATNDS." WHERE drv_id='".$employee."' AND  date BETWEEN '".$dhalf.$Cdate."' AND DATE_ADD('".$dhalf.$Cdate."', INTERVAL 16 DAY)";
	}
	if($Wchoice == 'monthly'){
	    $query ="SELECT date,Date_format(date,'%W') as day, time_format(TimeDiff(time_out,time_in), '%H:%i') as duration ,time_in,time_out,smilage,emilage  FROM ".TBL_ATNDS." WHERE drv_id='".$employee."' AND  date BETWEEN '".$dhalf.$Cdate."' AND DATE_ADD('".$dhalf.$Cdate."', INTERVAL 34 DAY)";
	}	

	if($db3->query($query) && $db3->get_num_rows() > 0){
		$pay = $db3->fetch_all_assoc();
	 }

  }else{
	  echo 'Invalid Access';
	  exit;
	  }
 


	$db->close();
	$db3->close();

    $pgTitle = "Admin Panel -- Payroll Detail";
	$smarty->assign("pgTitle",$pgTitle);
	$smarty->assign("msgs",$msgs);
	$smarty->assign("errors",$error);
	$smarty->assign("atype",$category);	
	$smarty->assign("fname",$fname);
	$smarty->assign("lname",$lname);
    $smarty->assign("Wchoice",$Wchoice);
	$smarty->assign("totSalary",$totSalary);
	$smarty->assign("totHours",$totHours);
	$smarty->assign("to_date",$to_date);
	$smarty->assign("from_date",$from_date);
	$smarty->assign("pay",$pay);	
	$smarty->assign("code",$code);	
	$smarty->assign("payrate",$payrate);								
	$smarty->display('payrolltpl/details.tpl');
		
?>