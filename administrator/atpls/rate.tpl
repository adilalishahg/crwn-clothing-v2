{ include file = mainhead.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#rate").validationEngine()
});
</script>
{/literal}
<form name="rate" id="rate" action="rate.php" method="post">
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; ">
	<tr>
	
		<tr>
 			<td height="19" colspan="3" align="right" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]</td>
	</tr>
	
	
	
		<td colspan="20">
			<table width="100%"  align="center" height="53" cellpadding="2" cellspacing="2">
 			{ if $msgs != '' or $errors!= ''} 
            <tr>
			   <td height="19" class="okmsg" colspan="2" align="center" style="color:#FF0000; font-weight:bold;">
			{ if $msgs != ''} {$msgs} {/if}
		    { if $errors != ''} {$errors} {/if}			   </td>
			 </tr>
             {/if}
			 <tr>
			   <td height="19" class="admintopheading" colspan="2" align="center"> UPDATE RATES</td>			
			 </tr> 
			 <tr>
			   <td width="47%" align="right" class="add_titles"><span class="gutt_textheading"><strong>Pickup Charges:<span style="color:#FF0000">*</span></strong></span></td>
			   	<td  width="53%" align="left">
                	<input type="hidden" name="id" id="id" value="{$rid}">
               		$
               		<input type="text" name="pickupcharges" id="pickupcharges" value="{$pickup_charges}" class="validate[required] textfield" />
				</td>
			  </tr>	
			<tr>
			  <td align="right" class="add_titles"><span class="gutt_textheading"><strong>Traffic Delay Per Hour:<span style="color:#FF0000">*</span></strong></span></td>
				<td align="left">$
				  <input type="text" name="traffic_delay" id="traffic_delay" value="{$traffic_delay}" class="validate[required] textfield" /></td>
			  </tr>	
			<tr>
			  <td width="47%" align="right" class="add_titles"><strong><span class="gutt_textheading">Price Per Mile</span>:<span style="color:#FF0000">*</span> </strong></td>
			  <td width="53%" align="left">$
			    <input type="text" name="price_per_mile" id="price_per_mile" value="{$price_per_mile}" class="validate[required] textfield" /></td>
		      </tr>	
			<tr>
				<td colspan="2" align="center"><input type="submit" name="submitAdmin" value="Update" class="btn"></td>
			</tr>
		  </table> 
	</td>
  </tr>
</table>																				
</form>
{ include file = footer.tpl}