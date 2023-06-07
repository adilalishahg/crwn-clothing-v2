{ include file = headerinner.tpl}
{literal} 
<style>
.disable_class{	 background-color:#E8E8E8;	}
</style>
<script type="text/javascript">







function code_chk(obj)



{



	obj = obj.value;



	$.post("drv_code.php", {drv_code:obj}, function(data){



		if(data.length > 0)



		{



			$('#dupcode').html(data);



		}   



	});



}







function age_calc(objx)



{



	obj = objx.value;



	$.post("age_calc.php", {dob:obj}, function(data){



		if(data.length > 0)



		{



			$('#age').val(data) ;



		}   



	});



}







function limitText(limitField, limitCount, limitNum) {



	if (limitField.value.length > limitNum) {



		limitField.value = limitField.value.substring(0, limitNum);



	} else {



		limitCount.value = limitNum - limitField.value.length;



	}



}



$(document).ready(function(){

    $('#editdrv').validationEngine();

	$('#drvduration').mask('19');

});



</script> 
{/literal}
<table  border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="outer_table" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">Edit Driver </td>
        </tr>
        <tr>
          <td height="19" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td height="19" align="center"> { if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
            
            
            
            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="editdrv" id="editdrv" method="post" action="editdrv.php?id={$id}"  enctype="multipart/form-data">
              <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:#999999 1px solid;">
                <tr>
                  <td colspan="2" valign="top" class="admintopheading"><strong>Driver Information</strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Driver Type:</strong></td>
                  <td align="left"><select name="drvtype" id="drvtype" class="validate[] SelectBox"  >
                      <option value="">Select</option>
                      



               {section name=n loop=$tlist}



			   
                      <option value="{$tlist[n].dtype_id}" {if $tlist[n].dtype_id eq $drvtype}selected{/if}>{$tlist[n].dtype_name}</option>
                                 



			   {/section}



		      
                    </select>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                <tr>
                  <td colspan="2" height="3"></td>
                </tr>
                <tr><!-- onBlur="code_chk(this);" -->
                  <td width="30%" align="left" valign="top" class="labels"><strong>Driver Code  :</strong></td>
                  <td align="left"><input type="text" name="drv_code" id="drv_code" value="{$drv_code}"  class="validate[required] inputTxtField" maxlength="15"   /><!--readonly="readonly"-->
                    <input name="d_code_x" type="hidden" id="d_code_x" value="{$drv_code}" />
                    &nbsp;<span class="SmallnoteTxt">*</span>
                    <div id="dupcode"></div></td>
                </tr>
                <tr>
                  <td width="30%" align="left" valign="top" class="labels"><strong>First Name  :</strong></td>
                  <td align="left"><input type="text" name="fname" id="fname" value="{$fname}"  class="validate[required,custom[onlyLetter]] inputTxtField {$disable_class}" maxlength="15"  />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Last Name  :</strong></td>
                  <td align="left"><input type="text" name="lname" id="lname" value="{$lname}"  class="validate[required,custom[onlyLetter]] inputTxtField {$disable_class}" maxlength="15"  />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
               <!-- <tr>
                  <td align="left" valign="top" class="labels"><strong>SSN:</strong></td>
                  <td align="left"><input type="text" name="ssn" id="ssn" value="{$ssn}" class="validate[required] inputTxtField" maxlength="11"   />
                    &nbsp;<span class="SmallnoteTxt">*</span>
                    <input type="hidden" name="hidssn" id="hidssn" value="{$hidssn}" /></td>
                </tr>-->
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Hourly Rate:</strong></td>
                  <td align="left"><input type="text" name="hrate" id="hrate" value="{$hrate}" class="validate[] inputTxtField" maxlength="5"   />
                    &nbsp;<span class="SmallnoteTxt">($)</span>
                    <input type="hidden" name="hidssn" id="hidssn" value="{$hidssn}" /></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Incentive per run:</strong></td>
                  <td align="left"><input type="text" name="per_run" id="per_run" value="{$data.per_run}" class=" validate[] inputTxtField" maxlength="5"   />
                    &nbsp;<span class="SmallnoteTxt">($) </span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Incentive per mile:</strong></td>
                  <td align="left"><input type="text" name="per_mile" id="per_mile" value="{$data.per_mile}" class=" validate[] inputTxtField" maxlength="5"   />
                    &nbsp;<span class="SmallnoteTxt">($) </span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Driving License Number :</strong></td>
                  <td align="left"><input type="text" name="license" id="license" value="{$license}" class="validate[] inputTxtField {$disable_class}" maxlength="25"/>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Driving License Expiry Date :</strong></td>
                  <td align="left"><input type="text" name="lic_expirydate" id="lic_expirydate" value="{$lic_expirydate}" class="validate[] inputTxtField date" maxlength="10"   />
                    &nbsp;<span class="SmallnoteTxt">(mm/dd/yyyy e.g. 09/14/2010)</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Address : </strong></td>
                  <td align="left"><textarea name="addr" cols="20" class="validate[] inputTxtField" id="addr"  onKeyDown="limitText(this.form.addr,this.form.countdown1,100);" onKeyUp="limitText(this.form.addr,this.form.countdown1,100);" >{$addr}</textarea>
                    &nbsp;<span class="SmallnoteTxt">(Maximum characters: 100)</span><br />
                    <input readonly type="text" name="countdown1" size="3" value="100">
                    characters left.</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>City: </strong></td>
                  <td align="left"><input type="text" name="city" id="city" value="{$city}" class="validate[] inputTxtField" maxlength="100"  />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>State:</strong></td>
                  <td align="left"><select name="state" id="state" class="validate[] SelectBox"   >
                      <option value="">Select</option>
                      



			   {section name=n loop=$slist}



			   
                      <option value="{$slist[n].abbr}" {if $state neq ''}{if $slist[n].abbr eq $state}selected{/if}{elseif $slist[n].abbr eq 'AZ'}selected{/if}>
                      



			   {$slist[n].statename}



			   
                      </option>
                      



			   {/section}



			  
                    </select>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                <tr>
                  <td colspan="2" height="3"></td>
                </tr>
              <tr>
                  <td align="left" valign="top" class="labels"><strong>Zip :</strong></td>
                  <td align="left" valign="top"><input type="text" name="zip" id="zip" value="{$zip}" class="validate[] inputTxtField digits" maxlength="15"   />
                    &nbsp;<span class="SmallnoteTxt"> </span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Day Phone  :</strong></td>
                  <td align="left" valign="top"><input type="text" name="day_phnum" id="day_phnum" value="{$day_phnum}" class="validate[required] inputTxtField" maxlength="15"   />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Cell Number  :</strong></td>
                  <td align="left" valign="top"><input type="text" name="cell_num" id="cell_num" value="{$cell_num}" class="validate[] inputTxtField {$disable_class}" maxlength="15"  />
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
               <!-- <tr>
                  <td align="left" valign="top" class="labels"><strong>SIP:</strong></td>
                  <td align="left" valign="top"><input type="text" name="sip" id="sip" value="{$sip}" class="validate[required] inputTxtField" maxlength="15"  /></td>
                </tr>-->
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Email</strong></td>
                  <td align="left" valign="top"><input type="text" name="email" id="email" value="{$email}" class="validate[] inputTxtField email {$disable_class}" maxlength="100"  />
                    &nbsp;<span class="SmallnoteTxt">
                    <input type="hidden" name="hidemail" id="hidemail" value="{$email}" />
                    </span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Date of Birth:</strong></td>
                  <td align="left" valign="top"><input type="text" name="dob" id="dob" value="{$dob}" class="validate[] inputTxtField date {$disable_class}" maxlength="10"  onblur="age_calc(this);" />
                    &nbsp;<span class="SmallnoteTxt"> (mm/dd/yyyy e.g. 09/14/1983)</span></td>
                </tr>
                <!--<tr>
                  <td align="left" valign="top" class="labels"><strong>Age:</strong></td>
                  <td align="left" valign="top"><input name="age" type="text" class="validate[required,custom[onlyNumber]] inputTxtField digits" id="age"   value="{$age}" maxlength="2"  readonly="readonly"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>-->
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Gender:</strong></td>
                  <td align="left" valign="top"><select name="sex" id="sex" class="validate[] SelectBox" >
                      <option value="Male" {if $sex eq 'Male'}selected{/if}>Male</option>
                      <option value="Female" {if $sex eq 'Female'}selected{/if}>Female</option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                <tr>
                  <td colspan="2" height="3"></td>
                </tr>
               <!-- <tr>
                  <td align="left" valign="top" class="labels"><strong>Nationality:</strong></td>
                  <td align="left" valign="top"><select name="nationality" id="nationality" class="SelectBox"   >
                      <option value="">Select</option>
			   {section name=n loop=$clist}
                      <option value="{$clist[n].iso}" {if $clist[n].iso  eq  $nationality } selected="selected" {/if}> {$clist[n].printable_name} </option>
			   {/section}
                    </select>
                    &nbsp;</td>
                </tr>-->
                <tr>
                  <td colspan="2" height="3"></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Emergency Contact Infomation: </strong></td>
                  <td align="left" valign="top"><textarea name="emg_contactinfo" cols="20" class="validate[] inputTxtField" id="emg_contactinfo"  onKeyDown="limitText(this.form.emg_contactinfo,this.form.countdown2,100);" 



onKeyUp="limitText(this.form.emg_contactinfo,this.form.countdown2,100);" >{$emg_contactinfo}</textarea>
                    &nbsp;<span class="SmallnoteTxt"> (Maximum characters: 100)</span><br />
                    <input readonly type="text" name="countdown2" size="3" value="100">
                    characters left.</td>
                </tr>
                <!--<tr>
                  <td align="left" valign="top" class="labels"><strong>Previous Address: </strong></td>
                  <td align="left" valign="top"><textarea name="prev_addr" cols="20" class="inputTxtField " id="prev_addr" onKeyDown="limitText(this.form.prev_addr,this.form.countdown3,100);" 
onKeyUp="limitText(this.form.prev_addr,this.form.countdown3,100);">{$prev_addr}</textarea>
                    &nbsp;<span class="SmallnoteTxt"> (Maximum characters: 100)</span><br />
                    <input readonly type="text" name="countdown3" size="3" value="100">
                    characters left.</td>
                </tr>-->
                <tr style="">
                  <td valign="top"><span class="labels"><strong>Driver Status :</strong></span></td>
                  <td valign="top" align="left"><select name="drvstatus" id="drvstatus" class="validate[] SelectBox" >
                      <option value="Active" {if $drvstatus eq 'Active'}selected{/if}>Active</option>
                      <option value="Suspended" {if $drvstatus eq 'Suspended'}selected{/if}>Suspended</option>
                      <option value="Left" {if $drvstatus eq 'Left'}selected{/if}>Left</option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                  <tr>
    <td align="left" valign="top" class="labels"><strong>User Name: </strong></td>
    <td align="left" valign="top">
   <!-- <input type="hidden" name="drvstatus" value="{$drvstatus}"  />-->
    <input type="text" name="username" id="username" value="{$username}" maxlength="20" class="validate[required] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="labels"><strong>Password: </strong></td>
    <td align="left" valign="top"><input type="text" name="password" id="password" maxlength="20" value="{$password}"  class="validate[required] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>
  </tr>
  
  <tr style="display:none----;"><td></td>
  <td><div style="text-align:center; padding-left:10px;"> 
{if $udata.0.signature neq ''}<img src="../{$udata.0.signature}" width="120" height="60" />{/if}</div></td></tr>
  <tr style="display:none---;">
    <td align="left" valign="top" class="labels"><strong>Driver Signature: </strong></td>
    <td align="left" valign="top"><input type="file" name="dimage[]" style="height:23px;" id="dimage" />&nbsp;(<span style="color:#FF0000; font-size:9px; font-weight:bold;">.jpg,.png,.gif  &amp; Size WxH=> 120x60</span>)
    <input type="hidden" name="hidimage" id="hidimage" value="{$udata.0.signature}" /></td>
  </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td align="left"><input type="submit" name="submit" value="Save Changes" class="inputButton btn"  ></td>
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