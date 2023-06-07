{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
function deleteRec(id)
 {
	var ok;
	ok=confirm("Are you sure you want to delete this record?");
	if (ok){		
			location.href="index.php?act=del&letterid="+id;
			return true;}else{
			return false;
		}
}
</script>
{/literal}
<table width="720" class="outer_table" style="margin-bottom:10px;" height="350" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
</tr><td width="90%" align="right" valign="top">		
<a href="subc.php">Subscribers List</a>&nbsp;|&nbsp;<a href="add_letter.php">Create NewsLetter</a>&nbsp;|&nbsp;[<a href="javascript:history.back();">back</a>]</td>	
</tr>
<tr>
  <td align="center" class="admintopheading">NEWSLETTERS LISTING</td>
</tr>
<tr>
  <td align="center" valign="top"><br /><span class="okmsg">{ if $msg != ''} {$msg} {/if}
    { if $error != ''} {$error} {/if} </span></td>
</tr>
<tr>
  <td align="center" valign="top">
  	<table width="80%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/2.jpg"></td>
        <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" background="../images/4.jpg"></td>
        <td align="center" valign="top"><table cellpadding="5" cellspacing="0" width="100%">			
			{if $noRec eq 0}
				<tr>
					<td colspan="2" style="color:#FF0000; text-align:center;"><b>No Newsletter Found!</b></td>
				</tr>
			{else}
			<tr>
				<td class="labeltxt" align="left"><b>Subject</b></td>
				<td width="166" class="labeltxt"><b>Actions</b></td>
			</tr>			
			{section name=q loop=$newsletters}
				<tr bgcolor="{cycle values='#d1d1d1,#ffffff'}" >
					<td align="left">{$newsletters[q].letter_title}</td>
					<td>
					<a href="send_letter.php?letterid={$newsletters[q].letter_id}">Send</a>
						&nbsp;|&nbsp;
					<a href="edit_letter.php?letterid={$newsletters[q].letter_id}"><img border="0" alt="Edit" src="../graphics/edit.png"></a>
						&nbsp;|&nbsp;
					<a href="#" onclick="return deleteRec('{$newsletters[q].letter_id}');"><img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
				</tr>
			{/section}
			
				<tr>
					<td colspan="2" align="center">
						{$paging}					</td>
				</tr>
			{/if}
		</table></td>
        <td align="left" valign="top" background="../images/5.jpg"></td>
      </tr>
      <tr>
        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>
        <td align="left" valign="top" background="../images/7.jpg"></td>
        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>
      </tr>
    </table>
	
	</td>
</tr>
<tr>
  <td align="center" valign="top">&nbsp;</td>
</tr>
</table>
{include file = innerfooter.tpl}