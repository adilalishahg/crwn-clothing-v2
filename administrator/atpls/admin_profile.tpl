{ include file = mainhead.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#adminprof").validationEngine();
});
</script>
{/literal}
<form name="adminprof" id="adminprof" action="admin_profile.php" method="post">
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
	<tr>
	<tr>
 			   <td height="19" colspan="3" align="right" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]</td>
    </tr>
		<td colspan="20" valign="top">
			<table width="100%"  align="center" height="53" border="0" cellpadding="2" cellspacing="2">
 			 { if $msgs != '' or $errors != ''}
 			 <tr>
			   <td height="19" class="okmsg" colspan="2" align="center" style="color:#FF0000; font-weight:bold;">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
             {/if}
			 <tr>
			   <td height="19" class="admintopheading" colspan="3" align="center"> MANAGE ADMIN PROFILE </td>			
			 </tr> 
			 <tr>
			   <td class="add_titles" width="47%" align="right">Admin Username:</td>
			   <td  width="53%" align="left"><input name="admin_user" type="text" class="validate[required,custom[noSpecialCaracters],length[0,50]]" id="admin_user" value="{$admin_user}" maxlength="50">
			   <span style="color:#F00">*</span></td>
			  </tr>	
			<tr>
			  <td align="right" class="add_titles">Admin Name: </td>
			  <td align="left"><input name="admin_name" type="text" class="validate[required,custom[onlyLetter],length[0,50]]" id="admin_name" value="{$admin_name}" maxlength="50">
			  <span style="color:#F00">*</span></td>
			  </tr>	
			
			<tr>
			  
				<td colspan="2" align="center" style="padding-left:50px"><input type="submit" name="submitAdmin" value="Update" class="btn">&nbsp;<input type="reset" name="reset" value=" Reset " class="btn"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = footer.tpl}