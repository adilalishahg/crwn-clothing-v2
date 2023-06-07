{literal}
<script type="text/javascript">
$(document).ready(function() {
    $("#addsubscriber").validationEngine();	
	});			
</script>
{/literal}
<table width="650" border="0" cellspacing="0" cellpadding="0">
                            
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">Add Member</td>
                            </tr>
							
                            <tr>
<td height="19" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"  valign="top" style="padding-bottom:50px;">
							  <form name="addsubscriber" id="addsubscriber" method="post" action="addmember.php">   
                                 <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td width="30%" height="25" align="right" class="labeltxt">Email Address: </td>
    <td width="35%" height="25"><input type="text" name="user_email" class="validate[required,custom[email],length[0,100]]" id="user_email" value="{$email}" /></td>
    <td width="35%"><input type="submit" name="add_user" id="add_user" value="Add User" />
      <input type="reset" name="reset" id="reset" value="Reset" /></td>
  </tr>
</table>		</td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table> </form>
							  </td>
            </tr>
      </table>