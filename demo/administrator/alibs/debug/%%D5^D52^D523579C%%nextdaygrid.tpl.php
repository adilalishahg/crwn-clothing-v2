<?php /* Smarty version 2.6.12, created on 2019-04-24 16:06:46
         compiled from rpaneltpl/nextdaygrid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'rpaneltpl/nextdaygrid.tpl', 336, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_buzzer2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo ' 
<style>
.assign { 	background-color:#99FF66;	}
.duplicateassign {	 background-color: #FFFF33;	}
</style>
<script type="text/javascript">
$(document).ready(function() { 
refreshed();
});
//setInterval(getalerts(),10000);
	function deleteRec(id,id2,dt)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			location.href="nextdaygrid.php?delId="+id+"&id="+id2+"&dt="+dt;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
function dvmap(did,tid,tdate,ttime,acknowledge_status)
	{
		//alert(did+" -- "+tid+" -- "+tdate+" -- "+ttime);
		var brk =  Array();
		var msg =  Array();
		//if (did != \'\' && tid != \'\' && tdate != \'\' && ttime != \'\')
		//{
			//brk = val1.split(\'^\');
			//alert("cnfrm.php"+did+" - "+tid+" - "+tdate+" - "+ttime);
		   //	$.post("cnfrm.php", {drv_id: did, trp_id: tid, trp_date: tdate, trp_time:ttime}, function(cnfrm)
			//{ //alert(acknowledge_status);
				//alert(\'Confirm Return : \'+ cnfrm);
				/*if(cnfrm == 0)
				{
				//alert(\'i got 0 now\');
				alert(\'This Driver is already assign to another trip. \\nPlease select different driver?\');
					if(cfm)
					{
						$.post("dvmap.php", {did: did, tid: tid, tdate: tdate, ttime: ttime}, function(data)
						{
							if(data.length > 0)
							{
								msg = data.split(\'^\');
								if(msg[1] == \'0\')
									alert("Not Assigned Yet");
							else
									alert("Assigned");
								$(	"#msg").html(msg[0]);
								if(msg[1] == \'0\')
								{
									$("#dv"+msg[1]).html(\'Not assigned Yet\');
									$("#dv"+val2).html(brk[1]);
								}
								if(msg[1] != \'0\' || msg[1] != \'fail\'  )
								{
									$("#dv"+msg[1]).html(\'Not assigned Yet\');
									$("#dv"+val2).html(brk[1]);			 
								}
								return true;
							}
						});
					}
					else
					{
						return false;
					}
				}
				else
				{*/
					//alert(\'i got 1 now\');
				//$.post("dvmap.php", {drv: ""+val2, veh:""+brk[0], vehnp:""+brk[1]}, function(data)
