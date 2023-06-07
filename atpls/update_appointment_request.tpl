{include file="headernew.tpl"}
{*include file="slider.tpl"*}
{*include file="services_homepage.tpl"*} 
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDDFDk56m_SRbneFRHG3bNdRQjPOAQAhj4"></script> 
{literal} 
<script type="text/javascript" >
function initialize() {
  autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete')),
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


 
 
function disableEnterKey(e)
{    var key;      
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox      

     return (key != 13);
}
</script> 
<script type="text/javascript">     
function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
function isNumber2(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 45) || charCode > 57) {
            return false;
        }
        return true;
    }	
function vtypechange(val){ 	if(val>220){ $('#vehtype').val('BLS'); vetype_fun('BLS');  } 	}	
function anticoagulant_fun(val){	 if(val=='Yes'){$('#needtobeheld_div').show('slow');}else{$('#needtobeheld_div').hide('slow');}}
function npo_prior_fun(val){	 if(val=='Yes'){$('#npo_prior_hours_div').show('slow');}else{$('#npo_prior_hours_div').hide('slow');}}
function vetype_fun(val){ if(val=='ALS' || val=='BLS'){$('#question21,#question22,#question23').show('slow');}else{$('#question21,#question22,#question23').hide('slow');}}

function bed_confinement_fun(val){ if(val=='Yes'){$('#bed_confinement1_div,#bed_confinement2_div,#bed_confinement3_div').show('slow');}else{$('#bed_confinement1_div,#bed_confinement2_div,#bed_confinement3_div').hide('slow');}}

