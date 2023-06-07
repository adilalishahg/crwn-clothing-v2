<?php /* Smarty version 2.6.12, created on 2023-01-26 22:31:39
         compiled from rate_management2/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'rate_management2/index.tpl', 81, false),)), $this); ?>
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
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{ location.href="index.php?del_id="+id;
		return true;}else{			
			return false;}
	}
function add_form(val){
	if (val != \'\'){		
	$(\'#add_rates\').show();
 	//location.href="index.php?st="+val;
	}else{
		$(\'#add_rates\').hide();
			}			
	}
function add_rates2(){
	var rate3	 		= $(\'#rate3\').val();
	var permile_ch 		= $(\'#permile_ch\').val();
	var rate6 			= $(\'#rate6\').val();
	var rate10 			= $(\'#rate10\').val();
	var afterhour_ch 	= $(\'#afterhour_ch\').val();
	var v_type 		= $(\'#v_type\').val();
	var id 			= $(\'#id\').val();
	//alert(id+\'b\'+v_type+\'b\'+acharges+\'b\'+wtcharges+\'b\'+mcharges+\'b\'+bcharges); return false;
  $.post("addrate.php", { permile_ch: ""+permile_ch, afterhour_ch: ""+afterhour_ch, rate3: ""+rate3, rate6: ""+rate6, rate10: ""+rate10, v_type: ""+v_type, id: ""+id}, function(data){	if(data.length > 0) { 
				//alert(data);
				//alert(\'Updated!\');
				location.reload(); } }); 
	}	
function update_rate(val){
	var rate3 		= $(\'#rate3\'+val).val();
	var permile_ch 		= $(\'#permile_ch\'+val).val();
	var rate6 	= $(\'#rate6\'+val).val();
	var rate10 		= $(\'#rate10\'+val).val();
	var afterhour_ch 	= $(\'#afterhour_ch\'+val).val();
	$.post("updaterate.php", {permile_ch: ""+permile_ch, afterhour_ch: ""+afterhour_ch, rate3: ""+rate3, rate6: ""+rate6, rate10: ""+rate10,id: ""+val}, function(data){
				if(data.length > 0) { alert(\'Updated!\');
				//location.reload(); 
				} }); 
	
	}
function deleteit(val){
	$.post("delete.php", {id: ""+val}, function(data){
				if(data.length > 0) { location.reload(); } }); 
	}		
</script> 

'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" width="100%" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
            
            <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></td>
        </tr>
        <tr>
          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>] </div></td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">RATES MANAGEMENT FOR [ <?php echo $this->_tpl_vars['hosp']['account_name']; ?>
 ] </td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>#.</strong></td>
                <td width="20%" align="center" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>0-3 Miles<br/>Charges</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>4-6 Miles<br/>Charges</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>7-10 Miles<br/>Charges</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>After 10 Miles<br/>Charges per mile</strong></td>
               <td width="11%" align="center" class="label_txt_heading"><strong>After Hours Fee<br/>(per trip)</strong></td>
               <td width="20%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['v_rates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <td align="left" valign="middle"><b><?php echo $this->_sections['q']['iteration']; ?>
.</b></td>
                <td align="left" valign="middle"><?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['vehtype']; ?>
</td>
                <td align="left" valign="middle"><input type="text" id="rate3<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
" value="<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['rate3']; ?>
"  size="5" /></td>
                <td align="left" valign="middle"><input type="text" id="rate6<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
" value="<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['rate6']; ?>
"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="rate10<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
" value="<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['rate10']; ?>
"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="permile_ch<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
" value="<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['permile_ch']; ?>
"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="afterhour_ch<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
" value="<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['afterhour_ch']; ?>
"  size="5"  /></td>
                 
                
                
                
                
                <td align="center" valign="minddle">&nbsp;<a href="#" onclick="deleteit('<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
');">Delete</a>&nbsp;<input type="button" value="Update" id="X" onclick="update_rate('<?php echo $this->_tpl_vars['v_rates'][$this->_sections['q']['index']]['id']; ?>
');" class="btn"/></td>
              </tr>
              <?php endfor; else: ?>
              <tr>
                <td colspan="7" align="center"><b>No Record Found</b></td>
              </tr>
              <?php endif; ?>
            </table></td>
        </tr>
        <tr>
          <td style="border: solid 0px #F00; padding-left:80px; padding-top:40px;">Add Rates for New Vehicle Type (Service): <select name="v_type" id="v_type" onchange="add_form(this.value);" >
              <option value="">Select Vehicle Type</option>
         <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['v_types']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <option value="<?php echo $this->_tpl_vars['v_types'][$this->_sections['q']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['v_types'][$this->_sections['q']['index']]['vehtype']; ?>
</option>
        <?php endfor; endif; ?>
            </select></td>
        </tr>
        <tr>
          <td><table width="650" border="0" cellspacing="2" cellpadding="2" id="add_rates" style="display:none; padding-left:100px;">
              <tr>
                <td colspan="2"></td>
              </tr>
                        <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>0-3 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate3" type="text" class="" id="rate3" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>4-6 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate6" type="text" class="" id="rate6" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>7-10 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate10" type="text" class="" id="rate10" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>After 10 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="permile_ch" type="text" class="" id="permile_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per mile</b>)</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>After Hours Fee:</strong></td>
                <td width="60%" height="25"><input name="afterhour_ch" type="text" class="" id="afterhour_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td height="25">&nbsp;</td>
                <td height="25"><input type="button" value="Add Rates" id="ddd" onclick="add_rates2();"  class="btn"/></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center"><?php echo $this->_tpl_vars['paging']; ?>
<input type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" id="id" name="id"  /></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 