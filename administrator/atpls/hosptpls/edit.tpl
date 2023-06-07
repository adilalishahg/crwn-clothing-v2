{ include file = headerinner.tpl}



{literal} 
<script type="text/javascript">


function USS(val){ 
	vals = val.split('^'); 
	if(vals.length > 0){
	if(vals[0] != '') $('#b_aname').val(vals[0]);
	if(vals[1] != '') $('#b_address').val(vals[1]);
	if(vals[2] != '') $('#b_city').val(vals[2]);
	if(vals[3] != '') $('#b_state').val(vals[3]);
	if(vals[4] != '') $('#b_zip').val(vals[4]);	
		}
	}




function showReason(val){







  if(val == 'disapproved'){



    $('#reason').show('slow');	



  }else{



    $('#reason').hide('slow');  



  }







}



$(document).ready(function() {

	$("#edituser").validationEngine()

	/*$("#h_phone").mask("(999) 999-9999");

	$("#phnum").mask("(999) 999-9999");	*/

});



</script> 
{/literal}
<table width="700" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">Edit Facility </td>
        </tr>
        <tr>
          <td height="19" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td height="19" align="center"> { if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
            
            
            
            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top"><form name="edituser" id="edituser" method="post" action="edit.php?id={$id}">
              <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">
                <tr>
                  <td colspan="3" valign="top" class="admintopheading"><strong>Facility Information </strong></td>
                </tr>

                <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>Facility Name:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="hosp_name" id="hosp_name" value="{$hosp_name}"  class="validate[required,custom[onlyLetter]] inputTxtField" maxlength="100"/>
                    &nbsp;<span class="SmallnoteTxt">*
                    <input type="hidden" name="ohosp_name" id="ohosp_name" value="{$ohosp_name}"/>
                    </span></td>
                </tr>
                <!--<tr>
                  <td width="30%" align="left" valign="top" class="labels"><strong>Programe Type:</strong></td>
                  <td colspan="2" align="left"><select name="progtype" id="progtype" class="txt_box required" >
                      <option value="">Select</option>
                      
			   {section name=n loop=$prgs}
			   
                      <option value="{$prgs[n].prgid}" {if $progtype eq $prgs[n].prgid}selected{/if} > {$prgs[n].prgtitle } </option>
                      
			   {/section}
			  
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
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
                  <td colspan="2" align="left"><input type="text" name="h_zip" id="h_zip" value="{$h_zip}" maxlength="10" class="validate[required] inputTxtField" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Phone:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="h_phone" id="h_phone" value="{$h_phone}" class="validate[required] inputTxtField" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                 <tr>
                  <td align="left" valign="top" class="labels"><strong>Rate Type:</strong></td>
                  <td colspan="2" align="left"><select name="rate_type" >
                  <option value="custom" {if $rate_type eq 'custom'}selected{/if}>Custom Rate</option>
                  <option value="flat" {if $rate_type eq 'flat'}selected{/if}>Flat Rate</option>
                  </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Contact Person Information </strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>First Name:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="fname" id="fname" value="{$fname}" class="validate[] inputTxtField" maxlength="50" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Last Name: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="lname" id="lname" value="{$lname}" class="validate[] inputTxtField" maxlength="50" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Phone: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="phnum" id="phnum" value="{$phnum}" class="validate[] inputTxtField" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Email Address: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="email" id="email" value="{$email}" class="validate[] inputTxtField" maxlength="100" />
                    &nbsp;
                  <input type="hidden" name="oemail" id="oemail" value="{$oemail}" class="inputTxtField" /></td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr align="left">
                  <td colspan="3" valign="top" class="admintopheading"><strong>Billing Information</strong></td>
                </tr>
                 <tr >
                  <td class="labels"  >Select Existing Account:<br/></td>
                  <td><select name="accname" id="accname" onchange="USS(this.value);" >
                  <option value=""> Select Account</option>
                  {section name=q loop=$accountnames}
                  {assign var="keywords" value="^"|explode:$accountnames[q].alldata}
                  <option value="{$accountnames[q].alldata}">{$keywords.0}</option>
                  {/section}
                  </select>
                   </td>
                  <td></td>
                </tr>
                 <tr >
                  <td class="labels"  >Account Name:<br/></td>
                  <td><input name="b_aname" type="text"  class="txt_box " id="b_aname" value="{$data.0.b_aname}" maxlength="150" />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr>
                 <tr >
                  <td class="labels"  >Billing Address:<br/></td>
                  <td><input name="b_address" type="text"  class="txt_box " id="b_address" value="{$data.0.b_address}" maxlength="150" />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels" >Billing City:</td>
                  <td><input name="b_city" type="text"  class="txt_box " id="b_city" value="{$data.0.b_city}" maxlength="150"/>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels" >Billing State:</td>
                  <td><select id="b_state" name="b_state"  class="txt_box" />
                    <option value="">Select</option>
                    {section name=n loop=$states}
                    <option value="{$states[n].abbr}"{if $states[n].abbr eq $data.0.b_state} selected="selected" {else}{if $states[n].abbr eq 'AZ'} selected="selected" {/if}{/if}>
                    {$states[n].statename}
                    </option>
                    {/section}
                    </select>
                    <span class="SmallnoteTxt" ></span></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="labels" >Billing Zip Code:</td>
                  <td><input name="b_zip" type="text"  class="txt_box" id="b_zip" value="{$data.0.b_zip}" maxlength="10" />
                    &nbsp;<span class="SmallnoteTxt">e.g. 12345-6789</span></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Account Information</strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Username:</strong></td>
                  <td align="left" valign="top"><input type="text" name="username" id="username" value="{$username}" class="validate[] inputTxtField" maxlength="20" />
                    &nbsp;<span class="SmallnoteTxt">
                    <input type="hidden" name="ousername" id="ousername" value="{$ousername}"/>
                    </span></td>
                  <td align="left" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Password:</strong></td>
                  <td colspan="2" align="left" valign="top"><input type="text" name="pwd1" id="pwd1" class="validate[] inputTxtField" value="{$pwd1}" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Confirm Password :</strong></td>
                  <td colspan="2" align="left" valign="top"><input type="text" name="pwd2" id="pwd2" class="validate[] inputTxtField" value="{$pwd2}" />
                    &nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Status :</strong></td>
                  <td align="left" valign="top"><select name="ustatus" id="ustatus" onchange="showReason(this.value);" class="validate[required]">
                      <option value="">Select</option>
                      <option value="inactive" {if $ustatus eq 'inactive'}selected{/if}>Inactive</option>
                      <option value="approved" {if $ustatus eq 'approved'}selected{/if}>Approved</option>
                      <option value="disapproved" {if $ustatus eq 'disapproved'}selected{/if}>Disapproved</option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span>
                    <input type="hidden" name="oustatus" id="oustatus" value="{$oustatus}"/></td>
                  <td align="left" valign="top">&nbsp;</td>
                </tr>
                <tr id="rea" >
                  <td align="left" valign="top"></td>
                  <td align="left" valign="top"><span id="reason" class="labeltxt" style="display:{if $ustatus eq 'disapproved'}block;{else}none;{/if}"><strong>Reason :</strong><br />
                    <textarea name="reason" cols="55" rows="4" id="reason" >{$reason}</textarea>
                    </span></td>
                  <td align="left" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" class="inputButton btn"  />
                    <input type="reset" name="reset" value="Reset" class="inputButton btn"  /></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 