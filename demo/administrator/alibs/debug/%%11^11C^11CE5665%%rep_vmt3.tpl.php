<?php /* Smarty version 2.6.12, created on 2019-04-24 16:00:21
         compiled from reportstpl/rep_vmt3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'reportstpl/rep_vmt3.tpl', 143, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo ' 
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   $(\'#searchReport\').validate();
						   $(\'#hosp\').attr(\'disabled\', true);
						   });
function other()
{
	val = document.getElementById(\'hospname\').value;
	if(val ==\'other\')
	{
	$(\'#hosp\').attr(\'disabled\', false);
	}
	else
	{
	 $(\'#hosp\').attr(\'disabled\', true);
	}
}
$(document).ready(function(){	

$("#startdate").datepicker( {yearRange:\'-120:00\', dateFormat: \'mm/dd/yy\'} );
$("#enddate").datepicker( {yearRange:\'-120:00\', dateFormat: \'mm/dd/yy\'} );
});
</script> 
'; ?>

<table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
            <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> <?php if ($this->_tpl_vars['noReq'] != '0'): ?>
              [<a href="javascript:history.back();">Back</a>]<?php endif; ?></div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">DISPATCH REPORTS</td>
        </tr>
           <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="rep.php" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
                  <tr>
                  <td width="15%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                  <td width="20%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="<?php echo $this->_tpl_vars['stdate']; ?>
" class="required" size="10"/>     (mm/dd/yyyy)</td>
                  <td width="10%"  align="left" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                  <td width="20%"  align="left" valign="top" ><input type="text" name="enddate" id="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" class="required" size="10" />       (mm/dd/yyyy)</td>
                  <td width="10%" align="left" valign="top" class="labeltxt"><strong>Driver:</strong></td>
                  <td width="30%" align="left" valign="top"><select name="driver_id" id="driver">
                      <option value="">Select Driver</option>
                      
            <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['driver']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>
                
                      <option value="<?php echo $this->_tpl_vars['driver'][$this->_sections['q']['index']]['drv_code']; ?>
" <?php if ($this->_tpl_vars['driver'][$this->_sections['q']['index']]['drv_code'] == $this->_tpl_vars['drv_id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['driver'][$this->_sections['q']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['driver'][$this->_sections['q']['index']]['lname']; ?>
  - [ <?php echo $this->_tpl_vars['driver'][$this->_sections['q']['index']]['drv_code']; ?>
 ]</option>
                      
            <?php endfor; endif; ?>
              
                    </select></td>
                </tr>
                <tr>
                  
                  
                </tr>
                
                <tr><td align="left" valign="top" class="labeltxt"><strong><strong>Patient Name:</strong></strong></td>
                  <td align="left" valign="top"><input type="text" name="pname" id="pname" value="<?php echo $this->_tpl_vars['pname']; ?>
" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div> </td>
                  <td align="left" valign="top"  class="labeltxt"><strong>Status:</strong></td>
                  <td align="left"><select  id="status" name="status">
                      <option value="">Select Status</option>
                      <option value="9" <?php if ($this->_tpl_vars['status'] == '9'): ?> selected="selected" <?php endif; ?> >Pending</option>
                      <option value="5" <?php if ($this->_tpl_vars['status'] == '5'): ?> selected="selected" <?php endif; ?> >In Progress</option>
                      <option value="3" <?php if ($this->_tpl_vars['status'] == '3'): ?> selected="selected" <?php endif; ?> >Cancelled</option>
                      <option value="2" <?php if ($this->_tpl_vars['status'] == '2'): ?> selected="selected" <?php endif; ?> >Rescheduled</option>
                      <option value="4" <?php if ($this->_tpl_vars['status'] == '4'): ?> selected="selected" <?php endif; ?> >Completed</option>
                      <option value="8" <?php if ($this->_tpl_vars['status'] == '8'): ?> selected="selected" <?php endif; ?> >Non Billable No-Show</option>
                      <option value="7" <?php if ($this->_tpl_vars['status'] == '7'): ?> selected="selected" <?php endif; ?> >Billable No-Show</option>
                    </select></td>
                  <td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
             <td align="left" valign="top">
                <select name="hospname" class=" txt_boxX" id="hospname"  >
                      <option value="">Select Account</option>
                      			  <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['hosp']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>	
                 <option value="<?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['hosp'][$this->_sections['q']['index']]['id'] == $this->_tpl_vars['hospname']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['account_name']; ?>
</option>
                      <?php endfor; endif; ?>
                    </select>
              </td>
                </tr>
                <!--<tr><td align="left" valign="top" class="labeltxt"><strong>Company Code :</strong></td>

              <td colspan="1" align="left" valign="top"><select name="code" class=" txt_boxX" id="code"  >
                      <option value="">All</option>
                      			  <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['ccode']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>	
                 <option value="<?php echo $this->_tpl_vars['ccode'][$this->_sections['q']['index']]['code']; ?>
" <?php if ($this->_tpl_vars['ccode'][$this->_sections['q']['index']]['code'] == $this->_tpl_vars['code']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['ccode'][$this->_sections['q']['index']]['code']; ?>
 - - <?php echo $this->_tpl_vars['ccode'][$this->_sections['q']['index']]['company']; ?>
</option>
                      <?php endfor; endif; ?>
                    </select></td></tr>-->
                <tr>
                                 <td></td> <td colspan="6" align="left" valign="top"><font style="color:#F00;">
                    <ol>
                    <li>  <?php if ($this->_tpl_vars['totalRows'] != ''):  endif; ?>[ Total Trips : <?php echo $this->_tpl_vars['totalRows']; ?>
 ]&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['tmiles'] != ''):  endif; ?>[ Total Miles : <?php echo $this->_tpl_vars['tmiles']; ?>
 ]</li>
                    <li>[Pending: <?php echo $this->_tpl_vars['st9']; ?>
] [In Progress: <?php echo $this->_tpl_vars['st5']; ?>
] [Cancelled: <?php echo $this->_tpl_vars['st3']; ?>
] [Rescheduled: <?php echo $this->_tpl_vars['st2']; ?>
] [Completed: <?php echo $this->_tpl_vars['st4']; ?>
] [Non Billable No-Show: <?php echo $this->_tpl_vars['st8']; ?>
] [Billable No-Show: <?php echo $this->_tpl_vars['st7']; ?>
]</li>
                    </ol>
                    </font></td>
                </tr>
                <tr>
                  <td align="left" colspan="1" valign="top">&nbsp;</td>
                  <td colspan="3" align="left" valign="top"><input type="submit" name="submit" id="submit" value='&nbsp;&nbsp;Show Report&nbsp;&nbsp;' class="inputButton btn"  />
                    &nbsp;&nbsp;&nbsp;
                    <input type="submit" name="submit2" id="submit2" value='&nbsp;&nbsp;Export CSV&nbsp;&nbsp;' class="inputButton btn"  />
                    &nbsp;&nbsp;&nbsp;
                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  />
                    &nbsp;<input type="button" onclick="javascript:location.reload();" value="&nbsp;&nbsp;Reload Page&nbsp;&nbsp;" class="btn" /> </td>
                </tr>
              </table>
            </form></td>
        </tr>
        <!--<tr>
          <td colspan="2" align="center"  valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center"  valign="top" height="35">&nbsp;</td>
        </tr>-->
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table11">
              <tr class="admintopheading">
               <!-- <td width="`15%" align="center"><strong>Facility</strong></td>-->
                <td width="10%" align="center"><strong>Patient Name </strong></td>
                <!--<td width="15%" align="center"><strong> Appointment Type </strong></td>-->
                <td width="10%" align="center"><strong> Driver </strong></td>
                <td width="15%" align="center"><strong> Pick Address</strong></td>
                <td width="15%" align="center"><strong>Drop Address</strong></td>
                <td width="7%" align="center"><strong> Date</strong></td>
                <td width="5%" align="center"><strong>Schedule Pick Time</strong></td>
                
                <td width="5%" align="center"><strong>Actual<br/><?php if ($this->_tpl_vars['status'] == '3'): ?>Cancelled
                <?php elseif ($this->_tpl_vars['status'] == '7' || $this->_tpl_vars['status'] == '8'): ?>No Show
                <?php else: ?>Pick<?php endif; ?>Time</strong></td>
                <td width="5%" align="center"><strong> Miles</strong></td>
                <!--<td width="5%" align="center"><strong>Rating</strong></td>-->
                <td width="5%" align="center">Option</td>
              </tr>
              <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>
              <?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['rows'] != '0'): ?>
              <tr id="tr<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#dfedfa"), $this);?>
">
                <!--<td align="left" valign="top"><strong><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_clinic']; ?>
</strong></td>-->
                <td align="center" valign="top"><p><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_user']; ?>
</p></td>
                
                <!--<td align="center" valign="top"><p><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['phyaddress'] != ''): ?>Specialist<?php else: ?>General Medicine<?php endif; ?></p></td>-->
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['name']; ?>
 <br>
                  [<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['drv_id']; ?>
]<?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['escort_id'] == $this->_tpl_vars['drv_id']): ?>}<br /><span style="color:#F00;">ESCORT</span><?php endif; ?></td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_add']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_add']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['date']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time']; ?>
</td>
                <td align="center" valign="top">
                <?php if ($this->_tpl_vars['status'] == '7' || $this->_tpl_vars['status'] == '8' || $this->_tpl_vars['status'] == '3'):  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['ac_noshowcancell']; ?>

                <?php else:  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'];  endif; ?>
                </td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_miles']; ?>
</td>
               <!-- <td align="center" valign="top"><div class="rating1" style="width:60px;"  title="<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['comments']; ?>
"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['drv_rating'] > 0): ?>
                    <?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['data'][$this->_sections['q']['index']]['drv_rating']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?> <img src="../theme/rate.gif" width="8px" height="8px"/> <?php endfor; endif; ?>
                    <?php endif; ?></div></td>-->
                <td align="center" valign="top">
                <a href="edit_trip.php?tdid=<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['tdid']; ?>
" title="Edit" target="_blank"> <img border="0" alt="Edit" src="../graphics/edit.png"></a><br/>
                <a href="javascript:popWind('details.php?id=<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['tdid']; ?>
');">View Detail</a></td>
              </tr>
              <?php endif; ?>
              <?php endfor; else: ?>
              <tr>
                <td colspan="7" align="center" ><b>No Record Found</b></td>
              </tr>
              <?php endif; ?>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><?php if ($this->_tpl_vars['totalRows'] > 0):  echo $this->_tpl_vars['pages'];  endif; ?></td>
        </tr>
      </table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 