</script>
{/literal} <body onLoad="initialize();">
<section class="section gray">
  <div class="w-container">
    <div class="w-col-12">
      <div class="row contact-wrap" style="padding:0 100 100 100px;"> 
        <!-----------------------------------------Start form--------------------------------------------------------> 
        {if $error neq ''}
        <div style="color:red;">{$error}</div>
        {/if}
        <form id="form" method="post" name="uss" action="update_appointment_request.php?id={$data.id}" autocomplete="off" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> New Appointment Request </div>
          </div>
          
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="inputState">Office Location</label>
              <select id="officelocation" class="form-control" name="officelocation" required>
                <option  value="" >Select Office Location</option>
                {section name=n loop=$offices}
					
                <option  value="{$offices[n].id}" {if $offices[n].id eq $data.officelocation} selected {/if}>{$offices[n].abrivation} -- {$offices[n].name}</option>{/section}
                
              </select>
            </div>
            <div class="form-group col-md-4">
            <label for="inputAddress">Facility Employee Completing Request</label>
            <input type="text" class="form-control" id="submitter_name" name="submitter_name" value="{$data.submitter_name}" placeholder="Enter Name" maxlength="60">
          	</div>
          </div>
          
          <div class="row">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> Patient Information </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Patient Name</label>
              <input type="text" class="form-control" id="clientname" name="clientname" value="{$data.clientname}" placeholder="Patient Name"  maxlength="60">
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Unit/Room #</label>
              <input type="text" class="form-control" id="room_number" name="room_number" value="{$data.room_number}" placeholder="Unit/Room #"  maxlength="40">
            </div>
             <div class="form-group col-md-2">
              <label for="inputCity">Date of Birth</label>
              <input type="text" class="form-control dob" id="dob" name="dob" value="{$data.dob|date_format:"%m/%d/%Y"}" placeholder="Date of Birth"  maxlength="10">
            </div>
            <div class="form-group col-md-2">
              <label for="inputState">Patient Weight (bls)</label>
              <input type="text" class="form-control" id="patient_weight" name="patient_weight" value="{$data.patient_weight}" placeholder="Patient Weight"  maxlength="3"  onkeypress="return isNumber(event)" onpaste="return false;" onBlur="vtypechange(this.value)">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> Reason for Appointment </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4">Procedure/ Consult Requested</label>
              <input type="text" class="form-control" id="consult_requested" name="consult_requested" value="{$data.consult_requested}" placeholder="Consult Requested" maxlength="200">
            </div>
            <div class="form-group col-md-3">
              <label for="inputCity">Consulting Physician</label>
              <input type="text" class="form-control" id="physician_name" name="physician_name" value="{$data.physician_name}" placeholder="Consulting Physician" maxlength="200">
            </div>
            <div class="form-group col-md-2">
              <label for="inputState">Phone #</label>
              <input type="text" class="form-control phone" id="physician_phone" name="physician_phone" value="{$data.physician_phone}" placeholder="Phone" maxlength="15">
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Reason</label>
              <textarea class="form-control" id="reason" name="reason" placeholder="Reason" >{$data.reason}</textarea>
            </div>
          </div>
          
           <div class="row">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> Appointment Detail </div>
          </div>
                    
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4">Appointment Date Requested</label>
              <input type="text" class="form-control stenddate" id="appdate_requested" name="appdate_requested" value="{$data.appdate_requested}" placeholder="Appointment Date Requested">
            </div>
            <!--<div class="form-group col-md-3">
              <label for="inputCity">Actual Appointment Date</label>
              <input type="text" class="form-control stenddate" id="appdate" name="appdate" value="{$data.appdate}" placeholder="Actual Appointment Date" maxlength="10">
            </div>-->
            <div class="form-group col-md-2">
              <label for="inputCity">Time</label>
              <input type="text" class="form-control timepicker time" id="apptime" name="apptime" value="{$data.apptime}" placeholder="Time" maxlength="8">
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Appointment Location/Office Name</label>
              <input type="text" class="form-control" id="appointment_location" name="appointment_location" value="{$data.appointment_location}" placeholder="Appointment Location" maxlength="200">
            </div>
            
            <div class="form-group col-md-6">
              <label for="inputPassword4">Address</label>
              <input type="text" class="form-control" id="autocomplete" name="address" value="{$data.address}" placeholder="Address" maxlength="200">
            </div>
            <div class="form-group col-md-3">
              <label for="inputPassword4">Suite #</label>
             <input type="text" class="form-control" id="suite" name="suite" value="{$data.suite}" placeholder="Suite #" maxlength="50">
            </div>
            <div class="form-group col-md-3">
              <label for="inputPassword4">Telephone</label>
              <input type="text" class="form-control phone" id="phone" name="phone" value="{$data.phone}" placeholder="Phone" maxlength="20">
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Trip type</label>
              <select id="triptype" class="form-control" name="triptype">
                <option  value="One Way" {if $data.triptype eq 'One Way'} selected {/if}>One Way</option>
                <option  value="Round Trip" {if $data.triptype eq 'Round Trip'} selected {/if}>Round Trip</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Mode of Transport</label>
              <select id="vehtype" class="form-control" name="vehtype" onChange="vetype_fun(this.value)">
                <option  value="Ambulatory" {if $data.vehtype eq 'Ambulatory'} selected {/if}>Ambulatory</option>
                <option  value="Wheelchair" {if $data.vehtype eq 'Wheelchair'} selected {/if}>Wheelchair</option>
                <option  value="Non-Medical Stretcher" {if $data.vehtype eq 'Non-Medical Stretcher'} selected {/if}>Non-Medical Stretcher</option>
                <option  value="BLS" {if $data.vehtype eq 'BLS'} selected {/if}>BLS</option>
                <option  value="ALS" {if $data.vehtype eq 'ALS'} selected {/if}>ALS</option>
              </select>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> Questions </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Clinical Needs <i class="fa fa-exclamation-circle" style="color:#F00" title="If Oxygen is greater than O3 l/m. Please select BLS Mod of Transportation"></i></label>
              <input type="text" class="form-control" id="clinical_needs" name="clinical_needs" value="{$data.clinical_needs}" placeholder="Clinical Needs" maxlength="4">
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Is patient on Anticoagulant Therapy (i.e.: coumadin)</label>
              <select id="anticoagulant_therapy" class="form-control" name="anticoagulant_therapy" onChange="anticoagulant_fun(this.value)">
                <option  value="No" {if $data.anticoagulant_therapy eq 'No'} selected {/if}>No</option>
                <option  value="Yes" {if $data.anticoagulant_therapy eq 'Yes'} selected {/if}>Yes</option>
              </select>
              </select>
            </div>
             <div class="form-group col-md-4" style="display:none;" id="needtobeheld_div">
              <label for="inputState">Does it need to be held?</label>
              <select id="needtobeheld" class="form-control" name="needtobeheld">
                <option  value="No" {if $data.needtobeheld eq 'No'} selected {/if}>No</option>
                <option  value="Yes" {if $data.needtobeheld eq 'Yes'} selected {/if}>Yes</option>
              </select>
            </div>
            
            <div class="form-group col-md-4">
              <label for="inputEmail4"># of Days to Hold Before Appointment</label>
              <input type="text" class="form-control" id="holddays" name="holddays" value="{$data.holddays}" placeholder="# of Days" maxlength="2"  onkeypress="return isNumber(event)" onpaste="return false;" >
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Does patient need to be NPO prior to appointment?</label>
               <select id="npo_prior" class="form-control" name="npo_prior" onChange="npo_prior_fun(this.value)">
                <option  value="No" {if $data.npo_prior eq 'No'} selected {/if}>No</option>
                <option  value="Yes" {if $data.npo_prior eq 'Yes'} selected {/if}>Yes</option>
              </select>
            </div>
            
            <div class="form-group col-md-4" style="display:none;" id="npo_prior_hours_div">
              <label for="inputEmail4">How many hours prior to appointment?</label>
              <input type="text" class="form-control" id="npo_prior_hours" name="npo_prior_hours" value="{$data.npo_prior_hours}" placeholder="# of Hours"  maxlength="4"  onkeypress="return isNumber2(event)" onpaste="return false;" >
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Attendant Required?</label>
              <select id="attendant" class="form-control" name="attendant">
                <option  value="No" {if $data.attendant eq 'No'} selected {/if}>No</option>
                <option  value="Yes" {if $data.attendant eq 'Yes'} selected {/if}>Yes</option>
              </select>
            </div>
            </div>
