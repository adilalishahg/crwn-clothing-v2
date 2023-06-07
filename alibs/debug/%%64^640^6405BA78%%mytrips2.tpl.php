<?php /* Smarty version 2.6.12, created on 2022-07-20 13:13:46
         compiled from mytrips2.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<meta http-equiv="refresh" content="300">
  <!-- START SECTION 2 -->
 <div class="submain" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row" style="min-height:400px">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Export Trips Sheet</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="mytrips2.php"  autocomplete="off">
     <?php if ($this->_tpl_vars['errors'] != ''): ?><div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;"><?php echo $this->_tpl_vars['errors']; ?>
</div></div><?php endif; ?>
     <?php if ($this->_tpl_vars['messages'] != ''): ?><div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;"><?php echo $this->_tpl_vars['messages']; ?>
</div></div><?php endif; ?>
                <div class="row">
						<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">From</span>
								<input type="text" name="stdate" class="form-control enddate" value="<?php echo $this->_tpl_vars['stdate']; ?>
" placeholder="Start Date" required="required" >								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">To</span>
								<input type="text" name="enddate" class="form-control enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" placeholder="End Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:2px;">
							<div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Export Report</button>
                        </div>
						</div>
                        <!--<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Status</span>
                                <select name="reqstatus" id="reqstatus" class="form-control">
                                <option value="" > All </option>
                                <option value="approved" <?php if ($this->_tpl_vars['reqstatus'] == 'approved'): ?> selected="selected"<?php endif; ?> >Approved</option>
                                <option value="disapproved" <?php if ($this->_tpl_vars['reqstatus'] == 'disapproved'): ?> selected="selected"<?php endif; ?> >Disapproved</option>
                                <option value="active" <?php if ($this->_tpl_vars['reqstatus'] == 'active'): ?> selected="selected"<?php endif; ?> >Pending</option>
                                </select>														
							</div>
						</div>-->
						
					</div>
                      <div class="row">     
                        <div class="form-group" style="margin-top:20px; margin-left:14px;">
                           <?php if ($this->_tpl_vars['filename'] != ''): ?> <a href="<?php echo $this->_tpl_vars['filename']; ?>
" >Click Here to Download Trip Sheet</a><?php endif; ?>
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
<script src="js/triprequest.js"></script>