$.post("dvmap2.php", {did: did, tid: tid, tdate: tdate, ttime: ttime, acknowledge_status: acknowledge_status}, function(data)
					{
						if(data.length > 0)
						{ //alert(data);
							msg = data.split(\'^\'); //alert(msg[2]);
							if(data == \'0\')
								alert("Not Assigned Yet");
							else {
								alert("Assigned");//alert(msg[2]); // location.reload(); 
								}
							/*$(	"#msg").html(msg[0]);
							if(msg[1] == \'0\')
							{
								$("#dv"+msg[1]).html(\'Not assigned Yet\');
								$("#dv"+val2).html(brk[1]);
							}
							if(msg[1] != \'0\' || msg[1] != \'fail\'  )
							{
								$("#dv"+msg[1]).html(\'Not assigned Yet\');
								$("#dv"+val2).html(brk[1]);			 
						}*/
						return true;
					}
					});
	//	}	
	///		});
		/*}
		else
		{
			return false;
		}*/	
	}
	 function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 715, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
    function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 800, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
   function popWind3(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 500, width = 500, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function fsubmit(url,id){
location.href=url+"&driver="+id; }
function fsubmit2(url,id){
location.href=url+"&user="+id;   }
function fsubmit3(url,id){
location.href=url+"&account="+id;}
//Alerts code for 		
function alerts(drv_id){ 
	 if(drv_id != \'\'){
	var message = prompt("Send Message to : "+drv_id);
		if(message !== \'\'){	 
		$.post("sendalert.php", {messag: ""+message, driver_code:""+drv_id}, function(data){
  				if(data.length > 0) { //alert(data);
				}
	 }); return true; }
	 	 else {return false; }
	   	}
 	 else { return false; }
	 }
var Usmania; 
var UsmaniaA = new Array();	   
function getalerts(){
		$.post("getalerts.php", {}, function(data){
  				if(data.length > 0) {
				var alerts = data;
				Usmania = alerts;
				sadigalliaga();
			 } });
	}	 
function sadigalliaga(){ //alert(Usmania);
			 UsmaniaA = Usmania.split(\'@\');
			 if(UsmaniaA.length > 1){
				id 		= UsmaniaA[0];
				from 	= UsmaniaA[1];
				message	= UsmaniaA[2];
				senttime= UsmaniaA[3];
						var ok;
		ok=confirm(\'From: \'+from+\'      Sent: \'+senttime+\'\\n\\nMessage: \'+message);
		if (ok)
		{		
			$.post("getalerts.php", {recid: ""+id}, function(data){
			});
			return true;
		}
		else
		{
			return false;
		}
	}   }
	//setInterval ( "getalerts()", 20000);
 //End of alert
 //Page refresh code
 function refreshpagejana(){
	 var value = \'refresh\';
 $.post("refreshpage.php", {action: ""+value}, function(data){
	 if(data.length > 0) { 
		 var laylay = data;
		 if(laylay == 0){
		 return false;
		  }
		 else if(laylay == 1){  location.reload();   }
		  }
	});
 }
 function refreshed(){
	 var value = \'refreshed\';
 $.post("refreshpage.php", {action: ""+value}, function(data){
			});
 }
 setInterval ( "refreshpagejana()", 1000000);
 //Page refresh code
 //Acknowledge by admin
  function ack(id){
 $.post("acknowledged.php", {id: ""+id}, function(data){
	 if(data.length > 0 ){
		 $(\'#\'+id).hide();
		 }
	});/**/
 }
 //end of acknowledge
</script> 		<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var oldDirections = [];
  var allDirections = [];
  var currentDirections = null;
  var route = [];
  var inc = 1;

  function initialize() {
    var myOptions = {
      zoom: 9,
      center: new google.maps.LatLng(42.0058862,-88.1714097),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    directionsDisplay = new google.maps.DirectionsRenderer({
        \'map\': map,
        \'preserveViewport\': true,
        \'draggable\': true
    });
    directionsDisplay.setPanel(document.getElementById("directions_panel"));

    google.maps.event.addListener(directionsDisplay, \'directions_changed\',
      function() {
        if (currentDirections) {
          oldDirections.push(currentDirections);
          //setUndoDisabled(false);
        }
        currentDirections = directionsDisplay.getDirections();
      });
    //setUndoDisabled(true);
    //calcRoute();
  }
  function calcRoute(add1,add2) {
    start = add1;
      end = add2;
	  inc = inc+1;
	//var start = \'48 Pirrama Road, Pyrmont NSW\';
    //var end = \'Bondi Beach, NSW\';
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
	  //allDirections = [];
	  //response= push(response);
	  //route = response.routes[inc];
        directionsDisplay.setDirections(response);
		 
      }
    });
  }
 
 
 function showpanel() {

   var docHeight = $(document).height();

   $("body").append("<div id=\'overlay\'>this is the point</div>");

   $("#overlay")
      .height(docHeight)
      .css({
         \'opacity\' : 0.4,
         \'position\': \'absolute\',
         \'top\': 0,
         \'left\': 0,
         \'background-color\': \'black\',
         \'width\': \'100%\',
         \'z-index\': 5000
      });

} 
  
  
</script>
'; ?>

</head>

<body onLoad="initialize()">
<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">
<tr><td style="background-color:#09F;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>
<tr><td style="height:10px;"></td></tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="tabs"><ul>
                    <li <?php if ($this->_tpl_vars['st'] == '5'): ?> class="active"<?php endif; ?>><a href="nextdaygrid.php?date=<?php echo $this->_tpl_vars['date']; ?>
&st=5">In Progress</a></li>
                     <li class="last" ><a href="nextdaygrid.php?date=<?php echo $this->_tpl_vars['date']; ?>
&st=9&acknowledge_status=0">Pending Trips</a></li>
<!--  -->                     
 <a href="autoscheduale.php?date=<?php echo $this->_tpl_vars['date']; ?>
" title="Click for Auto Schedule"><img src="../images/autoprocess.png" border="0"/></a>
 &nbsp;&nbsp;&nbsp;<a href="rescheduale.php?date=<?php echo $this->_tpl_vars['date']; ?>
" title="Reschedule"><img src="../images/Routing.gif" border="0" height="32" width="32" alt="Reschedule"/></a><?php if ($this->_tpl_vars['yes'] == '1'):  if ($this->_tpl_vars['date'] != $this->_tpl_vars['date0']):  endif;  endif; ?>
                </ul>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <form name="searchReport" action="nextdaygrid.php?st=<?php echo $this->_tpl_vars['st']; ?>
&date=<?php echo $this->_tpl_vars['date']; ?>
" method="post">
          <strong>Driver:</strong> <select name="driver" id="driver" onChange="fsubmit('nextdaygrid.php?st=<?php echo $this->_tpl_vars['st']; ?>
&date=<?php echo $this->_tpl_vars['date']; ?>
',this.value);">
                                    <option value="">Select Driver</option>
                    <?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['drivers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>	
                                <option value="<?php echo $this->_tpl_vars['drivers'][$this->_sections['d']['index']]['drv_code']; ?>
" <?php if ($this->_tpl_vars['drivers'][$this->_sections['d']['index']]['drv_code'] == $this->_tpl_vars['drv']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['drivers'][$this->_sections['d']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['drivers'][$this->_sections['d']['index']]['lname']; ?>
 - [ <?php echo $this->_tpl_vars['drivers'][$this->_sections['d']['index']]['drv_code']; ?>
 ]</option>
                    <?php endfor; endif; ?>  
                                  </select>
                                  <strong>Client:</strong> <select  onchange="fsubmit2('nextdaygrid.php?st=<?php echo $this->_tpl_vars['st']; ?>
&date=<?php echo $this->_tpl_vars['date']; ?>
',this.value);" name="user" id="user">
                                    <option value="">Select Client</option>
                    <?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['userdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>	
                   <option value="<?php echo $this->_tpl_vars['userdata'][$this->_sections['d']['index']]['trip_user']; ?>
" ><?php echo $this->_tpl_vars['userdata'][$this->_sections['d']['index']]['trip_user']; ?>
</option>
                    <?php endfor; endif; ?>  
                                  </select>
                                  <strong>Accounts:</strong> <select name="account" id="account"  onchange="fsubmit3('nextdaygrid.php?st=<?php echo $this->_tpl_vars['st']; ?>
&date=<?php echo $this->_tpl_vars['date']; ?>
',this.value);">
                                    <option value="">Select Account</option>
                    <?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['accounts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['d']['show'] = true;
$this->_sections['d']['max'] = $this->_sections['d']['loop'];
$this->_sections['d']['step'] = 1;
$this->_sections['d']['start'] = $this->_sections['d']['step'] > 0 ? 0 : $this->_sections['d']['loop']-1;
if ($this->_sections['d']['show']) {
    $this->_sections['d']['total'] = $this->_sections['d']['loop'];
    if ($this->_sections['d']['total'] == 0)
        $this->_sections['d']['show'] = false;
} else
    $this->_sections['d']['total'] = 0;
if ($this->_sections['d']['show']):

            for ($this->_sections['d']['index'] = $this->_sections['d']['start'], $this->_sections['d']['iteration'] = 1;
                 $this->_sections['d']['iteration'] <= $this->_sections['d']['total'];
                 $this->_sections['d']['index'] += $this->_sections['d']['step'], $this->_sections['d']['iteration']++):
$this->_sections['d']['rownum'] = $this->_sections['d']['iteration'];
$this->_sections['d']['index_prev'] = $this->_sections['d']['index'] - $this->_sections['d']['step'];
$this->_sections['d']['index_next'] = $this->_sections['d']['index'] + $this->_sections['d']['step'];
$this->_sections['d']['first']      = ($this->_sections['d']['iteration'] == 1);
$this->_sections['d']['last']       = ($this->_sections['d']['iteration'] == $this->_sections['d']['total']);
?>	
                   <option value="<?php echo $this->_tpl_vars['accounts'][$this->_sections['d']['index']]['id']; ?>
" ><?php echo $this->_tpl_vars['accounts'][$this->_sections['d']['index']]['account_name']; ?>
</option>
                    <?php endfor; endif; ?>  
                                  </select>
                                  
                                  </td>
              </tr>
              <tr>
                <td height="19" align="left">
                 <span style="color:#F00; font-weight:bold;" class="admintopheading">SCHEDULE DETAILS [ <?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 ]  </span>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<span style="background-color:#cfc2dd; font-size:14px;">&nbsp;&nbsp;&nbsp;Pre Match Assignment&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--> <span style="background-color:#eecec3; font-size:14px;">&nbsp;&nbsp;&nbsp;Manual Assignment&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#d7ece1; font-size:14px;">&nbsp;&nbsp;&nbsp;Auto Schedule Assignment&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#FF6; font-size:14px;">&nbsp;&nbsp;&nbsp;Let's Fill the Gap&nbsp;&nbsp;&nbsp;</span>
               </td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style=""><table width="100%" border="0" class="main_table1" cellpadding="0" cellspacing="0" >                  
                    <div id="sc"></div>
					<tr><td colspan="12"><div style="height:100%; border: solid #FF0000 0px; padding-top:10px;">
                    <table width="100%" border="0" >
					 <tr>
                      <!--<td align="left" class="label_txt_heading"><strong>Code</strong></td>-->
                      <td align="left" class="label_txt_heading"><strong>Account</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Patient Name</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Miles</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                      <td align="center" class="label_txt_heading"><strong>Options</strong></td>
                      <td align="left" class="label_txt_heading"><strong><?php if ($this->_tpl_vars['st'] == '9'): ?>Status<?php else: ?>Location<?php endif; ?></strong></td>
                    </tr>
					<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['membdetail']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>
					<tr valign="top" id="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id'] != ''): ?>
                   <!--<?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['assign_type'] == 'Prematch'): ?> bgcolor="#cfc2dd" <?php endif; ?>-->
                   <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['assign_type'] == 'Auto'): ?> bgcolor="#d7ece1" <?php endif; ?>
                   <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['assign_type'] == 'Manual'): ?> bgcolor="#eecec3" <?php endif; ?>
                    <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['assign_type'] == 'FilltheGap'): ?> bgcolor="#FF6" <?php endif; ?>
                   
                     <?php endif; ?> >
                      <!--<td ><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['ccode']; ?>
</td>-->
                      <td align="left" valign="top" class="grid_content"><b> <?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['accounts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>
                      <?php if ($this->_tpl_vars['accounts'][$this->_sections['p']['index']]['id'] == $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['account']): ?> <?php echo $this->_tpl_vars['accounts'][$this->_sections['p']['index']]['account_name']; ?>
 <?php endif; ?> 
                      <?php endfor; endif; ?></b></td>
                      <td align="left" valign="top" class="grid_content"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_user']; ?>
<br/>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pcomments'] != ''): ?><img src="../images/icons/information2.png" title="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pcomments']; ?>
" ><?php else: ?>
                      <img src="../images/icons/information.png" title="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pcomments']; ?>
" ><?php endif; ?></td>
<td align="left" valign="top" id="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
"> 
<select name="staff1" id="staff1" class="required" onChange="dvmap(this.value,'<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
', '<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_date']; ?>
', '<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time']; ?>
', '<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status']; ?>
', '<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
', '<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
');">
<option value="">--Select--</option>
<?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['driverdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?>
<option value="<?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['drv_code']; ?>
" <?php if ($this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['drv_code'] == $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['lname']; ?>
</option>
<?php endfor; endif; ?>
</select><br/> <a href="#" onClick="calcRoute('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
', '<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
');" >Show Route on Map</a>
</td>
                   	 <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['picklocation'] != ''): ?>[<strong>Pick Location:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['picklocation']; ?>
]<br/><?php endif; ?>
                   <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add'];  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pickup_instruction'] != ''): ?><br/>[<strong>Instruction:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pickup_instruction']; ?>
]<?php endif;  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['p_phnum'] != ''): ?><br/>[<strong>Phone #:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['p_phnum']; ?>
]<?php endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['droplocation'] != ''): ?>[<strong>Drop Location:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['droplocation']; ?>
]<br/><?php endif; ?>
                      <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add'];  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['destination_instruction'] != ''): ?><br/>[<strong>Instruction:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['destination_instruction']; ?>
]<?php endif;  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['d_phnum'] != ''): ?><br/>[<strong>Phone #:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['d_phnum']; ?>
]<?php endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wc'] == '1'): ?> W/C<?php else: ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wc'] == '1'): ?> --:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_miles']; ?>

                      <!--<span style="font-size:9px; color:#F00;"><br />$ <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['legcharges']; ?>
