  <table width="650" border="0" align="center" cellpadding="4" cellspacing="0">
        <tr>
          <td align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		  { if $errors != ''} {$errors} {/if}</td>
          </tr>
        <tr>
          <td  class="admintopheading">Edit Member </td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
<form name="edituser" id="edituser" method="post" action="editmember.php?id={$uid}">
	  <table width="600" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Your Personal Details: </strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
        <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td width="30%" height="25" align="right" class="labeltxt">First Name: </td>
    <td width="70%" height="25"><input type="text" name="fname" id="fname" value="{$fname}" /></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt">Last Name: </td>
    <td height="25"><input type="text" name="lname" id="lname" value="{$lname}" /></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt">Email Address: </td>
    <td height="25"><input type="text" name="email" id="email" value="{$email}" /></td>
  </tr>
</table>		</td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>    	</td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Company details: </strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
		  <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top">
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  
		  <tr>
			<td width="30%" height="25" align="right" class="labeltxt">Company</td>
			<td width="70%" height="25"><input type="text" name="company" id="company" value="{$company}" /></td>
		  </tr>
		  <tr>
			<td height="25" align="right" class="labeltxt">TAX ID./ SSN: </td>
			<td height="25"><input type="text" name="taxid" id="taxid" value="{$taxid}" /></td>
		  </tr>
		</table>		</td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Commission Payment Preference:</strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
		  <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top">
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  
		  <tr>
			<td width="31%" align="right" class="labeltxt">PayPal Account Email: </td>
			<td width="69%"><input type="text" name="ppalemail" id="ppalemail" value="{$ppalemail}" /></td>
		  </tr>
		</table>		</td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Your Address</strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
		  <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top">
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  
		  <tr>
			<td width="31%" height="25" align="right" class="labeltxt">Street Address: </td>
			<td width="69%" height="25"><input type="text" name="street" id="street" value="{$street}" /></td>
		  </tr>
		  <tr>
			<td height="25" align="right" class="labeltxt">Postal Code: </td>
			<td height="25"><input type="text" name="pcode" id="pcode" value="{$pcode}" /></td>
		  </tr>
		  <tr>
			<td height="25" align="right" class="labeltxt">City:</td>
			<td height="25"><input type="text" name="city" id="city" value="{$city}" /></td>
		  </tr>
		  <tr>
		    <td height="25" align="right" class="labeltxt">Country: </td>
		    <td height="25"><input type="text" name="country" id="country" value="{$country}" /></td>
		    </tr>
		  <tr>
		    <td height="25" align="right" class="labeltxt">State/ Province:</td>
		    <td height="25"><input type="text" name="state" id="state" value="{$state}" /></td>
		    </tr>
		</table></td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
	  <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Your Contact Information: </strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
		  <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top">
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  
		  <tr>
			<td width="31%" height="25" align="right" class="labeltxt">Telephone Number: </td>
			<td width="69%" height="25"><input type="text" name="telefone" id="telefone" value="{$telefone}" /></td>
		  </tr>
		  <tr>
			<td height="25" align="right" class="labeltxt">Fax Number: </td>
			<td height="25"><input type="text" name="fax" id="fax" value="{$fax}" /></td>
		  </tr>
		  <tr>
			<td height="25" align="right" class="labeltxt">Homepage:</td>
			<td height="25"><input type="text" name="homepage" id="homepage" value="{$homepage}" /></td>
		  </tr>
		</table>		</td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Your Password :</strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
		  <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top">
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
		  
		  <tr>
			<td width="31%" height="35" align="right" class="labeltxt">Password:</td>
			<td width="69%" height="35"><input type="password" name="pass1" id="pass1" value="{$pass1}" /></td>
		  </tr>
		  <tr>
			<td height="35" align="right" class="labeltxt">Confirm Password: </td>
			<td height="35"><input type="password" name="pass2" id="pass2" value="{$pass2}" /></td>
		  </tr>
		</table>		</td>
        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>		  </td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Options:</strong></td>
          </tr>
        <tr>
          <td width="48" align="right" valign="top"><input name="newsletter" type="checkbox" id="newsletter" value="yes" checked/></td>
          <td colspan="2" align="left" class="labeltxt">Affiliates Newsletter </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td width="145" align="right" valign="top" class="labeltxt">Status:</td>
          <td width="387" align="left" valign="top">
		  <select name="status" id="status">
		    <option value="">Select</option>
			<option value="inactive">Inactive</option>
			<option value="verified">Verified</option>
			<option value="denied">Block</option>
		  </select>		  </td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top"><input type="submit" name="regaff" id="regaff" value="Register" /></td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
		<tr>
		  <td colspan="3"><!--  CONTENT DETAIL --></td>
		</tr>
      </table>
	  </form>
		  
		  </td>
        </tr>
</table>			