{ include file = headerinner.tpl}
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
<table width="720" style="margin-bottom:10px;" class="outer_table" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>    
	<td width="90%" align="center" valign="top">	
	<div id="outerWrapper">
	<table width="700" border="0" align="center" cellpadding="4" cellspacing="0">
      <tr>
	     <td width="100%" align="right">[<a href="javascript:history.back();">back</a>]</td>
	  </tr>
        <tr>
              <td colspan="3" align="center" valign="top" class="admintopheading">		  
		SEND NEWSLETTERS		</td>
          </tr>
        <tr>
          <td colspan="3" valign="top" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		  </td>
          </tr>
		<tr>
		<td align="right">
			<a href="add_letter.php">Create NewsLetter</a></td>
	</tr>
	</table>	
	<!--Start Content -->
	<br />
		<table width="700"  border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
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
				<form name="frm_add_letter" id="frm_add_letter" class="required" action="send_letter.php" method="post">
					<input type="hidden" name="letterid" id="letterid" value="{$letterid}" />
				
					<table width="700" cellpadding="5" cellspacing="0">
						<tr>
							<td width="132" align="right" valign="top" class="labeltxt"><b>Subscribers List:</b></td>
							<td width="546">
							<select name="subscribers[]" type="text" size="5" id="subscribers" multiple="multiple" style="width:250px;height:150px; border:#000000 1px solid;" class="validate[required]">
								{section name=q loop=$subscribers}
								 <option value="{$subscribers[q].n_email}" 
								 {section name=n loop=$subscriberz} {if $subscribers[q].n_email eq $subscriberz[n]}selected{/if}{/section}>{$subscribers[q].n_email}</option>
								{/section}
								</select>&nbsp;&nbsp;{ if $errors != '' }<font color="#FF0000" style="font-weight:bold, font-family:Arial, Helvetica, sans-serif" ><img src="../images/unchecked.gif">{$errors}</font>{/if}								</td>
						</tr>
						<tr>
<tr>
						  <td align="right" valign="top" class="labeltxt"><b>Email:</b></td>
						  <td><input name="newElement" type="text" class="email" id="newElement" value="" size="30"/>
							<input type="button" value="Add Email" name="submit" class="btn" onclick ="addElement(document.frm_add_letter['subscribers[]'])";/>&nbsp;&nbsp;<input type="button" class="btn" value="Delete Email" name="delemail" onclick = "deleteElement(document.frm_add_letter['subscribers[]'])"/></td>
						  </tr>
						<tr>
							<td align="right" valign="top" class="labeltxt"><b>Subject:<span style="color:#FF0000">*</span></b></td>
							<td><input name="txt_letter_title" class="validate[required,custom[noSpecialCaracters],length[0,100]]" type="text" id="txt_letter_title" maxlength="100" size="30" value="{$subject}"/></td>
						</tr>
						<tr>
							<td align="right" valign="top" class="labeltxt"><b>Message:<span style="color:#FF0000">*</span></b></td>
							<td>
							<textarea name="editor1">{$content}</textarea>&nbsp;&nbsp;{ if $errors1 != '' }<font color="#FF0000" style="font-weight:bold, font-family:Arial, Helvetica, sans-serif" >{$errors1}</font>{/if}
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
							<td align="right" valign="top" class="labeltxt"><b>Email Header</b></td>
							<td valign="top" class="labeltxt">Include <input type="radio" name="header" checked="yes" value="include" />&nbsp;&nbsp;Not Include <input type="radio" name="header" value="notinclude" />
</td>
						</tr>
						<tr>
							<td align="right" valign="top" class="labeltxt"><b>Email Footer</b></td>
							<td valign="top" class="labeltxt">Include <input type="radio" name="footer" checked="yes" value="include" />&nbsp;&nbsp;Not Include <input type="radio" name="footer" value="notinclude" /></td>
						</tr>-->
						<tr>
							<td align="right"><b>&nbsp;</b></td>
							<td>
							<input type="submit" name="btn_send_letter" id="btn_send_letter" value="Send Newsletter" class="btn" />							</td>
						</tr>
					</table> 
				</form>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
				</td>
			</tr>
		</table>
		<!--End Content Area-->
		</td>
	<td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>
	  <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table>

	
	<!--End Content-->
</div></td>
</tr>
</table>
{ include file = innerfooter.tpl}
