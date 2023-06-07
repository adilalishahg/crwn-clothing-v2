{literal}

<script>

   $(document).ready(function(){

    $('#frm_addtype').validationEngine();

  });

</script>

{/literal}

<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">

        <tr>

          <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}

		  { if $errors != ''} {$errors} {/if} </td>

        </tr>

        <tr>

          <td class="admintopheading">Add Maintenance Type </td>

        </tr>

        <tr>

          <td align="left" valign="top">

		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">

  <tr>

    <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>

    <td align="left" background="../images/2.jpg"></td>

    <td width="17" align="left"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>

  </tr>

  <tr>

    <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>

    <td align="left" valign="top" width="100%">

	<form name="addtype" id="frm_addtype" method="post" action="add_type.php">

								<table width="650" border="0" cellspacing="2" cellpadding="2">

								  <tr>

									<td colspan="2"></td>

								  </tr>

								  <tr>

									<td width="26%" height="25" align="right" class="labeltxt"><strong>Type Name:</strong></td>

									<td width="74%" height="25"><input name="mentype" type="text" class="validate[required,custom[onlyLetter]] inputTxtField" id="mentype" value="{$vehtype}" maxlength="50" />

									*</td>

								  </tr>

								  <tr>

									<td height="25">&nbsp;</td>

									<td height="25">

									<input type="submit" value="Add" name="Addmentype" id="Addmentype" class="btn"/>

									<input type="reset" value="Reset" name="reset" class="btn" />									</td>

								  </tr>

			  </table>

								</form></td>

    <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>

    <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>

    <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>

  </tr>

</table>		  </td>

        </tr>

      </table>

