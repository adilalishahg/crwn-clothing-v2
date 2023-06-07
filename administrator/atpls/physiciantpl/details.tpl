
{literal}
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			
			location.href="index.php?delId="+id;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			
			return false;
		}
			
	}

	$(document).ready(function() {
	$("#affregister").validate()
    }

);

</script>
{/literal}
<table width="100%" border="0" cellpadding="4" cellspacing="0">
			<tr>
			  <td align="center"><span class="headingbg">{ if $msgs != ''} {$msgs} {/if}
		  { if $errors != ''} {$errors} {/if} </span></td>
	   </tr>
			<tr>
			  <td align="left" valign="top">
			  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
        <tr>
          <td class="admintopheading">Project Description</td>
          </tr>
        <tr>
          <td align="left" valign="top">
		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>
    <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
    <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>
  </tr>
  <tr>
    <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
    <td align="left" valign="top"><form name="editPage" id="editPage" method="post" action="editpage.php?eId={$eId}">
							  <table width="100%" border="0" cellspacing="2" cellpadding="2">
								  <tr>
									<td colspan="2"></td>
								  </tr>   
                                  <tr>
                                    <td height="25" class="labeltxt" align="right">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">Press 'Esc' to Close </td>
                                  </tr>
                                  <tr>
									<td height="25" class="labeltxt" align="right"><strong>Title:</strong></td>
									<td width="76%" class="labeltxt" height="25">{$title}</td>
								  </tr>
                                 <tr><td>&nbsp;</td></tr> 
								   <tr>
									<td height="25" class="labeltxt" align="right"><strong>Description:</strong></td>
									<td height="25">{$description}</td>
								  </tr>
								  <tr>
									<td height="25" colspan="2">
									<input type="hidden" name="hidpgname" value="{$hdpgname}" />									</td>
								  </tr>
								  
					</table>
								
								</form></td>
    <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>
    <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
    <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
  </tr>
</table>		  </td>
        </tr>
      </table>			  </td>
			</tr>
	  </table> 

