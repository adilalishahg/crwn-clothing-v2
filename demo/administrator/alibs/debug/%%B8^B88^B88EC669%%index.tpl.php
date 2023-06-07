<?php /* Smarty version 2.6.12, created on 2019-04-24 15:34:58
         compiled from patientstpls/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'patientstpls/index.tpl', 67, false),)), $this); ?>
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
		location.href="index.php?did="+id;
		return true;
		}
		else
		{
			return false;
		}
	}
function aap(vl){
	if(vl==\'on\') aap=1;
	if(vl==\'off\') aap=0;
	location.href="index.php?aap="+aap;
	}	
function status(vl){
	location.href="index.php?status="+vl;
	}	
function cisid(vl){
	location.href="index.php?cisid="+vl;
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
                <td height="19" align="center">
                <!--<div align="left" id="add_div" style="padding-right:20px; padding-bottom:0px; font-weight:bold;"> Auto addition during the 1<sup>st</sup> time of Trip Request process:<select name="aap" id="aap" onchange="aap(this.value)">
                <option value="on" <?php if ($this->_tpl_vars['add_auto_patient'] == '1'): ?> selected="selected"<?php endif; ?>>ON</option><option value="off" <?php if ($this->_tpl_vars['add_auto_patient'] == '0'): ?> selected="selected"<?php endif; ?>>OFF</option></select>
                </div>-->
                <div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"><!--
            Search By Insurance ID:<input type="text" name="cisid" id="cisid" value="<?php echo $this->_tpl_vars['cisid']; ?>
" onblur="cisid(this.value);" />-->&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Search By Name:<input type="text" name="byname" id="byname" value="<?php echo $this->_tpl_vars['byname']; ?>
" onblur="byname(this.value);" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a>
               <!-- Filter Members:<select name="status" id="status" onchange="status(this.value)">
                <option value="current" <?php if ($this->_tpl_vars['status'] == 'current'): ?> selected="selected"<?php endif; ?>>CURRENT</option>
                <option value="inactive" <?php if ($this->_tpl_vars['status'] == 'inactive'): ?> selected="selected"<?php endif; ?>>INACTIVE</option></select>--> | [<a href="javascript:history.back()">Back</a>] | <a title="Add" href="add.php"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a><!-- | <a href="add_patients_xls.php" rel="facebox" >
          <img alt="Add" border="0" src="../graphics/add_xls.png" title="Upload Patients Data Through .xls" height="27" width="25"></a>| <a href="add_patients_xlsx.php" rel="facebox" >
          <img alt="Add" border="0" src="../graphics/xlsx.png" title="Upload Patients Data Through .xlsx" height="27" width="25"></a>--> </div></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">PATIENTS MANAGEMENT</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px;"><table width="100%" border="0" class="main_table">
                    <tr>
                      <td width="20%" align="left" class="label_txt_heading"><strong>Patient Name</strong></td>
                      <!--<td width="10%" align="left" class="label_txt_heading"><strong>Insurance ID</strong></td>-->
                      <td width="45%" align="left" class="label_txt_heading"><strong>Address</strong></td>
                      <td width="15%" align="left" class="label_txt_heading"><strong>Patient Phone #</strong></td>
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
                      <td align="left" valign="middle"><b><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['name']; ?>
</b></td>
                      <!--<td align="left" valign="middle"><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['insurance']; ?>
</td>-->
 <td align="left" valign="middle"><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['address']; ?>
 <?php if ($this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['roomsite'] != ''): ?>,<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['roomsite'];  endif; ?> <!--<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['city']; ?>
, <?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['state']; ?>
 <?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['zip']; ?>
--></td>
                      <td align="left" valign="middle"><?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['phone']; ?>
</td>
                      <td align="center" valign="middle"><a href="edit.php?id=<?php echo $this->_tpl_vars['admdetail'][$this->_sections['q']['index']]['id']; ?>
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