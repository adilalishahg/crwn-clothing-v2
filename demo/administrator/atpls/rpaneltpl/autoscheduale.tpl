{ include file = header_buzzer3.tpl}
{literal} 
<script src="../scripts/jquery.min.1.10.2.js"></script>
<script type="text/javascript">
var noftrips = '{/literal}{$tot_unassign_trips}{literal}';
var av_drv	 = '{/literal}{$tot_availble_drivers}{literal}';
var date	 = '{/literal}{$date}{literal}';
$(document).ready(function() {  });
function recursMe(param,ending) { //alert(ending);
$("#rotator").rotator({
starting: 0,
ending: ending,
percentage: true,
color: 'green',
lineWidth: 30,
timer: 0,
radius: 150,
fontStyle: 'Calibri',
fontSize: '20pt',
fontColor: 'white',
backgroundColor: 'lightgray'});	
$('#auto').hide();
$('#wait').show();
var nu = 1;
var UsmaniaA;
$.post("doautoscheduale.php", {noftrips: ""+nu,date: ""+date}, function(data){ 		//alert(data);
		 if(data.length > 0 ){ UsmaniaA = data.split('^'); 
		  $("#tat").html(UsmaniaA[1]); $("#tat2").html(UsmaniaA[1]);
		  $("#tut").html(UsmaniaA[2]); $("#tut2").html(UsmaniaA[2]);
		  $("#tot").html(UsmaniaA[4]); $("#tot2").html(UsmaniaA[4]);
		  
		 if(UsmaniaA[5]>0){ $('#auto').show(); $('#wait').hide(); location.reload(); return false; } else{ setTimeout("recursMe(1,"+UsmaniaA[3]+")", 100); }
		  	}else{ $('#auto').show(); $('#wait').hide(); }});
    } 
function autoSCH(){ //alert('Under-Construction'); return false;
$('#auto').hide();
$('#wait').show();
countdown();
if(noftrips > 0){ 
	 $.post("doautoscheduale.php", {noftrips: ""+noftrips,date: ""+date}, function(data){
		 if(data.length > 0 ){  
		 
		 // alert(data); return false;
			 if(data == 1){ location.reload();
			 $('#auto').show();
			 $('#wait').hide();  
			  }
			 else{
			 $('#auto').show();
			 $('#wait').hide();
			 alert('Please check drivers are present! OR Trips define pick time?');
			 location.reload();
			   }
			 }
			}); }else {  
			$('#auto').show();
			$('#wait').hide(); alert('There is now new trip OR All trips are assigned already.');  }
			}
function autoSCHbusy(){
$('#auto').hide();
$('#wait').show();
countdown();
if(noftrips > 0){ //alert('one');
	 $.post("doautoscheduale_busyday.php", {noftrips: ""+noftrips}, function(data){
		 if(data.length > 0 ){  
			 if(data == 1){ location.reload();
			 $('#auto').show();
			 $('#wait').hide();  
			  }
			 else{
			 $('#auto').show();
			 $('#wait').hide();
			 alert('Please check drivers are present! OR Trips define pick time?');
			 location.reload();
			   }
			 }
			}); }else {  
			$('#auto').show();
			$('#wait').hide(); alert('There is now new trip OR All trips are assigned already.');  }
			}	
function popWind78(url){
 myWindow = window.open( url, "myWindow", 
"status = 1, height = 1000, width = 1000, scrollbars=1, resizable = 1" );
   myWindow.moveTo(0,0);
   }
					
