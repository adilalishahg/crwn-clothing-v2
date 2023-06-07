<?php /* Smarty version 2.6.12, created on 2019-04-24 15:01:57
         compiled from rpaneltpl/grid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'rpaneltpl/grid.tpl', 386, false),array('modifier', 'date_format', 'rpaneltpl/grid.tpl', 448, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_buzzer3.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo ' 
<script type="text/javascript">
tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
function GetClock(){
var d=new Date();
var nday=d.getDay(),nmonth=d.getMonth()+1,ndate=d.getDate(),nyear=d.getYear();
if(nyear<1000) nyear+=1900;
var d=new Date();
var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;
if(nhour==0){ap=" AM";nhour=12;}
else if(nhour<12){ap=" AM";}
else if(nhour==12){ap=" PM";}
else if(nhour>12){ap=" PM";nhour-=12;}
if(nmin<=9) nmin="0"+nmin;
if(nsec<=9) nsec="0"+nsec;
//document.getElementById(\'clockbox\').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+"   "+nhour+":"+nmin+":"+nsec+ap+"";
document.getElementById(\'clockbox\').innerHTML=" "+nmonth+\'/\'+ndate+\'/\'+nyear+\' -- \'+nhour+":"+nmin+":"+nsec+ap+"";
}
window.onload=function(){
GetClock();
setInterval(GetClock,1000);
}
</script>

<script type="text/javascript">
 $(document).ready(function() { 
});
refreshed();
function st_status_change(id,st){ 
	ok=confirm("Are you sure you want to change status of this Trip?");
		if (ok)
		{ //alert(st);		
	 $.post("editgrid_ajax.php", {id: ""+id,st: ""+st}, function(data){ //alert(data);
	 if(data.length > 0 ){  location.reload();
		 }
	});
		}else return false;
	}		
//setInterval(getalerts(),10000);
function deleteRec(id,id2)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			location.href="grid.php?delId="+id+"&id="+id2;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
	//function dvmap(val1,val2)
function dvmap(did,tid,tdate,ttime,acknowledge_status)
	{
		//alert(did+" -- "+tid+" -- "+tdate+" -- "+ttime);
		var brk =  Array();
		var msg =  Array();
		if (did != \'\' && tid != \'\' && tdate != \'\' && ttime != \'\')
		{
			//brk = val1.split(\'^\');
			//alert("cnfrm.php"+did+" - "+tid+" - "+tdate+" - "+ttime);
		   	$.post("cnfrm.php", {drv_id: did, trp_id: tid, trp_date: tdate, trp_time:ttime}, function(cnfrm)
			{ //alert(acknowledge_status);
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
$.post("dvmap.php", {did: did, tid: tid, tdate: tdate, ttime: ttime, acknowledge_status: acknowledge_status}, function(data)
					{
						if(data.length > 0)
						{ //alert(data);
							msg = data.split(\'^\'); //alert(msg[2]);
							if(msg[1] == \'0\')
								alert("Not Assigned Yet");
							else {
								alert(msg[2]); // location.reload(); 
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
				//}	
			});
		}
		else
		{
			return false;
		}	
	}
	 function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 915, scrollbars=0, resizable = 0" );
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
location.href=url+"&account="+id;   		}
//Alerts code for 		
function alerts(drv_id){ 
 if(drv_id != \'\'){
	var message = prompt("Send Message to : "+drv_id);
		if(message !== \'\' && message.length > 0){	 
		$.post("sendalert.php", {messag: ""+message, driver_code:""+drv_id}, function(data){ //alert(data);
  				if(data.length > 0) { 
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
	setInterval ( "getalerts()", 25000);
 //End of alert
 //Page refresh code
 function refreshpagejana(){
	 var value = \'refresh\';
 $.post("refreshpage.php", {action: ""+value}, function(data){
	 if(data.length > 0) { //alert(data);
		 var laylay = data;
		 if(laylay == 0 || laylay == \'P0\'){
		 return false;
		  }
		 else if(laylay == 1 || laylay == \'T0\'){  location.reload();   }
		  }
	});
 }
 function refreshed(){ 
	 var valu = \'refreshed\'; 
 $.post("refreshpage.php", {action: ""+valu}, function(data){
			});
 }
 setInterval ( "refreshpagejana()", 30000);
 //Page refresh code
 //Acknowledge by admin
  function ack(id){
 $.post("acknowledged.php", {id: ""+id}, function(data){
	 if(data.length > 0 ){
		 $(\'#\'+id).hide();
		 }
	});
 }
 //end of acknowledge
 //start of finding coordinates from google
 function findcoord(addtype,add,id){
	 //alert(id);
	 $.post("add_cordinates.php", {id: ""+id, addtype: ""+addtype}, function(data){
		 if(data.length > 0 ){
			 if(data == 1){ location.reload();   }
			 else if(data !== 1){ return false; }
			 }
			});
	 }
 //End of finding google coordinates
function hsscort(tdid){ //alert(\'\'+tdid);
$(\'#scorts\'+tdid).toggle();}
function addescort(drvid,tdid){
	 $.post("addescort.php", {tdid: ""+tdid, drvid: ""+drvid}, function(data){
		 if(data.length > 0 ){ //alert(data);
			 if(data == 1){ location.reload();   }
			 else if(data !== 1){ return false; }
			 }
			});
	//alert(tdid);
	} 
  setInterval ( "autorefresh()", 90000);
  function autorefresh(){	  location.reload(); 	  }
  
  function domultiload(){
	  var arr = [];
$(\'input.forcheck:checkbox:checked\').each(function () {
    arr.push($(this).val());
}); alert(arr);
	  }
</script> 

'; ?>


<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">
<tr><td style="background-color:#09F;"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td></tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
                  
                  
                  
                  <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
              </tr>
              <tr>
                <td height="19" align="center"><div id="search_form">
                    <form name="searchReport" action="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=<?php echo $this->_tpl_vars['st']; ?>
&ad=<?php echo $this->_tpl_vars['ad']; ?>
" method="post">
                      <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >
                        <tr>
                          <td colspan="8" align="left" valign="middle" class="labeltxt"><table border="0" width="100%">
                              <tr>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><strong>Driver ID:</strong></td>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><select name="driver" id="driver" onchange="fsubmit('grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=<?php echo $this->_tpl_vars['st']; ?>
&ad=<?php echo $this->_tpl_vars['ad']; ?>
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
                                  
                                  </td>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><strong>Client:</strong></td>
                                <td align="left" valign="top" class="labeltxt"><select  onchange="fsubmit2('grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=<?php echo $this->_tpl_vars['st']; ?>
&ad=<?php echo $this->_tpl_vars['ad']; ?>
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
                                  <!--<input type="text" name="user" id="user" value="<?php echo $this->_tpl_vars['user']; ?>
" class="inputTxtField "/>--> 
                                  &nbsp;
                                  <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
                                    <div class="suggestionList" id="autoSuggestionsList1"> &nbsp;</div>
                                  </div></td>
                                <td colspan="2" align="left" valign="top" class="labeltxt"><strong>Accounts:</strong>&nbsp;</td>
                                <td rowspan="2" align="left" valign="top" class="labeltxt"><select name="account" id="account"  onchange="fsubmit3('grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=<?php echo $this->_tpl_vars['st']; ?>
&ad=<?php echo $this->_tpl_vars['ad']; ?>
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
               <!--<input type="text" name="clinic" id="clinic" value="<?php echo $this->_tpl_vars['clinic']; ?>
" class="inputTxtField date" />-->
                                  <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">
                                    <div class="suggestionList" id="div">&nbsp;</div>
                                  </div></td>
                    <td valign="top"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  />
                                  &nbsp; </td>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><a href="../index.php"><img src="../images/person_icon.png" border="0"  /></a><!--<a href="location_network_status.php" target="_blank"><img src="../graphics/device.png" border="0"  /></a>-->  <a href="hits-map-all-drivers-location.php" target="_blank"><img src="../graphics/gps.png"></a></td>
                       
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                    </form>
                  </div></td>
              </tr>
              
              <tr>
                <td class="tabs"><ul>
                    <li <?php if ($this->_tpl_vars['st'] == '9'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=9&acknowledge_status=0">Pending (<?php echo $this->_tpl_vars['st9']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '5'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=5"> Scheduled (<?php echo $this->_tpl_vars['st5']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '10'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=10">Arrived (<?php echo $this->_tpl_vars['st10']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '6'): ?> class="active"<?php endif; ?>><a  href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=6">Picked Up (<?php echo $this->_tpl_vars['st6']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '4'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=4&ad=0">Delivered (<?php echo $this->_tpl_vars['st4']; ?>
)</a></li>
                    <li class="last"><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=3&ad=0">Cancelled (<?php echo $this->_tpl_vars['st3']; ?>
)</a></li>
                    <li style="background-color:#093;"><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=11" >Open Runs (<?php echo $this->_tpl_vars['st11']; ?>
)</a></li>
                     
                    <!--<li <?php if ($this->_tpl_vars['st'] == '0' || $this->_tpl_vars['acknowledge_status'] == '0'): ?> class="last" <?php else: ?> class="last"<?php endif; ?>>
                    <a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=9&acknowledge_status=0">Pending Trips (<?php echo $this->_tpl_vars['st9']; ?>
)</a>
                    </li> 
                   <li><input type="button" value="GET" onclick="getalerts()" /></li>-->
                  </ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <!--<img alt="Free Drivers" border="0"  src="../graphics/surrent_trip_btn.png" height="23px" width="23px">-->
                  <select style="width:300px; padding-bottom:5px; background-color:#69C; color:#FFF;" ><option value="">Drivers No Ride Scheduled in Next 45 Minutes</option>
                  <?php unset($this->_sections['d']);
$this->_sections['d']['name'] = 'd';
$this->_sections['d']['loop'] = is_array($_loop=$this->_tpl_vars['freedrivers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                   <option value="<?php echo $this->_tpl_vars['freedrivers'][$this->_sections['d']['index']]['driver']; ?>
" ><?php echo $this->_tpl_vars['freedrivers'][$this->_sections['d']['index']]['driver']; ?>
</option>
                    <?php endfor; endif; ?>
                  </select>
                 </td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading"><!--<a href="#" onclick="domultiload();" >Multi Load</a>-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SCHEDULED DETAILS &nbsp;&nbsp;&nbsp;<span id="clockbox" style="color:#FFF;"></span></td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0" >
                    <tr>
                     <!--  <td align="left" class="label_txt_heading"><strong>Code</strong></td>
                     <td align="left" class="label_txt_heading"><strong>Facility</strong></td>-->
                      <td align="left" class="label_txt_heading"><strong>Account</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Patient Name </strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Miles</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                      <td align="center" class="label_txt_heading"><strong>Options</strong></td>
                      <td align="left" class="label_txt_heading"><strong><?php if ($this->_tpl_vars['st'] == '9'): ?>Status<?php else: ?>Location<?php endif; ?></strong></td>
                     <!-- <td align="left" class="label_txt_heading"><strong>Call</strong></td>-->
                    </tr>
                    <div id="sc"></div>
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
                    <tr  valign="top" id="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
"  bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
" class="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['color_class']; ?>
">
                      <!--<td > <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['ccode']; ?>
  <input type="checkbox" value="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
" class="forcheck" /> </td>
                      <td align="left" valign="top" class="grid_content"><b><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_clinic']; ?>
</b></td>-->
                      <td align="left" valign="top" class="grid_content"><b>
                      <?php unset($this->_sections['p']);
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
                      <?php endfor; endif; ?>
                      </b></td>
                      <td align="left" valign="top" class="grid_content"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_user']; ?>
<br/>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pcomments'] != ''): ?><img src="../images/icons/information2.png" title="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pcomments']; ?>
" ><?php else: ?>
                      <img src="../images/icons/information.png" title="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pcomments']; ?>
" ><?php endif; ?></td>
                      <!--<td align="left" valign="top" class="grid_content"> 
                      <?php if ($this->_tpl_vars['st'] != '9'):  echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['driver']; ?>
-[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
]
<?php else: ?>
<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_date']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status']; ?>
')">
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
</select>
<?php endif; ?> </td>-->
        <td align="left" valign="top" class="grid_content"><select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_date']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status']; ?>
')">
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
<?php endfor; endif; ?>  </select>
<br/>
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
             <?php if ($this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['drv_code'] == $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['escort_id']): ?>ESC &raquo;<?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['lname'];  endif;  endfor; endif; ?>
<br/>
<?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id'] != ''): ?>
&nbsp;&nbsp;<a href="#" onclick="hsscort('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
')" ><input type="button" class="inputButton btn" value=" + ESCORT "  /></a>
<?php endif; ?>

<span id="scorts<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
" style="display:none;" >
<select id="sl<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
" onchange="return addescort(this.value,'<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
')">
<option value="">--Select Escort--</option>
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
" <?php if ($this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['drv_code'] == $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['escort_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['lname']; ?>
</option>
<?php endfor; endif; ?>  </select></span>
</td>
             <!--<td align="left" valign="top" class="grid_content"> <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id'] != ''):  echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['driver']; ?>
-[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
]
<?php else:  if ($this->_tpl_vars['st'] == '5' || $this->_tpl_vars['st'] == '9'): ?>
<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_date']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time']; ?>
')">
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
" <?php if ($this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['drv_code'] == $this->_tpl_vars['staff1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['lname']; ?>
</option>
<?php endfor; endif; ?>
</select>
<?php endif;  endif; ?> </td>
-->
                   <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['picklocation'] != ''): ?>[<strong>Pick Location:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['picklocation']; ?>
]<br/><?php endif; ?>
                   <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add'];  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pickup_instruction'] != ''): ?><br/>[<strong>Instruction:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pickup_instruction']; ?>
]<?php endif;  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['p_phnum'] != ''): ?><br/>[<strong>Phone #:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['p_phnum']; ?>
]<?php endif; ?>
                        <!--<a href="#" onclick="findcoord('pick','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" > <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pick_latlong'] == '' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pick_latlong'] == 'NULL'): ?><img src="../images/icons/null_cord.png" title="Find Coordinate" ><?php else: ?><img src="../images/icons/yes_cord.png" title="Find Updated Coordinate" ><?php endif; ?></a>--></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['droplocation'] != ''): ?>[<strong>Drop Location:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['droplocation']; ?>
]<br/><?php endif; ?>
                      <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add'];  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['destination_instruction'] != ''): ?><br/>[<strong>Instruction:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['destination_instruction']; ?>
]<?php endif;  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['d_phnum'] != ''): ?><br/>[<strong>Phone #:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['d_phnum']; ?>
]<?php endif; ?><!--<br/>
<a href="#" onclick="findcoord('drop','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
','<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" ><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drop_latlong'] == '' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drop_latlong'] == 'NULL'): ?><img src="../images/icons/null_cord.png" title="Find Coordinate" ><?php else: ?><img src="../images/icons/yes_cord.png" title="Find Updated Coordinate" ><?php endif; ?></a>--></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wc'] == '1'): ?> W/C<?php else: ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '1'): ?>
                      <br/><span style="color:#F00;"><?php echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['aptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</span><?php endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10' && $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wait_time'] != ''): ?><br/><img src="../graphics/waiting.png" title="Waiting" ><br/><span style="font-size:8px; color:#F00;"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wait_time'];  endif; ?></span></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wc'] == '1'): ?> --:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '1'): ?>
                      <br/><span style="color:#F00;"><?php echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
</span><?php endif; ?>
                      </td>
                      <td align="left" valign="top" class="grid_content"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_miles']; ?>

                       <!--<span style="font-size:9px; color:#F00;"><br />$ <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['legcharges']; ?>
</span>--></td>
                      <td align="left" valign="top" class="grid_content">
                      
                      <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['vehtype']; ?>
<span style="font-size:9px; color:#F00;">
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['dstretcher'] == 'Yes'): ?><br/>&raquo; 2Man-Team <?php endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['bar_stretcher'] == 'Yes'): ?><br/>&raquo; Bariatric-Str. <?php endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['dwchair'] == 'Yes'): ?><br/>&raquo; W-Chair-Rental <?php endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['oxygen'] == 'Yes'): ?><br/>&raquo; Oxygen <?php endif; ?></span>
                      
                      </td>
                      <td align="left" valign="top" class="grid_icon"><!--<a  href="#" onclick="popWind('editgrid-new.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
&type=<?php if ($this->_tpl_vars['st'] == 6): ?>1<?php else: ?>2<?php endif; ?>');" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>--><!--<a  href="editgrid-new.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
&type=<?php if ($this->_tpl_vars['st'] == 6): ?>1<?php else: ?>2<?php endif; ?>" rel="facebox" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>--><a  href="edit2.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['reqid']; ?>
" title="Edit" target="_blank"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;		  
    <?php if ($this->_tpl_vars['st'] == 4): ?> 
    <a href="javascript:popWind('../reports/details.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" title="View">
     <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4'): ?>
                        Successful
                        <?php endif; ?>	 
                        <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '1'): ?>
                        Delayed
                        <?php endif; ?> </a>&nbsp;&nbsp;
                        <?php else: ?>  <a href="javascript:popWind('../reports/details.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" title="View"> View</a>&nbsp;&nbsp;
                        <?php endif; ?>
                     <?php if ($_SESSION['admuser']['admin_level'] == '0'):  endif; ?> <a href="#"  onclick="return deleteRec('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
','<?php echo $this->_tpl_vars['id']; ?>
');"  title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a> &nbsp; 
                       <a href="#" onclick="alerts('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
')" ><img src="../graphics/alert.png" height="20px" width="20px" /></a>
                <br/><!--&nbsp;<a href="#" onclick="popWind3('temp_comments.php?tdid=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" ><img src="../graphics/temp_comments.png" height="20px" width="20px" /></a>-->
                        <select name="st_status" id="st_status" onchange="st_status_change('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
',this.value);" style="width:110px;" >
 <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?>                       
                          <option value="5" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?> selected="selected"<?php endif; ?>>Scheduled</option>
                          <option value="10" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10'): ?> selected="selected"<?php endif; ?>>Arrived</option>
                          <option value="3" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '3'): ?> selected="selected"<?php endif; ?>>Cancelled</option>
                          <option value="7" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '7'): ?> selected="selected"<?php endif; ?>>Billable No-Show</option>
                          <option value="8" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '8'): ?> selected="selected"<?php endif; ?>>non-Billable No-Show</option>
<?php elseif ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10'): ?>                       
                          <option value="10" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10'): ?> selected="selected"<?php endif; ?>>Arrived</option>
                          <option value="6" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6'): ?> selected="selected"<?php endif; ?>>Picked Up</option>
                          <option value="3" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '3'): ?> selected="selected"<?php endif; ?>>Cancelled</option>
                          <option value="7" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '7'): ?> selected="selected"<?php endif; ?>>Billable No-Show</option>
                          <option value="8" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '8'): ?> selected="selected"<?php endif; ?>>non-Billable No-Show</option>                          
<?php elseif ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '3' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '7' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '8'): ?>
						  <option value="3" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '3'): ?> selected="selected"<?php endif; ?>>Cancelled</option>
                          <option value="7" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '7'): ?> selected="selected"<?php endif; ?>>Billable No-Show</option>
                          <option value="8" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '8'): ?> selected="selected"<?php endif; ?>>non-Billable No-Show</option>	
                          <option value="5" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?> selected="selected"<?php endif; ?>>Scheduled</option>
<?php elseif ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '1'): ?>	
                          <option value="4" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4'): ?> selected="selected"<?php endif; ?>>Dropped</option>
                          <option value="6" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6'): ?> selected="selected"<?php endif; ?>>Picked</option>
                          <option value="5" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?> selected="selected"<?php endif; ?>>Scheduled</option>
<?php elseif ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6'): ?>
                          <option value="6" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6'): ?> selected="selected"<?php endif; ?>>Picked Up</option>
                          <option value="4" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '4'): ?> selected="selected"<?php endif; ?>>Dropped</option>
                          <option value="5" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?> selected="selected"<?php endif; ?>>Scheduled</option>

<?php elseif ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '9'): ?>	
                          <option value="9" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '9'): ?> selected="selected"<?php endif; ?>>Pending</option>
                          <option value="3" <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '3'): ?> selected="selected"<?php endif; ?>>Cancelled</option>
<?php endif; ?>
                        </select></td>
                      <td > <?php if ($this->_tpl_vars['st'] == '9'): ?>
                        <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status'] == '0'): ?>Pending<?php endif; ?><br/>
                        <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status'] == '0'): ?><span style="color:#66F; font-weight:bold;"><a href="#" onclick="ack('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
')">Ack. by Admin</a></span><?php endif; ?>
                <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['acknowledge_status'] == '2'): ?><span style="color:#F00; font-weight:bold;">Denied</span><?php endif; ?>
                        <?php else: ?> <!----><a title="[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
]" href="driver.php?dri_code=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
&a=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
&b=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
" target="_blank"><img alt="Track" border="0" src="../graphics/gps.png"></a><br/>
                        <a title="[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
] Multi Routes" href="driver_trips.php?dri_code=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
" target="_blank"><img alt="Track" border="0" src="../graphics/multiroutes.png"></a>
                        <?php endif; ?><!--<?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['gps'] != ''): ?> <a title="GPS" href="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['gps']; ?>
"><img alt="GPS" border="0"  src="../graphics/gps.png"></a><?php else: ?><img alt="GPS Not Installed" border="0"  src="../graphics/dgps.png"><?php endif; ?>&nbsp;&nbsp;
--></td>
                      <!--<td class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['sip'] != ''): ?><a href="sip:<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['sip']; ?>
" title="Call"><img alt="Call" border="0"  src="../graphics/call_driver.png"></a><?php else: ?><img alt="Call Not Configured" border="0"  src="../graphics/dcall.png"><?php endif; ?></td>-->
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                    </tr>
                    <?php endif; ?>
                  </table></td>
              </tr>
              <tr>
                <td><?php echo $this->_tpl_vars['paging']; ?>
</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 