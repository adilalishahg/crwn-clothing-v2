{ include file = headerinner.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function (){
$("#dobnew").mask("9999-99-99");
});
function chTrip(val){







    if(val == 'Round Trip'){

	

    var pu=$('#puchoice').val();

	

	

	if(pu=='Will Call'){

	



	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	



	

	}else{

	

		$('#rpTime').show();	

	

	}



	$('#backto').attr("class","txt_box required");	



	$('#rpu').attr("class","txt_box required");



	$('#rpu').show();	

	//$('#rpTime').show();	





	$('#trBackTo').show();

	$('#trBackTo1').show();

	$('#trBackTo2').show();

	$('#trBackTo3').show();

	$('#trBackTo4').show();	

	$('#trBackTo5').show();	

    //$('#backto').show();

	$('#backto').attr("class","txt_box required");

	

	$('#b1').show();	

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	$('#b5').show();	



	$('#puchoice').attr("class","txt_box required");	



	$('#backto').attr("disabled",false);



	$('#puchoice').attr("disabled",false);				  



	 return true;



    }





	

    if(val == 'One Way'){



	//$('#returnpickup').attr("disabled",true);



	$('#puchoice').removeAttr("class");



	//$('#backto').removeAttr("class");	



	$('#returnpickup').removeAttr("class");	



	$('#rpu').removeAttr("class");			



	$('#rpu').hide();	



	$('#trBackTo').hide();

	$('#trBackTo1').hide();

	$('#trBackTo2').hide();

	$('#trBackTo3').hide();

	$('#trBackTo4').hide();

	$('#trBackTo5').hide();	



$('#rpTime').hide();	

	//$('#backto').removeAttr("class");	



	//$('#backto').hide();	

    	$('#b1').hide();	

		$('#b2').hide();	

		$('#b3').hide();

		$('#b4').hide();

		$('#b5').hide();



	$('#puchoice').attr("disabled",true);	



    return true;



    }else{



	$('#backto').attr("class","txt_box required");	



	$('#rpu').attr("class","txt_box required");



	$('#rpu').show();	



	$('#trBackTo').hide();	

		



	$('#backto').attr("class","txt_box required");	



	$('#backto').attr("disabled",false);

	



	$('#puchoice').attr("class","txt_box required");	



	$('#puchoice').attr("disabled",false);	



	return true; 	



	}	



}
</script>
{/literal}
{if $triptype neq ''}
{literal}<script>chTrip('{/literal}{$triptype}{literal}');</script>{/literal}
{else}
{literal}<script>chTrip('{/literal}Round Trip{literal}');</script>{/literal}
{/if}
<table width="700" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            <tr>
                              <td height="19" align="center" class="admintopheading">Edit Request </td>
                            </tr>
<tr>
          <td height="19" align="center">&nbsp;</td>
        </tr>							
                           <tr>
