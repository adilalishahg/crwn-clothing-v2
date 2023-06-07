{ include file = headerinner.tpl}

{literal}
<script type="text/javascript" src="../js/jscolor/jscolor.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$("#settings").validate()
});

$(document).ready(function(){

	$('#end_date').datepicker();
	
  });
</script>
{/literal}

<table width="1010" height="350" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="outer_table" >
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                              <td height="44" colspan="9" align="center" valign="top">  							  </td>
                            </tr>
                            
                            <tr>
                              <td height="19" colspan="9" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>

                            <tr height="50">
                              <td align="center" >&nbsp;</td>
                              <td align="center" >&nbsp;</td>
                              <td colspan="6" align="center" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="16%" align="center" class="admintopheading"></td>
                            
                              <td width="30%" align="center" class="admintopheading">

</td>
                              <td align="left" class="admintopheading">SETTINGS</td>
                            </tr>
                            
                            <tr>
                              <td height="44" colspan="9" align="center"  valign="top" style="padding-bottom:50px;"></tr>
<tr><td colspan="3" align="center" class="labeltxt">{$umsg}</td></tr>
<form action="options.php" method="post" id="settings" name="settings">
<tr>
<td colspan="3" align="center">
<table cellspacing="1" cellpadding="4" align="center" border="0">

<tr><td width="130" class="labeltxt">Bgcolor1: </td><td><input type="text" name="bg1" value="{$bg1}" size="20" class="color" /></td></tr>
<tr><td class="labeltxt">Bgcolor2: </td><td><input type="text" name="bg2" value="{$bg2}" size="20" class="color" /></td></tr>
<tr><td class="labeltxt">Text color: </td><td><input type="text" class="color" value="{$txt}" name="text" size="20"/></td></tr>


<br /><br />







<td align="center" colspan="2"><input type="submit" name="options" value="Submit" /></td>
</form>



</table>
</td></tr></table>		 
{ include file = innerfooter.tpl}
