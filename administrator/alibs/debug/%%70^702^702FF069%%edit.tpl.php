<?php /* Smarty version 2.6.12, created on 2023-01-18 15:56:04
         compiled from accounts/edit.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<?php echo ' 
<script language="javascript">

$(document).ready(function() {

	$("#edit-admuser").validationEngine()
  if($(\'#portalAccess\').val()==1){
      $(\'#uname\').show();
      $(\'#pass\').show();
  }
  else{
    $(\'#uname\').hide();
    $(\'#pass\').hide();
  }

  $(\'#portalAccess\').change(function(){
  if($(\'#portalAccess\').val()==1){
    $(\'#uname\').show();
    $(\'#pass\').show();
  }
  else{
    $(\'#uname\').hide();
    $(\'#pass\').hide();
  }

});

});


</script> 
'; ?>

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
                <td height="44" align="center"  valign="top" style="color: #F00; padding-bottom:20px;"><form name="edit-admuser" id="edit-admuser" method="post" action="edit.php?eId=<?php echo $this->_tpl_vars['eId']; ?>
">
                    <table width="600" border="0" cellspacing="2" cellpadding="2">
                      <tr>
                        <td colspan="3" align="center" valign="top"><?php if ($this->_tpl_vars['msgs'] != ''): ?><font color="#009966" style="font-weight:bold"><?php echo $this->_tpl_vars['msgs']; ?>
</font><?php endif; ?>
                          
                          
                          
                          <?php if ($this->_tpl_vars['errors'] != ''): ?><font color="#FF0000" style="font-weight:bold"><?php echo $this->_tpl_vars['errors']; ?>
</font><?php endif; ?> </td>
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
                       <td width="60%" height="25"><input name="account_name" type="text" class="validate[required]" id="account_name" value="<?php echo $this->_tpl_vars['data']['account_name']; ?>
" maxlength="100" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Billing Address:</b></td>
                       <td width="60%" height="25"><input name="address" type="text" class="validate[required]" id="address" value="<?php echo $this->_tpl_vars['data']['address']; ?>
" maxlength="100" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>City:</b></td>
                       <td width="60%" height="25"><input name="city" type="text" class="validate[required]" id="city" value="<?php echo $this->_tpl_vars['data']['city']; ?>
" maxlength="50" />
                                      *</td>
                                  </tr>
                                 <tr>
                  <td width="40%" height="25" align="right" class="labeltxt"><strong>State:</strong></td>
                  <td width="60%" height="25"><select name="state" id="state" class="validate[required]" >
                      <option value="">Select</option>
			   <?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['states']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
            <option value="<?php echo $this->_tpl_vars['states'][$this->_sections['n']['index']]['abbr']; ?>
" <?php if ($this->_tpl_vars['states'][$this->_sections['n']['index']]['abbr'] == $this->_tpl_vars['data']['state']): ?>selected<?php elseif ($this->_tpl_vars['states'][$this->_sections['n']['index']]['abbr'] == 'AZ'): ?>selected<?php endif; ?>>
			   <?php echo $this->_tpl_vars['states'][$this->_sections['n']['index']]['statename']; ?>

                      </option>
			   <?php endfor; endif; ?>
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Zip Code:</b></td>
                       <td width="60%" height="25"><input name="zip" type="text" class="validate[required]" id="zip" value="<?php echo $this->_tpl_vars['data']['zip']; ?>
" maxlength="10" />
                                      *</td>
                                  </tr>
                                  <tr>
                              <td width="40%" height="25" align="right" class="labeltxt"><b>Phone #:</b></td>
                              <td width="60%" height="25"><input name="phone" type="text" class="validate[]" id="phnum" value="<?php echo $this->_tpl_vars['data']['phone']; ?>
" maxlength="20" /></td>
                                  </tr>
                               <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Free Miles:</b></td>
                                    <td width="60%" height="25"><input name="freemiles" type="text" class="validate[]" id="freemiles" value="<?php echo $this->_tpl_vars['data']['freemiles']; ?>
" maxlength="3" /></td>
                                  </tr> 
                                   <?php if ($_SESSION['adminuser'] == 'NEMTUS'): ?>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Pick Signature Required?:</b></td>
                                    <td width="60%" height="25"><select name="pick_signature" >
                  <option value="1" <?php if ($this->_tpl_vars['data']['pick_signature'] == '1'): ?>selected<?php endif; ?>>Yes</option>
                  <option value="0" <?php if ($this->_tpl_vars['data']['pick_signature'] == '0'): ?>selected<?php endif; ?>>No</option>
                  </select></td>
                                  </tr>
                                  <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Drop Signature Required?:</b></td>
                                    <td width="60%" height="25"><select name="drop_signature" >
                  <option value="1" <?php if ($this->_tpl_vars['data']['drop_signature'] == '1'): ?>selected<?php endif; ?>>Yes</option>
                  <option value="0" <?php if ($this->_tpl_vars['data']['drop_signature'] == '0'): ?>selected<?php endif; ?>>No</option>
                  </select></td>
                                  </tr><?php endif; ?>
                                <!-- <tr>
                                    <td width="40%" height="25" align="right" class="labeltxt"><b>Rate Type:</b></td>
                                    <td width="60%" height="25"><select name="rate_type" >
                  <option value="custom" <?php if ($this->_tpl_vars['data']['rate_type'] == 'custom'): ?>selected<?php endif; ?>>Custom Rate</option>
                  <option value="flat" <?php if ($this->_tpl_vars['data']['rate_type'] == 'flat'): ?>selected<?php endif; ?>>Flat Rate</option>
                  </select></td>
                                  </tr>  -->  
                                  <tr id="email" style="display:none--;">
                            <td width="30%" height="25" align="right" class="labeltxt"><strong>Email ID:</strong> </td>
                            <td width="70%" height="25"><input name="email" type="text" class="validate[email]" id="email" value="<?php echo $this->_tpl_vars['data']['email']; ?>
" maxlength="100" />
                            </td>
                            </tr>
                            <tr style="display:none--;">
                            <td width="30%" height="25" align="right" class="labeltxt"><strong>Portal Access:</strong> </td>
                            <td width="70%" height="25">
                              <select name="portalAccess" id="portalAccess">
                              <option value="1" <?php if ($this->_tpl_vars['data']['portal_access'] == 1): ?>selected<?php endif; ?>>Yes</option>
                              <option value="0" <?php if ($this->_tpl_vars['data']['portal_access'] == 0): ?>selected<?php endif; ?>>No</option>
                              </select>
                            </td>
                            </tr>
                                  <tr id="uname" style="display:none--;">
                                  <td width="30%" height="25" align="right" class="labeltxt"><strong>User Name:</strong> </td>
                                  <td width="70%" height="25"><input name="username" type="text" class="validate[]" id="username" value="<?php echo $this->_tpl_vars['data']['username']; ?>
" maxlength="55" />
                                  </td>
                                  </tr>
                                  <tr id="pass" style="display:none--;">
                                    <td width="30%" height="25" align="right" class="labeltxt"><strong>Password:</strong> </td>
                                    <td width="70%" height="25"><input name="password" type="text" class="validate[]" id="password" value="<?php echo $this->_tpl_vars['data']['password']; ?>
" maxlength="15" />
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 