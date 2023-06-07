<?php /* Smarty version 2.6.12, created on 2023-01-19 17:04:29
         compiled from dvtpl/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'dvtpl/index.tpl', 176, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo ' 
<script type="text/javascript">

function dvmap(val1,val2)

{

var brk =  Array();

var msg =  Array();

if (val1 != \'\' && val2 != \'\'){

brk = val1.split(\'^\');

$.post("cnfrm.php", {id: ""+brk[0]}, function(cnfrm)

{

//alert(\'Confirm Return : \'+ cnfrm);

if(cnfrm == 0)

{

//alert(\'i got 0 now\');

cfm = confirm(\'This Vehicle is already assign to another driver. \\ndo you really want to re-assign it?\');

if(cfm)

{

$.post("dvmap.php", {drv: ""+val2, veh:""+brk[0], vehnp:""+brk[1]}, function(data)

															   {

																  if(data.length > 0)

																  {

																	  msg = data.split(\'^\');

																  

																	  $(	"#msg").html(msg[0]);

																	  if(msg[1] == \'0\')

																	  {

																		  $("#dv"+msg[1]).html(\'Not assigned Yet\');

																			$("#dv"+val2).html(brk[1]);

																		}

																		if(msg[1] != \'0\' || msg[1] != \'fail\'  )

																		{

																			$("#dv"+msg[1]).html(\'Not assigned Yet\');

																			$("#dv"+val2).html(brk[1]);			 

																		}
							 location.reload(); 
																		return true;

																	}

});

}

else

{

return false;

}	

}

else

{

//alert(\'i got 1 now\');

$.post("dvmap.php", {drv: ""+val2, veh:""+brk[0], vehnp:""+brk[1]}, function(data)

																 {

																	if(data.length > 0)

																	{

																		msg = data.split(\'^\');

																	

																		$(	"#msg").html(msg[0]);

																		if(msg[1] == \'0\')

																		{

																			$("#dv"+msg[1]).html(\'Not assigned Yet\');

																			$("#dv"+val2).html(brk[1]);

																		}

																		if(msg[1] != \'0\' || msg[1] != \'fail\'  )

																		{

																			$("#dv"+msg[1]).html(\'Not assigned Yet\');

																			$("#dv"+val2).html(brk[1]);			 

																		}
				 location.reload(); 
																		return true;

																	}

});

}	

});

}

else

{

return false;

}	
//	location.reload();
  }	
function janoo(id){
	window.location.href = "unassign.php?id="+id;
	//alert(id)
	}
</script> 
'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td height="307"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="okmsg"><span id="msg"></span></td>
        </tr>
        <tr>
          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">DRIVERS &amp; VEHICLES MAPPING</td>
        </tr>
        <tr>
          <td align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="20%" align="center" class="label_txt_heading"><strong>Drivers</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Assigned Vehicle</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>UnAssigned</strong></td>
                <td width="35%" align="center" class="label_txt_heading"><strong>Change Assigned Vehicle</strong></td>
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
              <tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
                <td align="center" valign="middle"><?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['lname']; ?>
</td>
                <td align="center" valign="middle"><span id="dv<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['Drvid']; ?>
"><?php if ($this->_tpl_vars['dvdetails'][$this->_sections['q']['index']] == '0'): ?>Not assigned Yet<?php else:  echo $this->_tpl_vars['dvdetails'][$this->_sections['q']['index']];  endif; ?></span></td>
                <td><?php if ($this->_tpl_vars['dvdetails'][$this->_sections['q']['index']] == '0'):  else: ?><a href="#" onclick="janoo('<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['Drvid']; ?>
');" ><img alt="Un-Assign" border="0"  src="../images/icons/cross.png"></a><?php endif; ?></td>
                <td align="center" valign="middle"><select name="vtype" id="vtype" class="required" onchange="return dvmap(this.value,'<?php echo $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['Drvid']; ?>
')" style="width:300px">
                    <option value="">Select</option>
                    <?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['vlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			          
                    <option value="<?php echo $this->_tpl_vars['vlist'][$this->_sections['n']['index']]['id']; ?>
^<?php echo $this->_tpl_vars['vlist'][$this->_sections['n']['index']]['vnumber']; ?>
" <?php if ($this->_tpl_vars['vlist'][$this->_sections['n']['index']]['id'] == $this->_tpl_vars['drvdetails'][$this->_sections['q']['index']]['veh_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['vlist'][$this->_sections['n']['index']]['vnumber']; ?>
 -  <?php echo $this->_tpl_vars['vlist'][$this->_sections['n']['index']]['vname']; ?>
</option>
                    <?php endfor; endif; ?>
					
                  </select></td>
              </tr>
              <?php endfor; else: ?>
              
              <?php endif; ?>
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