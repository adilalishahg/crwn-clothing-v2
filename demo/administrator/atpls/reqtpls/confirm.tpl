

 {literal}

<link rel="stylesheet" href="../theme/style.css" type="text/css">
<script language="javascript">
function validate(form) {


	if(document.adduser.milage.value ==''){
				
				alert('Milage is Required');
				event.returnValue=false; return false;
				
		}
		else if(document.adduser.charges.value ==''){
				
				alert('Charges are Required');
				event.returnValue=false; return false;
				
		}
		else  {event.returnValue=true; return true;}	
		
		
		
		
}
</script>

{/literal}
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                           

                            

                            <tr>

                 <td height="19" align="center" class="admintopheading">Generate HIC Form</td>

                            </tr>

							

                  

                            <tr>

                              <td height="25" align="center"  valign="top" style="padding-bottom:50px;">

							  <form name="adduser" id="adduser" method="post" action="genreport.php" onsubmit="return validate(this);">

	  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" >

         
            <tr>

              <td valign="top" class="labeltxt"><strong>Milage:</strong></td>

              <td width="52%">&nbsp;&nbsp;<input type="text" name="milage" id="milage"  class="inputTxtField required" />&nbsp;<span class="SmallnoteTxt">*</span></td>

              <td width="14%">&nbsp;</td>

            </tr>

            <tr>

              <td width="34%" class="labeltxt" valign="top"><strong>Charges:</strong></td>

              <td colspan="2">$<input type="text" name="charges" id="charges"  class="inputTxtField required"/>&nbsp;<span class="SmallnoteTxt">*</span></td>

            </tr>

          

         

            <tr>

              <td valign="top">&nbsp;</td>

              <td colspan="2">
			
             <input type="hidden" value="{$id}" id="id" name="id">
			 <input type="hidden" value="{$reqid}" id="reqid" name="reqid">
			 
			  <input type="submit" name="submit" id="submit" value="submit" class="inputButton"  />

			  <input type="reset" name="reset" value="Reset" class="inputButton"  />			  </td>

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