<td height="19" align="center">
{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top">
							  <form name="editrequest" id="editrequest" method="post" action="edit.php?reqid={$reqid}&id={$id}&req={$req}">
	  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">
 <tr>
             <td colspan="3" valign="top" class="mainHeadingTxt"><strong>Trip Information</strong></td>
            </tr>
			<tr><td valign="top"><strong>Hospital Name :</strong></td><td valign="top">{$hospitalname}</td></tr>
            <tr>
             <td valign="top"><strong>Select Trip type :</strong></td>
              <td valign="top">
			  <select name="triptype" class="txt_box required" id="triptype" onchange="return chTrip(this.value);" tabindex="1" >
			    <option value="">Select</option>
				<option value="Round Trip" {if $triptype eq 'Round Trip'}selected{/if} selected>Round Trip</option>
				<option value="One Way" {if $triptype eq 'One Way'}selected{/if}>One Way</option>
			 </select>			  </td>
              <td valign="top">&nbsp;</td>
            </tr>  
             <tr>
              <td valign="top"><strong>Vehicle Preferences  :</strong></td>
              <td colspan="2" valign="top">
			 <select name="vehtype" class="txt_box required" id="vehtype" tabindex="2" >
			    <option value="">Select</option>
			  {section name=q loop=$vehiclepref}	
	<option value="{$vehiclepref[q].id}" {if $vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>
			  {/section}
			 </select>&nbsp;<span class="SmallnoteTxt">*</span>            </td>
            </tr>	
			<tr>
				<td valign="top"><strong>Case Manager:</strong></td>
				<td colspan="2" valign="top"><input name="casemanager1" type="text" class="txt_box required chars" id="casemanager1" tabindex="3" value="{$casemanager1}" maxlength="30" />&nbsp;<span class="SmallnoteTxt">*</span></td>
				<td></td>
			</tr>		
            <tr>
              <td colspan="3" valign="top">&nbsp;</td>
            </tr>         
           <tr>
              <td colspan="3" valign="top" class="mainHeadingTxt"><strong>Client Information</strong> </td>
            </tr>
           <tr>
              <td valign="top"><strong>Patient Name:</strong></td>
              <td valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="txt_box required chars" tabindex="4"  onfocus="return PerfromAutomation();" />&nbsp;<span class="SmallnoteTxt">*</span>           		  </td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><strong>Patient Phone Number:</strong></td>
              <td colspan="2" valign="top"><input type="text" name="phnum" id="phnum" value="{$phnum}" maxlength="15" class="txt_box required" tabindex="5"  />&nbsp;<span class="SmallnoteTxt">*</span>          			  </td>
            </tr>
			<tr>
		<td valign="top"><strong>Date of Birth:</strong></td>
			<td colspan="2" valign="top"><input type="text" name="dob" id="dobnew" value="{$dob}" class="txt_box required" tabindex="6" maxlength="15" /><span class="SmallnoteTxt">*   yyyy-mm-dd </span>	</td>
			<td></td>
		</tr>
            <tr>
              <td colspan="3" valign="top" class="mainHeadingTxt"><strong>Pick up  Information </strong></td>
              </tr>
            <tr>
              <td valign="top"><strong>Pick up address :</strong></td>
              <td width="47%"><input type="text" name="pickaddress" id="pickaddress" value="{$pickaddress}" class="txt_box required"  tabindex="8"  />&nbsp;<span class="SmallnoteTxt">*</span></td>
              <td width="16%">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><span class="label">City:</span></td>
              <td><input type="text" name="pckcity" id="pckcity"  class="txt_box  required chars" value="{$pckcity}" maxlength="20" tabindex="9" />
                                                 <span class="SmallnoteTxt">*</span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><span class="label">State:</span></td>
              <td><select name="pckstate" id="pckstate"  class="txt_box required" tabindex="10"> 
			    <option value="">Select</option>
			   {section name=n loop=$states} 
			   <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>
			   {$states[n].statename}
			   </option>
			  {/section}
              </select>
                                                   <span class="SmallnoteTxt">*</span></td>
              <td>&nbsp;</td>
            </tr>
			 <tr>
              <td valign="top"><span class="label">Zip Code:</span></td>
              <td><input type="text" name="pckzip" id="pckzip" class="txt_box required digits" value="{$pckzip}" maxlength="5"   tabindex="11" />
                                                 <span class="SmallnoteTxt">*</span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="37%" valign="top"><strong>Destination:</strong></td>
              <td colspan="2"><input type="text" name="destination" id="destination" value="{$destination}"  class="txt_box" tabindex="12"  />&nbsp;<span class="SmallnoteTxt">*</span></td>
            </tr>
            <tr>
              <td valign="top"><span class="label">City:</span></td>
              <td colspan="2"><input type="text" name="drpcity" value="{$drpcity}" id="drpcity" class="txt_box required chars" maxlength="20" tabindex="13" />
                                                <span class="SmallnoteTxt">*</span></td>
            </tr>
            <tr>
              <td valign="top"><span class="label">State:</span></td>
              <td colspan="2"><select name="drpstate" id="drpstate" class="txt_box required" tabindex="14">
                <option value="">Select</option>
			   {section name=n loop=$states}
			   <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state2}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>
			   {$states[n].statename}
			   </option>
			  {/section}
			  </select>
                                                  <span class="SmallnoteTxt">*</span></td>
            </tr>
			  <tr>
              <td valign="top"><span class="label">Zip Code: </span></td>
              <td colspan="2"><input maxlength="8" tabindex="15" type="text" name="drpzip" value="{$drpzip}" id="drpzip" class="txt_box required digits"/>
                                                <span class="SmallnoteTxt">*</span></td>
            </tr>
           {if $triptype eq 'Round Trip' } 			
            <tr id="trBackTo">
              <td valign="top"><span id="trBackTo1"><strong>Back to Address Details:</strong></span></td>
              <td colspan="2">&nbsp;
              </td>
            </tr>
             <tr>
                                               	<td class="label" id="b1" >Back To Address:</td>
                                                    <td><span id="trBackTo5" ><input tabindex="16" name="backto" type="text"  class="txt_box required" id="backto" value="{$bck}" maxlength="150"/>&nbsp;<span id="bb1" class="SmallnoteTxt">*</span></span></td>
                                                   <td></td>
                                                </tr>
												 <tr>
                                                	<td class="label" id="b2" >Back To City:</td>
                                                    <td><span id="trBackTo2" ><input tabindex="17" name="backtocity" type="text"  class="txt_box required" id="backtocity" value="{$bckcity}" maxlength="150"/>&nbsp;<span id="bb2" class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
												<tr>
                                                	<td class="label" id="b3" >Back To State:</td>
                                                    <td><span id="trBackTo3" ><select  tabindex="18"id="backtostate" name="backtostate"  class="txt_box required">
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
                                                	<td class="label" id="b4" >Back To Zip Code:</td>
                                                    <td><span id="trBackTo4"><input tabindex="19" name="backtozip" type="text"  class="txt_box required digits" id="backtozip" value="{$bckzip}" maxlength="150"/>&nbsp;<span id="bb4" class="SmallnoteTxt">*</span></span></td>
                                                    <td></td>
                                                </tr>
            {/if}
            <tr>
              <td colspan="3" valign="top" class="mainHeadingTxt"><strong>Appointment Information </strong></td>
             </tr>
			<tr>
              <td valign="top"><strong>A.H.C.C.C.S #:</strong></td>
              <td colspan="2">
			 <input tabindex="21" type="text" name="cisid" id="cisid" value="{$cisid}" class="txt_box required" onfocus="return PerfromAutomation();"/>&nbsp;<span class="SmallnoteTxt">*</span>  
			 </td>
			 <input type="hidden" id="progtype" name="progtype" value="{$progtype}">
            </tr>
            <tr>
             <td valign="top"><strong>Date:</strong></td>
              <td colspan="2"><input type="text" readonly="true" name="appdate" id="appdate" value="{$appdate}" class="txt_box required" tabindex="23"   />                
              <span class="SmallnoteTxt">*</span></td>
            </tr>
            <tr>
             <td valign="top"><strong>Time: </strong></td>
              <td colspan="2"><input type="text" name="apptime" id="apptime" value="{$apptime}" class="txt_box required" maxlength="5" tabindex="24" onblur="return tValid(this.value,'apptime');" />&nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
            </tr>
           {if $triptype eq 'Round Trip' || $triptype eq ''} 			
         <tr id="rpu">
              <td valign="top"><strong>Return Pickup: </strong></td>
              <td colspan="2">
	  <select name="puchoice" id="puchoice" class="SelectBox required" onchange="return pUchoice(this.value);" tabindex="25">
  <option value="" {if $pickupchoice eq ''}selected{/if}>Select</option>
				 <option value="Will Call" {if $pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>
				 <option value="Time" {if $pickupchoice eq 'Time'}selected{/if}>Time</option>
			   </select>	 
              &nbsp;<span class="SmallnoteTxt">*</span></span></td>
            </tr>
           <tr id="rpTime" {if $pickupchoice neq 'Time' || $pickupchoice eq 'Will Call'} style="display:none;" {/if}>
              <td valign="top"><strong>Pickup Time: </strong></td>
             <td colspan="2"><input type="text" name="returnpickup" id="returnpickup" value="{$returnpickup}" tabindex="26" class="txt_box required" maxlength="5" onblur="return tValid(this.value,'returnpickup');" />
              &nbsp;<span class="SmallnoteTxt">* (e.g. 15:30 Hrs)</span></td>
            </tr>	
			{/if}
            <tr>
              <td valign="top"><strong>Today Date:</strong></td>
              <td valign="top"><input type="text" name="todaydate" id="todaydate" value='{$smarty.now|date_format}' class="txt_box required" readonly  tabindex="27"  /></td>
              <td valign="top">&nbsp;</td>
            </tr>
			 <tr>
              <td valign="top"><strong>Comments:</strong></td>
              <td valign="top"><textarea name="comments" cols="60" rows="5" id="comments" tabindex="28" style="width:300px;"  >{$comments}</textarea></td>
              <td valign="top">&nbsp;</td>
            </tr>
		 <tr>
              <td valign="top">&nbsp;</td>
              <td colspan="2">
			 <input type="hidden" name="reqstatus" id="reqstatus" value="{$reqstatus}" />	
			  <input type="submit" name="submit" value='Update' class="btn" tabindex="29"    />
			  <input type="reset" name="reset" value="Reset" class="btn"  tabindex="30"   />			  </td>
            </tr>
          </table>
	      </form>							  </td>
            </tr>
			<tr>
			   <td>&nbsp;</td>
			</tr>			
      </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}