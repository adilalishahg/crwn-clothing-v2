{include file=loginhead.tpl}
<form name="loginform" id="loginform" action="login.php" method="post">
<table width=100% border=0 align="center" cellPadding=0 cellSpacing=0>
<tr>
<td colSpan=6>
<img src="images/login_02.gif" width=1004 height=76 alt=""></td>
</tr>
<tr>
  <td width="488" rowSpan=8>
    <img src="images/login_03.gif" width=458 height=179 alt=""></td>
  <td>&nbsp;</td>
  <td colSpan=3>&nbsp;</td>
  <td width="185" rowSpan=8 align="left">
    <img src="images/login_06.gif" width=185 height=179 alt=""></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colSpan=3>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colSpan=3>&nbsp;</td>
</tr>
<tr>
<td width="99"><span class="labeltxt"><span class="text">Username: </span></span></td>
<td colSpan=3><input name="adminname" id="adminname" value="{$adminname}" type="text" size="28" /></td>
</tr>
<tr>
<td><span class="labeltxt"><span class="labeltxt"><span class="text">Password:</span></span></span></td>
<td colSpan=3><input name="adminpass" id="adminpass" type="password"  size="28" /></td>
</tr>
<tr>
  <td><span class="labeltxt"><span class="text">Security Code:</span></span></td>
  <td colSpan=3><img src="CaptchaSecurityImages.php?width=100&height=40&character=5" style="border: 1px dotted #808080" /><br />
    <input name="pincode" class="captchafield" id="pincode" size="28" /></td>
</tr>
<tr>
  <td colspan="4">&nbsp;</td>
  </tr>
<tr>
<td height="42" colSpan=2>&nbsp;</td>
<td width="165" align="right">
<input type="image" src="images/login_button.gif" border="0" name="Login"> 
<input type="image" src="images/reset_button.gif" border="0" onclick="this.reset();" name="Reset"></td>
<td width="66" align="right"></td>
</tr>
<tr>
<td colSpan=6 valign="top">
<img src="images/login_17.gif" width=1004 height=186 alt=""></td>
</tr>
</table>
</form>
{include file='footer.tpl'}