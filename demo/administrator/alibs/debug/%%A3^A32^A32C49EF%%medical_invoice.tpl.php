<?php /* Smarty version 2.6.12, created on 2019-04-24 15:49:06
         compiled from reportstpl/medical_invoice.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'reportstpl/medical_invoice.tpl', 56, false),array('modifier', 'date_format', 'reportstpl/medical_invoice.tpl', 59, false),array('modifier', 'lower', 'reportstpl/medical_invoice.tpl', 82, false),array('modifier', 'replace', 'reportstpl/medical_invoice.tpl', 172, false),array('modifier', 'string_format', 'reportstpl/medical_invoice.tpl', 195, false),array('modifier', 'upper', 'reportstpl/medical_invoice.tpl', 215, false),array('modifier', 'truncate', 'reportstpl/medical_invoice.tpl', 244, false),)), $this); ?>
 <?php echo '
 <style type="text/css">
 .bg_col {  background-color:#ffe5d8; !important;
 background-image: none !important;
}
   #printable { display: block; }
    @media print
    {
      #non-printable { display: none; }
      #printable { display: block; }
    }
table { font-family:"Arial"}
table td { font-size:12px; color:#000;}
table td b { font-size:8px; font-weight:bold; padding-left:3px; color:#fb070e;}
    </style>
'; ?>

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="width:1030px; margin:auto;" ><table width="1030px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20"><table width="795" border="0" cellspacing="0" cellpadding="0" id="non-printable">
      <tr>
        <td width="572"><span style="color:#F00; font-size:12px;" ><?php if ($this->_tpl_vars['sra'] == '1'): ?>Special Rates Authorized<?php endif; ?></span>
        </td>
        <td width="26" align="center" valign="middle"></td>
       <td width="27" align="left" valign="middle"><a href="javascript:window.print();"><img src="../images/print.gif" width="16" height="16" border="0" /></a></td>
      </tr>
    </table></td>
    </tr>
       <tr>
        <td>
        <table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:7px;">
 <tr>
<td width="28%" align="center">&nbsp;<img src="../images/logo.png" alt="" width="250px;" height="100px;" /><br/>
<strong><span style="font-size:15px;" ><!--EIN : 46-4816250--></span></strong>
</td>
<td align="center" width="28%"><strong>
<?php echo $this->_tpl_vars['cdata']['title']; ?>
<br/>
<?php echo $this->_tpl_vars['cdata']['address']; ?>
<br/>
<?php echo $this->_tpl_vars['cdata']['city']; ?>
, <?php echo $this->_tpl_vars['cdata']['state']; ?>
 <?php echo $this->_tpl_vars['cdata']['zip']; ?>
<br/>
Phone#: <?php echo $this->_tpl_vars['cdata']['phone']; ?>
<br/>
Fax#: <?php echo $this->_tpl_vars['cdata']['fax']; ?>
<br/>
<!--Email: billing@medstarmedicaltransport.com--></strong></td>
 <td width="38%" align="center"><span style="font-weight:bold; text-decoration:underline;"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:30px; font-weight:bold; color:#000000; padding-left:5px;">Invoice</td>
          </tr>
          
          <tr>
            <td ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: solid #000000 1px;">
              <tr>
                <td width="122" height="22" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; border-bottom: solid #000000 1px; border-right: solid #000000 1px;">DATE</td>
                <?php if ($this->_tpl_vars['data']['gen_date'] != $this->_tpl_vars['data']['last_updated']): ?>
                <td width="122" height="22" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; border-bottom: solid #000000 1px; border-right: solid #000000 1px;">Last Updated</td>
                <?php endif; ?>
                <td width="122" height="22" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; border-bottom: solid #000000 1px;">INV<?php echo smarty_function_counter(array('start' => 0), $this);?>
ICE # </td>
              </tr>
              <tr>
                <td height="22" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal; color:#000000; border-right: solid #000000 1px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['tdata']['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                <?php if ($this->_tpl_vars['data']['gen_date'] != $this->_tpl_vars['data']['last_updated']): ?>
                 <td height="22" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal; color:#000000; border-right: solid #000000 1px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['last_updated'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                 <?php endif; ?>
                
                <td height="22" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal; color:#000000;"><?php echo $this->_tpl_vars['tdata']['id'];  echo $this->_tpl_vars['totals']; ?>
</td>
              </tr>
            </table></td>
          </tr>
         </table>      
        </td>
  </tr>       
    <tr>
        <td colspan="3">
        <table width="100%" border="1" align="center">
  <tr>
    <td width="50%" style="text-align:center"><strong>BILL TO</strong></td>
    <td width="50%" style="text-align:center"><strong>CLIENT INFORMATION</strong></td>
  </tr>
  <tr>
    <td><strong>Account Name:</strong> <?php echo $this->_tpl_vars['tdata']['account_name']; ?>
<br/>
        <strong>Billing address:</strong> <?php echo $this->_tpl_vars['tdata']['address']; ?>
, <?php echo $this->_tpl_vars['tdata']['city']; ?>
, <?php echo $this->_tpl_vars['tdata']['state']; ?>
 <?php echo $this->_tpl_vars['tdata']['zip']; ?>
</td>
    <td valign="top"><strong><?php echo $this->_tpl_vars['tdata']['clientname']; ?>
</strong><br/><br/>
    	<?php if (((is_array($_tmp=$this->_tpl_vars['tdata']['account_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'mercy care' || ((is_array($_tmp=$this->_tpl_vars['tdata']['account_name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'mercycare'): ?>
        <?php if ($this->_tpl_vars['tdata']['dob'] != '0000-00-00'): ?><strong>DOB:</strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['tdata']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
<br/><br/><?php endif; ?>
        <?php endif; ?>
        <strong>Claim #:</strong> <?php echo $this->_tpl_vars['tdata']['claim_no']; ?>
<br/><br/>
        <strong>Address:</strong><br/>
    <?php echo $this->_tpl_vars['tdata']['pickaddr']; ?>
</td>
  </tr>
</table>
  <!--<tr>
    <td colspan="3">
    <table width="100%" border="1">
  <tr>
    <td width="10%">Pickup<br/>Charges</td>
    <td width="10%">Per Mile<br/>Charges</td>
    <td width="10%">Wait Time<br/>Charges</td>
    <td width="10%">No Show<br/>Fee</td>
    <td width="10%">After<br/>Hours<br/>Fee</td>
    <td width="10%">2 Man Team<br/>Charges</td>
    <td width="10%">Bariatric<br/>Stretcher<br/>Charges</td>
    <td width="10%">Oxygen<br/>Charges</td>
    <td width="10%">Wheel Chair <br/>Rental<br/>Charges</td>
  </tr>
  <tr>
     <td>$ <?php echo $this->_tpl_vars['rates']['pickup_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['permile_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['waittime_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['noshow_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['afterhour_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['dstretcher_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['bstretcher_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['oxygen_ch']; ?>
</td>
     <td>$ <?php echo $this->_tpl_vars['rates']['doublewheel_ch']; ?>
</td>
  </tr>
   <tr>
    <td colspan="10" height="30"  style="border: solid #000000 0px;">&nbsp;</td>
  </tr>
</table>
</td>
  </tr>-->
  <tr>
    <td colspan="3">
    	<table width="100%" border="1"  align="center">
 <tr>
            <td width="40%" height="20" align="center" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000000; padding-bottom:5px; border-right: solid #000000 1px; border-bottom: solid #000000 1px;">DESCRIPTION</td>
            <td width="15%" height="20" align="center" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000000; padding-bottom:5px; border-bottom: solid #000000 1px;">AMOUNT</td>
          </tr>
          <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['tdataB']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <td  width="85%">&nbsp;
    <strong> Leg <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?>A<?php elseif ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?>B<?php elseif ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '3'): ?>C<?php elseif ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '4'): ?>D<?php endif; ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'One Way'): ?>
    &nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['apptime']; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'Round Trip'): ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['apptime'];  endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['returnpickup'];  endif; ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'Three Way'): ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['apptime'];  endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['three_pickup'];  endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '3'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['returnpickup'];  endif; ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'Four Way'): ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['apptime']; ?>
 <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['three_pickup']; ?>
 <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '3'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['four_pickup']; ?>
 <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '4'): ?>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['returnpickup']; ?>
 <?php endif; ?>
    <?php endif; ?>    
    <!--/ <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'):  echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['apptime'];  else:  echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['returnpickup'];  endif; ?>--></strong>
    
    <br/>
    <table width="100%" border="0" style="padding-left:10px;">
    <tr>
    <td><strong>&nbsp;PO#:</strong>&nbsp; <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['po']; ?>
 / 
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'):  echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['legaid'];  elseif ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'):  echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['legbid'];  elseif ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '3'):  echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['legcid'];  elseif ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '4'):  echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['legdid'];  endif; ?></td>
    <td><strong>&nbsp;Account Name:</strong>&nbsp; <?php echo $this->_tpl_vars['tdata']['account_name']; ?>
</td>
    <td><strong>&nbsp;Vehicle Service:  <?php echo $this->_tpl_vars['vdata']['vehtype']; ?>
<br/>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['miscellaneous_charges'] != '0'): ?>Misc. Chrg: <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['miscellaneous_charges']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['afterhour'] == '1'): ?>After Hour Fee: <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['afterhour_rate']; ?>
<br/><?php endif; ?></strong>
    </td>
  
    </tr>
 <!-- <tr>
    <td><strong>&nbsp;Pick Address:</strong><br/></td>
    <td><strong>&nbsp;Drop Address:</strong><br/></td>-->
    <!--<td>&nbsp;<?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['vehicle']; ?>
</td>-->
    <!--<td>&nbsp;<strong>Wait Time Charges: </strong><?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['waittime'] != '00:00:00'): ?> $ <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['waittime_rate'];  else: ?> $ 0 <?php endif; ?>--></td>
  <!--</tr>-->
  <tr>
  	<?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'One Way'): ?>
    <td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['pickaddr'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td>
    <td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'Round Trip'): ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['pickaddr'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['backto'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'Three Way'): ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['pickaddr'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['three_address'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '3'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['three_address'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['backto'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['triptype'] == 'Four Way'): ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '1'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['pickaddr'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '2'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['destination'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['three_address'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '3'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['three_address'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['four_address'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php if ($this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['leg'] == '4'): ?><td valign="top"><strong>&nbsp;Pick Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['four_address'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td><td valign="top"><strong>&nbsp;Drop Address:</strong><br/><?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['backto'])) ? $this->_run_mod_handler('replace', true, $_tmp, ', United States', '') : smarty_modifier_replace($_tmp, ', United States', '')); ?>
</td> <?php endif; ?>
    <?php endif; ?>
    <td  valign="top"><strong>Total Miles =</strong> <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['miles']; ?>
<!--<br/><strong>Free Miles =</strong> <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['freemiles']; ?>
<br/><strong>Billable Miles =</strong> <?php echo $this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['chargeablemile']; ?>
--></td>
    
  </tr>
</table>
    </td>
    <td  width="15%" style="text-align:center;"><strong>$ <?php echo ((is_array($_tmp=$this->_tpl_vars['tdataB'][$this->_sections['q']['index']]['charges'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</strong></td>
  </tr>
          <?php endfor; endif; ?>
 <!-- <tr>
  
    <td>  <table width="100%" border="0" style="padding-left:10px;">
  <tr>
    <td colspan="2"  style="text-align:right;"><strong>&nbsp;Total Amount:</strong></td>
    </tr>
  
</table></td>
<td style="text-align:center;"><strong>$ <?php echo $this->_tpl_vars['totalammount']; ?>
<input type="hidden" id="totalammount" value="<?php echo $this->_tpl_vars['totalammount']; ?>
"  /></strong></td>
      </tr>-->
   <tr>
    <td ><strong>Thank You For Using <?php echo $this->_tpl_vars['cdata']['title']; ?>
</strong>	<div style="text-align:right;" ><strong>Grand Total</strong></div></td>
    <td style="text-align:center;"> 	
					<strong>$ <?php echo ((is_array($_tmp=$this->_tpl_vars['gtotal'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</strong>
    </td>
  </tr>
  <tr><td colspan="4"><strong><ul>
  <li>MAKE ALL CHECKS PAYABLE TO <?php echo ((is_array($_tmp=$this->_tpl_vars['cdata']['title'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
, TOTAL DUE IN 30 DAYS UPON RECEIPT.</li>
 <!-- <li>OVERDUE ACCOUNTS SUBJECT TO A CHARGE OF 12% PER MONTH</li>-->
  <li>TOTAL CHARGES INCLUDE DISPATCH AND PICK-UP, DRIVER WAITING TIME AND ON-SITE CANCELLATION FEES</li>
  </ul></strong></td></tr>
          
          </table>
    <!--<table width="100%" border="1">
  	<tr style="background-color:#CCC;">
    <td align="center" width="4%"><strong>#</strong></td>
    <td align="center" width="8%"><strong>Date</strong></td>
    <td align="center" width="10%"><strong>Customer Name</strong></td>
    <td align="center" width="5%"><strong>PO#</strong></td>
    <td align="center" width="8%"><strong>Account</strong></td>
    <td align="center" width="13%"><strong>Pick Up Address</strong></td>
    <td align="center" width="13%"><strong>Delivery Address</strong></td>
    <td align="center" width="5%"><strong>Time</strong></td>
    <td align="center" width="10%"><strong>Vehicle Service</strong></td>
    <td align="center" width="10%"><strong>Miles</strong></td>
    <td align="center" width="18%"><strong>Out of Area / Misc Fee</strong></td>
    <td align="center" width="12%"><strong>Total $</strong></td>
  </tr>
 <tr>
    <td>Leg A</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['tdata']['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['clientname']; ?>
</td>
	<td><?php echo $this->_tpl_vars['tdata']['po']; ?>
<br/><?php echo $this->_tpl_vars['tdata']['legaid']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['account_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['pickaddr']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['destination']; ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['tdata']['apptime'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
</td>
    <td><?php echo $this->_tpl_vars['vdata']['vehtype']; ?>
<br />Pickup Charges: <?php echo $this->_tpl_vars['legA']['pickup_ch']; ?>
<br />Price Per Mile: <?php echo $this->_tpl_vars['legA']['permile_ch']; ?>
</td>
    <td>Total Miles = <?php echo $this->_tpl_vars['legA']['miles']; ?>
<br/>Free Miles = <?php echo $this->_tpl_vars['legA']['freemiles']; ?>
<br/>Billable Miles = <?php echo $this->_tpl_vars['chargeablemile1']; ?>
</td>
    <td>
<?php if ($this->_tpl_vars['legA']['miscellaneous_charges'] != '0'): ?>Misc. Chrg: <?php echo $this->_tpl_vars['legA']['miscellaneous_charges']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['dstretcher'] == 'Yes'): ?>2ManTeam Chrg: <?php echo $this->_tpl_vars['legA']['dstretcher_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['oxygen'] == 'Yes'): ?>Oxg. Chrg: <?php echo $this->_tpl_vars['legA']['oxygen_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['bstretcher'] == 'Yes'): ?>Bariatric Str. Chrg: <?php echo $this->_tpl_vars['legA']['bstretcher_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['doublewheel'] == 'Yes'): ?>WheelChair Rental Chrg: <?php echo $this->_tpl_vars['legA']['doublewheel_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['afterhour'] == '1'): ?>After Hour Fee: <?php echo $this->_tpl_vars['legA']['afterhour_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['noshow'] == '1'): ?>No Show Fee: <?php echo $this->_tpl_vars['legA']['noshow_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legA']['waittime_unit'] != '0'): ?>Wait Time Charges: <?php echo $this->_tpl_vars['legA']['waittime_rate']; ?>
<br/><?php endif; ?>
    </td>
    <td>$&nbsp;<?php echo $this->_tpl_vars['legA']['charges']; ?>
</td>
 </tr>
 <?php if ($this->_tpl_vars['tdata']['triptype'] == 'Round Trip'): ?>
 <tr>
     <td>Leg B</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['tdata']['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['clientname']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['po']; ?>
<br/><?php echo $this->_tpl_vars['tdata']['legbid']; ?>
</td>
	<td><?php echo $this->_tpl_vars['tdata']['account_name']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['destination']; ?>
</td>
    <td><?php echo $this->_tpl_vars['tdata']['backto']; ?>
</td>
    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['tdata']['returnpickup'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5, "") : smarty_modifier_truncate($_tmp, 5, "")); ?>
</td>
    <td><?php echo $this->_tpl_vars['vdata']['vehtype']; ?>
<br />Pickup Charges: <?php echo $this->_tpl_vars['legB']['pickup_ch']; ?>
<br />Price Per Mile: <?php echo $this->_tpl_vars['legB']['permile_ch']; ?>
</td>
    <td>Total Miles = <?php echo $this->_tpl_vars['legB']['miles']; ?>
<br/>Free Miles = <?php echo $this->_tpl_vars['legB']['freemiles']; ?>
<br/>Billable Miles = <?php echo $this->_tpl_vars['chargeablemile2']; ?>
</td>
    <td>
<?php if ($this->_tpl_vars['legB']['miscellaneous_charges'] != '0'): ?>Misc. Chrg: <?php echo $this->_tpl_vars['legB']['miscellaneous_charges']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['dstretcher'] == 'Yes'): ?>2ManTeam Chrg: <?php echo $this->_tpl_vars['legB']['dstretcher_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['oxygen'] == 'Yes'): ?>Oxg. Chrg: <?php echo $this->_tpl_vars['legB']['oxygen_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['bstretcher'] == 'Yes'): ?>Bariatric Str. Chrg: <?php echo $this->_tpl_vars['legB']['bstretcher_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['doublewheel'] == 'Yes'): ?>WheelChair Rental Chrg: <?php echo $this->_tpl_vars['legB']['doublewheel_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['afterhour'] == '1'): ?>After Hour Fee: <?php echo $this->_tpl_vars['legB']['afterhour_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['noshow'] == '1'): ?>No Show Fee: <?php echo $this->_tpl_vars['legB']['noshow_rate']; ?>
<br/><?php endif; ?>
<?php if ($this->_tpl_vars['legB']['waittime_unit'] != '0'): ?>Wait Time Charges: <?php echo $this->_tpl_vars['legB']['waittime_rate']; ?>
<br/><?php endif; ?>
    </td>
    <td>$&nbsp;<?php echo $this->_tpl_vars['legB']['charges']; ?>
</td>
 </tr><?php endif; ?>
 <tr>
 <td></td>
 <td colspan="9"> Grand Total: </td>
 <td><?php echo $this->_tpl_vars['total_charges']; ?>
</td>
 </tr>
  
  </table>-->
  </td></tr></table>
  </td>
      </tr>
    </table></div></td>
  </tr>
</table>