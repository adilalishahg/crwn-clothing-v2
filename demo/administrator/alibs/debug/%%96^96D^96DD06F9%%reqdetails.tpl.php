<?php /* Smarty version 2.6.12, created on 2019-04-24 16:01:04
         compiled from reportstpl/reqdetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reportstpl/reqdetails.tpl', 145, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">

function deleteRec(id)
		{ var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{ $.post("../requests/delete.php", {id: id}, function(data)
			{ });
			$(\'#tr\'+id).hide();
			//location.reload();
			 //location.href="reqdetails.php?delId="+id;
		return true;}else{			
			return false;}
}

function disapprove(id,reqid)
		{
		//alert(reqid);
		var ok;
		ok=confirm("Are you sure you want to Disapprove this request. \\n Refresh this page to affect changes!");
		if (ok)
		{ 
		$.post("disapprove.php", {tripid: ""+id, req_id: ""+reqid }, function(data){  }); 
		//location.href="reqdetails.php?delId="+id; 
		
		return true;}else{			
			return false;}
	}
function stchange(st,qrstr)
{
  if (qrstr != \'\'){		
 	location.href="reqdetails.php?st="+st+qrstr;
	return true;}else{
			return false;
		}			
	}	
function ChangeStatus(val,st){
var ans= 1;
if(st == \'3\'){
     jPrompt(\'Specify the reason for disapproving:\', \'\', \'Medical Transportation\', function(r) {
	  if(typeof(r) == "undefined"){
	    Ask();
	  }else{
	  if(r == \'\' || r == null){ jAlert(\'You must Specify a reason for disapproving\'); return false; }	  	  else{
	    ans = r;  	
        AjaxSend(val,st,ans); }
	  }
	});
}
if(st == \'2\'){
   AjaxSend(val,st,ans);
  }
}	
function removeTr(val){
  $(\'#tr\'+val).remove();
}
function Ask(){
    jPrompt(\'Specify the reason for disapproving:\', \'\', \'Medical Transportation\', function(r) {
	  if(typeof(r) == "undefined"){
	  jAlert(\'You must Specify a reason for disapproving\'); 	  
	    Ask();
	  }else{
	  return r; }
	});
}	
function AjaxSend(val,st,ans){
   $.post("hosprequests.php", {queryString: ""+val, sta:""+st, rea: ""+ans}, function(data){
  if(data.length > 0) {   
        if(st == \'3\'){	
          if(data == \'Success\'){
            //var url = window.location;
            //location.href= url;
            removeTr(val); return false;
          }else{
            //var url = window.location;
            //location.href= url;
            removeTr(val); return false;
          }	
		}
		else if(st == \'2\'){ 
          if(data == \'Success\'){
           //var url = window.location;
           //location.href= url;
            removeTr(val); return false;
          }else{
           //var url = window.location;
           //location.href= url;
            removeTr(val); return false;
          }		
		} 
        else{
		return false;	
		} 		
      }
	 });
}
</script>
'; ?>

<table  border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" class="outer_table">
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
							[<a href="index.php">Back</a>]</div>							  </td>
        </tr>							
                           <tr>
<td height="19" align="left" class="admintopheading">Requests:
  <!--<select name="st" id="st" onchange="return stchange(this.value,<?php echo $this->_tpl_vars['req']; ?>
);">-->
  <select name="st" id="st" onchange="return stchange(this.value,'<?php echo $this->_tpl_vars['qrstr']; ?>
');">
  <option value="">--Select--</option>
  <option value="active" <?php if ($this->_tpl_vars['st'] == 'active'): ?>selected<?php endif; ?>>Pending</option>
  <option value="approved" <?php if ($this->_tpl_vars['st'] == 'approved'): ?>selected<?php endif; ?>>Locked</option>
  <option value="disapproved" <?php if ($this->_tpl_vars['st'] == 'disapproved'): ?>selected<?php endif; ?>>Disapproved</option>
</select></td>
                           <td align="center" class="admintopheading">REQUESTS DETAIL </td>
                            </tr>
                            <tr>
                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								
							  <table width="100%" border="0" class="main_table">
                  <tr class="admintopheading" height="55">
                    <td align="center"><strong>Patient Name.</strong></td>
                    <td align="center"><strong>Appointment date/time </strong></td>
                    <td align="center"><strong>Pick Address</strong></td>
                    <td align="center"><strong>Destination</strong></td>
                    <td align="center"><strong>Patient Phone</strong></td>
                    <td align="center"><strong>Options</strong></td>
				<!--	<?php if ($this->_tpl_vars['reqdetails'][0]['reqstatus'] == 'approved'): ?>
					   <td align="center"><strong>Invoice & Trans.</strong></td>
					<?php endif; ?>-->
					<td align="center"><strong>Edit</strong></td>
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
				  <tr valign="top" id="tr<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
">
                    <td align="left">
					<b><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['clientname']; ?>
</b>					</td>
                    <td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 / <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['apptime']; ?>
</td>
                    <td align="center"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['pickaddr']; ?>
</td>
                    <td align="center"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['destination']; ?>
</td>
                    <td align="center"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['phnum']; ?>
</td>
                    <td align="center">
<a href="javascript:popWind('reqpreview.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
&reqid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqid']; ?>
&st=<?php echo $this->_tpl_vars['st']; ?>
');">Details</a>&nbsp;
 <a href="javascript:popWind2('medical_invoice.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
&reqid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['req_id']; ?>
')" ><span style="color:#F00;">Invoice</span></a><br/><?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['transportation_log'] != ''): ?><a href="view_log.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
&reqid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqid']; ?>
" rel="facebox" ><span style="color:#F00; font-size:9px;">Trans.<br/> Log</span> </a><?php endif; ?>
				<a href="#" onclick="deleteRec('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
')" ><img border="0" title="Delete" alt="Delete" src="../images/icons/cross.png"></a>
                <?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqstatus'] == 'active'): ?>
					<a href="javascript:ChangeStatus('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','2');">
					<img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg">					</a>
                    <a href="javascript:ChangeStatus('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','3');">
					<img border="0" title="Disapprove" alt="Disapprove" src="../graphics/disable.jpg">					</a>									
				   <?php elseif ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqstatus'] == 'disapproved'): ?>	
					<a href="javascript:ChangeStatus('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','2');">
					<img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg">					</a>									
			     <?php endif; ?>			</td>
                  <td><a href="../routingpanel/edit2.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
" target="_blank">Edit</a><!--<br/><?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqstatus'] == 'approved'): ?><a href="#" onclick="disapprove('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqid']; ?>
')" >DisApp</a><?php endif; ?>--></td>
 				 </tr>
				<?php endfor; else: ?>
				 <tr>
				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>
				 </tr> 
				 <?php endif; ?> 
                </table>				
               			
                </td>
            </tr>
			<tr>
			   <td colspan="2" align="center"><?php echo $this->_tpl_vars['paging']; ?>
</td>
			</tr>			
      </table>
    </td>
  </tr>
</table>		 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>