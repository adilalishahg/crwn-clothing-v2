<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />
<link href="../theme/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../theme/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/ui.datepicker.js"></script>
<!--<script src="../scripts/jquery.jmap.min.js" type="text/javascript"></script>-->
<link href="../theme/flora.datepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>

{literal}
<script>
$(document).ready(function(){					  
	 
	 $("#dob").mask("19/39/9999");
	 $("#waittime").mask("99:99");
	 $("#ar").validate();
	 //$("#dob").datepicker( {yearRange:'-120:00'} );
    });		
</script>
{/literal}
<link href="../theme/style.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="ar" id="ar" method="post" action="edit_request.php">
        <table width="100%" border="0" cellspacing="4" cellpadding="2" align="center" class="">
          <tr>
            <td colspan="4" valign="top" style="text-align:center;" class="admintopheading"><strong>Update Request & Invoice Information</strong></td>
          </tr>
          <tr>
             <td colspan="4"><input type="hidden" name="id" value="{$id}"></td>
          </tr>
			<tr> 
			  <td width="18%" align="left" valign="top" class="labeltxt"><strong>Patient Name:</strong>&nbsp;&nbsp;</td>
              <td width="30%" align="left"><input type="text" name="clientname" value="{$dt.clientname}"  /></td>
              <td width="32%" align="left" valign="top" class="labeltxt"><strong>Patient Phone #:</strong>&nbsp;&nbsp;</td>
              <td width="20%" align="left"><input type="text" name="phnum" value="{$dt.phnum}"  /></td>
            </tr>
            <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Vehicle Preference:</strong>&nbsp;&nbsp;</td>
              <td   align="left"><select name="vehtype" ><option value="" >Select Vehicle Preference</option>
	             {section name=q loop=$vehiclepref} <option value="{$vehiclepref[q].id}" {if $vehiclepref[q].id eq $dt.vehtype} selected="selected" {/if} >{$vehiclepref[q].vehtype}</option>{/section}
              </select></td>
              <td  align="left" valign="top" class="labeltxt"><strong>Account Name:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><select name="account" class=" txt_boxX" id="account"  >
             			  {section name=q loop=$accounts}	
                 <option value="{$accounts[q].id}" {if $accounts[q].id eq $dt.account} selected="selected" {/if}>{$accounts[q].account_name}</option>
                      {/section}
                    </select></td>
            </tr>
            <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>PO#: </strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="po" value="{$dt.po}"  /></td>
              <td  align="left" valign="top" class="labeltxt"><strong>DOB: </strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="dob" id="dob" value="{$dob}" />(mm/dd/yyyy)</td>
            </tr>
           
            <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Pick Location:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="picklocation" value="{$dt.picklocation}"  /></td>
              <td  align="left" valign="top" class="labeltxt"><strong>Pick Address with Suite#/Room #:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="pickaddr" value="{$dt.pickaddr}" size="40" /></td>
            </tr>
            <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Drop Location:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="droplocation" value="{$dt.droplocation}"  /></td>
              <td  align="left" valign="top" class="labeltxt"><strong>Drop Address with Suite#/Room #:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="destination" value="{$dt.destination}" size="40"  /></td>
            </tr>
            {if $dt.triptype eq 'Four Way' || $dt.triptype eq 'Three Way'}
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>2nd Location:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="droplocation2" value="{$dt.droplocation2}"  /></td>
              <td  align="left" valign="top" class="labeltxt"><strong>2nd Address with Suite#/Room #:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="three_address" value="{$dt.three_address}"  size="40"/></td>
            </tr>
            {/if}
            {if $dt.triptype eq 'Four Way'}
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>3rd Location:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="droplocation3" value="{$dt.droplocation3}"  /></td>
              <td  align="left" valign="top" class="labeltxt"><strong>3rd Address with Suite#/Room #:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="four_address" value="{$dt.four_address}"  size="40"/></td>
            </tr>
            {/if}
            {if $dt.triptype eq 'Four Way' || $dt.triptype eq 'Three Way' || $dt.triptype eq 'Round Trip'}
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Backto Location:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="backtolocation" value="{$dt.backtolocation}"  /></td>
              <td  align="left" valign="top" class="labeltxt"><strong>Backto Address with Suite#/Room #:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="backto" value="{$dt.backto}"  size="40"/></td>
            </tr>
            {/if}
            
             
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Trip # for Leg A:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="legaid" value="{$dt.legaid}"  /></td>
             </tr>
         
            {if $dt.triptype eq 'Four Way' || $dt.triptype eq 'Three Way' || $dt.triptype eq 'Round Trip'}
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Trip # for Leg B:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="legbid" value="{$dt.legbid}"  /></td>
             </tr>
            {/if}
            {if $dt.triptype eq 'Four Way' || $dt.triptype eq 'Three Way' }
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Trip # for Leg C:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="legcid" value="{$dt.legcid}"  /></td>
             </tr>
            {/if}
            {if $dt.triptype eq 'Four Way' }
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Trip # for Leg D:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="legdid" value="{$dt.legdid}"  /></td>
             </tr>
            {/if}
            <tr><td colspan="4" ><hr/></td></tr>
            
            <tr><td></td><td colspan="3" class="labeltxt"><input type="checkbox" name="regenrate" /> <span style="color:#F00;"><strong>Regenerate invoice correspond to above changes</strong></span></td></tr>
            {section name=q loop = $billingdata}
            <tr><td colspan="4" style="text-align:center;"><strong>Leg {if $billingdata[q].leg eq '1'}A{elseif $billingdata[q].leg eq '2'}B{elseif $billingdata[q].leg eq '3'}C{elseif $billingdata[q].leg eq '4'}D{/if}</strong></td></tr>
            <tr><td colspan="4"><hr /></td></tr>
             <tr> 
		      <td  align="left" valign="top" class="labeltxt"><strong>2 Man Team:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="checkbox" name="dstretcher[]" value="Yes" {if $billingdata[q].dstretcher eq 'Yes'} checked="checked"{/if}/>&nbsp;Yes&nbsp;&nbsp;@&nbsp;<input type="text" name="dstretcher_rate[]" value="{$billingdata[q].dstretcher_rate}" size="5"/></td>
              <td  align="left" valign="top" class="labeltxt"><strong>Bariatric Stretcher:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="checkbox" name="bstretcher[]" value="Yes" {if $billingdata[q].bstretcher eq 'Yes'} checked="checked"{/if}/>&nbsp;Yes&nbsp;&nbsp;@&nbsp;<input type="text" name="bstretcher_rate[]" value="{$billingdata[q].bstretcher_rate}" size="5"/></td>
            </tr>            
             <tr>			  
              <td  align="left" valign="top" class="labeltxt"><strong>Wheel Chair Rental:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="checkbox" name="doublewheel[]" id="doublewheel" value="Yes" {if $billingdata[q].doublewheel eq 'Yes'} checked="checked"{/if}/>&nbsp;Yes &nbsp;&nbsp;@&nbsp;<input type="text" name="doublewheel_rate[]" value="{$billingdata[q].doublewheel_rate}" size="5"/></td>
              <td  align="left" valign="top" class="labeltxt"><strong>0xygen:</strong>&nbsp;&nbsp;</td>
              <td   align="left"><input type="checkbox" name="oxygen[]" value="Yes" {if $billingdata[q].oxygen eq 'Yes'} checked="checked"{/if}/>
              &nbsp;Yes&nbsp;&nbsp;@&nbsp;<input type="text" name="oxygen_rate[]" value="{$billingdata[q].oxygen_rate}" size="5"/></td>
            </tr>
             <tr>
              <td  align="left" valign="top" class="labeltxt"><strong>Wait Time?:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="waittime[]" id="waittime" value="{$billingdata[q].waittime}" size="7" maxlength="8" class="inputTxtField" />&nbsp;&nbsp;@&nbsp;<input type="text" name="waittime_rate[]" value="{$billingdata[q].waittime_rate}" size="5"/> 
              per minute </td>
               <td  align="left" valign="top" class="labeltxt"><strong>No Show Apply?:</strong>&nbsp;&nbsp;</td>
              <td   align="left"><select name="noshow[]">
            										<option value="0" {if $billingdata[q].noshow eq '0'}selected{/if}>No</option>
                                                    <option value="1" {if $billingdata[q].noshow eq '1'}selected{/if}>Yes</option>
                                                    </select>&nbsp;&nbsp;&nbsp;@&nbsp;<input type="text" name="noshow_rate[]" value="{$billingdata[q].noshow_rate}" size="5"/></td>
      
            </tr>
             <tr>
              <td  align="left" valign="top" class="labeltxt"><strong>Free Miles:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="freemiles[]" id="freemiles" value="{$billingdata[q].freemiles}" size="10" maxlength="8" class="inputTxtField" /></td>
               <td  align="left" valign="top" class="labeltxt"><strong>After Hours Fee Apply?:</strong>&nbsp;&nbsp;</td>
              <td   align="left"><select name="afterhour[]">
            										<option value="0" {if $billingdata[q].afterhour eq '0'}selected{/if}>No</option>
                                                    <option value="1" {if $billingdata[q].afterhour eq '1'}selected{/if}>Yes</option>
                                                    </select>&nbsp;&nbsp;&nbsp;@&nbsp;<input type="text" name="afterhour_rate[]" value="{$billingdata[q].afterhour_rate}" size="5"/></td>
            </tr>
            <tr> 
			   <td  align="left" valign="top" class="labeltxt"><strong>Total Miles:</strong>&nbsp;&nbsp;</td>
              <td   align="left"><input type="text" name="miles[]" value="{$billingdata[q].miles}" size="5"/>&nbsp;Billable:&nbsp;{$billingdata[q].chargeablemile}&nbsp;&nbsp;@&nbsp;<input type="text" name="permile_ch[]" value="{$billingdata[q].permile_ch}" size="5"/></td>
              <td  align="left" valign="top" class="labeltxt"><strong>Miscellaneous Charges:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="miscellaneous_charges[]" value="{$billingdata[q].miscellaneous_charges}" size="10" maxlength="8" class="inputTxtField" /> $ </td>
            </tr>
             <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Unloaded Miles:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><select name="unloaded_miles[]" ><option value="" >None</option>
                  <option value="21-25" {if $billingdata[q].unloaded_miles eq '21-25'} selected {/if} >21-25</option>
                  <option value="26-30" {if $billingdata[q].unloaded_miles eq '26-30'} selected {/if} >26-30</option>
                  <option value="31-35" {if $billingdata[q].unloaded_miles eq '31-35'} selected {/if} >31-35</option>
                  <option value="36-40" {if $billingdata[q].unloaded_miles eq '36-40'} selected {/if} >36-40</option>
                  <option value="41-45" {if $billingdata[q].unloaded_miles eq '41-45'} selected {/if} >41-45</option>
                  <option value="46-50" {if $billingdata[q].unloaded_miles eq '46-50'} selected {/if} >46-50</option>
                  <option value="51-55" {if $billingdata[q].unloaded_miles eq '51-55'} selected {/if} >51-55</option>
                  <option value="56-60" {if $billingdata[q].unloaded_miles eq '56-60'} selected {/if} >56-60</option></select></td>
             <td  align="left" valign="top" class="labeltxt"><strong>Unloaded Miles Charges:</strong>&nbsp;&nbsp;</td>
             <td  align="left"><input type="text" name="unloaded_miles_ch[]" value="{$billingdata[q].unloaded_miles_ch}"/>
             </td>
            </tr>
            
            
            <tr> 
			  <td  align="left" valign="top" class="labeltxt"><strong>Pickup Charges:</strong>&nbsp;&nbsp;</td>
              <td  align="left"><input type="text" name="pickup_ch[]" value="{$billingdata[q].pickup_ch}"  /></td>
             <td  align="left" valign="top" class="labeltxt"><strong>Total Charges:</strong>&nbsp;&nbsp;</td>
             <td  align="left"><input type="text" name="charges[]" value="{$billingdata[q].charges}"/>
             <input type="hidden" name="leg_id[]" value="{$billingdata[q].id}" /></td>
            </tr>
        {/section}    
            
             <tr> 
			   <td  align="left" valign="top" class="labeltxt"><strong></strong>&nbsp;&nbsp;</td>
              <td   align="left"></td>
              <td  align="left" valign="top" class="labeltxt"><strong><input type="submit" name="submit" value="Update Billing Information" style="background-color: #0397ff;
border: 1px solid #06447d;
font-family: verdana;
height: 20px;
font-size: 13px;
font-weight: bold;
color: #FFF;
vertical-align: middle;
padding-bottom: 4px;
cursor: pointer;"  /></strong>&nbsp;&nbsp;<input type="hidden" name="triptype" value="{$dt.triptype}" /></td>
              <td  align="left"></td>
            </tr>
        </table>
      </form></td>
  </tr>
 
</table>
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>
<script>
$('#wait_time').mask('29:59:59');
</script>