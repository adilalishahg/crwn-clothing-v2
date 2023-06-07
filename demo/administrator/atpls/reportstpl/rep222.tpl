{ include file = headerinner.tpl}
{literal} 
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
						   $('#searchReport').validate();
						   $('#hosp').attr('disabled', true);
						   });

$(document).ready(function(){	
$("#startdate").datepicker( {maxDate: '-1', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {maxDate: '-1', dateFormat: 'mm/dd/yy'} );
});

</script> 
<style >
 { text-transform: lowercase; }  
</style>
{/literal}
<table  border="0" cellspacing="0" cellpadding="0" class="outer_table" align="right" bgcolor="#FFFFFF" >
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        { if $errors != '' || $msgs != ''}
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</span></td>
        </tr>
        {/if}
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> {if $noReq neq '0'}
              [<a href="javascript:history.back();">Back</a>]{/if}</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading"> PDF Export</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="rep222.php" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
                <tr>
                  <td  align="left" valign="top" class="labeltxt"><strong>Start Date:</strong></td>
                  <td  align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$stdate}" class="required" size="10"/> </td>
                  <td  align="left" valign="top" class="labeltxt"><strong>End Date:</strong></td>
                  <td><input type="text" name="enddate" id="enddate" value="{$enddate}" class="required" size="10"/>
                    <!--(mm/dd/yyyy)--></td>
                   <td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
                  <td align="left" valign="top"><select name="hospname" class=" txt_boxX required" id="hospname"  >
                      <option value=""> Select </option>
                      			  {section name=q loop=$hosp}	
                   <option value="{$hosp[q].id}" {if $hosp[q].id eq $hospname} selected="selected" {/if}>{$hosp[q].account_name}</option>
                      {/section}
                    </select></td> 
                 <td align="left"  class="labeltxt" valign="top"><strong>Patient:</strong>&nbsp;</td>
                  <td align="left" valign="top"><select name="trip_user" class=" txt_boxX " id="trip_user"  >
                      <option value=""> Select </option>
                      
                      			  {section name=q loop=$pdata}	
                 
                      <option value="{$pdata[q].name}" {if $pdata[q].name eq $trip_user} selected="selected" {/if}>{$pdata[q].name}</option>
                      
                      {/section}
                    
                    </select></td> 
                     
                    <td  align="left"  valign="top" class="labeltxt"><strong>Driver:</strong></td>
                  <td align="left" valign="top"><select name="driver_id" id="driver" class="">
                      <option value="">Select Driver</option>
                      
            {section name=q loop = $driver}
       <option value="{$driver[q].drv_code}" {if $driver[q].drv_code eq $driver_id} selected{/if}>{$driver[q].fname} {$driver[q].lname}  - [ {$driver[q].drv_code} ]</option>
            {/section}
                                       </select></td>
                </td>
                </tr>
                <tr ><td colspan="5"></td><td colspan="4">
                    <input type="submit" name="submit2" id="submit2" value='Generate PDF' class="inputButton btn"  /></td></tr>
              </table>
            </form></td>
        </tr>
        <!--<tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr class="admintopheading">
                <td width="1%" align="center"><strong>#</strong></td>
                <td width="4%" align="center"><strong>Date</strong></td>
                <td width="8%" align="center"><strong>Patient Name</strong></td>
                <td width="8%" align="center"><strong>Driver Name</strong></td>
                <td width="14%" align="center"><strong>Pick <br/>
                  Drop Address</strong></td>
                <td width="6%" align="center"><strong>Actual Pick/<br/>
                  Drop Time</strong></td>
                <td width="4%" align="center"><strong>Type</strong></td>
                <td width="6%" align="center"><strong>Trip Status</strong></td>
                <td width="4%" align="center"><strong>Miles</strong></td>
                <td width="6%" align="center"><strong>Amount</strong></td>
              </tr>
              {section name=q loop=$trips}
              <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
                <td align="center" valign="top">{$smarty.section.q.iteration}</td>
                <td align="center" valign="top">{$trips[q].date|date_format:"%m/%d/%Y"} </td>
                <td align="center" valign="top">{$trips[q].trip_user}</td>
                <td align="center" valign="top">{$trips[q].fname} {$trips[q].lname}</td>
                <td align="center" valign="top">{$trips[q].pck_add}<br/>
                  {$trips[q].drp_add}</td>
                <td align="center" valign="top">{$trips[q].aptime}<br/>
                  {$trips[q].drp_atime}</td>
                <td align="center" valign="top">{$trips[q].com_type}</td>
                <td align="center" valign="top">{$trips[q].status}</td>
                <td align="center" valign="top">{$trips[q].trip_miles}</td>
                <td align="center" valign="top">$ {$trips[q].com_ch}</td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="10" align="center" ><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>-->
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 