{include file = headerinner.tpl}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							
                            <tr>
                              <td  align="center" valign="top">&nbsp;</td>
                            </tr>
                            <tr id="showMe" align="center">
                              <td height="19" align="center">
							  <div class="notification success">
							  		<div>
									{ if $msgs != ''} {$msgs} {/if}
		                             { if $errors != ''} {$errors} {/if}							 	
									</div>
							  </div>							  </td>
                            </tr>

                            <!--<tr>
                              <td height="19" align="left"><strong>Select Site:
							  </strong>
							  <select name="site" id="site" onchange="selectSite(this.value);">
							    <option value=''>Select</option>
								<option value="1" {if $siteId eq '1'}selected{/if}>PosterFrame</option>
								<option value="2" {if $siteId eq '2'}selected{/if}>FrameMoldings</option>
							 </select>							  </td>
                            </tr>
                            <tr>
                              <td height="19" align="center" class="admintopheading">&nbsp;</td>
                            </tr>-->
			{if $maxRecord gt 10}
			<tr>
				
		      <td align="center">&nbsp;</td>
			</tr>
            {/if}			
         </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}
