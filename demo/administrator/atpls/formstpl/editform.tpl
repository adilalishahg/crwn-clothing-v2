{ include file = headerinner.tpl}
{literal}
<script type="text/javascript">
function validate(form){	
	if(form.upd_img.value!=''){
	if((form.upd_img.value.lastIndexOf(".pdf")==-1)&&(form.upd_img.value.lastIndexOf(".doc")==-1)&&(form.upd_img.value.lastIndexOf(".docx")==-1)&&(form.upd_img.value.lastIndexOf(".xls")==-1)&&(form.upd_img.value.lastIndexOf(".xlsx")==-1)&&(form.upd_img.value.lastIndexOf(".ppt")==-1)&&(form.upd_img.value.lastIndexOf(".jpg")==-1)) {    
	alert("Please upload only .pdf/.doc/.docx/.xls/.xlsx/.ppt/.jpg extension file");  
	event.returnValue=false; return false;
	}
	}
	event.returnValue=true;	return true;						 
}
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
	$("#affregister").validationEngine()
});

</script>
{/literal}
<table width="720" class="outer_table" style="margin-bottom:10px;" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                            <td height="25" align="right" valign="top" style="padding-right:40px">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">EDIT BROCHURE/FORM</td>
                            </tr>
							
                            <tr>
<td height="19" align="center" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							 <form name="affregister" id="affregister" method="post" action="editform.php" enctype="multipart/form-data" onsubmit="return validate(this);">
	  <table width="80%" border="0" cellspacing="2" cellpadding="2">
              
        <tr>
          <td colspan="3" align="center" valign="top">
        <table width="92%" border="0" cellspacing="0" cellpadding="0">
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
    <td width="24%" height="25" align="right" class="labeltxt"><strong>Title : <span style="color:#F00">*</span></strong></td>
    <td height="25" colspan="4" valign="middle"><input type="text" size="30" name="title" id="title" value="{$title}" class="validate[required,custom[onlyLetter],length[0,100]]" maxlength="100" /></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt"><strong>Description : <span style="color:#F00">*</span></strong></td>
    <td height="25" colspan="4" valign="middle"><textarea name="editor1" id="editor1" cols="145" rows="5">{$description}</textarea>{ if $msgs != '' }<font color="#FF0000" style="font-weight:bold, font-family:Arial, Helvetica, sans-serif" >{$msgs}</font>{/if}
	{literal}
<script language="javascript">CKEDITOR.replace( 'editor1', 
{
		toolbar : 'Basic',
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
{/literal}</td>
  </tr>
    <tr>
    <td width="24%" height="25" align="right" class="labeltxt"><strong>Uploaded Document : <span style="color:#F00">*</span></strong></td>
    <td height="40" colspan="4">{if $file_ext eq 'jpg'}<a href="{$target_path}{$file_name}" rel="facebox">{else}<a href="{$target_path}{$file_name}">{/if}<b>View</b></a></td>
  </tr>
    <tr>
    <td width="24%" height="25" align="right" class="labeltxt"><strong>Document : </strong></td>
    <td height="40" colspan="4"><input type="file" style="height:25px;" name="upd_img[]" id="upd_img" />&nbsp;(<span style="color:#FF0000; font-size:9px; font-weight:bold;">.pdf,.doc,.docx,.xls,.xlsx,.ppt,.jpg</span>)</td>
  </tr>
   <tr>
    <td height="25" align="right" class="labeltxt"><strong>Status:</strong> </td>
   <td height="25" colspan="4"><input name="status" type="radio" id="radio" value="1" {if $status eq '1'}checked {else}unchecked{/if} />     <span class="labeltxt">Published</span>     <input name="status" type="radio" id="status" value="0" {if $status eq '0'}checked {else}unchecked{/if}/>     
   <span class="labeltxt">Un-Published</span></td>
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
          <td width="48" align="right" valign="top">&nbsp;</td>
          <td width="1064" colspan="2" align="center" valign="top">
          <input  type="hidden" id="uid" name="uid" value="{$uid}">
		  <input type="hidden" name="himage" id="himage" value="{$file_name}" />
  		  <input type="hidden" name="hext" id="hext" value="{$file_ext}" />	
   		  <input type="hidden" name="hdate" id="hdate" value="{$date}" />	  
		  <input type="submit" name="editf" id="editf" value="Edit Brochure/Form" class="btn" />
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


{ include file = footer.tpl}
