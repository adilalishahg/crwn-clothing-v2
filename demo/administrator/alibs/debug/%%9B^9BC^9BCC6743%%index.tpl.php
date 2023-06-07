<?php /* Smarty version 2.6.12, created on 2019-04-24 15:33:32
         compiled from reqtpls/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'reqtpls/index.tpl', 209, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "headerinner.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{ location.href="index.php?delId="+id;

		return true;}else{			

			return false;}

	}

	

function stchange(val)

{

  if (val != \'\'){		

 	location.href="index.php?st="+val;

	return true;}else{

			return false;

		}			

	}	



function ChangeStatus(val,st){

var ans= 1;

if(st == \'3\'){

     jPrompt(\'Specify the reason for disapproving:\', \'\', \'MMT GLOBAL Transport\', function(r) {

	  if(typeof(r) == "undefined"){

	    Ask();

	  }else{

	  ans = r;  	 

      AjaxSend(val,st,ans);

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

    jPrompt(\'Specify the reason for disapproving:\', \'\', \'MMT GLOBAL Transport\', function(r) {

	  if(typeof(r) == "undefined"){

	  jAlert(\'You must Specify a reason for disapproving\'); 

	   Ask();

	   return false;

	  }else{

	  return r; }

	});

}	



function AjaxSend(val,st,ans){

    $.post("hosprequests.php", {queryString: ""+val, sta:""+st, rea: ""+ans}, function(data){

	  if(data.length > 0) {   

        if(data == \'Success\' && st == \'3\'){	removeTr(val);	

		return true;	

		}

		else if(data == \'Success\' && st == \'2\'){ removeTr(val);		

		return true;		

		} 

        else{

		return false;	

		} 		

      }

	 });

}



</script>

'; ?>


<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="44" align="center" valign="top">  							  </td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="okmsg"><span class="okmsg"><?php if ($this->_tpl_vars['msgs'] != ''): ?> <?php echo $this->_tpl_vars['msgs']; ?>
 <?php endif; ?>

		                    <?php if ($this->_tpl_vars['errors'] != ''): ?> <?php echo $this->_tpl_vars['errors']; ?>
 <?php endif; ?></span></td>

                            </tr>

<tr>

                              <td height="19" align="center">

							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">

							[<a href="javascript:history.back();">Back</a>]</div>							  </td>

        </tr>							

                            <tr>

<td width="71%" height="19" align="center" class="admintopheading">REQUESTS MANAGEMENT</td>

                            </tr>

                            

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">

							  <table width="100%" border="0" class="main_table">

                  <tr class="admintopheading">

                    <td width="20%" align="center"><strong>Account Name</strong></td>

                    <td width="15%" align="center"><strong>Account Address</strong></td>

                    <td width="15%" align="center"><strong>Total Requests </strong></td>

                    <td width="15%" align="center"><strong>Options</strong></td>

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

                    <td align="left" valign="middle"><b><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account_name']; ?>
</b></td>

                    <td align="center" valign="middle"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['address']; ?>
, <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['city']; ?>
, <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['state']; ?>
 <?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['zip']; ?>
</td>

                    <td align="center" valign="middle"><?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['cnt']; ?>
</td>

                    <td align="center" valign="middle">

				    <a href="reqdetails.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
" title="Approve Single Trip"><img alt="Approve Single Trip" border="0" src="../images/normal.png" title="Approve Single Trip"></a><br/><a href="reqdetails_with_auto_approve.php?req=<?php echo $this->_tpl_vars['reqdetails'][$this->_sections['q']['index']]['account']; ?>
" title="Approve Multiple Trips"><img alt="Approve Single Trip" border="0" src="../images/multiple.png" title="Approve Multiple Trips"></a>				</td>

 				 </tr>

				 <?php else: ?>

				 <tr>

				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>

				 </tr> 				 

				 <?php endif; ?>

				<?php endfor; else: ?>

				 <tr>

				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>

				 </tr> 

				 <?php endif; ?> 

                </table>				</td>

            </tr>
<!--
			<tr>

			   <td align="center"><?php echo $this->_tpl_vars['paging']; ?>
</td>

			</tr>	-->		

      </table>

    </td>

  </tr>

</table>		 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "innerfooter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
