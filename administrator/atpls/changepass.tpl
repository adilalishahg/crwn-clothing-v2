{ include file = mainhead.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#changepass").validationEngine()
});
</script>
{/literal}
<form name="changepass" id="changepass" action="changepass.php" method="post">
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
	<tr>
	
		<tr>
 			<td height="19" colspan="3" align="right" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]</td>
	</tr>
	
	
	
		<td colspan="20">
			<table width="100%"  align="center" height="53" cellpadding="2" cellspacing="2">
 			{ if $msgs != '' or $errors!= ''} 
            <tr>
			   <td height="19" class="okmsg" colspan="2" align="center" style="color:#FF0000; font-weight:bold;">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
             {/if}
			 <tr>
			   <td height="19" class="admintopheading" colspan="2" align="center"> CHANGE PASSWORD </td>			
			 </tr> 
			 <tr>
			   <td width="47%" align="right" class="add_titles"><span class="gutt_textheading"><strong>Old Password :<span style="color:#FF0000">*</span></strong></span></td>
			   <td  width="53%" align="left"><input type="password" name="adminOldpass" id="adminOldpass" class="validate[required] textfield" /></td>
			  </tr>	
			<tr>
			  <td align="right" class="add_titles"><span class="gutt_textheading"><strong>New Password :<span style="color:#FF0000">*</span></strong></span></td>
				<td align="left"><input type="password" name="adminpass1" id="adminpass1" class="validate[required] textfield" /></td>
			  </tr>	
			<tr>
			  <td width="47%" align="right" class="add_titles"><strong><span class="gutt_textheading">Re-type Password</span>:<span style="color:#FF0000">*</span> </strong></td>
			  <td width="53%" align="left"><input type="password" name="adminpass2" id="adminpass2" class="validate[required,confirm[adminpass1]] textfield" /></td>
		      </tr>	
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submitAdmin" value="Update" class="btn"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = footer.tpl}