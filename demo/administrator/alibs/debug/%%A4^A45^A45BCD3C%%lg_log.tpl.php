<?php /* Smarty version 2.6.12, created on 2019-04-24 15:47:26
         compiled from reportstpl/lg_log.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'reportstpl/lg_log.tpl', 136, false),array('modifier', 'date_format', 'reportstpl/lg_log.tpl', 143, false),)), $this); ?>
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

<table  border="0" cellspacing="0" cellpadding="0" class="outer_table" align="right" bgcolor="#FFFFFF" >
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
          <td height="19" colspan="2" align="center" class="admintopheading">LOGISTICARE LOG</td> 
        </tr>
        <!--<tr>
                              <td colspan="2" align="center"  valign="top">							  </td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"  valign="top">&nbsp;</td>
                            </tr>-->
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
               <!-- <tr>
                  <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                </tr>-->
                <tr>
                  <td width="10%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                  <td width="35%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="<?php echo $this->_tpl_vars['stdate']; ?>
" class="required" size="10"/>     (mm/dd/yyyy)</td>
                  <td width="20%"  align="left" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                  <td width="35%"  align="left" valign="top" ><input type="text" name="enddate" id="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" class="required" size="10" />       (mm/dd/yyyy)</td>
                </tr>
                <tr>
                  <td  align="left" valign="top" class="labeltxt"><strong>Driver:</strong></td>
                  <td align="left" valign="top"><select name="driver_id" id="driver" class="required"><!---->
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
                    <td align="left" valign="top"  class="labeltxt"><strong>Status:</strong></td>
                  <td align="left"><select  id="status" name="status">
                      <option value=""> All </option>
                      <!--<option value="9" <?php if ($this->_tpl_vars['status'] == '9'): ?> selected="selected" <?php endif; ?> >Pending</option>
                      <option value="5" <?php if ($this->_tpl_vars['status'] == '5'): ?> selected="selected" <?php endif; ?> >In Progress</option>-->
                      <option value="3" <?php if ($this->_tpl_vars['status'] == '3'): ?> selected="selected" <?php endif; ?> >Cancelled</option>
                      <!--<option value="2" <?php if ($this->_tpl_vars['status'] == '2'): ?> selected="selected" <?php endif; ?> >Rescheduled</option>-->
                      <option value="4" <?php if ($this->_tpl_vars['status'] == '4'): ?> selected="selected" <?php endif; ?> >Completed</option>
                      <!--<option value="8" <?php if ($this->_tpl_vars['status'] == '8'): ?> selected="selected" <?php endif; ?> >Not Going</option>-->
                      <option value="7" <?php if ($this->_tpl_vars['status'] == '7'): ?> selected="selected" <?php endif; ?> >No Show</option>
                    </select></td>
                  <!--<td align="left" valign="top" class="labeltxt"><strong><strong>Patient Name:</strong></strong></td>
                  <td align="left" valign="top"><input type="text" name="pname" id="pname" value="<?php echo $this->_tpl_vars['pname']; ?>
" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div> </td>-->
                </tr>
                <tr> </tr>
                <tr>
                  
                <td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
             <td align="left" valign="top">
                <select name="hospname" class="required txt_boxX" id="hospname">
                      <option value=""> Select Account </option>
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
 <?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['abrivation']; ?>
  <?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['location']; ?>
</option>
                      <?php endfor; endif; ?>
                    </select>
              </td>
                </tr>
                <tr>
                                 <td></td> <td colspan="3" align="left" valign="top"><font style="color:#F00;">
                    <ol>
                    <li>  <?php if ($this->_tpl_vars['totalRows'] != ''):  endif; ?>[ Total Trips : <?php echo $this->_tpl_vars['totalRows']; ?>
 ]&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['tmiles'] != ''):  endif; ?>[ Total Miles : <?php echo $this->_tpl_vars['tmiles']; ?>
 ]</li>
                    <li><!--[Pending: <?php echo $this->_tpl_vars['st9']; ?>
] [In Progress: <?php echo $this->_tpl_vars['st5']; ?>
] [Rescheduled: <?php echo $this->_tpl_vars['st2']; ?>
] --> [Completed: <?php echo $this->_tpl_vars['st4']; ?>
] [Cancelled: <?php echo $this->_tpl_vars['st3']; ?>
] [No Show: <?php echo $this->_tpl_vars['st7']; ?>
]</li>
                    </ol>
                    </font></td>
                </tr>
                <tr>
                  <td align="left" colspan="2" valign="top">&nbsp;</td>
                  <td colspan="2" align="left" valign="top">
                  <?php if ($this->_tpl_vars['yes'] == '1'): ?>
                  <a href="javascript:popWind('lg_print.php?startdate=<?php echo $this->_tpl_vars['stdate']; ?>
&enddate=<?php echo $this->_tpl_vars['enddate']; ?>
&driver_id=<?php echo $this->_tpl_vars['drv_id']; ?>
&status=<?php echo $this->_tpl_vars['status']; ?>
&hospname=<?php echo $this->_tpl_vars['hospname']; ?>
')" ><input type="button" value='Print Report' class="inputButton btn"  /></a>
                    &nbsp;<?php endif; ?>
                    <input type="hidden" value="<?php echo $this->_tpl_vars['logiticid']; ?>
" name="logiticid"  />
                    <?php if ($_SESSION['admuser']['admin_level'] == '0' || $_SESSION['adminpermission']['mtmreports_cr'] == 'on'): ?>
                  <input type="submit" name="submit" id="submit" value='Show Report' class="inputButton btn"  />
                    &nbsp;
                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  /><?php endif; ?></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr class="admintopheading">
                <!--<td width="5%" align="center"><strong>Trip #</strong></td>-->
                <td width="5%" align="center"><strong>Trip ID</strong></td>
                <td width="10%" align="center"><strong>Customer Name</strong></td>
                <!--<td width="4%" align="center"><strong>To/From</strong></td>-->
                <td width="10%" align="center"><strong>Scheduled</strong></td>
                <td width="10%" align="center"><strong>Actual Pickup</strong></td>
                <td width="10%" align="center"><strong>Actual Drop</strong></td>
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
                <!--<td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['ccode']; ?>
</td>-->
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['ccode']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_user']; ?>
</td>
                <!--<td align="center" valign="top">
                <?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['type'] == 'AB'): ?>T<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['type'] == 'BF'): ?>F<?php endif; ?></td>-->
                <td align="center" valign="top"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'] == '00:00:00'): ?>--:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M") : smarty_modifier_date_format($_tmp, "%I:%M")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p"));  endif; ?></td>
                <td align="center" valign="top"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'] == '00:00:00'): ?>--:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M") : smarty_modifier_date_format($_tmp, "%I:%M")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p"));  endif; ?></td>
                <td align="center" valign="top"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'] == '00:00:00'): ?>--:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M") : smarty_modifier_date_format($_tmp, "%I:%M")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p"));  endif; ?></td>
                <td align="center" valign="top"><a href="javascript:popWind('details.php?id=<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['tdid']; ?>
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
      </table></td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 