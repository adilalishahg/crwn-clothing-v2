{include file="headernew.tpl"}

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDDFDk56m_SRbneFRHG3bNdRQjPOAQAhj4"></script>
{literal}
<script type="text/javascript" >
function initialize() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete')),
      { types: ['geocode'] });
}
function initialize2() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete2')),
      { types: ['geocode'] });
}
function initialize3() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete3')),
      { types: ['geocode'] });
}
function initialize4() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('ins_billing_address')),
      { types: ['geocode'] });
}
function initialize5() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('pp_billing_address')),
      { types: ['geocode'] });
}
function initialize6() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete4')),
      { types: ['geocode'] }); //alert(types);
}
function initialize7() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete5')),
      { types: ['geocode'] });
}
function wcn(val){	if(val=='Yes'){	$('#wcnW,#wcnH').show();}else{	$('#wcnW,#wcnH').hide();}}	
function wait_legs(){
		var wait_time = $('#wait_time').val();
		var triptype = $('#triptype').val();
		if(wait_time=='No'){
			$('#waitA,#waitB,#waitC,#waitD').hide();
			$('#wait_timeA,#wait_timeB,#wait_timeC,#wait_timeD').removeClass('required');
			//alert(triptype);
			}else{
			if(triptype=='One Way'){
				$('#waitB,#waitC,#waitD').hide();
				$('#waitA').show();
				$('#wait_timeB,#wait_timeC,#wait_timeD').removeClass('required');
				$('#wait_timeA').addClass('required');}
			else if(triptype=='Round Trip'){
				$('#waitC,#waitD').hide();
				$('#waitA,#waitB').show();
				$('#wait_timeC,#wait_timeD').removeClass('required');
				$('#wait_timeA,#wait_timeB').addClass('required');}
			else if(triptype=='Three Way'){
				$('#waitD').hide();
				$('#waitA,#waitB,#waitC').show();
				$('#wait_timeD').removeClass('required');
				$('#wait_timeA,#wait_timeB,#wait_timeC').addClass('required');}
			else if(triptype=='Four Way'){
				$('#waitA,#waitB,#waitC,#waitD').show();
				//$('#wait_timeA,#wait_timeB,#wait_timeC,#wait_timeD').removeClass('required');
				$('#wait_timeA,#wait_timeB,#wait_timeC,#wait_timeD').addClass('required');}		
			//alert(triptype);
			}
		//alert('In');
		}	
 function bringlocations(account_id,location_id,account_obj=0){ //alert(account_obj);
 	
 	if(account_obj!=0) {
 	 var account_text= account_obj.options[account_obj.selectedIndex].text;
	 $("#referral_sources").val(account_text);
	}

	 $.post("bringlocations.php", {account_id: ""+account_id, location_id: ""+location_id}, function(data){ //alert(data);
	 if(data.length > 0 ){  //location.reload();

	 document.getElementById('office_location').innerHTML = ('<select   name="officelocation" required="required" class="form-control" id="officelocation">'+data+'</select>'); }
	 });}	
