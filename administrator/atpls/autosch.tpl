{include file = mainhead.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#phone").mask("(***) ***-****");
	$("#fax").mask("(***) ***-****");
	$("#add_user").validationEngine();
});
</script>
<style>
.verti_bg{ width:201px; height:165px; float:left; line-height:50px; margin: 10px auto 10px 2%; font-family:Verdana, Geneva, sans-serif; background-image:url(routingpanel/blck_bg.png); background-repeat:no-repeat; text-align:center; padding-top:15px; color: #fff; font-size:30px; font-weight:bold;}</style>
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">AUTO SCHEDULE</td>
                            </tr>
                            <tr>
<td height="19" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
						  <form name="add_user" id="add_user" method="post" action="" enctype="multipart/form-data">
	  <table width="90%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#FF0000" style="font-weight:bold">{$msgs}</font>{/if}</td>
        </tr>       
        <tr>
          <td colspan="3" align="center" valign="top">
          <table width="45%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="images/1.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="images/2.jpg">&nbsp;</td>
        <td width="17" align="left" valign="top"><img src="images/3.jpg" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="images/4.jpg">&nbsp;</td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
<tr>
<td width="50%" style="text-align:center;"><a href="setup.php" ><img src="routingpanel/settings.png" alt="" /><strong>SETUP</strong></a></td>
<td width="50%"  style="text-align:center;"><a href="routingpanel/scheduletrips_cal.php" ><img src="images/calander.png" alt="" /><strong>AUTO SCHEDULE</strong></a></td>
</tr>
<!--<a href="javascript:alert('Pending Approval for Google Live Traffic API');">-->

</table>		</td>
        <td align="left" valign="top" background="images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="images/6.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table>    	</td>
        </tr>
       
      </table>
	      </form>							  </td>
            </tr>
			<tr>
			   <td>&nbsp;</td>
			</tr>			
      </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}