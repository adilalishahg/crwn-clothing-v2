{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("#add_poll_2").validationEngine()
	$("#add_poll_1").validationEngine()
	$('#end_date').datepicker({minDate: 0, maxDate: '+12M +1D'});
	
  });
</script>
{/literal}
<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="outer_table" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
              
                            <tr>
                              <td height="19" colspan="8" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
							 <tr>
                              <td height="25" colspan="8" align="right" valign="bottom" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]
        					</td>
                            </tr>

                            <tr>
                              <td align="center" >&nbsp;</td>
                              <td colspan="7" align="center" >&nbsp;</td>
                            </tr>
                            <tr>                           
                              <td colspan="8" align="left" valign="top" class="admintopheading" style="padding:3px; vertical-align:top;">FIND DIRECTION{if $step1 eq 1}<span style="padding-left:550px; margin-bottom:10px;"><a href="new.php?from={$from}&to={$to}"><strong>Save</strong></a></span>{/if}</td>
                            </tr>
                            <tr><td colspan="8" align="center">{$msg}</td></tr>
                            <tr>
                              <td height="44" colspan="8" align="center"  valign="top" style="padding-bottom:50px;">
{if $step1 eq 1}
{literal}
<style type="text/css">
    #printable { display: block; }
@media print
{
    #non-printable { display: none; }
    #printable { display: block; }
}
</style>
<script language="javascript">
$(document).ready(function($) {		
	$('#map').jmap('init', {mapCenter:[55.958858,-3.162302]}, function(el, options){
   	$(el).jmap("searchDirections", {fromAddress: $('#from').val(), toAddress: $('#to').val(), directionsPanel:"directions"});	
  	});
});
</script>
{/literal}	
	<div class="event_detail" id="printable">
    <div align="right" id="map" style="width:350px; height:350px; float:right; margin-top:10px;"></div>
	<div id="directions" style="width:340px; float:left; margin-bottom:10px; border:#579722 1px solid; margin-top:10px;" class="direct"></div>
	<input type="hidden" id="from" name="from" value="{$from}" />
	<input type="hidden" id="to" name="to" value="{$to}" />
	<br />
    </div>
{elseif $step2 eq 1}
<form action="new.php" method="post" id="add_poll_1" name="add_poll_1">
	<table align="center" cellspacing="1" cellpadding="4" border="0" style="padding-top:10px;">
    <tr><td width="130" class="labeltxt" align="left">
    <strong>Route Title:<span style="color:#FF0000">*</span></strong> 
	</td><td width="300" colspan="4" align="left">
	<input type="text" name="title" id="title" size="40" value="{$title}" class="validate[required,custom[onlyLetter],length[0,50]]" maxlength="50" />
	</td></tr>
	<tr><td width="130" class="labeltxt" align="left">
    <strong>Route Description:<span style="color:#FF0000">*</span></strong> 
	</td><td width="300" colspan="4" align="left">
	<textarea name="description" id="description" class="validate[required,length[6,200]]" cols="40" rows="5">{$description}</textarea>	
	</td></tr>
    <input type="hidden" name="from" id="from" value="{$from}" />
	<input type="hidden" name="to" id="to" value="{$to}" />
	<td>
	
	</td>
	<td>
	
	</td></tr>

<tr><td align="center" colspan="5"><input type="submit" name="step2" value="Submit" class="btn" /></td></tr>
</table>
</form>
{else}
<form action="new.php" method="post" id="add_poll_2" name="add_poll_2">
	<table cellspacing="1" cellpadding="4" align="center" border="0" style="padding-top:10px;">
    <tr>
	<td width="100" class="labeltxt" align="right">
	<strong>From:<span style="color:#FF0000">*</span></strong>
	</td>
	<td width="280" colspan="4" align="left">
	<input type="text" name="from" id="from" size="40" maxlength="100" class="validate[required,length[0,100]]" />
	</td>
	</tr>
	<tr>
	<td width="100" class="labeltxt" align="right">
	<strong>To:<span style="color:#FF0000">*</span></strong>
	</td>
	<td width="280" colspan="4" align="left">
	<input type="text" name="to" id="to" size="40" maxlength="100" class="validate[required,length[0,100]]" />
	</td>
	</tr>
	<tr>
	<td align="center" colspan="5"><input type="submit" name="step1" value="Show Direction" class="btn" />&nbsp;&nbsp;<input type="reset" name="reset" value=" Reset " class="btn" />
	</td></tr>
	</table>
	</form>

<tr><td align="center" colspan="2"></td></tr></table>
{/if}
</td>
            </tr>
			<tr>
			   <td colspan="8"><center>{$paging}</center></td>
			</tr>			
     </table>
    </td>
  </tr>
  </table>
{include file = innerfooter.tpl}