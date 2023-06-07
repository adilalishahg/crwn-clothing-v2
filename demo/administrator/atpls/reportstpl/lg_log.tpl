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
<table  border="0" cellspacing="0" cellpadding="0" class="outer_table" align="right" bgcolor="#FFFFFF" >
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</span></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> {if $noReq neq '0'}
              [<a href="javascript:history.back();">Back</a>]{/if}</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">LOGISTICARE LOG</td> 
        </tr>
        <!--<tr>
                              <td colspan="2" align="center"  valign="top">							  </td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"  valign="top">&nbsp;</td>
                            </tr>-->
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
               <!-- <tr>
                  <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                </tr>-->
                <tr>
                  <td width="10%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                  <td width="35%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$stdate}" class="required" size="10"/>     (mm/dd/yyyy)</td>
                  <td width="20%"  align="left" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                  <td width="35%"  align="left" valign="top" ><input type="text" name="enddate" id="enddate" value="{$enddate}" class="required" size="10" />       (mm/dd/yyyy)</td>
                </tr>
                <tr>
                  <td  align="left" valign="top" class="labeltxt"><strong>Driver:</strong></td>
                  <td align="left" valign="top"><select name="driver_id" id="driver" class="required"><!---->
                      <option value="">Select Driver</option>
                      
            {section name=q loop = $driver}
                
                      <option value="{$driver[q].drv_code}" {if $driver[q].drv_code eq $drv_id} selected{/if}>{$driver[q].fname} {$driver[q].lname}  - [ {$driver[q].drv_code} ]</option>
                      
            {/section}
              
                    </select></td>
                    <td align="left" valign="top"  class="labeltxt"><strong>Status:</strong></td>
                  <td align="left"><select  id="status" name="status">
                      <option value=""> All </option>
                      <!--<option value="9" {if $status eq '9'} selected="selected" {/if} >Pending</option>
                      <option value="5" {if $status eq '5'} selected="selected" {/if} >In Progress</option>-->
                      <option value="3" {if $status eq '3'} selected="selected" {/if} >Cancelled</option>
                      <!--<option value="2" {if $status eq '2'} selected="selected" {/if} >Rescheduled</option>-->
                      <option value="4" {if $status eq '4'} selected="selected" {/if} >Completed</option>
                      <!--<option value="8" {if $status eq '8'} selected="selected" {/if} >Not Going</option>-->
                      <option value="7" {if $status eq '7'} selected="selected" {/if} >No Show</option>
                    </select></td>
                  <!--<td align="left" valign="top" class="labeltxt"><strong><strong>Patient Name:</strong></strong></td>
                  <td align="left" valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div> </td>-->
                </tr>
                <tr> </tr>
                <tr>
                  
                <td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
             <td align="left" valign="top">
                <select name="hospname" class="required txt_boxX" id="hospname">
                      <option value=""> Select Account </option>
                      			  {section name=q loop=$hosp}	
                 <option value="{$hosp[q].id}" {if $hosp[q].id eq $hospname} selected="selected" {/if}>{$hosp[q].account_name} {$hosp[q].abrivation}  {$hosp[q].location}</option>
                      {/section}
                    </select>
              </td>
                </tr>
                <tr>
                                 <td></td> <td colspan="3" align="left" valign="top"><font style="color:#F00;">
                    <ol>
                    <li>  {if $totalRows neq ''}{/if}[ Total Trips : {$totalRows} ]&nbsp;&nbsp;&nbsp;{if $tmiles neq ''}{/if}[ Total Miles : {$tmiles} ]</li>
                    <li><!--[Pending: {$st9}] [In Progress: {$st5}] [Rescheduled: {$st2}] --> [Completed: {$st4}] [Cancelled: {$st3}] [No Show: {$st7}]</li>
                    </ol>
                    </font></td>
                </tr>
                <tr>
                  <td align="left" colspan="2" valign="top">&nbsp;</td>
                  <td colspan="2" align="left" valign="top">
                  {if $yes eq '1'}
                  <a href="javascript:popWind('lg_print.php?startdate={$stdate}&enddate={$enddate}&driver_id={$drv_id}&status={$status}&hospname={$hospname}')" ><input type="button" value='Print Report' class="inputButton btn"  /></a>
                    &nbsp;{/if}
                    <input type="hidden" value="{$logiticid}" name="logiticid"  />
                    {if $smarty.session.admuser.admin_level eq '0' || $smarty.session.adminpermission.mtmreports_cr eq 'on'}
                  <input type="submit" name="submit" id="submit" value='Show Report' class="inputButton btn"  />
                    &nbsp;
                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  />{/if}</td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr class="admintopheading">
                <!--<td width="5%" align="center"><strong>Trip #</strong></td>-->
                <td width="5%" align="center"><strong>Trip ID</strong></td>
                <td width="10%" align="center"><strong>Customer Name</strong></td>
                <!--<td width="4%" align="center"><strong>To/From</strong></td>-->
                <td width="10%" align="center"><strong>Scheduled</strong></td>
                <td width="10%" align="center"><strong>Actual Pickup</strong></td>
                <td width="10%" align="center"><strong>Actual Drop</strong></td>
                <td width="5%" align="center">Option</td>
              </tr>
              {section name=q loop=$data}
              {if $reqdetails[q].rows neq '0'}
              <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
                <!--<td align="center" valign="top">{$data[q].ccode}</td>-->
                <td align="center" valign="top">{$data[q].ccode}</td>
                <td align="center" valign="top">{$data[q].trip_user}</td>
                <!--<td align="center" valign="top">
                {if $data[q].type eq 'AB'}T{/if}
                {if $data[q].type eq 'BF'}F{/if}</td>-->
                <td align="center" valign="top">{if $data[q].pck_time eq '00:00:00'}--:--{else}{$data[q].pck_time|date_format:"%I:%M"} {$data[q].pck_time|date_format:"%p"}{/if}</td>
                <td align="center" valign="top">{if $data[q].aptime eq '00:00:00'}--:--{else}{$data[q].aptime|date_format:"%I:%M"} {$data[q].aptime|date_format:"%p"}{/if}</td>
                <td align="center" valign="top">{if $data[q].drp_atime eq '00:00:00'}--:--{else}{$data[q].drp_atime|date_format:"%I:%M"} {$data[q].drp_atime|date_format:"%p"}{/if}</td>
                <td align="center" valign="top"><a href="javascript:popWind('details.php?id={$data[q].tdid}');">View Detail</a></td>
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
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 