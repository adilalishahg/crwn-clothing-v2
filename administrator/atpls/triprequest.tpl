<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">
{include file="top.tpl"}
{literal}
<script type="text/javascript">



//FETCH THE AUTOMATED DATA

$(document).ready(function (){

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

  

function PerfromAutomation(){

	

	//var pname = $('#pname').val();

	//var phnum = $('#phnum').val();

	//var dob   = $('#dob').val();

	var cisid =  $('#cisid').val();

	var ssn =  $('#ssn').val();

    var shid = '';

     if(cisid != '' && ssn == ''){ code = '0'; shid = cisid; }

     if(ssn != '' && cisid == ''){ code = '1'; shid = ssn;  }

     if(ssn != '' && cisid != ''){ code = '0'; shid = cisid;  }

	//var managr = $('#casemanager2').val();

	

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

						  if(formvals[0] != ''){

						  $('#pname').val(formvals[0]); }

						  if(formvals[1] != ''){						  

						  $('#phnum').val(formvals[1]); }

						  if(formvals[2] != '//'){					  

						  $('#dob').val(formvals[2]); }

						  if(formvals[3] != ''){							  

						  $('#casemanager2').val(formvals[3]); }

                          if(formvals[4] != ''){

						  $('#pickaddress').val(formvals[4]); }

						  if(formvals[5] != ''){						  

						  $('#destination').val(formvals[5]); }

						  if(formvals[6] != ''){							  

						  $('#backto').val(formvals[6]); }

						  if(formvals[7] != '//'){							  

						  $('#appdate').val(formvals[7]); }

						  if(formvals[8] != ''){							  

						  $('#apptime').val(formvals[8]); }

						  if(formvals[9] != ''){

						    if(formvals[9] == 'Will Call'){

							   pUchoice('Will Call');

							   $('#puchoice').val('Will Call');

							}else{					

							 $('#puchoice').val('Time');		  

						     $('#returnpickup').val(formvals[9]); 

							 $('#returnpickup').attr("class","txt_box required");	

	                         $('#rpTime').show();

							  }

							 }

						  if(formvals[10] != ''){						  

						  $('#casemanager1').val(formvals[10]); }

						  if(formvals[11] != ''){							  

						  $('#comments').val(formvals[11]); }			  

						  }else{

						  /*

						  $('#pickaddress').val('');

						  $('#destination').val('');

						  $('#backto').val('');

						  $('#appdate').val('');

						  $('#apptime').val('');

						  $('#returnpickup').val('');

						  $('#casemanager1').val('');

						  $('#comments').val('');	*/		  			  

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





function chTrip(val){



    if(val == 'roundtrip'){

	$('#backto').attr("class","txt_box required");	

	$('#rpu').attr("class","txt_box required");

	$('#rpu').show();	

	$('#trBackTo').show();		
    $('#backto').show();
	$('#backto').attr("class","txt_box required");
	
	$('#b1').show();	
	$('#b2').show();	

	$('#puchoice').attr("class","txt_box required");	

	$('#backto').attr("disabled",false);

	$('#puchoice').attr("disabled",false);				  

	 return true;

    }


	
    if(val == 'oneway'){

	//$('#returnpickup').attr("disabled",true);

	$('#puchoice').removeAttr("class");

	$('#backto').removeAttr("class");	

	$('#returnpickup').removeAttr("class");	

	$('#rpu').removeAttr("class");			

	$('#rpu').hide();	

	$('#trBackTo').hide();	


	$('#backto').removeAttr("class");	

	$('#backto').hide();	
    	$('#b1').hide();	
		$('#b2').hide();	

	$('#puchoice').attr("disabled",true);	

    return true;

    }else{

	$('#backto').attr("class","txt_box required");	

	$('#rpu').attr("class","txt_box required");

	$('#rpu').show();	

	$('#trBackTo').show();		

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



</script>


{/literal}
{if $progtype neq ''}

{literal}<script>chProg('{/literal}{$progtype}{literal}');</script>{/literal}

{else}

{literal}<script>chProg('0');</script>{/literal}

{/if}

{if $triptype neq ''}

{literal}<script>chTrip('{/literal}{$triptype}{literal}');</script>{/literal}

{else}

{literal}<script>chTrip('roundtrip');</script>{/literal}

{/if}

<body>
<form name="updReq" id="updReq" action="triprequest_1.php" method="post">
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
                <tr>
                	<td>
                    	<!--Body Container Starts Here-->
                    	<div class="body_container">
                        	<!--Left Panel Starts Here-->
                            <div id="left_panel">
                            	<!--Request a trip Panel Starts Here-->
                                <div class="form_panel">
                                	<div class="heading">Request a Trip</div>
                                    <div class="form_bg">                               	
	                                	<div class="form_top_curve"></div>
    	                                <div class="form">                                        	
                                        	<table cellpadding="1" cellspacing="5" width="80%">                                            	
                                            	 <tr>
                                                	<td colspan="3"><div class="form_heading">Trip Information</div></td>                                                   
                                                </tr>     
                                                <tr>
                                                	<td class="label">Select Trip Type:</td>
                                                    <td>
                                                    		 <select name="triptype"  class="txt_box required" id="triptype" onchange="return chTrip(this.value);" tabindex="1">

			    <option value="">Select</option>

				<option value="roundtrip" {if $triptype eq 'roundtrip'}selected{/if} selected>Round Trip</option>

				<option value="oneway" {if $triptype eq 'oneway'}selected{/if}>One Way</option>

			 </select>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <!--<tr>
                                                	<td class="label">Select Program:</td>
                                                    <td>
                                                    		<select name="progtype" class="txt_box required" id="progtype" onchange="return chProg(this.value);"  tabindex="2">

			    <option value="">Select</option>
				<option value="1" {if $progtype eq '1'}selected{/if}>A.H.C.C.C.S</option>

			 </select>
                                                    </td>
                                                    <td></td>
                                                </tr>-->
                                                <tr>
                                                	<td class="label">Vehicle Preference:</td>
                                                    <td>
                                                    	 <select name="vehtype" class="txt_box required" id="vehtype" tabindex="3" >

			    <option value="">Select</option>

			  {section name=q loop=$vehiclepref}	

				<option value="{$vehiclepref[q].id}" {if $vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>

			  {/section}

			 </select>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                   <!--<tr>
                                                	<td colspan="3"><div class="form_heading">Patient Information</div></td>                                                </tr>
                                                 <tr>
                                                	<td class="label">{if $progtype eq '0'}CIS ID:{elseif $progtype eq ''}CIS ID:{else}Social Security Number:{/if}</td>
                                                    <td><span id="cisidsp" {if $progtype eq '0'}style="display:block;"{elseif $progtype eq ''}style="display:block;"{else}style="display:none;"{/if}>

			 <input type="text" name="cisid" id="cisid" value="{$cisid}" class="txt_box required" tabindex="6"  />&nbsp;<span class="SmallnoteTxt">*</span></span>  <span id="ssnsp" {if $progtype eq '1'}style="display:block;"{else}style="display:none;"{/if}>

			 <input type="text" name="ssn" id="ssn" value="{$ssn}" class="txt_box" tabindex="7"  />&nbsp;<span class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Name:</td>
                                                    <td><input type="text" name="name" class="txt_box" /></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Phone Number:</td>
                                                    <td><input type="text" name="phone" class="txt_box" /></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Date of Birth:</td>
                                                    <td><input type="text" name="dob" class="txt_box" /></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Case Manger:</td>
                                                    <td><input type="text" name="case_manager" class="txt_box" /></td>
                                                    <td></td>
                                                   </tr>-->
												    <tr>
                                                	<td colspan="3"><div class="form_heading">Appointment Information</div></td>                                                   
                                                </tr>  
												        <tr>
                                                	<td class="label">Appointment Date:</td>
                                                    <td><input type="text" name="appdate" id="appdate" value="{$appdate}" class="txt_box required date" tabindex="4" maxlength="15" />                

              <span class="SmallnoteTxt">* (mm/dd/yy e.g: 09/14/1983)</span>	</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Appointment Time:</td>
                                                    <td><input type="text" name="apptime" id="apptime" value="{$apptime}" class="txt_box required"  maxlength="5" tabindex="5" onblur="return tValid(this.value,'apptime');"/>

              &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
                                                    <td></td>
                                                </tr>                                                   
                                                 {if $triptype eq 'roundtrip' || $triptype eq ''} 

            <tr id="rpu">

              <td class="label">Return Pickup:</td>

              <td colspan="2">

			  <select name="puchoice" id="puchoice" class="txt_box required" onchange="return pUchoice(this.value);" tabindex="6">

			     <option value="" {if $pickupchoice eq ''}selected{/if}>Select</option>

				 <option value="Will Call" {if $pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>

				 <option value="Time" {if $pickupchoice eq 'Time'}selected{/if}>Time</option>

			   </select>	 

              &nbsp;<span class="SmallnoteTxt">*</span></span>

			  </td>

            </tr>

           <tr id="rpTime" style="display:none;">

              <td class="label">Pickup Time:</td>

              <td colspan="2"><input type="text" name="returnpickup" id="returnpickup" value="{$returnpickup}" tabindex="7" class="txt_box required" maxlength="5" onblur="return tValid(this.value,'returnpickup');" />

              &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>

            </tr>			

			

           {/if} 

                                                <tr>
                                                	<td class="label">Casemanager :</td>
                                                    <td><input type="text" name="casemanager1" id="casemanager1" value="{if $casemanager1 eq ''}{if $smarty.session.allowUser eq 0}{$smarty.session.user.fname} {$smarty.session.user.lname}{/if}{else}{$casemanager1}{/if}"  class="txt_box required" tabindex="8" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Today Date:</td>
                                                    <td><input type="text" name="todaydate" id="todaydate" value='{$smarty.now|date_format}' class="txt_box required" readonly  tabindex="9"/></td>
                                                    <td></td>
                                                </tr> 
                                                <tr>
                                                	<td colspan="3"><div class="form_heading">Pick Up Information</div></td>                                                </tr>
                                                 <tr>
                                                	<td class="label">Pickup Address:</td>
                                                    <td><input type="text" name="pickaddress" id="pickaddress" value="{$pickaddress}" class="txt_box required" tabindex="10"  maxlength="150"/></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label">Destination:</td>
                                                    <td><input type="text" name="destination" id="destination" value="{$destination}"  class="txt_box required" tabindex="11" maxlength="150" />&nbsp;<span class="SmallnoteTxt">*</span></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                	<td class="label" id="b1">Back To:</td>
                                                    <td><span id="trBackTo2"><input type="text" name="backto" id="backto" value="{$backto}"  class="txt_box required" tabindex="12"/>&nbsp;<span id="b2" class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
                                                 <tr>
                                                	<td ></td>
                                                    <td style="text-align:right;"><input type="submit" value="Proceed..." id="submit" name="submit" class="btn"></td>
                                                    <td></td>
                                                </tr>
                                            </table>
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
 </form>	
    <!--Main Container End Here-->
</body>
</html>
