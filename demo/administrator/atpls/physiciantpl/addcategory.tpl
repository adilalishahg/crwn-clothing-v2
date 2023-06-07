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
	$("#affregister").validate()
    }

);

</script>
{/literal}
<table width="1010" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                              <td height="25" align="left" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">Add Category For Project Management </td>
                            </tr>
							
                            <tr>
<td height="19" align="center" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <form name="affregister" id="affregister" method="post" action="addcategory.php">
	  <table width="80%" border="0" cellspacing="2" cellpadding="2" class="outer_table">
        <tr>
          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
		  { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Add Project Details: </strong></td>
          </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
        <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td colspan="2" align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="19" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td rowspan="2" align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="5">&nbsp;</td>
    </tr>
  <tr>
    <td width="40%" height="25" align="right" class="labeltxt">Category:<span style="color:#FF0000">*</span></td>
    <td height="25"><input name="category" type="text" class="required" id="category" value="{$title}" size="30" maxlength="100" /></td>
  </tr>
  
   
    <!--<tr>
    <td height="25" align="right" class="labeltxt">Position: * </td>
     <td><select name="position" id="position">
     <option value="0" {if $position eq '0'}selected{/if}>0</option>
      {if $occupied_1 neq 'Y'}
     <option value="1" {if $position eq '1'}selected{/if}>1</option>
     {/if}
     {if $occupied_2 neq 'Y'}
     <option value="2" {if $position eq '2'}selected{/if}>2</option>
     {/if}
     {if $occupied_3 neq 'Y'}
     <option value="3" {if $position eq '3'}selected{/if}>3</option>
     {/if}
     {if $occupied_4 neq 'Y'}
     <option value="4" {if $position eq '4'}selected{/if}>4</option>
     {/if}


     </select></td>
  </tr>-->
  
  
  <tr>
    <td height="25" align="right" class="labeltxt">&nbsp;</td>
  </tr>
 <!-- <tr>
    <td height="25" align="right" class="labeltxt">Status: </td>
   <td width="5%" height="25"><input name="status" type="radio" id="radio" value="1" style"checked" />
   <span class="labeltxt">Published</span>
   <input name="status" type="radio" id="status" value="0" />
  <span class="labeltxt">UnPublished</span></td>
   </tr>-->
  
  
</table>		</td>
        <td rowspan="2" align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top" ></td>
        <td width="73" align="left" valign="top" ></td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
        <td colspan="2" align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
      </tr>
    </table>    	</td>
        </tr>
        
        <tr>
          <td width="48" align="right" valign="top">&nbsp;</td>
          <td width="1064" colspan="2" align="center" valign="top">
		
          <input type="submit" name="addtestimonials" id="addtestimonials" value="Add Project Category" class="btn" />
		  <input type="reset" name="reset" id="reset" value="Reset" class="btn" />		  </td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
		<tr>
		  <td colspan="3"><!--  CONTENT DETAIL --></td>
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
