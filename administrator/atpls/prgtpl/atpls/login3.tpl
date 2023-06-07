{include file=loginhead.tpl}
<tr>
    <td width="80%"><div id="outerWrapper">
<form name="loginform" id="loginform" action="login.php" method="post">
<table width=100% border=0 cellPadding=0 cellSpacing=0 bgcolor="#FFFFFF">
<tr>
<td width="105" rowSpan=5>&nbsp;</td>
<td width="898" valign="top">&nbsp;</td>
</tr>
<tr>
  <td align="center">
    <table width="350" cellpadding="0" cellspacing="0" border="0">
	<td width="100" rowSpan=4 valign="top"><img src="images/content_02.gif" width=103 alt=""></td>
  <td colSpan=3 valign="top"><table width="450" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" rowspan="2"><img src="images/content_03.gif" width=224  alt=""></td>
        <td width="37%" valign="bottom" align="right" style="background-image:url(images/content_04.gif); height:30px;">&nbsp;		</td>
        <td width="38%" rowspan="2"><img src="images/content_05.gif" width=23 alt=""></td>
      </tr>
      <tr>
        <td><img src="images/content_07.gif" width=310 alt=""></td>
        </tr>
    </table></td>
  </tr>

<tr>
  <td width="33" rowSpan=2 valign="top">
<img src="images/content_08.gif" width=33 alt=""></td>
<td width="158" valign="top"><img src="images/content_09.gif" width=158  alt=""></td>
<td width="390" valign="top"><table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%"><img src="images/content_10.gif" width=24  alt=""></td>
    <td colspan="2" valign="bottom" align="right" style="background-image:url(images/content_11.gif);">&nbsp;</td>
    <td width="25%"><img src="images/content_12.gif" width=24 alt=""></td>
  </tr>
  <tr>
    <td rowspan="2"><img src="images/content_14.gif" width=24 alt=""></td>
    <td colspan="2" valign="bottom"></td>
    <td rowspan="2"><img src="images/content_17.gif" width=24 alt=""></td>
  </tr>
  <tr>
    <td colspan="2" valign="bottom" align="right">
	{if $error neq ''}<font color="#FF0000"><b>{$error}</b></font>{/if}
	<table width="100%" border="0" cellspacing="2" cellpadding="2" bgcolor="#FFFFFF">
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
						<img src="CaptchaSecurityImages.php?width=100&height=40&character=5" style="border: 1px dotted #808080" height="25" /><br />
							<input name="pincode" class="captchafield" id="pincode" size="28" />						</td>
                      </tr>
                      
                      <tr>
                        <td align="right" valign="middle">&nbsp;</td>
                        <td align="right" valign="middle" style="padding-right:15px;"><input type="submit" value="Login"> &nbsp;<input type="reset" value="Reset">                        </td>
                      </tr>
          </table>	</td>
  </tr>
  
  <tr>
    <td><img src="images/content_26.gif" width=24  alt=""></td>
    <td colspan="2" valign="top"><img src="images/content_27.gif" width=342 alt=""></td>
    <td><img src="images/content_28.gif" width=24  alt=""></td>
  </tr>
</table></td>
</tr>
<tr>
  <td colspan="2" valign="top"><img src="images/content_29.gif" width=524  alt=""></td>
  </tr>
<tr>
  <td width="33" valign="top"><img src="images/content_31.gif" width=33  alt=""></td>
  <td colspan="2" valign="top"><img src="images/content_32.gif" width=492  alt=""><img src="images/content_33.gif" width=32 alt=""></td>
  </table>	</td>
  </tr>


<tr>
<td colSpan=2>
<img src="images/content_34.gif" width=1004 alt=""></td>
</tr>
</table>
</form>
</div>
    </td>
</tr>
{ include file = footer.tpl}