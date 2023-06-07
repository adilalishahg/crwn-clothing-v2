{literal}
  <script language="javascript">
    $(document).ready(function() {
      $('#addcsv').validate();
      $("#date").mask("99/99/9999");

    });

    function validate(form) {
      if (document.addcsv.file_csv.value != '') {
        if ((document.addcsv.file_csv.value.lastIndexOf(".xlsx") == -1)) {
          alert("Please upload only .xlsx extention file");
          event.returnValue = false;
          return false;
        }
        return true;
      }
    }
  </script>
{/literal}
<form name="addcsv" id="addcsv" method="post" action="patientDataUpload.php" enctype="multipart/form-data"
  onsubmit="return validate(this);">
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}
        { if $errors != ''} {$errors} {/if} </td>
    </tr>
    <tr>
      <td class="admintopheading" style="text-align:center;">Upload Trips Sheet [ ModiVCare ]</td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
            <td align="left" background="../images/2.jpg"></td>
            <td width="17" align="left"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
          </tr>
          <tr>
            <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
            <td align="left" valign="top" width="100%">
              <table width="650" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td height="25" align="right" class="labeltxt"><strong>Upload Trips Sheet:</strong></td>
                  <td height="25"><input type="file" name="file_csv" id="file_csv" class="required" />
                    <span style="color:#FF0000"> * (.xlsx only)</span>
                  </td>
                </tr>
                <!--<tr>
                    <td height="25" align="right" class="labeltxt"><strong>Office Location:</strong></td>
                    <td height="25"><select name="officelocation"  id="officelocation"  class="required">
                      <option  value="">-- Select Office Location --</option>
                        {section name=n loop=$locs}
    					<option value="{$locs[n].id}" 
                    {if $locs[n].id eq $post.officelocation}selected
                    {/if}> {$locs[n].abrivation} -- {$locs[n].location} </option>

                  {/section}
  				    </select>
                      </td>
                  </tr> -->
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="25"><input class="btn" type="submit" value="Add" name="addListing" />
                      <input class="btn" type="reset" value="Reset" name="reset" />
                    </td>
                  </tr>
                </table>
              </td>
              <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
              <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
              <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>