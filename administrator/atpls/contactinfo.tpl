{ include file = mainhead.tpl}
{literal}
<script type="text/javascript">

$(document).ready(function() {
	$("#adminprof").validate()
});
</script>
{/literal}
<form name="adminprof" id="adminprof" action="contactinfo.php" method="post">
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
	<tr>
	<tr>
 			   <td  colspan="3" align="right" style="padding-right:40px;">[<a href="javascript:history.back();">Back</a>]</td>
    </tr>
		<td colspan="20" valign="top" style="padding-top:35px;">
			<table width="99%"  align="center" height="53" border="0" cellpadding="2" cellspacing="2"  class="main_table" >
 			 { if $msgs != '' or $errors != ''}
 			 <tr>
			   <td height="19" colspan="2" align="center" valign="top" class="okmsg">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
             {/if}
			 <tr>
			   <td height="19" class="admintopheading" colspan="3" align="center"> MANAGE CONTACT INFORMATION </td>			
			 </tr> 
			 <tr>
			   <td class="add_titles" width="46%" align="right"><strong>Admin Name :</strong></td>
			   <td  width="54%" align="left"><input type="text" name="admin_name" id="admin_name" class="required" value="{$admin_name}"></td>
			  </tr>	
			<tr>
			  <td align="right" class="add_titles"><strong>Contact No.  :</strong> </td>
			  <td align="left"><input type="text" name="admin_contact" id="admin_contact" class="required digits" value="{$admin_contact}"></td>
			  </tr>	
			<tr>
			  <td width="46%" align="right" class="add_titles"><strong>Email :</strong></td>
			  <td width="54%" align="left"><input type="text" name="email" id="email" class="required email" value="{$admin_email}"></td>
		      </tr>	
			<tr>
			  
				<td colspan="2" align="center"><input type="submit" name="submitAdmin" value="Update" class="btn">&nbsp;&nbsp;<input type="reset" name="reset" id="reset" value="Reset" class="btn" /></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = footer.tpl}