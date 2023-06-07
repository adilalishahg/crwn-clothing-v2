<?php /* Smarty version 2.6.12, created on 2019-04-24 15:47:55
         compiled from reportstpl/invoices.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'reportstpl/invoices.tpl', 116, false),array('modifier', 'date_format', 'reportstpl/invoices.tpl', 140, false),array('modifier', 'truncate', 'reportstpl/invoices.tpl', 151, false),array('function', 'cycle', 'reportstpl/invoices.tpl', 139, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
// $("#startdate").mask("19/39/9999");
  //  $("#enddate").mask("19/39/9999");	
	//$("#phnum").mask("(999) 999-9999");
	//$("#h_phone").mask("(999) 999-9999");
	//$("#appdate").datepicker();
$(document).ready(function(){	
$("#startdate").datepicker( {maxDate: \'-0\', dateFormat: \'mm/dd/yy\'} );
$("#enddate").datepicker( {maxDate: \'-0\', dateFormat: \'mm/dd/yy\'} );
});
</script>'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
                              <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
		                    <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
                            </tr>
<tr>
                              <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							<?php if ($this->_tpl_vars['noReq'] != '0'): ?>
							[<a href="javascript:history.back();">Back</a>]<?php endif; ?></div>							  </td>
        </tr>							
                            <tr>
<td height="19" colspan="2" align="center" class="admintopheading">Generate Invoices</td>
                           </tr>
                           <tr>
                              <td height="44" colspan="2" align="center"  valign="top">
							 <form name="searchReport" action="invoices.php" method="get"> 
							  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
                      <tr>
              <td width="14%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
              <td width="19%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="<?php echo $this->_tpl_vars['startdate']; ?>
" class="inputTxtField"/> <span style="color:#FF0000">*</span></td>
              <td width="14%" align="right" valign="top" class="labeltxt"><div align="left"><strong>To:</strong>&nbsp;</div></td>
              <td width="18%" align="left" valign="top" class="labeltxt"><input type="text" name="enddate" id="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" class="inputTxtField" />
                 <span style="color:#FF0000">*</span></td>
                 <td width="14%" align="left" valign="top" class="labeltxt"><strong>Account:</strong></td>
              <td width="18%" align="left" valign="top">
			  <select name="hospname" id="hospname" class="">
			    <option value="">-- Select Account--</option>
			   <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['hosp']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    <option value="<?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['hospname'] == $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['account_name']; ?>
</option>
				<?php endfor; endif; ?>
			   </select>		  </td>
 </tr>
            <tr>
              
               <td  align="left" valign="top" class="labeltxt"><strong>Patient Name:</strong>&nbsp;</td>
              <td align="left" valign="top" class="labeltxt"><input name="pname" type="text" class="txt_box" id="pname"  value="<?php echo $this->_tpl_vars['pname']; ?>
" maxlength="50" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div></td>
           
              <td align="left" valign="top" class="labeltxt"><strong>Pick Location:</strong></td>
              <td align="left" valign="top">
			  <select name="picklocation" id="picklocation" class="">
			    <option value="">-- Select Pick Location--</option>
			   <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['picklocations']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    <option value="<?php echo $this->_tpl_vars['picklocations'][$this->_sections['q']['index']]['picklocation']; ?>
" <?php if ($this->_tpl_vars['picklocation'] == $this->_tpl_vars['picklocations'][$this->_sections['q']['index']]['picklocation']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['picklocations'][$this->_sections['q']['index']]['picklocation']; ?>
</option>
				<?php endfor; endif; ?>
			   </select>		  </td>
               <td align="right" valign="top" class="labeltxt"><div align="left"><strong>Drop Location:</strong></div></td>
              <td align="left" valign="top">
			  <select name="droplocation" id="droplocation" class="">
			    <option value="">-- Select Drop Location--</option>
			   <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['droplocations']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    <option value="<?php echo $this->_tpl_vars['droplocations'][$this->_sections['q']['index']]['droplocation']; ?>
" <?php if ($this->_tpl_vars['droplocation'] == $this->_tpl_vars['droplocations'][$this->_sections['q']['index']]['droplocation']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['droplocations'][$this->_sections['q']['index']]['droplocation']; ?>
</option>
				<?php endfor; endif; ?>
			   </select>		  </td>
            </tr>
            
           <!-- <tr>
              <td align="right" valign="top" class="labeltxt"><div align="left"><strong>Company Code :</strong></div></td>
              <td align="left" valign="top">
			  <select name="code" class=" txt_boxX" id="code"  >
                      <option value="">All</option>
                      			  <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['ccode']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                 <option value="<?php echo $this->_tpl_vars['ccode'][$this->_sections['q']['index']]['code']; ?>
" <?php if ($this->_tpl_vars['ccode'][$this->_sections['q']['index']]['code'] == $this->_tpl_vars['code']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['ccode'][$this->_sections['q']['index']]['code']; ?>
 - - <?php echo $this->_tpl_vars['ccode'][$this->_sections['q']['index']]['company']; ?>
</option>
                      <?php endfor; endif; ?>
                    </select> </td>
            </tr>-->
            
            <!--<tr>
              <td align="left" valign="top">&nbsp;</td>
              <td colspan="4" align="left" valign="top">
			  <font color="#FF0000">
   			     <b>Note:*</b>
				 <ol><li>Combination of all fields are not mandatory</li>
				 <li>Both Start and End date must be provided.</li>
				 </ol> </font>			  </td>
             </tr>-->
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td colspan="4" align="center" valign="top">
			  <input type="submit" name="submit2" value='Generate in HTML' class="inputButton btn" />&nbsp;&nbsp;&nbsp;
              <input type="submit" name="csv" value='Generate in CSV' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
              <input type="submit" name="submit" value='Generate in PDF' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
              <input type="submit" name="showreport" value='Show Report' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
              <!--<input type="submit" name="generate" value='Generate Invoices' class="inputButton btn"  />&nbsp;&nbsp;&nbsp;
			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />-->			  </td>
              </tr>
          </table>	
		                     </form>		  	                  </td>
                            </tr>
                            <tr>
		</tr>			
      </table>
    </td>
  </tr>
 <tr><td>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">                    
                            <tr>
                            <td align="center" class="admintopheading">Invoices <span style="float:right; color:#F00;">Total Amount Billed: $ <?php echo ((is_array($_tmp=$this->_tpl_vars['totalammount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span></td>
                            </tr>
                             <tr>
                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								<div style="width:100%; border: #F00 0px solid; float:left;"></div>
						   <br />
							  <table width="100%" border="0" class="">
                              <?php if ($this->_tpl_vars['pname'] != ''): ?>
<tr><td colspan="10" style="text-align:right;"><a href="javascript:popWind2('medical_invoice2.php?startdate=<?php echo $this->_tpl_vars['startdate']; ?>
&enddate=<?php echo $this->_tpl_vars['enddate']; ?>
&hospname=<?php echo $this->_tpl_vars['hospname']; ?>
&pname=<?php echo $this->_tpl_vars['pname']; ?>
')" ><input type="button" class="inputButton btn" value="Show Patient Combine Invoice"  /></a></td></tr> <?php endif; ?>    
							  <tr class="admintopheading">
<td width="4%"  align="center"> Date<br/>Account Name</td>
<td width="8%" align="center"> Customer<br/>Name</td>
<!----><td width="4%" align="center">Leg</td>
<td width="18%" align="center"> Pick Address /<br/> Drop Address</td>
<td width="5%" align="center">Pick<br/>Time</td>
<td width="10%" align="center">Miles</td>
<td width="13%" align="center">Veh.<br/>
  Type</td>
<td width="4%" align="center">Total<br/>$</td>
<td width="15%" align="center">Out of Area/Misc Fee</td>
<td width="5%"  align="center">View<br/>Edit</td>
								 </tr>	       
							<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['invoicesdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr id="tr<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['id']; ?>
" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#dfedfa"), $this);?>
">
<td align="left" valign="middle"><?php echo ((is_array($_tmp=$this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
<br/><?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['account_name']; ?>
</td>
<td align="left" valign="middle"><?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['clientname']; ?>
</td>
<!----><td align="left" valign="middle">Leg <?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['leg'] == '1'): ?>A<?php elseif ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['leg'] == '2'): ?>B<?php elseif ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['leg'] == '3'): ?>C<?php elseif ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['leg'] == '4'): ?>D<?php endif; ?>
</td>
<td align="left" valign="middle">
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['leg'] == '1'): ?>
<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['pickaddr']; ?>
/<br/><?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['destination']; ?>
 <?php else: ?>
<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['destination']; ?>
/<br/><?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['backto']; ?>
	<?php endif; ?>
</td>
<td align="left" valign="middle"> 
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['leg'] == '1'): ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['apptime'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
	<?php else: ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['returnpickup'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
  <?php endif; ?></td>
<td align="left" valign="middle">Total Miles=<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['miles']; ?>
<br/>
Free Miles=<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['freemiles']; ?>
<br/>
Billable Miles=<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['billablemile']; ?>
</td>
<td align="center" valign="middle"> <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['vehicle']; ?>
<!--<br />Pickup Charges: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['pickup_ch']; ?>
<br />Price Per Mile: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['permile_ch']; ?>
--></td>
<td align="center" valign="middle"> $<?php echo ((is_array($_tmp=$this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['charges'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
<td align="left" valign="middle"><!--$ <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['charges']; ?>
-->
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['miscellaneous_charges'] != '0'): ?>Misc. Chrg: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['miscellaneous_charges']; ?>
<br/><?php endif; ?>
<!--<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['dstretcher'] == 'Yes'): ?>2ManTeam Chrg: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['dstretcher_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['oxygen'] == 'Yes'): ?>Oxg. Chrg: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['oxygen_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['bstretcher'] == 'Yes'): ?>Bariatric Str. Chrg: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['bstretcher_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['doublewheel'] == 'Yes'): ?>WheelChair Rental Chrg: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['doublewheel_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['noshow'] == '1'): ?>No Show Fee: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['noshow_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['waittime_unit'] != '0'): ?>Wait Time Charges: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['waittime_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['unloaded_miles_ch'] != '0'): ?>Un.M Charges[<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['unloaded_miles']; ?>
]: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['unloaded_miles_ch']; ?>
<br/><?php endif; ?>
-->
<?php if ($this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['afterhour'] == '1'): ?>After Hour Fee: <?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['afterhour_rate']; ?>
<br/><?php endif; ?>




</td>
<td align="center" valign="middle"><a href="javascript:popWind2('medical_invoice.php?id=<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['tid']; ?>
')" ><img alt="View Invoice detail" border="0"  src="../graphics/view.gif"></a><br/><br/><a href="javascript:popWind2('edit_request.php?id=<?php echo $this->_tpl_vars['invoicesdata'][$this->_sections['q']['index']]['tid']; ?>
')" ><img alt="Edit Information" border="0"  src="../graphics/edit.png"></a></td>
</tr>
							 <?php endfor; else: ?>
							 <tr>
							  <td colspan="9" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 
							 <?php endif; ?> 
							</table> 					
                			
                </td>
            </tr>
      </table>  
</td></tr> 
</table>
<?php echo '
<script>selbox();</script>'; ?>
		 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>