{ include file = headerinner.tpl}



{literal} 
<script language="javascript">

$(document).ready(function() {

	$("#edit-admuser").validationEngine()

});


</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">Update Account</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="color: #F00; padding-bottom:20px;"><form name="edit-admuser" id="edit-admuser" method="post" action="edit.php?eId={$eId}">
                    <table width="600" border="0" cellspacing="2" cellpadding="2">
                      <tr>
                        <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
                          
                          
                          
                          { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if} </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
                              <td align="left" background="../images/2.jpg"></td>
                              <td width="17" align="left"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
                              <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                  <tr>
                                    <td colspan="2"></td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Account Name:</b></td>
                       <td width="60%" height="25"><input name="account_name" type="text" class="validate[required]" id="account_name" value="{$data.account_name}" maxlength="100" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Billing Address:</b></td>
                       <td width="60%" height="25"><input name="address" type="text" class="validate[required]" id="address" value="{$data.address}" maxlength="100" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>City:</b></td>
                       <td width="60%" height="25"><input name="city" type="text" class="validate[required]" id="city" value="{$data.city}" maxlength="50" />
                                      *</td>
                                  </tr>
                                 <tr>
                  <td width="40%" height="25" align="right" class="labeltxt"><strong>State:</strong></td>
                  <td width="60%" height="25"><select name="state" id="state" class="validate[required]" >
                      <option value="">Select</option>
			   {section name=n loop=$states}
            <option value="{$states[n].abbr}" {if $states[n].abbr eq $data.state}selected{elseif $states[n].abbr eq 'AZ'}selected{/if}>
			   {$states[n].statename}
                      </option>
			   {/section}
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Zip Code:</b></td>
                       <td width="60%" height="25"><input name="zip" type="text" class="validate[required]" id="zip" value="{$data.zip}" maxlength="10" />
                                      *</td>
                                  </tr>
                                  <tr>
                              <td width="40%" height="25" align="right" class="labeltxt"><b>Phone #:</b></td>
                              <td width="60%" height="25"><input name="phone" type="text" class="validate[]" id="phnum" value="{$data.phone}" maxlength="20" /></td>
                                  </tr>
                               <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Free Miles:</b></td>
                                    <td width="60%" height="25"><input name="freemiles" type="text" class="validate[]" id="freemiles" value="{$data.freemiles}" maxlength="3" /></td>
                                  </tr> 
                                 <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Rate Type:</b></td>
                                    <td width="60%" height="25"><select name="rate_type" >
                  <option value="custom" {if $data.rate_type eq 'custom'}selected{/if}>Custom Rate</option>
                  <option value="flat" {if $data.rate_type eq 'flat'}selected{/if}>Flat Rate</option>
                  </select></td>
                                  </tr>     
                                </table></td>
                              <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
                              <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
                              <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td width="48" align="left" valign="top">&nbsp;</td>
                        <td colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                                            <tr>
                        <td align="right" valign="top">&nbsp;</td>
                        <td colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center" valign="top"><input type="submit" name="admusersub" id="admusersub" value="Edit " class="btn" />
                          <input name="reset" type="reset"  id="admusersub" value="Reset" class="btn" /></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">&nbsp;</td>
                        <td colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><!--  CONTENT DETAIL --></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 