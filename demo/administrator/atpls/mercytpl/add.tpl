{include file = headerinner.tpl}
{literal}
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDDFDk56m_SRbneFRHG3bNdRQjPOAQAhj4"></script>
<script language="JavaScript" type="text/javascript" src="suggest.js"></script>
<script language="JavaScript" type="text/javascript" src="suggest2.js"></script>
<script language="JavaScript" type="text/javascript" src="suggestpick.js"></script>
<script language="JavaScript" type="text/javascript" src="suggestdrop.js"></script>
<script language="JavaScript" type="text/javascript" src="suggestdrop3.js"></script>
<script language="JavaScript" type="text/javascript" src="suggestdrop4.js"></script>
<script language="JavaScript" type="text/javascript" src="suggestdrop5.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
$("#dob1").datepicker( {yearRange:'-120:00'} );
$("#dob1").mask("9999-99-99");
$("#appdate").mask("9999-99-99");
$("#d_phnum").mask("(999) 999-9999");
$("#d_phnum2").mask("(999) 999-9999");
$("#d_phnum3").mask("(999) 999-9999");
$("#p_phnum").mask("(999) 999-9999");
$("#ins_fax").mask("(999) 999-9999");
$('#adduser').validate({
submitHandler: function(form) {
    // do other things for a valid form
 $('#submitB').hide();
 form.submit();
  }
});
});
function test(){
if($('#sameadd').attr('checked')){	
var v=$('#autocomplete').val();
var z=$('#psuiteroom').val();
var x=$('#picklocation').val();
var y=$('#pickup_instruction').val();
    $('#autocomplete3').val(v);
	$('#bsuiteroom').val(z);
    $('#backtolocation').val(x);
	$('#backto_instruction').val(y);
 } 
	else { 
	$('#autocomplete3').val('');
	$('#bsuiteroom').val('');
    $('#backtolocation').val('');
	$('#backto_instruction').val('');
 }}
function test2(){
if($('#sameadd2').attr('checked')){	
var v=$('#pickaddress').val();
var x=$('#pckcity').val();
var y=$('#pckzip').val();
var z=$('#pckstate').val();
    $('#b_address').val(v);
    $('#b_city').val(x);
	$('#b_zip').val(y);
	$('#b_state').val(z); } 
	else { 
	$('#b_address').val('');
    $('#b_city').val('');
	$('#b_zip').val(''); }}	
$(document).ready(function (){
$('#org_apptime').mask('29:59');
$('#three_pickup').mask('29:59');
$('#four_pickup').mask('29:59');
$('#five_pickup').mask('29:59');
var v=$('#puchoice').val();
if(v =='Time'){ 
	$('#rpTime').show();	
    }
$("form").bind("keypress", function (e) {
    if (e.keyCode == 13) {
        return false;
    }
});	
});
function tValid(val,idv){
  var i = val.substr(0,1);
  var j = val.substr(1,1);
   if(i == '2'){
     if(j > 3){ $('#'+idv).val(''); return false; }else{ return true; }
    }
}
function chTrip(val){
//$('#waitopt').attr('checked', false);
   	if(val == 'One Way'){
	$('#umb,#umc,#umd').hide();
	
	$('#hideno').hide();
	$("#showno").hide();
	//$('#returnpickup').attr("disabled",true);
	$('#puchoice').removeAttr("class");
	//$('#backto').removeAttr("class");	
	$('#returnpickup').removeAttr("class");	
	$('#rpu').removeAttr("class");			
	$('#rpu').hide();	
	//$('#trBackTo').hide();	
	$('#rpTime').hide();	
	$('#trBackTo3').hide();	
	$('#trBackTo4').hide();	
	//$('#backto').hide();	
	//To hide
  	$('#b0').hide();
	$('#b1').hide();	
	$('#b2').hide();
	$('#b3').hide();
	$('#b4').hide();
	$('#b5').hide();
		
	$('#three0').hide();
	$('#three1').hide();
	$("#three2").hide();
	$('#three3').hide();
	$("#three4").hide();
	$('#three5').hide();
	$("#three6").hide();
	$("#three7").hide();
	
	$('#five0').hide();
	$('#five1').hide();
	$("#five2").hide();
	$('#five3').hide();
	$("#five4").hide();
	$('#five5').hide();
	$("#five6").hide();
	$("#five7").hide();
	
	$('#four0').hide();
	$('#four1').hide();

	$("#four2").hide();
	$('#four3').hide();
	$("#four4").hide();
	$('#four5').hide();
	$("#four6").hide();
	$("#four7").hide();	
	//Remove required attributes
	$('#backto').removeClass('required');
	$('#backtocity').removeClass('required');
	$('#backtostate').removeClass('required');
	//$('#backtozip').removeClass('required');
	 	
	$('#five_pickup').removeClass('required');
	$('#am_pm5').removeClass('required');
	$('#five_address').removeClass('required');
	$('#five_city').removeClass('required');
	$('#five_state').removeClass('required');
	//$('#five_zip').removeClass('required');
	
	$('#four_pickup').removeClass('required');
	$('#am_pm4').removeClass('required');
	$('#four_address').removeClass('required');
	$('#four_city').removeClass('required');
	$('#four_state').removeClass('required');
	//$('#four_zip').removeClass('required');
	
	$('#three_pickup').removeClass('required');
	$('#am_pm3').removeClass('required');
	$('#three_address').removeClass('required');
	$('#three_city').removeClass('required');
	$('#three_state').removeClass('required');
	//$('#three_zip').removeClass('required');

    return true;
    }
    else  if(val == 'Round Trip'){
		$('#umc,#umd').hide();
		$('#umb').show();
    var pu=$('#puchoice').val();
	if(pu=='Will Call'){
	$('#returnpickup').removeAttr("class");	
	$('#rpTime').hide();	
    $('#rpu').show();	
 	}else{
	    $('#rpu').show();	
		$('#rpTime').show();	
	}
	$('#b0').show();
	$('#b1').show();	
	$('#b2').show();
	$('#b3').show();
	$('#b4').show();
	$('#b5').show();
	//To hide
	$('#three0').hide();
	$('#three1').hide();
	$("#three2").hide();
	$('#three3').hide();
	$("#three4").hide();
	$('#three5').hide();
	$("#three6").hide();
	$("#three7").hide();
	
	$('#five0').hide();
	$('#five1').hide();
	$("#five2").hide();
	$('#five3').hide();
	$("#five4").hide();
	$('#five5').hide();
	$("#five6").hide();
	$("#five7").hide();
	
	$('#four0').hide();
	$('#four1').hide();
	$("#four2").hide();
	$('#four3').hide();
	$("#four4").hide();
	$('#four5').hide();
	$("#four6").hide();
	$("#four7").hide();	
	//Add required attributes to second destination 
	$('#backto').addClass('required');
	$('#backtocity').addClass('required');
	$('#backtostate').addClass('required');
	//$('#backtozip').addClass('required');
	//Remove required attributes 	
	$('#five_pickup').removeClass('required');
	$('#am_pm5').removeClass('required');
	$('#five_address').removeClass('required');
	$('#five_city').removeClass('required');
	$('#five_state').removeClass('required');
	//$('#five_zip').removeClass('required');
	
	$('#four_pickup').removeClass('required');
	$('#am_pm4').removeClass('required');
	$('#four_address').removeClass('required');
	$('#four_city').removeClass('required');
	$('#four_state').removeClass('required');
	//$('#four_zip').removeClass('required');
	
	$('#three_pickup').removeClass('required');
	$('#am_pm3').removeClass('required');
	$('#three_address').removeClass('required');
	$('#three_city').removeClass('required');
	$('#three_state').removeClass('required');
	//$('#three_zip').removeClass('required');
				  
	 return true;
    }
	else if(val == 'Three Way'){
	$('#umd').hide();
	$('#umb,#umc').show();
	$('#three0').show();
	$('#three1').show();
	$("#three2").show();
	$('#three3').show();
	$("#three4").show();
	$('#three5').show();
	$("#three6").show();
	$("#three7").show();
	
	$('#rpu').show();
	$('#b0').show();
	$('#b1').show();
	$('#b2').show();
	$('#b3').show();
	$('#b4').show();
	$('#b5').show();
	
	//Add required attributes 
	//$('#backto').addClass('required');
	//$('#backtocity').addClass('required');
	//$('#backtostate').addClass('required');
	//$('#backtozip').addClass('required');
	
	$('#three_pickup').addClass('required');
	//$('#am_pm3').addClass('required');
	//$('#three_address').addClass('required');
	//$('#three_city').addClass('required');
	//$('#three_state').addClass('required');
	//$('#three_zip').addClass('required');
	//hide four and five attributes
	$('#five0').hide();
	$('#five1').hide();
	$("#five2").hide();
	$('#five3').hide();
	$("#five4").hide();
	$('#five5').hide();
	$("#five6").hide();
	$("#five7").hide();
	
	$('#four0').hide();
	$('#four1').hide();
	$("#four2").hide();
	$('#four3').hide();
	$("#four4").hide();
	$('#four5').hide();
	$("#four6").hide();
	$("#four7").hide();
	//remove required of four and five
	$('#five_pickup').removeClass('required');
	$('#am_pm5').removeClass('required');
	$('#five_address').removeClass('required');
	$('#five_city').removeClass('required');
	$('#five_state').removeClass('required');
	//$('#five_zip').removeClass('required');
	
	$('#four_pickup').removeClass('required');
	$('#am_pm4').removeClass('required');
	$('#four_address').removeClass('required');
	$('#four_city').removeClass('required');
	$('#four_state').removeClass('required');
	//$('#four_zip').removeClass('required');
	
	return true;
    } 
	else if(val == 'Four Way'){
$('#umb,#umc,#umd').show();
	$('#four0').show();
	$('#four1').show();
	$("#four2").show();
	$('#four3').show();
	$("#four4").show();
	$('#four5').show();
	$("#four6").show();
	$("#four7").show();
	
	$('#three0').show();
	$('#three1').show();
	$("#three2").show();
	$('#three3').show();
	$("#three4").show();
	$('#three5').show();
	$("#three6").show();
	$("#three7").show();
	
	$('#rpu').show();
	$('#b0').show();
	$('#b1').show();
	$('#b2').show();
	$('#b3').show();
	$('#b4').show();
		$('#b5').show();	
	//Add required attributes 	
	$('#backto').addClass('required');
	//$('#backtocity').addClass('required');
	//$('#backtostate').addClass('required');
	//$('#backtozip').addClass('required');
	
	//$('#four_pickup').addClass('required');
	//$('#am_pm4').addClass('required');
	//$('#four_address').addClass('required');
	//$('#four_city').addClass('required');
	//$('#four_state').addClass('required');
	//$('#four_zip').addClass('required');
	
	//$('#three_pickup').addClass('required');
	//$('#am_pm3').addClass('required');
	//$('#three_address').addClass('required');
	//$('#three_city').addClass('required');
	//$('#three_state').addClass('required');
	//$('#three_zip').addClass('required');
	//hide four attributes
	$('#five0').hide();
	$('#five1').hide();
	$("#five2").hide();
	$('#five3').hide();
	$("#five4").hide();
	$('#five5').hide();
	$("#five6").hide()
	$("#five7").hide();
	//remove required of five
	$('#five_pickup').removeClass('required');
	$('#am_pm5').removeClass('required');
	$('#five_address').removeClass('required');
	$('#five_city').removeClass('required');
	$('#five_state').removeClass('required');
	//$('#five_zip').removeClass('required');
	
    return true;
    } 
	else if(val == 'Five Way'){
//To show feilds		
	$('#five0').show();
	$('#five1').show();
	$("#five2").show();
	$('#five3').show();
	$("#five4").show();
	$('#five5').show();
	$("#five6").show();
	$("#five7").show();
	
	$('#four0').show();
	$('#four1').show();
	$("#four2").show();
	$('#four3').show();
	$("#four4").show();
	$('#four5').show();
	$("#four6").show();
	$("#four7").show();
	
	$('#three0').show();
	$('#three1').show();
	$("#three2").show();
	$('#three3').show();
	$("#three4").show();
	$('#three5').show();
	$("#three6").show();
	$("#three7").show();
	
	$('#rpu').show();
	$('#b0').show();
	$('#b1').show();
	$('#b2').show();
	$('#b3').show();
	$('#b4').show();
		$('#b5').show();
	//Add required attributes 	
	$('#backto').addClass('required');
	$('#backtocity').addClass('required');
	$('#backtostate').addClass('required');
	//$('#backtozip').addClass('required');
	
	$('#five_pickup').addClass('required');
	$('#am_pm5').addClass('required');
	$('#five_address').addClass('required');
	$('#five_city').addClass('required');
	$('#five_state').addClass('required');
	//$('#five_zip').addClass('required');
	
	$('#four_pickup').addClass('required');
	$('#am_pm4').addClass('required');
	$('#four_address').addClass('required');
	$('#four_city').addClass('required');
	$('#four_state').addClass('required');
	//$('#four_zip').addClass('required');
	
	$('#three_pickup').addClass('required');
	$('#am_pm3').addClass('required');
	$('#three_address').addClass('required');
	$('#three_city').addClass('required');
	$('#three_state').addClass('required');
	//$('#three_zip').addClass('required');
    return true;
    }
	else{
		
	
	return true; 	
	}	}
