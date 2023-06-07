{ include file = headerinner.tpl}
{literal}
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record?");
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
});

</script>
{/literal}

	  <form name="affregister" id="affregister" method="post" action="edittestimonials.php">
	  <table width="700" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
        <tr>
          <td colspan="3" align="right" valign="top" style="padding-right:10px">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
       
        <tr>
          <td colspan="3" align="center" valign="top" class="admintopheading"><strong>EDIT TESTIMONIAL</strong></td>
        </tr>
		
        <tr>
          <td colspan="3" align="center" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		
      <tr>
        <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td colspan="2" align="right" background="../images/2.jpg"></td>
        <td width="19" align="left" ><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td rowspan="2" align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" align="right">&nbsp;</td>
    </tr>
  <tr>
    <td width="40%" height="25" align="right" class="labeltxt"><strong>First Name: <span style="color:#F00">*</span></strong></td>
    <td height="25" colspan="4" valign="middle"><input name="fname" type="text" class="required chars" id="fname" value="{$fname}" maxlength="20" />
   </td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt"><strong>Last Name:</strong> <span style="color:#F00">*</span></td>
    <td height="25" colspan="4" valign="middle"><input name="lname" type="text" class="required chars" id="lname" value="{$lname}" maxlength="20" />
    </td>
  </tr>
   <tr>
  <td align="right" class="labeltxt"><strong>Facility:</strong><span style="color:#F00">*</span></td>
  <td><select name="hosp" id="hosp" class="required">
      <option value="">Select</option>
      
			 {section name=w loop=$slist}
			
			 
      <option value="{$slist[w].hospname}" {if $hosp1 eq $slist[w].hospname}selected{/if}>{$slist[w].hospname}</option>
      
			 {/section}
			
    </select></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt"><strong>Message:</strong><span style="color:#F00">*</span></td>
     <td colspan="4" rowspan="2" valign="middle"><textarea name="editor1" id="editor1" cols="145" rows="5">{$content}</textarea>{if $errors neq ''}<font color="#FF0000" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif;" >{$errors}</font>{/if}
{literal}
<script language="javascript">CKEDITOR.replace( 'editor1', 
{
        on :
        {
            instanceReady : function( ev )
            {
                // Output paragraphs as <p>Text</p>.
                this.dataProcessor.writer.setRules( 'p',
                    {
                        indent : true,
                        breakBeforeOpen : true,
                        breakAfterOpen : false,
                        breakBeforeClose : false,
                        breakAfterClose : true
                    });
				this.dataProcessor.writer.setRules( 'li',
                    {
                        indent : true,
                        breakBeforeOpen : true,
                        breakAfterOpen : false,
                        breakBeforeClose : false,
                        breakAfterClose : true
                    });
            }
        }
});
</script>
{/literal}									{ if $msgs != '' }<font color="#FF0000" style="font-weight:bold, font-family:Arial, Helvetica, sans-serif" ><img src="../images/unchecked.gif">{$msgs}</font>{/if}</td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt"><strong>Status:</strong> </td>
   <td width="2%" height="25" align="right"><input name="status" type="radio" id="radio" value="1" {if $status eq '1'}checked {else}unchecked{/if} /></td>
   <td width="8%"><span class="labeltxt">Published</span></td>
   <td width="3%"><input name="status" type="radio" id="status" value="0" {if $status eq '0'}checked {else}unchecked{/if}/></td>
   <td width="44%"><span class="labeltxt">Un-Published</span></td>
   </tr>
  
  
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
          <td align="right" valign="top">&nbsp;</td>
          <td colspan="2" align="center" valign="top">
		  
		  <input type="hidden" name="uid1" id="uid1" value="{$uid}" />
		  <input type="submit" name="regaff" id="regaff" value="Edit Testimonial" class="btn" />
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
</form>	
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}
