<?php /* Smarty version 2.6.12, created on 2019-04-24 16:30:05
         compiled from drvtpl/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'drvtpl/index.tpl', 70, false),array('modifier', 'wordwrap', 'drvtpl/index.tpl', 76, false),)), $this); ?>
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
function rate_it(id, rate)
{
	$(\'input\',id).rating(\'select\',rate);
	//$(\'input\',id).rating(\'disable\')
}
function stchange(val)
{
  if (val != \'\'){		
 	location.href="index.php?st="+val;
	return true;}else{
			return false;
		}			
	}	
function byname(vl){ //alert(vl);
	location.href="index.php?name="+vl;
	}		
</script> 
'; ?>

<?php if ($_SESSION['driver_quota_message'] != ''): ?><p style="color:#F00; font-size:12px; text-align:center; font-weight:bold;"><?php echo $_SESSION['driver_quota_message']; ?>
</p><?php endif; ?>
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
          <td height="19" colspan="2" align="center">
          <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
          Search By Name:<input type="text" name="byname" placeholder="First Name Or Last Name Only" id="byname" value="<?php echo $this->_tpl_vars['byname']; ?>
" onblur="byname(this.value);" size="30" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a> &nbsp;|&nbsp;&nbsp; [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp;<a title="Driver Types" href="drvtypes.php">Driver Types</a>&nbsp;<?php if ($this->_tpl_vars['count'] < 20): ?>|&nbsp;<a title="Add Driver" href="add-drv.php"><img alt="Add" border="0" src="../graphics/add_12.gif"></a><?php endif; ?> </div></td>
        </tr>
        <tr>
          <td width="11%" height="19" align="center" class="admintopheading"><select name="st" id="st" onchange="return stchange(this.value);">
              <option value="">--Select--</option>
              <option value="All" <?php if ($this->_tpl_vars['st'] == 'All'): ?>selected<?php endif; ?>>All</option>
              <option value="Active" <?php if ($this->_tpl_vars['st'] == 'Active'): ?>selected<?php endif; ?>>Active</option>
              <option value="Suspended" <?php if ($this->_tpl_vars['st'] == 'Suspended'): ?>selected<?php endif; ?>>Suspended</option>
              <option value="Left" <?php if ($this->_tpl_vars['st'] == 'Left'): ?>selected<?php endif; ?>>Left</option>
            </select></td>
          <td width="89%" align="center" class="admintopheading">DRIVERS MANAGEMENT</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td  align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td  align="center" class="label_txt_heading"><strong>Code</strong></td>
                <td  align="center" class="label_txt_heading"><strong>SSN</strong></td>
                <td  align="center" width="80px" class="label_txt_heading"><strong>Name </strong></td>
                <td width="50px" align="center" class="label_txt_heading"><strong>Type </strong></td>
                <td align="center" class="label_txt_heading"><strong>Contact Information </strong></td>
               <!-- <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>	
                <td width="70px" align="center" class="label_txt_heading"><strong>Avg. Rating</strong></td><?php endif; ?>
                <td width="50px" align="center" class="label_txt_heading"><strong>Driver Trips</strong></td>-->
                <td width="50px" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['drvdetails']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <tr valign="top" bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
                <td align="center"><b><?php echo $this->_sections['q']['iteration']; ?>
.</b></td>
                <td align="center"><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['drv_code']; ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['ssn']; ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['name']; ?>
 </td>
                <td align="center"><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['dtype_name']; ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['addr'])) ? $this->_run_mod_handler('wordwrap', true, $_tmp, 30, '<br />
                  ', true) : smarty_modifier_wordwrap($_tmp, 30, '<br />
                  ', true)); ?>
, <?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['city']; ?>
<br />
                  <b><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['day_phnum']; ?>
</b></td>
                  <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>	
               <!-- <td><div class="rating"> <?php if ($this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['rating'] > 0): ?>
                    <?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['rating']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?> <img src="../theme/rate.png"/> <?php endfor; endif; ?>
                    <?php endif; ?> </div></td><?php endif; ?>-->
                <!--<td align="center"><a href="history.php?dataset=<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['drv_code']; ?>
"><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['tot']; ?>
 - Trip<?php if ($this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['trips'] > 1): ?>s<?php endif; ?></a></td>
                <td align="center"><a href="history.php?dataset=<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['drv_code']; ?>
">Trips</a></td>-->
                <td align="center"><a href="editdrv.php?id=<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['Drvid']; ?>
" title="Edit Driver"> <img border="0" alt="Edit" src="../graphics/edit.png" /></a>&nbsp;&nbsp; <!--<a href="#" onclick="return deleteRec('<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['Drvid']; ?>
');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png" /></a>--></td>
              </tr>
              <?php endfor; else: ?>
              <tr>
                <td colspan="8" align="center"><b>No Record Found</b></td>
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