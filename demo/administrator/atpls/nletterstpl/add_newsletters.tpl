{include file = headerinner.tpl}
{literal}

<script language="javascript" type="text/javascript">
function change_val(val){
		var btn_id;
		btn_id = val.id;
		document.getElementById('chk_button').value = btn_id;
		return true;
	}

function addElement(val){

	var element = $('#newElement').val();
	var container = $('#subscribers').val();
	var t = Array();
	t = element.split('@');

	if(element != '' && typeof(t[1]) != 'undefined'){

      for(var i=0; i<val.length; i++){
        
	    if(element.toLowerCase() == val[i].value.toLowerCase()){
		alert('Email address is already in the list');
		return false;		
		}
	  } 

	var new_element = $("#subscribers").append("<option  id='"+t[0]+"' value='"+element+"'>"+element+"</option>");
	$('#newElement').val('');
	return false;
   }else{
    alert('Please enter valid email address');
	return false;
   }
}

function deleteElement(del){

    for(var i=0; i<del.length; i++){
		if(del.options[i].selected){
			del.remove(i);
		}
	  } 
}

$(document).ready(function() {
    $("#frm_add_letter").validationEngine();	
	});	

</script>

{/literal}
<table width="720" class="outer_table" style="margin-bottom:10px;" height="350" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr><td width="90%" align="center" valign="top">
	<div id="outerWrapper">

	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF">

      <tr>

	     <td width="100%" align="right" style="padding-right:10px">[<a href="javascript:history.back();">back</a>]</td>
	  </tr>

        <tr>
          <td align="center" valign="middle" class="admintopheading">ADD NEWSLETTERS</td>
          </tr>
        <tr>
          <td align="center"  valign="top">{ if $msgs != ''} {$msgs} {/if}

		   </td>
          </tr>
	</table>	

	<!--Start Content -->

	<br />

		<table width="700"  border="0" cellspacing="0" cellpadding="0" align="center">

      <tr>

        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/2.jpg"></td>

        <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>
      </tr>

	  <tr>

        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>

        <td align="left" valign="top">

		<!--Content Area-->

		<table cellpadding="5" cellspacing="0" width="100%">

			<tr>

				<td>

					<table cellpadding="5" cellspacing="0" width="100%">

			<tr>

				<td>

				<form name="frm_add_letter" id="frm_add_letter" action="add_letter.php" method="post">

				<input type="hidden" name="chk_button" id="chk_button" value="save" />

				

					<table width="100%" cellpadding="5" cellspacing="0">

						<tr>

							<td width="15%" align="right" valign="top" class="labeltxt"><b>Subscribers List:</b><span style="color:#FF0000">*</span></td>

							<td>
							<select name="subscribers[]" size="5" id="subscribers" multiple="multiple" style="width:250px;height:150px; border:#000000 1px solid;" class="validate[required]">
								{section name=q loop=$subscribers}
								 <option value="{$subscribers[q].email}" {section name=n loop=$subscribers1} {if $subscribers[q].email eq $subscribers1[n]}selected{/if}{/section}>{$subscribers[q].email}</option>
								{/section}
								</select>								</td>
						</tr>
						<tr valign="top">
							<td>							</td>
						</tr>
						
						<tr>
						  <td align="right" class="labeltxt"><b>Email:</b></td>
						  <td style="padding-top:3px;"><input name="newElement" type="text" class="email" id="newElement" value="" size="30" maxlength="100"/>
							<input type="button" class="btn" value=" Add Email " name="submit" onclick = "addElement(document.frm_add_letter['subscribers[]'])"/>&nbsp;&nbsp;<input type="button" class="btn" value="Delete Email" name="delemail" onclick = "deleteElement(document.frm_add_letter['subscribers[]'])"/></td>
						  </tr>
						<tr>

							<td align="right" valign="top" class="labeltxt"><b>Subject:</b><span style="color:#FF0000">*</span></td>
							<td><input name="txt_letter_title" type="text" class="validate[required,custom[noSpecialCaracters],length[0,100]]" id="txt_letter_title" value="{$subject}" size="30" maxlength="50" /></td>
						</tr>

						<tr>
							<td align="right" valign="top" class="labeltxt"><b>Message:</b><span style="color:#FF0000">*</span></td>
							<td><textarea name="editor1" id="editor1">{$content}</textarea>&nbsp;&nbsp;{if $errors1 neq ''}<span style="color:#FF0000; padding:6px;">{$errors1}</span>{/if}
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
{/literal}</td>
						</tr>
						<!--<tr>
							<td align="right" valign="top" class="labeltxt"><b>Email Header:</b></td>
							<td><span style="vertical-align:top; padding-right:5px; font-weight:bold;">Include</span><input type="radio" name="header" checked="yes" value="include" />&nbsp;&nbsp;<span style="vertical-align:top; padding-right:5px; font-weight:bold;">Not Include</span><input type="radio" name="header" value="notinclude" />
</td>
						</tr>
						<tr>
							<td align="right" valign="top" class="labeltxt"><b>Email Footer</b></td>
							<td><span style="vertical-align:top; padding-right:5px; font-weight:bold;">Include</span><input type="radio" name="footer" checked="yes" value="include" />&nbsp;&nbsp;<span style="vertical-align:top; padding-right:5px; font-weight:bold;">Not Include</span><input type="radio" name="footer" value="notinclude" /></td>
						</tr>-->
						
						<tr>

							<td align="right"><b>&nbsp;</b></td>
							<td align="center" style="margin-top:5px;"><input type="submit" name="btn_save_letter" id="save" value="     Save     " class="btn" onclick="return change_val(this);" />&nbsp;&nbsp; <input type="submit" name="btn_save_send_letter" id="save_send" value="Save & Send" class="btn"  onclick="return change_val(this);"  />							</td>
						</tr>
					</table> 
				</form>				</td>
			</tr>

			<tr>

				<td>&nbsp;</td>
			</tr>
		</table>				</td>
			</tr>
		</table>

		<!--End Content Area-->		</td>

	<td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>

	  <tr>

        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>

        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table>
</div></td>
</tr>
</table>

{ include file = innerfooter.tpl}

