

{literal}

<script>

   $(document).ready(function(){

    $('#addgrid').validate();

		$("#phone").mask("999-99-9999");

  });

</script>

{/literal}



<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF">

        <tr>

          <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}

		  { if $errors != ''} {$errors} {/if} </td>

        </tr>

        <tr>

          <td class="admintopheading">View Trip Details </td>

        </tr>

        <tr>

          <td align="left" valign="top">

		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">

  <tr>

    <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>

    <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>

    <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>

  </tr>

  <tr>

    <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>

    <td align="left" valign="top" width="100%"><form name="addgrid" id="addgrid" method="post" action="edit_popup.php" enctype="multipart/form-data" >

								<table width="650" border="0" cellspacing="2" cellpadding="2">			  

							

								  <tr>

								    <td width="150" height="25" align="right" class="labeltxt">Patient Name: </td>

								    <td width="486" height="25">{$cname}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Facility / Hospital: </td>

								    <td height="25">{$clinic}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Telephone:</td>

								    <td height="25">{$phone}</td>

							      </tr>

								 

								  <tr>

								    <td height="25" align="right" class="labeltxt">Pickup Address: </td>

								    <td height="25">{$addr1}</td>

							      </tr><br>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Picked Up on time? </td>

								    <td height="25">{$pustatus}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Pickup Time: </td>

								    <td height="25">{$ptime}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Drop Time: </td>

								    <td height="25">{$dtime}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Miles:</td>

								    <td height="25">{$m1}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Staff ID:</td>

								    <td height="25">{$staff1}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Remarks:</td>

								    <td height="25">{$remarks}</td>

							      </tr>

			  </table>         

			                     <input type="hidden" value="{$sheetid}" name="sheetid" id="sheetid">   

			                    <input type="hidden" value="{$tripid}" name="tripid" id="tripid">  

								<input type="hidden" value="{$id}" name="id" id="id">

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




