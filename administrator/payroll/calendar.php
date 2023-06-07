<?php 

	$db = new Database;	
	$db->connect();

	$today = date("Y-m-d");
	$day = date("d");
	$month = date("m"); // Numeric month
	$current_month = date("F"); // Text month
	$year = date("Y");
	
	/*$events = "SELECT DAY(event_date) as day FROM events WHERE YEAR(event_date) = '".$year."' AND MONTH(event_date) = '".$month."'";
	if($db->query($events) && $db->get_num_rows())
	{
		$events = $db->fetch_all_assoc();
	}
	$event_arr = array();
	for($i=0;$i<count($events);$i++)
	{
		array_push($event_arr,$events[$i]['day']);
	}*/

	function get_first_day_of_current_month(){
		$currentTime         = time();
		$dateTime            = getdate($currentTime);
		$currentFullYear     = $dateTime["year"];
		$currentMonthNumeric = $dateTime["mon"];
		$firstDayOfTheMonth  = date('Y-m-d',mktime(0,0,0,$currentMonthNumeric,1,$currentFullYear));
	 
		$firstDayOfTheMonth = substr($firstDayOfTheMonth.PHP_EOL,8,2);
		return $firstDayOfTheMonth;
	}
	function get_last_day_of_current_month(){
		$currentTime         = time();
		$dateTime            = getdate($currentTime);
		$currentFullYear     = $dateTime["year"];
		$currentMonthNumeric = $dateTime["mon"];
		$lastDayOfTheMonth   = date('Y-m-d',mktime(0,0,0,$currentMonthNumeric + 1,0,$currentFullYear));
	 
		$lastDayOfTheMonth = substr($lastDayOfTheMonth .PHP_EOL,8,2);
		return $lastDayOfTheMonth;
	}
	$start_of_month = get_first_day_of_current_month();
	$end_of_month = get_last_day_of_current_month();
	
	
	$h = mktime(0, 0, 0, $month, $start_of_month, $year);
	$sd = date("D", $h);
	$h1 = mktime(0, 0, 0, $month, $end_of_month, $year);
	$ed = date("D", $h1);

	if($sd == "Mon")
		$prepend = 0;
	elseif($sd == "Tue")
		$prepend = 1;
	elseif($sd == "Wed")
		$prepend = 2;
	elseif($sd == "Thr")
		$prepend = 3;
	elseif($sd == "Fri")
		$prepend = 4;
	elseif($sd == "Sat")
		$prepend = 5;
	elseif($sd == "Sun")
		$prepend = 6;
	
	if($ed == "Mon")
		$append = 0;
	elseif($ed == "Tue")
		$append = 1;
	elseif($ed == "Wed")
		$append = 2;
	elseif($ed == "Thr")
		$append = 3;
	elseif($ed == "Fri")
		$append = 4;
	elseif($ed == "Sat")
		$append = 5;
	elseif($ed == "Sun")
		$append = 0;
		
	$tdays = $prepend + $end_of_month + $append;
	$j=0;

?>
<!--<link rel="stylesheet" href="style/master2.css" type="text/css" media="screen" charset="utf-8" />
<script src="scripts/jquery-1.3.min.js" type="text/javascript"> </script>
<script src="scripts/coda.js" type="text/javascript"> </script>-->
<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <thead>
    <tr>
      <td colspan="7" align="center"><?php echo $current_month." ".$year;?></td>
    </tr>
    <tr>
      <th class="th">Mon</th>
      <th class="th">Tue</th>
      <th class="th">Wed</th>
      <th class="th">Thu</th>
      <th class="th">Fri</th>
      <th class="th">Sat</th>
      <th class="th">Sun</th>
    </tr>
  </thead>
  <tbody>
  	<tr>
<?php
	$k = 0;
	$s = 1;	
	$kFlag1 = false;
	$kFlag2 = false;
	for($i=1;$i<=$tdays;$i++)
	{
		$k++;

		$has_events = "N";
		$ams = "N"; // Actual Month Started	
		$ame = "N"; // Actual Month End

		if($i > $prepend + $end_of_month)
			$ame = "Y";

		if($i > $prepend)
		{
			$ams = "Y";
			$j++;
		}
		
		$class = "_td";

		if($ame == "Y" || $ams == "N")
			$classm = " padding";
		else
			$classm = "";

		if($has_events == "Y")
			$class_event = " date_has_event";
		else
			$class_event = "";

		if($day == ($i - $prepend))
			$class_today = " today";
		else
			$class_today = "";
?>
    
		<td class="<?php echo $class.$classm.$class_event.$class_today; ?>" id="d-<?=$j;?>" align="center">
			<?php 
			if($j>0){ 
			   if($s%7 == 0){
			       echo $j; 				   
			   }else{
			      
				  if($j <= $day){				  
				   echo '<a href="javascript:pick('.$j.');">'.$j.'</a>'; 
				  }else{ echo $j; }
			   }
			} 
			?>
		</td>
<?php
           $s++;
		if(($k%7) == 0)
		echo "</tr><tr>";

	}
?>
	</tr>
  </tbody>
</table>
