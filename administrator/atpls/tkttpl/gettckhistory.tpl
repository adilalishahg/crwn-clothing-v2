{literal}

<script>

  

function gotohistory(){

  val =  $('#veh').val();

  if(val != ''){

  

     

     location.href= 'history.php?id='+val;

	 return true;

    }else{ 

	

	alert("Select Driver From List");

	return false; }

  }  

$(document).ready(function(){
    $('#vhistory').validationEngine();
});
 

</script>

{/literal}

<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">

        

        <tr>

          <td class="admintopheading">Select Driver to find the Tickets History </td>

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

    <td align="left" valign="top" width="100%">

	<form name="vhistory" id="vhistory" method="post">

								<table width="650" border="0" cellspacing="2" cellpadding="2">

								  <tr>

									<td colspan="3"></td>

								  </tr>

								  <tr>

								    <td width="26%" height="25" align="right" class="labeltxt"><strong>Select Driver:</strong></td>

								    <td width="27%" height="25">

								  <select name="veh" id="veh" class="validate[required] inputTxtField">

									<option value="">Select</option>

									 {section name=n loop=$vlist}

				<option value="{$vlist[n].Drvid}">{$vlist[n].fname}-{$vlist[n].lname}</option>

				                      {/section}

									</select>

									</td>

							        <td width="47%"><input type="button" value="Show History" name="history" onclick="return gotohistory();" class="btn"/></td>

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

