{literal}



<script>



   $(document).ready(function(){



    $('#addfuel').validationEngine();



	$("#rfdate").mask("19/39/9999");	



  });



   function chk_date()



{



	date = $('#rfdate').val();



	



	















		if ( new Date(date) > new Date() )



		{



		alert('Future date is not allowed!');



		 $('#rfdate').val("");



		 return false;



		}



}



  // function chk_date()



//{



//	date = $('#rfdate').val();



//	cdate =new Date();



//	day = cdate.getDate();



//	month = cdate.getMonth();



//	year = cdate.getFullYear();



//	//curdate = month + '/'+day + '/' + year;



//	curdate = new Date(year, month, day);



//	Ardate = date.split('/');



//	entdate = new Date (Ardate[2], Ardate[0],Ardate[1]);



//	//alert(entdate + ' and ' + curdate  + ' diference :' + dif);



//	if(entdate > curdate)



//	{



//		//alert(date + ' and ' + curdate);



//		alert('Future date is not allowed!');



//	}



//}



</script>



{/literal}



<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">



        <tr>



          <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}



		  { if $errors != ''} {$errors} {/if} </td>



        </tr>



        <tr>



          <td class="admintopheading">Add Fuel </td>



        </tr>



        <tr>



          <td align="left" valign="top">



		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">



  <tr>



    <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>



    <td align="left" background="../images/2.jpg"></td>



    <td width="17" align="left" ><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>



  </tr>



  <tr>



    <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>



    <td align="left" valign="top" width="100%">



	<form name="addfuel" id="addfuel" method="post" action="addfuel.php?id={$id}">



								<table width="650" border="0" cellspacing="2" cellpadding="2">



								  <tr>



									<td colspan="2"></td>



								  </tr>



								  <tr>



								    <td height="25" align="right" class="labeltxt"><strong>Re-fill Date:</strong><span style="color:#FF0000">*</span></td>



								    <td height="25"><input type="text" name="rfdate" id="rfdate" value="{$rfdate}" class="validate[required] inputTxtField date" onblur="chk_date();" /> 



							        (mm/dd/yyyy) </td>



							      </tr>



								  <tr>



								    <td height="25" align="right" class="labeltxt"><strong>Quantity:</strong><span style="color:#FF0000">*</span></td>



								    <td height="25"><input name="qty" type="text" class="validate[required,custom[onlyNumber]] inputTxtField digits" id="qty" value="{$qty}" maxlength="2" />



								      (Gallons)</td>



							      </tr>



								  <tr>



									<td width="26%" height="25" align="right" class="labeltxt"><strong>Amount:</strong><span style="color:#FF0000">*</span></td>



									<td width="74%" height="25"><input name="amt" type="text" class="validate[required,custom[onlyNumber]] inputTxtField digits" id="amt" value="{$amt}" maxlength="4" /> 



									  (Dollars) </td>



								  </tr>



								  <tr>



									<td height="25">&nbsp;</td>



									<td height="25">



									<input type="submit" value="Add" name="AddFuel" class="btn"/>



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