function pUchoice(val){
    if(val == ''){    
	 return false;
    }
    if(val == 'Will Call'){ 
	$('#returnpickup').removeAttr("class");	
	$('#rpTime').hide();	
	  return true;
    }else{
	$('#returnpickup').attr("class","txt_boxX required");	
	$('#rpTime').show();
	return true; 	
	}	
}
function chProg(val){
    if(val == '0'){
     $('#labelXid').html('CIS ID');	
     $('#cisidsp').show();			     
     $('#ssnsp').hide();
	 $('#ssn').attr("class","txt_boxX");
	 $('#cisid').attr("class","txt_boxX required");	 		 
	 return true;
    }
    if(val == '1'){
     $('#labelXid').html('Social Security Number');	
     $('#ssnsp').show();	
     $('#cisidsp').hide();	 
	 $('#cisid').attr("class","txt_boxX");
	 $('#ssn').attr("class","txt_boxX required");		  		
    return true;
    }else{
     $('#labelXid').html('CIS ID');	
     $('#cisidsp').show();			     
     $('#ssnsp').hide();
	 $('#ssn').attr("class","txt_boxX");
	 $('#cisid').attr("class","txt_boxX required");
    return true;	 		
	}	
}
function app_type(type){ //alert(type);
	 if(type == 'specialist'){
	 $('.spec').show();
	 $('#fname').attr("class","txt_boxX required chars");
	 $('#lname').attr("class","txt_boxX required chars");
	 $('#phyaddress').attr("class","txt_boxX required");
	 $('#phycity').attr("class","txt_boxX required");
	 $('#phystate').attr("class","txt_boxX required");
	 $('#phyzip').attr("class","txt_boxX required digits");
	 $('#phyphone').attr("class","txt_boxX required");
	 $('#reason').attr("class","required");      }
	 else if(type == 'general'){
	 $('.spec').hide();
	 $('#fname').attr("class","txt_boxX chars");
	 $('#lname').attr("class","txt_boxX chars");
	 $('#phyaddress').attr("class","txt_boxX");
	 $('#phycity').attr("class","txt_boxX");
	 $('#phystate').attr("class","txt_boxX");
	 $('#phyzip').attr("class","txt_boxX digits");
	 $('#phyphone').attr("class","txt_boxX");
	 $('#reason').attr("class","");	 }
	  }	 
function back_address(val){
	  //alert(val);
	  if(val == '0'){
		$('.btaddress').show();
		$('#backto').attr("class","txt_boxX required");
		$('#backtocity').attr("class","txt_boxX required");
		$('#backtostate').attr("class","txt_boxX required");
		$('#backtozip').attr("class","txt_boxX digits");
		  }
	  else if(val == '1'){
		$('.btaddress').hide();
		$('#backto').attr("class","");
		$('#backtocity').attr("class","");
		$('#backtostate').attr("class","");
		$('#backtozip').attr("class","");
		  }
	  }
function time(t){ 
//var atime = document.getElementById('t').value; 
var atime = $('#'+t).val();
//alert(atime);
var hours = atime.split(':');
var hour = hours[0];
var minut = hours[1]; 
if(hour >23 || minut >59) 
{
alert('Please enter correct Appointment/Pick Time!');
$('#'+t).val('');
return false }}
function check_check3(){
	if($('#three_will_call').attr('checked')){
	$('#three_pickup').attr("disabled",true);
	$('#am_pm3').attr("disabled",true);
	$('#three_pickup').removeClass('required');
	$('#am_pm3').removeClass('required'); 
	$('#three_pickup').val('');   }
	else {
	$('#three_pickup').attr("disabled",false);
	$('#am_pm3').attr('disabled',false);
	$('#three_pickup').addClass('required');
	$('#am_pm3').addClass('required'); }
	 }	
function check_check4(){
	if($('#four_will_call').attr('checked')){ 
	$('#four_pickup').attr('disabled',true);
	$('#am_pm4').attr('disabled',true);
	$('#four_pickup').removeClass('required');
	$('#am_pm4').removeClass('required'); 
	$('#four_pickup').val('');    }
	else {
	$('#four_pickup').attr('disabled',false);
	$('#am_pm4').attr('disabled',false);
	$('#four_pickup').addClass('required');
	$('#am_pm4').addClass('required'); }
	 }		
