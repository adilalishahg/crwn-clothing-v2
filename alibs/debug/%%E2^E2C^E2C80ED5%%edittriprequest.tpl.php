<?php /* Smarty version 2.6.12, created on 2022-07-19 19:36:52
         compiled from edittriprequest.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDDFDk56m_SRbneFRHG3bNdRQjPOAQAhj4"></script>
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
 function bringlocations(account_id,location_id,account_obj=0){ //alert(account_obj);
 	
 	if(account_obj!=0) {
 	 var account_text= account_obj.options[account_obj.selectedIndex].text;
	 $("#referral_sources").val(account_text);
	}

	 $.post("bringlocations.php", {account_id: ""+account_id, location_id: ""+location_id}, function(data){ //alert(data);
	 if(data.length > 0 ){  //location.reload();

	 document.getElementById(\'office_location\').innerHTML = (\'<select   name="officelocation" required="required" class="form-control" id="officelocation">\'+data+\'</select>\'); }
	 });}		
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
      <!--  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "alert.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>-->
	<div class="w-col-12">
	<div class="row contact-wrap" style="padding:100 100 100 100px;"> 
<!----------------------------------------- Start form -------------------------------------------------------->		
            <form id="form" method="post" name="uss" action="edittriprequest.php">
                <div class="row">
				<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
				Update Trip Request
				</div> 
				</div>
                
                <div class="row" style="margin-top:20px; margin-left:20px">

						<div class="col-sm-6" >
							<div class="input-group">
								<span class="input-group-addon">Account Name *</span>
								<select name="account" id="account"  required="required" class="form-control" onChange="bringlocations(this.value,this)"  onKeyPress="return disableEnterKey(event)">
                                	<?php if ($_SESSION['type'] == 'ac' || $_SESSION['type'] == 'cm' || $_SESSION['type'] == 'pa' || $_SESSION['type'] == ''): ?><!--<option value=""> - X - </option>--><?php endif; ?>
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
"  <?php if ($this->_tpl_vars['accounts'][$this->_sections['n']['index']]['id'] == $this->_tpl_vars['tripdata']['account']): ?> selected <?php endif; ?> ><?php echo $this->_tpl_vars['accounts'][$this->_sections['n']['index']]['account_name']; ?>
 </option>
									<?php endfor; endif; ?>
								</select>
							</div>
						</div>
                       
						 <div class="col-sm-6">
							<div class="input-group">
							<span class="input-group-addon">Patient Name *</span>
							<input type="text" name="pname" id="pname" <?php if ($_SESSION['type'] == 'pa'): ?>value="<?php echo $_SESSION['userdata']['name']; ?>
" readonly<?php else: ?>value="<?php echo $this->_tpl_vars['tripdata']['clientname']; ?>
" <?php endif; ?> class="form-control" placeholder="Patient Name" required="required"  onKeyPress="return disableEnterKey(event)"/>
							</div>
						</div>
                        <div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Patient Phone No *</span>
							<input type="text" name="phnum" id="phnum" class="form-control phone"  value="<?php echo $this->_tpl_vars['tripdata']['phnum']; ?>
" placeholder="Phone Number"  maxlength="14" required="required"  onKeyPress="return disableEnterKey(event)"/>
							</div>
						</div>
						<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">PO # </span>
							<input type="text" name="po" id="po" value="<?php echo $this->_tpl_vars['tripdata']['po']; ?>
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
							<input type="text" name="dob" id="dob" class="form-control dob" <?php if ($this->_tpl_vars['tripdata']['dob'] != ''): ?> value="<?php echo $this->_tpl_vars['tripdata']['dob']; ?>
" <?php endif; ?> placeholder="Date of Birth"  maxlength="14" readonly="readonly">
							</div>
						</div>
                        
                        
                        
						</div>
			
				<!--<div class="row" style="margin-top:20px; margin-left:20px">
				<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">Trip Information</div> 
                </div>-->
				<div class="row" style="margin-top:20px; margin-left:20px">
						<div class="col-sm-6" >
							<div class="input-group">
								<span class="input-group-addon">Select Trip Type *</span>
								<select class="form-control" name="triptype"  id="triptype" onChange="return chTrip(this.value);"  onKeyPress="return disableEnterKey(event)" required>
									<option value="">--Select Trip Type--</option>
									<option value="One Way" <?php if ($this->_tpl_vars['tripdata']['triptype'] == 'One Way' || $this->_tpl_vars['tripdata']['triptype'] == ''): ?>selected<?php endif; ?>>
                                    One Way--(1 Destination)
									</option>
									<option value="Round Trip" <?php if ($this->_tpl_vars['tripdata']['triptype'] == 'Round Trip'): ?>selected<?php endif; ?>>
									Two Way--(Round Trip)
									</option>
									<option value="Three Way" <?php if ($this->_tpl_vars['tripdata']['triptype'] == 'Three Way'): ?>selected<?php endif; ?>>
									Three Way--(3 Destinations)
									</option>
									<option value="Four Way" 	<?php if ($this->_tpl_vars['tripdata']['triptype'] == 'Four Way'): ?>selected<?php endif; ?>>
									Four Way--(4 Destinations)
									</option>
								</select>
							</div>

						</div>
						<div class="col-sm-6" >
							<div class="input-group">
							<span class="input-group-addon">Vehicle Preference *</span>
					  <select name="vehtype" class="form-control" id="vehtype"  onKeyPress="return disableEnterKey(event)" required>
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
" <?php if ($this->_tpl_vars['tripdata']['vehtype'] == $this->_tpl_vars['vehiclepref'][$this->_sections['q']['index']]['id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['vehiclepref'][$this->_sections['q']['index']]['vehtype']; ?>
</option>                      
                     <?php endfor; endif; ?>
		                 </select>
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Oxygen Needed ?</span>
							<select name="oxygen"  class="form-control" id="oxygen" onChange="warhja(this.value)"  onKeyPress="return disableEnterKey(event)">
                      <option value="No" <?php if ($this->_tpl_vars['tripdata']['oxygen'] == 'No'): ?>selected<?php endif; ?>> No </option> 
                      <option value="Yes" <?php if ($this->_tpl_vars['tripdata']['oxygen'] == 'Yes'): ?>selected<?php endif; ?>> Yes </option>
                    </select>
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Appointment Date *</span>
							<input type="text" name="appdate" id="appdate" value="<?php echo $this->_tpl_vars['tripdata']['appdate']; ?>
" placeholder="Appointment Date" class="form-control apdate_nextday" required="required" readonly="readonly"  onKeyPress="return disableEnterKey(event)">
                            
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">PickUp Time *</span>
							<input type="text" name="apptime" id="apptime" value="<?php echo $this->_tpl_vars['tripdata']['apptime']; ?>
" class="form-control time"  placeholder=" (e.g. 15:30 Hrs)"  maxlength="8"  required="required" onKeyPress="return disableEnterKey(event)">
                            <span class="input-group-addon"><select  name="apptimerad" id="apptimerad" >
                            <option value="am"	<?php if ($this->_tpl_vars['tripdata']['apptimerad'] == 'am'): ?>selected<?php endif; ?>>AM</option>
                            <option value="pm" <?php if ($this->_tpl_vars['tripdata']['apptimerad'] == 'pm'): ?>selected<?php endif; ?>>PM</option></select></span>
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Appointment Time *</span>
							<input type="text" name="org_apptime" id="org_apptime" value="<?php echo $this->_tpl_vars['tripdata']['org_apptime']; ?>
" class="form-control time"  placeholder=" (e.g. 15:30 Hrs)"  maxlength="8" onKeyPress="return disableEnterKey(event)" required/>
                            <span class="input-group-addon"><select  name="org_apptimerad" id="org_apptimerad" >
                            <option value="am"	<?php if ($this->_tpl_vars['tripdata']['org_apptimerad'] == 'am'): ?>selected<?php endif; ?>>AM</option>
                            <option value="pm" <?php if ($this->_tpl_vars['tripdata']['org_apptimerad'] == 'pm'): ?>selected<?php endif; ?>>PM</option></select></span>
							</div>
						</div>
                        <div class="col-sm-6"  id="rpu" style="margin-top:20px; display:none;">
							<div class="input-group">
							<span class="input-group-addon">Return Pickup(For last destination)</span>
							<select name="puchoice" id="puchoice"  onChange="return pUchoice(this.value);"  class="form-control"  onKeyPress="return disableEnterKey(event)">
								<option value="Time" <?php if ($this->_tpl_vars['tripdata']['pickupchoice'] == 'Time'): ?>selected<?php endif; ?>>Time</option>
                                <option value="Will Call" <?php if ($this->_tpl_vars['tripdata']['pickupchoice'] == 'Will Call'): ?>selected<?php endif; ?>>Will Call</option>
							</select>
							</div>
						</div>
						<div class="col-sm-6" id="rpTime" style="margin-top:20px;display:none;">
						<div class="input-group">
						<span class="input-group-addon">Return Pick Time</span>
						<input type="text" class="form-control time"  placeholder="Return Pick Time" name="returnpickup" id="returnpickup" value="<?php echo $this->_tpl_vars['tripdata']['returnpickup']; ?>
" onBlur="return time(this.id);"  onKeyPress="return disableEnterKey(event)">
                        <span class="input-group-addon"><select  name="returnpickuprad" id="returnpickuprad" >
                            <option value="am"	<?php if ($this->_tpl_vars['tripdata']['returnpickuprad'] == 'am'): ?>selected<?php endif; ?>>AM</option>
                            <option value="pm" <?php if ($this->_tpl_vars['tripdata']['returnpickuprad'] == 'pm'): ?>selected<?php endif; ?>>PM</option></select></span>
						</div>
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
						<span class="input-group-addon">Pickup Location *</span>
						<input type="text" name="picklocation" id="picklocation" value="<?php echo $this->_tpl_vars['tripdata']['picklocation']; ?>
" class="form-control" placeholder="Pickup Location">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pickup Address *</span>
						<input type="text" name="pickaddress" class="form-control" id="autocomplete" value="<?php echo $this->_tpl_vars['tripdata']['pickaddress']; ?>
"  placeholder="Pickup Address" required="required">
                        
                        <input type="hidden" name="pickaddress_old" value="<?php echo $this->_tpl_vars['tripdata']['pickaddress']; ?>
">
						</div>
					</div>
				</div>	
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room</span>
						<input type="text" name="psuiteroom" id="psuiteroom" value="<?php echo $this->_tpl_vars['tripdata']['psuiteroom']; ?>
" class="form-control"  maxlength="20" placeholder="Suite/Apt/Bld/Room ">
                        <input type="hidden" name="psuiteroom_old" value="<?php echo $this->_tpl_vars['tripdata']['psuiteroom']; ?>
">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Same as patient phone # *</span>
						<input type="checkbox" id="pckphone" class="form-control" onClick="samephone('phnum','p_phnum','pckphone');">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pick Up Instructions </span>
						<textarea name="pickup_instruction" id="pickup_instruction" class="form-control" placeholder="Pick Up Instructions" rows="2"><?php echo $this->_tpl_vars['tripdata']['pickup_instruction']; ?>
</textarea>
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pick Phone Number *</span>
						<input type="text" name="p_phnum" id="p_phnum" value="<?php echo $this->_tpl_vars['tripdata']['p_phnum']; ?>
" class="form-control phone" maxlength="14" placeholder="Pick Phone Number">
						</div>
					</div>
				</div>	
					<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">
					First Destination <span class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;">Information</span></div> 
                    </div>
				<div class="row" style="margin-top:20px; margin-left:20px">	
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Drop Location </span>
						<input type="text" name="droplocation" value="<?php echo $this->_tpl_vars['tripdata']['droplocation']; ?>
" id="droplocation" class="form-control" placeholder="Drop Location">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Address *</span>
						<input type="text" name="destination" id="autocomplete2" value="<?php echo $this->_tpl_vars['tripdata']['destination']; ?>
" class="form-control" placeholder="Destination Address" required="required">
                        
                        <input type="hidden" name="destination_old" value="<?php echo $this->_tpl_vars['tripdata']['destination']; ?>
">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  *</span>
						<input type="text" name="dsuiteroom" id="dsuiteroom" value="<?php echo $this->_tpl_vars['tripdata']['dsuiteroom']; ?>
" class="form-control" placeholder="Suite/Apt/Bld/Room ">
						</div>
					</div>
                    <div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Phone Number *</span>
						<input type="text" name="d_phnum" id="d_phnum" class="form-control phone"  value="<?php echo $this->_tpl_vars['tripdata']['d_phnum']; ?>
" placeholder="Destination Phone Number">
						</div>
					</div>
				</div>	
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Instructions </span>
						<textarea name="destination_instruction" id="destination_instruction"  class="form-control" placeholder="Destination Instructions"><?php echo $this->_tpl_vars['tripdata']['destination_instruction']; ?>
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
						<input class="form-control  time" type="text" name="three_pickup" id="three_pickup" value="<?php echo $this->_tpl_vars['tripdata']['three_pickup']; ?>
"  maxlength="5" onBlur="javascript:time(this.id);" />
                        <span class="input-group-addon"><select  name="three_pickuprad" id="three_pickuprad" >
                            <option value="am"	<?php if ($this->_tpl_vars['tripdata']['three_pickuprad'] == 'am'): ?>selected<?php endif; ?>>AM</option>
                            <option value="pm" <?php if ($this->_tpl_vars['tripdata']['three_pickuprad'] == 'pm'): ?>selected<?php endif; ?>>PM</option></select></span>
						</div>
					</div>
					<div class="col-sm-6" id="three1" >
						<div class="input-group">
						<span class="input-group-addon">Will Call *</span>
						<input class="form-control" type="checkbox" name="three_will_call" id="three_will_call" onClick="check_check3();" <?php if ($this->_tpl_vars['tripdata']['three_will_call'] == 'on'): ?> checked="checked" <?php endif; ?> />
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" id="three2" style="margin-top:20px; ">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Location *</span>
						<input class="form-control" type="text" name="droplocation2" id="droplocation2" value="<?php echo $this->_tpl_vars['tripdata']['droplocation2']; ?>
" />
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Address *</span>
						<input class="form-control" type="text" name="destination2" id="destination2"  value="<?php echo $this->_tpl_vars['tripdata']['destination2']; ?>
" />
                        <input type="hidden" name="destination2_old" value="<?php echo $this->_tpl_vars['tripdata']['destination2']; ?>
" />
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  *</span>
						<input class="form-control" type="text" name="dsuiteroom2" id="dsuiteroom2" value="<?php echo $this->_tpl_vars['tripdata']['dsuiteroom2']; ?>
" maxlength="150"/>
                        <input type="hidden" name="dsuiteroom2_old" value="<?php echo $this->_tpl_vars['tripdata']['dsuiteroom2']; ?>
"/>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Phone Number # *</span>
						<input class="form-control phone" type="text" name="d_phnum2" id="d_phnum2" value="<?php echo $this->_tpl_vars['tripdata']['d_phnum2']; ?>
" maxlength="14"  onChange="use_same(this.id);" />
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Instructions *</span>
						<textarea class="form-control" name="destination_instruction2" id="destination_instruction2"><?php echo $this->_tpl_vars['tripdata']['destination_instruction2']; ?>
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
						<input class="form-control  time" type="text" name="four_pickup" id="four_pickup" value="<?php echo $this->_tpl_vars['tripdata']['four_pickup']; ?>
"  maxlength="5" onBlur="javascript:time(this.id);" />
                        <span class="input-group-addon"><select  name="four_pickuprad" id="four_pickuprad" >
                            <option value="am"	<?php if ($this->_tpl_vars['tripdata']['four_pickuprad'] == 'am'): ?>selected<?php endif; ?>>AM</option>
                            <option value="pm" <?php if ($this->_tpl_vars['tripdata']['four_pickuprad'] == 'pm'): ?>selected<?php endif; ?>>PM</option></select></span>
						</div>
					</div>
					<div class="col-sm-6"  style="">
						<div class="input-group">
						<span class="input-group-addon">Will Call *</span>
						<input class="form-control" type="checkbox" name="four_will_call" id="four_will_call" onClick="check_check3();" <?php if ($this->_tpl_vars['tripdata']['four_will_call'] == 'on'): ?> checked="checked" <?php endif; ?> />
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Location *</span>
						<input class="form-control" type="text" name="droplocation3" id="droplocation3" value="<?php echo $this->_tpl_vars['tripdata']['droplocation3']; ?>
" />
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Address *</span>
						<input class="form-control" type="text" name="destination3" id="destination3"  value="<?php echo $this->_tpl_vars['tripdata']['destination3']; ?>
"/>
                        <input type="hidden" name="destination3_old" value="<?php echo $this->_tpl_vars['tripdata']['destination3']; ?>
"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  *</span>
						<input class="form-control" type="text" name="dsuiteroom3" id="dsuiteroom3" value="<?php echo $this->_tpl_vars['tripdata']['dsuiteroom3']; ?>
"  maxlength="150"/>
						<input type="hidden" name="dsuiteroom3_old" value="<?php echo $this->_tpl_vars['tripdata']['dsuiteroom3']; ?>
"/>
                        </div>
					</div>
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Phone Number # *</span>
						<input class="form-control phone" type="text" name="d_phnum3" id="d_phnum3" value="<?php echo $this->_tpl_vars['tripdata']['d_phnum3']; ?>
" maxlength="14"  onChange="use_same(this.id);" />
						</div>
					</div>
					<div class="col-sm-6" id="four6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Instructions *</span>
						<textarea class="form-control" name="destination_instruction3" id="destination_instruction3"><?php echo $this->_tpl_vars['tripdata']['destination_instruction3']; ?>
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
						<span class="input-group-addon">Use Same Pickup Information *</span>
						<input class="form-control"  type="checkbox" name="sameadd" id="sameadd" onClick="samepickaddress();"/>
						</div>
					</div>
				</div>
                <div class="row" style="margin-top:20px; margin-left:20px;">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back To Location *</span>
						<input class="form-control"  name="backtolocation" type="text" id="backtolocation" value="<?php echo $this->_tpl_vars['tripdata']['backtolocation']; ?>
" maxlength="550"/>	</div>
					</div>
                    <div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back To Address *</span>
						<input class="form-control" name="backto" type="text" id="autocomplete3" value="<?php echo $this->_tpl_vars['tripdata']['backto']; ?>
" maxlength="150" placeholder="Enter Complete Back To Address"/>
                        <input name="backto_old" type="hidden" value="<?php echo $this->_tpl_vars['tripdata']['backto']; ?>
"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px;">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room *</span>
						<input class="form-control" type="text" name="bsuiteroom" id="bsuiteroom" value="<?php echo $this->_tpl_vars['tripdata']['bsuiteroom']; ?>
" maxlength="150"/>
                        <input type="hidden" name="bsuiteroom_old" value="<?php echo $this->_tpl_vars['tripdata']['bsuiteroom']; ?>
"/>
						</div>
					</div>
                    <div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back to Instructions </span>
						<textarea class="form-control" name="backto_instruction" id="backto_instruction"><?php echo $this->_tpl_vars['tripdata']['backto_instruction']; ?>
</textarea>
						</div>
					</div>
				</div>
                </section>
			
                    <hr/>
            
                    <div class="row" style="margin-top:20px; margin-left:20px">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" id="submit"  value="submit" class="btn btn-primary btn-lg" >Update Request</button>
							<!--<button type="reset" name="" class="btn btn-primary btn-lg" >Reset</button>-->
                            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"  />
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
<?php echo '<script>wcn(\'';  echo $this->_tpl_vars['tripdata']['wchair'];  echo '\');</script>'; ?>

<?php echo '<script>warhja(\'';  echo $this->_tpl_vars['tripdata']['oxygen'];  echo '\');</script>'; ?>

<?php echo '<script>check_cecc();</script>'; ?>

<?php echo '<script>chTrip(\'';  echo $this->_tpl_vars['tripdata']['triptype'];  echo '\');</script>'; ?>



<?php echo '<script>bringlocations(\'';  echo $this->_tpl_vars['tripdata']['account'];  echo '\',\'';  echo $this->_tpl_vars['tripdata']['officelocation'];  echo '\');</script>'; ?>

<?php echo '<script>
$(\'.apdate_nextday\').datetimepicker({timepicker:false,format:\'m/d/Y\',value:\'';  echo $this->_tpl_vars['nextDay'];  echo '\',closeOnDateSelect: true,yearStart:year,minDate:\'';  echo $this->_tpl_vars['chkNextDay'];  echo '\',maxDate:\'+1970/06/30\',scrollInput: false});
$(\'.apdate2_nextday\').datetimepicker({timepicker:false,format:\'m/d/Y\',value:dt,closeOnDateSelect: true,yearStart:year,yearEnd:year+1,minDate:\'';  echo $this->_tpl_vars['chkNextDay'];  echo '\',maxDate:\'+1970/06/30\',scrollInput: false}).val(\'\');
</script>'; ?>


<!--bringlocations(account_id,location_id)-->