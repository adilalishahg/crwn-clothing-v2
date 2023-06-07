{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function() {
$("#affregister").validationEngine();
});
function validate(form){
if(form.upload_img.value != ''){
if((form.upload_img.value.lastIndexOf(".jpg")==-1)&&(form.upload_img.value.lastIndexOf(".gif")==-1)&&(form.upload_img.value.lastIndexOf(".png")==-1)) {    
	alert("Please upload only .jpg/.gif/.png extension file");  
	return false;
	}
}	
}
</script>
{/literal}

	  <form name="affregister" id="affregister" method="post" action="editpanel.php" enctype="multipart/form-data" onsubmit="return validate(this);">
	  <table width="720" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF" class="outer_table" style="margin-bottom:10px;">
        <tr>
          <td colspan="3" align="right">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
        <tr>
          <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
		  { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}		  </td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" class="admintopheading"><strong>Update Details: </strong></td>
        </tr>
        <tr>
          <td colspan="3" align="center" valign="top">
        <table width="80%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td colspan="2" align="right" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="19" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td rowspan="2" align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="5" align="right">&nbsp;</td>
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
    <td width="35%" height="25" align="right" class="labeltxt" style="padding-right:12px;">Panel Type:<span style="color:#FF0000">*</span></td>
	<td><select name="type" id="type">
		<option value="">Select</option>									
		<option value="right" style="background-color:#CCCCCC;" {if $type eq 'right'} selected="selected" {/if}>Right Panel</option>
		<option value="left" {if $type eq 'left'} selected="selected" {/if}>Left Panel</option>							
		</select></td>
  </tr>
  <tr>
    <td width="35%" height="25" align="right" class="labeltxt" style="padding-right:12px;">Uploaded Image:</td>
	<td><a href="{$target}{$image}" rel="facebox">View</a></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt" style="padding-right:12px;">Image: </td>
     <td><input type="file" name="upload_img" id="upload_img" class="btn" />       </td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt">Link: <span style="color:#FF0000">*</span></td>
     <td><input name="url" type="text" id="url" maxlength="100" value="http://{$url}" class="required" size="30" /></td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt">Status: <span style="color:#FF0000">*</span></td>
     <td><span style="width:8%"><input name="status" type="radio" id="radio" value="1"  {if $status eq '1'}checked{/if} /></span>&nbsp;<span style="width:15%" class="labeltxt">Published</span>&nbsp;<span style="width:8%"><input name="status" type="radio" id="status" value="0"  {if $status eq '0'}checked{/if} /></span>&nbsp;<span class="labeltxt">Un-Published</span></td>
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
		  
		  <input type="hidden" name="uid1" id="uid1" value="{$uid}" />
		  <input type="hidden" name="hid_image" id="hid_image" value="{$image}" />
		  <input type="submit" name="regaff" id="regaff" value="Update Image" class="btn" />
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
