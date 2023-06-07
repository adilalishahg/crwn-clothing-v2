{ include file = headerinner.tpl}
{literal} 
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   $('#searchReport').validate();
						   $('#hosp').attr('disabled', true);
						   });
function other()
{
	val = document.getElementById('hospname').value;
	if(val =='other')
	{
	$('#hosp').attr('disabled', false);
	}
	else
	{
	 $('#hosp').attr('disabled', true);
	}
}
$(document).ready(function(){	

$("#startdate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
});
</script> 
{/literal}
<table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</span></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> {if $noReq neq '0'}
              [<a href="javascript:history.back();">Back</a>]{/if}</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">DISPATCH REPORTS</td>
        </tr>
           <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="rep.php" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
                  <tr>
                  <td width="15%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                  <td width="20%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$stdate}" class="required" size="10"/>     (mm/dd/yyyy)</td>
                  <td width="10%"  align="left" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                  <td width="20%"  align="left" valign="top" ><input type="text" name="enddate" id="enddate" value="{$enddate}" class="required" size="10" />       (mm/dd/yyyy)</td>
                  <td width="10%" align="left" valign="top" class="labeltxt"><strong>Driver:</strong></td>
                  <td width="30%" align="left" valign="top"><select name="driver_id" id="driver">
                      <option value="">Select Driver</option>
                      
            {section name=q loop = $driver}
                
                      <option value="{$driver[q].drv_code}" {if $driver[q].drv_code eq $drv_id} selected{/if}>{$driver[q].fname} {$driver[q].lname}  - [ {$driver[q].drv_code} ]</option>
                      
            {/section}
              
                    </select></td>
                </tr>
                <tr>
                  
                  
                </tr>
                
                <tr><td align="left" valign="top" class="labeltxt"><strong><strong>Patient Name:</strong></strong></td>
                  <td align="left" valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div> </td>
                  <td align="left" valign="top"  class="labeltxt"><strong>Status:</strong></td>
                  <td align="left"><select  id="status" name="status">
                      <option value="">Select Status</option>
                      <option value="9" {if $status eq '9'} selected="selected" {/if} >Pending</option>
                      <option value="5" {if $status eq '5'} selected="selected" {/if} >In Progress</option>
                      <option value="3" {if $status eq '3'} selected="selected" {/if} >Cancelled</option>
                      <option value="2" {if $status eq '2'} selected="selected" {/if} >Rescheduled</option>
                      <option value="4" {if $status eq '4'} selected="selected" {/if} >Completed</option>
                      <option value="8" {if $status eq '8'} selected="selected" {/if} >Non Billable No-Show</option>
                      <option value="7" {if $status eq '7'} selected="selected" {/if} >Billable No-Show</option>
                    </select></td>
                  <td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
             <td align="left" valign="top">
                <select name="hospname" class=" txt_boxX" id="hospname"  >
                      <option value="">Select Account</option>
                      			  {section name=q loop=$hosp}	
                 <option value="{$hosp[q].id}" {if $hosp[q].id eq $hospname} selected="selected" {/if}>{$hosp[q].account_name}</option>
                      {/section}
                    </select>
              </td>
                </tr>
                <!--<tr><td align="left" valign="top" class="labeltxt"><strong>Company Code :</strong></td>

              <td colspan="1" align="left" valign="top"><select name="code" class=" txt_boxX" id="code"  >
                      <option value="">All</option>
                      			  {section name=q loop=$ccode}	
                 <option value="{$ccode[q].code}" {if $ccode[q].code eq $code} selected="selected" {/if}>{$ccode[q].code} - - {$ccode[q].company}</option>
                      {/section}
                    </select></td></tr>-->
                <tr>
                                 <td></td> <td colspan="6" align="left" valign="top"><font style="color:#F00;">
                    <ol>
                    <li>  {if $totalRows neq ''}{/if}[ Total Trips : {$totalRows} ]&nbsp;&nbsp;&nbsp;{if $tmiles neq ''}{/if}[ Total Miles : {$tmiles} ]</li>
                    <li>[Pending: {$st9}] [In Progress: {$st5}] [Cancelled: {$st3}] [Rescheduled: {$st2}] [Completed: {$st4}] [Non Billable No-Show: {$st8}] [Billable No-Show: {$st7}]</li>
                    </ol>
                    </font></td>
                </tr>
                <tr>
                  <td align="left" colspan="1" valign="top">&nbsp;</td>
                  <td colspan="3" align="left" valign="top"><input type="submit" name="submit" id="submit" value='&nbsp;&nbsp;Show Report&nbsp;&nbsp;' class="inputButton btn"  />
                    &nbsp;&nbsp;&nbsp;
                    <input type="submit" name="submit2" id="submit2" value='&nbsp;&nbsp;Export CSV&nbsp;&nbsp;' class="inputButton btn"  />
                    &nbsp;&nbsp;&nbsp;
                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  />
                    &nbsp;<input type="button" onclick="javascript:location.reload();" value="&nbsp;&nbsp;Reload Page&nbsp;&nbsp;" class="btn" /> </td>
                </tr>
              </table>
            </form></td>
        </tr>
        <!--<tr>
          <td colspan="2" align="center"  valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"  valign="top" height="35">&nbsp;</td>
        </tr>-->
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table11">
              <tr class="admintopheading">
               <!-- <td width="`15%" align="center"><strong>Facility</strong></td>-->
                <td width="10%" align="center"><strong>Patient Name </strong></td>
                <!--<td width="15%" align="center"><strong> Appointment Type </strong></td>-->
                <td width="10%" align="center"><strong> Driver </strong></td>
                <td width="15%" align="center"><strong> Pick Address</strong></td>
                <td width="15%" align="center"><strong>Drop Address</strong></td>
                <td width="7%" align="center"><strong> Date</strong></td>
                <td width="5%" align="center"><strong>Schedule Pick Time</strong></td>
                
                <td width="5%" align="center"><strong>Actual<br/>{if $status=='3'}Cancelled
                {elseif $status=='7' || $status=='8'}No Show
                {else}Pick{/if}Time</strong></td>
                <td width="5%" align="center"><strong> Miles</strong></td>
                <!--<td width="5%" align="center"><strong>Rating</strong></td>-->
                <td width="5%" align="center">Option</td>
              </tr>
              {section name=q loop=$data}
              {if $reqdetails[q].rows neq '0'}
              <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
                <!--<td align="left" valign="top"><strong>{$data[q].trip_clinic}</strong></td>-->
                <td align="center" valign="top"><p>{$data[q].trip_user}</p></td>
                
                <!--<td align="center" valign="top"><p>{if $data[q].phyaddress neq ''}Specialist{else}General Medicine{/if}</p></td>-->
                <td align="center" valign="top">{$data[q].name} <br>
                  [{$data[q].drv_id}]{if $data[q].escort_id eq $drv_id}}<br /><span style="color:#F00;">ESCORT</span>{/if}</td>
                <td align="center" valign="top">{$data[q].pck_add}</td>
                <td align="center" valign="top">{$data[q].drp_add}</td>
                <td align="center" valign="top">{$data[q].date}</td>
                <td align="center" valign="top">{$data[q].pck_time}</td>
                <td align="center" valign="top">
                {if $status=='7' || $status=='8' || $status=='3'}{$data[q].ac_noshowcancell}
                {else}{$data[q].aptime}{/if}
                </td>
                <td align="center" valign="top">{$data[q].trip_miles}</td>
               <!-- <td align="center" valign="top"><div class="rating1" style="width:60px;"  title="{$data[q].comments}">{if $data[q].drv_rating gt 0}
                    {section name=r loop=$data[q].drv_rating} <img src="../theme/rate.gif" width="8px" height="8px"/> {/section}
                    {/if}</div></td>-->
                <td align="center" valign="top">
                <a href="edit_trip.php?tdid={$data[q].tdid}" title="Edit" target="_blank"> <img border="0" alt="Edit" src="../graphics/edit.png"></a><br/>
                <a href="javascript:popWind('details.php?id={$data[q].tdid}');">View Detail</a></td>
              </tr>
              {/if}
              {sectionelse}
              <tr>
                <td colspan="7" align="center" ><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center">{if $totalRows gt 0}{$pages}{/if}</td>
        </tr>
      </table>
{ include file = innerfooter.tpl} 