{literal}
<script language="JavaScript">
var gAutoPrint = true; // Flag for whether or not to automatically call the print function

function printSpecial()
{
	if (document.getElementById != null)
	{
		var html = '<HTML>\n<HEAD>\n';

		if (document.getElementsByTagName != null)
		{
			var headTags = document.getElementsByTagName("head");
			if (headTags.length > 0)
				html += headTags[0].innerHTML;
		}
		
		html += '\n</HE' + 'AD>\n<BODY>\n';
		
		var printReadyElem = document.getElementById("printReady");
		
		if (printReadyElem != null)
		{
				html += printReadyElem.innerHTML;
		}
		else
		{
			alert("Could not find the printReady section in the HTML");
			return;
		}
			
		html += '\n</BO' + 'DY>\n</HT' + 'ML>';
		
		var printWin = window.open("","printSpecial");
		printWin.document.open();
		printWin.document.write(html);
		printWin.document.close();
		if (gAutoPrint)
			printWin.print();
	}
	else
	{
		alert("Sorry, the print ready feature is only available in modern browsers.");
	}
}

</script>

<script type="text/javascript">
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

	$(document).ready(function() {
	$("#affregister").validate()
    }

);

</script>
{/literal}
<table width="100%" border="0" cellpadding="4" cellspacing="0">
			<tr>
			  <td align="center"><span class="headingbg">{ if $msgs != ''} {$msgs} {/if}
		  { if $errors != ''} {$errors} {/if} </span></td>
	   </tr>
			<tr>
			  <td align="left" valign="top">
			  <div id="printReady">
			  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
        <tr>
          <td class="admintopheading">Resume for the post of {$position}</td>
          </tr>
        <tr>
          <td align="left" valign="top">
		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>
    <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
    <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>
  </tr>
  <tr>
    <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
    <td align="left" valign="top"><form name="editPage" id="editPage" >
							  <table width="100%" border="0" cellspacing="10" cellpadding="5">
								  <tr>
									<td colspan="2"></td>
								  </tr>   
                                  <tr>
                                    <td height="25" class="labeltxt" align="right">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">Press 'Esc' to Close </td>
                                  </tr>
								  <tr>
									<td colspan="2" height="25" align="left"><strong>Personal Information</strong><hr /></td>									
								  </tr>
                                  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Sender Name:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="name" type="text" id="name" value="{$name}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Sender Email:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="email" type="text" id="email" value="{$email}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Phone:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="phone" type="text" id="phone" value="{$phone}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Position:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="position" type="text" id="position" value="{$position}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Address:</strong></td>
									<td height="25" >&nbsp;<div id="printReady"><textarea cols="50" rows="3" readonly="readonly" style="height:auto; overflow:visible; width:auto">{$address}</textarea>
									</div></td>
								  </tr>                          
								  <tr>
									<td colspan="2" height="25" align="left"><strong>Educational Information</strong><hr /></td>									
								  </tr>
                                  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Degree:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="degree" type="text" id="degree" value="{$degree}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Institute:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="institute" type="text" id="institute" value="{$institute}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>CGPA/Grade:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="grade" type="text" id="grade" value="{$grade}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td colspan="2" height="25" align="left"><strong>Experience</strong><hr /></td>									
								  </tr>
                                  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Experience:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="experience" type="text" id="experience" value="{$experience}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Employer:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="employer" type="text" id="employer" value="{$employer}" size="30" readonly="readonly" /></td>
								  </tr>
								  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Designation:</strong></td>
									<td width="76%" class="labeltxt" height="25"><input name="designation" type="text" id="designation" value="{$designation}" size="30" readonly="readonly" /></td>
								  </tr>								  
								  <tr>
									<td colspan="2" height="25" class="labeltxt" align="right" valign="top" style="padding-top:30px"><strong><input type="button" name="button" value="Print Contents" class="btn" onclick="javascript:void(printSpecial())" /></strong><input type="hidden" name="hidpgname" value="{$hdpgname}" /></td>
								  </tr>
								  
								  
					</table>
								
								</form></td>
    <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>
    <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
    <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
  </tr>
</table>		  </td>
        </tr>
      </table>		</div>	  </td>
			</tr>
	  </table> 

