<?php /* Smarty version 2.6.12, created on 2022-07-15 11:58:32
         compiled from account_profile.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<!-- START SECTION 2 -->
<div class="submain" id="home-stats" data-stellar-background-ratio="0.4" style="min-height:500px">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12 space-top">
          <h1><?php if ($_SESSION['type'] == 'ac'): ?>Account<?php endif;  if ($_SESSION['type'] == 'pa'): ?> Customer<?php endif;  if ($_SESSION['type'] == 'cm'): ?> Case Manager<?php endif; ?> Information</h1>
        </div>
        <div class="w-col-12">
          <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="form" class="form" name="contact-form" method="post" action="account_profile.php">
              <?php if ($this->_tpl_vars['errors'] != ''): ?>
              <div class="row" style="color:#F00;">
                <div class="col-sm-6" style="margin-top:20px;"><?php echo $this->_tpl_vars['errors']; ?>
</div>
              </div>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['messages'] != ''): ?>
              <div class="row" style="color:#F00;">
                <div class="col-sm-6" style="margin-top:20px;"><?php echo $this->_tpl_vars['messages']; ?>
</div>
              </div>
              <?php endif; ?>
              <div class="row" style="margin-top:10px;">
                <div class="col-sm-12">
                  <hr/>
                </div>
                
              </div>
              
              <?php if ($_SESSION['type'] == 'ac'): ?>
              <div class="row" style="margin-top:0px;">
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Account Name</span>
                    <input type="text" name="account_name" class="form-control" placeholder="Account Name" required="required"  value="<?php echo $this->_tpl_vars['data']['account_name']; ?>
" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Address</span>
                    <input type="text" name="address" class="form-control" placeholder="Enter Address" required="required"  value="<?php echo $this->_tpl_vars['data']['address']; ?>
" >
                  </div>
                </div>
                <!--<div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Address 2</span>
                    <input type="text" name="address2" class="form-control" placeholder="Enter Address2"  value="<?php echo $this->_tpl_vars['data']['address2']; ?>
" >
                  </div>
                </div>-->
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">City &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="city" class="form-control" placeholder="Enter City" required="required"  value="<?php echo $this->_tpl_vars['data']['city']; ?>
" >
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top:10px;">
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <select name="state" id="state" class="form-control" required="required" >
                      <option value="" >Select</option>
                      
			   <?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['states']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
             
                      <option value="<?php echo $this->_tpl_vars['states'][$this->_sections['n']['index']]['abbr']; ?>
" <?php if ($this->_tpl_vars['states'][$this->_sections['n']['index']]['abbr'] == $this->_tpl_vars['data']['state']): ?>selected<?php endif; ?>> <?php echo $this->_tpl_vars['states'][$this->_sections['n']['index']]['statename']; ?>
 </option>
                      
			   <?php endfor; endif; ?>
                    
                    </select>
                  </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Zip Code</span>
                    <input type="text" name="zip" class="form-control" placeholder="Enter Zip Code" required="required"  value="<?php echo $this->_tpl_vars['data']['zip']; ?>
" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="phone" class="form-control" placeholder="Enter phone" required="required"  value="<?php echo $this->_tpl_vars['data']['phone']; ?>
">
                  </div>
                </div>
                
              </div>
              <?php endif; ?>
             
             
              
              
              <div class="row" style="margin-top:10px;">
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email" required="required"  value="<?php echo $this->_tpl_vars['data']['email']; ?>
" >
                  </div>
                </div>
                <!--<div class="col-sm-4">
                  <input type="radio" checked="checked"  /> <a href="terms.php" target="_blank" > I am agreeing to <strong>Terms &amp; Conditions</strong> </a>
                  
                </div>-->
                
                
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">User Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="username" class="form-control" placeholder="Enter User Name" required="required"  value="<?php echo $this->_tpl_vars['data']['username']; ?>
">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Password</span>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required="required"  value="<?php echo $this->_tpl_vars['data']['password']; ?>
">
                  </div>
                </div>
                
                
                
              </div>
              <div class="row">
                <div class="form-group" style="margin-top:20px; margin-left:14px;">
                  <button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END SECTION 2 --> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footerlast.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<script src="js/inputmasking.js"></script>