{ include file = mainhead.tpl}
<form name="adminprof" action="admin_profile.php" method="post" onSubmit="return admin_prof();">
<table cellpadding="0" align="center" bgcolor="#FFFFFF"  cellspacing="0" width="1010">
	<tr>
		<td colspan="20" valign="top" style="padding-top:80px;">
			<table width="80%"  align="center" height="53" cellpadding="2" cellspacing="2"  class="main_table" >
 			 <tr>
			   <td height="19" class="okmsg" colspan="3" align="center">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}
			   </td>
			 </tr>
			 <tr>
			   <td height="19" class="admintopheading" colspan="3" align="center">Edit 	Admin Profile </td>			
			 </tr> 
			 <tr>
			    <td class="add_titles" width="32%">Admin Username :</td>
				<td  width="29%"><input type="text" name="admin_user" id="admin_user" value="{$admin_user}"></td>
				<td class="add_titles" width="39%"><!--*used for login--> </td>
			</tr>	
			<tr>
			    <td class="add_titles">Admin Name: </td>
				<td><input type="text" name="admin_name" id="admin_name" value="{$admin_name}"></td>
				<td class="txt"><!--*used for display--> </td>
			</tr>	
			<tr>
				<td width="32%" class="add_titles">Email:</td>
				<td width="29%"><input type="text" name="email" id="email" value="{$admin_email}"></td>
			    <td width="39%" class="txt"><!--*Admin Email Address--> </td>
			</tr>	
			<tr>
				<td>&nbsp;</td>
				<td colspan="2"><input type="submit" name="submitAdmin" value="Update"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = innerfooter.tpl}