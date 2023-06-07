{literal}

<script language="javascript">

	$(document).ready(function(){

							   $('#edit_men').validationEngine();

							    $('#date').mask('19/39/9999');

							   })

</script>

{/literal}

<table width="500" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td height="19" align="center" class="admintopheading">Edit Maintenance </td>

        </tr>

        <tr>

          <td height="19" align="center">&nbsp;</td>

        </tr>

        <tr>

          <td height="19" align="center"> { if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>

        </tr>

        <tr>

          <td height="44" align="center" valign="top" style="padding-bottom:50px;"><form name="editvehicle" id="edit_men" method="post" action="edit.php">

              <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:#999999 1px solid;">
 <tr>
			  	<td height="5" colspan="3"></td>
			  </tr>	
                <tr>

                  <td width="38%" align="left" valign="middle" class="labeltxt"><p><strong>Select Vehicle :</strong><span class="admintopheading">

                    <input name="r_id" type="hidden" id="r_id" value="{$data.id}" />

                  </span></p></td>

                  <td width="62%" colspan="2" align="left" valign="middle"><select name="veh_id" id="veh_id" class="validate[required]">

                    <option value="">Select Vehicle</option>

                    

                  {section name = q loop=$vehicles}

                  

                    <option value="{$vehicles[q].id}" {if $data.veh_id eq $vehicles[q].id} selected="selected"{/if}>{$vehicles[q].vname} - [{$vehicles[q].vnumber} ]</option>

                    

                  {/section}

                  

                  </select>

                    <span class="SmallnoteTxt">*</span></td>

                </tr>
 <tr>
			  	<td height="5" colspan="3"></td>
			  </tr>	
                  <tr>

                  <td width="38%" align="left" valign="middle" class="labeltxt"><p><strong>Maintenance Date:</strong></p></td>

                  <td colspan="2" align="left" valign="middle"><span class="SmallnoteTxt">

                    <input name="date" type="text"  class="validate[required] inputTxtField" id="date" value="{$data.date}"/>

                    (mm/dd/yyyy)

                    *</span></td>

                </tr>
 <tr>
			  	<td height="5" colspan="3"></td>
			  </tr>	
                <tr>

                  <td align="left" valign="middle" class="labeltxt"><strong>Maintenance Type:</strong></td>

                  <td colspan="2" align="left" valign="middle">

                  <select name="type" id="type"  class="validate[required] inputTxtField">

                  <option value="">Select Maintnance Type</option>

                  {section name = q loop=$types}

                  	<option value="{$types[q].id}" {if $types[q].id eq $data.m_type} selected="selected" {/if}>{$types[q].mentype}</option>

                  {/section}

                  </select>

                  <span class="SmallnoteTxt">*</span></td>

                </tr>
 <tr>
			  	<td height="5" colspan="3"></td>
			  </tr>	
                <tr>

                  <td align="left" valign="middle" class="labeltxt"><strong>Maintenance Description:</strong></td>

                  <td colspan="2" align="left" valign="middle"><textarea name="desc" id="desc" class="validate[required,length[6,200]]">{$data.m_description}</textarea> 

                  &nbsp;<span class="SmallnoteTxt">*</span></td>

                </tr>
 <tr>
			  	<td height="5" colspan="3"></td>
			  </tr>	
                <tr>

                  <td align="left" valign="middle" class="labeltxt"><strong>Maintenance Cost:</strong></td>

                  <td colspan="2" align="left" valign="middle"><input name="cost" type="text"  class="validate[required,custom[onlyNumber]] inputTxtField" id="cost" value="{$data.cost}" maxlength="6"/>

                  (dollars)                     &nbsp;<span class="SmallnoteTxt">*</span></td>

         <!--       </tr>

                <tr>

                  <td align="left" valign="middle" class="labeltxt"><strong>Status:</strong></td>

                  <td colspan="2" align="left" valign="middle"><select id="status" name="status">

                  <option value="">Select Status</option>

                  <option value="1">Done</option>

                  <option value="0">Pending</option>

                  </select>&nbsp;<span class="SmallnoteTxt">*</span></td>

                </tr>-->

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

                  <td colspan="2" align="center"><input type="submit" name="update" value="Update" class="inputButton btn" id="update"></td>

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

