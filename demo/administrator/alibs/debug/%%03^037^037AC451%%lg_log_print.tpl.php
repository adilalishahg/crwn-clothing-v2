<?php /* Smarty version 2.6.12, created on 2019-04-24 15:15:05
         compiled from reportstpl/lg_log_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reportstpl/lg_log_print.tpl', 25, false),array('modifier', 'upper', 'reportstpl/lg_log_print.tpl', 37, false),array('modifier', 'substr', 'reportstpl/lg_log_print.tpl', 45, false),)), $this); ?>
 <?php echo '
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<style type="text/css">
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
	
    </style>
'; ?>

<div align="left">
  <div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">

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

<!--<tr>


<td colspan="9" align="center"><strong>DRIVER'S NAME:</strong>  <?php echo $this->_tpl_vars['data']['0']['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<strong>Vehicle Number:</strong>  <?php echo $this->_tpl_vars['dataV']['vin']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Driving License Number:</strong>  <?php echo $this->_tpl_vars['data']['0']['license']; ?>
</td>
</tr>-->
<tr>

<td colspan="3" align="center" style="font-size:13px;"  width="35%"><u><?php echo ((is_array($_tmp=$this->_tpl_vars['contact']['title'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</u><br/>  <strong>PROVIDER NAME</strong> </td>
<td colspan="3" align="center" style="font-size:13px;" width="35%"><u><?php echo ((is_array($_tmp=$this->_tpl_vars['stdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['enddate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</u><br/> <strong> WEEK ENDING</strong> </td>
<td colspan="3" width="30%"></td>
</tr>

<tr>

<td colspan="3" align="center"  style="font-size:13px;"><u><?php echo $this->_tpl_vars['data']['0']['name']; ?>
</u><br/>  <strong>DRIVER'S NAME (as it appears on driver license)</strong> </td>
<td colspan="3" align="center" style="font-size:13px;"><u><?php echo ((is_array($_tmp=$this->_tpl_vars['dataV']['vin'])) ? $this->_run_mod_handler('substr', true, $_tmp, -6) : substr($_tmp, -6)); ?>
</u><br/>  <strong>Vehicle Number (Last six of VIN)</strong> </td>
<td colspan="3"></td><td></td>
</tr>
<?php echo '
'; ?>

<tr><td colspan="10">
<table width="100%" border="1" cellspacing="0">
  <tr>
    <td style="text-align:center" width="5%">Date of<br/>Service</td>
    <td style="text-align:center"  width="5%">LogistiCare<br/>Job #<br/>A or B</td>
    <td style="text-align:center"  width="15%">Recipient Name</td>
    <td style="text-align:center" width="1%">A<br/>W<br/>S</td>
    <td style="text-align:center" width="5%">Pick-up<br/>Time</td>
    <td style="text-align:center" width="5%">Drop off<br/>Time</td>
    
    <td style="text-align:center" width="5%">Total Trip<br/>Mileage</td>
    <td style="text-align:center" width="5%">Per Trip<br/>Billed<br/>Amount</td>
    <td style="text-align:center" width="25%">Recipient's Signature</td>
    <td style="text-align:center" colspan="2" width="15%">Driver and Passenger confirm by initialing that passenger was properly secured<br/>
    
    <table width="100%" border="0">
  <tr>
    <td width="50%" style="text-align:center">&nbsp;Rider</td>
    <td width="50%" style="text-align:center">&nbsp;Driver</td>
  </tr>
</table></td>
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
    <td style="text-align:center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td>
    <td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['ccode']; ?>
</td>
    <td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_user']; ?>
</td>
    <td style="text-align:center"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['vehtype'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 1) : substr($_tmp, 0, 1)); ?>
</td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'] == '00:00:00'): ?>--:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M") : smarty_modifier_date_format($_tmp, "%I:%M")); ?>
<!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['aptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p")); ?>
--><?php endif; ?></td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'] == '00:00:00'): ?>--:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M") : smarty_modifier_date_format($_tmp, "%I:%M")); ?>
<!-- <?php echo ((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['drp_atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%p") : smarty_modifier_date_format($_tmp, "%p")); ?>
--><?php endif; ?></td>
    
    <td style="text-align:center"><?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['trip_miles']; ?>
</td>
    <td style="text-align:center">$ <?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['charges']; ?>
</td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['signature'] != ''): ?><img src="../../iphone/signature/<?php echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['signature']; ?>
" width="100" height="50" /><?php endif; ?></td>
    <td style="text-align:center"><?php if ($this->_tpl_vars['data'][$this->_sections['q']['index']]['patient_initial'] == ''): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php else:  echo $this->_tpl_vars['data'][$this->_sections['q']['index']]['patient_initial'];  endif; ?></td>
    <td style="text-align:center">&nbsp;&nbsp;<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['dfname'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 1) : substr($_tmp, 0, 1)))) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp));  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['data'][$this->_sections['q']['index']]['dlname'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 1) : substr($_tmp, 0, 1)))) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
&nbsp;&nbsp;</td>
  </tr>
  
<!-- <?php if ($this->_sections['q']['iteration']%3 == 0): ?>  <br/><br/><br/><br/><br/><br/><br/><br/><br/>
  <?php endif; ?>--> 
  
  <?php endfor; endif; ?>
</table>


</td></tr>

              <tr><td colspan="10"><br/><hr/><br/></td></tr>
              <tr><td colspan="10"  style="text-align:left" valign="top">
<strong>**NOTE*** Leg of Transport</strong> - a leg of transport is the point at pick-up to the destination. Example: Picking recipient up at residence and transporting to the doctor's office would be considered on leg, picking the recipient up at the doctor's office and transporting back to the residence would be considered the second leg at the trip. Each leg of the transport must be documented on separate lines. A signature is required for each leg of the transport. Pick-up and drop-off times must be documented and in military time.
 <br/><br/>
 </td></tr>
<tr><td colspan="8"><strong>Driver's Comments:</strong> ______________________________________________________________________________________________</td></tr>
<tr><td colspan="8"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</strong> ______________________________________________________________________________________________<br/><strong>
I understand that the Broker will verify the accuracy of the mileage being reported and I hereby certify the information<br/> herein is true, correct and accurate.</strong>
</td></tr>


<tr><td colspan="10" >
<br/>
<div style="text-align:left; padding-left:10px;"> 
DRIVER'S SIGNATURE:   <?php if ($this->_tpl_vars['data']['0']['drsignature'] != ''): ?><u><img src="../<?php echo $this->_tpl_vars['data']['0']['drsignature']; ?>
" width="120" height="60" /></u><?php endif; ?></div>
</td></tr>


  </table>

<strong> </strong>
  </div>
</div>
