{ include file = mainhead.tpl}
<form name="adminprof" action="changepass.php" method="post">
<table cellpadding="0" align="center" bgcolor="#FFFFFF" cellspacing="0" width="1010">
	<tr>
		<td colspan="20" style="padding-top:80px;">
			<table width="80%"  align="center" height="53" cellpadding="2" cellspacing="2"  class="main_table" >
 			 <tr>
			   <td height="19" class="okmsg" colspan="3" align="center">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
			 <tr>
			   <td height="19" class="admintopheading" colspan="3" align="center">Change Password </td>			
			 </tr> 
			 <tr>
			    <td class="add_titles" width="32%"><span class="gutt_textheading"><strong>Old Passwowrd :</strong></span></td>
				<td  width="29%"><input type="password" name="adminOldpass" id="adminOldpass" class="textfield" /></td>
				<td class="add_titles" width="39%"><!--*used for login--> </td>
			</tr>	
			<tr>
			    <td class="add_titles"><span class="gutt_textheading"><strong>New Password :</strong></span></td>
				<td><input type="password" name="adminpass1" id="adminpass1" class="textfield" /></td>
				<td class="txt"><!--*used for display--> </td>
			</tr>	
			<tr>
				<td width="32%" class="add_titles"><strong><span class="gutt_textheading">Re-type Password</span>: </strong></td>
				<td width="29%"><input type="password" name="adminpass2" id="adminpass2" class="textfield" /></td>
			    <td width="39%" class="txt"><!--*Admin Email Address--> <input type="hidden" name="changePass" /></td>
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