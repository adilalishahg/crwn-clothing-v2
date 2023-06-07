<?php /* Smarty version 2.6.12, created on 2022-07-19 15:52:17
         compiled from mytrips.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mytrips.tpl', 96, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<meta http-equiv="refresh" content="300">

<?php echo ' 
<script type="text/javascript">
function deleteRec(id,st)
		{ //alert(st);
		var ok;
		ok=confirm("Are you sure you want to cancel this trip?");
		if (ok)
		{		
			location.href="mytrips.php?delId="+id;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
	</script> 
'; ?>

  <!-- START SECTION 2 -->
 <div class="submain" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Trips Request Report</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="mytrips.php">
     <?php if ($this->_tpl_vars['errors'] != ''): ?><div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;"><?php echo $this->_tpl_vars['errors']; ?>
</div></div><?php endif; ?>
     <?php if ($this->_tpl_vars['messages'] != ''): ?><div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;"><?php echo $this->_tpl_vars['messages']; ?>
</div></div><?php endif; ?>
                <div class="row">
						<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">From</span>
								<input type="text" name="stdate" class="form-control enddate" value="<?php echo $this->_tpl_vars['stdate']; ?>
" placeholder="Start Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">To</span>
								<input type="text" name="enddate" class="form-control enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" placeholder="End Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Status</span>
                                <select name="reqstatus" id="reqstatus" class="form-control">
                                <option value="" > All </option>
                                <option value="approved" <?php if ($this->_tpl_vars['reqstatus'] == 'approved'): ?> selected="selected"<?php endif; ?> >Approved</option>
                                <option value="disapproved" <?php if ($this->_tpl_vars['reqstatus'] == 'disapproved'): ?> selected="selected"<?php endif; ?> >Disapproved</option>
                                <option value="active" <?php if ($this->_tpl_vars['reqstatus'] == 'active'): ?> selected="selected"<?php endif; ?> >Pending</option>
                                <option value="inactive" <?php if ($this->_tpl_vars['reqstatus'] == 'inactive'): ?> selected="selected"<?php endif; ?> >Cancelled</option>
                                </select>
														
							</div>
						</div>
						<!--<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Region</span>
							<input type="text" name="password" class="form-control" placeholder="Enter Region" required="required">
							</div>
						</div>-->
					</div>
                      <div class="row">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Show Report</button>
                        </div>
                   </div>
                </form> 
            </div>
             </div>
         <div class="w-col-12">
         <table width="100%" border="0" class="table">
  <thead>
    <th>Patient Name</th>
    <th>Appointment date/time</th>
    <th>Pick Address</th>
    <th>Drop Address</th>
    <th>Phone #</th>
    <!--<th>Case Manager</th>-->
    <th>Status</th>
    <th>Options</th>
  </thead>
  <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['Requests']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr>
    <td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['clientname']; ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['Requests'][$this->_sections['q']['index']]['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 -- <?php echo ((is_array($_tmp=$this->_tpl_vars['Requests'][$this->_sections['q']['index']]['org_apptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td>
    <td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['pickaddr']; ?>
</td>
    <td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['destination']; ?>
</td>
    <td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['phnum']; ?>
</td>
    <!--<td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['casemanager_name']; ?>
</td>-->
    <td>
     <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'approved'): ?>Approved<?php endif; ?>
     <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'disapproved'): ?>Disapproved<?php endif; ?>
     <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'active'): ?>Pending<?php endif; ?>
     <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'inactive'): ?>Cancelled<?php endif; ?>
    
    </td>
    
    <td><a href="javascript:popWind('reqpreview.php?id=<?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['id']; ?>
');"><i class="fa fa-file-alt" style="color:#0059b7"></i></a>&nbsp;
    <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['editable'] == 'Yes'): ?><a href="edittriprequest.php?id=<?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['id']; ?>
" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>
    <?php else: ?><a href="#" onclick="alert('Unable to make changes inside of 48 hours, please call our dispatch line to have these changes approved <?php echo $this->_tpl_vars['contactinfo']['phone']; ?>
')" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a><?php endif; ?>
     <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'active' || $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'approved'): ?>
     	<?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['cancellable'] == 'Yes'): ?>
<a href="#"  onclick="return deleteRec('<?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['id']; ?>
');"  title="Cancel" style="color:red;font-weight:bold;font-size:16px;"> X</a> <?php endif; ?>
<?php endif; ?>
</td>
  </tr>
  <?php endfor; else: ?>
  <tr>
    <td colspan="7" style=" text-align:center;">&nbsp;No record found!.</td>
    
  </tr>
  <?php endif; ?>
  <tr>
    <td colspan="7" style=" text-align:center;"><?php echo $this->_tpl_vars['pages']; ?>
</td> 
  </tr>
</table>

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