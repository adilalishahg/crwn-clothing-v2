{include file = headerinner.tpl}

{literal}

<script type="text/javascript">

$(document).ready(function() {

	$("#edituser").validationEngine()

	$("#phnum").mask("(999) 999-9999");	

});

</script>

{/literal}

<table width="700" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="" style="margin-bottom:10px;">



  <tr>



    <td>



<table width="100%" border="0" cellspacing="0" cellpadding="0">



                            <tr>



                              <td height="25" align="right" valign="top">[<a href="casemanagers.php">Back</a>]</td>



                            </tr>



                            



                            <tr>



                              <td height="19" align="center" class="admintopheading">Edit Casemanager  </td>



                            </tr>



<tr>



          <td height="19" align="center">&nbsp;</td>



        </tr>							



                            <tr>



<td height="19" align="center">



{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}



		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>



                            </tr>



                            <tr>



                              <td height="44" align="center"  valign="top">



                                  <form name="edituser" id="edituser" method="post" action="editcm.php?id={$id}">

    

          <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">

    

                <tr>

    

                  <td colspan="3" valign="top" class="admintopheading"><strong>Facility Information </strong></td>

    

                  </tr>

    

                <!--<tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Corporate ID:</strong></td>

    

                  <td width="48%" align="left"><input type="text" name="hid" id="hid" value="{$hid}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*

    

                    <input type="hidden" name="ohid" id="ohid" value="{$ohid}"/>

    

                  </span></td>

    

                  <td width="14%" align="left">&nbsp;</td>

    

                </tr>-->

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Facility Name:</strong></td>

    

                  <td colspan="2" align="left">		 

    

                   <select name="hosp_name" id="hosp_name" class="validate[required]">

    

                    <option value="">Select</option>

    

                    {section name=r loop=$hosp}

    

                    <option value="{$hosp[r].id}" {if $hospid eq $hosp[r].id}selected="selected"{/if}>{$hosp[r].hospname}</option>

    

                    {/section}

    

                  </select>

    

                  &nbsp;<span class="SmallnoteTxt">*</span>

    

                  </span></td>

    

                </tr>

    

                <tr align="left">

    

                  <td colspan="3" valign="top">&nbsp;</td>

    

                </tr>

    

                <tr align="left">

    

                  <td colspan="3" valign="top" class="admintopheading"><strong>Casemanager  Information</strong></td>

    

                  </tr>

    

               <tr>

    

                  <td width="38%" align="left" valign="top" class="labeltxt"><strong>First Name:</strong></td>

    

                  <td colspan="2" align="left"><input type="text" name="fname" id="fname" value="{$fname}" class="validate[required,custom[onlyLetter]] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

    

                </tr>

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Last Name:</strong></td>

    

                  <td colspan="2" align="left"><input type="text" name="lname" id="lname" value="{$lname}" class="validate[required,custom[onlyLetter]] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

    

                </tr>

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Phone:</strong></td>

    

                  <td colspan="2" align="left"><input type="text" name="phnum" id="phnum" value="{$phnum}" class="validate[required] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

    

                </tr>

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Email Address: </strong></td>

    

                  <td colspan="2" align="left"><input type="text" name="email" id="email" value="{$email}" class="validate[required,custom[email]] inputTxtField email" maxlength="100" />&nbsp;<span class="SmallnoteTxt">*</span><input type="hidden" name="hidemail" value="{$hidemail}" /></td>

    

                </tr>

    

                <tr align="left">

    

                  <td colspan="3" valign="top">&nbsp;</td>

    

                  </tr>

    

                <tr align="left">

    

                  <td colspan="3" valign="top" class="admintopheading"><strong>Account Information</strong> </td>

    

                </tr>

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Username:</strong></td>

    

                  <td align="left" valign="top"><input type="text" name="username" id="username" value="{$username}" class="validate[required,custom[noSpecialCaracters]] inputTxtField" maxlength="20" />&nbsp;<span class="SmallnoteTxt">*

    

                    <input type="hidden" name="hiduname" value="{$hiduname}" />

    

                  </span></td>

    

                  <td align="left" valign="top">&nbsp;</td>

    

                </tr>

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Password:</strong></td>

    

                  <td colspan="2" align="left" valign="top"><input type="text" name="pwd1" id="pwd1" value="{$pwd1}"  onblur="return chkPass();" class="validate[required,length[5,15]] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

    

                </tr>

    

                <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Confirm Password :</strong></td>

    

                  <td colspan="2" align="left" valign="top"><input type="text" name="pwd2" id="pwd2" value="{$pwd2}"  onblur="return chkPass();"  class="validate[required,confirm[pwd1],length[5,15]] inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

    

                </tr>

    

               

    <tr>

    

                  <td align="left" valign="top" class="labeltxt"><strong>Status :</strong></td>

    

                  <td align="left" valign="top">

    

                  <select name="ustatus" id="ustatus" class="validate[required]">

    

                    <option value="">Select</option>

    

                    <option value="0" {if $ustatus eq '0'}selected{/if}>Inactive</option>

    

                    <option value="1" {if $ustatus eq '1'}selected{/if}>Active</option>             			              </select>&nbsp;<span class="SmallnoteTxt">*</span>	

    

                   <input type="hidden" name="oustatus" id="oustatus" value="{$oustatus}"/></td>

    

                  <td align="left" valign="top">&nbsp;</td>

    

                </tr>			

    

                

    

                <tr>

    

                  <td colspan="3" align="left" valign="top">&nbsp;</td>

    

                </tr>

    

                <tr>

    

                  <td valign="top">&nbsp;</td>

    

                  <td colspan="2" align="left">

    

                  <input type="submit" name="submit" value="Submit" class="inputButton btn"  />

    

                  <input type="reset" name="reset" value="Reset" class="inputButton btn"  />			  </td>

    

                </tr>

    

              </table>

    

              </form>							  

              </td>



            </tr>



			<tr>



			   <td>&nbsp;</td>



			</tr>			



      </table>



    </td>



  </tr>



</table>		 



{ include file = innerfooter.tpl}



