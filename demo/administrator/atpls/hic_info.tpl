{include file = mainhead.tpl}

{literal}

<script type="text/javascript">

$(document).ready(function() {

	$("#billingphone").mask("(***) ***-****");

	$("#add_user").validationEngine();

});

</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="admintopheading">HIC Details</td>

                            </tr>





							

                            <tr>

<td height="19" align="center">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">

						  <form name="add_user" id="add_user" method="post" action="hic_info.php">

	  <table width="700" border="0" cellspacing="2" cellpadding="2">

        <tr>

          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#FF0000" style="font-weight:bold">{$msgs}</font>{/if}</td>

        </tr>       

        <tr>

          <td colspan="3" align="center" valign="top">

          <table width="90%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="17" align="left" valign="top"><img src="images/1.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="images/2.jpg">&nbsp;</td>

        <td width="17" align="left" valign="top"><img src="images/3.jpg" width="17" height="17" /></td>

      </tr>

      <tr>

        <td align="left" valign="top" background="images/4.jpg">&nbsp;</td>

        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">

  <tr>

    <td colspan="2">&nbsp;</td>

    </tr>

  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Insurance Plan Name / Program Name : </b><span style="color:#FF0000">*</span><br /><input name="program" type="text" id="program" value="{$udata[0].program}" size="40" maxlength="50" class="validate[required,length[0,50]]" /></td>    

  </tr>

  <tr>

    <td colspan="2" width="29%" height="25" align="left" class="labeltxt adjust"><b>Related Corporate Condition : </b><br /><b style="font-size:11px;">Employment ?</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="condemp" value="1" {if $udata[0].condemp eq '1'} checked="checked" {/if} />&nbsp;Yes&nbsp;<input type="radio" name="condemp" value="0" {if $udata[0].condemp eq '0'} checked="checked" {/if} />&nbsp;No<br /><b style="font-size:11px;">Auto Accident ?</b>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="condauto" value="1" {if $udata[0].condauto eq '1'} checked="checked" {/if} />&nbsp;Yes&nbsp;<input type="radio" name="condauto" value="0" {if $udata[0].condauto eq '0'} checked="checked" {/if} />&nbsp;No<br /><b style="font-size:11px;">Other Accident ?</b>&nbsp;&nbsp;&nbsp;<input type="radio" name="condother" value="1" {if $udata[0].condother eq '1'} checked="checked" {/if} />&nbsp;Yes&nbsp;<input type="radio" name="condother" value="0" {if $udata[0].condother eq '0'} checked="checked" {/if} />&nbsp;No</td>

  </tr>

    <tr>

    <td colspan="2" width="29%" height="25" align="left" class="labeltxt adjust"><b>Diagnosis Or Nature of Illness/Injury :</b><span style="color:#FF0000">*</span><br /><input name="diagnosis" type="text" class="validate[required,length[0,5]]" id="diagnosis" value="{$udata[0].diagnosis}" size="40" maxlength="5" /></td>

  </tr>
  
  <tr>

    <td colspan="2" width="29%" height="25" align="left" class="labeltxt adjust"><b>Place of service :</b><span style="color:#FF0000">*</span><br /><input name="service1" type="text" class="validate[required,length[0,5]]" id="service1" value="{$udata[0].service1}" size="40" maxlength="5" /><br /><input name="service2" type="text" class="validate[required,length[0,5]]" id="service2" value="{$udata[0].service2}" size="40" maxlength="5" /></td>

  </tr>
  
  <tr>

    <td colspan="2" width="29%" height="25" align="left" class="labeltxt adjust"><b>CPT/HCPCS :</b><span style="color:#FF0000">*</span><br /><input name="cpt1" type="text" class="validate[required,length[0,10]]" id="cpt1" value="{$udata[0].cpt1}" size="40" maxlength="10" /><br /><input name="cpt2" type="text" class="validate[required,length[0,10]]" id="cpt2" value="{$udata[0].cpt2}" size="40" maxlength="10" /></td>

  </tr>

    <tr>

    <td colspan="2" width="29%" height="25" align="left" class="labeltxt adjust"><b>S Charges :</b> <span style="color:#FF0000">*</span><br /><input name="scharges" type="text" class="validate[required,length[0,10]]" id="scharges" value="{$udata[0].scharges}" size="40" maxlength="10" /></td>

  </tr>

    <tr>

    <td colspan="2" width="29%" height="25" align="left" class="labeltxt adjust"><b>Days/Units : </b><span style="color:#FF0000">*</span><br /><input name="units" type="text" class="validate[required,length[0,5]]" id="units" value="{$udata[0].units}" size="40" maxlength="5" /></td>

  </tr>

  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Rendering Providers ID # : </b><span style="color:#FF0000">*</span><br /><input name="provider" type="text" class="validate[required]" id="provider" value="{$udata[0].provider}" size="40" maxlength="15" /></td>

  </tr>

  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Federal Tax ID # : </b><span style="color:#FF0000">*</span><br /><input name="tax" type="text" class="validate[required]" id="tax" value="{$udata[0].tax}" size="40" maxlength="20" /></td>

  </tr>

  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>SSN : </b>&nbsp;&nbsp;<input type="checkbox" name="ssn" value="1" {if $udata[0].ssn eq '1'} checked="checked" {/if} /></td>

  </tr>

  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>EIN : </b>&nbsp;&nbsp;<input type="checkbox" name="ein" value="1" {if $udata[0].ein eq '1'} checked="checked" {/if} /></td>

  </tr>
  
  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Signed Title : </b><span style="color:#FF0000">*</span><br /><input name="signed" type="text" class="validate[required]" id="signed" value="{$udata[0].signed}" size="40" maxlength="50" /></td>

  </tr>

  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Billing Provider Address : </b><span style="color:#FF0000">*</span><br /><textarea name="billingaddr" id="billingaddr" cols="40" rows="5">{$udata[0].billingaddr}</textarea></td>

  </tr>
  
  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Billing Provider Phone # : </b><span style="color:#FF0000">*</span><br /><input name="billingphone" type="text" class="validate[required]" id="billingphone" value="{$udata[0].billingphone}" size="40" maxlength="15" /></td>

  </tr>
  
  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>Department Stamp : </b><span style="color:#FF0000">*</span><br /><textarea name="deptstamp" id="deptstamp" cols="40" rows="5">{$udata[0].deptstamp}</textarea></td>

  </tr>
  
  <tr>

    <td colspan="2" height="25" align="left" class="labeltxt adjust"><b>ReSubmission : </b><span style="color:#FF0000">*</span><br /><input name="resubmission" type="text" id="resubmission" value="{$udata[0].resubmission}" size="40" maxlength="50" class="validate[required,length[0,50]]" /></td>    

  </tr>	







</table>		</td>

        <td align="left" valign="top" background="images/5.jpg">&nbsp;</td>

      </tr>

      <tr>

        <td align="left" valign="top"><img src="images/6.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="images/7.jpg">&nbsp;</td>

        <td align="left" valign="top"><img src="images/8.jpg" width="17" height="17" /></td>

      </tr>

    </table>    	</td>

        </tr>

        <tr>

          <td width="48" align="right" valign="top">&nbsp;</td>

          <td width="532" colspan="2" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

          <td align="right" valign="top">&nbsp;</td>

          <td colspan="2" align="center" valign="top">

		  <input type="submit" name="add_user" id="add_user" value="Update Contact Details" class="btn" />

		  <input type="reset" name="reset" id="reset" value="   Reset   " class="btn"  />		  </td>

        </tr>

        <tr>

          <td align="right" valign="top">&nbsp;</td>

          <td colspan="2" align="left" valign="top">&nbsp;</td>

        </tr>

		<tr>

		  <td colspan="3"><!--  CONTENT DETAIL --></td>

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