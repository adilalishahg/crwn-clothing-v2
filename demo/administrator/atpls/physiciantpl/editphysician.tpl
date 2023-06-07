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
});


function check(){


  var first=document.getElementById('portfolio');
  var second=document.getElementById('portfolio_title');

  if(first.checked==true){
							
  second.disabled=false;							
  }else{
  	  second.value='';		  
	  second.disabled=true;
  }
}

</script>
{/literal}

	  <form name="affregister" id="affregister" method="post" action="editphysician.php" enctype="multipart/form-data">
	  <table width="700" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
        <tr>
          <td colspan="3" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
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
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
        <td colspan="2" align="right" valign="top" background="../images/2.jpg">&nbsp;</td>
        <td width="19" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
      </tr>
      <tr>
        <td rowspan="2" align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td colspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" align="right">&nbsp;</td>
    </tr>
   <tr>
    <td width="40%" height="25" align="right" class="labeltxt">Physician Name: <span style="color:#FF0000">*</span> </td>
    <td height="25"><input name="pname" type="text" class="required" id="pname" value="{$pname}" maxlength="50" /></td>
  </tr>
   <tr>
    <td height="25" align="right" class="labeltxt">Address: <span style="color:#FF0000">*</span> </td>
     <td><input name="paddress" type="text" class="required" id="paddress" maxlength="100" value="{$paddress}"/>       </td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt">Category: </td>
    <td height="25"><select name="pspecialities" id="pspecialities" style="width:250px;">
	<option value="">SELECT</option>
	{section name=q loop=$category}
	<option value="{$category[q].id}" {if $category[q].id eq $pspecialities} selected="selected" {/if}>{$category[q].category}</option>
	{/section}
	</select>
	</td>
  </tr>
 
 <!-- <tr>
    <td height="25" align="right" class="labeltxt">Picture:<span style="color:#FF0000">*</span></td>
     <td><input type="file" name="image" id="image" class="required btn" /></td>
  </tr>-->
 
  
   
  <!--<tr>
    <td height="25" align="right" class="labeltxt">Portfolio:  </td>
     <td><input type="checkbox" name="portfolio" id="portfolio" onclick="enable()"/>       </td>
  </tr>
  
  <tr>
    <td height="25" align="right" class="labeltxt">Portfolio Title:<span style="color:#FF0000">*</span> </td>
     <td><input type="text" name="portfolio_title" id="portfolio_title" class="required" disabled="disabled" />       </td>
  </tr>-->
   

  <!--<tr>
    <td height="25" align="right" class="labeltxt">Thumbnail Image:  </td>
     <td><input type="file" name="thumb[]" id="thumb[]" class="btn" />       </td>
  </tr>-->
  <!--<tr>
    <td height="25" align="right" class="labeltxt">Contact Person: <span style="color:#FF0000">*</span> </td>
     <td><input name="bperson" type="text" class="required" id="bperson" maxlength="100" value="{$bperson}" />       </td>
  </tr>-->
 
  <tr>
    <td height="25" align="right" class="labeltxt">Email: <span style="color:#FF0000">*</span> </td>
     <td><input name="pemail" type="text"  class="required" id="pemail" maxlength="100" value="{$pemail}"/>       </td>
  </tr> 
  <tr>
    <td height="25" align="right" class="labeltxt">Phone No: <span style="color:#FF0000">*</span> </td>
     <td><input name="pphone" type="text" class="required" id="pphone" maxlength="100" value="{$pphone}"/>       </td>
  </tr>
 <!-- <tr>
    <td height="25" align="right" class="labeltxt">Mobile No: <span style="color:#FF0000">*</span> </td>
     <td><input name="bmobile" type="text"  class="required" id="bmobile" maxlength="100" value="{$bmobile}"/>       </td>
  </tr>-->
  <tr>
    <td height="25" align="right" class="labeltxt">Fax: <span style="color:#FF0000">*</span> </td>
     <td><input name="pfax" type="text"  class="required" id="pfax" maxlength="100" value="{$pfax}"/>       </td>
  </tr>
 <!-- <tr>
    <td height="25" align="right" class="labeltxt">URL: <span style="color:#FF0000">*</span> </td>
    <td><input name="burl" type="text"  class="required" id="burl" maxlength="100" value="{$burl}"/></td>
  </tr>-->
 
    <tr>
    <td height="25" align="right" class="labeltxt">Status: </td>
   <td height="25"><input name="pstatus" type="radio" id="radio" value="1" checked="checked" />
   <span class="labeltxt">Featured</span>
   <input name="pstatus" type="radio" id="status" value="0" />
   <span class="labeltxt">Non-Featured</span></td>
   </tr>
  
 <!--<tr>
    <td width="24%" height="25" align="right" class="labeltxt"><strong>Position: * </strong></td>
    <td height="25"><select name="position" id="position">
     <option value="0" {if $position eq '0'}selected{/if}>0</option>
     {if $occupied_1 neq 'Y' || $position eq 1}
     <option value="1" {if $position eq '1'}selected{/if}>1</option>
     {/if}
     {if $occupied_2 neq 'Y' || $position eq 2}
     <option value="2" {if $position eq '2'}selected{/if}>2</option>
     {/if}
     {if $occupied_3 neq 'Y' || $position eq 3}
     <option value="3" {if $position eq '3'}selected{/if}>3</option>
     {/if}
     {if $occupied_4 neq 'Y' || $position eq 4}
     <option value="4" {if $position eq '4'}selected{/if}>4</option>
     {/if}


     </select></td>
  </tr>-->
  
  <!-- <tr>
    <td height="25" align="right" class="labeltxt"><strong>Status: * </strong></td>
<td>  <input name="status" type="radio" id="radio" value="1" {if $status eq '1'}checked {else}unchecked{/if} />
   <span class="labeltxt">Published</span>
  <input name="status" type="radio" id="status" value="0" {if $status eq '0'}checked {else}unchecked{/if}/>
  <span class="labeltxt">UnPublished</span></td>
   </tr> -->
  
  
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
<!--		  <input type="hidden" name="images" id="images" value="{$image}" />
		  <input type="hidden" name="img_thumb" id="img_thumb" value="{$thumb_image}" />-->
		  <input type="hidden" name="chkstatus" id="chkstatus" value="{$pstatus}" />
		  <input type="submit" name="regaff" id="regaff" value="Update" class="btn" />
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
