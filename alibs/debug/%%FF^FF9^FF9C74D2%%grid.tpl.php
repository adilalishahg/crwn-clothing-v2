<?php /* Smarty version 2.6.12, created on 2022-07-20 15:22:00
         compiled from grid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'grid.tpl', 120, false),array('modifier', 'date_format', 'grid.tpl', 137, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headernew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link href="administrator/theme/styles.css" rel="stylesheet">	
<meta http-equiv="refresh" content="60">
<?php echo ' 
<script type="text/javascript">
 $(document).ready(function() { 
});

function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 1000, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 650, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function popWind3(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 500, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function fsubmit(url,id){
location.href=url+"&driver="+id; }
function fsubmit2(url,id){
location.href=url+"&user="+id;   }
function fsubmit3(url,id){location.href=url+"&account="+id; }
function rload(url){location.href=url; }
function deleteRec(id,st)
		{ //alert(st);
		var ok;
		ok=confirm("Are you sure you want to cancel this trip?");
		if (ok)
		{		
			location.href="grid.php?delId="+id+"&st="+st;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
function refreshpagejana(){ location.reload();  }
setInterval ( "refreshpagejana()", 10000);	
</script> 
'; ?>

<div style="min-height:400px;" class="submain">

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF" >


  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
                  
                  
                  
                  <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
              </tr>
             <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="rload('grid.php');"><i class="fa fa-refresh" style="color:#0059b7; font-size:24px;"></i></a>-->
             <tr>
                <td height="19" align="center" class="admintopheading"><strong>TODAY TRIPS</strong></td>
              </tr>
              <tr>
                <td class="tabs" style="color:#FFF"><ul>
                    <!--<li <?php if ($this->_tpl_vars['st'] == '5'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=5">In Progress (<?php echo $this->_tpl_vars['st5']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '4'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=4">Completed (<?php echo $this->_tpl_vars['st4']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '3'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=3">Cancelled (<?php echo $this->_tpl_vars['st3']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '2'): ?> class="active"<?php endif; ?>><a  href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=2">Rescheduled (<?php echo $this->_tpl_vars['st2']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '8'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=8&ad=0">Not Going (<?php echo $this->_tpl_vars['st8']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '7'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=7&ad=0">Not at Home (<?php echo $this->_tpl_vars['st7']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '0' || $this->_tpl_vars['acknowledge_status'] == '0'): ?> class="last" <?php else: ?> class="last"<?php endif; ?>>
                    <a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=9&acknowledge_status=0">Pending Trips (<?php echo $this->_tpl_vars['st9']; ?>
)</a>
                    </li>-->
                    
                    <li <?php if ($this->_tpl_vars['st'] == '9'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=9&acknowledge_status=0">Pending (<?php echo $this->_tpl_vars['st9']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '5'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=5"> Scheduled (<?php echo $this->_tpl_vars['st5']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '10'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=10">Arrived (<?php echo $this->_tpl_vars['st10']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '6'): ?> class="active"<?php endif; ?>><a  href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=6">Picked Up (<?php echo $this->_tpl_vars['st6']; ?>
)</a></li>
                    <li <?php if ($this->_tpl_vars['st'] == '4'): ?> class="active"<?php endif; ?>><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=4&ad=0">Delivered (<?php echo $this->_tpl_vars['st4']; ?>
)</a></li>
                    <li class="last"><a href="grid.php?id=<?php echo $this->_tpl_vars['id']; ?>
&st=3&ad=0">Cancelled (<?php echo $this->_tpl_vars['st3']; ?>
)</a></li>
                    
                    
                    
                    <!--<li <?php if ($this->_tpl_vars['st'] == '9'): ?>style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"<?php endif; ?>><a rel="facebox" href="add-sheet.php">Upload Sheet</a></li>
 <li class="small"><a  title="Add" href="#" onclick="popWind2('addgrid.php?id=<?php echo $this->_tpl_vars['id']; ?>
');" > <img alt="Add" border="0" src="../graphics/add_12.gif"></a></li>--> 
                    <!--<li><input type="button" value="GET" onclick="getalerts()" /></li>-->
                  </ul></td>
              </tr>
              
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
                <table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0">
                    <tr style="background-color:#a40026; color:#FFF;">
                     <!--  <td align="left" class="label_txt_heading"><strong>Code</strong></td>
                     <td align="left" class="label_txt_heading"><strong>Facility</strong></td>-->
                      <td align="left" class="label_txt_heading"><strong>Account</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Patient Name </strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Miles</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                      <td align="center" class="label_txt_heading"><strong>Status</strong></td>
                     <!-- <td align="left" class="label_txt_heading"><strong><?php if ($this->_tpl_vars['st'] == '9'):  else: ?>Location<?php endif; ?></strong></td>
                      <td align="left" class="label_txt_heading"><strong>Call</strong></td>-->
                    </tr>
                    <div id="sc"></div>
                    <?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['membdetail']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <tr  valign="top" id="<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
"  bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
"><!---->
                     <!-- <td ><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_id']; ?>
</td>
                      <td align="left" valign="top" class="grid_content"><b><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_clinic']; ?>
</b></td>-->
                      <td align="left" valign="top" class="grid_content">
                      <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['account']; ?>

                      </td>
                      <td align="left" valign="top" class="grid_content"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_user']; ?>
</td>
                      
        <td align="left" valign="top" class="grid_content"><?php unset($this->_sections['r']);
$this->_sections['r']['name'] = 'r';
$this->_sections['r']['loop'] = is_array($_loop=$this->_tpl_vars['driverdata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>
            <?php if ($this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['drv_code'] == $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']):  echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['fname']; ?>
 <?php echo $this->_tpl_vars['driverdata'][$this->_sections['r']['index']]['lname'];  endif; ?>
<?php endfor; endif; ?> </td>
            
                   <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['picklocation'] != ''): ?>[<strong>Pick Location:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['picklocation']; ?>
]<br/><?php endif; ?>
                   <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add'];  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pickup_instruction'] != ''): ?><br/>[<strong>Instruction:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pickup_instruction']; ?>
]<?php endif;  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['p_phnum'] != ''): ?><br/>[<strong>Phone #:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['p_phnum']; ?>
]<?php endif; ?>
                        </td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['droplocation'] != ''): ?>[<strong>Drop Location:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['droplocation']; ?>
]<br/><?php endif; ?>
                      <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add'];  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['destination_instruction'] != ''): ?><br/>[<strong>Instruction:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['destination_instruction']; ?>
]<?php endif;  if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['d_phnum'] != ''): ?><br/>[<strong>Phone #:</strong> <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['d_phnum']; ?>
]<?php endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wc'] == '1'): ?> W/C<?php else: ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['wc'] == '1'): ?> --:--<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M"));  endif; ?></td>
                      <td align="left" valign="top" class="grid_content"><?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['trip_miles']; ?>
</td>
                      <td align="left" valign="top" class="grid_content">
                      
                      <?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['vehtype']; ?>
<span style="font-size:9px; color:#F00;">
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['dstretcher'] == 'Yes'): ?><br/>&raquo; 2Man-Team <?php endif; ?>
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['bar_stretcher'] == 'Yes'): ?><br/>&raquo; Bariatric-Str. <?php endif; ?>
                     </span>
                      
                      </td>
                      <td align="left" valign="top" class="grid_icon">
                        
                      
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?>In Progress<?php endif; ?>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '2'): ?>Rescheduled<?php endif; ?>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '3'): ?>Cancelled<?php endif; ?>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6'): ?>Picked Up<?php endif; ?>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '8'): ?>Not Going<?php endif; ?>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '7'): ?>Not at home<?php endif; ?>
						  <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '9'): ?>Pending<?php endif; ?>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10'): ?>Driver Arrived<?php endif; ?>
                           <br/>
                          <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '9' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10'): ?>
<a href="#"  onclick="return deleteRec('<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
','<?php echo $this->_tpl_vars['st']; ?>
');"  title="Cancel" style="color:red;font-weight:bold;font-size:16px;"> X</a>
<?php endif; ?><a  href="javascript:popWind2('details.php?id=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['tdid']; ?>
');" title="View">&nbsp;&nbsp;<i class="fa fa-file-alt" style="color:#0059b7;  font-size:24px;"></i></a> <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?>
                      <a title="[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
]" href="driver.php?dri_code=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
&a=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
&b=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
" target="_blank"><img alt="Track" border="0" src="administrator/graphics/gps.png"></a> <?php endif; ?>

                        </td>
                      <!--<td >
                      <?php if ($this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '10' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '6' || $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['status'] == '5'): ?>
                      <a title="[<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
]" href="driver.php?dri_code=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drv_id']; ?>
&a=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['pck_add']; ?>
&b=<?php echo $this->_tpl_vars['membdetail'][$this->_sections['q']['index']]['drp_add']; ?>
" target="_blank"><img alt="Track" border="0" src="administrator/graphics/gps.png"></a> <?php endif; ?>
                      </td>-->
                        
                    </tr>
                    <?php endfor; else: ?>
                    <tr>
                      <td colspan="12" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                    </tr>
                    <?php endif; ?>
                  </table></td>
              </tr>
              <tr>
                <td><?php echo $this->_tpl_vars['paging']; ?>
</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footerlast.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 