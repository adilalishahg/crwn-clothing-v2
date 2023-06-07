{include file = mainhead.tpl}
{literal}
<script type="text/javascript">

$(document).ready(function() {
	$("#live").validate()
});
</script>
{/literal}
<form name="live" id="live" action="live.php" method="post" >
<table cellpadding="0" align="center" bgcolor="#FFFFFF"  cellspacing="0" width="400">
	<tr>
	
	<tr>
 		<td height="19" colspan="3" align="right">[<a href="javascript:history.back();">Back</a>]</td>
	</tr>
	
	
	
	
		<td colspan="20" valign="top">
			<table width="100%"  align="center" height="53" cellpadding="2" cellspacing="2"  class="main_table" >
 			{ if $msgs != '' or $errors != ''} <tr>
			   <td height="19" class="okmsg" colspan="2" align="center">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
             {/if}
			 <tr>
			   <td height="19" class="admintopheading" colspan="2" align="center"> LIVE SUPPORT</td>			
			 </tr> 
			 <tr>
			   <td width="35%" align="right" class="add_titles">Status :</td>
				<td width="65%" align="left"><select name="status" id="status" class="required">
                <option value="">--Select--</option>
                <option value="online" {if $st eq 'online'}selected{/if}>Online</option>
                <option value="offline" {if $st eq 'offline'}selected{/if}>Offline</option>
                </select>				  <!--*used for login--> </td>
			  </tr>	
			<tr>
			  <td>&nbsp;</td>
				<td align="left"><input type="submit" name="submitAdmin" value="Update" class="btn"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = footer.tpl}