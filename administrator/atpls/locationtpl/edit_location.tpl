{ include file = headerinner.tpl}
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
	$("#edit_poll_1").validationEngine()
	$('#end_date').datepicker();
});
</script>
{/literal}
<table width="720" class="outer_table" style="margin-bottom:10px;" border="0" cellspacing="0" cellpadding="0" class="outer_table" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">Update Location Search</td>
                            </tr>
							
                            <tr>
<td height="19" align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <form name="edit_poll_1" id="edit_poll_1" method="post" action="edit_location.php" enctype="multipart/form-data">
	  <table width="600" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="430" colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}		  </td>
        </tr>
        
        <tr>
          <td colspan="3" align="center" valign="top">
        <table width="90%" border="0" cellspacing="0" cellpadding="0">
 
      <tr>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
 

  <tr>
    <td height="25" align="right" class="labeltxt" width="30%"><strong>Title:</strong><span style="color:#FF0000">*</span></td>
    <td height="25"><input type="text" name="title" id="title" value="{$title}" class="validate[required,custom[onlyLetter],length[0,50]]" maxlength="50" size="40" /></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt" width="30%"><strong>Description:</strong><span style="color:#FF0000">*</span></td>
    <td height="25"><textarea name="description" id="description" class="validate[required,length[6,200]]" cols="40" rows="5">{$description}</textarea></td>
  </tr>    
  <tr>
    <td height="25" align="right" class="labeltxt"><strong>Added On:</strong> </td>
    <td height="25" class="labeltxt">{$created|date_format}&nbsp;</td>
  </tr>  
   <tr>
    <td height="25" align="right" class="labeltxt" width="30%"><strong>From:</strong><span style="color:#FF0000">*</span></td>
    <td height="25"><input type="text" name="from" id="from" value="{$from}" class="validate[required,length[0,100]]" maxlength="100" size="40" /></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt" width="30%"><strong>To:</strong><span style="color:#FF0000">*</span></td>
    <td height="25"><input type="text" name="to" id="to" value="{$to}" class="validate[required,length[0,100]]" maxlength="100" size="40" /></td>
  </tr>



  
  <tr>
    <td height="25" align="center" class="labeltxt" colspan="2">
 <input type="hidden" name="hid" id="hid" value="{$uid}" /> <input type="hidden" name="created" id="created" value="{$created}" />
<input type="submit" name="edit_article" id="edit_article" value="Update Record" class="btn" />
<input type="reset" name="reset" id="reset" value="Reset" class="btn" /></td>
  </tr>
  
</table>
		</form>
</td>
        
      </tr>
     
    </table>    	</td>
        </tr>
        
        <tr>
          <td colspan="3" align="center" valign="top">		  		  </td>
        </tr>
        
        <tr>
          <td colspan="3" align="center" valign="top">		  		  </td>
        </tr>
        
        <tr>
          <td colspan="3" align="center" valign="top">		  		  </td>
        </tr>
        
		<tr>
		  <td colspan="3"><!--  CONTENT DETAIL --></td>
		</tr>
      </table>
  <tr>
    <td height="25" align="right" class="labeltxt">&nbsp;</td>
    <td height="25"> </td>
  </tr>
  
</table>		</td>
      </tr>
      
    </table> 
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}
