<link rel="stylesheet" href="../theme/style.css" type="text/css">
{include file = includeinner.tpl}
{literal} 
<script>
   $(document).ready(function(){
    $('#adduser').validate();
  });
</script> 
<style type="text/css">
#printable {
	display: block;
}
 @media print {
#non-printable {
	display: none;
}
#printable {
	display: block;
}
}
</style>

{/literal}
<div align="left">
  <!----><div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a>&nbsp;&nbsp;&nbsp;</div>
  <div align="center" id="printable">
    <table width="100%" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
                 <tr>
              <td height="25" colspan="4" class="admintopheading">Clock In/Out Information [{$date|date_format}]</td>
            </tr>
           <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Clock In Time<!-- [Date]--></strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Clock Out Time</strong></td>
                <td width="6%" align="center" class="label_txt_heading"><strong>Duration</strong></td>
              </tr>
              <form action="" method="post" id="adduser" >
              {section name=q loop = $data}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td height="25" align="center" valign="middle"><b>{$smarty.section.q.iteration}.<input type="hidden" name="atid[]" value="{$data[q].id}"  /></b></td>
                <td align="center" valign="middle"><input type="text" value="{$data[q].clockin|date_format:"%H:%M"}" class="clin" name="clockin[]"  maxlength="5" />&nbsp; HH:MM </td>
                <td align="center" valign="middle"><input type="text" value="{if $data[q].clockstatus eq 'in'}--:--{else}{$data[q].clockout|date_format:"%H:%M"}{/if}" name="clockout[]"  maxlength="5"  class="clout"/>&nbsp; HH:MM</td>
                <td align="center" valign="middle">{$data[q].duration1}</td>
              </tr>
             {sectionelse}
             
             <tr>
                <td colspan="4" align="center"><b><!--No Record Found--></b></td>
              </tr>
              {/section}
             <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td height="25" align="center" valign="middle" colspan="3"><b>Total Time</b></td>
                <td align="center" valign="middle">{$totalduration}</td>
              </tr>
             
             {if $date eq $today && $driversdata.clockstatus eq 'in'}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}" >
              <td height="25" align="center" valign="middle"><b></td>
              <td align="center" valign="middle" colspan="3" style="color:#F00; font-size:14px;">Last Clock In Time: <input type="text" value="{$driversdata.clockin|date_format:"%H:%M"}" id="drclockin" name="drclockin"  maxlength="5" />&nbsp; HH:MM </td>
              </tr>
             {/if}
             
             
              
              
              
              <tr><td><input type="hidden" name="date" value="{$date}"  />
              <input type="hidden" name="id" value="{$id}"  />
              <input type="hidden" name="date2" value="{$date}"  />
              <input type="hidden" name="clockstatus" value="{$driversdata.clockstatus}"  /></td><td></td><td  >
              <input type="submit" name="updatetimes" value=" Update " class="btn"  />
             </form></td></tr>
           
    </table>
  </div>
</div>