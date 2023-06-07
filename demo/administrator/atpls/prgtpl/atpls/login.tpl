{include file=loginhead.tpl}
<tr>
    <td width="80%" bgcolor="#FFFFFF" align="center"><div id="outerWrapper">
<form name="loginform" id="loginform" action="login.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="8" align="center" bgcolor="#FFFFFF">
  <tr>
    <td align="center"><table width="60%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="images/4.jpg">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="35" align="left" valign="top" class="gutt_adminlogin">Administration Login
             {if $error} <div align="right" class="okmsg">{$error}</div> {/if}</td>
          </tr>
          <tr>
            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="25%" align="left" valign="top"></td>
                <td width="75%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="17" align="left" valign="top"><img src="images/1.jpg" alt="d" width="17" height="17" /></td>
                    <td align="left" valign="top" background="images/2.jpg">&nbsp;</td>
                    <td width="17" align="left" valign="top"><img src="images/3.jpg" alt="d" width="17" height="17" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" background="images/4.jpg">&nbsp;</td>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="39%" align="right" valign="middle" class="labeltxt">Username: </td>
                        <td width="61%" align="left" valign="middle"><label>
                          <input name="adminname" id="adminname" value="{$adminname}" type="text" size="28" />
                        </label></td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle" class="labeltxt">Password: </td>
                        <td align="left" valign="middle"><input name="adminpass" id="adminpass" type="password"  size="28" /></td>
                      </tr>
                      <tr>
                        <td align="right" valign="bottom" class="labeltxt">Security Code:</td>
                        <td align="left" valign="middle">
						<img src="CaptchaSecurityImages.php?width=100&height=40&character=5" style="border: 1px dotted #808080" /><br />
							<input name="pincode" class="captchafield" id="pincode" size="28" />						</td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">&nbsp;</td>
                        <td align="right" valign="middle" style="padding-right:15px;"><input type="submit" value="Login"><input type="reset" value="Reset">                        </td>
                      </tr>
                    </table></td>
                    <td align="left" valign="top" background="images/5.jpg">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><img src="images/6.jpg" alt="d" width="17" height="17" /></td>
                    <td align="left" valign="top" background="images/7.jpg">&nbsp;</td>
                    <td align="left" valign="top"><img src="images/8.jpg" alt="d" width="17" height="17" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          
        </table></td>
        <td align="left" valign="top" background="images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</div>
    </td>
</tr>
{ include file = footer.tpl}