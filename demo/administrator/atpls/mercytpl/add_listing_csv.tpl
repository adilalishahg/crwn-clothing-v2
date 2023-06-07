{literal} 
<script language="javascript">
   $(document).ready(function(){
    $('#addcsv').validate();
		$("#date").mask("99/99/9999");

  });
function validate(form){
	if(document.addcsv.file_csv.value!=''){
if((document.addcsv.file_csv.value.lastIndexOf(".xlsx")==-1)) {    
	alert("Please upload only .xls extention file");  
    event.returnValue=false;
	return false;
								 }
				return true;							 
	}
 }	
</script> 
{/literal}
<form name="addcsv" id="addcsv" method="post" action="add_trip_sheet.php" enctype="multipart/form-data" onsubmit="return validate(this);" >
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}
        { if $errors != ''} {$errors} {/if} </td>
    </tr>
    <tr>
      <td class="admintopheading" style="text-align:center;">Upload Trip Sheet</td>
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
            <td align="left" valign="top" width="100%"><table width="650" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td height="25" align="right" class="labeltxt"><strong>Upload Trip Sheet:</strong></td>
                  <td height="25"><input type="file" name="file_csv" id="file_csv" class="required" />
                    <span style="color:#FF0000"> * (.xlsx only)</span></td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt"><strong>Trip Date:</strong></td>
                  <td height="25"><input type="text" name="dated" class="required" id="date" />
                    <span style="color:#FF0000"> * (mm/dd/yyyy) </span></td>
                </tr>
                <!--<tr>
                  <td height="25" align="right" class="labeltxt"><strong>Select Date:</strong></td>
                  <td height="25"><select id="dt" name="dt" class="required">
                      <option value="">--Select--</option>
                      <option value="0">Current Date</option>
                      <option value="1">Next Date</option>
                    </select>
                    <span style="color:#FF0000"> * </span></td>
                </tr>-->
                <tr>
                  <td height="25">&nbsp;</td>
                  <td height="25"><input class="btn" type="submit" value="Add" name="addListing"/>
                    <input class="btn" type="reset" value="Reset" name="reset" /></td>
                </tr>
              </table></td>
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
</form>