</span>--></td>
                      <td align="left" valign="top" class="grid_content"><strong><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['vehtype']; ?>
</strong></td>
                      <td align="left" valign="top" class="grid_icon">&nbsp;&nbsp;<a  href="edit2.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['reqid']; ?>
&date=<?php echo $this->_tpl_vars['date']; ?>
" title="Edit" target="_blank"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;			  
   <?php if ($this->_tpl_vars['st'] == 4): ?>  <a href="javascript:popWind('../reports/details.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" title="View"> <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4'): ?>
                        Successful
                        <?php endif; ?>	 
                        <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '1'): ?>
                        Delayed
                        <?php endif; ?> </a>&nbsp;&nbsp;
                        <?php else: ?>  <a href="javascript:popWind('../reports/details.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" title="View"> View</a>&nbsp;&nbsp;
                        <?php endif; ?>
                        <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?> <a href="#"  onclick="return deleteRec('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
','<?php echo $this->_tpl_vars['id']; ?>
','<?php echo $this->_tpl_vars['date']; ?>
');"  title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a> <?php endif; ?>
                        <!--&nbsp;<a href="#" onClick="popWind3('temp_comments.php?tdid=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" ><img src="../graphics/temp_comments.png" height="20px" width="20px" /></a>&nbsp;-->
                   </td>
