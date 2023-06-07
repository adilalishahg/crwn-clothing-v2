{include file = headerinner.tpl}
{literal}
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
// $("#startdate").mask("19/39/9999");
  //  $("#enddate").mask("19/39/9999");	
	//$("#phnum").mask("(999) 999-9999");
	//$("#h_phone").mask("(999) 999-9999");
	//$("#appdate").datepicker();
$(document).ready(function(){	
$("#startdate").datepicker( {maxDate: '-0', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {maxDate: '-0', dateFormat: 'mm/dd/yy'} );
});
</script>{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
                              <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
                              <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							{if $noReq neq '0'}
							[<a href="javascript:history.back();">Back</a>]{/if}</div>							  </td>
        </tr>							
                            <tr>
<td height="19" colspan="2" align="center" class="admintopheading">Generate Invoices</td>
                           </tr>
                           <tr>
                              <td height="44" colspan="2" align="center"  valign="top">
							 <form name="searchReport" action="invoices.php" method="get"> 
							  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
                      <tr>
              <td width="14%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
              <td width="19%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$startdate}" class="inputTxtField"/> <span style="color:#FF0000">*</span></td>
              <td width="14%" align="right" valign="top" class="labeltxt"><div align="left"><strong>To:</strong>&nbsp;</div></td>
              <td width="18%" align="left" valign="top" class="labeltxt"><input type="text" name="enddate" id="enddate" value="{$enddate}" class="inputTxtField" />
                 <span style="color:#FF0000">*</span></td>
                 <td width="14%" align="left" valign="top" class="labeltxt"><strong>Account:</strong></td>
              <td width="18%" align="left" valign="top">
			  <select name="hospname" id="hospname" class="">
			    <option value="">-- Select Account--</option>
			   {section name=q loop=$hosp}
			    <option value="{$hosp[q].id}" {if $hospname eq $hosp[q].id}selected="selected"{/if}>{$hosp[q].account_name}</option>
				{/section}
			   </select>		  </td>
 </tr>
            <tr>
              
               <td  align="left" valign="top" class="labeltxt"><strong>Patient Name:</strong>&nbsp;</td>
              <td align="left" valign="top" class="labeltxt"><input name="pname" type="text" class="txt_box" id="pname"  value="{$pname}" maxlength="50" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div></td>
           
              <td align="left" valign="top" class="labeltxt"><strong>Pick Location:</strong></td>
              <td align="left" valign="top">
			  <select name="picklocation" id="picklocation" class="">
			    <option value="">-- Select Pick Location--</option>
			   {section name=q loop=$picklocations}
			    <option value="{$picklocations[q].picklocation}" {if $picklocation eq $picklocations[q].picklocation}selected="selected"{/if}>{$picklocations[q].picklocation}</option>
				{/section}
			   </select>		  </td>
               <td align="right" valign="top" class="labeltxt"><div align="left"><strong>Drop Location:</strong></div></td>
              <td align="left" valign="top">
			  <select name="droplocation" id="droplocation" class="">
			    <option value="">-- Select Drop Location--</option>
			   {section name=q loop=$droplocations}
			    <option value="{$droplocations[q].droplocation}" {if $droplocation eq $droplocations[q].droplocation}selected="selected"{/if}>{$droplocations[q].droplocation}</option>
				{/section}
			   </select>		  </td>
            </tr>
            
           <!-- <tr>
              <td align="right" valign="top" class="labeltxt"><div align="left"><strong>Company Code :</strong></div></td>
              <td align="left" valign="top">
			  <select name="code" class=" txt_boxX" id="code"  >
                      <option value="">All</option>
                      			  {section name=q loop=$ccode}	
                 <option value="{$ccode[q].code}" {if $ccode[q].code eq $code} selected="selected" {/if}>{$ccode[q].code} - - {$ccode[q].company}</option>
                      {/section}
                    </select> </td>
            </tr>-->
            
            <!--<tr>
              <td align="left" valign="top">&nbsp;</td>
              <td colspan="4" align="left" valign="top">
			  <font color="#FF0000">
   			     <b>Note:*</b>
				 <ol><li>Combination of all fields are not mandatory</li>
				 <li>Both Start and End date must be provided.</li>
				 </ol> </font>			  </td>
             </tr>-->
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td colspan="4" align="center" valign="top">
			  <input type="submit" name="submit2" value='Generate in HTML' class="inputButton btn" />&nbsp;&nbsp;&nbsp;
              <input type="submit" name="csv" value='Generate in CSV' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
              <input type="submit" name="submit" value='Generate in PDF' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
              <input type="submit" name="showreport" value='Show Report' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
              <!--<input type="submit" name="generate" value='Generate Invoices' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />-->			  </td>
              </tr>
          </table>	
		                     </form>		  	                  </td>
                            </tr>
                            <tr>
		</tr>			
      </table>
    </td>
  </tr>
 <tr><td>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">                    
                            <tr>
                            <td align="center" class="admintopheading">Invoices <span style="float:right; color:#F00;">Total Amount Billed: $ {$totalammount|string_format:"%.2f"}</span></td>
                            </tr>
                             <tr>
                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								<div style="width:100%; border: #F00 0px solid; float:left;"></div>
						   <br />
							  <table width="100%" border="0" class="">
                              {if $pname neq ''}
<tr><td colspan="10" style="text-align:right;"><a href="javascript:popWind2('medical_invoice2.php?startdate={$startdate}&enddate={$enddate}&hospname={$hospname}&pname={$pname}')" ><input type="button" class="inputButton btn" value="Show Patient Combine Invoice"  /></a></td></tr> {/if}    
							  <tr class="admintopheading">
<td width="4%"  align="center"> Date<br/>Account Name</td>
<td width="8%" align="center"> Customer<br/>Name</td>
<!----><td width="4%" align="center">Leg</td>
<td width="18%" align="center"> Pick Address /<br/> Drop Address</td>
<td width="5%" align="center">Pick<br/>Time</td>
<td width="10%" align="center">Miles</td>
<td width="13%" align="center">Veh.<br/>
  Type</td>
<td width="4%" align="center">Total<br/>$</td>
<td width="15%" align="center">Out of Area/Misc Fee</td>
<td width="5%"  align="center">View<br/>Edit</td>
								 </tr>	       
							{section name=q loop=$invoicesdata}
<tr id="tr{$invoicesdata[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
<td align="left" valign="middle">{$invoicesdata[q].appdate|date_format:"%m/%d/%Y"}<br/>{$invoicesdata[q].account_name}</td>
<td align="left" valign="middle">{$invoicesdata[q].clientname}</td>
<!----><td align="left" valign="middle">Leg {if $invoicesdata[q].leg eq '1'}A{elseif $invoicesdata[q].leg eq '2'}B{elseif $invoicesdata[q].leg eq '3'}C{elseif $invoicesdata[q].leg eq '4'}D{/if}
</td>
<td align="left" valign="middle">
{if $invoicesdata[q].leg eq '1'}
{$invoicesdata[q].pickaddr}/<br/>{$invoicesdata[q].destination} {else}
{$invoicesdata[q].destination}/<br/>{$invoicesdata[q].backto}	{/if}
</td>
<td align="left" valign="middle"> 
{if $invoicesdata[q].leg eq '1'}
{$invoicesdata[q].apptime|truncate:5:""}	{else}
{$invoicesdata[q].returnpickup|truncate:5:""}  {/if}</td>
<td align="left" valign="middle">Total Miles={$invoicesdata[q].miles}<br/>
Free Miles={$invoicesdata[q].freemiles}<br/>
Billable Miles={$invoicesdata[q].billablemile}</td>
<td align="center" valign="middle"> {$invoicesdata[q].vehicle}<!--<br />Pickup Charges: {$invoicesdata[q].pickup_ch}<br />Price Per Mile: {$invoicesdata[q].permile_ch}--></td>
<td align="center" valign="middle"> ${$invoicesdata[q].charges|string_format:"%.2f"}</td>
<td align="left" valign="middle"><!--$ {$invoicesdata[q].charges}-->
{if $invoicesdata[q].miscellaneous_charges neq '0'}Misc. Chrg: {$invoicesdata[q].miscellaneous_charges}<br/>{/if}
<!--{if $invoicesdata[q].dstretcher eq 'Yes'}2ManTeam Chrg: {$invoicesdata[q].dstretcher_rate}<br/>{/if}
{if $invoicesdata[q].oxygen eq 'Yes'}Oxg. Chrg: {$invoicesdata[q].oxygen_rate}<br/>{/if}
{if $invoicesdata[q].bstretcher eq 'Yes'}Bariatric Str. Chrg: {$invoicesdata[q].bstretcher_rate}<br/>{/if}
{if $invoicesdata[q].doublewheel eq 'Yes'}WheelChair Rental Chrg: {$invoicesdata[q].doublewheel_rate}<br/>{/if}
{if $invoicesdata[q].noshow eq '1'}No Show Fee: {$invoicesdata[q].noshow_rate}<br/>{/if}
{if $invoicesdata[q].waittime_unit neq '0'}Wait Time Charges: {$invoicesdata[q].waittime_rate}<br/>{/if}
{if $invoicesdata[q].unloaded_miles_ch neq '0'}Un.M Charges[{$invoicesdata[q].unloaded_miles}]: {$invoicesdata[q].unloaded_miles_ch}<br/>{/if}
-->
{if $invoicesdata[q].afterhour eq '1'}After Hour Fee: {$invoicesdata[q].afterhour_rate}<br/>{/if}




</td>
<td align="center" valign="middle"><a href="javascript:popWind2('medical_invoice.php?id={$invoicesdata[q].tid}')" ><img alt="View Invoice detail" border="0"  src="../graphics/view.gif"></a><br/><br/><a href="javascript:popWind2('edit_request.php?id={$invoicesdata[q].tid}')" ><img alt="Edit Information" border="0"  src="../graphics/edit.png"></a></td>
</tr>
							 {sectionelse}
							 <tr>
							  <td colspan="9" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 
							 {/section} 
							</table> 					
                			
                </td>
            </tr>
      </table>  
</td></tr> 
</table>
{literal}
<script>selbox();</script>{/literal}		 
{ include file = innerfooter.tpl}