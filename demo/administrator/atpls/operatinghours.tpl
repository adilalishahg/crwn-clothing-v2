{ include file = mainhead.tpl}
{literal} 
<script type="text/javascript">

$(document).ready(function() {
	$("#ts,#te").mask("29:59:59");
});
function uptime(){ //alert(id);
var ts = $("#ts").val(); var te = $("#te").val();
$.post("operatinghours.php", {ts: ""+ts,te: ""+te}, function(data){ if(data.length>0){ alert("Operating Hours Updated Successfully.");  }});
}
</script> 
{/literal}
  <table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
    <tr>
    <tr>
      <td height="19" colspan="3" align="right" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]</td>
    </tr>
    
      <td colspan="20" valign="top"><table width="100%"  align="center" height="53" cellpadding="2" cellspacing="2" >
          <tr>
            <td height="19" class="okmsg" colspan="2" align="center" style="color:#FF0000; font-weight:bold;"> </td>
          </tr>
          <tr>
            <td height="19" class="admintopheading" colspan="2" align="center">MANAGE OPERATING HOURS</td>
          </tr>
          <tr>
            <td width="100%" colspan="2"><table width="100%" border="0">
  <tr>

    <td class="admintopheading">&nbsp;Day Start Time</td>
    <td class="admintopheading">&nbsp;Day End Time</td>
    <td class="admintopheading">&nbsp;Options</td>
  </tr>
  
  <tr>
    <td>&nbsp;<input type="text" value="{$timing.0.starttime}" id="ts" maxlength="8"  /></td>
    <td>&nbsp;<input type="text" value="{$timing.0.endtime}" id="te"  maxlength="8"/></td>
    <td>&nbsp;<input type="button" class="btn" value="Update Timing" onclick="uptime();"  /></td>
  </tr>
</table>
</td>
          </tr>
      </table></td>
    </tr>
  </table>
{ include file = footer.tpl}