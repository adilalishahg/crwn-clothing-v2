<?php /* Smarty version 2.6.12, created on 2019-04-24 15:31:41
         compiled from reportstpl/payment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'reportstpl/payment.tpl', 151, false),array('modifier', 'date_format', 'reportstpl/payment.tpl', 177, false),array('modifier', 'truncate', 'reportstpl/payment.tpl', 177, false),array('function', 'cycle', 'reportstpl/payment.tpl', 170, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
function selbox(val){
if(val == \'0\'){
if(document.getElementById(\'box\').checked == true)
   {
  $(\'#hospname\').attr("disabled", true);
  $(\'#address\').attr("disabled", true);
  $(\'#cisid\').attr("disabled", false);
  //$(\'#box2\').attr("disabled", true);   
  $(\'#box2\').attr("checked", false);  
  $(\'#ssn\').val("");   
  $(\'#ssn\').attr("disabled", true); 
  return true;  
  }
else if(document.getElementById(\'box\').checked == false){
  $(\'#hospname\').attr("disabled", false);
  $(\'#address\').attr("disabled", false);
  $(\'#ssn\').attr("disabled", true); 
  $(\'#box\').attr("disabled", false);
  $(\'#box2\').attr("disabled", false); 
  $(\'#box2\').attr("checked", false);     
  $(\'#cisid\').attr("disabled", true); 
  $(\'#cisid\').val(""); 
  return true;
  }else{
  return false;
    }
  }
if(val == \'1\'){
if(document.getElementById(\'box2\').checked == true)
   {
  $(\'#hospname\').attr("disabled", true);
  $(\'#address\').attr("disabled", true);
  $(\'#cisid\').val("");
  //$(\'#box\').attr("disabled", true); 
  $(\'#cisid\').attr("disabled", true);     
  $(\'#box\').attr("checked", false);   
  $(\'#ssn\').attr("disabled", false);  
  return true;  
  }
else if(document.getElementById(\'box2\').checked == false){
  $(\'#hospname\').attr("disabled", false);
  $(\'#address\').attr("disabled", false);
  $(\'#cisid\').attr("disabled", true); 
  $(\'#box\').attr("disabled", false);
  $(\'#box\').attr("checked", false); 
  $(\'#box2\').attr("disabled", false);     
  $(\'#ssn\').attr("disabled", true); 
  $(\'#ssn\').val("");    
  return true;
  }else{
  return false;
    }
  }  
}
$(document).ready(function(){	

$("#startdate").datepicker( {maxDate: \'-0\', dateFormat: \'mm/dd/yy\'} );
$("#enddate").datepicker( {maxDate: \'-0\', dateFormat: \'mm/dd/yy\'} );
});
</script>
'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
            <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
		                    <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td></tr>
							<tr>
                             <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							<?php if ($this->_tpl_vars['noReq'] != '0'): ?>
							[<a href="javascript:history.back();">Back</a>]<?php endif; ?></div>							  </td></tr>	
                            <tr>
<td height="19" colspan="2" align="center" class="admintopheading">PAYMENT REPORT</td>
                            </tr>
                                                       <tr>
                              <td height="auto" colspan="2" align="center"  valign="top">
							 <form name="searchReport" id="searchReport" action="payment.php" method="post"> 
							  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >
           <tr>
              <td colspan="5" valign="top" class="admintopheading" align="center">SEARCH CRITERIA</td>
           </tr>
            <tr>
              <td width="21%" align="left" valign="top" class="labeltxt"><strong>From:<font color="#FF0000">*</font></strong></td>
           <td width="31%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="<?php echo $this->_tpl_vars['startdate']; ?>
" class="inputTxtField"/>                &nbsp;
                <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;">
                  <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
                <div class="suggestionList" id="autoSuggestionsList1">
  &nbsp;				</div>
		      </div>
                (mm/dd/yyyy)</td>
              <td align="right" valign="top" class="labeltxt"><strong>To:<font color="#FF0000">*</font></strong>&nbsp;</td>
              <td align="left" valign="top" class="labeltxt">&nbsp;</td>
              <td width="40%" align="left" valign="top"><input type="text" name="enddate" id="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" class="inputTxtField" />
                <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">
                  <div class="suggestionList" id="div">&nbsp; </div>
               </div>
                (mm/dd/yyyy)</td>
             </tr>
            <tr>
              <td align="left" valign="top" class="labeltxt"><strong>Account Name:</strong></td>
              <td align="left" valign="top">
			  <select name="hospname" id="hospname">
			    <option value="">All</option>
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
</option
				><?php endfor; endif; ?>
			   </select>		  </td>
              <td align="right" valign="top" class="labeltxt"><strong>Request Status:</strong>&nbsp;</td>
              <td align="left" valign="top" class="labeltxt">&nbsp;</td>
              <td width="40%" align="left" valign="top">
              <select name="request_status">
              <option value="approved" <?php if ($this->_tpl_vars['request_status'] == 'approved'): ?> selected="selected" <?php endif; ?> >Approved</option>
              <option value="disapproved" <?php if ($this->_tpl_vars['request_status'] == 'disapproved'): ?> selected="selected" <?php endif; ?>>Disapproved</option>			              <option value="active" <?php if ($this->_tpl_vars['request_status'] == 'active'): ?> selected="selected" <?php endif; ?>>Pending</option>
              </select></td>
           </tr>
          		<tr>
              <td align="left" valign="top" class="labeltxt"><strong>Patient Name  :</strong></td>
     	 <td align="left" valign="top"><input type="text" name="pname" id="pname" value="<?php echo $this->_tpl_vars['pname']; ?>
" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div> </td>
              <td align="right" valign="top" class="labeltxt"><strong>Payment Status:</strong>&nbsp;</td>
              <td align="left" valign="top" class="labeltxt">&nbsp;</td>
              <td width="40%" align="left" valign="top"><select name="payment_status" ><option value="" <?php if ($this->_tpl_vars['payment_status'] == ''): ?> selected="selected" <?php endif; ?> >All</option><option value="0" <?php if ($this->_tpl_vars['payment_status'] == '0'): ?> selected="selected" <?php endif; ?> >Pending</option><option value="1" <?php if ($this->_tpl_vars['payment_status'] == '1'): ?> selected="selected" <?php endif; ?> >Collected</option></select></td>
			</tr>
            <!--<tr>
              <td align="left" valign="top" class="labeltxt"></td>
              <td align="left" valign="top"><input type="checkbox" <?php if ($this->_tpl_vars['reclaim'] != ''): ?> checked="checked" <?php endif; ?> name="reclaim" value="reclaim" />&nbsp;<strong>Reclaim Only</strong></td>
              <td align="left" valign="top"><strong>HIC Form: </strong></td><td align="left" valign="top" colspan="2"><input type="radio" name="hic" value="1" <?php if ($this->_tpl_vars['hic'] == '1'): ?> checked="checked" <?php endif; ?> /> Yes  <input type="radio" name="hic" value="0" <?php if ($this->_tpl_vars['hic'] == '0'): ?> checked="checked" <?php endif; ?> /> No&nbsp;</td>
			</tr>-->
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td colspan="4" align="left" valign="top">
			  <input type="submit" name="showpay" value='Report' class="inputButton btn"  />&nbsp;
			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />		 	  </td>
              </tr>
          </table>	</form>
                  		  	                  </td>
                            </tr>
                            <tr>
                              <td height="auto" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="100%" border="0" cellspacing="0" cellpadding="0">                    
                            <tr>
                            <td align="center" class="admintopheading">ACCOUNT RECEIVABLES </td>
                            </tr>
                            <tr>
                            <td align="center" class="admintopheading" >Total Amount in this Search: $ <?php echo ((is_array($_tmp=$this->_tpl_vars['tot_amount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 [ Collected: $ <?php echo ((is_array($_tmp=$this->_tpl_vars['collectedammount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
]  <span style="color:#F00;" >[ Pending: $ <?php echo ((is_array($_tmp=$this->_tpl_vars['pendingammount'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
]</span>  </td>
                            </tr>
                          <?php if ($this->_tpl_vars['noReq'] != '0'): ?>
                            <tr>
                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								<div style="100%; border: #F00 0px solid; float:left;"></div>
						   <br />
							  <table width="100%" border="0" class="">
							  <tr class="admintopheading">
<td width="15%" align="center"><strong><?php if ($this->_tpl_vars['showClient'] == 'no'): ?>Client<?php else: ?>Client Name<?php endif; ?></strong></td>
<td width="15%" align="center"><strong><?php if ($this->_tpl_vars['showClient'] == 'no'): ?>Contact Person<?php else: ?>Appt Date /Time<?php endif; ?><br/>Account Name</strong></td>
<td  width="20%"  align="center" ><strong>Pick Address</strong></td>
<td width="20%" align="center"><strong>Destination Address </strong></td>
<td width="10%" align="center"><strong>Amount</strong></td>
<td align="10%"><strong>&nbsp;Invoice&nbsp;</strong></td>
<td align="10%"><strong>Payment <br />Status </strong></td>
								</tr>	   
							<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['reqdetails']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							  <?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['rows'] != '0'): ?>
							  <tr id="tr<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
" bgcolor="<?php echo smarty_function_cycle(array('values' => "#ffffff,#dfedfa"), $this);?>
">
								<td align="left" valign="middle">
								<b><?php if ($this->_tpl_vars['showClient'] == 'no'):  echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['hospname'];  else:  echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['clientname'];  endif; ?></b>
								</td>
								<td align="center" valign="middle">
								<?php if ($this->_tpl_vars['showClient'] == 'no'): ?>
								<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['firstname']; ?>
 <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['lastname'];  else: ?>
								<?php echo ((is_array($_tmp=$this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['apptime'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>

								<?php endif; ?><br/><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account_name']; ?>

								</td>
							<td align="center" valign="middle"> <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['pickaddr']; ?>
</td>
									<td align="center" valign="middle"> <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['destination']; ?>
</td>
								<td align="center" valign="middle">   
								 $&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['charges'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

								 </td>                               
								<td align="center" valign="middle">
								<a href="javascript:popWind2('medical_invoice.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['tid']; ?>
');">Invoice</a></td>
								<td width="10" align="center" valign="middle">
								<select name="paystatus"  id="paystatus<?php echo $this->_sections['q']['iteration']; ?>
" onChange="javascript:chgpaystatus(this.value,<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
,<?php echo $this->_sections['q']['iteration']; ?>
);" ><!--<?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['paystatus'] == '1'): ?> disabled="disabled" <?php endif; ?>-->
			    <option value="0"<?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['paystatus'] == '0'): ?> selected="selected" <?php endif; ?>>Pending</option>
				<option value="1"<?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['paystatus'] == '1'): ?> selected="selected" <?php endif; ?>>Collected</option>
			   </select>
								</td>
								</tr>
							 <?php else: ?>
							 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 				 
							 <?php endif; ?>
							<?php endfor; else: ?>
							 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 
							 <?php endif; ?> 
							</table> 					
                			
                </td>
            </tr>
			 <?php else: ?>
						 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 				 
							 <?php endif; ?>
        <?php if ($this->_tpl_vars['payment_status'] == '0' && $this->_tpl_vars['hospname'] != '0' && $this->_tpl_vars['totalRows'] > 0): ?>                   
		<tr><td colspan="5" align="center" class="labeltxt">
        <form name="payonce" action="payment.php" method="post" >
        <input type="hidden" name="startdate" value="<?php echo $this->_tpl_vars['startdate']; ?>
" />
        <input type="hidden" name="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" />
        <input type="hidden" name="hospname" value="<?php echo $this->_tpl_vars['hospname']; ?>
" />
        <input type="hidden" name="payment_status" value="<?php echo $this->_tpl_vars['payment_status']; ?>
" />
        <input type="hidden" name="request_status" value="<?php echo $this->_tpl_vars['request_status']; ?>
" />
        <input type="hidden" name="pname" value="<?php echo $this->_tpl_vars['pname']; ?>
" />
        <input type="hidden" name="reclaim" value="<?php echo $this->_tpl_vars['reclaim']; ?>
" />
        <input type="submit" class="inputButton btn" name="payonce" value="Collected For All Search" /></form>
        </td></tr>
        <?php endif; ?>
      </table>
					     			       </td>
                   </tr>
			    <tr><td></td>
			</tr>		 
      </table>  
    </td>
  </tr>
</table>
<table><tr><td align="left"><?php echo $this->_tpl_vars['pages']; ?>
</td></tr></table>
<?php echo '
<script>selbox();</script>	
<script>
function chgpaystatus(pay,fid,id){
$.post("changestatus.php",{pay:pay,fid:fid},function(result){
	if(result != \'\') { location.reload(); }
		//$("#paystatus"+id).attr(\'disabled\',true);
		 }); }
</script>	 
'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>