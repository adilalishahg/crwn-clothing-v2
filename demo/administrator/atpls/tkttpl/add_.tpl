{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

$(document).ready(function($){

						   $('#date').mask('19/39/9999');

						   });

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

<table width="1010" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>

      </tr>

      <tr>

        <td height="19" align="center" class="admintopheading">Add Ticket </td>

      </tr>

      <tr>

        <td height="19" align="center">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

          { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>

      </tr>

      <tr>

        <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="addvehicle" id="addvehicle" method="post" action="add.php">

          <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" class="outer_table">

            <tr>

              <td colspan="3" valign="top" class="admintopheading"><strong>Ticket Information </strong></td>

            </tr>

            <tr>

              <td width="38%" align="left" valign="top" class="labeltxt"><strong>Ticket Number :</strong></td>

              <td colspan="2" align="left"><input type="text" name="tck_num" id="tck_num" value="{$tck_num}"  class="inputTxtField required"/>

                &nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Driver :</strong></td>

              <td colspan="2" align="left"><select name="drv_id" id="drv_id" class="SelectBox required" >

                <option value="">Select</option>

              {section name=n loop=$dlist}

                <option value="{$dlist[n].Drvid}">{$dlist[n].fname} {$dlist[n].lname}</option>

			  {/section}

              </select>                &nbsp;<span class="SmallnoteTxt">*</span></td>

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

              <td align="left" valign="top" class="labeltxt"><strong>Vehicle:</strong></td>

              <td colspan="2" align="left">			  

			  <select name="veh_id" id="veh_id" class="SelectBox required" >

                <option value="">Select</option>

               {section name=n loop=$vlist}

			   <option value="{$vlist[n].id}" {if $vlist[n].id eq $veh_id}selected{/if}>{$vlist[n].vname} - [ {$vlist[n].vnumber}]</option>           

			   {/section}

		      </select>&nbsp;<span class="SmallnoteTxt">*</span> </td>

            </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Date:</strong></td>

              <td colspan="2" align="left"><input type="text" name="date" id="date" value="{$date}" maxlength="15" class="inputTxtField required" />

                &nbsp;<span class="SmallnoteTxt">* (mm/dd/yyyy)</span></td>

            </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Reason:</strong></td>

              <td colspan="2" align="left"><input type="text" name="reason" id="reason" value="{$reason}" class="inputTxtField required" />

                &nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Cost:</strong></td>

              <td colspan="2" align="left"><input type="text" name="cost" id="cost" value="{$cost}" class="inputTxtField digits required" maxlength="5" />

                $&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

            

            <tr>

              <td align="left" valign="top" class="labeltxt">&nbsp;</td>

              <td align="left" valign="top">&nbsp;</td>

              <td valign="top">&nbsp;</td>

            </tr>

 <!--           <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Transmission:</strong></td>

              <td colspan="2" align="left" valign="top">

			  <select name="vtransmission" id="vtransmission" class="SelectBox required" >

               <option value="">Select</option>

			   <option value="Auto" {if $vtransmission eq 'Auto'}selected{/if}>Auto</option>           

			   <option value="Manual" {if $vtransmission eq 'Manual'}selected{/if}>Manual</option>  

		      </select>

			  &nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>-->

            

            <tr>

              <td valign="top">&nbsp;</td>

              <td colspan="2"><input type="submit" name="submit" value="Add Ticket" class="inputButton"></td>

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

