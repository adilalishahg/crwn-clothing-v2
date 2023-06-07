<?php /* Smarty version 2.6.12, created on 2022-09-27 18:12:12
         compiled from triprequest.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDDFDk56m_SRbneFRHG3bNdRQjPOAQAhj4"></script>
<script language="JavaScript" type="text/javascript" src="suggest.js"></script>
<?php echo '
<script type="text/javascript" >
function initialize() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'autocomplete\')),
      { types: [\'geocode\'] });
}
function initialize2() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'autocomplete2\')),
      { types: [\'geocode\'] });
}
function initialize3() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'autocomplete3\')),
      { types: [\'geocode\'] });
}
function initialize4() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'ins_billing_address\')),
      { types: [\'geocode\'] });
}
function initialize5() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'pp_billing_address\')),
      { types: [\'geocode\'] });
}
function initialize6() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'autocomplete4\')),
      { types: [\'geocode\'] }); //alert(types);
}
function initialize7() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById(\'autocomplete5\')),
      { types: [\'geocode\'] });
}
function wcn(val){	if(val==\'Yes\'){	$(\'#wcnW,#wcnH\').show();}else{	$(\'#wcnW,#wcnH\').hide();}}	
function wait_legs(){
		var wait_time = $(\'#wait_time\').val();
		var triptype = $(\'#triptype\').val();
		if(wait_time==\'No\'){
			$(\'#waitA,#waitB,#waitC,#waitD\').hide();
			$(\'#wait_timeA,#wait_timeB,#wait_timeC,#wait_timeD\').removeClass(\'required\');
			//alert(triptype);
			}else{
			if(triptype==\'One Way\'){
				$(\'#waitB,#waitC,#waitD\').hide();
				$(\'#waitA\').show();
				$(\'#wait_timeB,#wait_timeC,#wait_timeD\').removeClass(\'required\');
				$(\'#wait_timeA\').addClass(\'required\');}
			else if(triptype==\'Round Trip\'){
				$(\'#waitC,#waitD\').hide();
				$(\'#waitA,#waitB\').show();
				$(\'#wait_timeC,#wait_timeD\').removeClass(\'required\');
				$(\'#wait_timeA,#wait_timeB\').addClass(\'required\');}
			else if(triptype==\'Three Way\'){
				$(\'#waitD\').hide();
				$(\'#waitA,#waitB,#waitC\').show();
				$(\'#wait_timeD\').removeClass(\'required\');
				$(\'#wait_timeA,#wait_timeB,#wait_timeC\').addClass(\'required\');}
			else if(triptype==\'Four Way\'){
				$(\'#waitA,#waitB,#waitC,#waitD\').show();
				//$(\'#wait_timeA,#wait_timeB,#wait_timeC,#wait_timeD\').removeClass(\'required\');
				$(\'#wait_timeA,#wait_timeB,#wait_timeC,#wait_timeD\').addClass(\'required\');}		
			//alert(triptype);
			}
		//alert(\'In\');
		}	

 function bringlocations(account_id,location_id){ //  alert(account_id);  alert(location_id);
 	 var account_text= location_id.options[location_id.selectedIndex].text;
	 $("#referral_sources").val(account_text);

	 $.post("bringlocations.php", {account_id: ""+account_id, location_id: ""+location_id}, function(data){ //alert(data);
	 if(data.length > 0 ){  //location.reload();

	 document.getElementById(\'office_location\').innerHTML = (\'<select   name="officelocation" required="required" class="form-control" id="officelocation">\'+data+\'</select>\'); }
	 });}
function bringlocations2(account_id,location_id){  //alert(account_id);  alert(location_id);
 	 //var account_text= location_id.options[location_id.selectedIndex].text;
	 //$("#referral_sources").val(account_text);

	 $.post("bringlocations.php", {account_id: ""+account_id, location_id: ""+location_id}, function(data){ //alert(data);
	 if(data.length > 0 ){  //location.reload();

	 document.getElementById(\'office_location\').innerHTML = (\'<select   name="officelocation" required="required" class="form-control" id="officelocation">\'+data+\'</select>\'); }
	 });}	 
 
 
function disableEnterKey(e)
{    var key;      
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox      

     return (key != 13);
}

function populatedata(){
	var pname = $(\'#pname\').val();  //alert(patientname);
	$.post("fetchdata_patient_portal.php", {searchby: ""+pname,by: ""+"name"}, function(data){
				if(data.length > 0) { console.log(data);
				var obj = JSON.parse(data); 
				//	$(\'#autocomplete\').val(obj.address);
				//alert(obj.account);
				//if(obj.account!=\'\'){$(\'#account\').val(obj.account);    rate_type(obj.account);}
				if(obj.triptype!=\'\'){$(\'#triptype\').val(obj.triptype);}
				if(obj.vehtype!=\'\'){$(\'#vehtype\').val(obj.vehtype);}
				//if(obj.appdate!=\'\'){$(\'#appdate\').val(obj.appdate);}
				
				if(obj.returnpickup!=\'\'){
					if(obj.returnpickup==\'00:00:00\'){
						pUchoice(\'Will Call\');
						$(\'#puchoice\').val(\'Will Call\');
					}else{
						$(\'#puchoice\').val(\'Time\');
						$(\'#returnpickup\').val(obj.returnpickup);
						$(\'#returnpickuprad\').val(obj.returnpickuprad); 
						$(\'#returnpickup\').attr("class","txt_box required");
						$(\'#rpTime\').show();	
					}
				}
				if(obj.apptime!=\'\'){
					$(\'#apptime\').val(obj.apptime);
					$(\'#apptimerad\').val(obj.apptimerad);
					var t = obj.apptime;
					if(t){ 
						var res = t.split(":"); 
						var hours=((Number(res[0])+1));
						var ziro="0";
						if(hours<10){hours = ziro+hours; } 
						var minutes=res[1]; 
						$(\'#org_apptime\').val(hours+\':\'+minutes); 
					}
				}
				if(obj.org_apptime!=\'\'){
					$(\'#org_apptime\').val(obj.org_apptime);
					$(\'#org_apptimerad\').val(obj.org_apptimerad);
					}
				if(obj.three_pickup!=\'\'){$(\'#three_pickup\').val(obj.three_pickup.substr(0,5));}
				if(obj.four_pickup!=\'\'){$(\'#four_pickup\').val(obj.four_pickup.substr(0,5));}
				if(obj.gander!=\'\'){
					if(obj.gander==\'Male\'){
						$(\'#sex1\').attr("checked", true); 
					} else {
						$(\'#sex2\').attr("checked", true);
					}
				
				}	
				if(obj.cisid!=\'\'){$(\'#cisid\').val(obj.cisid);}
				if(obj.stretcher!=\'\'){if(obj.stretcher==\'Yes\')$("#stretcher").attr("checked",true);}
				if(obj.dstretcher!=\'\'){if(obj.dstretcher==\'Yes\')$(\'#dstretcher\').attr("checked",true);}
				if(obj.bar_stretcher!=\'\'){if(obj.bar_stretcher==\'Yes\')$(\'#bar_stretcher\').attr("checked",true);}
				if(obj.escort!=\'\'){if(obj.escort==\'Yes\')$(\'#escort\').attr("checked",true);}
				if(obj.wchair!=\'\'){if(obj.wchair==\'Yes\')$(\'#wchair\').attr("checked", true);}
				if(obj.dwchair!=\'\'){if(obj.dwchair==\'Yes\')$(\'#dwchair\').attr("checked", true);}
				if(obj.oxygen!=\'\'){if(obj.oxygen==\'Yes\')$(\'#oxygen\').attr("checked", true);}	
				
				if(obj.clientname!=\'\'){$(\'#pname\').val(obj.clientname);}				
				if(obj.phnum!=\'\'){$(\'#phnum\').val(obj.phnum);}
				if(obj.dob!=\'\'){$(\'#dob\').val(obj.dob);}					
				if(obj.po!=\'\'){$(\'#po\').val(obj.po);}
				if(obj.claim_no!=\'\'){$(\'#claim_no\').val(obj.claim_no);}
				if(obj.patient_weight!=\'\'){$(\'#patient_weight\').val(obj.patient_weight);}
				
				if(obj.p_phnum!=\'\'){$(\'#p_phnum\').val(obj.p_phnum);}
				if(obj.d_phnum!=\'\'){$(\'#d_phnum\').val(obj.d_phnum);}
				if(obj.d_phnum2!=\'\'){$(\'#d_phnum2\').val(obj.d_phnum2);}
				if(obj.d_phnum3!=\'\'){$(\'#d_phnum3\').val(obj.d_phnum3);}
				if(obj.backto_phnum!=\'\'){$(\'#backto_phnum\').val(obj.backto_phnum);}
				
				if(obj.picklocation!=\'\'){$(\'#picklocation\').val(obj.picklocation);}
				if(obj.droplocation!=\'\'){$(\'#droplocation\').val(obj.droplocation);}
				if(obj.droplocation2!=\'\'){$(\'#droplocation2\').val(obj.droplocation2);}
				if(obj.droplocation3!=\'\'){$(\'#droplocation3\').val(obj.droplocation3);}
				if(obj.backtolocation!=\'\'){$(\'#backtolocation\').val(obj.backtolocation);}
				
				if(obj.pickaddress!=\'\'){$(\'#autocomplete\').val(obj.pickaddress);}
				if(obj.destination!=\'\'){$(\'#autocomplete2\').val(obj.destination);}
				if(obj.three_address!=\'\'){$(\'#destination2\').val(obj.three_address);}
				if(obj.four_address!=\'\'){$(\'#destination3\').val(obj.four_address);}
				if(obj.backto!=\'\'){$(\'#autocomplete3\').val(obj.backto);}
				
				if(obj.psuiteroom!=\'\'){$(\'#psuiteroom\').val(obj.psuiteroom);}
				if(obj.dsuiteroom!=\'\'){$(\'#dsuiteroom\').val(obj.dsuiteroom);}
				if(obj.dsuiteroom2!=\'\'){$(\'#dsuiteroom2\').val(obj.dsuiteroom2);}
				if(obj.dsuiteroom3!=\'\'){$(\'#dsuiteroom3\').val(obj.dsuiteroom3);}
				if(obj.bsuiteroom!=\'\'){$(\'#bsuiteroom\').val(obj.bsuiteroom);}
				
				if(obj.pickup_instruction!=\'\'){$(\'#pickup_instruction\').val(obj.pickup_instruction);}
				if(obj.destination_instruction!=\'\'){$(\'#destination_instruction\').val(obj.destination_instruction);}
				if(obj.destination_instruction2!=\'\'){$(\'#destination_instruction2\').val(obj.destination_instruction2);}
				if(obj.destination_instruction3!=\'\'){$(\'#destination_instruction3\').val(obj.destination_instruction3);}
				if(obj.backto_instruction!=\'\'){$(\'#backto_instruction\').val(obj.backto_instruction);}
				
				if(obj.casemanager!=\'\'){$(\'#casemanager1\').val(obj.casemanager);}
				if(obj.comments!=\'\'){$(\'#comments\').val(obj.comments);}
				if(obj.insurance_name!=\'\'){$(\'#insurance_name\').val(obj.insurance_name);}
				if(obj.ssn!=\'\'){$(\'#ssn\').val(obj.ssn);}
				if(obj.appt_type!=\'\'){$(\'#type\').val(obj.appt_type);}
				
				chTrip(obj.triptype);
			
			   }   
		   });
	}
function time(t){ 
//var atime = document.getElementById(\'t\').value; 
var atime = $(\'#\'+t).val();
//alert(atime);
var hours = atime.split(\':\');
var hour = hours[0];
var minut = hours[1]; 
if(hour >12 || minut >59) 
{
alert(\'Please enter correct Time!\');
$(\'#\'+t).val(\'\');
return false }}	

function checkTimeXXX(){
	var apptime 		= $(\'#apptime\').val();
	var apptimerad 		= $(\'#apptimerad\').val();
	if(apptimerad==\'am\'){
		var add=parseInt(0);}else{var add=parseInt(12);}
	var hours = apptime.split(\':\');
	var hour =  parseInt(hours[0]);
	var minut = (hours[1]);
	//var pickTime=(hour+add)+\'\'+minut;
	var pickTime=((hour*3600)+(add*2600))+(minut*60);
	//alert(pickTime);
	var org_apptime 	= $(\'#org_apptime\').val();
	var org_apptimerad 	= $(\'#org_apptimerad\').val();
	
	if(org_apptimerad==\'am\'){
		var add2=parseInt(0);}else{var add2=parseInt(12);}
	var hours2 = org_apptime.split(\':\');
	var hour2 =  parseInt(hours2[0]);
	var minut2 = (hours2[1]);
	//var appointmentTime=(hour2+add2)+\'\'+minut2;
	var appointmentTime=((hour2*3600)+(add2*2600))+(minut2*60);
	
		//alert(appointmentTime);
		
	
  	
		alert(pickTime);
		alert(appointmentTime);
	if(pickTime	>= appointmentTime){alert(\'Appointment time should be greater than pickup time.\'); $(\'#org_apptime\').val(\'\'); $(\'#org_apptimerad\').val(\'\');}
	}
	
function checkTime(){
	var apptime 		= $(\'#apptime\').val();
	var apptimerad 		= $(\'#apptimerad\').val();
	
	var time = apptime + " "+ apptimerad;
var hours = Number(time.match(/^(\\d+)/)[1]);
var minutes = Number(time.match(/:(\\d+)/)[1]);
var AMPM = time.match(/\\s(.*)$/)[1];
if(AMPM == "pm" && hours<12) hours = hours+12;
if(AMPM == "am" && hours==12) hours = hours-12;
var sHours = hours.toString();
var sMinutes = minutes.toString();
if(hours<10) sHours = "0" + sHours;
if(minutes<10) sMinutes = "0" + sMinutes;
//alert(sHours + ":" + sMinutes);
	var PickTime	=	sHours + "" + sMinutes;
	//alert(PickTime);
	
	var org_apptime 	= $(\'#org_apptime\').val();
	var org_apptimerad 	= $(\'#org_apptimerad\').val();
	
	var time = org_apptime + " "+ org_apptimerad;
var hours = Number(time.match(/^(\\d+)/)[1]);
var minutes = Number(time.match(/:(\\d+)/)[1]);
var AMPM = time.match(/\\s(.*)$/)[1];
if(AMPM == "pm" && hours<12) hours = hours+12;
if(AMPM == "am" && hours==12) hours = hours-12;
var sHours = hours.toString();
var sMinutes = minutes.toString();
if(hours<10) sHours = "0" + sHours;
if(minutes<10) sMinutes = "0" + sMinutes;
//alert(sHours + ":" + sMinutes);
	var AppointmentTime	=	sHours + "" + sMinutes;
	//alert(AppointmentTime);	
	if(PickTime	>= AppointmentTime){alert(\'Appointment time should be greater than pickup time.\'); $(\'#org_apptime\').val(\'\'); $(\'#org_apptimerad\').val(\'\');}
	}	
	
function CheckdriversAvailibility(url,typ){
	if(typ == \'pick\'){
		var appdate = $(\'#appdate\').val();
	//	var apptime	= $(\'#apptime\').val(); // || apptime==\'\'
		if(appdate==\'\'){alert(\'To see driver free slots, please select appointment date and pick up time.\'); return false; }
		
		}
	
	
   myWindow1 = window.open( url+"?date="+appdate, "myWindow1", 
"status = 1, height = 750, width = 1200, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
</script>
'; ?>

<body onLoad="initialize(); initialize2(); initialize3();  initialize4(); initialize5();  initialize6(); initialize7();">

	<section class="section gray">
	<div class="w-container">
		<!--<div class="top-title">
			<div class="title-txt">
			<h1>Request Dispatch</h1>
			</div>
		</div>-->	
       <!-- <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "alert.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>-->
	<div class="w-col-12">
	<div class="row contact-wrap" style="padding:100 100 100 100px;"> 
<!-----------------------------------------Start form-------------------------------------------------------->		
          <?php if ($this->_tpl_vars['error'] != ''): ?><div style="color:red;"><?php echo $this->_tpl_vars['error']; ?>
</div><?php endif; ?>
            <form id="form" method="post" name="uss" action="triprequest.php"  autocomplete="off">
                <div class="row">
				<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
				New Trip Request
				</div> 
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">

						<div class="col-sm-6" >
							<div class="input-group">
								<span class="input-group-addon">Account Name *</span>
                                
                                <input type="text" name="accountXXX" value="<?php echo $this->_tpl_vars['accounts']['0']['account_name']; ?>
"  class="form-control"  readonly   onKeyPress="return disableEnterKey(event)"/>
                                <input type="hidden" name="account" value="<?php echo $this->_tpl_vars['accounts']['0']['id']; ?>
" />
								<!--<select name="account" id="account"  required="required" class="form-control" onChange="bringlocations(this.value,this)" readonly="readonly"  onKeyPress="return disableEnterKey(event)"  autocomplete="off">
                                	<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['accounts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
									<option value="<?php echo $this->_tpl_vars['accounts'][$this->_sections['n']['index']]['id']; ?>
"  <?php if ($this->_tpl_vars['accounts'][$this->_sections['n']['index']]['id'] == $this->_tpl_vars['post']['account']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['accounts'][$this->_sections['n']['index']]['account_name']; ?>
 </option>
									<?php endfor; endif; ?>
								</select>-->
							</div>
						</div>
                       
						 <div class="col-sm-4">
							<div class="input-group">
							<span class="input-group-addon">Patient Name *</span>
							<input type="text" list="clients" name="pname" id="pname" <?php if ($_SESSION['type'] == 'pa'): ?>value="<?php echo $_SESSION['userdata']['name']; ?>
" readonly<?php else: ?>value="<?php echo $this->_tpl_vars['post']['pname']; ?>
" <?php endif; ?> class="form-control" placeholder="Patient Name" required="required"  onKeyPress="return disableEnterKey(event)"/>
							<datalist id="clients">
								<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['clientName']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
									<option value="<?php echo $this->_tpl_vars['clientName'][$this->_sections['index']['index']]; ?>
">
								<?php endfor; endif; ?>
							</datalist>
                            <div id="layer1"></div>
                            </div>
						</div><?php if ($_SESSION['type'] == 'ac'): ?>
                        <div class="col-sm-2"><span style="font-size:14px; font-weight:bold; color:#F00;" title="Populate Patient Data"><a href="#" onClick="populatedata()" id="populate">Click For Auto Populate</a></span></div><?php endif; ?>
                        <div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Patient Phone No *</span>
							<input type="text" name="phnum" id="phnum" class="form-control phone"  value="<?php echo $this->_tpl_vars['post']['phnum']; ?>
" placeholder="Phone Number"  maxlength="14" required="required"  onKeyPress="return disableEnterKey(event)"/>
							</div>
						</div>
						<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">PO # </span>
							<input type="text" name="po" id="po" value="<?php echo $this->_tpl_vars['post']['po']; ?>
" class="form-control" placeholder="PO #" >
							</div>
						</div>
                        <!--<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Trip # </span>
							<input type="text" name="tripnumber" id="tripnumber" value="<?php echo $this->_tpl_vars['tripnumber']; ?>
" class="form-control" placeholder="Trip #" readonly >
							</div>
						</div>-->
                        <div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">DOB</span>
							<input type="text" name="dob" id="dob" class="form-control dob" <?php if ($this->_tpl_vars['post']['dob'] != ''): ?> value="<?php echo $this->_tpl_vars['post']['dob']; ?>
" <?php endif; ?> placeholder="Date of Birth"  maxlength="14" readonly="readonly">
							</div>
						</div>
                        
                        
                        
						</div>
			
				<!--<div class="row" style="margin-top:20px; margin-left:20px">
				<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">Trip Information</div> 
                </div>-->
				<div class="row" style="margin-top:20px;margin-left:20px;">
						<div class="col-sm-6" >
							<div class="input-group">
								<span class="input-group-addon">Select Trip Type *</span>
								<select class="form-control" name="triptype"  id="triptype" onChange="return chTrip(this.value);"  onKeyPress="return disableEnterKey(event)" required>
									<option value="">--Select Trip Type--</option>
									<option value="One Way" <?php if ($this->_tpl_vars['post']['triptype'] == 'One Way' || $this->_tpl_vars['post']['triptype'] == ''): ?>selected<?php endif; ?>>
                                    One Way--(1 Destination)
									</option>
									<option value="Round Trip" <?php if ($this->_tpl_vars['post']['triptype'] == 'Round Trip'): ?>selected<?php endif; ?>>
									Two Way--(Round Trip)
									</option>
									<!--<option value="Three Way" <?php if ($this->_tpl_vars['post']['triptype'] == 'Three Way'): ?>selected<?php endif; ?>>
									Three Way--(3 Destinations)
									</option>
									<option value="Four Way" 	<?php if ($this->_tpl_vars['post']['triptype'] == 'Four Way'): ?>selected<?php endif; ?>>
									Four Way--(4 Destinations)
									</option>-->
								</select>
							</div>
						</div>
						<div class="col-sm-6" >
							<div class="input-group">
							<span class="input-group-addon">Vehicle Preference *</span>
                            
                            
					  <!--<select name="vehtype" class="form-control" id="vehtype"  onKeyPress="return disableEnterKey(event)" required>
                      <option value="">Select Vehicle Preference</option>
                      <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['vehiclepref']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <option value="<?php echo $this->_tpl_vars['vehiclepref'][$this->_sections['q']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['post']['vehtype'] == $this->_tpl_vars['vehiclepref'][$this->_sections['q']['index']]['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['vehiclepref'][$this->_sections['q']['index']]['vehtype']; ?>
</option>                      
                     <?php endfor; endif; ?>
		                 </select>-->
							
                            
                            <input type="text" name="vehtypeXXX" value="<?php echo $this->_tpl_vars['vehiclepref']['0']['vehtype']; ?>
"  class="form-control"  readonly   onKeyPress="return disableEnterKey(event)"/>
                            <input type="hidden" name="vehtype" value="<?php echo $this->_tpl_vars['vehiclepref']['0']['id']; ?>
" />
                            
                            
                            
                            </div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Oxygen Needed ?</span>
							<select name="oxygen"  class="form-control" id="oxygen" onChange="warhja(this.value)"  onKeyPress="return disableEnterKey(event)">
                      <option value="No" <?php if ($this->_tpl_vars['post']['oxygen'] == 'No'): ?>selected<?php endif; ?>> No </option> 
                      <option value="Yes" <?php if ($this->_tpl_vars['post']['oxygen'] == 'Yes'): ?>selected<?php endif; ?>> Yes </option>
                    </select>
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Appointment Date *</span>
							<input type="text" name="appdate" id="appdate" value="<?php echo $this->_tpl_vars['post']['appdate']; ?>
" placeholder="Appointment Date" class="form-control apdate_nextday" required="required" readonly="readonly"  onKeyPress="return disableEnterKey(event)">
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">PickUp Time *</span>
							<select name="apptime" id="apptime" class="form-control" required>
								<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['intervalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
" <?php if ($this->_tpl_vars['intervalList'][$this->_sections['index']['index']] == $this->_tpl_vars['post']['apptime']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
</option>
								<?php endfor; endif; ?>
							</select>
							                            <select  class="input-group-addon" name="apptimerad" id="apptimerad" style="width: 100%;"><option value="am">AM</option><option value="pm">PM</option></select>
							                            
                            <span class="input-group-addon"><a onClick="CheckdriversAvailibility('driver_availibility.php','pick')">Free Driver Slots</a></span>
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Appointment Time *</span>
							<select name="org_apptime" id="org_apptime" class="form-control"  required>
								                           
								<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['intervalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
" <?php if ($this->_tpl_vars['intervalList'][$this->_sections['index']['index']] == $this->_tpl_vars['post']['org_apptime']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
</option>
								<?php endfor; endif; ?>
							</select>
							<span class="input-group-addon"><select  name="org_apptimerad" id="org_apptimerad" onChange="checkTime()" required>
                            <option value=""> -- </option>	  <option value="am">AM</option><option value="pm">PM</option></select></span>
							</div>
						</div>
                        
                        <div class="col-sm-6"  id="rpu" style="margin-top:20px; display:none;">
							<div class="input-group">
							<span class="input-group-addon">Return Pickup(For last destination)</span>
							<select name="puchoice" id="puchoice"  onChange="return pUchoice(this.value);"  class="form-control"  onKeyPress="return disableEnterKey(event)">
								<option value="Time" <?php if ($this->_tpl_vars['post']['pickupchoice'] == 'Time'): ?>selected<?php endif; ?>>Time</option>
                                <option value="Will Call" <?php if ($this->_tpl_vars['post']['pickupchoice'] == 'Will Call'): ?>selected<?php endif; ?>>Will Call</option>
							</select>
							</div>
						</div>
						<div class="col-sm-6" id="rpTime" style="margin-top:20px;display:none;">
						<div class="input-group">
						<span class="input-group-addon">Return Pick Time</span>
						<select name="returnpickup" id="returnpickup1" class="form-control" required>
								<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['intervalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
" <?php if ($this->_tpl_vars['intervalList'][$this->_sections['index']['index']] == $this->_tpl_vars['post']['returnpickup']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
</option>
								<?php endfor; endif; ?>
						</select>
												<select class="input-group-addon" name="returnpickuprad" id="returnpickuprad" style="width: 100%;">
                            <option value="am">AM</option><option value="pm">PM</option></select>
						                            <span class="input-group-addon"><a onClick="CheckdriversAvailibility('driver_availibility.php','pick')"> Free Driver Slots</a></span>
						</div>
					</div>
				</div>	
                
				<div style="color: red; font-size:18px; font-weight:bold;">
					<div class="col-sm-12" style="margin-top: 30px;margin-left:40px;">
						<div class="input-group">Please let us know if your preferred time is not available, so we can try to reschedule</div>
					</div>
				</div>
                
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
					Pick Up Information
					</div> 
                </div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pickup Location </span>
						<input type="text" name="picklocation" id="picklocation" value="<?php echo $this->_tpl_vars['post']['picklocation']; ?>
" class="form-control" placeholder="Pickup Location"  onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pickup Address *</span>
						<input type="text" name="pickaddress" class="form-control" id="autocomplete" value="<?php echo $this->_tpl_vars['post']['pickaddress']; ?>
"  placeholder="Pickup Address" required="required"  autocomplete="off" onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
				</div>	
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room </span>
						<input type="text" name="psuiteroom" id="psuiteroom" value="<?php echo $this->_tpl_vars['post']['psuiteroom']; ?>
" class="form-control"  maxlength="20" placeholder="Suite/Apt/Bld/Room " onKeyPress="return disableEnterKey(event)" />
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Same as patient phone # *</span>
						<input type="checkbox" id="pckphone" class="form-control" onClick="samephone('phnum','p_phnum','pckphone');" onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pick Up Instructions </span>
						<textarea name="pickup_instruction" id="pickup_instruction" class="form-control" placeholder="Pick Up Instructions" rows="2"><?php echo $this->_tpl_vars['post']['pickup_instruction']; ?>
</textarea>
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pick Phone Number </span>
						<input type="text" name="p_phnum" id="p_phnum" value="<?php echo $this->_tpl_vars['post']['p_phnum']; ?>
" class="form-control phone" maxlength="14" placeholder="Pick Phone Number" onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
				</div>	
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
					First Destination Address
					</div> 
                    </div>
				<div class="row" style="margin-top:20px; margin-left:20px">	
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Drop Location </span>
						<input type="text" name="droplocation" value="<?php echo $this->_tpl_vars['post']['droplocation']; ?>
" id="droplocation" class="form-control" placeholder="Drop Location" onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Address *</span>
						<input type="text" name="destination" id="autocomplete2" value="<?php echo $this->_tpl_vars['post']['destination']; ?>
" class="form-control" placeholder="Destination Address" required="required" onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  </span>
						<input type="text" name="dsuiteroom" id="dsuiteroom" value="<?php echo $this->_tpl_vars['post']['dsuiteroom']; ?>
" class="form-control" placeholder="Suite/Apt/Bld/Room " onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
                    <div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Phone Number </span>
						<input type="text" name="d_phnum" id="d_phnum" class="form-control phone"  value="<?php echo $this->_tpl_vars['post']['d_phnum']; ?>
" placeholder="Destination Phone Number" onKeyPress="return disableEnterKey(event)">
						</div>
					</div>
				</div>	
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Instructions</span>
						<textarea name="destination_instruction" id="destination_instruction"  class="form-control" placeholder="Destination Instructions"><?php echo $this->_tpl_vars['post']['destination_instruction']; ?>
</textarea>
						</div>
					</div>
					
				</div>	
				<section class="section" id="second" style="display:none;">
				<div class="row" >
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
						Second Destination Information
					</div> 
                </div>
				<div class="row" style="margin-top:20px; margin-left:20px;"  >
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">2nd Pick Time *</span>
						<select name="three_pickup" id="three_pickup" class="form-control">
								<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['intervalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
"><?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
</option>
								<?php endfor; endif; ?>
						</select>
						<span class="input-group-addon"><select  name="three_pickuprad" id="three_pickuprad" >
                            <option value="am">AM</option><option value="pm">PM</option></select></span>
						</div>
					</div>
					<div class="col-sm-6" id="three1" >
						<div class="input-group">
						<span class="input-group-addon">Will Call *</span>
						<input class="form-control" type="checkbox" name="three_will_call" id="three_will_call" onClick="check_check3();" <?php if ($this->_tpl_vars['post']['three_will_call'] == 'on'): ?> checked="checked" <?php endif; ?>  onKeyPress="return disableEnterKey(event)" onBlur="return time(this.id);"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" id="three2" style="margin-top:20px; ">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Location *</span>
						<input class="form-control" type="text" name="droplocation2" id="droplocation2" value="<?php echo $this->_tpl_vars['post']['droplocation2']; ?>
"  onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Address *</span>
						<input class="form-control" type="text" name="destination2" id="destination2"  value="<?php echo $this->_tpl_vars['post']['destination2']; ?>
"  onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  </span>
						<input class="form-control" type="text" name="dsuiteroom2" id="dsuiteroom2" value="<?php echo $this->_tpl_vars['post']['dsuiteroom2']; ?>
" maxlength="150" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Phone Number # </span>
						<input class="form-control phone" type="text" name="d_phnum2" id="d_phnum2" value="<?php echo $this->_tpl_vars['post']['d_phnum2']; ?>
" maxlength="14"  onChange="use_same(this.id);"  onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Instructions </span>
						<textarea class="form-control" name="destination_instruction2" id="destination_instruction2"><?php echo $this->_tpl_vars['post']['destination_instruction2']; ?>
</textarea>
						</div>
					</div>
				</div>
				</section>				
				<section class="section" id="third" style="display:none;"> 
				<div class="row" style=" margin-top:20px; margin-left:20px">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
						Third Destination Address
					</div> 
                </div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" id="four1" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Pick Time *</span>
						<select name="four_pickup" id="four_pickup" class="form-control">
								<?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['intervalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
								<option value="<?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
" <?php if ($this->_tpl_vars['intervalList'][$this->_sections['index']['index']] == $this->_tpl_vars['post']['four_pickup']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['intervalList'][$this->_sections['index']['index']]; ?>
</option>
								<?php endfor; endif; ?>
						</select>
						<span class="input-group-addon"><select name="four_pickuprad" id="four_pickuprad" >
                            <option value="am">AM</option><option value="pm">PM</option></select></span>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Will Call *</span>
						<input class="form-control" type="checkbox" name="four_will_call" id="four_will_call" onClick="check_check3();" <?php if ($this->_tpl_vars['post']['four_will_call'] == 'on'): ?> checked="checked" <?php endif; ?>  onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Location </span>
						<input class="form-control" type="text" name="droplocation3" id="droplocation3" value="<?php echo $this->_tpl_vars['post']['droplocation3']; ?>
"  onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Address *</span>
						<input class="form-control" type="text" name="destination3" id="destination3"  value="<?php echo $this->_tpl_vars['post']['destination3']; ?>
" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  </span>
						<input class="form-control" type="text" name="dsuiteroom3" id="dsuiteroom3" value="<?php echo $this->_tpl_vars['post']['dsuiteroom3']; ?>
"  maxlength="150" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Phone Number # </span>
						<input class="form-control phone" type="text" name="d_phnum3" id="d_phnum3" value="<?php echo $this->_tpl_vars['post']['d_phnum3']; ?>
" maxlength="14"  onChange="use_same(this.id);"  onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
					<div class="col-sm-6" id="four6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Instructions </span>
						<textarea class="form-control" name="destination_instruction3" id="destination_instruction3"><?php echo $this->_tpl_vars['post']['destination_instruction3']; ?>
</textarea>
						</div>
					</div>
				</div>
				</section>
				<section class="section" id="bck" style="display:none;">
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
						Last Destination Address
					</div> </div>
                    <div class="row" style="margin-top:20px; margin-left:20px;">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Use Same Pickup Information </span>
						<input class="form-control"  type="checkbox" name="sameadd" id="sameadd" onClick="samepickaddress();" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
				</div>
                <div class="row" style="margin-top:20px; margin-left:20px;">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back To Location </span>
						<input class="form-control"  name="backtolocation" type="text" id="backtolocation" value="<?php echo $this->_tpl_vars['post']['backtolocation']; ?>
" maxlength="550" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
                    <div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back To Address *</span>
						<input class="form-control" name="backto" type="text" id="autocomplete3" value="<?php echo $this->_tpl_vars['post']['backto']; ?>
" maxlength="150" placeholder="Enter Complete Back To Address" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px;">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room </span>
						<input class="form-control" type="text" name="bsuiteroom" id="bsuiteroom" value="<?php echo $this->_tpl_vars['post']['bsuiteroom']; ?>
" maxlength="150" onKeyPress="return disableEnterKey(event)"/>
						</div>
					</div>
                    <div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back to Instructions </span>
						<textarea class="form-control" name="backto_instruction" id="backto_instruction"><?php echo $this->_tpl_vars['post']['backto_instruction']; ?>
</textarea>
						</div>
					</div>
				</div>
                </section>
				<!--	<div class="row">
	<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
					General Options
					</div> 
                    </div>
				<div class="row" style="margin-top:20px; margin-left:20px">	
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Same as patient phone # *</span>
						<input type="checkbox" name="email" class="form-control" placeholder="Pick Phone Number" required="required">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Same as patient phone # *</span>
						<input type="checkbox" name="email" class="form-control" placeholder="Pick Phone Number" required="required">
						</div>
					</div>
				</div>	-->
               
                
					<div class="row" style="margin-top:20px; margin-left:20px; display:none;">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
					Recurring (Blanket Orders)
					<input type="checkbox" name="check_recc" id="check_recc" class="form-control" onClick="check_cecc();" <?php if ($this->_tpl_vars['post']['check_recc'] == 'on'): ?> checked <?php endif; ?>>
					</div> 
                    </div>
					
				<div id="recc" style="display:none; margin-top:20px; margin-left:20px " >
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon" style="width:110px"><input type="checkbox" id="monday" name="monday" onChange="checkrecday(this.id);" />&nbsp;&nbsp;&nbsp;Monday</span>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Pick Time </span>
						<input  name="aptmonday" id="aptmonday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'aptmonday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">ReturnPick Time  </span>
						<input  name="retmonday" id="retmonday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'retmonday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Till Date </span>
						<input name="tdmonday" id="tdmonday" type="text"  class="form-control apdate2_nextday" size="20" maxlength="10"  autocomplete="off" disabled="disabled"/>
						</div>
					</div>
					</div>
					
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon" style="width:110px"><input type="checkbox" id="tuseday" name="tuseday"  onchange="checkrecday(this.id);" />
                          &nbsp;&nbsp;&nbsp;Tuesday</span>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Pick Time </span>
						<input  name="apttuseday" id="apttuseday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'apttuseday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">ReturnPick Time </span>
						<input  name="rettuseday" id="rettuseday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'rettuseday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Till Date </span>
						<input name="tdtuseday" id="tdtuseday" type="text"  class="form-control apdate2_nextday" size="20" maxlength="10"  autocomplete="off" disabled="disabled"/>
						</div>
					</div>
					</div>
					
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon"  style="width:110px"><input type="checkbox" id="wednesday" name="wednesday"  onchange="checkrecday(this.id);" />
                          &nbsp;&nbsp;&nbsp;Wednesday</span>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Pick Time </span>
						<input  name="aptwednesday" id="aptwednesday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'aptwednesday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">ReturnPick Time  </span>
						<input  name="retwednesday" id="retwednesday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'retwednesday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Till Date </span>
						<input name="tdwednesday" id="tdwednesday" type="text"  class="form-control apdate2_nextday" size="20" maxlength="10"  autocomplete="off" disabled="disabled"/>
						</div>
					</div>
					</div>
					
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon" style="width:110px"><input type="checkbox" id="thirsday" name="thirsday"  onchange="checkrecday(this.id);" />
                          &nbsp;&nbsp;&nbsp;Thursday</span>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Pick Time </span>
						<input  name="aptthirsday" id="aptthirsday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'aptthirsday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">ReturnPick Time </span>
						<input  name="retthirsday" id="retthirsday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'retthirsday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Till Date </span>
						<input name="tdthirsday" id="tdthirsday" type="text"  class="form-control apdate2_nextday" size="20" maxlength="10" autocomplete="off" disabled="disabled"/>
						</div>
					</div>
					</div>
					
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon"  style="width:110px"><input type="checkbox" id="friday" name="friday"  onchange="checkrecday(this.id);" />
                          &nbsp;&nbsp;&nbsp;Friday</span>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Pick Time </span>
						<input  name="aptfriday" id="aptfriday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'aptfriday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">ReturnPick Time </span>
						<input  name="retfriday" id="retfriday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'retfriday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Till Date </span>
						<input name="tdfriday" id="tdfriday" type="text"  class="form-control apdate2_nextday" size="20" maxlength="10" autocomplete="off" disabled="disabled"/>
						</div>
					</div>
					</div>
					
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon" style="width:110px"><input type="checkbox" id="saturday" name="saturday"  onchange="checkrecday(this.id);" />
                          &nbsp;Saturday</span>
						</div>
					 </div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Pick Time </span>
						<input  name="aptsaturday" id="aptsaturday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'aptsaturday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">ReturnPick Time </span>
						<input  name="retsaturday" id="retsaturday" type="text" class="form-control time" size="15" maxlength="8" onBlur="return tValid(this.value,'retsaturday');" disabled="disabled"/>
						</div>
					</div>
					<div class="col-sm-3" >
						<div class="input-group">
						<span class="input-group-addon">Till Date </span>
						<input name="tdsaturday" id="tdsaturday" type="text"  class="form-control apdate2_nextday" size="20" maxlength="10" autocomplete="off" disabled="disabled" />
						  <input type="hidden" name="mon" value="monday" />
                          <input type="hidden" name="tus" value="tuesday" />
                          <input type="hidden" name="wed" value="wednesday" />
                          <input type="hidden" name="thi" value="thursday" />
                          <input type="hidden" name="fri" value="friday" />
                          <input type="hidden" name="sat" value="saturday" />
                        </div>
					</div>
					</div>
				</div>
					
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
					Comments OR Notes
					</div> 
                    </div>
					<div class="row" style="margin-top:20px; margin-left:20px">
						<div class="col-sm-12" >
							<div class="input-group">
								<span class="input-group-addon">Comments </span>
                                <textarea name="comments" id="comments"  class="form-control" rows="2" placeholder="Enter Trip Comments"><?php echo $this->_tpl_vars['post']['comments']; ?>
</textarea>
							</div>
						</div>
					</div>
                    <div class="row" style="margin-top:20px; margin-left:20px">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" id="submit"  value="submit" class="btn btn-primary btn-lg" >Submit Request</button>
							<!--<button type="reset" name="" class="btn btn-primary btn-lg" >Reset</button>-->
						</div>
                   </div>
            </form> 			
<!---------------------------------------------End of form---------------------------------------------------->			
        </div>
        </div>
     </div> 
    </section>  
</body>
 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footerlast.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="js/inputmasking.js"></script>
<script src="js/triprequest777.js"></script>
<?php echo '
 <!--{if $smarty.session.type eq \'ac\' || $smarty.session.type eq \'pa\'}
<script>check_cecc();</script>{/if}-->
<script>

$(\'.apdate_nextday\').datetimepicker({timepicker:false,format:\'m/d/Y\',value:\'';  echo $this->_tpl_vars['nextDay'];  echo '\',closeOnDateSelect: true,yearStart:year,minDate:\'';  echo $this->_tpl_vars['chkNextDay'];  echo '\',maxDate:\'+1970/06/30\',scrollInput: false});
$(\'.apdate2_nextday\').datetimepicker({timepicker:false,format:\'m/d/Y\',value:dt,closeOnDateSelect: true,yearStart:year,yearEnd:year+1,minDate:\'';  echo $this->_tpl_vars['chkNextDay'];  echo '\',maxDate:\'+1970/06/30\',scrollInput: false}).val(\'\');
</script>'; ?>

<?php echo '<script>chTrip(\'';  echo $this->_tpl_vars['post']['triptype'];  echo '\');</script>'; ?>

<?php echo '<script>bringlocations2(\'';  echo $this->_tpl_vars['post']['account'];  echo '\',\'';  echo $this->_tpl_vars['post']['officelocation'];  echo '\');</script>'; ?>

