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



</script>

{/literal}

<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="25" align="left" valign="top">[<a href="javascript:history.back();">Back</a>]</td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="admintopheading">Add Corporation </td>

                            </tr>

							

                            <tr>

<td height="19" align="center">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>

                            </tr>

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">

							  <form name="adduser" id="adduser" method="post" action="add.php">

	  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" class="outer_table">

            <tr>

              <td colspan="3" valign="top" class="admintopheading"><strong>Corporate Information </strong></td>

              </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Corporate ID:</strong></td>

              <td width="48%"><input type="text" name="hid" id="hid" value="{$hid}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

              <td width="14%">&nbsp;</td>

            </tr>

            <tr>

              <td width="38%" class="labeltxt" valign="top"><strong>Corporate Name:</strong></td>

              <td colspan="2"><input type="text" name="hosp_name" id="hosp_name" value="{$hosp_name}"  class="inputTxtField"/>&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Address:</strong></td>

              <td colspan="2"><input type="text" name="h_address" id="h_address" value="{$h_address}"  class="inputTxtField"/>&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>City:</strong></td>

              <td colspan="2"><input type="text" name="h_city" id="h_city" value="{$h_city}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>State:</strong></td>

              <td colspan="2">

			  <select name="h_state" id="h_state" class="SelectBox" >

			   <option value="">Select</option>

			   {section name=n loop=$states}

			   <option value="{$states[n].abbr}" {if $h_state neq ''}{if $states[n].abbr eq $h_state}selected{/if}{elseif $states[n].abbr eq 'AZ'}selected{/if}>

			   {$states[n].statename}

			   </option>

			   {/section}

			  </select>&nbsp;<span class="SmallnoteTxt">*</span>			  </td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Zipcode:</strong></td>

              <td colspan="2"><input type="text" name="h_zip" id="h_zip" value="{$h_zip}" maxlength="10" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Patient Phone:</strong></td>

              <td colspan="2"><input type="text" name="h_phone" id="h_phone" value="{$h_phone}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td colspan="3" valign="top" class="admintopheading"><strong>Contact Person Information </strong></td>

              </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>First Name:</strong></td>

              <td colspan="2"><input type="text" name="fname" id="fname" value="{$fname}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Last Name: </strong></td>

              <td colspan="2"><input type="text" name="lname" id="lname" value="{$lname}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Patient Phone: </strong></td>

              <td colspan="2"><input type="text" name="phnum" id="phnum" value="{$phnum}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Email Address: </strong></td>

              <td colspan="2"><input type="text" name="email" id="email" value="{$email}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td colspan="3" valign="top">&nbsp;</td>

              </tr>

            <tr>

              <td colspan="3" valign="top" class="admintopheading"><strong>Account Information</strong> </td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Username:</strong></td>

              <td valign="top"><input type="text" name="username" id="username" value="{$username}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*

                

              </span></td>

              <td valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Password:</strong></td>

              <td colspan="2" valign="top"><input type="password" name="pwd1" id="pwd1" class="inputTxtField" value="{$pwd1}"  />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Confirm Password :</strong></td>

              <td colspan="2" valign="top"><input type="password" name="pwd2" id="pwd2" class="inputTxtField" value="{$pwd2}"  />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td valign="top" class="labeltxt"><strong>Status :</strong></td>

              <td valign="top">

			  <select name="ustatus" id="ustatus">

			    <option value="">Select</option>

				<option value="inactive" {if $ustatus eq 'inactive'}selected{/if}>Inactive</option>

				<option value="approved" {if $ustatus eq 'approved'}selected{/if}>Approved</option>

				<option value="disapproved" {if $ustatus eq 'disapproved'}selected{/if}>Disapproved</option>

			   </select>&nbsp;<span class="SmallnoteTxt">*</span>	

			  </td>

              <td valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td valign="top">&nbsp;</td>

              <td colspan="2">

			  <input type="submit" name="submit" value="Submit" class="inputButton"  />

			  <input type="reset" name="reset" value="Reset" class="inputButton"  />			  </td>

            </tr>

          </table>

	      </form>							  </td>

            </tr>

			<tr>

			   <td>&nbsp;</td>

			</tr>			

      </table>

    </td>

  </tr>

</table>		 

{ include file = innerfooter.tpl}

