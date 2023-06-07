{ include file = headerinner.tpl}
{literal} 
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
	location.href="index.php?delId="+id;
		return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
$(document).ready(function() {
	$("#adduser").validationEngine()
	$("#h_phone").mask("(999)999-9999");
	$("#phnum").mask("(999)999-9999");	
});
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">Add Facility </td>
        </tr>
        <tr>
          <td height="19" align="center">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
            
            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top"><form name="adduser" id="adduser" method="post" action="add.php">
              <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">
                <tr>
                  <td colspan="3" valign="top" class="admintopheading"><strong>Facility Information </strong></td>
                </tr>
                <tr>
                  <td width="30%" align="left" valign="top" class="labels"><strong>Facility Name:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="hosp_name" id="hosp_name" value="{$hosp_name}"  class="validate[required,custom[onlyLetter]] inputTxtField" maxlength="100"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <!--<tr>
              <td align="left" valign="top" class="labels"><strong>Account Type:</strong></td>
              <td colspan="2" align="left"><select name="atype" id="atype" class="txt_box required" {if $alist eq $alist[q].id}selected{/if}>

			   <option value="">Select</option>

			   {section name=n loop=$alist}

			   <option value="{$alist[n].id}" >

			   {$alist[n].accnttype }

			   </option>

			   {/section}

			  </select>&nbsp;<span class="SmallnoteTxt">*</span></td>
            </tr>-->
                
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Address:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="h_address" id="h_address" value="{$h_address}"  class="validate[required] inputTxtField" maxlength="200"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>City:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="h_city" id="h_city" value="{$h_city}" class="validate[required,custom[onlyLetter]] inputTxtField" maxlength="100" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>State:</strong></td>
                  <td colspan="2" align="left"><select name="h_state" id="h_state" class="validate[required] SelectBox" >
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
                  <td colspan="3" height="3"></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Zipcode:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="h_zip" id="h_zip" value="{$h_zip}" maxlength="5" class="validate[required,custom[onlyZip]] inputTxtField" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Phone:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="h_phone" id="h_phone" value="{$h_phone}" class="validate[required] inputTxtField" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr align="left">
                  <td colspan="3" valign="top">&nbsp;</td>
                </tr>
                <tr align="left">
                  <td colspan="3" valign="top" class="admintopheading"><strong>Contact Person Information </strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>First Name:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="fname" id="fname" value="{$fname}" class="validate[custom[onlyLetter]] inputTxtField" maxlength="50" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Last Name: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="lname" id="lname" value="{$lname}" class="validate[custom[onlyLetter]] inputTxtField" maxlength="50" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Phone: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="phnum" id="phnum" value="{$phnum}" class="validate[] inputTxtField" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Email Address: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="email" id="email" value="{$email}" class="validate[custom[email]] inputTxtField" maxlength="100" />
                    &nbsp;</td>
                </tr>
                <tr align="left">
                  <td colspan="3" valign="top">&nbsp;</td>
                </tr>
                <tr align="left">
                  <td colspan="3" valign="top" class="admintopheading"><strong>Account Information</strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Username:</strong></td>
                  <td align="left" valign="top"><input type="text" name="username" id="username" value="{$username}" class="validate[custom[noSpecialCaracters]] inputTxtField" maxlength="20" />
                    &nbsp;</td>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Password:</strong></td>
                  <td colspan="2" align="left" valign="top"><input type="password" name="pwd1" id="pwd1" class="validate[length[5,15]] inputTxtField" value="{$pwd1}" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Confirm Password :</strong></td>
                  <td colspan="2" align="left" valign="top"><input type="password" name="pwd2" id="pwd2" class="validate[confirm[pwd1],legnth[5,15]] inputTxtField" value="{$pwd2}"  />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Status :</strong></td>
                  <td align="left" valign="top"><select name="ustatus" id="ustatus" class="validate[required]">
                      <option value="">Select</option>
                      <option value="inactive" {if $ustatus eq 'inactive'}selected{/if}>Inactive</option>
                      <option value="approved" {if $ustatus eq 'approved'}selected{/if}>Approved</option>
                      <option value="disapproved" {if $ustatus eq 'disapproved'}selected{/if}>Disapproved</option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td valign="top">&nbsp;</td>
                </tr>
                 <tr>
                  <td valign="top">&nbsp;</td>
                  <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" class="inputButton btn"  />
                    <input type="reset" name="reset" value="Reset" class="inputButton btn"  /></td>
                </tr>
              </table>
            </form> </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 