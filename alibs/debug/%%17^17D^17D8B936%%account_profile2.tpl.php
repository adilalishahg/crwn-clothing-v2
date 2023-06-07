<?php /* Smarty version 2.6.12, created on 2022-07-14 19:37:06
         compiled from account_profile2.tpl */ ?>
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
          <h1><?php if ($_SESSION['type'] == 'ac'): ?>Corporate<?php endif;  if ($_SESSION['type'] == 'pa'): ?> Customer<?php endif; ?> <?php if ($_SESSION['type'] == 'cm'): ?> Case Manager<?php endif; ?> Setting</h1>
        </div>
        <div class="w-col-12">
          <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="form" class="form" name="contact-form" method="post" action="account_profile2.php">
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
                <div class="col-sm-5">
                  <hr/>
                </div>
               <!-- <div class="col-sm-2" style="text-align:center">Setting</div>-->
                <div class="col-sm-5">
                  <hr/>
                </div>
              </div>
              <div class="row" style="margin-top:10px;">
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
                
               <!-- <div class="col-sm-4">
                  <input type="radio" checked="checked"  /> <a href="terms.php" target="_blank" > I am agreeing to <strong>Terms &amp; Conditions</strong> </a>
                  
                </div>-->
                
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