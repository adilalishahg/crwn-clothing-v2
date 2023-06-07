{ include file = mainhead.tpl}
<form name="copyright" action="copyright.php" method="post" >
<table cellpadding="0" align="center" bgcolor="#FFFFFF"  cellspacing="0" width="1010">
	<tr>
		<td colspan="20" valign="top" style="padding-top:80px;">
			<table width="80%"  align="center" height="53" cellpadding="2" cellspacing="2"  class="main_table" >
 			 <tr>
			   <td height="19" class="okmsg" colspan="2" align="center">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
			 <tr>
			   <td height="19" class="admintopheading" colspan="2" align="center">Manage Copyright </td>			
			 </tr> 
			 <tr>
			    <td class="add_titles" width="32%">Copyright :</td>
				<td><textarea name="copyright" cols="45" rows="2" id="copyright">{$copyright}</textarea>				  <!--*used for login--> </td>
			  </tr>	
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submitAdmin" value="Update"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = innerfooter.tpl}