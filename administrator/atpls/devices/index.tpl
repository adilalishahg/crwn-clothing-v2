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
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
                  
                  
                  
                  { if $errors != ''} {$errors} {/if}</span></td>
              </tr>
              <tr>
                <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> <a title="Add" href="add.php"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">DEVICES MANAGEMENT </td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px;"><table width="100%" border="0" class="main_table">
                    <tr>
                      <td width="30%" align="left" class="label_txt_heading"><strong>Device ID</strong></td>
          <td width="30%" align="left" class="label_txt_heading"><strong>Domain</strong></td>
                    <td width="20%" align="center" class="label_txt_heading"><strong>Added Date</strong></td>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Status</strong></td>
                    
                    </tr>
                    {section name=q loop=$org_data}
                    <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td align="left" valign="middle"><b>{$org_data[q].device_id}</b></td>
                      <td align="left" valign="middle">{$org_data[q].domain}</td>
                   <td align="center" valign="middle">{$org_data[q].date_added|date_format}</td>
             <td align="left" valign="middle">{if $org_data[q].status eq '1'}Active{/if}{if $org_data[q].status eq '0'}In-Active{/if}</td>
                      
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