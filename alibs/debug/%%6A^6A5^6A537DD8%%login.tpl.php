<?php /* Smarty version 2.6.12, created on 2022-09-01 18:48:41
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<div class="submain"  style="min-height:400px;">
	<div class="wrap">
      <h1>Account Login </h1><hr/>  
      <div class="group">
         <form method="post" action="login.php"  autocomplete="off">
            <div class="container">
               <label for="uname"><b>Username</b></label>
               <input type="text" placeholder="Enter Username" name="username" required>

               <label for="psw"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="password" required>

               <button type="submit" name="submit"  class="btn btn-primary btn-md" >Login</button>
               <input type="hidden" name="token_sent" value="<?php echo $this->_tpl_vars['token']; ?>
" />
            </div>
         </form>
         <div class="top-space-error">
            <?php if ($this->_tpl_vars['errors'] != ''): ?><div class="red-line"><span style="color:#F00; font-weight:bold;"><?php echo $this->_tpl_vars['errors']; ?>
</span></div><?php endif; ?>
            <?php if ($this->_tpl_vars['messages'] != ''): ?><div class="red-line"><span style="color:#F00; font-weight:bold;"><?php echo $this->_tpl_vars['messages']; ?>
</span></div><?php endif; ?>
         </div>    
      </div> 
      <div class="group">
         <div class="container" style="margin-top: 20px;">
         Click here to request for an account. <a href="signup.php">Sign Up</a>
         </div>
      </div>  
   </div>
</div>
            
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footerlast.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>