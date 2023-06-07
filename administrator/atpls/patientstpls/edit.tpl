{include file = headerinner.tpl}
{literal} 
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#add-admuser").validationEngine()
});
function age_calc(objx)
{
obj = objx.value;
	$.post("age_calc.php", {dob:obj}, function(data){
		if(data.length > 0)
		{
			$('#p_age').val(data) ;
		} else{
		$('#p_age').val('') ;
		}  
	});
}
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="right" valign="top">[<a href="javascript:history.back()">Back</a>]</td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">EDIT PATIENT</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px; color: #F00;"><form name="add-admuser" id="add-admuser" method="post" action="edit.php">
                    <table width="800" border="0" cellspacing="2" cellpadding="2">
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
                                    <td width="30%" height="25" align="right" class="labeltxt">Patient Name: </td>
                                    <td width="70%" height="25"><input name="name" type="text" class="validate[required]" id="name" value="{$data.name}" maxlength="60" />                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt"> Sex: </td>
                                    <td width="70%" height="25"><select name="sex" >
                                    <option value="Male" {if $data.sex eq 'Male'} selected="selected" {/if}>Male</option>
                                    <option value="Female" {if $data.sex eq 'Female'} selected="selected" {/if}>Female</option>
                                    </select>
                                      *</td>
                                  </tr>
                               <!--   
                                   <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt"> Insurance ID: </td>
                                    <td width="70%" height="25"><input name="insurance" type="text" class="validate[required]" id="insurance" value="{$data.insurance}" maxlength="30" />
                                      *</td>
                                  </tr>
                                   <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt"> SSN: </td>
                                    <td width="70%" height="25"><input name="ssn" type="text" class="validate[required]" id="ssn" value="{$data.ssn}" maxlength="20" />
                                      *</td>
                                  </tr>-->
                                     <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">DOB: </td>
                                    <td width="70%" height="25"><input name="dob" type="text" class="validate[]" id="dob" value="{$data.dob|date_format:"%m/%d/%Y"}" maxlength="10" onblur="age_calc(this);"  /> mm/dd/yyyy</td>
                                  </tr>                                 
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Address: </td>
                                    <td width="70%" height="25"><input name="address" type="text" class="validate[required]" id="address" value="{$data.address}" maxlength="150" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Room #/Site #: </td>
                                    <td width="70%" height="25"><input name="roomsite" type="text" class="validate[]" id="roomsite" value="{$data.roomsite}" maxlength="100" />
                                      </td>
                                  </tr>
                                <!--  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">City: </td>
                                    <td width="70%" height="25"><input name="city" type="text" class="validate[required]" id="city" value="{$data.city}" maxlength="50" />
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">State: </td>
                                    <td width="70%" height="25"><select name="state" id="state"  class="validate[required]">
                      <option value="">Select</option>
			   {section name=n loop=$slist}
                     <option value="{$slist[n].abbr}"{if $slist[n].abbr eq $data.state} selected="selected" {else}{if $slist[n].abbr eq 'AZ'} selected="selected" {/if}{/if}>
	   {$slist[n].statename}
                     </option>
			  {/section}
                    </select>
                                      *</td>
                                  </tr>
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Zip: </td>
                                    <td width="70%" height="25"><input name="zip" type="text" class="validate[required]" id="zip" value="{$data.zip}" maxlength="10" />
                                      *</td>
                                  </tr>-->
                                 
                                
                                  
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Patient Phone: </td>
                                    <td width="70%" height="25"><input name="phone" type="text" class="validate[required]" id="phnum" value="{$data.phone}" maxlength="15" />
                                    *</td>
                                  </tr>
                                   <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Claim #: </td>
                                    <td width="70%" height="25"><input name="claim_no" type="text" class="validate[required]" id="claim_no" value="{$data.claim_no}" maxlength="50" />
                                      </td>
                                  </tr>
                                  <tr>
                                    <td width="30%" height="25" align="right" class="labeltxt">Special Comments: </td>
                                    <td width="70%" height="25"><textarea name="comments" rows="5" >{$data.comments}</textarea></td>
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
                        <td colspan="3" align="center" valign="top"><input type="submit" name="admusersub" id="admusersub" value=" Update " class="btn" />
                          <input type="reset" name="reset" id="reset" value="Reset" class="btn" />
                          <input type="hidden" name="id" value="{$id}" />
                          <input type="hidden" name="pre_name" value="{$data.name}" /></td>
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