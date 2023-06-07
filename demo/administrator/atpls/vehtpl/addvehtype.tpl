{literal}
<style type="text/css">



<!--



.est {



	color: #F00;



}



-->



</style>
<script>



   $(document).ready(function(){

    $('#addvehtype').validationEngine();

  });



</script> 
{/literal}
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}
      
      
      
      { if $errors != ''} {$errors} {/if} </td>
  </tr>
  <tr>
    <td class="admintopheading">Add Vehicle Type</td>
  </tr>
  <tr>
    <td align="right" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td width="17" align="right" ><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
          <td align="right" background="../images/2.jpg"></td>
          <td width="17" align="right" ><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
        </tr>
        <tr>
          <td align="right" valign="top" background="../images/4.jpg">&nbsp;</td>
          <td align="right" valign="top" width="100%"><form name="addvehtype" id="addvehtype" method="post" action="addvehtype.php">
              <table width="650" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td colspan="2"></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Vehicle Code:</strong></td>
                  <td width="74%" height="25"><input name="vcode" type="text"  class="validate[required] inputTxtField" id="vcode" value="{$vcode}" maxlength="20"/>
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Vehicle type:</strong></td>
                  <td width="74%" height="25"><input name="vehtype" type="text" class="validate[required] inputTxtField" id="vehtype" value="{$vehtype}" maxlength="200" />
                    <span class="est">*</span></td>
                </tr>
               <!-- <tr>
            <td width="40%" height="25" align="right" class="labeltxt"><strong>Pickup Charges:</strong></td>
                <td width="60%" height="25"><input name="pickup_ch" type="text" class="" id="pickup_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              
-->           
			 <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>0-3 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate3" type="text" class="" id="rate3" value="0.0" maxlength="10" />
                  &nbsp;<span class="est">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>4-6 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate6" type="text" class="" id="rate6" value="0.0" maxlength="10" />
                  &nbsp;<span class="est">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>7-10 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate10" type="text" class="" id="rate10" value="0.0" maxlength="10" />
                  &nbsp;<span class="est">* </span>&nbsp;</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>After 10 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="permile_ch" type="text" class="" id="permile_ch" value="0.0" maxlength="10"  />
                  &nbsp;<span class="est">* </span>&nbsp;(<b>per mile</b>)</td>
              </tr>
              <!--<tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>Wait Time Charges(per minute):</strong></td>
                <td width="60%" height="25"><input name="waittime_ch" type="text" class="" id="waittime_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per hour</b>) </td>
              </tr>
              <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>No Show Fee:</strong></td>
                <td width="60%" height="25"><input name="noshow_ch" type="text" class="" id="noshow_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
-->              <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>After Hours Fee:</strong></td>
                <td width="60%" height="25"><input name="afterhour_ch" type="text" class="" id="afterhour_ch" value="0.0" maxlength="10" />
                  &nbsp;<span class="est">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
             <!--  <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>Stretcher Charges:</strong></td>
                <td width="60%" height="25"><input name="stretcher_ch" type="text" class="" id="stretcher_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>2 Man Team Charges:</strong></td>
                <td width="60%" height="25"><input name="dstretcher_ch" type="text" class="" id="dstretcher_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>Bariatric Stretcher Charges:</strong></td>
                <td width="60%" height="25"><input name="bstretcher_ch" type="text" class="" id="bstretcher_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>Oxygen Charges:</strong></td>
                <td width="60%" height="25"><input name="oxygen_ch" type="text" class="" id="oxygen_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="right" class="labeltxt"><strong>Wheel Chair Rental Charges:</strong></td>
                <td width="60%" height="25"><input name="doublewheel_ch" type="text" class="" id="doublewheel_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>-->
                <!--			 <tr>
									<td width="26%" height="25" align="right" class="labeltxt"><strong>Base Charges:</strong></td>
									<td width="74%" height="25"><input name="bcharges" type="text" class="validate[required] inputTxtField" id="bcharges" value="{if $bcharges neq ''}{$bcharges}{else}0.0{/if}" maxlength="10" size="8" />&nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)
								    <span class="est">*</span></td>
								  </tr>
								   <tr>
									<td width="26%" height="25" align="right" class="labeltxt"><strong>Mile Charges:</strong></td>
									<td width="74%" height="25"><input name="mcharges" type="text" class="validate[required] inputTxtField" id="mcharges" value="{if $mcharges neq ''}{$mcharges}{else}0.0{/if}" maxlength="10" size="8" />&nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per mile</b>)
								    <span class="est">*</span></td>
								  </tr>
								   <tr>
									<td width="26%" height="25" align="right" class="labeltxt"><strong>Wait Time Charges:</strong></td>
									<td width="74%" height="25"><input name="wtcharges" type="text" class="validate[required] inputTxtField" id="wtcharges" value="{if $wtcharges neq ''}{$wtcharges}{else}0.0{/if}" maxlength="10" size="8" />&nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per hour</b>)
								    <span class="est">*</span></td>
								  </tr>
								   <tr>
									<td width="26%" height="25" align="right" class="labeltxt"><strong>Additional Charges:</strong></td>
									<td width="74%" height="25"><input name="acharges" type="text" class="inputTxtField" id="acharges" value="{if $acharges neq ''}{$acharges}{else}0.0{/if}" maxlength="10" size="8" />&nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)
								    <span class="est">*</span></td>
								  </tr> -->
                <tr>
                  <td height="25">&nbsp;</td>
                  <td height="25"><input type="submit" value="Add" name="Addvehtype" class="btn"/>
                    <input type="reset" value="Reset" name="reset" class="btn" /></td>
                </tr>
              </table>
            </form></td>
          <td align="right" valign="top" background="../images/5.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
          <td align="right" valign="top" background="../images/7.jpg">&nbsp;</td>
          <td align="right" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
        </tr>
      </table></td>
  </tr>
</table>
