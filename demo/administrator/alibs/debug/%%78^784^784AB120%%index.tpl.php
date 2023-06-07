<?php /* Smarty version 2.6.12, created on 2019-04-24 16:00:21
         compiled from reportstpl/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'reportstpl/index.tpl', 256, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
function showgraph(val){
  if(val == \'1\'){
     $("#graph1").show("slow"); 
   }
  if(val == \'2\'){
     $("#graph2").show("slow");
   }   
  if(val == \'3\'){
     $("#graph1").hide("slow");   
     $("#graph2").hide("slow");  	 
   }     
}
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

$("#startdate").datepicker( {yearRange:\'-120:00\', dateFormat: \'mm/dd/yy\'} );
$("#enddate").datepicker( {yearRange:\'-120:00\', dateFormat: \'mm/dd/yy\'} );
});
</script>
'; ?>

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <?php if ($this->_tpl_vars['errors'] != '' || $this->_tpl_vars['msgs'] != ''): ?> <tr>
                              <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>
		                    <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>
                            </tr><?php endif; ?>
<tr>
                              <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							<?php if ($this->_tpl_vars['noReq'] != '0'):  endif; ?>
							[<a href="javascript:history.back();">Back</a>]</div>							  </td>
        </tr>							
                            <tr>
<td height="19" colspan="2" align="center" class="admintopheading">REQUEST REPORTS</td>
                           </tr>
                            <tr>
                              <td height="44" colspan="2" align="center"  valign="top">
							 <form name="searchReport" action="index.php" method="get"> 
							  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
          <!-- <tr>
              <td colspan="5" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
            </tr>-->
            <tr>
              <td width="20%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
              <td width="30%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="<?php echo $this->_tpl_vars['startdate']; ?>
" class="inputTxtField date" size="10"/>
                (mm/dd/yyyy)</td>
              <td width="15%" align="left" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
              <td width="35%" align="left" valign="top">&nbsp;<input type="text" name="enddate" id="enddate" value="<?php echo $this->_tpl_vars['enddate']; ?>
" class="inputTxtField date" size="10" />
             (mm/dd/yyyy)</td>
              </tr>

            <tr>
<td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
             <td align="left" valign="top">
                <select name="hospname" class=" txt_boxX" id="hospname"  >
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
" <?php if ($this->_tpl_vars['hosp'][$this->_sections['q']['index']]['id'] == $this->_tpl_vars['hospname']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['hosp'][$this->_sections['q']['index']]['account_name']; ?>
</option>
                      <?php endfor; endif; ?>
                    </select>
              </td>
                    <td width="2%" align="left" valign="top" class="labeltxt"><strong>Patient Name  :</strong></td><td colspan="2"><input type="text" name="pname" id="pname" value="<?php echo $this->_tpl_vars['pname']; ?>
" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div></td>
            </tr>

            <tr>

             <!-- <td align="left" valign="top" class="labeltxt"><strong>Company Code :</strong></td>

              <td colspan="1" align="left" valign="top"><select name="code" class=" txt_boxX" id="code"  >
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
                    </select></td>-->
<td align="left" valign="top"  class="labeltxt"><strong>Filter By Date:</strong>&nbsp;</td>
             

              <td align="left" valign="top"><span class="labeltxt">
                <select  name="by_date" >
                  <option value="today_date" <?php if ($this->_tpl_vars['by_date'] == 'today_date'): ?> selected="selected" <?php endif; ?>>By Request date</option>
                  <option value="appdate" <?php if ($this->_tpl_vars['by_date'] == 'appdate'): ?> selected="selected" <?php endif; ?>>By Appointment Date</option>
                </select>
              </span></td>
             
            </tr>

			

            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="4" align="left" valign="top">

			  <font color="#FF0000">
				 <ol><li>[ Total Requests: <?php echo $this->_tpl_vars['total']; ?>
] [ Approved: <?php echo $this->_tpl_vars['app']; ?>
] [ Pending: <?php echo $this->_tpl_vars['pend']; ?>
] [ Disapproved: <?php echo $this->_tpl_vars['disap']; ?>
]</li>
				 </ol> </font>			  </td>
              </tr>

            

            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="4" align="left" valign="top">

			  <input type="submit" name="submit" value='Report' class="inputButton btn"  />&nbsp;

			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />			  </td>
              </tr>
          </table>	

		                     </form>		  	                  </td>

                            </tr>

                           <!-- <tr>

                              <td colspan="2" align="center"  valign="top" class="admintopheading">GRAPH</td>

                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="middle" height="35">

							   <input type="button" onclick="showgraph(1);" value="General" class="btn">

							   <?php if ($this->_tpl_vars['noReq'] != '0'): ?>

							   <input type="button" onclick="showgraph(2);" value="Search Based" class="btn">

							   <input type="button" onclick="showgraph(3);" value="x" class="btn">							   

							   <?php else: ?>

							   <input type="button" value="Search Based" disabled="disabled" class="btn">							   

							   <?php endif; ?>

							    

							   							  </td>

                            </tr>

                            <tr>

                              <td width="49%" align="right"  valign="top" > 

							 <?php if ($this->_tpl_vars['noReq'] == '0'): ?>

							 <div id="graph1" style="display:none; position:relative; margin-left:73%;"><?php echo $this->_tpl_vars['graph1']->create(); ?>
</div>

							 <?php else: ?>

							  <div id="graph1" style="display:none;"><?php echo $this->_tpl_vars['graph1']->create(); ?>
</div>

							 <?php endif; ?>

							  

							  </td>

                              <td width="51%" align="left"  valign="top" >

							  <?php if ($this->_tpl_vars['noReq'] != '0'): ?>

								 <div id="graph2" style="display:none;"><?php echo $this->_tpl_vars['graph2']->create(); ?>
</div>

							   <?php endif; ?></td>

                            </tr>							-->

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">

						   <?php if ($this->_tpl_vars['noReq'] != '0'): ?>

						   <br />

							  <table width="85%" border="0" class="main_table">

							  <tr class="admintopheading">

								<td width="40%" align="center">

								<strong>Account Name</strong>

								</td>
								<td align="center"><strong>Requests Status </strong></td>
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
								<b><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account_name']; ?>
</b>
								</td>
								<td align="center" valign="middle">

																
<?php if ($this->_tpl_vars['showClient'] == 'no'): ?>
								<a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
&st=active<?php if ($this->_tpl_vars['startdate'] != ''): ?>&startdate=<?php echo $this->_tpl_vars['startdate'];  endif;  if ($this->_tpl_vars['enddate'] != ''): ?>&enddate=<?php echo $this->_tpl_vars['enddate'];  endif;  if ($this->_tpl_vars['pname'] != ''): ?>&pname=<?php echo $this->_tpl_vars['pname'];  endif; ?>&by_date=<?php echo $this->_tpl_vars['by_date'];  if ($this->_tpl_vars['apptype'] != ''): ?>&apptype=<?php echo $this->_tpl_vars['apptype'];  endif; ?>" target="_blank">Pending</a> | <a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
&st=approved<?php if ($this->_tpl_vars['startdate'] != ''): ?>&startdate=<?php echo $this->_tpl_vars['startdate'];  endif;  if ($this->_tpl_vars['enddate'] != ''): ?>&enddate=<?php echo $this->_tpl_vars['enddate'];  endif;  if ($this->_tpl_vars['pname'] != ''): ?>&pname=<?php echo $this->_tpl_vars['pname'];  endif; ?>&by_date=<?php echo $this->_tpl_vars['by_date'];  if ($this->_tpl_vars['apptype'] != ''): ?>&apptype=<?php echo $this->_tpl_vars['apptype'];  endif; ?>"  target="_blank">Approved</a> | <a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
&st=disapproved<?php if ($this->_tpl_vars['startdate'] != ''): ?>&startdate=<?php echo $this->_tpl_vars['startdate'];  endif;  if ($this->_tpl_vars['enddate'] != ''): ?>&enddate=<?php echo $this->_tpl_vars['enddate'];  endif;  if ($this->_tpl_vars['pname'] != ''): ?>&pname=<?php echo $this->_tpl_vars['pname'];  endif; ?>&by_date=<?php echo $this->_tpl_vars['by_date'];  if ($this->_tpl_vars['apptype'] != ''): ?>&apptype=<?php echo $this->_tpl_vars['apptype'];  endif; ?>"  target="_blank">Disapproved</a>

								 <?php else: ?>

<?php if ($this->_tpl_vars['g2activeReqs'] > 0): ?><a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
&cisid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['cisid']; ?>
&st=active<?php if ($this->_tpl_vars['startdate'] != ''): ?>&startdate=<?php echo $this->_tpl_vars['startdate'];  endif;  if ($this->_tpl_vars['enddate'] != ''): ?>&enddate=<?php echo $this->_tpl_vars['enddate'];  endif; ?>&by_date=<?php echo $this->_tpl_vars['by_date'];  if ($this->_tpl_vars['apptype'] != ''): ?>&apptype=<?php echo $this->_tpl_vars['apptype'];  endif; ?>&<?php if ($this->_tpl_vars['pname'] != ''): ?>&pname=<?php echo $this->_tpl_vars['pname'];  endif; ?>"  target="_blank">Active(<?php echo $this->_tpl_vars['g2activeReqs']; ?>
)</a><?php else: ?>Active(<?php echo $this->_tpl_vars['g2activeReqs']; ?>
)<?php endif; ?> 

 | <?php if ($this->_tpl_vars['g2appReqs'] > 0): ?><a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
&cisid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['cisid']; ?>
&st=approved<?php if ($this->_tpl_vars['startdate'] != ''): ?>&startdate=<?php echo $this->_tpl_vars['startdate'];  endif;  if ($this->_tpl_vars['enddate'] != ''): ?>&enddate=<?php echo $this->_tpl_vars['enddate'];  endif; ?>&by_date=<?php echo $this->_tpl_vars['by_date'];  if ($this->_tpl_vars['apptype'] != ''): ?>&apptype=<?php echo $this->_tpl_vars['apptype'];  endif; ?>&<?php if ($this->_tpl_vars['pname'] != ''): ?>&pname=<?php echo $this->_tpl_vars['pname'];  endif; ?>"  target="_blank">Approved(<?php echo $this->_tpl_vars['g2appReqs']; ?>
)</a><?php else: ?>Approved(<?php echo $this->_tpl_vars['g2appReqs']; ?>
)<?php endif; ?>

 | <?php if ($this->_tpl_vars['g2disappReqs'] > 0): ?> | <a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
&cisid=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['cisid']; ?>
&st=disapproved<?php if ($this->_tpl_vars['startdate'] != ''): ?>&startdate=<?php echo $this->_tpl_vars['startdate'];  endif;  if ($this->_tpl_vars['enddate'] != ''): ?>&enddate=<?php echo $this->_tpl_vars['enddate'];  endif; ?>&by_date=<?php echo $this->_tpl_vars['by_date'];  if ($this->_tpl_vars['apptype'] != ''): ?>&apptype=<?php echo $this->_tpl_vars['apptype'];  endif; ?>&<?php if ($this->_tpl_vars['pname'] != ''): ?>&pname=<?php echo $this->_tpl_vars['pname'];  endif; ?>"  target="_blank">Disapproved(<?php echo $this->_tpl_vars['g2disappReqs']; ?>
)</a><?php else: ?>Disapproved(<?php echo $this->_tpl_vars['g2disappReqs']; ?>
)<?php endif; ?>								

								<?php endif; ?>

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

						      <?php endif; ?>				       </td>

                    </tr>

			   <!-- <tr>

			   <td colspan="2" align="center"><?php echo $this->_tpl_vars['pages']; ?>
</td>

			</tr>		-->	

      </table>

    </td>

  </tr>

</table>

<?php echo '

<script>selbox();</script>'; ?>
		 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
