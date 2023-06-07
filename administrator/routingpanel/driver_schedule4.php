<?php include_once('../DBAccess/Database.inc.php');
	$db = new Database;	
    $db->connect();
	include_once('../include_file.php');
	if($today==''){$today = date('Y-m-d');}
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200">
<title></title>
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<link href="../theme/styles.css" rel="stylesheet" type="text/css">
<link href="theme/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8" />
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.tablednd_0_5.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.validationEngine-en.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.validationEngine.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/ui.datepicker.js"></script>

<script type="text/javascript"> 

$(document).ready(function()
{ 
$("#startdate").mask("9999-19-39");
$( "#startdate" ).datepicker({ minDate: -0, maxDate: "+3D" });
d = new Date();var rightPos = d.getHours()*120; //$('#slots').scrollLeft(rightPos); 

});


function changedate(val){ //alert(val); 
location.href="driver_schedule4.php?date="+val;
			return true;
}

</script>
<?php $minutes=((date('i'))+(date('H'))*60); 
// echo date('H:i');
?>
</head>
<body>
       <div id="top_menu" style="background-color:#06F;">
          <ul>
          	<li><a href="../index.php">HOME</a></li>
            <li><a href="../mercy/">ADD TRIP</a></li>
            <li><a href="../requests/">TRIP REQUESTS</a></li>
            <li><a href="../routingpanel/gridto.php" >DISPATCH</a></li>
            <li><a href="../routingpanel/futuretrips.php">CALENDAR</a></li>
            <li><a href="../routingpanel/nextdaygrid.php?st=9" >NEXT DAY</a></li>
            <li><a href="../routingpanel/futuretrips.php" >FUTURE SCHEDULE </a></li>
            <li><a href="../routingpanel/grid2.php?st=5" >PREVIOUS DAY</a></li>
            <li class="last"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong><span style="color:#FFF;">Select Date for Time Slot:</span></strong> <input type="text" name="startdate" id="startdate" value="<?php echo $today?>" class="inputTxtField date" onchange="changedate(this.value)" size="10" readonly="readonly"/></li>
            <li  class="last"><span id="clockbox" style="color:#FFF;"></span></li>
           </ul>         
</div>
		<style>
