{include file = mainhead.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#phone").mask("(***) ***-****");
	$("#fax").mask("(***) ***-****");
	$("#add_user").validationEngine();
});
$(document).ready(function() {
	$("#ts,#te").mask("29:59:59");
});
</script>
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">Setup Basic Setting</td>
                            </tr>
                            <tr>
<td height="19" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
						  <form name="add_user" id="add_user" method="post" action="" enctype="multipart/form-data">
	  <table width="90%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#FF0000" style="font-weight:bold">{$msgs}</font>{/if}</td>
        </tr>       
        <tr>
          <td colspan="3" align="center" valign="top">
          <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="images/1.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="images/3.jpg" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="images/4.jpg">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Day Start Time: </strong></td><td>	
<input type="text" name="starttime" value="{$udata2.starttime}" id="ts" maxlength="8"  /></td>
</tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Select Driver: </strong></td><td>	
<input type="radio" name="select_all_dv" value="yes" {if $udata.select_all_dv eq 'yes'} checked="checked" {/if} />All 
<input type="radio" name="select_all_dv" value="no" {if $udata.select_all_dv eq 'no'} checked="checked" {/if} />Desirable</td>
</tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Start Location: </strong></td><td>	
<select name="start_location" >
				  <option {if $udata.start_location eq 'office'} selected="selected" {/if} value="office" >From Office</option>
				  <option {if $udata.start_location eq 'home'} selected="selected" {/if} value="home" >From Home</option></select>
				  </td>
</tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Enable Multiple Run &amp; Route to Same Distination: </strong></td><td>	
<input type="radio" name="multi_run_same_loc" value="yes" {if $udata.multi_run_same_loc eq 'yes'} checked="checked" {/if} />Yes 
<input type="radio" name="multi_run_same_loc" value="no" {if $udata.multi_run_same_loc eq 'no'} checked="checked" {/if} />No</td>
</tr>

<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Enable Multiple Run &amp; Route to Different Distination:</strong> </td><td>	
<input type="radio" name="multi_run_diff_loc" value="yes" {if $udata.multi_run_diff_loc eq 'yes'} checked="checked" {/if} />Yes 
<input type="radio" name="multi_run_diff_loc" value="no" {if $udata.multi_run_diff_loc eq 'no'} checked="checked" {/if} />No</td>
</tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Consider Live Trafic Google API:</strong> </td><td>	
<input type="radio" name="live_trafic_ip" value="yes" {if $udata.live_trafic_ip eq 'yes'} checked="checked" {/if} />Yes 
<input type="radio" name="live_trafic_ip" value="no" {if $udata.live_trafic_ip eq 'no'} checked="checked" {/if} />No</td>
</tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Time Cap Window: </strong></td><td>	
<input type="text" name="time_cap_window" value="{$udata.time_cap_window}" maxlength="2" size="3"  /> Time in Minutes</td>
</tr>
<tr>
<td height="25" align="left" class="labeltxt adjust"><strong>Mile Cap Window:</strong> </td><td>	
<input type="text" name="mile_cap_window" value="{$udata.mile_cap_window}" maxlength="2" size="3"  /></td>
</tr>

</table>		</td>
        <td align="left" valign="top" background="images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="images/6.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table>    	</td>
        </tr>
        <tr>
          <td width="48" align="right" valign="top">&nbsp;</td>
          <td width="532" colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="center" valign="top">
		  <input type="submit" name="add_user" id="add_user" value="Update Setting" class="btn" />
		  <input type="reset" name="reset" id="reset" value="   Reset   " class="btn"  />
 </td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
		<tr>
		  <td colspan="3"><!--  CONTENT DETAIL --></td>
		</tr>
      </table>
	      </form>							  </td>
            </tr>
			<tr>
			   <td>&nbsp;</td>
			</tr>			
      </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}