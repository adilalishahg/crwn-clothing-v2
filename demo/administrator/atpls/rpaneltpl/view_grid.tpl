{literal} 
<script>

   $(document).ready(function(){

    $('#addgrid').validate();

		$("#phone").mask("999-99-9999");

  });

</script> 
{/literal}
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}
      
      { if $errors != ''} {$errors} {/if} </td>
  </tr>
  <tr>
    <td class="admintopheading">View Trip Details </td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
          <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
          <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
          <td align="left" valign="top" width="100%"><form name="addgrid" id="addgrid" method="post" action="editgrid.php" enctype="multipart/form-data" >
              <table width="750" border="0" cellspacing="2" cellpadding="2">
                
                <!--  <tr>
								    <td height="25" align="right" class="labeltxt">Trip Code: </td>
								    <td height="25">{$trip_code}</td>
							      </tr>-->
                <tr>
                  <td width="250" height="25" align="right" class="labeltxt">Patient Name: </td><td>&nbsp;&nbsp;</td>
                  <td width="486" height="25">{$cname}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Telephone:</td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$phone}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Pickup location: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$udata.0.picklocation}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Pickup Address: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$addr1}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Drop location: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$udata.0.droplocation}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Drop Address: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$drpadd}</td>
                </tr>
                <br>
                <tr>
                  <td height="25" align="right" class="labeltxt">Trip Assign Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$udata.0.tripassign_time|date_format:"%H:%M:%S"} [ {$udata.0.tripassign_time|date_format} ]</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Driver Confirmation Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$udata.0.driverconfirm_time|date_format:"%H:%M:%S"}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Driver Arrival Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$udata.0.arrived_time|date_format:"%H:%M:%S"}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Waiting Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$waitingtime}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Scheduled Pickup Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{if $wc eq '1'} Will Call {else}{$ptime}{/if}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Actual Pickup Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$aptime}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Estimated Drop Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$dtime}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Actual Drop Time: </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$adtime}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Miles:</td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$m1}</td>
                </tr>
                
                <tr>
                  <td height="25" align="right" class="labeltxt">Remarks:</td><td>&nbsp;&nbsp;</td>
                  <td height="25">{$remarks}</td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Status:</td><td>&nbsp;&nbsp;</td>
                  <td height="25"> {if $status eq '4'}
                    Completed
                    {elseif $status eq '1'}
                    Completed
                    {elseif $status eq '3'}
                    Cancelled
                    {elseif $status eq '5'}
                    Scheduled
                    {elseif $status eq '2'}
                    Rescheduled
                    {elseif $status eq '6'}
                    Picked Up
                    {elseif $status eq '7'}
                    Billable No-Show   
                    {elseif $status eq '8'}
                    non-Billable No-Show
                    {elseif $status eq '10'}
                    Arrived  {else}
                    Scheduled
                    {/if} </td>
                </tr>
                <tr>
                  <td height="25" align="right"> {if $udata[0].status=='3'}Cancelled Time:{/if}
                    {if $udata[0].status=='7' || $udata[0].status=='8'}No Show Time:{/if} </td><td>&nbsp;&nbsp;</td>
                  <td height="25">{if $udata[0].status=='7' || $udata[0].status=='8'  || $udata[0].status=='3'}{$udata.0.ac_noshowcancell}{/if}</td>
                </tr>
              </table>
              <input type="hidden" value="{$tripid}" name="tripid" id="tripid">
              <input type="hidden" value="{$id}" name="id" id="id">
            </form></td>
          <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
          <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
          <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
        </tr>
      </table></td>
  </tr>
</table>
