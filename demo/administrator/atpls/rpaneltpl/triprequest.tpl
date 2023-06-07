<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.hybriditservices.com/demos/httglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.hybriditservices.com/demos/httglobal-2/w3.org/1999/xhtml">
{include file="top.tpl"}
{literal}
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAA-y1i2USi6PLLmT4RvXc-gBQlCw3P91oSVaavChCcALS3NokerBSRHqtJLUD7R2vnmX5f33w4TW1Fzw"></script>
<script type="text/javascript">
//<![CDATA[

var from = '{/literal}{$from}{literal}';
var to = '{/literal}{$to}{literal}';
var ppm = '{/literal}{$rates[0].price_per_mile}{literal}';
var pc = '{/literal}{$rates[0].pickup_charges}{literal}';

google.load("maps", "2");
var gdir;
function load()
{
	if (GBrowserIsCompatible()) 
	{
		gdir = new google.maps.Directions();
		google.maps.Event.addListener(gdir, "load", handleLoad);
		gdir.load("from: "+from+" to: "+to+"", {getSteps: true});
	}
}
function handleLoad()
{
	var miles = gdir.getDistance().html;
	miles = miles.replace("mi","");
	miles = miles.replace(",","");
	document.getElementById("totalMiles").innerHTML = "Distance: "+miles+" Miles";
	var cost = (parseInt(miles) * parseInt(ppm))+parseInt(pc);
	document.getElementById("totalCost").innerHTML = "Trip Price: $ "+cost;
	//document.getElementById("totalMiles").innerHTML = gdir.getDistance().html;
}
window.onload = load;
window.onunload = google.maps.Unload;
//]]>
</script>