<div class="row">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> Responsible Party Notification </div>
          </div>            
       <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Name</label>
              <input type="text" class="form-control" id="notification_name" name="notification_name" value="{$data.notification_name}" placeholder="Name" maxlength="100">
            </div>
            <div class="form-group col-md-4">
              <label for="inputEmail4">Relationship</label>
              <input type="text" class="form-control" id="notification_relationship" name="notification_relationship" value="{$data.notification_relationship}" placeholder="Relationship" maxlength="100">
            </div>
            <div class="form-group col-md-4">
              <label for="inputEmail4">Phone</label>
              <input type="text" class="form-control phone" id="notification_phone" name="notification_phone" value="{$data.notification_phone}" placeholder="Phone" maxlength="15">
            </div>
            
       </div>        
          
          <div class="row" id="question21" style="display:none;">
            <div class="col-sm-12" style="color:#FFF;font-size:24px; margin-top:20px; text-align:center; background-color:#a40026; border-radius:5px;"> Questions </div>
          </div>
         <div class="form-row" id="question22" style="display:none;">
            <div class="form-group col-md-8">
              <label for="inputEmail4">Reason Ambulance Transportation is Required?</label>
             <textarea class="form-control" id="reason_ambulance" name="reason_ambulance" placeholder="Reason Ambulance Transportation" rows="1">
             {$data.reason_ambulance}</textarea>
            </div>
          <div class="form-group col-md-4">
              <label for="inputState">Ambulance is required for Bed Confinement?</label>
              <select id="bed_confinement" class="form-control" name="bed_confinement" onChange="bed_confinement_fun(this.value)">
                <option  value="No" {if $data.bed_confinement eq 'No'} selected {/if}>No</option>
                <option  value="Yes" {if $data.bed_confinement eq 'Yes'} selected {/if}>Yes</option>
              </select>
            </div>   
            </div>
            
           <div class="form-row">
           <div class="form-group  col-md-4" id="bed_confinement1_div" style="display:none;">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="bed_confinement1" checked disabled>
              <label class="form-check-label" for="gridCheck">Unable to get out of bed without assistance</label>
            </div>
          </div>
          <div class="form-group  col-md-4" id="bed_confinement2_div" style="display:none;">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="bed_confinement2" checked disabled>
              <label class="form-check-label" for="gridCheck"> Unable to ambulate </label>
            </div>
          </div>
          <div class="form-group  col-md-4" id="bed_confinement3_div" style="display:none;">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="bed_confinement3" checked disabled>
              <label class="form-check-label" for="gridCheck"> Unable to sit in a wheelchair or chair</label>
            </div>
          </div>
          
          </div>
          
          
          
          
            
       <div class="form-row" id="question23" style="display:none;">
       <div class="form-group  col-md-4" >
            <label for="inputEmail4">Attach Resident Face Sheet</label>
              <input type="file" class="form-control" id="facesheet" name="facesheet"  placeholder="Attach Resident Face Sheet" >
          </div>
       <div class="form-group  col-md-2" >{if $data.facesheet neq ''}<label for="inputEmail4"><a href="borrifiles/{$data.facesheet}" target="_blank">Old Attachment</a></label>{/if}</div>   
          <div class="form-group  col-md-4" >
            <label for="inputEmail4">Attach Completed Medical Necessity Form</label>
              <input type="file" class="form-control" id="necessityform" name="necessityform"  placeholder="Attach Completed Medical Necessity Form" >
          </div>
       <div class="form-group  col-md-2" >{if $data.necessityform neq ''}<label for="inputEmail4"><a href="borrifiles/{$data.necessityform}" target="_blank">Old Attachment</a></label>{/if}</div>      
       </div>   
        
       <div class="form-row" >
       <div class="form-group  col-md-12"><hr/></div>
       <div class="form-group" >
              <button type="submit" name="submit" id="submit"  value="submit" class="btn btn-primary btn-lg" >Update Appointment Request</button>
              <!--<button type="reset" name="" class="btn btn-primary btn-lg" >Reset</button>-->
            </div>
       </div>
          <!--<div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck"> Check me out </label>
            </div>
          </div>-->
            
          </div>
        </form>
        
        <!---------------------------------------------End of form----------------------------------------------------> 
        
      </div>
    </div>
  </div>