function check_check5(){
	if($('#five_will_call').attr('checked')){ 
	$('#five_pickup').attr('disabled',true);
	$('#am_pm5').attr('disabled',true);
	$('#five_pickup').removeClass('required');
	$('#am_pm5').removeClass('required'); 
	$('#five_pickup').val('');   }
	else {
	$('#five_pickup').attr('disabled',false);
	$('#am_pm5').attr('disabled',false);
	$('#five_pickup').addClass('required');
	$('#am_pm5').addClass('required'); }
	 }
function ch_dol(id){
		if(id != ''){ 
			$.post("fetch_dol.php", {id: ""+id}, function(data){
				if(data.length > 0) {
            	var fetchedData = data;
			  		formvals = new Array();	 
				    formvals = fetchedData.split('^'); 
				  	if(formvals.length > 0){
						var ftof = $('#ftof').val();
						var ispickf = $('#ispickf').val(); 
						if(ftof==1){
								if(formvals[0] != '')
								  $('#pickaddress').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#pckcity').val(formvals[1]);
								if(formvals[2] != '')							  
								  $('#pckstate').val(formvals[2]);
								if(formvals[3] != '')							  
								  $('#pckzip').val(formvals[3]);
						}
						if(ftof==0 && ispickf==1){
							if(formvals[0] != '')
								  $('#pickaddress').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#pckcity').val(formvals[1]);
								if(formvals[2] != '')							  
								  $('#pckstate').val(formvals[2]);
								if(formvals[3] != '')							  
								  $('#pckzip').val(formvals[3]);
								  }
						if(ftof==0 && ispickf==0){
							    if(formvals[0] != '')
								  $('#destination').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#drpcity').val(formvals[1]);
								if(formvals[2] != '')							  
								  $('#drpstate').val(formvals[2]);
								if(formvals[3] != '')							  
								  $('#drpzip').val(formvals[3]);
								  }		  
					}
			   }   
		   });
	  return true;
	  }
 }	 
 function ch_dol2(id){
		if(id != ''){ 
			$.post("fetch_dol.php", {id: ""+id}, function(data){
				if(data.length > 0) {
            	var fetchedData = data;
			  		formvals = new Array();	 
				    formvals = fetchedData.split('^'); 
				  	if(formvals.length > 0){
						var ftof = $('#ftof').val(); 
								if(formvals[0] != '')
								  $('#destination').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#drpcity').val(formvals[1]);
								if(formvals[2] != '')							  
								  $('#drpstate').val(formvals[2]);
								if(formvals[3] != '')							  
								  $('#drpzip').val(formvals[3]);
						}
			   }   
		   });
	  return true;
	  }
 }	 //addressla
function PerfromAutomation(){
		var pname =  $('#pname').val();
		if(pname != ''){ 
			$.post("../../fetchdata_patient.php", {pname: ""+pname}, function(data){
				if(data.length > 0) {
            	var fetchedData = data;
			  		formvals = new Array();	 
				    formvals = fetchedData.split('^'); 
				  	if(formvals.length > 0){
								if(formvals[0] != '')
								  $('#pname').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#phnum').val(formvals[1]);
						  		if(formvals[3] != '')						  
								  $('#dob1').val(formvals[3]);
							  	if(formvals[4] != '')					  
								  $('#po').val(formvals[4]);
							  	if(formvals[5] != '')							  
						  		  $('#patient_weight').val(formvals[5]);
								  
					
							   	if(formvals[15] != '')  $('#autocomplete').val(formvals[15]); 	 						  
						  		if(formvals[19] != '')	$('#autocomplete2').val(formvals[19]); 						  
						  		if(formvals[23] != '')	$('#autocomplete3').val(formvals[23]);						  
						  	    if(formvals[51] != '')  $('#picklocation').val(formvals[51]);
								if(formvals[52] != '')  $('#droplocation').val(formvals[52]);
								if(formvals[53] != '')  $('#backtolocation').val(formvals[53]);
								if(formvals[54] != '')  $('#account').val(formvals[54]);
								
								if(formvals[55] != '')  $('#psuiteroom').val(formvals[55]);
								if(formvals[56] != '')  $('#dsuiteroom').val(formvals[56]);
								if(formvals[57] != '')  $('#bsuiteroom').val(formvals[57]);
								
								if(formvals[43] != '')  $('#pickup_instruction').val(formvals[43]);								  

			
								  if(formvals[27] != ''){							  
								  $('#appdate').val(formvals[27]); }
								  if(formvals[29] != ''){
										if(formvals[29] == '00:00:00'){
										   pUchoice('Will Call');
										   $('#puchoice').val('Will Call');
										}else{					
										 $('#puchoice').val('Time');		  
										 $('#returnpickup').val(formvals[29]); 
										 $('#returnpickup').attr("class","txt_box required");	
										 $('#rpTime').show();
										  }
									 }	
									 if(formvals[30] != ''){  $('#casemanager1').val(formvals[30]);	 }
									  if(formvals[31] != ''){ $('#comments').val(formvals[31]); 	 }	
									 if(formvals[32] != ''){  $('#insurance_name').val(formvals[32]); }
									 if(formvals[33] != ''){  $('#ssn').val(formvals[33]);  }
									 if(formvals[34] != ''){  $('#type').val(formvals[34]); }
									 
									 
									 if(formvals[35] != ''){  $('#triptype').val(formvals[35]); }
									 if(formvals[36] != ''){  $('#vehtype').val(formvals[36]); }
									 if(formvals[38] != ''){  $('#apptime').val(formvals[38]); 
									 
									 t=formvals[38];
										if(t){ 
												var res = t.split(":"); 
												var hours=((Number(res[0])+1));
												var ziro="0";
												if(hours<10){hours = ziro+hours; } 
												var minutes=res[1]; 
												$('#org_apptime').val(hours+':'+minutes); 
									 	 				  } }
									 //if(formvals[37] != ''){  $('#org_apptime').val(formvals[37]); }
									 
									 if(formvals[39] != ''){
									 	if(formvals[39] ='Male'){$('#sex1').attr("checked", true); }
										else{$('#sex2').attr("checked", true);}
														   }
									if(formvals[41] != ''){  $('#cisid').val(formvals[41]); }
								//	if(formvals[42] != ''){  $('#hostpital_id').val(formvals[42]); }
									if(formvals[43] != ''){  $('#pickup_instruction').val(formvals[43]); }
									if(formvals[44] != ''){  if(formvals[44] == 'Yes') $("#stretcher").attr("checked", true); }
									if(formvals[45] != ''){  if(formvals[45] == 'Yes') $('#dstretcher').attr("checked", true); }
									if(formvals[46] != ''){  if(formvals[46] == 'Yes')  $('#bar_stretcher').attr("checked", true); }
									if(formvals[47] != ''){  if(formvals[47] == 'Yes')  $('#escort').attr("checked", true); }
									if(formvals[48] != ''){  if(formvals[48] == 'Yes')  $('#wchair').attr("checked", true); }
									if(formvals[49] != ''){  if(formvals[49] == 'Yes')  $('#dwchair').attr("checked", true); }
									if(formvals[50] != ''){  if(formvals[50] == 'Yes')  $('#oxygen').attr("checked", true); }						   	
														   chTrip(formvals[35]);				 
						 		}
			   }   
		   });
	  return true;
	  }
 }
