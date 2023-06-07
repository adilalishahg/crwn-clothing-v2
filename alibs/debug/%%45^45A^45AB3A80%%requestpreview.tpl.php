<?php /* Smarty version 2.6.12, created on 2021-02-15 15:58:03
         compiled from requestpreview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'requestpreview.tpl', 48, false),)), $this); ?>
<link href="css/preview.css" rel="stylesheet" type="text/css">
<?php echo '
<style>
.ptxt{
  font-family:Arial, Helvetica, sans-serif;
  font-weight:bold;
  font-size:11px;
}
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
.tde { border-bottom:1px solid #666; }	
.p { width:140px; line-height:14px; text-align:justify; height:auto; margin:0; padding:0; float:left;}
.headus { font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; color:#000;}
.val {font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
</style>
'; ?>

<div align="left">
  <div align="right" id="non-printable" style="width:840px; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
    <table border="0" cellspacing="1" cellpadding="1" width="840">
      <tr >
        <td class="tde" colspan="2"  valign="top"><p class="style4">&nbsp; <a href="http://<?php echo $this->_tpl_vars['eurl']; ?>
"><img src="images/van.png" border="0" style="max-height:70px; max-width:200px;"></a></td>
        <td class="tde" valign="top" colspan="2"><p align="center" class="style4"><em><b>TRANSPORTATION ORDER</b></em> </td>
        <td class="tde" valign="top" colspan="2"><strong> <font color="#000000" size="1px" ><?php echo $this->_tpl_vars['contact']['0']['title']; ?>
,<br />
          <?php echo $this->_tpl_vars['contact']['0']['address']; ?>
, <br />
          <?php echo $this->_tpl_vars['contact']['0']['city']; ?>
, <?php echo $this->_tpl_vars['contact']['0']['state']; ?>
, <?php echo $this->_tpl_vars['contact']['0']['zip']; ?>
 <br />
          TEL:<?php echo $this->_tpl_vars['contact']['0']['phone']; ?>
</font></strong></td>
      </tr>

<?php if ($this->_tpl_vars['RequestDetail']['0']['ftof'] == '1'): ?> <tr><td colspan="4"><span style="color:#F00;">Facility to Facility</span></td></tr>  <?php endif; ?>
      
<tr><!--<td width="140" class="headus">Facility: </td>
<td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['hospname']; ?>
</td>
<td width="140" class="headus">Insurance Type:</td><td width="140" class="val"></td>
<td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['insurance_name']; ?>
</td><td width="140" class="val"></td>--></tr>

<tr><!--<td width="140" class="headus">Insurance ID:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['cisid']; ?>
</td><td width="140" class="headus">S.S.N #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['ssn']; ?>
</td>
<td width="140" class="headus">Appointment Type:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['appt_type']; ?>
</td></tr>-->

<tr><td width="140" class="headus">Client Name:</td><td colspan="2" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['clientname']; ?>
</td><td width="140" class="headus"></td><td  colspan="2" class="val"></td></tr>

  <tr><td width="140"><p class="p"></p></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td></tr>

<tr><td width="140" class="headus">Requested Date:</td><td width="140" class="val"><?php echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['today_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td><td width="140"  class="headus">Appointment Date:</td><td width="140" class="val"><?php echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y")); ?>
</td><td width="140" class="headus">D.O.B:</td><td width="140" class="val"><?php if ($this->_tpl_vars['RequestDetail']['0']['dob'] != '0000-00-00'):  echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m/%d/%Y") : smarty_modifier_date_format($_tmp, "%m/%d/%Y"));  endif; ?></td></tr>


<tr><td width="140" class="headus">Client Weight:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['patient_weight']; ?>
 Lbs</td><td width="140"  class="headus">PO #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['po']; ?>
</td><td width="140"  class="headus">Claim #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['claim_no']; ?>
</td></tr>


<tr><td width="140" class="headus">Client Phone #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['phnum']; ?>
</td><td width="140" class="headus">Service Needed:</td><td width="140" class="val"><?php echo $this->_tpl_vars['vehtype']; ?>
</td><td width="140" class="headus">Trip Type:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['triptype']; ?>
</td></tr>
  
    <tr><td width="140"><p class="p"></p><br/></td><td width="140" class="val"></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td></tr>
  
<tr><td width="140" class="headus">Pick Up Phone#:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['p_phnum']; ?>
</td><td width="140" class="headus">Pickup Location:</td>
<td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['picklocation']; ?>
</td></tr>

 
<tr><td width="140" class="headus"></td><td width="140" colspan="3" class="val"></td><td width="140" class="headus">Appointment Time:</td>
<td width="140" class="val"><?php echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['org_apptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td></tr>

<tr><td width="140" class="headus">Pick Address:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['roomapt']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['pickaddr']; ?>
</td><td width="140" class="headus">Pick Time(1):</td><td width="140" class="val"><?php echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['apptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td></tr>

<tr><td width="140" class="headus">Pick Instructions:</td><td colspan="4" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['pickup_instruction']; ?>
</td></tr>

<tr><td width="140" class="headus">Destination Phone#:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['d_phnum']; ?>
</td><td width="140" class="headus">Drop Location:</td>
<td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['droplocation']; ?>
</td></tr>
<tr><td width="140" class="headus">Destination:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['stebldg']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['destination_place']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['destination']; ?>
</td><td width="140" class="headus">Pick Time(2):</td><td width="140" class="val"><?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Round Trip'):  echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['returnpickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?>
<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Three Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Four Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'):  echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['three_pickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?></td></tr>
<tr><td width="140" class="headus" colspan="2">Destination Instructions:</td><td colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['destination_instruction']; ?>
</td></tr>

<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Three Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Four Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'): ?>
<tr><td width="140" class="headus">Second Destination:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['stebldg3']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['destination_place3']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['three_address']; ?>
</td><td width="140" class="headus">Pick Time(3):</td><td width="140" class="val"><?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Three Way'):  echo ((is_array($_tmp=$this->_tpl_vars['returnpickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?>
<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Four Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'):  echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['four_pickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?></td></tr><?php endif; ?>

<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Four Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'): ?>
<tr><td width="140" class="headus">Third Destination:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['stebldg4']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['destination_place4']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['four_address']; ?>
</td><td width="140" class="headus">Pick Time(4):</td><td width="140" class="val"><?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Four Way'):  echo ((is_array($_tmp=$this->_tpl_vars['returnpickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?>
<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'):  echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['five_pickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?></td></tr><?php endif; ?>

<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'): ?>
<tr><td width="140" class="headus">Fourth Destination:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['stebldg5']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['destination_place5']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['five_address']; ?>
</td><td width="140" class="headus">Pick Time(Last):</td><td width="140" class="val"><?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'):  echo ((is_array($_tmp=$this->_tpl_vars['RequestDetail']['0']['returnpickup'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?></td></tr><?php endif; ?>

<?php if ($this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Round Trip' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Three Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Four Way' || $this->_tpl_vars['RequestDetail']['0']['triptype'] == 'Five Way'): ?>

<tr><td width="140" class="headus">Back To Location:</td>
<td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['backtolocation']; ?>
</td></tr>
<tr><td width="140" class="headus">Last Destination:</td><td width="140" colspan="3" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['backto']; ?>
</td><td width="140"></td><td width="140"></td></tr> <?php endif; ?>
  <tr><td width="140"><p class="p"></p></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td></tr>

  <tr><td width="140"><p class="p"></p></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td></tr>

<!--<tr>
<td width="140" class="headus">Driver:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['driver']; ?>
</td>
<td width="140" class="headus">Oxygen:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['oxygen']; ?>
</td>
<td width="140" class="headus">Child Seats:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['childseat']; ?>
</td></tr>-->
<tr>

<td width="140" class="headus">Bariatric Stretcher:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['bar_stretcher']; ?>
</td>
<td width="140" class="headus">2 Man Team:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['dstretcher']; ?>
</td>
</tr>
<tr>
<td width="140" class="headus">Wheel Chair Rental:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['dwchair']; ?>
</td>
<td width="140" class="headus">0xygen:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['oxygen']; ?>
</td>
</tr>

<?php if ($this->_tpl_vars['RequestDetail']['0']['phyaddress'] != ''): ?>
<tr><td width="140" class="headus">Physician Name:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['fname']; ?>
 <?php echo $this->_tpl_vars['RequestDetail']['0']['lname']; ?>
</td><td width="140" class="headus">Physician Hospital:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['clinic']; ?>
</td><td width="140" class="headus">Physician Phone/Fax:</td><td width="140" class="val"><?php echo $this->_tpl_vars['RequestDetail']['0']['phyphone']; ?>
 / <?php echo $this->_tpl_vars['RequestDetail']['0']['phyfax']; ?>
</td></tr>
<tr><td width="140" class="headus">Physician Address:</td><td width="140" class="val" colspan="2"><?php echo $this->_tpl_vars['RequestDetail']['0']['phyaddress']; ?>
</td><td width="140" class="headus">Reason for Visit:</td><td width="140" class="val" colspan="2"><?php echo $this->_tpl_vars['RequestDetail']['0']['reason']; ?>
</td></tr>
<?php endif; ?>

  <tr><td width="140" class="headus">Comments:</td><td width="140" class="val" colspan="5"><?php echo $this->_tpl_vars['RequestDetail']['0']['comments']; ?>
</td></tr>
      
      <tr valign="middle" class="pheading" height="35"> </tr>
    </table>
  </div>
</div>