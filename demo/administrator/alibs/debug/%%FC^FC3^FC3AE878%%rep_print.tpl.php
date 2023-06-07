<?php /* Smarty version 2.6.12, created on 2019-04-24 15:11:23
         compiled from reportstpl/rep_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reportstpl/rep_print.tpl', 29, false),array('modifier', 'upper', 'reportstpl/rep_print.tpl', 33, false),array('modifier', 'substr', 'reportstpl/rep_print.tpl', 45, false),)), $this); ?>
 <?php echo '
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<style type="text/css">
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
	.tdheight { height:21px; vertical-align:bottom; }
.tde { border-bottom:1px solid #666; }	
.p { width:140px; line-height:14px; text-align:justify; height:auto; margin:0; padding:0; float:left;}
.headus { font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; color:#000;}
.val {font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}	
    </style>
'; ?>

<div align="left">
  <div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
<!---->
<table width="100%" border="0" class="main_table">
<!--<tr><td colspan="9"> 
             <img src="../images/logo.png" width="100px" height="60px" border="0" /> <br/><br/>
              </td></tr>-->
<!--<tr>
<td colspan="5"><strong>Provider Name:</strong>________________________________ </td>
<td colspan="5"><strong>WEEK ENDING:</strong>________________________________ </td>
<td colspan="2"><strong>From</strong> - <strong>To :</strong><br/><strong>Total Completed Trips:</strong><br/><strong>Total Miles:</strong></td>
<td colspan="3"><?php echo ((is_array($_tmp=$this->_tpl_vars['stdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
<br/><?php echo $this->_tpl_vars['st4']; ?>
<br/><?php echo $this->_tpl_vars['tmiles']; ?>
</td>
</tr>-->

<tr><td colspan="3" width="30%" align="left" style="border-bottom:#000 solid 1px;"  class="headus"><strong>Transportation Provider:</strong> </td>
<td colspan="3" width="30%" style="border-bottom:#000 solid 1px;" class="val"> <?php echo ((is_array($_tmp=$this->_tpl_vars['contact']['title'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</td>
<td colspan="3">&nbsp;</td></tr>

<tr><td colspan="3" align="left" style="border-bottom:#000 solid 1px;" class="headus"><strong>Date of Service:</strong>  </td>
<td colspan="3"  style="border-bottom:#000 solid 1px;" class="val"> <?php echo ((is_array($_tmp=$this->_tpl_vars['stdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>
<td colspan="3">&nbsp;</td></tr>

<tr><td colspan="3" align="left" style="border-bottom:#000 solid 1px;" class="headus"><strong>Driver's License Number:</strong>  </td>
<td colspan="3"  style="border-bottom:#000 solid 1px;" class="val"> <?php echo $this->_tpl_vars['data']['0']['license']; ?>
</td>
<td colspan="3">&nbsp;</td></tr>

<tr><td colspan="3" align="left" style="border-bottom:#000 solid 1px;" class="headus"><strong>Vehicle ID Number (VIN, Last five digits:</strong>  </td>
<td colspan="3"  style="border-bottom:#000 solid 1px;" class="val"> <?php echo ((is_array($_tmp=$this->_tpl_vars['dataV']['vin'])) ? $this->_run_mod_handler('substr', true, $_tmp, -5) : substr($_tmp, -5)); ?>
</td>
<td colspan="3">&nbsp;</td></tr>
<tr><td colspan="9">
<table width="100%" border="1" cellspacing="0">
  <tr>
   
    <td style="text-align:center"  width="5%">MTM Trip Number</td>
    <td style="text-align:center"  width="15%">Beneficiary Printed Name</td>
    <td style="text-align:center" width="5%">Scheduled<br/>Pickup Time</td>
    <td style="text-align:center" width="5%">Pickup<br/>Arrival</td>
    <td style="text-align:center" width="5%">Pickup<br/>Departure</td>
	<td style="text-align:center" width="5%">Drop off<br/>Time</td>
    
    
    
    
    
    <td style="text-align:center" width="5%">Pickup<br/>Odometer</td>
    <td style="text-align:center" width="5%">Drop Off<br/>Odometer</td>
    <td style="text-align:center" width="20%">Recipient's Signature</td>
    
  </tr>
  <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  	<td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['ccode']; ?>
</td>
    <td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_user']; ?>
</td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'] == '00:00:00'): ?>--:--<?php else:  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time']; ?>
<!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p")); ?>
--><?php endif; ?></td>
    <td style="text-align:center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['arrived_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>
</td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'] == '00:00:00'): ?>--:--<?php else:  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime']; ?>
<!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p")); ?>
--><?php endif; ?></td>
    <!-- <td style="text-align:center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>-->
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_time'] == '00:00:00'): ?>--:--<?php else:  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_time']; ?>
<!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p")); ?>
--><?php endif; ?></td>
   
    
    <!--<td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'] == '00:00:00'): ?>--:--<?php else:  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'];  endif; ?></td>-->
    
    <td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['startmilage']; ?>
</td>
    <td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['endmilage']; ?>
</td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['signature'] != ''): ?><img src="../../iphone/signature/<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['signature']; ?>
" width="100" height="50" /><?php endif; ?></td>
    
  </tr>
  
<!-- <?php if ($this->_sections['q']['iteration']%3 == 0): ?>  <br/><br/><br/><br/><br/><br/><br/><br/><br/>
  <?php endif; ?>--> 
  
  <?php endfor; endif; ?>
</table>


</td></tr>
              <tr><td colspan="9"><br/><hr/>
              </td></tr>
              <tr><td colspan="10"  style="text-align:left" valign="top">
 Each leg of the transport must be documented on separate lines. A signature is required for each leg of the transport. <strong>All times must be documented using military time format.</strong> No shows will be indicated with NS in the Drop-Off Time.
 
<br/><br/>
<strong>I certify that all information contained herein is true and accurate, and understand that this statement is made subject to the applicable penalties under federal and state law for making false declarations.</strong>
</td></tr> 
<tr><td colspan="6" style="text-align:left; padding-left:1px; border-bottom:#000 solid 1px;">

<strong>DRIVER'S SIGNATURE:</strong>   <?php if ($this->_tpl_vars['data']['0']['drsignature'] != ''): ?><u><img src="../<?php echo $this->_tpl_vars['data']['0']['drsignature']; ?>
" width="120" height="60" /></u><?php endif; ?>
</td></tr>
<tr><td colspan="6" style="text-align:left; padding-left:1px; border-bottom:#000 solid 1px;"><br/>
<strong>DRIVER'S PRINTED NAME:</strong> <?php echo $this->_tpl_vars['data']['0']['name']; ?>
	
</td></tr>  </table>


  </div>
</div>
