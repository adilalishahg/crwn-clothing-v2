{ include file = headerinner.tpl}



{literal} 
<script type="text/javascript">



function deleteRec(id)



		{



		var ok;



		ok=confirm("Are you sure you want to delete this record?");



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
function byname(vl){ //alert(vl);
	location.href="index.php?name="+vl;
	}
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
                  
                  
                  
                  { if $errors != ''} {$errors} {/if}</span></td>
              </tr>
              <tr>
                <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
          Search By Account Name:<input type="text" name="byname" placeholder="Account Name" id="byname" value="{$byname}" onblur="byname(this.value);" size="30" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a> &nbsp;|&nbsp;&nbsp; [<a href="javascript:history.back();">Back</a>]| <a title="Add" href="add.php"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">ACCOUNTS MANAGEMENT </td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px;"><table width="100%" border="0" class="main_table">
                    <tr>
                      <td width="30%" align="left" class="label_txt_heading"><strong>Account Name</strong></td>
                      <td width="30" class="label_txt_heading"><strong>Address</strong></td>
                      <td width="15%" align="left" class="label_txt_heading"><strong>Phone</strong></td>
                      <td width="15%" align="left" class="label_txt_heading"><strong>Manage Rates</strong></td>
                      <td width="10%" align="center" class="label_txt_heading"><strong>Options</strong></td>
                    </tr>
                    {section name=q loop=$admdetail}
                    <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td align="left" valign="middle"><b>{$admdetail[q].account_name}</b></td>
                      <td align="left" valign="middle">{$admdetail[q].address}, {$admdetail[q].city}, {$admdetail[q].state} {$admdetail[q].zip}</td>
                      <td align="left" valign="middle">{$admdetail[q].phone}</td>
                      <td align="left" valign="middle"><a href="../rate_management/index.php?id={$admdetail[q].id}"><span style="color:#F00;">Manage</span></a></td>
                      <td align="center" valign="middle"><a href="edit.php?eId={$admdetail[q].id}" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp; <a href="#" onclick="return deleteRec('{$admdetail[q].id}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                    </tr>
                    {/section}
                  </table></td>
              </tr>
              <tr>
                <td align="center">{$paging}</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 