function PerfromAutomation1(){
		var shid =  $('#phnum').val();
		var code =  '0';
		if(shid != ''){ 
			$.post("../../fetchdata_patient.php", {phnum: ""+shid, id: ""+code}, function(data){
				if(data.length > 0) {
            	var fetchedData = data;
			  		formvals = new Array();	 
				    formvals = fetchedData.split('^'); 
				  	if(formvals.length > 0){
								if(formvals[0] != '')
								  $('#pname').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#phnum').val(formvals[1]);
						  	  	/*if(formvals[2] != '')						  
								  $('#email').val(formvals[2]);*/
								if(formvals[3] != '')						  
								  $('#dob1').val(formvals[3]);
							  	if(formvals[4] != '')					  
								  $('#po').val(formvals[4]);
							  	if(formvals[5] != '')							  
						  		  $('#patient_weight').val(formvals[5]);
											  
						if(formvals[15] != '')  $('#autocomplete').val(formvals[15]); 	 						  
						  		if(formvals[19] != '')	$('#autocomplete2').val(formvals[19]); 						  
						  		if(formvals[23] != '')	$('#autocomplete3').val(formvals[23]);						  
						  	    if(formvals[51] != '')  $('#picklocation').val(formvals[51]);
								if(formvals[52] != '')  $('#droplocation').val(formvals[52]);
								if(formvals[53] != '')  $('#backtolocation').val(formvals[53]);
								if(formvals[54] != '')  $('#account').val(formvals[54]);
								
								if(formvals[55] != '')  $('#psuiteroom').val(formvals[55]);
								if(formvals[56] != '')  $('#dsuiteroom').val(formvals[56]);
								if(formvals[57] != '')  $('#bsuiteroom').val(formvals[57]);
								
								if(formvals[43] != '')  $('#pickup_instruction').val(formvals[43]);								  

								  if(formvals[27] != ''){							  
								  $('#appdate').val(formvals[27]); }
								  if(formvals[29] != ''){
										if(formvals[29] == '00:00:00'){
										   pUchoice('Will Call');
										   $('#puchoice').val('Will Call');
										}else{					
										 $('#puchoice').val('Time');		  
										 $('#returnpickup').val(formvals[29]); 
										 $('#returnpickup').attr("class","txt_box required");	
										 $('#rpTime').show();
										  }
									 }	
									 if(formvals[30] != ''){  $('#casemanager1').val(formvals[30]);	 }
									  if(formvals[31] != ''){ $('#comments').val(formvals[31]); 	 }	
									 if(formvals[32] != ''){  $('#insurance_name').val(formvals[32]); }
									 if(formvals[33] != ''){  $('#ssn').val(formvals[33]);  }
									 if(formvals[34] != ''){  $('#type').val(formvals[34]); }
									 
									 
									 if(formvals[35] != ''){  $('#triptype').val(formvals[35]); }
									 if(formvals[36] != ''){  $('#vehtype').val(formvals[36]); }
									 //if(formvals[37] != ''){  $('#org_apptime').val(formvals[37]); }
									 if(formvals[38] != ''){  $('#apptime').val(formvals[38]); 
									 
									  t=formvals[38];
										if(t){ 
												var res = t.split(":"); 
												var hours=((Number(res[0])+1));
												var ziro="0";
												if(hours<10){hours = ziro+hours; } 
												var minutes=res[1]; 
												$('#org_apptime').val(hours+':'+minutes); 
									 	 				  } }
									 if(formvals[39] != ''){
									 	if(formvals[39] ='Male'){$('#sex1').attr("checked", true); }
										else{$('#sex2').attr("checked", true);}
														   }
								//	if(formvals[42] != ''){  $('#hostpital_id').val(formvals[42]); }
									if(formvals[43] != ''){  $('#pickup_instruction').val(formvals[43]); }
									if(formvals[44] != ''){  if(formvals[44] == 'Yes') $("#stretcher").attr("checked", true); }
									if(formvals[45] != ''){  if(formvals[45] == 'Yes') $('#dstretcher').attr("checked", true); }
									if(formvals[46] != ''){  if(formvals[46] == 'Yes')  $('#bar_stretcher').attr("checked", true); }
									if(formvals[47] != ''){  if(formvals[47] == 'Yes')  $('#escort').attr("checked", true); }
									if(formvals[48] != ''){  if(formvals[48] == 'Yes')  $('#wchair').attr("checked", true); }
									if(formvals[49] != ''){  if(formvals[49] == 'Yes')  $('#dwchair').attr("checked", true); }
									if(formvals[50] != ''){  if(formvals[50] == 'Yes')  $('#oxygen').attr("checked", true); }	
									
									chTrip(formvals[35]);				 
						 		}
			   }   
		   });
	  return true;
	  }
 }
function prog_change(h_id){
	 //alert(h_id);
	 if(h_id != ''){ 
			$.post("change_progarm.php", {h_id: ""+h_id}, function(data2){
				if(data2.length > 0) {
            	var fetchedData2 = data2;
			  		formvals2 = new Array();	 
				    formvals2 = fetchedData2.split('^'); 
				  	if(formvals2.length > 0){
								if(formvals2[0] != '') 
								{ var ptitle = formvals2[0]; //alert(ptitle);
								
								$('#prgtitle').val(ptitle);
								//document.getElementById("#prgtitle").value =ptitle;
								}//  $('#prgtitle').val(formvals2[0]);
							  	if(formvals2[1] != '')	{
									var plable = formvals2[1];
									document.getElementById('prgassoctitle').innerHTML = (plable);
						  	  }
					}
			   }   
		   });
	  return true;
	  }
	 }
	 
	 
function googleapihandler(id,data){
		  var str1 = document.getElementById(id);
		  var curLeft=0;
		  if (str1.offsetParent){
			  while (str1.offsetParent){
		   curLeft += str1.offsetLeft;
		   str1 = str1.offsetParent;
			  }
		  }
		  var str2 = document.getElementById(id);
		  var curTop=20;
		  if (str2.offsetParent){
			  while (str2.offsetParent){
		   curTop += str2.offsetTop;
		   str2 = str2.offsetParent;
			  }
		  }
		  $('#div_'+id).remove();
		  $('#'+id).parent().append('<div id="div_'+id+'"></div>');
		  var ss = document.getElementById('div_'+id);
		  var str =data
		  if(str.length < 1)
			  document.getElementById('div_'+id).style.visibility = "hidden";
		  else
			  ss.setAttribute('style','position:absolute;top:'+curTop+';left:'+curLeft+';width:250;z-index:1;padding:5px;border: 0px solid #000000; overflow:auto; height:105; background-color:#F5F5FF; z-index:9999;');
		  ss.innerHTML = '';
  
		 // console.log(data);
		$('body').click(function() {
       $('#div_'+id).remove();
});
		  $.each(data,function(index,item){
			  
			   var suggest = '<div  ';
            suggest += ' ';
            suggest += 'onclick="javascript:$(\'#'+id+'\').val(\''+item+'\');$(\'#div_'+id+'\').remove();" ';
            suggest += 'class="small">' + item + '</div>';
            ss.innerHTML += suggest;
			  
			  });
		   $.post("../google_api_log.php", {type: ""+'Address Populate'});
		  
		  
}
function initialize() {
	  $('#autocomplete').keyup(function(e){
		  switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
				
		  var myval = $('#autocomplete').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  
			  });	 
		 
		 }
		 	break;
		  }
	  
	  });
	 
     // 
}
function initialize2() {
		 $('#autocomplete2').keyup(function(e){
			 switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete2').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete2',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  });	 
		 
		 }
		 
		 break;
		}
	  
	  });
	  	
}
function initialize3() {
		$('#autocomplete3').keyup(function(e){
			switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete3').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete3',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  });	 
		 
		 }
		 	break;
			}
	  
	  });
}
function initialize4() {
$('#ins_billing_address').keyup(function(e){
	switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:	
		  var myval = $('#ins_billing_address').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('ins_billing_address',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  });	 
		 
		 }
		 break;
	}
	  
	  });
}
function initialize5() {
	$('#pp_billing_address').keyup(function(e){
		switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#pp_billing_address').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('pp_billing_address',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  });	 
		 
		 }
		 break;
		}
	  
	  });   
}
function initialize6() {
	$('#autocomplete4').keyup(function(e){
		switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete4').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete4',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  });	 
		 
		 }
		 	break;
		}
	  
	  });     
	  
}
function initialize7() {
	 $('#autocomplete5').keyup(function(e){
		 switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete5').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete5',data);
			  $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });
			  });	 
		 
		 }
		 	break;
		 }
	  
	  });     
}
function addressla(id){
		if(id != ''){ 
		if(id=='1') { var loc = $('#picklocation').val(); }
		if(id=='2') { var loc = $('#droplocation').val(); }
		if(id=='3') { var loc = $('#droplocation2').val(); }
		if(id=='4') { var loc = $('#droplocation3').val(); }
		if(id=='5') { var loc = $('#backtolocation').val(); }
			$.post("addressla.php", {id: ""+id,loc: ""+loc}, function(data){
				if(data.length > 0) { 
				if(id=='1') {  $('#autocomplete').val(data); }
				if(id=='2') {  $('#autocomplete2').val(data); }
				if(id=='3') {  $('#autocomplete4').val(data); }
				if(id=='4') {  $('#autocomplete5').val(data); }
				if(id=='5') {  $('#autocomplete3').val(data); }
			   }   
		   });
	  return true;
	  }
 }	 //addressla		
	