</section>
</body>
{*include file="flipserviceshomepage.tpl"*}
{include file="footerlast.tpl"} 
<script src="js/inputmasking.js"></script> 
<script src="js/triprequest777.js"></script> 
{literal}<script>
check_cecc();
$('.apdate_nextday').datetimepicker({timepicker:false,format:'m/d/Y',value:'{/literal}{$nextDay}{literal}',closeOnDateSelect: true,yearStart:year,minDate:'{/literal}{$chkNextDay}{literal}',maxDate:'+1970/06/30',scrollInput: false});
$('.apdate2_nextday').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,yearStart:year,yearEnd:year+1,minDate:'{/literal}{$chkNextDay}{literal}',maxDate:'+1970/06/30',scrollInput: false}).val('');
</script>{/literal}


{literal}
<script>
$(window).load(function() { 


vtypechange('{/literal}{$data.patient_weight}{literal}');
anticoagulant_fun('{/literal}{$data.anticoagulant_therapy}{literal}');
npo_prior_fun('{/literal}{$data.npo_prior}{literal}');
vetype_fun('{/literal}{$data.vehtype}{literal}');
bed_confinement_fun('{/literal}{$data.bed_confinement}{literal}');

$('#appdate_requested').val('{/literal}{$data.appdate_requested|date_format:"%m/%d/%Y"}{literal}');
$('#appdate').val('{/literal}{$data.appdate|date_format:"%m/%d/%Y"}{literal}');	
	
});
</script>
{/literal}
