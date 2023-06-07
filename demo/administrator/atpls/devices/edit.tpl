{ include file = headerinner.tpl}



{literal} 
<script language="javascript">

$(document).ready(function() {

	$("#edit-admuser").validationEngine()

});


</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">Edit Program Type</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="color: #F00; padding-bottom:20px;"><form name="edit-admuser" id="edit-admuser" method="post" action="editprg.php?eId={$eId}">
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
                                    <td width="30%" height="25" align="right" class="labeltxt">Program Title : </td>
                                    <td width="70%" height="25"><input name="prgtitle" type="text" class="validate[required]" id="prgtitle" value="{$prgtitle}" maxlength="50" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Associated Label Title: </td>
                                    <td width="70%" height="25"><input name="prgassoctitle" type="text" class="validate[required]" id="prgassoctitle" value="{$prgassoctitle}" maxlength="50" />
                                      *</td>
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
                        <td width="145" align="right" valign="top" class="labeltxt">Status:</td>
                        <td width="387" align="left" valign="top"><select name="prgstatus" id="prgstatus" class="validate[required]">
                            <option value="0" {if $prgstatus eq '0'}selected{/if}>Inactive</option>
                            <option value="1" {if $prgstatus eq '1'}selected{/if}>Active</option>
                          </select></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">&nbsp;</td>
                        <td colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center" valign="top"><input type="submit" name="admusersub" id="admusersub" value="Edit Program Type" class="btn" />
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