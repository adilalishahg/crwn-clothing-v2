{include file = includeinner.tpl}
{literal} 
<script>
   $(document).ready(function(){
    $('#adduser').validate();

 });
</script> 
{/literal}
<table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="admintopheading">Update Gas Receipt Information</td>
        </tr>
        <tr><td><hr/></td></tr>
        <tr>
          <td height="44" align="left"  valign="top" style="padding-bottom:50px;"><form name="edit" id="adduser" method="post" action="edit_receipt.php">
            <input type="hidden" name="id" value="{$id}" />
            <input type="hidden" name="startdate" value="{$startdate}" />
            <input type="hidden" name="enddate" value="{$enddate}" />
            <input type="hidden" name="reportby" value="{$reportby}" />
            <input type="hidden" name="driver_id" value="{$driver_id}" />
            <input type="hidden" name="veh_id" value="{$veh_id}" />
              <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
                <tr>
                  <td width="15%"><strong>Date</strong>(mm/dd/yyy)</td>
                  <td width="35%"><input type="text" name="uploadedon" id="uploadedon" value="{$receiptinfo.uploadedon|date_format:"%m/%d/%Y"}"  size="34" /></td>
                  <td width="15%"><strong>V.Crnt Mileage</strong></td>
                  <td width="35%"><input type="text" name="current_vehicle_milage" id="current_vehicle_milage" value="{$receiptinfo.current_vehicle_milage}" maxlength="12"  size="34"/></td>
                </tr>
                <tr><td colspan="4"></td></tr>
                <tr>
                  <td ><strong>Driver</strong></td>
                  <td > <select name="driver_code" style="width:255px">
                      <option value="">Select Driver</option>
            {section name=q loop = $driverdata}
                      <option value="{$driverdata[q].drv_code}" {if $driverdata[q].drv_code eq $receiptinfo.driver_code} selected{/if}>{$driverdata[q].fname} {$driverdata[q].lname}  - [ {$driverdata[q].drv_code} ]</option>
            {/section}
                    </select></td>
                  <td ><strong>Vehicle</strong></td>
                  <td ><select name="vehicle_id" style="width:255px">
                      <option value="">Select Vehicle</option>
            {section name=q loop = $vehicledata}
                      <option value="{$vehicledata[q].id}" {if $vehicledata[q].id eq $receiptinfo.vehicle_id} selected{/if}>{$vehicledata[q].vname} - [ {$vehicledata[q].vnumber} ]</option>
            {/section}
                    </select></td>
                </tr>
                                <tr><td colspan="4"></td></tr>
                        
               <tr>
                  <td ><strong>Total Gallon</strong></td>
                  <td ><input type="text" name="total_galon" id="total_galon" value="{$receiptinfo.total_galon}" maxlength="6"  size="34"/></td>
                  <td ><strong>Price Per Gallon ($)</strong></td>
                  <td ><input type="text" name="price_per_galon" id="price_per_galon" value="{$receiptinfo.price_per_galon}" maxlength="6"  size="34"/></td>
                </tr>                   
                  <tr><td colspan="4"><hr/><br/></td></tr>
               <tr>
                  <td colspan="4" align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="update" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" class="inputButton btn"></td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table>