</script> 
{/literal}
<body onLoad="initialize(); initialize2(); initialize3();  initialize4(); initialize5();  initialize6(); initialize7();">
<table width="78%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" class="" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
           <td height="25" align="right" valign="top">
		  <!--<a href="add_trip_sheet3.php" rel="facebox" >Access2Care
		  <img alt="Add" border="0" src="../graphics/add_xlsx.png" title="Upload Trips Sheet"></a> |-->
          <a href="add_trip_sheet2.php" rel="facebox" >Logistic Care
          <img alt="Add" border="0" src="../graphics/add_xlsx.png" title="Upload Trips Sheet"></a> |
          <a href="mmt.php" rel="facebox" >MTM
		  <img alt="Add" border="0" src="../graphics/add_xlsx.png" title="Upload Trips Sheet"></a> |
          <a href="javascript:history.back();">Back</a></td>
        </tr>
        { if $msgs == '' }
        <tr>
          <td height="19" align="center" class="admintopheading">New Request Form</td>
        </tr>
        {/if}
        { if $msgs != '' ||  $errors != ''}
        <tr>
          <td height="19" align="center">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
        </tr>{/if}
        <tr>
          <td height="44" align="center"  valign="top"> { if $msgs == '' }
            <form name="adduser" id="adduser" method="post" action="index.php" >
              <table width="98%" border="0" cellspacing="2" cellpadding="2" align="center">
                <tr>
                  <td colspan="3" valign="top" class="admintopheading" align="left"><strong><span class="form_heading">Pickup Information</span></strong></td>
                </tr>
                {literal}<script>
                 function hay(ff){ 
				 if(ff==1){	$('#pick,#drop,#pickdropbill').show();  $('#ispickfacility').hide();
				 }
				 if(ff==0){ $('#pick,#drop,#pickdropbill').hide();  $('#ispickfacility').show(); 
				 $('#pickaddress,#pckcity,#pckstate,#pckzip,#destination,#drpcity,#drpstate,#drpzip,#hostpital_id,#dropfacility').val('');
				 }
				}
				function dil(){ 
					var ftof = $('#ftof').val();
					var ispickf = $('#ispickf').val();
					//alert(ispickf);
					//var ftof = $('#ftof').val();
					 if(ftof==0 && ispickf==1){	$('#pick').show();  $('#drop').hide();}
					 if(ftof==0 && ispickf==0){	$('#drop').show();  $('#pick').hide();}
					 }
				function textalerty(val){
					if(val=='Yes'){	$('#cellalert,#cellalert2').show();}
					 else{	$('#cellalert,#cellalert2').hide();}
					}	 
                </script>{/literal}
              <!--   <tr>
                  <td align="left" valign="top" class="labels"><span style="color:#F00;">Are you transporting from facility to facility?</span></td>
                  <td colspan="2" align="left"><select name="ftof" id="ftof"  class="txt_box required"  onchange="hay(this.value);">
                                       <option value="1">Yes</option>
                      <option value="0">No</option>
				    </select>&nbsp;*</td>
                </tr>
               <tr id="pickdropbill" style="display:none;">
                  <td align="left" valign="top" class="labels">Bill To </td>
                  <td colspan="2" align="left"><input type="radio" checked="checked" name="billto" value="pick"  />&nbsp;&nbsp;Pick up Facility <span style="color:#F00;"><strong>OR</strong></span> <input type="radio" name="billto" value="drop"  />Drop up Facility</td>
                </tr>
                
                 <tr id="ispickfacility" style="display:none;">
                  <td align="left" valign="top" class="labels"><span style="color:#F00;">Is this pick up from a facility?</span></td>
                  <td colspan="2" align="left"><select name="ftofg" id="ispickf"  class="txt_box"  onchange="dil();">
                    <option  value="">-- Select Option --</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
				    </select></td>
                </tr>
               -->
                <tr>
                  <td align="left" valign="top" class="labels">Billing Account on File:</td>
                  <td colspan="2" align="left"><select name="account"  id="account"  class="txt_box required">
                    <option  value="">-- Select Billing Account --</option>
                      {section name=n loop=$accounts}
					<option value="{$accounts[n].id}" {if $accounts[n].id eq $post.account}selected{/if}> {$accounts[n].account_name} </option>
                		{/section}
				    </select></td>
                </tr>
                <tr>
                  <td colspan="3" valign="top" class="admintopheading" align="left"><strong><span class="form_heading">Patient Information</span></strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Patient Name</span>:</strong></td>
                  <td colspan="2" align="left"><input name="pname" type="text" class="txt_box required" id="pname"  value="{$post.pname}" maxlength="50" autocomplete="off"  onKeyUp="searchSuggest();" /> &nbsp;*&nbsp;&nbsp;&nbsp;<a href="#" onClick="PerfromAutomation();" ><img src="../images/export.png" width="30" height="20" title="Auto Populate Patient Data Through Name" /></a>
                    <div id="layer1"></div></td>
                </tr>
                
            <!--<tr>
                  <td align="left" valign="top" class="labels">Insurance ID:</td>
                  <td colspan="2" align="left"><input name="cisid" type="text" class="txt_box" id="cisid"  value="{$post.cisid}" maxlength="30"/>
                    </td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels">Insurance Type:</td>
                  <td colspan="2" align="left"><input type="text" name="insurance_name" id="insurance_name" /></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Status</span>:</strong></td>
                  <td colspan="2" align="left"><select name="status"  class="txt_box required" id="status">
			    <option value="">- Select Status -</option>
				<option value="current">Current</option>
                <option value="inactive">Inactive</option>
			</select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>-->
                <tr>
                  <td align="left" valign="top" class="labels"><span class="label">Patient Phone No: </span></td>
                  <td colspan="2" align="left"><input type="text" name="phnum" id="phnum" value="{$post.phnum}" class="txt_box" maxlength="14" onKeyUp="searchSuggest2();"/>
                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="PerfromAutomation1();" ><img src="../images/export.png" width="30" height="20" title="Auto Populate Patient Data Through Phone Number" /></a>
                    <div id="layer2"></div></td>
                </tr>
               <tr>
                  <td align="left" valign="top" class="labels"><span class="label">P.O #: </span></td>
                  <td colspan="2" align="left"><input type="text" name="po" id="po" value="{$post.po}" class="txt_box" maxlength="14" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><span class="label">Claim #: </span></td>
                  <td colspan="2" align="left"><input type="text" name="claim_no" id="claim_no" value="{$post.claim_no}" class="txt_box" maxlength="14" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Patient DOB: </span>:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="dob" id="dob1" value="{$post.dob}" class="txt_box" />
                    <span class="SmallnoteTxt"></span> (yyyy-mm-dd)</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><span class="label">Patient Weight: </span></td>
                  <td colspan="2" align="left"><input type="text" name="patient_weight" id="patient_weight" value="{$post.patient_weight}" class="txt_box" maxlength="14" />
                    &nbsp; (Lbs)</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top" class="admintopheading"><strong><span class="form_heading">Trip Information</span></strong></td>
                </tr>
                <tr>
                  <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Select Trip Type</span>:</strong></td>
                  <td colspan="2" align="left"><select name="triptype"  class="txt_box required" id="triptype" onChange="return chTrip(this.value);" >
                      <option value="">--Select Trip Type--</option>
                      <option value="One Way" 	{if $post.triptype eq 'One Way'}selected{/if} {if $post.triptype eq ''} selected {/if} >One Way--(1 Destination)</option>
                      <option value="Round Trip" {if $post.triptype eq 'Round Trip'}selected{/if}>Two Way--(Round Trip)</option>
                      <option value="Three Way" {if $post.triptype eq 'Three Way'}selected{/if}>Three Way--(3 Destinations)</option>
                      <option value="Four Way" 	{if $post.triptype eq 'Four Way'}selected{/if}>Four Way--(4 Destinations)</option>
                      <!--<option value="Five Way" 	{if $post.triptype eq 'Five Way'}selected{/if}>Five Way--(5 Destinations)</option>-->
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Vehicle Preference:</span></strong></td>
                  <td colspan="2" align="left"><select name="vehtype" class="required txt_box" id="vehtype"  >
                      <option value="">Select</option>
                      
                      			  {section name=q loop=$vehiclepref}	

                      <option value="{$vehiclepref[q].id}" {if $post.vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>
                      
                      {/section}
		
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                
                <tr>
                  <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Oxygen Required ?</span></strong></td>
                  <td colspan="2" align="left"><select name="oxygen"  class="txt_box required" id="oxygen" >
                      <option value="No" {if $post.oxygen eq 'No'}selected{/if}> No </option> 
                      <option value="Yes" {if $post.oxygen eq 'Yes'}selected{/if}> Yes </option>
                                          
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Do you want to generate text alert?</span></strong></td>
                <td colspan="2" align="left"><select name="cellalertoption" class="txt_box required" id="cellalertoption" onChange="textalerty(this.value)" >
                      <option value="No" {if $post.cellalertoption eq 'No'}selected{/if}> No </option>
                      <option value="Yes" {if $post.cellalertoption eq 'Yes'}selected{/if}> Yes </option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <!--<tr id="cellalert2" style="display:none;">
                  <td class="labels">Trigger Alert for :</td>
                  <td colspan="2"><select name="trigerfor" class="txt_box required" id="trigerfor" >
                      <option value="drop" {if $post.trigerfor eq 'drop'}selected{/if}> Drop off </option>
                      <option value="pick" {if $post.trigerfor eq 'pick'}selected{/if}> Pick Up </option>
                    </select></td>
                 </tr>-->
                 <tr id="cellalert" style="display:none;">
                  <td class="labels">Cell #:</td>
                  <td colspan="2"><input type="text" name="cellalert"  value="{$post.cellalert}" class="txt_box " maxlength="12"  />
                  <span style="color:#F00"> e.g. 1112223456 (Only cell number | Alert for 1st destination)</span></td>
                 </tr>
                <tr>
                  <td colspan="3" valign="top" class="admintopheading"><strong><span class="form_heading">Appointment Information</span></strong></td>
                </tr>
                <!--<tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Appointment Type:</span></strong></td>
                  <td colspan="2" align="left"><select name="type" class="required txt_box" id="type"  >
                      <option value="">Select</option>
                      			  {section name=q loop=$appdata}	
                 <option value="{$appdata[q].type}">{$appdata[q].type}</option>
                      {/section}
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>-->
                <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Appointment Date</span>:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="appdate" id="appdate" value="{if $post.appdate neq ''}{$post.appdate}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" class="required txt_box"  maxlength="15" />
                    &nbsp;<span class="SmallnoteTxt">*</span> <span class="SmallnoteTxt">(yyyy-mm-dd)</span></td>
                </tr>
                <tr>
                  <td colspan="3" height="3"></td>
                </tr>
                {literal}<script>
				function addaptime(){
					t=$('#apptime').val(); 
					if(t){ 
						var res = t.split(":"); 
						var hours=((Number(res[0])+1));
						var ziro="0";
						//alert(ziro+hours);
						if(hours<10){hours = ziro+hours; } 
						var minutes=res[1]; //alert(hours);
						$('#org_apptime').val(hours+':'+minutes); 
						}
				}</script>{/literal}
                <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Pick Time</span>:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="apptime" id="apptime" value="{$post.apptime}" class="required txt_box"  maxlength="8"   onblur="time(this.id); addaptime();"/>
                    &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
                </tr>
                 <tr>
                  <td align="left" valign="top" class="labels"><strong><span class="label">Appointment Time</span>:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="org_apptime" id="org_apptime" value="{$post.org_apptime}" class="txt_box"  maxlength="8"  onblur="return time(this.id);"/>
                    &nbsp;<span class="SmallnoteTxt">(e.g. 15:30 Hrs)</span></td>
                </tr>
               
                <tr  id="rpu" style="display:none;">
                  <td align="left" valign="top" class="labels"><strong><span class="label">Return Pickup</span>:</strong><br/>
                    <span style="color:#666; font-size:10px;">For last destination</span></td>
                  <td colspan="2" align="left"><select name="puchoice" id="puchoice" class="txt_box " onChange="return pUchoice(this.value);" >
                      <option value="" {if $pickupchoice eq ''}selected{/if}>Select</option>
                      <option value="Will Call" {if $post.pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>
                      <option value="Time" {if $post.pickupchoice eq 'Time'}selected{/if}>Time</option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr id="rpTime" style="display:none;">
                  <td align="left" valign="top" class="labels"><span class="label">Return Pick Time</span>:</td>
                  <td colspan="2" align="left"><input type="text" name="returnpickup" id="returnpickup" value="{$post.returnpickup}"  class="txt_box " maxlength="8" onBlur="return time(this.id);" />
                    &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
                </tr>
               <!-- <tr>
                  <td align="left" valign="top" class="labels"><span class="label">Staff Member :</span></td>
                  <td colspan="2" align="left"><input type="text" name="casemanager1" id="casemanager1" value="{$post.casemanager1}" class="txt_box " />
                    &nbsp;</td>
                </tr>-->
                <tr>
                  <td align="left" valign="top" class="labels"><span class="label">Today Date:</span></td>
                  <td colspan="2" align="left"><input type="text" name="todaydate" id="todaydate" value='{$smarty.now|date_format}' class="txt_box required" readonly  /></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><span class="label">Total Passengers:</span></td>
                  <td colspan="2" align="left"><input type="text" name="passenger" id="passenger"  class="txt_box required" value="1" /></td>
                </tr>
                <tr align="left">
                  <td colspan="3" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><div class="admintopheading">General Options</div></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="0">
                      <!--<tr>
  <td class="labels">Driver Preference :</td><td class="labels"><input type="radio" name="driver" value="Male" {if $post.driver eq 'Male'} checked="checked" {/if}/>&nbsp;Male</td>
  <td class="labels"><input type="radio" name="driver" value="Female" {if $post.driver eq 'Female'} checked="checked" {/if}/>&nbsp;Female</td>
  </tr>
                      <tr>
                        <td class="labels">Patient Driver Preference :</td>
                        <td class="labels"><input type="radio" name="sex" id="sex1" value="Male" {if $post.sex eq 'Male'} checked="checked" {/if}/>
                          &nbsp;Male</td>
                        <td class="labels"><input type="radio" name="sex" id="sex2" value="Female" {if $post.sex eq 'Female'} checked="checked" {/if}/>
                          &nbsp;Female</td>
                      </tr>-->
                      <tr>
                        <td height="4px" colspan="4"></td>
                      </tr>
                     <!-- <tr>
                        <td class="labels">Stretcher :</td>
                        <td class="labels"><input type="checkbox" name="stretcher" id="stretcher" value="Yes" {if $post.stretcher eq 'yes'} checked="checked"{/if}/>
&nbsp;Yes </td> </tr>-->
					 <tr>
                        <td class="labels">2 Man Team :</td>
                       <td class="labels"><input type="checkbox" name="dstretcher" id="dstretcher" value="Yes" {if $post.dstretcher eq 'yes'} checked="checked"{/if}/>
&nbsp;Yes</td> </tr>
					<!--<tr>
                        <td class="labels">Bariatric Stretcher :</td>
                        <td class="labels"><input type="checkbox" name="bar_stretcher" id="bar_stretcher" value="Yes" {if $post.bar_stretcher eq 'yes'} checked="checked"{/if}/>
&nbsp;Yes </td> </tr>
					<tr>
                        <td class="labels">Escort :</td>
                        <td class="labels"><input type="checkbox" name="escort" id="escort" value="Yes" {if $post.escort eq 'Yes'} checked="checked"{/if} />
                          &nbsp;Yes</td>
                      </tr>
                      <tr>
                        <td class="labels">Wheel Chair :</td>
                        <td class="labels"><input type="checkbox" name="wchair" id="wchair" value="Yes" {if $post.wchair eq 'Yes'} checked="checked"{/if}/>
                          &nbsp;Yes</td>
                      </tr>-->
                      <tr>
                        <td class="labels">Wheel Chair Rental :</td>
                        <td class="labels"><input type="checkbox" name="dwchair" id="dwchair" value="Yes" {if $post.dwchair eq 'Yes'} checked="checked"{/if}/>
                          &nbsp;Yes</td>
                      </tr>
                      <!--<tr>
                        <td class="labels">0xygen:</td>
                        <td class="labels"><input type="checkbox" name="oxygen" id="oxygen" value="Yes" {if $post.oxygen eq 'Yes'} checked="checked"{/if}/>
                          &nbsp;Yes</td>
                      </tr>
                      <tr>
  <td class="labels">Child Seat :</td><td class="labels"><input type="checkbox" name="childseat" value="Yes" {if $post.childseat eq 'Yes'} checked="checked"{/if}/>&nbsp;Yes</td>
  <td class="labels">Oxygen O<sub>2</sub> :</td><td class="labels"><input type="checkbox" name="oxygen" value="Yes" {if $post.oxygen eq 'Yes'} checked="checked" {/if} />&nbsp;Yes</td>
  </tr>-->
                    </table></td>
                </tr>
                <tr>
                  <td colspan="3"><div class="admintopheading">Pick Up Information</div></td>
                </tr>
                <!--<tr id="pick"  style="">
                  <td align="left" valign="top" class="labels">Pick Facility :</td>
                  <td colspan="2" align="left"><select name="hostpital_id" id="hostpital_id"  class="txt_box" onchange="ch_dol(this.value);">
                    <option  value="">-- Select Facility --</option>
                      {section name=n loop=$hospitals}
					<option value="{$hospitals[n].id}" {if $hospitals[n].id eq $post.hostpital_id}selected{/if}> {$hospitals[n].hospname} </option>
                		{/section}
				    </select></td>
                </tr>-->
                <tr>
                  <td class="labels">Pickup Location:</td>
                  <td><input type="text" name="picklocation" id="picklocation" value="{$post.picklocation}" class="txt_box "  size="45" onKeyUp="searchSuggest3();"  autocomplete="off"/><div id="layer3"></div></td>
                  <td><a onClick="addressla(1);"><img src="../graphics/arrow.png" ></a></td>
                 </tr>
                 <tr>
                  <td class="labels">Pickup Address:</td>
                  <td><input type="text" name="pickaddress" id="autocomplete" placeholder="Enter Complete Pickup Address" value="{$post.pickaddress}" class="txt_box required"   maxlength="150" onKeyUp="test();" size="45" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels">Suite #/Room #:</td> 
               <td><input type="text" name="psuiteroom" id="psuiteroom" value="{$post.psuiteroom}"  class="txt_box"  maxlength="150"  size="45" />
                 </td>
                  <td></td>
                </tr>
               <!--<tr>
                <td class="labels">City:</td>
              <td><input type="text" name="pckcity" id="pckcity"  class="txt_box  required chars" onkeyup="test();"  value="" maxlength="30" />
                    <span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels">State:</td>
                  <td><select name="pckstate" id="pckstate"  class="txt_box required">
                      <option value="">Select</option>
			   {section name=n loop=$states}
    <option value="{$states[n].abbr}"{if $states[n].abbr eq $post.pckstate} selected="selected" {else}{if $states[n].abbr eq 'AZ'} selected="selected" {/if}{/if}>
	   {$states[n].statename}
                      </option>
			  {/section}
                    </select>
                    <span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels">Zip Code: </td>
                  <td><input type="text" name="pckzip" id="pckzip" onkeyup="test();"  class="txt_box " value="{$post.pckzip}" maxlength="10"/>
                    <span class="SmallnoteTxt">* e.g. 12345-6789</span></td>
                  <td></td>
                </tr>-->
                <tr>
                  <td class="labels">Pick Up Instructions: </td>
                  <td colspan="2"><textarea rows="3" cols="40" name="pickup_instruction" id="pickup_instruction">{$post.pickup_instruction}</textarea>
                    </td>
                </tr>
                 <tr>
                  <td class="labels">Pick Phone Number:</td>
                  <td><input type="text" name="p_phnum" id="p_phnum" value="{$post.p_phnum}" class="txt_box" maxlength="14" />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr> 
                <tr>
                  <td colspan="3"><div class="admintopheading"><!---->First Destination Address</div></td>
                </tr>
                <tr>
                  <td class="labels">Drop Location:</td>
                  <td><input  type="text" name="droplocation" id="droplocation" value="{$post.droplocation}"  class="txt_box"  size="45"  onKeyUp="searchSuggest4();"  autocomplete="off"/><div id="layer4"></div>
                    </td>
                  <td><a onClick="addressla(2);"><img src="../graphics/arrow.png" ></a></td>
                </tr>
                <tr>
                  <td class="labels">Destination Address:</td>
                  <td><input  type="text" name="destination" id="autocomplete2" value="{$post.destination}" placeholder="Enter Complete Drop Address"  class="txt_box required"  maxlength="150"  size="45" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                 <tr>
                  <td class="labels">Suite #/Room #:</td> 
            <td><input type="text" name="dsuiteroom" id="dsuiteroom" value="{$post.dsuiteroom}"  class="txt_box"  maxlength="150"  size="45" />
                 </td>
                  <td></td>
                </tr>
                <!--<tr>
                  <td class="labels">City:</td>
                  <td><input type="text" name="drpcity" value="" id="drpcity" class="txt_box required" maxlength="20" />
                    <span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels">State:</td>
                  <td><select name="drpstate" id="drpstate" class="txt_box required">
                      <option value="">Select</option>
{section name=n loop=$states}
     <option value="{$states[n].abbr}"{if $states[n].abbr eq $post.drpstate} selected="selected" {else}{if $states[n].abbr eq 'AZ'} selected="selected" {/if}{/if}>
{$states[n].statename}
                      </option>
{/section}
                    </select>
                    <span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels">Zip Code: </td>
                  <td><input maxlength="10" type="text" name="drpzip" value="{$post.drpzip}" id="drpzip" class="txt_box "/>
                    <span class="SmallnoteTxt"> e.g. 12345-6789 </span></td>
                  <td></td>
                </tr>-->
                                <tr>
                  <td class="labels">Destination Instructions: </td>
                  <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction" id="destination_instruction">{$post.destination_instruction}</textarea>
                    </td>
                </tr>

				 <tr>
                  <td class="labels">Destination Phone Number:</td>
                  <td><input type="text" name="d_phnum" id="d_phnum" value="{$post.d_phnum}" class="txt_box" maxlength="14" />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr> 
                
             
                <tr id="three0" style="display:none">
                  <td colspan="3"><div class="admintopheading">Second Destination Information</div></td>
                </tr>
                <tr id="three1" style="display:none">
                  <td class="labels">2nd Pick Time: </td>
                  <td colspan="2"><input type="text" name="three_pickup" id="three_pickup" value="{$post.three_pickup}"  class="txt_box " maxlength="5" onBlur="javascript:time(this.id);" />
                    
                               <span class="SmallnoteTxt">*</span>&nbsp;Will Call&nbsp;
                    <input type="checkbox" name="three_will_call" id="three_will_call" onClick="check_check3();" {if $post.three_will_call eq 'on'} checked="checked" {/if} /></td>
                </tr>
               <tr id="three2" style="display:none">
                  <td class="labels">2nd Destination Location:</td>
                  <td><input  type="text" name="droplocation2" id="droplocation2" value="{$post.droplocation2}"  class="txt_box"  size="45"  onKeyUp="searchSuggest5();"  autocomplete="off"/><div id="layer5"></div>
                    </td>
                  <td><a onClick="addressla(3);"><img src="../graphics/arrow.png" ></a></td>
                </tr>
                <tr  id="three3" style="display:none">
                  <td class="labels">2nd Destination Address:</td>
                  <td><input  type="text" name="destination2" id="autocomplete4" value="{$post.destination2}" placeholder="Enter Address"  class="txt_box "  maxlength="150"  size="45" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                 <tr  id="three4" style="display:none">
                  <td class="labels">Suite / Apt / Bld:</td> 
               <td><input type="text" name="dsuiteroom2" id="dsuiteroom2" value="{$post.dsuiteroom2}"  class="txt_box"  maxlength="150"  size="45" />
                 </td>
                  <td></td>
                </tr>
                <tr  id="three5" style="display:none">
                  <td class="labels">2nd Destination Phone Number:</td>
                  <td><input type="text" name="d_phnum2" id="d_phnum2" value="{$post.d_phnum2}" class="txt_box" maxlength="14"  onChange="use_same(this.id);" />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr> 
                <tr  id="three6" style="display:none">
                  <td class="labels">2nd Destination Instructions: </td>
                  <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction2" id="destination_instruction2">{$post.destination_instruction2}</textarea>
                    </td>
                </tr>
           <tr id="four0" style="display:none">
                  <td colspan="3"><div class="admintopheading">Third Destination Address</div></td>
                </tr>
                <tr id="four1" style="display:none">
                  <td class="labels">Pick Time: </td>
                  <td colspan="2"><input type="text" name="four_pickup" id="four_pickup" value="{$post.four_pickup}"  class="txt_box " maxlength="5" onBlur="javascript: time(this.id);" />
                    <span class="SmallnoteTxt">*</span>&nbsp;Will Call&nbsp;
                    <input type="checkbox" name="four_will_call" id="four_will_call" onClick="check_check4();" {if $post.four_will_call eq 'on'} checked="checked" {/if}/></td>
                </tr>
                <tr id="four2" style="display:none">
                  <td class="labels">3rd Destination Location:</td>
                  <td><input  type="text" name="droplocation3" id="droplocation3" value="{$post.droplocation3}"  class="txt_box"  size="45"  onKeyUp="searchSuggest6();"  autocomplete="off"/><div id="layer6"></div>
                    </td>
                  <td><a onClick="addressla(4);"><img src="../graphics/arrow.png" ></a></td>
                </tr>
                <tr  id="four3" style="display:none">
                  <td class="labels">3rd Destination Address:</td>
                  <td><input  type="text" name="destination3" id="autocomplete5" value="{$post.destination3}" placeholder="Enter Address"  class="txt_box "  maxlength="150"  size="45" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                 <tr  id="four4" style="display:none">
                  <td class="labels">Suite / Apt / Bld:</td> 
               <td><input type="text" name="dsuiteroom3" id="dsuiteroom3" value="{$post.dsuiteroom3}"  class="txt_box"  maxlength="150"  size="45" />
                 </td>
                  <td></td>
                </tr>
                <tr  id="four5" style="display:none">
                  <td class="labels">3rd Destination Phone Number:</td>
                  <td><input type="text" name="d_phnum3" id="d_phnum3" value="{$post.d_phnum3}" class="txt_box" maxlength="14"  onChange="use_same(this.id);" />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr> 
                <tr  id="four6" style="display:none">
                  <td class="labels">3rd Destination Instructions: </td>
                  <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction3" id="destination_instruction3">{$post.destination_instruction3}</textarea>
                    </td>
                </tr>
                {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq 'Three Way' || $triptype=='' || $triptype eq 'Round Trip'}
                <tr id="b0" style="display:none">
                  <td colspan="3"><div class="admintopheading">Last Destination Address</div>
                    <br/>
                    Use Same Pickup Information
                    <input type="checkbox" name="sameadd" id="sameadd" onClick="test();"/></td>
                </tr>
                <tr id="b2" style="display:none" >
                  <td class="labels"  >Back To Location:<br/></td>
                  <td><input name="backtolocation" type="text"  class="txt_box " id="backtolocation" value="{$post.backlocation}" maxlength="150"  size="45"   onKeyUp="searchSuggest7();"  autocomplete="off"/><div id="layer7"></div>
                    </td>
                  <td><a onClick="addressla(5);"><img src="../graphics/arrow.png" ></a></td>
                </tr>
                 <tr id="b1" style="display:none" >
                  <td class="labels"  >Back To Address:<br/></td>
                  <td><input name="backto" type="text"  class="txt_box " id="autocomplete3" value="{$post.backto}" maxlength="150" placeholder="Enter Complete Back To Address"  size="45" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                 <tr id="b5" style="display:none;">
                  <td class="labels">Suite #/Room #:</td> 
               <td><input type="text" name="bsuiteroom" id="bsuiteroom" value="{$post.bsuiteroom}"  class="txt_box"  maxlength="150"  size="45" />
                 </td>
                  <td></td>
                </tr>
                 <tr id="b3" style="display:none;">
                  <td class="labels">Back to Instructions: </td>
                  <td colspan="2"><textarea rows="3" cols="40" name="backto_instruction" id="backto_instruction">{$post.backto_instruction}</textarea>
                    </td>
                </tr>
               <!-- <tr id="b2" style="display:none" >
                  <td class="labels" >Back To City:</td>
                  <td><input name="backtocity" type="text"  class="txt_box " id="backtocity" value="" maxlength="150"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td></td>
                </tr>
                <tr id="b3" style="display:none">
                  <td class="labels" >Back To State:</td>
                  <td><select id="backtostate" name="backtostate"  class="txt_box" />
                    
                    <option value="">Select</option>
                    {section name=n loop=$states}
                    <option value="{$states[n].abbr}"{if $states[n].abbr eq $post.backtostate} selected="selected" {else}{if $states[n].abbr eq 'AZ'} selected="selected" {/if}{/if}>
                    {$states[n].statename}
                    </option>
                    {/section}
                    </select>
                    <span class="SmallnoteTxt" >*</span></td>
                  <td></td>
                </tr>
                <tr id="b4" style="display:none" >
                  <td class="labels" >Back To Zip Code:</td>
                  <td><input name="backtozip" type="text"  class="txt_box" id="backtozip" value="{$post.backtozip}" maxlength="10" />
                    &nbsp;<span class="SmallnoteTxt"> e.g. 12345-6789</span></td>
                  <td></td>
                </tr>-->
                {/if}
                {literal} 
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$("#aptmonday, #retmonday, #apttuseday, #rettuseday, #aptwednesday, #retwednesday, #aptthirsday, #retthirsday, #aptfriday, #retfriday, #aptsaturday, #retsaturday, #aptsunday, #retsunday").mask("29:59");
	$("#tdmonday, #tdtuseday, #tdwednesday, #tdthirsday, #tdfriday, #tdsaturday, #tdsunday").mask("9999-19-39");
	$("#tdmonday, #tdtuseday, #tdwednesday, #tdthirsday, #tdfriday, #tdsaturday, #tdsunday").datepicker( {minDate: '0'} );
	});
