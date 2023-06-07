
{include file = headerinner.tpl}
<meta http-equiv="refresh" content="30">
{literal} 
<script type="text/javascript">
$(document).ready(function(){
	$('#searchReport').validationEngine();
  });
function clockinout(id,option){ //alert(id);
	 $.post("timeinout.php", {id: ""+id,option: ""+option}, function(data){ //alert(data);
	 if(data.length > 0 ){  location.reload();
		 }});
	}
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="admintopheading">CLOCK IN/OUT MANAGEMENT [ {$today|date_format} ]</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr>
                <!--<td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>-->
                <td width="20%" class="label_txt_heading"><strong>Driver Name</strong></td>
                <td width="8%" class="label_txt_heading"><strong>Driver Code</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Date</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Clock In Time<!-- [Date]--></strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Clock Out Time</strong></td>
                <td width="6%" align="center" class="label_txt_heading"><strong>Status</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Option</strong></td>
              </tr>
              {section name=q loop = $data}
              {if $data[q].clockstatus eq 'in'}
              <tr bgcolor="{cycle values="#d0d0d0"}">
                <!--<td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>-->
                <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$data[q].fname} {$data[q].lname}</td>
                <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$data[q].drv_code}</td>
                <td align="center" valign="middle">{$date|date_format}</td>
                <td align="center" valign="middle">
                {if $data[q].clockin neq '0000-00-00 00:00:00'}
                {if $data[q].clockin|date_format:"%Y-%m-%d" eq $today} {$data[q].clockin|date_format:"%H:%M"}{else}
                <span style="color:#F00; font-weight:bold;">{$data[q].clockin|date_format}  &nbsp;&nbsp;&nbsp;&nbsp;{$data[q].clockin|date_format:"%H:%M"}</span>{/if}
                {else}--:--{/if}<!-- [{$data[q].clockin|date_format:"%m/%d/%Y"}]--></td>
                <td align="center" valign="middle">
                {if $data[q].clockstatus eq 'in' || $data[q].clockout eq '0000-00-00 00:00:00' || $data[q].clockout|date_format:"%Y-%m-%d" neq $today}--:--{else} {$data[q].clockout|date_format:"%H:%M"}{/if}</td>
                <td align="center" valign="middle">{if $data[q].clockstatus eq 'in'}<span style="color:#063; font-weight:bold;">Clock In</span>{else}<span style="color:#F00; font-weight:bold;">Clock Out</span>{/if}</td>
                <td align="center" valign="top">{if $data[q].clockstatus eq 'out'} <a href="#" onclick="clockinout('{$data[q].Drvid}','in')" > <img src="../graphics/clockin.png" height="20px" width="20px" /></a>{else}<a href="#" onclick="clockinout('{$data[q].Drvid}','out')" > <img src="../graphics/clockout.png" height="20px" width="20px" /></a>{/if} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="javascript:popWind('details.php?id={$data[q].Drvid}&date={$date}');">Detail</a></td>
              </tr>
              {/if}
              {/section}
              <tr><td colspan="8"><hr/></td></tr>
              <tr><td colspan="8"><hr/></td></tr>
              <tr><td colspan="8"><hr/></td></tr>
              {section name=q loop = $data}
              {if $data[q].clockstatus eq 'out'}
              <tr bgcolor="{cycle values="#eeeeee"}">
                <!--<td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>-->
                <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$data[q].fname} {$data[q].lname}</td>
                <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$data[q].drv_code}</td>
                <td align="center" valign="middle">{$date|date_format}</td>
                <td align="center" valign="middle">
                {if $data[q].clockin neq '0000-00-00 00:00:00'}
                {if $data[q].clockin|date_format:"%Y-%m-%d" eq $today} {$data[q].clockin|date_format:"%H:%M"}{else}
                <span style="color:#F00; font-weight:bold;">{$data[q].clockin|date_format}  &nbsp;&nbsp;&nbsp;&nbsp;{$data[q].clockin|date_format:"%H:%M"}</span>{/if}
                {else}--:--{/if}<!-- [{$data[q].clockin|date_format:"%m/%d/%Y"}]--></td>
                <td align="center" valign="middle">
                {if $data[q].clockout eq '0000-00-00 00:00:00' }--:--{else}
                {if $data[q].clockout|date_format:"%Y-%m-%d" eq $today} {$data[q].clockout|date_format:"%H:%M"}{else}
                {$data[q].clockout|date_format}  &nbsp;&nbsp;&nbsp;&nbsp;{$data[q].clockout|date_format:"%H:%M"}{/if}{/if}</td>
                <td align="center" valign="middle">{if $data[q].clockstatus eq 'in'}<span style="color:#063; font-weight:bold;">Clock In</span>{else}<span style="color:#F00; font-weight:bold;">Clock Out</span>{/if}</td>
                <td align="center" valign="top">{if $data[q].clockstatus eq 'out'} <a href="#" onclick="clockinout('{$data[q].Drvid}','in')" > <img src="../graphics/clockin.png" height="20px" width="20px" /></a>{else}<a href="#" onclick="clockinout('{$data[q].Drvid}','out')" > <img src="../graphics/clockout.png" height="20px" width="20px" /></a>{/if} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="javascript:popWind('details.php?id={$data[q].Drvid}&date={$date}');">Detail</a></td>
              </tr>
              {/if}
              {/section}
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 