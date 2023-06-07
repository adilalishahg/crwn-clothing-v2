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

    $('#editvehtype').validationEngine();

  });



</script> 
{/literal}
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}
      
      
      
      { if $errors != ''} {$errors} {/if} </td>
  </tr>
  <tr>
    <td class="admintopheading">Edit Vehicle Type </td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
          <td align="left" background="../images/2.jpg"></td>
          <td width="17" align="left" ><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
          <td align="left" valign="top" width="100%"><form name="editvehtype" id="editvehtype" method="post" action="editvehtype.php?id={$id}">
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
                  <td width="74%" height="25"><input name="vehtype" type="text" class="validate[required] inputTxtField" id="vehtype" value="{$vehtype}" maxlength="200"  />
                    <span class="est">*</span>
                    <input type="hidden" name="hidvehtype" id="hidvehtype" value="{$hidvehtype}" /></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Pickup Charges:</strong></td>
                  <td width="74%" height="25"><input name="pickup_ch" type="text" class=" inputTxtField" id="pickup_ch" value="{$pickup_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                 <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Mile Charges:</strong></td>
                  <td width="74%" height="25"><input name="permile_ch" type="text" class=" inputTxtField" id="permile_ch" value="{$permile_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Wait Time Charges(per minute):</strong></td>
                  <td width="74%" height="25"><input name="waittime_ch" type="text" class=" inputTxtField" id="waittime_ch" value="{$waittime_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>No Show Fee:</strong></td>
                  <td width="74%" height="25"><input name="noshow_ch" type="text" class=" inputTxtField" id="noshow_ch" value="{$noshow_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>After Hours Fee:</strong></td>
                  <td width="74%" height="25"><input name="afterhour_ch" type="text" class=" inputTxtField" id="afterhour_ch" value="{$afterhour_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <!--<tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Strecher Charges:</strong></td>
                  <td width="74%" height="25"><input name="stretcher_ch" type="text" class=" inputTxtField" id="stretcher_ch" value="{$stretcher_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>-->
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>2 Man Team:</strong></td>
                  <td width="74%" height="25"><input name="dstretcher_ch" type="text" class=" inputTxtField" id="dstretcher_ch" value="{$dstretcher_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Bariatric Strecher Charges:</strong></td>
                  <td width="74%" height="25"><input name="bstretcher_ch" type="text" class=" inputTxtField" id="bstretcher_ch" value="{$bstretcher_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="26%" height="25" align="right" class="labeltxt"><strong>Oxygen Charges:</strong></td>
                  <td width="74%" height="25"><input name="oxygen_ch" type="text" class=" inputTxtField" id="oxygen_ch" value="{$oxygen_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                <tr>
                  <td width="36%" height="25" align="right" class="labeltxt"><strong>Wheel Chair Rental Charges:</strong></td>
                  <td width="74%" height="25"><input name="doublewheel_ch" type="text" class=" inputTxtField" id="doublewheel_ch" value="{$doublewheel_ch}" maxlength="200"  />
                    <span class="est">*</span></td>
                </tr>
                
                <!--	  <tr>



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



								  </tr>-->
                
                <tr>
                  <td height="25">&nbsp;</td>
                  <td height="25"><input type="submit" value="Save Changes" name="editvehtype" class="btn"/></td>
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
      </table></td>
  </tr>
</table>
