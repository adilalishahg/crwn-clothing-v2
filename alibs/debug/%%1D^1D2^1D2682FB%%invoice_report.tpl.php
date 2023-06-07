<?php /* Smarty version 2.6.12, created on 2022-09-27 12:40:46
         compiled from invoice_report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'invoice_report.tpl', 107, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--<meta http-equiv="refresh" content="300">-->

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
function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 750, width = 1200, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 750, width = 1200, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
	
	</script> 
'; ?>

  <!-- START SECTION 2 -->
 <div class="submain" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Invoices Report</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="invoice_report.php">
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
                        <!--<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Status</span>
                                <select name="reqstatus" id="reqstatus" class="form-control">
                                <option value="" > All </option>
                                <option value="5" <?php if ($this->_tpl_vars['reqstatus'] == '5'): ?> selected="selected"<?php endif; ?> >Pending</option>
                                </select>
														
							</div>
						</div>-->
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
                            <button type="submit" name="submit2" class="btn btn-primary btn-xlg" >Export PDF</button>
                        </div>
                   </div>
                </form> 
            </div>
             </div>
         <div class="w-col-12">
         <table width="100%" border="0" class="table">
  <thead>
    <th>Patient Name</th>
    <th>Date</th>
    <th>Pick Address</th>
    <th>Drop Address</th>
    <!--<th>Phone #</th>-->
    <!--<th>Case Manager</th>-->
    <th>Amount</th>
    <th>Detail</th>
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
<br/><?php echo ((is_array($_tmp=$this->_tpl_vars['Requests'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td>
    <td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['pck_add']; ?>
</td>
    <td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['drp_add']; ?>
</td>
    <!--<td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['phnum']; ?>
</td>-->
    <!--<td><?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['casemanager_name']; ?>
</td>-->
    <td> $ <?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['charges']; ?>

      			<!--<?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '5'): ?>Pending<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '1'): ?>Completed<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '10'): ?>Driver Arrived<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '3'): ?>Cancelled<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '4'): ?>Completed<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '6'): ?>Picked Up<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '7'): ?>Billable No-Show<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '8'): ?>non-Billable No-Show<?php endif; ?>
                <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['status'] == '9'): ?>Pending<?php endif; ?>-->
    
    </td>
    
    <td><a  href="javascript:popWind2('medical_invoice.php?id=<?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['tid']; ?>
');" title="View">&nbsp;&nbsp;<i class="fa fa-file-alt" style="color:#0059b7;  font-size:24px;"></i></a>&nbsp;
    <!--<?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['editable'] == 'Yes'): ?><a href="edittriprequest.php?id=<?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['id']; ?>
" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>
    <?php else: ?><a href="#" onclick="alert('Unable to make changes inside of 48 hours, please call our dispatch line to have these changes approved <?php echo $this->_tpl_vars['contactinfo']['phone']; ?>
')" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a><?php endif; ?>
     <?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'active' || $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['reqstatus'] == 'approved'): ?>
     	<?php if ($this->_tpl_vars['Requests'][$this->_sections['q']['index']]['cancellable'] == 'Yes'): ?>
<a href="#"  onclick="return deleteRec('<?php echo $this->_tpl_vars['Requests'][$this->_sections['q']['index']]['id']; ?>
');"  title="Cancel" style="color:red;font-weight:bold;font-size:16px;"> X</a> <?php endif; ?>
<?php endif; ?>-->
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