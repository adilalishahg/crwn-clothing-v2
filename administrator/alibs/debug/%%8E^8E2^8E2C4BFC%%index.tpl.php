<?php /* Smarty version 2.6.12, created on 2023-01-18 15:32:44
         compiled from accounts/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'accounts/index.tpl', 108, false),)), $this); ?>
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
function byname(vl){ //alert(vl);
	location.href="index.php?name="+vl;
	}
</script> 
'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="19" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
                  
                  
                  
                  <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
              </tr>
              <tr>
                <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
          Search By Account Name:<input type="text" name="byname" placeholder="Account Name" id="byname" value="<?php echo $this->_tpl_vars['byname']; ?>
" onblur="byname(this.value);" size="30" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a> &nbsp;|&nbsp;&nbsp; [<a href="javascript:history.back();">Back</a>]| <a title="Add" href="add.php"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">ACCOUNTS MANAGEMENT </td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px;"><table width="100%" border="0" class="main_table">
                    <tr>
                      <td width="20%" align="left" class="label_txt_heading"><strong>Account Name</strong></td>
                      <td width="20" class="label_txt_heading"><strong>Address</strong></td>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Phone</strong></td>
                      <td width="20%" align="left" class="label_txt_heading"><strong>Email</strong></td>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Manage Rates</strong></td>
                      <td width="10%" align="center" class="label_txt_heading"><strong>Options</strong></td>
                    </tr>
                    <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['admdetail']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <td align="left" valign="middle"><b><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['account_name']; ?>
</b></td>
                      <td align="left" valign="middle"><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['address']; ?>
, <?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['city']; ?>
, <?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['state']; ?>
 <?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['zip']; ?>
</td>
                      <td align="left" valign="middle"><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['phone']; ?>
</td>
                      <td align="left" valign="middle"><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['email']; ?>
</td>
                      <td align="left" valign="middle">
                      <?php if ($this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['id'] == $this->_tpl_vars['logiticid']): ?><a href="../rate_management2/index.php?id=<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['id']; ?>
"><span style="color:#F00;">Manage</span></a><?php else: ?>
                      <a href="../rate_management/index.php?id=<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['id']; ?>
"><span style="color:#F00;">Manage</span></a><?php endif; ?></td>
                      <td align="center" valign="middle"><a href="edit.php?eId=<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['id']; ?>
" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp; <a href="#" onclick="return deleteRec('<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['id']; ?>
');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                    </tr>
                    <?php endfor; endif; ?>
                  </table></td>
              </tr>
              <tr>
                <td align="center"><?php echo $this->_tpl_vars['paging']; ?>
</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 