<script type="text/javascript">
function test(){

var v=$('#pickaddress').val();
var x=$('#pckcity').val();
var y=$('#pckzip').val();



   $('#backto').val(v);
    $('#backtocity').val(x);
	 $('#backtozip').val(y);
}
$(document).ready(function (){




var v=$('#puchoice').val();


if(v =='Time'){ 



	$('#rpTime').show();	


    }

		$("#pname").autocomplete("rpc.php",{

		extraParams: {

        val: '1' }

        });

		$("#phnum").autocomplete("rpc.php",{

		extraParams: {

        val: '2' }

        });		

		$("#dob").autocomplete("rpc.php",{

		extraParams: {

        val: '3' }

        });

		$("#cisid").autocomplete("rpc.php",{

		extraParams: {

        val: '4' }

        });

		$("#casemanager2").autocomplete("rpc.php",{

		extraParams: {

        val: '5' }

        });

		$("#pickaddress").autocomplete("rpc.php",{

		extraParams: {

        val: '6' }

        });

		$("#destination").autocomplete("rpc.php",{

		extraParams: {

        val: '7' }

        });

		$("#backto").autocomplete("rpc.php",{

		extraParams: {

        val: '8' }

        });		

		$("#appdate").autocomplete("rpc.php",{

		extraParams: {

        val: '9' }

        });

		$("#apptime").autocomplete("rpc.php",{

		extraParams: {

        val: '10' }

        });

		$("#returnpickup").autocomplete("rpc.php",{

		extraParams: {

        val: '11' }

        });

		$("#casemanager1").autocomplete("rpc.php",{

		extraParams: {

        val: '12' }

        });	

		$("#ssn").autocomplete("rpc.php",{

		extraParams: {

        val: '13' }

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



    if(val == 'Round Trip'){
	
    var pu=$('#puchoice').val();
	
	
	if(pu=='Will Call'){
	

	$('#returnpickup').removeAttr("class");	
	$('#rpTime').hide();	
     $('#rpu').show();	
	
	}else{
	      $('#rpu').show();	
		$('#rpTime').show();	
	    
	}
  
   
       
	   

	$('#rpu').attr("class","txt_box required");

	//$('#rpu').show();	
	//$('#rpTime').show();	


	$('#trBackTo').show();	
		
    $('#backto').show();
	$('#backto').attr("class","txt_box required");
	

	$('#trBackTo2').show();
	$('#backtocity').show();
	$('#backtocity').attr("class","txt_box required");
	
	$('#trBackTo3').show();	
	$('#backtostate').show();
		$('#backtostate').attr("class","txt_box required");
	
	$('#trBackTo4').show();	
	$('#backtozip').show();	
	$('#backtozip').attr("class","txt_box required");
	
	
	
	$('#b1').show();	
	$('#b2').show();
	$('#b3').show();
	$('#b4').show();
	
	$('#bb1').show();	
	$('#bb2').show();
	$('#bb3').show();
	$('#bb4').show();
	
	
	
		

	$('#puchoice').attr("class","txt_box required");	

	 $('#backto').attr("disabled",false);
	$('#backtocity').attr("disabled",false);
	$('#backtostate').attr("disabled",false);
	$('#backtozip').attr("disabled",false);

	$('#puchoice').attr("disabled",false);				  

	 return true;

    }


	
   else if(val == 'One Way'){

	//$('#returnpickup').attr("disabled",true);

	$('#puchoice').removeAttr("class");

	$('#backto').removeAttr("class");	

	$('#returnpickup').removeAttr("class");	

	$('#rpu').removeAttr("class");			


	$('#rpu').hide();	

$('#trBackTo').hide();	

$('#rpTime').hide();	
	$('#backto').removeAttr("class");	

	$('#backto').hide();	
    	$('#b1').hide();	
		$('#b2').hide();	

	$('#puchoice').attr("disabled",true);	


     $('#trBackTo2').hide();
	$('#backtocity').hide();
	$('#backtocity').removeAttr("class");
	
	$('#trBackTo3').hide();	
	$('#backtostate').hide();
		$('#backtostate').removeAttr("class");
	
	$('#trBackTo4').hide();	
	$('#backtozip').hide();	
	$('#backtozip').removeAttr("class");
	
	$('#backto').attr("disabled",true);
	$('#backtocity').attr("disabled",true);
	$('#backtostate').attr("disabled",true);
	$('#backtozip').attr("disabled",true);
	
	
	$('#b3').hide();
	$('#b4').hide();
	
	$('#bb1').hide();	
	$('#bb2').hide();
	$('#bb3').hide();
	$('#bb4').hide(); 

    return true;

    }else{

	$('#backto').attr("class","txt_box required");	

	$('#rpu').attr("class","txt_box required");

	$('#rpu').show();	
		$('#bb1').hide();	
	$('#bb2').hide();
	$('#bb3').hide();
	$('#bb4').hide(); 
    $('#backto').attr("disabled",false);
	$('#backtocity').attr("disabled",false);
	$('#backtostate').attr("disabled",false);
	$('#backtozip').attr("disabled",false);
	$('#trBackTo').hide();	
	
     $('#trBackTo2').hide();
	 
     $('#trBackTo3').hide();
	 
     $('#trBackTo4').hide();
			$('#backtocity').hide();
			$('#backtostate').hide();
			$('#backtozip').hide();	

	$('#backto').attr("class","txt_box required");	

	$('#backto').attr("disabled",false);
	

	$('#puchoice').attr("class","txt_box required");	

	$('#puchoice').attr("disabled",false);	

	return true; 	

	}	

}



function pUchoice(val){

    if(val == ''){    

	 return false;

    }

    if(val == 'Will Call'){ 

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

	  return true;

    }else{

	$('#returnpickup').attr("class","txt_box required");	

	
	$('#rpTime').show();

	return true; 	

	}	

}



function chProg(val){



    if(val == '0'){

     $('#labelid').html('CIS ID');	

     $('#cisidsp').show();			     

     $('#ssnsp').hide();

	 $('#ssn').attr("class","txt_box");

	 $('#cisid').attr("class","txt_box required");	 		 

	 return true;

    }

    if(val == '1'){

     $('#labelid').html('Social Security Number');	

     $('#ssnsp').show();	

     $('#cisidsp').hide();	 

	 $('#cisid').attr("class","txt_box");

	 $('#ssn').attr("class","txt_box required");		  		

    return true;

    }else{

     $('#labelid').html('CIS ID');	

     $('#cisidsp').show();			     

     $('#ssnsp').hide();

	 $('#ssn').attr("class","txt_box");

	 $('#cisid').attr("class","txt_box required");

    return true;	 		

	}	

}

	function PerfromAutomation(){
		var cisid =  $('#cisid').val();
		var ssn =  $('#ssn').val();
	    var shid = '';
	    if(cisid != '' && ssn == ''){ code = '0'; shid = cisid; }
	    if(ssn != '' && cisid == ''){ code = '1'; shid = ssn;  }
	    if(ssn != '' && cisid != ''){ code = '0'; shid = cisid;  }
		if(shid == ''){
		   return false;
		}
		if(shid != ''){ 
			$.post("fetchdata.php", {hid: ""+shid, id: ""+code}, function(data){
				if(data.length > 0) {
	            	var fetchedData = data;
					formSeprate = new Array();
					formSeprate = fetchedData.split('--Automation--');			  
				    if(formSeprate.length > 0){ 
					    if(formSeprate[0] != ''){
					  		formvals = new Array();	 
						    formvals = formSeprate[0].split('^'); 
						  	if(formvals.length > 0){
								if(formvals[0] != '')
								  $('#pname').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#phnum').val(formvals[1]);
						  	  	if(formvals[2] != '')						  
								  $('#email').val(formvals[2]);
								if(formvals[3] != '')						  
								  $('#dob').val(formvals[3]);
							  	if(formvals[5] != '')					  
								  $('#fname').val(formvals[5]);
								if(formvals[6] != '')							  
								  $('#lname').val(formvals[6]);
	                          	if(formvals[7] != '')
							  	  $('#clinic').val(formvals[7]);
							  	if(formvals[8] != '')						  
								  $('#phyaddress').val(formvals[8]);
							  	if(formvals[9] != '')							  
								  $('#phycity').val(formvals[9]);
							  	if(formvals[10] != '')							  
							  	  $('#phystate').val(formvals[10]);
						  		if(formvals[11] != '')							  
						  		  $('#phyzip').val(formvals[11]);
						  	    if(formvals[12] != '')							  
						  		  $('#phyphone').val(formvals[12]);
	                          	if(formvals[13] != '')
						  		  $('#phyfax').val(formvals[13]);
							  	if(formvals[14] != '')						  
							  	  $('#reason').val(formvals[14]);
							  	if(formvals[15] != '')							  
						  		  $('#pickaddress').val(formvals[15]);
						  		if(formvals[16] != '')							  
						  		  $('#pckcity').val(formvals[16]);
						  		if(formvals[17] != '')							  
						  		  $('#pckstate').val(formvals[17]);
						  	    if(formvals[18] != '')							  
								  $('#pckzip').val(formvals[18]);
						  	  	if(formvals[19] != '')							  
								  $('#destination').val(formvals[19]);
						  		if(formvals[20] != '')							  
							  	  $('#drpcity').val(formvals[20]);
								if(formvals[21] != '')							  
								  $('#drpstate').val(formvals[21]);
						  	  	if(formvals[22] != '')						  
						  		  $('#drpzip').val(formvals[22]);
						  		if(formvals[23] != '')						  
						  		  $('#backto').val(formvals[23]); 

								  if(formvals[24] != '')		
								  $('#backtocity').val(formvals[24]); 		
								  if(formvals[25] != '')				
								  $('#backtostate').val(formvals[25]); 								  
								  if(formvals[26] != '')	
								  $('#backtozip').val(formvals[26]); 
								  
								  if(formvals[27] != ''){							  

								  $('#appdate').val(formvals[27]); }
		
								  if(formvals[28] != ''){							  
		
								  $('#apptime').val(formvals[28]); }

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
									 if(formvals[30] != ''){							  
		
								  		$('#casemanager1').val(formvals[30]);
									 }					 
						 		}
								

							}				

				  subformvals = new Array();	 

			      subformvals = formSeprate[1].split('^'); 

				

					 if(subformvals.length > 0){

					

					   for($j=0; $j<subformvals.length; $j++){

						   if(subformvals[$j] == 'monday'){

							  $('#day1').val(subformvals[$j+1]);

							  $('#day2').val(subformvals[$j+2]);

							  $('#day1from').val(subformvals[$j+3]);							  

							  $('#day1to').val(subformvals[$j+4]);							  

							}	

						   if(subformvals[$j] == 'tuesday'){

							  $('#day3').val(subformvals[$j+1]);

							  $('#day4').val(subformvals[$j+2]);

							  $('#day3from').val(subformvals[$j+3]);							  

							  $('#day3to').val(subformvals[$j+4]);								  

							}	

						   if(subformvals[$j] == 'wednesday'){

							  $('#day5').val(subformvals[$j+1]);

							  $('#day6').val(subformvals[$j+2]);

							  $('#day5from').val(subformvals[$j+3]);							  

							  $('#day5to').val(subformvals[$j+4]);								  

							}	

						   if(subformvals[$j] == 'thursday'){

							  $('#day7').val(subformvals[$j+1]);

							  $('#day8').val(subformvals[$j+2]);

							  $('#day7from').val(subformvals[$j+3]);							  

							  $('#day7to').val(subformvals[$j+4]);								  

							}	

						   if(subformvals[$j] == 'friday'){

							  $('#day9').val(subformvals[$j+1]);

							  $('#day10').val(subformvals[$j+2]);

							  $('#day9from').val(subformvals[$j+3]);							  

							  $('#day9to').val(subformvals[$j+4]);								  

							}	

						   if(subformvals[$j] == 'saturday'){

							  $('#day11').val(subformvals[$j+1]);

							  $('#day12').val(subformvals[$j+2]);

							  $('#day11from').val(subformvals[$j+3]);							  

							  $('#day11to').val(subformvals[$j+4]);								  

							}																																										                           if(subformvals[$j] == 'sunday'){

							  $('#day13').val(subformvals[$j+1]);

							  $('#day14').val(subformvals[$j+2]);

							  $('#day13from').val(subformvals[$j+3]);							  

							  $('#day13to').val(subformvals[$j+4]);								  

							} 

						} 

					  }else{

						  $('#day1').val('');

						  $('#day2').val('');

						  $('#day3').val('');

						  $('#day4').val('');

						  $('#day5').val('');

						  $('#day6').val('');

						  $('#day7').val('');

						  $('#day8').val('');

						  $('#day9').val('');

						  $('#day10').val('');

						  $('#day11').val('');

						  $('#day12').val('');

						  $('#day13').val('');

						  $('#day14').val('');						  			  			  

						}

				    }		 

			   }   

		   });

	  return true;

	  }

 }




</script>
{/literal}
<body>

	<!--Main Container Starts Here-->
	<div id="main_container">
    	{include file="topmenu.tpl"}
    	<!--Inner Container Starts Here-->
    	<div id="inner_container">
        	<table cellpadding="0" cellspacing="0"  width="100%">
            	<tr>
                	<td>
                    	<!--Header Starts Here-->
						 	{include file="header.tpl"}
                        <!--Header End Here-->
                    </td>
                </tr>
                <tr>
                	<td>
                    	<!--Menu Starts Here-->
                    	{include file="menu.tpl"}
                        <!--Menu End Here-->
                    </td>
                </tr>
                <tr><td height="9"></td></tr>
                <tr>
                	<td style="background-color:#FFF;">
					{if $smarty.session.user eq ''}
						<div class="banner"></div>
					{/if}
                    <div style="float:left; width:280px;">
   <!--start of Instant Rates -->
 <!-- <div class="instantrate_2"> 

  				<table width="100%" border="0" cellspacing="5" cellpadding="3">
                <form action="triprequest.php" method="post" id="rate" name="rate">
   				<input type="hidden" name="app" value="dic">
                  <input type="hidden" name="cmd" value="dst">
                  <input type="hidden" name="unit" value="mi">
				  <tr>
					<td colspan="2"></td>
					</tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    </tr>
				  <tr>
					<td width="25%"><strong>From:</strong></td>
					<td width="75%">
                    <label>
					  <input type="text" name="center" value="{$from}" class="required">
					</label>
                    </td>
				  </tr>
				  <tr>
					<td><strong>To:</strong></td>
					<td><input type="text" name="c1" value="{$to}" class="required"></td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    </tr>                   
                  <tr>
                  	<td colspan="2"><div id="totalMiles"></div></td>
                  </tr>
                  <tr>
                  	<td colspan="2"><div id="totalCost"></div></td>
                  </tr>
                  
                  
                  
				  <tr>
					<td>&nbsp;</td>
					<td><input class="instantbtn" type="submit" name="Submit" value="Submit" />
                      <input class="instantbtn" type="submit" name="Submit2" value="Reset" /></td>
				  </tr>
                  </form>
			</table>
			
		
  </div>
  <div class="calu_rate_2"><a href="javascript: void(0);" onclick="popWind('calculate_rate.php')"><img src="images/rate_calculator.png" alt="" border="0" /></a> </div>-->
  <div class="testimonials">
        <div class="testimonals_text">{$testi|truncate:170}<br />
        </div><div class="testimonals_btn">{$testdata[0].fname} {$testdata[0].lname}</div>
  </div>
  
  
  
  </div>
                    	<!--Body Container Starts Here-->
                    	<div class="body_container">
						
                        	<!--Left Panel Starts Here-->
                            <div id="left_panel">
							
                            	<!--Request a trip Panel Starts Here-->
                                <div class="form_panel_1">
                                	<div class="heading">Request a Trip</div>
                                    <div class="form_bg">                               	
	                                	<div class="form_top_curve"></div>
    	                                <div class="form_1">     <form name="updReq" id="updReq" action="triprequest_1.php" method="post">                                   	
                                        	<table cellpadding="1" cellspacing="5" width="100%">                                            	 <tr>
                                                	<td colspan="3"><div class="form_heading_2">Client Information</div></td>                                                </tr>
                                                <!--<tr>
                                                	<td class="label">Select Program:</td>
                                                    <td>
                                                    		 <select name="progtype"  class="txt_box required" id="progtype"   tabindex="1">

			    <option value="">Select</option>

				<option value="1" {if $tripprog eq '1'}selected{/if}>A.H.C.C.C.S</option>

			 </select>  &nbsp;<span class="SmallnoteTxt">*</span>                                                  </td>
                                                    <td></td>
                                                </tr>-->
                                          
												<tr>

              <td  class="label">A.H.C.C.C.S #:</strong></td>

              <td colspan="2" valign="top">

		    <span id="cisidsp">

			 <input tabindex="2" type="text" name="cisid" id="cisid" value="{$cisid}" class="txt_box {if $progtype eq '0'}required{/if}" onfocus="return PerfromAutomation();" autocomplete="off"/>&nbsp;<span class="SmallnoteTxt">*</span></span>  </td>
			 
			 <input type="hidden" id="progtype" name="progtype" value="{$progtype}">

            </tr>
                                                <tr>
                                                	<td class="label">Patient Name:</td>
                                                    <td><input name="pname" type="text" class="txt_box required chars" id="pname" tabindex="3" value="{$pname}" maxlength="30" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Patient Phone Number:</td>
                                                  <td><input type="text" name="phnum" id="phnum" value="{$phnum}" class="txt_box required" maxlength="14" tabindex="4"/>&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
												<tr>
                                                	<td class="label">Date of Birth:</td>
                                                    <td><input type="text" name="dob" id="dob" value="{$dob}" class="txt_box required" tabindex="5" maxlength="15" /><span class="SmallnoteTxt">*</span>	</td>
                                                    <td></td>
                                                </tr>
												 <tr>
                                                	<td class="label">Email:</td>
                                                    <td><input type="text" name="email" id="email" value="{$email}" class="txt_box email required" maxlength="70" tabindex="6"/>&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>												
												 <tr>
                                                	<td class="label">Today Date:</td>
                                                    <td><input type="text" name="todaydate" id="todaydate" value='{$smarty.now|date_format}' class="txt_box required" readonly  /></td>
                                                    <td></td>
                                                </tr>																		 
                                            	 <tr>
                                                	<td colspan="3"><div class="form_heading_2">Trip Information</div></td>                                                   
                                                </tr>     
                                                <tr>
                                                	<td class="label">Select Trip Type:</td>
                                                    <td>
                                                    		 <select name="triptype"  class="txt_box required" id="triptype" onchange="return chTrip(this.value);" tabindex="7">

			    <option value="">Select</option>

				<option value="Round Trip" {if $triptype eq 'Round Trip'}selected{/if}>Round Trip</option>

				<option value="One Way" {if $triptype eq 'One Way'}selected{/if}>One Way</option>
			 </select> &nbsp;<span class="SmallnoteTxt">*</span>                                                   </td>
                                                    <td></td>
                                                </tr>
												
												 
                                                <tr>
                                                	<td class="label">Vehicle Preference:</td>
                                                    <td>
                                                    	 <select tabindex="8" name="vehtype" class="txt_box required" id="vehtype"  >

			    <option value="">Select</option>

			  {section name=q loop=$vehiclepref}	

				<option value="{$vehiclepref[q].id}" {if $vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>

			  {/section}

			 </select>&nbsp;<span class="SmallnoteTxt">*</span>                                                    </td>
                                                    <td></td>
                                                </tr>
												
												<tr>
                                                	<td class="label">Case Manager:</td>
                                                    <td><input name="casemanager1" type="text" class="txt_box required chars" id="casemanager1" tabindex="9" value="{if $smarty.session.allowUser eq '0'}{$smarty.session.user.fname} {$smarty.session.user.lname}{else}{$casemanager1}{/if}" maxlength="30" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
												                                                   
												  <tr>
                                                	<td class="label">Service Date:</td>
                                                    <td><input type="text" name="appdate" id="appdate" value="{$appdate}" class="txt_box required" tabindex="10" maxlength="15" />                

              <span class="SmallnoteTxt">*</span>	</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Pick up Time:</td>
                                                    <td><input tabindex="11" type="text" name="apptime" id="apptime" value="{$apptime}" class="txt_box required"  maxlength="7"  onblur="return tValid(this.value,'apptime');"/>

              &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
                                                    <td></td>
                                                </tr>                                                   
                                                  {if $triptype eq 'roundtrip' || $triptype =='Round Trip'||$triptype ==''} 
            <tr id="rpu" style="display:none">

              <td class="label">Return Pickup:</td>

              <td colspan="2">


			  <select tabindex="12" name="puchoice" id="puchoice" class="txt_box required" onchange="return pUchoice(this.value);" >

			     <option value="" {if $pickupchoice eq ''}selected{/if}>Select</option>

				 <option value="Will Call" {if $pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>

				 <option value="Time" {if $pickupchoice eq 'Time'}selected{/if}>Time</option>
			   </select>	 

              &nbsp;<span class="SmallnoteTxt">*</span></td>
            </tr>

           <tr id="rpTime" style="display:none;">

              <td class="label">Pickup Time:</td>

              <td colspan="2"><input tabindex="13" type="text" name="returnpickup" id="returnpickup" value="{$returnpickup}"  class="txt_box required" maxlength="5" onblur="return tValid(this.value,'returnpickup');" />

              &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
            </tr>			

			

           {/if} 

                   {if $smarty.session.appnature eq 'spec'}
												<tr>
                                                	<td colspan="3"><div class="form_heading_2">Physician Information</div></td>                                                </tr>
												<tr>
                                                	<td class="label">First Name:</td>
                                                    <td><input name="fname" type="text" class="txt_box required chars" id="fname" tabindex="14" value="{$fname}" maxlength="30" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
												<tr>
                                                	<td class="label">Last Name:</td>
                                                    <td><input name="lname" type="text" class="txt_box required chars" id="lname" tabindex="15" value="{$lname}" maxlength="30" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
												<tr>
                                                	<td class="label">Doctor's Facility:</td>
                                                    <td><input name="clinic" type="text" class="txt_box" id="clinic" tabindex="16" value="{$clinic}" maxlength="100" /></td>
                                                    <td></td>
                                                </tr>
                                                 <tr>
                                                	<td class="label">Address:</td>
                                                    <td><input tabindex="17" type="text" name="phyaddress" id="phyaddress" value="{$phyaddress}" class="txt_box required"   maxlength="150" onkeyup="test();" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                                
                                                 <tr>
                                                   <td class="label">City:</td>
                                                   <td><input  tabindex="18" type="text" name="phycity" id="phycity"  class="txt_box  required chars" onkeyup="test();"  value="{$phycity}" maxlength="30" />
                                                   <span class="SmallnoteTxt">*</span></td>
                                                   <td></td>
                                                 </tr>
                                                 <tr>
                                                   <td class="label">State:</td>
                                                   <td><select tabindex="19" name="phystate" id="phystate"  class="txt_box required"> 
			  
			    <option value="">Select</option>

			   {section name=n loop=$states}

			   <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>

			   {$states[n].statename}

			   </option>
			  
			  {/section}
              </select>
                                                   <span class="SmallnoteTxt">*</span></td>
                                                   <td></td>
                                                 </tr>
												  <tr>
                                                   <td class="label">Zip Code: </td>
                                                   <td><input  tabindex="20" type="text" name="phyzip" id="phyzip" onkeyup="test();"  class="txt_box required digits" value="{$phyzip}" maxlength="5"/>
                                                   <span class="SmallnoteTxt">*</span></td>
                                                   <td></td>
                                                 </tr>
                                                <tr>
                                                	<td class="label">Phone:</td>
                                                    <td><input  tabindex="21"type="text" name="phyphone" id="phyphone" value="{$phyphone}" class="txt_box required" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                               
                                                <tr>
                                                  <td class="label">Fax:</td>
                                                  <td><input tabindex="22" type="text" name="phyfax" value="{$phyfax}" id="phyfax" class="txt_box" maxlength="20" />
                                                 </td>
                                                  <td></td>
                                                </tr>
                                                <tr>
                                                  <td class="label">Reason for Visit:</td>
                                                  <td><textarea tabindex="23"  name="reason" id="reason" class="required" cols="30" rows="3">{$reason}</textarea>&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                  <td></td>
                                                </tr>
												{/if}                            
                                                
                                                <tr>
                                                	<td colspan="3"><div class="form_heading_2">Pick Up Information</div></td>                                                </tr>
                                                 <tr>
                                                	<td class="label">Pickup Address:</td>
                                                    <td><input tabindex="24" type="text" name="pickaddress" id="pickaddress" value="{$pickaddress}" class="txt_box required"   maxlength="150" onkeyup="test();" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                                
                                                 <tr>
                                                   <td class="label">City:</td>
                                                   <td><input  tabindex="25" type="text" name="pckcity" id="pckcity"  class="txt_box  required chars" onkeyup="test();"  value="{$pckcity}" maxlength="30" />
                                                   <span class="SmallnoteTxt">*</span></td>
                                                   <td></td>
                                                 </tr>
                                                 <tr>
                                                   <td class="label">State:</td>
                                                   <td><select tabindex="26" name="pckstate" id="pckstate"  class="txt_box required"> 
			  
			    <option value="">Select</option>

			   {section name=n loop=$states}

			   <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>

			   {$states[n].statename}

			   </option>
			  
			  {/section}
              </select>
                                                   <span class="SmallnoteTxt">*</span></td>
                                                   <td></td>
                                                 </tr>
												  <tr>
                                                   <td class="label">Zip Code: </td>
                                                   <td><input  tabindex="27" type="text" name="pckzip" id="pckzip" onkeyup="test();"  class="txt_box required digits" value="{$pckzip}" maxlength="5"/>
                                                   <span class="SmallnoteTxt">*</span></td>
                                                   <td></td>
                                                 </tr>
                                                <tr>
                                                	<td class="label">Destination:</td>
                                                    <td><input  tabindex="28" type="text" name="destination" id="destination" value="{$destination}"  class="txt_box required"  maxlength="150" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                               
                                                <tr>
                                                  <td class="label">City:</td>
                                                  <td><input tabindex="29" type="text" name="drpcity" value="{$drpcity}" id="drpcity" class="txt_box required chars" maxlength="20" />
                                                  <span class="SmallnoteTxt">*</span></td>
                                                  <td></td>
                                                </tr>
                                                <tr>
                                                  <td class="label">State:</td>
                                                  <td><select tabindex="30" name="drpstate" id="drpstate" class="txt_box required">
                <option value="">Select</option>

			   {section name=n loop=$states}

			   <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state2}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>

			   {$states[n].statename}

			   </option>
			  {/section}
			</select>
                                                  <span class="SmallnoteTxt">*</span></td>
                                                  <td></td>
                                                </tr>
												 <tr>
                                                  <td class="label">Zip Code: </td>
                                                  <td><input tabindex="31" maxlength="5" type="text" name="drpzip" value="{$drpzip}" id="drpzip" class="txt_box required digits"/>
                                                  <span class="SmallnoteTxt">*</span></td>
                                                  <td></td>
                                                </tr>
												 {if $triptype eq 'roundtrip' || $triptype=='' || $triptype eq 'Round Trip'} 

                                                <tr>
                                                	<td class="label" id="b1" {if $triptype eq ''} style="display:none"{/if} >Back To Address:</td>
                                                    <td><span id="trBackTo"{if $triptype eq ''} style="display:none" {/if}><input tabindex="32" name="backto" type="text"  class="txt_box required" id="backto" value="{$backto}" maxlength="150" {if $triptype eq ''} style="display:none" {/if} />&nbsp;<span id="bb1" class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
												 <tr>
                                                	<td class="label" id="b2"{if $triptype eq ''} style="display:none" {/if}>Back To City:</td>
                                                    <td><span id="trBackTo2" {if $triptype eq ''} style="display:none"{/if}><input tabindex="33" name="backtocity" type="text"  class="txt_box required" id="backtocity" value="{$backtocity}" maxlength="150"{if $triptype eq ''} style="display:none" {/if}/>&nbsp;<span id="bb2" class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
												<tr>
                                                	<td class="label" id="b3" {if $triptype eq ''}style="display:none"{/if}>Back To State:</td>
                                                    <td><span id="trBackTo3"{if $triptype eq ''} style="display:none"{/if} ><select tabindex="34" id="backtostate" name="backtostate"  class="txt_box required" {if $triptype eq ''} style="display:none" {/if} />
                                                      <option value="">Select</option>
                                                      

			   {section name=n loop=$states}

                                                      <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>
                                                      

			   {$states[n].statename}

			   
                                                      </option>
                                                      
			  
			  {/section} </select>
                                                      <span class="SmallnoteTxt" id="bb3" >*</span></span></td>
                                                    <td></td>
                                                </tr>
												<tr>
                                                	<td class="label" id="b4" {if $triptype eq ''} style="display:none" {/if}>Back To Zip Code:</td>
                                                    <td><span id="trBackTo4"{if $triptype eq ''} style="display:none" {/if}><input tabindex="35" name="backtozip" type="text"  class="txt_box required digits" id="backtozip" value="{$backtozip}" maxlength="5" {if $triptype eq ''} style="display:none" {/if}/>&nbsp;<span id="bb4" class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
						{/if}
												
					      <tr>
                                                	<td ></td>
                            <td align="left" >
							<input tabindex="36" type="submit" value="Proceed" id="submit" name="submit" class="btn_2"></td>
                                                    <td></td>
                                              </tr>
                                            </table> </form>	
       	                              </div>
            	                        <div class="form_bottom_curve"></div>
                                    </div>
                                </div>
                                <!--Request a trip Panel End Here-->
                            </div>
                            <!--Left panel End Here-->
                            
                            <!--Right panel Starts Here-->
                             {include file="rpanel.tpl"}
                            <!--Right panel End Here-->
                        </div>
                        <!--Body Container End Here-->
                    </td>
                </tr>
                <tr><td>  <div class="content_bottom_img"> </div> </td></tr>
                <tr><td height="9"></td></tr>
                <tr>
                	<td>
                    	<!--Footer Starts Here-->
                    	{include file="footer.tpl"}
                        <!--Footer End Here-->
                    </td>
                </tr>
            </table>
        </div>
        <!--Inner Container End Here-->
    </div>

    <!--Main Container End Here-->
</body>
</html>
