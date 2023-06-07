<?php /* Smarty version 2.6.12, created on 2023-04-01 00:09:39
         compiled from mercytpl/logistic.tpl */ ?>
<?php echo '
  <script language="javascript">
    $(document).ready(function() {
      $(\'#addcsv\').validate();
      $("#date").mask("99/99/9999");

    });

    function validate(form) {
      if (document.addcsv.file_csv.value != \'\') {
        if ((document.addcsv.file_csv.value.lastIndexOf(".xlsx") == -1)) {
          alert("Please upload only .xlsx extention file");
          event.returnValue = false;
          return false;
        }
        return true;
      }
    }
  </script>
'; ?>

<form name="addcsv" id="addcsv" method="post" action="patientDataUpload.php" enctype="multipart/form-data"
  onsubmit="return validate(this);">
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <td align="center" class="headingbg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
        <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?> </td>
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
                        <?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['locs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
    					<option value="<?php echo $this->_tpl_vars['locs'][$this->_sections['n']['index']]['id']; ?>
" 
                    <?php if ($this->_tpl_vars['locs'][$this->_sections['n']['index']]['id'] == $this->_tpl_vars['post']['officelocation']): ?>selected
                    <?php endif; ?>> <?php echo $this->_tpl_vars['locs'][$this->_sections['n']['index']]['abrivation']; ?>
 -- <?php echo $this->_tpl_vars['locs'][$this->_sections['n']['index']]['location']; ?>
 </option>

                  <?php endfor; endif; ?>
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