.time_td {font-size:10px; text-align:center; font-weight:bold; height:37px; width:120px; border: solid 1px #FFF; background-image:url(time_bg.png);}
.driver_td {font-size:12px; font-weight:bold; text-align:center;}
.schedule_td { background-image:url(bg_care.png); background-repeat:repeat-x;}
.schedule_div { border: solid 1px #00F;}
.schedule_div:hover {opacity: 0.6;  filter: alpha(opacity=40); cursor:pointer;  }


</style>
<div style="width:100%; border: solid 0px #00F;">
<div style=" float:left; width:11.3%; border: solid 0px #FF0;">
<table width="100%;" height="1500px;" border="1">
 <tr><td style="height:60px;"  class="driver_td">Time</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">12:00 AM</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">1:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">2:00 AM</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">3:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">4:00 AM</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">5:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">6:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">7:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">8:00 AM</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">9:00 AM</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">10:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">11:00 AM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">12:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">1:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">2:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">3:00 PM</td></tr>
 <tr> <td  style="height:60px;" class="driver_td">4:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">5:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">6:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">7:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">8:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">9:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">10:00 PM</td></tr>
  <tr> <td  style="height:60px;" class="driver_td">11:00 PM</td></tr>
  
</table>
</div>
<style>
/*.here:after {
    content:"";
    position: absolute;
    z-index: -1;
    top: 0;
    bottom: 0;
	width:2px;
    margin-left: <?php echo (2*$minutes); ?>px;
    border-left: 6px dotted #F00;
}*/
div {
  border:1px solid #333;
  position:relative;
}
.flash {
  -moz-animation: flash 2s ease-out;
  	-moz-animation-iteration-count: 10000;
  	-webkit-animation: flash 2s ease-out;
  	-webkit-animation-iteration-count: 10000;
  	-ms-animation: flash 2s ease-out;
  	-ms-animation-iteration-count: 10000;
  	animation: flash 2s ease-out;
  	animation-iteration-count: 10000;
}
@-webkit-keyframes flash {
    0% {   	background-color: none;      }
    30% {  	background-color: #000080;   }        
    100% { 	background-color: none;     } }
@-moz-keyframes flash {    
	0% {   	background-color: none;     }
    30% {  	background-color: #000080;    }    
    100% { 	background-color: none;     } }

@-ms-keyframes flash {
    0% {     	background-color: none;   }
    30% {     	background-color: #000080;    }        
    100% {    	background-color: none;    } }

.xyz:hover:before {
    content: attr(data-tooltip);
    position: absolute;
    padding: 5px 10px;
    margin: -80px 0 0 0px;
    background: orange;
    color: white;
    border-radius: 3px;
	z-index:100000;
	width:300px;
	
}
.xyz:hover:after {
    content: '';
    position: absolute;
    margin: 6px 0 0 3px;
	width: 0;
	height: 0;
	border-top: 5px solid transparent;
	border-right: 10px solid orange;
	border-bottom: 5px solid transparent;
}

</style>
<div class="here" id="slots" style=" float:right; width:88.6%; border: solid 0px #FF0; overflow:scroll;">
<?php
$getDriver2= "SELECT DISTINCT(td.drv_id),dr.fname,dr.lname,dr.day_phnum,dr.cell_num,dr.Drvid FROM trip_details as td, drivers as dr WHERE td.drv_id=dr.drv_code AND td.date ='".$today."' AND td.status NOT IN ('3','7','8') GROUP BY td.drv_id LIMIT 1000";
if($db->query($getDriver2) && $db->get_num_rows())
	{ $cnt = $db->get_num_rows();}else{$cnt=1;} ?>

<table  border="1" width="<?php echo $cnt*155;?>px">
  <tr>
 <?php  
 	if($db->query($getDriver2) && $db->get_num_rows())
	{ $driverdata = $db->fetch_all_assoc(); //print_r($driverdata);
	for($i=0; $i<sizeof($driverdata); $i++){
		$Qdvmap="SELECT veh_numplate FROM dv_mapping WHERE drv_id = '".$driverdata[$i]['Drvid']."'";
		if($db->query($Qdvmap) && $db->get_num_rows()){$dvmapdata = $db->fetch_one_assoc();}
		$drv_name= '<strong>'.$driverdata[$i]['fname'].' '.$driverdata[$i]['lname'].'</strong><br/><span style="font-size:10px;" >'.$driverdata[$i]['day_phnum'].'<br/>'.$dvmapdata['veh_numplate'].'</span>'; ?>
  <td height="60px" style="text-align:center; color:#666;" width="150px"><?php echo $drv_name?></td>
  <?php }}?>
  </tr>
  <tr>
   <?php
	for($i=0; $i<sizeof($driverdata); $i++){
	$drv_name= $driverdata[$i]['fname'].' '.$driverdata[$i]['lname'];
	$drv_code=$driverdata[$i]['drv_id'];
		?>
  <td height="1530px" width="370px" style="background-image:url(hrbg.png); vertical-align:top;"><div>
  <?php $gettrips = "SELECT tr.tdid,tr.status,tr.pck_add,tr.drp_add,tr.pck_time,tr.drp_time,t.trip_user,t.trip_tel,tr.trip_miles FROM ".trip_details." as tr LEFT JOIN trips as t on tr.trip_id=t.trip_id WHERE tr.drv_id ='".$drv_code."' AND tr.date ='".$today."' AND tr.status NOT IN ('3','7','8')  AND tr.wc = '0' ORDER BY tr.pck_time  ";
	if($db->query($gettrips) && $db->get_num_rows())
	{	$data = $db->fetch_all_assoc();		//print_r($data);
	for($j=0;$j<sizeof($data); $j++){ $ignor=0;
	switch($data[$j]['status']){
		case 1:  
		case 4: $color='008C00'; //Droped
		break;
		case 6: $color='FFC200'; //Picked
		break;
		case 5: 
		case 9:{ $color='0F6'; //pending //Red color
		if(date('Y-m-d')==$today){
					if(timetominutes(date('H:i:s')) > timetominutes($data[$j]['pck_time'])){ 
					$color='';
					  $flash = 1;
					}else{$flash = 0;}//9E6A51 chocolate //000080 //navy blue
		}else {$flash = 0;}}
		break;
		case 3: //#FF69B4  //Pink colour 
		case 7: 
		case 8: $color='0F6'; //not going
		break;
		default:$color='0F6'; //default color
		}
		$endPP=$endP='';
	$trip_user=$data[$j]['trip_user'];
	  $start=(timetominutes($data[$j]['pck_time'])-30);
	 $end=timetominutes($data[$j]['drp_time']);
	//if($j>0){$endP=timetominutes($data[$j-1]['drp_time']);}
	//if($j>1){$endPP=timetominutes($data[$j-2]['drp_time']);}
	//if($end<60){$end=($start+60);}
	$height=	($end-$start);
	
	 ?>
     <?php if($j>0){
		if($endPP > $endP){$diff=($endPP-$endP);}else{$diff=0;} 
		//$start=($start-$endP);?>
        
    <!--<div <?php if($flash==1){?> class="flash" <?php }?> style="float:left; height:10px; border-radius: 5px; border: #000 solid 1px; margin-left:<?php echo 2*((($start-1)-$endP)-$diff);?>px; margin-top:<?php echo 6.2*$j;?>px; position:relative; z-index:+<?php echo $j?>; width:<?php echo 2*$width;?>px;  
    background: -webkit-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
    background: -moz-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
  	background: -o-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
  	background: -ms-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
  	background: linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);"
     title="<?php echo $trip_user.' [ ETA: '.substr($data[$j]['pck_time'],0,5).' - '.$data[$j]['drp_time'].' ] [ P/U: '.$data[$j]['pck_add'].' D/O: '.$data[$j]['drp_add'].' ]'.' [ P/N: '.$data[$j]['trip_tel'].' ]';?> " ></div>--> 
     <?php }else{ ?>
    <!--<div <?php if($flash==1){?> class="flash" <?php }?> style="float:left;height:10px; border-radius: 5px; border: #000 solid 1px; margin-left:<?php echo 2*($start);?>px; width:<?php echo 2*$width;?>px;  position:relative; z-index:1;
    background: -webkit-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
    background: -moz-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
  	background: -o-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
  	background: -ms-linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px);
  	background: linear-gradient(left, #CCC 60px, #<?php echo $color?> <?php echo ($width-60)?>px); "
     title="<?php echo $trip_user.' [ ETA: '.substr($data[$j]['pck_time'],0,5).' - '.$data[$j]['drp_time'].' ] [ P/U: '.$data[$j]['pck_add'].' D/O: '.$data[$j]['drp_add'].' ]'.' [ P/N: '.$data[$j]['trip_tel'].' ]';?>" ></div>--> 
     <?php }?>
    <!-- <div  style=" background-color:#09F; height:60px; border-radius: 5px; border: #000 solid 1px; margin-top:60px; position:relative; width:100%;"  />
         <div  style=" background-color:#000000; height:60px; border-radius: 5px; border: #000 solid 1px; margin-top:60px; position:relative;  width:100%;"  />-->
<div class="xyz" data-tooltip="<?php echo $trip_user.'&#010; [ Miles: '.$data[$j]['trip_miles'].' ] [ P/U: '.$data[$j]['pck_add'].' D/O: '.$data[$j]['drp_add'].' ]'.' [ P/N: '.$data[$j]['trip_tel'].' ]';?>" style='top: <?php echo (0.0624*$start)+$start;?>px; position: absolute; width: 100%; height: <?php echo $height?>px; background-color:#03F; border:groove; border-color:#666;'></div>
   
    <?php  }} ?>
    
	<!--<div style='top: 100px; position: absolute; width: 116px; height: 60px;  background-color:#F0F0F0; border:none;'></div>-->
    </div></td>
  <?php }?>
  </tr>
  
</table>

</div>
</div>
<?php //print_r($data);//echo $flash; ?>
<?php function timetominutes($val){
	$part=explode(':',$val);
	return (($part[0]*60)+$part[1]);	
	}?>
</body>
</html>
<link href="../theme/flora.datepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
if(nyear<1000) nyear+=1900;
var d=new Date();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;
if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}
if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;
//document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+"   "+nhour+":"+nmin+":"+nsec+ap+"";
document.getElementById('clockbox').innerHTML=" "+nhour+":"+nmin+":"+nsec+ap+"";
}
window.onload=function(){
GetClock();
setInterval(GetClock,1000);
}
</script>