<?php /* Smarty version 2.6.12, created on 2023-03-31 23:25:22
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mainhead.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>       	

            

            <!-- start of body content -->

            <div class="body_content">

            

            	<!-- start of content section -->

                <div class="content_section" >

                 

                 <ul class="gallery">

				 <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>

	<!--<li>

		<a href="cms/" class="thumb"><span><img src="cms.png" alt="" /></span></a>

		<h2><a href="cms/">Content Management</a></h2>

	</li>-->

	<?php endif; ?>

	<?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>

  <!--  <li>

		<a href="Corporates/" class="thumb"><span><img src="hospital.png" alt="" /></span></a>

		<h2><a href="Corporates/">Facility Management</a></h2>

	</li>-->

	<?php endif; ?>

    <li>

		<a href="vehicles/" class="thumb"><span><img src="vehicle.png" alt="" /></span></a>

		<h2><a href="vehicles/">Vehicles Management</a></h2>

	</li>

    <li>

		<a href="drivers/" class="thumb"><span><img src="driver.png" alt="" /></span></a>

		<h2><a href="drivers/">Drivers Management</a></h2>

	</li>

	<?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>

	<li>

		<a href="admusers/" class="thumb"><span><img src="user.png" alt="" /></span></a>

		<h2><a href="admusers/">Admin Users</a></h2>

	</li>

	<?php endif; ?>

	<li>

		<a href="attandance/" class="thumb"><span><img src="attend.png" alt="" /></span></a>

		<h2><a href="attandance/">Attendance Management</a></h2>

	</li>  

	<?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>  

   <!-- <li>

		<a href="testimonials/" class="thumb"><span><img src="testimonial.png" alt="" /></span></a>

		<h2><a href="testimonials/">Testimonials</a></h2>

	</li>-->

	<?php endif; ?>

	 <li>

		<a href="routingpanel/" class="thumb"><span><img src="routing.png" alt="" /></span></a>

		<h2><a href="routingpanel/">Routing Panel</a></h2>

	</li>

	

    <!-- <li>

		<a href="http://203.82.61.178" target="_blank" class="thumb"><span><img src="call_manager.png" alt="" /></span></a>

		<h2><a href="routingpanel/">Call Manager</a></h2>

	</li>-->
    <?php if ($this->_tpl_vars['expiredata'] != ''): ?>
    <li>
		<a href="vehicles/" class="thumb" title="<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['expiredata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>  &raquo; <?php echo $this->_tpl_vars['expiredata'][$this->_sections['q']['index']]['vnumber']; ?>
  <?php endfor; endif; ?>" ><span><img src="vehicle.gif" alt="" /></span></a>
		<h2><a href="vehicles/" title="<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['expiredata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>  &raquo; <?php echo $this->_tpl_vars['expiredata'][$this->_sections['q']['index']]['vnumber']; ?>
  <?php endfor; endif; ?>">Registration of Vehicles <br/><?php if ($this->_tpl_vars['expiring'] > 0):  echo $this->_tpl_vars['expiring']; ?>
 Expiring <?php endif; ?> <?php if ($this->_tpl_vars['expired'] > 0):  echo $this->_tpl_vars['expired']; ?>
 Expired <?php endif; ?></a></h2>
	</li><?php endif; ?>


     <!-- <li>

		<a href="http://69.64.48.92/htMap.aspx?name=662066" target="_blank" class="thumb"><span><img src="vehicle.png" alt="" /></span></a>

		<h2><a href="http://69.64.48.92/htMap.aspx?name=662066">GPS Tracking</a></h2>

	</li>

   <li>

		<a href="reports/billing.php"  class="thumb"><span><img src="billing.png" alt="" /></span></a>

		<h2><a href="reports/billing.php">Billing</a></h2>

	</li>-->

	

</ul> 

     

                </div><!-- end of content section -->               

                

                <!-- start of content section -->

                <!-- end of content section -->

                	

                

            </div> <!-- end of body content -->

            

            <!-- start of right side bar -->

             <!-- end of right side bar -->

            

            <div class="cleaner"></div> 



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>