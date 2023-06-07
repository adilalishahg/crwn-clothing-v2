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
          <td height="19" align="center" class="admintopheading">Update Timing Info For [ {$driver.fname} {$driver.lname} ]</td>
        </tr>
        <tr><td><hr/></td></tr>
        <tr>
          <td height="44" align="left"  valign="top" style="padding-bottom:50px;"><form name="edit" id="adduser" method="post" action="edit.php"> <input type="hidden" name="id" value="{$id}" />
            <input type="hidden" name="drvid" value="{$drvid}" />
            <input type="hidden" name="startdate" value="{$startdate}" />
            <input type="hidden" name="enddate" value="{$enddate}" />
            <input type="hidden" name="drv_id" value="{$drv_id}" />
            <input type="hidden" name="dated" value="{$dated}" />
              <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
                <tr>
                  <td class="admintopheading">Day</td>
                  <td class="admintopheading">Clock In</td>
                  <td class="admintopheading">Clock Out</td>
                  <!--<td class="admintopheading">Total Time</td>
                  <td class="admintopheading">Over Time</td> -->                  
                </tr>
                  <tr><td></td></tr>
                <tr>
                  <td ><select name="dayonoff" ><option value="on" {if $data.dayonoff eq 'on'} selected="selected" {/if} >On</option><option value="off" {if $data.dayonoff eq 'off'} selected="selected" {/if} >Off</option></select></td>
                  <td ><input size="10" class="required" name="clockin" id="in" value="{$data.clockin|date_format:"%H:%M"}"  />HH:MM</td>
                  <td ><input size="10" class="required" name="clockout" id="out" value="{$data.clockout|date_format:"%H:%M"}"  />HH:MM</td>
                 <!-- <td ><input size="10" name="total_time" value="{$data.total_time}"  />HH:MM</td>
                  <td ><input size="10" name="over_time" value="{$data.over_time}"  />HH:MM</td>-->
                </tr>
                  <tr><td colspan="3"><hr/><br/></td></tr>
               <tr>
                  <td colspan="3" align="center">&nbsp;&nbsp;&nbsp;<input type="submit" name="timein" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" class="inputButton btn"></td>
                </tr>
              </table>
            </form></td>
        </tr>
        
      </table>
