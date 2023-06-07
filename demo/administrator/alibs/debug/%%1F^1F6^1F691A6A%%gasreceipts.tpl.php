<?php /* Smarty version 2.6.12, created on 2019-04-24 16:00:26
         compiled from reportstpl/gasreceipts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'reportstpl/gasreceipts.tpl', 80, false),array('modifier', 'date_format', 'reportstpl/gasreceipts.tpl', 83, false),array('modifier', 'string_format', 'reportstpl/gasreceipts.tpl', 90, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo ' 
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
function aga(val)
{ 	if(val ==\'drivers\')
	{$(\'#drivers\').show(\'slow\'); $(\'#vehicles\').hide(\'slow\');}
	else
	{$(\'#drivers\').hide(\'slow\'); $(\'#vehicles\').show(\'slow\');}
}
$(document).ready(function(){	
$("#startdate").datepicker( {yearRange:\'-120:00\', dateFormat: \'mm/dd/yy\'} );
$("#enddate").datepicker( {yearRange:\'-120:00\', dateFormat: \'mm/dd/yy\'} );
$(\'#adduser\').validate();
});
</script> 
'; ?>

<table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
              [<a href="javascript:history.back();">Back</a>]</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">Gas Receipts Report</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="" method="post" id="adduser">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
                  <tr>
                  <td width="5%" class="labeltxt"><strong>From:</strong></td>
                  <td width="20%" ><input type="text" name="startdate" id="startdate" value="<?php echo $this->_tpl_vars['post']['startdate']; ?>
" class="required" size="10"/>(mm/dd/yyyy)</td>
                  <td width="5%"  class="labeltxt"><strong>To:</strong>&nbsp;</td>
                  <td width="20%" ><input type="text" name="enddate" id="enddate" value="<?php echo $this->_tpl_vars['post']['enddate']; ?>
" class="required" size="10" />(mm/dd/yyyy)</td>
                   <td width="9%" class="labeltxt"><strong>Report By</strong></td>
                  <td width="15%"><input type="radio" name="reportby" value="drivers" <?php if ($this->_tpl_vars['post']['reportby'] == 'drivers'): ?> checked="checked"<?php endif; ?> onchange="aga(this.value)"/> Drivers
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="reportby" value="vehicles"  <?php if ($this->_tpl_vars['post']['reportby'] == 'vehicles'): ?> checked="checked"<?php endif; ?>  onchange="aga(this.value)"/> Vehicles</td>
                  <td width="30%"  colspan="2">
                  <span id="drivers" style="display:none">
                  <strong>Drivers:</strong>&nbsp; 
                  <select name="driver_id" >
                      <option value="">Select Driver</option>
            <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['drivers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <option value="<?php echo $this->_tpl_vars['drivers'][$this->_sections['q']['index']]['drv_code']; ?>
" <?php if ($this->_tpl_vars['drivers'][$this->_sections['q']['index']]['drv_code'] == $this->_tpl_vars['post']['driver_id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['drivers'][$this->_sections['q']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['drivers'][$this->_sections['q']['index']]['lname']; ?>
  - [ <?php echo $this->_tpl_vars['drivers'][$this->_sections['q']['index']]['drv_code']; ?>
 ]</option>
            <?php endfor; endif; ?>
                    </select></span>
                    <span id="vehicles" style="display:none">
                  <strong>Vehicles:</strong>&nbsp; 
                  <select name="veh_id" >
                      <option value="">Select Vehicle</option>
            <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['vehicles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <option value="<?php echo $this->_tpl_vars['vehicles'][$this->_sections['q']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['vehicles'][$this->_sections['q']['index']]['id'] == $this->_tpl_vars['post']['veh_id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['vehicles'][$this->_sections['q']['index']]['vname']; ?>
 - [ <?php echo $this->_tpl_vars['vehicles'][$this->_sections['q']['index']]['vnumber']; ?>
 ]</option>
            <?php endfor; endif; ?>
                    </select></span>
                    </td>
                </tr>
                <tr>
                  <td align="left" colspan="2" valign="top">&nbsp;</td>
                  <td colspan="2" align="left" valign="top"><input type="submit" name="submit" id="submit" value='&nbsp;&nbsp;&nbsp;Show Report&nbsp;&nbsp;&nbsp;' class="inputButton btn"  />
                    &nbsp;
                    <input type="reset" name="reset" value='&nbsp;Reset&nbsp;' class="inputButton btn"  /></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table11">
              <tr class="admintopheading">
                <td width="2%" align="center"><strong>#</strong></td>
                <td width="6%" align="center"><strong> Date </strong></td>
                <td width="10%" align="center"><strong> Driver </strong></td>
                <td width="10%" align="center"><strong> Vehicle </strong></td>
                <td width="7%" align="center"><strong> Mileage </strong></td>
                <td width="7%" align="center"><strong> Total Gallon </strong></td>
                <td width="10%" align="center"><strong> Price Per Gallon </strong></td>
                <td width="8%" align="center"><strong> Total Amount </strong></td>
                <td width="13%" align="center"><strong> Options </strong></td>
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
                
                <td align="center" valign="top"><p><?php echo $this->_sections['q']['iteration']; ?>
</p></td>
                <td align="center" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['uploadedon'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
 </td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['driver']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['vehicle']; ?>
</td>
                
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['current_vehicle_milage']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['total_galon']; ?>
</td>
                <td align="center" valign="top"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['price_per_galon']; ?>
</td>
                <td align="center" valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['receipt_amount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
                
                <td align="center" valign="top"><a href="receiptdetail.php?id=<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['id']; ?>
" rel="facebox" >View Receipt</a> | <a href="edit_receipt.php?id=<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['id']; ?>
&startdate=<?php echo $this->_tpl_vars['post']['startdate']; ?>
&enddate=<?php echo $this->_tpl_vars['post']['enddate']; ?>
&reportby=<?php echo $this->_tpl_vars['post']['reportby']; ?>
&reportby=<?php echo $this->_tpl_vars['post']['reportby']; ?>
&driver_id=<?php echo $this->_tpl_vars['post']['driver_id']; ?>
&veh_id=<?php echo $this->_tpl_vars['post']['veh_id']; ?>
" rel="facebox" >Edit Info</a></td>
                 </tr>
              <?php endif; ?>
              <?php endfor; else: ?>
              <tr>
                <td colspan="7" align="center" ><b>No Record Found</b></td>
              </tr>
              <?php endif; ?>
            </table></td>
        </tr>
        
      </table>
 <?php echo '<script>aga(\'';  echo $this->_tpl_vars['post']['reportby'];  echo '\');</script>'; ?>
     
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 