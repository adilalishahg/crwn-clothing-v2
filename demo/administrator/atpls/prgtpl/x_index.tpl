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

</script>
{/literal}
<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF">
  <tr>
     <td valign="top">
	   <table width="85%" border="0" cellspacing="0" cellpadding="0" class="outer_table" align="center">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="44" align="center" valign="top">
  							  </td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
                              <td height="19" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="adduser.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">ADMIN USERS  MANAGEMENT                              							</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="100%" border="0" class="main_table">
                  <tr>
                    <td width="20%" align="left" class="labeltxt"><strong>Name.</strong></td>
                    <td width="15%" align="left" class="labeltxt"><strong>Email Address </strong></td>
                    <td width="25%" align="left" class="labeltxt"><strong>Username</strong></td>
                    <td width="25%" align="left" class="labeltxt"><strong>Log</strong></td>
                    <td width="25%" align="left" class="labeltxt"><strong>Status</strong></td>
                    <td width="15%" align="center" class="labeltxt"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$admdetail}
				  <tr>
                    <td align="left" valign="middle"><b>{$admdetail[q].admin_name} {$admdetail[q].admin_lname}</b></td>
                    <td align="left" valign="middle">{$admdetail[q].admin_email_address}</td>
                    <td align="left" valign="middle">{$admdetail[q].admin_uname}</td>
                    <td align="left" valign="middle"><a href="#">View Log</a></td>
                    <td align="left" valign="middle">{$admdetail[q].admin_status}</td>
                    <td align="center" valign="middle">
					<a href="edituser.php?eId={$admdetail[q].admin_id}" title="Edit"> 
					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;
                    <a href="#" onclick="return deleteRec('{$admdetail[q].admin_id}');" title="Remove"> 
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				 {/section} 
                </table>				</td>
            </tr>
			<tr align="center">
			   <td>{$paging}</td>
			</tr>			
      </table>
    </td>
  </tr>
</table>
     </td>
  </tr>
</table>		 
{ include file = footer.tpl}
