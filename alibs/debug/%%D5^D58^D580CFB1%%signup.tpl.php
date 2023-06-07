<?php /* Smarty version 2.6.12, created on 2022-09-01 18:48:26
         compiled from signup.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class="submain"  style="min-height:400px;">
	<div class="wrap" style="padding-bottom:20px;">
      <h1>Account SignUp </h1><hr/>  
      <table>
      <?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['errors']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
        <h5 style="color: red;"><?php echo $this->_tpl_vars['errors'][$this->_sections['index']['index']]; ?>
</h5>
      <?php endfor; endif; ?>
      <?php unset($this->_sections['index']);
$this->_sections['index']['name'] = 'index';
$this->_sections['index']['loop'] = is_array($_loop=$this->_tpl_vars['messages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['index']['show'] = true;
$this->_sections['index']['max'] = $this->_sections['index']['loop'];
$this->_sections['index']['step'] = 1;
$this->_sections['index']['start'] = $this->_sections['index']['step'] > 0 ? 0 : $this->_sections['index']['loop']-1;
if ($this->_sections['index']['show']) {
    $this->_sections['index']['total'] = $this->_sections['index']['loop'];
    if ($this->_sections['index']['total'] == 0)
        $this->_sections['index']['show'] = false;
} else
    $this->_sections['index']['total'] = 0;
if ($this->_sections['index']['show']):

            for ($this->_sections['index']['index'] = $this->_sections['index']['start'], $this->_sections['index']['iteration'] = 1;
                 $this->_sections['index']['iteration'] <= $this->_sections['index']['total'];
                 $this->_sections['index']['index'] += $this->_sections['index']['step'], $this->_sections['index']['iteration']++):
$this->_sections['index']['rownum'] = $this->_sections['index']['iteration'];
$this->_sections['index']['index_prev'] = $this->_sections['index']['index'] - $this->_sections['index']['step'];
$this->_sections['index']['index_next'] = $this->_sections['index']['index'] + $this->_sections['index']['step'];
$this->_sections['index']['first']      = ($this->_sections['index']['iteration'] == 1);
$this->_sections['index']['last']       = ($this->_sections['index']['iteration'] == $this->_sections['index']['total']);
?>
        <h5 style="color: green;"><?php echo $this->_tpl_vars['messages'][$this->_sections['index']['index']]; ?>
</h5>
      <?php endfor; endif; ?>
        <form action="signup.php" method="post" autocomplete="off">
            <tr>
                <th>Facility Name : </th>
                <td>
                    <input type="text" name="facility_name" id="facility_name" required> *
                </td>
            </tr>
            <tr>
                <th>Contact Person Name : </th>
                <td>
                    <input type="text" name="person_name" id="person_name" required> *
                </td>
            </tr>
            <tr>
                <th>Phone Number : </th>
                <td>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="(999)-999 9999" required> *
                </td>
            </tr>
            <tr>
                <th>Email Address : </th>
                <td>
                    <input type="email" name="email" id="email" required> *
                </td>
            </tr>
            <tr>
                <th>Client Address : </th>
                <td>
                    <input type="text" name="client_address" id="client_address" >
                </td>
            </tr>
            <tr>
                <th>
                    <input type="submit" value="Submit" class="btn btn-primary btn-md" name="submit">
                </th>
            </tr>
            </form>
        </table>

</div>
<?php echo '
<script>
document.getElementById(\'phone_number\').addEventListener(\'input\', function (e) {
        var x = e.target.value.replace(/\\A/g, \'\').match(/(\\d{3})(\\d{3})(\\d{4})/);
        e.target.value = \'(\' + x[1] + \')-\' + x[2] +\' \'+ x[3];
});
</script>
'; ?>
    
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footerlast.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>