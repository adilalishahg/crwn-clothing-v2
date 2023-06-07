{include file = headerinner.tpl}

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
	$("#phnum").mask("(999) 999-9999");	
});

</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="25" align="right" valign="top">[<a href="casemanagers.php">Back</a>]</td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="admintopheading">Add Corporate User</td>

                            </tr>

							

                            <tr>

<td height="19" align="center">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>

                            </tr>

                            <tr>

                              <td height="44" align="center"  valign="top">

							  <form name="adduser" id="adduser" method="post" action="addcm.php">

	  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">

            <tr>

              <td colspan="3" valign="top" class="admintopheading"><strong>Corporation Information</strong></td>

              </tr>

<!--            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Corporate ID:</strong></td>

              <td width="48%" align="left"><input type="text" name="hid" id="hid" value="{$hid}" class="inputTxtField" />&nbsp;<span class="SmallnoteTxt">*</span></td>

              <td width="14%" align="left">&nbsp;</td>

            </tr>-->

            <tr align="left">

              <td width="38%" valign="top" class="labeltxt"><strong>Corporation Name:</strong></td>

              <td colspan="2">

			  <select name="hosp_name" id="hosp_name" class="validate[required]">

			    <option value="">Select</option>

				{section name=r loop=$hospitals}

				<option value="{$hospitals[r].id}">{$hospitals[r].hospname}</option>

				{/section}

			  </select>

			  &nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr align="left">

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr align="left">

              <td colspan="3" valign="top" class="admintopheading"><strong>Corporate User Information</strong></td>

              </tr>

           <tr align="left">

              <td width="38%" valign="top" class="labeltxt"><strong>First Name:</strong></td>

              <td colspan="2"><input type="text" name="fname" id="fname" value="{$fname}" class="validate[required,custom[onlyLetter]] inputTxtField" maxlength="50" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr align="left">

              <td valign="top" class="labeltxt"><strong>Last Name: </strong></td>

              <td colspan="2"><input type="text" name="lname" id="lname" value="{$lname}" class="validate[required,custom[onlyLetter]] inputTxtField" maxlength="50" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr align="left">

              <td valign="top" class="labeltxt"><strong>Phone: </strong></td>

              <td colspan="2"><input type="text" name="phnum" id="phnum" value="{$phnum}" class="validate[required] inputTxtField" maxlength="14" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr align="left">

              <td valign="top" class="labeltxt"><strong>Email Address: </strong></td>

              <td colspan="2"><input type="text" name="email" id="email" value="{$email}" class="validate[required,custom[email]] inputTxtField email" maxlength="100" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr align="left">

              <td colspan="3" valign="top">&nbsp;</td>

              </tr>

            <tr align="left">

              <td colspan="3" valign="top"  class="admintopheading"><strong>Account Information</strong></td>

            </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Username:</strong></td>

              <td align="left" valign="top"><input type="text" name="username" id="username" value="{$username}" class="validate[required,custom[noSpecialCaracters]] inputTxtField" maxlength="20" />&nbsp;<span class="SmallnoteTxt">*</span></td>

              <td valign="top">&nbsp;</td>

            </tr>

            <tr align="left">

              <td valign="top" class="labeltxt"><strong>Password:</strong></td>

              <td colspan="2" valign="top"><input name="pwd1" type="text" class="validate[required,legnth[5,15]] inputTxtField" id="pwd1" onblur="return chkPass();" maxlength="15" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr align="left">

              <td valign="top" class="labeltxt"><strong>Confirm Password :</strong></td>

              <td colspan="2" valign="top"><input name="pwd2" type="text"  class="validate[required,confirm[pwd1],legnth[5,15]] inputTxtField" id="pwd2" onblur="return chkPass();" maxlength="15" />&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>


            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Status :</strong></td>

              <td align="left" valign="top">

			  <select name="ustatus" id="ustatus" class="validate[required]">

			    <option value="">Select</option>

				<option value="0" {if $ustatus eq '0'}selected{/if}>Inactive</option>

				<option value="1" {if $ustatus eq '1'}selected{/if}>Active</option>             			              </select>&nbsp;<span class="SmallnoteTxt">*</span>			  </td>

              <td valign="top">&nbsp;</td>

            </tr>

            <tr align="left">

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td colspan="3" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td valign="top">&nbsp;</td>

              <td colspan="2" align="center">

			  <input type="submit" name="submit" value="Submit" class="inputButton btn"  />

			  <input type="reset" name="reset" value="Reset" class="inputButton btn"  />			  </td>

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

