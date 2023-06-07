{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$("#affregister").validationEngine();
});
</script>

<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			
			location.href="index.php?delId="+id;
			return true;
		}
		else
		{
			
			return false;
		}
			
	}

function validate(form){
if(form.upload_img.value != ''){
if((form.upload_img.value.lastIndexOf(".jpg")==-1)&&(form.upload_img.value.lastIndexOf(".gif")==-1)&&(form.upload_img.value.lastIndexOf(".png")==-1)) {    
	alert("Please upload only .jpg/.gif/.png extension file");  
	return false;
	}
}	
}
</script>
<script language="javascript">
function validate2fields(){
	if($("#upload_img").val() == ""){
		return true;
	}else{
		return false;
	}
}
</script>
{/literal}
<table class="outer_table" width="720" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                              <td height="25" align="right" valign="top" style="padding-right:20px;">[<a href="javascript:history.back();">Back</a>]</td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="admintopheading">Add Panel Images</td>
                            </tr>
							
                            <tr>
<td height="19" align="center" >&nbsp;</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <form action="addpanel.php" name="affregister" id="affregister" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
	  <table width="80%" border="0" cellspacing="5" cellpadding="5">
        <tr>
          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
		  { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}		  </td>
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
    <td width="40%" align="right" class="labeltxt">Category: <span style="color:#FF0000">*</span> </td>
     <td><select name="category" id="category" class="validate[required]">
								<option value="">Select</option>
								<option value="0" style="background-color:#eeeeee;">GENERAL</option>									
								{section name=w loop=$category}
								<option value="{$category[w].id}" {if $category[w].id eq $selcategory} selected="selected" {/if} style="background-color:{cycle values="#d0d0d0,#eeeeee"}">{$category[w].category}</option>
								{/section}							
								</select></td>
  </tr>
	 <tr>
    <td width="40%" align="right" class="labeltxt">Panel: <span style="color:#FF0000">*</span> </td>
     <td><select name="type" id="type" class="validate[required]">
								<option value="">Select</option>									
								<option value="right" style="background-color:#CCCCCC;" {if $type eq 'right'} selected="selected"{/if}>Right Panel</option>
								<option value="left" {if $type eq 'left'} selected="selected"{/if}>Left Panel</option>							
								</select></td>
  </tr>
  <tr>
    <td width="40%" align="right" class="labeltxt">Image:<span style="color:#FF0000">*</span> </td>
     <td><input type="file" name="upload_img" id="upload_img" class="validate[required]" />&nbsp;<span style="color:#FF0000">(Jpg,Gif,Png)</span></td>
  </tr>
  <tr>
    <td align="right" class="labeltxt">Link:<span style="color:#FF0000">*</span></td>
     <td><input name="url" type="text" id="url" value="http://{$url}" maxlength="100" size="30" class="validate[required,length[0,100]]" /></td>
  </tr>
  <tr>
   <td height="25" align="right" class="labeltxt"><strong>Status:</strong></td>
   <td height="25"><span style="width:8%"><input name="status" type="radio" id="radio" value="1"  {if $status eq '1'}checked{/if} /></span>&nbsp;<span style="width:15%" class="labeltxt">Published</span>&nbsp;<span style="width:8%"><input name="status" type="radio" id="status" value="0"  {if $status eq '0'}checked{/if} /></span>&nbsp;<span class="labeltxt">Un-Published</span></td>
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
		  <input type="submit" name="addtestimonials" id="addtestimonials" value="Add Image" class="btn" />
		  <input type="reset" name="reset" id="reset" value="Reset" class="btn" onclick="$.validationEngine.closePrompt('.formError',true)" />		  </td>
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
