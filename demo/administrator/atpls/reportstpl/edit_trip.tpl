{include file = headerinner.tpl}
<link href="../theme/style.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">
$(document).ready(function(){	
$("#tripdate").datepicker();
$("#tripassign_time").mask("29:59:59");
$("#driverconfirm_time").mask("29:59:59");
$("#arrived_time").mask("29:59:59");
$("#pck_time").mask("29:59:59");
$("#aptime").mask("29:59:59");
$("#drp_time").mask("29:59:59");
$("#drp_atime").mask("29:59:59");

//$("#drp_time").mask("24:59:59");

});
</script>
{/literal}
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="ar" id="ar" method="post" action="edit_trip.php">
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
           
            <tr>
              <td height="25" colspan="4" class="admintopheading">Update Trip Information</td>
            </tr>

	<tr><td height="25"  align="left" class="labeltxt">Schedule Date: </td>
              <td height="25"  align="left" class="labeltxt"><input type="text" name="date" id="tripdate" value="{$dt.date}"  /></td>
              <td height="25"  align="left" class="labeltxt">Trip Assign Time: </td>
              <td height="25"  align="left" class="labeltxt">
              <input type="text" name="tripassign_time" id="tripassign_time" value="{$dt.tripassign_time|date_format:"%H:%M:%S"}" />
              <input type="hidden" name="tripassign_date" id="tripassign_date" value="{$dt.tripassign_time|date_format:"%Y-%m-%d"}" /></td>
              
            </tr>
            <tr>
            <td height="25"  align="left" class="labeltxt">Driver Confirmation Time: </td>
              <td height="25"  align="left" class="labeltxt">
              <input type="text" name="driverconfirm_time" id="driverconfirm_time" value="{$dt.driverconfirm_time|date_format:"%H:%M:%S"}"  />
              <input type="hidden" name="driverconfirm_date" id="driverconfirm_date" value="{$dt.driverconfirm_time|date_format:"%Y-%m-%d"}" /></td>
              <td height="25"  align="left" class="labeltxt">Driver Arrival Time: </td>
              <td height="25"  align="left" class="labeltxt">
              <input type="text" name="arrived_time" id="arrived_time" value="{$dt.arrived_time|date_format:"%H:%M:%S"}" />
              <input type="hidden" name="arrived_date" id="arrived_date" value="{$dt.arrived_time|date_format:"%Y-%m-%d"}" /></td>
              
              </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt">Schedule Time: </td>
              <td height="25"  align="left" class="labeltxt"><input type="text" name="pck_time" id="pck_time" value="{$dt.pck_time}"  /></td>
              <td height="25"  align="left" class="labeltxt">Actual Picked Time: </td>
              <td height="25"  align="left" class="labeltxt"><input type="text" name="aptime" id="aptime" value="{$dt.aptime}"  /></td>
            </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt">Drop Time: </td>
              <td height="25"   align="left" class="labeltxt"><input type="text" name="drp_time" id="drp_time" value="{$dt.drp_time}" /></td>
              <td height="25"   align="left" class="labeltxt">Actual Dropped Time: </td>
              <td height="25"  align="left" class="labeltxt"><input type="text" name="drp_atime" id="drp_atime" value="{$dt.drp_atime}" /></td>
            </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt">Driver:</td>
              <td height="25"   align="left" class="labeltxt"><select name="driver_id" id="driver">
                      <option value="">Select Driver</option>                      
            {section name=q loop = $driver}                
                      <option value="{$driver[q].drv_code}" {if $driver[q].drv_code eq $dt.drv_id} selected{/if}>{$driver[q].fname} {$driver[q].lname}  - [ {$driver[q].drv_code} ]</option>
                      
            {/section}
              
                    </select></td>
            
              <td height="25"   align="left" class="labeltxt">Trip Status:</td>
              <td height="25"   align="left" class="labeltxt" ><select name="status" id="status" style="width:150px;" >
                 		 <option value="9" 	{if $dt.status eq '9'} selected="selected"{/if}>Pending</option>
                          <option value="5" {if $dt.status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="10"{if $dt.status eq '10'} selected="selected"{/if}>Arrived</option>
                          <option value="6" {if $dt.status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="4" {if $dt.status eq '4'} selected="selected"{/if}>Dropped</option>
                          <option value="1" {if $dt.status eq '1'} selected="selected"{/if}>Dropped</option>
                          <option value="3" {if $dt.status eq '3'} selected="selected"{/if}>Cancelled</option>
                          <option value="7" {if $dt.status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          <option value="8" {if $dt.status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
					 </select></td>
           </tr>
           <tr> 
			   <td  align="left" valign="top" class="labeltxt"><strong></strong>&nbsp;&nbsp;</td>
              <td   align="left"></td>
              <td  align="left" valign="top" class="labeltxt"><br/><strong>
              <input type="submit" name="submit" value="Update Information" style="background-color: #0397ff;
border: 1px solid #06447d;
font-family: verdana;
height: 20px;
font-size: 13px;
font-weight: bold;
color: #FFF;
vertical-align: middle;
padding-bottom: 4px;
cursor: pointer;"  /></strong>&nbsp;&nbsp;<input type="hidden" name="tdid" value="{$dt.tdid}" />
											<input type="hidden" name="trip_id" value="{$dt.trip_id}" /></td>
              <td  align="left"></td>
            </tr>
          </table>
      </form></td>
  </tr>
 
</table>
<!--<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>-->
<script>
$('#wait_time').mask('29:59:59');
</script>
{ include file = innerfooter.tpl}