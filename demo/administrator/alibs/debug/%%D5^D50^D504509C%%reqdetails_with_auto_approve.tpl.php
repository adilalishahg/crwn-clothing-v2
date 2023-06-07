<?php /* Smarty version 2.6.12, created on 2019-04-24 15:34:50
         compiled from reqtpls/reqdetails_with_auto_approve.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'reqtpls/reqdetails_with_auto_approve.tpl', 167, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo ' 
<style>
/* Button css3*/

.submit {
	height:36px;
	padding:0 15px;
	color:#fff;
/*    float:left;*/
	font-size:14px;
	font-weight:bold;
	font-family: \'droid_sans,regular\';
	line-height:22px;
	text-align:center;
	font-family:Verdana, Geneva, sans-serif;
	margin:2px 0 4px 0;
	cursor:pointer;
	border:1px solid #fff;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	background: #D62815; /* Old browsers */
	/* IE9 SVG, needs conditional override of \'filter\' to \'none\' */
	background: -moz-linear-gradient(top, #D62815 0%, #D61415 5%, #D60115 55%, #D60000 76%, #D61815 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #D62815), color-stop(5%, #D62815), color-stop(55%, #D62815), color-stop(76%, #D62815), color-stop(100%, #D62815)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #D62815 0%, #D61415 5%, #D60115 55%, #D60000 76%, #D61815 100%);
	 /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #D62815 0%, #D61415 5%, #D60115 55%, #D60000 76%, #D61815 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top, #D62815 0%, #D61415 5%, #D60115 55%, #D60000 76%, #D61815 100%); /* IE10+ */
	background: linear-gradient(top, #D62815 0%, #D61415 5%, #D60115 55%, #D60000 76%, #D61815 100%); /* W3C */
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#D62615\', endColorstr=\'#D62015\', GradientType=0 ); /* IE6-8 */
}
.submit:hover {
	background:#D62815;
}
</style>

<script type="text/javascript">
function deleteRec(id)
		{ var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{ $.post("delete.php", {id: id}, function(data)
			{ });
			$(\'#tr\'+id).hide();
			//location.reload();
			 //location.href="reqdetails.php?delId="+id;
		return true;}else{			
			return false;}}
function stchange(val,req)
		{
  if (val != \'\'){		
 	location.href="reqdetails.php?st="+val+"&req="+req;
	return true;}else{
			return false;
		}			
	}
function autoapprove(req,tp)
		{ if (req != \'\'){		//alert(req);
 	location.href="reqdetails_with_auto_approve.php?reqid="+req+"&tp="+tp;
	return true;}else{
			return false;
		}
	}		
function ChangeStatus(val,st){
	 var ok;
		ok=confirm("Are you sure you want to Disapproved this Trip");
		if (ok)
		{
 $.post("hosprequests.php", {id: ""+val, ustatus:""+\'disapproved\'}, function(data){
  if(data.length > 0) {   
        	
          if(data == \'Success\'){
           removeTr(val); return false;
          }else{
            removeTr(val); return false;
          }	
		}
		return false;	
      });}
	  }
  
function removeTr(val){
  $(\'#tr\'+val).remove();}
function Ask(){
    jPrompt(\'Specify the reason for disapproving:\', \'\', \' Medical Transportation\', function(r) {
	  if(typeof(r) == "undefined"){
	  jAlert(\'You must Specify a reason for disapproving\'); 	  
	    Ask();
	  }else{
	  return r; }
	});}
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
	 });}

</script> 
'; ?>

<div style="width:612px;  float:left;"></div>
  <table class="outer_table" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
              
              <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
          </tr>
          <tr>
            <td height="19" colspan="2" align="center"><div align="left" style="float:left; color:#F00; font-weight:bold;" >Note: If you are approving past date trips, please update driver and times of particular trip in dispatch report section.</div><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>
          </tr>
          <tr>
            <td height="19" align="left" class="admintopheading">Requests:
              <select name="st" id="st" onchange="return stchange(this.value,<?php echo $this->_tpl_vars['req']; ?>
);">
                <option value="">--Select--</option>
                <option value="active" <?php if ($this->_tpl_vars['st'] == 'active'): ?>selected<?php endif; ?>>Pending</option>
                <option value="approved" <?php if ($this->_tpl_vars['st'] == 'approved'): ?>selected<?php endif; ?>>Locked</option>
                <option value="disapproved" <?php if ($this->_tpl_vars['st'] == 'disapproved'): ?>selected<?php endif; ?>>Disapproved</option>
              </select>&nbsp;&nbsp;&nbsp;<input type="button" id="autoapprove" value="Approve all Pending Request" class="submit" onclick="autoapprove('<?php echo $this->_tpl_vars['req']; ?>
','1');" />&nbsp;&nbsp;&nbsp;<input type="button" id="autoapprove2" value="Disapprove all Pending Request" class="submit" onclick="autoapprove('<?php echo $this->_tpl_vars['req']; ?>
','2');" /></td>
            <td class="admintopheading">REQUESTS DETAIL </td>
          </tr>
          <tr>
            <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
            <div style="width:700px; border: #F00 0px solid; float:left;"> </div>
                <table width="100%" border="0" class="main_table">
                  <tr class="admintopheading" height="55">
                    <td align="center"><strong>Patient Name</strong></td>
                    <td align="center"><strong>Appointment date/time </strong></td>
                    <td align="center"><strong>Pick Address</strong></td>
                    <td align="center"><strong>Destination</strong></td>
                    <td align="center"><strong>Patient Phone</strong></td>
                    <td align="center"><strong>Options</strong></td>
                    <?php if ($this->_tpl_vars['reqdetails'][0]['reqstatus'] == 'approved'): ?>
                    <td align="center"><strong>HIC Form</strong></td>
                    <?php endif; ?>
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
                    <td align="left"><b><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['clientname']; ?>
</b></td>
                    <td align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['appdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 / <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['apptime']; ?>
</td>
                    <td align="center"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['pickaddr']; ?>
</td>
                    <td align="center"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['destination']; ?>
</td>
                    <td align="center"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['phnum']; ?>
</td>
                    <td align="center"><a href="javascript:popWind('../../reqpreview.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
&reqid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqid']; ?>
');">Details</a>&nbsp;
                      
                      <?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqstatus'] == 'active'): ?> 
                      
                      <!--<a href="javascript:ChangeStatus('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','2');">
					<img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg">
                    </a>--> 
                      <a rel="facebox" href="approve_request.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
&rqid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqid']; ?>
&appdate=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['appdate']; ?>
"> <img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg"> </a> <a href="javascript:ChangeStatus('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','3');"> <img border="0" title="Disapprove" alt="Disapprove" src="../graphics/disable.jpg"> </a> <?php elseif ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqstatus'] == 'disapproved'): ?> <a href="javascript:ChangeStatus('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
','2');"> <img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg"> </a> <?php else: ?> <img border="0" title="Locked" alt="Locked" src="../graphics/lock.jpg"> <?php endif; ?> <a href="#" onclick="deleteRec('<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
')" ><img border="0" title="Delete" alt="Delete" src="../images/icons/cross.png"></a></td>
                    <?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqstatus'] == 'approved'): ?>
                    <td> <?php if ($this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['hic'] == '1'): ?> <a href="javascript:popWind('../reports/genreport.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
&reqid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['reqid']; ?>
');">Yes</a><?php else: ?>No<?php endif; ?></td>
                    <?php endif; ?>
                    <td><a href="../routingpanel/edit2.php?id=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['id']; ?>
" target="_blank">Edit</a></td>
                  </tr>
                  <?php endfor; else: ?>
                  <tr>
                    <td colspan="6" align="center" class="labeltxt"><b>No Record Found</b></td>
                  </tr>
                  <?php endif; ?>
                </table>
             </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><?php echo $this->_tpl_vars['paging']; ?>
</td>
          </tr>
        </table></td>
    </tr>
  </table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 