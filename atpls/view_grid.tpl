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
    <td class="admintopheading" style="text-align:center; background-color:#00F; color:#FFF">View Trip Details </td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
        
        <tr>
          <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
          <td align="left" valign="top" width="100%"><form name="addgrid" id="addgrid" method="post" action="editgrid.php" enctype="multipart/form-data" >
              <table width="750" border="0" cellspacing="2" cellpadding="2">
                
              
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
                     No-Show   
                    {elseif $status eq '8'}
                     No-Show
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
     </table></td>
  </tr>
</table>
