{ include file = headerinner.tpl}
{literal}
<script language="javascript">
$(document).ready(function() {
$("#frm_add_letter").validationEngine();	
});	
</script>
{/literal}

<table width="720" class="outer_table" style="margin-bottom:10px;" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>

	<td width="90%" align="center" valign="top">
	<table width="700" border="0" align="center" cellpadding="4" cellspacing="0">

      <tr>

	     <td colspan="2" align="right">[<a href="index.php">back</a>]</td>
	  </tr>

        <tr>

          <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}

		  { if $errors != ''} {$errors} {/if}</td>
          </tr>

	 <tr>
		<td colspan="2" align="right">

			<a href="add_letter.php">Create NewsLetter</a>		</td> 
	</tr>
	<td colspan="2" valign="top" align="center" class="admintopheading">
		  
		EDIT NEWSLETTERS		</td>



	</table>	

	<!--Start Content -->

	<br />

		<table  border="0" cellspacing="0" cellpadding="0" align="center">


	  <tr>



    <td width="17" align="left" valign="top">
        <table width="700"  border="0" cellspacing="0" cellpadding="0" align="center">

      <tr>

        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>

        <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>
      </tr>

	  <tr>

        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
        <td align="left" valign="top">
		<table cellpadding="5" cellspacing="0" width="700">

			<tr>

				<td>

					<table cellpadding="5" cellspacing="0" width="100%">

			<tr>

				<td>

				<form name="frm_add_letter" id="frm_add_letter" action="edit_letter.php" method="post">

				<input type="hidden" name="letterid" id="letterid" value="{$newsletters[0].letter_id}" />
				<table width="700" cellpadding="5" cellspacing="0" align="center">

						

						<tr>

							<td align="right" valign="top" class="labeltxt"><b>Subject: </b><span style="color:#FF0000">*</span></td>
							<td><input name="txt_letter_title" type="text" id="txt_letter_title" size="50" maxlength="100" value="{$subject}" class="validate[required,custom[noSpecialCaracters],length[0,100]]" /></td>
						</tr>

						<tr>

							<td align="right" valign="top" class="labeltxt"><b>Message: </b></td>

							<td><textarea name="editor1">{$content}</textarea>&nbsp;&nbsp;{ if $errors1 != '' }<font color="#FF0000" style="font-weight:bold, font-family:Arial, Helvetica, sans-serif" >{$errors1}</font>{/if}
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
{/literal} </td>
						</tr>

						<tr>

							<td colspan="2" align="left">&nbsp;</td>
						</tr>

						<tr>

							<td align="right"><b>&nbsp;</b></td>

							<td>

								<input type="submit" name="btn_edit_letter" id="btn_edit_letter" value="Update" class="btn" />							</td>
						</tr>
					</table> 
				</form>				</td>
			</tr>

			<tr>

				<td>&nbsp;</td>
			</tr>
		</table>				</td>
			</tr>
		</table>         </td>

	<td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
      </tr>

	  <tr>

        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>

        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table>	</td>
	</tr>
    </table>
</td>

</tr>
</table>
{ include file = innerfooter.tpl}