function checkrecday(feildid){
	if($('#'+feildid).attr('checked')){
		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).removeAttr('disabled');
		var apptime = $('#apptime').val();  			$('#apt'+feildid).val(apptime); 
		var returnpickup = $('#returnpickup').val(); 	$('#ret'+feildid).val(returnpickup); 
		}
	else {
		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).attr('disabled','disabled');
		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).val('');
		}
	}
function check_cecc(){
	if($('#check_recc').attr('checked')){ $('#recc').show(); }else { $('#recc').hide(); }
	}	
</script> 
                {/literal}
                <tr>
                  <td colspan="3"><div class="admintopheading">Recurring (Blanket Orders)<span style="float:right; padding-right:40px;" ><input type="checkbox" id="check_recc" name="check_recc" onClick="check_cecc();" {if $post.check_recc eq 'on'} checked {/if}/></span></div></td>
                </tr>
                <tr>
                  <td colspan="3"><table width="100%" border="0" id="recc" style="display:none;">
                      <tr>
                        <td>&nbsp;</td>
                        <td>Pick Time</td>
                        <td>ReturnPick Time</td>
                        <td>Till Date</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" id="monday" name="monday" onChange="checkrecday(this.id);" />
                          &nbsp;Monday</td>
                        <td><input  name="aptmonday" id="aptmonday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'aptmonday');" disabled="disabled"/></td>
                        <td><input  name="retmonday" id="retmonday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'retmonday');" disabled="disabled"/></td>
                        <td><input name="tdmonday" id="tdmonday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" id="tuseday" name="tuseday"  onchange="checkrecday(this.id);" />
                          &nbsp;Tuesday</td>
                        <td><input  name="apttuseday" id="apttuseday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'apttuseday');" disabled="disabled"/></td>
                        <td><input  name="rettuseday" id="rettuseday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'rettuseday');" disabled="disabled"/></td>
                        <td><input name="tdtuseday" id="tdtuseday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" id="wednesday" name="wednesday"  onchange="checkrecday(this.id);" />
                          &nbsp;Wednesday</td>
                        <td><input  name="aptwednesday" id="aptwednesday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'aptwednesday');" disabled="disabled"/></td>
                        <td><input  name="retwednesday" id="retwednesday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'retwednesday');" disabled="disabled"/></td>
                        <td><input name="tdwednesday" id="tdwednesday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" id="thirsday" name="thirsday"  onchange="checkrecday(this.id);" />
                          &nbsp;Thursday</td>
                        <td><input  name="aptthirsday" id="aptthirsday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'aptthirsday');" disabled="disabled"/></td>
                        <td><input  name="retthirsday" id="retthirsday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'retthirsday');" disabled="disabled"/></td>
                        <td><input name="tdthirsday" id="tdthirsday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" id="friday" name="friday"  onchange="checkrecday(this.id);" />
                          &nbsp;Friday</td>
                        <td><input  name="aptfriday" id="aptfriday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'aptfriday');" disabled="disabled"/></td>
                        <td><input  name="retfriday" id="retfriday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'retfriday');" disabled="disabled"/></td>
                        <td><input name="tdfriday" id="tdfriday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" id="saturday" name="saturday"  onchange="checkrecday(this.id);" />
                          &nbsp;Saturday</td>
                        <td><input  name="aptsaturday" id="aptsaturday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'aptsaturday');" disabled="disabled"/></td>
                        <td><input  name="retsaturday" id="retsaturday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'retsaturday');" disabled="disabled"/></td>
                        <td><input name="tdsaturday" id="tdsaturday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" id="sunday" name="sunday"  onchange="checkrecday(this.id);" />
                          &nbsp;Sunday</td>
                        <td><input  name="aptsunday" id="aptsunday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'aptsunday');" disabled="disabled"/></td>
                        <td><input  name="retsunday" id="retsunday" type="text" class="appt_txtbox" size="15" maxlength="8" onBlur="return tValid(this.value,'retsunday');" disabled="disabled"/></td>
                        <td><input name="tdsunday" id="tdsunday" type="text"  class="appt_txtbox" size="20" maxlength="10" disabled="disabled"/></td>
                      </tr>
                      <tr>
                        <td><input type="hidden" name="mon" value="monday" />
                          <input type="hidden" name="tus" value="tuesday" />
                          <input type="hidden" name="wed" value="wednesday" />
                          <input type="hidden" name="thi" value="thursday" />
                          <input type="hidden" name="fri" value="friday" />
                          <input type="hidden" name="sat" value="saturday" />
                          <input type="hidden" name="sun" value="sunday" /></td>
                      </tr>
                    </table></td>
                </tr>
               
                              
                <tr align="left">
                  <td colspan="3" valign="top" class="admintopheading"><strong>Comments OR Notes</strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels">&nbsp;</td>
                  <td align="left" valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top" class="labels"><textarea tabindex="50" name="comments" cols="74" rows="7" class="txtarea" id="comments">{$post.comments}</textarea></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels">&nbsp;</td>
                  <td colspan="2" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td colspan="2" align="right"><input type="submit" name="submit" value="Submit" class="inputButton btn"  id="submitB" />
                    <input type="reset" name="reset" value="Reset" class="inputButton btn"  /></td>
                </tr>
              </table>
            </form>
            {/if}</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
{if $post neq ''}
{literal}<script>check_cecc();</script>{/literal}
{literal}<script>textalerty('{/literal}{$post.cellalertoption}{literal}');</script>{/literal}
{/if}
{ include file = innerfooter.tpl} 