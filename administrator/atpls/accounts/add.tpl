{include file = headerinner.tpl}

{literal} 
<script language="javascript" type="text/javascript">

$(document).ready(function() {
  $('#uname').hide();
  $('#pass').hide();
	$("#add-admuser").validationEngine()
  $('#portalAccess').change(function(){
    if($('#portalAccess').val()==1){
      $('#uname').show();
      $('#pass').show();
    }
    else{
      $('#uname').hide();
      $('#pass').hide();
    }

  });
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
                <td height="19" align="center" class="admintopheading">Add Account</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px; color: #F00;"><form name="add-admuser" id="add-admuser" method="post" action="add.php">
                    <table width="650" border="0" cellspacing="2" cellpadding="2">
                      <tr>
                        <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
                          
                          
                          
                          { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if} </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                       <td width="60%" height="25"><input name="account_name" type="text" class="validate[required]" id="account_name" value="{$post.account_name}" maxlength="100" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Billing Address:</b></td>
                       <td width="60%" height="25"><input name="address" type="text" class="validate[required]" id="address" value="{$post.address}" maxlength="100" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>City:</b></td>
                       <td width="60%" height="25"><input name="city" type="text" class="validate[required]" id="city" value="{$post.city}" maxlength="50" />
                                      *</td>
                                  </tr>
                                 <tr>
                  <td width="40%" height="25" align="right" class="labeltxt"><strong>State:</strong></td>
                  <td width="60%" height="25"><select name="state" id="state" class="validate[required]" >
                      <option value="">Select</option>
			   {section name=n loop=$states}
            <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>
			   {$states[n].statename}
                      </option>
			   {/section}
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Zip Code:</b></td>
                       <td width="60%" height="25"><input name="zip" type="text" class="validate[required]" id="zip" value="{$post.zip}" maxlength="10" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Phone #:</b></td>
                                    <td width="60%" height="25"><input name="phone" type="text" class="validate[]" id="phnum" value="{$post.phone}" maxlength="20" /></td>
                                  </tr>
                                 <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Free Miles:</b></td>
                                    <td width="60%" height="25"><input name="freemiles" type="text" class="validate[]" id="freemiles" value="{$post.freemiles}" maxlength="3" /></td>
                                  </tr> 
                                {if $smarty.session.adminuser eq 'NEMTUS'}
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Pick Signature Required?:</b></td>
                                    <td width="60%" height="25"><select name="pick_signature" >
                  <option value="1" {if $post.pick_signature eq '1'}selected{/if}>Yes</option>
                  <option value="0" {if $post.pick_signature eq '0'}selected{/if}>No</option>
                  </select></td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Drop Signature Required?:</b></td>
                                    <td width="60%" height="25"><select name="drop_signature" >
                  <option value="1" {if $post.drop_signature eq '1'}selected{/if}>Yes</option>
                  <option value="0" {if $post.drop_signature eq '0'}selected{/if}>No</option>
                  </select></td>
                                  </tr>{/if}  
                                  
                       		<tr id="email" style="display:none--;">
                            <td width="30%" height="25" align="right" class="labeltxt"><strong>Email ID:</strong> </td>
                            <td width="70%" height="25"><input name="email" type="text" class="validate[email]" id="email" value="{$post.email}" maxlength="100" />
                            </td>
                            </tr>
                            <tr style="display:none--;">
                            <td width="30%" height="25" align="right" class="labeltxt"><strong>Portal Access:</strong> </td>
                            <td width="70%" height="25">
                              <select name="portalAccess" id="portalAccess">
                              <option value="1">Yes</option>
                              <option value="0" selected>No</option>
                              </select>
                            </td>
                            </tr>
                            <tr id="uname" style="display:none--;">
                            <td width="30%" height="25" align="right" class="labeltxt"><strong>User Name:</strong> </td>
                            <td width="70%" height="25"><input name="username" type="text" class="validate[]" id="username" value="{$post.username}" maxlength="55" />
                            </td>
                            </tr>
                                  <tr id="pass" style="display:none--;">
                                    <td width="30%" height="25" align="right" class="labeltxt"><strong>Password:</strong> </td>
                                    <td width="70%" height="25"><input name="password" type="text" class="validate[]" id="password" value="{$post.password}" maxlength="15" />
                                    </td>
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
                        <td colspan="3" align="center" valign="top"><input type="submit" name="admusersub" id="admusersub" value="Add" class="btn" />
                          <input type="reset" name="reset" id="reset" value="Reset" class="btn" /></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">&nbsp;</td>
                        <td colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
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