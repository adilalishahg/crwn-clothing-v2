<?php /* Smarty version 2.6.12, created on 2022-07-28 13:12:07
         compiled from details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'details.tpl', 42, false),)), $this); ?>
 <?php echo '
<link rel="stylesheet" href="administrator/theme/style.css" type="text/css">
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
  <div align="right" id="non-printable" style="width:950px; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
  <table border="0" cellspacing="1" cellpadding="1" width="100%">
      <tr >
        <td class="tde" colspan="2"  valign="top"><p class="style4">&nbsp; <a href="http://<?php echo $this->_tpl_vars['contact']['0']['url']; ?>
"><img src="images/logo.png" border="0" style="max-height:70px; max-width:200px;"></a></td>
        <td class="tde" valign="top" colspan="2"><p align="center" class="style4"><em><b></b></em> </td>
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
   
 <tr><td colspan="6" style="height:20px;"></td></tr>
 <tr><td colspan="6">
 <table width="100%" border="0"  style=" outline-style:ridge; margin-left:10px; padding-left:10px;" >

  
</table>
 </td></tr>        <tr><td height="25" colspan="6" class="admintopheading">Patient Information </td></tr>
<tr><td colspan="6" style="height:20px;"></td></tr>
<tr><td width="140" class="headus">Patient Name:</td><td class="val"><?php echo $this->_tpl_vars['data']['0']['clientname']; ?>
</td><td width="140" class="headus">Account Name:</td><td class="val"><?php echo $this->_tpl_vars['data']['0']['account_name']; ?>
</td></tr>
<tr><td width="140" class="headus">PO #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['po']; ?>
</td><td width="140" class="headus">Claim #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['claim_no']; ?>
</td><td width="140" class="headus">Patient Weight:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['patient_weight']; ?>
 Lbs</td></tr>
<tr><td width="140"><p class="p"></p></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td><td width="140"></td></tr>

<tr><td width="140" class="headus">Requested Date:</td><td width="140" class="val"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['today_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td><td width="140"  class="headus">Appointment Date:</td><td width="140" class="val"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td><td width="140" class="headus">D.O.B:</td><td width="140" class="val"><?php if ($this->_tpl_vars['data']['0']['dob'] != '0000-00-00'):  echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['dob'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp));  endif; ?></td></tr>
<tr><td width="140" class="headus"></td><td width="140" class="val"></td></tr>
<tr><td width="140" class="headus">Patient Phone #:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['phnum']; ?>
</td><td width="140" class="headus">Service Needed:</td><td width="140" class="val"><?php echo $this->_tpl_vars['vehtype']; ?>
</td><td width="140" class="headus">Trip Type:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['triptype']; ?>
</td></tr>

<tr>

<td width="140" class="headus">Bariatric Stretcher:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['bar_stretcher']; ?>
</td>
<td width="140" class="headus">2 Man Team:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['dstretcher']; ?>
</td><td width="140" class="headus">Wheel Chair Rental:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['dwchair']; ?>
</td>
</tr>
<tr>

<td width="140" class="headus">0xygen:</td><td width="140" class="val"><?php echo $this->_tpl_vars['data']['0']['oxygen']; ?>
</td><td width="140" class="headus">Comments:</td><td width="140" class="val" colspan="5"><?php echo $this->_tpl_vars['data']['0']['re_comments']; ?>
</td>
</tr>
  <tr></tr>
    </table>
    
      <tr>
        <td colspan="8"><table width="100%" border="0" cellspacing="2" cellpadding="2">
           
            <tr>
              <td height="25" colspan="4" class="admintopheading">Trip Information </td>
            </tr>
            <tr>
              <td height="25" align="left" class="labeltxt" width="15%">Pick up Location: </td>
              <td height="25" align="left" class="labeltxt" width="35%"><?php echo $this->_tpl_vars['data'][0]['picklocation']; ?>
</td>
              <td height="25" align="left" class="labeltxt" width="15%">Pickup Address: </td>
              <td height="25" align="left" class="labeltxt" width="35%"><?php echo $this->_tpl_vars['data'][0]['pck_add']; ?>
</td>
            </tr>
			<tr>
              
            </tr>

<tr>
              <td height="25"  align="left" class="labeltxt">Trip Assign Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['tripassign_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
 [ <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['tripassign_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 ]</td>
              <td height="25"  align="left" class="labeltxt">Driver Confirmation Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['driverconfirm_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td>
            </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt">Driver Arrival Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['0']['arrived_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td>
              <td height="25"  align="left" class="labeltxt">Waiting Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php echo $this->_tpl_vars['waitingtime']; ?>
</td>
            </tr>



            <tr>
              <td height="25"  align="left" class="labeltxt">Schedule Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php if ($this->_tpl_vars['data'][0]['pck_time'] == '23:59:59'): ?>Will Call<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['data'][0]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  endif; ?></td>
              <td height="25"  align="left" class="labeltxt">Actual Picked Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php if ($this->_tpl_vars['data'][0]['aptime'] != '00:00:00'):  echo ((is_array($_tmp=$this->_tpl_vars['data'][0]['aptime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  else:  echo '00:00:00';  endif; ?></td>
            </tr>
            <tr>
              
            </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt">Drop Location: </td>
              <td height="25"  align="left" class="labeltxt"><?php echo $this->_tpl_vars['data'][0]['droplocation']; ?>
</td>
              <td height="25"  align="left" class="labeltxt">Drop Address: </td>
              <td height="25"   align="left" class="labeltxt"><?php echo $this->_tpl_vars['data'][0]['drp_add']; ?>
</td>
            </tr>
            <tr>
              
            </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt">Drop Time: </td>
              <td height="25"   align="left" class="labeltxt"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'][0]['drp_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td>
              <td height="25"   align="left" class="labeltxt">Actual Dropped Time: </td>
              <td height="25"  align="left" class="labeltxt"><?php if ($this->_tpl_vars['data'][0]['drp_atime'] != '00:00:00'):  echo ((is_array($_tmp=$this->_tpl_vars['data'][0]['drp_atime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p"));  else:  echo '00:00:00';  endif; ?></td>
            </tr>
            <tr>
              
            </tr>
            <tr>
              <td height="25"   align="left" class="labeltxt">Miles:</td>
              <td height="25"  align="left" class="labeltxt"><?php echo $this->_tpl_vars['data'][0]['trip_miles']; ?>
</td>
              <td height="25"  align="left" class="labeltxt">Driver ID:</td>
              <td height="25"   align="left" class="labeltxt"><?php echo $this->_tpl_vars['data'][0]['drv_id']; ?>
</td>
            </tr>
            <tr>
           
            </tr>
            <tr>
              <td height="25"   align="left" class="labeltxt">Driver Name: </td>
              <td height="25"   align="left" class="labeltxt"><?php echo $this->_tpl_vars['data'][0]['name']; ?>
</td>
              <td height="25"   align="left" class="labeltxt">Driver Rating:</td>
              <td height="25"   align="left" class="labeltxt"><div class="rating"><?php if ($this->_tpl_vars['data'][0]['drv_rating'] > 0): ?>
                  
                  <?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['data'][0]['drv_rating']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r']['show'] = true;
$this->_sections['r']['max'] = $this->_sections['r']['loop'];
$this->_sections['r']['step'] = 1;
$this->_sections['r']['start'] = $this->_sections['r']['step'] > 0 ? 0 : $this->_sections['r']['loop']-1;
if ($this->_sections['r']['show']) {
    $this->_sections['r']['total'] = $this->_sections['r']['loop'];
    if ($this->_sections['r']['total'] == 0)
        $this->_sections['r']['show'] = false;
} else
    $this->_sections['r']['total'] = 0;
if ($this->_sections['r']['show']):

            for ($this->_sections['r']['index'] = $this->_sections['r']['start'], $this->_sections['r']['iteration'] = 1;
                 $this->_sections['r']['iteration'] <= $this->_sections['r']['total'];
                 $this->_sections['r']['index'] += $this->_sections['r']['step'], $this->_sections['r']['iteration']++):
$this->_sections['r']['rownum'] = $this->_sections['r']['iteration'];
$this->_sections['r']['index_prev'] = $this->_sections['r']['index'] - $this->_sections['r']['step'];
$this->_sections['r']['index_next'] = $this->_sections['r']['index'] + $this->_sections['r']['step'];
$this->_sections['r']['first']      = ($this->_sections['r']['iteration'] == 1);
$this->_sections['r']['last']       = ($this->_sections['r']['iteration'] == $this->_sections['r']['total']);
?> <img width="15px;" src="../theme/rate.gif"/> <?php endfor; endif; ?>
                  
                  <?php endif; ?></div></td>
            </tr>
            <tr>
              <td height="25"  align="left" class="labeltxt"> Remarks:</td>
              <td height="25"  align="left" class="labeltxt" colspan="3"><?php echo $this->_tpl_vars['data'][0]['trip_remarks']; ?>
</td>
            
            </tr>
            <tr>
              <td height="25"   align="left" class="labeltxt">Trip Comments:</td>
              <td height="25"  align="left" class="labeltxt" colspan="3"><?php echo $this->_tpl_vars['data']['0']['comments']; ?>
</td>
            </tr>
            <tr>
              <td height="25"   align="left" class="labeltxt">Trip Status:</td>
              <td height="25"   align="left" class="labeltxt" >
                <?php if ($this->_tpl_vars['data'][0]['status'] == '5'): ?>In Progress<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '1'): ?>Completed<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '10'): ?>Driver Arrived<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '3'): ?>Cancelled<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '4'): ?>Completed<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '6'): ?>Picked Up<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '7'): ?>Billable No-Show<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '8'): ?>non-Billable No-Show<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '9'): ?>Pending<?php endif; ?></td>
                <td height="25"   align="left" class="labeltxt">
                <?php if ($this->_tpl_vars['data'][0]['status'] == '3'): ?>Cancelled Time:<?php endif; ?>
                <?php if ($this->_tpl_vars['data'][0]['status'] == '7' || $this->_tpl_vars['data'][0]['status'] == '8'): ?>No Show Time:<?php endif; ?>
                </td>
              <td height="25"   align="left" class="labeltxt" >
                <?php if ($this->_tpl_vars['data'][0]['status'] == '7' || $this->_tpl_vars['data'][0]['status'] == '8' || $this->_tpl_vars['data'][0]['status'] == '3'):  echo $this->_tpl_vars['data']['0']['ac_noshowcancell'];  endif; ?></td>
            </tr>
            <tr>
              <td height="25" colspan="3">&nbsp;</td>
              <td height="25"></td>
            </tr>
          </table></td>
      </tr>
      </td>
      </tr></table>
  </div>
</div>