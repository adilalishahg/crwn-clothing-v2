{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#addPage").validationEngine();
	$("#free_from").mask("24:59:59");
});
function checkspace(){
	var pg = $("#pgName").val();
	var trimpg = jQuery.trim(pg);
	if(trimpg.indexOf(' ') != -1){
		alert("Space is not allowed in page name!");
		event.returnValue = false;
		return false;
	}	
}
</script>
{/literal}
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="admintopheading"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td width="17" align="left"><img src="../images/1.jpg" width="17" height="17" /></td>
          <td align="left" background="../images/2.jpg"></td>
          <td width="17" align="left"><img src="../images/3.jpg" width="17" height="17" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
          <td align="left" valign="top" width="100%"><form name="addPage" id="addPage" method="post" action="selectdrivers.php" enctype="multipart/form-data" onsubmit="javascript:checkspace();" >
              <table width="650" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td height="25" class="labeltxt" align="right">&nbsp;</td>
                  <td height="25" align="right" class="labeltxt">Press 'Esc' to Close </td>
                </tr>
                <tr>
      <td colspan="2" height="25" align="center" class="labeltxt"><strong>
	  Check required drivers and select their start location
	  </strong></td>
                  </tr>
				  <tr>
      <td height="25" align="center" class="labeltxt"><strong>
	 Day Start Time:
	  </strong></td><td><input type="text" name="free_from" value="{$starttime}" id="free_from"  /> HH:MM:SS</td>
                  </tr>
				  <tr>
      <td colspan="2" height="25" align="center" class="labeltxt"><strong>
	 
	  </strong></td>
                  </tr>
				  
				  {section name=q loop=$driverdata}
				<tr><!--checked="checked"-->
                  <td height="25" align="left" class="labeltxt" {if $driverdata[q].selected eq 'yes'}  style="color:#999;"  {/if}><input type="checkbox" name="att[{math equation="(x-1)"  x=$smarty.section.q.iteration}]" {if $driverdata[q].selected eq 'yes'} disabled="disabled"  {/if} />&nbsp;&nbsp;<strong>{$driverdata[q].fname} {$driverdata[q].lname} [{$driverdata[q].drv_code}]</strong></td>
                  <td height="25"><select name="loc[]" >
				  <option value="{$corpo_latlong}" {if $setupdata.start_location eq 'office'} selected="selected" {/if} >From Office</option>
				  <option value="{$driverdata[q].addr},{$driverdata[q].city},{$driverdata[q].state} {$driverdata[q].zip}" {if $setupdata.start_location eq 'home'} selected="selected" {/if} >From Home</option></select>
				  <input type="hidden" name="drv_code[]" value="{$driverdata[q].drv_code}" /></td>
                </tr>{/section}
				
                <tr>
                  <td width="40%" height="25" align="right" class="labeltxt"></td>
                  <td width="60%" height="25"></td>
                </tr>
                <tr>
                  <td height="25">&nbsp;</td>
                  <td height="25"><input type="submit" value=" Update Drivers " name="add" class="btn"/>
                  <input type="hidden" name="date" value="{$date}"  />
                    <input type="reset" value="Reset" name="reset" class="btn" onclick="$.validationEngine.closePrompt('.formError',true)" />
                  </td>
                </tr>
              </table>
            </form></td>
          <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>
          <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
          <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
        </tr>
      </table></td>
  </tr>
</table>
