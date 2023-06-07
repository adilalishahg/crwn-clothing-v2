{literal}

<script>

   $(document).ready(function(){

    $('#frm_editvehicle').validationEngine();

  });



</script>



{/literal}

<table width="500" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td height="19" align="center" class="admintopheading">Time In</td>

        </tr>

        <tr>

          <td height="19" align="center">&nbsp;</td>

        </tr>

        <tr>

          <td height="19" align="center"> { if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>

        </tr>

        <tr>

          <td height="44" align="left"  valign="top" style="padding-bottom:50px;"><form name="editvehicle" id="frm_editvehicle" method="post" action="{php}echo $_SERVER['PHP_SELF']; {/php}" onsubmit="return chkname();">

              <table width="95%" border="0" cellspacing="2" cellpadding="2" align="center" class="outer_table">

                <tr>

                  <td colspan="3" valign="top" class="admintopheading"><strong>{$name}</strong>

                    <input type="hidden" name="id" value="{$user[0].id}" /></td>

                </tr>
				<tr>
				<td colspan="3" height="5"></td>
				</tr>

                <tr>

                  <td width="38%" align="left" valign="middle" class="labeltxt"><p><strong>Driver Name :</strong></p></td>

                  <td colspan="2" align="left" valign="middle"><select name="driver" class="validate[required]" id="driver">

                      <option value="">Select Driver</option>

                      

                    

                  {section name = q loop=$drivers}

                  

                    

                      <option value="{$drivers[q].Drvid}">{$drivers[q].fname} {$drivers[q].lname}</option>

                      

                    

                  {/section}

                  

                  

                    </select>

                    <span class="SmallnoteTxt">*</span></td>

                </tr>
				<tr>
				<td colspan="3" height="5"></td>
				</tr>

                <tr>

                  <td width="38%" align="left" valign="middle" class="labeltxt"><p><strong>Date :</strong></p></td>

                  <td colspan="2" align="left" valign="middle"><span class="SmallnoteTxt">

                    <input name="date"  type="text"  class="validate[required] inputTxtField" id="date" value="{$date}" readonly="readonly"/>

                    * (mm/dd/yyyy)</span></td>

                </tr>

                <tr>

                  <td align="left" valign="middle" class="labeltxt"><strong>Time In :</strong></td>

                  <td colspan="2" align="left" valign="middle"><input name="in" type="text"  class="validate[required] inputTxtField" id="in" value="{if $time eq ''}00:00{else}{$time}{/if}" maxlength="10"/>

                    <span class="SmallnoteTxt">*                    

                    (hh:mm:ss)</span></td>

                </tr>

                <tr>

                  <td align="left" valign="middle" class="labeltxt"><strong>Start Mileage: </strong></td>

                  <td colspan="2" align="left" valign="middle"><input type="text" name="smilage" id="smilage" maxlength="10" /></td>

                </tr>

                <!--<tr>

              <td align="left" valign="top" class="labeltxt"><strong>Assigned to :</strong></td>

              <td colspan="2" align="left">

			  <select name="driver" id="driver" class="SelectBox required" >

                <option value="">Select Driver</option>

               {section name=n loop=$dlist}

			   <option value="{$dlist[n].drvid}" {if $dlist[n].drvid eq $driver}selected{/if}>{$dlist[n].fname} {$dlist[n].lname} </option>           

			   {/section}

		      </select>

                &nbsp;<span class="SmallnoteTxt">*</span> </td>

            </tr>-->

                <tr>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td valign="top">&nbsp;</td>

                  <td colspan="2"><input type="submit" name="timein" value="Update" class="inputButton btn" id="timein"></td>

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

