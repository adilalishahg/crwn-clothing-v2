<?php /* Smarty version 2.6.12, created on 2023-03-31 23:23:54
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="submain">
<div class="container">

        <!-- Marketing Icons Section -->
        <div class="row"  style="min-height:600px;">
           <!--<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "alert.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>-->
            <div class="col-lg-12" style="text-align:center;">
            <div id="content" class="wrapper"  style="text-align:center;">
            
          <?php if ($_SESSION['allowUser'] == '1'): ?> 
           <div class="fullWidthBucket">
            <!--<h1 class="main-head">Welcome <?php if ($_SESSION['type'] == 'ac'): ?>Healthcare Partners<?php else: ?>Healthcare Partners<?php endif; ?></h1>-->
            <div class="login-page-main">
            <a href="triprequest.php">
            <div class="col-md-3">
            <div class="panel panel-default text-center">
            <i class="fa fa-ambulance" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head">New Trip Request</h4>
            </div>
            </div>
            </a>
            </div>

             <div class="login-page-main">
             <a href="grid.php">
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-file-alt" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head">Today Trip</h4>
            </div>
            </div>
          </div>
          </a>
          </div>

          <div class="login-page-mian">
          <a href="mytrips.php"> 
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-user-plus" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head">Trip Reports</h4>
            </div>
            </div>
          </div> </a>
          </div>
         
          </div>
          <?php else: ?>
	      <div class="fullWidthBucket-main">
            <h1 class="main-head-transfer">Welcome to <?php echo $this->_tpl_vars['contactinfo']['title']; ?>
</h1>  
            <div class="col-md-4"></div>
            <!--<div class="login-page-main">
             <a href="triprequest.php">
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-edit" aria-hidden="true"  style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head-login">REQUEST A TRIP<br/>&nbsp;</h4>
            </div>
            </div>
          </div>
             </a>       
          </div>-->
          
          
             <div class="login-page-main">
             <a href="login.php">
            <div class="col-md-4">
             <div class="panel panel-default text-center">
            <i class="fa fa-hospital" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head-login">ACCOUNT LOGIN</h4>
            </div>
            </div>
          </div>
          </a>
          </div>
          
          
          <!--<div class="login-page-main">
          <a href="login.php">
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-user" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head-login">CUSTOMER LOGIN</h4>
            </div>
            </div>
          </div>
          </a>
          
          
          </div>-->
          </div>
      <?php endif; ?>    
                </div>
    </div>
            </div>
        </div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footerlast.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>