function CheckdriversAvailibility(url,typ){
	if(typ == 'pick'){
		var appdate = $('#appdate').val();
	//	var apptime	= $('#apptime').val(); // || apptime==''
		if(appdate==''){alert('To see driver free slots, please select appointment date and pick up time.'); return false; }
		
		}
	
	
   myWindow1 = window.open( url+"?date="+appdate, "myWindow1", 
"status = 1, height = 750, width = 1200, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }	 	
</script>
{/literal}
<body onLoad="initialize(); initialize2(); initialize3();  initialize4(); initialize5();  initialize6(); initialize7();">

	<section class="section gray">
	<div class="w-container">
		<!--<div class="top-title">
			<div class="title-txt">
			<h1>Request Dispatch</h1>
			</div>
		</div>-->	
      <!--  {include file="alert.tpl"}-->
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
								<!--<select name="account" id="account"  required="required" class="form-control" onChange="bringlocations(this.value,this)"  onKeyPress="return disableEnterKey(event)">
                                	{if $smarty.session.type eq 'ac' || $smarty.session.type eq 'cm' || $smarty.session.type eq 'pa' || $smarty.session.type eq ''}{/if}
									{section name=n loop=$accounts}
									<option value="{$accounts[n].id}"  {if $accounts[n].id eq $tripdata.account} selected {/if} >{$accounts[n].account_name} </option>
									{/section}
								</select>-->
                                <input type="text" name="accountXXX" value="{$accounts.0.account_name}"  class="form-control"  readonly   onKeyPress="return disableEnterKey(event)"/>
                                <input type="hidden" name="account" value="{$accounts.0.id}" />
							</div>
						</div>
                       
						 <div class="col-sm-6">
							<div class="input-group">
							<span class="input-group-addon">Patient Name *</span>
							<input type="text" name="pname" id="pname" {if $smarty.session.type eq 'pa'}value="{$smarty.session.userdata.name}" readonly{else}value="{$tripdata.clientname}" {/if} class="form-control" placeholder="Patient Name" required="required"  onKeyPress="return disableEnterKey(event)"/>
							</div>
						</div>
                        <div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Patient Phone No *</span>
							<input type="text" name="phnum" id="phnum" class="form-control phone"  value="{$tripdata.phnum}" placeholder="Phone Number"  maxlength="14" required="required"  onKeyPress="return disableEnterKey(event)"/>
							</div>
						</div>
						<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">PO # </span>
							<input type="text" name="po" id="po" value="{$tripdata.po}" class="form-control" placeholder="PO #" >
							</div>
						</div>
                        <!--<div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Trip # </span>
							<input type="text" name="tripnumber" id="tripnumber" value="{$tripnumber}" class="form-control" placeholder="Trip #" readonly >
							</div>
						</div>-->
                        <div class="col-sm-6" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">DOB</span>
							<input type="text" name="dob" id="dob" class="form-control dob" {if $tripdata.dob neq ''} value="{$tripdata.dob}" {/if} placeholder="Date of Birth"  maxlength="14" readonly="readonly">
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
									<option value="One Way" {if $tripdata.triptype eq 'One Way' || $tripdata.triptype eq ''}selected{/if}>
                                    One Way--(1 Destination)
									</option>
									<option value="Round Trip" {if $tripdata.triptype eq 'Round Trip'}selected{/if}>
									Two Way--(Round Trip)
									</option>
									<!--<option value="Three Way" {if $tripdata.triptype eq 'Three Way'}selected{/if}>
									Three Way--(3 Destinations)
									</option>
									<option value="Four Way" 	{if $tripdata.triptype eq 'Four Way'}selected{/if}>
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
                      {section name=q loop=$vehiclepref}	
                      <option value="{$vehiclepref[q].id}" {if $tripdata.vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>                      
                     {/section}
		                 </select>-->
                         <input type="text" name="vehtypeXXX" value="{$vehiclepref.0.vehtype}"  class="form-control"  readonly   onKeyPress="return disableEnterKey(event)"/>
                            <input type="hidden" name="vehtype" value="{$vehiclepref.0.id}" />
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Oxygen Needed ?</span>
							<select name="oxygen"  class="form-control" id="oxygen" onChange="warhja(this.value)"  onKeyPress="return disableEnterKey(event)">
                      <option value="No" {if $tripdata.oxygen eq 'No'}selected{/if}> No </option> 
                      <option value="Yes" {if $tripdata.oxygen eq 'Yes'}selected{/if}> Yes </option>
                    </select>
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Appointment Date *</span>
							<input type="text" name="appdate" id="appdate" value="{$tripdata.appdate}" placeholder="Appointment Date" class="form-control apdate_nextday" required="required" readonly="readonly"  onKeyPress="return disableEnterKey(event)">
                            
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">PickUp Time *</span>
							<input type="text" name="apptime" id="apptime" value="{$tripdata.apptime}" class="form-control time"  placeholder=" (e.g. 15:30 Hrs)"  maxlength="8"  required="required" onKeyPress="return disableEnterKey(event)">
                            <span class="input-group-addon"><select  name="apptimerad" id="apptimerad" >
                            <option value="am"	{if $tripdata.apptimerad eq 'am'}selected{/if}>AM</option>
                            <option value="pm" {if $tripdata.apptimerad eq 'pm'}selected{/if}>PM</option></select></span>
                           <!-- <span class="input-group-addon"><a onClick="CheckdriversAvailibility('driver_availibility.php','pick')"> Check Free Drivers Time Slots</a></span>-->
							</div>
						</div>
                        <div class="col-sm-6"  style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Appointment Time *</span>
							<input type="text" name="org_apptime" id="org_apptime" value="{$tripdata.org_apptime}" class="form-control time"  placeholder=" (e.g. 15:30 Hrs)"  maxlength="8" onKeyPress="return disableEnterKey(event)" required/>
                            <span class="input-group-addon"><select  name="org_apptimerad" id="org_apptimerad" >
                            <option value="am"	{if $tripdata.org_apptimerad eq 'am'}selected{/if}>AM</option>
                            <option value="pm" {if $tripdata.org_apptimerad eq 'pm'}selected{/if}>PM</option></select></span>
							</div>
						</div>
                        <div class="col-sm-6"  id="rpu" style="margin-top:20px; display:none;">
							<div class="input-group">
							<span class="input-group-addon">Return Pickup(For last destination)</span>
							<select name="puchoice" id="puchoice"  onChange="return pUchoice(this.value);"  class="form-control"  onKeyPress="return disableEnterKey(event)">
								<option value="Time" {if $tripdata.pickupchoice eq 'Time'}selected{/if}>Time</option>
                                <option value="Will Call" {if $tripdata.pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>
							</select>
							</div>
						</div>
						<div class="col-sm-6" id="rpTime" style="margin-top:20px;display:none;">
						<div class="input-group">
						<span class="input-group-addon">Return Pick Time</span>
						<input type="text" class="form-control time"  placeholder="Return Pick Time" name="returnpickup" id="returnpickup" value="{$tripdata.returnpickup}" onBlur="return time(this.id);"  onKeyPress="return disableEnterKey(event)">
                        <span class="input-group-addon"><select  name="returnpickuprad" id="returnpickuprad" >
                            <option value="am"	{if $tripdata.returnpickuprad eq 'am'}selected{/if}>AM</option>
                            <option value="pm" {if $tripdata.returnpickuprad eq 'pm'}selected{/if}>PM</option></select></span>
                           <!-- <span class="input-group-addon"><a onClick="CheckdriversAvailibility('driver_availibility.php','pick')"> Check Free Drivers Time Slots</a>--></span>
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
						<input type="text" name="picklocation" id="picklocation" value="{$tripdata.picklocation}" class="form-control" placeholder="Pickup Location">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pickup Address *</span>
						<input type="text" name="pickaddress" class="form-control" id="autocomplete" value="{$tripdata.pickaddress}"  placeholder="Pickup Address" required="required">
                        
                        <input type="hidden" name="pickaddress_old" value="{$tripdata.pickaddress}">
						</div>
					</div>
				</div>	
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room</span>
						<input type="text" name="psuiteroom" id="psuiteroom" value="{$tripdata.psuiteroom}" class="form-control"  maxlength="20" placeholder="Suite/Apt/Bld/Room ">
                        <input type="hidden" name="psuiteroom_old" value="{$tripdata.psuiteroom}">
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
						<textarea name="pickup_instruction" id="pickup_instruction" class="form-control" placeholder="Pick Up Instructions" rows="2">{$tripdata.pickup_instruction}</textarea>
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Pick Phone Number *</span>
						<input type="text" name="p_phnum" id="p_phnum" value="{$tripdata.p_phnum}" class="form-control phone" maxlength="14" placeholder="Pick Phone Number">
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
						<input type="text" name="droplocation" value="{$tripdata.droplocation}" id="droplocation" class="form-control" placeholder="Drop Location">
						</div>
					</div>
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Address *</span>
						<input type="text" name="destination" id="autocomplete2" value="{$tripdata.destination}" class="form-control" placeholder="Destination Address" required="required">
                        
                        <input type="hidden" name="destination_old" value="{$tripdata.destination}">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  *</span>
						<input type="text" name="dsuiteroom" id="dsuiteroom" value="{$tripdata.dsuiteroom}" class="form-control" placeholder="Suite/Apt/Bld/Room ">
						</div>
					</div>
                    <div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Phone Number *</span>
						<input type="text" name="d_phnum" id="d_phnum" class="form-control phone"  value="{$tripdata.d_phnum}" placeholder="Destination Phone Number">
						</div>
					</div>
				</div>	
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" >
						<div class="input-group">
						<span class="input-group-addon">Destination Instructions </span>
						<textarea name="destination_instruction" id="destination_instruction"  class="form-control" placeholder="Destination Instructions">{$tripdata.destination_instruction}</textarea>
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
						<input class="form-control  time" type="text" name="three_pickup" id="three_pickup" value="{$tripdata.three_pickup}"  maxlength="5" onBlur="javascript:time(this.id);" />
                        <span class="input-group-addon"><select  name="three_pickuprad" id="three_pickuprad" >
                            <option value="am"	{if $tripdata.three_pickuprad eq 'am'}selected{/if}>AM</option>
                            <option value="pm" {if $tripdata.three_pickuprad eq 'pm'}selected{/if}>PM</option></select></span>
						</div>
					</div>
					<div class="col-sm-6" id="three1" >
						<div class="input-group">
						<span class="input-group-addon">Will Call *</span>
						<input class="form-control" type="checkbox" name="three_will_call" id="three_will_call" onClick="check_check3();" {if $tripdata.three_will_call eq 'on'} checked="checked" {/if} />
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" id="three2" style="margin-top:20px; ">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Location *</span>
						<input class="form-control" type="text" name="droplocation2" id="droplocation2" value="{$tripdata.droplocation2}" />
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Address *</span>
						<input class="form-control" type="text" name="destination2" id="destination2"  value="{$tripdata.destination2}" />
                        <input type="hidden" name="destination2_old" value="{$tripdata.destination2}" />
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  *</span>
						<input class="form-control" type="text" name="dsuiteroom2" id="dsuiteroom2" value="{$tripdata.dsuiteroom2}" maxlength="150"/>
                        <input type="hidden" name="dsuiteroom2_old" value="{$tripdata.dsuiteroom2}"/>
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Phone Number # *</span>
						<input class="form-control phone" type="text" name="d_phnum2" id="d_phnum2" value="{$tripdata.d_phnum2}" maxlength="14"  onChange="use_same(this.id);" />
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">2nd Destination Instructions *</span>
						<textarea class="form-control" name="destination_instruction2" id="destination_instruction2">{$tripdata.destination_instruction2}</textarea>
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
						<input class="form-control  time" type="text" name="four_pickup" id="four_pickup" value="{$tripdata.four_pickup}"  maxlength="5" onBlur="javascript:time(this.id);" />
                        <span class="input-group-addon"><select  name="four_pickuprad" id="four_pickuprad" >
                            <option value="am"	{if $tripdata.four_pickuprad eq 'am'}selected{/if}>AM</option>
                            <option value="pm" {if $tripdata.four_pickuprad eq 'pm'}selected{/if}>PM</option></select></span>
						</div>
					</div>
					<div class="col-sm-6"  style="">
						<div class="input-group">
						<span class="input-group-addon">Will Call *</span>
						<input class="form-control" type="checkbox" name="four_will_call" id="four_will_call" onClick="check_check3();" {if $tripdata.four_will_call eq 'on'} checked="checked" {/if} />
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Location *</span>
						<input class="form-control" type="text" name="droplocation3" id="droplocation3" value="{$tripdata.droplocation3}" />
						</div>
					</div>
					<div class="col-sm-6"  style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Address *</span>
						<input class="form-control" type="text" name="destination3" id="destination3"  value="{$tripdata.destination3}"/>
                        <input type="hidden" name="destination3_old" value="{$tripdata.destination3}"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room  *</span>
						<input class="form-control" type="text" name="dsuiteroom3" id="dsuiteroom3" value="{$tripdata.dsuiteroom3}"  maxlength="150"/>
						<input type="hidden" name="dsuiteroom3_old" value="{$tripdata.dsuiteroom3}"/>
                        </div>
					</div>
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Phone Number # *</span>
						<input class="form-control phone" type="text" name="d_phnum3" id="d_phnum3" value="{$tripdata.d_phnum3}" maxlength="14"  onChange="use_same(this.id);" />
						</div>
					</div>
					<div class="col-sm-6" id="four6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">3rd Destination Instructions *</span>
						<textarea class="form-control" name="destination_instruction3" id="destination_instruction3">{$tripdata.destination_instruction3}</textarea>
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
						<input class="form-control"  name="backtolocation" type="text" id="backtolocation" value="{$tripdata.backtolocation}" maxlength="550"/>	</div>
					</div>
                    <div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back To Address *</span>
						<input class="form-control" name="backto" type="text" id="autocomplete3" value="{$tripdata.backto}" maxlength="150" placeholder="Enter Complete Back To Address"/>
                        <input name="backto_old" type="hidden" value="{$tripdata.backto}"/>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px; margin-left:20px;">
					<div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Suite/Apt/Bld/Room *</span>
						<input class="form-control" type="text" name="bsuiteroom" id="bsuiteroom" value="{$tripdata.bsuiteroom}" maxlength="150"/>
                        <input type="hidden" name="bsuiteroom_old" value="{$tripdata.bsuiteroom}"/>
						</div>
					</div>
                    <div class="col-sm-6" style="margin-top:20px;">
						<div class="input-group">
						<span class="input-group-addon">Back to Instructions </span>
						<textarea class="form-control" name="backto_instruction" id="backto_instruction">{$tripdata.backto_instruction}</textarea>
						</div>
					</div>
				</div>
                </section>
			
                    <hr/>
            
                    <div class="row" style="margin-top:20px; margin-left:20px">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" id="submit"  value="submit" class="btn btn-primary btn-lg" >Update Request</button>
							<!--<button type="reset" name="" class="btn btn-primary btn-lg" >Reset</button>-->
                            <input type="hidden" name="id" value="{$id}"  />
						</div>
                   </div>
            </form> 
<!---------------------------------------------End of form---------------------------------------------------->			
        </div>
        </div>
     </div> 
    </section>  
</body>
{include file="footerlast.tpl"}
<script src="js/inputmasking.js"></script>
<script src="js/triprequest777.js"></script>
{literal}<script>wcn('{/literal}{$tripdata.wchair}{literal}');</script>{/literal}
{literal}<script>warhja('{/literal}{$tripdata.oxygen}{literal}');</script>{/literal}
{literal}<script>check_cecc();</script>{/literal}
{literal}<script>chTrip('{/literal}{$tripdata.triptype}{literal}');</script>{/literal}


{literal}<script>bringlocations('{/literal}{$tripdata.account}{literal}','{/literal}{$tripdata.officelocation}{literal}');</script>{/literal}
{literal}<script>
$('.apdate_nextday').datetimepicker({timepicker:false,format:'m/d/Y',value:'{/literal}{$nextDay}{literal}',closeOnDateSelect: true,yearStart:year,minDate:'{/literal}{$chkNextDay}{literal}',maxDate:'+1970/06/30',scrollInput: false});
$('.apdate2_nextday').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,yearStart:year,yearEnd:year+1,minDate:'{/literal}{$chkNextDay}{literal}',maxDate:'+1970/06/30',scrollInput: false}).val('');
</script>{/literal}

<!--bringlocations(account_id,location_id)-->