<td >
<?php if ($this->_tpl_vars['st'] == '9'): ?>
<?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status'] == '0'): ?>Pending<?php endif; ?><br/>
<?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status'] == '0'): ?><span style="color:#66F; font-weight:bold;"><a href="#" onClick="ack('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
')">Ack. by Admin</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status'] == '2'): ?><span style="color:#F00; font-weight:bold;">Denied</span><?php endif; ?>
<?php else: ?>

<a title="[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
]" href="driver.php?dri_code=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id______']; ?>
&a=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
&b=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
" target="_blank"><img alt="Track" border="0" src="../graphics/gps.png"></a>
<?php endif; ?>
</td>
                      
                    </tr>
					
                    <?php endfor; else: ?><tr>
                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                    </tr>
					</table></div></td></tr>
					
                    <?php endif; ?>
                  </table></td>
              </tr>
              <tr>
                <td colspan="12">
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>

</tr>
<!--<tr><td>
<div style="border: 0px solid #F00; text-align:right;"><a href="#" onClick="$('#mapdiv').toggle();">Map&nabla;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
<div id="mapdiv" style="height:800px; width:100%; overflow:scroll; border: solid #FF0000 0px;" >
<div id="map_canvas" style="float:left;width:100%;height:100%"></div></div>
		</td>		
  </tr>-->
</table>