</script> 
<style type="text/css" >
.btn_bg2{ margin: 10px auto 10px 2%; font-family:Verdana, Geneva, sans-serif; background: #000; text-align:center; padding-bottom:15px; padding-left:30px; padding-right:30px; padding-top:15px; color: #fff; font-size:20px; font-weight:bold; border:1px solid white; cursor:pointer; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; text-decoration: none;}
.btn_bg2 a{ color:#FFF; text-decoration:none;}

.btn_main{width:800px; margin:auto;}
.btn_bg1{float: left; margin: 0px auto 0px 2%; font-family:Verdana, Geneva, sans-serif; text-align:center; padding-bottom:1px; padding-left:0px; padding-right:0px; padding-top:10px; color: #fff; font-size:20px; font-weight:bold; border:1px solid white; cursor:pointer; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; text-decoration: none;}
.btn_bg{float: left; margin: 10px auto 10px 2%; font-family:Verdana, Geneva, sans-serif; background: #000; text-align:center; padding-bottom:15px; padding-left:30px; padding-right:30px; padding-top:15px; color: #fff; font-size:20px; font-weight:bold; border:1px solid white; cursor:pointer; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px; text-decoration: none;}
.btn_bg a{ color:#FFF; text-decoration:none;}
.btn_bg_sec a{ color:#FFF; text-decoration:none;}
.btn_bg_sec{float: left; margin: 10px auto 10px 2%; font-family:Verdana, Geneva, sans-serif; background: #000; text-align:center; padding-bottom:15px; padding-left:30px; padding-right:30px; padding-top:15px; color: #fff; font-size:20px; font-weight:bold; border:1px solid white; cursor:pointer; border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px; text-decoration: none; margin-left:10px;}
.driver_head{width:209; float:left; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#000; padding-left:5px; padding-right:5px; font-weight:bold; padding-bottom:5px; padding-top:5px;}
.driver_num{width:auto; float:left; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#000; padding-left:5px; padding-right:5px; margin-left:100px; font-weight:bold; padding-bottom:5px; padding-top:5px;}
.table_inner{width:400px; float:left; margin-bottom:10px; margin-top:10px;}
.table_main{width:860px; float:left; margin-left:15px; }
.verti_bg{ width:201px; height:165px; float:left; line-height:50px; margin: 10px auto 10px 2%; font-family:Verdana, Geneva, sans-serif; background-image:url(blck_bg.png); background-repeat:no-repeat; text-align:center; padding-top:15px; color: #fff; font-size:30px; font-weight:bold;}
.verti_bg a{ color:#FFF; text-decoration:none;}
.gray_inner{width:860px; float:left; border: solid #999 1px; margin-top:10px;}
.gray_main{width:860px; margin:auto;}
.watingdiv {
	background: #161616 url(pattern_40.gif) top left repeat;
	margin: 0;
	padding: 0;
	font: 12px normal Verdana, Arial, Helvetica, sans-serif;
	height: 100%;
}
.container {width: 100%; margin: 0 auto; overflow: hidden;}
.content {width:100%; margin:0 auto; padding-top:50px;}
/* Second Loadin Circle */

.circle {
	background-color: rgba(0,0,0,0);
	border:5px solid rgba(0,183,229,0.9);
	opacity:.9;
	border-right:5px solid rgba(0,0,0,0);
	border-left:5px solid rgba(0,0,0,0);
	border-radius:50px;
	box-shadow: 0 0 35px #2187e7;
	width:50px;
	height:50px;
	margin:0 auto;
	-moz-animation:spinPulse 1s infinite ease-in-out;
	-webkit-animation:spinPulse 1s infinite linear;
}
.circle1 {
	background-color: rgba(0,0,0,0);
	border:5px solid rgba(0,183,229,0.9);
	opacity:.9;
	border-left:5px solid rgba(0,0,0,0);
	border-right:5px solid rgba(0,0,0,0);
	border-radius:50px;
	box-shadow: 0 0 15px #2187e7; 
	width:30px;
	height:30px;
	margin:0 auto;
	position:relative;
	top:-50px;
	-moz-animation:spinoffPulse 1s infinite linear;
	-webkit-animation:spinoffPulse 1s infinite linear;
}

@-moz-keyframes spinPulse {
	0% { -moz-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7;}
	50% { -moz-transform:rotate(145deg); opacity:1; }
	100% { -moz-transform:rotate(-320deg); opacity:0; }
}
@-moz-keyframes spinoffPulse {
	0% { -moz-transform:rotate(0deg); }
	100% { -moz-transform:rotate(360deg);  }
}
@-webkit-keyframes spinPulse {
	0% { -webkit-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7; }
	50% { -webkit-transform:rotate(145deg); opacity:1;}
	100% { -webkit-transform:rotate(-320deg); opacity:0; }
}
@-webkit-keyframes spinoffPulse {
	0% { -webkit-transform:rotate(0deg); }
	100% { -webkit-transform:rotate(360deg); }
}
.triggerBar {
	background: #000000;
	background: -moz-linear-gradient(top, #161616 0%, #000000 100%);
	background: -webkit-linear-gradient(top, #161616 0%,#000000 100%);
	border-left:0px solid #111; border-top:0px solid #111; border-right:1px solid #333; border-bottom:0px solid #333; 
	font-family: Verdana, Geneva, sans-serif;
	font-size: 1.0em;
	text-decoration: none;
	text-align: center;
	color: #fff;
	padding: 10px;
	border-radius: 3px;
	display: block;
	margin: 0 auto;
	width: 100%;
}


</style>
<script type="text/javascript">
// set minutes
//var mins = 5;
 
// calculate the seconds (don't change this! unless time progresses at a different speed for you...)
var secs = Math.floor(30);
function countdown() {
	setTimeout('Decrement()',1000);
}
function Decrement() {
	if (document.getElementById) {
		minutes = document.getElementById("minutes");
		seconds = document.getElementById("seconds");
		// if less than a minute remaining
		if (seconds < 59) {
			seconds.value = secs;
		} else {
			minutes.value = getminutes();
			seconds.value = getseconds();
		}
		secs--;
		setTimeout('Decrement()',1000);
	}
}
function getminutes() {
	// minutes is seconds divided by 60, rounded down
	mins = Math.floor(secs / 60);
	return mins;
}
function getseconds() {
	// take mins remaining (as seconds) away from total seconds remaining
	return secs-Math.round(mins *60);
}
//recursMe(5);
</script>
<script type="text/javascript" src="rotator.js"></script>
<script>
         $(window).load(function () {
           // $("#rotator").rotator();
         
         });
      </script>
{/literal}

<div style="width:100%; float:left;">
<div class="gray_main" id="auto">
<div class="gray_inner">
<div class="btn_main">
<div class="btn_bg_sec"><a href="selectdrivers.php?date={$date}" rel="facebox">Select Drivers</a></div>
<div class="btn_bg"><a href="nextdaygrid.php?date={$date}">Back To Grid</a></div>

<div class="btn_bg_sec"><a href="index.php">Home</a></div>
<div class="btn_bg"><a href="rescheduale.php?date={$date}">Revert All Assignment</a></div>
<div class="btn_bg1"><a href="javascript:popWind78('driver_schedule4.php?date={$date}')" ><img src="timeslots.png" title="" height="50px" width="90px" /></a><!--<a href="driver_schedule4.php?date={$date}" target="_blank">Drivers Time Slots</a>--></div>


</div>

<div class="table_main">
<div class="table_inner">
<table width="450" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="229" height="28" class="driver_head">Total Number of Drivers:</td>
    <td width="321" align="left" class="driver_num">{$totdrivers}</td>
  </tr>
  <tr>
    <td width="229" height="28" class="driver_head">Selected Drivers:</td>
    <td align="left" class="driver_num">{$tot_availble_drivers}</td>
  </tr>
  <tr>
    <td  width="229" class="driver_head">Total Number of Trips:</td>
    <td align="left" class="driver_num"><p id="tot">{$tot_trips}</p></td>
  </tr>
  <tr>
    <td width="229" height="28" class="driver_head">Total Number of Assign Trips:</td>
    <td align="left" class="driver_num"><p id="tat">{$tot_assign_trips}</p></td>
  </tr>
  <tr>
    <td width="229" height="28" class="driver_head">Total Number of Un-assign Trips:</td>
    <td align="left" class="driver_num"><p id="tut">{$tot_unassign_trips}</p></td>
  </tr>
</table>

</div>
<a {if $tot_availble_drivers gt 0} href="#" onclick="recursMe(1,{$percentage});" {else}  href="#" onclick="alert('Before starting Auto Schedual,  Please select some drivers');" {/if} > <div class="verti_bg">
Start<br/ > Auto<br/ > 
Schedule
</div>
</a>
<!--<a {if $tot_availble_drivers gt 0} href="#" onclick="autoSCHbusy();" {else}  href="#" onclick="alert('Before starting Auto Schedual,  Please select some drivers');" {/if} > <div class="verti_bg">
Busy<br/ > Day<br/ > 
Schedule
</div>
</a>-->
</div>
</div>
</div>

<!--<div class="gray_main">
<div class="gray_inner">
<div class="watingdiv" >
	<div class="container">
	<div class="content">
	<p class="triggerBar"><strong>Note: <br/>If you are still seeing some trips unassigned in routing grid, So please assign these trips manually.</strong></p>
    </div>
</div>
</div>
</div>
</div>-->

<div class="gray_main" id="wait" style="display:none;">
<div class="gray_inner">
<div class="watingdiv" >
	<div class="container">
	<div class="content">
   <!-- <div class="circle"></div>
    <div class="circle1"></div>-->
	<!--<p class="triggerBar">Be Attention</p>
	<p class="triggerBar">&raquo; System is working on high level task </p>
	<p class="triggerBar">&raquo; System may take a long time</p>
	<p class="triggerBar">&raquo; Please do not move to any other tab OR</p>
	<p class="triggerBar">&raquo; Do not close this tab</p>
	<p class="triggerBar">&raquo; Meanwhile system is working do not assign any driver to any trip</p>
	<p class="triggerBar">&raquo; This interface will be close automatically</p>-->
    {literal}
    <style>
.spinner {
  margin: 1px auto;
  width: 50px;
  height: 40px;
  text-align: center;
  font-size: 10px;
}

.spinner > div {
  background-color: #FFF;
  height: 100%;
  width: 6px;
  display: inline-block;
  -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
  animation: sk-stretchdelay 1.2s infinite ease-in-out;
}

.spinner .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}

.spinner .rect3 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

.spinner .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}

.spinner .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}

@-webkit-keyframes sk-stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  
  20% { -webkit-transform: scaleY(1.0) }
}

@keyframes sk-stretchdelay {
  0%, 40%, 100% { 
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% { 
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}
    </style>
    {/literal}
  <div class="spinner">
  <div class="rect1"></div>
  <div class="rect2"></div>
  <div class="rect3"></div>
  <div class="rect4"></div>
  <div class="rect5"></div>
  </div>
    <div id="rotator" style="height:400px;width:400px; margin:auto;"></div>

    <p class="triggerBar">Total Trips: <span id="tot2" >&raquo; {$tot_trips}</span> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Assign Trips: <span id="tat2" >&raquo; {$tot_assign_trips}</span>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Remaining Trips: <span id="tut2" >&raquo; {$tot_unassign_trips}</span></p>
 
    <p class="triggerBar" ><div class="btn_bg2"><a href="javascript:location.reload();">Stop Process & Go Back</a></div></p>
    
	<!--<p class="triggerBar"> Remainig Time (Approximately):&raquo;
	 <input id="minutes" type="text" style="width: 26px; border: none; background-color:#000000; color:#FFFFFF; font-size: 16px; font-weight: bold;"> minutes and <input id="seconds" type="text" style="width: 26px; border: none; background-color:#000000; color:#FFFFFF; font-size: 16px; font-weight: bold;"> Seconds
	 </p>-->
    </div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>