{ include file = mainhead.tpl}
{literal}
<script type="text/javascript">

$(document).ready(function() {
	$("#copyright").validationEngine()
});
</script>
{/literal}
<form name="copyright" id="copyright" action="copyright.php" method="post" >
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
	<tr>
	
	<tr>
 		<td height="19" colspan="3" align="right" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]</td>
	</tr>
	
	
	
	
		<td colspan="20" valign="top">
			<table width="100%"  align="center" height="53" cellpadding="2" cellspacing="2" >
 			{ if $msgs != '' or $errors != ''} <tr>
			   <td height="19" class="okmsg" colspan="2" align="center" style="color:#FF0000; font-weight:bold;">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
             {/if}
			 <tr>
			   <td height="19" class="admintopheading" colspan="2" align="center"> MANAGE COPYRIGHT </td>			
			 </tr> 
			 <tr>
			   <td width="40%" align="right" class="add_titles"><strong>Copyright :<span style="color:#FF0000">*</span></strong></td>
				<td align="left"><input name="copyright" class="validate[required,length[0,100]]" id="copyright" value="{$copyright}" size="40" maxlength="100">
				</textarea>				  <!--*used for login--> </td>
			  </tr>	
			<tr>
			  <td>&nbsp;</td>
				<td align="left" style="padding-left:100px"><input type="submit" name="submitAdmin" value="Update" class="btn"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = footer.tpl}