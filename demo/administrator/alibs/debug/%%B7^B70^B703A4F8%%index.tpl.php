<?php /* Smarty version 2.6.12, created on 2019-04-24 16:31:54
         compiled from vehtpl/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'vehtpl/index.tpl', 120, false),array('modifier', 'wordwrap', 'vehtpl/index.tpl', 123, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<?php echo ' 
<script type="text/javascript">



function deleteRec(id)



		{



		var ok;



		ok=confirm("Are you sure you want to delete this record?");



		if (ok)



		{ location.href="index.php?delId="+id;



		return true;}else{			



			return false;}



	}



	



function stchange(val)



{



  if (val != \'\'){		



 	location.href="index.php?st="+val;



	return true;}else{



			return false;



		}			



	}	



</script> 
'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
            
            
            
            <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp;<a title="Vehicle Types" href="vehtypes.php">Vehicle Types</a>&nbsp;|&nbsp;<a title="Vehicle Types" href="../maintenance/gethistory.php" rel="facebox">Maintenance History</a>&nbsp;|<a title="Vehicle Types" href="getmilhistory.php" rel="facebox"> Milage History</a>&nbsp;|&nbsp;<a title="Get Fuel History" href="getfuelhistory.php" rel="facebox">Fuel History</a>&nbsp;|&nbsp;<a title="Add Vehicle" href="addvehicle.php"><img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
        </tr>
        <tr>
          <td width="11%" height="19" align="center" class="admintopheading"><select name="st" id="st" onchange="return stchange(this.value);">
              <option value="">--Select--</option>
              <option value="All" <?php if ($this->_tpl_vars['st'] == 'All'): ?>selected<?php endif; ?>>All</option>
              <option value="Open" <?php if ($this->_tpl_vars['st'] == 'Open'): ?>selected<?php endif; ?>>Open</option>
              <option value="Suspended" <?php if ($this->_tpl_vars['st'] == 'Suspended'): ?>selected<?php endif; ?>>Suspended</option>
              <option value="Expired" <?php if ($this->_tpl_vars['st'] == 'Expired'): ?>selected<?php endif; ?>>Expired</option>
              <option value="Sold" <?php if ($this->_tpl_vars['st'] == 'Sold'): ?>selected<?php endif; ?>>Sold</option>
            </select></td>
          <td width="89%" align="center" class="admintopheading">VEHICLES MANAGEMENT</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>VIN Number</strong></td>
                <td width="25%" align="center" class="label_txt_heading"><strong>Name </strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Type </strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Assigned Miles </strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Last Re-Fill Date (mm/dd/yyyy)</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['vehdetails']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
                <td align="center" valign="middle"><b><?php echo $this->_sections['q']['iteration']; ?>
.</b></td>
                <td align="center" valign="middle"><?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['vinn']; ?>
</td>
                <td align="center" valign="middle"><?php echo ((is_array($_tmp=$this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['vname'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 30, '<br />
                  ', true) : smarty_modifier_wordwrap($_tmp, 30, '<br />
                  ', true)); ?>
</td>
                <td align="center" valign="middle"><?php if ($this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['vtype'] == ''): ?><a href="editvehicle.php?id=<?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['id']; ?>
" title="Edit Vehicle"> <?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['vehtype']; ?>
</a><?php else:  echo ((is_array($_tmp=$this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['vehtype'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 30, '<br />
                  ', true) : smarty_modifier_wordwrap($_tmp, 30, '<br />
                  ', true));  endif; ?></td>
                <td align="center" valign="middle"><strong><?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['vehmileage']; ?>
</strong></td>
                <td align="center" valign="middle"><strong><?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['refildate']; ?>
</strong></td>
                <td align="center" valign="top"><a href="editvehicle.php?id=<?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['id']; ?>
" title="Edit Vehicle"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp; <a href="addfuel.php?id=<?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['id']; ?>
" title="Manage Fuel" rel="facebox"> <img border="0" alt="Manage Fuel" src="../graphics/fuel.png" height="40" width="40"></a>&nbsp;&nbsp; <a href="#" onClick="return deleteRec('<?php echo $this->_tpl_vars['vehdetails'][$this->_sections['q']['index']]['id']; ?>
');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
              </tr>
              <?php endfor; else: ?>
              <tr>
                <td colspan="6" align="center"><b>No Record Found</b></td>
              </tr>
              <?php endif; ?>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><?php echo $this->_tpl_vars['pages']; ?>
</td>
        </tr>
      </table></td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 