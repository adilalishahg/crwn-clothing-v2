{literal}



<script>



   $(document).ready(function(){



    $('#vhistory').validationEngine();



  });



  



function gotohistory(){



  val =  $('#veh').val();



  if(val != ''){



     location.href= 'mil_history.php?id='+val;



	 return true;



    }else{ return false; }



  }  



  



</script>



{/literal}



<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">



        



        <tr>



          <td class="admintopheading">Select Vehicle to find the Milage History </td>



        </tr>



        <tr>



          <td align="left" valign="top">



		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">



  <tr>



    <td width="17" align="left" ><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>



    <td align="left" background="../images/2.jpg"></td>



    <td width="17" align="left"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>



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



								    <td width="26%" height="25" align="right" class="labeltxt"><strong>Select Vehicle:</strong></td>



								    <td width="27%" height="25">



								  <select name="veh" id="veh" class="validate[required] inputTxtField">



									<option value="">Select</option>{section name=n loop=$vlist}



									<option value="{$vlist[n].id}">{$vlist[n].vnumber}-{$vlist[n].vname}</option>{/section}



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



