{include file = headerinner.tpl}
{literal} 
<script language="javascript" type="text/javascript">
$(document).ready(function() {
$("#add-admuser").validationEngine()
});

</script> 

<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
	mode : "specific_textareas",
    editor_selector : /(content|mceRichText)/,
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">Update Question</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px; color: #F00;"><form name="add-admuser" id="add-admuser" method="post" action="" enctype="multipart/form-data">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                      <tr>
                        <td colspan="3" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
                          { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if} </td>
                      </tr>
                      <tr>
                    <td colspan="3" align="center" valign="top"><table width="90%" border="0" cellspacing="0" cellpadding="0">                           <tr>
                              <td width="17" align="left"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
                              <td align="left" background="../images/2.jpg"></td>
                              <td width="17" align="left"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
                              <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                  <tr>
                                    <td colspan="2"></td>
                                  </tr>
                     <tr>
                      <td width="10%" height="25" align="right" class="labeltxt"><b>Question:</b></td>
                      <td width="90%" height="25"><input name="question" type="text" class="validate[required]" id="question" value="{$data.question}" maxlength="500" size="50"/>*</td>
                    </tr>
                     <tr>
                      <td  height="25" align="right" class="labeltxt"><b>Answer</b></td>
                      <td  height="25"> <textarea class="content" id="answer" style="width: 100%; height: 500px" name="answer" >{$data.answer}</textarea></td>
                    </tr>
                                                                                     </table></td>
                              <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
                              <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
                              <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
                            </tr>
                          </table></td>
                      </tr>
                      {if $smarty.session.admuser.admin_level eq '0' || $smarty.session.adminpermission.m13m_up eq 'on' }{/if}
                      <tr>
                      <td colspan="3" align="center" valign="top">
                        <input type="submit" name="admusersub" id="admusersub" value=" Update " class="btn" />
                        <input type="reset" name="reset" id="reset" value="Reset" class="btn" />
                        <input type="hidden" name="eId" value="{$eId}"  />
                       </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top">&nbsp;</td>
                        <td colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><!--  CONTENT DETAIL --></td>
                      </tr>
                    </table>
                  </form></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 